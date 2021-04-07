<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Option;
use App\Observers\OptionsObserver;
use App\Observers\VisitorObserver;
use App\Models\Role;
use App\Observers\RoleObserver;
use App\Models\Language;
use App\Observers\LanguageObserver;
use App\Models\Translation;
use App\Observers\TranslationObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        Language::observe(LanguageObserver::class);
        Translation::observe(TranslationObserver::class);
        Role::observe(RoleObserver::class);
        Option::observe(OptionsObserver::class);
    }
}
