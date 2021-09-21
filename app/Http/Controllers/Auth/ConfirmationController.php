<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ConfirmationController extends Controller
{
    public function checkEmailCode(Request $request)
    {
        $this->validate($request, [
            'code' => ['required'],
        ]);
        $code = Session::pull('code');
        $email = Session::pull('email');
        $password = Session::pull('password');
        if($email!=null && $request->code==$code){
            $user =  User::create([
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            Profile::create([
                'user_id'=>$user->id
            ]);
            auth()->login($user, true);
            session(['email' => null, 'code'=>null, 'password'=>null]);
            return redirect('/home');
        }
        return Redirect::back()->withErrors(['message'=>'Код не совпадает с отправленным на вашу почту']);

    }
    public function checkForgotPasswordCode(Request $request){
        $this->validate($request, [
            'code' => ['required'],
        ]);
        $code = Session::pull('code');
        if( $request->code==$code){
            return redirect('/change/password');
        }
        return Redirect::back()->withErrors(['message'=>'Код не совпадает с отправленным на вашу почту']);
    }
}
