<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class UpdateUserProfile extends FormRequest
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
            ];
        }

        if (App::isLocale('ru')) {
            return [
                'name.string' => 'Имя не является строкой.',
                'name.max' => 'Имя не может содержать более :max символов.',
            ];
        }
    }
}
