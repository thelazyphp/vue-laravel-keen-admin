<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
