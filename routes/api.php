<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\OAuthController;
use App\Http\Controllers\Api\v1\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1/oauth'], function () {
    Route::post('login', [OAuthController::class, 'login'])->name('login');
    Route::post('refresh', [OAuthController::class, 'refresh'])->name('refresh');
    Route::post('register', [OAuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1/oauth'], function () {
    Route::post('logout', [OAuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::apiResource('category', CategoryController::class);
//    Route::get('skill', [SkillController::class, 'index'])->name('skill.index');
    Route::get('skill/{skill}', [SkillController::class, 'show'])->name('skill.show');
});

Route::get('skill', [SkillController::class, 'index'])->name('skill.index');
