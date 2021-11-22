<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class RealTimeNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $message;
    protected $fcmToken;
    protected $image;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $message, $image, $fcmToken)
    {
        $this->title = $title;
        $this->message = $message;
        $this->image = $image;
        $this->fcmToken = $fcmToken;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        return Larafirebase::withTitle($this->title)
            ->withBody($this->message)
            ->withImage($this->image)
            ->withPriority('high')
            ->sendMessage($this->fcmToken);

    }
}
