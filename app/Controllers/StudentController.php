<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;

class StudentController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/dashboard', [
            'title' => 'Student Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
        ], 'layouts/dashboard');
    }

    public function grades(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/grades', [
            'title' => 'My Grades',
            'user' => $user,
            'activeNav' => 'grades',
        ], 'layouts/dashboard');
    }

    public function assignments(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/assignments', [
            'title' => 'My Assignments',
            'user' => $user,
            'activeNav' => 'assignments',
        ], 'layouts/dashboard');
    }

    public function profile(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/profile', [
            'title' => 'My Profile',
            'user' => $user,
            'activeNav' => 'profile',
        ], 'layouts/dashboard');
    }

    public function attendance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/attendance', [
            'title' => 'My Attendance',
            'user' => $user,
            'activeNav' => 'attendance',
        ], 'layouts/dashboard');
    }

    public function alerts(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/alerts', [
            'title' => 'My Alerts',
            'user' => $user,
            'activeNav' => 'alerts',
        ], 'layouts/dashboard');
    }

    public function schedule(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/schedule', [
            'title' => 'My Schedule',
            'user' => $user,
            'activeNav' => 'schedule',
        ], 'layouts/dashboard');
    }

    public function resources(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('student/resources', [
            'title' => 'Learning Resources',
            'user' => $user,
            'activeNav' => 'resources',
        ], 'layouts/dashboard');
    }
}


