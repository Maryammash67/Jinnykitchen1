-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 10:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restuarent11`
--

-- --------------------------------------------------------

--
-- Table structure for table `adtodcarts`
--

CREATE TABLE `adtodcarts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foodtitle` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` int(255) NOT NULL,
  `branch_id` int(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adtodcarts`
--

INSERT INTO `adtodcarts` (`id`, `food_id`, `user_id`, `foodtitle`, `price`, `size`, `quantity`, `total_price`, `branch_id`, `branch_name`, `created_at`, `updated_at`) VALUES
(33, 2, 2, 'Gimbap', 650.00, 'Small', 2, 1300, 2, 'Mawanella', '2023-09-25 15:10:05', '2023-09-25 15:10:05'),
(35, 3, 2, 'Galbi', 1300.00, 'Large', 2, 2600, 2, 'Mawanella', '2023-09-26 13:45:40', '2023-09-26 13:45:40'),
(39, 2, 2, 'Gimbap', 1200.00, 'Large', 3, 3600, 2, 'Mawanella', '2023-09-28 02:19:54', '2023-09-28 02:19:54'),
(40, 3, 2, 'Galbi', 600.00, 'Medium', 3, 1800, 1, 'Kandy', '2023-09-28 02:27:10', '2023-09-28 02:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kandy', NULL, NULL),
(2, 'Mawanella', NULL, NULL);

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
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foodtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `foodtitle`, `image`, `description`, `category`, `created_at`, `updated_at`) VALUES
(1, 'kimchii', '1695318419.png', 'Kimchi the favorite and delicious dish..', 'food', '2023-09-21 12:16:59', '2023-09-26 12:51:28'),
(2, 'Gimbap', '1695318611.png', 'Seaweed-wrapped rice rolls with fillings.', 'food', '2023-09-21 12:20:11', '2023-09-21 12:20:11'),
(3, 'Galbi', '1695318726.jpg', 'Sweet soy-marinated grilled short ribs', 'food', '2023-09-21 12:22:06', '2023-09-21 12:22:06'),
(4, 'Japchae', '1695319661.png', 'Stir-fried glass noodles with veggies and meat', 'food', '2023-09-21 12:37:41', '2023-09-21 12:37:41'),
(5, 'Italian Pizza', '1695319787.png', 'Thin crust, melted cheese, flavorful toppings', 'food', '2023-09-21 12:39:47', '2023-09-21 12:39:47'),
(6, 'Lasagna', '1695319881.png', 'Layered pasta dish with sauce, cheese, and often meat', 'food', '2023-09-21 12:41:21', '2023-09-21 12:41:21'),
(7, 'Blackcurrant Mojito', '1695319988.png', 'Refreshing cocktail with blackcurrant flavor, mint, and lime', 'Beverages', '2023-09-21 12:43:08', '2023-09-21 12:43:08'),
(8, 'Watermelon Mojito', '1695320079.png', 'Cool cocktail featuring watermelon, mint, lime', 'Beverages', '2023-09-21 12:44:39', '2023-09-21 12:44:39'),
(10, 'Boba Mojito', '1695320264.png', 'Fusion drink combining boba pearls, mint, lime, and flavors', 'Beverages', '2023-09-21 12:47:44', '2023-09-21 12:47:44'),
(11, 'Mango Drink', '1695320508.png', 'Refreshing beverage made from ripe mangoes, often blended', 'Beverages', '2023-09-21 12:51:48', '2023-09-21 12:51:48'),
(12, 'Kunafa', '1695320640.png', 'Middle Eastern dessert with shredded pastry and sweet filling', 'Dessert', '2023-09-21 12:54:00', '2023-09-21 12:54:00'),
(13, 'Swiss Roll', '1695320707.png', 'Rolled sponge cake with filling, delightful and versatile', 'Dessert', '2023-09-21 12:55:07', '2023-09-21 12:55:07'),
(14, 'Nutella Crepe', '1695320805.png', 'Thin pancake filled with Nutella, deliciously indulgent choice', 'Dessert', '2023-09-21 12:56:45', '2023-09-21 12:56:45'),
(15, 'Chocolate Mousse', '1695320882.png', 'Decadent dessert, airy chocolate delight, creamy and rich', 'Dessert', '2023-09-21 12:58:02', '2023-09-21 12:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `foodcategories`
--

CREATE TABLE `foodcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foodchefs`
--

CREATE TABLE `foodchefs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foodchefs`
--

INSERT INTO `foodchefs` (`id`, `name`, `speciality`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Park Seo-Joon', 'A very talented famous chef from Korea who have experience in all dish with signature dish as Hotdog and Reamen', '1695320970.jpg', '2023-09-21 12:59:30', '2023-09-21 12:59:30'),
(2, 'Kim Taehyung', 'Rafting exquisite chicken dishes that leave patrons spellbound. From his signature fried chicken.', '1695321009.jpg', '2023-09-21 13:00:09', '2023-09-21 13:02:09'),
(3, 'Jung Yu-mi', 'A very talented female chef from Korea whit signature dish Kimchi.', '1695321070.jpg', '2023-09-21 13:01:10', '2023-09-21 13:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `food_attributes`
--

CREATE TABLE `food_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quty` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_attributes`
--

INSERT INTO `food_attributes` (`id`, `food_id`, `size`, `price`, `quty`, `created_at`, `updated_at`) VALUES
(1, 1, 'Large', '1200', '200', '2023-09-21 12:16:59', '2023-09-27 10:45:33'),
(2, 1, 'Small', '680', '20', '2023-09-21 12:16:59', '2023-09-27 10:23:51'),
(3, 2, 'Large', '1200', '12', '2023-09-21 12:20:11', '2023-09-27 10:21:54'),
(4, 2, 'Small', '650', '12', '2023-09-21 12:20:11', '2023-09-21 12:20:11'),
(5, 3, 'Large', '1300', '12', '2023-09-21 12:22:06', '2023-09-21 12:22:06'),
(6, 3, 'Medium', '600', '12', '2023-09-21 12:22:06', '2023-09-21 12:22:06'),
(7, 4, 'Large', '1500', '12', '2023-09-21 12:37:41', '2023-09-21 12:37:41'),
(8, 4, 'Medium', '850', '12', '2023-09-21 12:37:41', '2023-09-21 12:37:41'),
(9, 5, 'Large', '2000', '12', '2023-09-21 12:39:47', '2023-09-27 10:42:46'),
(10, 5, 'Medium', '1500', '12', '2023-09-21 12:39:47', '2023-09-21 12:39:47'),
(11, 5, 'Small', '1250', '12', '2023-09-21 12:39:47', '2023-09-21 12:39:47'),
(12, 6, 'Large', '4000', '12', '2023-09-21 12:41:21', '2023-09-27 10:38:13'),
(13, 6, 'Medium', '2500', '12', '2023-09-21 12:41:21', '2023-09-21 12:41:21'),
(14, 7, 'Large', '600', '120', '2023-09-21 12:43:08', '2023-09-27 10:45:10'),
(15, 7, 'Small', '300', '12', '2023-09-21 12:43:08', '2023-09-21 12:43:08'),
(16, 8, 'Large', '600', '12', '2023-09-21 12:44:39', '2023-09-21 12:44:39'),
(17, 8, 'Small', '300', '12', '2023-09-21 12:44:39', '2023-09-21 12:44:39'),
(20, 10, 'Large', '800', '21', '2023-09-21 12:47:44', '2023-09-21 12:47:44'),
(21, 10, 'Small', '650', '12', '2023-09-21 12:47:44', '2023-09-21 12:47:44'),
(22, 11, 'Large', '700', '12', '2023-09-21 12:51:48', '2023-09-21 12:51:48'),
(23, 11, 'Small', '550', '12', '2023-09-21 12:51:48', '2023-09-21 12:51:48'),
(24, 12, 'Normal', '4000', '12', '2023-09-21 12:54:00', '2023-09-21 12:54:00'),
(25, 13, 'Normal', '550', '12', '2023-09-21 12:55:07', '2023-09-21 12:55:07'),
(26, 14, 'Large', '2500', '12', '2023-09-21 12:56:45', '2023-09-21 12:56:45'),
(27, 14, 'Medium', '1500', '12', '2023-09-21 12:56:45', '2023-09-21 12:56:45'),
(28, 15, 'Medium', '4000', '12', '2023-09-21 12:58:02', '2023-09-21 12:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `food_branch`
--

CREATE TABLE `food_branch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_branch`
--

INSERT INTO `food_branch` (`id`, `food_id`, `branch_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, '2023-09-21 12:16:59', '2023-09-23 04:34:17'),
(2, 1, 2, 57, '2023-09-21 12:16:59', '2023-09-23 04:34:17'),
(3, 2, 1, 35, '2023-09-21 12:20:11', '2023-09-23 03:32:36'),
(4, 2, 2, 36, '2023-09-21 12:20:11', '2023-09-23 03:32:36'),
(5, 3, 1, 49, '2023-09-21 12:22:06', '2023-09-24 08:23:48'),
(6, 3, 2, 54, '2023-09-21 12:22:06', '2023-09-24 05:47:31'),
(7, 4, 1, 27, '2023-09-21 12:37:41', '2023-09-24 08:23:48'),
(8, 4, 2, 30, '2023-09-21 12:37:41', '2023-09-21 12:37:41'),
(9, 5, 1, 54, '2023-09-21 12:39:47', '2023-09-23 10:23:00'),
(10, 5, 2, 57, '2023-09-21 12:39:47', '2023-09-23 10:23:00'),
(11, 6, 1, 42, '2023-09-21 12:41:21', '2023-09-24 02:32:33'),
(12, 6, 2, 47, '2023-09-21 12:41:21', '2023-09-24 02:32:33'),
(13, 7, 1, 100, '2023-09-21 12:43:08', '2023-09-21 12:43:08'),
(14, 7, 2, 100, '2023-09-21 12:43:08', '2023-09-21 12:43:08'),
(15, 8, 1, 100, '2023-09-21 12:44:39', '2023-09-21 12:44:39'),
(16, 8, 2, 100, '2023-09-21 12:44:39', '2023-09-21 12:44:39'),
(19, 10, 1, 100, '2023-09-21 12:47:44', '2023-09-21 12:47:44'),
(20, 10, 2, 100, '2023-09-21 12:47:44', '2023-09-21 12:47:44'),
(21, 11, 1, 100, '2023-09-21 12:51:48', '2023-09-21 12:51:48'),
(22, 11, 2, 100, '2023-09-21 12:51:48', '2023-09-21 12:51:48'),
(23, 12, 1, 50, '2023-09-21 12:54:00', '2023-09-21 12:54:00'),
(24, 12, 2, 50, '2023-09-21 12:54:00', '2023-09-21 12:54:00'),
(25, 13, 1, 50, '2023-09-21 12:55:07', '2023-09-21 12:55:07'),
(26, 13, 2, 50, '2023-09-21 12:55:07', '2023-09-21 12:55:07'),
(27, 14, 1, 50, '2023-09-21 12:56:45', '2023-09-21 12:56:45'),
(28, 14, 2, 50, '2023-09-21 12:56:45', '2023-09-21 12:56:45'),
(29, 15, 1, 60, '2023-09-21 12:58:03', '2023-09-21 12:58:03'),
(30, 15, 2, 60, '2023-09-21 12:58:03', '2023-09-21 12:58:03');

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_08_07_100819_create_food_table', 1),
(7, '2023_08_17_190152_create_foodchefs_table', 1),
(8, '2023_08_23_175853_create_foodcategories_table', 1),
(9, '2023_08_30_071438_create_food_attributes_table', 1),
(10, '2023_09_04_093742_create_adtodcarts_table', 1),
(11, '2023_09_07_231500_create_branches_table', 1),
(12, '2023_09_07_231737_create_food_branch_table', 1),
(13, '2023_09_18_180032_create_purchase_histories_table', 1),
(14, '2023_09_27_162805_create_reservations_table', 2);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'API TOKEN', '83bba3f8c265c0bd691af51d24836213bc6d3eb72d07a4e9da8f8600fc9b36aa', '[\"*\"]', NULL, NULL, '2023-09-25 02:20:50', '2023-09-25 02:20:50'),
(2, 'App\\Models\\User', 4, 'API TOKEN', '0c2f424263e2f0d6cbef2fa16ef4934117f27aea6988e886f452dbfcb16639f1', '[\"*\"]', NULL, NULL, '2023-09-25 02:38:44', '2023-09-25 02:38:44'),
(3, 'App\\Models\\User', 3, 'API TOKEN', '78365ef7f2fefd03b747d43ec8628c06621c98d8c0fee610ceec3a0f83b27af4', '[\"*\"]', NULL, NULL, '2023-09-25 02:43:54', '2023-09-25 02:43:54'),
(4, 'App\\Models\\User', 1, 'API TOKEN', '3d121a31d8ff6025311f1d342d928e71e2e39aa6292e43e80418c4967326854c', '[\"*\"]', NULL, NULL, '2023-09-25 02:46:13', '2023-09-25 02:46:13'),
(5, 'App\\Models\\User', 1, 'API TOKEN', 'f68f7c53fda46f4891c67452e4890dd781cd178910f3f91e7fa79cfff46f3ee1', '[\"*\"]', '2023-09-27 13:46:49', NULL, '2023-09-27 13:42:01', '2023-09-27 13:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_histories`
--

INSERT INTO `purchase_histories` (`id`, `user_id`, `food_id`, `branch_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(25, 2, 3, 1, 3, 3900, '2023-09-24 05:47:31', '2023-09-24 05:47:31'),
(26, 2, 3, 2, 4, 5200, '2023-09-24 05:47:31', '2023-09-24 05:47:31'),
(27, 3, 3, 1, 2, 2600, '2023-09-24 08:23:48', '2023-09-24 08:23:48'),
(28, 3, 4, 1, 3, 4500, '2023-09-24 08:23:48', '2023-09-24 08:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `guestno` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `guestno`, `date`, `time`, `message`, `created_at`, `updated_at`) VALUES
(1, 'maryam', 'mash@gmail.com', '0123456789', '2', '26.09.2023', '2.00pm', 'hi i wanna table', '2023-09-28 02:30:02', '2023-09-28 02:30:02'),
(2, 'maryam', 'mash@gmail.com', '0123456789', '2', '26.09.2023', '2.00pm', 'hi i wanna table', '2023-09-28 02:30:41', '2023-09-28 02:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `usertype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin123@gmail.com', '3032014561', 'kandy', '1', NULL, '$2y$10$fJF8y82ngOsTgJ1BtXtwO.DDNDnSR7/XMrEq2DbFE7GOaqZaI4hwe', NULL, '2023-09-21 12:07:47', '2023-09-21 12:07:47'),
(2, 'User1', 'user123@gmail.com', '54684685464', 'Kandyy', '0', NULL, '$2y$10$y9NL2K7KtqLyMxMAnsHo9uZmhUgXvShNC1lrKlgoS5mkXI/zCfy9O', NULL, '2023-09-21 12:08:53', '2023-09-23 10:21:26'),
(3, 'Maryam', 'mash123@gmail.com', '00235303', 'Mawnella', '0', NULL, '$2y$10$jJoezBGeOSy5AquvnswrSO9IAFKVFOt/nOd8KkXj64V.lHWUIYAkm', NULL, '2023-09-21 12:09:40', '2023-09-21 12:09:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adtodcarts`
--
ALTER TABLE `adtodcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adtodcarts_food_id_foreign` (`food_id`),
  ADD KEY `adtodcarts_user_id_foreign` (`user_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodcategories`
--
ALTER TABLE `foodcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodchefs`
--
ALTER TABLE `foodchefs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_attributes`
--
ALTER TABLE `food_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_attributes_food_id_foreign` (`food_id`);

--
-- Indexes for table `food_branch`
--
ALTER TABLE `food_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_branch_food_id_foreign` (`food_id`),
  ADD KEY `food_branch_branch_id_foreign` (`branch_id`);

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
-- Indexes for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_histories_user_id_foreign` (`user_id`),
  ADD KEY `purchase_histories_food_id_foreign` (`food_id`),
  ADD KEY `purchase_histories_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adtodcarts`
--
ALTER TABLE `adtodcarts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `foodcategories`
--
ALTER TABLE `foodcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foodchefs`
--
ALTER TABLE `foodchefs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food_attributes`
--
ALTER TABLE `food_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `food_branch`
--
ALTER TABLE `food_branch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adtodcarts`
--
ALTER TABLE `adtodcarts`
  ADD CONSTRAINT `adtodcarts_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adtodcarts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_attributes`
--
ALTER TABLE `food_attributes`
  ADD CONSTRAINT `food_attributes_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `food_branch`
--
ALTER TABLE `food_branch`
  ADD CONSTRAINT `food_branch_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_branch_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD CONSTRAINT `purchase_histories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_histories_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
