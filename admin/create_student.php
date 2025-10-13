<?php
// ADDED BY CURSOR on 2025-10-13: Admin endpoint to create student (users + students) with transaction and validations
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
	http_response_code(405);
	echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
	exit;
}

define('BASE_PATH', dirname(__DIR__));

// Prefer /database/dbconnect.php if present, otherwise fallback to Core\Database
$dbconnect = BASE_PATH . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'dbconnect.php';
$hasDbConnect = is_file($dbconnect);
if ($hasDbConnect) {
	require_once $dbconnect;
}

// Fallback includes
$config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
$dbCorePath = BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Database.php';
if (is_file($dbCorePath)) {
	require_once $dbCorePath;
}

// note: using \PDO directly; no use statement required

// Read JSON or x-www-form-urlencoded
$raw = file_get_contents('php://input');
$data = json_decode($raw ?: 'null', true);
if (!is_array($data)) {
	$data = $_POST;
}

// Extract inputs
$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$password = (string)($data['password'] ?? '');

$lrn = trim((string)($data['lrn'] ?? ''));
$gradeLevel = isset($data['grade_level']) ? (int)$data['grade_level'] : null;
$sectionId = isset($data['section_id']) ? (int)$data['section_id'] : null;
$schoolYear = trim((string)($data['school_year'] ?? ''));
$adviserId = isset($data['adviser_id']) ? (int)$data['adviser_id'] : null;

$contactName = trim((string)($data['contact_name'] ?? ''));
$emergencyContact = trim((string)($data['emergency_contact'] ?? ''));
$relationship = trim((string)($data['relationship'] ?? ''));
$address = trim((string)($data['address'] ?? ''));

// Basic validation
if ($name === '' || $email === '' || $password === '' || $lrn === '' || $gradeLevel === null || $sectionId === null || $schoolYear === '' || $adviserId === null) {
	http_response_code(422);
	echo json_encode(['success' => false, 'message' => 'Missing required fields']);
	exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	http_response_code(422);
	echo json_encode(['success' => false, 'message' => 'Invalid email']);
	exit;
}

// Obtain PDO
try {
    if ($hasDbConnect && isset($pdo) && $pdo instanceof \PDO) {
		$db = $pdo;
	} elseif ($hasDbConnect && function_exists('getPdo')) {
		$db = getPdo();
	} elseif (class_exists('Core\\Database')) {
		$db = \Core\Database::connection($config['database']);
	} else {
		throw new RuntimeException('Database connection not available');
	}

    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

	// Uniqueness checks
	$st = $db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
	$st->execute([':email' => $email]);
    if ($st->fetch(\PDO::FETCH_ASSOC)) {
		echo json_encode(['success' => false, 'message' => 'Email already exists']);
		exit;
	}

	$st = $db->prepare('SELECT id FROM students WHERE lrn = :lrn LIMIT 1');
	$st->execute([':lrn' => $lrn]);
    if ($st->fetch(\PDO::FETCH_ASSOC)) {
		echo json_encode(['success' => false, 'message' => 'LRN already exists']);
		exit;
	}

	$db->beginTransaction();

	// Insert user
	$hash = password_hash($password, PASSWORD_BCRYPT);
	$insUser = $db->prepare('INSERT INTO users (role, email, password_hash, name, phone, address, status, created_at) VALUES ("student", :email, :hash, :name, :phone, :address, "active", NOW())');
	$insUser->execute([
		':email' => $email,
		':hash' => $hash,
		':name' => $name,
		':phone' => null,
		':address' => $address !== '' ? $address : null,
	]);
    $userId = (int)$db->lastInsertId();
	if ($userId <= 0) {
		$db->rollBack();
		http_response_code(500);
		echo json_encode(['success' => false, 'message' => 'Failed to create user']);
		exit;
	}

	// Insert student
	$insStudent = $db->prepare('INSERT INTO students (user_id, lrn, grade_level, section_id, school_year, adviser_id, contact_name, emergency_contact, relationship, address, date_enrolled) VALUES (:user_id, :lrn, :grade_level, :section_id, :school_year, :adviser_id, :contact_name, :emergency_contact, :relationship, :address, NOW())');
	$insStudent->execute([
		':user_id' => $userId,
		':lrn' => $lrn,
		':grade_level' => $gradeLevel,
		':section_id' => $sectionId,
		':school_year' => $schoolYear,
		':adviser_id' => $adviserId,
		':contact_name' => $contactName !== '' ? $contactName : null,
		':emergency_contact' => $emergencyContact !== '' ? $emergencyContact : null,
		':relationship' => $relationship !== '' ? $relationship : null,
		':address' => $address !== '' ? $address : null,
	]);

	$db->commit();

	echo json_encode(['success' => true, 'message' => 'Student created successfully']);
} catch (\Throwable $e) {
    if (isset($db) && $db instanceof \PDO && $db->inTransaction()) {
		$db->rollBack();
	}
	// Safe error
	http_response_code(500);
	echo json_encode(['success' => false, 'message' => 'Server error']);
}


