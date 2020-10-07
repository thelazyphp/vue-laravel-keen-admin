<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class GetCollection extends FormRequest
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
            'page'     => 'integer|min:1',
            'per_page' => 'integer|min:1',
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
            case 'en':
                return [
                    'page.integer'     => 'The page number is not an integer number.',
                    'page.min'         => 'The page number cannot be less than :min.',
                    'per_page.integer' => 'The records per page count is not an integer number.',
                    'per_page.min'     => 'The records per page count cannot be less than :min.',
                ];
            case 'ru':
                return [
                    'page.integer'     => 'Номер страницы не является целым числом.',
                    'page.min'         => 'Номер страницы не может быть меньше :min.',
                    'per_page.integer' => 'Количество записей на страницу не является целым числом.',
                    'per_page.min'     => 'Количество записей на страницу не может быть меньше :min.',
                ];
            default:
                return [];
        }
    }
}
