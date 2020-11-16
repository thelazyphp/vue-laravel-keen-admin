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
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()
            ->token()
            ->revoke();
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
            trans('api.errors.validation'),
        );

        $validated = $validator->validate();

        $user = User::where(
            'email', $validated['email']
        )->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => [
                    trans('api.errors.auth.user'),
                ],
            ]);
        }

        if (! Hash::check($user->password, $validated['password'])) {
            throw ValidationException::withMessages([
                'password' => [
                    trans('api.errors.auth.password'),
                ],
            ]);
        }

        $client = Client::where('password_client', true)->first();

        if (! $client) {
            return response('', 500);
        }

        return Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'scope' => '*',
            'username' => $validated['email'],
            'password' => $validated['password'],
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ]);
    }
}
