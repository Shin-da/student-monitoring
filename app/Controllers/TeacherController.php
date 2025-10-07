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
}


