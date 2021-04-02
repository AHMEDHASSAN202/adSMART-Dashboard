<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateNewLanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_name' => 'required|min:2|max:20',
            'language_code' => ['required', Rule::unique('languages', 'language_code'), 'min:2', 'max:20'],
            'language_direction' => ['required', Rule::in('rtl', 'ltr')],
            'language_image'   => 'required|exists:flags,flag_svg',
            'language_display_front'   => 'required|boolean'
        ];
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
        return [
            'language_name' => _e('name'),
            'language_code' => _e('code'),
            'language_direction' => _e('direction'),
            'language_image'    => _e('image')
        ];
    }

    public function messages()
    {
        return [
            'language_name.required' => _e('validation::required'),
            'language_code.required' => _e('validation::required'),
            'language_code.unique' => _e('validation::unique'),
            'language_direction.required' => _e('validation::required'),
            'language_image.exists' => _e('validation::exists'),
        ];
    }

}
