<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route used for Tus protocol file upload, mainly used for Uppy.
Route::any('/tus/{any?}', 'TusController@store')->where('any', '.*');

// Individual pages.
Route::get('/', 'PageController@home')->name('home');
Route::get('how-it-works', 'PageController@process')->name('process');

// Routes used for websocket verification.
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

// Blog.
Route::resource('blog', 'BlogController')->only(['index', 'show']);

// User routes.
Route::resource('users', 'UserController')->only(['show', 'update']);
Route::get('users/{user}/settings', 'UserController@edit')->name('users.edit');

Route::get('users/{user}/settings/password', 'UserPasswordController@password')->name('users.edit.password');
Route::patch('users/{user}/settings/password', 'UserPasswordController@password')->name('users.update.password');

Route::get('users/{user}/verify', 'UserController@verify')->name('users.verify');

// User submissions for the contest.
Route::middleware('auth')->group(function () {
    Route::resource('contests.submissions', 'ContestSubmissionController')->except('show');
    Route::post('contests/{contest}/submissions/{submission}/restore', 'ContestSubmissionController@restore')->name('contests.submission.restore');
});

// Contest handover section, comments and files.
Route::middleware('winner.check')->group(function () {
    Route::resource('contests.comments', 'ContestCommentController');
    Route::get('contests/{contest}/files/zip', 'ContestFileController@zip')->name('zip');
    Route::resource('contests.files', 'ContestFileController');
});

// Notifications.
Route::resource('notifications', 'NotificationController');

// Stripe webhooks.
Route::post('stripe/webhook', 'StripeWebhookController@handleWebhook');

// Contact page.
Route::get('contact', 'ContactController@form')->name('contact.form');
Route::post('contact', 'ContactController@email')->name('contact.mail');

// Assign a winner.
Route::post('contests/{contest}/submissions/{submission}/award', 'WinnerController@store')->name('award');

// Designer invitations.
Route::resource('users.invites', 'UserInvitationController')->only(['create', 'store']);

// Stripe routes.
Route::get('stripe/connect-complete', 'StripeConnectController@complete')->name('connect.complete');
Route::get('stripe/connect-dashboard', 'StripeConnectController@dashboard')->name('connect.dashboard');
Route::get('stripe/connect-onboarding', 'StripeConnectController@onboarding')->name('connect.onboarding');

