
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2014 at 11:01 AM
-- Server version: 5.1.61
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u651917881_galdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `gal_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8_lithuanian_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `gal_desc` text COLLATE utf8_lithuanian_ci NOT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`gal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`gal_id`, `user_id`, `name`, `date_created`, `gal_desc`, `is_published`) VALUES
(1, 1, 'Mountains', '2013-03-19 08:36:16', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1),
(2, 2, 'More mountains', '2013-03-13 08:26:39', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc...\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc...', 1),
(3, 1, 'Too much mountains', '2013-03-24 07:52:17', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n', 1),
(4, 3, 'Mountains, mountains everywhere', '2013-03-18 05:31:03', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 1),
(5, 4, 'Guns Replaced with Thumbs-Up', '2013-03-28 20:41:00', '<a href="http://www.thumbsandammo.blogspot.co.uk/">Thumbs and Ammo</a> removes the guns from famous film characters’ hands and replaces them with a thumbs-up. Real tough guys don’t need guns, they just need a positive, can-do attitude.', 1),
(6, 4, 'Googly Eyes on Books', '2013-03-28 20:57:00', 'From <a href="http://googlyeyebooks.tumblr.com/">a blog</a> that combines two of mankind’s greatest achievements: literature and googly eyes.', 0),
(7, 4, 'Pokemons with Nicolas Cage Face', '2013-04-02 20:02:00', '', 0),
(9, 5, '', '0000-00-00 00:00:00', '', 0),
(17, 2, 'asdkjasdkj', '2013-05-18 22:26:47', 'jkbjkjbkbjkjb', 0),
(20, 2, 'A Bit of Paint a Day Keeps the Boring Walls Away', '2013-05-20 08:36:36', '', 0),
(21, 5, 'kljhdjfgdfkfhbdiuohiiu', '2013-05-20 11:27:42', 'iuhiuehfglisdhxoirdshigkes', 0),
(22, 6, 'Testas', '2013-05-20 14:39:08', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `gal_id` varchar(11) COLLATE utf8_lithuanian_ci NOT NULL,
  `pic_name` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `description` text COLLATE utf8_lithuanian_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `sort_position` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `gal_id` (`gal_id`,`pic_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`gal_id`, `pic_name`, `description`, `date_created`, `sort_position`) VALUES
('1', '1.jpg', '1 jpg description', '2013-03-27 03:00:00', 0),
('1', '2.jpg', '2', '2013-03-27 08:00:00', 0),
('1', '3.jpg', '3', '2013-03-27 00:00:00', 0),
('1', '4.jpg', '4', '2013-03-27 00:00:00', 0),
('1', '5.jpg', '', '2013-03-27 00:00:00', 0),
('1', '6.jpg', '', '2013-03-27 00:00:00', 0),
('1', '7.jpg', '', '2013-03-27 00:00:00', 0),
('17', 'img.png', '', '2013-05-19 11:10:19', 0),
('17', 'img1.png', '', '2013-05-19 11:10:30', 0),
('17', 'img2.png', '', '2013-05-19 11:10:47', 0),
('2', '1.jpg', 'asdas', '2013-03-12 04:26:00', 0),
('20', 'img.jpg', '', '2013-05-20 08:37:10', 0),
('20', 'img1.jpg', '', '2013-05-20 08:37:18', 0),
('20', 'img2.jpg', '', '2013-05-20 08:37:24', 0),
('20', 'img3.jpg', '', '2013-05-20 08:37:30', 0),
('20', 'img4.jpg', '', '2013-05-20 08:37:37', 0),
('20', 'img5.jpg', '', '2013-05-20 08:37:45', 0),
('20', 'img6.jpg', '', '2013-05-20 08:37:50', 0),
('20', 'img7.jpg', '', '2013-05-20 08:37:57', 0),
('21', 'img.jpg', '', '2013-05-20 11:40:57', 0),
('22', 'img.jpg', 'žirgai', '2013-05-20 14:39:43', 0),
('4', '1.jpg', 'asdad', '2013-03-19 07:00:00', 0),
('5', '1.jpg', 'By Yossel S L', '0000-00-00 00:00:00', 0),
('5', '2.jpg', 'asdasd', '2013-03-22 00:00:00', 0),
('5', '3.jpg', 'By Pablo M R', '0000-00-00 00:00:00', 0),
('6', '1.jpg', '', '2013-03-28 00:00:00', 0),
('6', '2.jpg', '', '2013-03-27 00:00:00', 0),
('6', '3.jpg', '', '0000-00-00 00:00:00', 0),
('6', '4.jpg', '', '0000-00-00 00:00:00', 0),
('6', '5.jpg', '', '0000-00-00 00:00:00', 0),
('6', '6.jpg', '', '0000-00-00 00:00:00', 0),
('6', '7.jpg', '', '0000-00-00 00:00:00', 0),
('7', '1.jpg', '', '0000-00-00 00:00:00', 0),
('7', '2.jpg', '', '0000-00-00 00:00:00', 0),
('7', '3.jpg', '', '0000-00-00 00:00:00', 0),
('7', '4.jpg', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `side_menu`
--

CREATE TABLE IF NOT EXISTS `side_menu` (
  `item_name` varchar(50) NOT NULL,
  `item_link` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `only_online` tinyint(1) NOT NULL DEFAULT '1',
  `only_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `side_menu`
--

INSERT INTO `side_menu` (`item_name`, `item_link`, `item_id`, `only_online`, `only_admin`) VALUES
('Create a new gallery', 'galleries/create', 1, 1, 0),
('Login', 'users/login', 2, 0, 0),
('Change class', 'users/user_type', 3, 1, 1),
('Register', 'users/register', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) NOT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `member_class` varchar(10) DEFAULT 'User',
  `is_banned` tinyint(1) DEFAULT '0',
  `is_frozen` tinyint(1) NOT NULL DEFAULT '0',
  `is_muted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nick`, `pass`, `date_created`, `member_class`, `is_banned`, `is_frozen`, `is_muted`) VALUES
(1, 'Broken Mafiosi', '1214dd910011ff0de93ec86de70877a4f524fa57', '2013-04-21 18:34:41', 'User', 0, 0, 0),
(2, 'Rocco', 'b4d7ac1a9f76e13502fcff9ce303a9b80c9a1dc3', '2013-04-21 18:30:38', 'User', 0, 1, 0),
(3, 'Solth the master', '960616c382054ba77e11feb86da2b08ef35dfa90', '2013-04-21 18:33:45', 'User', 0, 0, 0),
(4, 'baNaNa', 'fd6a4e1ae07e28a6a1796e1a3d31b349997a0399', '2013-04-21 18:34:00', 'User', 0, 0, 0),
(5, 'admin', 'a3d889824cf70dca4da098ec0af6d3599cd6962d', '2013-04-22 10:25:53', 'Admin', 0, 0, 0),
(6, 'Linas', 'c2ed23c281bd38e874f7da0494bf0d686ba7d03c', '2013-05-20 14:37:49', 'User', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
