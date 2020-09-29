<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
            'company_name' => 'nullable|string|max:191|unique:companies,name',
            'first_name' => 'required|string|max:191|alpha',
            'last_name' => 'required|string|max:191|alpha',
            'username' => 'required|string|max:191|regex:/^[a-z][a-z0-9_]*$/i|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
