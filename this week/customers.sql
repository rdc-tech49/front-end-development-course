-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 05:45 AM
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
-- Database: `customers`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` enum('login','password_reset') NOT NULL,
  `action_status` enum('success','failure') NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action_type`, `action_status`, `ip_address`, `user_agent`, `timestamp`, `logout_time`, `latitude`, `longitude`) VALUES
(1, NULL, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:06:35', NULL, NULL, NULL),
(2, NULL, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:06:57', NULL, NULL, NULL),
(3, NULL, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:07:04', NULL, NULL, NULL),
(4, NULL, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:07:31', NULL, NULL, NULL),
(5, 20, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:16:03', NULL, NULL, NULL),
(6, 18, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:16:09', NULL, NULL, NULL),
(7, 19, 'login', 'failure', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:19:11', '2025-03-12 11:31:48', NULL, NULL),
(8, 20, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:31:52', '2025-03-12 11:31:59', NULL, NULL),
(9, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:32:03', '2025-03-12 11:32:05', NULL, NULL),
(10, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:32:09', '2025-03-12 11:32:10', NULL, NULL),
(11, NULL, 'login', 'failure', NULL, NULL, '2025-03-12 11:32:19', NULL, NULL, NULL),
(12, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:32:24', '2025-03-12 11:32:25', NULL, NULL),
(13, NULL, 'login', 'failure', NULL, NULL, '2025-03-12 11:32:31', NULL, NULL, NULL),
(14, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:32:36', '2025-03-12 11:34:10', NULL, NULL),
(15, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:34:16', '2025-03-12 11:34:41', NULL, NULL),
(16, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:34:16', NULL, NULL, NULL),
(17, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:34:46', '2025-03-12 11:34:48', NULL, NULL),
(18, 20, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:35:02', '2025-03-12 11:36:05', NULL, NULL),
(19, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:37:04', '2025-03-12 11:37:27', NULL, NULL),
(20, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-12 11:38:15', NULL, NULL, NULL),
(21, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 04:56:12', '2025-03-13 05:22:20', NULL, NULL),
(22, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:29:19', '2025-03-13 05:29:21', NULL, NULL),
(23, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:29:29', '2025-03-13 05:29:30', NULL, NULL),
(24, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:36:38', '2025-03-13 05:36:40', NULL, NULL),
(25, NULL, 'login', 'failure', NULL, NULL, '2025-03-13 05:36:44', NULL, NULL, NULL),
(26, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:36:48', '2025-03-13 05:38:14', NULL, NULL),
(27, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:38:19', '2025-03-13 05:38:20', NULL, NULL),
(28, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:38:41', '2025-03-13 05:38:44', NULL, NULL),
(29, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:38:48', '2025-03-13 05:38:49', NULL, NULL),
(30, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:39:11', '2025-03-13 05:39:12', NULL, NULL),
(31, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:39:15', '2025-03-13 05:39:16', NULL, NULL),
(32, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:40:27', '2025-03-13 05:40:28', NULL, NULL),
(33, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:40:32', NULL, NULL, NULL),
(34, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:41:07', '2025-03-13 05:51:47', NULL, NULL),
(35, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36', '2025-03-13 05:55:23', '2025-03-13 05:55:25', '', ''),
(36, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:55:30', '2025-03-13 05:55:31', '', ''),
(37, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:59:01', NULL, '', ''),
(38, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:59:45', NULL, '', ''),
(39, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:12:28', '2025-03-13 06:12:31', '', ''),
(40, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:12:36', '2025-03-13 06:12:42', '', ''),
(41, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:13:30', NULL, '', ''),
(42, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:15:03', '2025-03-13 06:15:05', '', ''),
(43, NULL, 'login', 'failure', NULL, NULL, '2025-03-13 06:15:09', NULL, NULL, NULL),
(44, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:15:13', '2025-03-13 06:18:40', '', ''),
(45, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:18:43', '2025-03-13 06:18:45', '', ''),
(46, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 06:18:51', '2025-03-13 06:18:53', '', ''),
(47, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:20:25', '2025-03-13 06:20:28', '13.013', '80.2395'),
(48, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:20:42', '2025-03-13 06:20:45', '13.013', '80.2395'),
(49, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:24:30', '2025-03-13 06:29:01', '13.013', '80.2395'),
(50, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:29:09', '2025-03-13 06:29:14', '13.013', '80.2395'),
(51, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:29:18', '2025-03-13 06:31:27', '13.013', '80.2395'),
(52, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:31:31', '2025-03-13 06:31:32', '13.013', '80.2395'),
(53, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:31:40', '2025-03-13 06:52:26', '13.013', '80.2395'),
(54, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:52:32', '2025-03-13 06:52:35', '13.013', '80.2395'),
(55, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:52:38', '2025-03-13 06:53:55', '13.013', '80.2395'),
(56, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 06:54:25', '2025-03-13 07:04:55', '13.013', '80.2395'),
(57, 18, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 07:04:59', '2025-03-13 07:05:01', '13.013', '80.2395'),
(58, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 07:05:25', '2025-03-13 07:09:02', '13.013', '80.2395'),
(59, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 07:09:06', '2025-03-13 07:09:11', '13.013', '80.2395'),
(60, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 07:53:21', '2025-03-13 07:53:41', '13.013', '80.2395'),
(61, 19, 'login', 'success', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-13 07:54:09', NULL, '13.013', '80.2395');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(64) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`user_id`, `name`, `email`, `password`, `date_of_birth`, `gender`, `designation`, `registration_date`, `remember_token`, `role`, `reset_token`, `reset_expires`) VALUES
(10, 'sdfasdf', 'trjtuktyuk@gmail.com', '$2y$10$5wsUiSHuSDobaniPerPZn.83Fi8gL4yN.WMnuptgYotAVfJvmf10u', '2025-03-01', 'Male', 'Inspector', '2025-03-10 15:00:05', NULL, 'user', NULL, NULL),
(18, 'asdf', 'asdf@gmail.com', '$2y$10$eI6HyMm8xsMC0LO7RKSFdOptfNCAt8ELezx6/DnhlBYSGbE8MLu6u', '2025-03-01', 'Other', 'Inspector', '2025-03-11 04:34:45', NULL, 'user', 'df75fb807b34521438a3293dd01cb2995fd726e66b156fabbdc438c31cd4ea9f15788e0dbfc3e46d658381a3eaa20df29525', '2025-03-13 20:15:29'),
(19, 'rdc', 'rdc491994@gmail.com', '$2y$10$wceMYjzC3/RjrwieyDkGjeBQ9pTS73piNRHgtgk5OFQqsdsp2atEa', '2025-03-01', 'Male', 'Sub-Inspector', '2025-03-11 05:53:56', NULL, 'admin', 'cf160654fc52ef23ed8a0d2e61d1ff45ab47a8809b4c0d3d274128b2292d4812be0bd102f852343e6bc7dc1487fa88389543', '2025-03-13 20:17:26'),
(20, 'zxcv', 'zxcv@gmail.com', '$2y$10$luva1QnrC7U0en9O2PgLk.Cb8rzav3VV68pYuGx9nee.biWSHMa3e', '2025-03-02', 'Female', 'Sub-Inspector', '2025-03-12 10:49:03', NULL, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `login_time`, `ip_address`, `user_agent`) VALUES
(1, 18, '2025-03-12 16:18:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(2, 20, '2025-03-12 16:19:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(3, 19, '2025-03-12 16:20:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(4, 18, '2025-03-12 16:36:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(5, 20, '2025-03-12 16:36:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(6, 19, '2025-03-12 16:37:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(7, 19, '2025-03-12 16:37:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(8, 20, '2025-03-12 16:46:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(9, 18, '2025-03-12 16:46:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(10, 19, '2025-03-12 16:49:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(11, 20, '2025-03-12 17:01:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(12, 18, '2025-03-12 17:02:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(13, 19, '2025-03-12 17:02:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(14, 18, '2025-03-12 17:02:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(15, 19, '2025-03-12 17:02:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(16, 19, '2025-03-12 17:04:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(17, 19, '2025-03-12 17:04:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(18, 18, '2025-03-12 17:04:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(19, 20, '2025-03-12 17:05:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(20, 19, '2025-03-12 17:07:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(21, 19, '2025-03-12 17:08:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(22, 19, '2025-03-13 10:26:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(23, 19, '2025-03-13 10:59:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(24, 18, '2025-03-13 10:59:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(25, 19, '2025-03-13 11:06:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(26, 18, '2025-03-13 11:06:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(27, 18, '2025-03-13 11:08:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(28, 19, '2025-03-13 11:08:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(29, 18, '2025-03-13 11:08:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(30, 19, '2025-03-13 11:09:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(31, 18, '2025-03-13 11:09:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(32, 19, '2025-03-13 11:10:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(33, 18, '2025-03-13 11:10:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(34, 19, '2025-03-13 11:11:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(35, 18, '2025-03-13 11:25:23', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36'),
(36, 19, '2025-03-13 11:25:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(37, 18, '2025-03-13 11:29:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(38, 18, '2025-03-13 11:29:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(39, 19, '2025-03-13 11:42:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(40, 18, '2025-03-13 11:42:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(41, 19, '2025-03-13 11:43:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(42, 18, '2025-03-13 11:45:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(43, 19, '2025-03-13 11:45:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(44, 18, '2025-03-13 11:48:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(45, 19, '2025-03-13 11:48:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
(46, 19, '2025-03-13 11:50:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(47, 18, '2025-03-13 11:50:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(48, 19, '2025-03-13 11:54:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(49, 18, '2025-03-13 11:59:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(50, 19, '2025-03-13 11:59:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(51, 18, '2025-03-13 12:01:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(52, 19, '2025-03-13 12:01:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(53, 18, '2025-03-13 12:22:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(54, 19, '2025-03-13 12:22:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(55, 19, '2025-03-13 12:24:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(56, 18, '2025-03-13 12:34:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(57, 19, '2025-03-13 12:35:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(58, 19, '2025-03-13 12:39:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(59, 19, '2025-03-13 13:23:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
(60, 19, '2025-03-13 13:24:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_logs`
--

CREATE TABLE `password_reset_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reset_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_logs`
--

INSERT INTO `password_reset_logs` (`id`, `user_id`, `reset_time`) VALUES
(1, 19, '2025-03-12 16:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_complaints`
--

CREATE TABLE `user_complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_number` varchar(50) NOT NULL,
  `complaint_title` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `complaint_message` text NOT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `respond_msg` text DEFAULT NULL,
  `respond_date` timestamp NULL DEFAULT NULL,
  `respond_status` enum('Pending','In Progress','Resolved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_complaints`
--

INSERT INTO `user_complaints` (`id`, `user_id`, `complaint_number`, `complaint_title`, `mobile_number`, `address`, `complaint_message`, `file_upload`, `complaint_date`, `respond_msg`, `respond_date`, `respond_status`) VALUES
(2, 18, 'ASD18-20250311130623', 'cno 2', '9498207763', 'asdfasg', 'bagrwg', 'uploads/complaints/ASD18-20250311130623.pdf', '2025-03-11 12:06:23', 'hi there this is the response message1\r\n', NULL, 'In Progress'),
(3, 18, 'ASD18-20250311131045', 'cno 3', '9498207763', 'sgbeb', 'erewerg', NULL, '2025-03-11 12:10:45', NULL, NULL, 'Pending'),
(4, 18, 'ASD18-20250311131106', 'cno 4', 'asd', 'asdafsbet', 'tnetneteneerg', 'uploads/complaints/ASD18-20250311131106.pdf', '2025-03-11 12:11:06', 'hi there this is the response message2', NULL, 'In Progress'),
(5, 19, 'ZXC19-20250311131347', 'zcv1 11', '9498207763', 'snnytyhnm', 'my,yi,yujyj', NULL, '2025-03-11 12:13:47', '', NULL, 'In Progress'),
(6, 19, 'ZXC19-20250311131401', 'zcv1 23', '9498207763', 'piyoiyo', 'dfghdgfh', 'uploads/complaints/ZXC19-20250311131401.pdf', '2025-03-11 12:14:01', 'hi there this is the response message3', NULL, 'Resolved'),
(10, 19, 'RDC19-20250311103234', 'test complaint 2', '94982077632', 'asdfadhfnns', '2', 'uploads/complaints/RDC19-20250311103234.pdf', '2025-03-11 09:32:34', NULL, NULL, 'Pending'),
(11, 19, 'RDC19-20250311103319', 'test complaint 3', '9498207763', '3', '3', 'uploads/complaints/RDC19-20250311103319.pdf', '2025-03-11 09:33:19', NULL, NULL, 'Pending'),
(12, 19, 'RDC19-20250311103404', 'test complaint 1', '94982077632asdf', 'sadf', 'asfdasdf', 'uploads/complaints/RDC19-20250311103404.pdf', '2025-03-11 09:34:04', NULL, NULL, 'Pending'),
(13, 19, 'RDC19-20250311103740', 'test complaint 4', '9498207763', '4', '4', 'uploads/complaints/RDC19-20250311103740.pdf', '2025-03-11 09:37:40', NULL, NULL, 'Pending'),
(14, 19, 'RDC19-20250311103826', 'test complaint 4', '9498207763', '4', '4', 'uploads/complaints/RDC19-20250311103826.pdf', '2025-03-11 09:38:26', NULL, NULL, 'Pending'),
(15, 19, 'RDC19-20250311103934', 'sadasfsd', 'fasfdsadf', 'safdasf', 'sadfsaf', 'uploads/complaints/RDC19-20250311103934.pdf', '2025-03-11 09:39:34', NULL, NULL, 'Pending'),
(16, 19, 'RDC19-20250311104005', 'test complaint 3', '9498207763', 'asdfsadg', 'aghags', 'uploads/complaints/RDC19-20250311104005.pdf', '2025-03-11 09:40:05', NULL, NULL, 'Pending'),
(17, 18, 'ASD18-20250312084809', 'test complaint 1', '9498207763', 'dggh', 'complaint today', 'uploads/complaints/ASD18-20250312084809.pdf', '2025-03-12 07:48:09', 'sent to adgp', NULL, 'In Progress'),
(18, 18, 'ASD18-20250312114844', 'asd', 'asdf', 'afgh', 'shsh', NULL, '2025-03-12 10:48:44', NULL, NULL, 'Pending'),
(19, 20, 'ZXC20-20250312114929', 'test complaint 3', '9498207763', 'gfnfgtf', 'djfrttrujdj', 'uploads/complaints/ZXC20-20250312114929.pdf', '2025-03-12 10:49:29', NULL, NULL, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_logs`
--
ALTER TABLE `password_reset_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_complaints`
--
ALTER TABLE `user_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `password_reset_logs`
--
ALTER TABLE `password_reset_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_complaints`
--
ALTER TABLE `user_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_info` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_info` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_logs`
--
ALTER TABLE `password_reset_logs`
  ADD CONSTRAINT `password_reset_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_info` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_complaints`
--
ALTER TABLE `user_complaints`
  ADD CONSTRAINT `user_complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_info` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
