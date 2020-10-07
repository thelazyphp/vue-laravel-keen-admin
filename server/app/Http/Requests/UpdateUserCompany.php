<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;

class UpdateUserCompany extends FormRequest
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
            'name'        => ['required', 'string', 'max:191', $this->user->company ? Rule::unique('companies')->ignore($this->user()->company) : 'unique:companies'],
            'website'     => 'nullable|string|max:191|url',
            'email'       => 'nullable|string|max:191|email',
            'phone'       => 'nullable|string|max:191|regex:/^\+\d{1,3}\d{1,12}$/',
            'license'     => 'nullable|string|max:191',
            'address'     => 'nullable|string|max:191',
            'description' => 'nullable|string',
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
                    'name.required'      => 'Введите название.',
                    'name.string'        => 'Название не является строкой.',
                    'name.max'           => 'Название не может превышать :max символ.',
                    'name.unique'        => 'Организация с таким названием уже существует.',
                    'website.string'     => 'Ссылка на сайт не является строкой.',
                    'website.max'        => 'Ссылка на сайт не может превышать :max символ.',
                    'website.url'        => 'Ссылка на сайт не является корректным URL.',
                    'email.string'       => 'E-Mail не является строкой.',
                    'email.max'          => 'E-Mail не может превышать :max символ.',
                    'email.email'        => 'Некорректный формат E-Mail.',
                    'phone.string'       => 'Номер телефона не является строкой.',
                    'phone.max'          => 'Номер телефона не может превышать :max символ.',
                    'phone.regex'        => 'Номер телефона должен быть указан в международном формате.',
                    'license.string'     => 'Лицензия не является строкой.',
                    'license.max'        => 'Лицензия не может превышать :max символ.',
                    'address.string'     => 'Адрес не является строкой.',
                    'address.max'        => 'Адрес не может превышать :max символ.',
                    'description.string' => 'Описание не является строкой.',
                ];
            default:
                return [];
        }
    }
}
