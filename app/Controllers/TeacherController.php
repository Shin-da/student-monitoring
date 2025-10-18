<?php
declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\StaticData;

class TeacherController extends Controller
{
    private function getDatabaseConnection()
    {
        $config = require BASE_PATH . '/config/config.php';
        $pdo = new \PDO(
            'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['database'],
            $config['database']['username'],
            $config['database']['password']
        );
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function dashboard(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }

        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getTeacherDashboardData();

        $this->view->render('teacher/dashboard', [
            'title' => 'Teacher Dashboard',
            'user' => $user,
            'activeNav' => 'dashboard',
            'showBack' => false,
            'stats' => $staticData['stats'],
            'sections' => $staticData['sections'],
            'activities' => $staticData['activities'],
            'alerts' => $staticData['alerts'],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('teacher dashboard data'),
        ], 'layouts/dashboard');
    }

    private function getTeacherStats($pdo, $teacherId)
    {
        // Get assigned sections count
        $stmt = $pdo->prepare("SELECT COUNT(*) as sections_count FROM teacher_sections WHERE teacher_id = ?");
        $stmt->execute([$teacherId]);
        $sectionsCount = $stmt->fetch(\PDO::FETCH_ASSOC)['sections_count'];

        // Get total students across all sections
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT s.id) as students_count 
            FROM students s 
            JOIN teacher_sections ts ON s.section_id = ts.section_id 
            WHERE ts.teacher_id = ?
        ");
        $stmt->execute([$teacherId]);
        $studentsCount = $stmt->fetch(\PDO::FETCH_ASSOC)['students_count'];

        // Get subjects taught count
        $stmt = $pdo->prepare("SELECT COUNT(DISTINCT subject_id) as subjects_count FROM teacher_sections WHERE teacher_id = ?");
        $stmt->execute([$teacherId]);
        $subjectsCount = $stmt->fetch(\PDO::FETCH_ASSOC)['subjects_count'];

        // Get pending alerts count
        $stmt = $pdo->prepare("SELECT COUNT(*) as alerts_count FROM performance_alerts WHERE teacher_id = ? AND status = 'active'");
        $stmt->execute([$teacherId]);
        $alertsCount = $stmt->fetch(\PDO::FETCH_ASSOC)['alerts_count'];

