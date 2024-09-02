-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 07:38 PM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `medecin`
--

CREATE TABLE `medecin` (
  `id_med` int(8) NOT NULL,
  `nom_med` varchar(50) NOT NULL,
  `email_med` varchar(50) NOT NULL,
  `mp_med` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medecin`
--

INSERT INTO `medecin` (`id_med`, `nom_med`, `email_med`, `mp_med`) VALUES
(11223347, 'yassine', 'yassine1999@gmail.com', 'azertyuiopp');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id_pat` int(8) NOT NULL,
  `nom_pat` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `prenom_pat` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `tel_pat` varchar(80) NOT NULL,
  `email_pat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL,
  `mp_pat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL,
  `date_nais` date DEFAULT NULL,
  `sexe` enum('M','F') CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id_pat`, `nom_pat`, `prenom_pat`, `tel_pat`, `email_pat`, `mp_pat`, `date_nais`, `sexe`) VALUES
(12345686, 'ahmed', 'ali', '11111118', 'ahmed@gmail.com', 'azerazer', '1999-12-12', 'M'),
(12345687, 'vvvvv', 'vvvvv', '12345678', 'aaa@gmail.com', 'aaaaaaaa', '1999-12-12', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `id_rdv` int(8) NOT NULL,
  `id_pat` int(8) NOT NULL,
  `date_RDV` date NOT NULL,
  `heure_RDV` time NOT NULL,
  `etat_rdv` enum('accepter','refuser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id_med`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_pat`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `fk1` (`id_pat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id_med` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11223348;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_pat` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12345688;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id_rdv` int(8) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_pat`) REFERENCES `patient` (`id_pat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
