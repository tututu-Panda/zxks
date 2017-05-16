<?php

return [



    'multi-auth' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Sysuser::class,
            'table'  => 'sysusers'
        ],
        'user' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Home\Student::class,
            'table'  => 'students'
        ]
    ],



    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
