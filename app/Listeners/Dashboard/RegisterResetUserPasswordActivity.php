<?php

namespace App\Listeners\Dashboard;

use App\Models\ActivityLog;

class RegisterResetUserPasswordActivity
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
            'auth_id'        => $event->user->user_id,
            'user_activity'  => 'user_reset_password',
        ], true);
    }
}
