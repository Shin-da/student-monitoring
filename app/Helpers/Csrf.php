<?php
declare(strict_types=1);

namespace Helpers;

use Core\Session;

class Csrf
{
    public static function generateToken(): string
    {
        if (!Session::get('csrf_token')) {
            Session::set('csrf_token', Security::generateSecureToken());
        }
        return Session::get('csrf_token');
    }
    
    public static function validateToken(string $token): bool
    {
        $sessionToken = Session::get('csrf_token');
        return $sessionToken && Security::constantTimeCompare($sessionToken, $token);
    }
    
    public static function check(?string $token): bool
    {
        return $token && self::validateToken($token);
    }
    
    public static function getTokenField(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(self::generateToken()) . '">';
    }
    
    public static function getMetaTag(): string
    {
        return '<meta name="csrf-token" content="' . htmlspecialchars(self::generateToken()) . '">';
    }
}