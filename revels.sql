-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2012 at 09:46 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `revels`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblCategories`
--

CREATE TABLE IF NOT EXISTS `tblCategories` (
  `cat_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Category id number primary key',
  `cat_name` varchar(1000) NOT NULL,
  `cat_type` int(4) NOT NULL COMMENT '1->cultural 2->non-cultural',
  `cat_head_id` int(11) NOT NULL DEFAULT '900',
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--

INSERT INTO `tblCategories` (`cat_id`, `cat_name`, `cat_type`, `cat_head_id`, `date_of_creation`) VALUES
(1, 'System Admin', 0, 900, '2012-01-13 07:25:52'),
(2, 'Web Admin', 2, 900, '2012-01-18 13:42:51'),
(3, 'Certificates and Prizes', 2, 900, '2012-01-18 15:56:25'),
(4, 'Dance', 1, 900, '2012-01-18 15:56:36'),
(5, 'EQIQ', 1, 900, '2012-01-18 15:56:45'),
(6, 'Fine Arts', 1, 900, '2012-01-18 15:56:53'),
(7, 'Graphics and Design', 2, 900, '2012-01-18 15:57:10'),
(8, 'Hospitality', 2, 900, '2012-01-18 15:57:24'),
(9, 'Human Resources', 2, 900, '2012-01-18 15:57:34'),
(10, 'InfoDesk', 2, 900, '2012-01-18 15:57:45'),
(11, 'Informals', 1, 900, '2012-01-18 15:58:20'),
(12, 'Judges', 2, 900, '2012-01-18 15:58:32'),
(13, 'Literary', 1, 900, '2012-01-18 15:58:53'),
(14, 'Logistics', 2, 900, '2012-01-18 15:59:01'),
(15, 'Media', 2, 900, '2012-01-18 15:59:08'),
(16, 'Music', 1, 900, '2012-01-18 15:59:24'),
(17, 'Outstation Publicity', 2, 900, '2012-01-18 15:59:37'),
(18, 'Photography and Snapit', 1, 900, '2012-01-18 15:59:57'),
(19, 'Publicity and Printing', 2, 900, '2012-01-18 16:00:10'),
(20, 'Sponsorship', 2, 900, '2012-01-18 16:00:20'),
(21, 'Stage Control', 2, 900, '2012-01-18 16:00:32'),
(22, 'Vigilance', 2, 900, '2012-01-18 16:00:41'),
(23, 'X-Venture', 1, 900, '2012-01-18 16:01:13'),
(24, 'Operations', 2, 900, '2012-01-18 16:01:45'),
(25, 'Dramatics', 1, 900, '2012-01-23 18:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblEventHeads`
--

CREATE TABLE IF NOT EXISTS `tblEventHeads` (
  `event_head_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_head_name` varchar(1000) NOT NULL,
  `event_head_regno` bigint(12) NOT NULL,
  `event_head_phone` bigint(12) NOT NULL,
  `event_head_email` varchar(1000) NOT NULL,
  `co_event_head` int(2) NOT NULL DEFAULT '0' COMMENT '0->event head 1->co event head',
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `associated_event` int(12) NOT NULL,
  PRIMARY KEY (`event_head_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `tblEvents`
--

CREATE TABLE IF NOT EXISTS `tblEvents` (
  `event_id` int(4) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(1000) NOT NULL,
  `event_description` text NOT NULL,
  `event_type` int(4) NOT NULL DEFAULT '1' COMMENT '1->cultural 2->non-cultural',
  `cat_id` int(11) NOT NULL,
  `event_max_team_number` int(11) NOT NULL,
  `event_rules` text NOT NULL,
  `event_image` text NOT NULL,
  `remove` int(11) NOT NULL DEFAULT '0',
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
--
--

--
-- Table structure for table `tblOrganiser`
--

CREATE TABLE IF NOT EXISTS `tblOrganiser` (
  `organiser_id` int(10) NOT NULL AUTO_INCREMENT,
  `organiser_name` varchar(200) NOT NULL,
  `organiser_phone` bigint(12) NOT NULL,
  `organiser_regno` bigint(12) NOT NULL,
  `organiser_email` varchar(200) NOT NULL,
  `associated_event` int(2) NOT NULL,
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`organiser_id`),
  UNIQUE KEY `organiser_phone` (`organiser_phone`,`organiser_regno`,`organiser_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
--
--

-- --------------------------------------------------------

--
-- Table structure for table `tblPersonnel`
--

CREATE TABLE IF NOT EXISTS `tblPersonnel` (
  `personnel_id` int(5) NOT NULL AUTO_INCREMENT,
  `personnel_regno` bigint(12) NOT NULL,
  `personnel_name` varchar(1000) NOT NULL,
  `personnel_phone` bigint(12) NOT NULL,
  `personnel_email` varchar(300) NOT NULL,
  `personnel_associated_cat` int(2) NOT NULL,
  `personnel_type` int(2) NOT NULL COMMENT '1 -> admin 2 -> cathead',
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `passchange` int(11) NOT NULL DEFAULT '0' COMMENT '0 -> not changed 1 -> changed',
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`personnel_id`),
  UNIQUE KEY `personnel_regno` (`personnel_regno`,`personnel_phone`,`personnel_email`,`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
--
--

-- --------------------------------------------------------

--
-- Table structure for table `tblResult`
--

CREATE TABLE IF NOT EXISTS `tblResult` (
  `resultId` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `first` int(10) NOT NULL,
  `second` int(10) NOT NULL,
  `third` int(10) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`resultId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
--
--

-- --------------------------------------------------------

--
-- Table structure for table `tblStudent`
--

CREATE TABLE IF NOT EXISTS `tblStudent` (
  `student_delno` int(4) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(1000) NOT NULL,
  `student_regno` bigint(12) NOT NULL,
  `student_email` text NOT NULL,
  `student_phone` bigint(12) NOT NULL,
  `student_college` text NOT NULL,
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_delno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblTeam`
--

CREATE TABLE IF NOT EXISTS `tblTeam` (
  `team_id` int(10) NOT NULL AUTO_INCREMENT,
  `team_delno` text NOT NULL,
  `team_event` int(11) NOT NULL,
  `date_of_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
