<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\StaticData;

class ParentController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'parent') {
            \Helpers\ErrorHandler::forbidden('You need parent privileges to access this page.');
            return;
        }
        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getParentDashboardData();

        $this->view->render('parent/dashboard', [
            'title' => 'Parent Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'child_info' => $staticData['child_info'],
            'academic_overview' => $staticData['academic_overview'],
            'recent_activities' => $staticData['recent_activities'],
            'upcoming_events' => $staticData['upcoming_events'],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('parent dashboard data'),
        ], 'layouts/dashboard');
    }
}


