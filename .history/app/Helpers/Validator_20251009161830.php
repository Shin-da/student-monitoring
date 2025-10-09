<?php
declare(strict_types=1);

namespace Helpers;

class Validator
{
    public static function email(string $value): bool
    {
        // Enhanced email validation with DNS check
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Optional: Check if domain has MX record (uncomment for production)
        // $domain = substr(strrchr($value, "@"), 1);
        // return checkdnsrr($domain, "MX");
        
        return true;
    }

    public static function required(string|array|null $value): bool
    {
        if (is_array($value)) {
            return !empty($value);
        }
        return isset($value) && trim((string)$value) !== '';
    }

    public static function minLength(string $value, int $min): bool
    {
        return mb_strlen($value) >= $min;
    }
    
    public static function maxLength(string $value, int $max): bool
    {
        return mb_strlen($value) <= $max;
    }
    
    public static function strongPassword(string $password): bool
    {
        // Minimum 8 characters, at least one uppercase, one lowercase, one number, one special char
        if (strlen($password) < 8) {
            return false;
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            return false; // No uppercase letter
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            return false; // No lowercase letter
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            return false; // No number
        }
        
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            return false; // No special character
        }
        
        // Check against common passwords
        $commonPasswords = [
            'password', '12345678', 'qwerty', 'abc123', 'password123',
            'admin', 'letmein', 'welcome', 'monkey', '123456789'
        ];
        
        if (in_array(strtolower($password), $commonPasswords)) {
            return false;
        }
        
        return true;
    }
    
    public static function sanitizeString(string $value): string
    {
        return trim(strip_tags($value));
    }
    
    public static function sanitizeEmail(string $value): string
    {
        return filter_var(trim($value), FILTER_SANITIZE_EMAIL);
    }
    
    public static function sanitizeInt(mixed $value): int
    {
        return (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
    
    public static function alphanumeric(string $value): bool
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value);
    }
    
    public static function numeric(string $value): bool
    {
        return is_numeric($value);
    }
    
    public static function url(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
    
    public static function dateFormat(string $value, string $format = 'Y-m-d'): bool
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }
    
    public static function inArray(mixed $value, array $array): bool
    {
        return in_array($value, $array, true);
    }
    
    public static function getPasswordErrors(string $password): array
    {
        $errors = [];
        
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'Password must contain at least one uppercase letter';
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'Password must contain at least one lowercase letter';
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'Password must contain at least one number';
        }
        
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = 'Password must contain at least one special character';
        }
        
        return $errors;
    }
}


