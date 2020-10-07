<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class RegisterUser extends FormRequest
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
        return [
            'company_name' => 'nullable|string|max:191|unique:companies,name',
            'first_name'   => 'required|string|max:191',
            'last_name'    => 'required|string|max:191',
            'username'     => 'required|string|max:191|regex:/^[a-z][a-z0-9._\-@]*$/i|unique:users',
            'password'     => 'bail|required|string|min:8|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        switch (App::getLocale()) {
            case 'ru':
                return [
                    'company_name.string' => 'Название организации не является строкой.',
                    'company_name.max'    => 'Название организации не может превышать :max символ.',
                    'company_name.unique' => 'Организация с таким названием уже существует.',
                    'first_name.required' => 'Введите имя.',
                    'first_name.string'   => 'Имя не является строкой.',
                    'first_name.max'      => 'Имя не может превышать :max символ.',
                    'last_name.required'  => 'Введите фамилию.',
                    'last_name.string'    => 'Фамилия не является строкой.',
                    'last_name.max'       => 'Фамилия не может превышать :max символ.',
                    'username.required'   => 'Введите имя пользователя.',
                    'username.string'     => 'Имя пользователя не является строкой.',
                    'username.max'        => 'Имя пользователя не может превышать :max символ.',
                    'username.regex'      => 'Имя пользователя должно начинаться с буквы. Допустимые символы: "a-Z0-9._-@".',
                    'username.unique'     => 'Пользователь с таким именем уже существует.',
                    'password.required'   => 'Введите пароль.',
                    'password.string'     => 'Пароль не является строкой.',
                    'password.min'        => 'Пароль должен содержать не менее :min символов.',
                    'password.confirmed'  => 'Подтвердите пароль.',
                ];
            default:
                return [];
        }
    }
}
