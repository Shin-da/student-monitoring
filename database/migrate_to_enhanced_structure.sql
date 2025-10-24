-- =====================================================
-- ENHANCED STUDENT MONITORING DATABASE MIGRATION
-- =====================================================
-- This script migrates from the current working structure
-- to the enhanced structure with proper relationships
-- 
-- SAFETY: This script preserves all existing data
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- =====================================================
-- STEP 1: BACKUP EXISTING DATA
-- =====================================================

-- Create backup tables for existing data
CREATE TABLE `backup_users_old` AS SELECT * FROM `users`;
CREATE TABLE `backup_students_old` AS SELECT * FROM `students`;

-- =====================================================
-- STEP 2: ENHANCE USERS TABLE
-- =====================================================

-- Add new columns to users table if they don't exist
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `phone` varchar(20) DEFAULT NULL AFTER `name`,
ADD COLUMN IF NOT EXISTS `address` text DEFAULT NULL AFTER `phone`;

-- =====================================================
-- STEP 3: CREATE NEW TABLES
-- =====================================================

-- Subjects table
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(20) NOT NULL,
  `grade_level` tinyint(3) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `ww_percent` tinyint(3) UNSIGNED DEFAULT 30,
  `pt_percent` tinyint(3) UNSIGNED DEFAULT 50,
  `qe_percent` tinyint(3) UNSIGNED DEFAULT 20,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `grade_level` (`grade_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sections table (enhanced)
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `grade_level` tinyint(3) UNSIGNED NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `max_students` int(11) DEFAULT 50,
  `school_year` varchar(10) NOT NULL DEFAULT '2025-2026',
  `adviser_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `grade_level` (`grade_level`),
  KEY `adviser_id` (`adviser_id`),
  KEY `school_year` (`school_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Teachers table
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `specialization` varchar(191) DEFAULT NULL,
  `is_adviser` tinyint(1) DEFAULT 0,
  `hire_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Parents table
CREATE TABLE IF NOT EXISTS `parents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `relationship` enum('father','mother','guardian','grandparent','other') DEFAULT 'guardian',
  `occupation` varchar(191) DEFAULT NULL,
  `workplace` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parents_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Classes table (for teacher-subject-section assignments)
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `school_year` varchar(10) NOT NULL DEFAULT '2025-2026',
  `semester` enum('1st','2nd') DEFAULT '1st',
  `schedule` varchar(100) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `subject_id` (`subject_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `school_year` (`school_year`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Student Classes table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS `student_classes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('enrolled','dropped','completed') DEFAULT 'enrolled',
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_class` (`student_id`, `class_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `student_classes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_classes_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- STEP 4: ENHANCE STUDENTS TABLE
-- =====================================================

-- Add new columns to students table
ALTER TABLE `students` 
ADD COLUMN IF NOT EXISTS `student_number` varchar(20) DEFAULT NULL AFTER `lrn`,
ADD COLUMN IF NOT EXISTS `school_year` varchar(10) DEFAULT '2025-2026' AFTER `section_id`,
ADD COLUMN IF NOT EXISTS `date_enrolled` date DEFAULT NULL AFTER `school_year`,
ADD COLUMN IF NOT EXISTS `date_graduated` date DEFAULT NULL AFTER `date_enrolled`,
ADD COLUMN IF NOT EXISTS `status` enum('enrolled','transferred','graduated','dropped') DEFAULT 'enrolled' AFTER `date_graduated`;

-- Add indexes for new columns
ALTER TABLE `students` 
ADD UNIQUE KEY IF NOT EXISTS `student_number` (`student_number`),
ADD KEY IF NOT EXISTS `grade_level` (`grade_level`),
ADD KEY IF NOT EXISTS `school_year` (`school_year`);

-- =====================================================
-- STEP 5: INSERT SAMPLE DATA
-- =====================================================

-- Insert sample subjects for Grade 7
INSERT IGNORE INTO `subjects` (`name`, `code`, `grade_level`, `description`) VALUES
('Mathematics', 'MATH7', 7, 'Basic Mathematics for Grade 7'),
('English', 'ENG7', 7, 'English Language and Literature'),
('Science', 'SCI7', 7, 'General Science'),
('Filipino', 'FIL7', 7, 'Filipino Language'),
('Social Studies', 'SS7', 7, 'Social Studies and History'),
('Physical Education', 'PE7', 7, 'Physical Education and Health'),
('Computer Science', 'CS7', 7, 'Introduction to Computer Science'),
('Values Education', 'VE7', 7, 'Values and Character Education');

-- Insert sample section
INSERT IGNORE INTO `sections` (`name`, `grade_level`, `room`, `max_students`, `school_year`, `description`) VALUES
('Grade 7 - Section A', 7, 'Room 101', 40, '2025-2026', 'Main Grade 7 section');

-- Create teacher record for existing teacher user
INSERT IGNORE INTO `teachers` (`user_id`, `employee_id`, `department`, `is_adviser`) 
SELECT id, CONCAT('EMP', LPAD(id, 3, '0')), 'General', 1 
FROM `users` 
WHERE role = 'teacher' AND id NOT IN (SELECT user_id FROM teachers);

-- =====================================================
-- STEP 6: UPDATE EXISTING STUDENT DATA
-- =====================================================

-- Update existing students with school year and enrollment date
UPDATE `students` 
SET 
  `school_year` = '2025-2026',
  `date_enrolled` = CURDATE(),
  `status` = 'enrolled'
WHERE `school_year` IS NULL;

-- Assign existing students to the sample section
UPDATE `students` 
SET `section_id` = 1 
WHERE `section_id` IS NULL AND `grade_level` = 7;

-- =====================================================
-- STEP 7: CREATE SAMPLE CLASSES
-- =====================================================

-- Create classes for the sample section
INSERT IGNORE INTO `classes` (`section_id`, `subject_id`, `teacher_id`, `school_year`, `schedule`, `room`) 
SELECT 
  1 as section_id,
  s.id as subject_id,
  t.id as teacher_id,
  '2025-2026' as school_year,
  CONCAT('Mon-Fri ', CASE s.id % 4 + 1 
    WHEN 1 THEN '8:00-9:00'
    WHEN 2 THEN '9:00-10:00' 
    WHEN 3 THEN '10:00-11:00'
    ELSE '11:00-12:00'
  END) as schedule,
  'Room 101' as room
FROM `subjects` s
CROSS JOIN `teachers` t
WHERE s.grade_level = 7 AND t.is_adviser = 1;

-- =====================================================
-- STEP 8: ENROLL STUDENTS IN CLASSES
-- =====================================================

-- Enroll all Grade 7 students in all Grade 7 classes
INSERT IGNORE INTO `student_classes` (`student_id`, `class_id`, `status`)
SELECT 
  st.id as student_id,
  c.id as class_id,
  'enrolled' as status
FROM `students` st
CROSS JOIN `classes` c
JOIN `sections` s ON c.section_id = s.id
WHERE st.grade_level = 7 AND s.grade_level = 7;

-- =====================================================
-- STEP 9: VERIFICATION QUERIES
-- =====================================================

-- These queries will help verify the migration was successful
-- (Commented out to avoid output during migration)

/*
-- Check table counts
SELECT 'users' as table_name, COUNT(*) as count FROM users
UNION ALL
SELECT 'students', COUNT(*) FROM students
UNION ALL
SELECT 'teachers', COUNT(*) FROM teachers
UNION ALL
SELECT 'subjects', COUNT(*) FROM subjects
UNION ALL
SELECT 'sections', COUNT(*) FROM sections
UNION ALL
SELECT 'classes', COUNT(*) FROM classes
UNION ALL
SELECT 'student_classes', COUNT(*) FROM student_classes;

-- Check student data
SELECT s.id, u.name, s.lrn, s.grade_level, sec.name as section_name, s.status
FROM students s
JOIN users u ON s.user_id = u.id
LEFT JOIN sections sec ON s.section_id = sec.id;

-- Check classes
SELECT c.id, s.name as subject, sec.name as section, u.name as teacher, c.schedule
FROM classes c
JOIN subjects s ON c.subject_id = s.id
JOIN sections sec ON c.section_id = sec.id
JOIN teachers t ON c.teacher_id = t.id
JOIN users u ON t.user_id = u.id;
*/

COMMIT;

-- =====================================================
-- MIGRATION COMPLETE
-- =====================================================
-- 
-- The database has been successfully migrated to the enhanced structure.
-- All existing data has been preserved and new relationships established.
-- 
-- Next steps:
-- 1. Test the student profile page
-- 2. Update application code to use new structure
-- 3. Add more sample data as needed
-- =====================================================
