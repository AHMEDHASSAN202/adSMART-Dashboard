<?php

namespace App\Http\Requests\Dashboard;

use App\Classes\Utilities;
use Illuminate\Foundation\Http\FormRequest;

class CreateNewRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $languages = Utilities::getLanguages();
        $rules = [];
        foreach ($languages as $language) {
            $rules['role_name.' . $language->language_code] = 'required|min:3|max:200';
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];

        $languages = Utilities::getLanguages();

        foreach ($languages as $language) {
            $attr['role_name.'.$language->language_code] = _e('name', $language->language_code);
        }

        return $attr;
    }

    public function messages()
    {
        $languages = Utilities::getLanguages();
        $translatedKeys = [
            'required' => 'required',
            'min'      => 'min.numeric',
            'max'      => 'max.numeric'
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
