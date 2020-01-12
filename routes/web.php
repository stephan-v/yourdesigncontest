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

// Contest routes.
Route::get('contests/create', 'ContestController@create')->middleware('auth');
Route::resource('contests', 'ContestController')->except(['create']);

Route::resource('blog', 'BlogController')->only(['index', 'show']);

Route::post('checkouts', 'CheckoutController@store');

Route::get('success', 'CheckoutController@success');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::post('stripe/webhook', 'StripeWebhookController@handleWebhook');
