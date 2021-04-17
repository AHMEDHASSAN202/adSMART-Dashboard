<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $pageId = $this->route('page_id');
        $languages = getLanguages();
        $rules = [
            'fk_type_id'        => 'required|exists:types,type_id',
            'feature_image'     => 'nullable|image|max:1024',
        ];
        foreach ($languages as $language) {
            $rules['page_title.' . $language->language_code] = 'required|min:3|max:250';
            $rules['page_slug.' . $language->language_code] = ['required', 'min:3', 'max:250', Rule::unique('pages_description', 'page_slug')->ignore($pageId, 'fk_page_id')];
            $rules['page_content.' . $language->language_code] = 'required';
        }
        return $rules;
    }

    public function attributes()
    {
        $attr = [
            'fk_type_id'            => _e('type'),
            'feature_image'         => _e('feature_image'),
        ];

        $languages = getLanguages();

        foreach ($languages as $language) {
            $attr['page_title.'.$language->language_code]   = _e('title', $language->language_code);
            $attr['page_slug.'.$language->language_code]    = _e('slug', $language->language_code);
            $attr['page_content.'.$language->language_code] = _e('content', $language->language_code);
        }

        return $attr;
    }

    public function messages()
    {
        $languages = getLanguages();
        $translatedKeys = [
            'required'      => 'required',
            'exists'        => 'exists',
            'unique'        => 'unique',
            'image'         => 'image',
            'min'           => 'min.numeric',
            'max.numeric'   => 'max.numeric',
            'max.file'      => 'max.file'
        ];
        $messages = [];
        foreach ($languages as $language) {
            foreach ($translatedKeys as $key => $validationKey) {
                $messages['*.'.$language->language_code.'.'.$key] = _e('validation::'.$validationKey, $language->language_code);
            }
        }

        return $messages;
    }
}
