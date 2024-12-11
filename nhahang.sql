-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 04:38 AM
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
-- Database: `nhahang`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `bill_time` datetime DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `user_id`, `reservation_id`, `table_id`, `payment_method`, `bill_time`, `payment_time`, `deleted_at`) VALUES
(1, 1, NULL, 1, NULL, '2024-12-02 20:45:28', NULL, NULL),
(2, 1, NULL, 1, 'credit_card', '2024-12-02 20:47:37', '2024-12-02 20:50:04', NULL),
(3, 1, NULL, 2, 'credit_card', '2024-12-02 20:52:46', '2024-12-02 20:58:46', NULL),
(4, 1, NULL, 3, 'cash', '2024-12-02 21:13:36', '2024-12-02 21:14:30', NULL),
(5, 1, NULL, 4, 'cash', '2024-12-05 16:33:55', '2024-12-05 16:34:56', NULL),
(6, 1, NULL, 1, NULL, '2024-12-05 16:36:47', NULL, NULL),
(7, 1, NULL, 8, NULL, '2024-12-05 16:37:00', NULL, NULL),
(8, NULL, 1, 2, NULL, '2024-12-06 17:47:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `bill_item_id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `dish_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`bill_item_id`, `bill_id`, `dish_id`, `quantity`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 1),
(3, 2, 3, 1),
(4, 2, 5, 3),
(5, 2, 7, 1),
(6, 2, 8, 1),
(7, 2, 11, 1),
(8, 2, 10, 1),
(9, 3, 1, 1),
(10, 3, 3, 1),
(11, 3, 2, 1),
(12, 4, 1, 1),
(13, 4, 2, 1),
(14, 4, 3, 1),
(15, 4, 4, 1),
(16, 4, 5, 1),
(17, 4, 20, 1),
(18, 4, 33, 1),
(19, 5, 8, 4),
(20, 5, 4, 1),
(21, 5, 1, 3),
(22, 5, 2, 4),
(23, 5, 15, 9),
(24, 6, 1, 1),
(25, 6, 2, 1),
(26, 6, 3, 1),
(27, 6, 4, 1),
(28, 6, 5, 1),
(29, 7, 1, 1),
(30, 7, 3, 2),
(31, 7, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `user_id`, `description`, `date`, `image`) VALUES
(1, 'Delicious Cooking Recipe', 1, 'A simple and delicious recipe for cooking.', '2024-12-01', 'images/blog-01.jpg'),
(2, 'Exciting Event Recap', 1, 'A recap of the exciting event that took place recently.', '2024-11-28', 'images/blog-02.jpg'),
(3, 'Traveling to Paris: A Guide', 1, 'The ultimate guide to traveling to Paris with tips and tricks.', '2024-11-24', 'images/blog-03.jpg'),
(4, 'The Future of Technology', 1, 'An overview of the advancements in technology in the next decade.', '2024-11-21', 'images/blog-04.jpg'),
(5, 'Healthy Lifestyle Tips', 1, 'Simple tips for maintaining a healthy lifestyle.', '2024-11-17', 'images/blog-05.jpg');

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
  `cate_id` bigint(20) UNSIGNED NOT NULL,
  `cate_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`) VALUES
