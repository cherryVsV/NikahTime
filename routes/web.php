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
Route::post('/email/confirm', [\App\Http\Controllers\Mails\MailController::class, 'sendEmail'])->name('emailConfirmation');
Route::get('/confirmation', function(){
    return view('auth.confirm');
});
Route::post('/confirmation', [\App\Http\Controllers\Auth\ConfirmationController::class, 'checkCode'])->name('checkCode');
Route::get('/social/auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('auth.social');
Route::get('/social/auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('auth.social.callback');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
