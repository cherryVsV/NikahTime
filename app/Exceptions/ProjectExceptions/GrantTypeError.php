<?php


namespace App\Exceptions\ProjectExceptions;


class GrantTypeError extends BaseError
{
    public function __construct()
    {
        parent::__construct("Validation failed", 422, "grantType field is required");
    }
}
