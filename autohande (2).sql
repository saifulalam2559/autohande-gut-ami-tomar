-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2026 at 11:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autohande`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_deletions`
--

CREATE TABLE `account_deletions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kundennummer` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reason` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `browser_details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_deletions`
--

INSERT INTO `account_deletions` (`id`, `user_id`, `kundennummer`, `deleted_at`, `reason`, `ip_address`, `browser_details`, `created_at`, `updated_at`) VALUES
(1, 130, '25EEK0000002', '2025-04-01 15:30:06', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 15:30:06', '2025-04-01 15:30:06'),
(2, 131, '25EEK0000002', '2025-04-01 16:36:56', 'hgfhgfhg', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 16:36:56', '2025-04-01 16:36:56'),
(3, 132, '25EEK0000006', '2025-04-01 17:27:51', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 17:27:51', '2025-04-01 17:27:51'),
(4, 133, NULL, '2025-04-01 21:12:06', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 21:12:06', '2025-04-01 21:12:06'),
(5, 134, '25EEK0000001', '2025-04-01 21:39:47', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 21:39:47', '2025-04-01 21:39:47'),
(6, 135, '25EEK0000002', '2025-04-01 21:44:55', 'no', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 21:44:55', '2025-04-01 21:44:55'),
(7, 136, NULL, '2025-04-01 22:18:22', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 22:18:22', '2025-04-01 22:18:22'),
(8, 137, NULL, '2025-04-01 22:23:00', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 22:23:00', '2025-04-01 22:23:00'),
(9, 138, NULL, '2025-04-01 22:24:28', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 22:24:28', '2025-04-01 22:24:28'),
(10, 139, '25EEK0000005', '2025-04-01 22:28:15', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 22:28:15', '2025-04-01 22:28:15'),
(11, 140, '25EEK0000006', '2025-04-02 11:27:19', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 11:27:19', '2025-04-02 11:27:19'),
(12, 141, '25EEK0000007', '2025-04-02 14:06:37', 'not good', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:06:37', '2025-04-02 14:06:37'),
(13, 141, '25EEK0000007', '2025-04-02 14:07:54', 'not good', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:07:54', '2025-04-02 14:07:54'),
(14, 141, '25EEK0000007', '2025-04-02 14:22:09', 'not good', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:22:09', '2025-04-02 14:22:09'),
(15, 141, '25EEK0000007', '2025-04-02 14:24:25', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:24:25', '2025-04-02 14:24:25'),
(16, 141, '25EEK0000007', '2025-04-02 14:35:12', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:35:12', '2025-04-02 14:35:12'),
(17, 141, '25EEK0000007', '2025-04-02 14:36:48', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 14:36:48', '2025-04-02 14:36:48'),
(18, 142, NULL, '2025-04-02 15:03:07', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 15:03:07', '2025-04-02 15:03:07'),
(19, 143, '25EEK0000010', '2025-04-02 15:15:33', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 15:15:33', '2025-04-02 15:15:33'),
(20, 144, '25EEK0000011', '2025-04-02 15:21:42', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 15:21:42', '2025-04-02 15:21:42'),
(21, 145, '25EEK0000012', '2025-04-02 15:24:34', 'gud', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 15:24:34', '2025-04-02 15:24:34'),
(22, 146, '25EEK0000013', '2025-04-02 20:17:24', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-02 20:17:24', '2025-04-02 20:17:24'),
(23, 147, '25EEK0000014', '2025-04-18 10:52:15', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-18 10:52:15', '2025-04-18 10:52:15'),
(24, 148, '25EEK0000015', '2025-04-18 11:10:30', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-18 11:10:30', '2025-04-18 11:10:30'),
(25, 149, '25EEK0000016', '2025-04-25 17:38:19', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-25 17:38:19', '2025-04-25 17:38:19'),
(26, 150, '25EEK0000017', '2025-04-25 20:27:05', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-25 20:27:05', '2025-04-25 20:27:05'),
(27, 151, '25EEK0000018', '2025-04-26 10:17:32', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-26 10:17:32', '2025-04-26 10:17:32'),
(28, 152, '25EEK0000019', '2025-04-26 11:10:16', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-26 11:10:16', '2025-04-26 11:10:16'),
(29, 153, '26EEK0000020', '2026-05-10 10:48:24', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-05-10 10:48:24', '2026-05-10 10:48:24'),
(30, 154, '26EEK0000021', '2026-05-10 15:12:47', '', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-05-10 15:12:47', '2026-05-10 15:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `autos`
--

CREATE TABLE `autos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_model_id` bigint(20) UNSIGNED NOT NULL,
  `body_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fuel_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transmission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `condition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emission_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_number` varchar(255) DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'EUR',
  `mileage` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mileage_unit` varchar(10) NOT NULL DEFAULT 'km',
  `first_registration` date DEFAULT NULL,
  `engine_cc` smallint(5) UNSIGNED DEFAULT NULL,
  `engine_size` varchar(255) DEFAULT NULL,
  `power_hp` smallint(5) UNSIGNED DEFAULT NULL,
  `power_kw` smallint(5) UNSIGNED DEFAULT NULL,
  `gears` tinyint(3) UNSIGNED DEFAULT NULL,
  `drivetrain` varchar(255) DEFAULT NULL,
  `co2_emissions` smallint(5) UNSIGNED DEFAULT NULL,
  `inspection_date` date DEFAULT NULL,
  `doors` tinyint(3) UNSIGNED DEFAULT NULL,
  `seats` tinyint(3) UNSIGNED DEFAULT NULL,
  `interior_color` varchar(255) DEFAULT NULL,
  `previous_owners` tinyint(3) UNSIGNED DEFAULT NULL,
  `accident_free` tinyint(1) DEFAULT NULL,
  `vat_deductible` tinyint(1) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('draft','published','inactive','sold') NOT NULL DEFAULT 'draft',
  `is_visible` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `sold_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autos`
--

INSERT INTO `autos` (`id`, `title`, `meta_title`, `meta_description`, `brand_id`, `vehicle_model_id`, `body_type_id`, `fuel_type_id`, `transmission_id`, `color_id`, `condition_id`, `emission_class_id`, `stock_number`, `variant`, `vin`, `price`, `currency`, `mileage`, `mileage_unit`, `first_registration`, `engine_cc`, `engine_size`, `power_hp`, `power_kw`, `gears`, `drivetrain`, `co2_emissions`, `inspection_date`, `doors`, `seats`, `interior_color`, `previous_owners`, `accident_free`, `vat_deductible`, `description`, `slug`, `status`, `is_visible`, `is_featured`, `published_at`, `sold_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Vitae est impedit fxxxxx', 'Ut qui odit quas sed voluptatem id sedxxxx', 'Reprehenderit ut dolor harum doloribus praesentium fuga Ad tenetur sit ipsum similiquexxxx', 3, 3, 3, 2, 2, 2, 3, 3, '328', 'Laboriosam id nisi', NULL, 725.00, 'Sin', 47, 'km', '2001-12-24', 70, 'Magnam quis eaque mi', 48, 24, 59, 'Voluptatem rerum ten', 39, '1987-02-24', 11, 32, 'Consequatur Cillum', 23, 0, 1, 'Aut aspernatur et de', 'vitae-est-impedit-fxxxxx-1', 'draft', 0, 1, NULL, NULL, '2026-09-06 21:22:46', '2026-09-06 22:04:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auto_feature`
--

CREATE TABLE `auto_feature` (
  `auto_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto_feature`
--

INSERT INTO `auto_feature` (`auto_id`, `feature_id`) VALUES
(2, 2),
(2, 3),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `auto_images`
--

CREATE TABLE `auto_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auto_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto_images`
--

INSERT INTO `auto_images` (`id`, `auto_id`, `image_path`, `alt_text`, `sort_order`, `is_primary`, `created_at`, `updated_at`) VALUES
(122, 2, 'a0b84cfb-4360-4d37-9779-ddba8c98bcad.jpg', 'BMW C34', 0, 1, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(123, 2, '5d29c8c7-e0f2-4470-bd65-96e49347a0f3.jpg', 'BMW C34', 1, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(124, 2, 'f3bbca74-72f0-4578-b063-fd8506ca6446.jpg', 'BMW C34', 2, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(125, 2, '78d57511-8e62-461a-a83c-09ed2d3e0cdc.jpg', 'BMW C34', 3, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(126, 2, '626c1b1b-9904-4e52-bea4-ff6934c7ce90.jpg', 'BMW C34', 4, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(127, 2, '9d8d6412-5400-4364-8676-08327bda7249.png', 'BMW C34', 5, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46'),
(128, 2, 'c2cba90d-a049-4c80-ac43-911b959377f2.webp', 'BMW C34', 6, 0, '2026-09-06 21:22:46', '2026-09-06 21:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `body_types`
--

CREATE TABLE `body_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body_types`
--

INSERT INTO `body_types` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 'Hatchback', 'hatchback', 1, 0, '2026-09-05 17:00:05', '2026-09-05 17:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'AUDI', 'audi', 1, 1, '2026-09-05 14:33:31', '2026-09-05 14:33:31'),
(3, 'BMW', 'bmw', 1, 0, '2026-09-05 15:23:52', '2026-09-05 15:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(15, 'USB Hub C', 'usb-hub-c', 'active', '2026-08-05 07:24:26', '2026-08-08 18:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `hex_code` varchar(7) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `slug`, `hex_code`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Black', 'black', '#2D2525', 1, 0, '2026-09-05 18:40:28', '2026-09-05 18:40:28'),
(3, 'Blue', 'blue', '#5D74EA', 1, 0, '2026-09-05 18:40:59', '2026-09-05 18:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `emission_classes`
--

CREATE TABLE `emission_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emission_classes`
--

INSERT INTO `emission_classes` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Euro 6', 'euro-6', 1, 0, '2026-09-05 20:14:15', '2026-09-05 20:14:15'),
(3, 'Euro 8', 'euro-8', 1, 0, '2026-09-05 20:14:29', '2026-09-05 20:14:29');

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_category_id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 2, 'Apple CarPlay', 'apple-carplay', 1, 0, '2026-09-05 21:41:31', '2026-09-05 21:41:31'),
(3, 3, 'Heated Seats', 'heated-seats', 1, 0, '2026-09-05 21:41:51', '2026-09-05 21:41:51'),
(4, 3, 'Parking', 'parking', 1, 0, '2026-09-06 21:34:28', '2026-09-06 21:34:28'),
(5, 2, 'Seats', 'seats', 1, 0, '2026-09-06 21:34:57', '2026-09-06 21:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `feature_categories`
--

CREATE TABLE `feature_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_categories`
--

INSERT INTO `feature_categories` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Safety', 'safety', 1, 0, '2026-09-05 21:31:39', '2026-09-05 21:31:39'),
(3, 'Interior', 'interior', 1, 0, '2026-09-05 21:31:50', '2026-09-05 21:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Diesel', 'diesel', 1, 0, '2026-09-05 17:48:37', '2026-09-05 17:48:37'),
(3, 'Hybrid', 'hybrid', 1, 0, '2026-09-05 17:49:03', '2026-09-05 17:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `kundennummer_sequences`
--

CREATE TABLE `kundennummer_sequences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `last_sequence` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kundennummer_sequences`
--

INSERT INTO `kundennummer_sequences` (`id`, `prefix`, `last_sequence`, `created_at`, `updated_at`) VALUES
(1, 'EEK', 22, '2025-04-01 21:35:33', '2026-05-10 15:13:57');

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
(1, '2024_08_22_230252_create_maincategories_table', 1),
(2, '2024_08_22_234755_create_sub_sub_categories_table', 2),
(6, '2024_08_31_212544_create_subsubcategories_table', 5),
(7, '2024_08_31_174612_create_colors_table', 6),
(8, '2024_09_01_112810_create_patterns_table', 7),
(9, '2024_09_01_133632_create_materials_table', 8),
(11, '2024_09_02_135414_create_dresssizes_table', 9),
(12, '2024_09_02_182544_create_socksizes_table', 10),
(13, '2024_09_02_190326_create_pantiessizes_table', 11),
(14, '2024_09_03_144547_create_images_table', 12),
(16, '2024_09_03_190731_create_productimages_table', 13),
(17, '2024_09_05_220052_create_sessions_table', 14),
(18, '2024_09_06_125750_add_two_factor_columns_to_users_table', 15),
(19, '2024_09_06_152948_add_two_factor_columns_to_users_table', 16),
(20, '2024_09_06_201022_add_two_factor_enabled_to_users_table', 17),
(22, '2024_09_08_213602_create_material_product_table', 19),
(23, '2024_08_27_202146_create_products_table', 20),
(27, '2024_09_09_101716_create_dresssize_product_table', 23),
(28, '2024_09_09_102025_create_pantiessize_product_table', 24),
(29, '2024_09_09_102201_create_sock_product_table', 25),
(30, '2024_09_09_111031_create_socksize_product_table', 26),
(32, '2024_09_09_101716_create_dresssizes_product_table', 27),
(33, '2024_09_14_201743_create_cache_table', 28),
(34, '2024_09_17_115653_create_settings_table', 29),
(35, '2024_09_18_162441_create_productattributes_table', 30),
(36, '2024_09_24_152459_create_wishlists_table', 31),
(39, '2024_09_28_152845_create_coupons_table', 32),
(51, '2014_10_12_000000_create_users_table', 33),
(55, '2024_10_11_152520_create_order_items_table', 35),
(56, '2024_10_09_194902_create_orders_table', 36),
(58, '2024_10_17_094745_create_reviews_table', 37),
(59, '2024_10_19_132529_add_verification_fields_to_users_table', 38),
(64, '2024_10_27_122301_create_returntables_table', 39),
(65, '2024_11_29_220439_create_tax_rates_table', 40),
(66, '2024_11_30_001119_add_tax_rate_to_orders_table', 41),
(67, '2024_12_09_210951_create_banners_table', 42),
(68, '2024_12_10_152622_create_magazinkategories_table', 43),
(69, '2024_12_10_152631_create_magazinposts_table', 44),
(70, '2024_12_14_203415_create_newssubscriptions_table', 45),
(71, '2024_12_14_204838_create_subscriptions_table', 46),
(72, '2024_12_18_201758_add_field_name_to_products', 47),
(73, '2024_12_21_195843_add_field_name_to_orders', 48),
(74, '2024_12_21_211307_add_product_title_and_number_to_order_items_table', 49),
(75, '2025_02_02_194510_add_dimensions_to_orders_table', 50),
(76, '2025_02_04_151411_add_shipment_fields_to_orders_table', 51),
(77, '2025_02_11_230951_add_dates_to_returntables', 52),
(81, '2025_04_01_162959_create_account_deletions_table', 53),
(82, '2025_04_01_232917_create_kundennummer_sequences_table', 54),
(84, '2025_04_07_201753_create_support_ticket_messages_table', 56),
(85, '2025_04_08_190812_create_support_replies_table', 57),
(86, '2025_04_07_201752_create_support_tickets_table', 58),
(87, '2025_04_10_102103_create_tickets_table', 59),
(88, '2025_04_10_160124_create_replays_table', 60),
(89, '2025_04_11_231318_add_read_flags_to_replays_table', 61),
(91, '2025_04_20_210729_create_notice_boards_table', 62),
(92, '2025_04_29_115039_create_brands_table', 63),
(93, '2025_04_29_121814_add_brand_id_to_products_table', 64),
(94, '2025_05_03_161936_create_labelsettings_table', 65),
(96, '2026_08_04_220007_create_categories_table', 66),
(99, '2026_08_05_190240_create_stocks_table', 68),
(101, '2026_08_04_113044_create_products_table', 70),
(105, '2026_08_07_002516_create_product_artikelnrs_table', 71),
(106, '2026_08_05_202220_create_stock_movements_table', 72),
(107, '2026_08_08_145616_create_picking_lists_table', 73),
(108, '2026_08_09_100505_create_user_manuals_table', 74),
(109, '2026_08_09_200311_add_image_path_to_products_table', 75),
(110, '2026_09_02_220437_create_settings_table', 76),
(111, '2026_09_02_220436_create_auto_images_table', 77),
(113, '2026_09_02_220434_create_emission_classes_table', 79),
(114, '2026_09_02_220433_create_vehicle_conditions_table', 80),
(115, '2026_09_02_220432_create_colors_table', 81),
(116, '2026_09_02_220431_create_transmissions_table', 82),
(117, '2026_09_02_220430_create_fuel_types_table', 83),
(118, '2026_09_02_220429_create_body_types_table', 84),
(119, '2026_09_02_220427_create_brands_table', 85),
(121, '2026_09_02_225909_create_auto_feature_table', 87),
(122, '2026_09_05_225742_create_feature_categories_table', 88),
(123, '2026_09_02_220435_create_features_table', 89),
(126, '2026_09_02_220324_create_autos_table', 90);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$JXk9zXj3IGAI1Zlkm7LIpuUqyj5/YVzR2a1BSQTteL5GfMCSpc.CW', '2026-05-10 10:29:14'),
('alametc@aol.com', '$2y$12$rimHbAX3aMd0PzFfcwV5o.NfpFjhG4N2EaavhOSEdmOdQPCSe542K', '2026-05-10 10:20:46'),
('kyjida@mailinator.com', '$2y$12$FaMPzUma5xD08Szr1TLlauWCrMB9ZVfo1XnQsnUD5CandX..LH6OS', '2024-10-19 17:40:55'),
('nejeziz@mailinator.com', '$2y$12$JKBfpbzcUUUvdXXEXkLjDOm09..oMbwMwUGU3DO/rWNw2yMwuuUTm', '2024-10-19 23:23:13'),
('seller@gmail.com', '$2y$12$4EBN9wZJjV1Nwgu5nGzd/uZGwHqHEDyM5esFVprn.W6w0Bcmwe/FW', '2024-10-18 21:59:29');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kUqXfZlQqrmMLrbyop8mEmbzsTE0x6INuY8D5dnk', 28, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ0FJbzB0VXg1SVFXS1FiNDU5cThMS0VMSGl6ZGxKRWIwVnc0dVZLeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI4O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4ODc3MzQ5Mzt9fQ==', 1788773494),
('Yd66Us8d5j94JWI17l6OZ49kcVUWdNYStspfAfEn', 28, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYkt4d0ZMZzNlZFBYZTl0WVNXV0NVY0ZKQWpPdzJ3U1NySUNoMlo2eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI4O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4ODY4MDU3Mzt9fQ==', 1788741371);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'string',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transmissions`
--

