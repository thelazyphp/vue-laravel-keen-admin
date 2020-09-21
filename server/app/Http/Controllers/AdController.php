<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Http\Resources\Ads;
use App\Http\Resources\Ad as AdResource;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except([
            //
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'sort.field' => 'string',
            'sort.sort' => 'string:in:asc,desc',
            'pagination.page' => 'integer|min:1',
            'pagination.perpage' => 'integer|min:1',
        ]);

        $field = $request->input('sort.field', 'id');
        $sort = $request->input('sort.sort', 'asc');
        $page = $request->input('pagination.page', 1);
        $perpage = $request->input('pagination.perpage', 10);

        $query = Ad::query();

        $total = $query->count();

        $pages = ceil($total / $perpage);

        $users = $query->orderBy($field, $sort)
            ->skip(($page - 1) * $perpage)
            ->take($perpage)
            ->get();

        return (new Ads($users))->additional([
            'meta' => [
                'field' => $field,
                'sort' => $sort,
                'total' => $total,
                'pages' => $pages,
                'page' => $page,
                'perpage' => $perpage,
            ]
        ]);
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
