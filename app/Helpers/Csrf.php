<?php
declare(strict_types=1);

namespace Helpers;

use Core\Session;

class Csrf
{
    public static function token(): string
    {
        $token = bin2hex(random_bytes(16));
        Session::set('_csrf', $token);
        return $token;
    }

    public static function check(?string $token): bool
    {
        $stored = Session::get('_csrf');
        $valid = is_string($token) && is_string($stored) && hash_equals($stored, $token);
        // Don't delete token after use - allow multiple submissions with same token
        return $valid;
    }
}


