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

    public function componentLibrary(): void
    {
        $this->view->render('demo/component-library', [
            'title' => 'Component Library Demo',
        ]);
    }

    public function pwaFeatures(): void
    {
        $this->view->render('demo/pwa-features', [
            'title' => 'PWA Features Demo',
        ]);
    }

    public function realtimeFeatures(): void
    {
        $this->view->render('demo/realtime-features', [
            'title' => 'Real-time Features Demo',
        ]);
    }
}


