<?php

namespace App\Providers;

use App\View\Components\Test;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

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
    public function boot(Dashboard $dashboard)
    {
        Blade::component(Test::class, 'testcomponent');
        //$dashboard->registerResource('scripts', 'rater.js');
        //$dashboard->registerResource('scripts', 'public/js/dashboard.js');
    }
}
