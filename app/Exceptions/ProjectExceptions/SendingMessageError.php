<?php


namespace App\Exceptions\ProjectExceptions;


class SendingMessageError extends BaseError
{
    public function __construct()
    {
        parent::__construct("Sending message error", 550, "Message can't be sent ");
    }
}
