-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2020 at 09:38 AM
-- Server version: 8.0.20
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SemesterResult`
--

-- --------------------------------------------------------

--
-- Table structure for table `StudentGrade`
--

CREATE TABLE `StudentGrade` (
  `roll` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `course1` varchar(10) NOT NULL,
  `course1mark` float NOT NULL,
  `course1point` float NOT NULL,
  `course1grade` varchar(10) NOT NULL,
  `course2` varchar(10) NOT NULL,
  `course2mark` float NOT NULL,
  `course2point` float NOT NULL,
  `course2grade` varchar(10) NOT NULL,
  `course3` varchar(10) NOT NULL,
  `course3mark` float NOT NULL,
  `course3point` float NOT NULL,
  `course3grade` varchar(10) NOT NULL,
  `course4` varchar(10) NOT NULL,
  `course4mark` float NOT NULL,
  `course4point` float NOT NULL,
  `course4grade` varchar(10) NOT NULL,
  `cgpa` float NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `StudentGrade`
--
ALTER TABLE `StudentGrade`
  ADD PRIMARY KEY (`roll`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
