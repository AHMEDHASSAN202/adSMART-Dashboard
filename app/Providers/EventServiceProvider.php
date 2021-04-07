<?php

namespace App\Providers;

use App\Events\Dashboard\AfterUserLoginToDashboardEvent;
use App\Events\Dashboard\AfterUserLogoutFromDashboardEvent;
use App\Events\Dashboard\BeforeUserLoginToDashboardEvent;
use App\Events\Dashboard\BeforeUserLogoutFromDashboardEvent;
use App\Events\Dashboard\UserAttemptedToDashboardLogin;
use App\Listeners\Dashboard\RegisterActivityAfterLoged;
use App\Listeners\Dashboard\RegisterChangeUserPasswordActivity;
use App\Listeners\Dashboard\RegisterResetUserPasswordActivity;
use App\Listeners\Dashboard\RegisterUserAttemptedToDashboardLogin;
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
            RegisterActivityAfterLoged::class,
        ],
        UserAttemptedToDashboardLogin::class => [
            RegisterUserAttemptedToDashboardLogin::class
        ],
        BeforeUserLogoutFromDashboardEvent::class => [

        ],
        AfterUserLogoutFromDashboardEvent::class => [

        ],
        PasswordReset::class => [
            RegisterResetUserPasswordActivity::class
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
