<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function getMessage($messageId)
    {
        //$messages = Message::all();

       // return new MessageCollection($messages);
    }


    public function sendMessage(Request $request)
    {
        $this->validate($request,[
            'message'=>['required', 'string']
        ]);
        $user_id = auth()->user()->getAuthIdentifier();
        $user = User::find($user_id);
        event(new NewChatMessage($request->message, $user));
        return response()->json('Event generated correctly');
    }

    public function makeSeenMessage($messageId){

    }


}
