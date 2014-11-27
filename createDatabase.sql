-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2014 at 04:29 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_info`
--

CREATE TABLE IF NOT EXISTS `address_info` (
`address_id` int(4) NOT NULL,
  `house_no` varchar(15) DEFAULT NULL,
  `street_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `apartment_no` varchar(10) DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `province` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `address_info`
--

INSERT INTO `address_info` (`address_id`, `house_no`, `street_name`, `apartment_no`, `city`, `province`, `zip_code`, `country`) VALUES
(1, '6165', 'Sherbrooke W', '-', 'Montreal', 'Quebec', 'H4B 1M1', 'Canada'),
(2, '1212', 'Av. Des Pins Ouest', '-', 'Montreal', 'Quebec', 'H3G 1A9', 'Canada'),
(3, '1800', 'St. Mathieu', '-', 'Montreal', 'Quebec', 'H3H 2S8', 'Canada'),
(4, '4301', 'Rue de la Roche', '-', 'Montreal', 'Quebec', ' H2J 3H8', 'Canada'),
(5, '10355', 'Avenue de Bois-de-Boulogne', '-', 'Montreal', 'Quebec', 'H4N 1L5', 'Canada'),
(6, '2202', 'Avenue Barclay', '-', 'Montreal', 'Quebec', ' H3S 1J3', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_images`
--

CREATE TABLE IF NOT EXISTS `apartment_images` (
`image_id` int(5) NOT NULL,
  `dwelling_Id` int(6) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_size` varchar(200) NOT NULL,
  `file_type` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `apartment_images`
--

INSERT INTO `apartment_images` (`image_id`, `dwelling_Id`, `file_name`, `file_size`, `file_type`) VALUES
(1, 1, '25-11-2014-1751623174-1416942326.jpg', '24298', 'image/jpeg'),
(2, 2, '25-11-2014-2083539209-1416942467.jpg', '15757', 'image/jpeg'),
(3, 3, '25-11-2014-229986368-1416948293.jpg', '11578', 'image/jpeg'),
(4, 4, '25-11-2014-981023916-1416948467.jpg', '16059', 'image/jpeg'),
(5, 6, '27-11-2014-709063908-1417101914.jpg', '11897', 'image/jpeg'),
(6, 7, '27-11-2014-1166065820-1417102017.jpg', '3968', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bannedusers`
--

CREATE TABLE IF NOT EXISTS `bannedusers` (
`banId` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `description` varchar(1028) CHARACTER SET utf8 DEFAULT NULL,
  `from_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `to_` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bannedusers`
--

INSERT INTO `bannedusers` (`banId`, `user_id`, `description`, `from_`, `to_`) VALUES
(1, 3, 'You have disrespected our policies therefore you h', '2014-11-25 20:54:29', '2014-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
`conversationId` int(6) NOT NULL,
  `user_one` int(6) NOT NULL,
  `user_two` int(6) NOT NULL,
  `time_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`conversationId`, `user_one`, `user_two`, `time_`) VALUES
(1, 1, 2, '2014-11-25 23:06:48'),
(2, 1, 4, '2014-11-25 23:28:52'),
(3, 2, 3, '2014-11-25 23:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reply`
--

CREATE TABLE IF NOT EXISTS `conversation_reply` (
`cr_id` int(6) NOT NULL,
  `sender` int(6) NOT NULL,
  `reply_message` varchar(1000) DEFAULT NULL,
  `time_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `conversationId` int(6) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `conversation_reply`
--

INSERT INTO `conversation_reply` (`cr_id`, `sender`, `reply_message`, `time_`, `conversationId`) VALUES
(1, 1, 'hello fabian', '2014-11-25 23:08:01', 1),
(2, 1, 'how are you?', '2014-11-25 23:08:22', 1),
(3, 2, 'hey ajmer ', '2014-11-25 23:09:14', 1),
(4, 2, 'whats up?', '2014-11-25 23:09:25', 1),
(5, 1, 'i am fine', '2014-11-25 23:09:56', 1),
(6, 1, 'hello roy', '2014-11-25 23:28:52', 2),
(7, 1, 'whats up?', '2014-11-25 23:29:03', 2),
(8, 1, '', '2014-11-25 23:41:07', 2),
(9, 1, '', '2014-11-25 23:41:25', 2),
(10, 2, 'hey hello', '2014-11-25 23:45:36', 1),
(11, 2, 'hello camilo', '2014-11-25 23:47:24', 3),
(12, 2, 'hey ', '2014-11-25 23:47:37', 3),
(13, 2, 'heyyyyyy', '2014-11-25 23:48:17', 1),
(14, 2, 'heeeeeee', '2014-11-25 23:56:33', 3),
(15, 2, 'asfafa', '2014-11-26 01:03:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dwellings`
--

CREATE TABLE IF NOT EXISTS `dwellings` (
`dwelling_Id` int(6) NOT NULL,
  `address_id` int(4) NOT NULL,
  `user_id` int(6) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `no_of_rooms` int(11) DEFAULT NULL,
  `no_of_bathrooms` int(11) DEFAULT NULL,
  `no_of_living_rooms` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `rangeType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dwellings`
--

INSERT INTO `dwellings` (`dwelling_Id`, `address_id`, `user_id`, `type`, `description`, `no_of_rooms`, `no_of_bathrooms`, `no_of_living_rooms`, `price`, `rangeType`) VALUES
(1, 1, 2, 'Apartment', 'Bright, large studios (1 1/2, 2 1/2) for rent in well maintained, quiet building. All dwellings are clean and renovated with hardwood floors. Include hot water, heating, stove, fridge. Laundry room in the building, janitor on the spot. Close to transport and services (metro Vendome and bus 105). Close to Concordia University (Loyola Campus). \r\n\r\nAvailable now, December 1st or January 1st. Price range between $550 and $590 per month. \r\nTo visit call 514-294-5868', 1, 1, 1, 500, 'Rent'),
(2, 2, 1, 'Apartment', 'Large windows frame bright, gorgeous views of Mount Royal and downtown. You?ll feel right at home with an updated kitchen, a renovated bathroom, a balcony and hardwood flooring. Need to get to McGill, Royal Victoria or MGH? Skip transit because they?re all easy walks from La Tour Horizon.\r\n\r\n', 2, 1, 1, 1699, 'Rent'),
(3, 3, 1, 'Apartment', 'includes fridge, stove, oven, washing machine, dryer and a dishwasher; \r\ndoesn''t include electricity \r\n\r\nit''s located on Rene-levesque street and it has a balcony (long one) on the street \r\n\r\n', 1, 1, 1, 1500, 'Rent'),
(4, 4, 3, 'Apartment', 'Super appart 3.5 au coeur du plateau mont royal, entre le Parc Lafontaine et l?avenue Mont Royal 1 chambre ferm?e 1 grand salon cuisine ouverte balcon beaucoup de rangements parquet tr?s lumineux laundry room et garage ? v?lo dans l?immeuble Le loyer comprend les charges Cession de bail Libre ? partir du 22 d?cembre commerces et restaurants ? 3 minutes ? pied pr?s du m?tro Mont-Royal lignes de bus 11 et 14 au pied de l?immeuble Je rentre en Californie le 22 d?cembre, la fin du mois de d?cembre est gratuite. Ideal pour les nouveaux arrivants ? Montr?al: je pr?f?rerais laisser les meubles (table, canap?, lit, bureau, diff?rents meubles ikea achet?s neufs il y a un peu plus d?un an, tous en parfait ?tat) faites moi une offre, et il ne vous restera plus qu?a poser vos valises! ', 2, 3, 2, 390000, 'Sale'),
(6, 5, 4, 'Apartment', 'Disponible 5 1/2 haut de duplex dans une environnement calme,securitere ,deux pas d''ecole et un grand parc \r\n-cuisine en bois et granite \r\n-salle de bain completement renove \r\n-planche bois de franc \r\n-peintur', 3, 1, 1, 1200, 'Rent'),
(7, 6, 4, 'Apartment', 'hello,\r\nRoom for rent in a large apartment 8 and a half. The room has large windows and its own private bathroom ! The House is not furnished but the rest of the apartment is! The apartment is inhabited by three academics, two and a Master Degree .\r\n\r\nIs a 10-15 minute walk from the metro Outremont and ', 1, 1, 1, 350, 'Rent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(6) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `rangeType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phoneNumber`, `username`, `password`, `salt`, `type`, `rangeType`) VALUES
(1, 'Ajmer', 'Singh', 'Ajmer@ajmer.ca', '438 323 2343', 'ajmer', '45FIRt6yMSMKE', '45fee2b5f36b86015a2ab9564e765aa0b582f7c66a74c54c4b153128048bc888', 'Tenant', 'Regular'),
(2, 'Fabian', 'Vergara', 'hg-faver@hotmail.com', '222 324 2344', 'faver', 'd3yTTT.8w5.oo', 'd341cc51ea668a4bd7475905756b864efca1138c6d3e32a0ce0c0357d0f7acc3', 'Landlord', 'Admin'),
(3, 'Some', 'dude', 'Camilo@yahoo.ca', '514 233 3421', 'dude', '1clHbzjXlIRxY', '1ca5f21a442fb85c95de9bfffcaa38851341959ea1dfd38ff9b852aaa630104f', 'Tenant', 'Regular'),
(4, 'Roy', 'Khoury', 'roy@yahoo.ca', '1231231234', 'roy_123', '62bwEQDGc3xOk', '62c52c5b9ea4aecc8f8b5d6b2b9308c14792d56d2ad6fe3956fb580143960e98', 'Tenant', 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_info`
--
ALTER TABLE `address_info`
 ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `apartment_images`
--
ALTER TABLE `apartment_images`
 ADD PRIMARY KEY (`image_id`), ADD KEY `dwelling_Id` (`dwelling_Id`);

--
-- Indexes for table `bannedusers`
--
ALTER TABLE `bannedusers`
 ADD PRIMARY KEY (`banId`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
 ADD PRIMARY KEY (`conversationId`), ADD KEY `user_one` (`user_one`), ADD KEY `user_two` (`user_two`);

--
-- Indexes for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
 ADD PRIMARY KEY (`cr_id`), ADD KEY `conversationId` (`conversationId`), ADD KEY `convo_reply_sender_userId_fk` (`sender`);

--
-- Indexes for table `dwellings`
--
ALTER TABLE `dwellings`
 ADD PRIMARY KEY (`dwelling_Id`), ADD KEY `user_id` (`user_id`), ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_info`
--
ALTER TABLE `address_info`
MODIFY `address_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `apartment_images`
--
ALTER TABLE `apartment_images`
MODIFY `image_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bannedusers`
--
ALTER TABLE `bannedusers`
MODIFY `banId` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
MODIFY `conversationId` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
MODIFY `cr_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dwellings`
--
ALTER TABLE `dwellings`
MODIFY `dwelling_Id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment_images`
--
ALTER TABLE `apartment_images`
ADD CONSTRAINT `apartment_images_ibfk_1` FOREIGN KEY (`dwelling_Id`) REFERENCES `dwellings` (`dwelling_Id`);

--
-- Constraints for table `bannedusers`
--
ALTER TABLE `bannedusers`
ADD CONSTRAINT `bannedusers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`user_one`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`user_two`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
ADD CONSTRAINT `conversation_reply_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversation` (`conversationId`),
ADD CONSTRAINT `convo_reply_sender_userId_fk` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `dwellings`
--
ALTER TABLE `dwellings`
ADD CONSTRAINT `dwellings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `dwellings_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address_info` (`address_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
