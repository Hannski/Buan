-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Nov 2019 um 11:34
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `eckhardt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `a_id` int(100) NOT NULL,
  `a_nname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `a_vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `a_pwmd5` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`a_id`, `a_nname`, `a_vorname`, `a_pwmd5`) VALUES
(1, 'eckhardt', 'hannah', 'hallo');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(100) NOT NULL,
  `preis` float NOT NULL,
  `dateiname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dateipfad` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `preis`, `dateiname`, `dateipfad`) VALUES
(1, 20, '', ''),
(3, 15, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items_language`
--

CREATE TABLE `items_language` (
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `art_id` int(100) NOT NULL,
  `id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `items_language`
--

INSERT INTO `items_language` (`language`, `info`, `art_id`, `id`, `name`) VALUES
('de', 'Wollsocken mit hohem Bund', 1, 1, 'Wollsocken'),
('en', 'woolsocks with high rim', 1, 2, 'Wool Socks');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `items_language`
--
ALTER TABLE `items_language`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `items_language`
--
ALTER TABLE `items_language`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
