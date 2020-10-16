<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\Login;

class AuthController extends Controller
{
    /**
     * The auth service instance.
     *
     * @var \App\Services\AuthService
     */
    protected $authService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\AuthService  $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->authService->logout(auth()->user())
            ? response()
            : response('', 500);
    }

    /**
     * Log the user in.
     *
     * @param  \App\Http\Requests\Login  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Login $request)
    {
        $payload = $request->validated();

        $response = $this->authService->login($payload);

        return response(
            $response->body(), $response->status(), $response->headers()
        );
    }
}
