<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingsContactUsDataUpdatedRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contact_address'         =>  'nullable',
            'contact_email'           =>  'nullable|email',
            'contact_phone'           =>  'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'email'     => _e('email')
        ];
    }

    public function messages()
    {
        return [
            'email'      => _e('validation::email')
        ];
    }
}
