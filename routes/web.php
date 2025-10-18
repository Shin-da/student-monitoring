<?php
use Core\Router;
use Controllers\HomeController;
use Controllers\AuthController;
use Controllers\AdminController;
use Controllers\TeacherController;
use Controllers\AdviserController;
use Controllers\StudentController;
use Controllers\ParentController;
use Controllers\ErrorController;

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
$router->post('/admin/delete-user', [AdminController::class, 'deleteUser']);
$router->get('/admin/create-parent', [AdminController::class, 'createParent']);
$router->post('/admin/create-parent', [AdminController::class, 'createParent']);
$router->get('/admin/settings', [AdminController::class, 'settings']);
$router->get('/admin/reports', [AdminController::class, 'reports']);
$router->get('/admin/logs', [AdminController::class, 'logs']);

// Role dashboards
$router->get('/teacher', [TeacherController::class, 'dashboard']);
$router->get('/teacher/alerts', [TeacherController::class, 'alerts']);
$router->get('/adviser', [AdviserController::class, 'dashboard']);
$router->get('/student', [StudentController::class, 'dashboard']);
$router->get('/parent', [ParentController::class, 'dashboard']);

// Student pages
$router->get('/student/grades', [StudentController::class, 'grades']);
$router->get('/student/assignments', [StudentController::class, 'assignments']);
$router->get('/student/profile', [StudentController::class, 'profile']);
$router->get('/student/attendance', [StudentController::class, 'attendance']);
$router->get('/student/alerts', [StudentController::class, 'alerts']);
$router->get('/student/schedule', [StudentController::class, 'schedule']);
$router->get('/student/resources', [StudentController::class, 'resources']);

// Teacher pages
$router->get('/teacher/grades', [TeacherController::class, 'grades']);
$router->get('/teacher/classes', [TeacherController::class, 'classes']);
$router->get('/teacher/sections', [TeacherController::class, 'sections']);
$router->get('/teacher/assignments', [TeacherController::class, 'assignments']);
$router->get('/teacher/attendance', [TeacherController::class, 'attendance']);
$router->get('/teacher/student-progress', [TeacherController::class, 'studentProgress']);
$router->get('/teacher/communication', [TeacherController::class, 'communication']);
$router->get('/teacher/materials', [TeacherController::class, 'materials']);

// Teacher API endpoints
$router->get('/teacher/api/section-details', [TeacherController::class, 'getSectionDetails']);
$router->post('/teacher/api/log-activity', [TeacherController::class, 'logActivity']);
// Attendance APIs
$router->get('/teacher/api/attendance/list', [TeacherController::class, 'getAttendanceList']);
$router->post('/teacher/api/attendance/save', [TeacherController::class, 'saveAttendance']);

// Adviser pages
$router->get('/adviser/students', [AdviserController::class, 'students']);
$router->get('/adviser/performance', [AdviserController::class, 'performance']);
$router->get('/adviser/communication', [AdviserController::class, 'communication']);

// Demo pages
$router->get('/demo/component-library', [HomeController::class, 'componentLibrary']);
$router->get('/demo/component-system', [HomeController::class, 'componentSystemDemo']);
$router->get('/demo/component-showcase', [HomeController::class, 'componentShowcase']);
$router->get('/demo/pwa-features', [HomeController::class, 'pwaFeatures']);
$router->get('/demo/realtime-features', [HomeController::class, 'realtimeFeatures']);

// Offline route (serves static offline page)
$router->get('/offline', function () {
	$file = BASE_PATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'offline.html';
	if (is_file($file)) {
		header('Content-Type: text/html; charset=utf-8');
		readfile($file);
		return;
	}
	http_response_code(404);
	echo 'Offline page not found';
});

// Error Pages
$router->get('/error/404', [ErrorController::class, 'notFound']);
$router->get('/error/403', [ErrorController::class, 'forbidden']);
$router->get('/error/500', [ErrorController::class, 'internalServerError']);
$router->get('/error/401', [ErrorController::class, 'unauthorized']);
$router->get('/error/503', [ErrorController::class, 'serviceUnavailable']);

// Generic error handler
$router->get('/error/{code}', function($code) {
	$errorController = new ErrorController();
	$errorController->error((int)$code);
});

