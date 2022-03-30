<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// I added this manually
use Illuminate\Pagination\Paginator;

class  AppServiceProvider extends ServiceProvider
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
        // I added this manually
        Paginator::useBootstrap();
    }
}
