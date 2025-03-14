-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 12:32 PM
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
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `items_to_be_supplied`
--

CREATE TABLE `items_to_be_supplied` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `items_purchased_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_to_be_supplied`
--

INSERT INTO `items_to_be_supplied` (`id`, `item_name`, `item_model`, `quantity`, `items_purchased_date`) VALUES
(1, 'Mobile', 'nokia', 2, '2025-03-01'),
(2, 'Tablet', 'apple', 5, '2025-03-02'),
(3, 'Computer', 'Dell', 10, '2025-03-01'),
(5, 'Ram', 'samsung', 0, '2025-03-01'),
(6, 'Motherboard', 'msi', 3, '2025-03-13'),
(7, 'mouse', 'samsung', 15, '2025-03-14'),
(8, 'DSLR camera', 'nikon', 20, '2025-03-01'),
(9, 'Mobile', 'samsung', 10, '2025-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `item_supplied`
--

CREATE TABLE `item_supplied` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplied_date` date NOT NULL,
  `supplied_to` varchar(255) NOT NULL,
  `received_person_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_supplied`
--

INSERT INTO `item_supplied` (`id`, `item_name`, `item_model`, `quantity`, `supplied_date`, `supplied_to`, `received_person_name`) VALUES
(1, 'Mobile', 'nokia', 3, '2025-03-14', 'chennai', 'chennai01'),
(5, 'Mobile', 'nokia', 3, '2025-03-13', 'chennai', 'chennai02'),
(6, 'Mobile', 'nokia', 3, '2025-03-13', 'chennai', 'chennai02'),
(7, 'Computer', 'Dell', 10, '2025-03-14', 'chennai', 'chennai01'),
(8, 'Ram', 'samsung', 2, '2025-03-14', 'trichy', 'trichy si'),
(9, 'Ram', 'samsung', 3, '2025-03-14', 'madurai', 'maduraisi'),
(10, 'Mobile', 'nokia', 5, '2025-03-14', 'madurai', 'maduraisi');

-- --------------------------------------------------------

--
-- Table structure for table `stock_received`
--

CREATE TABLE `stock_received` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_description` text DEFAULT NULL,
  `purchased_date` date NOT NULL,
  `purchase_order_number` varchar(50) DEFAULT NULL,
  `vendor_details` varchar(255) DEFAULT NULL,
  `warranty_expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_received`
--

INSERT INTO `stock_received` (`id`, `item_name`, `item_model`, `item_quantity`, `item_description`, `purchased_date`, `purchase_order_number`, `vendor_details`, `warranty_expiry_date`) VALUES
(5, 'Mobile', 'nokia', 13, '', '2025-03-01', '', '', '0000-00-00'),
(6, 'Tablet', 'apple', 5, '', '2025-03-02', '', '', '0000-00-00'),
(7, 'Computer', 'Dell', 20, '', '2025-03-01', '', '', '0000-00-00'),
(9, 'Ram', 'samsung', 5, '', '2025-03-01', 'ram01', '', '0000-00-00'),
(10, 'Motherboard', 'msi', 3, '', '2025-03-13', '', '', '0000-00-00'),
(11, 'mouse', 'samsung', 15, '', '2025-03-14', '', '', '0000-00-00'),
(12, 'DSLR camera', 'nikon', 20, '', '2025-03-01', '', '', '0000-00-00'),
(13, 'Mobile', 'samsung', 10, '', '2025-03-01', '', '', '0000-00-00');

--
-- Triggers `stock_received`
--
DELIMITER $$
CREATE TRIGGER `after_stock_delete` AFTER DELETE ON `stock_received` FOR EACH ROW BEGIN
    DELETE FROM items_to_be_supplied
    WHERE item_name = OLD.item_name AND item_model = OLD.item_model;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stock_insert` AFTER INSERT ON `stock_received` FOR EACH ROW BEGIN
    INSERT INTO items_to_be_supplied (item_name, item_model, quantity, items_purchased_date)
    VALUES (NEW.item_name, NEW.item_model, NEW.item_quantity, NEW.purchased_date);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stock_update` AFTER UPDATE ON `stock_received` FOR EACH ROW BEGIN
    UPDATE items_to_be_supplied
    SET item_name = NEW.item_name,
        item_model = NEW.item_model,
        quantity = NEW.item_quantity,
        items_purchased_date = NEW.purchased_date
    WHERE item_name = OLD.item_name AND item_model = OLD.item_model;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'rdc', 'rdc491994@gmail.com', '$2y$10$JKRKC4QVZlM3a6qpn5v9fOweNpCyqujXpYw66irimrAU/7wmEXtL2', 'admin'),
(2, 'chennai', 'chennai@g.com', '$2y$10$TYgFTXMTikWolqevQ4lcVO1bKnkdF.JiMwy4n83TDQICpcuo5gFQW', 'user'),
(3, 'trichy', 'trighy@g.com', '$2y$10$a/vibIzqZ0h3E8SO.GohCeBhluik7TKswLWccwFYqblCHqahqfrOG', 'user'),
(4, 'madurai', 'madurai@gmail.com', '$2y$10$b9iSClXDkwPZChgr/OPEq.LqVEqZ88JDWwY2GCE9KKRJ0JhkxF7MW', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items_to_be_supplied`
--
ALTER TABLE `items_to_be_supplied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplied`
--
ALTER TABLE `item_supplied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_received`
--
ALTER TABLE `stock_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items_to_be_supplied`
--
ALTER TABLE `items_to_be_supplied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_supplied`
--
ALTER TABLE `item_supplied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_received`
--
ALTER TABLE `stock_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
