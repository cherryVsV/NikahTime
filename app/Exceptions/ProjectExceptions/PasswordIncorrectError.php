<?php


namespace App\Exceptions\ProjectExceptions;


class PasswordIncorrectError extends BaseError
{
    public function __construct($id)
    {
        parent::__construct("ERR_AUTHORIZATION_FAILED", 422, "Password field is incorrect for user_id = ".$id);
    }
}
