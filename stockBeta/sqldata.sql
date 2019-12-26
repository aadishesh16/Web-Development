-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2015 at 02:15 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pset7`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL,
  `symbol` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(11) NOT NULL,
  `action` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `symbol`, `shares`, `action`, `time`) VALUES
(6, 'FB', 3, 'buy', '2015-11-02 07:00:04'),
(6, 'goog', 4, 'buy', '2015-11-02 07:04:21'),
(6, 'FB', 6, 'sell', '2015-11-02 07:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL,
  `symbol` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(11) NOT NULL,
  UNIQUE KEY `id_8` (`id`,`symbol`),
  KEY `symbol` (`symbol`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `symbol`, `shares`) VALUES
(3, 'FB', 4),
(3, 'goog', 8),
(6, 'appl', 3),
(6, 'goog', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `cash`) VALUES
(1, 'belindazeng', '$1$50$oxJEDBo9KDStnrhtnSzir0', 0.0000),
(2, 'caesar', '$1$50$GHABNWBNE/o4VL7QjmQ6x0', 0.0000),
(3, 'jharvard', '$1$50$RX3wnAMNrGIbgzbRYrxM1/', 2277.1000),
(4, 'malan', '$1$50$lJS9HiGK6sphej8c4bnbX.', 0.0000),
(5, 'rob', '$1$HA$l5llES7AEaz8ndmSo5Ig41', 0.0000),
(6, 'skroob', '$1$50$euBi4ugiJmbpIbvTTfmfI.', 9000.8600),
(7, 'zamyla', '$1$50$uwfqB45ANW.9.6qaQ.DcF.', 0.0000),
(8, 'aadishesh', '$1$SvAY7rTd$NwVv5eE7f2fQRa2wIceEf0', 0.0000),
(10, 'aadisheshsharma', '$1$tJ6.Z4Es$bat9iNtY6qovJ607LfivC/', 0.0000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

