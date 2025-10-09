<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;

class TeacherController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/dashboard', [
            'title' => 'Teacher Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
        ], 'layouts/dashboard');
    }

    public function alerts(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            \Helpers\Response::forbidden();
            return;
        }
        // Sample alerts data could be fetched from a model later
        $alerts = [];
        $this->view->render('teacher/alerts', [
            'title' => 'Alerts',
            'user' => $user,
            'alerts' => $alerts,
            'activeNav' => 'alerts',
            'showBack' => true,
        ], 'layouts/dashboard');
    }

    public function grades(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/grades', [
            'title' => 'Grade Management',
            'user' => $user,
            'activeNav' => 'grades',
        ], 'layouts/dashboard');
    }

    public function classes(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/classes', [
            'title' => 'Class Management',
            'user' => $user,
            'activeNav' => 'classes',
        ], 'layouts/dashboard');
    }

    public function assignments(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/assignments', [
            'title' => 'Assignment Management',
            'user' => $user,
            'activeNav' => 'assignments',
        ], 'layouts/dashboard');
    }

    public function attendance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/attendance', [
            'title' => 'Attendance Management',
            'user' => $user,
            'activeNav' => 'attendance',
        ], 'layouts/dashboard');
    }

    public function studentProgress(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/student-progress', [
            'title' => 'Student Progress',
            'user' => $user,
            'activeNav' => 'student-progress',
        ], 'layouts/dashboard');
    }

    public function communication(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/communication', [
            'title' => 'Communication',
            'user' => $user,
            'activeNav' => 'communication',
        ], 'layouts/dashboard');
    }

    public function materials(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('teacher/materials', [
            'title' => 'Teaching Materials',
            'user' => $user,
            'activeNav' => 'materials',
        ], 'layouts/dashboard');
    }
}


