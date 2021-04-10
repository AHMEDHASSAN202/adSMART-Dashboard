<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChangeMyPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password'      => 'required',
            'password'              => 'required|min:6|max:50|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'current_password'   => _e('current_password'),
            'password'           => _e('password')
        ];
    }

    public function messages()
    {
        return [
            'required'        => _e('validation::required'),
            'min.string'      => _e('"validation::min.string'),
            'max.string'      => _e('"validation::max.string'),
            'confirmed'       => _e('validation::confirmed'),
        ];
    }
}
