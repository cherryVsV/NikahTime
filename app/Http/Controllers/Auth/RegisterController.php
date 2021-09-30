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
        $this->validate($request, [
            'grantType'=>['required', 'string']
        ]);
        if ($request->grantType == 'email') {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'unique:users'],
                'code' => ['required'],
            ]);
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
            $token = $generateToken->generateToken($request, $email, $password);
            return response()->json(
               $token
            , 200);
        }
    }

    public function registration(Request $request)
    {
        $this->validate($request, [
            'grantType'=>['required', 'string']
        ]);
        if ($request->grantType == 'email') {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8']
            ]);
            $toEmail = $request->email;
            $code = strval(mt_rand(100000, 999999));
            session(['email' => $toEmail, 'password' => $request->password, "code" => $code]);
            $sendCode = new SendCodeController();
            $answer = $sendCode->sendEmailCode($toEmail, $code);
            if($answer=='ok'){
                return response(null, 204);
            }

        }
        if ($request->grantType == 'googleIdToken') {
            $this->validate($request, [
                'idToken' => ['required', 'string'],
            ]);
            $register = new LoginAndRegisterViaGoogleService();
            $userData = $register->authViaGoogle($request->idToken);
            $generateToken = new GenerateAccessTokenService();
            $user = $userData['user'];
            $username = $userData['username'];
            $password = $userData['password'];
            $token = $generateToken->generateToken($request, $username, $password);
            return response()->json(
                $token
                , 200);
           // return response(null,204);

        }
    }

    public function requestRegistrationCode(Request $request)
    {
        $this->validate($request, [
            'grantType'=>['required', 'string']
        ]);
        if ($request->grantType == 'email') {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $toEmail = $request->email;
            $code = strval(mt_rand(100000, 999999));
            session(['email' => $toEmail, "code" => $code]);
            $sendCode = new SendCodeController();
            $answer = $sendCode->sendEmailCode($toEmail, $code);
            if($answer=='ok'){
                return response(null, 202);
            }
        }

    }

}
