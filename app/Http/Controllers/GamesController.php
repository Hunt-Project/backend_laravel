<?php

namespace App\Http\Controllers;

use App\Models\games;
use App\Http\Requests\StoregamesRequest;
use App\Http\Requests\UpdategamesRequest;

class GamesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoregamesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregamesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(games $games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategamesRequest  $request
     * @param  \App\Models\games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategamesRequest $request, games $games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(games $games)
    {
        //
    }
}
