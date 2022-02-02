-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2022 at 02:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kayttajatietokanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `kayttajat`
--

CREATE TABLE `kayttajat` (
  `id` int(4) NOT NULL,
  `kayttajanimi` varchar(255) NOT NULL,
  `salasana` varchar(255) NOT NULL,
  `rooli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kayttajat`
--

INSERT INTO `kayttajat` (`id`, `kayttajanimi`, `salasana`, `rooli`) VALUES
(1, 'admin', 'pzFHg$2y$10$c9ue42WE9GEriXR0pWZKT.n3ICTKnHN9R1BV.meTEEsFkOFgem8Vi', 'admin'),
(16, 'editor', 'MoijK$2y$10$jv6uSZER/JQ7Vi3Plc8Tm.FiKII4hKZFFJf/lmFVgv7NSSLK5gvC.', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kayttajat`
--
ALTER TABLE `kayttajat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kayttajat`
--
ALTER TABLE `kayttajat`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
