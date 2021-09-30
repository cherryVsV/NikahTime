<?php


namespace App\Exceptions\ProjectExceptions;


class UserNotFoundError extends BaseError
{
    public function __construct()
    {
        parent::__construct("ERR_AUTHORIZATION_FAILED", 422, "User doesn't exist");
    }
}
