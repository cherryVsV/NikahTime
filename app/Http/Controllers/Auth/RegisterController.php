<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmMail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'code' => ['required'],
        ];
        $code = session('code');
        $email = session('email');
        $password = session('password');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        if ($email != null && $request->code == $code) {
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);

            $token = $user->createToken('NikahTime Personal Access Client')->accessToken;
            Auth::login($user);
            return response()->json(['token' => $token], 200);
        }
        else {
            return response()->json(['error' => 'Введенный код не совпадает с отправленным на вашу почту '.$email], 500);
        }

    }

    public function sendConfirmEmail(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $toEmail = $request->email;
            $code = strval(mt_rand(100000, 999999));
            $details = [
                'code' => $code,
            ];
            session(['email' => $toEmail, 'code' => $code, 'password' => $request->password]);
            $email = session('email');
            Mail::to($toEmail)->send(new ConfirmMail($details));
            return response()->json(['success' => 'Письмо подтверждения отправлено на почту '.$email ], 200);

        }
    }

}
