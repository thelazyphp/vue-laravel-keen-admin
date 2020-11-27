<?php

namespace App\Http\Controllers\Address\Components;

use App\Http\Controllers\Controller;
use App\Models\Address\Components\Locality;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\Address\Components\Localities;
use App\Http\Filters\Address\Components\LocalitiesFilter;
use App\Http\Resources\Address\Components\Locality as LocalityResource;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new Localities(
            Locality::queryFilter(new LocalitiesFilter($request))->get()
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
     * @param  \App\Models\Address\Components\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function show(Locality $locality)
    {
        return new LocalityResource($locality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address\Components\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locality $locality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address\Components\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locality $locality)
    {
        //
    }
}
