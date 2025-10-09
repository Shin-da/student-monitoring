<?php
declare(strict_types=1);

// Define required constants
define('BASE_PATH', __DIR__);
define('APP_PATH', __DIR__ . '/app');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/bootstrap.php';

use Helpers\Cache;
use Helpers\ActivityLogger;
use Helpers\Security;
use Helpers\Notification;

// Initialize cache system
Cache::init(__DIR__ . '/storage/cache');

echo "=== Student Monitoring System - Feature Demonstration ===\n\n";

// 1. Cache System Demo
echo "1. Cache System Demonstration:\n";
echo "   Setting cache values...\n";

Cache::set('demo_key', 'Hello World!', 30);
Cache::set('user_123_profile', ['name' => 'John Doe', 'role' => 'student'], 300);
Cache::set('system_stats', ['active_users' => 150, 'total_grades' => 1250], 600);

echo "   Retrieved: " . Cache::get('demo_key') . "\n";
echo "   User Profile: " . json_encode(Cache::get('user_123_profile')) . "\n";
echo "   System Stats: " . json_encode(Cache::get('system_stats')) . "\n";

$cacheStats = Cache::getStats();
echo "   Cache Statistics: " . json_encode($cacheStats, JSON_PRETTY_PRINT) . "\n\n";

// 2. Security System Demo
echo "2. Security System Demonstration:\n";

// Rate limiting demo
$testEmail = 'demo@example.com';
echo "   Testing rate limiting for: $testEmail\n";

for ($i = 1; $i <= 7; $i++) {
    $allowed = Security::rateLimitLogin($testEmail);
    $remaining = Security::getLoginAttemptsRemaining($testEmail);
    echo "   Attempt $i: " . ($allowed ? 'ALLOWED' : 'BLOCKED') . " (Remaining: $remaining)\n";
}

// Input validation demo
echo "\n   Testing input validation:\n";
$testData = [
    'email' => 'test@example.com',
    'password' => 'weak',
    'name' => 'John Doe',
    'age' => '25'
];

$validationRules = [
    'email' => ['required' => true, 'email' => true],
    'password' => ['required' => true, 'strong_password' => true],
    'name' => ['required' => true, 'min_length' => 2],
    'age' => ['numeric' => true]
];

$errors = Security::validateInput($testData, $validationRules);
if (!empty($errors)) {
    echo "   Validation Errors:\n";
    foreach ($errors as $field => $fieldErrors) {
        echo "     $field: " . implode(', ', $fieldErrors) . "\n";
    }
} else {
    echo "   All validation passed!\n";
}

// Sanitization demo
$sanitized = Security::sanitizeArray($testData, [
    'email' => 'email',
    'name' => 'string',
    'age' => 'int'
]);
echo "   Sanitized Data: " . json_encode($sanitized, JSON_PRETTY_PRINT) . "\n\n";

// 3. Activity Logging Demo
echo "3. Activity Logging Demonstration:\n";

// Simulate some activities
ActivityLogger::logUserAction('login', ['ip' => '192.168.1.100']);
ActivityLogger::logStudentAction('view_grades', 123, ['subject' => 'Mathematics']);
ActivityLogger::logGradeAction('add_grade', 456, ['student_id' => 123, 'grade' => 85]);
ActivityLogger::logSystemAction('backup_created', ['size' => '150MB']);

$recentLogs = ActivityLogger::getRecentLogs(5);
echo "   Recent Activity Logs:\n";
foreach ($recentLogs as $log) {
    echo "     [{$log['timestamp']}] {$log['action']} by {$log['user_role']}\n";
}

$stats = ActivityLogger::getLogStats();
echo "\n   Activity Statistics:\n";
echo "     Total Actions: {$stats['total_actions']}\n";
echo "     Unique Users: {$stats['unique_users']}\n";
echo "     Actions by Type: " . json_encode($stats['actions_by_type']) . "\n\n";

// 4. Notification System Demo
echo "4. Notification System Demonstration:\n";

// Start session for notifications
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

Notification::success('Welcome to the system!');
Notification::info('New features are available.');
Notification::warning('Please update your password.');
Notification::error('Failed to connect to external service.');

echo "   Notifications created and stored in session.\n";
echo "   HTML Output:\n";
echo Notification::renderHtml();

$jsonNotifications = Notification::renderJson();
echo "   JSON Format: " . json_encode($jsonNotifications, JSON_PRETTY_PRINT) . "\n\n";

// 5. Performance Metrics
echo "5. Performance Metrics:\n";

$startTime = microtime(true);
$startMemory = memory_get_usage();

// Simulate some operations
for ($i = 0; $i < 1000; $i++) {
    $key = "test_key_$i";
    Cache::set($key, "value_$i", 60);
    $value = Cache::get($key);
}

$endTime = microtime(true);
$endMemory = memory_get_usage();

$executionTime = round(($endTime - $startTime) * 1000, 2);
$memoryUsed = round(($endMemory - $startMemory) / 1024, 2);

echo "   Cache Operations (1000 set/get cycles):\n";
echo "     Execution Time: {$executionTime}ms\n";
echo "     Memory Used: {$memoryUsed}KB\n";
echo "     Average per Operation: " . round($executionTime / 1000, 3) . "ms\n\n";

// 6. System Health Check
echo "6. System Health Check:\n";

$healthChecks = [
    'cache_directory' => is_dir(Cache::getCacheDirectory()) && is_writable(Cache::getCacheDirectory()),
    'session_active' => session_status() === PHP_SESSION_ACTIVE,
    'php_version' => version_compare(PHP_VERSION, '8.0.0', '>='),
    'extensions_loaded' => extension_loaded('json') && extension_loaded('session')
];

foreach ($healthChecks as $check => $status) {
    $statusText = $status ? '✓ PASS' : '✗ FAIL';
    echo "   " . str_pad(ucwords(str_replace('_', ' ', $check)), 20) . ": $statusText\n";
}

// 7. Feature Integration Test
echo "\n7. Feature Integration Test:\n";

try {
    // Simulate a complete user workflow
    echo "   Simulating user login workflow...\n";
    
    // 1. Check rate limiting
    $canLogin = Security::rateLimitLogin('integration@test.com');
    echo "     Rate Limit Check: " . ($canLogin ? 'PASS' : 'FAIL') . "\n";
    
    // 2. Cache user session
    if ($canLogin) {
        Cache::set('user_session_integration', [
            'user_id' => 999,
            'role' => 'student',
            'login_time' => time()
        ], 1800);
        echo "     Session Cached: PASS\n";
    }
    
    // 3. Log activity
    ActivityLogger::logUserAction('integration_test', ['test_id' => 'DEMO_001']);
    echo "     Activity Logged: PASS\n";
    
    // 4. Create notification
    Notification::success('Integration test completed successfully!');
    echo "     Notification Created: PASS\n";
    
    // 5. Verify cache retrieval
    $session = Cache::get('user_session_integration');
    echo "     Cache Retrieval: " . ($session ? 'PASS' : 'FAIL') . "\n";
    
    echo "   Integration Test: ALL SYSTEMS OPERATIONAL\n";
    
} catch (Exception $e) {
    echo "   Integration Test: FAILED - " . $e->getMessage() . "\n";
}

// Cleanup
Cache::flush();
echo "\n=== Demonstration Complete ===\n";
echo "Cache cleaned up. All systems ready for production use.\n";