<?php

namespace App\Providers;

use App\Classes\InertiaDocument;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

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
        $this->app->singleton('document', function () {
            return new InertiaDocument();
        });
        $this->app->singleton('agent', function () {
            return new Agent();
        });
    }
}
