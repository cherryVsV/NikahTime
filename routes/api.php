<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
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

Route::post('login', [LoginController::class, 'login']);

Route::post('register', [RegisterController::class, 'register']);

Route::post('confirm/email', [RegisterController::class, 'sendConfirmEmail']);

Route::get('social/auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('auth.social');

Route::get('social/auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('auth.social.callback');

Route::post('forgot/password', [ResetPasswordController::class, 'sendForgotPasswordEmail']);

Route::post('change/password', [ResetPasswordController::class, 'changePassword']);

Route::post('password/confirmation', [ResetPasswordController::class, 'checkForgotPasswordCode']);

Route::post('logout', [LoginController::class, 'logOut']);

Route::apiResource('interest', App\Http\Controllers\InterestController::class);

Route::apiResource('user-tariff', App\Http\Controllers\UserTariffController::class);

Route::apiResource('question', App\Http\Controllers\QuestionController::class);

Route::apiResource('chat', App\Http\Controllers\ChatController::class);

Route::apiResource('message', App\Http\Controllers\MessageController::class);

Route::apiResource('profile', App\Http\Controllers\ProfileController::class);

Route::apiResource('like', App\Http\Controllers\LikeController::class);



