-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 04:24 PM
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
  `description` text NOT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `date`, `time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(9, 7, '2024-12-04', '11:21:00', 'checkup', 'Completed', '2024-12-01 15:20:28', '2024-12-01 16:06:32'),
(11, 7, '2024-12-12', '15:15:00', 'sadsadasdasdas', 'Pending', '2024-12-01 16:12:52', '2024-12-01 16:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int UNSIGNED NOT NULL,
  `medication_name` varchar(255) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `reset_token`, `created_on`) VALUES
(1, 'glenvicta@gmail.com', 'F8PNBr9q6o', '2024-12-01 20:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Male',
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `dob`, `gender`, `contact_number`, `email`, `address`) VALUES
(1, 'User', 'Admin', '1999-01-01', 'Male', '1234567890', 'useradmin@example.com', '69 Street');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int UNSIGNED NOT NULL,
  `patient_id` int UNSIGNED DEFAULT NULL,
  `medication` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `renewal_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `medication`, `dosage`, `duration`, `renewal_date`, `created_at`) VALUES
(3, 1, 'SALBUTAMOL', '5', '69 DAYS', '2024-12-31', '2024-12-01 15:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_inventory_link`
--

CREATE TABLE `prescription_inventory_link` (
  `prescription_id` int UNSIGNED NOT NULL,
  `inventory_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int NOT NULL,
  `user_id` int NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `session_data` varchar(70) NOT NULL,
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
(19, 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '::1', '6fe96705e524103db7320e0648eec4236309b783e4d0e49672b9e952db2c7d34', '2024-12-02 00:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_token` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `google_oauth_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_token`, `email_verified_at`, `password`, `remember_token`, `google_oauth_id`, `created_at`, `updated_at`) VALUES
(7, 'admin', 'admin@gmail.com', '6504eca908d30287583e39d3db8a78c891e36e92df431cdcc76bd385b16a9c4e8f41c77a473521594fadb6fc134b2f5c8216', NULL, '$2y$04$J9GMGAAepT7PsZM1e5oI1.Adzok2PbaDnpIKnQtZbVQO2TLE.raNS', NULL, NULL, '2024-12-01 12:18:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_ibfk_1` (`patient_id`);

--
-- Indexes for table `prescription_inventory_link`
--
ALTER TABLE `prescription_inventory_link`
  ADD PRIMARY KEY (`prescription_id`,`inventory_id`),
  ADD KEY `inventory_id` (`inventory_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_inventory_link`
--
ALTER TABLE `prescription_inventory_link`
  ADD CONSTRAINT `prescription_inventory_link_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_inventory_link_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
