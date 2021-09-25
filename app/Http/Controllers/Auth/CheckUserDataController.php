<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\UserNotFoundError;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CheckUserDataController extends Controller
{
    public function checkUserData(Request $request){
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        $user = null;
        if ($request->grantType == 'email') {
            $user = User::where('email', $request->email)->first();
        }
        if ($request->grantType == 'phone') {
            $user = User::where('phone', $request->phoneNumber)->first();
        }
        if (is_null($user)) {
            throw new UserNotFoundError();
        }
        return $user;
    }
}
