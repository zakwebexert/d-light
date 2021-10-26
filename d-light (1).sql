-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 05:46 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d-light`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `product_choices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_choices`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`id`, `product_id`, `user_id`, `quantity`, `product_choices`, `created_at`, `updated_at`) VALUES
(23, 13, 1, 1, '[]', '2021-07-17 05:34:25', '2021-07-17 05:34:25'),
(24, 18, 1, 1, '[]', '2021-07-17 05:34:35', '2021-07-17 05:34:35'),
(71, 18, 2, 1, '[]', '2021-09-22 00:06:55', '2021-09-22 00:06:55'),
(72, 17, 2, 1, '[]', '2021-09-22 00:06:55', '2021-09-22 00:06:55'),
(73, 12, 2, 1, '[]', '2021-09-22 00:06:55', '2021-09-22 00:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `choice_options`
--

CREATE TABLE `choice_options` (
  `id` bigint(20) NOT NULL,
  `choice_id` bigint(20) NOT NULL,
  `option_title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choice_options`
--

INSERT INTO `choice_options` (`id`, `choice_id`, `option_title`, `description`, `created_at`, `updated_at`) VALUES
(5, 2, 'Small', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(6, 2, 'Medium', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(7, 2, 'Large', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(8, 3, '10 volt', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(9, 3, '20 volt', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(10, 3, '30 volt', NULL, '2021-07-03 09:36:21', '2021-07-03 09:36:21'),
(11, 4, '10', NULL, '2021-07-15 13:42:52', '2021-07-15 13:42:52'),
(12, 4, '20', NULL, '2021-07-15 13:42:52', '2021-07-15 13:42:52'),
(13, 4, '30', NULL, '2021-07-15 13:42:52', '2021-07-15 13:42:52'),
(14, 4, '40', NULL, '2021-07-15 13:42:52', '2021-07-15 13:42:52'),
(15, 5, 'size one', NULL, '2021-07-15 13:44:31', '2021-07-15 13:44:31'),
(16, 5, 'sdfsd', NULL, '2021-07-15 13:44:31', '2021-07-15 13:44:31'),
(33, 18, '#b6afaf', NULL, '2021-07-15 14:35:27', '2021-07-15 14:35:27'),
(34, 18, '#520a0a', NULL, '2021-07-15 14:35:27', '2021-07-15 14:35:27'),
(35, 18, '#ede3e3', NULL, '2021-07-15 14:35:27', '2021-07-15 14:35:27'),
(36, 19, '#645454', NULL, '2021-07-15 14:35:47', '2021-07-15 14:35:47'),
(37, 19, '#e9e2e2', NULL, '2021-07-15 14:35:47', '2021-07-15 14:35:47'),
(38, 19, '#e2f698', NULL, '2021-07-15 14:35:47', '2021-07-15 14:35:47'),
(39, 20, '#242323', NULL, '2021-07-15 14:35:58', '2021-07-15 14:35:58'),
(40, 21, '10', NULL, '2021-07-15 14:38:38', '2021-07-15 14:38:38'),
(41, 21, '20', NULL, '2021-07-15 14:38:38', '2021-07-15 14:38:38'),
(42, 21, '30', NULL, '2021-07-15 14:38:38', '2021-07-15 14:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `percent` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_content`
--

