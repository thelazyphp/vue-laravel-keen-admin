<?php

namespace App\Http\Controllers;

use App\Filters\UsersFilter;
use App\Http\Requests\GetCollection;
use App\Models\User;
use App\Http\Resources\Users;
use App\Http\Requests\StoreUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\RegisterUser;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\UpdateUserAccount;
use App\Http\Requests\UpdateUserCompany;

class UserController extends Controller
{
    /**
     * @var \App\Filters\UsersFilter
     */
    protected $filter;

    /**
     * @param  \App\Filters\UsersFilter  $filter
     */
    public function __construct(UsersFilter $filter)
    {
        $this->middleware('auth:api')->except([
            'register',
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
        $this->authorize('viewAny', User::class);

        $validated = $request->validated();

        $query = auth()->user()->company->users();

        return new Users(
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

        $employee = Role::where('name', 'employee')->first();
        $user->role()->associate($employee);

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

        $admin = Role::where('name', 'admin')->first();
        $user->role()->associate($admin);

        if (!empty($validated['company_name'])) {
            $user->company()->associate(
                Company::create([
                    'name' => $validated['company_name'],
                ])
            );
        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, User $user)
    {
        $this->authorize('updateRole', $user);

        $this->validate($request, [
            'name' => 'required|string|in:admin,manager,employee',
        ]);

        $role = Role::where('name', $request->name)->first();

        $user->role()->associate($role);
        $user->save();

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

    /**
     * @param  \App\Http\Requests\UpdateUserCompany  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateCompany(UpdateUserCompany $request, User $user)
    {
        $this->authorize('updateCompany', $user);

        $validated = $request->validated();

        //

        return new UserResource($user);
    }
}
