<?php

namespace App\Http\Controllers;

use App\Filters\AdsFilter;
use App\Filters\UsersFilter;
use App\Http\Requests\GetDatatableCollection;
use App\Models\Ad;
use App\Http\Resources\Datatable\Ads;
use App\Models\User;
use App\Http\Resources\Datatable\Users;

class DatatableController extends Controller
{
    /**
     * @var \App\Filters\AdsFilter
     */
    protected $adsFilter;

    /**
     * @var \App\Filters\UsersFilter
     */
    protected $usersFilter;

    /**
     * @param  \App\Filters\AdsFilter  $adsFilter
     * @param  \App\Filters\UsersFilter  $usersFilter
     */
    public function __construct(AdsFilter $adsFilter, UsersFilter $usersFilter)
    {
        $this->middleware('auth:api')->except([
            //
        ]);

        $this->adsFilter = $adsFilter;
        $this->usersFilter = $usersFilter;
    }

    /**
     * @param  \App\Http\Requests\GetDatatableCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function getAds(GetDatatableCollection $request)
    {
        $validated = $request->validated();

        $sort = 'desc';
        $field = 'published_at';
        $page = 1;
        $perpage = 10;

        if (isset($validated['sort']['sort'])) {
            $sort = $validated['sort']['sort'];
        }

        if (isset($validated['sort']['field'])) {
            $field = $validated['sort']['field'];
        }

        if (isset($validated['pagination']['page'])) {
            $page = $validated['pagination']['page'];
        }

        if (isset($validated['pagination']['perpage'])) {
            $perpage = $validated['pagination']['perpage'];
        }

        $params = [
            'sort' => $sort == 'asc'
                ? $field
                : '-'.$field,
        ];

        foreach ($request->input('query', []) as $key => $value) {
            if (strpos($key, ':') === false) {
                $params[$key] = $value;
            } else {
                [$key, $op] = explode(':', $key, 2);
                $params[$key] = $op.$value;
            }
        }

        $query = Ad::query();

        $query = $query->filter(
            $this->adsFilter, $params
        );

        $total = $query->count();
        $pages = ceil($total / $perpage);

        $ads = $query->skip(($page - 1) * $perpage)->take($perpage)->get();

        return (new Ads($ads))->additional([
            'meta' => [
                'sort'    => $sort,
                'field'   => $field,
                'total'   => $total,
                'pages'   => $pages,
                'page'    => $page,
                'perpage' => $perpage,
            ]
        ]);
    }

    /**
     * @param  \App\Http\Requests\GetDatatableCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers(GetDatatableCollection $request)
    {
        $this->authorize('viewAny', User::class);

        $validated = $request->validated();

        $sort = 'asc';
        $field = 'first_name';
        $page = 1;
        $perpage = 10;

        if (isset($validated['sort']['sort'])) {
            $sort = $validated['sort']['sort'];
        }

        if (isset($validated['sort']['field'])) {
            $field = $validated['sort']['field'];
        }

        if (isset($validated['pagination']['page'])) {
            $page = $validated['pagination']['page'];
        }

        if (isset($validated['pagination']['perpage'])) {
            $perpage = $validated['pagination']['perpage'];
        }

        $params = [
            'sort' => $sort == 'asc'
                ? $field
                : '-'.$field,
        ];

        foreach ($request->input('query', []) as $key => $value) {
            if (strpos($key, ':') === false) {
                $params[$key] = $value;
            } else {
                [$key, $op] = explode(':', $key, 2);
                $params[$key] = $op.$value;
            }
        }

        $query = auth()->user()->company->users();

        $query = $query->filter(
            $this->usersFilter, $params
        );

        $total = $query->count();
        $pages = ceil($total / $perpage);

        $users = $query->skip(($page - 1) * $perpage)->take($perpage)->get();

        return (new Users($users))->additional([
            'meta' => [
                'sort'    => $sort,
                'field'   => $field,
                'total'   => $total,
                'pages'   => $pages,
                'page'    => $page,
                'perpage' => $perpage,
            ]
        ]);
    }
}
