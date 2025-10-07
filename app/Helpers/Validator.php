<?php
declare(strict_types=1);

namespace Helpers;

class Validator
{
    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
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
}


