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

Route::group(['namespace' => 'Auth'], function() {
    // Auth GET routes
    Route::get('/', 'LoginController@showLoginForm')->name('login');

    // Auth POST routes
    Route::post('/', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'App'], function() {
    // App GET routes
    Route::resource('/articles', 'ArticlesController');
    Route::resource('/products', 'ProductsController');
//    Route::resource('/{article}/comments', 'CommentsController');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    // App POST routes
//    Route::post('/timezone', 'DashboardController@timezoneAjax');
});