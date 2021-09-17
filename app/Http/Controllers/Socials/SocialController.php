<?php

namespace App\Http\Controllers\Socials;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = $this->findOrCreateUser($provider, $socialiteUser);

        auth()->login($user, true);

        return redirect('/home');
    }

    public function findOrCreateUser($provider, $socialiteUser)
    {
        if ($user = $this->findUserByEmail($provider, $socialiteUser->getEmail())) {

            return $user;
        }
        $user = User::create([
            'email' => $socialiteUser->getEmail(),
            'password' => Hash::make(Str::random(8)),
        ]);

        return $user;
    }

    public function findUserByEmail($provider, $email)
    {
        return !$email ? null : User::where('email', $email)->first();
    }

}
