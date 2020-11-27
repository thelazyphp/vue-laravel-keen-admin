<?php

namespace App\Http\Controllers\Address\Components;

use App\Http\Controllers\Controller;
use App\Models\Address\Components\Metro;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\Address\Components\Metros;
use App\Http\Filters\Address\Components\MetrosFilter;
use App\Http\Resources\Address\Components\Metro as MetroResource;

class MetroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new Metros(
            Metro::queryFilter(new MetrosFilter($request))->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address\Components\Metro  $metro
     * @return \Illuminate\Http\Response
     */
    public function show(Metro $metro)
    {
        return new MetroResource($metro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address\Components\Metro  $metro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metro $metro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address\Components\Metro  $metro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metro $metro)
    {
        //
    }
}
