<?php


namespace App\Http\Controllers\Services;

use AnimusCoop\AppleTokenAuth\Classes\AppleAuth;

class AppleAuthService
{
    private $token;
    public function decode()
    {
        if (!$this->token) {
            return null;
        }

        $tokenParts = explode(".", $this->token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode(str_replace(array('-', '_'), array('+', '/'), $tokenParts[1]));
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
    }

    public function getSub()
    {
        $appleSignInPayload = $this->decode();

        return $appleSignInPayload->sub;
    }
    public function setToken($token){
        $this->token = $token;
    }
}