CREATE TABLE `home_page_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_num` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_page_content`
--

INSERT INTO `home_page_content` (`id`, `product_id`, `product_num`, `comment`, `created_at`, `updated_at`) VALUES
(49, 12, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(50, 13, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(51, 17, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(52, 16, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(53, 19, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(54, 21, 2, NULL, '2021-06-27 06:43:02', '2021-06-27 06:43:02'),
(68, 22, 5, NULL, '2021-06-27 06:54:33', '2021-06-27 06:54:33'),
(69, 16, 5, NULL, '2021-06-27 06:54:33', '2021-06-27 06:54:33'),
(70, 12, 5, NULL, '2021-06-27 06:54:33', '2021-06-27 06:54:33'),
(71, 15, 5, NULL, '2021-06-27 06:54:33', '2021-06-27 06:54:33'),
(72, 15, 3, 'Sale', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(73, 18, 3, 'New', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(74, 20, 3, '-15%', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(75, 17, 3, 'New', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(76, 21, 3, 'Sale', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(77, 12, 3, '-20%', '2021-06-27 07:41:51', '2021-06-27 07:41:51'),
(78, 13, 4, 'Sale', '2021-06-27 07:42:36', '2021-06-27 07:42:36'),
(79, 20, 4, 'New', '2021-06-27 07:42:36', '2021-06-27 07:42:36'),
(80, 15, 4, '-10%', '2021-06-27 07:42:36', '2021-06-27 07:42:36'),
(81, 14, 4, 'Sale', '2021-06-27 07:42:36', '2021-06-27 07:42:36'),
(93, 9, 1, 'Now only 10$', '2021-07-27 14:15:33', '2021-07-27 14:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_09_101046_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `option_ps`
--

CREATE TABLE `option_ps` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `option_desc` text DEFAULT NULL,
  `option_sku` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `discount_id` bigint(20) DEFAULT NULL,
  `inventory_id` bigint(20) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `shiffing_method` varchar(255) NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `address` varchar(255) NOT NULL,
  `building_Info` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `user_id`, `total`, `shiffing_method`, `payment_id`, `status`, `address`, `building_Info`, `created_at`, `updated_at`) VALUES
(32, 2, '169', 'normalShipping', NULL, 'Paid', '', '', '2021-07-18 02:37:00', '2021-07-18 02:37:10'),
(33, 2, '400', 'normalShipping', NULL, 'Processed', '', '', '2021-07-18 04:32:50', '2021-07-18 06:35:57'),
(34, 2, '0', 'normalShipping', NULL, 'pending', '', '', '2021-07-27 14:41:33', '2021-07-27 14:41:33'),
(35, 2, '0', 'normalShipping', NULL, 'Paid', 'Abdullah Plaza، Sector II، خیابان سر سید، راولپنڈی, پنجاب 46000, Pakistan', 'plate 17', '2021-07-27 14:51:22', '2021-07-27 14:51:45'),
(36, 2, '0', 'normalShipping', NULL, 'pending', 'Webster, TX, USA', 'hasan plaza plate 17', '2021-07-27 15:17:52', '2021-07-27 15:17:52'),
(37, 2, '144', 'normalShipping', NULL, 'pending', 'Abdullah Plaza، Sector II، خیابان سر سید، راولپنڈی, پنجاب 46000, Pakistan', 'hasan plaza plate 17', '2021-07-28 00:30:11', '2021-07-28 00:30:11'),
(38, 2, '144', 'normalShipping', NULL, 'pending', 'Islamabad, Islamabad Capital Territory, Pakistan', 'hasan plaza plate 17', '2021-07-28 05:47:20', '2021-07-28 05:47:20'),
(39, 2, '144', 'normalShipping', NULL, 'Processed', '8777 Collins Ave, Surfside, FL 33154, USA', 'sss', '2021-07-28 05:58:12', '2021-08-11 18:46:13'),
(40, 2, '177', 'normalShipping', NULL, 'pending', 'Ghaziabad, Uttar Pradesh, India', 'hasan plaza plate 17', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(41, 2, '308', 'normalShipping', NULL, 'pending', 'Dorohuska 33, 22-105 Srebrzyszcze, Poland', 'hasan plaza plate 17', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(42, 2, '308', 'normalShipping', NULL, 'Paid', 'Abdullah Plaza، Sector II، خیابان سر سید، راولپنڈی, پنجاب 46000, Pakistan', 'hasan plaza plate 17', '2021-09-21 23:41:32', '2021-09-21 23:45:59'),
(43, 2, '45', 'normalShipping', NULL, 'Paid', 'Abdullah Plaza، Sector II، خیابان سر سید، راولپنڈی, پنجاب 46000, Pakistan', 'hasan plaza plate 17', '2021-09-22 00:05:38', '2021-09-22 00:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_Id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_choices` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_Id`, `quantity`, `product_choices`, `created_at`, `updated_at`) VALUES
(68, 32, 9, 1, '[]', '2021-07-18 02:37:00', '2021-07-18 02:37:00'),
(69, 32, 18, 1, '[]', '2021-07-18 02:37:00', '2021-07-18 02:37:00'),
(70, 32, 12, 1, '[]', '2021-07-18 02:37:00', '2021-07-18 02:37:00'),
(71, 33, 9, 4, '[\"Size=>Small\",\"another_sizes=>size one\",\"colors=>#e9e2e2\",\"Volt=>20\"]', '2021-07-18 04:32:50', '2021-07-18 04:32:50'),
(72, 37, 13, 1, '[]', '2021-07-28 00:30:11', '2021-07-28 00:30:11'),
(73, 38, 13, 1, '[]', '2021-07-28 05:47:20', '2021-07-28 05:47:20'),
(74, 39, 13, 1, '[]', '2021-07-28 05:58:12', '2021-07-28 05:58:12'),
(75, 40, 17, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(76, 40, 18, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(77, 40, 17, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(78, 40, 21, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(79, 40, 14, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(80, 40, 15, 1, '[]', '2021-08-16 07:44:16', '2021-08-16 07:44:16'),
(81, 41, 17, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(82, 41, 18, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(83, 41, 17, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(84, 41, 14, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(85, 41, 15, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(86, 41, 17, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(87, 41, 16, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(88, 41, 16, 1, '[]', '2021-09-20 23:33:42', '2021-09-20 23:33:42'),
(89, 42, 17, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(90, 42, 18, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(91, 42, 17, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(92, 42, 14, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(93, 42, 15, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(94, 42, 17, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(95, 42, 16, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(96, 42, 16, 1, '[]', '2021-09-21 23:41:32', '2021-09-21 23:41:32'),
(97, 43, 17, 1, '[]', '2021-09-22 00:05:38', '2021-09-22 00:05:38'),
(98, 43, 21, 1, '[]', '2021-09-22 00:05:38', '2021-09-22 00:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_desc` text DEFAULT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `style_id` bigint(20) UNSIGNED NOT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `product_desc`, `product_sku`, `category_id`, `style_id`, `discount_id`, `inventory_id`, `price`, `image`, `created_at`, `updated_at`) VALUES
(9, 'Light Candle', 'candle description', '121212', 5, 3, NULL, NULL, 100, '11657825482.jpg', '2021-06-27 05:38:22', '2021-06-27 05:38:22'),
(10, 'Best Furniture', 'furniture description', '121212', 5, 14, NULL, NULL, 100, '36270303.jpg', '2021-06-27 05:39:53', '2021-06-27 05:39:53'),
(11, 'Amazon Echo', 'amazon echo description', '121212', 4, 16, NULL, NULL, 222, '789468989s.jpg', '2021-06-27 05:40:46', '2021-06-27 05:40:46'),
(12, 'Classic garden chair', 'chair description', '121212', 1, 14, NULL, NULL, 36, '5189417453.png', '2021-06-27 05:41:58', '2021-06-27 05:41:58'),
(13, 'Modern Sofa', 'sofa description', '121212', 3, 15, NULL, NULL, 144, '18745626042.png', '2021-06-27 05:42:52', '2021-06-27 05:42:52'),
(14, 'Black table lamp', 'lamp description', '121212', 4, 14, NULL, NULL, 44, '4327222431.png', '2021-06-27 05:43:35', '2021-06-27 05:43:35'),
(15, 'Beach cap', 'cap description', '121212', 2, 12, NULL, NULL, 32, '43590222811.png', '2021-06-27 05:44:22', '2021-06-27 05:44:22'),
(16, 'Roof lamp', 'lamp description', '121212', 5, 16, NULL, NULL, 65, '12965649526.png', '2021-06-27 05:44:54', '2021-06-27 05:44:54'),
(17, 'Wooden chair', 'chair description', '121212', 4, 14, NULL, NULL, 23, '20630864848.png', '2021-06-27 05:45:33', '2021-06-27 05:45:33'),
(18, 'Polo shirts', 'shirt description', '121212', 1, 15, NULL, NULL, 33, '11584999134.png', '2021-06-27 05:46:19', '2021-06-27 05:46:19'),
(19, 'Office chair', 'chair description', '121212', 5, 15, NULL, NULL, 23, '13216603357.png', '2021-06-27 05:47:04', '2021-06-27 05:47:04'),
(20, 'Sun glasses', 'glasses description', '3323d', 2, 14, NULL, NULL, 23, '43498288912.png', '2021-06-27 05:47:48', '2021-06-27 05:47:48'),
(21, 'Wall Clock', 'clock description', '3323d', 5, 14, NULL, NULL, 22, '59137780413.png', '2021-06-27 05:48:32', '2021-06-27 05:48:32'),
(22, 'Blue Skateboard', 'skate board description', 'weew33', 1, 13, NULL, NULL, 31, '111671142314.png', '2021-06-27 05:49:20', '2021-06-27 05:49:45'),
(23, 'Amazon Echo', 'dummy product description', 'SSO8b2', 3, 12, NULL, NULL, 3232, '1016895333Triangle-9.jpg', '2021-07-28 22:32:08', '2021-07-28 22:32:08'),
(24, 'new test product', 'description of test product', 'dWT25j', 1, 14, NULL, NULL, 100, '141955869jpegsystems-home.jpg', '2021-08-09 12:56:08', '2021-08-09 12:56:08'),
(26, 'test antoher product', 'dummy product description', 'LJE4ph', 1, 13, NULL, NULL, 2499, '1201891852JPEG_example_flower.jpg', '2021-08-27 00:15:15', '2021-08-27 00:15:15'),
(27, 'test test test', 'dummy product description', 'sA4g9T', 1, 12, NULL, NULL, 2499, '1029305443JPEG_example_flower.jpg', '2021-08-27 00:54:47', '2021-08-27 01:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Women\'s', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(2, 'Juice', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(3, 'Foods', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(4, 'Sport', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(5, 'Men\'s', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(6, 'Travel', '', '2021-06-21 19:55:53', '2021-06-21 19:55:53'),
(10, 'new test category', '', '2021-08-24 23:41:24', '2021-08-24 23:41:24'),
(11, 'Amazon Echo update', '485981760Astore Minimarg SubKuch SK Tourism.jpg', '2021-08-31 11:25:53', '2021-08-31 11:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_choices`
--

CREATE TABLE `product_choices` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `choice_title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_choices`
--

INSERT INTO `product_choices` (`id`, `product_id`, `choice_title`, `description`, `created_at`, `updated_at`) VALUES
(2, 9, 'Size', NULL, '2021-07-03 09:34:41', '2021-07-03 09:34:41'),
(3, 9, 'Volt', NULL, '2021-07-03 09:34:41', '2021-07-03 09:34:41'),
(4, 9, 'Volt', NULL, '2021-07-15 13:42:52', '2021-07-15 13:42:52'),
(5, 9, 'another sizes', NULL, '2021-07-15 13:44:31', '2021-07-15 13:44:31'),
(18, 10, 'colors', NULL, '2021-07-15 14:35:27', '2021-07-15 14:35:27'),
(19, 9, 'colors', NULL, '2021-07-15 14:35:47', '2021-07-15 14:35:47'),
(20, 11, 'colors', NULL, '2021-07-15 14:35:58', '2021-07-15 14:35:58'),
(21, 9, 'Volt', NULL, '2021-07-15 14:38:38', '2021-07-15 14:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(4, 27, '61287e274286f.jpg', '2021-08-27 00:54:47', '2021-08-27 00:54:47'),
(5, 27, '61287e27440ae.jpg', '2021-08-27 00:54:47', '2021-08-27 00:54:47'),
(6, 27, '61287e27454ad.jpg', '2021-08-27 00:54:47', '2021-08-27 00:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_session`
--

CREATE TABLE `shopping_session` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `style_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `style_name`, `image`, `created_at`, `updated_at`) VALUES
(12, 'Modern', 'modern.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52'),
(13, 'Postmodern', 'postmodern.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52'),
(14, 'Nordic', 'nordic.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52'),
(15, 'European', 'european.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52'),
(16, 'American', 'american.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52'),
(17, 'Chinese', 'chinease.jpg', '2021-08-27 07:13:52', '2021-08-27 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `active`, `password`, `remember_token`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@domain.com', NULL, 1, 1, '$2y$10$qjKjrzmHYfIUPxADUiEk9ezZ8G5MTjUeyHH8uVPVTtEUs9Mt/2Csi', NULL, NULL, '2021-06-19 06:12:33', '2021-07-15 14:42:31'),
(2, 'test client', 'test@gmail.com', NULL, 0, 1, '$2y$10$qjKjrzmHYfIUPxADUiEk9ezZ8G5MTjUeyHH8uVPVTtEUs9Mt/2Csi', NULL, '32323343', '2021-06-19 06:12:33', '2021-07-29 00:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_line` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choice_options`
--
ALTER TABLE `choice_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choice_id` (`choice_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_page_content`
--
ALTER TABLE `home_page_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_ps`
--
ALTER TABLE `option_ps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_choices`
--
ALTER TABLE `product_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `choice_options`
--
ALTER TABLE `choice_options`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_content`
--
ALTER TABLE `home_page_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `option_ps`
--
ALTER TABLE `option_ps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_choices`
--
ALTER TABLE `product_choices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choice_options`
--
ALTER TABLE `choice_options`
  ADD CONSTRAINT `choice_id` FOREIGN KEY (`choice_id`) REFERENCES `product_choices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `order_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_choices`
--
ALTER TABLE `product_choices`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
