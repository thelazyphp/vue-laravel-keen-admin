<?php

namespace App\Http\Controllers\Address\Components;

use App\Http\Controllers\Controller;
use App\Models\Address\Components\Area;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\Address\Components\Areas;
use App\Http\Filters\Address\Components\AreasFilter;
use App\Http\Resources\Address\Components\Area as AreaResource;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new Areas(
            Area::queryFilter(new AreasFilter($request))->get()
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
     * @param  \App\Models\Address\Components\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return new AreaResource($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address\Components\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address\Components\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
