-- Enhanced Students Table Structure
-- This script adds important fields to the students table for better student identification and management

-- Add additional fields to students table for comprehensive student information
ALTER TABLE `students` 
ADD COLUMN `student_number` varchar(20) DEFAULT NULL AFTER `lrn`,
ADD COLUMN `first_name` varchar(100) DEFAULT NULL AFTER `student_number`,
ADD COLUMN `last_name` varchar(100) DEFAULT NULL AFTER `first_name`,
ADD COLUMN `middle_name` varchar(100) DEFAULT NULL AFTER `last_name`,
ADD COLUMN `birth_date` date DEFAULT NULL AFTER `middle_name`,
ADD COLUMN `gender` enum('male','female','other') DEFAULT NULL AFTER `birth_date`,
ADD COLUMN `contact_number` varchar(20) DEFAULT NULL AFTER `gender`,
ADD COLUMN `address` text DEFAULT NULL AFTER `contact_number`,
ADD COLUMN `guardian_name` varchar(191) DEFAULT NULL AFTER `address`,
ADD COLUMN `guardian_contact` varchar(20) DEFAULT NULL AFTER `guardian_name`,
ADD COLUMN `guardian_relationship` varchar(50) DEFAULT NULL AFTER `guardian_contact`,
ADD COLUMN `school_year` varchar(10) DEFAULT '2025-2026' AFTER `guardian_relationship`,
ADD COLUMN `enrollment_status` enum('enrolled','transferred','dropped','graduated') DEFAULT 'enrolled' AFTER `school_year`,
ADD COLUMN `previous_school` varchar(191) DEFAULT NULL AFTER `enrollment_status`,
ADD COLUMN `medical_conditions` text DEFAULT NULL AFTER `previous_school`,
ADD COLUMN `allergies` text DEFAULT NULL AFTER `medical_conditions`,
ADD COLUMN `emergency_contact_name` varchar(191) DEFAULT NULL AFTER `allergies`,
ADD COLUMN `emergency_contact_number` varchar(20) DEFAULT NULL AFTER `emergency_contact_name`,
ADD COLUMN `emergency_contact_relationship` varchar(50) DEFAULT NULL AFTER `emergency_contact_number`,
ADD COLUMN `profile_picture` varchar(255) DEFAULT NULL AFTER `emergency_contact_relationship`,
ADD COLUMN `notes` text DEFAULT NULL AFTER `profile_picture`;

-- Add indexes for better performance
ALTER TABLE `students`
ADD INDEX `idx_student_number` (`student_number`),
ADD INDEX `idx_last_name` (`last_name`),
ADD INDEX `idx_grade_level` (`grade_level`),
ADD INDEX `idx_section_id` (`section_id`),
ADD INDEX `idx_enrollment_status` (`enrollment_status`),
ADD INDEX `idx_school_year` (`school_year`);

-- Add unique constraint for student_number
ALTER TABLE `students`
ADD UNIQUE KEY `unique_student_number` (`student_number`);

-- Update existing students with basic information (if any exist)
-- This will populate the new fields with data from the users table
UPDATE `students` s 
JOIN `users` u ON s.user_id = u.id 
SET 
    s.first_name = SUBSTRING_INDEX(u.name, ' ', 1),
    s.last_name = SUBSTRING_INDEX(u.name, ' ', -1),
    s.enrollment_status = 'enrolled',
    s.school_year = '2025-2026'
WHERE s.first_name IS NULL;

-- Create a view for easy student information retrieval
CREATE OR REPLACE VIEW `student_profiles` AS
SELECT 
    s.id as student_id,
    s.user_id,
    s.lrn,
    s.student_number,
    s.first_name,
    s.last_name,
    s.middle_name,
    CONCAT(s.first_name, ' ', IFNULL(s.middle_name, ''), ' ', s.last_name) as full_name,
    s.birth_date,
    s.gender,
    s.contact_number,
    s.address,
    s.grade_level,
    s.section_id,
    sec.name as section_name,
    s.guardian_name,
    s.guardian_contact,
    s.guardian_relationship,
    s.school_year,
    s.enrollment_status,
    s.previous_school,
    s.medical_conditions,
    s.allergies,
    s.emergency_contact_name,
    s.emergency_contact_number,
    s.emergency_contact_relationship,
    s.profile_picture,
    s.notes,
    s.created_at,
    s.updated_at,
    u.email,
    u.status as user_status
FROM `students` s
LEFT JOIN `users` u ON s.user_id = u.id
LEFT JOIN `sections` sec ON s.section_id = sec.id;

-- Insert sample sections if they don't exist
INSERT IGNORE INTO `sections` (`id`, `name`, `grade_level`, `room`, `max_students`, `school_year`, `description`) VALUES
(1, 'Grade 7 - Section A', 7, 'Room 101', 40, '2025-2026', 'Grade 7 Section A'),
(2, 'Grade 7 - Section B', 7, 'Room 102', 40, '2025-2026', 'Grade 7 Section B'),
(3, 'Grade 8 - Section A', 8, 'Room 201', 40, '2025-2026', 'Grade 8 Section A'),
(4, 'Grade 8 - Section B', 8, 'Room 202', 40, '2025-2026', 'Grade 8 Section B'),
(5, 'Grade 9 - Section A', 9, 'Room 301', 40, '2025-2026', 'Grade 9 Section A'),
(6, 'Grade 9 - Section B', 9, 'Room 302', 40, '2025-2026', 'Grade 9 Section B'),
(7, 'Grade 10 - Section A', 10, 'Room 401', 40, '2025-2026', 'Grade 10 Section A'),
(8, 'Grade 10 - Section B', 10, 'Room 402', 40, '2025-2026', 'Grade 10 Section B'),
(9, 'Grade 11 - Section A', 11, 'Room 501', 40, '2025-2026', 'Grade 11 Section A'),
(10, 'Grade 11 - Section B', 11, 'Room 502', 40, '2025-2026', 'Grade 11 Section B'),
(11, 'Grade 12 - Section A', 12, 'Room 601', 40, '2025-2026', 'Grade 12 Section A'),
(12, 'Grade 12 - Section B', 12, 'Room 602', 40, '2025-2026', 'Grade 12 Section B');
