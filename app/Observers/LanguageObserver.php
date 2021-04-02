<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
    public function saved($lang)
    {
        Cache::forget('languages');
    }

    public function created($lang)
    {
        Cache::forget('languages');
    }

    public function deleted($lang)
    {
        Cache::forget('languages');
    }
}
