<?php
use Core\Router;
use Controllers\HomeController;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\TeacherController;
use Controllers\AdviserController;
use Controllers\StudentController;
use Controllers\ParentController;

/** @var Router $router */

$router->get('/', [HomeController::class, 'index']);

// Auth
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->post('/logout', [AuthController::class, 'logout']);

// Admin
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/create-user', [AdminController::class, 'createUser']);
$router->post('/admin/create-user', [AdminController::class, 'createUser']);
$router->post('/admin/approve-user', [AdminController::class, 'approveUser']);
$router->post('/admin/reject-user', [AdminController::class, 'rejectUser']);
$router->post('/admin/suspend-user', [AdminController::class, 'suspendUser']);
$router->post('/admin/activate-user', [AdminController::class, 'activateUser']);
$router->get('/admin/create-parent', [AdminController::class, 'createParent']);
$router->post('/admin/create-parent', [AdminController::class, 'createParent']);

// Role dashboards
$router->get('/teacher', [TeacherController::class, 'dashboard']);
$router->get('/teacher/alerts', [TeacherController::class, 'alerts']);
$router->get('/adviser', [AdviserController::class, 'dashboard']);
$router->get('/student', [StudentController::class, 'dashboard']);
$router->get('/parent', [ParentController::class, 'dashboard']);


