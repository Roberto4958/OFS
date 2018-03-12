-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2018 at 05:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OFS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `Id` int(5) NOT NULL,
  `ItemID` int(4) NOT NULL,
  `Amount` int(6) NOT NULL,
  `userID` int(4) NOT NULL,
  `countyID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`Id`, `ItemID`, `Amount`, `userID`, `countyID`) VALUES
(1, 1, 2, 1, 1),
(2, 1, 7, 1, 1),
(3, 2, 3, 1, 1),
(4, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `Id` int(4) NOT NULL,
  `Name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`Id`, `Name`) VALUES
(3, 'Dairy'),
(1, 'Fruits'),
(4, 'Grains'),
(2, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `Drones`
--

CREATE TABLE `Drones` (
  `Id` int(4) NOT NULL,
  `Availability` datetime NOT NULL,
  `countyID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Drones`
--

INSERT INTO `Drones` (`Id`, `Availability`, `countyID`) VALUES
(1, '2018-03-04 12:34:00', 1),
(2, '2018-03-04 12:34:00', 1),
(3, '2018-03-04 12:34:00', 1),
(4, '2018-03-04 12:34:00', 1),
(5, '2018-03-04 12:34:00', 1),
(6, '2018-03-04 12:34:00', 1),
(7, '2018-03-04 12:34:00', 1),
(8, '2018-03-04 12:34:00', 1),
(9, '2018-03-04 12:34:00', 1),
(10, '2018-03-04 12:34:00', 1),
(11, '2018-03-04 12:34:00', 1),
(12, '2018-03-04 12:34:00', 2),
(13, '2018-03-04 12:34:00', 2),
(14, '2018-03-04 12:34:00', 2),
(15, '2018-03-04 12:34:00', 2),
(16, '2018-03-04 12:34:00', 2),
(17, '2018-03-04 12:34:00', 2),
(18, '2018-03-04 12:34:00', 2),
(19, '2018-03-04 12:34:00', 2),
(20, '2018-03-04 12:34:00', 2),
(21, '2018-03-04 12:34:00', 2),
(22, '2018-03-04 12:34:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `GuestCart`
--

CREATE TABLE `GuestCart` (
  `Id` int(5) NOT NULL,
  `ItemID` int(4) NOT NULL,
  `Amount` int(6) NOT NULL,
  `guestSession` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GuestCart`
--

INSERT INTO `GuestCart` (`Id`, `ItemID`, `Amount`, `guestSession`) VALUES
(1, 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `GuestSession`
--

CREATE TABLE `GuestSession` (
  `Id` int(4) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GuestSession`
--

INSERT INTO `GuestSession` (`Id`, `Time`) VALUES
(1, '2018-03-04 12:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE `Items` (
  `Id` int(4) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `CategoryName` varchar(120) NOT NULL,
  `Price` double(4,2) NOT NULL,
  `Weight` double(4,2) NOT NULL,
  `Amount` int(7) NOT NULL,
  `countyID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Items`
--

INSERT INTO `Items` (`Id`, `Name`, `CategoryName`, `Price`, `Weight`, `Amount`, `countyID`) VALUES
(1, 'apple', 'Fruits', 1.29, 0.33, 10000, 1),
(2, 'Strawberry', 'Fruits', 4.84, 2.00, 10000, 1),
(3, 'whitegrape', 'Fruits', 3.29, 1.00, 10000, 1),
(4, 'pomegranate', 'Fruits', 1.99, 1.33, 10000, 1),
(5, 'blackberry', 'Fruits', 2.99, 2.33, 10000, 1),
(6, 'blueberry', 'Fruits', 9.99, 3.00, 10000, 1),
(7, 'watermelon', 'Fruits', 2.99, 5.00, 10000, 1),
(8, 'apple', 'Fruits', 1.29, 0.33, 10000, 2),
(9, 'Strawberry', 'Fruits', 4.84, 2.00, 10000, 2),
(10, 'whitegrape', 'Fruits', 3.29, 1.00, 10000, 2),
(11, 'pomegranate', 'Fruits', 1.99, 1.33, 10000, 2),
(12, 'blackberry', 'Fruits', 2.99, 2.33, 10000, 2),
(13, 'blueberry', 'Fruits', 9.99, 3.00, 10000, 2),
(14, 'watermelon', 'Fruits', 2.99, 5.00, 10000, 2),
(15, 'lettuce', 'Vegetables', 0.99, 0.50, 10000, 2),
(16, 'avacado', 'Vegetables', 2.99, 1.00, 10000, 2),
(17, 'cucumber', 'Vegetables', 1.99, 1.00, 10000, 2),
(18, 'onion', 'Vegetables', 1.99, 1.00, 10000, 2),
(19, 'lettuce', 'Vegetables', 0.99, 0.50, 10000, 1),
(20, 'avacado', 'Vegetables', 2.99, 1.00, 10000, 1),
(21, 'cucumber', 'Vegetables', 1.99, 1.00, 10000, 1),
(22, 'onion', 'Vegetables', 1.99, 1.00, 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supportedCountys`
--

CREATE TABLE `supportedCountys` (
  `Id` int(4) NOT NULL,
  `Name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supportedCountys`
--

INSERT INTO `supportedCountys` (`Id`, `Name`) VALUES
(2, 'San Mateo'),
(1, 'Santa Clara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(4) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `firstName` varchar(120) NOT NULL,
  `lastName` varchar(120) NOT NULL,
  `County` varchar(120) NOT NULL,
  `Country` varchar(120) NOT NULL,
  `State` varchar(120) NOT NULL,
  `City` varchar(120) NOT NULL,
  `streetAddress` varchar(120) NOT NULL,
  `Password` char(64) NOT NULL,
  `Salt` char(10) NOT NULL,
  `authToken` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Email`, `firstName`, `lastName`, `County`, `Country`, `State`, `City`, `streetAddress`, `Password`, `Salt`, `authToken`) VALUES
(1, 'user1@gmail.com', 'Tom', 'Smith', 'Santa Clara', 'United States', 'California', 'Mountain View', '440 moffett blvd', 'cc5813115ed95e02c011e3b3364a4d59ba7f0234ccfca9f98ebda6c17e259868', '0123456789', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `Drones`
--
ALTER TABLE `Drones`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `GuestCart`
--
ALTER TABLE `GuestCart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `GuestSession`
--
ALTER TABLE `GuestSession`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `supportedCountys`
--
ALTER TABLE `supportedCountys`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Drones`
--
ALTER TABLE `Drones`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `GuestCart`
--
ALTER TABLE `GuestCart`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `GuestSession`
--
ALTER TABLE `GuestSession`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Items`
--
ALTER TABLE `Items`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `supportedCountys`
--
ALTER TABLE `supportedCountys`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
