<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return User::create(
            tap($validator->validate(), function (&$validated) {
                $validated['password'] = Hash::make($validated['password']);
            })
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['string', 'max:50'],
            'email' => ['email', 'max:50', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'min:8'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return tap($user)->update(
            tap($validator->validate(), function (&$validated) {
                if (isset($validated['password'])) {
                    $validated['password'] = Hash::make($validated['password']);
                }
            })
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
        $user->delete();

        return response('', 204);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return User::create(
            tap($validator->validate(), function (&$validated) {
                $validated['password'] = Hash::make($validated['password']);
            })
        );
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request, User $user)
    {
        $rules = [
            'email' => ['email', 'max:50', Rule::unique('users')->ignore($user)],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return tap($user)->update($validator->validate());
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        $rules = [
            'name' => ['string', 'max:50'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return tap($user)->update($validator->validate());
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $rules = [
            'password' => ['required', 'password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return tap($user)->update(
            tap($validator->validate(), function (&$validated) {
                $validated['password'] = Hash::make($validated['new_password']);
            })
        );
    }
}
