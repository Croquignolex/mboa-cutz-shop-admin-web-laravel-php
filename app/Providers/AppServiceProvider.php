<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use App\Observers\RoleObserver;
use App\Observers\ServiceObserver;
use App\Observers\ProductObserver;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force https redirection
        if(env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Database varchar default length
        Schema::defaultStringLength(191);

        // Models boot
        Tag::observe(TagObserver::class);
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Product::observe(ProductObserver::class);
        Service::observe(ServiceObserver::class);
        Article::observe(ArticleObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
