-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 04:27 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_activations`
--

CREATE TABLE `account_activations` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `activation_key` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `due_payments`
--

CREATE TABLE `due_payments` (
  `PaymentID` mediumint(8) NOT NULL,
  `PayerID` mediumint(8) NOT NULL,
  `Amount` tinyint(2) NOT NULL,
  `Method` set('cash','venmo') NOT NULL,
  `ReceiverID` mediumint(8) NOT NULL,
  `PaymentDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `due_payments`
--

INSERT INTO `due_payments` (`PaymentID`, `PayerID`, `Amount`, `Method`, `ReceiverID`, `PaymentDateTime`) VALUES
(24, 93, 10, 'cash', 90, '2019-09-03 15:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` mediumint(8) UNSIGNED NOT NULL,
  `Name` varchar(65) NOT NULL,
  `OnCampus` tinyint(1) NOT NULL,
  `Location` varchar(65) NOT NULL,
  `eventDate` date NOT NULL,
  `Type` varchar(32) NOT NULL,
  `PointsWorth` tinyint(3) UNSIGNED NOT NULL,
  `PerHour` tinyint(1) NOT NULL,
  `RegisteredDateTime` datetime NOT NULL,
  `RegisteredByID` mediumint(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `OnCampus`, `Location`, `eventDate`, `Type`, `PointsWorth`, `PerHour`, `RegisteredDateTime`, `RegisteredByID`) VALUES
(88, 'Social', 1, 'GR 3.202', '0000-00-00', '', 5, 0, '2018-10-06 08:28:46', 63),
(87, 'Volunteering Event 1', 1, 'GR 3.204', '0000-00-00', '', 5, 1, '2018-10-03 21:42:12', 63),
(86, 'Harmony', 0, 'Harmony Science Academy', '0000-00-00', '', 10, 1, '2018-01-29 16:32:25', 78),
(85, 'Spring Semester Planning Meeting', 0, 'Conrad High School', '0000-00-00', '', 10, 1, '2018-01-24 21:27:07', 78),
(84, 'Officer Meeting', 1, 'ECS Conference Room', '0000-00-00', '', 5, 0, '2018-01-19 15:15:04', 63),
(116, 'EventEvent', 1, '1', '2019-06-01', 'Volunteering', 5, 1, '2019-04-15 14:04:21', 63),
(115, 'Event5', 1, '1', '2019-08-12', 'Social', 5, 0, '2019-04-09 08:42:42', 63),
(106, 'Event Further', 1, '0501', '2019-05-01', 'Social', 5, 0, '2019-03-26 15:57:03', 63),
(114, 'Event3', 1, '1', '2019-06-04', 'Social', 5, 0, '2019-04-09 08:42:09', 63),
(108, 'Event1', 0, 'State Farm CityLine', '2019-04-05', 'Professional Workshop', 20, 0, '2019-03-29 17:47:47', 63),
(113, 'Event2', 1, '1', '2019-05-11', 'Volunteering', 5, 1, '2019-04-09 08:41:34', 63),
(111, 'social3', 1, '1', '2019-05-03', 'Social', 5, 0, '2019-04-04 13:24:41', 63),
(112, 'social4', 1, '1', '0000-00-00', 'Volunteering', 5, 1, '2019-04-04 13:25:28', 63),
(117, 'EventEvent', 1, '1.102', '0000-00-00', 'Volunteering', 5, 1, '2019-05-16 16:32:12', 63),
(118, 'EventEvent', 1, '1.102', '0000-00-00', 'Volunteering', 5, 1, '2019-05-16 16:32:33', 63),
(119, 'TestTest', 1, '1.102', '0000-00-00', 'General Meeting', 5, 0, '2019-05-16 16:55:33', 63);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `UserID` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Semester` set('Fall','Spring') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `UserID` int(11) DEFAULT NULL,
  `Position` varchar(32) NOT NULL,
  `Executive` tinyint(1) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Strikes` tinyint(4) DEFAULT NULL,
  `TableOrder` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`UserID`, `Position`, `Executive`, `StartDate`, `EndDate`, `Strikes`, `TableOrder`) VALUES
