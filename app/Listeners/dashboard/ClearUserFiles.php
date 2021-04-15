<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\AfterEditUserEvent;
use App\Events\Dashboard\AfterRemoveUserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearUserFiles
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
        if (!$event->user->user_avatar) return;

        //when user edit files
        if ($event instanceof AfterEditUserEvent) {
            if ($event->user->wasChanged('user_avatar')) {
                deleteFile($event->user->getOriginal('user_avatar'));
            }
            return;
        }
        //when user removed
        if ($event instanceof AfterRemoveUserEvent) {
            deleteFile($event->user->getOriginal('user_avatar'));
        }
    }
}
