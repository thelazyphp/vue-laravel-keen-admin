<?php

namespace App\Http\Controllers\Address\Components;

use App\Http\Controllers\Controller;
use App\Models\Address\Components\Entrance;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\Address\Components\Entrances;
use App\Http\Filters\Address\Components\EntrancesFilter;
use App\Http\Resources\Address\Components\Entrance as EntranceResource;

class EntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new Entrances(
            Entrance::queryFilter(new EntrancesFilter($request))->get()
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
     * @param  \App\Models\Address\Components\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function show(Entrance $entrance)
    {
        return new EntranceResource($entrance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address\Components\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrance $entrance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address\Components\Entrance  $entrance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrance $entrance)
    {
        //
    }
}
