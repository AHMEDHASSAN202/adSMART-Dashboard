<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingsGeneralDataUpdatedRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $languages = getLanguages();

        $rules['default_lang'] = 'required|exists:languages,language_code';
        foreach ($languages as $language) {
            $rules['site_name:' . $language->language_code] = 'required|max:200';
            $rules['description:' . $language->language_code] = 'required|max:1000';
            $rules['keywords:' . $language->language_code] = 'required|max:1000';
            $rules['logo:' . $language->language_code] = 'nullable|image|max:1024';
        }

        return $rules;
    }

    public function attributes()
    {
        $languages = getLanguages();

        $attributes['default_lang'] = _e('default_lang');
        foreach ($languages as $language) {
            $attributes['site_name:' . $language->language_code] = _e('site_name');
            $attributes['description:' . $language->language_code] = _e('description');
            $attributes['keywords:' . $language->language_code] = _e('keywords');
            $attributes['logo:' . $language->language_code] = _e('logo');
        }

        return $attributes;
    }

    public function messages()
    {
        return [
            'required'      => _e('validation::required'),
            'image'         => _e('validation::image'),
            'max.file'      => _e('validation::max.file'),
            'min.string'    => _e('validation::min.string'),
            'exists'        => _e('validation::exists'),
        ];
    }
}
