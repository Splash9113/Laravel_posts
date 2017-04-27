<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::resource('posts', 'PostController');
Route::post('posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::delete('posts/{post}/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');