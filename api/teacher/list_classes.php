<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/app/Core/Database.php';
$config = require BASE_PATH . '/config/config.php';

use Core\Database;

try {
    $pdo = Database::connection($config['database']);
    $stmt = $pdo->query('SELECT section_id, class_name, subject, grade_level, section, room, max_students, description, date_created FROM sections ORDER BY date_created DESC');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    echo json_encode(['success' => true, 'data' => $rows]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


