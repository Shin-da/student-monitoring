<?php
declare(strict_types=1);

namespace Helpers;

class Url
{
    public static function basePath(): string
    {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        if ($dir !== '' && str_ends_with($dir, '/public')) {
            $dir = rtrim(substr($dir, 0, -strlen('/public')), '/');
        }
        return $dir === '/' ? '' : $dir; // return empty for root
    }

    public static function to(string $path = '/'): string
    {
        $normalized = '/' . ltrim($path, '/');
        return self::basePath() . ($normalized === '//' ? '/' : $normalized);
    }

    public static function asset(string $relativePath): string
    {
        $rel = ltrim($relativePath, '/');
        $scriptFilename = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? '');
        $servedFromPublic = str_ends_with($scriptFilename, '/public/index.php');
        
        // Check if we're running PHP built-in server with document root at public/
        $isBuiltInServer = isset($_SERVER['SERVER_SOFTWARE']) && 
                          str_starts_with($_SERVER['SERVER_SOFTWARE'], 'PHP');

        // If caller already provided a path under assets/, don't prepend another assets/
        $isUnderAssets = str_starts_with($rel, 'assets/');

        if ($servedFromPublic || $isBuiltInServer) {
            // Docroot is public/, assets are at /assets
            return self::basePath() . ($isUnderAssets ? '/' . $rel : '/assets/' . $rel);
        }
        // Docroot is project root, assets are at /public/assets
        return self::basePath() . '/public/' . ($isUnderAssets ? $rel : 'assets/' . $rel);
    }

    /**
     * Build a URL to a file located under the public/ directory (e.g., manifest.json, browserconfig.xml)
     * Works whether the web server's document root is the project root or the public/ folder.
     */
    public static function publicPath(string $relativePath): string
    {
        $rel = ltrim($relativePath, '/');
        $scriptFilename = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? '');
        $servedFromPublic = str_ends_with($scriptFilename, '/public/index.php');
        if ($servedFromPublic) {
            // URLs are relative to public/
            return self::basePath() . '/' . $rel;
        }
        // When served from project root, prefix with /public
        return self::basePath() . '/public/' . $rel;
    }
}



