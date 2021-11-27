<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\PasswordIncorrectError;
use App\Exceptions\ProjectExceptions\UserNotFoundError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
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
        $this->validate($request, [
            'grantType' => ['required', 'string']
        ]);
        $checkUserData = new CheckUserDataController();
        $userData = $checkUserData->checkUserData($request);
        $password = '';
        $user = $userData['user'];
        $username = $userData['username'];
        if ($request->grantType == 'email' || $request->grantType == 'phoneNumber') {
            if (!Hash::check($request->password, $user->password)) {
                throw new PasswordIncorrectError();
            }
            $password = $request->password;
        }
        if ($request->grantType == 'googleIdToken') {
            $password = $userData['password'];
            $username = $username . ' google';
        }
        if ($request->grantType == 'appleIdToken') {
            $password = $userData['password'];
            $username = $username . ' apple';
        }
        if (!is_null($user->blocked_at)) {
            throw new ValidationDataError('ERR_USER_AUTH', 403, 'Selected user is blocked!');
        }
        if ($request->has('notificationId')) {
            if (!is_null($user->notification_id)) {
                $not_tokens = json_decode($user->notification_id);
                if (!in_array($request->notificationId, $not_tokens)) {
                    $not_tokens[] = $request->notificationId;
                }

            } else {
                $not_tokens[] = $request->notificationId;
            }
            $user->notification_id = $not_tokens;
            $user->save();
        }
        $generateToken = new GenerateAccessTokenService();
        $token = $generateToken->generateToken($request, $username, $password);
        $profile = Profile::where('user_id', $user->id)->first();
        return response()->json([
            'user' => new ProfileResource($profile),
            'tokenData' => $token
        ], 200);

    }

    public function logout($token)
    {
        try {
            $user = User::find(auth()->user()->getAuthIdentifier());
            $accessToken = auth()->user()->token();
            $refreshToken = DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);
            $accessToken->revoke();
            if (!is_null($user->notification_id)) {
                $not_tokens = json_decode($user->notification_id);
                if (in_array($token, $not_tokens)) {
                    $array = array_flip(  $not_tokens);
                    unset ($array[$token]);
                    $not_tokens = array_flip($array);
                }
            }
            $user->notification_id = $not_tokens;
            $user->save();
            return response(null, 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_LOGOUT_FAILED',
                'details' => $e->getMessage()],
                404);
        }
    }
}
