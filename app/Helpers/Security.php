<?php
declare(strict_types=1);

namespace Helpers;

use Core\Session;

class Security
{
    private static array $rateLimits = [];
    
    public static function setSecurityHeaders(): void
    {
        // Content Security Policy
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data:; font-src 'self' https://cdn.jsdelivr.net; connect-src 'self'; frame-ancestors 'none';");
        
        // Prevent MIME type sniffing
        header("X-Content-Type-Options: nosniff");
        
        // Prevent clickjacking
        header("X-Frame-Options: DENY");
        
        // XSS Protection
        header("X-XSS-Protection: 1; mode=block");
        
        // Referrer Policy
        header("Referrer-Policy: strict-origin-when-cross-origin");
        
        // Permissions Policy
        header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
        
        // Remove server signature
        header_remove("X-Powered-By");
        
        // HSTS (only if using HTTPS)
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
        }
    }
    
    public static function rateLimitLogin(string $identifier, int $maxAttempts = 5, int $timeWindow = 900): bool
    {
        $key = 'login_attempts_' . hash('sha256', $identifier);
        $attempts = Session::get($key, []);
        $now = time();
        
        // Clean old attempts
        $attempts = array_filter($attempts, fn($timestamp) => $timestamp > ($now - $timeWindow));
        
        // Check if limit exceeded
        if (count($attempts) >= $maxAttempts) {
            return false;
        }
        
        // Record this attempt
        $attempts[] = $now;
        Session::set($key, $attempts);
        
        return true;
    }
    
    public static function clearLoginAttempts(string $identifier): void
    {
        $key = 'login_attempts_' . hash('sha256', $identifier);
        Session::forget($key);
    }
    
    public static function getLoginAttemptsRemaining(string $identifier, int $maxAttempts = 5, int $timeWindow = 900): int
    {
        $key = 'login_attempts_' . hash('sha256', $identifier);
        $attempts = Session::get($key, []);
        $now = time();
        
        // Clean old attempts
        $attempts = array_filter($attempts, fn($timestamp) => $timestamp > ($now - $timeWindow));
        
        return max(0, $maxAttempts - count($attempts));
    }
    
    public static function getLoginLockoutTime(string $identifier, int $timeWindow = 900): int
    {
        $key = 'login_attempts_' . hash('sha256', $identifier);
        $attempts = Session::get($key, []);
        
        if (empty($attempts)) {
            return 0;
        }
        
        $lastAttempt = max($attempts);
        $lockoutEnd = $lastAttempt + $timeWindow;
        
        return max(0, $lockoutEnd - time());
    }
    
    public static function validateInput(array $data, array $rules): array
    {
        $errors = [];
        
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            
            foreach ($fieldRules as $rule => $params) {
                switch ($rule) {
                    case 'required':
                        if (!Validator::required($value)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' is required';
                        }
                        break;
                        
                    case 'email':
                        if ($value && !Validator::email($value)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must be a valid email address';
                        }
                        break;
                        
                    case 'min_length':
                        if ($value && !Validator::minLength($value, $params)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must be at least ' . $params . ' characters long';
                        }
                        break;
                        
                    case 'max_length':
                        if ($value && !Validator::maxLength($value, $params)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must not exceed ' . $params . ' characters';
                        }
                        break;
                        
                    case 'strong_password':
                        if ($value && !Validator::strongPassword($value)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $passwordErrors = Validator::getPasswordErrors($value);
                            $errors[$field] = array_merge($errors[$field], $passwordErrors);
                        }
                        break;
                        
                    case 'alphanumeric':
                        if ($value && !Validator::alphanumeric($value)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must contain only letters and numbers';
                        }
                        break;
                        
                    case 'numeric':
                        if ($value && !Validator::numeric($value)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must be numeric';
                        }
                        break;
                        
                    case 'in_array':
                        if ($value && !Validator::inArray($value, $params)) {
                            $errors[$field] = $errors[$field] ?? [];
                            $errors[$field][] = ucfirst($field) . ' must be one of: ' . implode(', ', $params);
                        }
                        break;
                }
            }
        }
        
        return $errors;
    }
    
    public static function sanitizeArray(array $data, array $fields): array
    {
        $sanitized = [];
        
        foreach ($fields as $field => $type) {
            if (!isset($data[$field])) {
                continue;
            }
            
            switch ($type) {
                case 'string':
                    $sanitized[$field] = Validator::sanitizeString($data[$field]);
                    break;
                    
                case 'email':
                    $sanitized[$field] = Validator::sanitizeEmail($data[$field]);
                    break;
                    
                case 'int':
                    $sanitized[$field] = Validator::sanitizeInt($data[$field]);
                    break;
                    
                default:
                    $sanitized[$field] = $data[$field];
                    break;
            }
        }
        
        return $sanitized;
    }
    
    public static function generateSecureToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }
    
    public static function hashSensitiveData(string $data): string
    {
        return hash('sha256', $data);
    }
    
    public static function constantTimeCompare(string $known, string $user): bool
    {
        return hash_equals($known, $user);
    }
    
    public static function logSecurityEvent(string $event, string $identifier, array $details = []): void
    {
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'identifier' => $identifier,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'details' => $details
        ];
        
        // In production, log to a secure file or database
        error_log('[SECURITY] ' . json_encode($logEntry), 3, __DIR__ . '/../../logs/security.log');
    }
    
    public static function generateCsrfToken(): string
    {
        if (!Session::get('csrf_token')) {
            Session::set('csrf_token', self::generateSecureToken());
        }
        return Session::get('csrf_token');
    }
    
    public static function validateCsrfToken(string $token): bool
    {
        $sessionToken = Session::get('csrf_token');
        return $sessionToken && self::constantTimeCompare($sessionToken, $token);
    }
}