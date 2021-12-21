<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $type;
    public $user;
    public $chat;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $chat, $user, $type)
    {
        $this->message = $message;
        $this->chat = $chat;
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chats.'.$this->user->id);
    }
    /**
     * Получите данные для трансляции.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'messageId' => $this->message,
            'chatId'=>$this->chat,
            'type'=>$this->type
        ];
    }
}
