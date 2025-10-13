<?php
// ADDED BY CURSOR on 2025-10-13: Teacher endpoint to fetch joined student list for dashboards
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
	http_response_code(405);
	echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
	exit;
}

define('BASE_PATH', dirname(__DIR__));

// Prefer /database/dbconnect.php
$dbconnect = BASE_PATH . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'dbconnect.php';
if (!is_file($dbconnect)) {
	http_response_code(500);
	echo json_encode(['success' => false, 'message' => 'Database configuration not found']);
	exit;
}
require_once $dbconnect;

use PDO;

try {
	if (!isset($pdo) || !($pdo instanceof PDO)) {
		if (function_exists('getPdo')) {
			$pdo = getPdo();
		} else {
			throw new RuntimeException('PDO not available');
		}
	}
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT s.id, s.lrn, u.name AS student_name, s.grade_level, sec.class_name, sec.section, s.school_year
			FROM students s
			JOIN users u ON s.user_id = u.id
			LEFT JOIN sections sec ON s.section_id = sec.section_id
			ORDER BY s.date_enrolled DESC';

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	echo json_encode(['success' => true, 'data' => $rows]);
} catch (\Throwable $e) {
	http_response_code(500);
	echo json_encode(['success' => false, 'message' => 'Server error']);
}


