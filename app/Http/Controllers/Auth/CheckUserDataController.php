<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\SocialAuthError;
use App\Exceptions\ProjectExceptions\UserNotFoundError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\AppleAuthService;
use App\Http\Controllers\Services\GoogleAuthService;
use App\Http\Controllers\Services\LoginAndRegisterViaGoogleService;
use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CheckUserDataController extends Controller
{
    public function checkUserData(Request $request){
        $user = null;
        $username = '';
        $password = '';
        if ($request->grantType == 'email') {
            $this->validate($request, [
                'email'=>['required', 'string', 'email', 'exists:users']
            ]);
            $user = User::where('email', $request->email)->first();
            $username = $user->email;
        }
        if ($request->grantType == 'phoneNumber') {
            $this->validate($request, [
                'phoneNumber'=>['required', 'string', 'exists:users,phone']
            ]);
            $user = User::where('phone', $request->phoneNumber)->first();
            $username = $user->phone;
        }
        if ($request->grantType == 'googleIdToken') {
            $this->validate($request, [
                'idToken'=>['required', 'string']
            ]);
            $login = new LoginAndRegisterViaGoogleService();
            $userData = $login->authViaGoogle($request->idToken, 'google');
            $user = $userData['user'];
            $username = $userData['username'];
            $password = $userData['password'];
        }
        if ($request->grantType == 'appleIdToken') {
            $this->validate($request, [
                'idToken'=>['required', 'string']
            ]);
            $login = new LoginAndRegisterViaGoogleService();
            $userData = $login->authViaGoogle($request->idToken, 'apple');
            $user = $userData['user'];
            $username = $userData['username'];
            $password = $userData['password'];
        }
        if (is_null($user)) {
            throw new UserNotFoundError($username);
        }
        return ['user'=>$user, 'username'=>$username, 'password'=>$password];
    }
}
