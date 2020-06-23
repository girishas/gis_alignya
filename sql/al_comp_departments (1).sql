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
-- Table structure for table `al_comp_departments`
--

CREATE TABLE `al_comp_departments` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'company id',
  `parent_department_id` int(11) DEFAULT 0 COMMENT '0- root, X - depart id',
  `department_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='organization unit';

--
-- Dumping data for table `al_comp_departments`
--

INSERT INTO `al_comp_departments` (`id`, `company_id`, `parent_department_id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Parent Department', 1, '2020-06-23 16:37:19', '2020-06-23 16:37:19'),
(2, 1, 1, 'sub department', 1, '2020-06-23 16:39:03', '2020-06-23 16:39:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `al_comp_departments`
--
ALTER TABLE `al_comp_departments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `al_comp_departments`
--
ALTER TABLE `al_comp_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
