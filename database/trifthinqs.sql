-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2022 at 10:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trifthinqs`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_u` int(11) NOT NULL,
  `id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_u`, `id_p`) VALUES
(2, 80);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender`) VALUES
('-'),
('female'),
('male');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `jenis_produk` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`jenis_produk`) VALUES
('Flannel'),
('Hat'),
('Hoodie'),
('Jacket'),
('Pants'),
('Shirt'),
('Shoe'),
('Sweater'),
('T-Shirt'),
('Vest');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level`) VALUES
('admin'),
('user');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `jenis_produk` char(10) NOT NULL,
  `kode_produk` char(8) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `ukuran` char(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `status` varchar(4) DEFAULT 'sell'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `jenis_produk`, `kode_produk`, `nama_produk`, `ukuran`, `harga`, `keterangan`, `gambar`, `warna`, `status`) VALUES
(64, 'Jacket', 'KBG1', 'Jacket Flace Dord', 'XL', 499000, 'kondisi 90% pemakaian noraml, sudah dicuci sebelum dijual.', '629ee46a3d1cc6297755722989.jpg', '#e5e0e0', 'sell'),
(65, 'Hoodie', 'KBG2', 'Flece hoddie Baby', 'M', 499000, 'Kondisi 90%, bekas dipake pacar nya justin bibir yang terkenal se rt 04. ini khusus wanita', '629ee448cbc0962977519ef41b.jpg', '#eab3d0', 'sell'),
(66, 'Shoe', 'KBG3', 'Nike air force 1 (Full White)', 'EU39', 899000, 'kondisi 90% pemakaian sehari hari seperti biasanya.', '629ee432d2cdb48783731_f1d57525-9f99-497e-85d2-0824677e962b_750_750.jpeg', '#ffffff', 'sell'),
(67, 'Pants', 'KBG4', 'Jeans Levis Crome Heart', '30', 299000, 'kondisi 85% dalam pemakaian noramal', '629ee36b8a4ef629774ea7a02d.jpg', '#4b7caa', 'sell'),
(68, 'Hat', 'KBG5', 'Hat DiSney Minnie mouse', 'M', 99000, 'kondisi 70% dalam pemakaian noramal', '629ee358b124c629774844eb7f.jpg', '#e54343', 'sell'),
(75, 'Hoodie', 'KBG6', 'Flece hoddie LA', 'L', 499000, 'kondisi 75% dalam pemakaian noramal', '629ee348a7b4c629774780cbc5.jpg', '#0a27ff', 'sell'),
(76, 'Jacket', 'KBG7', 'MLB varsity', 'XL', 599000, 'kondisi 75% dalam pemakaian noramal', '629ee331d512f6297746aef496.jpg', '#bb1b1b', 'sell'),
(79, 'Shoe', 'KBG8', 'Nike Air Force 1 Mid Sail University Red', 'EU42', 550000, 'Kondisi 70%, pemakaian normal', '629ee328174426297745a1dba9.jpg', '#ffffff', 'sold'),
(80, 'Shoe', 'KBG9', 'Nike Air Jordan 1 Mid Triple White', 'EU42', 650000, 'Kondisi 70%, pemakaian normal', '629ee315f15bb6297744ba0e05.jpg', '#ffffff', 'sold'),
(81, 'Shoe', 'KBG10', 'Nike Airmax 97 Midnight Navy', 'EU42', 500000, 'Kondisi 70%, pemakaian normal<br/>gg gamink<br/>gess!!', '62e4f75ba62b0629ee306c5944629b9b7d6bfffsama.PNG', '#000000', 'sold');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status`) VALUES
('ban'),
('non'),
('on');

-- --------------------------------------------------------

--
-- Table structure for table `status_p`
--

CREATE TABLE `status_p` (
  `status` varchar(4) NOT NULL DEFAULT 'sell'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_p`
--

INSERT INTO `status_p` (`status`) VALUES
('sell'),
('sold');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `ukuran` char(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`ukuran`) VALUES
('27'),
('28'),
('29'),
('30'),
('31'),
('32'),
('33'),
('34'),
('EU36'),
('EU37'),
('EU38'),
('EU39'),
('EU40'),
('EU41'),
('EU42'),
('EU43'),
('EU44'),
('L'),
('M'),
('no'),
('S'),
('XL'),
('XXL');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_jenis_produk`
--

CREATE TABLE `ukuran_jenis_produk` (
  `ukuran` char(5) DEFAULT NULL,
  `jenis_produk` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran_jenis_produk`
--

