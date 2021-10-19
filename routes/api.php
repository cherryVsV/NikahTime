<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchUsersController;
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

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('registration', [RegisterController::class, 'registration']);

Route::post('registration/code/verify', [RegisterController::class, 'verifyRegistrationCode']);

Route::post('registration/code', [RegisterController::class, 'requestRegistrationCode']);

Route::post('account/password/code', [ResetPasswordController::class, 'getResetPasswordCode']);

Route::post('account/password/code/verify', [ResetPasswordController::class, 'verifyResetPasswordCode']);

Route::post('account/password/reset', [ResetPasswordController::class, 'resetPassword']);


Route::middleware("auth:api")->group(function(){

    Route::get('account/logout', [LoginController::class, 'logOut']);

    Route::get('account/user', [ProfileController::class, 'getUser']);

    Route::put('account/user/update', [ProfileController::class, 'updateUser']);

    Route::post('store/image', [FileController::class, 'storeImage']);

    Route::get('search/get/selection/users', [SearchUsersController::class, 'getSelectionUsers']);

    Route::post('search/save/seen/users', [SearchUsersController::class, 'saveSeenUsers']);

    Route::post('search/users', [SearchUsersController::class, 'searchUsers']);



    Route::apiResource('interest', App\Http\Controllers\InterestController::class);

    Route::apiResource('user-tariff', App\Http\Controllers\UserTariffController::class);

    Route::apiResource('question', App\Http\Controllers\QuestionController::class);

    Route::apiResource('chat', App\Http\Controllers\ChatController::class);

    Route::apiResource('message', App\Http\Controllers\MessageController::class);

    Route::apiResource('like', App\Http\Controllers\LikeController::class);
});







