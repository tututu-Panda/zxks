<?php

return [



    'multi-auth' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Admin::class,
            'table'  => 'admins'
        ],
        'user' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
            'table'  => 'users'
        ]
    ],



    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
