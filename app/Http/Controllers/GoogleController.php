<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find user by Google ID or email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(16)), // random secure password
            ]);
            Auth::login($user);
        }

        return redirect()->route('index')->with('success', 'Welcome ' . $user->name);
    }
}
