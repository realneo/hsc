-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2014 at 07:01 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hsc_db`
--
CREATE DATABASE IF NOT EXISTS `hsc_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hsc_db`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE IF NOT EXISTS `auth_type` (
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
(7, 'Normal');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `binding`
--

INSERT INTO `binding` (`id`, `date`, `branch_id`, `user_id`, `amount`) VALUES
(1, '2014-07-19', 1, 2, 50000),
(2, '2014-07-21', 1, 2, 5000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `user_id`) VALUES
(1, '2014-07-19', 'iftar', 'Juzaimah', 30000, 1, 2),
(3, '2014-07-19', 'Voucher', 'Ruwaida', 10000, 1, 2),
(4, '2014-07-21', 'Makuli', 'Juzaimah', 50000, 1, 2),
(5, '2014-07-21', 'Luku', 'Rahim', 10000, 4, 2),
(6, '2014-07-19', 'Makuli', 'Rahim', 3000, 2, 2),
(8, '2014-07-19', 'iftar', 'Juzaimah', 2000, 2, 2),
(10, '2014-07-20', 'Voucher', 'Juzaimah', 50000, 5, 2),
(11, '2014-07-22', 'Makuli', 'Fahad', 50000, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES
(1, '2014-07-21 15:22:12', 2, 1, 'Daily Sale : 9000000.00 for 2014-07-21 by Fahad K'),
(2, '2014-07-21 15:24:34', 2, 1, 'Daily Sale : 50000.00 for 2014-07-21 by Fahad K'),
(3, '2014-07-21 15:25:03', 2, 1, 'Daily Expense : Tsh 30000.00, used for <b>iftar</b> on 2014-07-19'),
(4, '2014-07-21 15:25:23', 2, 1, 'Daily Expense : Tsh 10000.00, used for <b>Voucher</b> on 2014-07-21'),
(5, '2014-07-21 15:25:31', 2, 1, 'Deleted Expense : <b>10000</b> Tsh for <b>Voucher</b> by Fahad K'),
(6, '2014-07-21 15:25:44', 2, 1, 'Daily Expense : Tsh 10000.00, used for <b>Voucher</b> on 2014-07-19'),
(7, '2014-07-21 15:26:05', 2, 1, 'Manual Invoice: Tsh 100000.00 by Fahad K'),
(8, '2014-07-21 15:27:00', 2, 1, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-21'),
(9, '2014-07-21 15:57:56', 2, 1, 'Daily Sale : 2000000.00 for 2014-07-21 by Fahad K'),
(10, '2014-07-21 15:58:08', 2, 1, 'Daily Sale : 5000.00 for 2014-07-21 by Fahad K'),
(11, '2014-07-21 15:58:32', 2, 1, 'Daily Expense : Tsh 50000.00, used for <b>Makuli</b> on 2014-07-21'),
(12, '2014-07-21 15:59:05', 2, 1, 'Entered Manual Invoice: Tsh 50000.00 by Fahad K'),
(13, '2014-07-21 16:00:05', 2, 1, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-21'),
(14, '2014-07-21 16:01:21', 2, 1, 'Entered Manual Invoice: Tsh 50000.00 by Fahad K'),
(15, '2014-07-21 16:06:18', 2, 1, 'Entered Manual Invoice: Tsh 100.00 by Fahad K'),
(16, '2014-07-21 16:08:32', 2, 4, 'Daily Sale : 70000.00 for 2014-07-21 by Fahad K'),
(17, '2014-07-21 16:08:50', 2, 4, 'Daily Expense : Tsh 10000.00, used for <b>Luku</b> on 2014-07-21'),
(18, '2014-07-21 16:20:50', 2, 4, 'Manual Invoice: Tsh 50000.00 by Fahad K'),
(19, '2014-07-21 16:21:01', 2, 4, 'Entered Manual Invoice: Tsh 50000.00 by Fahad K'),
(20, '2014-07-21 16:24:27', 2, 4, 'Entered Manual Invoice: Tsh 50000.00 by Fahad K'),
(21, '2014-07-21 16:27:44', 2, 4, 'Entered Manual Invoice: Tsh 50000.00 by Fahad K'),
(22, '2014-07-21 16:30:31', 2, 6, 'Daily Sale : 5000000.00 for 2014-07-21 by Fahad K'),
(23, '2014-07-21 16:30:48', 2, 6, 'Manual Invoice: Tsh 80000.00 by Fahad K'),
(24, '2014-07-21 16:31:18', 2, 6, 'Entered Manual Invoice: Tsh 80000.00 by Fahad K'),
(25, '2014-07-21 16:31:41', 2, 6, 'Daily Sale : 90000.00 for 2014-07-21 by Fahad K'),
(26, '2014-07-21 16:33:40', 2, 6, 'Manual Invoice: Tsh 70000.00 by Fahad K'),
(27, '2014-07-21 16:34:31', 2, 6, 'Entered Manual Invoice: Tsh 20000.00 by Fahad K'),
(28, '2014-07-21 16:38:23', 2, 6, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-21'),
(29, '2014-07-21 17:28:00', 2, 2, 'Daily Sale : 50000.00 for 2014-07-21 by Fahad K'),
(30, '2014-07-21 17:28:26', 2, 2, 'Daily Expense : Tsh 3000.00, used for <b>Makuli</b> on 2014-07-19'),
(31, '2014-07-21 17:28:53', 2, 2, 'Daily Expense : Tsh 2000.00, used for <b>iftar</b> on 2014-07-21'),
(32, '2014-07-21 17:28:59', 2, 2, 'Deleted Expense : <b>2000</b> Tsh for <b>iftar</b> by Fahad K'),
(33, '2014-07-21 17:29:16', 2, 2, 'Daily Expense : Tsh 2000.00, used for <b>iftar</b> on 2014-07-19'),
(34, '2014-07-21 17:30:14', 2, 2, 'Manual Invoice: Tsh 25000.00 by Fahad K'),
(35, '2014-07-21 17:30:50', 2, 2, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-21'),
(36, '2014-07-21 17:31:00', 2, 2, 'Deleted Return : Tsh <b>10,000</b> for <b>Returned 1 Bedsheet and Took 1 Carpet</b> by Fahad K'),
(37, '2014-07-21 17:31:12', 2, 2, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-19'),
(38, '2014-07-21 17:31:57', 2, 2, 'Entered Manual Invoice: Tsh 15000.00 by Fahad K'),
(39, '2014-07-21 17:32:43', 2, 2, 'Entered Manual Invoice: Tsh 5000.00 by Fahad K'),
(40, '2014-07-21 17:33:02', 2, 2, 'Entered Manual Invoice: Tsh 5000.00 by Fahad K'),
(41, '2014-07-21 17:35:41', 2, 2, 'Entered Manual Invoice: Tsh 5000.00 by Fahad K'),
(42, '2014-07-21 17:37:13', 2, 2, 'Entered Manual Invoice: Tsh 5000.00 by Fahad K'),
(43, '2014-07-21 17:37:59', 2, 2, 'Manual Invoice: Tsh 50000.00 by Fahad K'),
(44, '2014-07-21 17:38:11', 2, 2, 'Entered Manual Invoice: Tsh 25000.00 by Fahad K'),
(45, '2014-07-21 17:38:31', 2, 2, 'Entered Manual Invoice: Tsh 25000.00 by Fahad K'),
(46, '2014-07-21 17:49:37', 2, 4, 'Manual Invoice: Tsh 6000000.00 by Fahad K'),
(47, '2014-07-21 17:50:04', 2, 4, 'Entered Manual Invoice: Tsh 2000000.00 by Fahad K'),
(48, '2014-07-21 17:50:31', 2, 4, 'Entered Manual Invoice: Tsh 4000000.00 by Fahad K'),
(49, '2014-07-22 09:51:24', 2, 2, 'Manual Invoice: Tsh 5000000.00 by Fahad K'),
(50, '2014-07-22 09:52:29', 2, 2, 'Entered Manual Invoice: Tsh 3000000.00 by Fahad K'),
(51, '2014-07-22 10:03:27', 2, 2, 'Entered Manual Invoice: Tsh 2000000.00 by Fahad K'),
(52, '2014-07-22 10:09:39', 2, 2, 'Entered Manual Invoice: Tsh 2000000.00 by Fahad K'),
(53, '2014-07-22 10:12:57', 2, 2, 'Entered Manual Invoice: Tsh 2000000.00 by Fahad K'),
(54, '2014-07-22 10:19:50', 2, 7, 'Manual Invoice: Tsh 2000000.00 by Fahad K'),
(55, '2014-07-22 10:20:29', 2, 7, 'Entered Manual Invoice: Tsh 500000.00 by Fahad K'),
(56, '2014-07-22 10:20:47', 2, 7, 'Entered Manual Invoice: Tsh 1500000.00 by Fahad K'),
(57, '2014-07-22 10:24:12', 2, 3, 'Manual Invoice: Tsh 6000000.00 by Fahad K'),
(58, '2014-07-22 10:24:32', 2, 3, 'Entered Manual Invoice: Tsh 2000000.00 by Fahad K'),
(59, '2014-07-22 10:25:00', 2, 3, 'Entered Manual Invoice: Tsh 1000000.00 by Fahad K'),
(60, '2014-07-22 10:25:18', 2, 3, 'Entered Manual Invoice: Tsh 3000000.00 by Fahad K'),
(61, '2014-07-22 10:30:19', 2, 5, 'Daily Sale : 5000000.00 for 2014-07-22 by Fahad K'),
(62, '2014-07-22 10:30:32', 2, 5, 'Daily Expense : Tsh 50000.00, used for <b>Voucher</b> on 2014-07-22'),
(63, '2014-07-22 10:30:39', 2, 5, 'Deleted Expense : <b>50000</b> Tsh for <b>Voucher</b> by Fahad K'),
(64, '2014-07-22 10:30:58', 2, 5, 'Daily Expense : Tsh 50000.00, used for <b>Voucher</b> on 2014-07-20'),
(65, '2014-07-22 10:31:17', 2, 5, 'Manual Invoice: Tsh 500000.00 by Fahad K'),
(66, '2014-07-22 10:31:39', 2, 5, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-20'),
(67, '2014-07-22 10:32:56', 2, 5, 'Failed to edit Daily Sale : 5000000.00 for 2014-07-22 by Fahad K,it was not available'),
(68, '2014-07-22 10:33:09', 2, 5, 'Daily Sale : 5000000.00 for 2014-07-22 by Fahad K'),
(69, '2014-07-22 10:33:23', 2, 5, 'Daily Expense : Tsh 50000.00, used for <b>Makuli</b> on 2014-07-22'),
(70, '2014-07-22 10:33:39', 2, 5, 'Returned Returned 1 Bedsheet and Took 1 Carpet on 2014-07-22'),
(71, '2014-07-22 10:34:37', 2, 5, 'Entered Manual Invoice: Tsh 100000.00 by Fahad K'),
(72, '2014-07-22 10:35:23', 2, 5, 'Entered Manual Invoice: Tsh 400000.00 by Fahad K'),
(73, '2014-07-22 14:15:37', 2, 6, 'Daily Audited : Tsh 90000.00, was added to the daily sale of Arusha'),
(74, '2014-07-22 14:20:52', 2, 2, 'Daily Audited : Tsh 90000.00, was added to the daily sale of <b>Msimbazi</b>'),
(75, '2014-07-22 14:22:02', 2, 2, 'Daily Audited : Tsh 900.00, was added to the daily sale of <b>Msimbazi</b>'),
(76, '2014-07-22 14:22:05', 2, 2, 'Daily Audited : Tsh 9.00, was added to the daily sale of <b>Msimbazi</b>'),
(77, '2014-07-22 14:22:07', 2, 2, 'Daily Audited : Tsh 0.09, was added to the daily sale of <b>Msimbazi</b>'),
(78, '2014-07-22 14:22:23', 2, 2, 'Daily Audited : Tsh 0.09, was added to the daily sale of <b>Msimbazi</b>'),
(79, '2014-07-22 14:25:42', 2, 2, 'Daily Audited : Tsh 66767676.76, was added to the daily sale of <b>Msimbazi</b>'),
(80, '2014-07-22 14:25:52', 2, 2, 'Daily Audited : Tsh 667676.77, was added to the daily sale of <b>Msimbazi</b>'),
(81, '2014-07-22 14:27:02', 2, 2, 'Daily Audited : Tsh <b>6676.77</b>, was added to the daily sale of <b>Msimbazi</b>'),
(82, '2014-07-22 14:27:38', 2, 2, 'Daily Audited : Tsh <b>0.20</b>, was added to the daily sale of <b>Msimbazi</b>'),
(83, '2014-07-22 14:27:52', 2, 2, 'Daily Audited : Tsh <b>20.00</b>, was added to the daily sale of <b>Msimbazi</b>'),
(84, '2014-07-22 14:28:12', 2, 2, 'Daily Audited : Tsh <b>20.00</b>, was added to the daily sale of <b>Msimbazi</b>'),
(85, '2014-07-22 14:29:03', 2, 2, 'Daily Audited : Tsh <b>78.98</b>, was added to the daily sale of <b>Msimbazi</b>'),
(86, '2014-07-22 14:30:59', 2, 2, 'Daily Audited : Tsh <b>90000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(87, '2014-07-22 14:31:24', 2, 2, 'Daily Audited : Tsh <b>90000000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(88, '2014-07-22 14:32:24', 2, 2, 'Daily Audited : Tsh <b>900000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(89, '2014-07-22 14:33:28', 2, 2, 'Daily Audited : Tsh <b>900,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(90, '2014-07-22 14:56:42', 2, 3, 'Daily Audited : Tsh <b>900,000</b>, was added to the daily sale of <b>Upanga</b>'),
(91, '2014-07-22 15:23:06', 2, 3, 'Daily Sale : 5600000.00 for 2014-07-22 by Fahad K'),
(92, '2014-07-22 15:23:48', 2, 3, 'Daily Audited : Tsh <b>7,899,990</b>, was added to the daily sale of <b>Upanga</b>'),
(93, '2014-07-23 10:55:10', 2, 1, 'Added : <b>Fahad</b> <b>Kassim</b> in the System'),
(94, '2014-07-23 11:47:55', 2, 4, 'Added : <b>Peter</b> <b>John</b> in the System'),
(95, '2014-07-23 15:12:05', 2, 5, 'Daily Audited : Tsh <b>4,000,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(96, '2014-07-23 15:13:54', 2, 5, 'Daily Audited : Tsh <b>5,000,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(97, '2014-07-23 15:29:18', 2, 5, 'Daily Audited : Tsh <b>7,000,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(98, '2014-07-23 15:35:10', 2, 7, 'Daily Sale : 67000.00 for 2014-07-23 by Fahad K'),
(99, '2014-07-23 15:35:56', 2, 7, 'Daily Audited : Tsh <b>67,060</b>, was added to the daily sale of <b>Mwanza</b>'),
(100, '2014-07-23 15:40:36', 2, 5, 'Daily Audited : Tsh <b>4,000,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(101, '2014-07-23 15:40:44', 2, 5, 'Daily Audited : Tsh <b>5,700,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(102, '2014-07-23 15:47:03', 2, 5, 'Daily Audited : Tsh <b>5,000,500</b>, was added to the daily sale of <b>Mlimani</b>'),
(103, '2014-07-23 16:00:22', 2, 5, 'Sales Report : With variance of Tsh 500/=, was produce for 2014-07-22'),
(104, '2014-07-23 16:01:02', 2, 5, 'Daily Audited : Tsh <b>5,000,570</b>, was added to the daily sale of <b>Mlimani</b>'),
(105, '2014-07-23 16:01:06', 2, 5, 'Sales Report : With variance of Tsh 570/=, was produce for 2014-07-22'),
(106, '2014-07-23 16:01:55', 2, 5, 'Daily Audited : Tsh <b>5,000,550</b>, was added to the daily sale of <b>Mlimani</b>'),
(107, '2014-07-23 16:01:58', 2, 5, 'Sales Report : With variance of Tsh 550/=, was produce for 2014-07-22'),
(108, '2014-07-23 16:04:48', 2, 5, 'Sales Report : With variance of Tsh 550/=, was produce for 2014-07-22'),
(109, '2014-07-23 16:04:55', 2, 5, 'Sales Report : With variance of Tsh 550/=, was produce for 2014-07-22'),
(110, '2014-07-23 16:05:01', 2, 5, 'Daily Audited : Tsh <b>5,000,650</b>, was added to the daily sale of <b>Mlimani</b>'),
(111, '2014-07-23 16:05:03', 2, 5, 'Sales Report : With variance of Tsh 650/=, was updated for 2014-07-22'),
(112, '2014-07-23 16:37:26', 2, 5, 'Sales Report : With variance of Tsh 650/=, was produce for 2014-07-22'),
(113, '2014-07-23 16:39:36', 2, 5, 'Daily Audited : Tsh <b>5,000,000</b>, was added to the daily sale of <b>Mlimani</b>'),
(114, '2014-07-23 16:39:44', 2, 5, 'Daily Audited : Tsh <b>5,000,050</b>, was added to the daily sale of <b>Mlimani</b>'),
(115, '2014-07-23 16:39:52', 2, 5, 'Sales Report : With variance of Tsh 50/=, was updated for 2014-07-22'),
(116, '2014-07-23 16:43:11', 2, 5, 'Sales Report : With variance of Tsh 50/=, was produce for 2014-07-22'),
(117, '2014-07-23 16:43:16', 2, 5, 'Sales Report : With variance of Tsh 50/=, was produce for 2014-07-22'),
(118, '2014-07-23 16:43:18', 2, 5, 'Sales Report : With variance of Tsh 50/=, was produce for 2014-07-22'),
(119, '2014-07-23 16:43:20', 2, 5, 'Sales Report : With variance of Tsh 50/=, was produce for 2014-07-22'),
(120, '2014-07-23 16:43:55', 2, 7, 'Sales Report : With variance of Tsh 60/=, was updated for 2014-07-22'),
(121, '2014-07-23 16:48:54', 2, 7, 'Daily Audited : Tsh <b>67,030</b>, was added to the daily sale of <b>Mwanza</b>'),
(122, '2014-07-23 16:48:58', 2, 7, 'Sales Report : With variance of Tsh 30/=, was updated for 2014-07-22'),
(123, '2014-07-23 16:49:03', 2, 5, 'Sales Report : With variance of Tsh 50/=, was produce for 2014-07-22'),
(124, '2014-07-23 16:53:16', 2, 5, 'Sales Report : With variance of Tsh 50/=, was updated for 2014-07-22'),
(125, '2014-07-23 16:53:19', 2, 7, 'Sales Report : With variance of Tsh 30/=, was updated for 2014-07-22'),
(126, '2014-07-23 16:53:26', 2, 5, 'Daily Audited : Tsh <b>5,000,560</b>, was added to the daily sale of <b>Mlimani</b>'),
(127, '2014-07-23 16:53:29', 2, 5, 'Sales Report : With variance of Tsh 560/=, was updated for 2014-07-22'),
(128, '2014-07-23 16:54:16', 2, 3, 'Daily Sale : 90000.00 for 2014-07-23 by Fahad K'),
(129, '2014-07-23 16:54:44', 2, 3, 'Daily Audited : Tsh <b>90,400</b>, was added to the daily sale of <b>Upanga</b>'),
(130, '2014-07-23 16:55:11', 2, 3, 'Sales Report : With variance of Tsh 400/=, was updated for 2014-07-22'),
(131, '2014-07-23 17:22:17', 2, 2, 'Daily Audited : Tsh <b>1,900,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(132, '2014-07-23 17:22:24', 2, 2, 'Daily Audited : Tsh <b>500,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(133, '2014-07-23 17:22:30', 2, 2, 'Daily Audited : Tsh <b>120,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(134, '2014-07-23 17:22:43', 2, 2, 'Sales Report : With variance of Tsh 20,000/=, was updated for 2014-07-19'),
(135, '2014-07-23 17:23:47', 2, 2, 'Daily Audited : Tsh <b>110,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(136, '2014-07-23 17:23:56', 2, 2, 'Sales Report : With variance of Tsh 10,000/=, was updated for 2014-07-19'),
(137, '2014-07-23 17:24:56', 2, 2, 'Daily Audited : Tsh <b>90,000</b>, was added to the daily sale of <b>Msimbazi</b>'),
(138, '2014-07-23 17:24:59', 2, 2, 'Sales Report : With variance of Tsh -10,000/=, was updated for 2014-07-19'),
(139, '2014-07-26 11:01:42', 2, 5, 'Daily Sale : 2000000.00 for 2014-07-26 by Fahad K'),
(140, '2014-07-26 11:42:50', 2, 1, 'Daily Audited : Tsh <b>8,667,030</b>, was added to the daily sale of <b>Uhuru</b>'),
(141, '2014-07-26 11:43:21', 2, 1, 'Sales Report : With variance of Tsh 1,900,030/=, was updated for 2014-07-25'),
(142, '2014-07-26 11:44:30', 2, 1, 'Sales Report : With variance of Tsh 1,900,030/=, was updated for 2014-07-25'),
(143, '2014-07-26 12:36:39', 2, 1, 'Sales Report : With variance of Tsh 150,000/=, was updated for 2014-07-19'),
(144, '2014-07-26 12:38:10', 2, 1, 'Sales Report : With variance of Tsh 150,000/=, was updated for 2014-07-19'),
(145, '2014-07-26 12:42:10', 2, 1, 'Sales Report : With variance of Tsh -10,000/=, was updated for 2014-07-19'),
(146, '2014-07-26 12:43:50', 2, 1, 'Daily Audited : Tsh <b>95,000</b>, was added to the daily sale of <b>Uhuru</b>'),
(147, '2014-07-26 12:43:52', 2, 1, 'Sales Report : With variance of Tsh -5,000/=, was updated for 2014-07-19'),
(148, '2014-07-26 14:45:38', 2, 2, 'Returns Report : Fahad K Approved returns from <b>Msimbazi</b>'),
(149, '2014-07-26 14:47:03', 2, 6, 'Returns Report : Fahad K Approved returns from <b>Arusha</b>'),
(150, '2014-07-26 15:50:03', 2, 1, 'Returns Report : Fahad K Approved returns from <b>Uhuru</b>'),
(151, '2014-07-26 16:24:45', 2, 1, 'Returns Report : Fahad K Approved returns from <b>Uhuru</b>'),
(152, '2014-07-26 16:31:55', 2, 1, 'Returns Report : Fahad K Approved returns from <b>Uhuru</b>'),
(153, '2014-07-26 16:33:05', 2, 1, 'Returns Report : Fahad K Approved returns from <b>Uhuru</b>'),
(154, '2014-07-26 16:33:33', 2, 2, 'Returns Report : Fahad K Approved returns from <b>Msimbazi</b>'),
(155, '2014-07-26 16:34:21', 2, 1, 'Returns Report : Fahad K Approved returns from <b>Uhuru</b>'),
(156, '2014-07-26 16:34:24', 2, 6, 'Returns Report : Fahad K Approved returns from <b>Arusha</b>'),
(157, '2014-07-26 16:34:25', 2, 4, 'Returns Report : Fahad K Approved returns from <b>Rugland</b>'),
(158, '2014-07-26 16:38:52', 2, 2, 'Returns Report : Fahad K Approved returns from <b>Msimbazi</b>');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `manual_invoices`
--

INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `balance`, `entered`, `date_entered`) VALUES
(1, 2, '2014-07-19', 50000, 0, 1, '2014-07-21'),
(2, 4, '2014-07-19', 6000000, 0, 1, '2014-07-21'),
(3, 2, '2014-07-20', 5000000, 0, 1, '2014-07-22'),
(4, 7, '2014-07-21', 2000000, 0, 1, '2014-07-22'),
(5, 3, '2014-07-20', 6000000, 0, 1, '2014-07-22'),
(6, 5, '2014-07-20', 500000, 0, 1, '2014-07-22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `manual_invoices_progress`
--

INSERT INTO `manual_invoices_progress` (`id`, `date`, `date_issued`, `manual_invoice_id`, `amount_entered`, `branch_id`) VALUES
(1, '2014-07-21', '2014-07-19', 1, 25000, 2),
(2, '2014-07-21', '2014-07-19', 2, 2000000, 4),
(3, '2014-07-22', '2014-07-20', 3, 3000000, 2),
(5, '2014-07-22', '2014-07-20', 3, 2000000, 2),
(6, '2014-07-22', '2014-07-21', 4, 500000, 7),
(7, '2014-07-22', '2014-07-21', 4, 1500000, 7),
(8, '2014-07-22', '2014-07-20', 5, 2000000, 3),
(9, '2014-07-22', '2014-07-20', 5, 1000000, 3),
(10, '2014-07-22', '2014-07-20', 5, 3000000, 3),
(11, '2014-07-22', '2014-07-20', 6, 100000, 5),
(12, '2014-07-22', '2014-07-20', 6, 400000, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `date`, `item_returned`, `qty`, `action`, `receipt_number`, `user_id`, `branch_id`, `amount`, `status`) VALUES
(2, '2014-07-01', '45SC', 3, 'return ct shear rng 1pc j2162 rng 1pc', '-', 4, 1, 135000, 'unchecked'),
(3, '2014-07-02', '45SC', 3, 'return bds golden white 4pc', '-', 4, 1, 42000, 'unchecked'),
(4, '2014-07-03', '45SC', 3, 'return fashion shaggy 200x290 3ps', '-', 4, 1, 870000, 'unchecked'),
(6, '2014-07-01', '45SC', 3, 'return hsc 66x66 2 pc', '-', 8, 3, 19000, 'unchecked'),
(7, '2014-07-01', '45SC', 3, 'retune lm-120x170', '-', 6, 2, 160000, 'unchecked'),
(9, '2014-07-02', '45SC', 3, 'retune TANZANITE-200X290', '-', 6, 2, 70000, 'unchecked'),
(10, '2014-07-03', '45SC', 3, 'retuned bds001', '-', 6, 2, 45000, 'unchecked'),
(11, '2014-07-01', '45SC', 3, 'return(jinan-120x270))1pc', '-', 3, 5, 18000, 'unchecked'),
(12, '2014-07-02', '45SC', 0, 'return(medallion-160x230)1pc', '-', 3, 5, 129000, 'unchecked'),
(14, '2014-07-01', '45SC', 2, 'manual invoice entered (belonging to june 2014)', '-', 6, 2, 7472000, 'unchecked'),
(15, '2014-07-02', '45SC', 2, 'manual invoice entered (belonging to june 2014)', '-', 3, 5, 2940000, 'unchecked'),
(16, '2014-07-02', '45SC', 2, 'returns', '-', 7, 7, 60000, 'unchecked'),
(17, '2014-07-03', '45SC', 2, 'returns', '-', 7, 7, 60000, 'unchecked'),
(18, '2014-07-05', '45SC', 2, 'j2250(rn)1pc', '3622', 3, 5, 70000, 'unchecked'),
(19, '2014-07-04', '45SC', 2, 'return(ct-assorted-hook)1pc', '-', 3, 5, 40000, 'unchecked'),
(20, '2014-07-04', '45SC', 2, 'return hsc 66x66 2 pc', '-', 3, 3, 19000, 'unchecked'),
(21, '2014-07-05', '45SC', 2, 'j2250(rn)1pc', '3622', 3, 5, -70000, 'unchecked'),
(22, '2014-07-05', '45SC', 2, 'cheque ', '574742', 29, 1, 8710000, 'checked'),
(23, '2014-07-05', '45SC', 2, 'africano 200x290', '5580', 29, 1, 157000, 'unchecked'),
(24, '2014-07-05', '45SC', 2, 'cheque', '5747', 29, 1, 5862500, 'unchecked'),
(25, '2014-07-06', '45SC', 2, 'ttku2-160x230-1pc', '8892', 3, 2, 70000, 'unchecked'),
(26, '2014-07-06', '45SC', 2, 'ttku2-160x230-1pc', '6687', 3, 5, 70000, 'unchecked'),
(27, '2014-07-07', '45SC', 2, 'lima-120x170-1pc', '8419', 3, 5, 160000, 'unchecked'),
(28, '2014-07-07', '45SC', 2, 'w1460-3-yl-1pc', '10493', 3, 5, 110000, 'unchecked'),
(29, '2014-07-07', '45SC', 2, 'bds004', 'arecpos011703', 10, 6, 60000, 'unchecked'),
(30, '2014-07-07', '45SC', 2, 'medallion-240x340-3pc', '0129', 3, 5, 780000, 'unchecked'),
(31, '2014-07-08', '45SC', 2, 'hl-c-05-1.6(2pc)', '00322', 3, 5, 86000, 'unchecked'),
(32, '2014-07-15', '45SC', 2, '444', '34343434', 2, 7, 3434, 'unchecked'),
(33, '2014-07-15', '45SC', 2, '123123123', '123123', 0, 1, 123213, 'unchecked'),
(37, '2014-07-15', '45SC', 2, 'taula narudisha', '23443344', 0, 1, 500, 'unchecked'),
(38, '2014-07-16', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '2121', 2, 1, 35000, 'unchecked'),
(39, '2014-07-16', '45SC', 2, 'Bedsheet and Took Carpet', '222', 2, 2, 20000, 'checked'),
(40, '2014-07-16', '45SC', 2, 'Returned Kanzu ya Rahim', '490', 2, 4, 20000, 'checked'),
(41, '2014-07-16', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '2010', 2, 6, 100000, 'checked'),
(42, '2014-07-17', '45SC', 2, 'Taulo', '2121', 2, 1, 1234, 'checked'),
(43, '2014-07-18', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '4532', 2, 2, 20000, 'checked'),
(44, '2014-06-01', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '2323', 2, 1, 20000, 'checked'),
(45, '2014-06-02', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '2345', 2, 1, 20000, 'checked'),
(46, '2014-07-19', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '3456', 2, 1, 20000, 'checked'),
(47, '2014-07-20', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '5677', 2, 1, 5000, 'checked'),
(48, '2014-07-21', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '2312', 2, 6, 12121.11, 'checked'),
(50, '2014-07-19', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', 'f23a', 2, 2, 10000, 'checked'),
(51, '2014-07-20', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', 'f34r', 2, 5, 10000, 'checked'),
(52, '2014-07-22', '45SC', 2, 'Returned 1 Bedsheet and Took 1 Carpet', '34de', 2, 5, 50000, 'checked');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sales_voucher`
--

