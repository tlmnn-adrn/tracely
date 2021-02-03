-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2021 at 01:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracely`
--

-- --------------------------------------------------------

--
-- Table structure for table `Benutzer`
--

CREATE TABLE `Benutzer` (
  `id` int(11) NOT NULL,
  `telefonnummer` varchar(20) NOT NULL,
  `passwort` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `plz` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Benutzer`
--

INSERT INTO `Benutzer` (`id`, `telefonnummer`, `passwort`, `email`, `vorname`, `nachname`, `plz`) VALUES
(1, '+4915752088865', '$2y$10$QC2JsRyHKvF/lu/l.mY7huRIxKQBhn44qFfc1jd36nPJmF0xWTX3y', 'adrian.tilmann@gmail.com', 'Tilmann', 'Adrian', '01326'),
(2, '+4915204867444', '$2y$10$GUjMFEZN1cnqQH2WlUdKA.WZmVfgWahNAZXTUf.sCWQLqAodKtK5q', 'mrmallemixeph@gmail.com', 'Jakob', 'Großer', '01324'),
(3, '+491511293235', '$2y$10$opPGS0W7Qsb5io4jLGikiuI0tDVSWpHN8Z/mEReYMBa1BqlaZlPta', 'peter@mail.com', 'Peter', 'Cavaletta', '01326');

-- --------------------------------------------------------

--
-- Table structure for table `Institution`
--

CREATE TABLE `Institution` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `passwort` varchar(60) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `stadt` varchar(255) NOT NULL,
  `plz` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `institutionsartId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Institution`
--

INSERT INTO `Institution` (`id`, `name`, `passwort`, `adresse`, `stadt`, `plz`, `email`, `institutionsartId`) VALUES
(1, 'GDB', '$2y$10$QC2JsRyHKvF/lu/l.mY7huRIxKQBhn44qFfc1jd36nPJmF0xWTX3y', 'Cunewalder Straße 3', 'Dresden', '01325', 'gdb@lernsax.de', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Institutionsart`
--

CREATE TABLE `Institutionsart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `aufenthaltszeit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `QrCode`
--

CREATE TABLE `QrCode` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `tischnummer` int(11) NOT NULL,
  `sitzplätze` int(11) NOT NULL,
  `institutionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Scan`
--

CREATE TABLE `Scan` (
  `id` int(11) NOT NULL,
  `qrCodeId` int(11) NOT NULL,
  `benutzerId` int(11) NOT NULL,
  `zeitpunkt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Benutzer`
--
ALTER TABLE `Benutzer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Institution`
--
ALTER TABLE `Institution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Institutionsart`
--
ALTER TABLE `Institutionsart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `QrCode`
--
ALTER TABLE `QrCode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Scan`
--
ALTER TABLE `Scan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Benutzer`
--
ALTER TABLE `Benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Institution`
--
ALTER TABLE `Institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Institutionsart`
--
ALTER TABLE `Institutionsart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `QrCode`
--
ALTER TABLE `QrCode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Scan`
--
ALTER TABLE `Scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
