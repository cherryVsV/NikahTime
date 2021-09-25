<?php


namespace App\Exceptions\ProjectExceptions;


class VerificationError extends BaseError
{
    public function __construct()
    {
        parent::__construct("Verification failed", 403, "Code or email don't matches our credentials");
    }
}
