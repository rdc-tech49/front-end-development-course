-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 12:33 PM
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
CREATE DATABASE IF NOT EXISTS `customers` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `customers`;

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
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`user_id`, `name`, `email`, `password`, `date_of_birth`, `gender`, `designation`, `registration_date`, `remember_token`, `role`) VALUES
(12, 'rdc', 'rdc491994@gmail.com', '$2y$10$ftSBIsuZdSGLKYzqzUgGbuiBdF1TNfTFTXT0iG7yYOPpmD9n6AnlK', '2025-03-01', 'Male', 'Sub-Inspector', '2025-03-10 15:33:52', NULL, 'admin'),
(18, 'asdf', 'asdf@gmail.com', '$2y$10$eI6HyMm8xsMC0LO7RKSFdOptfNCAt8ELezx6/DnhlBYSGbE8MLu6u', '2025-03-01', 'Other', 'Inspector', '2025-03-11 04:34:45', NULL, 'user'),
(19, 'zxc', 'zxc@gmail.com', '$2y$10$7nJGJIRAir7G2yvQInB1AuAe9cT9.LZYc804vN0dvo/mFPc7jJCbu', '2025-03-02', 'Other', 'Inspector', '2025-03-11 12:13:21', NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_complaints`
--

CREATE TABLE `user_complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_number` varchar(100) NOT NULL,
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
(6, 19, 'ZXC19-20250311131401', 'zcv1 23', '9498207763', 'piyoiyo', 'dfghdgfh', 'uploads/complaints/ZXC19-20250311131401.pdf', '2025-03-11 12:14:01', 'hi there this is the response message3', NULL, 'Resolved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_complaints`
--
ALTER TABLE `user_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_complaints`
--
ALTER TABLE `user_complaints`
  ADD CONSTRAINT `user_complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_info` (`user_id`) ON DELETE CASCADE;
--
-- Database: `inventory_management`
--
CREATE DATABASE IF NOT EXISTS `inventory_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventory_management`;

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
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'customers', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"audit_logs\",\"customer_info\",\"login_logs\",\"password_reset_logs\",\"user_complaints\"],\"table_structure[]\":[\"audit_logs\",\"customer_info\",\"login_logs\",\"password_reset_logs\",\"user_complaints\"],\"table_data[]\":[\"audit_logs\",\"customer_info\",\"login_logs\",\"password_reset_logs\",\"user_complaints\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"inventory_management\",\"table\":\"item_supplied\"},{\"db\":\"inventory_management\",\"table\":\"stock_received\"},{\"db\":\"inventory_management\",\"table\":\"users\"},{\"db\":\"inventory_management\",\"table\":\"items_to_be_supplied\"},{\"db\":\"customers\",\"table\":\"customer_info\"},{\"db\":\"inventory_db\",\"table\":\"users\"},{\"db\":\"customers\",\"table\":\"login_logs\"},{\"db\":\"customers\",\"table\":\"audit_logs\"},{\"db\":\"inventory_db\",\"table\":\"items\"},{\"db\":\"customers\",\"table\":\"user_complaints\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'customers', 'audit_logs', '{\"CREATE_TIME\":\"2025-03-13 10:28:36\",\"col_order\":[0,1,2,3,4,5,8,9,6,7],\"col_visib\":[1,1,1,1,1,1,1,1,1,1]}', '2025-03-13 05:31:09'),
('root', 'customers', 'customer_info', '{\"sorted_col\":\"`customer_info`.`date_of_birth` DESC\"}', '2025-03-12 07:16:07'),
('root', 'customers', 'user_complaints', '[]', '2025-03-11 07:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-03-14 04:51:21', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `tnp_it_wings`
--
CREATE DATABASE IF NOT EXISTS `tnp_it_wings` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tnp_it_wings`;

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
