<?php

namespace App\Services;

use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Http;

class AuthService
{
    /**
     * Log the authenticated user out.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function logout(User $user)
    {
        return $user->token()->revoke();
    }

    /**
     * Request an auth token for the user.
     *
     * @param  string  $username
     * @param  string  $password
     * @return \Illuminate\Http\Client\Response
     */
    public function token($username, $password)
    {
        $client = Client::where('password_client', true)->first();

        return Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'scope' => '*',
            'username' => $username,
            'password' => $password,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ]);
    }
}
