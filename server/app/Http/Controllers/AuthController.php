<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Request auth token for the user.
     *
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
            $request->all(), $rules, trans('api.validation')
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => trans('api.errors.validation'),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response()->json([
                'errors' => [
                    'email' => [
                        trans('api.errors.token.user'),
                    ],
                ],

                'message' => trans('api.errors.validation'),
            ], 422);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => [
                        trans('api.errors.token.password'),
                    ],
                ],

                'message' => trans('api.errors.validation'),
            ], 422);
        }

        $response = Http::post(config('app.url').'/oauth/token', [
            'grant_type' => 'password',
            'scope' => '*',
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
        ]);

        return response(
            $response->body(), $response->status(), $response->headers()
        );
    }
}
