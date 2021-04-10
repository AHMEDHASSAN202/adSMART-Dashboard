<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\User;
use App\Observers\ProfileObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
        Profile::observe(ProfileObserver::class);
    }
}
