<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->emailOrPhone)
            ->orWhere('phone', $request->emailOrPhone)
            ->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $tokenResult = $user->createToken('NikahTime Personal Access Client');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'user'=>Auth::user()
                ]);

            } else {
                $response = ['Password incorrect'];
                return response($response, 422);
            }
        }else {
            $response = ['User doesn\'t exist'];
            return response($response, 422);
        }
    }

    public function logOut()
    {
        if (Auth::user()) {
            Auth::user()->authAccessToken()->delete();
            return response()->json(['success' => 'Успешный выход из аккаунта'], 200);
        }
        return response()->json(['error' => 'Неавторизованный пользователь'], 422);
    }
}
