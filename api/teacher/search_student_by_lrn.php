<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/app/Core/Database.php';
$config = require BASE_PATH . '/config/config.php';

use Core\Database;
use PDO;

try {
    $pdo = Database::connection($config['database']);
    $q = trim((string)($_GET['q'] ?? ''));
    if ($q === '') {
        echo json_encode(['success' => true, 'data' => null]);
        exit;
    }

    // Centralized users table: find student by lrn
    $stmt = $pdo->prepare('SELECT id as user_id, name, lrn, grade_level FROM users WHERE role = "student" AND (lrn = :q OR lrn LIKE :like) LIMIT 1');
    $stmt->execute(['q' => $q, 'like' => $q . '%']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    echo json_encode(['success' => true, 'data' => $row]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


