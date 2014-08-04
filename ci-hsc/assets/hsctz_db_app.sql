-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2014 at 09:06 AM
-- Server version: 5.5.37-35.1
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hsctz_db_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE IF NOT EXISTS `auth_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `auth_type`
--

INSERT INTO `auth_type` (`id`, `name`) VALUES
(10, 'Administrator'),
(20, 'Management'),
(21, 'Accountant'),
(30, 'Manager'),
(31, 'Stock Controller'),
(40, 'Cashier'),
(50, 'Sales'),
(60, 'Security'),
(70, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `binding`
--

CREATE TABLE IF NOT EXISTS `binding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`) VALUES
(1, 'Uhuru'),
(2, 'Msimbazi'),
(3, 'Upanga'),
(4, 'Rugland'),
(5, 'Mlimani'),
(6, 'Arusha'),
(7, 'Mwanza');

-- --------------------------------------------------------

--
-- Table structure for table `cheque`
--

CREATE TABLE IF NOT EXISTS `cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` date NOT NULL,
  `chq_number` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `name_of_customer` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `pre_status` enum('cleared','not_cleared','','') NOT NULL,
  `post_status` enum('used','started_using','','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_log`
--

CREATE TABLE IF NOT EXISTS `cheque_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_posted` date NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cheque_id` (`cheque_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `manual_invoices`
--

CREATE TABLE IF NOT EXISTS `manual_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `balance` double NOT NULL,
  `entered` tinyint(1) NOT NULL DEFAULT '0',
  `date_entered` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `manual_invoices_progress`
--

CREATE TABLE IF NOT EXISTS `manual_invoices_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `date_issued` date NOT NULL,
  `manual_invoice_id` int(11) NOT NULL,
  `amount_entered` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `item_returned` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `status` enum('checked','unchecked','','') NOT NULL DEFAULT 'unchecked',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_voucher`
--

CREATE TABLE IF NOT EXISTS `sales_voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `total_sale`
--

CREATE TABLE IF NOT EXISTS `total_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_sale` double NOT NULL,
  `audited_total_sale` double NOT NULL,
  `produced` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `auth_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES
(1, '2014-07-04', 'nadhir.bahayan@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f7d033e22ae348aeb5660fc2140aec35850c4da9970', 0, 10, 1),
(2, '2014-07-04', 'nargis@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f7d033e22ae348aeb5660fc2140aec35850c4da9970', 2, 40, 1),
(3, '2014-07-04', 'yusra.said@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 1, 40, 1),
(4, '2014-07-04', 'thalia.hassan@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 3, 40, 1),
(5, '2014-07-04', 'fatma.abdallah@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 1, 40, 1),
(6, '2014-07-04', 'samya.mohammed@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 4, 40, 1),
(7, '2014-07-04', 'saleh.naajy@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 2, 40, 1),
(8, '2014-07-04', 'asia.abdallah@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 4, 40, 1),
(9, '2014-07-04', 'rahim.hassan@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f7d033e22ae348aeb5660fc2140aec35850c4da9970', 0, 21, 1),
(10, '2014-07-04', 'saleh.ally@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 0, 40, 1),
(11, '2014-07-04', 'latifa.mkwachu@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(12, '2014-07-04', 'feisal.sharif@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(13, '2014-07-04', 'maryam.abdallah@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 1),
(15, '2014-07-04', 'abdul.kareem@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(16, '2014-07-04', 'fareed.hemeed@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(17, '2014-07-04', 'aisha.adam@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(18, '2014-07-04', 'habiba.said@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 5, 50, 3),
(19, '2014-07-05', 'hassan.naajy@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 1, 40, 1),
(20, '2014-07-05', 'aysha.nassor@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 3, 40, 1),
(21, '2014-07-10', 'hannan.awadh@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f79c23a2a60eb4e9a8190bd2f5f6e5bc11cbdbe8010', 0, 21, 1),
(22, '2014-07-23', 'fahad@yoteyote.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f7d033e22ae348aeb5660fc2140aec35850c4da9970', 1, 30, 2),
(23, '2014-08-02', 'fadhil@hsctz.com', 'c149aedbd1cf84de81f5ab7437e5b3255edef0f7d033e22ae348aeb5660fc2140aec35850c4da9970', 0, 31, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('not_specified','male','female','') NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `gender`, `user_id`, `img_url`) VALUES
(1, 'Nadhir', 'Bahayan', 'male', 1, 'https://avatars0.githubusercontent.com/u/833644?s=250'),
(2, 'Nargis', 'Ahmed', 'female', 2, 'http://img4-2.myrecipes.timeinc.net/i/recipes/sl/12/04/fresh-strawberry-meringue-cake-sl-l.jpg'),
(3, 'Yusra', 'Said', 'female', 3, ''),
(4, 'Thalia', 'Hassan', 'female', 4, ''),
(5, 'Fatma', 'Abdallah', 'female', 5, ''),
(6, 'Samya', 'Mohammed', 'female', 6, ''),
(7, 'Saleh', 'Naajy', 'male', 7, ''),
(8, 'Asia', 'Abdallah', 'female', 8, ''),
(9, 'Rahim', 'Hassan', 'male', 9, 'https://scontent-a-lhr.xx.fbcdn.net/hphotos-frc3/v/t1.0-9/1044498_10152930467610433_1832308176_n.jpg?oh=337789b27902b365097fa166466c4a80&oe=54430A77'),
(10, 'Saleh', 'Ally', 'male', 10, ''),
(11, 'Latifa', 'Mkwachu', 'female', 11, ''),
(12, 'Feisal', 'Sharif', 'male', 12, ''),
(13, 'Maryam', 'Abdallah', 'female', 13, ''),
(14, 'Fatma', 'Abdallah', 'female', 14, ''),
(15, 'Abdul', 'Kareem', 'male', 15, ''),
(16, 'Fareed', 'Hemeed', 'male', 16, ''),
(17, 'Aisha', 'Adam', 'female', 17, ''),
(18, 'Habiba', 'Said', 'female', 18, ''),
(19, 'Hasssan', 'Naajy', 'male', 19, ''),
(20, 'Aysha', 'Nassor', 'female', 20, ''),
(21, 'Hannan', 'Awadh', 'female', 21, ''),
(22, 'Fahad', 'Kassim', 'male', 22, 'http://www.gravatar.com/avatar/ed73505af8345bb6d383fd5c65e8ca17?s=200 '),
(23, 'Fadhil', 'Fadhil', 'male', 23, 'http://cdni.condenast.co.uk/330x330/k_n/mini-raspberry-chocolate-nests_easy-living_24may13_bt_330x330.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `variance`
--

CREATE TABLE IF NOT EXISTS `variance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `variance` double NOT NULL,
  `date_produced` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cheque_log`
--
ALTER TABLE `cheque_log`
  ADD CONSTRAINT `cheque_log_ibfk_1` FOREIGN KEY (`cheque_id`) REFERENCES `cheque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
