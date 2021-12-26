<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    function GoogleRegister()
    {
        return Socialite::driver('google')->redirect();
    }
    function GoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    function GoogleCallbackUrlRegister()
    {
        $user = Socialite::driver('google')->user();

        $users =   User::where('email', $user->getEmail())->first();
        if ($users == '') {
            $user = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt($user->getEmail() . now()),
            ]);
            $user->assignrole('Customer');
            Auth::login($user);
            return redirect('/');
        } else {
            Auth::login($users);
            return redirect('/');
        }
    }
}
