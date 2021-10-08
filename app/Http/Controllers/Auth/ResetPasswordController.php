<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\GrantTypeError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Exceptions\ProjectExceptions\VerificationError;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\GenerateAccessTokenService;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function getResetPasswordCode(Request $request)
    {
        $this->validate($request, [
            'grantType' => ['required', 'string']
        ]);
        $checkUserData = new CheckUserDataController();
        $user = $checkUserData->checkUserData($request);
        if ($request->grantType == "email") {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users']
            ]);
            $toEmail = $request->email;
            $code = '';
            $array = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
            for ($i = 0; $i < 14; $i++) {
                $code .= $array[mt_rand(0, count($array) - 1)];
            }
            if(DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'reset'])->exists()){
                DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'reset'])->delete();
            }
            DB::table("password_resets")->insert([
                "email" => $toEmail,
                "token" => Hash::make($code),
                "type"=>'reset'
            ]);
            $sendCode = new SendCodeController();
            $answer = $sendCode->sendEmailCode($toEmail, $code);
            if($answer=='ok'){
                return response(null, 200);
            }

        }

    }

    public function verifyResetPasswordCode(Request $request)
    {
        $this->validate($request, [
            'grantType' => ['required', 'string']
        ]);
        if ($request->grantType == "email") {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users', 'exists:password_resets'],
                'code' => ['required', 'string']
            ]);

            $passwordReset = DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'reset'])->first();
            if ($passwordReset == null || !Hash::check($request->code, $passwordReset->token)) {
                throw new VerificationError();
            }
            return response(null, 204);

        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'grantType' => ['required', 'string']
        ]);
        if ($request->grantType == "email") {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users', 'exists:password_resets'],
                'password' => ['required', 'string', 'min:8'],
                'code' => ['required', 'string']
            ]);
            $passwordReset = DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'reset'])->first();
            if ($passwordReset == null || !Hash::check($request->code, $passwordReset->token)) {
                throw new VerificationError();
            }
            DB::table('password_resets')->where(['email'=> $request->email, 'type'=>'reset'])->delete();
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $generateToken = new GenerateAccessTokenService();
            $token = $generateToken->generateToken($request, $request->email, $request->password);
            $profile = Profile::where('user_id', $user->id)->first();
            return response()->json([
                'user' => new ProfileResource($profile),
                'tokenData' => $token
            ], 200);

        }


    }
}
