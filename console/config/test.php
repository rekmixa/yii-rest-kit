<?php
return [
    'components' => [
        'db' => [
            'dsn' => env('DB_TEST_DSN'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASSWORD'),
        ],
    ],
];
