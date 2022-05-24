-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 06:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminUsername` varchar(250) NOT NULL,
  `adminPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminUsername`, `adminPassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `p_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `user_id`, `qty`) VALUES
(479, 11, 50, 1),
(480, 10, 50, 1),
(533, 15, 54, 1),
(534, 13, 54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_ID` int(11) NOT NULL,
  `categories` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_ID`, `categories`) VALUES
(1, 'Blouse'),
(2, 'Crop Top'),
(3, 'Sweater/Jacket'),
(4, 'Tube top'),
(5, 'Pants/Trousers'),
(6, 'Shorts'),
(7, 'Skirts'),
(8, 'Shirt'),
(9, 'Dress'),
(12, 'Swim Suits');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerImage` varchar(250) NOT NULL,
  `customerName` varchar(250) NOT NULL,
  `customerContact` varchar(250) NOT NULL,
  `customerAddress` varchar(250) NOT NULL,
  `customerEmail` varchar(250) NOT NULL,
  `customerUsername` varchar(250) NOT NULL,
  `customerPassword` varchar(250) NOT NULL,
  `customerStatus` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerImage`, `customerName`, `customerContact`, `customerAddress`, `customerEmail`, `customerUsername`, `customerPassword`, `customerStatus`) VALUES
(52, 'default.png', 'John Doe Pingris', '09398320588', 'Brgy. Tibay ng Tondo Manila', 'johndoe@gmail.com', 'johndoe123', 'd763ec748433fb79a04f82bd46133d55', 0),
(55, 'default.png', 'Nadine Lustre', '09398320585', 'Brgy. Broken ng Tondo Manila', 'nadine@gmail.com', 'Nadin123', 'b06a6f494253f7919b0421af10c2cd82', 0),
(56, 'default.png', 'Aiza Seguera', '09398320583', 'Brgy. Sad ng Tondo Manila', 'Aiza@gmail.com', 'Aiza123', 'b38ac18016d255ee4e9a364fb6490ebf', 0),
(57, 'default.png', 'Andrea Torres', '09398320582', 'Brgy. GIrl ng Tondo Manila', 'andrea@gmail.com', 'Andrea123', '8d28898f353eda472701f2b68d2a8cdb', 0);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodID` int(11) NOT NULL,
  `foodImage` varchar(250) NOT NULL,
  `foodName` varchar(250) NOT NULL,
  `foodCategory` int(20) NOT NULL,
  `foodStock` varchar(250) NOT NULL,
  `foodDescription` varchar(250) NOT NULL,
  `foodPrice` float NOT NULL,
  `foodStatus` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `foodImage`, `foodName`, `foodCategory`, `foodStock`, `foodDescription`, `foodPrice`, `foodStatus`) VALUES
