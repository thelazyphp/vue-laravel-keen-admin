<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class StoreUser extends FormRequest
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
            'image_id'      => 'nullable|integer|exists:images,id',
            'first_name'    => 'required|string|max:191',
            'last_name'     => 'required|string|max:191',
            'email'         => 'nullable|string|max:191|email',
            'contact_phone' => 'nullable|string|max:191|regex:/^\+\d{1,3}\d{1,12}$/',
            'username'      => 'required|string|max:191|regex:/^[a-z][a-z0-9._\-@]*$/i|unique:users',
            'password'      => 'required|string|min:8',
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
                    'image_id.integer'     => 'ID изображения не является целым числом.',
                    'image_id.exists'      => 'Изображение с таким ID не найдено.',
                    'first_name.required'  => 'Введите имя.',
                    'first_name.string'    => 'Имя не является строкой.',
                    'first_name.max'       => 'Имя не может превышать :max символ.',
                    'last_name.required'   => 'Введите фамилию.',
                    'last_name.string'     => 'Фамилия не является строкой.',
                    'last_name.max'        => 'Фамилия не может превышать :max символ.',
                    'email.string'         => 'E-Mail не является строкой.',
                    'email.max'            => 'E-Mail не может превышать :max символ.',
                    'email.email'          => 'Некорректный формат E-Mail.',
                    'contact_phone.string' => 'Контактный телефон не является строкой.',
                    'contact_phone.max'    => 'Контактный телефон не может превышать :max символ.',
                    'contact_phone.regex'  => 'Контактный телефон должен быть указан в международном формате.',
                    'username.required'    => 'Введите имя пользователя.',
                    'username.string'      => 'Имя пользователя не является строкой.',
                    'username.max'         => 'Имя пользователя не может превышать :max символ.',
                    'username.regex'       => 'Имя пользователя должно начинаться с буквы. Допустимые символы: "a-Z0-9._-@".',
                    'username.unique'      => 'Пользователь с таким именем уже существует.',
                    'password.required'    => 'Введите пароль.',
                    'password.string'      => 'Пароль не является строкой.',
                    'password.min'         => 'Пароль должен содержать не менее :min символов.',
                ];
            default:
                return [];
        }
    }
}
