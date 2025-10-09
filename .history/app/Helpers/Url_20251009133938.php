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

        // If caller already provided a path under assets/, don't prepend another assets/
        $isUnderAssets = str_starts_with($rel, 'assets/');

        if ($servedFromPublic) {
            // Docroot is public/, assets are at /assets
            return self::basePath() . ($isUnderAssets ? '/' . $rel : '/assets/' . $rel);
        }
        // Docroot is project root, assets are at /public/assets
        return self::basePath() . '/public/' . ($isUnderAssets ? $rel : 'assets/' . $rel);
    }
}



