-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Dez 2019 um 09:06
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
(2, 'eckhardt', 'hannah', '93715d17a0a3ac5dbc553e90926499d1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `item_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `menge` int(255) NOT NULL,
  `total` float NOT NULL,
  `zeitPunkt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `cart`
--

INSERT INTO `cart` (`item_id`, `user_id`, `menge`, `total`, `zeitPunkt`) VALUES
(89, 0, 6, 0, '2019-12-03 17:18:58'),
(89, 0, 6, 0, '2019-12-03 17:20:13'),
(90, 0, 7, 0, '2019-12-03 17:23:51'),
(90, 0, 7, 0, '2019-12-03 17:31:58');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(100) NOT NULL,
  `name_de` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung_de` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `preis` float NOT NULL,
  `dateiname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bestand` int(100) NOT NULL,
  `gesperrt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `name_de`, `name_en`, `beschreibung_de`, `beschreibung_en`, `preis`, `dateiname`, `bestand`, `gesperrt`) VALUES
(89, 'Die Tings', 'the ting tings', 'Tolles Album', 'nice album', 50, 'BlackLight.jpg', 600, 0),
(90, 'Super critical ist ein Album', 'Sper Critical - Studio Album from 2014', 'Das vierte Album  der britischen Band the Ting Tings', 'The fourth Album by the british Band The Ting Tings', 100, 'MatchOfTheDay.jpg', 600, 1),
(91, 'Sounds From Nowhere - Album von 2012', 'Sounds From Nowhere - Album from 2012', 'erstes Album', 'first Album', 150, 'SoundsFromNowhere.jpg', 200, 0),
(92, 'We Started Nothing- Album von 2009', 'We Started Nothing- Album from 2009', 'weiteres Album', 'another Album', 200, 'WeStartetNothing.jpg', 500, 0),
(93, 'Match Of The Day- Album von 2009', 'Match Of The Day- Album from 2009', 'wirklich das erste', 'Really the first one', 250, 'MatchOfTheDay.jpg', 200, 0);

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
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
