-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Jan 2020 um 14:23
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
(15, 'hannah', 'hhjkh', '7e98b8a17c0aad30ba64d47b74e2a6c1', 0, 0),
(17, 'cc', 'cc', 'e0323a9039add2978bf5b49550572c7c', 0, 0),
(20, 'Mueller', 'Armin', '4124bc0a9335c27f086f24ba207a4912', 0, 1),
(35, 'Maier', 'Jana', 'f5d7e2532cc9ad16bc2a41222d76f269', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `u_id` int(100) NOT NULL,
  `item_id` int(12) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`id`, `order_id`, `u_id`, `item_id`, `menge`) VALUES
(1, 37, 26, 89, 3),
(2, 38, 26, 90, 5),
(3, 38, 26, 91, 13),
(4, 38, 26, 92, 2),
(5, 38, 26, 89, 12),
(6, 39, 28, 90, 23),
(7, 41, 28, 89, 44),
(8, 41, 28, 90, 336),
(9, 41, 28, 91, 444),
(10, 41, 28, 92, 222);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellverwaltung`
--

CREATE TABLE `bestellverwaltung` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellverwaltung`
--

INSERT INTO `bestellverwaltung` (`order_id`, `user_id`, `datum`) VALUES
(35, 26, '2020-01-04'),
(36, 26, '2020-01-04'),
(37, 26, '2020-01-04'),
(38, 26, '2020-01-04'),
(39, 28, '2020-01-05'),
(40, 28, '2020-01-05'),
(41, 28, '2015-01-05');

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
  `gesperrt` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `name_de`, `name_en`, `beschreibung_de`, `beschreibung_en`, `preis`, `dateiname`, `bestand`, `gesperrt`) VALUES
(89, 'teh Tings', 'the ting tings', 'Tolles Album', 'nice album', 50, 'BlackLight.jpg', -99984, 0),
(90, 'Super critical ist ein Album', 'Sper Critical - Studio Album from 2014', 'Das vierte Album  der britischen Band the Ting Tings', 'The fourth Album by the british Band The Ting Tings', 100, 'MatchOfTheDay.jpg', -392339, 0),
(91, 'Sounds From Nowhere - Album von 2012', 'Sounds From Nowhere - Album from 2012', 'erstes Album', 'first Album', 150, 'SoundsFromNowhere.jpg', 2513, 0),
(92, 'We Started Nothing- Album von 2009', 'We Started Nothing- Album from 2009', 'weiteres Album', 'another Album', 200, 'WeStartetNothing.jpg', -175222, 0),
(93, 'Match Of The Day- Album von 2009', 'Match Of The Day- Album from 2009', 'wirklich das erste', 'Really the first one', 250, 'MatchOfTheDay.jpg', 8000, 0),
(94, 'Mehr raushauen paket', 'get on it package', 'bestes paket', 'best package', 500, 'flight_sitzplatz.JPG', 100000, 0),
(95, 'dd', 'dd', 'df', 'adf', 8, 'abfrage_bestellungen.JPG', 55555, 0),
(96, 'ss', 'ss', 'sAS', 'DS', 44, 'Bildschirmfoto von 2019-08-10 12-06-19.png', 55, 0),
(97, 'ss', 'ss', 'sAS', 'DS', 44, 'Bildschirmfoto von 2019-08-10 12-06-19.png', 55, 0);

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
  `temp_pw` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg` varchar(800) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `pwmd5`, `confirm_datum`, `gesperrt`, `temp_pw`, `msg`) VALUES
(23, 'hannes', 'eb09d5e396183f4b71c3c798158f7c07', '2019-12-12', 1, '5db35e5a4c8d01301678ae8b760a6464', 'sSaf'),
(24, 'hannah', 'peter', '2019-12-28', 0, '', ''),
(25, 'katze', 'ee6b4548f10eadbac6e13fe798c4f831', '2019-12-28', 0, '', 'uhu'),
(26, 'uhu', 'ee6b4548f10eadbac6e13fe798c4f831', '2019-12-28', 1, '5eb529d6933ce1e201a529c5aa856c8b', 'uhu'),
(27, 'hummel', 'e612686f8244f5aa3edab76c75ce7cfd', '2020-01-01', 0, '', 'kjahsdfsdfsdvcxcsdfg'),
(28, 'hans', 'f2a0ffe83ec8d44f2be4b624b0f47dde', '2015-01-05', 0, NULL, 'oh');

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
(26, 'aa', 'aa', 'asdasd', 4, 3456345, 'sfsadfsdf', 'AT', 1),
(28, 'ss', 'ss', 'ss', 5, 345, 'saf', 'BS', 2);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_orderId` (`order_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `order_id` (`order_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indizes für die Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `useradressen`
--
ALTER TABLE `useradressen`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `bestellungen_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `bestellverwaltung` (`order_id`),
  ADD CONSTRAINT `bestellungen_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bestellungen_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints der Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  ADD CONSTRAINT `bestellverwaltung_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints der Tabelle `useradressen`
--
ALTER TABLE `useradressen`
  ADD CONSTRAINT `useradressen_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
