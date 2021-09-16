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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('interest', App\Http\Controllers\InterestController::class);

Route::apiResource('user-tariff', App\Http\Controllers\UserTariffController::class);

Route::apiResource('question', App\Http\Controllers\QuestionController::class);

Route::apiResource('chat', App\Http\Controllers\ChatController::class);

Route::apiResource('message', App\Http\Controllers\MessageController::class);

Route::apiResource('profile', App\Http\Controllers\ProfileController::class);

Route::apiResource('like', App\Http\Controllers\LikeController::class);
