-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2026 at 04:37 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counsellor`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'AAAA', '2026-09-25 23:26:44', '2026-09-25 23:26:44'),
(2, 1, 7, 'BBB', '2026-09-25 23:26:53', '2026-09-25 23:26:53'),
(4, 2, 2, 'kkkkk', '2026-09-25 23:51:59', '2026-09-25 23:52:19'),
(5, 2, 15, 'aaaa', '2026-09-26 00:33:07', '2026-09-26 00:33:07'),
(10, 2, 16, 'AAAA', '2026-09-30 01:27:34', '2026-09-30 01:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

DROP TABLE IF EXISTS `availabilities`;
CREATE TABLE IF NOT EXISTS `availabilities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `counsellor_id` bigint UNSIGNED NOT NULL,
  `day_of_week` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `availabilities_counsellor_id_foreign` (`counsellor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `counsellor_id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(10, 2, 3, '08:00:00', '18:00:00', '2026-09-25 00:16:23', '2026-09-25 00:16:23'),
(14, 2, 2, '08:00:00', '10:00:00', '2026-09-25 00:33:59', '2026-09-25 00:33:59'),
(15, 2, 1, '09:00:00', '11:00:00', '2026-09-25 00:34:04', '2026-09-25 00:34:04'),
(11, 2, 4, '08:00:00', '18:00:00', '2026-09-25 00:16:34', '2026-09-25 00:16:34'),
(12, 2, 5, '08:00:00', '18:00:00', '2026-09-25 00:16:41', '2026-09-25 00:16:41'),
(13, 2, 6, '08:00:00', '18:00:00', '2026-09-25 00:16:48', '2026-09-25 00:16:48'),
(16, 2, 2, '11:00:00', '13:00:00', '2026-09-25 00:34:28', '2026-09-25 00:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('blog','painting','poetry') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blog',
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `blogs_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `image`, `content`, `created_at`, `updated_at`, `user_id`, `type`, `status`, `is_active`) VALUES
(1, 'First Blog', 'Mindfulness & Meditation', '1790752132.png', '<p>First Blog Desc2</p>', '2026-09-30 01:38:52', '2026-09-30 02:40:28', 7, 'blog', 'rejected', 1),
(2, 'Paint 01 022', NULL, '1790755746.jpg', NULL, '2026-09-30 01:39:48', '2026-09-30 02:39:06', 7, 'painting', 'rejected', 0),
(3, 'Poetry 011', NULL, NULL, '<p>AAA</p>', '2026-09-30 01:40:06', '2026-09-30 02:29:51', 7, 'poetry', 'approved', 0),
(4, 'Blog 02', 'Mindfulness & Meditation', '1790753526.png', '<p>AAA</p>', '2026-09-30 02:02:06', '2026-09-30 02:02:06', 1, 'blog', 'approved', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Anxiety & Stress2', NULL, '2026-09-30 02:18:09', 1),
(2, 'Depression & Mood', NULL, '2026-09-26 00:17:12', 0),
(3, 'Relationships & Family', NULL, NULL, 1),
(4, 'Self-Care & Wellness', NULL, NULL, 1),
(5, 'Therapy & Counseling', NULL, NULL, 1),
(6, 'Mindfulness & Meditation', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `counsellor_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','accepted','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_counsellor_id_foreign` (`counsellor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `counsellor_id`, `date`, `start_time`, `end_time`, `message`, `status`, `cancellation_reason`, `created_at`, `updated_at`, `cancelled_by`) VALUES
(1, 7, 2, '2026-09-25', '09:00:00', '10:00:00', NULL, 'cancelled', 'Hello', '2026-09-25 00:41:07', '2026-09-25 00:48:00', NULL),
(2, 7, 2, '2026-09-25', '14:00:00', '15:00:00', NULL, 'cancelled', 'A', '2026-09-25 00:49:06', '2026-09-25 00:51:02', NULL),
(3, 7, 2, '2026-09-25', '08:00:00', '09:00:00', NULL, 'cancelled', 'Cancelled by User', '2026-09-25 00:51:27', '2026-09-25 00:51:31', NULL),
(4, 7, 2, '2026-09-25', '08:00:00', '08:50:00', NULL, 'completed', NULL, '2026-09-25 01:09:37', '2026-09-25 23:49:52', NULL),
(5, 8, 2, '2026-09-25', '10:00:00', '10:50:00', 'Try now', 'completed', NULL, '2026-09-25 01:11:21', '2026-09-30 01:20:19', NULL),
(6, 8, 2, '2026-09-25', '09:00:00', '09:50:00', 'AAA', 'completed', NULL, '2026-09-25 01:15:34', '2026-09-30 01:17:22', NULL),
(7, 10, 2, '2026-09-25', '11:00:00', '11:50:00', 'AAA', 'cancelled', 'AAA', '2026-09-25 02:11:38', '2026-09-30 01:24:27', 'counsellor'),
(8, 11, 2, '2026-09-25', '13:00:00', '13:50:00', 'AAAA', 'completed', NULL, '2026-09-25 02:37:52', '2026-09-30 01:24:44', NULL),
(9, 11, 2, '2026-09-25', '14:00:00', '14:50:00', 'BBB', 'accepted', NULL, '2026-09-25 02:38:05', '2026-09-30 01:19:05', NULL),
(10, 11, 2, '2026-09-25', '15:00:00', '15:50:00', 'AAAA', 'cancelled', 'AAA', '2026-09-25 02:38:38', '2026-09-30 01:19:12', 'counsellor'),
(11, 15, 2, '2026-09-28', '09:00:00', '09:50:00', 'ooo', 'cancelled', 'AAA', '2026-09-26 00:40:48', '2026-09-26 00:40:54', 'user'),
(12, 7, 2, '2026-09-28', '09:00:00', '09:50:00', 'AAAA', 'cancelled', 'AAA', '2026-09-26 02:04:12', '2026-09-26 02:04:41', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Are my details confidential?', '100% confidential. Everything you share with your counsellor stays strictly between the two of you. Biyani Ghar never discloses your identity, conversations or personal details to college staff, faculty or anyone else without your written consent....', '2026-09-25 23:34:00', '2026-09-30 02:13:38', 1),
(2, 'Is counselling free for students?', '<p>Yes, Biyani Ghar\'s counselling sessions are offered free of cost to all enrolled students.</p>', '2026-09-25 23:34:00', '2026-09-30 02:13:43', 0),
(3, 'How do I book a session?', '<p>Use the \'Book Session\' button anywhere on this page to choose a counsellor and a time that works for you.</p>', '2026-09-25 23:34:00', '2026-09-25 23:34:00', 1),
(4, 'Can I reach out anonymously at first?', '<p>Yes, you are welcome to ask general questions anonymously before deciding whether to share your name and details.</p>', '2026-09-25 23:34:00', '2026-09-25 23:34:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `counsellor_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaves_counsellor_id_foreign` (`counsellor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `counsellor_id`, `date`, `reason`, `created_at`, `updated_at`) VALUES
(5, 2, '2026-09-26', NULL, '2026-09-25 00:37:47', '2026-09-25 00:37:47'),
(4, 2, '2026-09-24', NULL, '2026-09-25 00:37:41', '2026-09-25 00:37:41'),
(6, 2, '2026-09-30', NULL, '2026-09-25 00:37:53', '2026-09-25 00:37:53'),
(7, 2, '2026-09-24', 'Lorem Ipsum test test', '2026-09-25 00:45:48', '2026-09-25 00:45:48'),
(8, 2, '2026-09-26', NULL, '2026-09-25 00:46:58', '2026-09-25 00:46:58'),
(9, 2, '2026-09-24', NULL, '2026-09-25 03:08:04', '2026-09-25 03:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_25_051216_create_otps_table', 1),
(5, '2026_09_25_051217_create_availabilities_table', 1),
(6, '2026_09_25_051218_create_leaves_table', 1),
(7, '2026_09_25_051219_create_bookings_table', 1),
(9, '2026_09_25_063918_add_message_to_bookings_table', 2),
(10, '2026_09_25_074729_add_counsellor_fields_to_users_table', 3),
(11, '2026_09_25_081250_create_blogs_table', 4),
(12, '2026_09_25_081251_create_testimonials_table', 4),
(13, '2026_09_25_082226_add_content_to_blogs_table', 5),
(14, '2026_09_25_082851_create_questions_table', 6),
(15, '2026_09_25_082852_create_answers_table', 6),
(16, '2026_09_25_085042_remove_image_from_testimonials_and_link_from_blogs', 7),
(17, '2026_09_25_085743_add_experience_to_users_table', 8),
(18, '2026_09_26_045807_create_faqs_table', 9),
(19, '2026_09_26_050849_add_cancelled_by_to_bookings_table', 10),
(20, '2026_09_26_051544_create_blog_categories_table', 11),
(21, '2026_09_26_051902_modify_status_in_bookings_table', 12),
(22, '2026_09_26_052843_add_activity_columns_to_blogs_table', 13),
(23, '2026_09_26_053600_add_is_active_to_tables', 14);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

DROP TABLE IF EXISTS `otps`;
CREATE TABLE IF NOT EXISTS `otps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone`, `otp`, `expires_at`, `created_at`, `updated_at`) VALUES
(13, '9785555555', '367459', '2026-09-25 02:24:12', '2026-09-25 02:21:12', '2026-09-25 02:21:12'),
(17, '1111111111', '984831', '2026-09-25 03:08:23', '2026-09-25 03:05:23', '2026-09-25 03:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 7, 'Pankaj Gupya', 'AAAA', '2026-09-25 23:26:35', '2026-09-25 23:26:35'),
(2, 7, 'FFF', 'FFF', '2026-09-25 23:38:15', '2026-09-25 23:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Zz4VsKMZEPew8s13kzoigulCio8y8zpihMKXFFSz', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI0emVVS1dPVVNrSnpkVktWWlkxbEZ2c0hmQ0ZHWjlmMXpXb25qVXpGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb3Vuc2VsbG9yLWxvZ2luIiwicm91dGUiOiJjb3Vuc2VsbG9yLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiNDJjNTMwODc3MjliZDBmNjg5MTU3ZDBkODBhY2QzNDBiYzM5MGZlMTBmMjQ3NWQwYTMxYmM5ZWJjMWI2NDc2YiJ9', 1790750669),
('6PnXz9j0ItuHOMLJevXyhu2EXU36yqyKYy51ti8S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJxSUZtMUV5Wkx1VFR1TVh1c1BPNEZYblViWUNuZTRJZTNqenkzM3FJIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=', 1790760815),
('QAFm4XinaNiPG8gef5G5zwkMDX3gwULnTw52oDAj', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJEdEFPMGo0ZFhxYk5EZFY1TDB2T0dib3Q3ejZMRjdnZ1pwbHp1bVg3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL3VzZXIiLCJyb3V0ZSI6InVzZXIuZGFzaGJvYXJkIn0sIm90cF9zZW50X2F0IjoxNzkwNzUyNjc0LCJ1YXRfb3RwIjoiMzM1OTQwIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjd9', 1790754760);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `student_name`, `course_year`, `content`, `created_at`, `updated_at`, `is_active`) VALUES
(2, 'a', 'BCA, 2nd Year', '<p>I was struggling with homesickness and anxiety, but talking to the counsellor made me feel at ease. Truly a safe space...</p>', '2026-09-25 02:49:20', '2026-09-30 02:35:43', 1),
(3, 'Priya Singh', 'MBA, 1st Year', '<p>Managing studies and personal life was getting overwhelming. The guidance I received here was life-changing.</p>', '2026-09-25 02:49:20', '2026-09-26 00:03:39', 1),
(4, 'Neha Gupta', 'B.Sc Bio, Final Year', 'I walked in feeling overwhelmed by exams. One honest conversation helped me breathe and make a plan I could actually follow.', '2026-09-25 02:49:20', '2026-09-25 02:58:10', 1),
(5, 'Amit Kumar', 'BBA, 2nd Year', 'It felt like talking to someone who truly understood. No judgment, just care, and I left feeling lighter.', '2026-09-25 02:49:20', '2026-09-25 02:58:11', 1),
(6, 'Kritika Jain', 'B.Com, 1st Year', 'Biyani Ghar reminded me that asking for help is not a weakness. It is a real act of courage.', '2026-09-25 02:49:20', '2026-09-25 02:58:12', 1),
(7, 'Saurabh Mishra', 'MCA, Final Year', 'I was constantly overthinking my career choices. The sessions gave me a new perspective and helped me focus.', '2026-09-25 02:49:20', '2026-09-25 02:58:13', 1),
(8, 'Pooja Yadav', 'M.Sc IT, 1st Year', 'The environment is so welcoming. Every student should visit at least once, even if it\'s just to vent.', '2026-09-25 02:49:20', '2026-09-25 02:58:14', 1),
(9, 'Vikas Patel', 'B.Tech EE, 2nd Year', 'I learned how to manage my time better and reduce my stress levels significantly. Thank you Biyani Ghar!', '2026-09-25 02:49:20', '2026-09-25 02:58:15', 1),
(10, 'Sneha Reddy', 'BCA, Final Year', 'Whenever I feel stuck, I know there is a place on campus where I will be heard. It\'s a wonderful initiative.', '2026-09-25 02:49:20', '2026-09-25 02:58:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','counsellor','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `experience` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `about`, `experience`, `image`, `qualification`, `is_active`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, 'admin', NULL, '$2y$12$YyJJT2g26KrZrmCxLI71J.rw3cztHq5z7fu3F47ZFTsmF0YAVvDL2', NULL, '2026-09-24 23:44:29', '2026-09-24 23:44:29', NULL, NULL, NULL, NULL, 1),
(2, 'Dr. John Doe', 'counsellor1@example.com', NULL, 'counsellor', NULL, '$2y$12$uVEl6aIrl00nLFaGotTCdem.WKDtrM6GPP4J.uhxbD1eQomXFRC2G', NULL, '2026-09-24 23:44:29', '2026-09-25 23:28:58', 'AAAA', '1-3 years', '1790323448.jpg', NULL, 1),
(3, 'Dr. Jane Smith', 'counsellor2@example.com', NULL, 'counsellor', NULL, '$2y$12$WZ/Hg/earkjsnpdZs5or9ud00B934blruBvFEakDxIx3YBT05faCC', NULL, '2026-09-24 23:44:29', '2026-09-24 23:44:29', NULL, NULL, NULL, NULL, 1),
(4, 'Dr. Alice Johnson', 'counsellor3@example.com', NULL, 'counsellor', NULL, '$2y$12$/qm6g0tbG/AXkI0SEaogXesIKVhWGWezmgilThlbRXg7OWUT4n73q', NULL, '2026-09-24 23:44:30', '2026-09-24 23:44:30', NULL, NULL, NULL, NULL, 1),
(5, 'Dr. Bob Brown', 'counsellor4@example.com', NULL, 'counsellor', NULL, '$2y$12$LKEPLgiai./lLdvNyGc7nusdkpqjwvBwNzDvc3WCnazGol99bvxGK', NULL, '2026-09-24 23:44:30', '2026-09-24 23:44:30', NULL, NULL, NULL, NULL, 1),
(6, 'Dr. Charlie Davis', 'counsellor5@example.com', NULL, 'counsellor', NULL, '$2y$12$iky7b7yTwXB/xxSGFWGo0upoqRHmTA0pGFoGl1m3rxuzHtwxA0/Rq', NULL, '2026-09-24 23:44:30', '2026-09-24 23:44:30', NULL, NULL, NULL, NULL, 1),
(7, 'AAA', NULL, '9785487576', 'user', NULL, NULL, NULL, '2026-09-25 00:04:13', '2026-09-26 02:04:12', NULL, NULL, NULL, NULL, 1),
(8, 'Pankaj Gupta', NULL, '555555555555555', 'user', NULL, NULL, NULL, '2026-09-25 01:10:46', '2026-09-25 01:11:21', NULL, NULL, NULL, NULL, 1),
(9, 'User 7575', NULL, '757575757575', 'user', NULL, NULL, NULL, '2026-09-25 02:07:23', '2026-09-25 02:07:23', NULL, NULL, NULL, NULL, 1),
(10, 'Pankaj', NULL, '6666666666', 'user', NULL, NULL, NULL, '2026-09-25 02:11:09', '2026-09-25 02:11:38', NULL, NULL, NULL, NULL, 1),
(11, 'AAA', NULL, '1111111111', 'user', NULL, NULL, NULL, '2026-09-25 02:36:46', '2026-09-25 02:37:52', NULL, NULL, NULL, NULL, 1),
(12, 'AA', 'counsellor1a@example.com', NULL, 'counsellor', NULL, '$2y$12$PuJDiiMx2Bvpbdi036YOb.SiM.Uhxaf/1ZH7FvyDtpaLCk9mA8Fm6', NULL, '2026-09-25 03:09:09', '2026-09-30 02:22:51', 'BB', NULL, '1790398942.jpg', NULL, 1),
(13, 'AA', 'admins@example.com', NULL, 'counsellor', NULL, '$2y$12$IfbF1FZ.xQ/si.WKipKJJ.bmpW/myejcpSXrWyWLbERTkaYDbfLEy', NULL, '2026-09-25 03:24:16', '2026-09-25 03:24:16', 'AAAAA', NULL, '1790326455.jpg', NULL, 1),
(14, 'AAAA', 'aaa@example.com', NULL, 'counsellor', NULL, '$2y$12$1FeUncXNeA9iceXRB1nyJ.Xbx2yeXOn5RYGfk0oM88ItdtHhltGom', NULL, '2026-09-26 00:05:10', '2026-09-26 00:05:10', 'AAA', '2+', '1790400909.jpg', 'AAA', 1),
(15, 'oooooooooo', NULL, '9999999999', 'user', NULL, NULL, NULL, '2026-09-26 00:32:56', '2026-09-26 00:40:48', NULL, NULL, NULL, NULL, 1),
(16, 'User 7890', NULL, '1234567890', 'user', NULL, NULL, NULL, '2026-09-30 01:25:36', '2026-09-30 01:25:36', NULL, NULL, NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
