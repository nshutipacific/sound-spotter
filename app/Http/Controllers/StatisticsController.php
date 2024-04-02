<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalArtists = Artist::where('saved_by_user', $user->id)->count();
        $totalAlbums = Album::where('saved_by_user', $user->id)->count();

        return response()->json([
            'total_artists' => $totalArtists,
            'total_albums' => $totalAlbums,
        ]);
    }
}
