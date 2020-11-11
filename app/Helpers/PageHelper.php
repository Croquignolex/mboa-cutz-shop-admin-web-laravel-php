<?php

use Illuminate\Support\Collection;

if(!function_exists('page_title'))
{
    /**
     * @param $page
     * @return string
     */
    function page_title($page)
    {
        $base_name = config('app.name');
        return $page === '' ? $base_name : "$page - $base_name";
    }
}

if(!function_exists('active_page'))
{
    /**lightSpeedOut
     * @param Collection $routes
     * @return string
     */
    function active_page(Collection $routes)
    {
        foreach ($routes as $route) {
            if(Illuminate\Support\Facades\Route::is($route)) {
                return 'active';
            }
        }
        return '';
    }
}

if(!function_exists('active_page_group'))
{
    /**lightSpeedOut
     * @param Collection $routes
     * @return string
     */
    function active_page_group(Collection $routes)
    {
        foreach ($routes as $route) {
            if(Illuminate\Support\Facades\Route::is($route)) {
                return 'show';
            }
        }
        return '';
    }
}

if(!function_exists('seo_keywords'))
{
    /**
     * @return string
     */
    function seo_keywords()
    {
        return 'mboa,cutz,hair,men,baber';
    }
}

if(!function_exists('seo_description'))
{
    /**
     * @return string
     */
    function seo_description()
    {
        return 'Baber shop';
    }
}

if(!function_exists('seo_authors'))
{
    /**
     * @return string
     */
    function seo_authors()
    {
        return 'MBOACUTZ,Alex NGOMBOL';
    }
}

if(!function_exists('customers_pages'))
{
    /**
     * @return Collection
     */
    function customers_pages()
    {
        return collect(['customers.index', 'customers.create', 'customers.show']);
    }
}

if(!function_exists('articles_pages'))
{
    /**
     * @return Collection
     */
    function articles_pages()
    {
        return collect(['articles.index', 'articles.create', 'articles.show', 'articles.edit']);
    }
}

if(!function_exists('categories_pages'))
{
    /**
     * @return Collection
     */
    function categories_pages()
    {
        return collect(['categories.index', 'categories.create', 'categories.show', 'categories.edit']);
    }
}

if(!function_exists('tags_pages'))
{
    /**
     * @return Collection
     */
    function tags_pages()
    {
        return collect(['tags.index', 'tags.create', 'tags.show', 'tags.edit']);
    }
}

if(!function_exists('testimonials_pages'))
{
    /**
     * @return Collection
     */
    function testimonials_pages()
    {
        return collect(['testimonials.index', 'testimonials.show', 'testimonials.create', 'testimonials.edit']);
    }
}

if(!function_exists('admins_pages'))
{
    /**
     * @return Collection
     */
    function admins_pages()
    {
        return collect(['admins.index', 'admins.create', 'admins.show', 'admins.edit']);
    }
}

if(!function_exists('products_pages'))
{
    /**
     * @return Collection
     */
    function products_pages()
    {
        return collect(['products.index', 'products.create', 'products.show', 'products.edit']);
    }
}

if(!function_exists('services_pages'))
{
    /**
     * @return Collection
     */
    function services_pages()
    {
        return collect(['services.index', 'services.create', 'services.show', 'services.edit']);
    }
}

if(!function_exists('articles_pages'))
{
    /**
     * @return Collection
     */
    function articles_pages()
    {
        return collect(['articles.index', 'articles.create', 'articles.show', 'articles.edit']);
    }
}

if(!function_exists('events_pages'))
{
    /**
     * @return Collection
     */
    function events_pages()
    {
        return collect(['events.index', 'events.create', 'events.show', 'events.edit']);
    }
}

if(!function_exists('archives_pages'))
{
    /**
     * @return Collection
     */
    function archives_pages()
    {
        return collect([
            'archives.index', 'archives.tags.index', 'archives.admins.index',
            'archives.products.index', 'archives.services.index', 'archives.articles.index',
            'archives.customers.index', 'archives.categories.index', 'archives.testimonials.index',
            'archives.product-reviews.index', 'archives.service-reviews.index', 'archives.article-comments.index',
        ]);
    }
}
