<?php
declare(strict_types=1);

// JSON API endpoint: /api/create_user.php
// Accepts POST JSON and creates a user (and student record if role is 'student')

header('Content-Type: application/json; charset=utf-8');

// Only allow POST
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// Resolve base path and load config/DB
define('BASE_PATH', dirname(__DIR__));

$configFile = BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
$dbFile = BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Database.php';

if (!file_exists($configFile) || !file_exists($dbFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server configuration error']);
    exit;
}

$config = require $configFile;
require_once $dbFile;

use Core\Database;
use PDO;

// Read JSON body
$raw = file_get_contents('php://input');
$data = json_decode($raw ?: 'null', true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON body']);
    exit;
}

// Extract and validate inputs
$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$password = (string)($data['password'] ?? '');
$role = trim((string)($data['role'] ?? ''));

// Optional centralized fields for specific roles
$lrn = isset($data['lrn']) ? trim((string)$data['lrn']) : null; // students
$gradeLevel = isset($data['grade_level']) ? (int)$data['grade_level'] : null; // students
$sectionName = isset($data['section_name']) ? trim((string)$data['section_name']) : null; // students
$isAdviser = isset($data['is_adviser']) ? (int)!!$data['is_adviser'] : 0; // teachers
$linkedStudentUserId = isset($data['linked_student_user_id']) ? (int)$data['linked_student_user_id'] : null; // parents
$parentRelationship = isset($data['parent_relationship']) ? trim((string)$data['parent_relationship']) : null; // parents

if ($name === '' || $email === '' || $password === '' || $role === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

// Basic role check
$allowedRoles = ['admin', 'teacher', 'adviser', 'student', 'parent'];
if (!in_array($role, $allowedRoles, true)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Invalid role']);
    exit;
}

try {
    $pdo = Database::connection($config['database']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Uniqueness check for email
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Email already exists.']);
        exit;
    }

    $pdo->beginTransaction();

    // Insert user, adding optional fields only if columns exist
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Discover available columns on users table
    $colsStmt = $pdo->query('SHOW COLUMNS FROM users');
    $availableCols = [];
    foreach ($colsStmt->fetchAll(PDO::FETCH_ASSOC) as $c) {
        $availableCols[strtolower($c['Field'])] = true;
    }

    $columns = ['role', 'email', 'password_hash', 'name', 'status'];
    $placeholders = [':role', ':email', ':hash', ':name', ':status'];
    $params = [
        'role' => $role,
        'email' => $email,
        'hash' => $passwordHash,
        'name' => $name,
        'status' => 'active',
    ];

    // created_at if present
    if (isset($availableCols['created_at'])) {
        $columns[] = 'created_at';
        $placeholders[] = 'NOW()';
    }

    // Optional centralized fields
    if (isset($availableCols['lrn']) && $role === 'student') {
        $columns[] = 'lrn';
        $placeholders[] = ':lrn';
        $params['lrn'] = $lrn ?: null;
    }
    if (isset($availableCols['grade_level']) && $role === 'student') {
        $columns[] = 'grade_level';
        $placeholders[] = ':grade_level';
        $params['grade_level'] = $gradeLevel ?: null;
    }
    if (isset($availableCols['section_name']) && $role === 'student') {
        $columns[] = 'section_name';
        $placeholders[] = ':section_name';
        $params['section_name'] = $sectionName ?: null;
    }
    if (isset($availableCols['is_adviser']) && in_array($role, ['teacher','adviser'], true)) {
        $columns[] = 'is_adviser';
        $placeholders[] = ':is_adviser';
        $params['is_adviser'] = (int)$isAdviser;
    }
    if (isset($availableCols['linked_student_user_id']) && $role === 'parent') {
        $columns[] = 'linked_student_user_id';
        $placeholders[] = ':linked_student_user_id';
        $params['linked_student_user_id'] = $linkedStudentUserId ?: null;
    }
    if (isset($availableCols['parent_relationship']) && $role === 'parent') {
        $columns[] = 'parent_relationship';
        $placeholders[] = ':parent_relationship';
        $params['parent_relationship'] = $parentRelationship ?: null;
    }

    $sql = 'INSERT INTO users (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')';
    $insertUser = $pdo->prepare($sql);
    $ok = $insertUser->execute($params);

    if (!$ok) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
        exit;
    }

    $userId = (int)$pdo->lastInsertId();

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'User created successfully.',
        'user_id' => $userId,
    ]);
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}


