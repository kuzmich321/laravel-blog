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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController')->only([
    'index', 'show'
]);

Route::resource('posts', 'PostController')->only([
    'index', 'show'
]);

Route::namespace('Admin')->prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::patch('users/{user}/restore', 'UserController@restore')->name('users.restore');
    Route::resource('users', 'UserController');
});

