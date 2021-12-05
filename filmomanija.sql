-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 02:18 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteka`
--

-- --------------------------------------------------------

--
-- Table structure for table `citalac`
--

CREATE TABLE `citalac` (
  `citalacID` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `kategorijaClanstvaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `citalac`
--

INSERT INTO `citalac` (`citalacID`, `ime`, `prezime`, `kategorijaClanstvaID`) VALUES
(11, 'Darko', 'Milicic', 2),
(12, 'Boban', 'Rajovic', 2),
(14, 'Sasa', 'Popovic', 1),
(15, 'Lazar', 'Ristovski', 3),
(26, 'Ilija', 'Grahovac', 1),
(27, 'Marko', 'Markovic', 2),
(34, 'Serif', 'Konjevic', 2),
(39, 'Filip', 'Filipovic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategorijaclanstva`
--

CREATE TABLE `kategorijaclanstva` (
  `kategorijaClanstvaID` int(11) NOT NULL,
  `nazivClanstva` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorijaclanstva`
--

INSERT INTO `kategorijaclanstva` (`kategorijaClanstvaID`, `nazivClanstva`) VALUES
(1, 'premijum korisnik'),
(2, 'redovni korisnik'),
(3, 'najosnovnije usluge');

-- --------------------------------------------------------

--
-- Table structure for table `knjiga`
--

CREATE TABLE `knjiga` (
  `idKnjige` int(11) NOT NULL,
  `imeKnjige` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pisacID` int(11) NOT NULL,
  `zanrID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `knjiga`
--

INSERT INTO `knjiga` (`idKnjige`, `imeKnjige`, `pisacID`, `zanrID`) VALUES
(20, 'Lovac na zmajeve', 1, 1),
(21, 'Hiljadu cudesnih sunaca', 1, 1),
(23, 'Biser koji je slomio skoljku', 2, 1),
(24, 'Golden sky', 3, 2),
(25, 'Vanila sky', 3, 2),
(26, 'Stepski vuk', 4, 1),
(27, 'Sidarta', 4, 1),
(28, 'Demian', 4, 1),
(47, 'Lauta i oziljci', 10, 6),
(49, 'Enciklopedija mrtvih', 10, 1),
(61, 'Bobi', 1, 1),
(69, 'A planine odjeknuse', 1, 1),
(71, 'Prvi put s ocem na jutrenje', 9, 5),
(72, 'Isijavanje', 11, 7),
(73, 'Santa Maria Della Salute', 12, 1),
(75, 'Abvg', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pisac`
--

CREATE TABLE `pisac` (
  `pisacID` int(11) NOT NULL,
  `imePisca` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezimePisca` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zemljaPorekla` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pisac`
--

INSERT INTO `pisac` (`pisacID`, `imePisca`, `prezimePisca`, `zemljaPorekla`) VALUES
(1, 'Haled', 'Hoseini', 'Avganistan'),
(2, 'Nadija', 'Hasimi', 'Avganistan'),
(3, 'Zorana', 'Jovanovic', 'Srbija'),
(4, 'Herman', 'Hese', 'Nemačka'),
(9, 'Laza', 'Lazarevic', 'Srbija'),
(10, 'Danilo', 'Kis', 'Srbija'),
(11, 'Stephen', 'King', 'SAD'),
(12, 'Laza', 'Kostic', 'Srbija');

-- --------------------------------------------------------

--
-- Table structure for table `uzeoknjigu`
--

CREATE TABLE `uzeoknjigu` (
  `citalacID` int(11) NOT NULL,
  `idKnjige` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uzeoknjigu`
--

INSERT INTO `uzeoknjigu` (`citalacID`, `idKnjige`) VALUES
(11, 21),
(11, 25),
(11, 28),
(12, 23),
(14, 20),
(14, 24),
(14, 69),
(15, 26),
(15, 49),
(26, 25),
(26, 28);

-- --------------------------------------------------------

--
-- Table structure for table `zanr`
--

CREATE TABLE `zanr` (
  `zanrID` int(11) NOT NULL,
  `imeZanra` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zanr`
--

INSERT INTO `zanr` (`zanrID`, `imeZanra`) VALUES
(1, 'Roman'),
(2, 'Bestseler'),
(5, 'Pripovetka'),
(6, 'Novela'),
(7, 'Horor'),
(8, 'Basna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citalac`
--
ALTER TABLE `citalac`
  ADD PRIMARY KEY (`citalacID`),
  ADD KEY `kategorijaClanstvaID` (`kategorijaClanstvaID`);

--
-- Indexes for table `kategorijaclanstva`
--
ALTER TABLE `kategorijaclanstva`
  ADD PRIMARY KEY (`kategorijaClanstvaID`);

--
-- Indexes for table `knjiga`
--
ALTER TABLE `knjiga`
  ADD PRIMARY KEY (`idKnjige`),
  ADD KEY `pisacID` (`pisacID`),
  ADD KEY `zanrID` (`zanrID`);

--
-- Indexes for table `pisac`
--
ALTER TABLE `pisac`
  ADD PRIMARY KEY (`pisacID`);

--
-- Indexes for table `uzeoknjigu`
--
ALTER TABLE `uzeoknjigu`
  ADD PRIMARY KEY (`citalacID`,`idKnjige`),
  ADD KEY `idKnjige` (`idKnjige`);

--
-- Indexes for table `zanr`
--
ALTER TABLE `zanr`
  ADD PRIMARY KEY (`zanrID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citalac`
--
ALTER TABLE `citalac`
  MODIFY `citalacID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kategorijaclanstva`
--
ALTER TABLE `kategorijaclanstva`
  MODIFY `kategorijaClanstvaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `knjiga`
--
ALTER TABLE `knjiga`
  MODIFY `idKnjige` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `pisac`
--
ALTER TABLE `pisac`
  MODIFY `pisacID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `zanr`
--
ALTER TABLE `zanr`
  MODIFY `zanrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citalac`
--
ALTER TABLE `citalac`
  ADD CONSTRAINT `citalac_ibfk_1` FOREIGN KEY (`kategorijaClanstvaID`) REFERENCES `kategorijaclanstva` (`kategorijaClanstvaID`);

--
-- Constraints for table `knjiga`
--
ALTER TABLE `knjiga`
  ADD CONSTRAINT `knjiga_ibfk_1` FOREIGN KEY (`pisacID`) REFERENCES `pisac` (`pisacID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `knjiga_ibfk_2` FOREIGN KEY (`zanrID`) REFERENCES `zanr` (`zanrID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uzeoknjigu`
--
ALTER TABLE `uzeoknjigu`
  ADD CONSTRAINT `uzeoknjigu_ibfk_1` FOREIGN KEY (`citalacID`) REFERENCES `citalac` (`citalacID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzeoknjigu_ibfk_2` FOREIGN KEY (`idKnjige`) REFERENCES `knjiga` (`idKnjige`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
