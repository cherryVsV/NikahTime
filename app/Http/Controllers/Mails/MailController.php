<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmedRegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendConfirmationEmail(Request $request){
        $this->validate($request,[
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],]);
        $toEmail = $request->email;
        $code = strval(mt_rand(100000, 999999));
        $details = [
            'code'=>$code,
            'title'=>'Подтверждение адреса электронной почты'
        ];
        session(['email' => $toEmail, 'code'=>$code, 'password'=>$request->password]);
        Mail::to($toEmail)->send(new ConfirmedRegisterMail($details));
        return redirect('/confirmation');

    }
    public function sendForgotPasswordEmail(Request $request){
        $this->validate($request,[
            'email' => [ 'string', 'email', 'max:255', 'exists:users']]);
        $toEmail = $request->email;
        $code = strval(mt_rand(100000, 999999));
        $details = [
            'code'=>$code,
            'title'=>'Восстановление пароля'
        ];
        session(['email' => $toEmail, 'code'=>$code]);
        Mail::to($toEmail)->send(new ConfirmedRegisterMail($details));
        return redirect('/forgot/password/confirmation');

    }
}
