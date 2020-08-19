-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8080
-- Generation Time: Aug 19, 2020 at 05:06 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(6, 'Backend', '2020-08-18 18:30:29', '2020-08-18 18:30:29'),
(7, 'Frontend', '2020-08-18 18:30:37', '2020-08-18 18:30:37');

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
(1, '2020_08_17_073216_create_tasks_table', 1),
(2, '2020_08_17_090441_create_users_table', 2),
(4, '2020_08_17_101645_add_field_userid_to_table_tasks', 3),
(5, '2020_08_17_121623_add_soft_delete_to_tasks', 4),
(6, '2020_08_18_113054_create_categories_table', 5),
(7, '2020_08_18_114805_create_statuses_table', 6),
(8, '2020_08_18_144631_add_timestamp_to_categories', 7),
(9, '2020_08_18_144642_add_timestamp_to_statuses', 7);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `Name`, `created_at`, `updated_at`) VALUES
(1, 'Completed', NULL, NULL),
(2, 'Snoozed', NULL, '2020-08-18 15:20:52'),
(4, 'Overdue', '2020-08-18 18:29:45', '2020-08-18 18:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `Dat` date DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `Name`, `Description`, `Dat`, `status_id`, `category_id`, `created_at`, `updated_at`, `user_id`, `deleted_at`) VALUES
(1, 'asdasd2', 'asdsa', '2020-08-18', 1, 1, NULL, '2020-08-18 10:46:04', 1, NULL),
(2, 'TEST', 'asdsa', '2020-08-18', 0, 0, '2020-08-18 11:08:22', '2020-08-18 11:08:22', 1, '2020-08-18 11:27:50'),
(3, 'TEST234', 'sdfsd', '2020-08-18', 2, 0, '2020-08-18 11:08:42', '2020-08-18 11:08:42', 1, NULL),
(4, 'Change GetProducts Api', '', '2020-08-18', 2, 6, '2020-08-18 16:27:34', '2020-08-18 19:16:06', 3, NULL),
(5, 'Create an Api for Filters', 'tests', '2020-08-17', 4, 6, '2020-08-18 16:32:15', '2020-08-18 19:30:38', 3, NULL),
(6, 'Tasks', 'As a user i want filters by category,Status', '2020-08-18', 1, 7, '2020-08-18 16:33:49', '2020-08-18 19:20:35', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `username`, `password`, `Email`, `Mobile`, `Gender`, `Birthday`, `created_at`, `updated_at`) VALUES
(1, 'miled', NULL, 'user', '$2y$10$mlb/37znor26CoO1dNEAMuCemZJh/8c39OqTHq28qi0nFjNhOQF4O', NULL, NULL, NULL, NULL, '2020-08-17 09:22:56', '2020-08-17 09:22:56'),
(2, 'user1', NULL, 'user1', '$2y$10$qCx7y.I0CEIMAf6RUo0anuIkmedrGqAICi3bYGXCrfI.VyO9.iyqy', NULL, NULL, NULL, NULL, '2020-08-17 11:52:28', '2020-08-17 11:52:28'),
(3, 'Miled', 'El Kareh', 'miled', '$2y$10$chQoEvWbidCd.CpHgWVKIeC7LHmDi4vySFlRBJ3YDhCbkA1gx8tQm', 'karehmiled@gmail.com', '+961 70 941 652', 'Male', '2020-08-18', '2020-08-18 16:25:47', '2020-08-18 16:25:47'),
(4, 'miled', NULL, 'user2', '$2y$10$eWWYF6m9sHOsIAU94jaLLOpGmXVERnAufJw3nu/Yh38tBrBFizHbi', NULL, NULL, NULL, NULL, '2020-08-18 22:39:18', '2020-08-18 22:39:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`Name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_name_unique` (`Name`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
