-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 02:56 PM
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
-- Database: `fickrr`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `addon_id` int(11) NOT NULL,
  `addon_name` varchar(191) DEFAULT NULL,
  `addon_slug` varchar(191) DEFAULT NULL,
  `addon_image` varchar(191) DEFAULT NULL,
  `addon_version` varchar(10) DEFAULT NULL,
  `addon_dir` varchar(191) DEFAULT NULL,
  `addon_envato_id` varchar(50) DEFAULT NULL,
  `addon_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`addon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `addon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
