<?php

use App\Http\Controllers\API\V1\Admin\PaymentMethodController;
use App\Http\Controllers\API\V1\Admin\ProjectController;
use App\Http\Controllers\API\V1\Admin\ObjectController;
use App\Http\Controllers\API\V1\MainController;
use App\Http\Middleware\CheckRoleMiddleware;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\API\V1\ProfileController;

Route::get('initialize', [MainController::class, 'init']);
Route::get('', [MainController::class, 'index']);


//Route::prefix('profile')->middleware('auth:sanctum')->group(function () {
//    Route::get('', [ProfileController::class, 'index']);
//    Route::put('', [ProfileController::class, 'update']);
//    Route::put('change-password', [ProfileController::class, 'changePassword']);
//});


Route::prefix('projects')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [ProjectController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::get('/{project}', [ProjectController::class, 'show'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [ProjectController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{project}', [ProjectController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});


Route::prefix('objects')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ObjectController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::get('/{object}', [ObjectController::class, 'show'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [ObjectController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{object}', [ObjectController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{object}', [ObjectController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});

Route::prefix('payment-methods')->middleware('auth:sanctum')->group(function () {

    Route::get('/',[PaymentMethodController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/',[PaymentMethodController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{payment-method}', [PaymentMethodController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{payment-method}', [PaymentMethodController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});
