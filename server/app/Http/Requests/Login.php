<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class Login extends FormRequest
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
            'username' => 'bail|required|string|exists:users',
            'password' => 'required|string',
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
                    'username.required' => 'Введите имя пользователя.',
                    'username.string'   => 'Имя пользователя не является строкой.',
                    'username.exists'   => 'Пользователь с таким именем не найден.',
                    'password.required' => 'Введите пароль.',
                    'password.string'   => 'Пароль не является строкой.',
                ];
            default:
                return [];
        }
    }
}