(1, 'starters'),
(2, 'mains'),
(3, 'desserts'),
(4, 'drinks'),
(5, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `dish_id` bigint(20) UNSIGNED NOT NULL,
  `cate_id` bigint(20) UNSIGNED NOT NULL,
  `dish_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dish_price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`dish_id`, `cate_id`, `dish_name`, `image`, `dish_price`) VALUES
(1, 1, 'Beijing style roasted duck and jellyfish salad', 'images/menu-01.jpg', '10.00'),
(2, 1, 'Australian beef tenderloin and Thai fresh herbs salad', 'images/menu-02.jpg', '12.00'),
(3, 1, 'Coconut blade, prawns, pork with fresh herbs salad', 'images/menu-03.jpg', '14.00'),
(4, 1, 'Deep-fried prawns with salted egg yolk', 'images/menu-04.jpg', '16.00'),
(5, 1, 'Spinach soup with prawns, squid and scallops', 'images/menu-05.jpg', '18.00'),
(6, 2, 'Double-boiled chicken soup with Australian abalone', 'images/menu-06.jpg', '20.00'),
(7, 2, 'Beijing style grilled pork ribs served with red sticky rice', 'images/menu-07.jpg', '22.00'),
(8, 2, 'Double-boiled duck with five fruits served with fresh noodles', 'images/menu-08.jpg', '24.00'),
(9, 2, 'Fried rice with prawns and salted duck eggs', 'images/menu-09.jpg', '26.00'),
(10, 2, 'Stir-fried blinweed with garlic', 'images/menu-10.jpg', '28.00'),
(11, 2, 'Hong Kong style steamed garoupa', 'images/menu-11.jpg', '30.00'),
(12, 2, 'Deep-fried cobia with orange sauce', 'images/menu-12.jpg', '32.00'),
(13, 2, 'Bird’s nest and shredded chicken soup', 'images/menu-13.jpg', '34.00'),
(14, 2, 'Stewed US beef with beans and tomato sauce served with bread', 'images/menu-14.jpg', '36.00'),
(15, 2, 'Fried tofu with lemongrass and chili', 'images/menu-15.jpg', '38.00'),
(16, 2, 'Norwegian salmon hot pot served with fresh vermicelli', 'images/menu-16.jpg', '40.00'),
(17, 2, 'Cobia and bamboo shoots hot pot served with fresh vermicelli', 'images/menu-17.jpg', '42.00'),
(18, 2, 'Thai seafood and mushroom hot pot served with fresh vermicelli', 'images/menu-18.jpg', '44.00'),
(19, 2, 'Seafood and crab paste hot pot served with fresh vermicelli', 'images/menu-19.jpg', '46.00'),
(20, 2, 'Snakehead fish hotpot', 'images/menu-20.jpg', '48.00'),
(21, 3, 'Mango', 'images/menu-21.jpg', '50.00'),
(22, 3, 'Watermelon', 'images/menu-22.jpg', '52.00'),
(23, 3, 'Pineapple', 'images/menu-23.jpg', '54.00'),
(24, 3, 'Guava', 'images/menu-24.jpg', '56.00'),
(25, 3, 'Jackfruit', 'images/menu-25.jpg', '58.00'),
(26, 4, 'Vodka Red ', 'images/menu-26.jpg', '58.00'),
(27, 4, 'Volka White', 'images/menu-27.jpg', '62.00'),
(28, 4, 'Tao Meo', 'images/menu-28.jpg', '64.00'),
(29, 4, 'Soju', 'images/menu-29.jpg', '66.00'),
(30, 4, 'Chuoi hot', 'images/menu-30.jpg', '68.00'),
(31, 4, 'Coca', 'images/menu-31.jpg', '70.00'),
(32, 4, 'Pepsi', 'images/menu-32.jpg', '72.00'),
(33, 4, 'Sting Red', 'images/menu-33.jpg', '74.00'),
(34, 4, 'Sting Yellow', 'images/menu-34.jpg', '76.00'),
(35, 4, '7 Up', 'images/menu-35.jpg', '78.00');

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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `gallery_category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image_path`, `gallery_category_id`) VALUES
(1, 'images/photo-gallery-13.jpg', 1),
(2, 'images/photo-gallery-14.jpg', 2),
(3, 'images/photo-gallery-15.jpg', 3),
(4, 'images/photo-gallery-16.jpg', 4),
(5, 'images/photo-gallery-17.jpg', 1),
(6, 'images/photo-gallery-18.jpg', 2),
(7, 'images/photo-gallery-19.jpg', 3),
(8, 'images/photo-gallery-20.jpg', 4),
(9, 'images/photo-gallery-21.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `name`) VALUES
(1, 'Interior'),
(2, 'Food'),
(3, 'Events'),
(4, 'Guests'),
(5, 'Funny'),
(6, 'Reviewer');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(61, '0001_01_01_000000_create_users_table', 1),
(62, '0001_01_01_000001_create_cache_table', 1),
(63, '0001_01_01_000002_create_jobs_table', 1),
(64, '2024_11_23_070040_create_categories_table', 1),
(65, '2024_11_23_070105_create_dishes_table', 1),
(66, '2024_11_23_070120_create_restaurant_tables_table', 1),
(67, '2024_11_23_085630_create_reservations', 1),
(68, '2024_11_23_085803_create_bills_table', 1),
(69, '2024_11_23_184251_create_gallery_categories_table', 1),
(70, '2024_11_23_184326_create_galleries_table', 1),
(71, '2024_11_23_184704_create_blogs_table', 1),
(72, '2024_11_24_085808_create_bill_items_table', 1);

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `customer_name`, `customer_phone`, `customer_email`, `table_id`, `reservation_time`, `reservation_date`, `description`) VALUES
(1, 'Anh', '123123123', 'anhhuahuynh@gmail.com', 2, '10:30:00', '2024-12-07', 'Pls give me 2 chair for children!');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

CREATE TABLE `restaurant_tables` (
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_tables`
--

INSERT INTO `restaurant_tables` (`table_id`, `capacity`, `state`) VALUES
(1, 2, 'unavailable'),
(2, 2, 'reserved'),
(3, 2, 'available'),
(4, 4, 'available'),
(5, 4, 'available'),
(6, 4, 'available'),
(7, 8, 'available'),
(8, 8, 'unavailable'),
(9, 12, 'available'),
(10, 8, 'available'),
(11, 14, 'available');

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
('2JiIgYolwLi1kce6gkW8sXowvJReVraPTYoqS3B6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSWc0OTZyeHBDRm5ZaDRmU1ZHa0ZUTm9MQzlaUm5Sb3c2MUtOTXRNMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iaWxscz9rZXl3b3JkPTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE4OiJmbGFzaGVyOjplbnZlbG9wZXMiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1733507280);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'anhhuahuynh@gmail.com', '0123456789', '212 Nguyen Dinh Chieu', '$2y$12$DItmLQwODWRU/V9Oe3as6e0GzUdB7UEbPUYuJVJv3HVlOJ.xMD0FW', 'Admin', NULL, NULL, NULL),
(2, 'User 1', 'user1@example.com', '1234567890', '123 Main Street', '$2y$12$zxxtK7uijqJ.z1B3sw8B4OhNeO6zOxyCpjLFvjGbtfmGaL8NIirFK', 'Staff', NULL, NULL, NULL),
(3, 'User 2', 'user2@example.com', '0987654321', '456 Another St.', '$2y$12$IreBawGY8wJ2RwsIbXeBPO45gE0E0ZVkGaCA4Y5HSVvyzTeZiNol6', 'Staff', NULL, NULL, NULL),
(4, 'User 3', 'user3@example.com', '1122334455', '789 Third Ave.', '$2y$12$fZ.qqjR6d4IDZiohTpvXfO917Pawe4IwuX9.Ldhv9upiXs1TJfFEq', 'Staff', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_reservation_id_foreign` (`reservation_id`),
  ADD KEY `bills_table_id_foreign` (`table_id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`bill_item_id`),
  ADD KEY `bill_items_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_items_dish_id_foreign` (`dish_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`dish_id`),
  ADD KEY `dishes_cate_id_foreign` (`cate_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_gallery_category_id_foreign` (`gallery_category_id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`);

--
-- Indexes for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `bill_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `dish_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  MODIFY `table_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`),
  ADD CONSTRAINT `bills_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`table_id`),
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `bill_items_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`);

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`cate_id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_gallery_category_id_foreign` FOREIGN KEY (`gallery_category_id`) REFERENCES `gallery_categories` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`table_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
