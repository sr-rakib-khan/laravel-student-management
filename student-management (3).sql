-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2024 at 01:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `session`, `batch_name`, `monthly_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2024', '6/2024', '1000', '1', '2024-09-10 10:03:38', '2024-09-10 21:47:13'),
(3, '2', '2024', '7/2024', '1000', '1', '2024-10-11 09:06:15', '2024-10-11 09:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `batchfees`
--

CREATE TABLE `batchfees` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feehead_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batchfees`
--

INSERT INTO `batchfees` (`id`, `course_id`, `feehead_id`, `fee_name`, `fee_amount`, `created_at`, `updated_at`) VALUES
(1, '1', '13', 'Addmission Fee for admit new class', '2000', '2024-09-13 08:00:19', '2024-09-13 09:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Class-6 Mathematics', '1', '2024-09-08 21:58:55', '2024-09-08 21:58:55'),
(2, 'Class-7 Mathematics', '1', '2024-09-08 22:01:19', '2024-09-08 22:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `expensecategory_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expensecategory_id`, `title`, `comment`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(2, 1, 'fuel', 'this is fuel cost', '500', '17-10-24', '2024-10-17 08:55:30', '2024-10-17 08:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fuel', 1, '2024-10-16 00:35:41', '2024-10-16 04:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feeheads`
--

CREATE TABLE `feeheads` (
  `id` bigint UNSIGNED NOT NULL,
  `feehead_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feeheads`
--

INSERT INTO `feeheads` (`id`, `feehead_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'January', '1', '2024-09-10 23:25:38', '2024-09-10 23:25:38'),
(2, 'February', '1', '2024-09-10 23:25:58', '2024-09-10 23:25:58'),
(3, 'March', '1', '2024-09-10 23:26:22', '2024-09-10 23:26:22'),
(4, 'April', '1', '2024-09-10 23:26:33', '2024-09-10 23:26:33'),
(5, 'May', '1', '2024-09-10 23:26:43', '2024-09-10 23:26:43'),
(6, 'June', '1', '2024-09-10 23:26:51', '2024-09-10 23:26:51'),
(7, 'Jully', '1', '2024-09-10 23:27:21', '2024-09-10 23:27:21'),
(8, 'August', '1', '2024-09-10 23:27:35', '2024-09-10 23:27:35'),
(9, 'September', '1', '2024-09-10 23:27:45', '2024-09-10 23:27:45'),
(10, 'October', '1', '2024-09-10 23:27:56', '2024-09-10 23:27:56'),
(11, 'November', '1', '2024-09-10 23:28:09', '2024-09-10 23:28:09'),
(12, 'December', '1', '2024-09-10 23:28:21', '2024-09-10 23:28:21'),
(13, 'Addmission', '1', '2024-09-10 23:28:34', '2024-09-10 23:28:34'),
(14, 'Others', '1', '2024-09-10 23:28:42', '2024-09-10 23:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `fees_months`
--

CREATE TABLE `fees_months` (
  `id` bigint UNSIGNED NOT NULL,
  `fees_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees_months`
--

INSERT INTO `fees_months` (`id`, `fees_month`, `created_at`, `updated_at`) VALUES
(3, 'January-2024', NULL, NULL),
(4, 'February-2024', NULL, NULL),
(5, 'March-2024', NULL, NULL),
(6, 'April-2024', NULL, NULL),
(7, 'May-2024', NULL, NULL),
(8, 'June-2024', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fess`
--

CREATE TABLE `fess` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `feehead_id` int NOT NULL,
  `fees_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tusion_fee` decimal(10,2) NOT NULL,
  `monthly_discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_afterdiscount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `common_fee` decimal(8,2) NOT NULL,
  `extra_discount` decimal(8,2) NOT NULL,
  `due` decimal(8,2) NOT NULL,
  `payment` decimal(8,2) NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fee_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fees_collect_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fess`
--

INSERT INTO `fess` (`id`, `student_id`, `feehead_id`, `fees_month`, `tusion_fee`, `monthly_discount`, `fee_afterdiscount`, `net_fee`, `common_fee`, `extra_discount`, `due`, `payment`, `summary`, `created_at`, `updated_at`, `fee_details`, `year`, `fees_collect_date`) VALUES
(15, 38, 0, 'Addmission', 0.00, '0', '0', '2000', 2000.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, 'Admission fee', '2024', NULL),
(16, 38, 0, 'January-2024', 1000.00, '100', '900', '2900', 0.00, 0.00, 0.00, 2900.00, NULL, '2024-11-07 18:00:00', NULL, 'january tusion fee', '2024', '2024-11-08'),
(17, 38, 0, 'February-2024', 1000.00, '100', '900', '900', 0.00, 0.00, 0.00, 900.00, NULL, '2024-11-07 18:00:00', NULL, 'february tusion fee', '2024', NULL),
(18, 38, 0, 'March-2024', 1000.00, '100', '900', '900', 0.00, 0.00, 0.00, 0.00, NULL, '2024-11-07 18:00:00', NULL, 'march tusion fee', '2024', NULL),
(19, 38, 0, 'April-2024', 1000.00, '100', '900', '1800', 0.00, 0.00, 900.00, 1800.00, NULL, '2024-11-07 18:00:00', NULL, 'april tusion fee', '2024', NULL),
(20, 38, 0, 'May-2024', 1000.00, '100', '900', '900', 0.00, 0.00, 0.00, 900.00, '0', '2024-11-07 18:00:00', NULL, 'may tusion fee', '2024', '2024-11-08'),
(21, 38, 0, 'June-2024', 1000.00, '100', '900', '900', 0.00, 200.00, 0.00, 900.00, '0', '2024-11-07 18:00:00', NULL, 'june tusion fee', '2024', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_08_055525_create_courses_table', 1),
(6, '2024_09_08_193449_create_sections_table', 2),
(7, '2024_09_10_021400_create_batches_table', 3),
(8, '2024_09_10_164824_create_feeheads_table', 4),
(9, '2024_09_13_014825_create_batchfees_table', 5),
(10, '2024_09_13_045835_create_studentmanages_table', 6),
(11, '2024_09_18_022804_create_students_table', 7),
(12, '2024_09_18_165759_create_sms_table', 8),
(13, '2024_09_19_040725_create_smstemplates_table', 9),
(14, '2024_09_28_144813_add_coloumn_to_sms_table', 10),
(15, '2024_10_15_131921_add_coloumn_tusion_fee_to_students_table', 11),
(16, '2024_10_15_143745_create_fess_table', 12),
(17, '2024_10_15_143911_create_fees_months_table', 12),
(18, '2024_10_15_161225_add_coloumn_fee_details_fess_table', 13),
(19, '2024_10_16_060954_create_expense_categories_table', 14),
(20, '2024_10_16_143026_create_expenses_table', 15),
(21, '2024_10_30_041511_create_student_dues_table', 16),
(22, '2024_10_30_081149_add_columns_fess', 17),
(23, '2024_10_31_041652_add_column_fess', 18),
(24, '2024_11_05_151100_add_coloumns_fees', 19),
(25, '2024_11_08_143821_add_column_fess_table', 20),
(26, '2024_11_11_155833_add_columns_users_table', 21),
(27, '2024_11_11_172009_change_users_table', 22),
(28, '2024_11_11_172730_remove_unique_from_email_on_users_table', 23),
(29, '2024_11_18_144046_create_smslogs_table', 24),
(30, '2024_11_27_152223_add_collect_date_to_fess_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `section_name`, `schedule_day`, `schedule_time`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'boys-1', 'sat, sun, mon', '9 Am', '1', '2024-09-09 22:50:10', '2024-09-09 22:50:10'),
(5, 2, 'boys-2', 'sat, sun, mon', '3 pm', '1', '2024-09-09 23:28:31', '2024-09-10 00:19:54'),
(6, 1, 'girls -1', 'sat, sun, mon', '3 pm', '1', '2024-11-13 08:45:23', '2024-11-13 08:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` bigint UNSIGNED NOT NULL,
  `sms_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `helpline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `sms_key`, `sms_url`, `helpline`, `sender_id`, `footer_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'oLyAySR9ZjAp2fNzbZMI', 'http://bulksmsbd.net/api/smsapi', '57547272', '8809617620375', '\"Powered by Bouer Doya IT\"', '1', NULL, '2024-09-28 09:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `smslogs`
--

CREATE TABLE `smslogs` (
  `id` bigint UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smslogs`
--

INSERT INTO `smslogs` (`id`, `message`, `recipient`, `created_at`, `updated_at`) VALUES
(1, 'gfdkgjdfslgjkldfs', '01749436376', '2024-11-18 09:13:13', '2024-11-18 09:13:13'),
(4, 'no data get from server', '01749436376', '2024-11-18 21:15:49', '2024-11-18 21:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `smstemplates`
--

CREATE TABLE `smstemplates` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smstemplates`
--

INSERT INTO `smstemplates` (`id`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Admission Success', 'Welcome {name} your Admission Successful. Course {course_info} Student ID: {id} Login your profile for Details {login_url} Helpline: {helpline_number}', '2024-09-19 10:13:19', '2024-09-19 10:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `studentmanages`
--

CREATE TABLE `studentmanages` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `batch_id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tusion_fees` decimal(8,2) NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admission_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `course_id`, `section_id`, `batch_id`, `student_id`, `tusion_fees`, `discount`, `note`, `institute_name`, `status`, `photo`, `student_name`, `date_of_birth`, `gender`, `religion`, `sms_mobile`, `father_name`, `mother_name`, `guardian_mobile`, `address`, `sms`, `admission_date`, `created_at`, `updated_at`) VALUES
(38, 1, 2, 1, '00001', 1000.00, '100', NULL, NULL, '1', 'assets/students/672d8c81d8f93.png', 'Rahim', '2024-11-08', 'Male', 'Muslim', '01749436376', 'lorem ipsum', 'lorem ipsum', '32154687', NULL, '0', '08-11-24', '2024-11-07 21:58:58', '2024-11-20 07:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `student_dues`
--

CREATE TABLE `student_dues` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `due_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_dues`
--

INSERT INTO `student_dues` (`id`, `student_id`, `due_amount`, `created_at`, `updated_at`) VALUES
(13, 38, 200.00, '2024-11-07 21:58:58', '2024-11-07 21:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `photo`, `phone`, `user_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rakib khan', 'assets/admin/6732d335560be.jpg', '01749436376', 'rakibkhan', 'info@gmail.com', NULL, '$2y$12$HyO8C18MMPZy/MnbJussKuqmgVg4d4RRLKqdEctQCkfoLkyMm9x7a', NULL, '2024-11-11 09:02:10', '2024-11-11 22:01:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batchfees`
--
ALTER TABLE `batchfees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expensecategory_id_foreign` (`expensecategory_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feeheads`
--
ALTER TABLE `feeheads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_months`
--
ALTER TABLE `fees_months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fess`
--
ALTER TABLE `fess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fess_student_id_foreign` (`student_id`);

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
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_course_id_foreign` (`course_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smslogs`
--
ALTER TABLE `smslogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smstemplates`
--
ALTER TABLE `smstemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentmanages`
--
ALTER TABLE `studentmanages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_dues`
--
ALTER TABLE `student_dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_dues_student_id_foreign` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batchfees`
--
ALTER TABLE `batchfees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feeheads`
--
ALTER TABLE `feeheads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fees_months`
--
ALTER TABLE `fees_months`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fess`
--
ALTER TABLE `fess`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smslogs`
--
ALTER TABLE `smslogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `smstemplates`
--
ALTER TABLE `smstemplates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentmanages`
--
ALTER TABLE `studentmanages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student_dues`
--
ALTER TABLE `student_dues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expensecategory_id_foreign` FOREIGN KEY (`expensecategory_id`) REFERENCES `expense_categories` (`id`);

--
-- Constraints for table `fess`
--
ALTER TABLE `fess`
  ADD CONSTRAINT `fess_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_dues`
--
ALTER TABLE `student_dues`
  ADD CONSTRAINT `student_dues_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
