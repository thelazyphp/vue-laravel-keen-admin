<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RefreshToken;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'logout',
        ]);
    }

    /**
     * @param  \App\Http\Requests\Login  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Login $request)
    {
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();

        //

        return app()->handle(
            Request::create('/oauth/token', 'POST', [
                'grant_type'    => 'password',
                'scope'         => '*',
                'username'      => $validated['username'],
                'password'      => $validated['password'],
                'client_id'     => env('APP_CLIENT_ID'),
                'client_secret' => env('APP_CLIENT_SECRET'),
            ])
        );
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->token()->revoke();
    }

    /**
     * @param  App\Http\Requests\RefreshToken  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(RefreshToken $request)
    {
        $validated = $request->validated();

        return app()->handle(
            Request::create('/oauth/token', 'POST', [
                'grant_type'    => 'refresh_token',
                'scope'         => '*',
                'refresh_token' => $validated['refresh_token'],
                'client_id'     => env('APP_CLIENT_ID'),
                'client_secret' => env('APP_CLIENT_SECRET'),
            ])
        );
    }
}
