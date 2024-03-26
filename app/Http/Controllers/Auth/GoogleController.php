<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
        dd($user);
    }
}
