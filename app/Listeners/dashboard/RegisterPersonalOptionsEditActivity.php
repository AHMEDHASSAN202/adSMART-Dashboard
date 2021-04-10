<?php

namespace App\Listeners\Dashboard;

use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterPersonalOptionsEditActivity
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
            'auth_id'        => $event->profile->user_id,
            'user_activity'  => 'update_personal_options',
            'user_activity_desc'  => ActivityLog::getActivityDescription('update_personal_options'),
        ], true);
    }
}
