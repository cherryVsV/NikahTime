<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Exceptions\ProjectExceptions\VerificationError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Controllers\Services\LoginAndRegisterViaGoogleService;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function verifyRegistrationCode(Request $request)
    {
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        if ($request->grantType == 'email') {
            $rules = [
                'email' => ['required', 'string', 'email', 'unique:users'],
                'code' => ['required'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            }
            $code = session('code');
            $email = session('email');
            $password = session('password');
            if ($email != $request->email || $code != $request->code) {
                throw new VerificationError();
            }
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);
            $generateToken = new GenerateAccessTokenService();
            $token = $generateToken->generateToken($request, $user);
            return response()->json(
               $token
            , 200);
        }
    }

    public function registration(Request $request)
    {
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        if ($request->grantType == 'email') {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            }
            $toEmail = $request->email;
            $code = strval(mt_rand(100000, 999999));
            session(['email' => $toEmail, 'password' => $request->password, "code" => $code]);
            $sendCode = new SendCodeController();
            $sendCode->sendEmailCode($toEmail, $code, 204);

        }
        if ($request->grantType == 'googleIdToken') {
            $rules = [
                'idToken' => ['required', 'string'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            }
            $register = new LoginAndRegisterViaGoogleService();
            $user = $register->authViaGoogle($request->idToken);
            $generateToken = new GenerateAccessTokenService();
            $token = $generateToken->generateToken($request, $user);
            return response()->json([], 204);

        }
    }

    public function requestRegistrationCode(Request $request)
    {
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        if ($request->grantType == 'email') {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            }
            $toEmail = $request->email;
            $code = strval(mt_rand(100000, 999999));
            session(['email' => $toEmail, "code" => $code]);
            $sendCode = new SendCodeController();
            $sendCode->sendEmailCode($toEmail, $code, 202);
        }

    }

}
