<?php

return [

    'errors' => [
        'validation' => 'Указанные данные неверны.',

        'token' => [
            'user' => 'Пользователь с таким email не найден.',
            'password' => 'Неверный пароль.',
        ],
    ],

    'validation' => [
        'email.required' => 'Не указан email.',
        'email.email' => 'Неверный формат email.',
        'email.max' => 'Email не может содержать более :max символов.',
        'email.unique' => 'Пользователь с таким email уже существует.',
        'name.required' => 'Не указано имя.',
        'name.string' => 'Имя не является строкой.',
        'name:max' => 'Имя не может содержать более :max символов.',
        'password.required' => 'Не указан пароль.',
        'password.string' => 'Пароль не является строкой.',
        'password.min' => 'Пароль не может содержать менее :min символов.',
        'password.confirmed' => 'Пароль не подтвержден.',
        'cur_password.required_with' => 'Не указан текущий пароль.',
        'new_password.string' => 'Новый пароль не является строкой.',
        'new_password.min' => 'Новый пароль не может содержать менее :min символов.',
        'new_password.confirmed' => 'Новый пароль не подтвержден.',
    ],

];
