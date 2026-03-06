<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ini_set('memory_limit', '512M');
        class_alias(\App\Helpers\DNS1D::class, 'DNS1D');
        class_alias(\App\Helpers\DNS2D::class, 'DNS2D');
    }
}
