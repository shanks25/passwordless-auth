<?php

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

Route::get('login/magic','MagicLoginController@index')->name('login.magic');

Route::post('login/magic','MagicLoginController@sendmail')->name('login.magic');
Route::get('login/magic/{token}','MagicLoginController@validateToken');

Route::get('/home', 'HomeController@index')->name('home');
