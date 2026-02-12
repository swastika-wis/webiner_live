-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 07:40 AM
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
-- Database: `webinar_live`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_number` varchar(255) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `meeting_password` varchar(255) DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `meeting_details` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `meeting_number`, `vendor_id`, `meeting_password`, `topic`, `meeting_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '87375935417', '1', 'aeu1wWROAn5f17nIOpf36zWQ4IXYMU.1', 'Topic One', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 12 Feb 2026 05:39:42 GMT\r\n\r\n{\"uuid\":\"luzjHhrKSeKFr4bwMrIF+g==\",\"id\":87375935417,\"host_id\":\"8ojqWW6uQDiesEVzJRIH0w\",\"host_email\":\"swastika.wis@gmail.com\",\"topic\":\"Topic One\",\"type\":2,\"status\":\"waiting\",\"start_time\":\"2026-02-14T05:36:00Z\",\"duration\":30,\"timezone\":\"Asia\\/Kolkata\",\"created_at\":\"2026-02-12T05:39:43Z\",\"start_url\":\"https:\\/\\/us05web.zoom.us\\/s\\/87375935417?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NzM3NTkzNTQxNyIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiOG9qcVdXNnVRRGllc0VWekpSSUgwdyIsInppZCI6IjdkMzBjNDYwNDIyMzQ2Y2ViOGM2Y2ZiZTg5MzM2NGU5Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzcwODgxOTg0LCJpYXQiOjE3NzA4NzQ3ODQsImFpZCI6IlAzRmdZM1JYUVdXUWRTVTJiYlp3NUEiLCJjaWQiOiIifQ.xnmFrZcQ0YnIl3UD75lEFu1CP4e3GJBRkqgl4ULt1Ts\",\"join_url\":\"https:\\/\\/us05web.zoom.us\\/j\\/87375935417?pwd=aeu1wWROAn5f17nIOpf36zWQ4IXYMU.1\",\"password\":\"GtF5Tp\",\"h323_password\":\"553744\",\"pstn_password\":\"553744\",\"encrypted_password\":\"aeu1wWROAn5f17nIOpf36zWQ4IXYMU.1\",\"settings\":{\"host_video\":true,\"participant_video\":true,\"cn_meeting\":false,\"in_meeting\":false,\"join_before_host\":false,\"jbh_time\":0,\"mute_upon_entry\":true,\"watermark\":false,\"use_pmi\":false,\"approval_type\":2,\"audio\":\"voip\",\"auto_recording\":\"none\",\"auto_add_recording_to_video_management\":{\"enable\":false},\"enforce_login\":false,\"enforce_login_domains\":\"\",\"alternative_hosts\":\"\",\"alternative_host_update_polls\":false,\"alternative_host_manage_meeting_summary\":false,\"alternative_host_manage_cloud_recording\":false,\"close_registration\":false,\"show_share_button\":false,\"allow_multiple_devices\":false,\"registrants_confirmation_email\":true,\"waiting_room\":false,\"request_permission_to_unmute_participants\":false,\"registrants_email_notification\":true,\"meeting_authentication\":false,\"encryption_type\":\"enhanced_encryption\",\"approved_or_denied_countries_or_regions\":{\"enable\":false},\"breakout_room\":{\"enable\":false},\"internal_meeting\":false,\"continuous_meeting_chat\":{\"enable\":false,\"auto_add_invited_external_users\":false,\"auto_add_meeting_participants\":false},\"participant_focused_meeting\":false,\"push_change_to_calendar\":false,\"resources\":[],\"allow_host_control_participant_mute_state\":false,\"alternative_hosts_email_notification\":true,\"show_join_info\":false,\"device_testing\":false,\"focus_mode\":false,\"meeting_invitees\":[],\"private_meeting\":false,\"email_notification\":true,\"host_save_video_order\":false,\"sign_language_interpretation\":{\"enable\":false},\"email_in_attendee_report\":false},\"creation_source\":\"open_api\",\"pre_schedule\":false}', '2026-02-14 05:36:00', '2026-02-12 00:09:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_02_095829_create_vendors_table', 1),
(6, '2025_09_07_145637_create_meetings_table', 1),
(7, '2025_09_08_014100_create_participents_table', 1),
(8, '2025_09_12_093925_create_polls', 1),
(9, '2025_09_14_154543_create_questions_table', 2),
(10, '2025_09_12_094645_create_poll_options', 3),
(11, '2025_09_15_061101_create_qnas_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `option_image` varchar(255) DEFAULT NULL,
  `votes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `poll_id`, `question_id`, `option_text`, `option_image`, `votes_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 2, 'blue', NULL, 0, '2026-02-12 00:18:10', '2026-02-12 00:18:10', NULL),
(2, NULL, 2, 'red', NULL, 0, '2026-02-12 00:18:10', '2026-02-12 00:18:10', NULL),
(3, NULL, 2, 'black', NULL, 0, '2026-02-12 00:18:10', '2026-02-12 00:18:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participents`
--

CREATE TABLE `participents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) DEFAULT NULL,
  `login_status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participents`
--

INSERT INTO `participents` (`id`, `full_name`, `email`, `phone`, `meeting_id`, `status`, `active`, `password`, `login_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AMI', 'a@gmail.com', '8888888888', '87375935417', '1', 1, '$2y$12$zoI/EoHBnPL/kjKAWhZCSuqJzdI7xvpKBlLbYJZssFXUwKsntPJ5m', '0', '2026-02-12 05:55:28', '2026-02-12 00:52:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_number` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `meeting_number`, `title`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '87375935417', 'Sky colour', '2026-02-14 07:45:00', NULL, '2026-02-12 00:14:01', '2026-02-12 00:14:01', NULL),
(2, '87375935417', 'Sky colour', '2026-02-14 07:45:00', NULL, '2026-02-12 00:14:01', '2026-02-12 00:14:01', NULL),
(3, '87375935417', 'Sky colour', '2026-02-14 07:45:00', NULL, '2026-02-12 00:17:32', '2026-02-12 00:17:32', NULL),
(4, '87375935417', 'Sky colour', '2026-02-14 07:45:00', NULL, '2026-02-12 00:18:10', '2026-02-12 00:18:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qnas`
--

CREATE TABLE `qnas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `ask_by` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `answer_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `question_text` text DEFAULT NULL,
  `question_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `poll_id`, `question_type`, `question_text`, `question_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'text', 'Current sky colour', NULL, '2026-02-12 00:17:32', '2026-02-12 00:17:32', NULL),
(2, 4, 'text', 'Current sky colour', NULL, '2026-02-12 00:18:10', '2026-02-12 00:18:10', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Swastika Admin', 'swastika.wis@gmail.com', NULL, '$2y$12$5neiq7VLcqsl.uSp9yyiNOFUqiir6bSif9jBHy9CvajRRVMojHtkW', NULL, '2026-02-12 00:00:51', '2026-02-12 00:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_polls`
--

CREATE TABLE `user_polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paticipant_id` int(11) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `theme_background` varchar(255) DEFAULT NULL,
  `theme_foreground` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `logo2` varchar(255) DEFAULT NULL,
  `logo3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `theme_background`, `theme_foreground`, `logo`, `user_name`, `password`, `logo2`, `logo3`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test Meeting One', '#6b41b9', '#000000', 'vendors/z7TQsNcOOTidaU7u5LzeXNr1xWsBaAJmULDHoZcW.jpg', 'test@gmail.com', '$2y$12$AFlqwuyifTWiWJqRuvb0xuDE7XhHtksMm2g7mwNkQXUGtOZLDiio6', 'vendors/Z8Ar5NI3bXiEh7vNK4grmXjgbDSY1ZcbJYovULjg.jpg', 'vendors/OK55N9z3bzECwQxdH8CWBF2ei6Ow73n43AnkL6PW.jpg', '2026-02-12 00:05:56', '2026-02-12 00:05:56', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `participents`
--
ALTER TABLE `participents`
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
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qnas`
--
ALTER TABLE `qnas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_poll_id_foreign` (`poll_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_polls`
--
ALTER TABLE `user_polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `participents`
--
ALTER TABLE `participents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `qnas`
--
ALTER TABLE `qnas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_polls`
--
ALTER TABLE `user_polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
