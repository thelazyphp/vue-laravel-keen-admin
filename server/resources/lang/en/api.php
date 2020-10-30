<?php

return [

    'errors' => [
        'auth' => [
            'user' => 'The user with such email is not exists.',
            'password' => 'The password is invalid.',
        ],

        'validation' => [
            'required' => 'The field is required.',
            'email' => 'The email format is invalid.',
            'password' => 'The password is invalid.',
            'string' => 'The field must be a string.',
            'email.unique' => 'The user with such email is already exists.',
            'password.confirmed' => 'The password is not confirmed.',
            'new_password.confirmed' => 'The new password is not confirmed.',

            'min' => [
                'string' => 'The field cannot contain less than :min characters.',
            ],

            'max' => [
                'string' => 'The field cannot contain more than :max characters.',
            ],
        ],
    ],

];
