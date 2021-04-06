<?php

namespace App\Providers;

use App\Events\Dashboard\AfterUserLoginToDashboardEvent;
use App\Events\Dashboard\AfterUserLogoutFromDashboardEvent;
use App\Events\Dashboard\BeforeUserLoginToDashboardEvent;
use App\Events\Dashboard\BeforeUserLogoutFromDashboardEvent;
use App\Listeners\Dashboard\SendEmailVerificationNotificationDashboard;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BeforeUserLoginToDashboardEvent::class => [
            SendEmailVerificationNotificationDashboard::class
        ],
        AfterUserLoginToDashboardEvent::class => [

        ],
        BeforeUserLogoutFromDashboardEvent::class => [

        ],
        AfterUserLogoutFromDashboardEvent::class => [

        ],
        PasswordReset::class => [

        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
