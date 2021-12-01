<?php

use App\Http\Controllers\Voyager\VoyagerUserController;
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
Route::get('/', function (){
    return view('welcome');
});
Route::get('/privacy/policy', function (){
    return view('privacyPolicy');
});

Route::get('/user/agreement', function (){
    return view('userAgreement');
});

Route::get('/user/app_use_terms', function(){
   return view('appUseTerms');
});

Route::get('/support', function(){
   return view('support');
});
Route::group(['prefix'=>'admin'], function(){
    Route::get('users/block',[VoyagerUserController::class, 'block'])->name('users.block');
    Voyager::routes();
});

