-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb17.awardspace.net
-- Generation Time: May 21, 2019 at 02:01 AM
-- Server version: 5.7.20-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2311052_registrar`
--

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
-- Table structure for table `Officers`
--

CREATE TABLE `Officers` (
  `UserID` int(11) NOT NULL,
  `Position` varchar(32) NOT NULL,
  `Start Date` date NOT NULL,
  `End Date` date NOT NULL,
  `Strikes` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Officers`
--

INSERT INTO `Officers` (`UserID`, `Position`, `Start Date`, `End Date`, `Strikes`) VALUES
(63, 'Athletics Chair', '0000-00-00', '0000-00-00', 0),
(79, 'SHPE Jr. Chair', '0000-00-00', '0000-00-00', 0),
(78, 'Vice-President', '0000-00-00', '0000-00-00', 0),
(80, 'SHPE Jr. Appointed Chair', '0000-00-00', '0000-00-00', 0),
(81, 'President', '0000-00-00', '0000-00-00', 0),
(85, 'School Affairs', '0000-00-00', '0000-00-00', 0),
(88, 'House_Officer4', '0000-00-00', '0000-00-00', 0),
(89, 'House_Officer5', '0000-00-00', '0000-00-00', 0);

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
  `Officer` tinyint(1) NOT NULL,
  `Position` varchar(65) NOT NULL,
  `RegisteredDateTime` datetime NOT NULL,
  `RegisteredByUserID` varchar(65) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `UTDEmail`, `Password`, `Officer`, `Position`, `RegisteredDateTime`, `RegisteredByUserID`) VALUES
(36, 'test', 'test', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 0, '', '0000-00-00 00:00:00', ''),
(63, 'firstName', 'lastName', 'test2@test.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Athletics Chair', '0000-00-00 00:00:00', ''),
(79, 'Magaly', 'Narvaez', 'mxn151230@utdallas.edu', 'a5cede18505e9083fb431f4cb561b134', 1, 'SHPE Jr. Chair', '2018-01-22 14:14:00', '78'),
(78, 'Hepson', 'Sanchez', 'hms160230@utdallas.edu', '886e631541a09114e30cac35f8eb3bf3', 1, 'Vice-President', '2018-01-22 14:07:02', '63'),
(80, 'Gabriel', 'Barron', 'gab150130@utdallas.edu', '4262fdc3fcd809d4004bec80d1aec035', 1, 'SHPE Jr. Appointed Chair', '2018-01-22 14:16:05', '78'),
(81, 'Carlos', 'Esponda', 'cfe160030@utdallas.edu', '9a8d90c698fea843eaa0a8fad991f0fb', 1, 'President', '2018-01-22 14:17:19', '78'),
(82, 'Mariajose', 'Plascencia', 'mgp170030@utdallas.edu', '06d80eb0c50b49a509b49f2424e8c805', 0, '', '2018-01-22 14:18:52', '78'),
(83, 'Carlos', 'Morin', 'cem170630@utdallas.edu', '54fad3c22f965d4d7a996498e504865b', 0, '', '2018-01-29 16:29:53', '78'),
(84, 'Orlando', 'Chavez', 'odc150030@utdallas.edu', 'ae03eb098cc1d47c17aa02eac314f06c', 0, '', '2018-01-29 16:30:56', '78'),
(85, 'Jose', 'Vargas', 'jav150430@utdallas.edu', '8b3de3c30d17afdeb04c47bdab73beb6', 1, 'School Affairs', '2018-01-29 17:04:21', '78'),
(86, 'First', 'Last', '123@utdallas.edu', '2ca63cddd54f9490efad22421891a9d1', 0, '', '2019-03-13 17:48:28', '63'),
(87, 'First1', 'Last1', '456@utdallas.edu', 'house', 0, '', '2019-03-13 17:53:53', '63'),
(88, 'First4', 'Last4', 'last4@utdallas.edu', '$2y$10$ssSBTbfBNqRpeEuY/VNiCO74h', 1, 'House_Officer4', '2019-03-13 18:08:09', '63'),
(89, 'First5', 'Last5', 'Last5@utdallas.edu', '$2y$10$4ITSQDyNZE21SwZCAd5GmeV/d', 1, 'House_Officer5', '2019-03-13 18:08:47', '63');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

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
  MODIFY `UserID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
