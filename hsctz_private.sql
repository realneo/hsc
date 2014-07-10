-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2014 at 05:59 AM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hsctz_private`
--

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
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `binding`
--

INSERT INTO `binding` (`id`, `date`, `branch_id`, `user_id`, `amount`) VALUES
(1, '2014-07-04', 1, 3, 15000),
(2, '2014-07-05', 1, 29, 97000),
(3, '2014-07-09', 1, 29, 43000);

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
  `amount` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `user_id`) VALUES
(1, '2014-07-01', 'makuli kushusha canter na wall to wall', 'Said Naji', 40000, 1, 4),
(4, '2014-07-01', 'boda boda kwnda kupima msikiti', 'Said Naji', 10000, 1, 4),
(5, '2014-07-01', 'transport', 'Said Naji', 35000, 1, 4),
(6, '2014-07-01', 'kiroba', 'Said Naji', 4000, 1, 4),
(7, '2014-07-02', 'makuli', 'Said Naji', 10000, 1, 4),
(8, '2014-07-02', 'transport to mteja', 'Said Naji', 7000, 1, 4),
(9, '2014-07-02', 'kiroba', 'Said Naji', 10000, 1, 4),
(10, '2014-07-02', 'pikipiki', 'Said Naji', 8000, 1, 4),
(11, '2014-07-03', 'pikipiki', 'Said Naji', 5000, 1, 4),
(12, '2014-07-03', 'mifuko', 'Said Naji', 21000, 1, 4),
(15, '2014-07-03', 'gundi', 'Said Naji', 20000, 1, 4),
(16, '2014-07-03', 'transport', 'Said Naji', 25000, 1, 4),
(17, '2014-07-03', 'makuli', 'Said Naji', 35000, 1, 4),
(18, '2014-07-03', 'fundi rama kuweka dsplay AC/ fayz kalshat', 'Said Naji', 20000, 1, 4),
(19, '2014-07-01', 'mehdy kigamboni', 'Saleh Naji', 3725500, 2, 6),
(20, '2014-07-02', 'makuli', 'Saleh Naji', 17000, 2, 6),
(21, '2014-07-02', 'vitu vya usafi/mop na aro', 'Saleh Naji', 15500, 2, 6),
(22, '2014-07-03', 'mehdy kigamboni', 'Saleh Naji', 613000, 2, 6),
(23, '2014-07-03', 'FADHL LAMU', 'Saleh Naji', 3092000, 2, 6),
(24, '2014-07-03', 'TAX STAFF HOSPITAL/SABASABA', 'Saleh Naji', 20000, 2, 6),
(25, '2014-07-03', 'FAYZ KALSHATY-FUEL HIACE', 'Saleh Naji', 90000, 2, 6),
(26, '2014-07-03', 'makuli', 'Saleh Naji', 10000, 2, 6),
(27, '2014-07-01', 'FTARI', 'Salim Mohamed', 35000, 5, 3),
(28, '2014-07-02', 'FTARI', 'Salim Mohamed', 35000, 5, 3),
(29, '2014-07-03', 'FTARI', 'Salim Mohamed', 35000, 5, 3),
(30, '2014-07-01', 'makuli', 'Mohamed Rahim', 3000, 4, 5),
(31, '2014-07-04', 'parking payment', 'mohamed', 300000, 6, 10),
(32, '2014-07-04', 'luku', 'mohamed', 200000, 6, 10),
(33, '2014-07-04', 'staff bonus', 'mohamed', 180000, 6, 10),
(34, '2014-07-04', 'sadaka', 'Said Naji', 1000, 1, 3),
(35, '2014-07-04', 'viroba', 'Said Naji', 4000, 1, 3),
(36, '2014-07-04', 'transport to mteja', 'Said Naji', 10000, 1, 3),
(37, '2014-07-04', 'makuli', 'Said Naji', 15000, 1, 3),
(38, '2014-07-04', 'mifuko', 'Saleh Naji', 21000, 2, 3),
(39, '2014-07-04', 'vocha/moza', 'Saleh Naji', 10000, 2, 3),
(40, '2014-07-04', 'makuli', 'Saleh Naji', 7000, 2, 3),
(41, '2014-07-04', 'FTARI', 'Salim Mohamed', 35000, 5, 3),
(42, '2014-07-04', 'bonus', 'Nurah Saleh', 173200, 3, 3),
(46, '2014-07-05', 'fahd', 'mudi dereva', 550000, 5, 3),
(47, '2014-07-05', 'bonus', 'mlimani', 707600, 5, 3),
(48, '2014-07-05', 'ftari', 'mlimani', 35000, 5, 3),
(49, '2014-07-05', 'kiingilio 77 ', 'seif', 2500, 1, 29),
(50, '2014-07-05', 'bodaboda 77 ', 'seif', 6000, 1, 29),
(51, '2014-07-05', 'visu', 'said najj', 4000, 1, 29),
(52, '2014-07-05', 'transport  from godown wall to wall ', 'said najj', 15000, 1, 29),
(53, '2014-07-05', 'ufundi mskitini ', 'mzee ally', 400000, 1, 29),
(54, '2014-07-05', 'transport to mteja ', 'said najj', 10000, 1, 29),
(55, '2014-07-05', 'kamba', 'said najj', 22000, 1, 29),
(56, '2014-07-05', 'makuli kubeba woll to woll na kupanga duka', 'said najj', 20000, 1, 29),
(57, '2014-07-05', 'mifuko', 'said najj', 11000, 1, 29),
(58, '2014-07-05', 'bonus', 'staff', 275000, 7, 20),
(59, '2014-07-05', 'food', 'staff', 120000, 7, 20),
(61, '2014-07-06', 'bonus', 'said najj', 480000, 1, 29),
(62, '2014-07-06', 'kiingilio 77 ', 'said najj', 10000, 1, 29),
(63, '2014-07-06', 'kiingilio 77 ', 'said najj', 10000, 1, 29),
(64, '2014-07-06', 'nauli 77', 'said najj', 10000, 1, 29),
(65, '2014-07-07', 'kiingilio 77 ', 'said najj', 10000, 1, 29),
(66, '2014-07-07', 'nauli 77', 'said najj', 10000, 1, 29),
(67, '2014-07-07', 'viroba', 'said najj', 10000, 1, 29),
(68, '2014-07-07', 'transport to mteja ', 'said najj', 5000, 1, 29),
(69, '2014-07-06', 'fatri', 'mlimani', 35000, 5, 3),
(71, '2014-07-07', 'ftari', 'mlimani', 35000, 5, 3),
(72, '2014-07-07', 'fahmy malipo ya 77 6-7-2014', 'fahmy aboud', 10000, 1, 29),
(73, '2014-07-07', 'makuli', 'said najj', 10000, 1, 29),
(74, '2014-07-08', 'petty cash', 'mohamed', 300000, 6, 10),
(75, '2014-07-08', 'shop lecence', 'mohamed', 200000, 6, 10),
(76, '2014-07-08', 'luku', 'hassan', 50000, 7, 20),
(77, '2014-07-08', 'dawa ya panya,mende na sabuni', 'said najj', 20000, 1, 29),
(78, '2014-07-08', 'makuli', 'said najj', 12000, 1, 29),
(79, '2014-07-08', 'transport', 'said najj', 10000, 1, 29),
(80, '2014-07-09', 'mselem/rahim', 'saleh', 500000, 2, 5),
(81, '2014-07-09', 'mafuta/fayz kalshat', 'saleh', 50000, 2, 5),
(82, '2014-07-09', 'solotape and kamba', 'aunt fatma', 46000, 2, 5),
(83, '2014-07-09', 'makuli', 'saleh', 14000, 2, 5),
(84, '2014-07-09', 'k.k.security', 'mohamed', 180500, 6, 10),
(85, '2014-07-09', 'fahad boss', 'said naji', 10000, 1, 29),
(86, '2014-07-09', 'mifuko', 'said naji', 21000, 1, 29),
(87, '2014-07-09', 'makuli', 'said naji', 10000, 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=338 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES
(1, '2014-07-04', 1, 0, 'Nadhir Bahayan logged in.'),
(2, '2014-07-04', 1, 0, 'Added : Nargis Ahmed in the Database'),
(3, '2014-07-04', 1, 0, 'Added : Yusra Said in the Database'),
(4, '2014-07-04', 1, 0, 'Added : Thalia Hassan in the Database'),
(5, '2014-07-04', 1, 0, 'Added : Fatma Abdallah in the Database'),
(6, '2014-07-04', 1, 0, 'Added : Samya Mohammed in the Database'),
(7, '2014-07-04', 1, 0, 'Added : Saleh Naajy in the Database'),
(8, '2014-07-04', 1, 0, 'Added : Asia Abdallah in the Database'),
(9, '2014-07-04', 1, 0, 'Added : Rahim Hassan in the Database'),
(10, '2014-07-04', 9, 0, ' logged in.'),
(11, '2014-07-04', 1, 0, 'Rahim Hassan logged in.'),
(12, '2014-07-04', 9, 0, 'Rahim Hassan logged in.'),
(13, '2014-07-04', 9, 0, 'Rahim Hassan logged in.'),
(14, '2014-07-04', 2, 0, 'Nargis Ahmed logged in.'),
(15, '2014-07-04', 0, 6, 'Daily Sale : 3542000 for 2014-07-01 by Nargis Ahmed'),
(16, '2014-07-04', 0, 6, 'Manual Invoice: -295000 by Nargis Ahmed'),
(17, '2014-07-04', 0, 6, 'Daily Sale : 4408000 for 2014-07-02 by Nargis Ahmed'),
(18, '2014-07-04', 0, 6, 'Manual Invoice: -365000 by Nargis Ahmed'),
(19, '2014-07-04', 0, 6, 'Daily Sale : 6208500 for 2014-07-03 by Nargis Ahmed'),
(20, '2014-07-04', 0, 6, 'Manual Invoice: -58000 by Nargis Ahmed'),
(21, '2014-07-04', 9, 0, 'Rahim Hassan logged in.'),
(22, '2014-07-04', 4, 0, 'Thalia Hassan logged in.'),
(23, '2014-07-04', 4, 1, 'Daily Expense : 40000 for 2014-07-01'),
(24, '2014-07-04', 4, 1, 'Daily Expense : 10000 for 2014-07-04'),
(25, '2014-07-04', 4, 1, 'Daily Expense : 35000 for 2014-07-04'),
(26, '2014-07-04', 0, 1, 'Deleted Expense : 35,000 for transport by Thalia Hassan'),
(27, '2014-07-04', 0, 1, 'Deleted Expense : 10,000 for boda boda kwnda kupima msikiti by Thalia Hassan'),
(28, '2014-07-04', 4, 1, 'Daily Expense : 10000 for 2014-07-01'),
(29, '2014-07-04', 4, 1, 'Daily Expense : 35000 for 2014-07-01'),
(30, '2014-07-04', 4, 1, 'Daily Expense : 4000 for 2014-07-01'),
(31, '2014-07-04', 4, 1, 'Returned return ct shear rng 1pc j2162 rng 1pc on 2014-07-04'),
(32, '2014-07-04', 4, 1, 'Returned return ct shear rng 1pc j2162 rng 1pc on 2014-07-01'),
(33, '2014-07-04', 0, 1, 'Edited Daily Sale : 11426500 for 2014-07-04 by Thalia Hassan'),
(34, '2014-07-04', 0, 1, 'Edited Daily Sale : 11426500 for 2014-07-04 by Thalia Hassan'),
(35, '2014-07-04', 4, 0, 'Thalia Hassan logged in.'),
(36, '2014-07-04', 4, 0, 'Thalia Hassan logged in.'),
(37, '2014-07-04', 0, 1, 'Daily Sale : 11426500 for 2014-07-01 by Thalia Hassan'),
(38, '2014-07-04', 0, 1, 'Daily Sale : 9939000 for 2014-07-02 by Thalia Hassan'),
(39, '2014-07-04', 4, 1, 'Daily Expense : 10000 for 2014-07-02'),
(40, '2014-07-04', 4, 1, 'Daily Expense : 7000 for 2014-07-02'),
(41, '2014-07-04', 4, 1, 'Daily Expense : 10000 for 2014-07-02'),
(42, '2014-07-04', 4, 1, 'Daily Expense : 8000 for 2014-07-02'),
(43, '2014-07-04', 4, 1, 'Returned return bds golden white 4pc on 2014-07-02'),
(44, '2014-07-04', 0, 1, 'Daily Sale : 17013000 for 2014-07-03 by Thalia Hassan'),
(45, '2014-07-04', 4, 1, 'Daily Expense : 5000 for 2014-07-03'),
(46, '2014-07-04', 4, 1, 'Daily Expense : 21000 for 2014-07-03'),
(47, '2014-07-04', 4, 1, 'Daily Expense : 20000 for 2014-07-04'),
(48, '2014-07-04', 4, 1, 'Daily Expense : 25000 for 2014-07-04'),
(49, '2014-07-04', 0, 1, 'Deleted Expense : 20,000 for gundi by Thalia Hassan'),
(50, '2014-07-04', 0, 1, 'Deleted Expense : 25,000 for transport by Thalia Hassan'),
(51, '2014-07-04', 4, 1, 'Daily Expense : 20000 for 2014-07-03'),
(52, '2014-07-04', 4, 1, 'Daily Expense : 25000 for 2014-07-03'),
(53, '2014-07-04', 4, 1, 'Daily Expense : 35000 for 2014-07-03'),
(54, '2014-07-04', 4, 1, 'Daily Expense : 20000 for 2014-07-03'),
(55, '2014-07-04', 4, 1, 'Returned return fashion shaggy 200x290 3ps on 2014-07-03'),
(56, '2014-07-04', 8, 0, 'Asia Abdallah logged in.'),
(57, '2014-07-04', 0, 3, 'Daily Sale : 1758000 for 2014-07-01 by Asia Abdallah'),
(58, '2014-07-04', 8, 3, 'Returned return hsc 66x66 2 pc on 2014-07-04'),
(59, '2014-07-04', 8, 3, 'Returned return hsc 66x66 2 pc on 2014-07-01'),
(60, '2014-07-04', 0, 3, 'Daily Sale : 2072500 for 2014-07-02 by Asia Abdallah'),
(61, '2014-07-04', 0, 3, 'Daily Sale : 3418000 for 2014-07-03 by Asia Abdallah'),
(62, '2014-07-04', 6, 0, 'Samya Mohammed logged in.'),
(63, '2014-07-04', 0, 2, 'Daily Sale : 19678000 for 2014-07-01 by Samya Mohammed'),
(64, '2014-07-04', 6, 2, 'Daily Expense : 3725500 for 2014-07-01'),
(65, '2014-07-04', 6, 2, 'Returned retune lm-120x170 on 2014-07-01'),
(66, '2014-07-04', 0, 2, 'Daily Sale : 9388500 for 2014-07-02 by Samya Mohammed'),
(67, '2014-07-04', 6, 2, 'Daily Expense : 17000 for 2014-07-02'),
(68, '2014-07-04', 6, 2, 'Daily Expense : 15500 for 2014-07-02'),
(69, '2014-07-04', 6, 2, 'Returned retune TANZANITE-200X290 on 2014-07-04'),
(70, '2014-07-04', 6, 2, 'Returned retune TANZANITE-200X290 on 2014-07-02'),
(71, '2014-07-04', 0, 2, 'Daily Sale : 10567500 for 2014-07-03 by Samya Mohammed'),
(72, '2014-07-04', 6, 2, 'Daily Expense : 613000 for 2014-07-03'),
(73, '2014-07-04', 6, 2, 'Daily Expense : 3092000 for 2014-07-03'),
(74, '2014-07-04', 6, 2, 'Daily Expense : 20000 for 2014-07-03'),
(75, '2014-07-04', 6, 2, 'Daily Expense : 90000 for 2014-07-03'),
(76, '2014-07-04', 6, 2, 'Daily Expense : 10000 for 2014-07-03'),
(77, '2014-07-04', 6, 2, 'Returned retuned bds001 on 2014-07-03'),
(78, '2014-07-04', 3, 0, 'Yusra Said logged in.'),
(79, '2014-07-04', 0, 5, 'Daily Sale : 3718500 for 2014-07-01 by Yusra Said'),
(80, '2014-07-04', 3, 5, 'Daily Expense : 35000 for 2014-07-01'),
(81, '2014-07-04', 3, 5, 'Returned return(jinan-120x270))1pc on 2014-07-01'),
(82, '2014-07-04', 0, 5, 'Daily Sale : 7193000 for 2014-07-02 by Yusra Said'),
(83, '2014-07-04', 3, 5, 'Returned return(medallion-160x230)1pc on 2014-07-02'),
(84, '2014-07-04', 3, 5, 'Daily Expense : 35000 for 2014-07-02'),
(85, '2014-07-04', 0, 5, 'Daily Sale : 5149000 for 2014-07-03 by Yusra Said'),
(86, '2014-07-04', 3, 5, 'Daily Expense : 35000 for 2014-07-03'),
(87, '2014-07-04', 6, 0, 'Samya Mohammed logged in.'),
(88, '2014-07-04', 6, 2, 'Returned manual invoice entered on 2014-07-01'),
(89, '2014-07-04', 0, 2, 'Manual Invoice: -7472000 by Samya Mohammed'),
(90, '2014-07-04', 6, 2, 'Returned manual invoice entered (belonging to june 2014) on 2014-07-01'),
(91, '2014-07-04', 3, 0, 'Yusra Said logged in.'),
(92, '2014-07-04', 3, 5, 'Returned manual invoice entered (belonging to june 2014) on 2014-07-02'),
(93, '2014-07-04', 5, 0, 'Fatma Abdallah logged in.'),
(94, '2014-07-04', 0, 4, 'Daily Sale : 153000 for 2014-07-01 by Fatma Abdallah'),
(95, '2014-07-04', 0, 4, 'Daily Sale : 512500 for 2014-07-03 by Fatma Abdallah'),
(96, '2014-07-04', 0, 4, 'Daily Sale : 342000 for 2014-07-01 by Fatma Abdallah'),
(97, '2014-07-04', 5, 4, 'Daily Expense : 3000 for 2014-07-01'),
(98, '2014-07-04', 7, 0, 'Saleh Naajy logged in.'),
(99, '2014-07-04', 0, 7, 'Daily Sale : 4623500 for 2014-07-01 by Saleh Naajy'),
(100, '2014-07-04', 0, 7, 'Manual Invoice: -966000 by Saleh Naajy'),
(101, '2014-07-04', 0, 7, 'Daily Sale : 3657500 for 2014-07-01 by Saleh Naajy'),
(102, '2014-07-04', 0, 7, 'Daily Sale : 2961500 for 2014-07-04 by Saleh Naajy'),
(103, '2014-07-04', 0, 7, 'Daily Sale : 2691500 for 2014-07-01 by Saleh Naajy'),
(104, '2014-07-04', 0, 7, 'Manual Invoice: -966000 by Saleh Naajy'),
(105, '2014-07-04', 0, 7, 'Daily Sale : 3050000 for 2014-07-02 by Saleh Naajy'),
(106, '2014-07-04', 7, 7, 'Returned returns on 2014-07-02'),
(107, '2014-07-04', 0, 7, 'Daily Sale : 1687000 for 2014-07-03 by Saleh Naajy'),
(108, '2014-07-04', 7, 7, 'Returned returns on 2014-07-03'),
(109, '2014-07-04', 3, 0, 'Yusra Said logged in.'),
(110, '2014-07-04', 1, 0, 'Nadhir Bahayan logged in.'),
(111, '2014-07-04', 1, 0, 'Added : Saleh Ally in the Database'),
(112, '2014-07-04', 10, 0, 'Saleh Ally logged in.'),
(113, '2014-07-04', 0, 6, 'Edited Daily Sale : 6042000 for 2014-07-04 by Saleh Ally'),
(114, '2014-07-04', 0, 6, 'Edited Daily Sale : 6042000 for 2014-07-04 by Saleh Ally'),
(115, '2014-07-04', 10, 6, 'Daily Expense : 300000 for 2014-07-04'),
(116, '2014-07-04', 10, 6, 'Daily Expense : 200000 for 2014-07-04'),
(117, '2014-07-04', 10, 6, 'Daily Expense : 180000 for 2014-07-04'),
(118, '2014-07-04', 0, 6, 'Manual Invoice: -1231000 by Saleh Ally'),
(119, '2014-07-04', 9, 0, 'Rahim Hassan logged in.'),
(120, '2014-07-05', 9, 0, 'Rahim Hassan logged in.'),
(121, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(122, '2014-07-05', 10, 0, 'Saleh Ally logged in.'),
(123, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(124, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(125, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(126, '2014-07-05', 0, 6, 'Daily Sale : 4811000 for 2014-07-04 by Yusra Said'),
(127, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(128, '2014-07-05', 0, 5, 'Daily Sale : 4000000 for 2014-07-05 by Yusra Said'),
(129, '2014-07-05', 3, 5, 'Added : LATIFA MKWACHU in the Database'),
(130, '2014-07-05', 3, 5, 'Added : FEISAL SHARIF in the Database'),
(131, '2014-07-05', 3, 5, 'Added : MARYAM ABDALLAH in the Database'),
(132, '2014-07-05', 3, 5, 'Added : FATMA ABDALLAH in the Database'),
(133, '2014-07-05', 3, 5, 'Added : ABDUL KAREEM in the Database'),
(134, '2014-07-05', 3, 5, 'Added : FAREED HEMEED in the Database'),
(135, '2014-07-05', 3, 5, 'Added : AISHA ADAM in the Database'),
(136, '2014-07-05', 3, 5, 'Added : HABIBA SAID in the Database'),
(137, '2014-07-05', 3, 5, 'Returned j2250(rn)1pc on 2014-07-05'),
(138, '2014-07-05', 0, 5, 'Manual Invoice: -910000 by Yusra Said'),
(139, '2014-07-05', 4, 0, 'Thalia Hassan logged in.'),
(140, '2014-07-05', 1, 0, 'Nadhir Bahayan logged in.'),
(141, '2014-07-05', 1, 0, 'Added : Saleh Naajy in the Database'),
(142, '2014-07-05', 1, 0, 'Added : Hasssan Naajy in the Database'),
(143, '2014-07-05', 20, 0, 'Hasssan Naajy logged in.'),
(144, '2014-07-05', 0, 7, 'Edited Daily Sale : 400000 for 2014-07-05 by Hasssan Naajy'),
(145, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(146, '2014-07-05', 9, 0, 'Rahim Hassan logged in.'),
(147, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(148, '2014-07-05', 0, 1, 'Daily Sale : 9529000 for 2014-07-04 by Yusra Said'),
(149, '2014-07-05', 0, 1, 'Binding Amount : 15000 for 2014-07-04 by Yusra Said'),
(150, '2014-07-05', 3, 1, 'Daily Expense : 1000 for 2014-07-04'),
(151, '2014-07-05', 3, 1, 'Daily Expense : 4000 for 2014-07-04'),
(152, '2014-07-05', 3, 1, 'Daily Expense : 10000 for 2014-07-04'),
(153, '2014-07-05', 3, 1, 'Daily Expense : 15000 for 2014-07-04'),
(154, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(155, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(156, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(157, '2014-07-05', 0, 2, 'Daily Sale : 6831500 for 2014-07-04 by Yusra Said'),
(158, '2014-07-05', 3, 2, 'Daily Expense : 21000 for 2014-07-04'),
(159, '2014-07-05', 3, 2, 'Daily Expense : 10000 for 2014-07-04'),
(160, '2014-07-05', 3, 2, 'Daily Expense : 7000 for 2014-07-04'),
(161, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(162, '2014-07-05', 0, 5, 'Daily Sale : 5207000 for 2014-07-04 by Yusra Said'),
(163, '2014-07-05', 3, 5, 'Daily Expense : 35000 for 2014-07-04'),
(164, '2014-07-05', 3, 5, 'Returned return(ct-assorted-hook)1pc on 2014-07-04'),
(165, '2014-07-05', 3, 0, 'Yusra Said logged in.'),
(166, '2014-07-05', 0, 3, 'Daily Sale : 126000 for 2014-07-04 by Yusra Said'),
(167, '2014-07-05', 3, 3, 'Daily Expense : 173200 for 2014-07-04'),
(168, '2014-07-05', 3, 3, 'Returned return hsc 66x66 2 pc on 2014-07-04'),
(169, '2014-07-05', 0, 3, 'Manual Invoice: -3018500 by Yusra Said'),
(170, '2014-07-05', 1, 0, 'Nadhir Bahayan logged in.'),
(171, '2014-07-05', 1, 0, 'Added : Aysha Nassor in the Database'),
(172, '2014-07-05', 10, 0, 'Saleh Ally logged in.'),
(173, '2014-07-05', 0, 6, 'Manual Invoice: -87000 by Saleh Ally'),
(174, '2014-07-05', 0, 6, 'Daily Sale : 5372500 for 2014-07-05 by Saleh Ally'),
(175, '2014-07-05', 0, 6, 'Edited Daily Sale : 5459500 for 2014-07-05 by Saleh Ally'),
(176, '2014-07-05', 0, 5, 'Edited Daily Sale : 10135000 for 2014-07-05 by Yusra Said'),
(177, '2014-07-05', 3, 5, 'Daily Expense : 550000 for 2014-07-05'),
(178, '2014-07-05', 3, 5, 'Daily Expense : 707600 for 2014-07-05'),
(179, '2014-07-05', 3, 5, 'Daily Expense : 35000 for 2014-07-05'),
(180, '2014-07-05', 0, 5, 'Deleted Expense : 35,000 for ftari by Yusra Said'),
(181, '2014-07-05', 0, 5, 'Deleted Expense : 707,600 for bonus by Yusra Said'),
(182, '2014-07-05', 0, 5, 'Deleted Expense : 550,000 for fahad by Yusra Said'),
(183, '2014-07-05', 3, 5, 'Daily Expense : 550000 for 2014-07-05'),
(184, '2014-07-05', 3, 5, 'Daily Expense : 707600 for 2014-07-05'),
(185, '2014-07-05', 3, 5, 'Daily Expense : 35000 for 2014-07-05'),
(186, '2014-07-05', 0, 5, 'Manual Invoice: 910000 by Yusra Said'),
(187, '2014-07-05', 3, 5, 'Returned j2250(rn)1pc on 2014-07-05'),
(188, '2014-07-06', 29, 0, 'Aysha Nassor logged in.'),
(189, '2014-07-06', 0, 1, 'Daily Sale : 27500500 for 2014-07-05 by Aysha Nassor'),
(190, '2014-07-06', 0, 1, 'Binding Amount : 97000 for 2014-07-05 by Aysha Nassor'),
(191, '2014-07-06', 29, 1, 'Daily Expense : 2500 for 2014-07-05'),
(192, '2014-07-06', 29, 1, 'Daily Expense : 6000 for 2014-07-05'),
(193, '2014-07-06', 29, 1, 'Daily Expense : 4000 for 2014-07-05'),
(194, '2014-07-06', 29, 1, 'Daily Expense : 15000 for 2014-07-05'),
(195, '2014-07-06', 29, 1, 'Daily Expense : 400000 for 2014-07-05'),
(196, '2014-07-06', 29, 1, 'Daily Expense : 10000 for 2014-07-05'),
(197, '2014-07-06', 29, 1, 'Daily Expense : 22000 for 2014-07-05'),
(198, '2014-07-06', 29, 1, 'Daily Expense : 20000 for 2014-07-05'),
(199, '2014-07-06', 29, 1, 'Returned cheque  on 2014-07-05'),
(200, '2014-07-06', 29, 1, 'Returned africano 200x290 on 2014-07-05'),
(201, '2014-07-06', 29, 1, 'Returned cheque on 2014-07-05'),
(202, '2014-07-06', 29, 1, 'Daily Expense : 11000 for 2014-07-05'),
(203, '2014-07-06', 29, 0, 'Aysha Nassor logged in.'),
(204, '2014-07-06', 20, 0, 'Hasssan Naajy logged in.'),
(205, '2014-07-06', 3, 0, 'Yusra Said logged in.'),
(206, '2014-07-06', 0, 7, 'Daily Sale : 3582000 for 2014-07-05 by Hasssan Naajy'),
(207, '2014-07-06', 0, 7, 'Manual Invoice: -356000 by Hasssan Naajy'),
(208, '2014-07-06', 20, 7, 'Daily Expense : 275000 for 2014-07-05'),
(209, '2014-07-06', 20, 7, 'Daily Expense : 120000 for 2014-07-05'),
(210, '2014-07-06', 29, 0, 'Aysha Nassor logged in.'),
(211, '2014-07-06', 3, 0, 'Yusra Said logged in.'),
(212, '2014-07-06', 3, 2, 'Returned ttku2-160x230-1pc on 2014-07-06'),
(213, '2014-07-06', 3, 2, 'Daily Expense : 35000 for 2014-07-06'),
(214, '2014-07-06', 29, 0, 'Aysha Nassor logged in.'),
(215, '2014-07-06', 20, 0, 'Hasssan Naajy logged in.'),
(216, '2014-07-06', 0, 7, 'Edited Daily Sale : 683000 for 2014-07-06 by Hasssan Naajy'),
(217, '2014-07-06', 0, 7, 'Edited Daily Sale : 687000 for 2014-07-06 by Hasssan Naajy'),
(218, '2014-07-06', 0, 7, 'Edited Daily Sale : 687000 for 2014-07-06 by Hasssan Naajy'),
(219, '2014-07-06', 0, 7, 'Daily Sale : 687000 for 2014-07-06 by Hasssan Naajy'),
(220, '2014-07-06', 1, 0, 'Nadhir Bahayan logged in.'),
(221, '2014-07-06', 0, 2, 'Edited Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(222, '2014-07-06', 0, 2, 'Edited Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(223, '2014-07-06', 3, 0, 'Yusra Said logged in.'),
(224, '2014-07-06', 0, 5, 'Edited Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(225, '2014-07-06', 0, 5, 'Edited Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(226, '2014-07-06', 3, 5, 'Returned ttku2-160x230-1pc on 2014-07-06'),
(227, '2014-07-06', 0, 5, 'Edited Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(228, '2014-07-06', 0, 5, 'Daily Sale : 7123000 for 2014-07-06 by Yusra Said'),
(229, '2014-07-07', 0, 1, 'Daily Sale : 3758000 for 2014-07-06 by Aysha Nassor'),
(230, '2014-07-07', 29, 1, 'Daily Expense : 480000 for 2014-07-06'),
(231, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-06'),
(232, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-06'),
(233, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-06'),
(234, '2014-07-07', 29, 0, 'Aysha Nassor logged in.'),
(235, '2014-07-07', 0, 1, 'Daily Sale : 7115500 for 2014-07-07 by Aysha Nassor'),
(236, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-07'),
(237, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-07'),
(238, '2014-07-07', 29, 1, 'Daily Expense : 10000 for 2014-07-07'),
(239, '2014-07-07', 29, 1, 'Daily Expense : 5000 for 2014-07-07'),
(240, '2014-07-07', 3, 0, 'Yusra Said logged in.'),
(241, '2014-07-07', 3, 5, 'Returned lima-120x170-1pc on 2014-07-07'),
(242, '2014-07-07', 3, 5, 'Returned w1460-3-yl-1pc on 2014-07-07'),
(243, '2014-07-07', 3, 5, 'Daily Expense : 35000 for 2014-07-06'),
(244, '2014-07-07', 3, 5, 'Daily Expense : 35000 for 2014-07-07'),
(245, '2014-07-07', 0, 5, 'Deleted Expense : 35,000 for ftari by Yusra Said'),
(246, '2014-07-07', 3, 5, 'Daily Expense : 70000 for 2014-07-07'),
(247, '2014-07-07', 20, 0, 'Hasssan Naajy logged in.'),
(248, '2014-07-07', 0, 7, 'Daily Sale : 3210000 for 2014-07-07 by Hasssan Naajy'),
(249, '2014-07-07', 0, 7, 'Edited Daily Sale : -5000 for 2014-07-07 by Hasssan Naajy'),
(250, '2014-07-07', 0, 7, 'Edited Daily Sale : 3205000 for 2014-07-07 by Hasssan Naajy'),
(251, '2014-07-07', 10, 0, 'Saleh Ally logged in.'),
(252, '2014-07-07', 0, 6, 'Daily Sale : 3875500 for 2014-07-07 by Saleh Ally'),
(253, '2014-07-07', 0, 6, 'Manual Invoice: -328000 by Saleh Ally'),
(254, '2014-07-07', 10, 6, 'Returned bds004 on 2014-07-07'),
(255, '2014-07-07', 3, 0, 'Yusra Said logged in.'),
(256, '2014-07-07', 3, 5, 'Returned medallion-240x340-3pc on 2014-07-07'),
(257, '2014-07-07', 0, 5, 'Edited Daily Sale : 9623000 for 2014-07-07 by Yusra Said'),
(258, '2014-07-07', 0, 5, 'Edited Daily Sale : 9623000 for 2014-07-07 by Yusra Said'),
(259, '2014-07-07', 0, 5, 'Daily Sale : 9623000 for 2014-07-07 by Yusra Said'),
(260, '2014-07-08', 10, 0, 'Saleh Ally logged in.'),
(261, '2014-07-08', 29, 0, 'Aysha Nassor logged in.'),
(262, '2014-07-08', 29, 1, 'Daily Expense : 10000 for 2014-07-07'),
(263, '2014-07-08', 29, 1, 'Daily Expense : 10000 for 2014-07-07'),
(264, '2014-07-08', 9, 0, 'Rahim Hassan logged in.'),
(265, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(266, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(267, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(268, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(269, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(270, '2014-07-08', 29, 0, 'Aysha Nassor logged in.'),
(271, '2014-07-08', 29, 0, 'Aysha Nassor logged in.'),
(272, '2014-07-08', 0, 1, 'Daily Sale : 3547500 for 2014-07-07 by Aysha Nassor'),
(273, '2014-07-08', 5, 0, 'Fatma Abdallah logged in.'),
(274, '2014-07-08', 0, 1, 'Daily Sale : 7115500 for 2014-07-07 by Aysha Nassor'),
(275, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(276, '2014-07-08', 0, 5, 'Daily Sale : 9623000 for 2014-07-07 by Yusra Said'),
(277, '2014-07-08', 10, 0, 'Saleh Ally logged in.'),
(278, '2014-07-08', 29, 0, 'Aysha Nassor logged in.'),
(279, '2014-07-08', 0, 6, 'Daily Sale : 3547500 for 2014-07-07 by Saleh Ally'),
(280, '2014-07-08', 0, 6, 'Daily Sale : 5347500 for 2014-07-05 by Saleh Ally'),
(281, '2014-07-08', 0, 6, 'Manual Invoice: -112000 by Saleh Ally'),
(282, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(283, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(284, '2014-07-08', 0, 2, 'Daily Sale : 9041000 for 2014-07-08 by Fatma Abdallah'),
(285, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(286, '2014-07-08', 3, 5, 'Returned hl-c-05-1.6(2pc) on 2014-07-08'),
(287, '2014-07-08', 10, 0, 'Saleh Ally logged in.'),
(288, '2014-07-08', 0, 6, 'Daily Sale : 3337000 for 2014-07-08 by Saleh Ally'),
(289, '2014-07-08', 10, 6, 'Daily Expense : 300000 for 2014-07-08'),
(290, '2014-07-08', 10, 6, 'Daily Expense : 200000 for 2014-07-08'),
(291, '2014-07-08', 3, 0, 'Yusra Said logged in.'),
(292, '2014-07-09', 0, 7, 'Daily Sale : 3205000 for 2014-07-07 by Hasssan Naajy'),
(293, '2014-07-09', 0, 7, 'Daily Sale : 1835500 for 2014-07-08 by Hasssan Naajy'),
(294, '2014-07-09', 20, 7, 'Daily Expense : 50000 for 2014-07-08'),
(295, '2014-07-09', 29, 0, 'Aysha Nassor logged in.'),
(296, '2014-07-09', 29, 0, 'Aysha Nassor logged in.'),
(297, '2014-07-09', 0, 1, 'Manual Invoice: -4419000 by Aysha Nassor'),
(298, '2014-07-09', 0, 1, 'Daily Sale : 1811500 for 2014-07-09 by Aysha Nassor'),
(299, '2014-07-09', 29, 1, 'Daily Expense : 20000 for 2014-07-08'),
(300, '2014-07-09', 29, 1, 'Daily Expense : 12000 for 2014-07-08'),
(301, '2014-07-09', 29, 1, 'Daily Expense : 10000 for 2014-07-08'),
(302, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(303, '2014-07-09', 0, 1, 'Daily Sale : 1811500 for 2014-07-08 by Aysha Nassor'),
(304, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(305, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(306, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(307, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(308, '2014-07-09', 5, 0, 'Fatma Abdallah logged in.'),
(309, '2014-07-09', 5, 2, 'Daily Expense : 500000 for 2014-07-09'),
(310, '2014-07-09', 5, 2, 'Daily Expense : 50000 for 2014-07-09'),
(311, '2014-07-09', 5, 2, 'Daily Expense : 46000 for 2014-07-09'),
(312, '2014-07-09', 5, 2, 'Daily Expense : 14000 for 2014-07-09'),
(313, '2014-07-09', 0, 2, 'Daily Sale : 6309000 for 2014-07-09 by Fatma Abdallah'),
(314, '2014-07-09', 0, 7, 'Daily Sale : 1248500 for 2014-07-09 by Hasssan Naajy'),
(315, '2014-07-09', 0, 7, 'Manual Invoice: -111500 by Hasssan Naajy'),
(316, '2014-07-09', 10, 0, 'Saleh Ally logged in.'),
(317, '2014-07-09', 0, 6, 'Daily Sale : 3134000 for 2014-07-09 by Saleh Ally'),
(318, '2014-07-09', 10, 6, 'Daily Expense : 180500 for 2014-07-09'),
(319, '2014-07-09', 3, 0, 'Yusra Said logged in.'),
(320, '2014-07-10', 3, 0, 'Yusra Said logged in.'),
(321, '2014-07-10', 9, 0, 'Rahim Hassan logged in.'),
(322, '2014-07-10', 29, 0, 'Aysha Nassor logged in.'),
(323, '2014-07-10', 29, 1, 'Daily Expense : 10000 for 2014-07-09'),
(324, '2014-07-10', 29, 1, 'Daily Expense : 21000 for 2014-07-09'),
(325, '2014-07-10', 29, 1, 'Daily Expense : 10000 for 2014-07-09'),
(326, '2014-07-10', 0, 1, 'Binding Amount : 43000 for 2014-07-09 by Aysha Nassor'),
(327, '2014-07-10', 5, 0, 'Fatma Abdallah logged in.'),
(328, '2014-07-10', 0, 1, 'Manual Invoice: -9649500 by Aysha Nassor'),
(329, '2014-07-10', 3, 0, 'Yusra Said logged in.'),
(330, '2014-07-10', 3, 0, 'Yusra Said logged in.'),
(331, '2014-07-10', 20, 0, 'Hasssan Naajy logged in.'),
(332, '2014-07-10', 20, 0, 'Hasssan Naajy logged in.'),
(333, '2014-07-10', 29, 1, 'Entered Manual Invoice: 4419000 by Aysha Nassor'),
(334, '2014-07-10', 1, 0, 'Nadhir Bahayan logged in.'),
(335, '2014-07-10', 1, 0, 'Added : Hannan Awadh in the Database'),
(336, '2014-07-10', 30, 0, 'Hannan Awadh logged in.'),
(337, '2014-07-10', 9, 0, 'Rahim Hassan logged in.');

-- --------------------------------------------------------

--
-- Table structure for table `manual_invoices`
--

CREATE TABLE IF NOT EXISTS `manual_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `entered` tinyint(1) NOT NULL DEFAULT '0',
  `date_entered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `manual_invoices`
--

INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `entered`, `date_entered`) VALUES
(1, 6, '2014-07-01', -295000, 0, '0000-00-00'),
(2, 6, '2014-07-02', -365000, 0, '0000-00-00'),
(3, 6, '2014-07-03', -58000, 0, '0000-00-00'),
(5, 7, '2014-07-01', -966000, 0, '0000-00-00'),
(7, 6, '2014-07-04', -1231000, 0, '0000-00-00'),
(8, 5, '2014-07-05', -910000, 0, '0000-00-00'),
(9, 3, '2014-07-04', -3018500, 0, '0000-00-00'),
(11, 5, '2014-07-05', 910000, 0, '0000-00-00'),
(12, 7, '2014-07-05', -356000, 0, '0000-00-00'),
(13, 6, '2014-07-07', -328000, 0, '0000-00-00'),
(14, 6, '2014-07-05', -112000, 0, '0000-00-00'),
(15, 1, '2014-07-08', -4419000, 0, '0000-00-00'),
(16, 7, '2014-07-09', -111500, 0, '0000-00-00'),
(17, 1, '2014-07-09', -5230500, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `action` varchar(255) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `date`, `action`, `receipt_number`, `user_id`, `branch_id`, `amount`) VALUES
(2, '2014-07-01', 'return ct shear rng 1pc j2162 rng 1pc', '-', 4, 1, 135000),
(3, '2014-07-02', 'return bds golden white 4pc', '-', 4, 1, 42000),
(4, '2014-07-03', 'return fashion shaggy 200x290 3ps', '-', 4, 1, 870000),
(6, '2014-07-01', 'return hsc 66x66 2 pc', '-', 8, 3, 19000),
(7, '2014-07-01', 'retune lm-120x170', '-', 6, 2, 160000),
(9, '2014-07-02', 'retune TANZANITE-200X290', '-', 6, 2, 70000),
(10, '2014-07-03', 'retuned bds001', '-', 6, 2, 45000),
(11, '2014-07-01', 'return(jinan-120x270))1pc', '-', 3, 5, 18000),
(12, '2014-07-02', 'return(medallion-160x230)1pc', '-', 3, 5, 129000),
(14, '2014-07-01', 'manual invoice entered (belonging to june 2014)', '-', 6, 2, 7472000),
(15, '2014-07-02', 'manual invoice entered (belonging to june 2014)', '-', 3, 5, 2940000),
(16, '2014-07-02', 'returns', '-', 7, 7, 60000),
(17, '2014-07-03', 'returns', '-', 7, 7, 60000),
(18, '2014-07-05', 'j2250(rn)1pc', '3622', 3, 5, 70000),
(19, '2014-07-04', 'return(ct-assorted-hook)1pc', '-', 3, 5, 40000),
(20, '2014-07-04', 'return hsc 66x66 2 pc', '-', 3, 3, 19000),
(21, '2014-07-05', 'j2250(rn)1pc', '3622', 3, 5, -70000),
(22, '2014-07-05', 'cheque ', '574742', 29, 1, 8710000),
(23, '2014-07-05', 'africano 200x290', '5580', 29, 1, 157000),
(24, '2014-07-05', 'cheque', '5747', 29, 1, 5862500),
(25, '2014-07-06', 'ttku2-160x230-1pc', '8892', 3, 2, 70000),
(26, '2014-07-06', 'ttku2-160x230-1pc', '6687', 3, 5, 70000),
(27, '2014-07-07', 'lima-120x170-1pc', '8419', 3, 5, 160000),
(28, '2014-07-07', 'w1460-3-yl-1pc', '10493', 3, 5, 110000),
(29, '2014-07-07', 'bds004', 'arecpos011703', 10, 6, 60000),
(30, '2014-07-07', 'medallion-240x340-3pc', '0129', 3, 5, 780000),
(31, '2014-07-08', 'hl-c-05-1.6(2pc)', '00322', 3, 5, 86000);

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
  `amount` int(11) NOT NULL,
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
  `total_sale` int(11) NOT NULL,
  `audited_total_sale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `total_sale`
