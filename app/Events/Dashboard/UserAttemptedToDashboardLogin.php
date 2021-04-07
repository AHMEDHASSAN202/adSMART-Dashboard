<?php

namespace App\Events\Dashboard;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAttemptedToDashboardLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
