<?php

use App\Http\Controllers\API\V1\Admin\PaymentMethodController;
use App\Http\Controllers\API\V1\Admin\ProjectController;
use App\Http\Controllers\API\V1\Admin\ObjectController;
use App\Http\Controllers\API\V1\MainController;
use App\Http\Middleware\CheckRoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Admin\ProgramController;
use App\Http\Controllers\API\V1\Admin\FaqController;
use App\Http\Controllers\API\V1\Admin\NewsController;
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

    Route::get('/', [PaymentMethodController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [PaymentMethodController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{payment-method}', [PaymentMethodController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{payment-method}', [PaymentMethodController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});


Route::prefix('programs')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [ProgramController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [ProgramController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{program}', [ProgramController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{program}', [ProgramController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');
});


Route::prefix('faqs')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [FaqController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [FaqController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::match(['PUT', 'PATCH'], '/{faq}', [FaqController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::delete('/{faq}', [FaqController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});


Route::prefix('news')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [NewsController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [NewsController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{new}', [NewsController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{new}', [NewsController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');

});
