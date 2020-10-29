<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        return $request->user()->token()->revoke()
            ? response(['status' => 'ok'])
            : response(['status' => 'failed'], 500);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function token(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        $validator->validate();

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => [
                    trans('api.errors.auth.user'),
                ],
            ]);
        }

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [
                    trans('api.errors.auth.password'),
                ],
            ]);
        }

        $client = Client::where('password_client', true)->first();

        $response = Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'scope' => '*',
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ]);

        return response(
            $response->body(),
            $response->status(),
            $response->headers()
        );
    }
}
