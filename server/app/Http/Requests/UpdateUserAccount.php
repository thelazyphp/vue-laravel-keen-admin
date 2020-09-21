<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserAccount extends FormRequest
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
            'username' => ['string', 'max:191', Rule::unique('users')->ignore($this->user())],
            'cur_password' => 'required_with:new_password|password',
            'new_password' => 'string|min:8|confirmed',
        ];
    }
}
