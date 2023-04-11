-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2009 at 03:33 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `omegle`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE IF NOT EXISTS `chats` (
  `userId` int(11) NOT NULL,
  `randomUserId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--


-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE IF NOT EXISTS `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `randomUserId` int(11) DEFAULT NULL,
  `msg` text,
  `sentdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

--
-- Dumping data for table `msgs`
--


-- --------------------------------------------------------

--
-- Table structure for table `oldmsgs`
--

CREATE TABLE IF NOT EXISTS `oldmsgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `randomUserId` int(11) NOT NULL,
  `msg` text NOT NULL,
  `archivedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `oldmsgs`
--

INSERT INTO `oldmsgs` (`id`, `userId`, `randomUserId`, `msg`, `archivedDate`) VALUES
(1, 423, 423, 'hiiiiiiiiiiiii', '2009-09-21 03:29:04'),
(2, 424, 424, 'hello', '2009-09-21 03:29:10'),
(3, 423, 423, 'hiiiiiiiiiii', '2009-09-21 03:29:17'),
(4, 423, 423, 'hiiiiiiiiii', '2009-09-21 03:30:14'),
(5, 424, 424, 'Helloooooooooooo', '2009-09-21 03:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `typing`
--

CREATE TABLE IF NOT EXISTS `typing` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typing`
--

INSERT INTO `typing` (`id`) VALUES
(294),
(299),
(321),
(332),
(340),
(360),
(402),
(410),
(411);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inchat` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=426 ;

--
-- Dumping data for table `users`
--

