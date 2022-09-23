-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 10:19 AM
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
  `teacher_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` int(15) DEFAULT NULL,
  `start` int(50) NOT NULL,
  `end` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_course`, `teacher_id`, `name`, `description`, `duration`, `start`, `end`) VALUES
(2, 66, 'curso', 'descripcion curso', 12, 1663970400, 1663884000);

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
(66, 'rtert', 'Alex', 'Baik', 'DAW', 'Bó.', '$2y$10$CXMC01EnG8icwvhoMU7ZL.D47l6QtZWUsRZ1kSuluD4TCZdBaOdLi', '2022-09-21 08:59:42', '1663918054download.jpg'),
(68, 'wergwerg', 'wergwerg', 'wergwreg', 'wergwerg', 'admin', '$2y$10$nsfVfGt4qEW8KZyYgZ8ePeS4SnWS/6ayOaYe3NBSuX7aPxHn5o16W', '2022-09-22 06:51:24', '1663822284'),
(69, '3563464364D', 'Nombre', 'Apellidos', 'Telecos', 'Profe telecos', '$2y$10$VNfydqd8Wpr8q2uvgPP6SeBcYVkUErVyU7NefRQnj6S5GUq/4LxAm', '2022-09-23 08:21:50', '1663917710download.jpg');

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
  ADD PRIMARY KEY (`id_course`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`);

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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
