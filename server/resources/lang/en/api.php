<?php

return [

    'errors' => [
        'login' => 'Invalid username or password.',
        'upload' => 'Error uploading file.',

        'validation' => [
            'required' => 'The field is required.',
            'filled' => 'The field cannot be empty.',
            'array' => 'The field must be an array.',
            'boolean' => 'The field must be boolean.',
            'email' => 'The email format is invalid.',
            'file' => 'The field must be a file.',
            'image' => 'The image format is invalid.',
            'numeric' => 'The field must be numeric.',
            'password' => 'The password is invalid.',
            'string' => 'The field must be a string.',
            'mimes' => 'The allowed file types: :values.',
            'email.unique' => 'The user with such email is already exists.',
            'username.unique' => 'The user with such name is already exists.',
            'passwordConf.required' => 'The password is not confirmed.',
            'passwordConf.same' => 'Both password fields must match.',
            'newPasswordConf.required' => 'The new password is not confirmed.',
            'newPasswordConf.same' => 'Both password fields must match.',

            'min' => [
                'numeric' => 'The filed value cannot be less than :min.',
                'string' => 'The field cannot contain less than :min characters.',
            ],

            'max' => [
                'file' => 'The file size cannot be greater than :max kilobytes.',
                'numeric' => 'The filed value cannot be greater than :max.',
                'string' => 'The field cannot contain more than :max characters.',
            ],
        ],
    ],

];
