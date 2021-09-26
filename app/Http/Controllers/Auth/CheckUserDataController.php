<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\UserNotFoundError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\LoginAndRegisterViaGoogleService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if ($request->grantType == 'googleIdToken') {
            $rules = [
                'idToken' => ['required', 'string'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            }
            $auth = new LoginAndRegisterViaGoogleService();
            $user = $auth->authViaGoogle($request->idToken);
        }
        if (is_null($user)) {
            throw new UserNotFoundError();
        }
        return $user;
    }
}
