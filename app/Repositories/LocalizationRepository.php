<?php
/**
 * Created by PhpStorm.
 * User: AQSSA
 */

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Support\Facades\DB;

class LocalizationRepository
{
    public function getLanguages(Request $request = null)
    {
        return Cache::rememberForever('languages', function () {
            return Language::all();
        });
    }

    public function getTranslations(Request $request = null)
    {
        return Cache::rememberForever('translations', function () {
            $translationsCollection = Translation::all();
            $translations = $translationsCollection->mapToGroups(function ($item) {
                return [
                    $item['translation_key'] => [
                        $item['translation_lang'] => $item['translation_value'],
                        'translation_id_'.$item['translation_lang'] => $item['translation_id'],
                    ]
                ];
            })->map(function ($trans) {
                $langWithTranslate = [];
                foreach ($trans as $t) {
                    foreach ($t as $key => $translateWord) {
                        $langWithTranslate[$key] = $translateWord;
                    }
                }

                return $langWithTranslate;
            });
            return $translations;
        });
    }

    public function updateTranslate($data)
    {
        $languages = $this->getLanguages();
        foreach ($data as $key => $values) {
            foreach ($languages as $language) {
                DB::table(Translation::getTableName())
                    ->where('translation_id', $values['translation_id_'.$language->language_code])
                    ->update(['translation_value' => $values[$language->language_code]]);
            }
        }
        Cache::forget('translations');
    }

    public function getTranslate($lang, $key)
    {
        $translations = $this->getTranslations();
        $word = '';

        if (!is_array($key)) {
            $key = [$key];
        }

        foreach ($key as $k) {
            $word .= @$translations[$k][$lang] . ' ';
        }

        return $word;
    }

    public function getLanguage($code)
    {
        if (!$code) return null;

        $languages = $this->getLanguages();

        $language = $languages->first(function ($lang) use ($code) {
            return strtolower($lang->language_code) == strtolower($code);
        });

        $language->language_image_path = _flagSvg($language->language_image);

        return $language;
    }

    public function getLanguageById($languageId)
    {
        if (!$languageId) return null;

        $languages = $this->getLanguages();

        $language = $languages->first(function ($lang) use ($languageId) {
            return $lang->language_id == $languageId;
        });

        $language->language_image_path = _flagSvg($language->language_image);

        return $language;
    }


    public function addNewLanguage($createLanguageRequest)
    {
        $data = $createLanguageRequest->all();

        $newLanguage = Language::create($data);

        return $newLanguage;
    }

    public function removeLanguage($languageIds)
    {
        if (!is_array($languageIds)) $languageIds = [$languageIds];

        $languagesWantsDelete = Language::whereIn('language_id', $languageIds)->get(['language_id', 'language_code']);

        $languagesWantsDelete->map(function ($language) {

            $languageCode = $language->language_code;

            if ($languageCode == app()->getLocale()) {
                app(VisitorsInformationRepository::class)->removeVisitorData();
            }

            $language->delete();

            $this->removeLanguageTranslations($languageCode);

        });

        return true;
    }

    private function removeLanguageTranslations($languageCode)
    {
        return Translation::where('translation_lang', $languageCode)->delete();
    }

    public function updateLanguage(Language $language, $updateLanguageRequest)
    {
        $language->language_name = $updateLanguageRequest->language_name;
        $language->language_code = $updateLanguageRequest->language_code;
        $language->language_direction = $updateLanguageRequest->language_direction;
        $language->language_display_front = (int)!empty($updateLanguageRequest->language_display_front);
        $language->language_image = $updateLanguageRequest->language_image;

        $language->save();

        return $language;
    }

    public function toggleDisplayFront(Language $language)
    {
        $language->language_display_front = !(boolean)$language->language_display_front;
        $language->save();

        return $language;
    }

    public function addNewTranslationsLanguage($languageCode)
    {
        $translationsArray = [];

        $keys = DB::table(Translation::getTableName())->select('translation_key', 'translation_value')->where('translation_lang', getOptionValue('default_lang'))->get();

        $keys->map(function ($key) use (&$translationsArray, $languageCode) {
            $translationsArray[] = [
                'translation_key'   => $key->translation_key,
                'translation_value' => $key->translation_value,
                'translation_lang'  => $languageCode
            ];
        });

        DB::table(Translation::getTableName())->insert($translationsArray);
    }

    public function updateTranslationsLanguageCode($oldCode, $newCode)
    {
        return DB::table(Translation::getTableName())->where('translation_lang', $oldCode)->update(['translation_lang' => $newCode]);
    }

    public function deleteTranslationsLanguage($languageCode)
    {
        return DB::table(Translation::getTableName())->where('translation_lang', $languageCode)->delete();
    }
}
