-- Manual Database Backup
-- Created: 2025-10-18 10:49:36
-- Database: student_monitoring

CREATE TABLE `audit_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` varchar(100) NOT NULL,
  `target_type` varchar(50) NOT NULL,
  `target_id` int(10) unsigned NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `action` (`action`),
  KEY `target_type` (`target_type`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `target_type`, `target_id`, `details`, `ip_address`, `user_agent`, `created_at`) VALUES
('1', '1', 'user_approved', 'user', '3', '{\"approved_role\":\"student\",\"user_email\":\"test@example.com\",\"user_name\":\"Test User\"}', NULL, NULL, '2025-10-16 22:47:17'),
('2', '1', 'user_approved', 'user', '4', '{\"approved_role\":\"student\",\"user_email\":\"johncalrbeee@gmail.com\",\"user_name\":\"John Carlbe\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 22:48:34'),
('3', '1', 'user_deleted', 'user', '3', '{\"deleted_role\":\"student\",\"user_email\":\"test@example.com\",\"user_name\":\"Test User\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 22:48:53'),
('4', '1', 'user_deleted', 'user', '4', '{\"deleted_role\":\"student\",\"user_email\":\"johncalrbeee@gmail.com\",\"user_name\":\"John Carlbe\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-17 07:43:16'),
('5', '1', 'user_approved', 'user', '5', '{\"approved_role\":\"student\",\"user_email\":\"johncarlbeg@gmail.com\",\"user_name\":\"John Carlbe\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-17 07:52:30'),
('6', '1', 'user_deleted', 'user', '6', '{\"deleted_role\":\"parent\",\"user_email\":\"dad@da.com\",\"user_name\":\"Ssdada ddawS\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-18 01:44:23'),
('7', '1', 'user_approved', 'user', '7', '{\"approved_role\":\"student\",\"user_email\":\"jeffstudent04@gmail.com\",\"user_name\":\"Jeff Garcia\"}', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-18 02:19:49');

CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `grade_level` tinyint(3) unsigned DEFAULT NULL,
  `section_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `lrn` (`lrn`),
  KEY `user_id` (`user_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `students` (`id`, `user_id`, `lrn`, `grade_level`, `section_id`, `created_at`, `updated_at`) VALUES
('4', '5', 'LRN000005', '7', '1', '2025-10-17 07:52:30', '2025-10-17 07:52:30'),
('5', '7', 'LRN000007', '7', '1', '2025-10-18 02:19:49', '2025-10-18 02:19:49');

CREATE TABLE `user_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `requested_role` enum('admin','teacher','adviser','student','parent') NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL,
  `processed_by` int(10) unsigned DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_data`)),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `processed_by` (`processed_by`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_requests` (`id`, `user_id`, `requested_role`, `status`, `requested_at`, `processed_at`, `processed_by`, `rejection_reason`, `additional_data`) VALUES
('1', '0', 'student', 'pending', '2025-10-16 22:30:20', NULL, NULL, NULL, '{\"registration_ip\":null,\"registration_user_agent\":null,\"registration_time\":\"2025-10-16 08:25:14\"}'),
('2', '0', 'student', 'pending', '2025-10-16 22:30:20', NULL, NULL, NULL, '{\"registration_ip\":null,\"registration_user_agent\":null,\"registration_time\":\"2025-10-16 21:20:03\"}'),
('3', '0', 'student', 'pending', '2025-10-16 22:39:50', NULL, NULL, NULL, '{\"registration_ip\":null,\"registration_user_agent\":null,\"registration_time\":\"2025-10-16 08:25:14\"}'),
('4', '0', 'student', 'pending', '2025-10-16 22:39:50', NULL, NULL, NULL, '{\"registration_ip\":null,\"registration_user_agent\":null,\"registration_time\":\"2025-10-16 21:20:03\"}'),
('5', '0', 'student', 'pending', '2025-10-16 22:40:22', NULL, NULL, NULL, '{\"test\":true}'),
('8', '5', 'student', 'approved', '2025-10-17 07:52:24', '2025-10-17 07:52:30', '1', NULL, '{\"registration_ip\":\"::1\",\"registration_user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36\",\"registration_time\":\"2025-10-17 15:52:24\"}'),
('9', '7', 'student', 'approved', '2025-10-18 02:19:41', '2025-10-18 02:19:49', '1', NULL, '{\"registration_ip\":\"::1\",\"registration_user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/141.0.0.0 Safari\\/537.36\",\"registration_time\":\"2025-10-18 10:19:41\"}');

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('admin','teacher','adviser','student','parent') NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','active','suspended') DEFAULT 'pending',
  `requested_role` enum('admin','teacher','adviser','student','parent') DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `approved_by` (`approved_by`),
  KEY `idx_users_created_at` (`created_at`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `role`, `email`, `password_hash`, `name`, `created_at`, `updated_at`, `status`, `requested_role`, `approved_by`, `approved_at`) VALUES
('1', 'admin', 'admin@school.edu', '$2y$10$kcVb2JJm.eD.91F2YFtiu.xJKCD.bZJV5n5CUB5ukf1yHcFeRBlZ6', 'System Administrator', '2025-10-16 13:37:51', '2025-10-16 08:21:19', 'active', NULL, NULL, NULL),
('2', 'teacher', 'teacher@gmail.com', '$2y$10$2X.vGcyfr7drEFSj5P5BZOQwF7bQfFF.CFLHKohz5GvYh7v7WAkhe', 'Shin Da', '2025-10-16 13:56:17', '2025-10-18 01:16:23', 'suspended', NULL, NULL, NULL),
('5', 'student', 'johncarlbeg@gmail.com', '$2y$10$vmW37iXVMm5MnGu6HQuUo.f1kzOnD37/F.oA6UdRyRMARkFKPEgs2', 'John Carlbe', '2025-10-17 07:52:24', '2025-10-17 07:52:29', 'active', 'student', '1', '2025-10-17 07:52:29'),
('7', 'student', 'jeffstudent04@gmail.com', '$2y$10$bOjUg3Fuw/aY/yXhfVnnTuJ120T2F2PTrVhCzuBEvPEdAYIH0Adie', 'Jeff Garcia', '2025-10-18 02:19:41', '2025-10-18 02:19:49', 'active', 'student', '1', '2025-10-18 02:19:49');

