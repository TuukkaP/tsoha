-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Palvelin: 127.0.0.1
-- Luontiaika: 24.04.2013 klo 13:38
-- Palvelimen versio: 5.5.27-log
-- PHP:n versio: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Tietokanta: `peuranie`
--
CREATE DATABASE `peuranie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `peuranie`;

-- --------------------------------------------------------

--
-- Rakenne taululle `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `place_id` int(10) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `date` date NOT NULL,
  `order_start` time NOT NULL,
  `order_end` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Vedos taulusta `orders`
--

INSERT INTO `orders` (`id`, `place_id`, `user_id`, `date`, `order_start`, `order_end`) VALUES
(1, 1, 1, '2013-04-03', '18:07:02', '23:00:00'),
(2, 3, 10, '2013-04-15', '09:00:00', '17:00:00'),
(3, 3, 10, '2013-04-25', '09:00:00', '17:00:00'),
(4, 1, 10, '2013-03-25', '09:00:00', '17:00:00'),
(5, 1, 2, '2013-04-04', '09:00:00', '17:00:00'),
(6, 1, 2, '2013-04-03', '09:00:00', '17:00:00'),
(7, 1, 3, '2013-04-05', '09:00:00', '17:00:00'),
(8, 1, 2, '2013-04-30', '09:00:00', '17:00:00'),
(9, 1, NULL, '2013-04-30', '07:00:00', '07:00:00'),
(10, 1, 10, '2013-04-30', '09:00:00', '17:00:00'),
(11, 1, 10, '2013-04-20', '09:00:00', '17:00:00'),
(12, 2, 2, '2013-04-20', '09:00:00', '17:00:00'),
(13, 3, 10, '2013-04-20', '09:00:00', '17:00:00'),
(14, 2, 1, '2013-04-05', '11:00:00', '18:00:00'),
(15, 2, 2, '2013-04-10', '09:00:00', '17:00:00'),
(16, 1, 1, '2013-04-05', '09:00:00', '17:00:00'),
(17, 2, 2, '2013-04-20', '09:00:00', '17:00:00'),
(18, 2, 1, '2013-04-05', '11:00:00', '18:00:00'),
(20, 1, 2, '2013-04-04', '09:00:00', '17:00:00'),
(21, 3, 1, '2013-04-15', '09:00:00', '17:00:00'),
(22, 3, 2, '2013-04-15', '09:00:00', '17:00:00'),
(23, 1, NULL, '2013-04-08', '09:17:00', '17:10:00'),
(24, 2, NULL, '2013-04-16', '09:17:00', '17:10:00'),
(25, 3, 1, '2013-04-30', '09:00:00', '17:00:00'),
(26, 2, 3, '2013-04-17', '17:00:00', '21:00:00'),
(27, 3, 1, '2016-04-13', '16:15:00', '17:15:00'),
(32, 3, 2, '2017-04-13', '12:00:00', '18:00:00'),
(33, 3, 1, '2018-04-13', '00:00:00', '00:00:00'),
(40, 1, 1, '2013-04-17', '00:00:00', '00:00:00'),
(41, 1, 1, '2013-04-17', '00:00:00', '00:00:00'),
(42, 1, 1, '2013-04-16', '00:00:00', '00:00:00'),
(43, 1, NULL, '2013-04-26', '07:00:00', '07:00:00'),
(44, 1, 0, '2013-04-26', '07:00:00', '07:00:00'),
(48, 1, 1, '2013-04-15', '00:00:00', '00:00:00'),
(49, 2, NULL, '2013-04-22', '07:00:00', '07:00:00'),
(50, 2, 10, '2013-05-01', '07:00:00', '07:00:00'),
(51, 3, 10, '2013-05-01', '07:00:00', '14:00:00'),
(52, 1, NULL, '2013-05-01', '07:00:00', '07:00:00'),
(53, 2, 0, '2013-04-23', '07:00:00', '07:00:00'),
(56, 2, 1, '2013-04-22', '07:00:00', '07:00:00'),
(57, 2, 0, '2013-04-29', '07:00:00', '14:00:00'),
(58, 2, 2, '2013-04-22', '07:00:00', '10:00:00'),
(59, 2, NULL, '2013-04-26', '07:00:00', '15:00:00'),
(60, 2, NULL, '2013-04-24', '07:00:00', '07:00:00'),
(61, 2, NULL, '2013-04-28', '07:00:00', '14:00:00'),
(62, 3, 1, '2013-09-09', '07:00:00', '15:00:00'),
(63, 2, 0, '2013-09-12', '12:00:00', '13:30:00'),
(64, 3, 1, '2013-04-25', '07:00:00', '13:00:00'),
(65, 3, 1, '2013-05-11', '07:00:00', '17:00:00'),
(66, 1, 0, '2013-05-02', '07:00:00', '16:00:00'),
(67, 1, 0, '2013-05-03', '07:00:00', '14:00:00'),
(68, 3, 0, '2013-05-10', '07:00:00', '10:00:00'),
(69, 2, 2, '2013-07-31', '07:00:00', '07:00:00'),
(70, 3, 10, '2013-08-20', '10:00:00', '15:00:00'),
(71, 2, 0, '2013-10-15', '07:00:00', '14:00:00'),
(72, 2, 0, '2013-07-25', '07:00:00', '16:00:00'),
(73, 3, 0, '2013-05-18', '07:00:00', '07:00:00'),
(74, 2, 10, '2013-12-16', '07:00:00', '17:00:00'),
(75, 3, 13, '2013-05-02', '07:00:00', '07:00:00'),
(76, 3, 13, '2013-05-08', '07:00:00', '07:00:00'),
(77, 1, 13, '2013-04-22', '07:00:00', '07:00:00'),
(78, 2, 13, '2013-05-05', '07:00:00', '07:00:00'),
(79, 3, 13, '2013-05-19', '07:00:00', '07:00:00'),
(80, 2, 13, '2013-05-14', '07:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Rakenne taululle `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Vedos taulusta `places`
--

INSERT INTO `places` (`id`, `name`, `address`, `info`) VALUES
(1, 'Paska apteekki', 'Paskakuja 5', 'Infoaaa'),
(2, 'Apteekki', 'Paskempikuja 5', 'Infoaaasadasdasdassad'),
(3, 'Kauniaisten Kauppa', 'ASDASd', '    asdasdas');

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(10) NOT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Users taulu' AUTO_INCREMENT=14 ;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `firstname`, `lastname`, `email`, `address`) VALUES
(1, 'Apina', 'ccbb7cfd9871ac8f4feb4d2ae40c2a2f955058b56c1c5e9063cda2d114d0037d', 'admin', 'etunimi', 'Kaapeli', 'asdasd@asdasd.com', 'asdasdasdasdasd '),
(2, 'Gorilla', 'ccbb7cfd9871ac8f4feb4d2ae40c2a2f955058b56c1c5e9063cda2d114d0037d', 'user', 'Apina', 'Kuukkeli', 'asdasda', 'kumikuja 5'),
(13, 'Duunari', 'f1b89289556625b087dafb7b784c28873c4b2365a988f3b99b8feb382022ffd0', 'user', 'Pekka', 'Kalle', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
