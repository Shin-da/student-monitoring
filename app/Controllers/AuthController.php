<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Core\Database;
use Helpers\Validator;
use Helpers\Csrf;
use PDO;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view->render('auth/login', ['title' => 'Login'], 'layouts/auth');
    }

    public function login(): void
    {
        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            $this->view->render('auth/login', ['title' => 'Login', 'error' => 'Security token expired. Please try again.'], 'layouts/auth');
            return;
        }

        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        if (!Validator::email($email) || !Validator::required($password)) {
            $this->view->render('auth/login', ['title' => 'Login', 'error' => 'Invalid credentials'], 'layouts/auth');
            return;
        }

        try {
            $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
            $pdo = Database::connection($config['database']);

            $stmt = $pdo->prepare('SELECT id, name, role, password_hash, status FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            http_response_code(500);
            $this->view->render('auth/login', ['title' => 'Login', 'error' => 'Login is temporarily unavailable. Please check database setup and try again.'], 'layouts/auth');
            return;
        }

        if (!$user || !password_verify($password, $user['password_hash'] ?? '')) {
            $this->view->render('auth/login', ['title' => 'Login', 'error' => 'Invalid credentials'], 'layouts/auth');
            return;
        }

        // Check if account is active
        if ($user['status'] !== 'active') {
            $statusMessage = match($user['status']) {
                'pending' => 'Your account is pending approval. Please contact the administrator.',
                'suspended' => 'Your account has been suspended. Please contact the administrator.',
                default => 'Your account is not active. Please contact the administrator.'
            };
            $this->view->render('auth/login', ['title' => 'Login', 'error' => $statusMessage], 'layouts/auth');
            return;
        }

        // Regenerate session ID to prevent fixation
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }

        Session::set('user', ['id' => (int)$user['id'], 'name' => $user['name'], 'role' => $user['role']]);

        $redirects = [
            'admin' => '/admin',
            'teacher' => '/teacher',
            'adviser' => '/adviser',
            'student' => '/student',
            'parent' => '/parent',
        ];
        $dest = $redirects[$user['role']] ?? '/';
        $location = \Helpers\Url::to($dest);
        header('Location: ' . $location);
    }

    public function showRegister(): void
    {
        $this->view->render('auth/register', ['title' => 'Register'], 'layouts/auth');
    }

    public function register(): void
    {
        if (!Csrf::check($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            $this->view->render('auth/register', ['title' => 'Register', 'error' => 'Security token expired. Please try again.'], 'layouts/auth');
            return;
        }

        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $requestedRole = trim((string)($_POST['role'] ?? 'student'));

        if (!Validator::required($name) || !Validator::email($email) || !Validator::minLength($password, 8)) {
            $this->view->render('auth/register', ['title' => 'Register', 'error' => 'Please provide valid details.'], 'layouts/auth');
            return;
        }

        // Only allow student registration for self-registration
        if (!in_array($requestedRole, ['student'])) {
            $this->view->render('auth/register', ['title' => 'Register', 'error' => 'Invalid registration type.'], 'layouts/auth');
            return;
        }

        $config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $pdo = Database::connection($config['database']);

        // Check uniqueness of email
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $this->view->render('auth/register', ['title' => 'Register', 'error' => 'Email already in use.'], 'layouts/auth');
            return;
        }

        try {
            $pdo->beginTransaction();

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare('INSERT INTO users (role, email, password_hash, name, status, requested_role) VALUES (:role, :email, :hash, :name, :status, :requested_role)');
            // Create pending account - admin must approve
            $ok = $insert->execute([
                'role' => $requestedRole, 
                'email' => $email, 
                'hash' => $hash, 
                'name' => $name,
                'status' => 'pending',
                'requested_role' => $requestedRole
            ]);
            
            if (!$ok) {
                throw new \Exception('Failed to create user account');
            }

            $userId = $pdo->lastInsertId();

            // Create user request entry
            $stmt = $pdo->prepare('
                INSERT INTO user_requests (user_id, requested_role, status, additional_data) 
                VALUES (:user_id, :requested_role, "pending", :additional_data)
            ');
            $stmt->execute([
                'user_id' => $userId,
                'requested_role' => $requestedRole,
                'additional_data' => json_encode([
                    'registration_ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                    'registration_user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
                    'registration_time' => date('Y-m-d H:i:s')
                ])
            ]);

            $pdo->commit();

            $this->view->render('auth/register', [
                'title' => 'Register', 
                'success' => 'Registration successful! Your account is pending approval. You will be notified once an administrator approves your account.'
            ], 'layouts/auth');

        } catch (\Exception $e) {
            $pdo->rollBack();
            $this->view->render('auth/register', ['title' => 'Register', 'error' => 'Registration failed. Please try again.'], 'layouts/auth');
        }
    }

    public function logout(): void
    {
        // Optional: enforce POST + CSRF (if logout is a form with token)
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            if (!Csrf::check($_POST['csrf_token'] ?? null)) {
                http_response_code(419);
                header('Location: ' . \Helpers\Url::to('/'));
                return;
            }
        }
        Session::destroy();
        header('Location: ' . \Helpers\Url::to('/'));
    }
}


