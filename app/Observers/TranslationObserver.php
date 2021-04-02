<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Observers;


use Illuminate\Support\Facades\Cache;

class TranslationObserver
{
    public function saved($translate)
    {
        Cache::forget('translations');
    }

    public function created($translate)
    {
        Cache::forget('translations');
    }

    public function deleted($translate)
    {
        Cache::forget('translations');
    }
}
