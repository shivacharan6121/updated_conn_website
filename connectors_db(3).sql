-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2025 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectors.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `Nomenclature` varchar(30) NOT NULL,
  `make` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `usedqty` int(11) NOT NULL,
  `availableqty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`Nomenclature`, `make`, `quantity`, `usedqty`, `availableqty`) VALUES
('10-646401-035N', 'Amphenol', 20, 10, 10),
('2DC79PBR', 'ITT Cannon', 15, 0, 15),
('2DC79PF173', 'ITT Cannon', 25, 0, 25),
('2DC79SBR', 'ITT Cannon', 15, 0, 15),
('2DC79SF173', 'ITT Cannon', 25, 0, 25),
('801-008-16M6-7PA', 'Glenair', 25, 0, 25),
('801-008-26M17-85PA', 'Glenair', 25, 0, 25),
('801-009-02M6-7SA', 'Glenair', 15, 0, 15),
('801-011-02M17-85SA', 'Glenair', 15, 0, 15),
('801-039-26M6-7PA', 'Glenair', 25, 0, 25),
('8D8RS-15F-19PN', 'SOURIAU', 25, 0, 25),
('8D8RS-21F-39PN', 'SOURIAU', 100, 0, 100),
('8D9P-15F-19SN', 'SOURIAU', 25, 0, 25),
('8D9P-21F-39SN', 'SOURIAU', 100, 0, 100),
('8STA01235PN', 'Amphenol', 10, 0, 10),
('8STA01435PN', 'Amphenol', 10, 0, 10),
('8STA01435SN', 'SOURIAU', 25, 0, 25),
('8STA61235SN', 'Amphenol', 30, 0, 30),
('8STA61435SN', 'Amphenol', 30, 0, 30),
('9P MICRO D', 'ITT Cannon', 15, 0, 15),
('9S MICRO D', 'ITT Cannon', 25, 0, 25),
('D38999-20FB-35PN', 'Amphenol', 20, 0, 20),
('D38999-20FE-35PN', 'Amphenol', 10, 0, 10),
('D38999-20FF-35PN', 'Amphenol', 10, 0, 10),
('D38999-20FG-35PN', 'Amphenol', 10, 0, 10),
('D38999-20WJ-20PA', 'Amphenol', 10, 0, 10),
('D38999-26FA-35BN', 'Amphenol', 10, 0, 10),
('D38999-26FB-35SN', 'Amphenol', 20, 0, 20),
('D38999-26FD-35PN', 'Amphenol', 10, 0, 10),
('D38999-26FE-35AN', 'Amphenol', 10, 0, 10),
('D38999-26FF-35AN', 'Amphenol', 10, 0, 10),
('D38999-26FF-35SN', 'Amphenol', 10, 0, 10),
('D38999-26FH-35PN', 'Amphenol', 10, 0, 10),
('D38999-26FH-55PN', 'Amphenol', 10, 0, 10),
('D38999-26FJ-35PN', 'Amphenol', 10, 0, 10),
('D38999-26WC-98SA', 'Amphenol', 10, 0, 10),
('D38999-26WE-35PN', 'Amphenol', 10, 0, 10),
('D38999-26WF-35SN', 'Amphenol', 10, 0, 10),
('D38999-26WJ-20PA', 'Amphenol', 10, 0, 10),
('D38999-26WJ-20PN', 'Amphenol', 10, 0, 10),
('D38999-31WF-20PN', 'Amphenol', 10, 0, 10),
('D38999/20FA35PN', 'Amphenol', 10, 0, 10),
('D38999/20FA35SN', 'Amphenol', 30, 0, 30),
('D38999/20FB35PN', 'Amphenol', 10, 0, 10),
('D38999/20FB35SN', 'Amphenol', 10, 0, 10),
('D38999/20FB99SN', 'Amphenol', 30, 0, 30),
('D38999/20FE35PN', 'Amphenol', 10, 0, 10),
('D38999/20FE35SN', 'Amphenol', 20, 0, 20),
('D38999/20FF35SN', 'Amphenol', 10, 0, 10),
('D38999/20FJ35PN', 'Amphenol', 10, 0, 10),
('D38999/20MC35PN', 'Amphenol', 30, 0, 30),
('D38999/20MC35SN', 'Amphenol', 10, 0, 10),
('D38999/20MD35SN', 'Amphenol', 10, 0, 10),
('D38999/20MH35SN', 'Amphenol', 10, 0, 10),
('D38999/26FA35PN', 'Amphenol', 30, 0, 30),
('D38999/26FA35SN', 'Amphenol', 30, 0, 30),
('D38999/26FB35PN', 'Amphenol', 30, 0, 30),
('D38999/26FB35SN', 'Amphenol', 30, 0, 30),
('D38999/26FB99PN', 'Amphenol', 30, 0, 30),
('D38999/26FC35PN', 'Amphenol', 30, 0, 30),
('D38999/26FC35SN', 'Amphenol', 30, 0, 30),
('D38999/26FE35PN', 'Amphenol', 30, 0, 30),
('D38999/26FE35SN', 'Amphenol', 30, 0, 30),
('D38999/26FF35PN', 'Amphenol', 10, 0, 10),
('D38999/26MD35PN', 'Amphenol', 30, 0, 30),
('D38999/26MG35SN', 'Amphenol', 30, 0, 30),
('D38999/26WC35PN', 'Amphenol', 10, 0, 10),
('D38999/26WC98PN', 'Amphenol', 30, 0, 30),
('D38999/26WC98SN', 'Amphenol', 10, 0, 10),
('D38999/26WD19PN', 'Amphenol', 10, 0, 10),
('D38999/26WE35SN', 'Amphenol', 10, 0, 10),
('D38999/26WH35SA', 'Amphenol', 10, 0, 10),
('D38999/26WH35SN', 'Amphenol', 10, 0, 10),
('D38999/26WJ35SA', 'Amphenol', 10, 0, 10),
('D38999/26WJ35SB', 'Amphenol', 10, 0, 10),
('D38999/26WJ35SC', 'Amphenol', 10, 0, 10),
('D38999/26WJ35SN', 'Amphenol', 10, 0, 10),
('DD104F1000X', 'Amphenol', 10, 0, 10),
('DD104M1000X', 'Amphenol', 10, 0, 10),
('DD15F1000X', 'Amphenol', 30, 0, 30),
('DD26M1000X', 'Amphenol', 10, 0, 10),
('EVD15F10000-SAX', 'Amphenol', 15, 0, 15),
('EVD15M10000-PAX', 'Amphenol', 15, 0, 15),
('EVD50F10000-SAX', 'Amphenol', 15, 0, 15),
('EVD50M10000-PAX', 'Amphenol', 15, 0, 15),
('M83513 04G 03C', 'ITT Cannon', 25, 0, 25),
('M83513 04H 03C', 'ITT Cannon', 25, 0, 25),
('M83513 11G 02CP', 'ITT Cannon', 15, 0, 15),
('M85049/38-S-13W', 'Amphenol', 10, 0, 10),
('M85049/38-S-23N', 'Amphenol', 10, 0, 10),
('M85049/38-S-23W', 'Amphenol', 10, 0, 10),
('M85049/39-S-13N', 'Amphenol', 10, 0, 10),
('M85049/47-S-20N', 'Amphenol', 10, 0, 10),
('MS27473T20F35PA', 'Amphenol', 10, 0, 10),
('MS27473T20F35PN', 'Amphenol', 10, 0, 10),
('MS3475-L12-10SN', 'Amphenol', 10, 0, 10),
('MS3475L14-19S', 'Amphenol', 30, 0, 30),
('MS3475L1419P', 'Amphenol', 10, 0, 10),
('8STA01435PN', 'SOURIAU', 15, 0, 15),
('8STA01235SN', 'SOURIAU', 25, 0, 25),
('8STA01235PN', 'SOURIAU', 15, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `part_no` varchar(40) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`part_no`, `quantity`) VALUES
('10-646401-035N', 104),
('10-646401-035Ni', 0),
('10-646401-035Nioil', 20),
('101', 20),
('1034', 12),
('109', 1),
('10jddjw', 20),
('123', 12),
('123456', 20),
('20', 1),
('324', 1),
('D38999-20FB-35PN', 20),
('D38999-20FE-35PN', 10),
('D38999-20FF-35PN', 10),
('D38999-20FG-35PN', 10),
('D38999-20WJ-20PA', 10),
('D38999-26FA-35BN', 10),
('D38999-26FB-35SN', 10),
('D38999-26FD-35PN', 10),
('D38999-26FE-35AN', 10),
('D38999-26FF-35AN', 10),
('D38999-26FF-35SN', 10),
('D38999-26FH-35PN', 20),
('D38999-26FH-55PN', 20),
('D38999-26FJ-35PN', 10),
('D38999-26WC-98SA', 10),
('D38999-26WE-35PN', 10),
('D38999-26WF-35SN', 20),
('D38999-26WJ-20PA', 10),
('D38999-26WJ-20PN', 10),
('D38999-31WF-20PN', 10),
('D38999/26WC35PN', 10),
('D38999/26WC98SN', 10),
('D38999/26WD19PN', 10),
('D38999/26WE35SN', 10),
('D38999/26WH35SA', 10),
('D38999/26WH35SN', 10),
('D38999/26WJ35SA', 10),
('D38999/26WJ35SB', 10),
('D38999/26WJ35SC', 10),
('D38999/26WJ35SN', 10),
('DD104F1000X', 10),
('DD104M1000X', 10),
('DD15F1000X', 30),
('DD26M1000X', 10),
('DES109-WE', 20),
('DES1200', 0),
('EVD15F10000-SAX', 15),
('EVD15M10000-PAX', 15),
('EVD50F10000-SAX', 15),
('EVD50M10000-PAX', 15),
('kjkhujgbi', 87),
('M85049/38-S-13W', 10),
('M85049/38-S-23N', 10),
('M85049/38-S-23W', 10),
('M85049/38-S-25W', 10),
('M85049/39-S-13N', 10),
('M85049/47-S-20N', 10),
('MS27473T20F35PA', 10),
('MS27473T20F35PN', 10),
('MS3475-L12-10SN', 10),
('polokf', 10),
('wes-900', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(35) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('user123', 'user@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`part_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
