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
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`, `username`) VALUES
(0, '$2y$10$OCMn12zdgZ0U.GnqE.FNfeOPBei/ovF5lK5u14pAOWFJSVF9D29pO', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int(148) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `dni` varchar(21) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `dni`, `name`, `surname`, `title`, `description`, `password`, `created_at`, `image`) VALUES
(6, '123D', 'hernando', 'herrera', 'tecnico', 'tecnico instalaciones termohidráulicas', '$2y$10$gaJIweo7gDlHfVH/YznLL.3yBNHbPLhNKyUV4FoHtQYRTVkcW0pzS', '2022-09-16 09:30:45', NULL),
(63, 'wetwewewqwedfgsdrfg', 'egwewgerwge', 'gwegwegwe', 'gwegewgwewge', 'wgegwe', '$2y$10$rTU0gtiNOOF7gjVSj0jZYuqmqqxCUItIdWCKM/DKRXmPxnJGifGH6', '2022-09-21 08:48:43', ''),
(64, 'efqfeq', 'fqefq', 'feqfqefq', 'efqefq', 'qefqefq', '$2y$10$R79roQUxe7rpDMdgW1DTiOTsyuqaTwN6ubS8o3bNLxvSlFR552BBu', '2022-09-21 08:53:08', 'imagen.png'),
(65, 'efqfeqfw', 'fqefq', 'feqfqefq', 'efqefq', 'qefqefq', '$2y$10$F4m36UG6/vt/3XEW.wY.L.YNCKt5CACeZMAtYpy3tQy2.fMIhUDiu', '2022-09-21 08:55:26', '1663746926imagen.png'),
(66, 'rtert', 'ertergg', 'regerg', 'ergerg', 'ergerg', '$2y$10$CXMC01EnG8icwvhoMU7ZL.D47l6QtZWUsRZ1kSuluD4TCZdBaOdLi', '2022-09-21 08:59:42', '1663747182imagen.png'),
(67, 'fewfsadf', 'sdfsdfsdfsd', 'fsdfsdfs', 'dfsdfsdf', 'sdsdfsdf', '$2y$10$mq58UZ3ritGX.VjtZpwfVOq8Hcv5dtyZL6exWUZz0jjsuESebN7pu', '2022-09-21 08:59:55', '1663747195');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `id` (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD UNIQUE KEY `id_course` (`id_course`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD KEY `id` (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
