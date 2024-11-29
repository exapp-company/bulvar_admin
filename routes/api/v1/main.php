<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\MainController;
use App\Http\Controllers\API\V1\ProfileController;


Route::get('initialize', [MainController::class, 'init']);
Route::get('', [MainController::class, 'index']);


Route::prefix('profile')->middleware('auth:sanctum')->group(function () {
    Route::get('', [ProfileController::class, 'index']);
    Route::put('', [ProfileController::class, 'update']);
    Route::put('change-password', [ProfileController::class, 'changePassword']);
});
