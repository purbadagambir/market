-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 03:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modern_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `type` varchar(32) NOT NULL,
  `menu_key` varchar(32) NOT NULL,
  `label` varchar(199) NOT NULL,
  `route` varchar(199) DEFAULT NULL,
  `icon` varchar(199) DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `type`, `menu_key`, `label`, `route`, `icon`, `short_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'MAIN_MENU', 'MM_DASHBOARD', 'Dashboard', NULL, 'fas fa-tachometer-alt', 1, 1, '2022-12-06 05:42:08', NULL),
(2, 0, 'MAIN_MENU', 'MM_POS', 'POS', '/pos', 'fas fa-clipboard', 2, 1, '2022-12-06 06:57:41', NULL),
(3, 0, 'MAIN_MENU', 'MM_PENJUALAN', 'Penjualan', 'penjualan', 'fas fa-money-check-alt', 3, 1, '2022-12-06 07:06:52', NULL),
(4, 3, 'SUB_MENU', 'SM_LIST_PENJUALAN', 'Daftar Penjualan', '/list-penjualan', NULL, 1, 1, '2022-12-06 07:08:43', NULL),
(5, 3, 'SUB_MENU', 'SM_LIST_PENGEMBALIAN', 'Daftar Pengembalian', '/list-pengembalian', NULL, 2, 1, '2022-12-06 07:08:43', NULL),
(6, 0, 'MAIN_MENU', 'MM_SISTEM', 'Sistem', 'sistem', 'fas fa-cog', 19, 1, '2022-12-06 13:34:12', NULL),
(7, 6, 'SUB_MENU', 'SM_TOKO', 'Toko', '', NULL, 1, 1, '2022-12-06 13:36:25', NULL),
(8, 7, 'ACTIONS', 'A_BUAT_TOKO', 'Buat Toko', '/buat-toko', NULL, 1, 1, '2022-12-06 13:37:02', NULL),
(9, 6, 'SUB_MENU', 'SM_MEREK', 'Merek', NULL, NULL, 4, 1, '2022-12-09 02:37:24', NULL),
(10, 9, 'ACTIONS', 'A_TAMBAH_MEREK', 'Tambah Merek', '/tambah-merek', NULL, 1, 1, '2022-12-09 02:40:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
