<?php

namespace App\Listeners\Dashboard;

use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterChangeMyProfilePasswordActivity
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
        ActivityLog::createWithAgent([
            'auth_id'        => $event->me->user_id,
            'user_activity'  => 'change_your_password',
        ]);
    }
}
