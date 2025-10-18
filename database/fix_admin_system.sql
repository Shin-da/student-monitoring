-- Fix Admin System Database Structure
-- This script fixes the database to properly handle user approval and role-specific tables

-- First, let's add missing columns to users table for better tracking
ALTER TABLE `users` 
ADD COLUMN `linked_student_user_id` int(10) UNSIGNED DEFAULT NULL AFTER `approved_at`,
ADD COLUMN `parent_relationship` enum('father','mother','guardian') DEFAULT NULL AFTER `linked_student_user_id`,
ADD INDEX `idx_linked_student` (`linked_student_user_id`);

-- Add foreign key constraint for linked student
ALTER TABLE `users` 
ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`linked_student_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- Update the students table to have proper structure
ALTER TABLE `students` 
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT current_timestamp() AFTER `section_id`,
ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() AFTER `created_at`;

-- Update the teachers table to have proper structure  
ALTER TABLE `teachers` 
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT current_timestamp() AFTER `is_adviser`,
ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() AFTER `created_at`;

-- Update the parents table to have proper structure
ALTER TABLE `parents` 
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT current_timestamp() AFTER `relationship`,
ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() AFTER `created_at`;

-- Create advisers table (separate from teachers for better organization)
CREATE TABLE IF NOT EXISTS `advisers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `advisers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `advisers_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create user_requests table to track registration requests
CREATE TABLE IF NOT EXISTS `user_requests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `requested_role` enum('admin','teacher','adviser','student','parent') NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` int(10) UNSIGNED DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `additional_data` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `processed_by` (`processed_by`),
  KEY `status` (`status`),
  CONSTRAINT `user_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_requests_ibfk_2` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create audit_logs table for tracking admin actions
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action` varchar(100) NOT NULL,
  `target_type` varchar(50) NOT NULL,
  `target_id` int(10) UNSIGNED NOT NULL,
  `details` json DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `action` (`action`),
  KEY `target_type` (`target_type`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert some sample sections for testing
INSERT IGNORE INTO `sections` (`section_id`, `class_name`, `subject`, `grade_level`, `section`, `room`, `max_students`, `description`) VALUES
(1, 'Mathematics', 'Algebra', '7', 'A', 'Room 101', 30, 'Grade 7 Algebra Class'),
(2, 'Science', 'Biology', '8', 'B', 'Room 102', 25, 'Grade 8 Biology Class'),
(3, 'English', 'Literature', '9', 'C', 'Room 103', 35, 'Grade 9 Literature Class'),
(4, 'Mathematics', 'Geometry', '10', 'A', 'Room 201', 30, 'Grade 10 Geometry Class'),
(5, 'Science', 'Chemistry', '11', 'B', 'Room 202', 25, 'Grade 11 Chemistry Class'),
(6, 'English', 'Creative Writing', '12', 'C', 'Room 203', 30, 'Grade 12 Creative Writing Class');

-- Insert some sample subjects
INSERT IGNORE INTO `subjects` (`id`, `name`, `grade_level`, `ww_percent`, `pt_percent`, `qe_percent`) VALUES
(1, 'Mathematics', 7, 30, 50, 20),
(2, 'Science', 7, 30, 50, 20),
(3, 'English', 7, 30, 50, 20),
(4, 'Mathematics', 8, 30, 50, 20),
(5, 'Science', 8, 30, 50, 20),
(6, 'English', 8, 30, 50, 20),
(7, 'Mathematics', 9, 30, 50, 20),
(8, 'Science', 9, 30, 50, 20),
(9, 'English', 9, 30, 50, 20),
(10, 'Mathematics', 10, 30, 50, 20),
(11, 'Science', 10, 30, 50, 20),
(12, 'English', 10, 30, 50, 20),
(13, 'Mathematics', 11, 30, 50, 20),
(14, 'Science', 11, 30, 50, 20),
(15, 'English', 11, 30, 50, 20),
(16, 'Mathematics', 12, 30, 50, 20),
(17, 'Science', 12, 30, 50, 20),
(18, 'English', 12, 30, 50, 20);

-- Update existing users to have proper role-specific entries
-- First, let's check if we need to create entries for existing users

-- For existing students (users with role='student')
INSERT IGNORE INTO `students` (`user_id`, `lrn`, `grade_level`, `section_id`)
SELECT 
    u.id as user_id,
    CONCAT('LRN', LPAD(u.id, 6, '0')) as lrn,
    CASE 
        WHEN u.id % 4 = 0 THEN 7
        WHEN u.id % 4 = 1 THEN 8
        WHEN u.id % 4 = 2 THEN 9
        ELSE 10
    END as grade_level,
    CASE 
        WHEN u.id % 4 = 0 THEN 1
        WHEN u.id % 4 = 1 THEN 2
        WHEN u.id % 4 = 2 THEN 3
        ELSE 4
    END as section_id
FROM `users` u 
WHERE u.role = 'student' 
AND u.status = 'active'
AND NOT EXISTS (SELECT 1 FROM `students` s WHERE s.user_id = u.id);

-- For existing teachers (users with role='teacher')
INSERT IGNORE INTO `teachers` (`user_id`, `is_adviser`)
SELECT 
    u.id as user_id,
    0 as is_adviser
FROM `users` u 
WHERE u.role = 'teacher' 
AND u.status = 'active'
AND NOT EXISTS (SELECT 1 FROM `teachers` t WHERE t.user_id = u.id);

-- Create user requests for pending users
INSERT IGNORE INTO `user_requests` (`user_id`, `requested_role`, `status`, `requested_at`, `processed_at`, `processed_by`)
SELECT 
    u.id as user_id,
    u.requested_role as requested_role,
    CASE 
        WHEN u.status = 'active' THEN 'approved'
        WHEN u.status = 'pending' THEN 'pending'
        ELSE 'rejected'
    END as status,
    u.created_at as requested_at,
    u.approved_at as processed_at,
    u.approved_by as processed_by
FROM `users` u 
WHERE u.requested_role IS NOT NULL
AND NOT EXISTS (SELECT 1 FROM `user_requests` ur WHERE ur.user_id = u.id);

-- Create audit logs for existing approvals
INSERT IGNORE INTO `audit_logs` (`user_id`, `action`, `target_type`, `target_id`, `details`, `created_at`)
SELECT 
    u.approved_by as user_id,
    'user_approved' as action,
    'user' as target_type,
    u.id as target_id,
    JSON_OBJECT('approved_role', u.role, 'user_email', u.email) as details,
    u.approved_at as created_at
FROM `users` u 
WHERE u.approved_by IS NOT NULL 
AND u.approved_at IS NOT NULL
AND u.status = 'active';

-- Add indexes for better performance
CREATE INDEX `idx_users_status_role` ON `users` (`status`, `role`);
CREATE INDEX `idx_users_created_at` ON `users` (`created_at`);
CREATE INDEX `idx_user_requests_status` ON `user_requests` (`status`, `requested_at`);
CREATE INDEX `idx_audit_logs_action_date` ON `audit_logs` (`action`, `created_at`);

-- Update the users table to remove the requested_role column since we now have user_requests table
-- But first, let's make sure all data is migrated
-- We'll keep the column for now but mark it as deprecated

-- Add a comment to indicate the column is deprecated
ALTER TABLE `users` 
MODIFY COLUMN `requested_role` enum('admin','teacher','adviser','student','parent') DEFAULT NULL COMMENT 'DEPRECATED: Use user_requests table instead';

-- Create a view for easy access to user requests with user details
CREATE OR REPLACE VIEW `user_requests_view` AS
SELECT 
    ur.id as request_id,
    ur.user_id,
    u.name as user_name,
    u.email as user_email,
    ur.requested_role,
    ur.status as request_status,
    ur.requested_at,
    ur.processed_at,
    ur.processed_by,
    approver.name as processed_by_name,
    ur.rejection_reason,
    ur.additional_data
FROM `user_requests` ur
JOIN `users` u ON ur.user_id = u.id
LEFT JOIN `users` approver ON ur.processed_by = approver.id
ORDER BY ur.requested_at DESC;

-- Create a view for admin dashboard statistics
CREATE OR REPLACE VIEW `admin_stats_view` AS
SELECT 
    (SELECT COUNT(*) FROM `users` WHERE `status` = 'pending') as pending_users,
    (SELECT COUNT(*) FROM `users` WHERE `status` = 'active') as active_users,
    (SELECT COUNT(*) FROM `users` WHERE `status` = 'suspended') as suspended_users,
    (SELECT COUNT(*) FROM `users` WHERE `role` = 'student' AND `status` = 'active') as active_students,
    (SELECT COUNT(*) FROM `users` WHERE `role` = 'teacher' AND `status` = 'active') as active_teachers,
    (SELECT COUNT(*) FROM `users` WHERE `role` = 'parent' AND `status` = 'active') as active_parents,
    (SELECT COUNT(*) FROM `user_requests` WHERE `status` = 'pending') as pending_requests,
    (SELECT COUNT(*) FROM `audit_logs` WHERE `created_at` >= DATE_SUB(NOW(), INTERVAL 24 HOUR)) as recent_actions;

COMMIT;
