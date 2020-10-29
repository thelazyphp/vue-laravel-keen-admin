<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/version', function (Request $request) {
    return response()->json([
        'version' => $request->version,
    ]);
});

Route::post('/users/register', [UserController::class, 'register']);

Route::post('/token', [AuthController::class, 'token']);

Route::middleware('auth:api')->match(['get', 'post'], '/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->apiResource('users', UserController::class);
