<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalOptionsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fk_user_country'       => 'sometimes|exists:flags,flag_id',
            'user_phone'            => 'sometimes|digits:10',
        ];
    }


    public function attributes()
    {
        return [
            'fk_user_country'   => _e('country'),
            'user_phone'        => _e('phone')
        ];
    }

    public function messages()
    {
        return [
            'exists'        => _e('validation::exists'),
            'digits'        => _e('validation::digits'),
        ];
    }
}
