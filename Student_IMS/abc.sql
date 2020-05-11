-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 12:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `ParentId` int(11) NOT NULL,
  `StudentAdm` int(11) NOT NULL,
  `FatherName` varchar(50) NOT NULL,
  `MotherName` varchar(50) NOT NULL,
  `Guardian` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mobile` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `Adm` int(6) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MidleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailAddress` varchar(50) NOT NULL,
  `Mobile` int(12) NOT NULL,
  `DoB` date NOT NULL,
  `County` varchar(50) NOT NULL,
  `imagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`Adm`, `FirstName`, `MidleName`, `LastName`, `EmailAddress`, `Mobile`, `DoB`, `County`, `imagename`) VALUES
(5398, 'Haron', 'Muriki', 'Ntogati', 'hmuriki@gmail.com', 720281540, '1998-07-12', 'Nakuru', ''),
(5399, 'Nich', 'Budi', 'Budi', 'nbundi@gmail.com', 701234567, '1998-04-23', 'Nairobi', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `AdmNo` int(6) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mobile` int(12) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `timeCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `AdmNo`, `Email`, `Mobile`, `Password`, `timeCreated`) VALUES
(12, 5398, 'hmuriki@gmail.com', 720281540, '1b96b67922a23246768fc7952de7ae3e', '2020-05-01 21:42:54'),
(13, 5399, 'nbundi@gmail.com', 0, 'e10adc3949ba59abbe56e057f20f883e', '2020-05-03 15:48:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`ParentId`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`Adm`),
  ADD KEY `EmailAddress` (`EmailAddress`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Adm` (`AdmNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `ParentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
