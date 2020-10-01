<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only([
            'logout',
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'bail|required|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        //

        return app()->handle(
            Request::create('/oauth/token', 'POST', [
                'grant_type'    => 'password',
                'scope'         => '*',
                'username'      => $request->username,
                'password'      => $request->password,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required',
        ]);

        return app()->handle(
            Request::create('/oauth/token', 'POST', [
                'grant_type'    => 'refresh_token',
                'scope'         => '*',
                'refresh_token' => $request->refresh_token,
                'client_id'     => env('APP_CLIENT_ID'),
                'client_secret' => env('APP_CLIENT_SECRET'),
            ])
        );
    }
}
