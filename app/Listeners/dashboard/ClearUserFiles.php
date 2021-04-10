<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\AfterEditUserEvent;
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
        //when user edit files
        if ($event instanceof AfterEditUserEvent) {
            if ($event->user->wasChanged('user_avatar')) {
                deleteFile($event->user->getOriginal('user_avatar'));
            }
            return;
        }
        //when user removed
    }
}
