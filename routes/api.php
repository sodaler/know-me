<?php

use App\Http\Controllers\Api\v1\CardController;
use App\Http\Controllers\Api\v1\CardRequestController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ChatController;
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
        'categories' => CategoryController::class,
        'users' => UserController::class
    ]);

    Route::get('cards', [CardController::class, 'index'])->name('card.index');
    Route::get('cards/{card}', [CardController::class, 'show'])->name('card.show');
    Route::post('cards/{card}/image', [CardController::class, 'addImage'])->name('card.image.add');
    Route::post('cards', [CardController::class, 'store'])->name('card.store');

    Route::patch('cards/{card}/request/send', [CardRequestController::class, 'send'])->name('card.request.send');
    Route::patch('cards/{card}/request/accept', [CardRequestController::class, 'accept'])->name('card.request.accept');
    Route::patch('cards/{card}/request/cancel', [CardRequestController::class, 'cancel'])->name('card.request.cancel');
    Route::patch('cards/{card}/request/in-progress', [CardRequestController::class, 'inProgress'])->name('card.request.in-progress');
    Route::patch('cards/{card}/request/complete', [CardRequestController::class, 'complete'])->name('card.request.complete');

    Route::get('skills', [SkillController::class, 'index'])->name('skill.index');
    Route::get('skills/{skill}', [SkillController::class, 'show'])->name('skill.show');

    Route::get('chats', [ChatController::class, 'index'])->name('chat.index');
    Route::get('chats/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('chats', [ChatController::class, 'store'])->name('chat.store');
    Route::post('chats/send-message', [ChatController::class, 'sendMessage'])->name('chat.message.send');
    Route::delete('chats/{chat}', [ChatController::class, 'deleteMessage'])->name('chat.delete');
    Route::get('chats/messages', [ChatController::class, 'chatMessages'])->name('chat.message.index');

    Route::get('users/{user}/chats', [UserController::class, 'indexChats'])->name('user.chat.index');
});
