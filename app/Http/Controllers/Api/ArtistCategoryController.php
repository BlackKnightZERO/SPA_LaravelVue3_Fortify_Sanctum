<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtistCategory;
use App\Http\Requests\ArtistCategoryRequest;
use App\Http\Resources\ArtistCategoryResource;

class ArtistCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArtistCategoryResource::collection( ArtistCategory::all() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArtistCategory $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArtistCategory $artistCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArtistCategory  $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistCategoryRequest $request, ArtistCategory $artistCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtistCategory $artistCategory)
    {
        //
    }
}
