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
        $checkUserData = new CheckUserDataController();
        $user = $checkUserData->checkUserData($request);
        if ($request->grantType == "email") {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            } else {
                $toEmail = $request->email;
                $code = '';
                $array = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'));
                for ($i = 0; $i < 14; $i++) {
                    $code .= $array[mt_rand(0, count($array) - 1)];
                }
                DB::table("password_resets")->insert([
                    "email" => $toEmail,
                    "token" => Hash::make($code)
                ]);
                $sendCode = new SendCodeController();
                $sendCode->sendEmailCode($toEmail, $code, 200);
            }
        }

    }

    public function verifyResetPasswordCode(Request $request)
    {
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        if ($request->grantType == "email") {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users', 'exists:password_resets'],
                'code' => ['required', 'string']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            } else {
                $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();
                if ($passwordReset == null || !Hash::check($request->code, $passwordReset->token)) {
                    throw new VerificationError();
                }
                return response()->json([], 204);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        if (!$request->has('grantType') || is_null($request->grantType)) {
            throw new GrantTypeError();
        }
        if ($request->grantType == "email") {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users', 'exists:password_resets'],
                'password' => ['required', 'string', 'min:8'],
                'code' => ['required', 'string']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationDataError("Validation failed", 422, $validator->errors()->first());
            } else {
                $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();
                if ($passwordReset == null || !Hash::check($request->code, $passwordReset->token)) {
                    throw new VerificationError();
                }
                DB::table('password_resets')->where('email', $request->email)->delete();
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->password);
                $user->save();
                $generateToken = new GenerateAccessTokenService();
                $token = $generateToken->generateToken($request, $user);
                $profile = Profile::where('user_id', $user->id)->first();
                return response()->json([
                        'user'=> new ProfileResource($profile),
                        'tokenData' => $token
                ], 200);
            }
        }


    }
}
