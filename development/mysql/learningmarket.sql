-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2014 at 03:34 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `learningmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` mediumint(8) unsigned NOT NULL,
  `cat_id` mediumint(8) unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `desc` text,
  `thumbnail` text,
  `created_on` datetime NOT NULL,
  `last_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `listing_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `author_id`, `cat_id`, `title`, `slug`, `desc`, `thumbnail`, `created_on`, `last_updated_on`, `is_published`, `price`, `listing_status`) VALUES
(1, 1, 1, 'This is a test', 'this-is-a-test', 'Lorem ipsum lalala ~~', NULL, '2014-08-17 00:00:00', '2014-08-16 14:11:42', 1, 15.85, 0);

-- --------------------------------------------------------

--
-- Table structure for table `listing_category`
--

CREATE TABLE IF NOT EXISTS `listing_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `parent_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `listing_category`
--

INSERT INTO `listing_category` (`id`, `name`, `slug`, `description`, `parent_id`) VALUES
(1, 'Maths', 'maths', NULL, NULL),
(2, 'Physics', 'physics', NULL, NULL),
(3, 'Algebra', 'algebra', NULL, 1),
(4, 'Geometry', 'geometry', NULL, 1),
(5, 'Test', 'test', NULL, 3),
(6, 'Test 2', 'test-2', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE IF NOT EXISTS `purchase_history` (
  `user_id` mediumint(8) unsigned NOT NULL,
  `listing_id` mediumint(8) unsigned NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
