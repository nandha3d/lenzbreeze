<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class SaleProServiceProvider extends ServiceProvider
{
    /**
     * Register SalePro bindings and services.
     */
    public function register(): void
    {
        // Bind SalePro SMS ViewModel
        $this->app->bind(
            \App\ViewModels\ISmsModel::class,
            \App\ViewModels\SmsModel::class
        );

        // Register local HTML package to provide Form and Html facades for SalePro views
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
    }

    /**
     * Bootstrap SalePro services.
     */
    public function boot(): void
    {
        // Add SalePro views directory as a PRIORITY view path
        // Using prependLocation on the view finder directly (not config)
        // because the FileViewFinder is already instantiated before boot()
        $this->app['view']->getFinder()->prependLocation(resource_path('views/salepro'));

        // Also register as a namespaced hint for explicit salepro::view usage
        $this->loadViewsFrom(resource_path('views/salepro'), 'salepro');

        // Share SalePro asset prefix with all views
        View::composer('*', function ($view) {
            if (!$view->offsetExists('salepro_asset_prefix')) {
                $view->with('salepro_asset_prefix', '/salepro-assets');
            }
        });
    }
}
