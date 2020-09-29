<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['string', 'max:191', Rule::unique('companies', 'name')->ignore($this->user()->company)],
            'website' => 'nullable|string|max:191|url',
            'email' => 'nullable|string|max:191|email',
            'phone' => 'nullable|string|max:191|regex:/^\+\d{1,3}\d{1,12}$/',
            'license' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
            'description' => 'nullable|string',
        ];
    }
}
