-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2025 at 09:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemax-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'top',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner 1', NULL, 'top', 'active', '2025-07-30 08:48:40', '2025-07-30 08:48:40'),
(2, 'Banner 2', NULL, 'top', 'active', '2025-07-30 08:48:40', '2025-07-30 08:48:40'),
(3, 'Banner 3', NULL, 'top', 'active', '2025-07-30 08:48:40', '2025-07-30 08:48:40'),
(4, 'Banner 4', NULL, 'top', 'active', '2025-07-30 08:48:40', '2025-07-30 08:48:40'),
(5, 'Banner 5', NULL, 'top', 'active', '2025-07-30 08:48:40', '2025-07-30 08:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showtime_id` bigint UNSIGNED NOT NULL,
  `booking_time` datetime NOT NULL,
  `total_price` int UNSIGNED NOT NULL DEFAULT '0',
  `payment_status` enum('pending','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `order_code`, `showtime_id`, `booking_time`, `total_price`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'CINEMAX2E40BICH', 1, '2025-07-30 15:52:30', 100000, 'pending', '2025-07-30 08:52:30', '2025-07-30 08:52:30'),
(2, 2, 'CINEMAXCSRZGUNQ', 1, '2025-07-30 15:56:40', 50000, 'pending', '2025-07-30 08:56:40', '2025-07-30 08:56:40'),
(3, 2, 'CINEMAX2Z8BPGV4', 1, '2025-07-30 15:58:18', 50000, 'pending', '2025-07-30 08:58:18', '2025-07-30 08:58:18'),
(4, 2, 'CINEMAXBUJEYST5', 1, '2025-07-30 16:01:01', 50000, 'pending', '2025-07-30 09:01:01', '2025-07-30 09:01:01'),
(5, 2, 'CINEMAXWH8SJMVN', 1, '2025-07-30 16:01:26', 50000, 'pending', '2025-07-30 09:01:26', '2025-07-30 09:01:26'),
(6, 2, 'CINEMAX3PWCBL9W', 1, '2025-07-30 16:01:46', 100000, 'pending', '2025-07-30 09:01:46', '2025-07-30 09:01:46'),
(7, 2, 'CINEMAXWJHJZP8P', 1, '2025-07-30 16:09:58', 100000, 'pending', '2025-07-30 09:09:58', '2025-07-30 09:09:58'),
(8, 2, 'CINEMAXSVHHG7LJ', 1, '2025-07-30 16:10:59', 100000, 'pending', '2025-07-30 09:10:59', '2025-07-30 09:10:59'),
(9, 2, 'CINEMAXSD5CZ5SJ', 1, '2025-07-30 16:13:24', 100000, 'pending', '2025-07-30 09:13:24', '2025-07-30 09:13:24'),
(10, 2, 'CINEMAXFO2VLYRL', 3, '2025-07-30 16:14:09', 100000, 'pending', '2025-07-30 09:14:09', '2025-07-30 09:14:09'),
(11, 2, 'CINEMAXNQVIIJVO', 2, '2025-07-30 16:15:56', 100000, 'paid', '2025-07-30 09:15:56', '2025-07-30 09:15:56'),
(12, 3, 'CINEMAXNPYO0RT6', 1, '2025-07-30 16:22:17', 50000, 'paid', '2025-07-30 09:22:17', '2025-07-30 09:22:17'),
(13, 4, 'CINEMAXKCCI8TFL', 2, '2025-07-30 20:46:44', 50000, 'pending', '2025-07-30 13:46:44', '2025-07-30 13:46:44'),
(14, 4, 'CINEMAX7GTITGIO', 1, '2025-07-30 20:50:59', 100000, 'paid', '2025-07-30 13:50:59', '2025-07-30 13:50:59'),
(15, 2, 'CINEMAX9VIGAFOB', 1, '2025-07-31 09:17:23', 350000, 'paid', '2025-07-31 02:17:23', '2025-07-31 02:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `booking_seats`
--

CREATE TABLE `booking_seats` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `seat_id` bigint UNSIGNED NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_seats`
--

INSERT INTO `booking_seats` (`id`, `booking_id`, `seat_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50000, '2025-07-30 08:52:30', '2025-07-30 08:52:30'),
(2, 1, 2, 50000, '2025-07-30 08:52:30', '2025-07-30 08:52:30'),
(3, 2, 1, 50000, '2025-07-30 08:56:40', '2025-07-30 08:56:40'),
(4, 3, 1, 50000, '2025-07-30 08:58:18', '2025-07-30 08:58:18'),
(5, 4, 3, 50000, '2025-07-30 09:01:01', '2025-07-30 09:01:01'),
(6, 5, 4, 50000, '2025-07-30 09:01:26', '2025-07-30 09:01:26'),
(7, 6, 4, 50000, '2025-07-30 09:01:46', '2025-07-30 09:01:46'),
(8, 6, 5, 50000, '2025-07-30 09:01:46', '2025-07-30 09:01:46'),
(9, 7, 1, 50000, '2025-07-30 09:09:58', '2025-07-30 09:09:58'),
(10, 7, 2, 50000, '2025-07-30 09:09:58', '2025-07-30 09:09:58'),
(11, 8, 1, 50000, '2025-07-30 09:10:59', '2025-07-30 09:10:59'),
(12, 8, 2, 50000, '2025-07-30 09:10:59', '2025-07-30 09:10:59'),
(13, 9, 4, 50000, '2025-07-30 09:13:24', '2025-07-30 09:13:24'),
(14, 9, 5, 50000, '2025-07-30 09:13:24', '2025-07-30 09:13:24'),
(15, 10, 6, 50000, '2025-07-30 09:14:09', '2025-07-30 09:14:09'),
(16, 10, 7, 50000, '2025-07-30 09:14:09', '2025-07-30 09:14:09'),
(17, 11, 1, 50000, '2025-07-30 09:15:56', '2025-07-30 09:15:56'),
(18, 11, 2, 50000, '2025-07-30 09:15:56', '2025-07-30 09:15:56'),
(19, 12, 1, 50000, '2025-07-30 09:22:17', '2025-07-30 09:22:17'),
(20, 13, 3, 50000, '2025-07-30 13:46:44', '2025-07-30 13:46:44'),
(21, 14, 2, 50000, '2025-07-30 13:50:59', '2025-07-30 13:50:59'),
(22, 14, 10, 50000, '2025-07-30 13:50:59', '2025-07-30 13:50:59'),
(23, 15, 3, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(24, 15, 4, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(25, 15, 5, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(26, 15, 6, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(27, 15, 7, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(28, 15, 8, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23'),
(29, 15, 9, 50000, '2025-07-31 02:17:23', '2025-07-31 02:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"d207ef6d-83c9-4697-b5fd-cff730b07408\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:1;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 15:55:30.658951\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753865550,\"delay\":180}', 0, NULL, 1753865730, 1753865550),
(2, 'default', '{\"uuid\":\"202b5a9f-5464-41de-9fdb-9bb452b24159\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:2;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 15:59:40.052423\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753865800,\"delay\":180}', 0, NULL, 1753865980, 1753865800),
(3, 'default', '{\"uuid\":\"5408254c-1601-4a1e-8adf-850c7dfd1aaa\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:3;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 16:01:18.298303\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753865898,\"delay\":180}', 0, NULL, 1753866078, 1753865898),
(4, 'default', '{\"uuid\":\"a57400bc-e040-4f25-9825-54a52f37b1e8\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:4;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 16:04:01.235793\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753866061,\"delay\":180}', 0, NULL, 1753866241, 1753866061),
(5, 'default', '{\"uuid\":\"ddb51c51-ea1a-4018-8d07-b5eacbf4802c\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:5;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 16:04:26.766228\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753866086,\"delay\":180}', 0, NULL, 1753866266, 1753866086),
(6, 'default', '{\"uuid\":\"f3c7e7c6-c85b-4db5-b1da-f875c255a5d6\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:6;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 16:04:46.636600\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753866106,\"delay\":180}', 0, NULL, 1753866286, 1753866106),
(7, 'default', '{\"uuid\":\"2ec9ac50-521a-45e3-b05c-86ef87b833a2\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:12;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 16:25:17.385006\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753867337,\"delay\":180}', 0, NULL, 1753867517, 1753867337),
(8, 'default', '{\"uuid\":\"fe6bfaf9-4102-4e60-8ae7-e6debad91c61\",\"displayName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\CancelPendingBooking\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\CancelPendingBooking\\\":2:{s:12:\\\"\\u0000*\\u0000bookingId\\\";i:13;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2025-07-30 20:49:44.646965\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}}\"},\"createdAt\":1753883205,\"delay\":178}', 0, NULL, 1753883384, 1753883206);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_14_090802_create_rooms_table', 1),
(5, '2025_07_14_090845_create_movies_table', 1),
(6, '2025_07_14_090859_create_showtimes_table', 1),
(7, '2025_07_14_090914_create_seat_types_table', 1),
(8, '2025_07_14_090915_create_seats_table', 1),
(9, '2025_07_14_090930_create_banners_table', 1),
(10, '2025_07_19_141833_create_bookings_table', 1),
(11, '2025_07_19_141914_create_booking_seats_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image`, `duration`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'được ăn cả ngã về không', 'được ăn cả ngã về không', 'uploads/movies/sq0dOedvhEUWrnG6CmsGnMONvSk4yPTk21JrwjLD.jpg', 129, 'active', '2025-07-30 08:49:55', '2025-07-30 08:49:55', NULL);

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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `capacity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 1', 50, NULL, '2025-07-30 08:49:00', '2025-07-30 08:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `seat_type_id` bigint UNSIGNED DEFAULT NULL,
  `row` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_x` int UNSIGNED NOT NULL,
  `position_y` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `room_id`, `seat_type_id`, `row`, `position_x`, `position_y`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'A', 1, 1, 'A1', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(2, 1, 1, 'A', 2, 1, 'A2', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(3, 1, 1, 'A', 3, 1, 'A3', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(4, 1, 1, 'A', 4, 1, 'A4', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(5, 1, 1, 'A', 5, 1, 'A5', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(6, 1, 1, 'A', 6, 1, 'A6', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(7, 1, 1, 'A', 7, 1, 'A7', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(8, 1, 1, 'A', 8, 1, 'A8', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(9, 1, 1, 'A', 9, 1, 'A9', '2025-07-30 08:49:28', '2025-07-30 08:49:28'),
(10, 1, 1, 'A', 10, 1, 'A10', '2025-07-30 08:49:28', '2025-07-30 08:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `seat_types`
--

CREATE TABLE `seat_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seat_types`
--

INSERT INTO `seat_types` (`id`, `name`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ghế Thường', 50000, '2025-07-30 08:49:19', '2025-07-30 08:49:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `show_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `movie_id`, `room_id`, `show_date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-08-01', '01:00:00', '03:09:00', '2025-07-30 08:50:24', '2025-07-30 08:50:24'),
(2, 1, 1, '2025-08-01', '03:20:00', '05:29:00', '2025-07-30 08:51:01', '2025-07-30 08:51:01'),
(3, 1, 1, '2025-08-01', '17:30:00', '19:39:00', '2025-07-30 08:51:23', '2025-07-30 08:51:23'),
(4, 1, 1, '2025-08-01', '19:47:00', '21:56:00', '2025-07-30 08:52:03', '2025-07-30 08:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2025-07-30 08:48:40', '$2y$12$fZLn/V96PuasdyxCGSXsgOjc.sHJ1dJxlLjeJJZlbUhvW8zhXT.9q', 'admin', 'CSsvuvdP64', '2025-07-30 08:48:41', '2025-07-30 08:48:41'),
(2, 'trần nhật ninh', 'tnnpalk@gmail.com', NULL, '$2y$12$j5FmfL8phYnYMn9CyPephe.L0YkrQN/qVM1VDw7KYIosZ/6n95Gfu', 'user', NULL, '2025-07-30 08:52:24', '2025-07-30 08:52:24'),
(3, 'ninh', 'ninh@gmail.com', NULL, '$2y$12$tEq/heyWh2RIYic3p1vz2eFQrCpZSBWIRAMaTUTGYYQqMeQxFAXQe', 'user', NULL, '2025-07-30 09:22:08', '2025-07-30 09:22:08'),
(4, 'ninh123', 'ninh12321@gmail.com', NULL, '$2y$12$PGoT95oa0Wv93/voE1pjxenzeaSz28iMv0lGDkvjbTueKD7c2iVpu', 'user', NULL, '2025-07-30 13:46:38', '2025-07-30 13:46:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_order_code_unique` (`order_code`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_showtime_id_foreign` (`showtime_id`);

--
-- Indexes for table `booking_seats`
--
ALTER TABLE `booking_seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_seats_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_seats_seat_id_foreign` (`seat_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_room_id_foreign` (`room_id`),
  ADD KEY `seats_seat_type_id_foreign` (`seat_type_id`);

--
-- Indexes for table `seat_types`
--
ALTER TABLE `seat_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `showtimes_movie_id_foreign` (`movie_id`),
  ADD KEY `showtimes_room_id_foreign` (`room_id`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `booking_seats`
--
ALTER TABLE `booking_seats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seat_types`
--
ALTER TABLE `seat_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_showtime_id_foreign` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_seats`
--
ALTER TABLE `booking_seats`
  ADD CONSTRAINT `booking_seats_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_seats_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seats_seat_type_id_foreign` FOREIGN KEY (`seat_type_id`) REFERENCES `seat_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
