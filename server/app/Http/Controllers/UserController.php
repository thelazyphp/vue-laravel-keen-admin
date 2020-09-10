<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Resources\User as UserResource;

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
        $this->validate($request, [
            'image_id' => 'nullable|integer|exists:images,id',

            'role' => [
                'required',
                'string',
                Rule::in(User::roles()),
            ],

            'f_name' => 'string|max:191',
            'm_name' => 'nullable|string|max:191',
            'l_name' => 'string|max:191',
            'email' => 'required|string|max:191|email|unique:users',
            'phone' => 'nullable|string|max:191|regex:/\+\d{1,3}\d{1,12}/',
            'about' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($request->only([
            'image_id',
            'role',
            'f_name',
            'm_name',
            'l_name',
            'email',
            'phone',
            'about',
            'password',
        ]));

        $user->company()->associate(auth()->user()->company);
        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
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
        $this->validate($request, [
            'image_id' => 'nullable|integer|exists:images,id',

            'role' => [
                'string',
                Rule::in(User::roles()),
            ],

            'f_name' => 'max:191',
            'm_name' => 'nullable|string|max:191',
            'l_name' => 'max:191',
            'email' => 'string|max:191|email|unique:users',
            'phone' => 'nullable|string|max:191|regex:/\+\d{1,3}\d{1,12}/',
            'about' => 'nullable|string',
            'password' => 'string|min:8|confirmed',
        ]);

        if ($request->has('password')) {
            $request->password = Hash::make($request->passwrod);
        }

        return tap($user)->update($request->only([
            'image_id',
            'role',
            'f_name',
            'm_name',
            'l_name',
            'email',
            'phone',
            'about',
            'password',
        ]));
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
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'nullable|string|max:191|unique:companies,name',
            'f_name'       => 'required|string|max:191',
            'm_name'       => 'nullable|string|max:191',
            'l_name'       => 'required|string|max:191',
            'email'        => 'required|string|max:191|email|unique:users',
            'password'     => 'required|string|min:8|confirmed',
        ]);

        $attributes = $request->all();
        $attributes['password'] = Hash::make($request->password);
        $user = User::create($attributes);

        if ($request->filled('company_name')) {
            $company = Company::create([
                'name' => $request->company_name,
            ]);

            $user->company()->associate($company);
            $user->save();
        }

        return $user;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => [
                'string', 'max:191', 'email', Rule::unique('users')->ignore($user),
            ],

            'cur_password' => 'required_with:new_password|password',
            'new_password' => 'string|min:8|confirmed',
        ]);

        $user = tap($user)->update($request->only('email'));

        if ($request->has('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return $user;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        $this->validate($request, [
            'image_id' => 'nullable|integer|exists:images,id',
            'f_name' => 'string|max:191',
            'm_name' => 'nullable|string|max:191',
            'l_name' => 'string|max:191',
            'phone' => 'nullable|string|max:191|regex:/\+\d{1,3}\d{1,12}/',
            'about' => 'nullable|string',
        ]);

        return tap($user)->update($request->only([
            'image_id',
            'f_name',
            'm_name',
            'l_name',
            'phone',
            'about',
        ]));
    }
}
