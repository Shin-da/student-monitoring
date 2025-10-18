<?php
declare(strict_types=1);

namespace Helpers;

/**
 * Static Data Helper
 * 
 * This class provides static data to replace database queries during frontend development.
 * All data is clearly marked as static for easy identification by backend developers.
 * 
 * IMPORTANT: This is for frontend development only. Backend developers should replace
 * these methods with actual database queries when implementing the backend.
 */
class StaticData
{
    /**
     * Get static data indicator HTML
     * This creates a clear visual indicator that data is static
     */
    public static function getStaticDataIndicator(string $context = 'data'): string
    {
        return '<div class="static-data-indicator alert alert-info alert-dismissible fade show mb-2" role="alert">
                    <div class="d-flex align-items-center">
                        <svg width="16" height="16" fill="currentColor" class="me-2">
                            <use href="#icon-info"></use>
                        </svg>
                        <strong>Static Data:</strong> This ' . $context . ' is for frontend development only. Backend integration required.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
    }

    /**
     * Get static data badge for inline indicators
     */
    public static function getStaticDataBadge(string $text = 'STATIC'): string
    {
        return '<span class="badge bg-warning text-dark ms-1" title="This data is static for frontend development">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                        <use href="#icon-info"></use>
                    </svg>
                    ' . $text . '
                </span>';
    }

    /**
     * ADMIN DASHBOARD STATIC DATA
     */
    public static function getAdminDashboardData(): array
    {
        return [
            'pendingCount' => 5,
            'userStats' => [
                ['role' => 'admin', 'count' => 2],
                ['role' => 'teacher', 'count' => 15],
                ['role' => 'adviser', 'count' => 8],
                ['role' => 'student', 'count' => 245],
                ['role' => 'parent', 'count' => 180]
            ],
            'systemStats' => [
                'uptime' => 98.5,
                'responseTime' => 2.3,
                'activeSessions' => 15,
                'memoryUsage' => 67.2
            ],
            'recentActivity' => [
                [
                    'id' => 1,
                    'user' => 'John Doe',
                    'action' => 'Created new student account',
                    'timestamp' => '2025-01-17 14:30:00',
                    'type' => 'user_creation'
                ],
                [
                    'id' => 2,
                    'user' => 'Jane Smith',
                    'action' => 'Updated grade for Math assignment',
                    'timestamp' => '2025-01-17 14:25:00',
                    'type' => 'grade_update'
                ],
                [
                    'id' => 3,
                    'user' => 'Mike Johnson',
                    'action' => 'Approved teacher registration',
                    'timestamp' => '2025-01-17 14:20:00',
                    'type' => 'user_approval'
                ]
            ]
        ];
    }

    /**
     * TEACHER DASHBOARD STATIC DATA
     */
    public static function getTeacherDashboardData(): array
    {
        return [
            'stats' => [
                'sections_count' => 3,
                'students_count' => 85,
                'subjects_count' => 4,
                'alerts_count' => 2
            ],
            'sections' => [
                [
                    'section_id' => 1,
                    'class_name' => 'Grade 10',
                    'section' => 'A',
                    'subject_name' => 'Mathematics',
                    'student_count' => 28,
                    'average_grade' => 87.5
                ],
                [
                    'section_id' => 2,
                    'class_name' => 'Grade 10',
                    'section' => 'B',
                    'subject_name' => 'Science',
                    'student_count' => 30,
                    'average_grade' => 89.2
                ],
                [
                    'section_id' => 3,
                    'class_name' => 'Grade 11',
                    'section' => 'A',
                    'subject_name' => 'Physics',
                    'student_count' => 27,
                    'average_grade' => 85.8
                ]
            ],
            'activities' => [
                [
                    'id' => 1,
                    'action' => 'Graded Math Quiz - Section 10A',
                    'timestamp' => '2025-01-17 13:45:00',
                    'type' => 'grading'
                ],
                [
                    'id' => 2,
                    'action' => 'Updated attendance for Science class',
                    'timestamp' => '2025-01-17 11:30:00',
                    'type' => 'attendance'
                ],
                [
                    'id' => 3,
                    'action' => 'Created new Physics assignment',
                    'timestamp' => '2025-01-17 09:15:00',
                    'type' => 'assignment'
                ]
            ],
            'alerts' => [
                [
                    'id' => 1,
                    'student_name' => 'Alice Johnson',
                    'message' => 'Grade dropped below 75% in Mathematics',
                    'priority' => 'high',
                    'timestamp' => '2025-01-17 14:00:00'
                ],
                [
                    'id' => 2,
                    'student_name' => 'Bob Smith',
                    'message' => 'Missing 3 consecutive assignments',
                    'priority' => 'medium',
                    'timestamp' => '2025-01-17 13:30:00'
                ]
            ]
        ];
    }

