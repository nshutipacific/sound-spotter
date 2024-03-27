<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::get('/albums', function () {
    // Make the HTTP request to the API
    $response = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'album.search',
        'album' => 'Album',
        'api_key' => env('LAST_FM_API_KEY'),
        'format' => 'json',
    ]);

    // Process the response...
    return $response->json(); // Returning the JSON response directly
});