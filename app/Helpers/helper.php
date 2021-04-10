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


function getOption($optionKey) {
    return app(\App\Repositories\OptionRepository::class)->getOption($optionKey);
}

function getOptionValue($optionKey, $default=null) {
    $option = getOption($optionKey);
    return $option ? $option->option_value : $default;
}

function deleteFile($file, $disk='public') {
    return \Illuminate\Support\Facades\Storage::disk($disk)->delete($file);
}
