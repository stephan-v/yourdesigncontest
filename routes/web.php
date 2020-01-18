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

// Contest/Checkout routes.
Route::get('contests/create', 'ContestController@create')->middleware('auth');
Route::get('contests/{contest}/checkout/create', 'ContestCheckoutController@create')->middleware('auth')->name('checkout.create');
Route::resource('contests', 'ContestController')->except(['create']);

Route::resource('blog', 'BlogController')->only(['index', 'show']);

Route::post('checkouts', 'ContestCheckoutController@store');
Route::get('success', 'ContestCheckoutController@success');

// Authentication routes.
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

// User routes.
Route::get('users/{user}', 'UserController@show')->name('users.show');

Route::resource('contests.submissions', 'ContestSubmissionController');

// Comments.
Route::resource('submissions.comments', 'SubmissionCommentController');

// Stripe webhooks.
Route::post('stripe/webhook', 'StripeWebhookController@handleWebhook');

