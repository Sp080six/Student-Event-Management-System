-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 02:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_event`
--
CREATE DATABASE STUDENT_EVENT;
USE STUDENT_EVENT;
-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `ClubID` int(11) NOT NULL,
  `ClubName` int(25) NOT NULL,
  `ClubHead` int(25) NOT NULL,
  `NumberOfMembers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(50) NOT NULL,
  `EventVenue` varchar(50) NOT NULL,
  `EventDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `EventVenue`, `EventDate`) VALUES
(1, 'Hacknight2', 'Seminar Hall 3', '2023-10-07'),
(2, 'Hacktoberfest 2023', 'Seminar Hall 1', '2023-11-11'),
(3, 'Ingenius', 'Seminar Hall 2', '2023-10-14'),
(4, 'Kodikon', 'Seminar Hall 2', '2023-10-14'),
(6, 'She Summit 2023', 'Seminar Hall 3', '2023-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `event2`
--

CREATE TABLE `event2` (
  `EventName` varchar(50) NOT NULL,
  `EventBuilding` varchar(50) NOT NULL,
  `EventFloor` varchar(50) NOT NULL,
  `EventRoom` varchar(50) NOT NULL,
  `EventDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event2`
--

INSERT INTO `event2` (`EventName`, `EventBuilding`, `EventFloor`, `EventRoom`, `EventDate`) VALUES
('Binary Battle', 'Main Building', 'Ground', 'Seminar Hall 1', '2023-08-12'),
('Hacknight', 'Main Building', 'Ground', '104', '2023-11-04'),
('Ingenius', 'MRD Auditorium', 'Ground', 'A1', '2023-11-04'),
('Kodikon', 'Main Building', 'Third', '306', '2023-10-21'),
('Maaya Inauguaration', 'MRD Auditorium', 'Ground', 'A1', '2023-11-10'),
('She Summit', 'MRD Auditorium', 'Ground', 'A1', '2023-10-07'),
('Tech Trek', 'Main Building', 'Ground', 'Seminar Hall 1', '2023-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GuestName` varchar(25) NOT NULL,
  `Age` int(11) NOT NULL,
  `EventName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `SRN` varchar(13) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Department` varchar(25) NOT NULL,
  `Semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`SRN`, `Name`, `Department`, `Semester`) VALUES
('PES2UG21CS100', 'Ram', 'CSE', 5),
('PES2UG21CS101', 'Shruti', 'CSE', 5),
('PES2UG21CS102', 'Sragvi', 'CSE', 5),
('PES2UG21CS103', 'Spoorthi', 'CSE', 5),
('PES2UG21CS104', 'Shreya', 'CSE', 5),
('PES2UG21CS105', 'Shyam', 'CSE', 7);

-- --------------------------------------------------------

--
-- Table structure for table `registersfor`
--

CREATE TABLE `registersfor` (
  `SRN` varchar(13) NOT NULL,
  `EventName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`ClubID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `event2`
--
ALTER TABLE `event2`
  ADD PRIMARY KEY (`EventName`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GuestName`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`SRN`);

--
-- Indexes for table `registersfor`
--
ALTER TABLE `registersfor`
  ADD PRIMARY KEY (`SRN`,`EventName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SHOW TABLES;
