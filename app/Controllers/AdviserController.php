<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;

class AdviserController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'adviser') {
            \Helpers\Response::forbidden();
            return;
        }
        $this->view->render('adviser/dashboard', [
            'title' => 'Class Adviser Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
        ], 'layouts/dashboard');
    }
}


