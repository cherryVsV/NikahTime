<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\PasswordIncorrectError;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginController extends Controller
{
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $checkUserData = new CheckUserDataController();
        $user = $checkUserData->checkUserData($request);
        if (!Hash::check($request->password, $user->password)) {
            throw new PasswordIncorrectError();
        }
        Auth::login($user);
        $tokenResult = $user->createToken('NikahTime Personal Access Client');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $profile = Profile::where('user_id', $user->id)->first();
        $firstName = $profile->name;
        $date = new DateTime();
        //make success response correct!
        return response()->json([
            'Account' => [
                'user' => [
                    'firstName' => $firstName
                ],
                'tokenData' => [
                    'accessToken' => $tokenResult->accessToken,
                    'expiresIn' => $date->getTimestamp(),
                    'refreshToken' => $token->revoked
                ]
            ]
        ], 200);

    }

    public function logOut()
    {
        try {
            $accessToken = auth()->user()->token();

            $refreshToken = DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);

            $accessToken->revoke();

            return response()->json(['code' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['error' =>
                ['code' => 404,
                    'title' => 'error',
                    'details' => $e]],
                404);
        }
    }
}
