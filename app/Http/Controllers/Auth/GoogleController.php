<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    //work on redirectToGoogle
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //work on handleGoogleCallback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            // Log in the existing user.
            auth()->login($existingUser, true);
        } else {
            // Create a new user.
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->password = bcrypt(request(Str::random())); // Set some random password
            $newUser->save();

            // Log in the new user.
            auth()->login($newUser, true);
        }

        // Redirect to url as requested by user, if empty use /dashboard page as generated by Jetstream
        return redirect()->intended('/dashboard');
    }
}