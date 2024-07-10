-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 06:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siteko`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(4) NOT NULL,
  `city` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `city`, `date`) VALUES
('J001', 'Jakarta', '2021-06-19'),
('J002', 'Jogja', '2021-06-12'),
('J003', 'Bandung', '2021-06-27'),
('J004', 'Solo', '2024-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `kode_booking` int(6) NOT NULL,
  `id_user` int(4) NOT NULL,
  `kode_jadwal` varchar(4) NOT NULL,
  `kode_tiket` varchar(4) NOT NULL,
  `jumlah_tiket` int(4) NOT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status` enum('Belum dibayar','Pending','Lunas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`kode_booking`, `id_user`, `kode_jadwal`, `kode_tiket`, `jumlah_tiket`, `total_harga`, `bukti_pembayaran`, `status`) VALUES
(104, 5, 'J001', 'T001', 2, 4000000, '60cfd2480c06c.png', 'Lunas'),
(105, 5, 'J002', 'T002', 1, 1500000, '60cfd61811661.png', 'Pending'),
(106, 3, 'J001', 'T003', 3, 7500000, '60cfdc0092fb7.png', 'Lunas'),
(107, 6, 'J001', 'T001', 2, 4000000, '60cff663ab5aa.png', 'Lunas'),
(108, 3, 'J001', 'T001', 2, 4000000, '668d2d1b4e6ae.jpg', 'Lunas'),
(109, 8, 'J004', 'T003', 3, 7500000, '668e125aec776.jpg', 'Lunas');

--
-- Triggers `reservasi`
--
DELIMITER $$
CREATE TRIGGER `reservasi` AFTER INSERT ON `reservasi` FOR EACH ROW UPDATE tiket SET stock = stock - 1
WHERE kode_tiket = new.kode_tiket
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `kode_tiket` varchar(4) NOT NULL,
  `seat` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`kode_tiket`, `seat`, `price`, `stock`) VALUES
('T001', 'Pink A', 2000000, 47),
('T002', 'Pink B', 1500000, 49),
('T003', 'Blue', 2500000, 48),
('T004', 'Green A', 500000, 50),
('T005', 'Green B', 2500000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('Admin','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `no_hp`, `email`, `password`, `level`) VALUES
(1, 'Indah', '089776565400', 'indah@gmail.com', 'indah', 'Customer'),
(2, 'Admin', '085678910112', 'admin@gmail.com', 'admin', 'Admin'),
(3, 'Bariq', '089765432190', 'bariq@gmail.com', 'bariq', 'Customer'),
(4, 'Sabrina', '088747666555', 'sabrina@gmail.com', 'sabrina', 'Customer'),
(5, 'Novi', '087654688657', 'novi@gmail.com', 'novi', 'Customer'),
(6, 'Abin', '087654688657', 'abin@gmail.com', 'abin', 'Customer'),
(7, 'Gafar', '089786567456', 'gafar@gmail.com', 'gafar', 'Customer'),
(8, 'Anita', '087890675345', 'anita@gmail.com', 'anita', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`kode_booking`),
  ADD KEY `kode_jadwal` (`kode_jadwal`),
  ADD KEY `kode_tiket` (`kode_tiket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`kode_tiket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `kode_booking` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`kode_jadwal`) REFERENCES `jadwal` (`kode_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_ibfk_3` FOREIGN KEY (`kode_tiket`) REFERENCES `tiket` (`kode_tiket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
