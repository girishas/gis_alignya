-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 06:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alignya_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `al_department_member`
--

CREATE TABLE `al_department_member` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `is_head` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-head'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `al_department_member`
--

INSERT INTO `al_department_member` (`id`, `member_id`, `department_id`, `is_head`) VALUES
(1, 1, 1, 0),
(2, 5, 1, 0),
(3, 4, 1, 1),
(4, 6, 2, 0),
(5, 4, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `al_department_member`
--
ALTER TABLE `al_department_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `al_department_member`
--
ALTER TABLE `al_department_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
