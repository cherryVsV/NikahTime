<?php


namespace App\Http\Controllers\Services;


use App\Exceptions\ProjectExceptions\SocialAuthError;
use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginAndRegisterViaGoogleService
{
   public function authViaGoogle($token){
       $googleAuthService = new GoogleAuthService();
       $googleAuthService->setToken($token);
       $jwt = $googleAuthService->decode();
       if($jwt) {
           $sub = $googleAuthService->getSub();
           $email = $googleAuthService->getEmail();
           if (is_null($email)|| !User::where('email', $email)->exists()) {
               $user = User::create([
                   'email' => $email,
                   'password' => Hash::make(strval(mt_rand(10000000, 99999999)))
               ]);
               Profile::create([
                   'user_id' => $user->id
               ]);

           }else{
               $user = User::where('email', $email)->first();
           }
           if (!SocialAccount::where(['provider_id' => $sub, 'provider' => 'google'])->exists()) {
               SocialAccount::create([
                   'user_id' => $user->id,
                   'provider_id' => $sub,
                   'provider' => 'google',
                   'token' => $token
               ]);
           }
           return $user;
       }
           throw new SocialAuthError('Unprocessible entity', 422, 'Token incorrect');
   }
}
