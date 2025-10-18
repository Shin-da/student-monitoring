<?php

namespace Helpers;

class ErrorHandler
{
    /**
     * Redirect to an error page
     */
    public static function redirectToError(int $code, string $message = ''): void
    {
        $url = Url::to("/error/{$code}");
        if ($message) {
            $url .= '?message=' . urlencode($message);
        }
        header("Location: {$url}");
        exit;
    }

    /**
     * Show 404 error
     */
    public static function notFound(string $message = ''): void
    {
        self::redirectToError(404, $message);
    }

    /**
     * Show 403 error
     */
    public static function forbidden(string $message = ''): void
    {
        self::redirectToError(403, $message);
    }

    /**
     * Show 401 error
     */
    public static function unauthorized(string $message = ''): void
    {
        self::redirectToError(401, $message);
    }

    /**
     * Show 500 error
     */
    public static function internalServerError(string $message = ''): void
    {
        self::redirectToError(500, $message);
    }

    /**
     * Show 503 error
     */
    public static function serviceUnavailable(string $message = ''): void
    {
        self::redirectToError(503, $message);
    }

    /**
     * Log error and show appropriate error page
     */
    public static function handleError(\Throwable $exception): void
    {
        // Log the error (you can implement logging here)
        error_log("Error: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine());

        // Show appropriate error page based on exception type
        if ($exception instanceof \InvalidArgumentException) {
            self::redirectToError(400, $exception->getMessage());
        } elseif ($exception instanceof \UnauthorizedException) {
            self::redirectToError(401, $exception->getMessage());
        } elseif ($exception instanceof \ForbiddenException) {
            self::redirectToError(403, $exception->getMessage());
        } elseif ($exception instanceof \NotFoundException) {
            self::redirectToError(404, $exception->getMessage());
        } else {
            self::redirectToError(500, 'An unexpected error occurred');
        }
    }
}
