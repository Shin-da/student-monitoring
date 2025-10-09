<?php
declare(strict_types=1);

namespace Helpers;

class ActivityLogger
{
    private static array $logs = [];
    
    public static function log(string $action, string $entityType, ?int $entityId = null, array $details = []): void
    {
        $log = [
            'id' => uniqid(),
            'timestamp' => date('Y-m-d H:i:s'),
            'user_id' => $_SESSION['user_id'] ?? null,
            'user_role' => $_SESSION['user_role'] ?? 'guest',
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'details' => $details
        ];
        
        // Store in session for demo (in production, store in database)
        if (!isset($_SESSION['activity_logs'])) {
            $_SESSION['activity_logs'] = [];
        }
        
        array_unshift($_SESSION['activity_logs'], $log);
        
        // Keep only last 100 logs in session
        $_SESSION['activity_logs'] = array_slice($_SESSION['activity_logs'], 0, 100);
        
        // Also log to file for debugging
        error_log('[ACTIVITY] ' . json_encode($log), 3, __DIR__ . '/../../logs/activity.log');
    }
    
    public static function logUserAction(string $action, array $details = []): void
    {
        self::log($action, 'user', $_SESSION['user_id'] ?? null, $details);
    }
    
    public static function logStudentAction(string $action, int $studentId, array $details = []): void
    {
        self::log($action, 'student', $studentId, $details);
    }
    
    public static function logGradeAction(string $action, int $gradeId, array $details = []): void
    {
        self::log($action, 'grade', $gradeId, $details);
    }
    
    public static function logSystemAction(string $action, array $details = []): void
    {
        self::log($action, 'system', null, $details);
    }
    
    public static function getRecentLogs(int $limit = 50): array
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        return array_slice($logs, 0, $limit);
    }
    
    public static function getLogsByUser(int $userId, int $limit = 50): array
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        $userLogs = array_filter($logs, fn($log) => $log['user_id'] === $userId);
        return array_slice($userLogs, 0, $limit);
    }
    
    public static function getLogsByAction(string $action, int $limit = 50): array
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        $actionLogs = array_filter($logs, fn($log) => $log['action'] === $action);
        return array_slice($actionLogs, 0, $limit);
    }
    
    public static function getLogsByEntity(string $entityType, ?int $entityId = null, int $limit = 50): array
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        $entityLogs = array_filter($logs, function($log) use ($entityType, $entityId) {
            if ($log['entity_type'] !== $entityType) {
                return false;
            }
            
            if ($entityId !== null && $log['entity_id'] !== $entityId) {
                return false;
            }
            
            return true;
        });
        
        return array_slice($entityLogs, 0, $limit);
    }
    
    public static function getLogStats(): array
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        
        $stats = [
            'total_actions' => count($logs),
            'unique_users' => count(array_unique(array_column($logs, 'user_id'))),
            'actions_by_type' => [],
            'actions_by_user_role' => [],
            'recent_activity' => []
        ];
        
        foreach ($logs as $log) {
            // Count by action type
            $action = $log['action'];
            $stats['actions_by_type'][$action] = ($stats['actions_by_type'][$action] ?? 0) + 1;
            
            // Count by user role
            $role = $log['user_role'];
            $stats['actions_by_user_role'][$role] = ($stats['actions_by_user_role'][$role] ?? 0) + 1;
        }
        
        // Get recent activity (last 10 actions)
        $stats['recent_activity'] = array_slice($logs, 0, 10);
        
        return $stats;
    }
    
    public static function exportLogs(string $format = 'json'): string
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        
        switch ($format) {
            case 'csv':
                return self::exportToCsv($logs);
            case 'json':
            default:
                return json_encode($logs, JSON_PRETTY_PRINT);
        }
    }
    
    private static function exportToCsv(array $logs): string
    {
        if (empty($logs)) {
            return '';
        }
        
        $output = fopen('php://temp', 'r+');
        
        // Write headers
        $headers = array_keys($logs[0]);
        fputcsv($output, $headers);
        
        // Write data
        foreach ($logs as $log) {
            $row = [];
            foreach ($headers as $header) {
                $value = $log[$header];
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $row[] = $value;
            }
            fputcsv($output, $row);
        }
        
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);
        
        return $csv;
    }
    
    public static function clearLogs(): void
    {
        $_SESSION['activity_logs'] = [];
    }
    
    public static function archiveLogs(): bool
    {
        $logs = $_SESSION['activity_logs'] ?? [];
        
        if (empty($logs)) {
            return true;
        }
        
        $archiveFile = __DIR__ . '/../../logs/activity_archive_' . date('Y-m-d_H-i-s') . '.json';
        $result = file_put_contents($archiveFile, json_encode($logs, JSON_PRETTY_PRINT));
        
        if ($result !== false) {
            self::clearLogs();
            return true;
        }
        
        return false;
    }
}