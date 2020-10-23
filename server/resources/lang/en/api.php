<?php

return [

    'errors' => [
        'validation' => 'The given data was invalid.',

        'token' => [
            'user' => 'The user with such email is not found.',
            'password' => 'Invalid password.',
        ],
    ],

    'validation' => [
        'email.required' => 'The email is required.',
        'email.email' => 'The email format is invalid.',
        'email.max' => 'The email cannot contain more than :max characters.',
        'email.unique' => 'The user with such email is already exists.',
        'name.required' => 'The name is required.',
        'name.string' => 'The name must be a string.',
        'name:max' => 'The name cannot contain more than :max characters.',
        'password.required' => 'The password is required.',
        'password.string' => 'The password must be a string.',
        'password.min' => 'The password cannot contain less than :min characters.',
        'password.confirmed' => 'The password is not confirmed.',
        'cur_password.required_with' => 'The current password is required.',
        'new_password.string' => 'The new password must be a string.',
        'new_password.min' => 'The new password cannot contain less than :min characters.',
        'new_password.confirmed' => 'The new password is not confirmed.',
    ],

];
