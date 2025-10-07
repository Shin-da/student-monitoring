<?php
declare(strict_types=1);

namespace Helpers;

class Response
{
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function forbidden(string $message = '403 Forbidden'): void
    {
        http_response_code(403);
        header('Content-Type: text/plain');
        echo $message;
    }
}


