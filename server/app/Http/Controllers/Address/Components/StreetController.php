<?php

namespace App\Http\Controllers\Address\Components;

use App\Http\Controllers\Controller;
use App\Models\Address\Components\Street;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\Address\Components\Streets;
use App\Http\Filters\Address\Components\StreetsFilter;
use App\Http\Resources\Address\Components\Street as StreetResource;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new Streets(
            Street::queryFilter(new StreetsFilter($request))->get()
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
     * @param  \App\Models\Address\Components\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        return new StreetResource($street);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address\Components\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Street $street)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address\Components\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        //
    }
}
