<?php
declare(strict_types=1);

namespace Helpers;

class Cache
{
    private static array $cache = [];
    private static string $cacheDir = '';
    private static int $defaultTtl = 3600; // 1 hour
    private string $currentTag = '';
    
    public static function init(string $cacheDirectory = null): void
    {
        self::$cacheDir = $cacheDirectory ?? __DIR__ . '/../../storage/cache';
        
        if (!is_dir(self::$cacheDir)) {
            mkdir(self::$cacheDir, 0755, true);
        }
    }
    
    public static function get(string $key, mixed $default = null): mixed
    {
        // Check memory cache first
        if (isset(self::$cache[$key])) {
            $item = self::$cache[$key];
            if ($item['expires'] === 0 || $item['expires'] > time()) {
                return $item['data'];
            } else {
                unset(self::$cache[$key]);
            }
        }
        
        // Check file cache
        $filename = self::getFilename($key);
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $data = unserialize($content);
            
            if ($data && ($data['expires'] === 0 || $data['expires'] > time())) {
                // Store in memory cache
                self::$cache[$key] = $data;
                return $data['data'];
            } else {
                // Expired, remove file
                unlink($filename);
            }
        }
        
        return $default;
    }
    
    public static function set(string $key, mixed $value, int $ttl = null): bool
    {
        $ttl = $ttl ?? self::$defaultTtl;
        $expires = $ttl > 0 ? time() + $ttl : 0;
        
        $item = [
            'data' => $value,
            'expires' => $expires,
            'created' => time()
        ];
        
        // Store in memory cache
        self::$cache[$key] = $item;
        
        // Store in file cache
        $filename = self::getFilename($key);
        $content = serialize($item);
        
        return file_put_contents($filename, $content, LOCK_EX) !== false;
    }
    
    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }
    
    public static function forget(string $key): bool
    {
        // Remove from memory cache
        unset(self::$cache[$key]);
        
        // Remove from file cache
        $filename = self::getFilename($key);
        if (file_exists($filename)) {
            return unlink($filename);
        }
        
        return true;
    }
    
    public static function remember(string $key, callable $callback, int $ttl = null): mixed
    {
        $value = self::get($key);
        
        if ($value === null) {
            $value = $callback();
            self::set($key, $value, $ttl);
        }
        
        return $value;
    }
    
    public static function rememberForever(string $key, callable $callback): mixed
    {
        return self::remember($key, $callback, 0);
    }
    
    public static function increment(string $key, int $value = 1): int
    {
        $current = (int)self::get($key, 0);
        $new = $current + $value;
        self::set($key, $new);
        return $new;
    }
    
    public static function decrement(string $key, int $value = 1): int
    {
        $current = (int)self::get($key, 0);
        $new = max(0, $current - $value);
        self::set($key, $new);
        return $new;
    }
    
    public static function flush(): bool
    {
        // Clear memory cache
        self::$cache = [];
        
        // Clear file cache
        if (!is_dir(self::$cacheDir)) {
            return true;
        }
        
        $files = glob(self::$cacheDir . '/*.cache');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        
        return true;
    }
    
    public static function clear(): bool
    {
        return self::flush();
    }
    
    public static function cleanExpired(): int
    {
        $cleaned = 0;
        
        // Clean memory cache
        foreach (self::$cache as $key => $item) {
            if ($item['expires'] > 0 && $item['expires'] <= time()) {
                unset(self::$cache[$key]);
                $cleaned++;
            }
        }
        
        // Clean file cache
        if (!is_dir(self::$cacheDir)) {
            return $cleaned;
        }
        
        $files = glob(self::$cacheDir . '/*.cache');
        foreach ($files as $file) {
            if (is_file($file)) {
                $content = file_get_contents($file);
                $data = unserialize($content);
                
                if (!$data || ($data['expires'] > 0 && $data['expires'] <= time())) {
                    unlink($file);
                    $cleaned++;
                }
            }
        }
        
        return $cleaned;
    }
    
    public static function getStats(): array
    {
        $memoryCount = count(self::$cache);
        $fileCount = 0;
        $totalSize = 0;
        
        if (is_dir(self::$cacheDir)) {
            $files = glob(self::$cacheDir . '/*.cache');
            $fileCount = count($files);
            
            foreach ($files as $file) {
                if (is_file($file)) {
                    $totalSize += filesize($file);
                }
            }
        }
        
        return [
            'memory_items' => $memoryCount,
            'file_items' => $fileCount,
            'total_size' => $totalSize,
            'total_size_formatted' => self::formatBytes($totalSize),
            'cache_directory' => self::$cacheDir
        ];
    }
    
    public static function getKeys(): array
    {
        $keys = [];
        
        // Get memory cache keys
        $keys = array_merge($keys, array_keys(self::$cache));
        
        // Get file cache keys
        if (is_dir(self::$cacheDir)) {
            $files = glob(self::$cacheDir . '/*.cache');
            foreach ($files as $file) {
                $key = basename($file, '.cache');
                $key = str_replace('_', ':', $key); // Reverse the key encoding
                if (!in_array($key, $keys)) {
                    $keys[] = $key;
                }
            }
        }
        
        return array_unique($keys);
    }
    
    public static function getCacheInfo(string $key): ?array
    {
        // Check memory cache
        if (isset(self::$cache[$key])) {
            $item = self::$cache[$key];
            return [
                'key' => $key,
                'location' => 'memory',
                'size' => strlen(serialize($item['data'])),
                'created' => $item['created'],
                'expires' => $item['expires'],
                'ttl' => $item['expires'] > 0 ? $item['expires'] - time() : 0,
                'is_expired' => $item['expires'] > 0 && $item['expires'] <= time()
            ];
        }
        
        // Check file cache
        $filename = self::getFilename($key);
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $data = unserialize($content);
            
            if ($data) {
                return [
                    'key' => $key,
                    'location' => 'file',
                    'size' => filesize($filename),
                    'created' => $data['created'],
                    'expires' => $data['expires'],
                    'ttl' => $data['expires'] > 0 ? $data['expires'] - time() : 0,
                    'is_expired' => $data['expires'] > 0 && $data['expires'] <= time()
                ];
            }
        }
        
        return null;
    }
    
    private static function getFilename(string $key): string
    {
        self::init();
        
        // Sanitize key for filename
        $safeKey = str_replace([':', '/', '\\', ' '], '_', $key);
        $safeKey = preg_replace('/[^a-zA-Z0-9_-]/', '', $safeKey);
        
        return self::$cacheDir . '/' . $safeKey . '.cache';
    }
    
    private static function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }
    
    // Tag-based caching
    private static array $tags = [];
    
    public static function tag(string $tag): self
    {
        $instance = new static();
        $instance->currentTag = $tag;
        return $instance;
    }
    
    public static function flushTag(string $tag): int
    {
        $flushed = 0;
        
        if (!isset(self::$tags[$tag])) {
            return $flushed;
        }
        
        foreach (self::$tags[$tag] as $key) {
            if (self::forget($key)) {
                $flushed++;
            }
        }
        
        unset(self::$tags[$tag]);
        return $flushed;
    }
    
    private function taggedSet(string $key, mixed $value, int $ttl = null): bool
    {
        if (isset($this->currentTag)) {
            if (!isset(self::$tags[$this->currentTag])) {
                self::$tags[$this->currentTag] = [];
            }
            self::$tags[$this->currentTag][] = $key;
        }
        
        return self::set($key, $value, $ttl);
    }
    
    // Configuration methods
    public static function setDefaultTtl(int $ttl): void
    {
        self::$defaultTtl = $ttl;
    }
    
    public static function getDefaultTtl(): int
    {
        return self::$defaultTtl;
    }
    
    public static function setCacheDirectory(string $directory): void
    {
        self::$cacheDir = $directory;
        
        if (!is_dir(self::$cacheDir)) {
            mkdir(self::$cacheDir, 0755, true);
        }
    }
    
    public static function getCacheDirectory(): string
    {
        return self::$cacheDir;
    }
}