    /**
     * STUDENT DASHBOARD STATIC DATA
     */
    public static function getStudentDashboardData(): array
    {
        return [
            'student_info' => [
                'lrn' => 'LRN000005',
                'grade_level' => 10,
                'section' => 'A',
                'class_name' => 'Grade 10-A'
            ],
            'academic_stats' => [
                'overall_average' => 85.2,
                'current_rank' => 12,
                'total_students' => 28,
                'attendance_rate' => 96.5
            ],
            'recent_grades' => [
                [
                    'subject' => 'Mathematics',
                    'assignment' => 'Quiz 3',
                    'score' => 88,
                    'max_score' => 100,
                    'percentage' => 88.0,
                    'date' => '2025-01-17'
                ],
                [
                    'subject' => 'Science',
                    'assignment' => 'Lab Report 2',
                    'score' => 92,
                    'max_score' => 100,
                    'percentage' => 92.0,
                    'date' => '2025-01-16'
                ],
                [
                    'subject' => 'English',
                    'assignment' => 'Essay Writing',
                    'score' => 85,
                    'max_score' => 100,
                    'percentage' => 85.0,
                    'date' => '2025-01-15'
                ]
            ],
            'upcoming_assignments' => [
                [
                    'id' => 1,
                    'subject' => 'Mathematics',
                    'title' => 'Trigonometry Test',
                    'due_date' => '2025-01-20',
                    'days_remaining' => 3
                ],
                [
                    'id' => 2,
                    'subject' => 'Science',
                    'title' => 'Chemistry Lab',
                    'due_date' => '2025-01-22',
                    'days_remaining' => 5
                ]
            ]
        ];
    }

    /**
     * ADVISER DASHBOARD STATIC DATA
     */
    public static function getAdviserDashboardData(): array
    {
        return [
            'class_stats' => [
                'total_students' => 32,
                'present_today' => 28,
                'alerts' => 5,
                'class_average' => 87.5
            ],
            'student_performance' => [
                [
                    'student_id' => 1,
                    'name' => 'Alice Johnson',
                    'average' => 92.5,
                    'attendance' => 98.5,
                    'status' => 'excellent'
                ],
                [
                    'student_id' => 2,
                    'name' => 'Bob Smith',
                    'average' => 78.2,
                    'attendance' => 85.0,
                    'status' => 'needs_attention'
                ],
                [
                    'student_id' => 3,
                    'name' => 'Carol Davis',
                    'average' => 89.1,
                    'attendance' => 95.0,
                    'status' => 'good'
                ]
            ],
            'recent_activities' => [
                [
                    'id' => 1,
                    'action' => 'Conducted parent-teacher conference',
                    'student' => 'Alice Johnson',
                    'timestamp' => '2025-01-17 14:00:00'
                ],
                [
                    'id' => 2,
                    'action' => 'Updated student progress report',
                    'student' => 'Bob Smith',
                    'timestamp' => '2025-01-17 13:30:00'
                ]
            ]
        ];
    }

    /**
     * PARENT DASHBOARD STATIC DATA
     */
    public static function getParentDashboardData(): array
    {
        return [
            'child_info' => [
                'name' => 'John Carlbe',
                'lrn' => 'LRN000005',
                'grade_level' => 10,
                'section' => 'A',
                'class_name' => 'Grade 10-A'
            ],
            'academic_overview' => [
                'overall_average' => 85.2,
                'attendance_rate' => 96.5,
                'assignments_completed' => 24,
                'assignments_pending' => 3
            ],
            'recent_activities' => [
                [
                    'id' => 1,
                    'action' => 'Submitted Math homework',
                    'subject' => 'Mathematics',
                    'timestamp' => '2025-01-17 18:30:00',
                    'status' => 'completed'
                ],
                [
                    'id' => 2,
                    'action' => 'Attended Science class',
                    'subject' => 'Science',
                    'timestamp' => '2025-01-17 14:00:00',
                    'status' => 'present'
                ]
            ],
            'upcoming_events' => [
                [
                    'id' => 1,
                    'title' => 'Parent-Teacher Conference',
                    'date' => '2025-01-25',
                    'time' => '14:00',
                    'type' => 'meeting'
                ],
                [
                    'id' => 2,
                    'title' => 'Mathematics Test',
                    'date' => '2025-01-20',
                    'time' => '09:00',
                    'type' => 'exam'
                ]
            ]
        ];
    }

