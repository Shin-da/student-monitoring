<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view->render('home/index', [
            'title' => 'Welcome',
        ]);
    }
}


