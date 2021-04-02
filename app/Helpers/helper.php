<?php


function _e($key, $lang=null) {
    $lang = $lang ?: app()->getLocale();

    $keyword = app('App\Repositories\LocalizationRepository')->getTranslate($lang, $key);

    if (!$keyword) {
        return str_replace('_', ' ', $key);
    }

    return $keyword;
}


function _flagSvg($svg) {
    return asset('dashboard-assets/media/flags/' . $svg);
}
