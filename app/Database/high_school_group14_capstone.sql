-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 02:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `high_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adm_id` int(11) NOT NULL,
  `adm_username` varchar(255) DEFAULT NULL,
  `adm_profile` varchar(255) DEFAULT NULL,
  `adm_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `att_id` int(11) NOT NULL,
  `att_student_id` int(11) DEFAULT NULL,
  `att_code` varchar(255) DEFAULT NULL,
  `att_startime` time NOT NULL,
  `att_endtime` time NOT NULL,
  `att_date` date NOT NULL,
  `att_sch_id` int(11) NOT NULL,
  `att_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_submit`
--

CREATE TABLE `attendance_submit` (
  `att_sub_id` int(11) NOT NULL,
  `att_sub_code` varchar(255) DEFAULT NULL,
  `att_sub_time` time DEFAULT NULL,
  `att_sub_status` enum('Present','Late','Absent') DEFAULT 'Absent',
  `att_sub_stu_id` int(11) DEFAULT NULL,
  `att_sub_att_id` int(11) DEFAULT NULL,
  `att_sub_sch_id` int(11) DEFAULT NULL,
  `att_sub_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cou_id` int(11) NOT NULL,
  `cou_tea_id` int(11) NOT NULL,
  `cou_gra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cou_id`, `cou_tea_id`, `cou_gra_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL,
  `doc_type` enum('lecture','homework','none') DEFAULT 'none',
  `doc_name` varchar(255) NOT NULL,
  `doc_deatial` varchar(255) NOT NULL,
  `doc_cou_id` int(11) NOT NULL,
  `doc_date` datetime DEFAULT NULL,
  `doc_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`doc_id`, `doc_type`, `doc_name`, `doc_deatial`, `doc_cou_id`, `doc_date`, `doc_file`) VALUES
(1, 'lecture', 'dhslkjsa', 'bjkda', 3, '2025-04-06 17:50:16', 'documents/doc_file_1743936616.pdf'),
(2, 'homework', 'adslhfjk', 'ledaj', 3, '2025-04-06 18:27:30', 'documents/doc_file_1743938850.pdf'),
(3, 'homework', 'Chapter5', 'bajdhriuqheoi', 3, '2025-04-06 18:31:00', 'documents/Chapter5_1743939060.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `gra_id` int(11) NOT NULL,
  `gra_class` varchar(255) NOT NULL,
  `gra_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gra_id`, `gra_class`, `gra_group`) VALUES
(1, 'A', 12),
(2, 'B', 12);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_10_090206_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sch_id` int(11) NOT NULL,
  `sch_start_time` time NOT NULL,
  `sch_end_time` time NOT NULL,
  `sch_day` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
  `sch_cou_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sch_id`, `sch_start_time`, `sch_end_time`, `sch_day`, `sch_cou_id`) VALUES
