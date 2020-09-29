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
use App\Models\Company;
use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\UpdateUserAccount;
use App\Http\Requests\UpdateUserCompany;

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
            'query.search' => 'nullable|string',
            'params' => 'array',
            'sort.field' => 'string',
            'sort.sort' => 'string:in:asc,desc',
            'pagination.page' => 'integer|min:1',
            'pagination.perpage' => 'integer|min:1',
        ]);

        $query = User::query();

        if ($request->filled('query.search')) {
            $search = $request->input('query.search');

            $query = $query->where(function ($query) use ($search) {
                $query = $query->where(
                    'first_name', 'like', '%'.$search.'%'
                );

                return $query->orWhere(
                    'last_name', 'like', '%'.$search.'%'
                );
            });
        }

        foreach ($request->input('params', []) as $key => $value) {
            [$field, $op] = explode(':', $key, 2);

            switch ($op) {
                case 'eq':
                    $query = $query->where($field, $value);
                    break;
                case 'lt':
                    $query = $query->where($field, '<', $value);
                    break;
                case 'le':
                    $query = $query->where($field, '<', $value);
                    break;
                case 'gt':
                    $query = $query->where($field, '>', $value);
                    break;
                case 'ge':
                    $query = $query->where($field, '>', $value);
                    break;
                case 'in':
                    $query = $query->whereIn($field, explode(',', $value));
                    break;
            }
        }

        $field = $request->input('sort.field', 'id');
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
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->company()->associate(auth()->user()->company);
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

        if (!empty($validated['company_name'])) {
            $user->company()->associate(
                Company::create([
                    'name' => $validated['company_name'],
                ])
            );

            $user->save();
        }

        return new UserResource($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, User $user)
    {
        $this->authorize('activate', $user);
        $user->activate();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, User $user)
    {
        $this->authorize('deactivate', $user);
        $user->deactivate();
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

    /**
     * @param  \App\Http\Requests\UpdateUserCompany  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateCompany(UpdateUserCompany $request, User $user)
    {
        $this->authorize('updateCompany', $user);

        $validated = $request->validated();

        if (empty($user->company) && !empty($validated['name'])) {
            $user->company()->associate(
                Company::create($validated)
            );

            $user->save();
        } else {
            $user->company()->update($validated);
        }

        return new UserResource($user);
    }
}
