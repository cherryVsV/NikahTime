<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmedRegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request){
        $this->validate($request,[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);
        $toEmail = $request->email;
        $code = strval(mt_rand(100000, 999999));
        $details = [
            'code'=>$code
        ];
        session(['email' => $toEmail, 'code'=>$code]);
        Mail::to($toEmail)->send(new ConfirmedRegisterMail($details));
        return redirect('/confirmation');

    }
}
