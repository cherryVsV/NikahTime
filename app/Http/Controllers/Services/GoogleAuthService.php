<?php


namespace App\Http\Controllers\Services;


use App\Exceptions\ProjectExceptions\SocialAuthError;
use Exception;

class GoogleAuthService
{
    private $token;

    public function decode()
    {
        if (!$this->token) {
            return null;
        }
        try{
        $tokenParts = explode(".", $this->token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode(str_replace(array('-', '_'), array('+', '/'), $tokenParts[1]));
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
        }
        catch (Exception $ex){
            throw new SocialAuthError('ERR_AUTHORIZATION_FAILED', 422, 'Token incorrect');
        }
    }

    public function getSub()
    {
        $googleSignInPayload = $this->decode();

        return $googleSignInPayload->sub;
    }

    public function setToken($token){
        $this->token = $token;
    }

}
