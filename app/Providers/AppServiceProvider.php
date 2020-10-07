<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Testimonial;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use App\Observers\RoleObserver;
use App\Observers\ServiceObserver;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\Schema;
use App\Observers\TestimonialObserver;
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
        Schema::defaultStringLength(191);

        Tag::observe(TagObserver::class);
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Product::observe(ProductObserver::class);
        Service::observe(ServiceObserver::class);
        Category::observe(CategoryObserver::class);
        Testimonial::observe(TestimonialObserver::class);
    }
}
