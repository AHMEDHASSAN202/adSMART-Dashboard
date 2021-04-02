<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


use Illuminate\Support\Facades\Cache;
use App\Models\Option;

class OptionsObserver
{
    public function saved(Option $option)
    {
        Cache::forget('options');
    }

    public function created($option)
    {
        Cache::forget('options');
    }

    public function deleted($option)
    {
        Cache::forget('options');
    }
}
