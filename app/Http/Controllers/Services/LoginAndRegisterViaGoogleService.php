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
           $username = $googleAuthService->getSub();
           $email = $googleAuthService->getEmail();
           $password = strval(mt_rand(10000000, 99999999));
           if (is_null($email)|| !User::where('email', $email)->exists()) {
               $user = User::create([
                   'email' => $email,
                   'password' => Hash::make($password)
               ]);
               Profile::create([
                   'user_id' => $user->id
               ]);

           }else{
               $user = User::where('email', $email)->first();
               $user->password=Hash::make($password);
               $user->save();
           }
           if (!SocialAccount::where(['provider_id' => $username, 'provider' => 'google'])->exists()) {
               SocialAccount::create([
                   'user_id' => $user->id,
                   'provider_id' => $username,
                   'provider' => 'google',
                   'token' => $token
               ]);
           }
           return ['username'=>$username, 'password'=>$password, 'user'=>$user];
       }
       else{
           throw new SocialAuthError('ERR_AUTHORIZATION_FAILED', 422, 'Token incorrect');}
   }
}
