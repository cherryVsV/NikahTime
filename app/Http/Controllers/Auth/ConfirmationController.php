<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ConfirmationController extends Controller
{
    public function checkCode(Request $request)
    {
        $this->validate($request, [
            'code' => ['required'],
        ]);
        $code = session('code');
        $email = session('email');
        if($email!=null && $request->code==$code){
            $password = Hash::make(Str::random(8));
            $user = User::create([
                'email'=>$email,
                'password'=>$password,
            ]);
            auth()->login($user, true);
            return redirect('/home');
        }
        return Redirect::back()->withErrors(['message'=>'Код не совпадает с отправленным на вашу почту']);

    }
}
