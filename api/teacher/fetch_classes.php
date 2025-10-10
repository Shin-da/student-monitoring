<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/app/Core/Database.php';
$config = require BASE_PATH . '/config/config.php';

use Core\Database;

try {
    $pdo = Database::connection($config['database']);
    
    // Fetch all classes from sections table
    $stmt = $pdo->query("
        SELECT 
            section_id,
            class_name,
            subject,
            grade_level,
            section,
            room,
            max_students,
            description,
            date_created
        FROM sections 
        ORDER BY date_created DESC
    ");
    
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    
    // Format the response with additional computed fields
    $formattedClasses = array_map(function($class) {
        return [
            'id' => (int)$class['section_id'],
            'class_name' => $class['class_name'],
            'subject' => $class['subject'],
            'grade_level' => $class['grade_level'],
            'section' => $class['section'],
            'room' => $class['room'] ?: 'TBD',
            'max_students' => (int)$class['max_students'] ?: 50,
            'description' => $class['description'] ?: '',
            'date_created' => $class['date_created'],
            'display_name' => $class['class_name'] . ' (' . $class['subject'] . ')',
            'student_count' => 0, // TODO: Join with actual student count
            'attendance_rate' => rand(75, 95) // TODO: Calculate actual attendance
        ];
    }, $classes);
    
    echo json_encode([
        'success' => true,
        'data' => $formattedClasses,
        'count' => count($formattedClasses),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch classes',
        'error' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}
