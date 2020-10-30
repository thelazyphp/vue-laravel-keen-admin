<?php

use Illuminate\Support\Facades\Route;
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

Route::post('/users/register', [UserController::class, 'register']);

Route::post('/auth/token', [AuthController::class, 'token']);

Route::middleware('auth:api')->match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->match(['put', 'patch'], '/users/{user}/account', [UserController::class, 'updateAccount']);

Route::middleware('auth:api')->match(['put', 'patch'], '/users/{user}/profile', [UserController::class, 'updateProfile']);

Route::middleware('auth:api')->match(['put', 'patch'], '/users/{user}/password', [UserController::class, 'updatePassword']);

Route::middleware('auth:api')->apiResource('users', UserController::class);
