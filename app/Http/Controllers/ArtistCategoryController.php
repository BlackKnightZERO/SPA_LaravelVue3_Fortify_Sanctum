<?php

namespace App\Http\Controllers;

use App\Models\ArtistCategory;
use App\Http\Requests\StoreArtistCategoryRequest;
use App\Http\Requests\UpdateArtistCategoryRequest;

class ArtistCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArtistCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtistCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArtistCategory  $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArtistCategory $artistCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArtistCategory  $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ArtistCategory $artistCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArtistCategoryRequest  $request
     * @param  \App\Models\ArtistCategory  $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistCategoryRequest $request, ArtistCategory $artistCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArtistCategory  $artistCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtistCategory $artistCategory)
    {
        //
    }
}
