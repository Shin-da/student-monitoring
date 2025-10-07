<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;

class ParentController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'parent') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('parent/dashboard', [
            'title' => 'Parent Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
        ], 'layouts/dashboard');
    }
}


