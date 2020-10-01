<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;

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
    (new \App\Parsing\Parsers\Realt\RealtApartmentsParser())->start();
    (new \App\Parsing\Parsers\Irr\IrrApartmentsParser())->start();
    (new \App\Parsing\Parsers\Onliner\OnlinerApartmentsParser())->start();
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
});

Route::post('/users/register', [UserController::class, 'register']);
Route::match(['put', 'patch'], '/users/{user}/profile', [UserController::class, 'updateProfile']);
Route::match(['put', 'patch'], '/users/{user}/account', [UserController::class, 'updateAccount']);

Route::apiResource('ads', AdController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('images', ImageController::class)->only('store');
