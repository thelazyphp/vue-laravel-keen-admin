<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class GetDatatableCollection extends FormRequest
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
            'query'              => 'array',
            'sort'               => 'array',
            'sort.sort'          => 'string|in:asc,desc',
            'sort.field'         => 'string',
            'pagination'         => 'array',
            'pagination.page'    => 'integer|min:1',
            'pagination.perpage' => 'integer|min:1',
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
                    'query.array'                => 'Параметр не является массивом.',
                    'sort.array'                 => 'Параметр не является массивом.',
                    'sort.sort.string'           => 'Параметр не является строкой.',
                    'sort.sort.in'               => 'Допустимые значения: asc, desc.',
                    'sort.field.string'          => 'Параметр не является строкой.',
                    'pagination.array'           => 'Параметр не является массивом.',
                    'pagination.page.integer'    => 'Параметр не является целым числом.',
                    'pagination.page.min'        => 'Параметр не может быть меньше :min.',
                    'pagination.perpage.integer' => 'Параметр не является целым числом.',
                    'pagination.perpage.min'     => 'Параметр не может быть меньше :min.',
                ];
            default:
                return [];
        }
    }
}
