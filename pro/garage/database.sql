-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 01:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `idEmp` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `salaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`idEmp`, `email`, `name`, `salaire`) VALUES
(3, 'moemen@esprit.tn', 'moemen', 150);

-- --------------------------------------------------------

--
-- Table structure for table `garag`
--

CREATE TABLE `garag` (
  `ID_garage` int(11) NOT NULL,
  `Nom_garage` varchar(255) NOT NULL,
  `Date_garage` varchar(255) NOT NULL,
  `Prix_garage` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garag`
--

INSERT INTO `garag` (`ID_garage`, `Nom_garage`, `Date_garage`, `Prix_garage`, `id`) VALUES
(2, 'garage', '2022-11-01', '250', 3),
(3, 'garage voiture', '2022-11-01', '250', 3),
(4, 'garage produit', '2022-11-09', '250', 3),
(5, 'aaaa', '2022-11-02', '5555', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmp`);

--
-- Indexes for table `garag`
--
ALTER TABLE `garag`
  ADD PRIMARY KEY (`ID_garage`),
  ADD KEY `fk_garage_user` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `garag`
--
ALTER TABLE `garag`
  MODIFY `ID_garage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `garag`
--
ALTER TABLE `garag`
  ADD CONSTRAINT `fk_garage_user` FOREIGN KEY (`id`) REFERENCES `employe` (`idEmp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
