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
            'username'     => ['string', 'max:191', 'regex:/^[a-z][a-z0-9._\-@]*$/i', Rule::unique('users')->ignore($this->user())],
            'cur_password' => 'required_with:new_password|string|password',
            'new_password' => 'string|min:8|confirmed',
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
                    'username.string'            => 'Имя пользователя не является строкой.',
                    'username.max'               => 'Имя пользователя не может превышать :max символ.',
                    'username.regex'             => 'Имя пользователя должно начинаться с буквы. Допустимые символы: "a-Z0-9._-@".',
                    'username.unique'            => 'Пользователь с таким именем уже существует.',
                    'cur_password.required_with' => 'Введите текущий пароль.',
                    'cur_password.string'        => 'Текущий пароль не является строкой.',
                    'cur_password.password'      => 'Введен неверный текущий пароль.',
                    'new_password.string'        => 'Новый пароль не является строкой.',
                    'new_password.min'           => 'Новый пароль должен содержать не менее :min символов.',
                    'new_password.confirmed'     => 'Подтвердите пароль.',
                ];
            default:
                return [];
        }
    }
}
