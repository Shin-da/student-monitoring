<?php
declare(strict_types=1);

namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler): void
    {
        $this->map('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->map('POST', $path, $handler);
    }

    public function map(string $method, string $path, callable|array $handler): void
    {
        $this->routes[$method][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        // When the app is served from a subdirectory (e.g., /student-monitoring),
        // Apache sets the request URI to include that base path. Trim it so
        // routes can remain defined from root ("/").
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        // If rewrite sends to public/index.php, trim trailing /public from base
        if ($basePath !== '' && str_ends_with($basePath, '/public')) {
            $basePath = rtrim(substr($basePath, 0, -strlen('/public')), '/');
        }
        if ($basePath !== '' && $basePath !== '/') {
            if (str_starts_with($path, $basePath)) {
                $path = substr($path, strlen($basePath)) ?: '/';
            }
        }
        $normalized = $this->normalize($path);

        $handler = $this->routes[$method][$normalized] ?? null;
        if ($handler === null) {
            // Redirect to 404 error page instead of showing plain text
            header('Location: ' . \Helpers\Url::to('/error/404'));
            exit;
        }

        if (is_array($handler)) {
            [$class, $action] = $handler;
            $controller = new $class();
            $controller->$action();
            return;
        }

        ($handler)();
    }

    private function normalize(string $path): string
    {
        if ($path === '') {
            return '/';
        }
        $path = '/' . trim($path, '/');
        return $path === '//' ? '/' : $path;
    }
}


