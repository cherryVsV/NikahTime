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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $passwordReset = DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'verify'])->first();
            $password = $passwordReset->password;
            if ($passwordReset == null || !Hash::check($request->code, $passwordReset->token)) {
                throw new VerificationError();
            }
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($password),
                'email_verified_at'=>Carbon::now()
            ]);
            DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'verify'])->delete();
            Profile::create([
                'user_id' => $user->id
            ]);
            $generateToken = new GenerateAccessTokenService();
            $token = $generateToken->generateToken($request, $request->email, $password);
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
            DB::table("password_resets")->insert([
                "email" => $toEmail,
                "token" => Hash::make($code),
                "type"=>'verify',
                "password"=>$request->password
            ]);
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
            $username = $userData['username'].' google';
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
            if(!DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'verify'])->exists()) {
                throw new VerificationError();
            }
           DB::table('password_resets')->where(['email' => $request->email, 'type' => 'verify'])
               ->update(['token'=>Hash::make($code)]);

            $sendCode = new SendCodeController();
            $answer = $sendCode->sendEmailCode($toEmail, $code);
            if($answer=='ok'){
                return response(null, 202);
            }
        }

    }

}
