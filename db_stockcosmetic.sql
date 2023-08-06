-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 06, 2023 at 05:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stockcosmetic`
--

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `idfaktur` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`idfaktur`, `supplier`, `tanggal`, `gambar`) VALUES
(1, 1, '2023-05-25 05:35:17', 'ec7971e5f9417ef1c39ddebcf37962591684992917.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qty` int(11) NOT NULL,
  `statusbarang` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `qty`, `statusbarang`) VALUES
(1, 48, '2023-08-05 07:28:37', 40, 2),
(2, 48, '2023-08-05 04:01:59', 20, 1),
(3, 48, '2023-08-05 07:28:22', 10, 1),
(4, 48, '2023-05-27 04:52:40', 20, 0),
(5, 1, '2023-05-29 11:41:36', 1, 0),
(6, 3, '2023-05-30 04:56:21', 89, 0),
(7, 50, '2023-07-26 07:35:28', 10, 2),
(8, 50, '2023-07-31 06:54:09', 10, 2),
(9, 1, '2023-08-05 02:59:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `email`, `password`, `role`, `status`) VALUES
(14, 'edric', 'EDRICSURYADY@GMAIL.COM', '222', 'manager', '1'),
(16, 'manager', 'manager@gmail.com', '123', 'manager', '1'),
(17, 'kepalagudang', 'kepalagudang@gmail.com', '123', 'kepalagudang', '1'),
(21, 'jfa', 'jfa@gmail.com', '123', 'owner', '1'),
(22, 'Wiliam Chandra', 'wiliamchandra@gmail.com', '123', 'mati', '1'),
(23, 'novita', 'novitaelisa@gmail.com', '123', 'owner', '1');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `idfaktur` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `penerima` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `idfaktur`, `tanggal`, `penerima`, `qty`) VALUES
(1, 48, 1, '2023-05-27 04:16:50', 14, 20),
(2, 48, 1, '2023-05-27 03:25:47', 14, 40),
(3, 48, 1, '2023-05-27 03:25:56', 14, 10),
(4, 48, 1, '2023-05-27 04:51:46', 14, 101),
(5, 42, 1, '2023-05-27 05:16:47', 14, 100);

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

CREATE TABLE `req` (
  `idreq` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req`
--

INSERT INTO `req` (`idreq`, `idbarang`, `tanggal`, `status`, `qty`) VALUES
(1, 49, '2023-04-17 08:48:18', 1, 288),
(2, 50, '2023-04-27 08:11:19', 1, 12),
(3, 51, '2023-05-10 08:59:20', 1, 12),
(5, 2, '2023-07-31 06:52:37', 1, 20),
(6, 6, '2023-04-27 08:12:28', 0, 20),
(7, 8, '2023-08-05 02:58:23', 1, 20),
(9, 48, '2023-05-29 08:13:32', 2, 20),
(12, 1, '2023-05-29 08:38:45', 0, 10),
(13, 49, '2023-05-30 06:39:38', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `restart_token`
--

CREATE TABLE `restart_token` (
  `id` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `token` varchar(250) NOT NULL,
  `expdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `idretur` int(11) NOT NULL,
  `idbarang` int(10) NOT NULL,
  `idfaktur` int(11) NOT NULL,
  `penerima` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `statusbarang` int(11) NOT NULL DEFAULT 0,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`idretur`, `idbarang`, `idfaktur`, `penerima`, `qty`, `status`, `statusbarang`, `tanggal`) VALUES
(1, 8, 1, 1, 1, 'rusak', 1, '2023-05-29 11:44:32'),
(2, 49, 1, 1, 1, 'rusak', 0, '2023-05-25 06:03:06'),
(3, 42, 1, 1, 20, 'rusak', 0, '2023-05-27 06:04:54'),
(4, 8, 1, 1, 1, 'rusak', 0, '2023-05-29 06:06:35'),
(5, 2, 1, 1, 1, 'rusak', 0, '2023-05-30 06:33:43'),
(6, 5, 1, 2, 1, 'rusak', 0, '2023-05-30 06:37:49'),
(7, 2, 1, 3, 1, 'rusak', 1, '2023-07-26 07:36:47'),
(8, 41, 1, 3, 20, 'PECAH', 1, '2023-07-31 06:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `jenisbarang` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `Harga` int(100) NOT NULL,
  `gambar` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `jenisbarang`, `stock`, `Harga`, `gambar`) VALUES
