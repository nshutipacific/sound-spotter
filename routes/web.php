<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Two\GoogleProvider;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
