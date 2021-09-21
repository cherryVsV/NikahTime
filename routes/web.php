<?php

use App\Http\Controllers\Socials\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/email/confirm', [\App\Http\Controllers\Mails\MailController::class, 'sendConfirmationEmail'])->name('emailConfirmation');
Route::post('/forgot/password', [\App\Http\Controllers\Mails\MailController::class, 'sendForgotPasswordEmail'])->name('forgotPassword');
Route::get('/confirmation', function(){
    return view('auth.confirm');
});
Route::get('/forgot/password/confirmation', function(){
    return view('auth.forgot');
});
Route::get('/change/password', function(){
    return view('auth.change');
});
Route::post('/change/password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
Route::post('/confirmation', [\App\Http\Controllers\Auth\ConfirmationController::class, 'checkEmailCode'])->name('checkEmailCode');
Route::post('password/confirmation', [\App\Http\Controllers\Auth\ConfirmationController::class, 'checkForgotPasswordCode'])->name('checkForgotPasswordCode');
Route::get('/social/auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('auth.social');
Route::get('/social/auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('auth.social.callback');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
