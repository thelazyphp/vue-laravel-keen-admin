<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/users/register', [UserController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout']);

        Route::get('/users/{user}/profile', [UserController::class, 'showProfile']);

        Route::match(['put', 'patch'], '/users/{user}/profile', [UserController::class, 'updateProfile']);

        Route::get('/users/{user}/account', [UserController::class, 'showAccount']);

        Route::match(['put', 'patch'], '/users/{user}/account', [UserController::class, 'updateAccount']);

        Route::delete('/users/{user}/account', [UserController::class, 'destroyAccount']);

        Route::apiResource('users', UserController::class)->only([
            'show',
            'update',
            'destroy',
        ]);
    });
});
