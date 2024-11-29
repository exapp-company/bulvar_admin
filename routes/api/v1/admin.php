<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\CityController;
use App\Http\Controllers\API\V1\Admin\UserController;



Route::prefix('city')->group(function () {
    Route::get('', [CityController::class, 'index']);
    Route::post('', [CityController::class, 'store']);
    Route::get('{city}', [CityController::class, 'show']);
    Route::put('{city}', [CityController::class, 'update']);
    Route::delete('{city}', [CityController::class, 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::post('', [UserController::class, 'store']);
    Route::get('{user}', [UserController::class, 'show']);
    Route::put('{user}', [UserController::class, 'update']);
    Route::delete('{user}', [UserController::class, 'destroy']);
});
