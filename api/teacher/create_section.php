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

    $teacherUserId = (int)($data['teacher_user_id'] ?? 0);
    $sectionName = trim((string)($data['section_name'] ?? ''));
    $gradeLevel = (int)($data['grade_level'] ?? 0);
    $description = isset($data['description']) ? trim((string)$data['description']) : null;

    if ($teacherUserId <= 0 || $sectionName === '' || $gradeLevel <= 0) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Validate teacher role
    $st = $pdo->prepare('SELECT id, role FROM users WHERE id = :id AND role IN ("teacher","adviser") LIMIT 1');
    $st->execute(['id' => $teacherUserId]);
    if (!$st->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Invalid teacher']);
        exit;
    }

    // Prevent duplicate section name per teacher
    $chk = $pdo->prepare('SELECT id FROM sections WHERE teacher_user_id = :t AND section_name = :n LIMIT 1');
    $chk->execute(['t' => $teacherUserId, 'n' => $sectionName]);
    if ($chk->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Section name already exists']);
        exit;
    }

    // Create section with transactional safety including dynamic table creation
    $pdo->beginTransaction();

    $ins = $pdo->prepare('INSERT INTO sections (teacher_user_id, section_name, grade_level, description) VALUES (:t, :n, :g, :d)');
    if (!$ins->execute(['t' => $teacherUserId, 'n' => $sectionName, 'g' => $gradeLevel, 'd' => $description])) {
        throw new RuntimeException('Insert failed');
    }
    $sectionId = (int)$pdo->lastInsertId();

    // Sanitize table name: section_<simplified>
    $simplified = strtolower($sectionName);
    $simplified = preg_replace('/[^a-z0-9]+/i', '_', $simplified);
    $simplified = trim($simplified, '_');
    if ($simplified === '') { $simplified = 'untitled'; }
    $baseTable = 'section_' . $simplified;

    // Ensure unique table name
    $tbl = $baseTable;
    $suffix = 1;
    $existsStmt = $pdo->prepare('SHOW TABLES LIKE :t');
    while (true) {
        $existsStmt->execute(['t' => $tbl]);
        if (!$existsStmt->fetch(PDO::FETCH_NUM)) break;
        $tbl = $baseTable . '_' . $suffix++;
    }

    // Create dynamic per-section table (centralized users FK)
    $createSql = "CREATE TABLE `{$tbl}` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `lrn` VARCHAR(20) NOT NULL,
        `student_user_id` INT UNSIGNED NOT NULL,
        `full_name` VARCHAR(100) NULL,
        `grade_level` TINYINT UNSIGNED NULL,
        `added_by_user_id` INT UNSIGNED NULL,
        `date_added` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT `fk_{$tbl}_student_user` FOREIGN KEY (`student_user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
        CONSTRAINT `fk_{$tbl}_added_by_user` FOREIGN KEY (`added_by_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
        UNIQUE KEY `uq_{$tbl}_student` (`student_user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $pdo->exec($createSql);

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Section created successfully',
        'id' => $sectionId,
        'table_name' => $tbl,
        'section_name_simplified' => $simplified
    ]);
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


