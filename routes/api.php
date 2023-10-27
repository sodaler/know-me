<?php

use App\Http\Controllers\Api\v1\CardController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\OAuthController;
use App\Http\Controllers\Api\v1\PasswordController;
use App\Http\Controllers\Api\v1\SkillController;
use App\Http\Controllers\Api\v1\UserController;
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
    Route::post('password-link', [PasswordController::class, 'link'])->name('password.link');
    Route::get('password', [PasswordController::class, 'reset'])->name('password.reset');
    Route::post('password', [PasswordController::class, 'store'])->name('password.store');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1/oauth'], function () {
    Route::post('logout', [OAuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::apiResources([
        'category' => CategoryController::class,
        'user' => UserController::class
    ]);

    Route::get('card', [CardController::class, 'index'])->name('card.index');
    Route::get('card/{card}', [CardController::class, 'show'])->name('card.show');
    Route::post('card/{card}/image', [CardController::class, 'addImage'])->name('card.image.add');
    Route::get('skill', [SkillController::class, 'index'])->name('skill.index');
    Route::get('skill/{skill}', [SkillController::class, 'show'])->name('skill.show');
});
