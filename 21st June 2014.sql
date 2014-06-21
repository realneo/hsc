-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 21, 2014 at 07:42 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hsc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `password`) VALUES
(1, 'Msimbazi', 'msimbazi'),
(2, 'Uhuru', 'uhuru'),
(3, 'Msimbazi', 'msimbazi'),
(4, 'Uhuru', 'uhuru');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`id`, `name`, `password`) VALUES
(1, 'Nargis', 'nargis'),
(2, 'Samya', 'samya');

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
  `cashier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `cashier_id`) VALUES
(1, '2014-06-19', 'Test', 'Test', 10, 1, 0),
(2, '2014-06-19', 'Food', '', 2000, 1, 0),
(3, '2014-06-20', 'Eat', 'Sleep', 2000, 1, 0),
(4, '2014-06-20', 'Makuli', 'AMina', 3000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES
(1, '2014-06-17', 1, 'You logged in Msimbazi branch'),
(2, '2014-06-17', 1, 'Nargis - Total Sale : 20000 on 2014-06-17'),
(3, '2014-06-18', 1, 'Nargis - Total Sale : 1,200,000 on 2014-06-18'),
(4, '2014-06-18', 1, 'Nargis - Total Sale : 1,000 on 2014-06-19'),
(5, '2014-06-18', 1, 'Nargis - Total Sale : 1000 on 2014-06-18'),
(6, '2014-06-18', 1, 'Nargis - Masoud sold 3000 on 2014-06-19'),
(7, '2014-06-18', 1, 'Nargis - Masoud sold  on 2014-06-19'),
(8, '2014-06-18', 1, 'Nargis - Masoud sold  on 2014-06-18'),
(9, '2014-06-18', 1, 'Nargis - Masoud sold 2000 on 2014-06-21'),
(10, '2014-06-19', 1, 'You logged in Msimbazi branch'),
(11, '2014-06-19', 1, 'Nargis - Total Sale : 2000 on 2014-06-19'),
(12, '2014-06-19', 1, 'Nargis - Expense : 2000 for Food'),
(13, '2014-06-19', 1, 'Nargis - Expense : 2000 for Eat'),
(14, '2014-06-19', 1, 'Nargis - Expense : 3000 for Makuli'),
(15, '2014-06-19', 1, 'Nargis - Total Sale : 91212121 on 2014-06-10'),
(16, '2014-06-19', 1, 'Samya - Masoud sold 2000 on 2014-06-19'),
(17, '2014-06-19', 1, 'Samya - Masoud sold 9999 on 2014-06-19'),
(18, '2014-06-19', 1, 'Samya - Masoud sold 9999 on 2014-06-19'),
(19, '2014-06-19', 1, 'Nargis - Masoud sold 3000 on 2014-06-19');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `manual_invoices`
--

INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `entered`, `date_entered`) VALUES
(1, 1, '2014-06-20', 2000000, 0, '0000-00-00'),
(2, 1, '2014-06-20', 10, 1, '2014-06-17'),
(3, 1, '2014-06-02', 12, 0, '0000-00-00'),
(4, 1, '2014-06-20', 122, 0, '0000-00-00'),
(5, 0, '2014-06-20', 2000000, 0, '0000-00-00'),
(6, 0, '2014-06-20', 20, 1, '0000-00-00'),
(7, 0, '2014-06-20', 50000, 0, '0000-00-00'),
(8, 1, '2014-06-20', 9000000, 0, '0000-00-00'),
(9, 1, '2014-06-20', 1, 1, '0000-00-00'),
(10, 1, '2014-06-20', 949866, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `branch_id`) VALUES
(1, 'Masoud', 1),
(2, 'Anna', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_voucher`
--

CREATE TABLE `sales_voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `sales_voucher` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sales_voucher`
--

INSERT INTO `sales_voucher` (`id`, `date`, `branch_id`, `sales_id`, `cashier_id`, `sales_voucher`) VALUES
(1, '2014-06-18', 1, 1, 1, 1),
(2, '2014-06-19', 1, 1, 1, 3000),
(3, '2014-06-19', 1, 1, 1, 3000),
(4, '2014-06-18', 1, 1, 1, 6000),
(5, '2014-06-21', 1, 1, 1, 2000),
(6, '2014-06-19', 1, 1, 2, 2000),
(7, '2014-06-19', 1, 1, 2, 9999),
(8, '2014-06-19', 1, 1, 2, 9999),
(9, '2014-06-19', 1, 1, 1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `total_sale`
--

CREATE TABLE `total_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `total_sale` int(11) NOT NULL,
  `audited_total_sale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `total_sale`
--

INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `cashier_id`, `total_sale`, `audited_total_sale`) VALUES
(1, '2014-06-17', 1, 1, 20000, 0),
(2, '2014-06-18', 1, 1, 1, 0),
(3, '2014-06-19', 1, 1, 1, 0),
(4, '2014-06-18', 1, 1, 1000, 0),
(5, '2014-06-19', 1, 1, 2000, 0),
(6, '2014-06-10', 1, 1, 91212121, 0);
