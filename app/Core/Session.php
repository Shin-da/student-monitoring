<?php
declare(strict_types=1);

namespace Core;

class Session
{
    public static function start(array $options = []): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        if (!empty($options['name'])) {
            session_name($options['name']);
        }
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params([
            'lifetime' => $options['cookie_lifetime'] ?? $cookieParams['lifetime'],
            'path' => $cookieParams['path'],
            'domain' => $cookieParams['domain'],
            'secure' => $options['cookie_secure'] ?? false,
            'httponly' => $options['cookie_httponly'] ?? true,
            'samesite' => $options['cookie_samesite'] ?? 'Lax',
        ]);
        session_start();
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], (bool)$params['secure'], (bool)$params['httponly']);
        }
        session_destroy();
    }
}