(9, 'aa.jpg', 'Outfit (27)', 3, '0', '1 BuFashion for Lorem ipsum dolor si', 500, 0),
(10, 'i.jpg', 'Outfit (21)', 1, '0', '2 LitFashion for Lorem ipsum dolor si', 600, 0),
(11, 'c.jpg', 'Outfit (22)', 10, '0', 'PansFashion for Lorem ipsum dolor si', 850, 0),
(12, 'd.jpg', 'Outfit (20)', 9, '-7', 'GrahFashion for Lorem ipsum dolor si', 500, 0),
(13, 'e.jpg', 'Outfit (19)', 8, '0', 'SiniFashion for Lorem ipsum dolor si', 700, 0),
(14, 'f.jpg', 'Outfit (18)', 7, '0', 'PinakbeFashion for Lorem ipsum dolor si', 400, 0),
(15, 'g.jpg', 'Outfit (17)', 7, '0', 'TakoFashion for Lorem ipsum dolor si', 500, 0),
(16, 'h.jpg', 'Outfit (16)', 6, '4', 'SizzlFashion for Lorem ipsum dolor si', 300, 0),
(17, 'b.jpg', 'Outfit (15)', 5, '0', 'ChFashion for Lorem ipsum dolor si', 600, 0),
(18, 'j.jpg', 'Outfit (14)', 4, '-1', 'HoliFashion for Lorem ipsum dolor si', 500, 0),
(19, 'k.jpg', 'Outfit (13)', 3, '0', 'goFashion for Lorem ipsum dolor si', 600, 0),
(20, 'l.jpg', 'Outfit (12)', 2, '7', 'An iFashion for Lorem ipsum dolor si', 1000, 0),
(21, 'm.jpg', 'Outfit (11)', 1, '5', '1.Fashion for Lorem ipsum dolor si', 500, 0),
(22, 'n.jpg', 'Outfit (11)', 10, '4', 'FiliFashion for Lorem ipsum dolor si', 850, 0),
(23, 'o.jpg', 'Outfit (10)', 9, '4', 'StraFashion for Lorem ipsum dolor si', 500, 0),
(24, 'p.jpg', 'Outfit (09)', 8, '2', 'AdFashion for Lorem ipsum dolor si', 160, 0),
(25, 'q.jpg', 'Outfit (08)', 7, '5', 'GiniFashion for Lorem ipsum dolor si', 600, 0),
(26, 'r.jpg', 'Outfit (07)', 6, '7', 'NilFashion for LakoFashion for orem ipsum dolor si', 800, 0),
(27, 's.jpg', 'Outfit (06)', 5, '8', 'A salaFashion for Lorem ipsum dolor si', 600, 0),
(28, 't.jpg', 'Outfit (05)', 2, '3', 'KapeFashion for Lorem ipsum dolor si', 450, 0),
(29, 'u.jpg', 'Outfit (04)', 6, '4', 'Fashion for Lorem ipsum dolor si', 700, 0),
(30, 'v.jpg', 'Outfit (03)', 6, '3', 'Fashion for Lorem ipsum dolor si', 800, 0),
(33, 'w.jpg', 'Outfit (02)', 6, '1', 'Fashion for Lorem ipsum dolor si', 1000, 0),
(34, 'x.jpg', 'Outfit (01)', 4, '1', 'Lorem ipsum dolor Fashion for Fashion for ', 500, 0),
(35, 'y.jpg', 'Outfit (23) ', 1, '1', 'Lorem ipsum dolor si si la feisi a feisi  a feisi ', 300, 0),
(40, 'fttcs.jpg', 'Outfit (28) ', 3, '-8', 'try ged asda sd das da sd', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(11) NOT NULL,
  `complaintID` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `complaintID`, `user_Id`, `message`, `date_time`, `is_deleted`) VALUES
