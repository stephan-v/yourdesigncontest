<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContestCheckoutController;
use App\Http\Controllers\ContestCommentController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestFileController;
use App\Http\Controllers\ContestPayoutController;
use App\Http\Controllers\ContestSubmissionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\TransferWiseWebhookController;
use App\Http\Controllers\TusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInvitationController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\UserPayoutController;
use App\Http\Controllers\ContestWinnerController;
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
Route::any('/tus/{any?}', [TusController::class, 'store'])->where('any', '.*');

// Stand-alone pages.
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('how-it-works', [PageController::class, 'process'])->name('process');

Auth::routes(['verify' => true]);

// Contest routes.
Route::resource('contests', ContestController::class)->only(['create', 'index', 'store', 'show']);

// Wordpress Blog.
Route::resource('blog', BlogController::class)->only(['index', 'show']);

// User routes.
Route::resource('users', UserController::class)->only(['show', 'update']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('users/{user}/settings', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/{user}/settings/password', [UserPasswordController::class, 'edit'])->name('users.edit.password');
    Route::patch('users/{user}/settings/password', [UserPasswordController::class, 'update'])->name('users.update.password');
    Route::get('users/{user}/payout', [UserController::class, 'payout'])->name('users.payout');

    // Contest submissions.
    Route::resource('contests.submissions', ContestSubmissionController::class)->except('show');
    Route::post('contests/{contest}/submissions/{submission}/restore', [ContestSubmissionController::class, 'restore'])->name('contests.submission.restore');

    // Assign a winner.
    Route::post('contests/{contest}/submissions/{submission}/award', [ContestWinnerController::class, 'store'])->name('award');

    // Designer invitations.
    Route::resource('users.invites', UserInvitationController::class)->only(['create', 'store']);

    // User payout.
    Route::post('user/payout', [UserPayoutController::class, 'store'])->middleware('auth')->name('request.payout');

    // Contest payout.
    Route::post('contests/{contest}/payout', [ContestPayoutController::class, 'store'])->middleware('auth')->name('contests.payout');

    // Checkout routes.
    Route::get('contests/checkout/create', [ContestCheckoutController::class, 'create'])->name('checkout.create');
    Route::post('contests/checkout', [ContestCheckoutController::class, 'store'])->middleware('database.transaction');
    Route::get('success', [ContestCheckoutController::class, 'success'])->name('checkout.success');
});

// Contest handover section, comments and files.
Route::resource('contests.comments', ContestCommentController::class);
Route::get('contests/{contest}/files/zip', [ContestFileController::class, 'zip'])->name('zip');
Route::resource('contests.files', ContestFileController::class);

// Notifications.
Route::get('notifications', [NotificationController::class, 'index']);
Route::post('notifications/mark-as-read', [NotificationController::class, 'markAsRead']);

// Stripe webhooks.
Route::post('webhooks/stripe', [StripeWebhookController::class, 'handleWebhook']);

Route::post('webhooks/transferwise', [TransferWiseWebhookController::class, 'handleWebhook']);

// Contact page.
Route::get('contact', [ContactController::class, 'form'])->name('contact.form');
Route::post('contact', [ContactController::class, 'email'])->name('contact.mail');

// Faq pages.
Route::get('faq', [FaqController::class, 'index'])->name('faq.index');

// Socialite routes.
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('socialite.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('socialite.callback');
