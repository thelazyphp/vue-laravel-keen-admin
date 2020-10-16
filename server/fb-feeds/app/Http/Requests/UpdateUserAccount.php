<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;

class UpdateUserAccount extends FormRequest
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
                'email',
                'max:50',
                Rule::unique('users')->ignore($this->route('user')),
            ],

            'cur_password' => [
                'required_with:new_password',
                'password',
            ],

            'new_password' => [
                'string',
                'min:8',
                'confirmed',
            ],

            'timezone' => [
                'timezone',
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
                'email.email' => 'The E-Mail format is invalid.',
                'email.max' => 'The E-Mail cannot contain more than :max symbols.',
                'email.unique' => 'The user with such E-Mail is already exist.',
                'cur_password.required_with' => 'The current password is required.',
                'cur_password.password' => 'The current password is incorrect.',
                'new_password.string' => 'The new password must be a string.',
                'new_password.min' => 'The new password cannot contain less than :min symbols.',
                'new_password.confirmed' => 'Confirm the new password.',
                'timezone.timezone' => 'The timezone format is invalid.',
            ];
        }

        if (App::isLocale('ru')) {
            return [
                'email.email' => 'Неверный формат E-Mail.',
                'email.max' => 'E-Mail не может содержать более :max символов.',
                'email.unique' => 'Пользователь с таким E-Mail уже существует.',
                'cur_password.required_with' => 'Введите текущий пароль.',
                'cur_password.password' => 'Введен неверный текущий пароль .',
                'new_password.string' => 'Новый пароль не является строкой.',
                'new_password.min' => 'Новый пароль не может содержать менее :min символов.',
                'new_password.confirmed' => 'Подтвердите новый пароль.',
                'timezone.timezone' => 'Неверный формат часового пояса.',
            ];
        }
    }
}
