<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NCA\UploadController as NcaUploadController;
use App\Http\Controllers\API\NCA\RecordController as NcaRecordController;

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

    Route::post('/nca', NcaUploadController::class);

    Route::apiResource('nca/records', NcaRecordController::class);

});
