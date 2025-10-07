<?php
declare(strict_types=1);

return [
    'app' => [
        'name' => 'Smart Student Monitoring',
        'env' => 'development',
        'base_url' => '/',
        'timezone' => 'Asia/Manila',
        'display_errors' => true,
    ],
    'database' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'database' => 'student_monitoring',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ],
    'session' => [
        'name' => 'ssm_session',
        'cookie_lifetime' => 60 * 60 * 2,
        'cookie_secure' => false,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ],
];


