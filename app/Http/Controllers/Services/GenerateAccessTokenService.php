<?php


namespace App\Http\Controllers\Services;


use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GenerateAccessTokenService
{
    public function generateToken(Request $request, User $user){
        Auth::login($user);
        $date = new DateTime();
        $tokenResult = $user->createToken('NikahTime Personal Access Client');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return [
            'accessToken' => $tokenResult->accessToken,
            'expiresIn' => $date->getTimestamp(),
            'refreshToken' => $token->revoked
        ];
    }
}
