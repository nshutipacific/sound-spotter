<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::get('/albums', function (Request $request) {
    $album = $request->query('album', 'Album');
    $response = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'album.search',
        'album' => $album,
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

Route::get('/artist/info', function (Request $request) {
    $mbid = $request->query('mbid');

    $allArtistInfo = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'artist.getInfo',
        'mbid' => $mbid,
        'api_key' => env('LAST_FM_API_KEY'),
        'format' => 'json',
    ]);

    $artistTopAlbums = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'artist.getTopAlbums',
        'mbid' => $mbid,
        'api_key' => env('LAST_FM_API_KEY'),
        'limit' => '5',
        'format' => 'json',
    ]);

    $artistTopTracks = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'artist.getTopTracks',
        'mbid' => $mbid,
        'api_key' => env('LAST_FM_API_KEY'),
        'limit' => '5',
        'format' => 'json',
    ]);

    $artistSimilarArtsists = Http::get(env('LAST_FM_API_URL'), [
        'method' => 'artist.getSimilar',
        'mbid' => $mbid,
        'api_key' => env('LAST_FM_API_KEY'),
        'limit' => '5',
        'format' => 'json',
    ]);

    return  [
        'artistInfo' => $allArtistInfo->json(),
        'artistTopAlbums' => $artistTopAlbums->json(),
        'artistTopTracks' => $artistTopTracks->json(),
        'artistSimilarArtsists' => $artistSimilarArtsists->json(),
    ];
});