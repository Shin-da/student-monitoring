<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Core\Database;
use Helpers\Csrf;
use Helpers\StaticData;
use PDO;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getAdminDashboardData();

        $this->view->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'pendingCount' => $staticData['pendingCount'],
            'userStats' => $staticData['userStats'],
            'systemStats' => $staticData['systemStats'],
            'recentActivity' => $staticData['recentActivity'],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('dashboard data'),
        ], 'layouts/dashboard');
    }

    public function users(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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
            'staticDataIndicator' => StaticData::getStaticDataIndicator('user management interface - data is dynamic'),
        ], 'layouts/dashboard');
    }

    public function approveUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'CSRF token mismatch']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId) {
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Invalid user ID']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Get user details
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id AND status = "pending"');
            $stmt->execute(['user_id' => $userId]);
            $userToApprove = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userToApprove) {
                throw new \Exception('User not found or not pending approval');
            }

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

            // Create role-specific entry
            $role = $userToApprove['role'];
            switch ($role) {
                case 'student':
                    $stmt = $pdo->prepare('
                        INSERT INTO students (user_id, lrn, grade_level, section_id) 
                        VALUES (:user_id, :lrn, :grade_level, :section_id)
                    ');
                    $stmt->execute([
                        'user_id' => $userId,
                        'lrn' => 'LRN' . str_pad((string)$userId, 6, '0', STR_PAD_LEFT),
                        'grade_level' => 7, // Default grade level
                        'section_id' => 1   // Default section
                    ]);
                    break;

                case 'teacher':
                    $stmt = $pdo->prepare('
                        INSERT INTO teachers (user_id, is_adviser) 
                        VALUES (:user_id, 0)
                    ');
                    $stmt->execute(['user_id' => $userId]);
                    break;

                case 'adviser':
                    $stmt = $pdo->prepare('
                        INSERT INTO teachers (user_id, is_adviser) 
                        VALUES (:user_id, 1)
                    ');
                    $stmt->execute(['user_id' => $userId]);
                    
                    // Also create adviser entry
                    $stmt = $pdo->prepare('
                        INSERT INTO advisers (user_id, section_id) 
                        VALUES (:user_id, :section_id)
                    ');
                    $stmt->execute([
                        'user_id' => $userId,
                        'section_id' => 1 // Default section
                    ]);
                    break;

                case 'parent':
                    // Parents don't need a separate table entry initially
                    // They can be linked to students later
                    break;
            }

            // Update user request status
            $stmt = $pdo->prepare('
                UPDATE user_requests 
                SET status = "approved", 
                    processed_at = NOW(), 
                    processed_by = :admin_id 
                WHERE user_id = :user_id AND status = "pending"
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'user_id' => $userId
            ]);

            // Log the approval action
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "user_approved", "user", :target_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'target_id' => $userId,
                'details' => json_encode([
                    'approved_role' => $role,
                    'user_email' => $userToApprove['email'],
                    'user_name' => $userToApprove['name']
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'status' => 'active', 'message' => 'User approved successfully']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));

        } catch (\Exception $e) {
            $pdo->rollBack();
            
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
        }
    }

    public function rejectUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'CSRF token mismatch']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        $rejectionReason = trim($_POST['rejection_reason'] ?? 'No reason provided');
        
        if (!$userId) {
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Invalid user ID']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Get user details before deletion
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id AND status = "pending"');
            $stmt->execute(['user_id' => $userId]);
            $userToReject = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userToReject) {
                throw new \Exception('User not found or not pending approval');
            }

            // Update user request status to rejected
            $stmt = $pdo->prepare('
                UPDATE user_requests 
                SET status = "rejected", 
                    processed_at = NOW(), 
                    processed_by = :admin_id,
                    rejection_reason = :rejection_reason
                WHERE user_id = :user_id AND status = "pending"
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'user_id' => $userId,
                'rejection_reason' => $rejectionReason
            ]);

            // Delete pending user
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = :user_id AND status = "pending"');
            $stmt->execute(['user_id' => $userId]);

            // Log the rejection action
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "user_rejected", "user", :target_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'target_id' => $userId,
                'details' => json_encode([
                    'rejected_role' => $userToReject['role'],
                    'user_email' => $userToReject['email'],
                    'user_name' => $userToReject['name'],
                    'rejection_reason' => $rejectionReason
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'deleted' => true, 'message' => 'User rejected successfully']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));

        } catch (\Exception $e) {
            $pdo->rollBack();
            
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
        }
    }

    public function suspendUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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

        if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'status' => 'suspended']);
            return;
        }
        header('Location: ' . \Helpers\Url::to('/admin/users'));
    }

    public function activateUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        if (!\Helpers\Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'CSRF token mismatch']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $userId = (int)($_POST['user_id'] ?? 0);
        if (!$userId || $userId === (int)$user['id']) {
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Cannot delete yourself or invalid user ID']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Get user details before deletion
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
            $stmt->execute(['user_id' => $userId]);
            $userToDelete = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userToDelete) {
                throw new \Exception('User not found');
            }

            // Delete role-specific entries first (due to foreign key constraints)
            $role = $userToDelete['role'];
            switch ($role) {
                case 'student':
                    $stmt = $pdo->prepare('DELETE FROM students WHERE user_id = :user_id');
                    $stmt->execute(['user_id' => $userId]);
                    break;

                case 'teacher':
                case 'adviser':
                case 'parent':
                case 'admin':
                    // These roles don't have separate tables in the current schema
                    // They only exist in the users table
                    break;
            }

            // Delete the user
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = :user_id');
            $stmt->execute(['user_id' => $userId]);

            // Log the deletion action
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "user_deleted", "user", :target_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'target_id' => $userId,
                'details' => json_encode([
                    'deleted_role' => $role,
                    'user_email' => $userToDelete['email'],
                    'user_name' => $userToDelete['name']
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'deleted' => true, 'message' => 'User deleted successfully']);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));

        } catch (\Exception $e) {
            $pdo->rollBack();
            
            if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest' || (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                return;
            }
            header('Location: ' . \Helpers\Url::to('/admin/users'));
        }
    }

    public function createUser(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
            $pdo = Database::connection($config['database']);

            // Get all active student users for parent linking (centralized)
                $stmt = $pdo->prepare('
                    SELECT u.id, u.name, s.lrn, s.grade_level 
                    FROM users u 
                    LEFT JOIN students s ON s.user_id = u.id 
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

        } catch (\Exception $e) {
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
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        $this->view->render('admin/logs', [
            'title' => 'System Logs & Audit Trail',
            'user' => $user,
            'activeNav' => 'logs',
        ], 'layouts/dashboard');
    }

    public function createStudent(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'admin') {
            \Helpers\ErrorHandler::forbidden('You need administrator privileges to access this page.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
            $pdo = Database::connection($config['database']);

            // Get available sections for dropdown
            $stmt = $pdo->prepare('SELECT id, name, grade_level, room FROM sections WHERE school_year = "2025-2026" ORDER BY grade_level, name');
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->view->render('admin/create-student', [
                'title' => 'Register New Student',
                'user' => $user,
                'activeNav' => 'users',
                'sections' => $sections,
                'csrf_token' => \Helpers\Csrf::token(),
            ], 'layouts/dashboard');
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            header('Location: ' . \Helpers\Url::to('/admin/create-student'));
            return;
        }

        // Validate required fields
        $requiredFields = [
            'first_name', 'last_name', 'email', 'password', 'grade_level', 'section_id'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $this->view->render('admin/create-student', [
                    'title' => 'Register New Student',
                    'user' => $user,
                    'activeNav' => 'users',
                    'error' => "Please fill in all required fields. Missing: {$field}"
                ], 'layouts/dashboard');
                return;
            }
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Check if email already exists
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $_POST['email']]);
            if ($stmt->fetch()) {
                throw new \Exception('Email already exists in the system.');
            }


            // Check if LRN already exists (if provided)
            if (!empty($_POST['lrn'])) {
                $stmt = $pdo->prepare('SELECT id FROM students WHERE lrn = :lrn LIMIT 1');
                $stmt->execute(['lrn' => $_POST['lrn']]);
                if ($stmt->fetch()) {
                    throw new \Exception('LRN already exists in the system.');
                }
            }

            // Create user account
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $fullName = trim($_POST['first_name'] . ' ' . ($_POST['middle_name'] ?? '') . ' ' . $_POST['last_name']);
            
            $stmt = $pdo->prepare('
                INSERT INTO users (role, email, password_hash, name, status, approved_by, approved_at) 
                VALUES ("student", :email, :password_hash, :name, "active", :approved_by, NOW())
            ');
            $stmt->execute([
                'email' => $_POST['email'],
                'password_hash' => $passwordHash,
                'name' => $fullName,
                'approved_by' => $user['id']
            ]);

            $userId = $pdo->lastInsertId();

            // Generate LRN if not provided
            $lrn = $_POST['lrn'] ?? 'LRN' . str_pad((string)$userId, 6, '0', STR_PAD_LEFT);


            // Create student profile
            $stmt = $pdo->prepare('
                INSERT INTO students (
                    user_id, lrn, first_name, last_name, middle_name,
                    birth_date, gender, contact_number, address, grade_level, section_id,
                    guardian_name, guardian_contact, guardian_relationship, school_year,
                    enrollment_status, previous_school, medical_conditions, allergies,
                    emergency_contact_name, emergency_contact_number, emergency_contact_relationship,
                    notes
                ) VALUES (
                    :user_id, :lrn, :first_name, :last_name, :middle_name,
                    :birth_date, :gender, :contact_number, :address, :grade_level, :section_id,
                    :guardian_name, :guardian_contact, :guardian_relationship, :school_year,
                    :enrollment_status, :previous_school, :medical_conditions, :allergies,
                    :emergency_contact_name, :emergency_contact_number, :emergency_contact_relationship,
                    :notes
                )
            ');

            $stmt->execute([
                'user_id' => $userId,
                'lrn' => $lrn,
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'middle_name' => $_POST['middle_name'] ?? null,
                'birth_date' => $_POST['birth_date'] ?? null,
                'gender' => $_POST['gender'] ?? null,
                'contact_number' => $_POST['contact_number'] ?? null,
                'address' => $_POST['address'] ?? null,
                'grade_level' => (int)$_POST['grade_level'],
                'section_id' => (int)$_POST['section_id'],
                'guardian_name' => $_POST['guardian_name'] ?? null,
                'guardian_contact' => $_POST['guardian_contact'] ?? null,
                'guardian_relationship' => $_POST['guardian_relationship'] ?? null,
                'school_year' => $_POST['school_year'] ?? '2025-2026',
                'enrollment_status' => $_POST['enrollment_status'] ?? 'enrolled',
                'previous_school' => $_POST['previous_school'] ?? null,
                'medical_conditions' => $_POST['medical_conditions'] ?? null,
                'allergies' => $_POST['allergies'] ?? null,
                'emergency_contact_name' => $_POST['emergency_contact_name'] ?? null,
                'emergency_contact_number' => $_POST['emergency_contact_number'] ?? null,
                'emergency_contact_relationship' => $_POST['emergency_contact_relationship'] ?? null,
                'notes' => $_POST['notes'] ?? null
            ]);

            // Log the student creation
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "student_created", "student", :student_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'student_id' => $userId,
                'details' => json_encode([
                    'student_name' => $fullName,
                    'student_email' => $_POST['email'],
                    'student_number' => $studentNumber,
                    'lrn' => $lrn,
                    'grade_level' => $_POST['grade_level'],
                    'section_id' => $_POST['section_id']
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            // Redirect to success page or users list
            header('Location: ' . \Helpers\Url::to('/admin/users?success=student_created&student_id=' . $userId));
            return;

        } catch (\Exception $e) {
            $pdo->rollBack();
            
            // Get sections again for form re-render
            $stmt = $pdo->prepare('SELECT id, name, grade_level, room FROM sections WHERE school_year = "2025-2026" ORDER BY grade_level, name');
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->view->render('admin/create-student', [
                'title' => 'Register New Student',
                'user' => $user,
                'activeNav' => 'users',
                'sections' => $sections,
                'error' => $e->getMessage(),
                'form_data' => $_POST // Preserve form data for user convenience
            ], 'layouts/dashboard');
        }
    }

    /**
     * Display adviser assignment page
     */
    public function assignAdvisers(): void
    {
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            header('Location: ' . \Helpers\Url::to('/login'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            // Get all sections with their current advisers
            $stmt = $pdo->prepare('
                SELECT s.id, s.name, s.grade_level, s.room, s.adviser_id,
                       u.name as adviser_name, u.email as adviser_email
                FROM sections s
                LEFT JOIN users u ON s.adviser_id = u.id
                WHERE s.is_active = 1 AND s.school_year = "2025-2026"
                ORDER BY s.grade_level, s.name
            ');
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get all available advisers (users with adviser role)
            $stmt = $pdo->prepare('
                SELECT u.id, u.name, u.email, t.is_adviser
                FROM users u
                LEFT JOIN teachers t ON u.id = t.user_id
                WHERE u.role = "adviser" AND u.status = "active"
                ORDER BY u.name
            ');
            $stmt->execute();
            $advisers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get teachers who can be assigned as advisers
            $stmt = $pdo->prepare('
                SELECT u.id, u.name, u.email, t.is_adviser
                FROM users u
                LEFT JOIN teachers t ON u.id = t.user_id
                WHERE u.role = "teacher" AND u.status = "active"
                ORDER BY u.name
            ');
            $stmt->execute();
            $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->view->render('admin/assign-advisers', [
                'title' => 'Assign Advisers to Sections',
                'user' => $user,
                'activeNav' => 'sections',
                'sections' => $sections,
                'advisers' => $advisers,
                'teachers' => $teachers
            ], 'layouts/dashboard');

        } catch (\Exception $e) {
            $this->view->render('admin/assign-advisers', [
                'title' => 'Assign Advisers to Sections',
                'user' => $user,
                'activeNav' => 'sections',
                'sections' => [],
                'advisers' => [],
                'teachers' => [],
                'error' => $e->getMessage()
            ], 'layouts/dashboard');
        }
    }

    /**
     * Handle adviser assignment (POST)
     */
    public function assignAdviser(): void
    {
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            header('Location: ' . \Helpers\Url::to('/login'));
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=csrf_invalid'));
            return;
        }

        $sectionId = (int)($_POST['section_id'] ?? 0);
        $adviserId = (int)($_POST['adviser_id'] ?? 0);

        if (!$sectionId || !$adviserId) {
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=missing_data'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Check if section exists
            $stmt = $pdo->prepare('SELECT id, name FROM sections WHERE id = ? AND is_active = 1');
            $stmt->execute([$sectionId]);
            $section = $stmt->fetch();
            if (!$section) {
                throw new \Exception('Section not found.');
            }

            // Check if adviser exists and is active
            $stmt = $pdo->prepare('SELECT id, name, role FROM users WHERE id = ? AND status = "active"');
            $stmt->execute([$adviserId]);
            $adviser = $stmt->fetch();
            if (!$adviser) {
                throw new \Exception('Adviser not found or inactive.');
            }

            // Ensure user has adviser role
            if ($adviser['role'] !== 'adviser') {
                // Update user role to adviser if they're a teacher
                if ($adviser['role'] === 'teacher') {
                    $stmt = $pdo->prepare('UPDATE users SET role = "adviser" WHERE id = ?');
                    $stmt->execute([$adviserId]);
                } else {
                    throw new \Exception('User must be a teacher or adviser to be assigned as section adviser.');
                }
            }

            // Check if adviser is already assigned to another section
            $stmt = $pdo->prepare('SELECT id, name FROM sections WHERE adviser_id = ? AND id != ? AND is_active = 1');
            $stmt->execute([$adviserId, $sectionId]);
            $existingAssignment = $stmt->fetch();
            if ($existingAssignment) {
                throw new \Exception('This adviser is already assigned to section: ' . $existingAssignment['name']);
            }

            // Remove current adviser from this section (if any)
            $stmt = $pdo->prepare('UPDATE sections SET adviser_id = NULL WHERE id = ?');
            $stmt->execute([$sectionId]);

            // Assign new adviser to section
            $stmt = $pdo->prepare('UPDATE sections SET adviser_id = ? WHERE id = ?');
            $stmt->execute([$adviserId, $sectionId]);

            // Update teacher record to mark as adviser
            $stmt = $pdo->prepare('UPDATE teachers SET is_adviser = 1 WHERE user_id = ?');
            $stmt->execute([$adviserId]);

            // Log the assignment
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "adviser_assigned", "section", :section_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'section_id' => $sectionId,
                'details' => json_encode([
                    'section_name' => $section['name'],
                    'adviser_name' => $adviser['name'],
                    'adviser_id' => $adviserId
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?success=adviser_assigned&section=' . urlencode($section['name']) . '&adviser=' . urlencode($adviser['name'])));

        } catch (\Exception $e) {
            $pdo->rollBack();
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=' . urlencode($e->getMessage())));
        }
    }

    /**
     * Remove adviser from section
     */
    public function removeAdviser(): void
    {
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            header('Location: ' . \Helpers\Url::to('/login'));
            return;
        }

        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=csrf_invalid'));
            return;
        }

        $sectionId = (int)($_POST['section_id'] ?? 0);

        if (!$sectionId) {
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=missing_section'));
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        try {
            $pdo->beginTransaction();

            // Get section and current adviser info
            $stmt = $pdo->prepare('
                SELECT s.id, s.name, s.adviser_id, u.name as adviser_name
                FROM sections s
                LEFT JOIN users u ON s.adviser_id = u.id
                WHERE s.id = ? AND s.is_active = 1
            ');
            $stmt->execute([$sectionId]);
            $section = $stmt->fetch();
            
            if (!$section) {
                throw new \Exception('Section not found.');
            }

            if (!$section['adviser_id']) {
                throw new \Exception('No adviser assigned to this section.');
            }

            // Remove adviser from section
            $stmt = $pdo->prepare('UPDATE sections SET adviser_id = NULL WHERE id = ?');
            $stmt->execute([$sectionId]);

            // Check if this adviser is assigned to any other sections
            $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM sections WHERE adviser_id = ? AND is_active = 1');
            $stmt->execute([$section['adviser_id']]);
            $otherAssignments = $stmt->fetch();

            // If no other assignments, remove adviser flag from teacher record
            if ($otherAssignments['count'] == 0) {
                $stmt = $pdo->prepare('UPDATE teachers SET is_adviser = 0 WHERE user_id = ?');
                $stmt->execute([$section['adviser_id']]);
            }

            // Log the removal
            $stmt = $pdo->prepare('
                INSERT INTO audit_logs (user_id, action, target_type, target_id, details, ip_address, user_agent) 
                VALUES (:admin_id, "adviser_removed", "section", :section_id, :details, :ip, :user_agent)
            ');
            $stmt->execute([
                'admin_id' => $user['id'],
                'section_id' => $sectionId,
                'details' => json_encode([
                    'section_name' => $section['name'],
                    'adviser_name' => $section['adviser_name'],
                    'adviser_id' => $section['adviser_id']
                ]),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);

            $pdo->commit();

            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?success=adviser_removed&section=' . urlencode($section['name']) . '&adviser=' . urlencode($section['adviser_name'])));

        } catch (\Exception $e) {
            $pdo->rollBack();
            header('Location: ' . \Helpers\Url::to('/admin/assign-advisers?error=' . urlencode($e->getMessage())));
        }
    }
}


