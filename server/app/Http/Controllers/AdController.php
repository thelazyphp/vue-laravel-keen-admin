<?php

namespace App\Http\Controllers;

use App\Filters\AdsFilter;
use App\Http\Requests\GetCollection;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Http\Resources\Ads;
use App\Http\Resources\Ad as AdResource;

class AdController extends Controller
{
    /**
     * @var \App\Filters\AdsFilter
     */
    protected $filter;

    public function __construct(AdsFilter $filter)
    {
        $this->middleware('auth:api')->except([
            //
        ]);

        $this->filter = $filter;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\GetCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(GetCollection $request)
    {
        $validated = $request->validated();

        $query = Ad::query();

        $query = $query->filter(
            $this->filter, $request->all()
        );

        return new Ads(
            $query->paginate(
                empty($validated['per_page'])
                    ? null
                    : $validated['per_page']
            )
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
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return new AdResource($ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }
}
