<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\API\V1\MainController;
use App\Http\Controllers\API\V1\Admin\FaqController;
use App\Http\Controllers\API\V1\Admin\NewsController;
use App\Http\Controllers\API\V1\DomoplanerController;
use App\Http\Controllers\API\V1\Admin\FormsController;
use App\Http\Controllers\API\V1\Admin\ObjectController;
use App\Http\Controllers\API\V1\Admin\ProgramController;
use App\Http\Controllers\API\V1\Admin\ProjectController;
use App\Http\Controllers\API\V1\Admin\SeoModuleController;
use App\Http\Controllers\API\V1\Admin\PaymentMethodController;


Route::get('initialize', [MainController::class, 'init']);
Route::get('', [MainController::class, 'index']);


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
    Route::get('/{news}', [NewsController::class, 'show']);
    Route::post('/', [NewsController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{news}', [NewsController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{news}', [NewsController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');
});


Route::prefix('forms')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [FormsController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [FormsController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{form}', [FormsController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{form}', [FormsController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');
});


Route::prefix('seo-modules')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [SeoModuleController::class, 'index'])->middleware(CheckRoleMiddleware::class . ':admin,seo,content');
    Route::post('/', [SeoModuleController::class, 'store'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::match(['PUT', 'PATCH'], '/{seo-module}', [SeoModuleController::class, 'update'])->middleware(CheckRoleMiddleware::class . ':admin,content');
    Route::delete('/{seo-module}', [SeoModuleController::class, 'destroy'])->middleware(CheckRoleMiddleware::class . ':admin');
});


Route::prefix('domoplaner')->group(function () {
    Route::get('feed', [DomoplanerController::class, 'feed']);
    Route::get('flat/{flatId}', [DomoplanerController::class, 'flat']);
});
