<?php

namespace App\Listeners\Dashboard;

use App\Mail\Dashboard\UserNotificationAboutTheirAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserNotificationAboutTheirAccount
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
        if (request()->send_user_notification != true) return;

        //send mail
        Mail::to($event->user->user_email)->send(new UserNotificationAboutTheirAccount($event->user));
    }
}