(NULL, 'Academic Chair', 1, '2019-08-11', '2019-08-02', 3, 6),
(NULL, 'SHPE Jr. Elected Chair', 1, NULL, NULL, NULL, 5),
(NULL, 'Corporate Liaison', 1, NULL, NULL, 2, 4),
(91, 'Treasurer', 1, '2019-08-01', '2019-08-09', 1, 3),
(NULL, 'Secretary', 1, '0000-00-00', '0000-00-00', 3, 2),
(63, 'Vice-President', 1, '2019-08-09', '2019-08-17', 5, 1),
(90, 'President', 1, '2019-08-06', '2019-08-22', 2, 0),
(NULL, 'Recruitment and Retention Chair', 0, NULL, NULL, NULL, 8),
(NULL, '', 1, '0000-00-00', '0000-00-00', 0, 7),
(NULL, 'SHPE Jr. Appointed Chair', 0, NULL, NULL, NULL, 9),
(NULL, 'Alumni Liaison', 0, NULL, NULL, NULL, 10),
(NULL, 'School Affairs Chair', 0, NULL, NULL, NULL, 11),
(NULL, 'Public Relations Chair', 0, NULL, NULL, NULL, 12),
(NULL, 'Community Service Chair', 0, NULL, NULL, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `RewardID` mediumint(8) UNSIGNED NOT NULL,
  `RecipientID` mediumint(8) UNSIGNED NOT NULL,
  `OfficerID` mediumint(8) UNSIGNED NOT NULL,
  `EventID` mediumint(8) UNSIGNED NOT NULL,
  `Carpooled` tinyint(1) NOT NULL,
  `Hours` tinyint(3) UNSIGNED NOT NULL,
  `Points` tinyint(3) UNSIGNED NOT NULL,
  `RewardDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`RewardID`, `RecipientID`, `OfficerID`, `EventID`, `Carpooled`, `Hours`, `Points`, `RewardDateTime`) VALUES
(59, 36, 63, 88, 0, 0, 5, '2018-10-06 08:29:18'),
(58, 85, 78, 86, 0, 1, 10, '2018-01-29 17:05:29'),
(57, 82, 78, 86, 0, 1, 10, '2018-01-29 17:00:33'),
(56, 80, 78, 86, 0, 1, 10, '2018-01-29 16:59:26'),
(55, 80, 78, 86, 0, 1, 10, '2018-01-29 16:35:12'),
(54, 83, 78, 86, 0, 1, 10, '2018-01-29 16:34:15'),
(53, 84, 78, 86, 0, 1, 10, '2018-01-29 16:33:11'),
(52, 78, 80, 85, 0, 1, 10, '2018-01-24 21:35:13'),
(51, 80, 78, 85, 1, 1, 15, '2018-01-24 21:27:58'),
(50, 77, 63, 84, 0, 0, 5, '2018-01-19 15:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `ID` mediumint(8) UNSIGNED NOT NULL,
  `FirstName` varchar(16) NOT NULL,
  `LastName` varchar(16) NOT NULL,
  `Company` varchar(32) NOT NULL,
  `position` varchar(32) NOT NULL,
  `Email` varchar(65) NOT NULL,
  `LinkedIn` varchar(32) NOT NULL,
  `Biography` varchar(160) NOT NULL,
  `EventID` mediumint(8) UNSIGNED NOT NULL,
  `RegisteredByUserID` mediumint(8) UNSIGNED NOT NULL,
  `RegisteredDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` mediumint(8) UNSIGNED NOT NULL,
  `FirstName` varchar(65) NOT NULL,
  `LastName` varchar(65) NOT NULL,
  `UTDEmail` varchar(255) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `RegisteredDateTime` datetime NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `UTDEmail`, `Password`, `RegisteredDateTime`, `verified`) VALUES
(36, 'First1', 'Last1', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', '0000-00-00 00:00:00', 1),
(63, 'First2', 'Last2', 'test2@test.com', '098f6bcd4621d373cade4e832627b4f6', '0000-00-00 00:00:00', 1),
(90, 'First3', 'Last3', 'test3@test.com', '098f6bcd4621d373cade4e832627b4f6', '0000-00-00 00:00:00', 1),
(91, 'First4', 'Last4', 'test4@test.com', '098f6bcd4621d373cade4e832627b4f6', '0000-00-00 00:00:00', 1),
(93, 'Hepson', 'Sanchez', 'hepson.sanchez@utdallas.edu', '098f6bcd4621d373cade4e832627b4f6', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_activations`
--
ALTER TABLE `account_activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `due_payments`
--
ALTER TABLE `due_payments`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`Position`),
  ADD UNIQUE KEY `TableOrder` (`TableOrder`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`RewardID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_activations`
--
ALTER TABLE `account_activations`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `due_payments`
--
ALTER TABLE `due_payments`
  MODIFY `PaymentID` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `RewardID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
