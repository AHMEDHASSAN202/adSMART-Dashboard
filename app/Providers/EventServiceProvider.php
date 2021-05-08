<?php

namespace App\Providers;

use App\Events\Dashboard\AfterChangeMyProfilePassword;
use App\Events\Dashboard\AfterCreateUserEvent;
use App\Events\Dashboard\AfterDeleteRoleEvent;
use App\Events\Dashboard\AfterEditUserEvent;
use App\Events\Dashboard\AfterPersonalOptionsEdit;
use App\Events\Dashboard\AfterRemoveUserEvent;
use App\Events\Dashboard\AfterUserLoginToDashboardEvent;
use App\Events\Dashboard\AfterUserLogoutFromDashboardEvent;
use App\Events\Dashboard\BeforeUserLoginToDashboardEvent;
use App\Events\Dashboard\BeforeUserLogoutFromDashboardEvent;
use App\Events\Dashboard\UserAttemptedToDashboardLogin;
use App\Listeners\Dashboard\ClearUserFiles;
use App\Listeners\Dashboard\RegisterActivityAfterLoged;
use App\Listeners\Dashboard\RegisterChangeMyProfilePasswordActivity;
use App\Listeners\Dashboard\RegisterChangeUserPasswordActivity;
use App\Listeners\Dashboard\RegisterEditUserActivity;
use App\Listeners\Dashboard\RegisterPersonalOptionsEditActivity;
use App\Listeners\Dashboard\RegisterResetUserPasswordActivity;
use App\Listeners\Dashboard\RegisterUserAttemptedToDashboardLogin;
use App\Listeners\Dashboard\ResendVerificationNotificationIfEditEmail;
use App\Listeners\Dashboard\SendUserNotificationAboutTheirAccount;
use App\Listeners\Dashboard\SendVerificationNotificationAfterLoggen;
use App\Listeners\Dashboard\SetDefaultRoleForUsersDeletedRole;
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
            SendVerificationNotificationAfterLoggen::class
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
        ],
        AfterEditUserEvent::class => [
            ResendVerificationNotificationIfEditEmail::class,
            ClearUserFiles::class,
            RegisterEditUserActivity::class
        ],
        AfterCreateUserEvent::class => [
            ResendVerificationNotificationIfEditEmail::class,
            SendUserNotificationAboutTheirAccount::class
        ],
        AfterRemoveUserEvent::class => [
            ClearUserFiles::class,
        ],
        AfterPersonalOptionsEdit::class => [
            RegisterPersonalOptionsEditActivity::class
        ],
        AfterChangeMyProfilePassword::class => [
            RegisterChangeMyProfilePasswordActivity::class
        ],
        AfterDeleteRoleEvent::class => [
            SetDefaultRoleForUsersDeletedRole::class
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
