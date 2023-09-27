<?php

use App\Http\Controllers\Api\v1\OAuthController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

//Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
//    Route::post('login', [AuthController::class, 'login']);
//    Route::post('register', [AuthController::class, 'register']);
//    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::post('me', [AuthController::class, 'me']);
//});
//
//
//Route::middleware('jwt.auth')->get('hello', function () {
//    return 1111;
//});

Route::group(['prefix' => 'v1/oauth'], function () {
    Route::post('token', [OAuthController::class, 'token'])->name('token');
    Route::post('login', [OAuthController::class, 'login'])->name('login');
    Route::post('refresh', [OAuthController::class, 'refresh'])->name('refresh');
    Route::post('register', [OAuthController::class, 'register'])->name('register');
    Route::post('logout', [OAuthController::class, 'logout'])->name('logout');
});

Route::get('hello', function () {
   return 111;
});
