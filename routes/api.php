<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\BlockUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchUsersController;
use App\Http\Controllers\UserTariffController;
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

Route::post('auth/apple/callback', [SocialController::class, 'callback']);

Route::middleware("auth:api")->group(function(){

    Route::get('account/logout/{token}', [LoginController::class, 'logOut']);

    Route::get('account/user', [ProfileController::class, 'getUser']);

    Route::get('account/user/{userId}', [ProfileController::class, 'getUserById']);

    Route::put('block/user/{userId}', [BlockUserController::class, 'blockUserById']);

    Route::delete('block/user/delete/{userId}', [BlockUserController::class, 'unblockUserById']);

    Route::put('account/user/update', [ProfileController::class, 'updateUser']);

    Route::post('store/file', [FileController::class, 'storeFile']);

    Route::post('get/file/size', [FileController::class, 'getFileSize']);

    Route::get('search/get/selection/users', [SearchUsersController::class, 'getSelectionUsers']);

    Route::post('search/save/seen/users', [SearchUsersController::class, 'saveSeenUsers']);

    Route::post('search/users', [SearchUsersController::class, 'searchUsers']);

    Route::put('guests/add/{userId}', [GuestController::class, 'addUserGuest']);

    Route::get('guests/get', [GuestController::class, 'getGuestsUser']);

    Route::put('favourites/add/{userId}', [FavouritesController::class, 'addToUserFavourites']);

    Route::get('favourites/get', [FavouritesController::class, 'getUserFavourites']);

    Route::delete('favourites/delete/{userId}', [FavouritesController::class, 'deleteFromUserFavourites']);

    Route::post('chats/add/{userId}', [ChatController::class, 'addUserChat']);

    Route::get('chats/user', [ChatController::class, 'getChatMessages']);

    Route::get('chats/get/{chatId}', [ChatController::class, 'getChatInformation']);

    Route::put('chats/block/{chatId}', [ChatController::class, 'blockChat']);

    Route::delete('chats/delete/{chatId}', [ChatController::class, 'deleteChat']);

    Route::post('chats/send/message', [MessageController::class, 'sendMessage']);

    Route::get('chats/get/message/{messageId}', [MessageController::class, 'getMessage']);

    Route::put('chats/seen/message/{messageId}', [MessageController::class, 'makeSeenMessage']);

    Route::put('set/user/tariff/{tariffId}', [UserTariffController::class, 'setUserTariff']);

    Route::post('complain', [ComplaintController::class, 'makeComplain']);

    Route::get('get/tariffs', [UserTariffController::class, 'getTariffs']);

    Route::get('get/user/tariff', [UserTariffController::class, 'getUserTariff']);
});







