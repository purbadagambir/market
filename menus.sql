-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2022 at 07:31 AM
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
(1, 0, 'MAIN_MENU', 'DASHBOARDS', 'Dashboards', 'dashboard', 'fa fa-th', 1, 1, '2022-12-06 05:42:08', '2022-12-27 19:35:45'),
(2, 0, 'MAIN_MENU', 'POIN_OF_SALES', 'Poin Of Sales', 'pos', 'fa fa-cart-plus', 2, 1, '2022-12-06 06:57:41', '2022-12-27 19:36:35'),
(3, 0, 'MAIN_MENU', 'PRODUK', 'Produk', 'produk', 'fa  fa-star-half-full', 3, 1, '2022-12-06 07:06:52', '2022-12-27 19:37:59'),
(4, 3, 'SUB_MENU', 'DAFTAR_PRODUK', 'Daftar Produk', 'produk-list', 'fa fa-angle-double-right', 1, 1, '2022-12-06 07:08:43', '2022-12-27 19:39:37'),
(5, 3, 'SUB_MENU', 'KATEGORI', 'Kategori', 'produk-category', 'fa fa-angle-double-right', 3, 1, '2022-12-06 07:08:43', '2022-12-29 21:26:27'),
(6, 0, 'MAIN_MENU', 'SISTEM', 'Sistem', 'sistem', 'fa fa-cog', 15, 1, '2022-12-06 13:34:12', '2022-12-29 01:53:01'),
(7, 6, 'SUB_MENU', 'DAFTAR_TOKO', 'Daftar Toko', 'sistem-toko', 'fa fa-angle-double-right', 1, 1, '2022-12-06 13:36:25', '2022-12-27 19:42:30'),
(8, 6, 'SUB_MENU', 'METODE_PEMBAYARAN', 'Metode Pembayaran', 'sistem-metode-pembayaran', 'fa fa-angle-double-right', 2, 1, '2022-12-06 13:37:02', '2022-12-27 19:44:07'),
(9, 6, 'SUB_MENU', 'MATA_UANG', 'Mata Uang', 'sistem-mata-uang', 'fa fa-angle-double-right', 3, 1, '2022-12-09 02:37:24', '2022-12-27 19:44:35'),
(11, 6, 'SUB_MENU', 'MENU', 'Menu', 'sistem-menu', 'fa fa-angle-double-right', 13, 1, '2022-12-09 07:06:37', '2022-12-27 19:45:29'),
(12, 6, 'SUB_MENU', 'RESTORE_DATABASE', 'Restore Database', 'sistem-restore-database', 'fa fa-angle-double-right', 7, 1, '2022-12-09 23:17:32', '2022-12-29 01:47:00'),
(85, 0, 'MAIN_MENU', 'PENJUALAN', 'Penjualan', 'penjualan', 'fa fa-laptop', 4, 1, '2022-12-27 19:46:39', '2022-12-27 19:47:18'),
(86, 85, 'SUB_MENU', 'DAFTAR_PENJUALAN', 'Daftar Penjualan', 'penjualan-list', 'fa fa-angle-double-right', 1, 1, '2022-12-27 19:48:29', '2022-12-27 19:48:31'),
(87, 85, 'SUB_MENU', 'DAFTAR_PENGEMBALIAN', 'Daftar Pengembalian', 'penjualan-pengembalian', 'fa fa-angle-double-right', 2, 1, '2022-12-27 19:49:13', '2022-12-27 19:49:14'),
(88, 85, 'SUB_MENU', 'CATATAN_PENJUALAN', 'Catatan Penjualan', 'penjualan-catatan', 'fa fa-angle-double-right', 3, 1, '2022-12-27 19:49:47', '2022-12-27 19:49:48'),
(89, 85, 'SUB_MENU', 'KARTU_MEMBER', 'Kartu Member', 'penjualan-kartu-member', 'fa fa-angle-double-right', 4, 1, '2022-12-27 19:50:21', '2022-12-27 19:50:21'),
(90, 0, 'MAIN_MENU', 'PEMBELIAN', 'Pembelian', 'pembelian', 'fa fa-file-text-o', 5, 1, '2022-12-27 19:51:48', '2022-12-27 19:51:49'),
(91, 0, 'MAIN_MENU', 'INVENTORY', 'Inventory', 'inventory', 'fa fa-table', 6, 1, '2022-12-27 19:52:14', '2022-12-27 19:52:14'),
(92, 0, 'MAIN_MENU', 'MUTASI', 'Mutasi', 'mutasi', 'fa fa-exchange', 7, 1, '2022-12-27 19:52:47', '2022-12-27 19:52:47'),
(93, 0, 'MAIN_MENU', 'MEMBER', 'Member', 'member', 'fa fa-users', 8, 1, '2022-12-27 19:53:20', '2022-12-27 19:53:20'),
(94, 0, 'MAIN_MENU', 'PENGELUARAN', 'Pengeluaran', 'pengeluaran', 'fa fa-minus-square', 9, 1, '2022-12-27 19:53:45', '2022-12-27 19:53:45'),
(95, 0, 'MAIN_MENU', 'ANALISA', 'Analisa', 'analisa', 'fa fa-bar-chart', 10, 1, '2022-12-27 19:54:44', '2022-12-27 19:54:46'),
(96, 0, 'MAIN_MENU', 'LAPORAN', 'Laporan', 'laporan', 'fa fa-edit', 11, 1, '2022-12-27 19:55:11', '2022-12-27 19:55:11'),
(97, 0, 'MAIN_MENU', 'AKUNTANSI', 'Akuntansi', 'akuntansi', 'fa fa-university', 12, 1, '2022-12-27 19:55:40', '2022-12-27 19:55:40'),
(98, 0, 'MAIN_MENU', 'MAILBOX', 'Mailbox', 'mailbox', 'fa fa-envelope', 13, 1, '2022-12-27 19:57:01', '2022-12-27 19:57:01'),
(99, 0, 'MAIN_MENU', 'PENGGUNA', 'Pengguna', 'pengguna', 'fa fa-user', 14, 1, '2022-12-27 19:57:24', '2022-12-27 19:58:22'),
(100, 0, 'MAIN_MENU', 'GANTI_OUTLET', 'Ganti Outlet', 'ganti-outlet', 'fa fa-map-signs', 15, 1, '2022-12-27 19:57:57', '2022-12-27 19:57:57'),
(101, 3, 'SUB_MENU', 'CETAK_BARCODE', 'Cetak Barcode', 'produk-cetak-barcode', 'fa fa-angle-double-right', 2, 1, '2022-12-29 01:30:32', '2022-12-29 01:30:33'),
(102, 3, 'SUB_MENU', 'RAK', 'Rak', 'produk-rak', 'fa fa-angle-double-right', 4, 1, '2022-12-29 01:31:35', '2022-12-29 01:31:37'),
(103, 3, 'SUB_MENU', 'UNIT', 'Unit', 'produk-unit', 'fa fa-angle-double-right', 5, 1, '2022-12-29 01:32:16', '2022-12-29 01:32:16'),
(104, 3, 'SUB_MENU', 'MERK', 'Merk', 'produk-merk', 'fa fa-angle-double-right', 6, 1, '2022-12-29 01:36:18', '2022-12-29 01:36:19'),
(105, 3, 'SUB_MENU', 'PERINGATAN_STOCK', 'Peringatan Stock', 'produk-peringatan-stock', 'fa fa-angle-double-right', 7, 1, '2022-12-29 01:38:10', '2022-12-29 01:38:12'),
(106, 6, 'SUB_MENU', 'PERSENTASE_PAJAK', 'Persentase Pajak', 'sistem-persentase-pajak', 'fa fa-angle-double-right', 4, 1, '2022-12-29 01:49:33', '2022-12-29 01:49:33'),
(107, 6, 'SUB_MENU', 'PERSENTASE_POIN', 'Persentase Poin', 'sistem-persentase-poin', 'fa fa-angle-double-right', 5, 1, '2022-12-29 01:50:06', '2022-12-29 01:50:06'),
(108, 6, 'SUB_MENU', 'BACKUP_DATABASE', 'Backup Database', 'sistem-backup-database', 'fa fa-angle-double-right', 6, 1, '2022-12-29 01:50:45', '2022-12-29 01:50:45');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
