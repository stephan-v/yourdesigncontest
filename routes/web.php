<?php

use Illuminate\Support\Facades\Route;

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

// Wordpress Blog.
Route::get('/', function() {
    return redirect('/blog');
});

Route::get('/blog', 'BlogController@index')->name('home');
Route::get('/blog/{post}', 'BlogController@show')->name('show');

