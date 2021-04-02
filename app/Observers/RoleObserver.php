<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


class RoleObserver
{
    public function deleted($role)
    {
        //update user role with default role
    }
}
