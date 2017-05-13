<?php

return [



    'multi-auth' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Sysuser::class,
            'table'  => 'sysusers'
        ],
        'student' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Student::class,
            'table'  => 'students'
        ]
    ],



    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
