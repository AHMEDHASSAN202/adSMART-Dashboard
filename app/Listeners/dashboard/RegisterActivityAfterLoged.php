<?php

namespace App\Listeners\Dashboard;

use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterActivityAfterLoged
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
           'user_activity'  => 'dashboard_logged',
           'user_activity_desc'  => ActivityLog::getActivityDescription('dashboard_logged'),
       ], true);
    }
}
