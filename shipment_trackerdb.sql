-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 01:35 PM
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
-- Database: `shipment_trackerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(12, 'dsfds', 'abdhulhaadhi123@gmail.com', 'helllloooo', 'ffgjghkjk', '2025-04-23 07:11:51'),
(16, 'sgdfgdfh', 'adfsdf@fdgf.srgf', 'sfgdfhdghgf', 'dsfsdgfdg', '2025-04-24 20:30:21'),
(17, 'fbgnhmn', 'sfgdfg@gg.df', 'sdfgsdg', 'fgdfghdghfgh', '2025-04-24 20:31:25'),
(19, 'Abdhul Haadhi', 'abdhulhaadhi123@gmail.com', 'welcom', 'Welcome message ', '2025-04-25 09:20:41'),
(20, 'Haadhi', 'abdhulhaadhi33@gmail.com', 'helllloooo', 'Hellooo world\r\n', '2025-04-25 10:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(20) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `sender_address` text NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_address` text NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `tracking_number`, `sender_name`, `sender_address`, `recipient_name`, `recipient_address`, `weight`, `status`, `created_at`, `updated_at`) VALUES
(8, 'ser123433545', 'john', 'john address', 'Haadhi', 'rose address', 100.00, 'in_transit', '2025-04-24 20:23:01', '2025-04-24 20:23:01'),
(10, 'er344354656', 'tytytytyty', 'tytytyty', 'tytytyty', 'tytytyt', 120.00, 'outForDelevery', '2025-04-24 20:25:44', '2025-04-25 09:25:21'),
(12, '555555555555', 'dcvxcxvb', 'xvxfbcvn', 'xvxvxcvsfg', 'xcbxvbvcb1000', 1000.00, 'delayed', '2025-04-24 20:38:30', '2025-04-24 20:38:30'),
(13, 'lk123456789', 'Abdhul Haadhi', '318/c, Waragashinna, Akurana', 'Haadhi', 'haadhi address', 2000.00, 'created', '2025-04-25 09:23:46', '2025-04-25 09:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '325a2cc052914ceeb8c19016c091d2ac', 'admin', '2025-04-21 14:58:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
