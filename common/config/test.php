<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'dsn' => env('DB_TEST_DSN'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASSWORD'),
        ],
    ],
];
