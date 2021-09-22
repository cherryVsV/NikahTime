<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function sendForgotPasswordEmail(Request $request)
    {
        $rules = [
            'email' => ['string', 'email', 'max:255', 'exists:users']
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
            session(['email' => $toEmail, 'code' => $code]);
            Mail::to($toEmail)->send(new ConfirmMail($details));
            return response()->json(['success' => 'Письмо подтверждения отправлено на почту ' . $toEmail], 200);
        }

    }
    public function checkForgotPasswordCode(Request $request){
        $this->validate($request, [
            'code' => ['required'],
        ]);
        $code = session('code');
        if( $request->code==$code){
            return response()->json(['success' => 'Почта подтверждена'], 200);
        }
        return response()->json(['error'=>'Код не совпадает с отправленным на вашу почту']);
    }
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'password' => ['required', 'string', 'min:8', 'confirmed']]);
        $email = session('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['success' => 'Пароль успешно изменен'], 200);
            }
            return response()->json(['error' => 'Ошибка при изменении пароля! Проверьте введенные данные']);


    }
}
