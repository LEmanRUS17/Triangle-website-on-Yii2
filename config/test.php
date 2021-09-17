<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test-local.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'language' => 'en-US',
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'db' => [
            'dsn' => '',
        ],
    ],
];
