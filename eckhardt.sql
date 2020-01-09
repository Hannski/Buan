-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Jan 2020 um 09:26
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
  `gesperrt` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`a_id`, `a_nname`, `a_vorname`, `a_pwmd5`, `superAdmin`, `gesperrt`) VALUES
(1, 'eckhardt', 'hannah', '93715d17a0a3ac5dbc553e90926499d1', 1, 0),
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
  `menge` int(11) NOT NULL,
  `b_gesperrt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`id`, `order_id`, `u_id`, `item_id`, `menge`, `b_gesperrt`) VALUES
(1, 1, 28, 89, 2, 0),
(4, 2, 28, 89, 7, 0),
(5, 2, 28, 94, 6, 0),
(6, 2, 28, 90, 4, 0),
(7, 2, 28, 91, 4, 0),
(8, 2, 28, 93, 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellverwaltung`
--

CREATE TABLE `bestellverwaltung` (
  `order_id` int(50) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bestellverwaltung`
--

INSERT INTO `bestellverwaltung` (`order_id`, `datum`) VALUES
(1, '2020-01-07'),
(2, '2015-01-07');

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
(89, 'Kuechenkonzert', 'Kitchen Concert', '30 Downloads, 30 Aufkleber (selbstklebend, 2-farbig) ', '30 downloads, 30 stickers (self-adhering, dual-toned)', 50, 'kuchenkonzert.jpg', 91, 0),
(90, 'Flurkonzert', 'Hallway Concert', '50 Aufkleber, 50 Downloads, 5 Flaschenoeffner, 5 Audiokassetten', '50 stickers, 50 downloads, 5 bottle openers, 5 tapes', 100, 'flur.jpg', 96, 0),
(91, 'Wohnzimmerkonzert', 'Living Room Concert', '50 Downloads, 20 bedruckte Beutel, 10 Motifshirts, 10 CDs, 50 Postkarten', '50 downloads,20 printed tote bags, 10 printed shirts, 10 CDs, 50 postcards', 150, 'wohnzimmer.jpg', 46, 0),
(93, 'Kneipenkonzert', 'Pub Concert', '100 Downloads, 100 Kurze, 50 Motifshirts, 25 CDS, 60 Feuerzeuge', '100 Downloads, 100 shots, 50 printes shirts, 25 CDs, 60 lighters', 250, 'kneipe.jpg', 99, 0),
(94, 'Dachbodenkonzert', 'Attic Concert', '100 Downloads, 25 CDs, 5 Audiokassetten oder 5 Lathe-Cut 7\", 25 Motifshirts', '100 downloads, 25 CDs, 5 tapes or 5 lathe-cut 7\", 25 printed shirts', 200, 'dachboden.jpg', 94, 0),
(101, 'as', 'sas', 'as', 'dsf', 6, 'Unbenannt.JPG', 56, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pwmd5` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_datum` date DEFAULT '0000-00-00',
  `gesperrt` tinyint(1) NOT NULL DEFAULT '0',
  `temp_pw` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg` varchar(800) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `pwmd5`, `confirm_datum`, `gesperrt`, `temp_pw`, `msg`) VALUES
(28, 'hans', 'b2fe440cb7a0b127f1a90ffea296313b', '2015-01-05', 0, NULL, 'Mein Name ist hans Mueller. Ich habe grosses interresse an einem Job bei Ihnen. Meine Handznummer lauetet: 09889 097 778. Rufen Sie gerne an.'),
(29, 'Werner', '80d5f512d443c9573b5a408fb01d2e3a', '2020-01-15', 1, NULL, 'Hallo, ich bin es. Werner. Ich hatte letzte Woche meine Nummer bei Peter Hochmann hinterlassen. Er meinte ich soll mich nochmal melden. VG'),
(31, 'Maria', '84c63835ca2fcac8636cf7d36aa48fa4', '2019-07-16', 0, NULL, 'Maria Sanchez. 989 786 654. Ich hatte mit Peter gesprochen...'),
(32, 'Nelida', '1753ec1889f70aa87845cc5bfd3b4409', '2020-01-13', 0, NULL, 'Nelida Hruiyga. ich sollte mich melden, meine Nummer habt ihr');

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
  `plz` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `useradressen`
--

INSERT INTO `useradressen` (`u_id`, `vorname`, `nachname`, `strasse`, `nummer`, `plz`, `ort`, `land`, `id`) VALUES
(28, 'Hans', 'Mueller', 'Im Broog', 897, '67886', 'Statthausen', 'GD', 3),
(29, 'Werner', 'Irishman', 'Countryroad', 1000, '39183', 'Schull', 'IE', 4),
(31, 'Maria', 'Sanchez', 'Steinweg', 445, 'JU89I', 'Barcelona', 'ES', 5),
(32, 'Nelida', 'Hruiyga', 'kaschtschstr', 2, '8U77ZT', 'Prag', 'CZ', 6);

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
  ADD PRIMARY KEY (`order_id`);

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
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `bestellverwaltung`
--
ALTER TABLE `bestellverwaltung`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `useradressen`
--
ALTER TABLE `useradressen`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
