<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

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
            'image_id' => 'nullable|integer|exists:images,id',
            'role' => ['string', Rule::in(User::fillableRoles())],
            'first_name' => 'string|max:191|alpha',
            'last_name' => 'string|max:191|alpha',
            'email' => 'nullable|string|max:191|email',
            'contact_phone' => 'nullable|string|max:191|regex:/^\+\d{1,3}\d{1,12}$/',
            'username' => ['string', 'max:191', 'regex:/^[a-z][a-z0-9_]*$/i', Rule::unique('users')->ignore($this->route('user'))],
            'password' => 'string|min:8',
        ];
    }
}
