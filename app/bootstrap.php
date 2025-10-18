<?php
declare(strict_types=1);

// Error reporting for development; adjust in config for production
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Load config
$configFile = BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    echo 'Configuration file missing. Please create config/config.php.';
    exit;
}
$config = require $configFile;

// Simple autoloader
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Core' => APP_PATH . DIRECTORY_SEPARATOR . 'Core',
        'Controllers' => APP_PATH . DIRECTORY_SEPARATOR . 'Controllers',
        'Models' => APP_PATH . DIRECTORY_SEPARATOR . 'Models',
        'Helpers' => APP_PATH . DIRECTORY_SEPARATOR . 'Helpers',
        'App' => APP_PATH,
    ];

    foreach ($prefixes as $ns => $dir) {
        $nsPrefix = $ns . '\\';
        if (str_starts_with($class, $nsPrefix)) {
            $relative = substr($class, strlen($nsPrefix));
            $path = $dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
            return;
        }
    }
});

// Start session early
Core\Session::start($config['session'] ?? []);

// Initialize Router
$router = new Core\Router();

// Load routes
require BASE_PATH . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';

// Dispatch
$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');


