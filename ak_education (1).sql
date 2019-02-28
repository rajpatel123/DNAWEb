-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2019 at 09:25 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ak_education`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`, `status`, `created_on`) VALUES
(1, 'NEET-PG', '1546970143package-image.jpg', 1, '2019-01-08'),
(2, 'NEET-UG', '1547433834user_blank.png', 1, '2019-01-13'),
(3, 'NEET-SS', '1547434027user_blank.png', 1, '2019-01-13'),
(4, 'Today Update', '', 1, '2019-01-26'),
(5, 'Live Online', '', 1, '2019-01-26'),
(6, 'Shopping', '', 1, '2019-01-26'),
(7, 'Test Series', '', 1, '2019-01-26'),
(8, 'MBBS PROF.', '', 1, '2019-01-26'),
(9, 'Feedback', '', 1, '2019-01-26'),
(10, 'Contact us', '', 1, '2019-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0 - Deactive, 1 - Active, 2 - Suspend ',
  `mverify_code` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `username`, `email_id`, `mobile_no`, `image`, `password`, `fb_id`, `status`, `mverify_code`, `created_on`) VALUES
(1, 'anil', 'anil1993', 'er.aniljadon.ak@gmail.com', '', '', 'anil1993', '', '1', 0, '2019-01-21 10:20:39'),
(2, 'Rishabh', 'rishu@123', 'rishu@gmail.com', '', '', '12345678', '', '1', 0, '2019-01-23 05:09:07'),
(3, 'Rishabh1', 'rishu@1234', 'rishu123@gmail.com', '', '', '12345', '', '1', 0, '2019-01-23 05:21:05'),
(4, 'rahul kumar', 'rahul123', 'rahul@gmail.com', '', '', '1234', '', '1', 0, '2019-01-23 07:37:58'),
(5, 'bhav', 'bhav123', 'bhav@gmail.com', '', '', '123456', '', '1', 0, '2019-01-23 08:10:32'),
(6, 'ryu', 'ttyuu7', 'tt@gmail.com', '', '', '12345678', '', '1', 0, '2019-01-24 00:03:44'),
(7, 'vikrant', 'vikrant123', 'vikrant@gmail.com', '', '', '123456', '', '1', 0, '2019-01-24 00:26:02'),
(8, 'vikrant bhawani', 'vikran12', 'vikrantbhawani123@gmail.com', '', '', 'vikrantbhawani1234', '', '1', 0, '2019-01-24 00:52:48'),
(9, 'Mohan Kumar', 'Mohan123', 'coolmohan667@gmail.com', '', '', 'mohan667', '', '1', 0, '2019-01-24 00:53:01'),
(10, 'Manish', 'Chandra', 'manish.bhumca16@gmail.com', '', '', 'Manish@1993', '', '1', 0, '2019-01-24 00:57:55'),
(11, 'ram', 'kumar', 'jpr122450@gmail.com', '', '', '123456789', '', '1', 0, '2019-01-24 00:59:44'),
(12, 'ankush', 'ankush', 'ankushbatra16@gmail.com', '', '', '12345678', '', '1', 0, '2019-01-24 01:39:16'),
(13, 'Tarun', 'TarunRajput', 'rajputtarun89799@gmail.com', '', '', 'tarun7017', '', '1', 0, '2019-01-24 01:54:33'),
(14, 'shruti hassan', 'shruti', 'shruti123@gmail.com', '', '', 'shruti123', '', '1', 0, '2019-01-24 11:46:54'),
(15, 'ram', 'ramsingh', 'logicalmastermind@gmail.com', '', '', 'ramsingh123', '', '1', 0, '2019-01-24 22:21:20'),
(16, 'vivek', 'vivekjha', 'vivekjha@gmail.com', '', '', 'vivek@gmail.com', '', '1', 0, '2019-01-24 22:23:15'),
(17, 'rajkumar', 'rajkumar', 'rajkumar@gmail.com', '', '', 'rajkumar', '', '1', 0, '2019-01-24 22:29:26'),
(18, 'rajiv kumar', 'Rajiv', 'rajiv123@gmail.com', '', '', 'rajiv@1234', '', '1', 0, '2019-01-25 09:03:07'),
(19, 'kishan gupta', 'kishan gupta', 'gkishan832@gmail.com', '', '', 'kishan123', '', '1', 0, '2019-02-08 05:35:19'),
(20, 'kishan ', 'kishan gupta', 'kishangupta21995@gmail.com@gmail.com', '', '', 'kishan123', '', '1', 0, '2019-02-14 02:52:45'),
(21, 'kishan ', 'kishan gupta', 'kishangupta21995@gmail.com', '', '', 'kishan123', '', '1', 0, '2019-02-14 02:54:30'),
(22, 'Bhawaprakash', 'Bhawa', 'bhawa123@gmail.com', '', '', 'tarun7017', '', '1', 0, '2019-02-15 04:15:08'),
(23, 'hello', 'hello', 'hello@hello.hello', '', '', 'aaaaaa', '', '1', 0, '2019-02-23 01:54:34'),
(25, 'anjali', 'anjali', 'anjali@gmail.com', '', '', '', 'anjaliak803', '1', 0, '2019-02-24 06:52:30'),
(26, 'rishabh', 'rishabh', 'hisabh@gmail.com', '', '', '', '23584748974897489', '1', 0, '2019-02-24 23:16:25'),
(27, 'Rishabh Saxena', 'Rishabh Saxena', 'saxenarishav11@gmail.com', '', '', '', '988070101377390', '1', 0, '2019-02-25 00:20:43'),
(28, 'Rishabh', 'Rishabh', 'saxenarishav11@gmail.com', '', '', '', '12257357358', '1', 0, '2019-02-27 07:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `final_result`
--

CREATE TABLE `final_result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `tquestion` int(11) NOT NULL,
  `canswer` int(11) NOT NULL,
  `wanswer` int(11) NOT NULL,
  `sanswer` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_result`
--

INSERT INTO `final_result` (`id`, `user_id`, `test_id`, `tquestion`, `canswer`, `wanswer`, `sanswer`, `created_on`) VALUES
(6, 1, 1, 10, 3, 2, 5, '2019-02-07 09:16:53'),
(106, 1, 14, 11, 1, 6, 4, '2019-02-27 02:20:23'),
(100, 1, 6, 4, 1, 3, 0, '2019-02-26 10:03:08'),
(107, 1, 14, 11, 1, 6, 4, '2019-02-27 02:20:38'),
(108, 1, 14, 11, 0, 0, 11, '2019-02-27 02:22:48'),
(134, 12, 6, 4, 0, 4, 0, '2019-02-27 21:04:47'),
(103, 1, 14, 11, 0, 0, 11, '2019-02-27 02:12:38'),
(133, 12, 6, 4, 1, 1, 2, '2019-02-27 11:25:52'),
(132, 12, 14, 11, 2, 5, 4, '2019-02-27 11:23:11'),
(131, 12, 6, 4, 2, 0, 2, '2019-02-27 11:10:32'),
(130, 13, 14, 11, 0, 0, 11, '2019-02-27 10:43:48'),
(129, 13, 14, 11, 0, 0, 11, '2019-02-27 10:16:35'),
(128, 27, 14, 11, 3, 2, 6, '2019-02-27 09:02:56'),
(127, 27, 14, 11, 0, 0, 11, '2019-02-27 08:59:38'),
(109, 1, 14, 11, 0, 0, 11, '2019-02-27 02:23:15'),
(57, 1, 6, 4, 2, 1, 1, '2019-02-13 01:54:48'),
(126, 27, 14, 11, 0, 0, 11, '2019-02-27 08:47:49'),
(125, 1, 19, 1, 0, 0, 1, '2019-02-27 07:10:58'),
(124, 1, 14, 11, 0, 0, 11, '2019-02-27 06:34:13'),
(123, 1, 14, 11, 0, 0, 11, '2019-02-27 06:27:52'),
(122, 1, 14, 11, 0, 0, 11, '2019-02-27 06:26:11'),
(121, 1, 14, 11, 0, 0, 11, '2019-02-27 06:24:29'),
(104, 1, 14, 11, 1, 6, 4, '2019-02-27 02:20:03'),
(65, 1, 19, 1, 0, 0, 1, '2019-02-13 23:55:06'),
(120, 1, 14, 11, 0, 0, 11, '2019-02-27 06:23:02'),
(67, 3, 13, 4, 2, 1, 1, '2019-02-14 06:42:01'),
(119, 1, 14, 11, 0, 0, 11, '2019-02-27 06:19:52'),
(118, 1, 14, 11, 3, 5, 3, '2019-02-27 06:09:56'),
(117, 1, 14, 11, 0, 0, 11, '2019-02-27 06:05:47'),
(116, 1, 14, 11, 0, 0, 11, '2019-02-27 06:01:11'),
(115, 1, 6, 30, 15, 12, 3, '2019-02-27 03:20:28'),
(114, 1, 6, 30, 15, 12, 3, '2019-02-27 02:41:54'),
(113, 1, 14, 11, 0, 0, 11, '2019-02-27 02:36:56'),
(75, 5, 13, 4, 1, 3, 0, '2019-02-20 08:55:50'),
(101, 1, 6, 30, 15, 12, 3, '2019-02-26 22:26:32'),
(77, 1, 14, 11, 0, 1, 10, '2019-02-20 08:58:04'),
(78, 4, 13, 4, 1, 0, 3, '2019-02-20 09:19:31'),
(79, 2, 6, 4, 1, 3, 0, '2019-02-20 10:32:48'),
(112, 1, 14, 11, 0, 0, 11, '2019-02-27 02:26:20'),
(81, 3, 6, 4, 1, 2, 1, '2019-02-21 01:55:31'),
(111, 1, 14, 11, 1, 0, 10, '2019-02-27 02:24:30'),
(83, 2, 13, 4, 4, 0, 0, '2019-02-23 10:28:09'),
(110, 1, 14, 11, 1, 0, 10, '2019-02-27 02:24:10'),
(87, 2, 19, 1, 0, 0, 1, '2019-02-25 03:25:10'),
(88, 1, 13, 4, 0, 0, 4, '2019-02-25 03:26:12'),
(105, 1, 14, 11, 1, 6, 4, '2019-02-27 02:20:09'),
(93, 4, 6, 4, 0, 1, 3, '2019-02-25 06:02:45'),
(95, 5, 6, 4, 1, 3, 0, '2019-02-25 23:28:21'),
(96, 4, 14, 11, 5, 4, 2, '2019-02-26 06:40:48'),
(97, 3, 14, 11, 6, 2, 3, '2019-02-26 06:48:08'),
(98, 2, 14, 11, 7, 0, 4, '2019-02-26 06:48:33'),
(102, 1, 14, 11, 0, 1, 10, '2019-02-27 02:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `txt_no` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_date` varchar(50) NOT NULL,
  `order_status` int(11) NOT NULL,
  `delivery_status` varchar(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `order_id`, `txt_no`, `product_id`, `quantity`, `price`, `total_price`, `color`, `size`, `message`, `payment_type`, `payment_status`, `payment_date`, `order_status`, `delivery_status`, `created_on`) VALUES
(2, 1, 'ORD1359', '77480332', 4, '1', '600', '918', 'Yellow', '2-4', '', 1, 0, '', 1, '2', '2018-09-01 18:47:32'),
(3, 11, 'ORD6213', '33224821', 9, '1', '700', '1021', '', 'Red', '', 1, 0, '', 1, '0', '2018-09-03 13:48:29'),
(4, 6, 'ORD2210', '69975274', 122, '1', '600', '1439', '', 'Red', '', 1, 0, '', 1, '2', '2018-09-03 17:28:10'),
(5, 6, 'ORD2210', '69975274', 76, '1', '700', '1439', '', 'Red', '', 1, 0, '', 1, '2', '2018-09-03 17:28:10'),
(6, 11, 'ORD6541', '70901794', 23, '1', '100', '403', '2-4', 'Pink', '', 1, 0, '', 1, '0', '2018-09-03 19:38:10'),
(7, 6, 'ORD6598', '34677466', 23, '1', '100', '203', '2-4', 'White', '', 1, 0, '', 1, '2', '2018-09-03 22:53:31'),
(18, 1, 'ORD3979', '38460811', 4, '1', '600', '918', '', 'Red', '', 2, 0, '', 0, '0', '2018-10-04 14:06:04'),
(17, 15, 'ORD9031', '93968557', 4, '2', '1200', '1436', '', 'Yellow', '', 2, 0, '', 0, '0', '2018-09-12 12:59:00'),
(16, 1, 'ORD4055', '26574288', 23, '1', '100', '403', '', 'Yellow', '', 2, 0, '', 0, '0', '2018-09-08 19:34:42'),
(15, 1, 'ORD1262', '46711567', 1, '1', '60', '361', '', '', '', 2, 0, '', 0, '0', '2018-09-08 19:10:58'),
(14, 1, 'ORD8974', '38401526', 23, '1', '100', '303', '', 'Yellow', '', 2, 0, '', 0, '0', '2018-09-08 18:59:49'),
(19, 1, 'ORD8284', '25313122', 9, '1', '700', '1103', 'Green', '', '', 2, 0, '', 0, '0', '2018-10-04 15:44:43'),
(20, 1, 'ORD8284', '25313122', 521, '1', '20', '1103', 'White', '', '', 2, 0, '', 0, '0', '2018-10-04 15:44:43'),
(21, 1, 'ORD8284', '25313122', 1, '1', '60', '1103', 'Yellow', '2-4', '', 2, 0, '', 0, '0', '2018-10-04 15:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `cat_id`, `sub_cat_name`, `status`, `created_on`) VALUES
(1, 1, 'MD / MS / DNB', 1, '2019-02-13 22:44:44'),
(4, 3, 'DM', 1, '2019-01-13 20:13:22'),
(5, 2, 'PHYSICS', 1, '2019-02-13 23:12:53'),
(6, 3, 'M. Ch', 1, '2019-02-13 22:45:53'),
(8, 4, 'Exam', 1, '2019-01-26 05:11:41'),
(9, 4, 'Questions', 1, '2019-01-26 05:08:19'),
(10, 5, 'Tutorials', 1, '2019-01-26 05:09:14'),
(11, 6, 'Books', 1, '2019-01-26 05:09:47'),
(12, 6, 'SRP Classes', 1, '2019-01-26 05:10:13'),
(13, 7, 'Login', 1, '2019-01-26 05:10:28'),
(14, 8, 'University Exam', 1, '2019-01-26 05:10:51'),
(15, 2, 'CHEMISTRY', 1, '2019-02-13 23:13:08'),
(16, 2, 'BIOLOGY', 1, '2019-02-13 23:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `sub_child_category`
--

CREATE TABLE `sub_child_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `sub_child_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_child_category`
--

INSERT INTO `sub_child_category` (`id`, `cat_id`, `sub_cat_id`, `sub_child_name`, `status`, `created_on`) VALUES
(1, 1, 1, 'PATHOLOGY', 1, '2019-02-13 22:55:12'),
(2, 1, 1, 'BIOCHEMISTRY', 1, '2019-02-13 22:54:36'),
(3, 1, 1, 'PHYSIOLOGY', 1, '2019-02-13 22:54:10'),
(4, 1, 1, 'ANATOMY', 1, '2019-02-13 22:53:31'),
(5, 3, 4, 'GASTRO', 1, '2019-01-21 08:26:14'),
(6, 3, 4, 'NEURO', 1, '2019-02-13 23:17:28'),
(8, 3, 4, 'ENDO', 1, '2019-02-13 23:17:59'),
(9, 3, 4, 'RHEUMATOLOGY', 1, '2019-02-13 23:18:40'),
(10, 3, 4, 'PULMONO', 1, '2019-01-21 08:28:28'),
(11, 3, 6, 'GASTRO', 1, '2019-01-21 08:28:54'),
(12, 3, 6, 'URO', 1, '2019-01-21 08:29:02'),
(13, 3, 6, 'CTVS', 1, '2019-01-21 08:29:21'),
(19, 2, 5, 'CLASS - XI', 1, '2019-02-13 23:13:53'),
(20, 1, 1, 'PHARMACOLOGY', 1, '2019-02-13 22:56:08'),
(21, 1, 1, 'MICROBIOLOGY', 1, '2019-02-13 22:56:42'),
(22, 1, 1, 'F.M.T', 1, '2019-02-13 22:56:57'),
(23, 1, 1, 'E.N.T', 1, '2019-02-13 22:57:13'),
(24, 1, 1, 'OPTHALMOLOGY', 1, '2019-02-13 22:57:33'),
(25, 1, 1, 'COMMUNITY MEDICINE ( P.S.M )', 1, '2019-02-13 22:58:13'),
(26, 1, 1, 'MEDICINE', 1, '2019-02-13 22:58:30'),
(27, 1, 1, 'SURGERY', 1, '2019-02-13 22:58:45'),
(28, 1, 1, 'GYNE & OBS', 1, '2019-02-13 22:59:11'),
(29, 1, 1, 'PEDIATRICS', 1, '2019-02-13 22:59:27'),
(30, 1, 1, 'RADIOLOGY', 1, '2019-02-13 22:59:41'),
(31, 1, 1, 'ORTHOPAEDICS', 1, '2019-02-13 22:59:58'),
(32, 1, 1, 'PSYCHIATRY', 1, '2019-02-13 23:00:13'),
(33, 1, 1, 'ANAESTHESIA', 1, '2019-02-13 23:00:30'),
(34, 1, 1, 'DERMATOLOGY', 1, '2019-02-13 23:00:45'),
(35, 2, 5, 'CLASS - XII', 1, '2019-02-13 23:14:24'),
(36, 2, 15, 'CLASS - XI', 1, '2019-02-13 23:14:44'),
(37, 2, 15, 'CLASS - XII', 1, '2019-02-13 23:14:55'),
(38, 2, 16, 'CLASS - XI', 1, '2019-02-13 23:15:10'),
(39, 2, 16, 'CLASS - XII', 1, '2019-02-13 23:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `question` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `paid` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `date`, `file`, `name`, `question`, `duration`, `category`, `paid`, `status`, `created_on`) VALUES
(6, '02/06/2019', '1549364453light_thump.png', 'All-India NIMHANS Mock Exam', '60', '45m', 'Grand Test', 'Yes', 1, '2019-02-05 04:00:53'),
(13, '12/09/2018', '1549366232pexels-photo_thump.jpg', 'Image Based Grand Test', '30', '2h', 'Mini Test', 'Yes', 1, '2019-02-05 04:30:32'),
(14, '02/03/2019', '1549366943Desktop-autumn-hd-wallpaper-3D_thump.jpg', 'Revision Grand Test', '90', '3 hour', 'Subject Wise Test', 'No', 1, '2019-02-05 04:42:23'),
(19, '02/04/2019', '1550119169Screen Shot 2019-02-13 at 4.54.03 PM_thump.png', 'dna', '2', '30m', 'Mini Test', 'No', 1, '2019-02-13 21:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `currect_ans` text NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`id`, `test_id`, `question`, `ans1`, `ans2`, `ans3`, `ans4`, `currect_ans`, `created_on`) VALUES
(19, 14, 'All are true about anion gap except', 'In lactic acidosis anion gap is increased', 'Anion gap is descrease in hypercalcemia', 'Anion gap is decreased in Lithium toxicity', 'Anion gap is decreased in Ketoacidosis', 'Anion gap is decreased in Lithium toxicity', '2019-02-07 08:17:18'),
(12, 17, 'Time dependent killing and  nil/minimal post antibiotic effect is seen with', 'Linezolid ', 'Tetracyclines', 'Vancomycin ', 'Erythromycin', 'Vancomycin', '2019-02-06 05:59:31'),
(4, 18, 'Which is the least preferred benzodiazepine in elderly with liver dysfunction?', 'Lorazepam', 'Oxazepam', 'Temazepam', 'Diazepam', 'Oxazepam', '2019-02-05 21:14:38'),
(5, 18, 'Which is the least preferred benzodiazepine in elderly with liver dysfunction?', '   Oxazepam  ', 'Lorazepam', ' Temazepam', ' Diazepam', 'Oxazepam', '2019-02-05 21:16:17'),
(6, 18, 'Streptococcus bovis infection  is associated with', 'CLL', 'Hairy cell', 'Colorectal', 'Multiple', 'CLL', '2019-02-06 05:02:57'),
(7, 18, 'Mycoplsma is intrinsically resistant to -------------------------', 'Ceftriaxone', 'Doxycycline', 'azithromycin', 'Levofloxacin', 'Levofloxacin', '2019-02-06 05:08:09'),
(8, 18, 'Sclerotic bodies are seen in_________________', 'Sporothrix', 'Blastomycosis', 'Chromoblastomycosis', 'coccidiodes', 'coccidiodes', '2019-02-06 05:15:01'),
(9, 18, 'Werner syndrome is _______________', 'MEN I', 'MEN II', 'Premature ageing', 'Defective sirtuins', 'MEM I', '2019-02-06 05:20:03'),
(10, 18, 'Which of the following is common in patients with Kallmann syndrome', 'Anosmia', 'A white forelock', ' Precocious puberty in females ', 'Syndactyly and hyperphagic odesity in malew', 'A white forelock', '2019-02-06 05:27:46'),
(11, 18, 'Which of the following is an example of anaplerotic reaction', 'Pyruvate to oxaloacetate', 'Pyruvate to actey coenzyme ', 'Pyruvate to lactic acid ', 'Pyruvate to acetalbehyde', 'Pyruvate to oxaloacetate', '2019-02-06 05:31:12'),
(13, 17, 'All are true about dexmedetomidine except ', 'Centrally acting alpha-2 antagonist ', 'it can be administered as IV infusion', 'Dry mouth is a side effect', 'Metabolism mainly in liver', 'Dry mouth is a side effect', '2019-02-06 06:02:57'),
(14, 17, 'The Stafne bone cyst is ___________ ', 'Point of maximum tension in a fracture ', 'Relaxed Tension lines in skin ', ' collagen and elastin lines in stab injury ', 'Point of tension in hanging', 'Point of tension in hanging', '2019-02-06 06:07:57'),
(15, 17, 'Grayhack shunt is established between_________________', 'Corpora cavernosa and corpora spongiosa ', 'corpora caverosa and  sapheous vein', ' corora cavernosa and dorsal vein ', 'Corpora cavernosa and glans', 'Corpora cavernosa and glans', '2019-02-06 06:13:33'),
(16, 17, 'Modified Shock index is calculated using', 'HR/SBP', 'HR/DBP', 'HR/MAP', 'PR/SBP', 'HR/DBP', '2019-02-06 06:27:16'),
(17, 17, 'The McLeod phenotype is associated with the deficiency of which of the following?', 'Duffy antigen ', 'Kidd proteni', 'kell protein', 'None of the above ', 'None of the above ', '2019-02-06 06:32:49'),
(18, 17, 'The reagent used to distinguish staphylococci from streptococci is', 'Hydrogen peroxide', 'Fibronectin', 'Fibrinecten', 'Oxidase', 'Oxidase', '2019-02-06 06:35:54'),
(20, 14, 'Which of these is not a pre-leukemic condition?', 'Aplastic anemia', 'Myelodysplastic syndrome', 'Myelodysplastic', 'anemia', 'anemia', '2019-02-07 08:19:04'),
(21, 13, '	\nThe number of moles of solute present in 1 kg of a solvent is called its', 'molality', 'molarity', 'normality', 'formality', 'molality', '2019-02-07 10:10:02'),
(22, 13, 'The metallurgical process in which a metal is obtained in a fused state is called', 'smelting', 'roasting', 'calcinations', 'froth floatation', 'smelting', '2019-02-07 10:11:25'),
(25, 6, 'Gamma Camera is used for......', 'Imaging', 'To scan surface', 'To radiate a tumor', 'To image radioactivity', 'To radiate a tumor', '2019-02-07 10:31:02'),
(26, 6, 'Band shaped keratopathy is seen in all except....', 'Sickle cell', 'Sarcoidosis', 'Glaucoma', 'Renal Failure', 'Glaucoma', '2019-02-07 10:32:35'),
(27, 6, 'what is this Coadministration......', 'Antibiotics', 'Barbiturates', 'Glucocorticoids', 'Alcohol', 'Barbiturates', '2019-02-07 10:34:11'),
(28, 6, 'Type 3 dysbetalipoproteinemia is due to....', 'Defective apo E', 'Overproduction of VLDL', 'Absent', 'Apo CII deficiency', 'Defective apo E', '2019-02-07 10:35:49'),
(29, 13, 'True about pelvic abscess is....', 'Associated with pythorax', 'May spontaneosly', 'Uncommon cause of ', 'Identified by CT', 'Uncommon cause of ', '2019-02-07 10:38:18'),
(30, 13, 'Sphincter and dilator pupillae develop from', 'Surface ectoderm', 'Neural crest', 'Neural ectoderm', 'Mesoderm', 'Mesoderm', '2019-02-07 10:39:52'),
(31, 14, 'Which of the following manifestation of cisplatin toxicity?', 'Hemorrhagic cystitis', 'Optic neuritis', 'Rhabdomyolysis', 'Ototoxicity', 'Optic neuritis', '2019-02-07 10:42:45'),
(32, 14, 'Sistrunk operation is done for........', 'Thyroglossal cyst', 'Dentigenous cyst', 'Meningo', 'Branchial', 'Meningo', '2019-02-07 10:44:33'),
(33, 14, 'Lymphatic drainage of prostate is into......', 'Interanal iliac ', 'External iliac', 'para-aortic lymph', 'Superficial', 'External iliac', '2019-02-07 10:46:37'),
(34, 14, 'Which of the following are myths related to weight management?', 'Supplements for weight loss will do the trick ', 'Stopping snacking will help lose weight', 'Quitting carbs and fat will help prevent weight gain  ', 'All of the above', 'All of the above', '2019-02-08 02:51:14'),
(35, 14, 'Which of the following is a useful tip for weight management?', 'Moving to a complete protein diet   										  	', 'Moving to fat-free, sugar-free diet   										  	', 'Skipping meals is the best way to lose weight ', 'None of the above', 'None of the above', '2019-02-08 02:53:44'),
(36, 14, 'How much physical activity (brisk walking/jogging/running/cycling/swimming, etc.) do you get per week?', 'Sedantary', 'Moderate', 'Athletic', 'Active', 'Moderate', '2019-02-08 02:58:56'),
(37, 14, 'Do you have any dietary restrictions or preferences?', 'Vegetarian', 'Non-vegetarian', 'Eggetarian', 'Vegan', 'Vegetarian', '2019-02-08 03:02:08'),
(38, 14, 'ICSI stands for', 'Intra Cytsolic Semen Injection ', 'Inter Cytosolic Semen Injection ', 'Intra Cytoplasmic Sperm Injection ', 'Inter Cytoplasmic Sperm Injection', 'Intra Cytoplasmic Sperm Injection ', '2019-02-08 03:05:00'),
(39, 14, 'ICSI can be performed in all of the following cases except-', 'Failure of IVF ', 'Asthenospermia (sperms are immobile) ', 'Polyspermia ', 'Severe Oligospermia', 'Polyspermia ', '2019-02-08 03:07:16'),
(40, 19, 'which of the ?', 'optin 1', '2', '3', '4', '3', '2019-02-13 21:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_type` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `facilities` text NOT NULL,
  `brand` text NOT NULL,
  `price_rating` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `privacy_policy` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `shop_name`, `shop_type`, `email`, `password`, `profile_pic`, `mobile_no`, `address`, `latitude`, `longitude`, `category`, `facilities`, `brand`, `price_rating`, `type`, `status`, `privacy_policy`, `created_on`) VALUES
(1, 'DNA', 'admin', '', '', 'info@dna.com', 'e10adc3949ba59abbe56e057f20f883e', '', '9131974355', '', '', '', '', '', '', '', 'Admin', 1, 1, '2018-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `video_pdf`
--

CREATE TABLE `video_pdf` (
  `id` int(11) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `sub_child_cat` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `file` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_pdf`
--

INSERT INTO `video_pdf` (`id`, `file_type`, `sub_child_cat`, `type`, `file`, `title`, `sub_title`, `desc`, `status`, `created_on`) VALUES
(9, 'video', 5, 2, '154857095923665151_228235431047555_8457618035568541696_n.mp4', 'Test2', 'Test2', '', 1, '2019-01-26 23:36:06'),
(8, 'video', 5, 1, '154857089723992637_296895610714539_3897207797737062400_n.mp4', 'Test1', 'Test1', '', 1, '2019-01-26 23:35:00'),
(7, 'video', 1, 1, '154857072923992637_296895610714539_3897207797737062400_n.mp4', 'Biology', 'Test', '', 1, '2019-01-26 23:32:09'),
(10, 'video', 5, 1, '1548735608VID-20190126-WA0004.mp4', 'GASTRO', 'Republic day', ' Republic day', 1, '2019-01-28 21:20:08'),
(11, 'video', 5, 1, '1548735695VID-20190126-WA0008.mp4', 'Song', 'song', '26 january song', 1, '2019-01-28 21:21:35'),
(12, 'video', 5, 1, '1548735818VID-20181215-WA0035.mp4', 'GASTRO', 'motivation ', 'Motivational Songs', 1, '2019-01-28 21:23:39'),
(13, 'video', 1, 1, '1548765098VID-20181215-WA0035.mp4', 'Biology', 'Motivational', '', 1, '2019-01-29 05:31:38'),
(14, 'video', 1, 1, '1548765100VID-20181215-WA0035.mp4', 'Biology', 'Motivational', '', 1, '2019-01-29 05:31:43'),
(15, 'video', 1, 1, '1548765103VID-20181215-WA0035.mp4', 'Biology', 'Motivational', '', 1, '2019-01-29 05:31:43'),
(16, 'video', 1, 1, '1548765711VID-20190126-WA0008.mp4', 'Biology', '26 January', '', 1, '2019-01-29 05:41:52'),
(17, 'video', 2, 1, '1548765849VID-20181215-WA0035.mp4', 'Chemistry', 'Motivational', '', 1, '2019-01-29 05:44:11'),
(18, 'video', 2, 1, '1548765909VID-20190126-WA0008.mp4', 'Chemistry', '26 January', '', 1, '2019-01-29 05:45:09'),
(19, 'video', 3, 1, '1548766007VID-20181215-WA0035.mp4', 'Physics', 'Motivational', '', 1, '2019-01-29 05:46:49'),
(20, 'video', 3, 1, '1548766110VID-20190126-WA0008.mp4', 'Physics', 'Exam', '', 1, '2019-01-29 05:48:30'),
(21, 'video', 4, 1, '1548766158VID-20181215-WA0035.mp4', 'Maths', 'Exam', '', 1, '2019-01-29 05:49:20'),
(22, 'video', 4, 1, '1548766196VID-20190126-WA0008.mp4', 'Maths', 'Result', '', 1, '2019-01-29 05:49:56'),
(23, 'video', 6, 1, '1548766243VID-20181215-WA0035.mp4', 'NEVRO', 'Exam', '', 1, '2019-01-29 05:50:43'),
(24, 'video', 6, 1, '1548766281VID-20190126-WA0008.mp4', 'NEVRO', 'Result', '', 1, '2019-01-29 05:51:21'),
(25, 'video', 7, 1, '1548766326VID-20181215-WA0035.mp4', 'Ram', 'Exam', '', 1, '2019-01-29 05:52:08'),
(26, 'video', 7, 1, '1548766367VID-20190126-WA0008.mp4', 'Ram', 'Result', '', 1, '2019-01-29 05:52:47'),
(27, 'video', 8, 1, '1548766409VID-20181215-WA0035.mp4', 'EN DO', 'Exam', '', 1, '2019-01-29 05:53:32'),
(28, 'video', 8, 1, '1548766454VID-20190126-WA0008.mp4', 'EN DO', 'Result', '', 1, '2019-01-29 05:54:14'),
(29, 'video', 9, 1, '1548766504VID-20181215-WA0035.mp4', 'RHEBMATO', 'Exam', '', 1, '2019-01-29 05:55:04'),
(30, 'video', 9, 1, '1548766553VID-20190126-WA0008.mp4', 'RHEBMATO', 'Result', '', 1, '2019-01-29 05:55:53'),
(31, 'video', 10, 1, '1548766631VID-20181215-WA0035.mp4', 'PULMONO', 'Exam', '', 1, '2019-01-29 05:57:14'),
(32, 'video', 10, 1, '1548766683VID-20190126-WA0008.mp4', 'PULMONO', 'Result', '', 1, '2019-01-29 05:58:03'),
(33, 'video', 12, 1, '1548766733VID-20181215-WA0035.mp4', 'URO', 'Exam', '', 1, '2019-01-29 05:58:55'),
(34, 'video', 12, 1, '1548766770VID-20190126-WA0008.mp4', 'URO', 'Result', '', 1, '2019-01-29 05:59:30'),
(35, 'video', 13, 1, '1548766806VID-20181215-WA0035.mp4', 'CTVS', 'Exam', '', 1, '2019-01-29 06:00:10'),
(36, 'video', 13, 1, '1548766844VID-20190126-WA0008.mp4', 'CTVS', 'Result', '', 1, '2019-01-29 06:00:44'),
(37, 'video', 14, 1, '1548766921VID-20181215-WA0035.mp4', 'testing', 'Exam', '', 1, '2019-01-29 06:02:04'),
(38, 'video', 14, 1, '1548766954VID-20190126-WA0008.mp4', 'testing', 'Result', '', 1, '2019-01-29 06:02:34'),
(39, 'video', 16, 1, '1548766996VID-20181215-WA0035.mp4', 'UG1', 'Exam', '', 1, '2019-01-29 06:03:16'),
(40, 'video', 16, 1, '1548767034VID-20190126-WA0008.mp4', 'UG1', 'Result', '', 1, '2019-01-29 06:03:54'),
(41, 'video', 17, 1, '1548767079VID-20181215-WA0035.mp4', 'UG2', 'Exam', '', 1, '2019-01-29 06:04:39'),
(42, 'video', 17, 1, '1548767109VID-20190126-WA0008.mp4', 'UG2', 'Result', '', 1, '2019-01-29 06:05:09'),
(43, 'video', 18, 1, '1548767147VID-20181215-WA0035.mp4', 'UG2', 'Exam', '', 1, '2019-01-29 06:05:47'),
(44, 'video', 18, 1, '1548767179VID-20190126-WA0008.mp4', 'UG9', 'Result', '', 1, '2019-01-29 06:06:20'),
(45, 'video', 19, 1, '1548767223VID-20181215-WA0035.mp4', 'TestData', 'Exam', '', 1, '2019-01-29 06:07:03'),
(46, 'video', 19, 1, '1548767254VID-20190126-WA0008.mp4', 'TestData', 'Result', '', 1, '2019-01-29 06:07:34'),
(47, 'video', 1, 1, '1548953896SampleVideo_1280x720_1mb.mp4', 'Helth traning video', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 1, '2019-01-31 09:58:16'),
(48, 'video', 2, 1, '1548953954videoplayback.mp4', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 1, '2019-01-31 09:59:14'),
(49, 'pdf', 3, 2, '1548954017MEET DOCTOR EASY PORTAL.pdf', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', '', 1, '2019-01-31 10:00:17'),
(50, 'video', 3, 1, '1548954655videoplayback (2).mp4', 'How to Fix a Short Leg', 'Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus', 'Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae', 1, '2019-01-31 10:11:06'),
(51, 'video', 3, 1, '1548954740videoplayback (2).mp4', 'How to Fix a Short Leg', 'How to Fix a Short Leg', 'How to Fix a Short Leg', 1, '2019-01-31 10:12:34'),
(52, 'video', 4, 2, '1548958640SampleVideo_1280x720_1mb.mp4', 'DNA Siksha', 'DNA Siksha', 'Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in ', 1, '2019-01-31 11:17:20'),
(53, 'video', 0, 2, '', 'DNA Siksha', 'faucibus orci luctus', 'Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in ', 1, '2019-01-31 11:18:01'),
(54, 'video', 3, 2, '1548958742videoplayback (2).mp4', 'faucibus orci luctus', 'faucibus orci luctus', 'faucibus orci luctus', 1, '2019-01-31 11:19:22'),
(55, 'video', 3, 2, '1548958763videoplayback (2).mp4', 'faucibus orci luctus', 'faucibus orci luctus', 'faucibus orci luctus', 1, '2019-01-31 11:19:36'),
(56, 'video', 3, 2, '1548958783videoplayback (2).mp4', 'faucibus orci luctus', 'faucibus orci luctus', 'faucibus orci luctus', 1, '2019-01-31 11:19:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_result`
--
ALTER TABLE `final_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_child_category`
--
ALTER TABLE `sub_child_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_pdf`
--
ALTER TABLE `video_pdf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `final_result`
--
ALTER TABLE `final_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_child_category`
--
ALTER TABLE `sub_child_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_pdf`
--
ALTER TABLE `video_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
