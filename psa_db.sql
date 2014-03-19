-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 03:00 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `psa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE IF NOT EXISTS `ORDERS` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` varchar(11) COLLATE utf8_lithuanian_ci NOT NULL,
  `date` date NOT NULL,
  `attribute` text COLLATE utf8_lithuanian_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PLACES`
--

CREATE TABLE IF NOT EXISTS `PLACES` (
  `place_id` int(11) NOT NULL,
  `name` text COLLATE utf8_lithuanian_ci NOT NULL,
  `description` text COLLATE utf8_lithuanian_ci NOT NULL,
  `adress` text COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PLACE_PRODUCTS`
--

CREATE TABLE IF NOT EXISTS `PLACE_PRODUCTS` (
  `product_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `is_available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT`
--

CREATE TABLE IF NOT EXISTS `PRODUCT` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) COLLATE utf8_lithuanian_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `attributes` text COLLATE utf8_lithuanian_ci NOT NULL,
  `description` text COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `name` varchar(25) COLLATE utf8_lithuanian_ci NOT NULL,
  `surname` varchar(25) COLLATE utf8_lithuanian_ci NOT NULL,
  `phone_number` int(9) NOT NULL,
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
  `role` varchar(15) COLLATE utf8_lithuanian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_lithuanian_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`name`, `surname`, `phone_number`, `user_id`, `role`, `password`, `username`) VALUES
('Martynas', 'Mac', 123, 1, 'user', 'a', 'nitmar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
