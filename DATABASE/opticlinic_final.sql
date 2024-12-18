-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2024 at 01:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opticlinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `date`, `time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(12, 8, '2024-12-04', '13:17:00', 'sadfsadf', 'Pending', '2024-12-17 14:18:08', '2024-12-18 03:11:57'),
(14, 9, '2024-12-11', '22:24:00', 'asdfasdf', 'Confirmed', '2024-12-17 14:20:38', '2024-12-18 03:12:02'),
(15, 8, '2024-12-19', '13:20:00', 'sadfasd', 'Completed', '2024-12-17 14:20:52', '2024-12-18 03:12:07'),
(17, 10, '2024-12-20', '22:49:00', 'Daniel Buhay', 'Completed', '2024-12-17 14:46:28', '2024-12-17 15:38:09'),
(28, 10, '2025-01-02', '11:08:00', 'Daniel', 'Pending', '2024-12-18 03:05:48', '2024-12-18 03:05:48'),
(29, 11, '2024-12-27', '11:13:00', 'Da', 'Pending', '2024-12-18 03:10:23', '2024-12-18 03:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int UNSIGNED NOT NULL,
  `medication_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stock_quantity` int UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `medication_name`, `stock_quantity`, `price`, `last_updated`) VALUES
(1, 'Medication A', 100, 20.50, '2024-12-01 15:06:44'),
(2, 'Medication B', 50, 35.00, '2024-12-01 15:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_token` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `reset_token`, `created_on`) VALUES
(1, 'glenvicta@gmail.com', 'F8PNBr9q6o', '2024-12-01 20:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `medication` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dosage` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `checkup_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `medication`, `dosage`, `duration`, `checkup_date`, `created_at`) VALUES
(1, 10, 'Amoxicillin', '500mg', '7 days', '2024-12-25', '2024-12-18 02:00:00'),
(2, 10, 'Ibuprofen', '200mg', '5 days', '2024-12-22', '2024-12-17 01:30:00'),
(3, 10, 'Paracetamol', '500mg', '3 days', '2024-12-20', '2024-12-16 07:45:00'),
(4, 10, 'Loratadine', '10mg', '10 days', '2024-12-28', '2024-12-15 03:00:00'),
(5, 10, 'Cetirizine', '10mg', '14 days', '2025-01-01', '2024-12-14 00:15:00'),
(6, 10, 'Metformin', '500mg', '30 days', '2025-01-18', '2024-12-13 04:00:00'),
(7, 10, 'Azithromycin', '250mg', '5 days', '2024-12-23', '2024-12-12 02:20:00'),
(8, 10, 'Simvastatin', '40mg', '7 days', '2024-12-26', '2024-12-11 06:30:00'),
(9, 10, 'Amlodipine', '5mg', '15 days', '2025-01-02', '2024-12-10 05:40:00'),
(10, 10, 'Prednisone', '20mg', '10 days', '2024-12-30', '2024-12-09 08:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int NOT NULL,
  `user_id` int NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `session_data` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `browser`, `ip`, `session_data`, `created_at`) VALUES
(1, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'c34399a137d93acbdfe1e30d9bd37bbdfb82649e2d94245e9357a55d96552aeb', '2024-12-01 19:48:59'),
(2, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'a4dabef0a0011b6a77780d726a974b9157a3dd33b802a963a776473dea366ae0', '2024-12-01 19:56:09'),
(3, 3, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '1f290467be6570e48467df2876e0cf5b81176f5269bc44ed73639944ecc07ad5', '2024-12-01 19:57:03'),
(4, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'ae7220821dc74abc78b75e833215c81cd48843928daeb78ccb462179d59fe5f4', '2024-12-01 19:58:42'),
(5, 5, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '624a59dc1cc5e51380fe5ccc2dc02b1ae643d50d72dd24440f9c3a4f9e512e35', '2024-12-01 20:03:05'),
(6, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'a7eb01105aea115acac93b8399fe24160c8f355dca94217ba4068c8f6b8eeaa1', '2024-12-01 20:18:59'),
(7, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '2fb83f57a52d276b6e1d75127e0b1c19bb1354a969ca47915fb810e21331ddb7', '2024-12-01 22:22:29'),
(8, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '49aa5f86ac591a6490f0a5aae78f427e68cec76ab09e82cdd94d5b69ee088350', '2024-12-01 22:22:36'),
(9, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '51772a95775f6efe7db87cf798cdef0b11a3bf7d89456848903597f38de56d57', '2024-12-01 22:24:44'),
(10, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '81094256e3f06f2f3f65ebd333eed95801543417259b72e4d82fd6c2b83f392b', '2024-12-01 22:28:07'),
(11, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '176fddc16f4e55fb8cd487e5ee35b7bc4719a27aec0b07494d995189612a209c', '2024-12-01 22:33:23'),
(12, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '7c8dad6155dee732a17edc5904490f5a274f8ceb61198a5b67084cf8221598b4', '2024-12-01 22:38:15'),
(13, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'cb6aca8300c24b68aaf0a7617eec4d1a69b6956626903dd3af88ab394e5d73ee', '2024-12-01 22:38:25'),
(14, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '344ffaf5b91a73d5dda03f818eef3c98699faf6317f89bf1a7f905ec55231071', '2024-12-01 22:39:10'),
(15, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'ca2418f31fa2f8ab68459c9aa96ea5af764adde076c246ac86dca32d8678db60', '2024-12-01 22:45:20'),
(16, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '782e5a437422e4a219d5fcbb6ea60a65a20ec6fab4309c9d2e6bcf893dbc6ad0', '2024-12-01 22:45:29'),
(17, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '642ac73d2130df103e979aaf49e6be8fae74e000241cec86081c29bd5d679746', '2024-12-01 22:56:57'),
(18, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '5be285cf974cb96b4b773a225e24eab5981ffe0d772948164407b0da2ccf710f', '2024-12-01 22:57:07'),
(19, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '6fe96705e524103db7320e0648eec4236309b783e4d0e49672b9e952db2c7d34', '2024-12-02 00:21:07'),
(20, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '99ca5fd2c0da0b400511169072aa36c1ae79b1bb07ed766bb7333b2a23c8bf67', '2024-12-17 22:26:54'),
(21, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '9b5f513b0b870a055f35e06b018dfa5bed044baa98565011369c0ba5ba0e1de1', '2024-12-17 22:27:02'),
(22, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '9b255118a10c119fa33b192431f4d614390fbe6093fa0b560e166ab572a9c456', '2024-12-18 01:31:37'),
(23, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '24b7f03a5b5c5c7807de791a6b6097cbfbefc11c0978bdc20101b36ec0ed7717', '2024-12-18 01:32:20'),
(24, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'a28e360519e393a7b67e772064b1a7f7d578b410871e79b310c1367c8f83fba3', '2024-12-18 01:33:26'),
(25, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '56fa11de8a8579f7b75e408339d2243022905f0af338a9d4e18892fd3e12e7c8', '2024-12-18 01:36:39'),
(26, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '9ca767a6e566d408ab51a11688a95a0d6dc2f69270b07b2059d3388852221d3f', '2024-12-18 01:58:15'),
(27, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '5787f5a4f70bf75e8a1480b209d55ba13147a14d4bf820eda09e963156db433a', '2024-12-18 02:01:25'),
(28, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '1424fca7c3864d12d2daeab6ea2c0e25bd0fdb555522f9b40fcb331790becab6', '2024-12-18 02:07:22'),
(29, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '17dcbb309b07b88ec60822a5745ef3ac0152307e9c6e793169d27e59b5a61757', '2024-12-18 02:08:28'),
(30, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'bef9272a2408f61309b62fa114e0dac3a1d8fbb7391c44658689c641cae045d3', '2024-12-18 02:08:42'),
(31, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'c7b11e14cc8b176938e0a48291e5d6b20cd591227d65c063c0c7d3f803e0109e', '2024-12-18 02:09:20'),
(32, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '3d795db8e1b9a8e52d77d2d7d664b61e4d5917dcb3fbd0934ecbc68e39ce966e', '2024-12-18 02:09:51'),
(33, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '02f56f7abfada00a95189942d83d6044a989e36e03d08a9969160396e6145551', '2024-12-18 11:03:39'),
(34, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'f268c32e2b0d0913c101f48bc865ed7ba9312ade5281c608c92c2326a618291c', '2024-12-18 11:05:19'),
(35, 11, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', 'af4d96e7a8456fc76904742c1cb14ea4d9acb05777b3efb7f67a0f7ec757e37b', '2024-12-18 11:09:17'),
(36, 11, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '7d4f9f5a05ad1df8ada5cec46bb87054cda76fb0543e5b7c9fb3ed4ebed51778', '2024-12-18 11:09:27'),
(37, 10, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '8d258c1d509aed7eef7f390e0462382dfacc503d48d1814b5fa1022eeaeccf5a', '2024-12-18 11:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'patient',
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_oauth_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `email_token`, `email_verified_at`, `password`, `role`, `remember_token`, `google_oauth_id`, `created_at`, `updated_at`, `first_name`, `last_name`, `dob`, `gender`, `contact_number`, `address`) VALUES
(8, 'magboo.ariston@minsu.edu.ph', '', '', NULL, '', 'patient', NULL, NULL, '2024-12-17 12:01:57', NULL, 'Ariston', 'Magboo', '2024-12-06', 'Male', '09954933015', '#011 CUBI ST. BRGY. STO. NINO CALAPAN CITY ORIENTAL MINDORO'),
(9, 'dasd', '', '', NULL, '', 'patient', NULL, NULL, '2024-12-17 12:04:40', '2024-12-17 14:26:12', 'Ariston1', 'Magboo', '2024-12-21', 'Male', '09954933015', '#011 CUBI ST. BRGY. STO. NINO CALAPAN CITY ORIENTAL MINDORO'),
(10, 'admin@gmail.com', 'admin', '50f054c29ef37bc5fe76b8c9336fa64ea10759bc1d986f46f34726d56ef207442f55f58df00aea30781e4c8fa0f23c475227', NULL, '$2y$04$yVKdoz8YtSBTopIjGvwzfumHYZVipqfiMNhG1v06wOS3qVONuRhvO', 'admin', NULL, NULL, '2024-12-17 14:26:54', '2024-12-18 03:10:43', 'Project23', 'Project34', '2024-12-13', 'Male', '09124943749', 'Baco'),
(11, 'johndanielcruz100554@gmail.com', 'daniel0044555', 'e137dc266914f0aa9a5ae81f28f0bc7c9988fcd00ac1fcf240d9550ddb46d52f432ad255ad753123fac372fc8cb5d116e0f2', NULL, '$2y$04$95c80Gz0WJwSGp13Po68YO5/cRwqqYKPCYVgsnGJKgEzNtWSqpZby', 'patient', NULL, NULL, '2024-12-18 03:09:17', '2024-12-18 03:10:04', 'John Daniel', 'Cruz', '2025-01-03', 'Male', '09124943747', 'MACIPIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usersss` (`user_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_usersss` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
