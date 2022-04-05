-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2022 at 06:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taitaja22TK`
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

-- --------------------------------------------------------

--
-- Table structure for table `sisalto`
--

CREATE TABLE `sisalto` (
  `id` int(4) NOT NULL,
  `alaotsikko` varchar(255) NOT NULL,
  `teksti` varchar(255) NOT NULL,
  `kuva` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sisalto`
--

INSERT INTO `sisalto` (`id`, `alaotsikko`, `teksti`, `kuva`) VALUES
(28, 'tafaaf', 'afafaf', 'img/unsplash_images/neonbrand-60krlMMeWxU-unsplash.jpg'),
(29, 'aegg', 'egegaegagafa', 'img/unsplash_images/pavel-neznanov-w95Fb7EEcjE-unsplash.jpg'),
(34, 'EDDIE HALL', 'ldöaldlöada', 'img/unsplash_images/testi2_EDDIE HALL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sivut`
--

CREATE TABLE `sivut` (
  `id` int(4) NOT NULL,
  `nimi` varchar(255) NOT NULL,
  `nimiurl` varchar(255) NOT NULL,
  `otsikko` varchar(255) NOT NULL,
  `teemakuva` varchar(255) NOT NULL,
  `sisalto_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sivut`
--

INSERT INTO `sivut` (`id`, `nimi`, `nimiurl`, `otsikko`, `teemakuva`, `sisalto_id`) VALUES
(27, 'testi', 'testi.php', 'testi', 'img/unsplash_images/markus-spiske-cjOAigK9xo0-unsplash.jpg', '28;29;'),
(43, 'testi2', 'testi2.php', 'testi2', 'img/unsplash_images/', '34;');

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
(1, 'Oikein rakentaminen onnistuu hyvillä ratkaisuilla - Tervetuloa asioimaan Ruosteiseen Rautaan!', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kayttajat`
--
ALTER TABLE `kayttajat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sisalto`
--
ALTER TABLE `sisalto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sivut`
--
ALTER TABLE `sivut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tervehdysteksti`
--
ALTER TABLE `tervehdysteksti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kayttajat`
--
ALTER TABLE `kayttajat`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sisalto`
--
ALTER TABLE `sisalto`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sivut`
--
ALTER TABLE `sivut`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tervehdysteksti`
--
ALTER TABLE `tervehdysteksti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
