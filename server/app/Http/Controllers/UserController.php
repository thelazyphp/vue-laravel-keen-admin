<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Users;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\RegisterUser;
use App\Models\Organization;
use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\UpdateUserAccount;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except([
            'register',
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
        $this->authorize('viewAny', User::class);

        $this->validate($request, [
            'query.search'          => 'nullable|string',
            'params'                => 'array',
            'sort.field'            => 'string',
            'sort.sort'             => 'string:in:asc,desc',
            'pagination.page'       => 'integer|min:1',
            'pagination.perpage'    => 'integer|min:1',
        ]);

        $query = User::query();

        if ($request->filled('query.search')) {
            $search = $request->input('query.search');

            //
        }

        foreach ($request->input('params', []) as $key => $value) {
            [$field, $op] = explode(':', $key, 2);

            //

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

        $field = $request->input('sort.field', 'first_name');
        $sort = $request->input('sort.sort', 'asc');
        $page = (int) $request->input('pagination.page', 1);
        $perpage = (int) $request->input('pagination.perpage', 10);

        $total = $query->count();
        $pages = ceil($total / $perpage);

        $users = $query->orderBy($field, $sort)
            ->skip(($page - 1) * $perpage)
            ->take($perpage)
            ->get();

        return (new Users($users))->additional([
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
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->organization()->associate(auth()->user()->organization);
        $user->save();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUser  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        return new UserResource(
            tap($user)->update($validated)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response('', 204);
    }

    /**
     * @param  \App\Http\Requests\RegisterUser  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUser $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if (!empty($validated['organization_name'])) {
            $user->organization()->associate(
                Organization::create([
                    'name' => $validated['organization_name'],
                ])
            );

            $user->save();
        }

        return new UserResource($user);
    }

    /**
     * @param  \App\Http\Requests\UpdateUserProfile  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateUserProfile $request, User $user)
    {
        $this->authorize('updateProfile', $user);

        $validated = $request->validated();

        return new UserResource(
            tap($user)->update($validated)
        );
    }

    /**
     * @param  \App\Http\Requests\UpdateUserAccount  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(UpdateUserAccount $request, User $user)
    {
        $this->authorize('updateAccount', $user);

        $validated = $request->validated();

        if (!empty($validated['new_password'])) {
            $validated['password'] = Hash::make($validated['new_password']);
        }

        return new UserResource(
            tap($user)->update($validated)
        );
    }
}
