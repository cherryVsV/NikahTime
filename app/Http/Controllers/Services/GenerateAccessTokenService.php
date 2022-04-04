<?php


namespace App\Http\Controllers\Services;


use App\Exceptions\ProjectExceptions\SocialAuthError;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class GenerateAccessTokenService
{
    public function generateToken(Request $req, $username, $password)
    {
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();
        try {
            $req->request->add([
                "grant_type" => "password",
                "client_id" => $client->id,
                "client_secret" => $client->secret,
                "username" => $username,
                "password" => $password,
            ]);

            $tokenRequest = $req->create(
                '/oauth/token',
                'post'
            );
            $instance = Route::dispatch($tokenRequest);
            $token = json_decode($instance->getContent());
            return [
                'accessToken' => $token->access_token,
                'expiresIn' => $token->expires_in,
                'refreshToken' => $token->refresh_token
            ];
        } catch (Exception $e) {
            throw new SocialAuthError('ERR_AUTHORIZATION_FAILED', 422, 'Username- '.$username.' '.$e->getMessage());
        }

    }
}
