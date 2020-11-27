<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueryResourceCollection extends FormRequest
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
            'q' => ['string'],
            'filter' => ['array'],
            'sort' => ['array'],
            'page' => ['numeric', 'min:1'],
            'limit' => ['numeric', 'min:1', 'max:500'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return trans('api.errors.validation');
    }
}
