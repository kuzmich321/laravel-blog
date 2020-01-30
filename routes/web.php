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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::resource('users', 'UserController')->only([
    'index', 'show'
]);

Route::resource('posts', 'PostController')->only([
    'index', 'show'
]);

Route::namespace('Admin')->prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', 'AdminController@index')->name('admin');

    Route::name('admin.')->group(function () {
        Route::patch('users/{user}/restore', 'UserController@restore')->name('users.restore');
        Route::resource('users', 'UserController');

        Route::patch('posts/{post}/restore', 'PostController@restore')->name('posts.restore');
        Route::resource('posts', 'PostController');
    });
});
