<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'password' => ['required', 'string', 'min:8', 'confirmed']]);
        $user = User::find(Auth::user()->getAuthIdentifier());
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/home');
        }
        return Redirect::back()->withErrors(['message'=>'Ошибка при изменении пароля! Проверьте введенные данные']);

    }
}
