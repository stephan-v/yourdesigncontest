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

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::resource('contest', 'ContestController');
Route::resource('blog', 'BlogController');

Route::get('blog', 'BlogController@index');

Route::get('checkout-session', 'CheckoutController@session');
Route::get('checkout', 'CheckoutController@index');
Route::get('success', 'CheckoutController@success');
