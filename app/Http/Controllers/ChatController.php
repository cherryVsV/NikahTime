<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatStoreRequest;
use App\Http\Requests\ChatUpdateRequest;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getChatMessages()
    {
        $chats = Chat::all();

        return new ChatCollection($chats);
    }

    public function addUserChat($userId)
    {
        //$chat = Chat::create($request->validated());

        //return new ChatResource($chat);
    }

    public function blockChat($chatId)
    {
        //$chat->update($request->validated());

        //return new ChatResource($chat);
    }

    public function deleteChat($chatId)
    {
        //$chat->delete();

       // return response()->noContent();
    }

    public function getChatInformation($chatId){

    }
}
