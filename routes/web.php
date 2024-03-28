<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Two\GoogleProvider;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');


Route::get('/logout', function () {
    App::make('auth')->logout();
    return redirect('/');
})->name('logout');

Route::get('/artists', function () {
    return view('artists.index');
})->name('artists');
