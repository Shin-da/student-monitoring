<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\StaticData;

class AdviserController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'adviser') {
            \Helpers\ErrorHandler::forbidden('You need adviser privileges to access this page.');
            return;
        }
        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getAdviserDashboardData();

        $this->view->render('adviser/dashboard', [
            'title' => 'Class Adviser Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'class_stats' => $staticData['class_stats'],
            'student_performance' => $staticData['student_performance'],
            'recent_activities' => $staticData['recent_activities'],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('adviser dashboard data'),
        ], 'layouts/dashboard');
    }

    public function students(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'adviser') {
            \Helpers\ErrorHandler::forbidden('You need adviser privileges to access this page.');
            return;
        }
        $this->view->render('adviser/students', [
            'title' => 'Student Management',
            'user' => $user,
            'activeNav' => 'students',
        ], 'layouts/dashboard');
    }

    public function performance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'adviser') {
            \Helpers\ErrorHandler::forbidden('You need adviser privileges to access this page.');
            return;
        }
        $this->view->render('adviser/performance', [
            'title' => 'Student Performance',
            'user' => $user,
            'activeNav' => 'performance',
        ], 'layouts/dashboard');
    }

    public function communication(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'adviser') {
            \Helpers\ErrorHandler::forbidden('You need adviser privileges to access this page.');
            return;
        }
        $this->view->render('adviser/communication', [
            'title' => 'Communication Center',
            'user' => $user,
            'activeNav' => 'communication',
        ], 'layouts/dashboard');
    }
}


