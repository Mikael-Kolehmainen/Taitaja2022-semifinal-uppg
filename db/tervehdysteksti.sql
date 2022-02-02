-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2022 at 02:09 PM
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
-- Table structure for table `tervehdysteksti`
--

CREATE TABLE `tervehdysteksti` (
  `id` int(255) NOT NULL,
  `tervehdys` varchar(255) NOT NULL,
  `nykyinen` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tervehdysteksti`
--

INSERT INTO `tervehdysteksti` (`id`, `tervehdys`, `nykyinen`) VALUES
(1, 'Oikein rakentaminen onnistuu hyvillä ratkaisuilla - Tervetuloa asioimaan Ruosteiseen Rautaan!', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tervehdysteksti`
--
ALTER TABLE `tervehdysteksti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tervehdysteksti`
--
ALTER TABLE `tervehdysteksti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
