<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


use App\Events\Dashboard\AfterDeleteRoleEvent;

class RoleObserver
{
    public function deleted($role)
    {
        event(new AfterDeleteRoleEvent($role));
    }
}
