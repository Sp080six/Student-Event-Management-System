-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 08:08 AM
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
-- Database: `crud`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEventDetailsWithOtherTable` ()   BEGIN
    SELECT 
        p.Srn,
        p.Name AS ParticipantName,
        p.Department,
        p.Semester,
        r.EventName AS RegisteredEvent,
        d.DomainName
    FROM
        participant p
    LEFT JOIN
        registerfor r ON p.Srn = r.Srn
    LEFT JOIN
        domain d ON r.DomainId = d.DomainId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEventDetailsWithParticipants` ()   BEGIN
    SELECT 
        e.EventName,
        e.RoomNo,
        e.Building,
        e.Floor,
        e.DateOfEvent,
        e.ClubId,
        c.ClubName,
        c.ClubHead,
        c.NumberOfMembers,
        g.Name AS GuestName,
        g.Age,
        p.Srn AS ParticipantSrn,
        p.Name AS ParticipantName,
        p.Department,
        p.Semester
    FROM
        Event e
    LEFT JOIN
        Club c ON e.ClubId = c.ClubId
    LEFT JOIN
        Guest g ON e.EventName = g.EventName
    LEFT JOIN
        RegisterFor r ON e.EventName = r.EventName
    LEFT JOIN
        Participant p ON r.Srn = p.Srn;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `ClubId` int(11) NOT NULL,
  `ClubName` varchar(25) NOT NULL,
  `ClubHead` varchar(25) NOT NULL,
  `NumberOfMembers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`ClubId`, `ClubName`, `ClubHead`, `NumberOfMembers`) VALUES
(1, 'Acm', 'Surabhi', 50),
(2, 'Shunya', 'Chandana', 150),
(3, 'CodeChef', 'Yuvaraj', 70),
(4, 'Kannada Kutta', 'Mahesh', 200);

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `DomainId` int(11) NOT NULL,
  `DomainName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`DomainId`, `DomainName`) VALUES
(1, 'Math'),
(2, 'Clutural'),
(3, 'Code'),
(4, 'Innovation');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventName` varchar(25) NOT NULL,
  `RoomNo` varchar(25) NOT NULL,
  `Building` varchar(25) NOT NULL,
  `Floor` varchar(25) NOT NULL,
  `DateOfEvent` date NOT NULL,
  `ClubId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventName`, `RoomNo`, `Building`, `Floor`, `DateOfEvent`, `ClubId`) VALUES
('Anveshana', '1', 'MRD Block', 'Ground', '2023-11-23', 2),
('BinaryBattle', '1', 'Main Block', '1', '2023-11-20', 3),
('Codeit', '2', 'Main Block', '1', '2023-11-20', 3),
('Janapada', '3', 'Main Block', '1', '2023-11-21', 4);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `EventName` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`EventName`, `Name`, `Age`) VALUES
('Anveshana', 'Ananya', 22),
('BinaryBattle', 'Ravi', 54),
('BinaryBattle', 'Saptami', 25);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `Srn` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Department` varchar(25) NOT NULL,
  `Semester` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`Srn`, `Name`, `Department`, `Semester`) VALUES
('PES2UG21CS501', 'Shreya', 'CSE', '5'),
('PES2UG21CS506', 'Shreya P', 'CSE', '5'),
('PES2UG21CS514', 'Shruti', 'CSE', '5'),
('PES2UG21EC557', 'Surabhi', 'EC', '5'),
('PES3UG21BC004', 'Aditya', 'Bcom', '5'),
('PESUG21CS536', 'Spoorthi', 'CSE', '5');

--
-- Triggers `participant`
--
DELIMITER $$
CREATE TRIGGER `check_srn_format` BEFORE INSERT ON `participant` FOR EACH ROW BEGIN
    IF NEW.Srn NOT LIKE 'PES2UG2%' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid input: Srn must start with PES2UG2';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `partof`
--

CREATE TABLE `partof` (
  `DomainId` int(11) NOT NULL,
  `ClubId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partof`
--

INSERT INTO `partof` (`DomainId`, `ClubId`) VALUES
(1, 2),
(2, 4),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `registerfor`
--

CREATE TABLE `registerfor` (
  `Srn` varchar(25) NOT NULL,
  `EventName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registerfor`
--

INSERT INTO `registerfor` (`Srn`, `EventName`) VALUES
('PES2UG21CS501', 'Anveshana'),
('PES2UG21EC557', 'Anveshana'),
('PES2UG21EC557', 'BinaryBattle'),
('PES3UG21BC004', 'Anveshana'),
('PES3UG21BC004', 'BinaryBattle'),
('PES3UG21BC004', 'Janapada'),
('PESUG21CS536', 'Codeit');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `SponsorName` varchar(25) NOT NULL,
  `SponsorContact` bigint(11) NOT NULL,
  `SponsorAmount` int(11) NOT NULL,
  `SponsorStartDate` date NOT NULL,
  `SponsorEndDate` date NOT NULL,
  `EventName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`SponsorName`, `SponsorContact`, `SponsorAmount`, `SponsorStartDate`, `SponsorEndDate`, `EventName`) VALUES
('BD', 7896541230, 2000, '2023-11-07', '2024-11-07', 'Janapada'),
('DP', 8956231476, 9000, '2023-11-06', '2024-11-04', 'BinaryBattle'),
('Mrd', 456987123, 80000, '2023-11-01', '2024-11-27', 'Anveshana'),
('S', 8745213692, 7000, '2023-07-03', '2023-11-16', 'BinaryBattle'),
('V', 4563211563, 4000, '2023-11-18', '2023-11-21', 'Codeit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`ClubId`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`DomainId`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventName`),
  ADD KEY `ClubId` (`ClubId`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`EventName`,`Name`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`Srn`);

--
-- Indexes for table `partof`
--
ALTER TABLE `partof`
  ADD PRIMARY KEY (`DomainId`,`ClubId`),
  ADD KEY `ClubId` (`ClubId`);

--
-- Indexes for table `registerfor`
--
ALTER TABLE `registerfor`
  ADD PRIMARY KEY (`Srn`,`EventName`),
  ADD KEY `EventName` (`EventName`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`SponsorName`),
  ADD KEY `EventName` (`EventName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `ClubId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `DomainId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`ClubId`) REFERENCES `club` (`ClubId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`EventName`) REFERENCES `event` (`EventName`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partof`
--
ALTER TABLE `partof`
  ADD CONSTRAINT `partof_ibfk_1` FOREIGN KEY (`DomainId`) REFERENCES `domain` (`DomainId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `partof_ibfk_2` FOREIGN KEY (`ClubId`) REFERENCES `club` (`ClubId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `registerfor`
--
ALTER TABLE `registerfor`
  ADD CONSTRAINT `registerfor_ibfk_1` FOREIGN KEY (`EventName`) REFERENCES `event` (`EventName`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `registerfor_ibfk_2` FOREIGN KEY (`Srn`) REFERENCES `participant` (`Srn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`EventName`) REFERENCES `event` (`EventName`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
