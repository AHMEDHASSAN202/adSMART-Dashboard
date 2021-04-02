<?php

namespace App\Events\Dashboard;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BeforeUserLoginToDashboardEvent
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
