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

/*
    Threads
 */

// Route::resource('threads', 'ThreadController')->except(['show', 'store']);

Route::get('threads', 'ThreadController@index');
Route::get('threads/create', 'ThreadController@create');
Route::get('threads/{category}', 'ThreadController@index');
Route::get('threads/{category}/{thread}', 'ThreadController@show');
Route::delete('threads/{category}/{thread}', 'ThreadController@destroy');
Route::post('threads', 'ThreadController@store');
Route::post('threads/{thread}/replies', 'ReplyController@store');
Route::post('favourites/reply/{reply}', 'FavouriteController@storeReply');
Route::post('favourites/thread/{thread}', 'FavouriteController@storeThread');
Route::delete('favourites/reply/{reply}', 'FavouriteController@removeReply');
Route::delete('favourites/thread/{thread}', 'FavouriteController@removeThread');

Route::get('profiles/{user}', 'ProfileController@show')->name('profile');

/*
    Authentication
 */

Auth::routes();

/*
    Miscellaneous
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
