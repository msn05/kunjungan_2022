-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 06:10 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kunjungan`
--

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL COMMENT 'number of data',
  `visit_id` int(10) NOT NULL COMMENT 'data kunjungan id',
  `name` text DEFAULT NULL COMMENT 'nama fasiltas yang didapatkan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='data fasilitas kunjungan';

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL COMMENT 'number of data',
  `visit_id` int(10) NOT NULL COMMENT 'data kunjungan id',
  `statuses_visit` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'status kunjungan',
  `date_expired` date DEFAULT NULL COMMENT 'tanggal berakhir kunjungan',
  `results` text DEFAULT NULL COMMENT 'hasil kunjungan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='data jadwal kunjungan';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'number of data',
  `username` varchar(100) NOT NULL COMMENT 'username login ',
  `full_name` varchar(100) DEFAULT NULL COMMENT 'full name users account',
  `password` text NOT NULL COMMENT 'password account',
  `access` enum('1','2','3') NOT NULL DEFAULT '3' COMMENT 'access view data',
  `statuses` int(11) NOT NULL DEFAULT 0 COMMENT 'status account users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='data users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `access`, `statuses`) VALUES
(1, 'admin@account.com', 'admin dir', '$2y$10$MkEiZ8YSlEBiZ/8ZKnxodO64KA42UuOtDGs39sGBumXbtA9WxvtH6', '1', 1),
(2, 'staff@account.com', 'staff dir', '$2y$10$eBJEpqi3/Wab7J3/7CF3B.RJCXcPQxFFrkdrV22kK7TlXBR9V5rgq', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` int(11) NOT NULL COMMENT 'number of data',
  `users_id` int(10) NOT NULL,
  `name_employee` text NOT NULL COMMENT 'nama pegawai ',
  `date_visit` datetime NOT NULL COMMENT 'tanggal kunjungan',
  `destination` text NOT NULL COMMENT 'tujuan',
  `totals_follow_employee` int DEFAULT 0 COMMENT 'total pengawai yang dibawa',
  `necessity` text NOT NULL COMMENT 'keperluan kunjungan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='data kunjungan karyawan';

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `users_id`, `name_employee`, `date_visit`, `destination`, `totals_follow_employee`, `necessity`) VALUES
(42, 1, 'test', '2022-07-06 00:00:00', 'st', '2', 'test'),
(43, 2, 'test staff', '2022-07-22 00:00:00', 'test staff', '2', 'test staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_un` (`visit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_un` (`username`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'number of data', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'number of data', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'number of data', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'number of data', AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `fk_visited` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_FK` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
