<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index']);
    Route::get('chats', [\App\Http\Controllers\ChatController::class, 'index']);

    Route::group(['prefix' => 'message'], function () {
       Route::post('send', [\App\Http\Controllers\MessageController::class, 'sendMessage']);
       Route::get('{senderId}/{recipientId}/list', [\App\Http\Controllers\MessageController::class, 'getMessages']);
    });
});
