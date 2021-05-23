<?php

namespace App\Listeners\Dashboard;

use App\Repositories\UsersRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetDefaultRoleForUsersDeletedRole
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
        app(UsersRepository::class)->setDefaultRoleForDeleteRole();
    }
}