(1, 'Scarlet whitening', 'sabun mandi', 385, 200000, 'd6e3454663762f1a8c1f9f71a451ff601679287561.jpeg'),
(2, 'Pixy', 'Sabun Muka', 1953, 30000, 'bf33e82002e5393f8680ae92ff2ba5e51679287573.png'),
(3, 'gatsby', 'Pomade rambut pria', 0, 8500, '8d7894887fc7842093b1f24a163262891679287673.png'),
(4, 'Clear', 'Shampo ketombe', 419, 60, 'c80782f329f526f5e992443396b752061679287752.png'),
(5, 'Garnier', 'Sabun muka', 1139, 80000, 'bf5978706239175ea3c528b88f99fd5c1679287787.jpg'),
(6, 'Casablanka', 'Parfum Pria', 230, 90, '9ee2b865109c9879cd5f801b3f4d8a771679287855.png'),
(8, 'Barbara', 'Hair Spray', 211, 450, 'cce5732e75e46c83cf70a70b99517e481679635424.jpeg'),
(41, 'Brasov Lipptin', 'Lipstic', 70, 163000, '6b0fa9bab2653256631d1a2baf51ba541679635457.png'),
(42, 'bigen', 'Hair Spray', 48, 180000, 'f3d73704174d4c68e29a5d5fcbfb3f3d1679635664.jpeg'),
(48, 'Mirabela Urang aring', 'Hair Lotion', 10, 200, '0851a597245e59718ad939aa278aee1e1681560075.png'),
(49, 'RDL White', 'Soap Papaya', 625, 20000, 'b719100e369833f4641e1a5bf31babfa1681560212.png'),
(50, 'caladine powder 100gr', 'bedak bayi', 9, 15000, 'e4bfe9b03634b07e2526a5e9b2c7973b1681561100.png'),
(51, 'caladine powder  60gr', 'bedak bayi', 22, 12000, 'bde761779038651630c9a314ce5e56c11681561172.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `nama`, `supplier`, `kontak`) VALUES
(1, 'lina noviana', 'Burma cosmetic', '081218170845'),
(2, 'Steven', 'VO3', '021912931'),
(3, 'V3', 'PT surabaya', '081218190'),
(14, 'rina roina', 'pixy', '081218'),
(15, 'dinda', 'Jaya Abadi', '081288782208'),
(16, '3dri1c', 'stevn', 'abcd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`idfaktur`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `idbarang` (`idbarang`),
  ADD KEY `penerima` (`penerima`),
  ADD KEY `idfaktur` (`idfaktur`);

--
-- Indexes for table `req`
--
ALTER TABLE `req`
  ADD PRIMARY KEY (`idreq`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `restart_token`
--
ALTER TABLE `restart_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`idretur`),
  ADD KEY `idbarang` (`idbarang`),
  ADD KEY `penerima` (`penerima`),
  ADD KEY `idfaktur` (`idfaktur`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faktur`
--
ALTER TABLE `faktur`
  MODIFY `idfaktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `req`
--
ALTER TABLE `req`
  MODIFY `idreq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `restart_token`
--
ALTER TABLE `restart_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `idretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `faktur_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`idsupplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluar`
--
ALTER TABLE `keluar`
  ADD CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masuk_ibfk_2` FOREIGN KEY (`penerima`) REFERENCES `login` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `masuk_ibfk_3` FOREIGN KEY (`idfaktur`) REFERENCES `faktur` (`idfaktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `req`
--
ALTER TABLE `req`
  ADD CONSTRAINT `req_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restart_token`
--
ALTER TABLE `restart_token`
  ADD CONSTRAINT `restart_token_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`iduser`);

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_ibfk_2` FOREIGN KEY (`penerima`) REFERENCES `supplier` (`idsupplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_ibfk_3` FOREIGN KEY (`idfaktur`) REFERENCES `faktur` (`idfaktur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
