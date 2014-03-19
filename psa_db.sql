-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2014 at 10:32 
-- Server version: 5.6.16
-- PHP Version: 5.5.9

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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Picos'),
(2, 'Salotos'),
(4, 'Užkandžiai');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `item_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `item_type` (`item_type`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `cat_id`, `item_name`, `item_type`) VALUES
(1, 1, 'Margarita', NULL),
(2, 2, 'Salotos su karšta lašiša', NULL),
(3, 1, 'Mafia', NULL),
(4, 1, 'Peperoni', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_extras`
--

CREATE TABLE IF NOT EXISTS `item_extras` (
  `extra_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `cost` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`extra_id`),
  KEY `option_id` (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item_extras`
--

INSERT INTO `item_extras` (`extra_id`, `option_id`, `name`, `cost`) VALUES
(1, 1, 'Papildomi pievagrybiai', '0.50'),
(3, 2, 'Papildomi pievagrybiai', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_options`
--

CREATE TABLE IF NOT EXISTS `item_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `option_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`option_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `item_options`
--

INSERT INTO `item_options` (`option_id`, `item_id`, `option_name`, `price`) VALUES
(1, 1, '30 cm', '8.99'),
(2, 1, '50 cm', '29.99'),
(3, 2, 'Maža porcija', '10.99'),
(5, 2, 'Didelė porcija', '15.00'),
(6, 3, '30 cm', '8.99'),
(7, 4, '50 cm', '29.99'),
(8, 3, '50 cm', '29.99'),
(9, 4, '30 cm', '8.99');

-- --------------------------------------------------------

--
-- Table structure for table `item_pizza_base`
--

CREATE TABLE IF NOT EXISTS `item_pizza_base` (
  `base_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) DEFAULT NULL,
  `base_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `cost` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`base_id`),
  KEY `option_id` (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_pizza_base`
--

INSERT INTO `item_pizza_base` (`base_id`, `option_id`, `base_name`, `cost`) VALUES
(1, 1, 'Įprastas padas', NULL),
(2, 2, 'Įprastas padas', NULL),
(3, 2, 'Itališkas traškus padas', '0.50');

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

--
-- Dumping data for table `PLACES`
--

INSERT INTO `PLACES` (`place_id`, `name`, `description`, `adress`) VALUES
(0, 'Katino Miciaus picerija', 'Isikūrusi VU MIF Baltupių fakulteto foje', 'Didlaukio 47'),
(1, 'CHEM FAKAS', 'Chemikų studentų lyga pristavlia', 'Naugarduko 24');

-- --------------------------------------------------------

--
-- Table structure for table `PLACE_ITEMS`
--

CREATE TABLE IF NOT EXISTS `PLACE_ITEMS` (
  `place_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  PRIMARY KEY (`place_item_id`),
  KEY `item_id` (`item_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `PLACE_ITEMS`
--

INSERT INTO `PLACE_ITEMS` (`place_item_id`, `item_id`, `place_id`, `is_available`) VALUES
(1, 1, 0, 1),
(2, 2, 1, 1),
(3, 3, 0, 1),
(4, 4, 0, 1);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`item_type`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`item_type`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `item_extras`
--
ALTER TABLE `item_extras`
  ADD CONSTRAINT `item_extras_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `item_options` (`option_id`);

--
-- Constraints for table `item_options`
--
ALTER TABLE `item_options`
  ADD CONSTRAINT `item_options_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `item_pizza_base`
--
ALTER TABLE `item_pizza_base`
  ADD CONSTRAINT `item_pizza_base_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `item_options` (`option_id`);

--
-- Constraints for table `PLACE_ITEMS`
--
ALTER TABLE `PLACE_ITEMS`
  ADD CONSTRAINT `PLACE_ITEMS_ibfk_3` FOREIGN KEY (`place_id`) REFERENCES `PLACES` (`place_id`),
  ADD CONSTRAINT `PLACE_ITEMS_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `PLACE_ITEMS_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
