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

try {
    $pdo = Database::connection($config['database']);

    $rawInput = file_get_contents('php://input');
    $data = json_decode($rawInput ?: 'null', true);
    if (!is_array($data)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON', 'raw_input' => $rawInput]);
        exit;
    }

    $className = trim((string)($data['class_name'] ?? ''));
    $subject = trim((string)($data['subject'] ?? ''));
    $gradeLevel = trim((string)($data['grade_level'] ?? ''));
    $section = trim((string)($data['section'] ?? ''));
    $room = trim((string)($data['room'] ?? ''));
    $maxStudents = isset($data['max_students']) ? (int)$data['max_students'] : null;
    $description = isset($data['description']) ? trim((string)$data['description']) : null;

    if ($className === '' || $subject === '' || $gradeLevel === '' || $section === '') {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Please fill all required fields']);
        exit;
    }

    if ($maxStudents !== null && ($maxStudents < 1 || $maxStudents > 200)) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Max students must be between 1 and 200']);
        exit;
    }

    $sql = 'INSERT INTO sections (class_name, subject, grade_level, section, room, max_students, description, date_created)
            VALUES (:class_name, :subject, :grade_level, :section, :room, :max_students, :description, NOW())';
    $stmt = $pdo->prepare($sql);
    $ok = $stmt->execute([
        'class_name' => $className,
        'subject' => $subject,
        'grade_level' => $gradeLevel,
        'section' => $section,
        'room' => $room ?: null,
        'max_students' => $maxStudents,
        'description' => $description,
    ]);

    if (!$ok) {
        throw new RuntimeException('Insert failed');
    }

    echo json_encode(['success' => true, 'message' => 'Class created successfully', 'id' => (int)$pdo->lastInsertId()]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


