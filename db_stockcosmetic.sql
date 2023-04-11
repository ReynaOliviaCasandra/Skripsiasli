-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:33012
-- Generation Time: Apr 11, 2023 at 07:52 AM
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
(1, 1, '2023-04-08 12:44:35', '7163053ae08e8c51ca62afe25356454e1680957875.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qty` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statusbarang` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `qty`, `status`, `statusbarang`) VALUES
(1, 1, '2023-04-10 01:35:40', 100, 'Sangat bagus', 2),
(2, 43, '2023-04-10 01:35:57', 60, 'Mantap', 3),
(3, 5, '2023-04-11 05:04:27', 10, 'mantap', 2),
(4, 6, '2023-04-11 05:06:16', 10, 'Mantap', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `email`, `password`, `role`) VALUES
(8, 'novita', 'noviana@gmail.com', '123', 'owner'),
(9, 'lina', 'lina@gmail.com', '123', 'kepalagudang'),
(10, 'Agustina', 'agustina@gmail.com', '123', 'manager'),
(11, 'yonathan', 'yonathan@gmail.com', '123', 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kadarluasa` datetime DEFAULT NULL,
  `penerima` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `kadarluasa`, `penerima`, `qty`) VALUES
(1, 2, '2023-04-08 07:52:47', '2023-04-08 00:00:00', 11, 20);

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

CREATE TABLE `req` (
  `idreq` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `penerima` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req`
--

INSERT INTO `req` (`idreq`, `idbarang`, `tanggal`, `status`, `penerima`, `qty`) VALUES
(2, 2, '2023-04-08 06:43:56', 2, 'SADSA', 100),
(3, 41, '2023-04-08 06:50:46', 1, 'Novita', 100),
(4, 45, '2023-04-11 05:22:21', 1, 'Novita', 100),
(6, 1, '2023-04-09 15:43:45', 0, 'manager toko', 20);

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `idretur` int(11) NOT NULL,
  `idbarang` int(10) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`idretur`, `idbarang`, `penerima`, `qty`, `status`, `tanggal`) VALUES
(1, 3, 'lina', 10, 'rusak', '2023-04-11 05:03:08');

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
(1, 'Scarlet whitening', 'Sabun Mandi wanita', 487, 200000, 'd6e3454663762f1a8c1f9f71a451ff601679287561.jpeg'),
(2, 'Pixy', 'Sabun Muka', 1750, 30000, 'bf33e82002e5393f8680ae92ff2ba5e51679287573.png'),
(3, 'gatsby', 'Pomade rambut pria', 70, 40, '8d7894887fc7842093b1f24a163262891679287673.png'),
(4, 'Clear', 'Shampo ketombe', 440, 60, 'c80782f329f526f5e992443396b752061679287752.png'),
(5, 'Garnier', 'Sabun muka', 1180, 80, 'bf5978706239175ea3c528b88f99fd5c1679287787.jpg'),
(6, 'Casablanka', 'Parfum Pria', 240, 90, '9ee2b865109c9879cd5f801b3f4d8a771679287855.png'),
(8, 'Barbara', 'Hair Spray', 140, 450, 'cce5732e75e46c83cf70a70b99517e481679635424.jpeg'),
(41, 'Brasov Lipptin', 'Lipstic', 100, 163000, '6b0fa9bab2653256631d1a2baf51ba541679635457.png'),
(42, 'bigen', 'Hair Spray', 80, 180000, 'f3d73704174d4c68e29a5d5fcbfb3f3d1679635664.jpeg'),
(43, 'citra', 'Hand Body', 0, 65000, 'f4daaaee18909560c130a369c56e25ae1679635804.jpeg'),
(44, 'Detol', 'Sabun Batang', 10, 0, '843bfd67886a520b53c5565f3b5671301679638311.jpg'),
(45, 'Makarizo', 'Spray Hair', 5, 0, '705ce494c87729723aeb1150de2dbc131679638726.jpg'),
(46, 'nyabun', 'Sabun Muka', 300, 0, 'aee7f789067999528b17f4d5dc19daaa1680593033.jpg');

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
(1, 'lina noviana', 'Burma cosmetic', '08121812'),
(2, 'Steven', 'VO3', '021'),
(3, 'V3', 'PT surabaya', '081218190'),
(14, 'rina roina', 'pixy', '081218');

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
  ADD KEY `penerima` (`penerima`);

--
-- Indexes for table `req`
--
ALTER TABLE `req`
  ADD PRIMARY KEY (`idreq`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`idretur`),
  ADD KEY `idbarang` (`idbarang`);

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
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `req`
--
ALTER TABLE `req`
  MODIFY `idreq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `idretur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `masuk_ibfk_2` FOREIGN KEY (`penerima`) REFERENCES `login` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `req`
--
ALTER TABLE `req`
  ADD CONSTRAINT `req_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `stock` (`idbarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
