<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\UserPermissions;

class AuthController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];

        $validated = $this->validate(
            $request,
            $rules,
            trans('api.errors.validation')
        );

        $user = User::where('email', $validated['username'])
            ->orWhere('username', $validated['username'])
            ->first();

        if (
            ! $user
            || ! Hash::check($validated['password'], $user->password)
        ) {
            return response()->json([
                'message' => trans('api.errors.login'),
            ], 401);
        }

        $token = $user->createToken(config('app.name'));

        return response()->json([
            'user' => $user,
            'token' => $token->accessToken,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()
            ->token()
            ->revoke();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $rules = [
            'companyName' => ['nullable', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:25'],
            'lastName' => ['nullable', 'string', 'max:25'],
            'email' => ['nullable', 'email', 'max:50', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'passwordConf' => ['required', 'string', 'same:password'],
        ];

        $validated = $this->validate(
            $request,
            $rules,
            trans('api.errors.validation')
        );

        $user = User::create([
            'name' => $validated['name'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        $company = new Company([
            'name' => $validated['companyName'],
        ]);

        $company->owner()->associate($user);

        $company->save();

        $user->company()->associate($company);

        $permissions = new UserPermissions([
            'create_users' => true,
            'update_users' => true,
            'delete_users' => true,
        ]);

        $user->permissions()->save($permissions);

        $user->save();

        return $user;
    }
}
