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
    // App resources routes
    Route::resources([
        'admins' => 'AdminController',
        'products' => 'ProductController',
        'categories' => 'CategoryController',
    ]);

    // App GET routes
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/logs', 'ProfileController@logs')->name('profile.logs');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    // App POST routes
    Route::post('/timezone', 'DashboardController@timezoneAjax');
    Route::post('/profile/update-info', 'ProfileController@updateInfo')->name('profile.update.info');
    Route::post('/profile/update-password', 'ProfileController@updatePassword')->name('profile.update.password');
    Route::post('/profile/update-avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
});

Route::group(['namespace' => 'Archive'], function() {
    // App resources routes

    // App GET routes
    Route::get('/archives', 'ArchiveController@index')->name('archives.index');
    Route::get('/archives/admins', 'AdminController@index')->name('archives.admins.index');

    // App POST routes
    Route::post('/archives/admins/{admin}/restore', 'AdminController@restore')->name('archives.admins.restore');
});