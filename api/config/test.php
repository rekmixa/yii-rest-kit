<?php
return [
    'id' => 'app-api-tests',
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
        'db' => [
            'dsn' => env('DB_TEST_DSN'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASSWORD'),
        ],
    ],
];
