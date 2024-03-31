<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artists.index');
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
        $validatedData = $request->validate([
            'mbid' => 'required',
            'name' => 'required',
            'image' => 'required',
            'listeners' => 'required',
        ]);

        $artist = new Artist();
        
        $artist->mbid = $validatedData['mbid'];
        $artist->name = $validatedData['name'];
        $artist->image = $validatedData['image'];
        $artist->listeners = $validatedData['listeners'];
        $artist->saved_by_user = auth()->id();

        $artist->save();

        return response()->json(['message' => 'Artist Added to your Favourites'], 200);
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
