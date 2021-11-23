<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\RealTimeNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{

    public function getMessage($messageId)
    {
        if(!Message::where('id',$messageId)->exists()){
            throw new ValidationDataError('ERR_MESSAGE_NOT_FOUND', 422, 'Selected message do not exists');
        }
        return response()->json($this->getMessageData($messageId), 200);
    }


    public function sendMessage(Request $request)
    {
        $this->validate($request,[
            'message'=>['required', 'string'],
            'chatId'=>['required', 'integer', 'exists:chats,id'],
            'messageType'=>['required', 'string']
        ]);
        if($request->messageType == 'text') {
            $patternUrl = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
            $patternPhone = '/[(]*\d{3}[)]*\s*[.\-\s]*\d{3}[.\-\s]*\d{4}/';
            if (preg_match($patternUrl, $request->message) || preg_match($patternPhone, $request->message)) {
                throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'Field message contains unresolved characters');
            }
        }
        try{
        $user_id = auth()->user()->getAuthIdentifier();
        $sender = Profile::where('user_id',$user_id)->first();
        if(!Chat::where('id',$request->chatId )->exists()){
            throw new ValidationDataError('ERR_CHAT_NOT_FOUND', 422, 'Selected chat do not exists');
        }
        $chat = Chat::find($request->chatId);
        if($chat->user1_id == $user_id){
            $receiverId = $chat->user2_id;
        }else{
            $receiverId = $chat->user1_id;
        }
        $user = User::find($receiverId);
        $message = Message::create([
            'user_id'=>$user_id,
            'chat_id'=>$request->chatId,
            'message'=>$request->message,
            'receiver_id'=>$receiverId,
            'type'=>$request->messageType
        ]);
        broadcast(new NewChatMessage($message->id, $user, 'Новое сообщение'));
        if(!is_null($user->notification_id)){
            $avatar = null;
            if (!is_null($sender->photos)) {
                $avatar = json_decode($sender->photos)[0];
                if(!str_starts_with($avatar, 'http')){
                    $avatar = URL::to('/') . '/storage/'.$avatar;
                }
            }
            return $this->sendNotification($user->notification_id, array(
                "title" => "Новое сообщение",
                "text" => $request->message
            ));
        }

        return response(null, 200);

        }
        catch (Exception $e){
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_SEND_MESSAGE_FAILED',
                'details' => $e->getMessage()],
                404);
        }

    }

    public function makeSeenMessage($messageId)
    {
        if(!Message::where('id',$messageId)->exists()){
            throw new ValidationDataError('ERR_MESSAGE_NOT_FOUND', 422, 'Selected message do not exists');
        }
        $message = Message::find($messageId);
        if($message->is_seen){
            throw new ValidationDataError('ERR_MESSAGE_ALREADY_SEEN', 422, 'Selected message is already seen');
        }
        $message->is_seen = true;
        $message->save();
        $userId = $message->user_id;
        $user = User::find($userId);
       event(new NewChatMessage($message->id, $user, 'Прочитано'));
        return response()->json($this->getMessageData($messageId), 200);

    }

    public function getMessageData($messageId)
    {
        $user_id = auth()->user()->getAuthIdentifier();
        $message = Message::find($messageId);
        $isAuthUserMessage = false;
        if($message->user_id == $user_id){
            $isAuthUserMessage = true;
        }
        return ['message'=>$message->message, 'messageTime'=>Carbon::parse($message->created_at)->format('d.m.Y H:i:s'),
            'isAuthUserMessage'=>$isAuthUserMessage, 'messageType'=>$message->type, 'messageId'=>$message->id, 'isMessageSeen'=>$message->is_seen];

    }

    public function sendNotification($device_token, $message)
    {
        $SERVER_API_KEY = 'AAAA7lhkIJw:APA91bHWE_uMLI15hP0WD7RPS-QKFYVP0mnGxENbV6FmdmGuTc5Lvi7ZExQ_9-Xr1V40ulH0YRDutkgPBXiBHKFTnKr8kDURJUF9QkAtH6zSVS7Ybyq8nzvvtJ97rAUJfWHB3npLpdkP';

        // payload data, it will vary according to requirement
        $data = [
            "to" => $device_token, // for single device id
            "data" => $message
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }


}
