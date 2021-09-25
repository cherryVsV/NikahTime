<?php


namespace App\Exceptions\ProjectExceptions;


class PasswordIncorrectError extends BaseError
{
    public function __construct()
    {
        parent::__construct("Authorization failed", 422, "Password field is incorrect");
    }
}
