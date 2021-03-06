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
        $imageName = null;

        if($request->hasFile('image')){
            $imageName = time().'-'.rand(1,999).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/Uploads/Artist'), $imageName);
        }

        $data = Artist::create([
            'title' => $validated['title'],
            'artist_category_id' => $validated['artist_category_id'],
            'description' => $validated['description'],
            'nationality' => $validated['nationality'],
            'image' => $imageName
        ]);

        return new ArtistResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        // $artist->load('artistCategory');
        // return $artist;
        return new ArtistResource($artist);
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
        $validated = $request->validated();
        $imageName = null;

        if($request->hasFile('image')){
            $imageName = time().'-'.rand(1,999).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/Uploads/Artist'), $imageName);
        }

        $artist->update([
            'title' => $validated['title'],
            'artist_category_id' => $validated['artist_category_id'],
            'description' => $validated['description'],
            'nationality' => $validated['nationality'],
            'image' => $imageName
        ]);
        return new ArtistResource($artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response(null, 204);
    }
}
