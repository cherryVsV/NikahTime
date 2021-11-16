<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\SocialAuthError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function index($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
            $username = $userSocial->id;
            $password = strval(mt_rand(10000000, 99999999));
            if (!SocialAccount::where(['provider_id' => $username, 'provider' => $provider])->exists()) {
                $user = User::create([
                    'password' => Hash::make($password)
                ]);
                Profile::create([
                    'user_id' => $user->id
                ]);
                SocialAccount::create([
                    'user_id' => $user->id,
                    'provider_id' => $username,
                    'provider' => $provider
                ]);
            } else {
                $social = SocialAccount::where(['provider_id' => $username, 'provider' => $provider])->first();
                $user = User::where('id', $social->user_id)->first();
                $user->password = Hash::make($password);
                $user->save();
            }
            $generateToken = new GenerateAccessTokenService();
            $username = $username . ' apple';
            $request = new Request();
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
