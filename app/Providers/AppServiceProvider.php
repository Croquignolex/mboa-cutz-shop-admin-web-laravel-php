<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Observers\CategoryObserver;
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
        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