CREATE TABLE `transmissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transmissions`
--

INSERT INTO `transmissions` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Manual', 'manual', 1, 4, '2026-09-05 18:20:12', '2026-09-05 18:21:57'),
(2, 'Automatic', 'automatic', 1, 0, '2026-09-05 18:20:20', '2026-09-05 18:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('admin','seller','customer') NOT NULL DEFAULT 'seller',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `two_factor_code` varchar(255) DEFAULT NULL,
  `two_factor_expires_at` datetime DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `admin_note` longtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `photo`, `role`, `status`, `two_factor_code`, `two_factor_expires_at`, `two_factor_enabled`, `remember_token`, `created_at`, `updated_at`, `verification_code`, `expires_at`, `email_verified_at`, `admin_note`, `phone`) VALUES
(28, 'ASaiful', 'Alam', 'admin@gmail.com', '$2y$12$J1VEDyTMnv8CCzxOOed2De1j/Cc7GiioCM9mVJvcmw0OF.Cb4UO0u', '1744982899.jpg', 'admin', 'active', NULL, NULL, 0, NULL, '2024-10-11 20:50:40', '2025-04-18 11:28:19', NULL, NULL, '2024-10-17 22:04:22', NULL, NULL),
(29, 'Seller Saiful', 'Seller Alam', 'seller@gmail.com', '$2y$12$2smANiE1eGniJjZKZsV95u.Wn3uKbQJbTBJ78xYZsR/oswsAwx18K', '1786110703.jpg', 'seller', 'active', NULL, NULL, 0, NULL, '2024-10-11 20:50:40', '2026-09-01 13:50:18', NULL, NULL, '2024-10-17 22:04:22', NULL, NULL),
(30, 'Saiful', 'Alam', 'alametc@aol.com', '$2y$12$SyCT5PA7I5RDxLlfXYWheeVQ8Is29Mf11MRXtI40aM4fLSrxdZRx2', '1743203732.jpg', 'customer', 'inactive', NULL, NULL, 0, 'OjR5cnqnHjcCNskTuu6edfT2whWhdwPmPyFNTjIxEywmwGOQeob1x5yeAXSV', '2024-10-11 20:50:40', '2026-08-07 10:59:30', NULL, NULL, '2024-10-17 22:04:22', '2 time Returned', NULL),
(155, 'John', 'Dlo', 'saifulalam0451@gmail.com', '$2y$12$Mp3eQLWr83OEjxPvJA.fEuWxNZku5UvfAM8/YHZr4DTyHt1LjfkDW', '1786110539.jpg', 'customer', 'active', NULL, NULL, 0, 'I9ZTh5ZaKg8I79NTi3Ylf4gahyyw9Ezw0dGGsgWAd9O6jFkQWLk2X0jOGh8D', '2026-05-10 15:13:57', '2026-09-01 13:38:37', NULL, NULL, '2026-05-10 15:14:20', NULL, 'ZHgrdTJ4MXcwSjI2T3paTitKSnpBUT09OjrRcT16A9xLifaTkSNzJTwK');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_conditions`
--

CREATE TABLE `vehicle_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_conditions`
--

INSERT INTO `vehicle_conditions` (`id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'New', 'new', 1, 0, '2026-09-05 18:57:26', '2026-09-05 18:57:26'),
(3, 'Demonstrationdfdf', 'demonstration', 1, 0, '2026-09-05 18:57:51', '2026-09-05 18:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `brand_id`, `name`, `slug`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 2, 'C-Class', 'c-class', 1, 0, '2026-09-05 16:12:05', '2026-09-05 16:12:05'),
(3, 3, 'C34', 'c34', 1, 0, '2026-09-05 16:12:46', '2026-09-05 16:12:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_deletions`
--
ALTER TABLE `account_deletions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autos_slug_unique` (`slug`),
  ADD UNIQUE KEY `autos_stock_number_unique` (`stock_number`),
  ADD UNIQUE KEY `autos_vin_unique` (`vin`),
  ADD KEY `autos_brand_id_index` (`brand_id`),
  ADD KEY `autos_vehicle_model_id_index` (`vehicle_model_id`),
  ADD KEY `autos_body_type_id_index` (`body_type_id`),
  ADD KEY `autos_fuel_type_id_index` (`fuel_type_id`),
  ADD KEY `autos_transmission_id_index` (`transmission_id`),
  ADD KEY `autos_color_id_index` (`color_id`),
  ADD KEY `autos_condition_id_index` (`condition_id`),
  ADD KEY `autos_emission_class_id_index` (`emission_class_id`),
  ADD KEY `autos_price_index` (`price`),
  ADD KEY `autos_mileage_index` (`mileage`),
  ADD KEY `autos_first_registration_index` (`first_registration`),
  ADD KEY `autos_status_index` (`status`),
  ADD KEY `autos_is_visible_index` (`is_visible`),
  ADD KEY `autos_is_featured_index` (`is_featured`),
  ADD KEY `autos_status_is_visible_index` (`status`,`is_visible`),
  ADD KEY `autos_status_is_featured_index` (`status`,`is_featured`);

--
-- Indexes for table `auto_feature`
--
ALTER TABLE `auto_feature`
  ADD PRIMARY KEY (`auto_id`,`feature_id`),
  ADD KEY `auto_feature_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `auto_images`
--
ALTER TABLE `auto_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_images_auto_id_sort_order_index` (`auto_id`,`sort_order`),
  ADD KEY `auto_images_auto_id_is_primary_index` (`auto_id`,`is_primary`);

--
-- Indexes for table `body_types`
--
ALTER TABLE `body_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `body_types_slug_unique` (`slug`),
  ADD KEY `body_types_is_active_index` (`is_active`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`),
  ADD KEY `brands_is_active_index` (`is_active`),
  ADD KEY `brands_sort_order_index` (`sort_order`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_slug_unique` (`slug`),
  ADD KEY `colors_is_active_index` (`is_active`);

--
-- Indexes for table `emission_classes`
--
ALTER TABLE `emission_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emission_classes_slug_unique` (`slug`),
  ADD KEY `emission_classes_is_active_index` (`is_active`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_name_unique` (`name`),
  ADD UNIQUE KEY `features_slug_unique` (`slug`),
  ADD KEY `features_feature_category_id_index` (`feature_category_id`),
  ADD KEY `features_is_active_index` (`is_active`),
  ADD KEY `features_sort_order_index` (`sort_order`),
  ADD KEY `features_feature_category_id_is_active_index` (`feature_category_id`,`is_active`);

--
-- Indexes for table `feature_categories`
--
ALTER TABLE `feature_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feature_categories_name_unique` (`name`),
  ADD UNIQUE KEY `feature_categories_slug_unique` (`slug`),
  ADD KEY `feature_categories_is_active_index` (`is_active`),
  ADD KEY `feature_categories_sort_order_index` (`sort_order`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fuel_types_slug_unique` (`slug`),
  ADD KEY `fuel_types_is_active_index` (`is_active`);

--
-- Indexes for table `kundennummer_sequences`
--
ALTER TABLE `kundennummer_sequences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kundennummer_sequences_prefix_unique` (`prefix`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_type_index` (`type`);

--
-- Indexes for table `transmissions`
--
ALTER TABLE `transmissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transmissions_slug_unique` (`slug`),
  ADD KEY `transmissions_is_active_index` (`is_active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_conditions`
--
ALTER TABLE `vehicle_conditions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_conditions_slug_unique` (`slug`),
  ADD KEY `vehicle_conditions_is_active_index` (`is_active`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_deletions`
--
ALTER TABLE `account_deletions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `autos`
--
ALTER TABLE `autos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auto_images`
--
ALTER TABLE `auto_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `body_types`
--
ALTER TABLE `body_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emission_classes`
--
ALTER TABLE `emission_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feature_categories`
--
ALTER TABLE `feature_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kundennummer_sequences`
--
ALTER TABLE `kundennummer_sequences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transmissions`
--
ALTER TABLE `transmissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `vehicle_conditions`
--
ALTER TABLE `vehicle_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `autos_body_type_id_foreign` FOREIGN KEY (`body_type_id`) REFERENCES `body_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_condition_id_foreign` FOREIGN KEY (`condition_id`) REFERENCES `vehicle_conditions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_emission_class_id_foreign` FOREIGN KEY (`emission_class_id`) REFERENCES `emission_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_fuel_type_id_foreign` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_transmission_id_foreign` FOREIGN KEY (`transmission_id`) REFERENCES `transmissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `autos_vehicle_model_id_foreign` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auto_feature`
--
ALTER TABLE `auto_feature`
  ADD CONSTRAINT `auto_feature_auto_id_foreign` FOREIGN KEY (`auto_id`) REFERENCES `autos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auto_feature_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auto_images`
--
ALTER TABLE `auto_images`
  ADD CONSTRAINT `auto_images_auto_id_foreign` FOREIGN KEY (`auto_id`) REFERENCES `autos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_feature_category_id_foreign` FOREIGN KEY (`feature_category_id`) REFERENCES `feature_categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