INSERT INTO `sales_voucher` (`id`, `date`, `branch_id`, `sales_id`, `user_id`, `amount`) VALUES
(1, '2014-07-15', 2, 1, 2, 121212),
(2, '2014-07-13', 2, 5, 2, 12000),
(3, '2014-07-15', 5, 15, 0, 2222),
(4, '2014-07-15', 5, 14, 0, 60000),
(5, '2014-07-15', 5, 14, 0, 200),
(7, '2014-07-15', 5, 16, 0, 900),
(8, '2014-07-15', 5, 11, 0, 345000),
(9, '2014-07-15', 5, 15, 0, 800),
(10, '2014-07-15', 5, 12, 0, 500),
(11, '2014-07-15', 5, 15, 0, 345),
(12, '2014-07-15', 5, 12, 0, 2333),
(13, '2014-07-15', 5, 14, 0, 2000),
(14, '2014-07-15', 5, 18, 0, 70000),
(15, '2014-07-16', 5, 12, 2, 900);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `total_sale`
--

INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`, `produced`) VALUES
(2, '2014-07-21', 1, 2, 2000000, 0, 0),
(3, '2014-07-20', 4, 2, 70000, 0, 0),
(4, '2014-07-20', 6, 2, 5000000, 0, 0),
(5, '2014-07-21', 6, 2, 90000, 0, 0),
(6, '2014-07-19', 1, 5, 50000, 95000, 1),
(7, '2014-07-05', 5, 2, 3400000, 0, 0),
(8, '2014-07-22', 5, 6, 5000000, 5300560, 1),
(10, '2014-07-25', 1, 2, 6767000, 8667030, 1),
(11, '2014-07-22', 3, 2, 90000, 90400, 1),
(12, '2014-07-20', 5, 6, 400000, 400560, 0),
(13, '2014-07-09', 5, 2, 2000000, 2000000, 0),
(14, '2014-07-22', 5, 13, 3400000, 4500560, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `auth_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES
(1, '2014-07-04', 'nadhir.bahayan@hsctz.com', 'jQueryMaster7', 0, 1, 1),
(2, '2014-07-04', 'nargis@hsctz.com', 'nargis', 2, 4, 1),
(3, '2014-07-04', 'yusra.said@hsctz.com', 'ys20142215', 1, 4, 1),
(4, '2014-07-04', 'thalia.hassan@hsctz.com', 'th20145134', 3, 4, 1),
(5, '2014-07-04', 'fatma.abdallah@hsctz.com', 'fa20144315', 1, 4, 1),
(6, '2014-07-04', 'samya.mohammed@hsctz.com', 'sm20145136', 4, 4, 1),
(7, '2014-07-04', 'saleh.naajy@hsctz.com', 'ssn20146315', 2, 4, 1),
(8, '2014-07-04', 'asia.abdallah@hsctz.com', 'aa20145137', 4, 4, 1),
(9, '2014-07-04', 'rahim.hassan@hsctz.com', 'rh20144444', 0, 2, 1),
(10, '2014-07-04', 'saleh.ally@hsctz.com', 'sa20148833', 0, 4, 1),
(11, '2014-07-04', 'latifa.mkwachu@hsctz.com', 'salesPassword', 5, 5, 3),
(12, '2014-07-04', 'feisal.sharif@hsctz.com', 'salesPassword', 5, 5, 3),
(13, '2014-07-04', 'maryam.abdallah@hsctz.com', 'salesPassword', 5, 5, -18),
(15, '2014-07-04', 'abdul.kareem@hsctz.com', 'salesPassword', 5, 5, 3),
(16, '2014-07-04', 'fareed.hemeed@hsctz.com', 'salesPassword', 5, 5, 3),
(17, '2014-07-04', 'aisha.adam@hsctz.com', 'salesPassword', 5, 5, 3),
(18, '2014-07-04', 'habiba.said@hsctz.com', 'salesPassword', 5, 5, 3),
(20, '2014-07-05', 'hassan.naajy@hsctz.com', 'hn20143314', 0, 4, 1),
(29, '2014-07-05', 'aysha.nassor@hsctz.com', 'an20140010', 3, 4, 1),
(30, '2014-07-10', 'hannan.awadh@hsctz.com', 'ha20141121', 0, 2, 1),
(31, '2014-07-23', 'fahad@yoteyote.com', '123456789', 1, 3, 2),
(32, '2014-07-23', 'peter@hsctz.com', 'testest', 4, 6, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `gender`, `user_id`, `img_url`) VALUES
(1, 'Nadhir', 'Bahayan', 'male', 1, 'https://avatars0.githubusercontent.com/u/833644?s=200'),
(2, 'Nargis', 'Ahmed', 'female', 2, ''),
(3, 'Yusra', 'Said', 'female', 3, ''),
(4, 'Thalia', 'Hassan', 'female', 4, ''),
(5, 'Fatma', 'Abdallah', 'female', 5, ''),
(6, 'Samya', 'Mohammed', 'female', 6, ''),
(7, 'Saleh', 'Naajy', 'male', 7, ''),
(8, 'Asia', 'Abdallah', 'female', 8, ''),
(9, 'Rahim', 'Hassan', 'male', 9, ''),
(10, 'Saleh', 'Ally', 'male', 10, ''),
(11, 'Latifa', 'Mkwachu', 'female', 11, ''),
(12, 'Feisal', 'Sharif', 'male', 12, ''),
(13, 'Maryam', 'Abdallah', 'female', 13, ''),
(14, 'Fatma', 'Abdallah', 'female', 14, ''),
(15, 'Abdul', 'Kareem', 'male', 15, ''),
(16, 'Fareed', 'Hemeed', 'male', 16, ''),
(17, 'Aisha', 'Adam', 'female', 17, ''),
(18, 'Habiba', 'Said', 'female', 18, ''),
(20, 'Hasssan', 'Naajy', 'male', 20, ''),
(21, 'Aysha', 'Nassor', 'female', 29, ''),
(22, 'Hannan', 'Awadh', 'female', 30, ''),
(23, 'Fahad', 'Kassim', 'male', 31, 'http://www.gravatar.com/avatar/ed73505af8345bb6d383fd5c65e8ca17?s=200 '),
(24, 'Peter', 'John', 'male', 32, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `variance`
--

INSERT INTO `variance` (`id`, `user_id`, `branch_id`, `variance`, `date_produced`) VALUES
(1, 2, 0, 500009, '2014-07-20'),
(4, 10, 5, 560, '2014-07-22'),
(5, 2, 7, 30, '2014-07-22'),
(7, 2, 1, 1900030, '2014-07-25'),
(11, 5, 1, -5000, '2014-07-19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
