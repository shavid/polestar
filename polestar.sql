-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 10:21 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polestar`
--

-- --------------------------------------------------------

--
-- Table structure for table `requested_bookings`
--

DROP TABLE IF EXISTS `requested_bookings`;
CREATE TABLE IF NOT EXISTS `requested_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `booking_Date` date DEFAULT NULL,
  `start_Time` time DEFAULT NULL,
  `end_Time` time DEFAULT NULL,
  `room` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Requested',
  `band_Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requested_bookings`
--

INSERT INTO `requested_bookings` (`id`, `fname`, `lname`, `mobile`, `email`, `booking_Date`, `start_Time`, `end_Time`, `room`, `status`, `band_Name`) VALUES
(1, 'Greg', 'Holdfast', '07851068945', 'pod.racer@123.com', '2016-03-23', '10:00:00', '15:00:00', 'Blue', 'Accepted', 'Pod Racers'),
(2, 'dave ', 'shpherd', '045454', 'davidjohnshepherd@msn.com', '2016-03-23', '10:00:00', '14:00:00', 'Red', 'Accepted', 'Keyboard Warriors'),
(3, 'Sebulba', 'Dugg', '07851068945', 'pod.racer@123.com', '2016-03-23', '12:00:00', '15:00:00', 'Yellow', 'Accepted', 'Seb & The Dugs'),
(4, 'Salmon', 'Johnson', '07851068945', 'salmon@123.com', '2016-03-23', '17:00:00', '20:00:00', 'Green', 'Accepted', 'Salmon & The Pink'),
(5, 'Chick', 'McGee', '07851068945', 'salmon@123.com', '2016-03-23', '19:00:00', '23:00:00', 'Red', 'Accepted', 'McGee'),
(6, 'Billy', 'Dangerous', '07851068945', 'danger@123.com', '2016-03-24', '17:00:00', '23:00:00', 'Blue', 'Accepted', 'Danger'),
(7, 'Fred', 'Damzel', '07851068945', 'dammer@123.com', '2016-03-24', '15:00:00', '19:00:00', 'Blue', 'Requested', 'Damzels'),
(8, 'Abukaris', 'Tikus', '07851068945', 'dammer@123.com', '2016-03-23', '12:00:00', '14:00:00', 'Blue', 'Requested', 'TikiTikus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`) VALUES
(2, 'Alex', 'accc00554dfedf9180131dd6e6a9ba2dea1a64da767386e61f817cd3712dc58b', '347a2cb3369931c9', 'alex.blamire@icloud.com'),
(3, 'shavid', '81a5cb91824c20e706fd7a5a9d6b5b6752093503ca17ec2f7200131b90879dc9', '7875a8843c26c8a1', 'davidjohnshepherd@msn.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
