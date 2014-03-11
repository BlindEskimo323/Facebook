-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 01:33 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `CircleMembers`
--

CREATE TABLE `CircleMembers` (
  `CircleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  KEY `CircleID` (`CircleID`,`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Circles`
--

CREATE TABLE `Circles` (
  `CircleID` int(11) NOT NULL AUTO_INCREMENT,
  `Owner` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`CircleID`),
  KEY `Owner` (`Owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Sender` int(11) NOT NULL,
  `Receiver` int(11) NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `Sender` (`Sender`),
  KEY `Receiver` (`Receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `Sender` int(11) NOT NULL,
  `Receiver` int(11) NOT NULL,
  `Response` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `Sender` (`Sender`,`Receiver`),
  KEY `Receiver` (`Receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Circles`
--
ALTER TABLE `Circles`
  ADD CONSTRAINT `circles_ibfk_1` FOREIGN KEY (`CircleID`) REFERENCES `CircleMembers` (`CircleID`),
  ADD CONSTRAINT `circles_ibfk_2` FOREIGN KEY (`Owner`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Receiver`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Requests`
--
ALTER TABLE `Requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`Receiver`) REFERENCES `Users` (`UserID`);