<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Models\Option;

class SettingsRepository
{
    public function clearCache()
    {
        try {
            Cache::flush();
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
        } catch (\ErrorException $e) {
            return false;
        }

        return true;
    }
}
