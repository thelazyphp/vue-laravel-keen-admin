<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UsersService;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\RegisterUser;
use App\Http\Resources\UserProfile;
use App\Http\Resources\UserAccount;
use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\UpdateUserAccount;

class UserController extends Controller
{
    /**
     * The users service instance.
     *
     * @var \App\Services\UsersService
     */
    protected $usersService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\UsersService  $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $payload = $request->validated();

        return new UserResource(
            $this->usersService->update($user, $payload)
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

        return $this->usersService->delete($user) === false
            ? response('', 500)
            : response('', 204);
    }

    /**
     * Register a new user.
     *
     * @param  \App\Http\Requests\RegisterUser  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUser $request)
    {
        $payload = $request->validated();

        return new UserResource(
            $this->usersService->register($payload)
        );
    }

    /**
     * Display the specified resource profile.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showProfile(User $user)
    {
        $this->authorize('viewProfile', $user);

        return new UserProfile($user);
    }

    /**
     * Display the specified resource account.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showAccount(User $user)
    {
        $this->authorize('viewAccount', $user);

        return new UserAccount($user);
    }

    /**
     * Update the specified resource profile in storage.
     *
     * @param  \App\Http\Requests\UpdateUserProfile  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateUserProfile $request, User $user)
    {
        $this->authorize('updateProfile', $user);

        $payload = $request->validated();

        return new UserProfile(
            $this->usersService->updateProfile($user, $payload)
        );
    }

    /**
     * Update the specified resource account in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAccount  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(UpdateUserAccount $request, User $user)
    {
        $this->authorize('updateAccount', $user);

        $payload = $request->validated();

        return new UserAccount(
            $this->usersService->updateAccount($user, $payload)
        );
    }

    /**
     * Remove the specified resource account from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroyAccount(User $user)
    {
        $this->authorize('deleteAccount', $user);

        return $this->usersService->deleteAccount($user) === false
            ? response('', 500)
            : response('', 204);
    }
}