INSERT INTO `ukuran_jenis_produk` (`ukuran`, `jenis_produk`) VALUES
('L', 'T-Shirt'),
('M', 'T-Shirt'),
('S', 'T-Shirt'),
('XL', 'T-Shirt'),
('XXL', 'T-Shirt'),
('L', 'Flannel'),
('M', 'Flannel'),
('S', 'Flannel'),
('XL', 'Flannel'),
('XXL', 'Flannel'),
('L', 'Hoodie'),
('M', 'Hoodie'),
('S', 'Hoodie'),
('XL', 'Hoodie'),
('XXL', 'Hoodie'),
('L', 'Jacket'),
('M', 'Jacket'),
('S', 'Jacket'),
('XL', 'Jacket'),
('XXL', 'Jacket'),
('L', 'Sweater'),
('M', 'Sweater'),
('S', 'Sweater'),
('XL', 'Sweater'),
('XXL', 'Sweater'),
('L', 'Vest'),
('M', 'Vest'),
('S', 'Vest'),
('XL', 'Vest'),
('XXL', 'Vest'),
('27', 'Pants'),
('28', 'Pants'),
('29', 'Pants'),
('30', 'Pants'),
('31', 'Pants'),
('32', 'Pants'),
('33', 'Pants'),
('34', 'Pants'),
('EU36', 'Shoe'),
('EU37', 'Shoe'),
('EU38', 'Shoe'),
('EU39', 'Shoe'),
('EU40', 'Shoe'),
('EU41', 'Shoe'),
('EU42', 'Shoe'),
('EU43', 'Shoe'),
('EU44', 'Shoe'),
('no', 'Hat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(225) DEFAULT NULL,
  `foto` varchar(250) NOT NULL DEFAULT 'default.png',
  `no_telp` char(13) DEFAULT '-',
  `alamat` varchar(250) DEFAULT '-',
  `level` char(5) DEFAULT 'user',
  `gender` char(6) DEFAULT '-',
  `lahir` date DEFAULT current_timestamp(),
  `status` char(3) DEFAULT 'non',
  `kode_aktivasi` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `foto`, `no_telp`, `alamat`, `level`, `gender`, `lahir`, `status`, `kode_aktivasi`) VALUES
(1, 'Admin TrifthinQs', 'trifthinqs@gmail.com', '$2y$10$2FOpMDh42oK..2C6nI/Q2ekTX05ikIkzl6hXWnpIw0W8UjKE5Hkia', '62fcf12aaf5dfScreen Shot 2022-07-30 at 14.28.24.png', '-', '-', 'admin', '-', '2022-07-30', 'on', 'aa0dbb'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$F/yIrOMw8aQ4Uh0ksOqtU.HyuPey291bchPDwN4ZI5gQIQ4Xd7KN6', 'default.png', '-', '-', 'admin', '-', '2022-06-29', 'on', ''),
(3, 'Admin GoturthinQs', 'goturthinqs@gmail.com', '$2y$10$2Z8acHPbbrGhGdE3LL/rZe5weU8Wqc86ElBlUkrT4zrik5OzKPJDK', '62aade75835bcicon.png', '-', '-', 'user', '-', '2022-06-16', 'on', '33fe15'),
(5, 'Admin Udin Store', 'udinstoreid@gmail.com', '$2y$10$PmhBHC2oM8GiRq6xWnoIAe8D8.Z.LgwlGnaxfde6hYRUw3nRRgF2.', '62aade75835bcicon.png', '-', '-', 'user', '-', '2022-07-25', 'on', 'f7d8dc'),
(66, 'Muhamad Jamaludin Padmawinata', 'muhhjam@gmail.com', '$2y$10$/2/69gY91Lsh3tos8KhmR.gnWH7ZLrNYCku3ZEth9YoiXGqTMPppq', '62fdc283e03e4IMG20211121182503.jpg', '-', '-', 'user', '-', '2022-06-16', 'on', '021739'),
(85, 'jamjam', 'muhamadjamaludinpadmawinata@gmail.com', '$2y$10$4TPhtt0NeZc3j2UXStgaiOeCiTqs73jc3PTtylwErkP7YQ2qyR39u', 'default.png', '-', '-', 'user', '-', '2022-07-11', 'on', '9eb347'),
(264, 'jamjam', 'muhamadj735@gmail.com', '$2y$10$Xj8OcH/5gKeQyazaRnBRNuqD5brPRyAkH0.y59VvLeB0pVMAKsaGS', 'default.png', '-', '-', 'user', '-', '2022-08-16', 'on', 'e4ede9'),
(269, 'jamjam', '11jauhari11@gmail.com', '$2y$10$rVS7iOkfTdAgqtnNf.efsONeei69mTR.XguxZzgIVqc27Mf.xuI/K', 'default.png', '-', '-', 'user', '-', '2022-10-26', 'on', '7568ab');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_code` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `id_u` int(11) NOT NULL,
  `id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wish`
--

INSERT INTO `wish` (`id_u`, `id_p`) VALUES
(2, 80),
(2, 75),
(3, 64),
(3, 68),
(1, 75),
(66, 79),
(264, 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `id_u` (`id_u`),
  ADD KEY `id_p` (`id_p`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`jenis_produk`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_produk` (`jenis_produk`),
  ADD KEY `ukuran` (`ukuran`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `status_p`
--
ALTER TABLE `status_p`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ukuran`);

--
-- Indexes for table `ukuran_jenis_produk`
--
ALTER TABLE `ukuran_jenis_produk`
  ADD KEY `ukuran` (`ukuran`),
  ADD KEY `jenis_produk` (`jenis_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`level`),
  ADD KEY `gender` (`gender`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_code`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD KEY `id_u` (`id_u`),
  ADD KEY `id_p` (`id_p`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_p`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`jenis_produk`) REFERENCES `jenis_produk` (`jenis_produk`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`ukuran`) REFERENCES `ukuran` (`ukuran`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status_p` (`status`);

--
-- Constraints for table `ukuran_jenis_produk`
--
ALTER TABLE `ukuran_jenis_produk`
  ADD CONSTRAINT `ukuran_jenis_produk_ibfk_1` FOREIGN KEY (`ukuran`) REFERENCES `ukuran` (`ukuran`),
  ADD CONSTRAINT `ukuran_jenis_produk_ibfk_2` FOREIGN KEY (`jenis_produk`) REFERENCES `jenis_produk` (`jenis_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`level`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`gender`) REFERENCES `gender` (`gender`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status` (`status`);

--
-- Constraints for table `wish`
--
ALTER TABLE `wish`
  ADD CONSTRAINT `wish_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wish_ibfk_2` FOREIGN KEY (`id_p`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
