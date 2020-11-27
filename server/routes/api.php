<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Address\Components\CountryController;
use App\Http\Controllers\Address\Components\ProvinceController;
use App\Http\Controllers\Address\Components\AreaController;
use App\Http\Controllers\Address\Components\LocalityController;
use App\Http\Controllers\Address\Components\DistrictController;
use App\Http\Controllers\Address\Components\MetroController;
use App\Http\Controllers\Address\Components\StreetController;
use App\Http\Controllers\Address\Components\HouseController;
use App\Http\Controllers\Address\Components\EntranceController;
use App\Http\Controllers\CadastralRecordController;
use App\Http\Controllers\CadastralRecordTypeController;
use App\Http\Controllers\CadastralRecordFunctionController;

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

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout']);

    Route::apiResources([
        'countries' => CountryController::class,
        'provinces' => ProvinceController::class,
        'areas' => AreaController::class,
        'localities' => LocalityController::class,
        'districts' => DistrictController::class,
        'metros' => MetroController::class,
        'streets' => StreetController::class,
        'houses' => HouseController::class,
        'entrances' => EntranceController::class,
    ], ['only' => ['index', 'show']]);

    Route::post('/cadastral-records/upload', [CadastralRecordController::class, 'upload']);

    Route::apiResource('cadastral-records', CadastralRecordController::class);

    Route::apiResources([
        'cadastral-records/types' => CadastralRecordTypeController::class,
        'cadastral-records/functions' => CadastralRecordFunctionController::class,
    ], ['only' => ['index', 'show']]);

});
