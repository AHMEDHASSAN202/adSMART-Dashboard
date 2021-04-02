<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


use Illuminate\Support\Facades\Cache;

class VisitorObserver
{
    public function saved($info)
    {
        Cache::forget('visitor_' . $info->ip_address);
    }

    public function created($info)
    {
        Cache::forget('visitor_' . $info->ip_address);
    }

    public function deleted($info)
    {
        Cache::forget('visitor_' . $info->ip_address);
    }
}