(3, '07:00:00', '07:50:00', 'monday', 1),
(4, '08:00:00', '08:50:00', 'monday', 1),
(5, '09:00:00', '09:50:00', 'monday', 1),
(6, '10:00:00', '10:50:00', 'monday', 1),
(7, '07:00:00', '07:50:00', 'tuesday', 2),
(8, '08:00:00', '08:50:00', 'tuesday', 2),
(9, '09:00:00', '09:50:00', 'tuesday', 3),
(10, '10:00:00', '10:50:00', 'tuesday', 3),
(11, '07:00:00', '07:50:00', 'wednesday', 4),
(12, '08:00:00', '08:50:00', 'wednesday', 4),
(13, '09:00:00', '09:50:00', 'wednesday', 2),
(14, '10:00:00', '10:50:00', 'wednesday', 2),
(15, '07:00:00', '07:50:00', 'thursday', 6),
(16, '08:00:00', '08:50:00', 'thursday', 6),
(17, '09:00:00', '09:50:00', 'thursday', 8),
(18, '10:00:00', '10:50:00', 'thursday', 8),
(19, '07:00:00', '07:50:00', 'friday', 7),
(20, '08:00:00', '08:50:00', 'friday', 7),
(21, '09:00:00', '09:50:00', 'friday', 4),
(22, '10:00:00', '10:50:00', 'friday', 4);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `sco_id` int(11) NOT NULL,
  `sco_point` int(11) DEFAULT NULL,
  `sco_month` enum('January','February','March','April','May','June','July','August','September','October','November','December') DEFAULT NULL,
  `sco_cou_id` int(11) NOT NULL,
  `sco_stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('riZ7LrjXe3qVH2ZB6lPmnx0OxzNKXGh9dV4BBTlP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', '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', 1743939066);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stu_id` int(11) NOT NULL,
  `stu_fname` varchar(255) NOT NULL,
  `stu_gra_id` int(11) NOT NULL,
  `stu_username` varchar(255) NOT NULL,
  `stu_password` varchar(255) NOT NULL,
  `stu_gender` varchar(255) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_ph_number` int(11) NOT NULL,
  `stu_parent_number` int(11) NOT NULL,
  `stu_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stu_id`, `stu_fname`, `stu_gra_id`, `stu_username`, `stu_password`, `stu_gender`, `stu_dob`, `stu_ph_number`, `stu_parent_number`, `stu_profile`) VALUES
(1, 'honghav', 2, 'honghav1', '123456', 'male', '2025-04-03', 138974, 371791, NULL),
(2, 'ehak', 2, 'ehak2', '123456', 'male', '2025-04-03', 130640893, 3197849, NULL),
(3, 'Sokchea', 1, 'sokchea01', 'pass123', 'Male', '2010-03-12', 93123456, 967890123, NULL),
(4, 'Dara', 1, 'dara02', 'pass123', 'Male', '2009-07-20', 93234567, 966789012, NULL),
(5, 'Sophea', 1, 'sophea03', 'pass123', 'Female', '2011-01-15', 93345678, 965678901, NULL),
(6, 'Rachana', 1, 'rachana04', 'pass123', 'Female', '2010-10-10', 93456789, 964567890, NULL),
(7, 'Visal', 1, 'visal05', 'pass123', 'Male', '2008-05-25', 93567890, 963456789, NULL),
(8, 'Phearom', 1, 'phearom06', 'pass123', 'Male', '2009-11-30', 93678901, 962345678, NULL),
(9, 'Leakena', 2, 'leakena07', 'pass123', 'Female', '2011-09-18', 93789012, 961234567, NULL),
(10, 'Vuthy', 2, 'vuthy08', 'pass123', 'Male', '2010-02-05', 93890123, 960123456, NULL),
(11, 'Sreyneang', 2, 'sreyneang09', 'pass123', 'Female', '2009-12-22', 93901234, 959876543, NULL),
(12, 'Borey', 2, 'borey10', 'pass123', 'Male', '2011-08-09', 93012345, 958765432, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_image`) VALUES
(1, 'khmer', NULL),
(2, 'math', NULL),
(3, 'english', NULL),
(4, 'ICT', NULL),
(5, 'History', NULL),
(6, 'Geography', NULL),
(7, 'Physics', NULL),
(8, 'Chemistry', NULL),
(9, 'Biology', NULL),
(10, 'Earth Science', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tea_id` int(11) NOT NULL,
  `tea_fname` varchar(255) NOT NULL,
  `tea_gender` varchar(50) NOT NULL,
  `tea_subject` int(11) DEFAULT NULL,
  `tea_username` varchar(255) NOT NULL,
  `tea_password` varchar(255) NOT NULL,
  `tea_dob` date NOT NULL,
  `tea_ph_number` varchar(255) DEFAULT NULL,
  `tea_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tea_id`, `tea_fname`, `tea_gender`, `tea_subject`, `tea_username`, `tea_password`, `tea_dob`, `tea_ph_number`, `tea_profile`) VALUES
(1, 'long', 'Male', 1, 'long1', '123456', '2025-04-03', '40781371', '319874'),
(2, 'sokha', 'Female', 2, 'sokha1', '123456', '2025-04-03', '46923', NULL),
(3, 'Sokun', 'Female', 4, 'sokun_history', 'pass123', '1982-09-18', NULL, NULL),
(4, 'Narin', 'Male', 5, 'narin_geo', 'pass123', '1980-11-25', NULL, NULL),
(5, 'Pisey', 'Female', 6, 'pisey_phys', 'pass123', '1987-03-07', NULL, NULL),
(6, 'Vanna', 'Male', 7, 'vanna_chem', 'pass123', '1983-01-15', NULL, NULL),
(7, 'Davy', 'Female', 8, 'davy_bio', 'pass123', '1986-06-30', NULL, NULL),
(8, 'Rathana', 'Male', 1, 'rathana_earth', 'pass123', '1984-08-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `att_student_id` (`att_student_id`),
  ADD KEY `att_sch_id` (`att_sch_id`);

--
-- Indexes for table `attendance_submit`
--
ALTER TABLE `attendance_submit`
  ADD PRIMARY KEY (`att_sub_id`),
  ADD KEY `att_sub_stu_id` (`att_sub_stu_id`),
  ADD KEY `att_sub_att_id` (`att_sub_att_id`),
  ADD KEY `fk_att_sub_sch_id` (`att_sub_sch_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cou_id`),
  ADD KEY `cou_gra_id` (`cou_gra_id`),
  ADD KEY `cou_tea_id` (`cou_tea_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `doc_cou_id` (`doc_cou_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gra_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sch_id`),
  ADD KEY `sch_cou_id` (`sch_cou_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`sco_id`),
  ADD KEY `sco_cou_id` (`sco_cou_id`),
  ADD KEY `sco_stu_id` (`sco_stu_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stu_id`),
  ADD KEY `stu_gra_id` (`stu_gra_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tea_id`),
  ADD KEY `tea_subject` (`tea_subject`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `attendance_submit`
--
ALTER TABLE `attendance_submit`
  MODIFY `att_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `gra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `sco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`att_student_id`) REFERENCES `students` (`stu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`att_sch_id`) REFERENCES `schedules` (`sch_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_submit`
--
ALTER TABLE `attendance_submit`
  ADD CONSTRAINT `attendance_submit_ibfk_1` FOREIGN KEY (`att_sub_stu_id`) REFERENCES `students` (`stu_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `attendance_submit_ibfk_2` FOREIGN KEY (`att_sub_att_id`) REFERENCES `attendances` (`att_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_att_sub_sch_id` FOREIGN KEY (`att_sub_sch_id`) REFERENCES `schedules` (`sch_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`cou_gra_id`) REFERENCES `grade` (`gra_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`cou_tea_id`) REFERENCES `teachers` (`tea_id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`doc_cou_id`) REFERENCES `courses` (`cou_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`sch_cou_id`) REFERENCES `courses` (`cou_id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`sco_cou_id`) REFERENCES `courses` (`cou_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`sco_stu_id`) REFERENCES `students` (`stu_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`stu_gra_id`) REFERENCES `grade` (`gra_id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`tea_subject`) REFERENCES `subjects` (`sub_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
