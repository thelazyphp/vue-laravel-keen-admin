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
            'email' => [
                'bail',
                'required',
                'email',
                'exists:users',
            ],

            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        if (App::isLocale('en')) {
            return [
                'email.required' => 'The E-Mail is required.',
                'email.email' => 'The E-Mail format is invalid.',
                'email.exists' => 'The user with such E-Mail does not exist.',
                'password.required' => 'The password is required.',
                'password.string' => 'The password must be a string.',
            ];
        }

        if (App::isLocale('ru')) {
            return [
                'email.required' => 'Введите E-Mail.',
                'email.email' => 'Неверный формат E-Mail.',
                'email.exists' => 'Пользователя с таким E-Mail не существует.',
                'password.required' => 'Введите пароль.',
                'password.string' => 'Пароль не является строкой.',
            ];
        }
    }
}
