<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContestCommentController;
use App\Http\Controllers\Api\SubmissionCommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->name('api.')->group(function () {
    Route::resource('comments', CommentController::class)->only(['update', 'destroy']);
    Route::resource('contests.comments', ContestCommentController::class)->only(['index', 'store']);
    Route::resource('submissions.comments', SubmissionCommentController::class)->only(['index', 'store']);
});
