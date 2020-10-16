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
            'name' => [
                'required',
                'string',
                'max:15',
            ],

            'email' => [
                'required',
                'email',
                'max:50',
                'unique:users',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
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
                'name.required' => 'The name is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name cannot contain more than :max symbols.',
                'email.required' => 'The E-Mail is required.',
                'email.email' => 'The E-Mail format is invalid.',
                'email.max' => 'The E-Mail cannot contain more than :max symbols.',
                'email.unique' => 'The user with such E-Mail is already exist.',
                'password.required' => 'The password is required.',
                'password.string' => 'The password must be a string.',
                'password.min' => 'The password cannot contain less than :min symbols.',
                'password.confirmed' => 'Confirm the password.',
            ];
        }

        if (App::isLocale('ru')) {
            return [
                'name.required' => 'Введите имя.',
                'name.string' => 'Имя не является строкой.',
                'name.max' => 'Имя не может содержать более :max символов.',
                'email.required' => 'Введите E-Mail.',
                'email.email' => 'Неверный формат E-Mail.',
                'email.max' => 'E-Mail не может содержать более :max символов.',
                'email.unique' => 'Пользователь с таким E-Mail уже существует.',
                'password.required' => 'Введите пароль.',
                'password.string' => 'Пароль не является строкой.',
                'password.min' => 'Пароль не может содержать менее :min символов.',
                'password.confirmed' => 'Подтвердите пароль.',
            ];
        }
    }
}