--

INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`) VALUES
(1, '2014-07-01', 6, 2, 3542000, 0),
(2, '2014-07-02', 6, 2, 4408000, 0),
(3, '2014-07-03', 6, 2, 6208500, 0),
(4, '2014-07-01', 1, 4, 11426500, 0),
(5, '2014-07-02', 1, 4, 9939000, 0),
(6, '2014-07-03', 1, 4, 17013000, 0),
(7, '2014-07-01', 3, 8, 1758000, 0),
(8, '2014-07-02', 3, 8, 2072500, 0),
(9, '2014-07-03', 3, 8, 3418000, 0),
(10, '2014-07-01', 2, 6, 19678000, 0),
(11, '2014-07-02', 2, 6, 9388500, 0),
(12, '2014-07-03', 2, 6, 10567500, 0),
(13, '2014-07-01', 5, 3, 3718500, 0),
(14, '2014-07-02', 5, 3, 7193000, 0),
(15, '2014-07-03', 5, 3, 5149000, 0),
(16, '2014-07-02', 4, 5, 153000, 0),
(17, '2014-07-03', 4, 5, 512500, 0),
(18, '2014-07-01', 4, 5, 345000, 0),
(22, '2014-07-01', 7, 7, 2691500, 0),
(23, '2014-07-02', 7, 7, 3050000, 0),
(24, '2014-07-03', 7, 7, 1687000, 0),
(25, '2014-07-04', 6, 3, 4811000, 0),
(26, '2014-07-05', 5, 3, 10135000, 0),
(27, '2014-07-04', 1, 3, 9529000, 0),
(28, '2014-07-04', 2, 3, 6831500, 0),
(29, '2014-07-04', 5, 3, 5207000, 0),
(30, '2014-07-04', 3, 3, 126000, 0),
(32, '2014-07-05', 1, 29, 27500500, 0),
(33, '2014-07-05', 7, 20, 3582000, 0),
(34, '2014-07-06', 7, 20, 687000, 0),
(35, '2014-07-06', 5, 3, 7123000, 0),
(36, '2014-07-06', 1, 29, 3758000, 0),
(42, '2014-07-07', 1, 29, 7115500, 0),
(43, '2014-07-07', 5, 3, 9623000, 0),
(44, '2014-07-07', 6, 10, 3547500, 0),
(45, '2014-07-05', 6, 10, 5347500, 0),
(46, '2014-07-08', 2, 5, 9041000, 0),
(47, '2014-07-08', 6, 10, 3337000, 0),
(48, '2014-07-07', 7, 20, 3205000, 0),
(49, '2014-07-08', 7, 20, 1835500, 0),
(50, '2014-07-09', 1, 29, 1811500, 0),
(51, '2014-07-08', 1, 29, 1811500, 0),
(52, '2014-07-09', 2, 5, 6309000, 0),
(53, '2014-07-09', 7, 20, 1248500, 0),
(54, '2014-07-09', 6, 10, 3134000, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES
(1, '2014-07-04', 'nadhir.bahayan@hsctz.com', 'jQueryMaster7', 0, 1, 1),
(2, '2014-07-04', 'nargis.ahmed@hsctz.com', 'na201451333', 0, 4, 1),
(3, '2014-07-04', 'yusra.said@hsctz.com', 'ys20142215', 0, 4, 1),
(4, '2014-07-04', 'thalia.hassan@hsctz.com', 'th20145134', 0, 4, 1),
(5, '2014-07-04', 'fatma.abdallah@hsctz.com', 'fa20144315', 0, 4, 1),
(6, '2014-07-04', 'samya.mohammed@hsctz.com', 'sm20145136', 0, 4, 1),
(7, '2014-07-04', 'saleh.naajy@hsctz.com', 'ssn20146315', 0, 4, 1),
(8, '2014-07-04', 'asia.abdallah@hsctz.com', 'aa20145137', 0, 4, 1),
(9, '2014-07-04', 'rahim.hassan@hsctz.com', 'rh20144444', 0, 2, 1),
(10, '2014-07-04', 'saleh.ally@hsctz.com', 'sa20148833', 0, 4, 1),
(11, '2014-07-04', 'latifa.mkwachu@hsctz.com', 'salesPassword', 5, 5, 3),
(12, '2014-07-04', 'feisal.sharif@hsctz.com', 'salesPassword', 5, 5, 3),
(13, '2014-07-04', 'maryam.abdallah@hsctz.com', 'salesPassword', 5, 5, -18),
(14, '2014-07-04', 'fatma.abdallah@hsctz.com', 'salesPassword', 5, 5, 3),
(15, '2014-07-04', 'abdul.kareem@hsctz.com', 'salesPassword', 5, 5, 3),
(16, '2014-07-04', 'fareed.hemeed@hsctz.com', 'salesPassword', 5, 5, 3),
(17, '2014-07-04', 'aisha.adam@hsctz.com', 'salesPassword', 5, 5, 3),
(18, '2014-07-04', 'habiba.said@hsctz.com', 'salesPassword', 5, 5, 3),
(19, '2014-07-05', 'saleh.naajy@hsctz.com', 'sn20142556', 0, 4, 1),
(20, '2014-07-05', 'hassan.naajy@hsctz.com', 'hn20143314', 0, 4, 1),
(29, '2014-07-05', 'aysha.nassor@hsctz.com', 'an20140010', 0, 4, 1),
(30, '2014-07-10', 'hannan.awadh@hsctz.com', 'ha20141121', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `user_id`) VALUES
(1, 'Nadhir', 'Bahayan', 1),
(2, 'Nargis', 'Ahmed', 2),
(3, 'Yusra', 'Said', 3),
(4, 'Thalia', 'Hassan', 4),
(5, 'Fatma', 'Abdallah', 5),
(6, 'Samya', 'Mohammed', 6),
(7, 'Saleh', 'Naajy', 7),
(8, 'Asia', 'Abdallah', 8),
(9, 'Rahim', 'Hassan', 9),
(10, 'Saleh', 'Ally', 10),
(11, 'Latifa', 'Mkwachu', 11),
(12, 'Feisal', 'Sharif', 12),
(13, 'Maryam', 'Abdallah', 13),
(14, 'Fatma', 'Abdallah', 14),
(15, 'Abdul', 'Kareem', 15),
(16, 'Fareed', 'Hemeed', 16),
(17, 'Aisha', 'Adam', 17),
(18, 'Habiba', 'Said', 18),
(19, 'Saleh', 'Naajy', 19),
(20, 'Hasssan', 'Naajy', 20),
(21, 'Aysha', 'Nassor', 29),
(22, 'Hannan', 'Awadh', 30);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
