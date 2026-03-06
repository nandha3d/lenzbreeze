<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\SaleProServiceProvider::class,
    ])
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // SalePro routes merged into /admin
            \Illuminate\Support\Facades\Route::middleware(['web', \App\Http\Middleware\SwitchToSaleProConnection::class])
                ->prefix('admin')
                ->group(base_path('routes/salepro.php'));

            // Bind {product} parameter to WebProduct for admin routes
            \Illuminate\Support\Facades\Route::model('product', \App\Models\WebProduct::class);
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register SalePro middleware aliases
        $middleware->alias([
            'active' => \App\Http\Middleware\Active::class,
            'common' => \App\Http\Middleware\Common::class,
            'superadminauth' => \App\Http\Middleware\SuperAdminAuth::class,
            'cors' => \App\Http\Middleware\Cors::class,
            'checkSmsBalance' => \App\Http\Middleware\CheckSmsBalance::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
