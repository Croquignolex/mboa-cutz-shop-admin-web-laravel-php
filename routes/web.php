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
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/logs', 'ProfileController@logs')->name('profile.logs');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    // App POST routes
    Route::post('/timezone', 'DashboardController@timezoneAjax');

    Route::post('/profile/update-info', 'ProfileController@updateInfo')->name('profile.update.info');
    Route::post('/profile/update-avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
    Route::post('/profile/update-password', 'ProfileController@updatePassword')->name('profile.update.password');

    Route::post('/products/{product}/update-image', 'ProductController@updateImage')->name('products.update.image');
    Route::post('/services/{service}/update-image', 'ServiceController@updateImage')->name('services.update.image');
    Route::post('/articles/{article}/update-image', 'ArticleController@updateImage')->name('articles.update.image');
    Route::post('/testimonials/{testimonial}/update-image', 'TestimonialController@updateImage')->name('testimonials.update.image');

    Route::post('/categories/{category}/add-product', 'CategoryController@addProduct')->name('categories.add.product');
    Route::post('/categories/{category}/add-service', 'CategoryController@addService')->name('categories.add.service');
    Route::post('/categories/{category}/add-article', 'CategoryController@addArticle')->name('categories.add.article');

    Route::post('/tags/{tag}/add-product', 'TagController@addProduct')->name('tags.add.product');
    Route::post('/tags/{tag}/add-service', 'TagController@addService')->name('tags.add.service');
    Route::post('/tags/{tag}/add-article', 'TagController@addArticle')->name('tags.add.article');

    Route::delete('/products/{product}/remove-review/{review}', 'ProductController@removeReview')->name('products.remove.review');
    Route::delete('/services/{service}/remove-review/{review}', 'ServiceController@removeReview')->name('services.remove.review');
    Route::delete('/articles/{article}/remove-comment/{comment}', 'ArticleController@removeComment')->name('articles.remove.comment');

    // App resources routes
    Route::resource('/customers', 'CustomerController')->except(['edit']);
    Route::resource('/contacts', 'ContactController')->only(['index', 'destroy']);
    Route::resources([
        'tags' => 'TagController',
        'admins' => 'AdminController',
        'products' => 'ProductController',
        'articles' => 'ArticleController',
        'services' => 'ServiceController',
        'categories' => 'CategoryController',
        'testimonials' => 'TestimonialController',
    ]);
});

Route::group(['namespace' => 'Archive'], function() {
    // App GET routes
    Route::get('/archives', 'ArchiveController@index')->name('archives.index');
    Route::get('/archives/tags', 'TagController@index')->name('archives.tags.index');
    Route::get('/archives/admins', 'AdminController@index')->name('archives.admins.index');
    Route::get('/archives/products', 'ProductController@index')->name('archives.products.index');
    Route::get('/archives/services', 'ServiceController@index')->name('archives.services.index');
    Route::get('/archives/articles', 'ArticleController@index')->name('archives.articles.index');
    Route::get('/archives/contacts', 'ContactController@index')->name('archives.contacts.index');
    Route::get('/archives/customers', 'CustomerController@index')->name('archives.customers.index');
    Route::get('/archives/categories', 'CategoryController@index')->name('archives.categories.index');
    Route::get('/archives/testimonials', 'TestimonialController@index')->name('archives.testimonials.index');
    Route::get('/archives/product-reviews', 'ProductReviewController@index')->name('archives.product-reviews.index');
    Route::get('/archives/service-reviews', 'ServiceReviewController@index')->name('archives.service-reviews.index');
    Route::get('/archives/article-comments', 'ArticleCommentController@index')->name('archives.article-comments.index');

    // App POST routes
    Route::post('/archives/tags/{tag}/restore', 'TagController@restore')->name('archives.tags.restore');
    Route::post('/archives/admins/{admin}/restore', 'AdminController@restore')->name('archives.admins.restore');
    Route::post('/archives/products/{product}/restore', 'ProductController@restore')->name('archives.products.restore');
    Route::post('/archives/services/{service}/restore', 'ServiceController@restore')->name('archives.services.restore');
    Route::post('/archives/articles/{article}/restore', 'ArticleController@restore')->name('archives.articles.restore');
    Route::post('/archives/contacts/{contact}/restore', 'ContactController@restore')->name('archives.contacts.restore');
    Route::post('/archives/customers/{customer}/restore', 'CustomerController@restore')->name('archives.customers.restore');
    Route::post('/archives/categories/{category}/restore', 'CategoryController@restore')->name('archives.categories.restore');
    Route::post('/archives/testimonials/{testimonial}/restore', 'TestimonialController@restore')->name('archives.testimonials.restore');
    Route::post('/archives/product-reviews/{review}/restore', 'ProductReviewController@restore')->name('archives.product-reviews.restore');
    Route::post('/archives/service-reviews/{review}/restore', 'ServiceReviewController@restore')->name('archives.service-reviews.restore');
    Route::post('/archives/article-comments/{comment}/restore', 'ArticleCommentController@restore')->name('archives.article-comments.restore');
});