(61, 93, 44, 'Kasi ang sapatos ng pagmamahal ay hinambalos sa pagibig ko sa yo ', '2021-12-17 18:54:40', 1),
(62, 5, 25, 'Hi din', '2021-12-19 06:06:47', 1),
(63, 5, 25, 'Hi din', '2021-12-19 06:06:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_manager`
--

CREATE TABLE `order_manager` (
  `order_id` int(11) NOT NULL,
  `user_id` int(250) NOT NULL,
  `total_amount` float NOT NULL,
  `payment_option` varchar(250) NOT NULL,
  `date_time_bought` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_manager`
--

INSERT INTO `order_manager` (`order_id`, `user_id`, `total_amount`, `payment_option`, `date_time_bought`, `order_status`) VALUES
(118, 52, 850, 'Cash On Delivery', '2022-05-24 08:47:12', 'complete'),
(119, 55, 700, 'Cash On Delivery', '2022-05-24 15:33:18', 'complete'),
(120, 56, 850, 'Cash On Delivery', '2022-05-24 15:33:21', 'complete'),
(121, 57, 1550, 'Cash On Delivery', '2022-05-24 15:33:27', 'complete'),
(122, 55, 1550, 'Cash On Delivery', '2022-05-24 15:33:29', 'complete'),
(123, 52, 1550, 'Cash On Delivery', '2022-05-24 14:48:48', 'complete'),
(124, 57, 1200, 'Cash On Delivery', '2022-05-24 15:33:35', 'complete'),
(125, 56, 1550, 'Cash On Delivery', '2022-05-24 15:33:37', 'complete'),
(126, 56, 850, 'Cash On Delivery', '2022-05-24 15:33:45', 'complete'),
(127, 52, 1550, 'Cash On Delivery', '2022-05-24 14:49:02', 'complete'),
(128, 56, 1550, 'Cash On Delivery', '2022-05-24 15:33:41', 'complete'),
(129, 55, 1550, 'Cash On Delivery', '2022-05-24 15:33:47', 'complete'),
(130, 55, 1550, 'Cash On Delivery', '2022-05-24 15:33:50', 'complete'),
(131, 56, 1550, 'Cash On Delivery', '2022-05-24 15:33:52', 'complete'),
(132, 52, 1550, 'Cash On Delivery', '2022-05-24 14:49:14', 'complete'),
(133, 56, 1550, 'Cash On Delivery', '2022-05-24 15:33:54', 'complete'),
(134, 57, 1550, 'Cash On Delivery', '2022-05-24 15:33:58', 'complete'),
(135, 56, 1550, 'Cash On Delivery', '2022-05-24 15:34:00', 'complete'),
(136, 55, 1550, 'Cash On Delivery', '2022-05-24 15:34:02', 'complete'),
(137, 52, 1550, 'Cash On Delivery', '2022-05-24 14:49:23', 'complete'),
(138, 57, 1550, 'Cash On Delivery', '2022-05-24 15:34:06', 'complete'),
(139, 56, 1550, 'Cash On Delivery', '2022-05-24 15:34:08', 'complete'),
(140, 55, 1550, 'Cash On Delivery', '2022-05-24 15:34:12', 'complete'),
(141, 52, 1550, 'Cash On Delivery', '2022-05-24 15:13:47', 'complete'),
(142, 57, 1550, 'Cash On Delivery', '2022-05-24 15:34:14', 'complete'),
(150, 52, 1200, 'Cash On Delivery', '2022-05-24 15:19:54', 'complete'),
(154, 52, 900, 'Cash On Delivery', '2022-05-24 16:07:38', 'complete'),
(155, 55, 900, 'Cash On Delivery', '2022-05-24 16:11:33', 'complete'),
(156, 56, 900, 'Cash On Delivery', '2022-05-24 16:11:35', 'complete'),
(157, 57, 900, 'Cash On Delivery', '2022-05-24 16:11:37', 'complete'),
(158, 55, 900, 'Cash On Delivery', '2022-05-24 16:11:39', 'complete'),
(159, 57, 1100, 'Cash On Delivery', '2022-05-24 16:11:42', 'complete'),
(160, 56, 800, 'Cash On Delivery', '2022-05-24 16:11:46', 'complete'),
(161, 57, 800, 'Cash On Delivery', '2022-05-24 16:11:48', 'complete'),
(162, 55, 800, 'Cash On Delivery', '2022-05-24 16:11:49', 'complete'),
(163, 56, 1300, 'Cash On Delivery', '2022-05-24 16:11:51', 'complete'),
(164, 57, 1300, 'Cash On Delivery', '2022-05-24 16:20:27', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `product` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `date_time_bought` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `product`, `quantity`, `total`, `date_time_bought`) VALUES
(52, 'Array', 3, 360, '2021-12-13 08:26:35'),
(53, 'Array', 1, 20, '2021-12-13 08:29:26'),
(54, 'Coke Sakto is one of my favorite soda', 11, 220, '2021-12-13 08:30:40'),
(55, 'Chicken Adobo with rice and ice tea', 1, 120, '2021-12-13 11:52:35'),
(56, 'Pansit Palabok good for 10 person with 1.5 coke ', 1, 850, '2021-12-14 21:17:38'),
(57, 'Sizzling Sisig with rice and ice tea ', 1, 200, '2021-12-14 21:41:13'),
(58, 'Lechon Paksiw with 1 rice and ice tea ', 1, 180, '2021-12-14 21:51:42'),
(62, '1 Bucket of San Mig Apple with 1 order sizzling sisig2 Liters of Royal with cup good for your hang out', 1, 500170, '2021-12-15 05:24:53'),
(63, '1 Bucket of San Mig Apple with 1 order sizzling sisig2 Liters of Royal with cup good for your hang out', 1, 4000170, '2021-12-15 05:40:04'),
(66, '1 Bucket of San Mig Apple with 1 order sizzling sisig2 Liters of Royal with cup good for your hang out', 1, 500170, '2021-12-15 07:11:40'),
(67, '1 Bucket of San Mig Apple with 1 order sizzling sisig', 1, 500, '2021-12-15 08:03:13'),
(68, 'Pansit Palabok good for 10 person with 1.5 coke ', 1, 850, '2021-12-16 15:23:47'),
(69, '2 Liters of Royal with cup good for your hang out', 1, 170, '2021-12-17 14:20:42'),
(70, 'Menudo with 1 rice and ice tea for your cravings ', 3, 480, '2021-12-17 17:04:01'),
(71, 'Sizzling Sisig with rice and ice tea ', 3, 600, '2021-12-17 17:20:55'),
(72, 'Menudo with 1 rice and ice tea for your cravings ', 1, 170, '2021-12-17 17:30:34'),
(73, 'Menudo with 1 rice and ice tea for your cravings ', 2, 340, '2021-12-17 17:46:48'),
(74, 'Kare-Kare with 1 rice and ice tea for your cravings', 3, 570, '2021-12-17 17:54:26'),
(75, 'Sizzling Sisig with rice and ice tea ', 4, 800, '2021-12-17 18:02:34'),
(76, 'Kare-Kare with 1 rice and ice tea for your cravings', 3, 570, '2021-12-17 18:21:51'),
(77, 'Menudo with 1 rice and ice tea for your cravings ', 4, 680, '2021-12-17 18:35:30'),
(78, 'Sizzling Sisig with rice and ice tea ', 4, 800, '2021-12-17 18:50:23'),
(94, '10', 1, 600, '2022-05-21 10:22:06'),
(0, '11', 1, 850, '2022-05-21 10:22:06'),
(0, '12', 1, 500, '2022-05-21 10:22:06'),
(0, '10', 1, 600, '2022-05-21 10:25:13'),
(0, '9', 1, 500, '2022-05-21 10:25:13'),
(0, '9', 1, 500, '2022-05-21 10:27:21'),
(0, '11', 1, 850, '2022-05-21 10:27:21'),
(97, '9', 1, 500, '2022-05-21 10:40:04'),
(0, '10', 1, 600, '2022-05-21 10:40:04'),
(98, '9', 1, 500, '2022-05-21 10:41:08'),
(0, '10', 1, 600, '2022-05-21 10:41:08'),
(99, '9', 1, 500, '2022-05-21 10:45:51'),
(100, '9', 1, 500, '2022-05-21 10:46:38'),
(101, '9', 1, 500, '2022-05-21 10:49:17'),
(0, '10', 1, 600, '2022-05-21 10:49:17'),
(102, '9', 3, 1500, '2022-05-21 11:08:48'),
(0, '12', 3, 1500, '2022-05-21 11:08:48'),
(103, '11', 1, 850, '2022-05-21 11:10:17'),
(0, '11', 1, 850, '2022-05-21 11:11:47'),
(0, '9', 1, 500, '2022-05-21 11:11:47'),
(0, '11', 1, 850, '2022-05-21 11:43:18'),
(0, '9', 1, 500, '2022-05-21 11:43:18'),
(0, '11', 1, 850, '2022-05-21 11:43:52'),
(0, '13', 1, 700, '2022-05-21 11:44:42'),
(0, '12', 1, 500, '2022-05-21 11:44:42'),
(109, '12', 1, 500, '2022-05-21 11:45:34'),
(0, '11', 1, 850, '2022-05-21 11:45:34'),
(110, '11', 1, 850, '2022-05-21 13:52:37'),
(111, '9', 1, 500, '2022-05-21 15:28:02'),
(0, '11', 1, 850, '2022-05-21 15:28:03'),
(112, '9', 1, 500, '2022-05-21 15:48:46'),
(113, '9', 1, 500, '2022-05-21 15:58:44'),
(114, '9', 1, 500, '2022-05-21 16:45:35'),
(0, '10', 1, 600, '2022-05-21 16:45:35'),
(115, '40', 11, 3300, '2022-05-21 16:57:15'),
(116, '12', 10, 5000, '2022-05-21 16:58:42'),
(117, '14', 6, 2400, '2022-05-21 17:07:11'),
(118, '11', 1, 850, '2022-05-24 08:45:58'),
(119, '13', 1, 700, '2022-05-24 08:46:08'),
(120, '11', 1, 850, '2022-05-24 08:52:33'),
(0, '11', 1, 850, '2022-05-24 14:00:22'),
(0, '13', 1, 700, '2022-05-24 14:00:22'),
(0, '11', 1, 850, '2022-05-24 14:00:30'),
(0, '13', 1, 700, '2022-05-24 14:00:30'),
(0, '11', 1, 850, '2022-05-24 14:01:23'),
(0, '13', 1, 700, '2022-05-24 14:01:23'),
(0, '15', 1, 500, '2022-05-24 14:02:52'),
(0, '13', 1, 700, '2022-05-24 14:02:53'),
(125, '11', 1, 850, '2022-05-24 14:07:25'),
(0, '13', 1, 700, '2022-05-24 14:07:26'),
(126, '11', 1, 850, '2022-05-24 14:23:45'),
(135, '11', 1, 850, '2022-05-24 14:46:12'),
(0, '13', 1, 700, '2022-05-24 14:46:12'),
(0, '11', 1, 850, '2022-05-24 14:47:23'),
(0, '13', 1, 700, '2022-05-24 14:47:23'),
(137, '11', 1, 850, '2022-05-24 14:48:11'),
(0, '13', 1, 700, '2022-05-24 14:48:11'),
(0, '11', 1, 850, '2022-05-24 14:49:56'),
(0, '13', 1, 700, '2022-05-24 14:49:56'),
(139, '11', 1, 850, '2022-05-24 14:50:29'),
(0, '13', 1, 700, '2022-05-24 14:50:29'),
(140, '11', 1, 850, '2022-05-24 14:51:12'),
(0, '13', 1, 700, '2022-05-24 14:51:12'),
(0, '13', 1, 700, '2022-05-24 15:13:07'),
(0, '11', 1, 850, '2022-05-24 15:13:07'),
(147, '13', 1, 700, '2022-05-24 15:13:36'),
(0, '11', 1, 850, '2022-05-24 15:13:36'),
(0, '11', 1, 850, '2022-05-24 15:14:20'),
(0, '13', 1, 700, '2022-05-24 15:14:20'),
(0, '13', 1, 700, '2022-05-24 15:15:12'),
(0, '15', 1, 500, '2022-05-24 15:15:12'),
(0, '13', 1, 700, '2022-05-24 15:19:00'),
(0, '15', 1, 500, '2022-05-24 15:19:00'),
(151, '13', 1, 700, '2022-05-24 15:20:02'),
(0, '15', 1, 500, '2022-05-24 15:20:02'),
(0, '13', 1, 700, '2022-05-24 15:21:24'),
(0, '15', 1, 500, '2022-05-24 15:21:24'),
(153, '13', 1, 700, '2022-05-24 15:24:54'),
(0, '16', 1, 300, '2022-05-24 15:24:54'),
(0, '17', 1, 600, '2022-05-24 15:47:23'),
(0, '16', 1, 300, '2022-05-24 15:47:23'),
(0, '16', 1, 300, '2022-05-24 15:48:41'),
(0, '17', 1, 600, '2022-05-24 15:48:41'),
(0, '16', 1, 300, '2022-05-24 15:52:33'),
(0, '17', 1, 600, '2022-05-24 15:52:33'),
(158, '17', 1, 600, '2022-05-24 15:53:27'),
(158, '16', 1, 300, '2022-05-24 15:53:27'),
(0, '19', 1, 600, '2022-05-24 16:06:28'),
(0, '18', 1, 500, '2022-05-24 16:06:28'),
(161, '16', 1, 300, '2022-05-24 16:10:35'),
(161, '18', 1, 500, '2022-05-24 16:10:35'),
(162, '16', 1, 300, '2022-05-24 16:10:43'),
(162, '18', 1, 500, '2022-05-24 16:10:43'),
(163, '16', 1, 300, '2022-05-24 16:11:04'),
(163, '20', 1, 1000, '2022-05-24 16:11:05'),
(164, '16', 1, 300, '2022-05-24 16:12:05'),
(164, '20', 1, 1000, '2022-05-24 16:12:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodID`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `order_manager`
--
ALTER TABLE `order_manager`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_manager`
--
ALTER TABLE `order_manager`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
