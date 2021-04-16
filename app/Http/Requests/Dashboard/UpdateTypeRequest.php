<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $typeId = $this->route('type_id');

        return [
            'type_slug'         => ['required', Rule::unique('types', 'type_slug')->ignore($typeId, 'type_id')],
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
