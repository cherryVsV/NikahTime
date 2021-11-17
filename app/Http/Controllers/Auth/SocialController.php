<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\SocialAuthError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Controllers\Services\LoginAndRegisterViaGoogleService;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\SocialAccount;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function index($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);
        $code = $requestData['code'];
        try {
            SocialAccount::create([
               'user_id'=>93,
               'provider'=>'apple',
               'provider_id'=>$code
            ]);
            $client = new Client();
            $response = $client->request('POST', 'https://appleid.apple.com/auth/token', ['form_params' => [
                'client_id' => "ru.nikahtime.web",
                'client_secret' => "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImtpZCI6IjVEUDdITTc3VDcifQ.eyJpc3MiOiJaM1k1TDhIVkRCIiwiaWF0IjoxNjM3MTMxODIwLCJleHAiOjE2NTI2ODM4MjAsImF1ZCI6Imh0dHBzOi8vYXBwbGVpZC5hcHBsZS5jb20iLCJzdWIiOiJydS5uaWthaHRpbWUud2ViIn0.fvgIqQoKDt7z0sFo87-L5e77onGyzybS0DyJSnFRfnL8hJXPUvDoRzykTfNvSB4JxJd8XTmbjshT-1lT2pOvGw",
                'code' => $code,
                'grant_type' => 'authorization_code'
            ]]);

            $content = json_decode($response->getBody(), true);
            $idToken = $content['id_token'];
            $register = new LoginAndRegisterViaGoogleService();
            $userData = $register->authViaGoogle($idToken, 'apple');
            $generateToken = new GenerateAccessTokenService();
            $user = $userData['user'];
            $username = $userData['username'].' apple';
            $password = $userData['password'];
            $token = $generateToken->generateToken($request, $username, $password);
            $profile = Profile::where('user_id', $user->id)->first();
            return response()->json([
                'user' => new ProfileResource($profile),
                'tokenData' => $token
            ], 200);
        } catch (Exception $e) {
            throw new SocialAuthError('ERR_AUTHORIZATION_FAILED', 422, $e->getMessage());
        }
    }
}
