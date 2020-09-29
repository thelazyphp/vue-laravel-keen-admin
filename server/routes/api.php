<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
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

Route::match(['get', 'post'], '/parsers/start', function () {
    (new \App\Parsing\Parsers\Onliner\OnlinerApartmentsParser())->start();
    (new \App\Parsing\Parsers\Realt\RealtApartmentsParser())->start();
    (new \App\Parsing\Parsers\Irr\IrrApartmentsParser())->start();
});

Route::apiResource('ads', AdController::class);

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout']);
});

Route::match(['put', 'patch'], '/users/{user}/profile', [UserController::class, 'updateProfile']);
Route::match(['put', 'patch'], '/users/{user}/account', [UserController::class, 'updateAccount']);
Route::match(['put', 'patch'], '/users/{user}/company', [UserController::class, 'updateCompany']);
Route::post('/users/register', [UserController::class, 'register']);
Route::match(['get', 'post'], '/users/{user}/activate', [UserController::class, 'activate']);
Route::match(['get', 'post'], '/users/{user}/deactivate', [UserController::class, 'deactivate']);
Route::apiResource('users', UserController::class);
