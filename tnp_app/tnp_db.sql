-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 04:55 AM
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
-- Database: `tnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_complients`
--

CREATE TABLE `user_complients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `complaint_title` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `complaint_message` text DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `compliant_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `respond_msg` text DEFAULT NULL,
  `respond_date` date DEFAULT NULL,
  `respond_status` varchar(1) DEFAULT NULL COMMENT 'Y-Yes,\r\nN-NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_complients`
--

INSERT INTO `user_complients` (`id`, `user_id`, `complaint_title`, `mobile_number`, `address`, `complaint_message`, `file_upload`, `compliant_date`, `respond_msg`, `respond_date`, `respond_status`) VALUES
(1, NULL, 'sdfsd', '32452342', 'dsfdfsd', 'dsfdsf', 'Full Stack Development-Training Proposal - Tamilnadu Police-Updated.pdf', '2025-03-10 01:30:59', '', '0000-00-00', ''),
(2, NULL, '', '', '', '', '', '2025-03-10 01:35:08', '', '0000-00-00', ''),
(3, NULL, 'dsfdsf', '686787687', '234324', '4342423423', 'IT78.pdf', '2025-03-10 01:36:06', '', '0000-00-00', ''),
(4, NULL, 'adfas', 'sadsad', 'sdsasa', 'sadsa', 'Full Stack Development-Training Proposal - Tamilnadu Police-Updated.pdf', '2025-03-10 02:17:52', NULL, NULL, NULL),
(5, NULL, 'dadas', 'fsdfds', 'dsfsdf', 'sdfsfew', '3', '2025-03-10 02:23:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `email`, `password`, `dob`, `gender`, `reg_date`) VALUES
(1, 'test', 'test@gmail.com', 'test', '2025-03-10', 'male', '2025-03-09 11:33:05'),
(2, 'sakthi', 'sakthiguru@nielitchennai.edu.in', '123', '2025-03-09', 'male', '2025-03-09 12:06:39'),
(3, 'new', 'new@gmail.com', '123', '2025-03-10', 'male', '2025-03-09 12:09:21'),
(10, 'name1', 'harishankar@nielitchennai.edu.in', '123', '2025-03-10', 'male', '2025-03-09 14:28:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_complients`
--
ALTER TABLE `user_complients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_complients`
--
ALTER TABLE `user_complients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
