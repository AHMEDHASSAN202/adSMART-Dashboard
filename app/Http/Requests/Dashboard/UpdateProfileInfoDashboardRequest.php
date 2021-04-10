<?php

namespace App\Http\Requests\Dashboard;

use App\Repositories\AuthRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileInfoDashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $me = app(AuthRepository::class)->getAdmin();
        return [
            'user_avatar'   => 'nullable|image|max:1024',
            'user_name'     => 'required|min:3|max:20',
            'user_email'    => ['required', 'email', Rule::unique('users', 'user_email')->ignore($me->user_id, 'user_id')]
        ];
    }

    public function attributes()
    {
        return [
            'user_avatar'   => _e('avatar'),
            'user_email'    => _e('email'),
            'user_name'     => _e('name')
        ];
    }

    public function messages()
    {
        return [
            'required'      => _e('validation::required'),
            'image'         => _e('validation::image'),
            'max.file'      => _e('validation::max.file'),
            'min.string'    => _e('validation::min.string'),
            'max.numeric'   => _e('validation::max.numeric'),
            'email'         => _e('validation::email'),
            'unique'        => _e('validation::unique'),
        ];
    }
}
