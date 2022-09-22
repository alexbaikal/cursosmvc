-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 10:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `NID` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASSWORD` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`NID`, `NAME`, `PASSWORD`) VALUES
('123', 'admin', 'admin'),
('admin', 'admin', 'admin'),
('root', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `checkinoutinfo`
--

CREATE TABLE `checkinoutinfo` (
  `SI_NO` int(11) NOT NULL,
  `NAME` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NID` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ROOMNO` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ROOMTYPE` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CAPACITY` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHECKEDIN` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHECKEDOUT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRICEDAY` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTALDAYS` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTALPRICE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkinoutinfo`
--

INSERT INTO `checkinoutinfo` (`SI_NO`, `NAME`, `EMAIL`, `PHONE`, `ADDRESS`, `NID`, `ROOMNO`, `ROOMTYPE`, `CAPACITY`, `CHECKEDIN`, `CHECKEDOUT`, `PRICEDAY`, `TOTALDAYS`, `TOTALPRICE`) VALUES
(16, '3', '3', '3', '3', '3', '12', '12', '12', '2021-12-06', '2021-12-06', '12', '1', '12'),
(17, '2', '2', '2', '2', '2', '9', '9', '9', '2021-12-06', '2021-12-06', '9', '1', '9'),
(18, '4', '4', '4', '4', '4', '11', 'Non-Ac', 'Double', '2021-12-06', '2021-12-16', '500', '11', '5500'),
(19, '8', '8', '8', '8', '8', '11', 'Non-Ac', 'Double', '2021-12-06', '2021-12-07', '500', '2', '1000'),
(20, '3', '3', '3', '3', '3', '11', 'Non-Ac', 'Double', '2021-12-06', '2021-12-06', '500', '1', '500'),
(21, '2', '3', '2', '2', '2', '13', 'Ac', '12', '2020-12-01', '2020-12-31', '12', '31', '372'),
(22, '2', '3', '2', '2', '2', '13', 'Ac', '12', '2020-09-01', '2020-11-30', '12', '91', '1092'),
(23, '2', '3', '2', '2', '2', '13', 'Ac', '12', '2013-07-01', '2021-11-30', '12', '155', '1860'),
(24, '23', '3', '2', '2', '2', '13', 'Ac', '12', '2021-12-06', '2021-12-19', '12', '22', '4884'),
(25, 'Md. Mursalin', 'mursa@gamil.com', '015555', 'Dhaka, Bangladesh', 'mursalin', '1', 'AC', 'Single', '2021-12-01', '2021-12-10', '1500', '10', '15000'),
(26, 'Md. Mursalin', 'mursa@gamil.com', '015555', 'Dhaka, Bangladesh', 'mursalin', '11', 'Non-Ac', 'Double', '2021-12-02', '2021-12-19', '500', '22', '4884'),
(27, 'mursalin', 'mursalin@gmail.com', 'mursalin', 'mursalin', 'mursalin', '111', 'AC', 'Double', '2021-11-30', '2021-12-18', '1000', '19', '19000'),
(28, 'mursalin', 'mursalin@gmail.com', 'mursalin', 'mursalin', 'mursalin', '2', 'AC-Room', 'Double', '2021-11-28', '2021-12-08', '2000', '11', '22000'),
(29, '1', '1', '1', '1', '1', '1', 'AC', 'Single', '2021-11-29', '2021-12-17', '1500', '19', '28500'),
(30, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '1', 'AC', 'Single', '2021-12-17', '2021-12-19', '1500', '22', '4884'),
(31, '1', '1', '1', '1', '1', '111', 'AC', 'Double', '2021-11-28', '2021-12-19', '1000', '22', '4884'),
(32, '4', '4', '4', '4', '4', '12', '12', '12', '2021-12-18', '2021-12-19', '12', '22', '4884'),
(33, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '123', '1222', '222', '2021-11-30', '2021-12-25', '222', '26', '5772'),
(34, '1', '1', '1111', '1', '1', '123', '1222', '222', '2021-11-28', '2021-12-19', '222', '22', '4884'),
(35, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '1', 'AC', 'Single', '2021-11-29', NULL, '1500', NULL, NULL),
(36, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '11', 'Non-Ac', 'Double', '2021-11-29', NULL, '500', NULL, NULL),
(37, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '12', '12', '12', '2021-11-29', NULL, '12', NULL, NULL),
(38, 'mursalin', 'mursalin@gmail.com', '01222222', 'Dhaka, Bangladesh', 'mursalin', '111', 'AC', 'Double', '2021-12-19', NULL, '1000', NULL, NULL),
(39, '1', '1', '1111', '1', '1', '123', '1222', '222', '2021-12-19', NULL, '222', NULL, NULL),
(40, 'mursalin', 'mursalin@gmail.com', '0122', 'Dhaka, Bangladesh', 'mursalin', '1111', 'dc', '2', '2022-09-09', '2022-09-09', '23', '1', '23');

-- --------------------------------------------------------

--
-- Table structure for table `customerinfo`
--

CREATE TABLE `customerinfo` (
  `NAME` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customerinfo`
--

INSERT INTO `customerinfo` (`NAME`, `NID`, `PASSWORD`, `EMAIL`, `PHONE`, `ADDRESS`) VALUES
('123', '1', '1', '1', '1111', '1'),
('4', '4', '4', '4', '4', '4'),
('a', 'a', 'a', 'a', 'a', 'a'),
('mursalin', 'mursalin', 'mursalin', 'mursalin@gmail.com', '0122', 'Dhaka, Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo`
--

CREATE TABLE `employeeinfo` (
  `NAME` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employeeinfo`
--

INSERT INTO `employeeinfo` (`NAME`, `NID`, `PASSWORD`, `EMAIL`, `ADDRESS`, `PHONE`) VALUES
('1', '1', '1', '1', '1', '1'),
('123', '111', '1111', '111', '111', '111'),
('2', '2', '2', '2', '2', '2'),
('3', '3', '3', '3', '3', '3'),
('Md. Mursalin', 'mursalin', 'mursalin', 'mur@gmail.com', 'dhaka, bangla', '01222222'),
('rakib', 'rakib', 'rakib', 'hasan@gmail.com', 'dhaka', '012323');

-- --------------------------------------------------------

--
-- Table structure for table `roominfo`
--

CREATE TABLE `roominfo` (
  `ROOM_NO` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CAPACITY` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRICE_DAY` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roominfo`
--

INSERT INTO `roominfo` (`ROOM_NO`, `TYPE`, `CAPACITY`, `PRICE_DAY`, `STATUS`) VALUES
('1', 'AC', 'Single', '1500', 'Booked'),
('11', 'Non-Ac', 'Double', '500', 'Booked'),
('111', 'AC', 'Double', '1000', 'Booked'),
('1111', 'dc', '2', '23', 'Available'),
('12', '12', '12', '12', 'Booked'),
('123', '1222', '222', '222', 'Booked'),
('13', 'Ac', '12', '12', 'Available'),
('2', 'AC-Room', 'Double', '2000', 'Available'),
('3', 'AC', 'Double', '600', 'Available'),
('9', '9', '9', '9', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `checkinoutinfo`
--
ALTER TABLE `checkinoutinfo`
  ADD PRIMARY KEY (`SI_NO`);

--
-- Indexes for table `customerinfo`
--
ALTER TABLE `customerinfo`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `employeeinfo`
--
ALTER TABLE `employeeinfo`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `roominfo`
--
ALTER TABLE `roominfo`
  ADD PRIMARY KEY (`ROOM_NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkinoutinfo`
--
ALTER TABLE `checkinoutinfo`
  MODIFY `SI_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