    /**
     * USERS MANAGEMENT STATIC DATA
     */
    public static function getUsersData(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'System Administrator',
                'email' => 'admin@school.edu',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => '2025-10-16 19:37:51',
                'approved_by_name' => null,
                'approved_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Shin Da',
                'email' => 'teacher@gmail.com',
                'role' => 'teacher',
                'status' => 'active',
                'created_at' => '2025-10-16 19:56:17',
                'approved_by_name' => 'System Administrator',
                'approved_at' => '2025-10-16 20:00:00'
            ],
            [
                'id' => 3,
                'name' => 'Maria Santos',
                'email' => 'maria.santos@school.edu',
                'role' => 'teacher',
                'status' => 'pending',
                'created_at' => '2025-01-17 10:30:00',
                'approved_by_name' => null,
                'approved_at' => null
            ],
            [
                'id' => 4,
                'name' => 'John Carlbe',
                'email' => 'johncarlbeg@gmail.com',
                'role' => 'student',
                'status' => 'active',
                'created_at' => '2025-10-17 13:52:24',
                'approved_by_name' => 'System Administrator',
                'approved_at' => '2025-10-17 13:52:29'
            ],
            [
                'id' => 5,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'role' => 'parent',
                'status' => 'pending',
                'created_at' => '2025-01-17 11:15:00',
                'approved_by_name' => null,
                'approved_at' => null
            ]
        ];
    }

    /**
     * ASSIGNMENTS STATIC DATA
     */
    public static function getAssignmentsData(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Trigonometry Quiz',
                'description' => 'Solve trigonometric equations and identities',
                'assignment_type' => 'quiz',
                'max_score' => 100,
                'due_date' => '2025-01-20',
                'created_at' => '2025-01-15 09:00:00',
                'class_name' => 'Grade 10',
                'section' => 'A',
                'subject_name' => 'Mathematics',
                'total_students' => 28,
                'graded_students' => 25,
                'status' => 'active',
                'completion_percentage' => 89.3
            ],
            [
                'id' => 2,
                'title' => 'Chemistry Lab Report',
                'description' => 'Write a detailed report on the acid-base titration experiment',
                'assignment_type' => 'lab_report',
                'max_score' => 100,
                'due_date' => '2025-01-22',
                'created_at' => '2025-01-16 14:30:00',
                'class_name' => 'Grade 10',
                'section' => 'B',
                'subject_name' => 'Science',
                'total_students' => 30,
                'graded_students' => 18,
                'status' => 'active',
                'completion_percentage' => 60.0
            ],
            [
                'id' => 3,
                'title' => 'Physics Problem Set',
                'description' => 'Solve problems on kinematics and dynamics',
                'assignment_type' => 'homework',
                'max_score' => 50,
                'due_date' => '2025-01-18',
                'created_at' => '2025-01-14 16:00:00',
                'class_name' => 'Grade 11',
                'section' => 'A',
                'subject_name' => 'Physics',
                'total_students' => 27,
                'graded_students' => 27,
                'status' => 'overdue',
                'completion_percentage' => 100.0
            ]
        ];
    }

    /**
     * ATTENDANCE STATIC DATA
     */
    public static function getAttendanceData(): array
    {
        return [
            'sections' => [
                [
                    'section_id' => 1,
                    'class_name' => 'Grade 10',
                    'section' => 'A',
                    'subject_name' => 'Mathematics',
                    'total_students' => 28,
                    'present_count' => 26,
                    'absent_count' => 2,
                    'attendance_rate' => 92.9
                ],
                [
                    'section_id' => 2,
                    'class_name' => 'Grade 10',
                    'section' => 'B',
                    'subject_name' => 'Science',
                    'total_students' => 30,
                    'present_count' => 28,
                    'absent_count' => 2,
                    'attendance_rate' => 93.3
                ]
            ],
            'students' => [
                [
                    'student_id' => 1,
                    'student_name' => 'Alice Johnson',
                    'lrn' => 'LRN000001',
                    'grade_level' => 10,
                    'attendance_status' => 'present'
                ],
                [
                    'student_id' => 2,
                    'student_name' => 'Bob Smith',
                    'lrn' => 'LRN000002',
                    'grade_level' => 10,
                    'attendance_status' => 'present'
                ],
                [
                    'student_id' => 3,
                    'student_name' => 'Carol Davis',
                    'lrn' => 'LRN000003',
                    'grade_level' => 10,
                    'attendance_status' => 'absent'
                ]
            ]
        ];
    }

    /**
     * GRADES STATIC DATA
     */
    public static function getGradesData(): array
    {
        return [
            'subjects' => [
                [
                    'id' => 1,
                    'name' => 'Mathematics',
                    'average' => 87.5,
                    'total_assignments' => 12,
                    'graded_assignments' => 10
                ],
                [
                    'id' => 2,
                    'name' => 'Science',
                    'average' => 89.2,
                    'total_assignments' => 8,
                    'graded_assignments' => 8
                ],
                [
                    'id' => 3,
                    'name' => 'English',
                    'average' => 85.8,
                    'total_assignments' => 10,
                    'graded_assignments' => 9
                ]
            ],
            'students' => [
                [
                    'student_id' => 1,
                    'name' => 'Alice Johnson',
                    'lrn' => 'LRN000001',
                    'overall_average' => 92.5,
                    'rank' => 1,
                    'subjects' => [
                        ['name' => 'Mathematics', 'grade' => 95.0],
                        ['name' => 'Science', 'grade' => 90.0],
                        ['name' => 'English', 'grade' => 92.5]
                    ]
                ],
                [
                    'student_id' => 2,
                    'name' => 'Bob Smith',
                    'lrn' => 'LRN000002',
                    'overall_average' => 78.2,
                    'rank' => 15,
                    'subjects' => [
                        ['name' => 'Mathematics', 'grade' => 75.0],
                        ['name' => 'Science', 'grade' => 80.0],
                        ['name' => 'English', 'grade' => 79.5]
                    ]
                ]
            ]
        ];
    }

    /**
     * TEACHER GRADES STATIC DATA (for grades management page)
     */
    public static function getTeacherGradesData(): array
    {
        return [
            [
                'id' => 1,
                'student_id' => 1,
                'student_name' => 'Alice Johnson',
                'lrn' => 'LRN000001',
                'class_name' => 'Grade 10-A',
                'subject_name' => 'Mathematics',
                'description' => 'Quiz 3 - Trigonometry',
                'grade_type' => 'quiz',
                'grade_value' => 95.0,
                'max_score' => 100.0,
                'max_grade' => 100.0,
                'percentage' => 95.0,
                'grade_date' => '2025-01-17',
                'graded_at' => '2025-01-17 14:30:00',
                'status' => 'passing'
            ],
            [
                'id' => 2,
                'student_id' => 2,
                'student_name' => 'Bob Smith',
                'lrn' => 'LRN000002',
                'class_name' => 'Grade 10-A',
                'subject_name' => 'Mathematics',
                'description' => 'Quiz 3 - Trigonometry',
                'grade_type' => 'quiz',
                'grade_value' => 78.0,
                'max_score' => 100.0,
                'max_grade' => 100.0,
                'percentage' => 78.0,
                'grade_date' => '2025-01-17',
                'graded_at' => '2025-01-17 14:30:00',
                'status' => 'passing'
            ],
            [
                'id' => 3,
                'student_id' => 3,
                'student_name' => 'Carol Davis',
                'lrn' => 'LRN000003',
                'class_name' => 'Grade 10-A',
                'subject_name' => 'Science',
                'description' => 'Lab Report 2',
                'grade_type' => 'lab_report',
                'grade_value' => 88.0,
                'max_score' => 100.0,
                'max_grade' => 100.0,
                'percentage' => 88.0,
                'grade_date' => '2025-01-16',
                'graded_at' => '2025-01-16 16:45:00',
                'status' => 'passing'
            ],
            [
                'id' => 4,
                'student_id' => 4,
                'student_name' => 'David Wilson',
                'lrn' => 'LRN000004',
                'class_name' => 'Grade 10-B',
                'subject_name' => 'Physics',
                'description' => 'Problem Set 1',
                'grade_type' => 'homework',
                'grade_value' => 65.0,
                'max_score' => 50.0,
                'max_grade' => 50.0,
                'percentage' => 65.0,
                'grade_date' => '2025-01-15',
                'graded_at' => '2025-01-15 10:20:00',
                'status' => 'failing'
            ],
            [
                'id' => 5,
                'student_id' => 5,
                'student_name' => 'Emma Brown',
                'lrn' => 'LRN000005',
                'class_name' => 'Grade 10-A',
                'subject_name' => 'English',
                'description' => 'Essay Writing',
                'grade_type' => 'essay',
                'grade_value' => 0.0,
                'max_score' => 100.0,
                'max_grade' => 100.0,
                'percentage' => 0.0,
                'grade_date' => null,
                'graded_at' => null,
                'status' => 'pending'
            ]
        ];
    }
}
