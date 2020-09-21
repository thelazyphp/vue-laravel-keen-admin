<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

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
            'image_id' => 'nullable|integer|exists:images,id',
            'role' => ['required', 'string', Rule::in(User::fillableRoles())],
            'f_name' => 'required|string|max:191|alpha',
            'm_name' => 'nullable|string|max:191|alpha',
            'l_name' => 'required|string|max:191|alpha',
            'email' => 'nullable|string|max:191|email',
            'phone' => 'nullable|string|max:191|regex:/\+\d{1,3}\d{1,12}/',
            'username' => 'required|string|max:191|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
}
