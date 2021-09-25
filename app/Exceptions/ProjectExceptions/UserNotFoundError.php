<?php


namespace App\Exceptions\ProjectExceptions;


class UserNotFoundError extends BaseError
{
    public function __construct()
    {
        parent::__construct("Data doesn't match our credentials", 422, "User doesn't exist");
    }
}
