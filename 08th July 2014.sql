-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 08, 2014 at 12:09 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hsc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE `auth_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `auth_type`
--

INSERT INTO `auth_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Management'),
(3, 'Manager'),
(4, 'Cashier'),
(5, 'Sales'),
(6, 'Security'),
(7, 'Normal\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `binding`
--

CREATE TABLE `binding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `binding`
--

INSERT INTO `binding` (`id`, `date`, `branch_id`, `user_id`, `amount`) VALUES
(1, '2014-07-05', 1, 1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
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
(4, 'Mlimani'),
(5, 'Rugland'),
(6, 'Arusha'),
(7, 'Mwanza');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `user_id`) VALUES
(1, '2014-07-04', 'Makuli', 'Suleiman', 15000, 7, 1),
(2, '2014-07-04', 'Luku', 'Hassan', 50000, 7, 1),
(4, '2014-07-07', 'sdfsfd', 'gfsge', 232, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES
(1, '2014-07-04', 1, 0, 'Nargis Said logged in.'),
(2, '2014-07-04', 1, 0, 'Nargis Said logged in.'),
(3, '2014-07-04', 0, 7, 'Daily Sale : 4000000 for 2014-07-04 by Nargis Said'),
(4, '2014-07-04', 0, 7, 'Edited Daily Sale : 4500000 for 2014-07-04 by Nargis Said'),
(5, '2014-07-04', 1, 7, 'Daily Expense : 15000 for 2014-07-04'),
(6, '2014-07-04', 1, 7, 'Daily Expense : 50000 for 2014-07-04'),
(7, '2014-07-04', 0, 7, 'Manual Invoice: -50000 by Nargis Said'),
(8, '2014-07-04', 1, 7, 'Returned Exchange on 2014-07-04'),
(9, '2014-07-04', 1, 7, 'Added : Muhammad Abbas in the Database'),
(10, '2014-07-04', 1, 7, 'Nargis Said sold 1200000 on 2014-07-04'),
(11, '2014-07-05', 1, 0, 'Nargis Said logged in.'),
(12, '2014-07-05', 1, 0, 'Nargis Said logged in.'),
(13, '2014-07-05', 1, 0, 'Nargis Said logged in.'),
(14, '2014-07-05', 1, 0, 'Nargis Said logged in.'),
(15, '2014-07-05', 1, 0, 'Nargis Said logged in.'),
(16, '2014-07-05', 0, 1, 'Binding Amount : 3000 for 2014-07-05 by Nargis Said'),
(17, '2014-07-08', 1, 1, 'Daily Expense : 343434 for 2014-07-08'),
(18, '2014-07-08', 1, 1, 'Daily Expense : 232 for 2014-07-07'),
(19, '2014-07-08', 0, 1, 'Deleted Expense : 343,434 for dgdfhfh by Nargis Said'),
(20, '2014-07-08', 1, 0, 'Nargis Said logged in.');

-- --------------------------------------------------------

--
-- Table structure for table `manual_invoices`
--

CREATE TABLE `manual_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `entered` tinyint(1) NOT NULL DEFAULT '0',
  `date_entered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manual_invoices`
--

INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `entered`, `date_entered`) VALUES
(1, 7, '2014-07-04', -50000, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `action` varchar(255) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `date`, `action`, `receipt_number`, `user_id`, `branch_id`, `amount`) VALUES
(1, '2014-07-04', 'Exchange', 'RE223', 1, 7, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `sales_voucher`
--

CREATE TABLE `sales_voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sales_voucher`
--

INSERT INTO `sales_voucher` (`id`, `date`, `branch_id`, `sales_id`, `user_id`, `amount`) VALUES
(1, '2014-07-04', 7, 12, 1, 1200000);

-- --------------------------------------------------------

--
-- Table structure for table `total_sale`
--

CREATE TABLE `total_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_sale` int(11) NOT NULL,
  `audited_total_sale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `total_sale`
--

INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`) VALUES
(1, '2014-07-04', 7, 1, 4500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `auth_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES
(1, '2014-07-01', 'nargis@hsctz.com', 'nargis', 0, 4, 0),
(11, '2014-07-02', 'masoud@hsctz.com', 'masoud', 3, 5, 1),
(12, '2014-07-04', 'muhammad.abbas@hsctz.com', 'ma2014777', 7, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `user_id`) VALUES
(1, 'Nargis', 'Said', 1),
(10, 'Masoud', 'Ally', 11),
(11, 'Muhammad', 'Abbas', 12);
