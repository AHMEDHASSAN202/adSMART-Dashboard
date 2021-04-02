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
}
