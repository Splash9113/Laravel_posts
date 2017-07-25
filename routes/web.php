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

//Images
Route::post('avatar-upload', 'ImageController@uploadAvatar')->name('avatar.upload');
Route::post('avatar-delete', 'ImageController@deleteAvatar            $table->softDeletes();
')->name('avatar.delete');

//Posts
Route::resource('posts', 'PostController');

//Comments
Route::post('posts/{post}/comments', 'CommentController@store')->name('comments.store');
Route::delete('posts/{post}/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

//Messages
Route::get('message', 'ChatController@index')->name('chat.index');
Route::get('message/{user}', 'ChatController@privateChat')->name('chat.showPrivate');
Route::get('message/chat/{chat}', 'ChatController@chat')->name('chat.show');
Route::post('message/chat/{chat}', 'ChatController@send')->name('chat.send');