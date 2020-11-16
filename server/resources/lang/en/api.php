<?php

return [

    'errors' => [
        'auth' => [
            'user' => 'The user with such email is not exists.',
            'password' => 'The password is invalid.',
        ],

        'upload' => 'Error uploading file.',

        'validation' => [
            'required' => 'The field is required.',
            'filled' => 'The field cannot be empty.',
            'array' => 'The field must be an array.',
            'boolean' => 'The field must be a boolean value.',
            'email' => 'The email format is invalid.',
            'file' => 'The field must be a file.',
            'image' => 'The image format is invalid.',
            'password' => 'The password is invalid.',
            'string' => 'The field must be a string.',
            'mimes' => 'The allowed file types: :values.',
            'email.unique' => 'The user with such email is already exists.',
            'password.confirmed' => 'The password is not confirmed.',
            'new_password.confirmed' => 'The new password is not confirmed.',

            'min' => [
                'numeric' => 'The field value cannot be less than :min.',
                'string' => 'The field cannot contain less than :min characters.',
            ],

            'max' => [
                'file' => 'The file size cannot be greater than :max kilobytes.',
                'numeric' => 'The field value cannot be greater than :min.',
                'string' => 'The field cannot contain more than :max characters.',
            ],
        ],
    ],

];
