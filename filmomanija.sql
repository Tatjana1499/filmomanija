-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 06:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmomanija`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanstvo`
--

CREATE TABLE `clanstvo` (
  `vrstaClanstvaID` int(10) NOT NULL,
  `nazivClanstva` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clanstvo`
--

INSERT INTO `clanstvo` (`vrstaClanstvaID`, `nazivClanstva`) VALUES
(1, 'nedeljno'),
(2, 'mesecno'),
(3, 'godisnje');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `filmID` int(10) NOT NULL,
  `nazivFilma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rediteljID` int(10) NOT NULL,
  `zanrID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`filmID`, `nazivFilma`, `rediteljID`, `zanrID`) VALUES
(1, 'Riders of Justice', 7, 1),
(2, 'Come True', 10, 5),
(3, 'Identifying Features', 4, 2),
(4, 'Saint Maud', 11, 5),
(5, 'About Endlessness', 1, 2),
(6, 'The Beta Test', 12, 4),
(7, 'Licorice Pizza', 2, 3),
(8, 'Quo Vadis, Aida?', 5, 8),
(9, 'Drive My Car', 3, 2),
(10, 'Pig', 8, 4),
(11, 'State Funeral', 6, 8),
(12, 'No Sudden Move', 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `iznajmljivanje`
--

CREATE TABLE `iznajmljivanje` (
  `korisnikID` int(10) NOT NULL,
  `filmID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `iznajmljivanje`
--

INSERT INTO `iznajmljivanje` (`korisnikID`, `filmID`) VALUES
(1, 2),
(1, 9),
(1, 12),
(3, 4),
(3, 10),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(10) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vrstaClanstvaID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `ime`, `prezime`, `vrstaClanstvaID`) VALUES
(0, 'kor1', 'kor1', 1),
(1, 'Pera', 'Peric', 3),
(2, 'Mika', 'Mikic', 3),
(3, 'Zika', 'Zikic', 1),
(4, 'Marko', 'Markovic', 1),
(5, 'Ilija', 'Ilic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reditelj`
--

CREATE TABLE `reditelj` (
  `rediteljID` int(10) NOT NULL,
  `imeReditelja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezimeReditelja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `drzava` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reditelj`
--

INSERT INTO `reditelj` (`rediteljID`, `imeReditelja`, `prezimeReditelja`, `drzava`) VALUES
(0, 'proba2', 'proba2', 'proba2'),
(1, 'Roy', 'Andersson', 'Svedska'),
(2, 'Paul Thomas', 'Anderson', 'SAD'),
(3, 'Ryusuke', 'Hamaguchi', 'Japan'),
(4, 'Fernanda', 'Valadez', 'Meksiko'),
(5, 'Jasmila', 'Zbanic', 'Bosna i Hercegovina'),
(6, 'Sergey', 'Loznitsa', 'Belorusija'),
(7, 'Anders Thomas', 'Jensen', 'Danska'),
(8, 'Michael', 'Sarnoski', 'SAD'),
(9, 'Steven', 'Soderbergh', 'SAD'),
(10, 'Anthony Scott', 'Burns', 'Kanada'),
(11, 'Rose', 'Glass', 'Velika Britanija'),
(12, 'Jim', 'Cummings', 'SAD');

-- --------------------------------------------------------

--
-- Table structure for table `zanr`
--

CREATE TABLE `zanr` (
  `zanrID` int(10) NOT NULL,
  `nazivZanra` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zanr`
--

INSERT INTO `zanr` (`zanrID`, `nazivZanra`) VALUES
(0, 'proba2'),
(1, 'akcija'),
(2, 'drama'),
(3, 'komedija'),
(4, 'triler'),
(5, 'horor'),
(6, 'porodicni'),
(7, 'biografski'),
(8, 'istorijski'),
(9, 'ljubavni'),
(10, 'misterija');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanstvo`
--
ALTER TABLE `clanstvo`
  ADD PRIMARY KEY (`vrstaClanstvaID`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`filmID`),
  ADD KEY `rediteljID` (`rediteljID`,`zanrID`),
  ADD KEY `zanrID` (`zanrID`);

--
-- Indexes for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  ADD PRIMARY KEY (`korisnikID`,`filmID`),
  ADD KEY `filmID` (`filmID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`),
  ADD KEY `vrstaClanstvaID` (`vrstaClanstvaID`);

--
-- Indexes for table `reditelj`
--
ALTER TABLE `reditelj`
  ADD PRIMARY KEY (`rediteljID`);

--
-- Indexes for table `zanr`
--
ALTER TABLE `zanr`
  ADD PRIMARY KEY (`zanrID`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vrstaClanstva`
--
ALTER TABLE `clanstvo`
  MODIFY `vrstaClanstvaID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `filmID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reditelj`
--
ALTER TABLE `reditelj`
  MODIFY `rediteljID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zanr`
--
ALTER TABLE `zanr`
  MODIFY `zanrID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`zanrID`) REFERENCES `zanr` (`zanrID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`rediteljID`) REFERENCES `reditelj` (`rediteljID`) ON UPDATE CASCADE;

--
-- Constraints for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  ADD CONSTRAINT `iznajmljivanje_ibfk_1` FOREIGN KEY (`korisnikID`) REFERENCES `korisnik` (`korisnikID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `iznajmljivanje_ibfk_2` FOREIGN KEY (`filmID`) REFERENCES `film` (`filmID`) ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`vrstaClanstvaID`) REFERENCES `clanstvo` (`vrstaClanstvaID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
