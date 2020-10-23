<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::prefix('{version}')->group(function () {
    Route::post('/auth/token', [AuthController::class, 'token']);

    //

    Route::middleware('auth:api')->group(function () {
        Route::match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout']);

        //
    });
});
