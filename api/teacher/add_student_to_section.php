<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/app/Core/Database.php';
$config = require BASE_PATH . '/config/config.php';

use Core\Database;
use PDO;

try {
    $pdo = Database::connection($config['database']);
    $data = json_decode(file_get_contents('php://input') ?: 'null', true);
    if (!is_array($data)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
        exit;
    }

    $sectionId = (int)($data['section_id'] ?? 0);
    $studentUserId = (int)($data['student_user_id'] ?? 0);
    $addedByUserId = (int)($data['added_by_user_id'] ?? 0);

    if ($sectionId <= 0 || $studentUserId <= 0 || $addedByUserId <= 0) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Validate section ownership
    $own = $pdo->prepare('SELECT teacher_user_id FROM sections WHERE id = :id LIMIT 1');
    $own->execute(['id' => $sectionId]);
    $sec = $own->fetch(PDO::FETCH_ASSOC);
    if (!$sec || (int)$sec['teacher_user_id'] !== $addedByUserId) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Not allowed']);
        exit;
    }

    // Validate student exists
    $st = $pdo->prepare('SELECT id FROM users WHERE id = :id AND role = "student" LIMIT 1');
    $st->execute(['id' => $studentUserId]);
    if (!$st->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Student not found']);
        exit;
    }

    // Prevent duplicate membership
    $chk = $pdo->prepare('SELECT id FROM section_students WHERE section_id = :s AND student_user_id = :u LIMIT 1');
    $chk->execute(['s' => $sectionId, 'u' => $studentUserId]);
    if ($chk->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Student already in this section']);
        exit;
    }

    // Insert into centralized linking table
    $ins = $pdo->prepare('INSERT INTO section_students (section_id, student_user_id, added_by_user_id) VALUES (:s, :u, :a)');
    $ins->execute(['s' => $sectionId, 'u' => $studentUserId, 'a' => $addedByUserId]);

    // Also insert into dynamic per-section table
    $nameStmt = $pdo->prepare('SELECT section_name FROM sections WHERE id = :id LIMIT 1');
    $nameStmt->execute(['id' => $sectionId]);
    $secRow = $nameStmt->fetch(PDO::FETCH_ASSOC);
    $sectionName = (string)($secRow['section_name'] ?? '');
    $simplified = strtolower($sectionName);
    $simplified = preg_replace('/[^a-z0-9]+/i', '_', $simplified);
    $simplified = trim($simplified, '_');
    if ($simplified === '') { $simplified = 'untitled'; }
    $baseTable = 'section_' . $simplified;

    // Resolve actual table name (with suffix if any). We'll pick the first that exists matching base or suffixed.
    $tbl = $baseTable;
    $existsStmt = $pdo->prepare('SHOW TABLES LIKE :t');
    $existsStmt->execute(['t' => $tbl]);
    if (!$existsStmt->fetch(PDO::FETCH_NUM)) {
        // try suffixed variants up to a small bound
        for ($i = 1; $i <= 10; $i++) {
            $try = $baseTable . '_' . $i;
            $existsStmt->execute(['t' => $try]);
            if ($existsStmt->fetch(PDO::FETCH_NUM)) { $tbl = $try; break; }
        }
    }

    // Fetch student info for dynamic table
    // Fetch LRN and grade from students table joined with users table
    $stuStmt = $pdo->prepare('SELECT u.name, s.lrn, s.grade_level FROM users u LEFT JOIN students s ON s.user_id = u.id WHERE u.id = :id LIMIT 1');
    $stuStmt->execute(['id' => $studentUserId]);
    $stu = $stuStmt->fetch(PDO::FETCH_ASSOC) ?: [];

    // Insert into dynamic table if it exists
    $existsStmt->execute(['t' => $tbl]);
    if ($existsStmt->fetch(PDO::FETCH_NUM)) {
        $sql = "INSERT IGNORE INTO `{$tbl}` (lrn, student_user_id, full_name, grade_level, added_by_user_id) VALUES (:lrn, :sid, :name, :gl, :aid)";
        $pdo->prepare($sql)->execute([
            'lrn' => $stu['lrn'] ?? null,
            'sid' => $studentUserId,
            'name' => $stu['name'] ?? null,
            'gl' => $stu['grade_level'] ?? null,
            'aid' => $addedByUserId,
        ]);
    }

    echo json_encode(['success' => true, 'message' => 'Student added successfully']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


