<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function allAlbums()
    {
        return view('albums.all');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $albums = Album::where('saved_by_user', $userId)->get();

        return view('albums.index', compact('albums'));
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
        $validetedData = $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'image' => 'required',
        ]);

        if (auth()->check()) {
            $userId = auth()->id();

            $existingAlbum = Album::where('name', $validetedData['name'])
                ->where('artist', $validetedData['artist'])
                ->where('saved_by_user', $userId)
                ->first();

            if ($existingAlbum) {
                return response()->json(['message' => 'Album is already saved'], 200);
            }

            $album = new Album();
            $album->name = $validetedData['name'];
            $album->artist = $validetedData['artist'];
            $album->image = $validetedData['image'];
            $album->saved_by_user = $userId;
            $album->save();

            return response()->json(['message' => 'Album added to your favorites'], 200);
        } else {
            return response()->json(['message' => 'Please login to save albums'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $albumName)
    {
        $userId = auth()->id();
        $album = Album::where('name', $albumName)->where('saved_by_user', $userId)->first();

        return view('albums.show', compact('album'));
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
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'image' => 'required',
        ]);

        $album = Album::find($request->id);
        
        $album->name = $validatedData['name'];
        $album->artist = $validatedData['artist'];
        $album->image = $validatedData['image'];

        if($album->update()){
            return response()->json(['message' => 'Album updated Successfully'], 200);
        }else{
            return response()->json(['message' => 'Album Not updated'], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();
        $album = Album::where('id', $id)->where('saved_by_user', $userId)->first();

        if ($album) {
            $album->delete();
            return response()->json(['message' => 'Album deleted Successfully'], 200);
        } else {
            return response()->json(['message' => 'Album Not deleted'], 200);
        }
    }
}
