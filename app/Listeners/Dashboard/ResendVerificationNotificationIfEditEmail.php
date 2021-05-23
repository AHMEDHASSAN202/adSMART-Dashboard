<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\AfterEditUserEvent;
use App\Repositories\AuthRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResendVerificationNotificationIfEditEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (!getOptionValue('users_must_verify_email')) return;
        if (!$event->user->wasChanged('user_email') && $event instanceof AfterEditUserEvent) return;
        app(AuthRepository::class)->sendVerifyEmail($event->user);
    }
}
