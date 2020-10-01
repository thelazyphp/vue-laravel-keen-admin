<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Seller;
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
            'query.search'          => 'nullable|string',
            'params'                => 'array',
            'sort.field'            => 'string',
            'sort.sort'             => 'string:in:asc,desc',
            'pagination.page'       => 'integer|min:1',
            'pagination.perpage'    => 'integer|min:1',
        ]);

        $query = Ad::query();

        if ($request->filled('query.search')) {
            $search = $request->input('query.search');

            $query = $query->where(function ($query) use ($search) {
                $query = $query->where(
                    'full_address', 'like', '%'.$search.'%'
                );

                $query = $query->where(
                    'address_district', 'like', '%'.$search.'%'
                );

                return $query->orWhere(
                    'address_microdistrict', 'like', '%'.$search.'%'
                );
            });
        }

        foreach ($request->input('params', []) as $key => $value) {
            [$field, $op] = explode(':', $key, 2);

            if ($field == 'seller.type') {
                $query = $query->whereIn(
                    'seller_id', Seller::select('id')->where('type', $value)->get()->pluck('id')->toArray()
                );
            } else {
                switch ($op) {
                    case 'not':
                        $query = $query->where($field, '<>', $value);
                        break;
                    case 'eq':
                        $query = $query->where($field, $value);
                        break;
                    case 'lt':
                        $query = $query->where($field, '<', $value);
                        break;
                    case 'le':
                        $query = $query->where($field, '<=', $value);
                        break;
                    case 'gt':
                        $query = $query->where($field, '>', $value);
                        break;
                    case 'ge':
                        $query = $query->where($field, '>=', $value);
                        break;
                    case 'in':
                        $query = $query->whereIn($field, explode(',', $value));
                        break;
                    case 'not_in':
                        $query = $query->whereNotIn($field, explode(',', $value));
                        break;
                }
            }
        }

        $field = $request->input('sort.field', 'published_at');
        $sort = $request->input('sort.sort', 'asc');
        $page = (int) $request->input('pagination.page', 1);
        $perpage = (int) $request->input('pagination.perpage', 10);

        $total = $query->count();
        $pages = ceil($total / $perpage);

        $users = $query->orderBy($field, $sort)
            ->skip(($page - 1) * $perpage)
            ->take($perpage)
            ->get();

        return (new Ads($users))->additional([
            'meta' => [
                'field'     => $field,
                'sort'      => $sort,
                'total'     => $total,
                'pages'     => $pages,
                'page'      => $page,
                'perpage'   => $perpage,
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
