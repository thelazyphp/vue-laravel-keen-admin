<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;

class UpdateUser extends FormRequest
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
                'string',
                'max:15',
            ],

            'email' => [
                'email',
                'max:50',
                Rule::unique('users')->ignore($this->route('user')),
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
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name cannot contain more than :max symbols.',
                'email.email' => 'The E-Mail format is invalid.',
                'email.max' => 'The E-Mail cannot contain more than :max symbols.',
                'email.unique' => 'The user with such E-Mail is already exist.',
                'timezone.timezone' => 'The timezone format is invalid.',
            ];
        }

        if (App::isLocale('ru')) {
            return [
                'name.string' => 'Имя не является строкой.',
                'name.max' => 'Имя не может содержать более :max символов.',
                'email.email' => 'Неверный формат E-Mail.',
                'email.max' => 'E-Mail не может содержать более :max символов.',
                'email.unique' => 'Пользователь с таким E-Mail уже существует.',
                'timezone.timezone' => 'Неверный формат часового пояса.',
            ];
        }
    }
}
