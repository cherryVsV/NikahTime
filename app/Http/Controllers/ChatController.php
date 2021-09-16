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
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ChatCollection
     */
    public function index(Request $request)
    {
        $chats = Chat::all();

        return new ChatCollection($chats);
    }

    /**
     * @param \App\Http\Requests\ChatStoreRequest $request
     * @return \App\Http\Resources\ChatResource
     */
    public function store(ChatStoreRequest $request)
    {
        $chat = Chat::create($request->validated());

        return new ChatResource($chat);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chat $chat
     * @return \App\Http\Resources\ChatResource
     */
    public function show(Request $request, Chat $chat)
    {
        return new ChatResource($chat);
    }

    /**
     * @param \App\Http\Requests\ChatUpdateRequest $request
     * @param \App\Models\Chat $chat
     * @return \App\Http\Resources\ChatResource
     */
    public function update(ChatUpdateRequest $request, Chat $chat)
    {
        $chat->update($request->validated());

        return new ChatResource($chat);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chat $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Chat $chat)
    {
        $chat->delete();

        return response()->noContent();
    }
}
