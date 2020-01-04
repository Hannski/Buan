-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Jan 2020 um 17:20
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
  `a_pwmd5` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `superAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `gesperrt` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`a_id`, `a_nname`, `a_vorname`, `a_pwmd5`, `superAdmin`, `gesperrt`) VALUES
(2, 'eckhardt', 'hannah', '93715d17a0a3ac5dbc553e90926499d1', 1, 0),
(13, 'eckhardt', 'hans', 'b1f4f9a523e36fd969f4573e25af4540', 0, 0),
(14, 'ss', 'ss', '1aabac6d068eef6a7bad3fdf50a05cc8', 0, 0),
(15, 'hannah', 'hhjkh', '7e98b8a17c0aad30ba64d47b74e2a6c1', 0, 0),
(16, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0, 0),
(17, 'cc', 'cc', 'e0323a9039add2978bf5b49550572c7c', 0, 0),
(18, 'jdfhjf', 'hfjfhjf', '4b43b0aee35624cd95b910189b3dc231', 0, 0),
(19, 'aa', 'aa', '0cc175b9c0f1b6a831c399e269772661', 0, 0),
(20, 'aa', 'aa', '0cc175b9c0f1b6a831c399e269772661', 0, 0),
(21, 'aa', 'aa', '0cc175b9c0f1b6a831c399e269772661', 0, 0),
(22, 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', 0, 0),
(23, 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', 0, 0),
(24, 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', 0, 0),
(25, 'ss', 'ss', '3691308f2a4c2f6983f2880d32e29c84', 0, 0),
(26, 'ss', 'ss', '3691308f2a4c2f6983f2880d32e29c84', 0, 0),
(27, 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 0, 0),
(28, 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 0, 0),
(29, 'hannah', 'hannah', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0),
(30, 'hannah', 'eckhardt', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0),
(31, 'hannah', 'eckhardt', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0),
(32, 'hannah', 'eckhardt', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0),
(33, 'hannah', 'eckhardt', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0),
(34, 'eckhardt', 'hannah', 'eb09d5e396183f4b71c3c798158f7c07', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `monat` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `jahr` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `u_id` int(100) NOT NULL,
  `bestelldatum` date NOT NULL DEFAULT '0000-00-00',
  `item_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `menge` int(11) NOT NULL,
  `gesperrt` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`id`, `order_id`, `monat`, `jahr`, `u_id`, `bestelldatum`, `item_id`, `menge`, `gesperrt`) VALUES
(1, 13, '1', '2020', 23, '2020-01-03', '89', 5, 0),
(2, 15, '1', '2020', 23, '2020-01-03', '89', 5, 0),
(3, 15, '1', '2020', 23, '2020-01-03', '90', 13, 0),
(4, 15, '1', '2020', 23, '2020-01-03', '91', 2, 0),
(5, 16, '3', '2018', 23, '2018-03-18', '90', 4, 0),
(6, 16, '3', '2018', 23, '2018-03-18', '90', 4, 0),
(7, 16, '1', '2020', 23, '2020-01-03', '89', 4, 0),
(8, 17, '1', '2020', 23, '2020-01-03', '90', 66, 0),
(9, 18, '1', '2020', 23, '2020-01-03', '91', 5, 0),
(10, 18, '1', '2020', 23, '2020-01-03', '93', 7, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellverwaltung`
--

CREATE TABLE `bestellverwaltung` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellverwaltung`
--

INSERT INTO `bestellverwaltung` (`order_id`, `user_id`) VALUES
(9, 23),
(10, 23),
(11, 23),
(12, 23),
(13, 23),
(14, 23),
(15, 23),
(16, 23),
(17, 23),
(18, 23),
(19, 23);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL,
  `item_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `menge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(89, 'teh Tings', 'the ting tings', 'Tolles Album', 'nice album', 50, 'BlackLight.jpg', 20, 0),
(90, 'Super critical ist ein Album', 'Sper Critical - Studio Album from 2014', 'Das vierte Album  der britischen Band the Ting Tings', 'The fourth Album by the british Band The Ting Tings', 100, 'MatchOfTheDay.jpg', 75, 0),
(91, 'Sounds From Nowhere - Album von 2012', 'Sounds From Nowhere - Album from 2012', 'erstes Album', 'first Album', 150, 'SoundsFromNowhere.jpg', 10, 0),
(92, 'We Started Nothing- Album von 2009', 'We Started Nothing- Album from 2009', 'weiteres Album', 'another Album', 200, 'WeStartetNothing.jpg', 10, 0),
(93, 'Match Of The Day- Album von 2009', 'Match Of The Day- Album from 2009', 'wirklich das erste', 'Really the first one', 250, 'MatchOfTheDay.jpg', 0, 0),
(94, 'Mehr raushauen paket', 'get on it package', 'bestes paket', 'best package', 500, 'Download.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pwmd5` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `confirm_datum` date DEFAULT '0000-00-00',
  `gesperrt` tinyint(1) NOT NULL DEFAULT '0',
  `temp_pw` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `msg` varchar(800) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `pwmd5`, `confirm_datum`, `gesperrt`, `temp_pw`, `msg`) VALUES
(23, 'hannes', 'eb09d5e396183f4b71c3c798158f7c07', '2019-12-12', 1, '5db35e5a4c8d01301678ae8b760a6464', 'sSaf'),
(24, 'hannah', 'peter', '2019-12-28', 0, '', ''),
(25, 'katze', 'ee6b4548f10eadbac6e13fe798c4f831', '2019-12-28', 0, '', 'uhu'),
(26, 'uhu', 'ee6b4548f10eadbac6e13fe798c4f831', '2019-12-28', 0, '', 'uhu'),
(27, 'hummel', 'e612686f8244f5aa3edab76c75ce7cfd', '2020-01-01', 0, '', 'kjahsdfsdfsdvcxcsdfg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `useradressen`
--

CREATE TABLE `useradressen` (
  `u_id` int(11) NOT NULL,
  `vorname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nummer` int(50) NOT NULL,
  `plz` int(50) NOT NULL,
  `ort` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `useradressen`
--

INSERT INTO `useradressen` (`u_id`, `vorname`, `nachname`, `strasse`, `nummer`, `plz`, `ort`, `land`, `id`) VALUES
(2, 'Hans', 'Peter', 'Iltisstr.', 2, 87996, 'Kiel', 'BB', 1),
(50, 'Hannah', 'Eckhardt', 'Marthastr', 1, 456465, 'Kiel', 'BB', 31),
(23, 'hans', 'christian', 'folkberg', 6, 667765, 'Berlin', 'AL', 33);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `useradressen`
--
ALTER TABLE `useradressen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `useradressen`
--
ALTER TABLE `useradressen`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
