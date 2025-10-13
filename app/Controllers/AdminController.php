<?php
// MODIFIED BY CURSOR on 2025-10-13: Fix student listing query to join students table for lrn/grade_level
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Core\Database;
use Helpers\Csrf;
use PDO;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Get pending users count
        $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM users WHERE status = "pending"');
        $stmt->execute();
        $pendingCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Get total users by role
        $stmt = $pdo->prepare('SELECT role, COUNT(*) as count FROM users WHERE status = "active" GROUP BY role');
        $stmt->execute();
        $userStats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'pendingCount' => $pendingCount,
            'userStats' => $userStats,
        ], 'layouts/dashboard');
    }

    public function users(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Get all users with their status
        $stmt = $pdo->prepare('
            SELECT u.*, 
                   approver.name as approved_by_name
            FROM users u 
            LEFT JOIN users approver ON u.approved_by = approver.id 
            ORDER BY u.created_at DESC
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view->render('admin/users', [
            'title' => 'User Management',
            'user' => $user,
            'activeNav' => 'users',
            'users' => $users,
            'csrf_token' => \Helpers\Csrf::token(),
        ], 'layouts/dashboard');
    }

    public function approveUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId) {
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Update user status to active and set approval info
        $stmt = $pdo->prepare('
            UPDATE users 
            SET status = "active", 
                approved_by = :admin_id, 
                approved_at = NOW() 
            WHERE id = :user_id AND status = "pending"
        ');
        $stmt->execute([
            'admin_id' => $user['id'],
            'user_id' => $userId
        ]);

<<<<<<< Updated upstream
        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'status' => 'active']);
            return;
        }
=======
>>>>>>> Stashed changes
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function rejectUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId) {
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Delete pending user
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :user_id AND status = "pending"');
        $stmt->execute(['user_id' => $userId]);

<<<<<<< Updated upstream
        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'deleted' => true]);
            return;
        }
=======
>>>>>>> Stashed changes
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function suspendUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId) {
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Suspend user
        $stmt = $pdo->prepare('UPDATE users SET status = "suspended" WHERE id = :user_id AND id != :admin_id');
        $stmt->execute([
            'user_id' => $userId,
            'admin_id' => $user['id'] // Prevent admin from suspending themselves
        ]);

<<<<<<< Updated upstream
        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'status' => 'suspended']);
            return;
        }
=======
>>>>>>> Stashed changes
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function activateUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId) {
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Activate user
        $stmt = $pdo->prepare('UPDATE users SET status = "active" WHERE id = :user_id');
        $stmt->execute(['user_id' => $userId]);

<<<<<<< Updated upstream
        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'status' => 'active']);
            return;
        }
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function deleteUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if (!\Helpers\Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'CSRF failed']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId || $userId === (int)$user['id']) {
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Invalid user id']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :user_id');
        $ok = $stmt->execute(['user_id' => $userId]);

        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => (bool)$ok, 'deleted' => (bool)$ok]);
            return;
        }
