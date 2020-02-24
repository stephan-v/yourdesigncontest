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
Route::post('contests/{contest}/checkout', 'ContestCheckoutController@store');
Route::get('success', 'ContestCheckoutController@success');

Route::get('contests', 'ContestController@index')->name('contests.index');
Route::post('contests', 'ContestController@store')->name('contests.store');
Route::get('contests/{contest}', 'ContestController@show')->middleware('payment.check')->name('contests.show');

// Contest payout.
Route::get('contests/{contest}/payout', 'ContestPayoutController@store');

Route::resource('blog', 'BlogController')->only(['index', 'show']);

// Authentication routes.
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

// User routes.
Route::resource('users', 'UserController');

// User submissions for the contest.
Route::middleware('auth')->group(function () {
    Route::resource('contests.submissions', 'ContestSubmissionController')->except('show');
    Route::post('contests/{contest}/submissions/{submission}/restore', 'ContestSubmissionController@restore')->name('contests.submission.restore');
});

// Source files for the contest.
Route::get('contests/{contest}/files/zip', 'ContestFileController@zip')->name('zip');
Route::resource('contests.files', 'ContestFileController');

// Comments.
Route::resource('comments', 'CommentController')->only(['update', 'destroy']);
Route::resource('submissions.comments', 'SubmissionCommentController');

// Stripe webhooks.
Route::post('stripe/webhook', 'StripeWebhookController@handleWebhook');

// Individual static pages.
Route::get('how-it-works', 'PageController@process')->name('process');

// Contact page.
Route::get('contact', 'ContactController@form')->name('contact.form');
Route::post('contact', 'ContactController@email')->name('contact.mail');

// Assign a winner.
Route::post('contests/{contest}/submissions/{submission}/award', 'WinnerController@store')->name('award');

Route::get('stripe/connect-complete', 'StripeConnectController@complete')->name('connect.complete');
Route::get('stripe/connect-dashboard', 'StripeConnectController@dashboard')->name('connect.dashboard');
Route::get('stripe/connect-onboarding', 'StripeConnectController@onboarding')->name('connect.onboarding');

