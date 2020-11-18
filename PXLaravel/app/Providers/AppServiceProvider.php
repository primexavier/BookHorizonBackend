<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NascentAfrica\Jetstrap\JetstrapFacade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path().'/..';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JetstrapFacade::bootstrap4();
        Paginator::useBootstrap();
        JetstrapFacade::useCoreUi3();
    }
}
