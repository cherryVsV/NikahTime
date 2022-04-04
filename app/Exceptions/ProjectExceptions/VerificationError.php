<?php


namespace App\Exceptions\ProjectExceptions;


class VerificationError extends BaseError
{
    public function __construct($username)
    {
        parent::__construct("ERR_VERIFICATION_FAILED", 403, "Code or email/phone for username - ".$username. " don't matches our credentials");
    }
}
