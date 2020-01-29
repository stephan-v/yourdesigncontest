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

Route::any('/tus/{any?}', function () {
    $response = app(\TusPhp\Tus\Server::class)->serve();

    return $response->send();
})->where('any', '.*');

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

// Contest/Checkout routes.
Route::get('contests/create', 'ContestController@create')->middleware('auth')->name('contests.create');
Route::get('contests/{contest}/checkout/create', 'ContestCheckoutController@create')->middleware('auth')->name('checkout.create');
Route::resource('contests', 'ContestController')->except(['create']);

// Contest payout.
Route::post('contests/{contest}/payout', 'ContestPayoutController@store');

Route::resource('blog', 'BlogController')->only(['index', 'show']);

Route::post('checkouts', 'ContestCheckoutController@store');
Route::get('success', 'ContestCheckoutController@success');

// Authentication routes.
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

// User routes.
Route::get('users/{user}', 'UserController@show')->name('users.show');

// User submissions for the contest.
Route::resource('contests.submissions', 'ContestSubmissionController');

// Source files for the contest.
Route::get('contests/{contest}/files/zip', 'ContestFileController@zip')->name('zip');
Route::resource('contests.files', 'ContestFileController');

// Comments.
Route::resource('submissions.comments', 'SubmissionCommentController');

// Stripe webhooks.
Route::post('stripe/webhook', 'StripeWebhookController@handleWebhook');

// Individual static pages.
Route::get('how-it-works', 'PageController@process')->name('process');

// Contact page.
Route::get('contact', 'ContactController@form')->name('contact.form');
Route::post('contact', 'ContactController@email')->name('contact.mail');

// Assign a winner.
Route::post('contests/{contest}/submissions/{submission}/winner', 'WinnerController@store')->name('winner');

