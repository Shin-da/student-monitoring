-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 04:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup_students`
--

CREATE TABLE `backup_students` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `grade_level` tinyint(3) UNSIGNED DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_users`
--

CREATE TABLE `backup_users` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `role` enum('admin','teacher','adviser','student','parent') NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','active','suspended') DEFAULT 'pending',
  `requested_role` enum('admin','teacher','adviser','student','parent') DEFAULT NULL,
  `approved_by` int(10) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `backup_users`
--

INSERT INTO `backup_users` (`id`, `role`, `email`, `password_hash`, `name`, `created_at`, `updated_at`, `status`, `requested_role`, `approved_by`, `approved_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$AtSRPrCSU7rcmPtJICAPYOQnEo1E5cTkepljQUS/x8O4yJvnDGbIa', 'Administrator', '2025-10-06 20:01:37', '2025-10-07 00:26:13', 'active', NULL, NULL, NULL),
(2, 'student', 'orbemike1922@gmail.com', '$2y$10$zFGWOXXSQpP4Z3O9E5uh4.MRwR591Z.qJbdaUs3M87iaY70FGSyCu', 'mike', '2025-10-07 14:41:55', '2025-10-10 13:42:04', 'active', 'student', 1, '2025-10-10 13:42:04'),
(3, 'student', 'luwiistudent@gmail.com', '$2y$10$LDhIrP4cCshxcwB65WSvkOeVq.69I3dU.WAD9dMQ6kXffCtUplUIG', 'luwii', '2025-10-08 14:29:53', '2025-10-08 14:29:53', 'active', NULL, 1, '2025-10-08 14:29:53'),
(5, 'student', 'louie@student.ph', '$2y$10$B3Ct4HPjaBi/4D09tpzW4.oWuJp.is4ZotSfq87ihT80iyQk9C89q', 'louie', '2025-10-10 14:01:35', '2025-10-10 14:01:35', 'active', NULL, NULL, NULL),
(7, 'teacher', 'teacher@gmail.com', '$2y$10$GxLmK2wK325VIF1MCxZMD.ILkKoLvdDRrQK6pnXHQnw43QyDbm/yO', 'teacher', '2025-10-10 14:23:00', '2025-10-10 14:23:00', 'active', NULL, NULL, NULL),
(8, 'student', 'mikestudent@gmail.com', '$2y$10$WUO99ZtUj6hABPnpWC08OuVCgm8GvytVLxcHYB1C2p2XyLlUn4OTa', 'mike', '2025-10-13 11:59:45', '2025-10-13 11:59:45', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `relationship` enum('father','mother','guardian') DEFAULT 'guardian',
  `contact_name` varchar(191) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) UNSIGNED NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `section` varchar(10) NOT NULL,
  `room` varchar(50) NOT NULL,
  `max_students` int(11) DEFAULT 50,
  `description` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `class_name`, `subject`, `grade_level`, `section`, `room`, `max_students`, `description`, `date_created`) VALUES
(1, 'IT', 'mathematics', '12', '4E', '212', 54, 'gsdfgh', '2025-10-10 15:16:04'),
(4, 'IT 1', 'mathematics', '12', 'e', '211', 34, NULL, '2025-10-12 03:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `grade_level` tinyint(3) UNSIGNED DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `school_year` varchar(10) DEFAULT NULL,
  `adviser_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_name` varchar(191) DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date_enrolled` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `lrn`, `grade_level`, `section_id`, `school_year`, `adviser_id`, `contact_name`, `emergency_contact`, `relationship`, `address`, `date_enrolled`) VALUES
(1, 11, 'LRN2025-001', 10, 1, '2025-2026', 1, 'Ana Santos', '09171234567', 'Mother', 'Manila City', '2025-10-13 12:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `grade_level` tinyint(3) UNSIGNED NOT NULL,
  `ww_percent` tinyint(3) UNSIGNED DEFAULT 30,
  `pt_percent` tinyint(3) UNSIGNED DEFAULT 50,
  `qe_percent` tinyint(3) UNSIGNED DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `teacher_name` varchar(191) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `is_adviser` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `teacher_name`, `department`, `is_adviser`) VALUES
(1, 10, 'Juan Dela Cruz', 'Math', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` enum('admin','teacher','adviser','student','parent') NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_role` enum('admin','teacher','adviser','student','parent') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','active','suspended') DEFAULT 'pending',
  `requested_role` enum('admin','teacher','adviser','student','parent') DEFAULT NULL,
  `approved_by` int(10) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password_hash`, `name`, `phone`, `address`, `user_role`, `created_at`, `updated_at`, `status`, `requested_role`, `approved_by`, `approved_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$AtSRPrCSU7rcmPtJICAPYOQnEo1E5cTkepljQUS/x8O4yJvnDGbIa', 'Administrator', NULL, NULL, NULL, '2025-10-06 20:01:37', '2025-10-07 00:26:13', 'active', NULL, NULL, NULL),
(2, 'student', 'orbemike1922@gmail.com', '$2y$10$zFGWOXXSQpP4Z3O9E5uh4.MRwR591Z.qJbdaUs3M87iaY70FGSyCu', 'mike', NULL, NULL, NULL, '2025-10-07 14:41:55', '2025-10-10 13:42:04', 'active', 'student', 1, '2025-10-10 13:42:04'),
(3, 'student', 'luwiistudent@gmail.com', '$2y$10$LDhIrP4cCshxcwB65WSvkOeVq.69I3dU.WAD9dMQ6kXffCtUplUIG', 'luwii', NULL, NULL, NULL, '2025-10-08 14:29:53', '2025-10-08 14:29:53', 'active', NULL, 1, '2025-10-08 14:29:53'),
(5, 'student', 'louie@student.ph', '$2y$10$B3Ct4HPjaBi/4D09tpzW4.oWuJp.is4ZotSfq87ihT80iyQk9C89q', 'louie', NULL, NULL, NULL, '2025-10-10 14:01:35', '2025-10-10 14:01:35', 'active', NULL, NULL, NULL),
(7, 'teacher', 'teacher@gmail.com', '$2y$10$GxLmK2wK325VIF1MCxZMD.ILkKoLvdDRrQK6pnXHQnw43QyDbm/yO', 'teacher', NULL, NULL, NULL, '2025-10-10 14:23:00', '2025-10-10 14:23:00', 'active', NULL, NULL, NULL),
(8, 'student', 'mikestudent@gmail.com', '$2y$10$WUO99ZtUj6hABPnpWC08OuVCgm8GvytVLxcHYB1C2p2XyLlUn4OTa', 'mike', NULL, NULL, NULL, '2025-10-13 11:59:45', '2025-10-13 11:59:45', 'active', NULL, NULL, NULL),
(10, 'teacher', 'teacher1@school.ph', '$2y$10$testpasswordhash', 'Juan Dela Cruz', NULL, NULL, NULL, '2025-10-13 12:54:23', '2025-10-13 12:54:23', 'active', NULL, NULL, NULL),
(11, 'student', 'student1@school.ph', '$2y$10$testpasswordhash', 'Maria Santos', NULL, NULL, NULL, '2025-10-13 12:54:23', '2025-10-13 12:54:23', 'active', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`),
  ADD UNIQUE KEY `idx_students_lrn` (`lrn`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `approved_by` (`approved_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `fk_parents_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_parents_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parents_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