=======
>>>>>>> Stashed changes
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function createUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view->render('admin/create-user', [
                'title' => 'Create User',
                'user' => $user,
                'activeNav' => 'users',
            ], 'layouts/dashboard');
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/create-user'));
            return;
        }

        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $role = trim((string)($_POST['role'] ?? ''));
        $status = trim((string)($_POST['status'] ?? 'active'));

        if (!\Helpers\Validator::required($name) || !\Helpers\Validator::email($email) || 
            !\Helpers\Validator::minLength($password, 8) || !in_array($role, ['admin', 'teacher', 'adviser', 'student', 'parent'])) {
            $this->view->render('admin/create-user', [
                'title' => 'Create User',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Please provide valid details.'
            ], 'layouts/dashboard');
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Check uniqueness of email
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $this->view->render('admin/create-user', [
                'title' => 'Create User',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Email already in use.'
            ], 'layouts/dashboard');
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $pdo->prepare('
            INSERT INTO users (role, email, password_hash, name, status, approved_by, approved_at) 
            VALUES (:role, :email, :hash, :name, :status, :approved_by, NOW())
        ');
        $ok = $insert->execute([
            'role' => $role,
            'email' => $email,
            'hash' => $hash,
            'name' => $name,
            'status' => $status,
            'approved_by' => $user['id']
        ]);

        if (!$ok) {
            $this->view->render('admin/create-user', [
                'title' => 'Create User',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'User creation failed. Please try again.'
            ], 'layouts/dashboard');
            return;
        }

        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function createParent(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
            $pdo = Database::connection($config['database']);

            // Get all active student users for parent linking with student details
            $stmt = $pdo->prepare('
                SELECT u.id AS id, u.name AS name, s.lrn, s.grade_level
                FROM users u
                JOIN students s ON s.user_id = u.id
                WHERE u.role = "student" AND u.status = "active"
                ORDER BY u.name
            ');
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->view->render('admin/create-parent', [
                'title' => 'Create Parent Account',
                'user' => $user,
                'activeNav' => 'users',
                'students' => $students,
            ], 'layouts/dashboard');
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/create-parent'));
            return;
        }

        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $studentId = (int)($_POST['student_id'] ?? 0);
        $relationship = trim((string)($_POST['relationship'] ?? 'guardian'));

        if (!\Helpers\Validator::required($name) || !\Helpers\Validator::email($email) || 
            !\Helpers\Validator::minLength($password, 8) || !$studentId) {
            $this->view->render('admin/create-parent', [
                'title' => 'Create Parent Account',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Please provide valid details.'
            ], 'layouts/dashboard');
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Check uniqueness of email
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $this->view->render('admin/create-parent', [
                'title' => 'Create Parent Account',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Email already in use.'
            ], 'layouts/dashboard');
            return;
        }

        // Verify student user exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE id = :id AND role = "student" LIMIT 1');
        $stmt->execute(['id' => $studentId]);
        if (!$stmt->fetch()) {
            $this->view->render('admin/create-parent', [
                'title' => 'Create Parent Account',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Selected student does not exist.'
            ], 'layouts/dashboard');
            return;
        }

        try {
            $pdo->beginTransaction();

            // Create parent user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare('
                INSERT INTO users (role, email, password_hash, name, status, approved_by, approved_at) 
                VALUES ("parent", :email, :hash, :name, "active", :approved_by, NOW())
            ');
            $insert->execute([
                'email' => $email,
                'hash' => $hash,
                'name' => $name,
                'approved_by' => $user['id']
            ]);

            $parentUserId = $pdo->lastInsertId();

            // Link parent to student in centralized users table
            $update = $pdo->prepare('
                UPDATE users 
                SET linked_student_user_id = :student_user_id,
                    parent_relationship = :relationship
                WHERE id = :parent_user_id
            ');
            $update->execute([
                'student_user_id' => $studentId,
                'relationship' => $relationship,
                'parent_user_id' => $parentUserId,
            ]);

            $pdo->commit();
            header('Location: ' . \Helpers\Url::to('/admin/users'));

        } catch (Exception $e) {
            $pdo->rollBack();
            $this->view->render('admin/create-parent', [
                'title' => 'Create Parent Account',
                'user' => $user,
                'activeNav' => 'users',
                'error' => 'Parent creation failed. Please try again.'
            ], 'layouts/dashboard');
        }
    }

    public function settings(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        $this->view->render('admin/settings', [
            'title' => 'System Settings',
            'user' => $user,
            'activeNav' => 'settings',
        ], 'layouts/dashboard');
    }

    public function reports(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Get user statistics for reports
        $stmt = $pdo->prepare('SELECT role, COUNT(*) as count FROM users WHERE status = "active" GROUP BY role');
        $stmt->execute();
        $userStats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate totals
        $totalUsers = array_sum(array_column($userStats, 'count'));
        $studentCount = 0;
        $teacherCount = 0;
        $parentCount = 0;

        foreach ($userStats as $stat) {
            switch ($stat['role']) {
                case 'student':
                    $studentCount = (int)$stat['count'];
                    break;
                case 'teacher':
                    $teacherCount = (int)$stat['count'];
                    break;
                case 'parent':
                    $parentCount = (int)$stat['count'];
                    break;
            }
        }

        $this->view->render('admin/reports', [
            'title' => 'Reports & Analytics',
            'user' => $user,
            'activeNav' => 'reports',
            'totalUsers' => $totalUsers,
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'parentCount' => $parentCount,
        ], 'layouts/dashboard');
    }

    public function logs(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\Response::forbidden();
            return;
        }

        $this->view->render('admin/logs', [
            'title' => 'System Logs & Audit Trail',
            'user' => $user,
            'activeNav' => 'logs',
        ], 'layouts/dashboard');
    }
}


