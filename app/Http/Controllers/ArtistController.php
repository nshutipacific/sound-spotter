<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function allArtists()
    {
        return view('artists.all');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $artists = Artist::where('saved_by_user', $userId)->get();

        return view('artists.index', ['artists' => $artists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'mbid' => 'required',
            'name' => 'required',
            'image' => 'required',
            'listeners' => 'required',
        ]);

        if (auth()->check()) {
            $userId = auth()->id();

            $existingArtist = Artist::where('mbid', $validatedData['mbid'])
                ->where('saved_by_user', $userId)
                ->first();

            if ($existingArtist) {
                return response()->json(['message' => 'Artist is Already saved'], 200);
            }

            $artist = new Artist();
            $artist->mbid = $validatedData['mbid'];
            $artist->name = $validatedData['name'];
            $artist->image = $validatedData['image'];
            $artist->listeners = $validatedData['listeners'];
            $artist->saved_by_user = $userId;
            $artist->save();

            return response()->json(['message' => 'Artist added to your favorites'], 200);
        } else {
            return response()->json(['message' => 'Please login to save artists'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
