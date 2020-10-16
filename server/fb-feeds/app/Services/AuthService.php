<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthService
{
    /**
     * The Password Grant Client ID.
     *
     * @var int|string
     */
    private $clientId;

    /**
     * The Password Grant Client secret.
     *
     * @var string
     */
    private $clientSecret;

    /**
     * Create a new auth service instance.
     *
     * @param  int|string  $clientId
     * @param  string  $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Log the user out.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function logout(User $user)
    {
        return $user->token()->revoke();
    }

    /**
     * Log the user in.
     *
     * @param  array  $payload
     * @return \Illuminate\Http\Client\Response
     */
    public function login($payload)
    {
        return Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'scope' => '*',
            'username' => $payload['username'],
            'password' => $payload['password'],
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);
    }
}
