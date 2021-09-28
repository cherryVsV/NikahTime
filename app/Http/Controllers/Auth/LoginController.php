<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\PasswordIncorrectError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Resources\ProfileResource;
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

    public function login(Request $request)
    {
        $checkUserData = new CheckUserDataController();
        $user = $checkUserData->checkUserData($request);
        if ($request->grantType == 'email' || $request->grantType == 'phone') {
            if (!Hash::check($request->password, $user->password)) {
                throw new PasswordIncorrectError();
            }
        }
        $generateToken = new GenerateAccessTokenService();
        $token = $generateToken->generateToken($request, $user);
        $profile = Profile::where('user_id', $user->id)->first();
        return response()->json([
                'user'=> new ProfileResource($profile),
                'tokenData' =>$token
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
