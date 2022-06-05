<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Resources\ArtistResource;
use App\Http\Requests\ArtistRequest;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArtistResource::collection( Artist::with('artistCategory')->latest('id')->paginate(10) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {
        $validated = $request->validated();
        $path = null;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads/artist', $file_name, 'public');
        }

        return Artist::create([
            'title' => $validated['title'],
            'artist_category_id' => $validated['artist_category_id'],
            'description' => $validated['description'],
            'nationality' => $validated['nationality'],
            'image' => $path
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        return $artist->delete();
    }
}
