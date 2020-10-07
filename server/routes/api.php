<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('users')->group(function () {
    Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
    Route::match(['put', 'patch'], '/{user}/profile', [\App\Http\Controllers\UserController::class, 'updateProfile']);
    Route::match(['put', 'patch'], '/{user}/account', [\App\Http\Controllers\UserController::class, 'updateAccount']);
    Route::match(['put', 'patch'], '/{user}/company', [\App\Http\Controllers\UserController::class, 'updateCompany']);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::match(['get', 'post'], '/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::apiResource('ads', \App\Http\Controllers\AdController::class);
Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::apiResource('images', \App\Http\Controllers\ImageController::class)->only('store');
