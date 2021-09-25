<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Exceptions\ProjectExceptions\VerificationError;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
                'email' => ['required', 'string', 'email','unique:users' ],
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
            $date = new DateTime();
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);
            Auth::login($user);
            $tokenResult = $user->createToken('NikahTime Personal Access Client');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'TokenData' => [
                    'accessToken' => $tokenResult->accessToken,
                    'expiresIn' => $date->getTimestamp(),
                    'refreshToken' => $token->revoked
                ]
            ], 200);
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
    }

    public function requestRegistrationCode(Request $request){
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
