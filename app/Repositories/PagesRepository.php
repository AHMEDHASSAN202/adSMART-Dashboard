<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;



use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PagesRepository
{
    public function getPages($type=null)
    {
        $cacheKey = 'pages:' . app()->getLocale();

        $pages = Cache::rememberForever($cacheKey, function () {
            return Page::pageDescription()->pageType()->latest()->get();
        });

        if ($type) {
            $pages = $pages->where('type_slug', $type);
        }

        return $pages;
    }

    private function clearCache()
    {
        return Cache::forget('pages:' . app()->getLocale());
    }
}
