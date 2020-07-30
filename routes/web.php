<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Post;
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



Route::get('/', 'WelcomeController@index');
Route::get('search-post/{id}', 'WelcomeController@show')->name('search.post');
Route::post('add-post-count', 'WelcomeController@loadMorePost')->name('search.add-post');


\Auth::routes();

// Home
Route::get('/home', 'HomeController@index')->name('home');


// Dashboard route
Route::prefix('dashboard')->group(function () {
    Route::get('info', 'DashboardController@showInfo')->middleware('auth')->name('dashboard.info');
    Route::get('post-setting', 'DashboardController@showPostSetting')->middleware('auth')->name('dashboard.postSett');
    Route::get('your-post-setting', 'DashboardController@showYourPost')->middleware('auth')->name('dashboard.yourPost');
    Route::get('add-post', 'DashboardController@showAddPost')->middleware('auth')->name('dashboard.addPost');
});

Route::prefix('post')->group(function () {
    Route::get('/', 'PostController@index')->middleware('auth')->name('post.index');
    Route::post('/', 'PostController@store')->middleware('auth')->name('post.create');
    Route::get('/edit/{id}', 'PostController@edit')->middleware('auth')->name('post.edit');
    Route::post('/search', 'PostController@search')->name('post.search');
    Route::post('/admin-search', 'PostController@adminSearch')->middleware('auth')->name('post.admin-search');
    Route::delete('/{id}', 'PostController@destroy')->middleware('auth')->name('post.delete');
    Route::patch('/update/{id}', 'PostController@update')->middleware('auth')->name('post.update');
});
