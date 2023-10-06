<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\BreedController;

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

Route::group([ 'prefix' => 'images' ], function() {
    Route::get('/', [ImageController::class, 'load']);
    // Route::delete('/{id}', [ImageController::class, 'destroy']);
});

Route::group([ 'prefix' => 'cats' ], function() {
    Route::get('/', [CatController::class, 'index']);
    Route::post('/', [CatController::class, 'store']);
    Route::patch('/{id}', [CatController::class, 'update']);
    Route::get('/{id}', [CatController::class, 'show']);
    Route::delete('/{id}', [CatController::class, 'destroy']);
});

Route::group([ 'prefix' => 'breeds' ], function() {
    Route::get('/', [BreedController::class, 'index']);
    Route::post('/', [BreedController::class, 'store']);
    Route::patch('/{id}', [BreedController::class, 'update']);
    Route::get('/{id}', [BreedController::class, 'show']);
    Route::delete('/{id}', [BreedController::class, 'destroy']);
});
