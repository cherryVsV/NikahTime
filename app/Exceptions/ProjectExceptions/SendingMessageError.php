<?php


namespace App\Exceptions\ProjectExceptions;


class SendingMessageError extends BaseError
{
    public function __construct()
    {
        parent::__construct("ERR_SEND_MESSAGE_FAILED", 550, "Message can't be sent ");
    }
}
