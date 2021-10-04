<?php

namespace App\Http\Controllers\Voyager;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string','email', 'exists:users,email'],
            'password' => ['required','string'],
        ]);
    }
    public function postLogin(Request $request)
    {
        $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();
        if($user->role_id !=1){
            return $this->sendFailedLoginResponse($request);
        }
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
