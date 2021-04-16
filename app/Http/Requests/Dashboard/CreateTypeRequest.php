<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_key'          => 'required|min:2|max:50',
            'type_slug'         => 'required|unique:types,type_slug',
            'type_value'        => 'required|min:2|max:50',
        ];
    }

    public function attributes()
    {
        return [
            'type_value'               => _e('name'),
            'type_slug'                => _e('slug')
        ];
    }

    public function messages()
    {
        return [
            'required'      => _e('validation::required'),
            'min.string'    => _e('validation::min.string'),
            'max.string'    => _e('validation::max.string'),
            'unique'        => _e('validation::unique'),
        ];
    }
}
