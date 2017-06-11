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

//Profile
Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile', 'ProfileController@update')->name('profile.update');
Route::delete('profile', 'ProfileController@destroy')->name('profile.destroy');

//Posts
Route::resource('posts', 'PostController');

//Comments
Route::post('posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::delete('posts/{post}/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

//Messages
Route::get('message', 'MessageController@index')->name('message.index');
Route::get('message/{user}', 'MessageController@privateChat')->name('message.privateChat');
Route::get('message/chat/{chat}', 'MessageController@chat')->name('message.chat');
Route::post('message/chat/{chat}', 'MessageController@send')->name('message.send');