<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $languages = getLanguages();
        $rules = [
            'parent_id'        => 'nullable|exists:categories,category_id',
            'image'            => 'nullable|image|max:1024',
        ];
        foreach ($languages as $language) {
            $rules['category_name.' . $language->language_code] = 'required|min:3|max:250';
            $rules['category_slug.' . $language->language_code] = 'required|min:3|max:250|unique:categories_description,category_slug';
            $rules['category_description.' . $language->language_code] = 'required';
        }
        return $rules;
    }

    public function attributes()
    {
        $attr = [
            'parent_id'             => _e('parent', 'category'),
            'image'                 => _e('image'),
        ];

        $languages = getLanguages();

        foreach ($languages as $language) {
            $attr['category_name.'.$language->language_code]        = _e('name', $language->language_code);
            $attr['category_slug.'.$language->language_code]        = _e('slug', $language->language_code);
            $attr['category_description.'.$language->language_code] = _e('description', $language->language_code);
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
