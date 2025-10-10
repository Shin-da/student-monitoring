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
    // Assume session user id
    session_start();
    $teacherUserId = (int)($_SESSION['user_id'] ?? 0);
    if ($teacherUserId <= 0) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }
    $stmt = $pdo->prepare('SELECT id, teacher_user_id, section_name, grade_level, description, created_at FROM sections WHERE teacher_user_id = :t ORDER BY created_at DESC');
    $stmt->execute(['t' => $teacherUserId]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

    // Enrich with student counts using centralized linking table
    if ($rows) {
        $ids = array_map(fn($r) => (int)$r['id'], $rows);
        $in = implode(',', array_fill(0, count($ids), '?'));
        $cst = $pdo->prepare("SELECT section_id, COUNT(*) as c FROM section_students WHERE section_id IN ($in) GROUP BY section_id");
        $cst->execute($ids);
        $counts = [];
        foreach ($cst->fetchAll(PDO::FETCH_ASSOC) as $cr) { $counts[(int)$cr['section_id']] = (int)$cr['c']; }
        foreach ($rows as &$r) { $r['student_count'] = $counts[(int)$r['id']] ?? 0; }
    }
    echo json_encode(['success' => true, 'data' => $rows]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


