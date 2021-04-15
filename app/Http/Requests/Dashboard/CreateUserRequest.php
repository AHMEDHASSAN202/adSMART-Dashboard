<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_avatar'       => 'nullable|image|max:1024',
            'user_name'         => 'required|min:3|max:20',
            'user_email'        => 'required|email|unique:users,user_email',
            'user_password'     => 'required|min:6|max:30',
            'user_phone'        => 'nullable|digits:10|unique:profiles,user_phone',
            'user_address'      => 'nullable|string|max:50',
            'fk_role_id'        => 'required|exists:roles,role_id',
            'fk_user_country'   => 'nullable|exists:flags,flag_id',
            'send_user_notification' => 'required|boolean',
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
            'send_user_notification'    => _e('send_user_notification_about_their_account'),
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
            'boolean'       => _e('validation::boolean'),
            'digits'        => _e('validation::digits'),
        ];
    }
}
