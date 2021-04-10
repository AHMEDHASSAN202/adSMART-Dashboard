<?php

namespace App\Listeners\Dashboard;

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
        if (!$event->user->wasChanged('user_email')) {
            return;
        }
        app(AuthRepository::class)->sendVerifyEmail($event->user);
    }
}
