-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2016 at 02:11 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetingrooms`
--

CREATE TABLE `meetingrooms` (
  `meetingid` int(3) NOT NULL,
  `roomnumber` varchar(5) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetingrooms`
--

INSERT INTO `meetingrooms` (`meetingid`, `roomnumber`, `confirmed`) VALUES
(27, 'Z139', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(3) NOT NULL,
  `meetingcreator` varchar(100) NOT NULL,
  `roomnumber` varchar(10) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `meetingcreator`, `roomnumber`, `starttime`, `endtime`, `date`, `created`, `modified`) VALUES
(27, 'b5017909', 'Z139', '10:00:00', '12:30:00', '2016-12-20', '2016-12-16 01:41:26', '2016-12-16 01:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(3) NOT NULL,
  `roomnumber` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomnumber`) VALUES
(1, 'A101'),
(2, 'A102'),
(3, 'A103'),
(4, 'A104'),
(5, 'A105'),
(6, 'A106'),
(7, 'A107'),
(8, 'A108'),
(9, 'A109'),
(10, 'A110');

-- --------------------------------------------------------

--
-- Table structure for table `usermeetings`
--

CREATE TABLE `usermeetings` (
  `id` int(3) NOT NULL,
  `empid` varchar(10) NOT NULL,
  `meetingid` int(3) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermeetings`
--

INSERT INTO `usermeetings` (`id`, `empid`, `meetingid`, `confirmed`) VALUES
(2, 'b101010', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `empid` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `empid`, `password`, `firstname`, `lastname`, `email`, `created`, `modified`) VALUES
(6, 'b5017909', '$2y$10$lqB8fTQBOtGO59Oq0SFMReKcathrC7rL4GMCeKJ9.pjlJG8uB46MW', 'James', 'Pirie', 'jgpirie@gmail.com', '2016-12-09 09:59:48', '2016-12-09 10:00:19'),
(7, 'b101010', '$2y$10$INx6I9ybydE0NPie9l8T..3WDB2jyt4Z5LDSuZ1xBd39rpBgddDV6', 'Test', 'User', 'test@user.com', '2016-12-16 01:40:46', '2016-12-16 01:40:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meetingrooms`
--
ALTER TABLE `meetingrooms`
  ADD KEY `meetingid` (`meetingid`),
  ADD KEY `roomnumber` (`roomnumber`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `roomnumber` (`roomnumber`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomnumber` (`roomnumber`);

--
-- Indexes for table `usermeetings`
--
ALTER TABLE `usermeetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`),
  ADD KEY `meetingid` (`meetingid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usermeetings`
--
ALTER TABLE `usermeetings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `meetingrooms`
--
ALTER TABLE `meetingrooms`
  ADD CONSTRAINT `meetingrooms_ibfk_1` FOREIGN KEY (`meetingid`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meetingrooms_ibfk_2` FOREIGN KEY (`roomnumber`) REFERENCES `meetings` (`roomnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usermeetings`
--
ALTER TABLE `usermeetings`
  ADD CONSTRAINT `usermeetings_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `users` (`empid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usermeetings_ibfk_2` FOREIGN KEY (`meetingid`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