        return [
            'sections_count' => $sectionsCount,
            'students_count' => $studentsCount,
            'subjects_count' => $subjectsCount,
            'alerts_count' => $alertsCount,
        ];
    }

    private function getTeacherSections($pdo, $teacherId)
    {
        $stmt = $pdo->prepare("
            SELECT 
                ts.id,
                ts.section_id,
                ts.subject_id,
                s.class_name,
                s.subject,
                s.grade_level,
                s.section,
                s.room,
                sub.name as subject_name,
                ts.is_adviser,
                COUNT(DISTINCT st.id) as student_count,
                COALESCE(AVG(CASE WHEN att.status = 'present' THEN 100 ELSE 0 END), 0) as attendance_rate
            FROM teacher_sections ts
            JOIN sections s ON ts.section_id = s.section_id
            JOIN subjects sub ON ts.subject_id = sub.id
            LEFT JOIN students st ON st.section_id = s.section_id
            LEFT JOIN attendance att ON att.student_id = st.id AND att.section_id = s.section_id AND att.subject_id = sub.id
            WHERE ts.teacher_id = ?
            GROUP BY ts.id, ts.section_id, ts.subject_id, s.class_name, s.subject, s.grade_level, s.section, s.room, sub.name, ts.is_adviser
            ORDER BY s.grade_level, s.section
        ");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getRecentActivities($pdo, $teacherId)
    {
        $stmt = $pdo->prepare("
            SELECT 
                activity_type,
                description,
                target_type,
                target_id,
                created_at
            FROM teacher_activities 
            WHERE teacher_id = ? 
            ORDER BY created_at DESC 
            LIMIT 5
        ");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getPendingAlerts($pdo, $teacherId)
    {
        $stmt = $pdo->prepare("
            SELECT 
                pa.id,
                pa.alert_type,
                pa.title,
                pa.description,
                pa.severity,
                pa.created_at,
                u.name as student_name,
                s.class_name,
                sub.name as subject_name
            FROM performance_alerts pa
            JOIN students st ON pa.student_id = st.id
            JOIN users u ON st.user_id = u.id
            JOIN sections s ON pa.section_id = s.section_id
            JOIN subjects sub ON pa.subject_id = sub.id
            WHERE pa.teacher_id = ? AND pa.status = 'active'
            ORDER BY pa.created_at DESC
            LIMIT 5
        ");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function alerts(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }

        try {
            $pdo = $this->getDatabaseConnection();
            $teacherId = $user['id'];

            // Get all alerts for this teacher
            $stmt = $pdo->prepare("
                SELECT 
                    pa.id,
                    pa.alert_type,
                    pa.title,
                    pa.description,
                    pa.severity,
                    pa.status,
                    pa.created_at,
                    pa.resolved_at,
                    u.name as student_name,
                    s.class_name,
                    sub.name as subject_name,
                    resolver.name as resolved_by_name
                FROM performance_alerts pa
                JOIN students st ON pa.student_id = st.id
                JOIN users u ON st.user_id = u.id
                JOIN sections s ON pa.section_id = s.section_id
                JOIN subjects sub ON pa.subject_id = sub.id
                LEFT JOIN users resolver ON pa.resolved_by = resolver.id
                WHERE pa.teacher_id = ?
                ORDER BY pa.created_at DESC
            ");
            $stmt->execute([$teacherId]);
            $alerts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->view->render('teacher/alerts', [
                'title' => 'Alerts',
                'user' => $user,
                'alerts' => $alerts,
                'activeNav' => 'alerts',
                'showBack' => true,
            ], 'layouts/dashboard');
        } catch (\Exception $e) {
            \Helpers\ErrorHandler::internalServerError('Failed to load alerts: ' . $e->getMessage());
        }
    }

    public function grades(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }

        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getTeacherDashboardData();
        $gradesData = StaticData::getTeacherGradesData();

        // Get URL parameters for filtering (for UI state)
        $sectionId = $_GET['section'] ?? null;
        $subjectId = $_GET['subject'] ?? null;
        $gradeType = $_GET['grade_type'] ?? null;

        $this->view->render('teacher/grades', [
            'title' => 'Grade Management',
            'user' => $user,
            'activeNav' => 'grades',
            'sections' => $staticData['sections'],
            'subjects' => [
                ['id' => 1, 'name' => 'Mathematics', 'grade_level' => 10],
                ['id' => 2, 'name' => 'Science', 'grade_level' => 10],
                ['id' => 3, 'name' => 'Physics', 'grade_level' => 11]
            ],
            'stats' => [
                'total_students' => 85,
                'grades_entered' => 78,
                'pending_grades' => 7,
                'avg_grade' => 87.5,
                'grade_distribution' => [
                    'A' => 25,
                    'B' => 35,
                    'C' => 15,
                    'D' => 5,
                    'F' => 3
                ]
            ],
            'grades' => $gradesData,
            'assignments' => StaticData::getAssignmentsData(),
            'filters' => [
                'section_id' => $sectionId,
                'subject_id' => $subjectId,
                'grade_type' => $gradeType
            ],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('grades data'),
        ], 'layouts/dashboard');
    }

    private function getGradeStats($pdo, $teacherId, $sectionId = null, $subjectId = null)
    {
        $whereClause = "WHERE g.teacher_id = ?";
        $params = [$teacherId];

        if ($sectionId) {
            $whereClause .= " AND g.section_id = ?";
            $params[] = $sectionId;
        }

        if ($subjectId) {
            $whereClause .= " AND g.subject_id = ?";
            $params[] = $subjectId;
        }

        // Total students
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT s.id) as total_students
            FROM students s
            JOIN teacher_sections ts ON s.section_id = ts.section_id
            WHERE ts.teacher_id = ?
        ");
        $stmt->execute([$teacherId]);
        $totalStudents = $stmt->fetchColumn();

        // Grades entered
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as grades_entered
            FROM grades g
            $whereClause
        ");
        $stmt->execute($params);
        $gradesEntered = $stmt->fetchColumn();

        // Pending grades (students without grades for assignments)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as pending_grades
            FROM students s
            JOIN teacher_sections ts ON s.section_id = ts.section_id
            LEFT JOIN grades g ON g.student_id = s.id AND g.section_id = ts.section_id AND g.subject_id = ts.subject_id
            WHERE ts.teacher_id = ? AND g.id IS NULL
        ");
        $stmt->execute([$teacherId]);
        $pendingGrades = $stmt->fetchColumn();

        // Average grade
        $stmt = $pdo->prepare("
            SELECT COALESCE(AVG(g.grade_value), 0) as avg_grade
            FROM grades g
            $whereClause
        ");
        $stmt->execute($params);
        $avgGrade = $stmt->fetchColumn();

        return [
            'total_students' => (int)$totalStudents,
            'grades_entered' => (int)$gradesEntered,
            'pending_grades' => (int)$pendingGrades,
            'avg_grade' => round((float)$avgGrade, 1)
        ];
    }

    private function getGradesWithDetails($pdo, $teacherId, $sectionId = null, $subjectId = null, $gradeType = null)
    {
        $whereClause = "WHERE g.teacher_id = ?";
        $params = [$teacherId];

        if ($sectionId) {
            $whereClause .= " AND g.section_id = ?";
            $params[] = $sectionId;
        }

        if ($subjectId) {
            $whereClause .= " AND g.subject_id = ?";
            $params[] = $subjectId;
        }

        if ($gradeType) {
            $whereClause .= " AND g.grade_type = ?";
            $params[] = $gradeType;
        }

        $stmt = $pdo->prepare("
            SELECT 
                g.id,
                g.grade_value,
                g.max_score,
                g.grade_type,
                g.description,
                g.graded_at,
                u.name as student_name,
                s.lrn,
                sec.class_name,
                sec.section,
                sub.name as subject_name,
                CASE 
                    WHEN g.grade_value >= 90 THEN 'A'
                    WHEN g.grade_value >= 80 THEN 'B'
                    WHEN g.grade_value >= 70 THEN 'C'
                    WHEN g.grade_value >= 60 THEN 'D'
                    ELSE 'F'
                END as letter_grade,
                CASE 
                    WHEN g.grade_value >= 75 THEN 'passing'
                    ELSE 'failing'
                END as status
            FROM grades g
            JOIN students st ON g.student_id = st.id
            JOIN users u ON st.user_id = u.id
            JOIN sections sec ON g.section_id = sec.section_id
            JOIN subjects sub ON g.subject_id = sub.id
            LEFT JOIN students s ON st.id = s.id
            $whereClause
            ORDER BY g.graded_at DESC, u.name
        ");
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getTeacherAssignments($pdo, $teacherId, $sectionId = null, $subjectId = null)
    {
        $whereClause = "WHERE a.teacher_id = ? AND a.is_active = 1";
        $params = [$teacherId];

        if ($sectionId) {
            $whereClause .= " AND a.section_id = ?";
            $params[] = $sectionId;
        }

        if ($subjectId) {
            $whereClause .= " AND a.subject_id = ?";
            $params[] = $subjectId;
        }

        $stmt = $pdo->prepare("
            SELECT 
                a.id,
                a.title,
                a.description,
                a.assignment_type,
                a.max_score,
                a.due_date,
                a.created_at,
                sec.class_name,
                sec.section,
                sub.name as subject_name,
                COUNT(g.id) as grades_count,
                COUNT(DISTINCT st.id) as total_students
            FROM assignments a
            JOIN sections sec ON a.section_id = sec.section_id
            JOIN subjects sub ON a.subject_id = sub.id
            LEFT JOIN students st ON st.section_id = a.section_id
            LEFT JOIN grades g ON g.section_id = a.section_id AND g.subject_id = a.subject_id AND g.description = a.title
            $whereClause
            GROUP BY a.id, a.title, a.description, a.assignment_type, a.max_score, a.due_date, a.created_at, sec.class_name, sec.section, sub.name
            ORDER BY a.due_date DESC, a.created_at DESC
        ");
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function classes(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }
        $this->view->render('teacher/classes', [
            'title' => 'Class Management',
            'user' => $user,
            'activeNav' => 'classes',
        ], 'layouts/dashboard');
    }

    public function sections(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array(($user['role'] ?? ''), ['teacher', 'adviser'], true)) {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }

        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getTeacherDashboardData();
        $gradesData = StaticData::getGradesData();

        // Enhance sections with student data
        $sections = $staticData['sections'];
        foreach ($sections as &$section) {
            $section['students'] = [
                [
                    'student_id' => 1,
                    'student_name' => 'Alice Johnson',
                    'student_email' => 'alice.johnson@school.edu',
                    'lrn' => 'LRN000001',
                    'grade_level' => 10,
                    'avg_grade' => 92.5,
                    'grades_count' => 8,
                    'present_count' => 15,
                    'late_count' => 1,
                    'absent_count' => 2,
                    'total_attendance' => 18,
                    'last_attendance_date' => date('Y-m-d'),
                    'missing_assignments' => 0
                ],
                [
                    'student_id' => 2,
                    'student_name' => 'Bob Smith',
                    'student_email' => 'bob.smith@school.edu',
                    'lrn' => 'LRN000002',
                    'grade_level' => 10,
                    'avg_grade' => 78.2,
                    'grades_count' => 6,
                    'present_count' => 12,
                    'late_count' => 3,
                    'absent_count' => 3,
                    'total_attendance' => 18,
                    'last_attendance_date' => date('Y-m-d', strtotime('-1 day')),
                    'missing_assignments' => 2
                ]
            ];
            
            // Calculate section-level statistics
            $section['total_students'] = count($section['students']);
            $section['students_with_grades'] = count(array_filter($section['students'], function($s) { return $s['grades_count'] > 0; }));
            $section['students_present_today'] = count(array_filter($section['students'], function($s) { 
                return $s['last_attendance_date'] === date('Y-m-d'); 
            }));
        }

        $this->view->render('teacher/sections', [
            'title' => 'My Sections',
            'user' => $user,
            'sections' => $sections,
            'activeNav' => 'classes',
            'staticDataIndicator' => StaticData::getStaticDataIndicator('sections data'),
        ], 'layouts/dashboard');
    }

    public function assignments(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }

        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getTeacherDashboardData();
        $assignmentsData = StaticData::getAssignmentsData();

        // Get URL parameters for filtering (for UI state)
        $sectionId = $_GET['section'] ?? null;
        $subjectId = $_GET['subject'] ?? null;
        $status = $_GET['status'] ?? null;

        $this->view->render('teacher/assignments', [
            'title' => 'Assignment Management',
            'user' => $user,
            'activeNav' => 'assignments',
            'sections' => $staticData['sections'],
            'subjects' => [
                ['id' => 1, 'name' => 'Mathematics', 'grade_level' => 10],
                ['id' => 2, 'name' => 'Science', 'grade_level' => 10],
                ['id' => 3, 'name' => 'Physics', 'grade_level' => 11]
            ],
            'stats' => [
                'total_assignments' => count($assignmentsData),
                'active_assignments' => count(array_filter($assignmentsData, fn($a) => $a['status'] === 'active')),
                'overdue_assignments' => count(array_filter($assignmentsData, fn($a) => $a['status'] === 'overdue')),
                'avg_completion' => round(array_sum(array_column($assignmentsData, 'completion_percentage')) / count($assignmentsData), 1)
            ],
            'assignments' => $assignmentsData,
            'filters' => [
                'section_id' => $sectionId,
                'subject_id' => $subjectId,
                'status' => $status
            ],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('assignments data'),
        ], 'layouts/dashboard');
    }

    private function getAssignmentStats($pdo, $teacherId, $sectionId = null, $subjectId = null)
    {
        $whereClause = "WHERE a.teacher_id = ? AND a.is_active = 1";
        $params = [$teacherId];

        if ($sectionId) {
            $whereClause .= " AND a.section_id = ?";
            $params[] = $sectionId;
        }

        if ($subjectId) {
            $whereClause .= " AND a.subject_id = ?";
            $params[] = $subjectId;
        }

        // Total assignments
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as total_assignments
            FROM assignments a
            $whereClause
        ");
        $stmt->execute($params);
        $totalAssignments = $stmt->fetchColumn();

        // Completed assignments (all students graded)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as completed_assignments
            FROM assignments a
            LEFT JOIN students st ON st.section_id = a.section_id
            LEFT JOIN grades g ON g.student_id = st.id AND g.section_id = a.section_id AND g.subject_id = a.subject_id AND g.description = a.title
            $whereClause
            GROUP BY a.id
            HAVING COUNT(st.id) = COUNT(g.id) AND COUNT(st.id) > 0
        ");
        $stmt->execute($params);
        $completedAssignments = count($stmt->fetchAll());

        // Active assignments (not completed, not overdue)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as active_assignments
            FROM assignments a
            $whereClause
            AND (a.due_date IS NULL OR a.due_date >= CURDATE())
        ");
        $stmt->execute($params);
        $activeAssignments = $stmt->fetchColumn();

        // Overdue assignments
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as overdue_assignments
            FROM assignments a
            $whereClause
            AND a.due_date < CURDATE()
        ");
        $stmt->execute($params);
        $overdueAssignments = $stmt->fetchColumn();

        return [
            'total_assignments' => (int)$totalAssignments,
            'completed_assignments' => (int)$completedAssignments,
            'active_assignments' => (int)$activeAssignments,
            'overdue_assignments' => (int)$overdueAssignments
        ];
    }

    private function getAssignmentsWithDetails($pdo, $teacherId, $sectionId = null, $subjectId = null, $status = null)
    {
        $whereClause = "WHERE a.teacher_id = ? AND a.is_active = 1";
        $params = [$teacherId];

        if ($sectionId) {
            $whereClause .= " AND a.section_id = ?";
            $params[] = $sectionId;
        }

        if ($subjectId) {
            $whereClause .= " AND a.subject_id = ?";
            $params[] = $subjectId;
        }

        // Add status filtering
        if ($status) {
            switch ($status) {
                case 'active':
                    $whereClause .= " AND (a.due_date IS NULL OR a.due_date >= CURDATE())";
                    break;
                case 'completed':
                    // This would need a more complex query to check if all students are graded
                    break;
                case 'overdue':
                    $whereClause .= " AND a.due_date < CURDATE()";
                    break;
            }
        }

        $stmt = $pdo->prepare("
            SELECT 
                a.id,
                a.title,
                a.description,
                a.assignment_type,
                a.max_score,
                a.due_date,
                a.created_at,
                sec.class_name,
                sec.section,
                sub.name as subject_name,
                COUNT(DISTINCT st.id) as total_students,
                COUNT(DISTINCT g.id) as graded_students,
                CASE 
                    WHEN a.due_date IS NULL THEN 'active'
                    WHEN a.due_date >= CURDATE() THEN 'active'
                    ELSE 'overdue'
                END as status,
                CASE 
                    WHEN COUNT(DISTINCT st.id) = 0 THEN 0
                    ELSE ROUND((COUNT(DISTINCT g.id) / COUNT(DISTINCT st.id)) * 100, 1)
                END as completion_percentage
            FROM assignments a
            JOIN sections sec ON a.section_id = sec.section_id
            JOIN subjects sub ON a.subject_id = sub.id
            LEFT JOIN students st ON st.section_id = a.section_id
            LEFT JOIN grades g ON g.student_id = st.id AND g.section_id = a.section_id AND g.subject_id = a.subject_id AND g.description = a.title
            $whereClause
            GROUP BY a.id, a.title, a.description, a.assignment_type, a.max_score, a.due_date, a.created_at, sec.class_name, sec.section, sub.name
            ORDER BY a.due_date DESC, a.created_at DESC
        ");
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function attendance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }
        // STATIC DATA: Replace database queries with static data for frontend development
        $staticData = StaticData::getTeacherDashboardData();
        $attendanceData = StaticData::getAttendanceData();

        $date = $_GET['date'] ?? date('Y-m-d');
        $sectionId = $_GET['section'] ?? 1;
        $subjectId = $_GET['subject'] ?? 1;

        $this->view->render('teacher/attendance', [
            'title' => 'Attendance Management',
            'user' => $user,
            'activeNav' => 'attendance',
            'sections' => $staticData['sections'],
            'filters' => [ 
                'date' => $date, 
                'section_id' => $sectionId, 
                'subject_id' => $subjectId 
            ],
            'students' => $attendanceData['students'],
            'summary' => [
                'present' => 26,
                'absent' => 2,
                'late' => 1,
                'excused' => 0
            ],
            'staticDataIndicator' => StaticData::getStaticDataIndicator('attendance data'),
        ], 'layouts/dashboard');
    }

    public function getAttendanceList(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        $date = $_GET['date'] ?? date('Y-m-d');
        $sectionId = isset($_GET['section_id']) ? (int)$_GET['section_id'] : 0;
        $subjectId = isset($_GET['subject_id']) ? (int)$_GET['subject_id'] : 0;
        if (!$sectionId || !$subjectId) { http_response_code(400); echo json_encode(['success'=>false,'message'=>'Missing parameters']); return; }

        try {
            $pdo = $this->getDatabaseConnection();
            $stmt = $pdo->prepare("\n                SELECT \n                    s.id AS student_id, u.name AS student_name, s.lrn, s.grade_level,\n                    a.status AS attendance_status\n                FROM students s\n                JOIN users u ON s.user_id = u.id\n                LEFT JOIN attendance a ON a.student_id = s.id AND a.section_id = ? AND a.subject_id = ? AND a.attendance_date = ?\n                WHERE s.section_id = ?\n                ORDER BY u.name\n            ");
            $stmt->execute([$sectionId, $subjectId, $date, $sectionId]);
            $students = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'data' => $students]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function saveAttendance(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true) ?? [];
        foreach (['student_id','section_id','subject_id','date','status'] as $k) {
            if (!isset($input[$k]) || $input[$k] === '') { http_response_code(400); echo json_encode(['success'=>false,'message'=>'Missing field: '.$k]); return; }
        }

        $studentId = (int)$input['student_id'];
        $sectionId = (int)$input['section_id'];
        $subjectId = (int)$input['subject_id'];
        $date = $input['date'];
        $status = $input['status'];
        if (!in_array($status, ['present','absent','late','excused'], true)) { http_response_code(400); echo json_encode(['success'=>false,'message'=>'Invalid status']); return; }

        try {
            $pdo = $this->getDatabaseConnection();
            $stmt = $pdo->prepare('SELECT id FROM attendance WHERE student_id=? AND section_id=? AND subject_id=? AND attendance_date=?');
            $stmt->execute([$studentId, $sectionId, $subjectId, $date]);
            $existingId = $stmt->fetchColumn();
            if ($existingId) {
                $stmt = $pdo->prepare('UPDATE attendance SET status=?, updated_at=NOW() WHERE id=?');
                $stmt->execute([$status, $existingId]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO attendance (student_id, teacher_id, section_id, subject_id, attendance_date, status) VALUES (?,?,?,?,?,?)');
                $stmt->execute([$studentId, $user['id'], $sectionId, $subjectId, $date, $status]);
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function studentProgress(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }
        $this->view->render('teacher/student-progress', [
            'title' => 'Student Progress',
            'user' => $user,
            'activeNav' => 'student-progress',
        ], 'layouts/dashboard');
    }

    public function communication(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }
        $this->view->render('teacher/communication', [
            'title' => 'Communication',
            'user' => $user,
            'activeNav' => 'communication',
        ], 'layouts/dashboard');
    }

    public function materials(): void
    {
        $user = Session::get('user');
        if (!$user || ($user['role'] ?? '') !== 'teacher') {
            \Helpers\ErrorHandler::forbidden('You need teacher privileges to access this page.');
            return;
        }
        $this->view->render('teacher/materials', [
            'title' => 'Teaching Materials',
            'user' => $user,
            'activeNav' => 'materials',
        ], 'layouts/dashboard');
    }

    // API Methods for AJAX requests
    public function getSectionDetails(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        $sectionId = $_GET['section_id'] ?? null;
        $subjectId = $_GET['subject_id'] ?? null;

        if (!$sectionId || !$subjectId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
            return;
        }

        try {
            $pdo = $this->getDatabaseConnection();
            $teacherId = $user['id'];

            // Verify teacher has access to this section
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM teacher_sections WHERE teacher_id = ? AND section_id = ? AND subject_id = ?");
            $stmt->execute([$teacherId, $sectionId, $subjectId]);
            if ($stmt->fetchColumn() == 0) {
                http_response_code(403);
                echo json_encode(['success' => false, 'message' => 'Access denied to this section']);
                return;
            }

            // Get detailed section information
            $stmt = $pdo->prepare("
                SELECT 
                    s.section_id,
                    s.class_name,
                    s.subject,
                    s.grade_level,
                    s.section,
                    s.room,
                    sub.name as subject_name,
                    COUNT(DISTINCT st.id) as student_count
                FROM sections s
                JOIN subjects sub ON sub.id = ?
                LEFT JOIN students st ON st.section_id = s.section_id
                WHERE s.section_id = ?
                GROUP BY s.section_id, s.class_name, s.subject, s.grade_level, s.section, s.room, sub.name
            ");
            $stmt->execute([$subjectId, $sectionId]);
            $section = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$section) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Section not found']);
                return;
            }

            // Get students with detailed information
            $stmt = $pdo->prepare("
                SELECT 
                    s.id as student_id,
                    u.name as student_name,
                    u.email as student_email,
                    s.lrn,
                    s.grade_level,
                    COALESCE(AVG(g.grade_value), 0) as avg_grade,
                    COUNT(g.id) as grades_count,
                    COUNT(CASE WHEN att.status = 'present' THEN 1 END) as present_count,
                    COUNT(CASE WHEN att.status = 'late' THEN 1 END) as late_count,
                    COUNT(CASE WHEN att.status = 'absent' THEN 1 END) as absent_count,
                    COUNT(att.id) as total_attendance,
                    MAX(att.attendance_date) as last_attendance_date
                FROM students s
                JOIN users u ON s.user_id = u.id
                LEFT JOIN grades g ON g.student_id = s.id AND g.section_id = ? AND g.subject_id = ?
                LEFT JOIN attendance att ON att.student_id = s.id AND att.section_id = ? AND att.subject_id = ?
                WHERE s.section_id = ?
                GROUP BY s.id, u.name, u.email, s.lrn, s.grade_level
                ORDER BY u.name
            ");
            $stmt->execute([$sectionId, $subjectId, $sectionId, $subjectId, $sectionId]);
            $students = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $section['students'] = $students;

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'data' => $section]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function logActivity(): void
    {
        $user = Session::get('user');
        if (!$user || !in_array($user['role'] ?? '', ['teacher', 'adviser'], true)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Access denied']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || !isset($input['activity_type'], $input['description'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            return;
        }

        try {
            $pdo = $this->getDatabaseConnection();
            $teacherId = $user['id'];

            $stmt = $pdo->prepare("
                INSERT INTO teacher_activities (teacher_id, activity_type, description, target_type, target_id, metadata) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $teacherId,
                $input['activity_type'],
                $input['description'],
                $input['target_type'] ?? null,
                $input['target_id'] ?? null,
                isset($input['metadata']) ? json_encode($input['metadata']) : null
            ]);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Activity logged successfully']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }
}


