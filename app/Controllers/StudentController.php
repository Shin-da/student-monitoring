<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\StaticData;

class StudentController extends Controller
{
    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
            return;
        }
        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getStudentDashboardData();

        $this->view->render('student/dashboard', [
            'title' => 'Student Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'student_info' => $staticData['student_info'],
            'academic_stats' => $staticData['academic_stats'],
            'recent_grades' => $staticData['recent_grades'],
            'upcoming_assignments' => $staticData['upcoming_assignments'],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('student dashboard data'),
        ], 'layouts/dashboard');
    }

    public function grades(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
            return;
        }

        try {
            // Get database connection
            $config = require BASE_PATH . '/config/config.php';
            $db = \Core\Database::connection($config['database']);
            
            // Fetch complete student data with enhanced structure using the student_profiles view
            $userStmt = $db->prepare("
                SELECT * FROM student_profiles 
                WHERE user_id = ? AND user_status = 'active'
            ");
            $userStmt->execute([$user['id']]);
            $studentData = $userStmt->fetch();
            
            if (!$studentData) {
                \Helpers\ErrorHandler::notFound('Student profile not found.');
                return;
            }

            // Get section information with adviser details
            $sectionInfo = null;
            if ($studentData['section_id']) {
                try {
                    $sectionStmt = $db->prepare("
                        SELECT s.*, u.name as adviser_name, u.email as adviser_email
                        FROM sections s
                        LEFT JOIN teachers t ON s.adviser_id = t.id
                        LEFT JOIN users u ON t.user_id = u.id
                        WHERE s.id = ?
                    ");
                    $sectionStmt->execute([$studentData['section_id']]);
                    $sectionInfo = $sectionStmt->fetch();
                } catch (\Exception $e) {
                    // Fallback to basic section info
                    $sectionStmt = $db->prepare("SELECT * FROM sections WHERE id = ?");
                    $sectionStmt->execute([$studentData['section_id']]);
                    $sectionInfo = $sectionStmt->fetch();
                }
            }

            // Get subjects for the student's grade level
            $subjects = [];
            if ($studentData['grade_level']) {
                try {
                    $subjectsStmt = $db->prepare("
                        SELECT * FROM subjects 
                        WHERE grade_level = ? AND is_active = 1 
                        ORDER BY name
                    ");
                    $subjectsStmt->execute([$studentData['grade_level']]);
                    $subjects = $subjectsStmt->fetchAll();
                } catch (\Exception $e) {
                    // Subjects table might not have data yet
                    $subjects = [];
                }
            }

            // Get academic stats (enhanced with real data)
            $academicStats = [
                'overall_average' => 0,
                'passing_subjects' => 0,
                'total_subjects' => count($subjects),
                'improvement' => 0,
                'subjects_count' => count($subjects),
                'grade_level' => $studentData['grade_level'],
                'school_year' => $studentData['school_year']
            ];

            // Get enrollment information
            $enrollmentInfo = [
                'date_enrolled' => $studentData['date_enrolled'],
                'school_year' => $studentData['school_year'],
                'status' => $studentData['student_status'],
                'lrn' => $studentData['lrn']
            ];

            $this->view->render('student/profile', [
                'title' => 'My Profile',
                'user' => $user,
                'activeNav' => 'profile',
                'student_data' => $studentData,
                'section_info' => $sectionInfo,
                'subjects' => $subjects,
                'academic_stats' => $academicStats,
                'enrollment_info' => $enrollmentInfo,
            ], 'layouts/dashboard');
            
        } catch (\Exception $e) {
            error_log("Error fetching student profile: " . $e->getMessage());
            \Helpers\ErrorHandler::internalServerError('Unable to load profile data. Please try again later.');
        }
    }

    public function attendance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'student') {
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
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
            \Helpers\ErrorHandler::forbidden('You need student privileges to access this page.');
            return;
        }
        $this->view->render('student/resources', [
            'title' => 'Learning Resources',
            'user' => $user,
            'activeNav' => 'resources',
        ], 'layouts/dashboard');
    }
}


