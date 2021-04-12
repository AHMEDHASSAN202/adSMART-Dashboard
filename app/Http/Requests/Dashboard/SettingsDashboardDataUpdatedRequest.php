<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingsDashboardDataUpdatedRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $languages = getLanguages();

        $rules['display_must_verify_email_msg'] = 'boolean';
        $rules['users_must_verify_email'] = 'boolean';
        $rules['default_avatar'] = 'nullable|image|max:1024';

        foreach ($languages as $language) {
            $rules['dashboard_title:' . $language->language_code] = 'required|max:200';
        }

        return $rules;
    }

    public function attributes()
    {
        $languages = getLanguages();

        $attributes['display_must_verify_email_msg'] =  _e('display_must_verify_email_msg');
        $attributes['users_must_verify_email'] =  _e('users_must_verify_email');
        foreach ($languages as $language) {
            $rules['dashboard_title:' . $language->language_code] = _e('dashboard_title');
        }

        return $attributes;
    }

    public function messages()
    {
        return [
            'required'          => _e('validation::required'),
            'boolean'           => _e('validation::boolean'),
            'max.string'        => _e('validation::min.string'),
            'image'         => _e('validation::image'),
            'max.file'      => _e('validation::max.file'),
        ];
    }
}
