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
}


