-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2017 at 08:17 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgpm`
--
CREATE DATABASE IF NOT EXISTS `lgpm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lgpm`;

-- --------------------------------------------------------

--
-- Table structure for table `auditUserLogin`
--

CREATE TABLE `auditUserLogin` (
  `loginId` int(3) NOT NULL COMMENT 'loginId',
  `FK_Username` varchar(24) CHARACTER SET utf8 NOT NULL COMMENT 'FK_Username',
  `loginDate` varchar(19) CHARACTER SET utf8 NOT NULL COMMENT 'loginDate'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auditUserLogin`
--

INSERT INTO `auditUserLogin` (`loginId`, `FK_Username`, `loginDate`) VALUES
(1, 'leeg', '2017-08-07 19:39:11'),
(2, 'leeg', '2017-08-07 20:44:40'),
(3, 'leeg', '2017-08-07 20:46:57'),
(4, 'leeg', '2017-08-07 20:47:36'),
(5, 'leeg', '2017-08-07 20:49:39'),
(6, 'leeg', '2017-08-13 20:21:32'),
(7, 'leeg', '2017-08-13 20:22:02'),
(8, 'leeg', '2017-08-14 19:07:50'),
(9, 'leeg', '2017-08-14 19:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `siteId` int(100) NOT NULL COMMENT 'siteId',
  `siteName` varchar(24) CHARACTER SET utf8 NOT NULL COMMENT 'siteName',
  `siteKey` varchar(42) CHARACTER SET utf8 DEFAULT NULL COMMENT 'siteKey',
  `dateCreated` varchar(19) CHARACTER SET utf8 NOT NULL COMMENT 'dateCreated',
  `hidden` int(1) NOT NULL COMMENT 'hidden'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`siteId`, `siteName`, `siteKey`, `dateCreated`, `hidden`) VALUES
(18, 'ASOS', NULL, '2017-08-06 21:16:26', 0),
(19, 'Facebook', NULL, '2017-08-06 21:16:31', 0),
(20, 'Twitter', NULL, '2017-08-06 21:16:35', 0),
(21, 'Youtube', NULL, '2017-08-06 21:16:39', 0),
(22, 'Lloyds', NULL, '2017-08-06 21:16:46', 0),
(23, 'Amazon', NULL, '2017-08-06 21:16:50', 0),
(24, 'Github', NULL, '2017-08-06 21:16:54', 0),
(34, 'Google', NULL, '2017-08-07 19:40:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(3) NOT NULL COMMENT 'userId',
  `username` varchar(24) CHARACTER SET utf8 NOT NULL COMMENT 'username',
  `password` varchar(42) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`) VALUES
(1, 'leeg', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_monthlyFolders`
-- (See below for the actual view)
--
CREATE TABLE `vw_monthlyFolders` (
`siteName` varchar(24)
,`dateCreated` varchar(19)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_monthlyFolders`
--
DROP TABLE IF EXISTS `vw_monthlyFolders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_monthlyFolders`  AS  select `folders`.`siteName` AS `siteName`,`folders`.`dateCreated` AS `dateCreated` from `folders` order by `folders`.`dateCreated` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditUserLogin`
--
ALTER TABLE `auditUserLogin`
  ADD PRIMARY KEY (`loginId`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`siteId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditUserLogin`
--
ALTER TABLE `auditUserLogin`
  MODIFY `loginId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'loginId', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `siteId` int(100) NOT NULL AUTO_INCREMENT COMMENT 'siteId', AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'userId', AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
