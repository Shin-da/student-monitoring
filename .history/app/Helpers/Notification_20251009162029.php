<?php
declare(strict_types=1);

namespace Helpers;

class Notification
{
    public static function success(string $message): void
    {
        self::set('success', $message);
    }
    
    public static function error(string $message): void
    {
        self::set('error', $message);
    }
    
    public static function warning(string $message): void
    {
        self::set('warning', $message);
    }
    
    public static function info(string $message): void
    {
        self::set('info', $message);
    }
    
    public static function get(string $type = null): array
    {
        if ($type) {
            $messages = $_SESSION['notifications'][$type] ?? [];
            unset($_SESSION['notifications'][$type]);
            return $messages;
        }
        
        $messages = $_SESSION['notifications'] ?? [];
        unset($_SESSION['notifications']);
        return $messages;
    }
    
    public static function has(string $type = null): bool
    {
        if ($type) {
            return !empty($_SESSION['notifications'][$type]);
        }
        
        return !empty($_SESSION['notifications']);
    }
    
    public static function flash(string $type, string $message): void
    {
        self::set($type, $message);
    }
    
    public static function getFlashed(): array
    {
        return self::get();
    }
    
    public static function renderHtml(): string
    {
        $html = '';
        $notifications = self::get();
        
        foreach ($notifications as $type => $messages) {
            if (!is_array($messages)) {
                $messages = [$messages];
            }
            
            foreach ($messages as $message) {
                $iconClass = match($type) {
                    'success' => 'fas fa-check-circle',
                    'error' => 'fas fa-exclamation-triangle',
                    'warning' => 'fas fa-exclamation-circle',
                    'info' => 'fas fa-info-circle',
                    default => 'fas fa-bell'
                };
                
                $alertClass = match($type) {
                    'success' => 'alert-success',
                    'error' => 'alert-danger',
                    'warning' => 'alert-warning',
                    'info' => 'alert-info',
                    default => 'alert-secondary'
                };
                
                $html .= sprintf(
                    '<div class="alert %s alert-dismissible fade show" role="alert" data-auto-dismiss="5000">
                        <i class="%s me-2" aria-hidden="true"></i>
                        <span>%s</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close notification"></button>
                    </div>',
                    $alertClass,
                    $iconClass,
                    htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
                );
            }
        }
        
        return $html;
    }
    
    public static function renderJson(): array
    {
        $notifications = self::get();
        $result = [];
        
        foreach ($notifications as $type => $messages) {
            if (!is_array($messages)) {
                $messages = [$messages];
            }
            
            foreach ($messages as $message) {
                $result[] = [
                    'type' => $type,
                    'message' => $message,
                    'timestamp' => time()
                ];
            }
        }
        
        return $result;
    }
    
    private static function set(string $type, string $message): void
    {
        if (!isset($_SESSION['notifications'])) {
            $_SESSION['notifications'] = [];
        }
        
        if (!isset($_SESSION['notifications'][$type])) {
            $_SESSION['notifications'][$type] = [];
        }
        
        $_SESSION['notifications'][$type][] = $message;
    }
}