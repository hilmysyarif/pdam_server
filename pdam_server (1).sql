-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2019 at 08:27 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `category_id`, `content`, `judul`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Pelanggan yang terhormat.. Selamat datang di BUMDES Kertawinangun, Kami harap dengan adanya sistem informasi Pemakaian air menjadikan mutu layanan BUMDES di Kertawinangun bisa membangun kualitas dan layanan untuk seluruh pelanggan', 'Selamat datang di BUMDES Kertawinangun', '2019-01-18 21:53:22', '2019-01-18 21:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Berita', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `bulan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pemakaian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_meteran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `user_id`, `bulan`, `tahun`, `jumlah_pemakaian`, `foto_meteran`, `total_bayar`, `created_at`, `updated_at`) VALUES
(3, 1, '11', '2018', '10', '1120181.png', '3000', '2019-01-15 00:04:14', '2019-01-15 00:04:14'),
(4, 1, '1', '2017', '50', '120171.jpg', '24000', '2019-01-15 03:14:37', '2019-01-15 03:14:37'),
(11, 3, '1', '2019', '66', '120193.jpg', '66000', '2019-01-15 19:44:34', '2019-01-15 19:44:34'),
(12, 4, '1', '2019', '45', '120194.jpg', '45000', '2019-01-15 23:25:52', '2019-01-15 23:25:52'),
(13, 1, '1', '2019', '20', '120191.jpg', '8000', '2019-01-22 00:59:11', '2019-01-22 00:59:11'),
(14, 1, '2', '2019', '30', '220191.jpg', '3000', '2019-01-22 01:00:55', '2019-01-22 01:00:55'),
(15, 1, '3', '2019', '40', '320191.jpg', '3000', '2019-01-22 01:08:19', '2019-01-22 01:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_08_03_114156_create_urls_table', 1),
(9, '2018_09_04_124737_create_permission_tables', 1),
(10, '2018_12_26_190807_add_some_information_into_users_table', 1),
(11, '2019_01_15_190807_create_histories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hilmysyarif@gmail.com', '$2y$10$27CvOkfFszkSyfZHZ/qmRO18gpA9itjITsEQucOIA4czTMhQPbC5i', '2019-01-14 20:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `first_name`, `last_name`, `id_pelanggan`, `alamat`, `no_hp`) VALUES
(1, 'hilmysyarif', 'hilmysyarif@gmail.com', NULL, '$2y$10$pLlWyPf.m24TbaTJY/FjpeN5RqsPFQIM/hZBZX3PlXa2x1R5pnoAe', 'RYD8t4TiHOFG7YuPWzcSKLa5el2IPsy9cc3lNSPulHyI8G9df8PGvIh67HBA', '2019-01-16 03:06:14', '2019-01-17 01:32:33', 'hilmy', 'syarif', '1010101010', 'test', '0895365359636'),
(3, 'pelanggan1', 'pelanggan1@gmail.com', NULL, '$2y$10$0u09255J8obb45Hk0vi.L.TugqdAKHG1SkF5rjiTlhgsV9kYfjMAq', 'mw6l5FersLaxlWdKxz06odWUzASkfB1XAqteUrqFPPJSXzB6EX9BGJxhDSuo', '2019-01-15 19:42:20', '2019-01-22 12:20:11', 'Pelanggan', '1', '1122', 'Dusun Wage RT 002 RW 001 Desa Kertawinangun', '081322664288'),
(4, 'pelangganbaru', 'pelangganbaru@gmail.com', NULL, '$2y$10$oExtbBgs3nPId2lGRWZQDOQhfREJgR5BkwDTazWgKfCWuzjVLiA46', 'drtma5iRBN3zqLEJSFdfNzTyXnw11LuK6E1cXxhGcy0XpBOpl7t3HUEvNNuF', '2019-01-15 23:24:54', '2019-01-22 12:19:10', 'Pelanggan', 'Baru', '1212', 'Dusun Manis Rt 001 Rw 02 Desa Kertawinangun', '082245662344'),
(50, '9999999', '999@999.com', NULL, '$2y$10$pLlWyPf.m24TbaTJY/FjpeN5RqsPFQIM/hZBZX3PlXa2x1R5pnoAe', 'OnPwgR4Peyg7LbM7GVJVNFX7B2Mat3aUD6rQ16qBecPftT8ReOretU6BYIcH', '2019-01-18 22:13:30', '2019-01-22 12:26:08', '9999', '9999', '123456789', 'perumahan pondok aren indah, jl. akasia iii blok b3/6', '9999999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
