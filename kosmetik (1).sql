-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 07:30 AM
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
-- Database: `kosmetik`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar_url` varchar(255) NOT NULL,
  `best_seller` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `harga`, `gambar_url`, `best_seller`, `created_at`) VALUES
(5, 'Glad2Glow AHA BHA PHA Peeling', 'Eksfoliasi lembut untuk kulit cerah', 65000, 'https://tse3.mm.bing.net/th/id/OIP.a2StSI050qIupfhDXiIrUQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 1, '2026-01-21 02:20:35'),
(6, 'Simple Hydrating Toner', 'Toner ringan untuk melembabkan', 95000, 'https://tse4.mm.bing.net/th/id/OIP.lcJEIZZUGxVAJ-AKCXf8DAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 0, '2026-01-21 02:20:35'),
(7, 'CeraVe Moisturizing Cream', 'Pelembab ceramide semua jenis kulit', 110000, 'https://tse2.mm.bing.net/th/id/OIP.dTnNYH4zwwn3WMxCyGMw3AHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 1, '2026-01-21 02:20:35'),
(8, 'Pure Paw Paw Balm', 'Salep serbaguna bibir & kulit', 58000, 'https://tse1.mm.bing.net/th/id/OIP.Z9dPrxyRGow-xrFRxfG41QHaFj?rs=1&pid=ImgDetMain&o=7&rm=3', 0, '2026-01-21 02:20:35'),
(9, 'YOU AcnePlus Spot Serum', 'Serum totol jerawat', 75000, 'https://tse2.mm.bing.net/th/id/OIP.mogC2nE0iCj8gGT0gwfiVwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 1, '2026-01-21 02:20:35'),
(10, 'The Originote Sunscreen SPF 50', 'Sunscreen SPF 50 PA+++', 85000, 'https://tse1.mm.bing.net/th/id/OIP._lnp-9h-5DUkjoYN3WTWuQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 1, '2026-01-21 02:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pembayaran` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user`, `total`, `pembayaran`, `tanggal`) VALUES
(1, 'del', 315000, 'BCA', '2026-01-13 05:38:21'),
(2, 'bgh', 58000, 'Dana', '2026-01-15 02:23:54'),
(3, 'bgh', 95000, 'Mandiri', '2026-01-15 03:12:37'),
(4, 'ting', 45000, 'COD', '2026-01-21 01:09:48'),
(5, 'ting', 110000, 'BCA', '2026-01-21 02:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `produk` varchar(100) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `produk`, `size`, `qty`, `harga`) VALUES
(1, 1, 'Daily Moisturizer', '300ml', 2, 110000),
(2, 1, 'Hydrating Toner', '100ml', 1, 95000),
(3, 2, ' pure paw paw', '100ml', 1, 58000),
(4, 3, 'Hydrating Toner', '300ml', 1, 95000),
(5, 4, 'The Originote Ceramella Sunscreen SPF 50 PA+++', '100ml', 1, 45000),
(6, 5, 'CeraVe Moisturizing Cream', '100 ml', 1, 110000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(1, 'sella', 'sella@gmail.com', '$2y$10$U/dEnuqDuJJZeXxgiL4xK.664OobRRpY.IupWARfVSXxLXCWc0rZ6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
