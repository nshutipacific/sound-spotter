<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::get('/albums', function () {
    $response = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'album.search',
        'album' => 'Album',
        'api_key' => env('LAST_FM_API_KEY'),
        'format' => 'json',
    ]);
    return $response->json();
});

Route::get('/artists', function (Request $request) {
    $artist = $request->query('artist', 'A'); 
    $response = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'artist.search',
        'artist' => $artist,
        'api_key' => env('LAST_FM_API_KEY'),
        'format' => 'json',
    ]);
    return $response->json();
});