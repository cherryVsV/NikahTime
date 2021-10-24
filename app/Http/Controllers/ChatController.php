<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function getChatMessages()
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        if(!Chat::where('user1_id',$auth_id)->orWhere('user2_id',$auth_id)->exists()){
            throw new ValidationDataError('ERR_CHATS_NOT_FOUND', 422, 'Selected user do not have any chats');
        }
        $chats = $this->getChatsInformation();
        return response()->json($chats, 200);
    }

    public function addUserChat($userId)
    {
        if(!User::where('id', $userId)->exists()){
            throw new ValidationDataError('ERR_USER_NOT_FOUND', 422, 'Selected user do not exists');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if($auth_id == $userId){
            throw new ValidationDataError('ERR_CHAT_CREATE', 422, 'User can not have chat with itself');
        }
        if(!Chat::where(['user1_id'=>$auth_id, 'user2_id'=>$userId])->orWhere(['user2_id'=>$auth_id, 'user1_id'=>$userId])->exists()){
            $chat = Chat::create([
                'user1_id'=>$auth_id,
                'user2_id'=>$userId
            ]);
        }else{
            $chat = Chat::where(['user1_id'=>$auth_id, 'user2_id'=>$userId])->orWhere(['user2_id'=>$auth_id, 'user1_id'=>$userId])->first();
        }
        $user = Profile::where('user_id', $userId)->first();
        $avatar = null;
        if(!is_null($user->photos)) {
            $avatar = json_decode($user->photos)[0];
        }
        return response()->json([
            "chatId"=> $chat->id,
            "userAvatar"=> $avatar,
            "userName"=> $user->first_name
        ], 200);

    }

    /**
     * @throws ValidationDataError
     */
    public function blockChat($chatId)
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        if(!Chat::where(['id'=>$chatId, 'user1_id'=>$auth_id])->orWhere(['id'=>$chatId, 'user2_id'=>$auth_id])->exists())
        {
            throw new ValidationDataError('ERR_CHAT_NOT_FOUND', 422, 'Selected chat do not exists');
        }
        $chat = Chat::find($chatId);
        if($chat->is_blocked){
            $chat->user_block= null;
        }else{
            $chat->user_block= $auth_id;
        }
        $chat->is_blocked = !$chat->is_blocked;
        $chat->save();
        return response()->json($this->getChat($chatId), 200);

    }

    public function deleteChat($chatId)
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        if(!Chat::where(['id'=>$chatId, 'user1_id'=>$auth_id])->orWhere(['id'=>$chatId, 'user2_id'=>$auth_id])->exists())
        {
            throw new ValidationDataError('ERR_CHAT_NOT_FOUND', 422, 'Selected chat do not exists');
        }
        $chat = Chat::find($chatId);
        $chat->delete();
        $chats = $this->getChatsInformation();
        return response()->json($chats, 200);
    }

    public function getChatInformation($chatId)
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        if(!Chat::where(['id'=>$chatId, 'user1_id'=>$auth_id])->orWhere(['id'=>$chatId, 'user2_id'=>$auth_id])->exists())
        {
            throw new ValidationDataError('ERR_CHAT_NOT_FOUND', 422, 'Selected chat do not exists');
        }
        return response()->json($this->getChat($chatId), 200);

    }
    public function getChat($chatId)
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        $chat = Chat::where(['id' => $chatId, 'user1_id' => $auth_id])->orWhere(['id' => $chatId, 'user2_id' => $auth_id])->first();
        if ($chat->user1_id == $auth_id) {
            $user = Profile::where('user_id', $chat->user2_id)->first();
        } else {
            $user = Profile::where('user_id', $chat->user1_id)->first();
        }
        $avatar = null;
        if (!is_null($user->photos)) {
            $avatar = json_decode($user->photos)[0];
        }
        $isAuthBlock = false;
        if (!is_null($chat->user_block) && $chat->user_block == $auth_id) {
            $isAuthBlock = true;
        }
        if (Message::where('chat_id', $chat->id)->exists()) {
            $chatData = ['chatId' => $chat->id, 'userAvatar' => $avatar, 'userName' => $user->first_name, 'isChatBlocked' => $chat->is_blocked,
                'isAuthUserBlockChat' => $isAuthBlock];
            $messageData = [];
            $messages = Message::where('chat_id', $chat->id)->get();
            foreach ($messages as $message) {
                $isAuthMessage = false;
                if ($message->user_id == $auth_id) {
                    $isAuthMessage = true;
                }
                $messageData[] = ['message' => $message->message, 'messageTime' => Carbon::parse($message->created_at)->format('d.m.Y H:i:s'),
                    'isAuthUserMessage' => $isAuthMessage,'messageType'=>$message->type, 'messageId' => $message->id, 'isMessageSeen' => $message->is_seen];
            }
            return ['chat' => $chatData, 'messages' => $messageData];
        }
        return [];
    }
    public function getChatsInformation()
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        $userChats = Chat::where('user1_id',$auth_id)->orWhere('user2_id',$auth_id)->get();
        $chats = [];
        foreach($userChats as $chat){
            if($chat->user1_id == $auth_id)
            {
                $user = Profile::where('user_id', $chat->user2_id)->first();
            }else
            {
                $user = Profile::where('user_id', $chat->user1_id)->first();
            }
            $avatar = null;
            if(!is_null($user->photos))
            {
                $avatar = json_decode($user->photos)[0];
            }
            $isAuthBlock = false;
            if(!is_null($chat->user_block) && $chat->user_block == $auth_id)
            {
                $isAuthBlock = true;
            }
            if(Message::where('chat_id',$chat->id)->exists())
            {
                $message = Message::orderBy('id', 'desc')->take(1)->first();
                $notSeenCount = Message::where(['chat_id'=>$chat->id, 'receiver_id'=>$auth_id, 'is_seen'=>false])->count();
                $isAuthMessage = false;
                if($message->user_id == $auth_id){
                    $isAuthMessage = true;
                }
                $data = ['chatId'=>$chat->id, 'userAvatar'=>$avatar, 'userName'=>$user->first_name, 'isChatBlocked'=>$chat->is_blocked, 'isAuthUserBlockChat'=>$isAuthBlock,
                    'lastMessage'=>$message->message, 'lastMessageType'=>$message->type, 'lastMessageTime'=>Carbon::parse($message->created_at)->format('d.m.Y H:i:s'), 'isAuthUserMessage'=>$isAuthMessage, 'isSeenMessage'=>$message->is_seen,
                    'numberNotSeenMessages'=>$notSeenCount
                ];
                $chats[] = $data;
            }
        }
        return $chats;
    }
}
