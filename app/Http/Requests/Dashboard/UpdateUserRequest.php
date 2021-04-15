<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = $this->route('user');

        return [
            'user_avatar'       => 'nullable|image|max:1024',
            'user_name'         => 'required|min:3|max:20',
            'user_email'        => ['required', 'email', Rule::unique('users', 'user_email')->ignore($user->user_id, 'user_id')],
            'user_password'     => 'nullable|min:6|max:30',
            'user_phone'        => ['nullable', 'digits:10', Rule::unique('profiles', 'user_phone')->ignore($user->user_id, 'fk_user_id')],
            'user_address'      => 'nullable|string|max:50',
            'fk_role_id'        => 'required|exists:roles,role_id',
            'fk_user_country'   => 'nullable|exists:flags,flag_id',
        ];
    }

    public function attributes()
    {
        return [
            'user_avatar'               => _e('avatar'),
            'user_email'                => _e('email'),
            'user_name'                 => _e('name'),
            'user_password'             => _e('password'),
            'user_phone'                => _e('phone'),
            'user_address'              => _e('address'),
            'fk_role_id'                => _e('role'),
            'fk_user_country'           => _e('country'),
        ];
    }

    public function messages()
    {
        return [
            'required'      => _e('validation::required'),
            'image'         => _e('validation::image'),
            'max.file'      => _e('validation::max.file'),
            'min.string'    => _e('validation::min.string'),
            'max.string'    => _e('validation::max.string'),
            'max.numeric'   => _e('validation::max.numeric'),
            'email'         => _e('validation::email'),
            'unique'        => _e('validation::unique'),
            'exists'        => _e('validation::exists'),
            'digits'        => _e('validation::digits'),
        ];
    }
}
