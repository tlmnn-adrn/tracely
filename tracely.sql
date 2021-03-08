-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 07. Mrz 2021 um 21:12
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tracely`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Benutzer`
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
-- Daten für Tabelle `Benutzer`
--

INSERT INTO `Benutzer` (`id`, `telefonnummer`, `passwort`, `email`, `vorname`, `nachname`, `plz`) VALUES
(1, '+4915752088865', '$2y$10$QC2JsRyHKvF/lu/l.mY7huRIxKQBhn44qFfc1jd36nPJmF0xWTX3y', 'adrian.tilmann@gmail.com', 'Tilmann', 'Adrian', '01326'),
(2, '+4915204867444', '$2y$10$GUjMFEZN1cnqQH2WlUdKA.WZmVfgWahNAZXTUf.sCWQLqAodKtK5q', 'mrmallemixeph@gmail.com', 'Jakob', 'Großer', '01324'),
(3, '+491511293235', '$2y$10$opPGS0W7Qsb5io4jLGikiuI0tDVSWpHN8Z/mEReYMBa1BqlaZlPta', 'peter@mail.com', 'Peter', 'Cavaletta', '01326'),
(4, '+4912342099967', '$2y$10$mZx5C6jHAkJX/PsATuJTNuM8y0.ll.qwRN2YCU1n7RkRbBknUzGm6', 'max@mustermann.tdl', 'Max', 'Mustermann', '01234'),
(5, '+4915751829040', '$2y$10$gITH3l/ElvtsjV40bCGfzO2OAy9At9FP6s5bZFDPGLVyDFBMrqQE.', 'peter@son.eu', 'Peter', 'Peterson', '01313'),
(6, '+4919205810294', '$2y$10$qpihwIaulIwMA5gA6i9a1.RYKU7ztMN4LMlcG9CsvnweYRT7S4u8a', 'peter@cavaletta.com', 'Peter', 'il Cavaletta', '01234');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Institution`
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
-- Daten für Tabelle `Institution`
--

INSERT INTO `Institution` (`id`, `name`, `passwort`, `adresse`, `stadt`, `plz`, `email`, `institutionsartId`) VALUES
(1, 'GDB', '$2y$10$QC2JsRyHKvF/lu/l.mY7huRIxKQBhn44qFfc1jd36nPJmF0xWTX3y', 'Cunewalder Straße 3', 'Dresden', '01321', 'gdb@lernsax.de', 1),
(2, 'Test', '$2y$10$VkkEBN35RPBiz4/aArBTyO6pKOz7gnpDJDVjCdBLgDfL6.5z8ltLa', 'Mindestens 3', 'Dresden', '01326', 't@t.t', 1),
(3, 'Muster GmbH', '$2y$10$8GRnDQm8foETyzQY39sqpe31HO7qhzJxFNA7wdgOh5hr/CnpAKXx2', 'Beispiel Allee 12', 'Musterstadt', '01234', 'kontakt@muster.tdl', 2),
(4, 'Muster GmbH1', '$2y$10$EuBKTO3dLTD.TGrdpRwFhe3G/B0m.R1A/qLyAb14pWZv/E0FEFHhW', 'Beispiel Allee 121', 'Musterstadt', '01234', 'kontakt1@muster.tdl', 2),
(5, 'T', '$2y$10$i3QUuenJARCxgzci.w4pWOEl6PsQz/hm2iTpXsaedTglCNAW4uSz2', 'T', 'Dresden', '12345', 'peter@mail.mail', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Institutionsart`
--

CREATE TABLE `Institutionsart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `aufenthaltszeit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `Institutionsart`
--

INSERT INTO `Institutionsart` (`id`, `name`, `aufenthaltszeit`) VALUES
(1, 'Test', 3),
(2, 'Langer Test', 10),
(3, 'kurzer Test', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `QrCode`
--

CREATE TABLE `QrCode` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `tischnummer` int(11) NOT NULL,
  `sitzplätze` int(11) NOT NULL,
  `institutionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `QrCode`
--

INSERT INTO `QrCode` (`id`, `code`, `tischnummer`, `sitzplätze`, `institutionId`) VALUES
(1, '123', 420, 69, 1),
(2, '123', 12, 12, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RememberBenutzer`
--

CREATE TABLE `RememberBenutzer` (
  `authId` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `RememberBenutzer`
--

INSERT INTO `RememberBenutzer` (`authId`, `token`, `id`) VALUES
(1, 'pLK5Qico4LvE1sFb0QC3xNtiYyxvbHspsOvzHn7sqjc1buOAKkYAMsDcx1tHFYgT', 16),
(1, 'Rj4jnso3bEVPOU2RG0DLy6r0xJq4Z2Ahpkdq8Tw8NxSb4zgMlT9gm93lc6TfVGe2', 17),
(1, 'plLEsvUzaW806WM7YqdmONObCCsBBKBCgTbj78Wc7AB1OsZI4r7KLeSvu9jmeQJQ', 18),
(1, 'XR6toZZl2SgnUIyWzcfYKdlfJWiV5nxlo8q7zK5KdkdjDWSlHRMoRCuDIS2LxiGl', 19),
(6, 'bIKag33FfNpsMUXWLUzztp98RftJon4Ulqt0OSzUnUetvDavYAuFup8SmPKABgPn', 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `RememberInstitution`
--

CREATE TABLE `RememberInstitution` (
  `authId` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `RememberInstitution`
--

INSERT INTO `RememberInstitution` (`authId`, `token`, `id`) VALUES
(1, 'TVgvSYvhqHOP2DgmffXPG1Tv0tGiCZ8gqtXsHuJF2ZKYB29p0GNM1wYD4vwXLuPy', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Scan`
--

CREATE TABLE `Scan` (
  `id` int(11) NOT NULL,
  `qrCodeId` int(11) NOT NULL,
  `benutzerId` int(11) NOT NULL,
  `tag` date NOT NULL,
  `uhrzeit` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `Scan`
--

INSERT INTO `Scan` (`id`, `qrCodeId`, `benutzerId`, `tag`, `uhrzeit`) VALUES
(1, 1, 1, '2021-03-05', '00:00:00'),
(2, 1, 1, '2021-03-05', '00:00:00'),
(3, 1, 1, '2021-03-05', '00:00:00'),
(4, 1, 1, '2021-03-05', '00:00:00'),
(5, 1, 1, '2021-03-05', '00:00:00'),
(6, 1, 1, '2021-03-05', '00:00:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Benutzer`
--
ALTER TABLE `Benutzer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `Institution`
--
ALTER TABLE `Institution`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `Institutionsart`
--
ALTER TABLE `Institutionsart`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `QrCode`
--
ALTER TABLE `QrCode`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `RememberBenutzer`
--
ALTER TABLE `RememberBenutzer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `RememberInstitution`
--
ALTER TABLE `RememberInstitution`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `Scan`
--
ALTER TABLE `Scan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Benutzer`
--
ALTER TABLE `Benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `Institution`
--
ALTER TABLE `Institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `Institutionsart`
--
ALTER TABLE `Institutionsart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `QrCode`
--
ALTER TABLE `QrCode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `RememberBenutzer`
--
ALTER TABLE `RememberBenutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `RememberInstitution`
--
ALTER TABLE `RememberInstitution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `Scan`
--
ALTER TABLE `Scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
