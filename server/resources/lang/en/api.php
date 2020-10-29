<?php

return [

    'errors' => [
        'auth' => [
            'user' => 'The user with such email is not exists.',
            'password' => 'The password is invalid.',
        ],

        'validation' => [
            'required' => 'The field is required.',
            'required_with' => 'The field is required.',
            'email' => 'The email format is invalid.',
            'file' => 'The field must be a file.',
            'image' => 'The field must be an image.',
            'password' => 'The password is invalid.',
            'string' => 'The field must be a string.',
            'timezone' => 'The timezone format is invalid.',
            'in' => 'The field value is invalid.',
            'email.unique' => 'The user with such email is already exists.',
            'password.confirmed' => 'The password is not confirmed.',

            'min' => [
                'string' => 'The field cannot contain less than :min characters.',
            ],

            'max' => [
                'file' => 'The file size cannot be greater than :max kilobytes.',
                'string' => 'The field cannot contain more than :max characters.',
            ],
        ],
    ],

];
