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
           $password = strval(mt_rand(10000000, 99999999));
           if (!SocialAccount::where(['provider_id' => $username, 'provider' => 'google'])->exists()) {
               $user = User::create([
                   'password' => Hash::make($password)
               ]);
               Profile::create([
                   'user_id' => $user->id
               ]);
               SocialAccount::create([
                   'user_id' => $user->id,
                   'provider_id' => $username,
                   'provider' => 'google',
                   'token' => $token
               ]);
           }
           else{
               $social = SocialAccount::where(['provider_id' => $username, 'provider' => 'google'])->first();
               $social->token = $token;
               $social->save();
               $user = User::where('id', $social->user_id)->first();
               $user->password=Hash::make($password);
               $user->save();
           }
           return ['username'=>$username, 'password'=>$password, 'user'=>$user];
       }
       else{
           throw new SocialAuthError('ERR_AUTHORIZATION_FAILED', 422, 'Token incorrect');}
   }
}
