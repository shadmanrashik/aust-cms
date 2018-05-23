-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2017 at 04:25 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aust_canteen_management`
--
CREATE DATABASE IF NOT EXISTS `aust_canteen_management` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aust_canteen_management`;

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE IF NOT EXISTS `customer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `order_date_time` datetime NOT NULL,
  `order_id` varchar(32) NOT NULL,
  `cash` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`id`, `name`, `order_date_time`, `order_id`, `cash`) VALUES
(1, 'Mamun Shams', '2017-02-06 01:23:46', 'ACMS-4303922', 5),
(2, 'Mamun Shams', '2017-02-06 02:02:15', 'ACMS-2202503', 200),
(3, 'Mamun Shams', '2017-02-06 02:50:24', 'ACMS-2020205', 50),
(4, 'Abir', '2017-02-06 14:39:50', 'ACMS-2732202', 500),
(5, 'Asib Hasan', '2017-02-06 19:04:56', 'ACMS-236073', 300),
(6, 'Asib Hasan', '2017-02-07 01:09:16', 'ACMS-27336203', 100),
(7, 'Asib Hasan', '2017-02-07 01:57:15', 'ACMS-002333', 100),
(8, 'Abir', '2017-02-07 09:07:19', 'ACMS-3092633', 200),
(9, 'Abir', '2017-02-08 01:37:12', 'ACMS-38232223', 200),
(10, 'Antor Habib', '2017-02-13 00:04:25', 'ACMS-20020022', 150),
(11, 'Azad', '2017-02-13 20:47:24', 'ACMS-6362733', 100),
(12, 'Abul Molla', '2017-02-13 20:55:27', 'ACMS-260232', 350);

-- --------------------------------------------------------

--
-- Table structure for table `employee_category`
--

CREATE TABLE IF NOT EXISTS `employee_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `salary` double NOT NULL,
  `overtime_salary` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee_category`
--

INSERT INTO `employee_category` (`id`, `name`, `salary`, `overtime_salary`) VALUES
(1, 'Counter', 300, 80),
(2, 'Chef', 400, 100),
(3, 'Cleaner', 100, 30),
(4, 'Assistant Chef', 200, 65),
(5, 'Distributer', 150, 50);

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE IF NOT EXISTS `employee_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_no` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `name`, `address`, `phone_no`, `email`, `category`) VALUES
(2, 'M. Z. Azad', 'Nikunja 10', '01798565489', 'mza@gtm.com', 2),
(4, 'Hasibul Shah', 'lalaland', '01798655154', 'fgh@hgjkh.com', 4),
(5, 'Fahim Foysal', 'Noakhali', '07964542568', 'fsh@gmail.com', 3),
(6, 'Manik Saha', 'Borishal Vila', '0178954512', 'msh@grt.co', 5),
(7, 'Abdul Kuddus', 'Lalmatia Gao', '01745285223', 'ak@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_work_detail`
--

CREATE TABLE IF NOT EXISTS `employee_work_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `month` varchar(16) NOT NULL,
  `work_day` int(11) NOT NULL,
  `over_time_hour` int(11) NOT NULL,
  `salary_due` double NOT NULL,
  `paid_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employee_id`,`month`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee_work_detail`
--

INSERT INTO `employee_work_detail` (`id`, `employee_id`, `month`, `work_day`, `over_time_hour`, `salary_due`, `paid_status`) VALUES
(2, 2, 'Januray', 20, 10, 8000, 1),
(3, 2, 'December', 22, 7, 9000, 1),
(4, 2, 'October', 25, 0, 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(32) NOT NULL,
  `food_category` varchar(32) DEFAULT NULL,
  `food_amount` int(11) NOT NULL DEFAULT '0',
  `food_price` double NOT NULL,
  PRIMARY KEY (`food_id`),
  KEY `food_category` (`food_category`),
  KEY `food_id` (`food_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1014 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`food_id`, `food_name`, `food_category`, `food_amount`, `food_price`) VALUES
(1001, 'Burger', '', 20, 30),
(1003, 'Nodules', '', 30, 25),
(1004, 'Cake', '', 50, 10),
(1006, 'Pepsi', NULL, 150, 15),
(1007, 'Coffee', NULL, 50, 15),
(1008, 'Fried Rice', NULL, 50, 85),
(1009, 'Porota', NULL, 150, 6),
(1010, 'Butterbun', NULL, 100, 15),
(1011, 'Bakorkhani', NULL, 48, 25),
(1012, 'Sandwich', NULL, 15, 25),
(1013, 'Chicken Fry', NULL, 40, 50);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `user_name`, `user_password`) VALUES
(1, '1', 'Admin', '123'),
(3, '14.01.04.043', 'selfimou', '12345'),
(4, '14.01.04.030', 'anikbhai', '12345'),
(5, '1001', 'tarif', '12345'),
(6, '1010', 'akmolla', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `online_order`
--

CREATE TABLE IF NOT EXISTS `online_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(32) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_remain` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` double NOT NULL,
  `status` int(11) NOT NULL,
  `time` text NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `online_order`
--

INSERT INTO `online_order` (`id`, `invoice_no`, `product_id`, `product_name`, `product_amount`, `product_remain`, `unit_price`, `total_price`, `status`, `time`, `date`, `user_id`) VALUES
(1, 'ACMS-93322229', 1011, 'Bakorkhani', 5, 43, 20, 100, 2, '14:00', '2017-02-13', '1001'),
(7, 'ACMS-26023', 1007, 'Coffee', 5, 45, 15, 75, 1, '15:30', '2017-02-13', '1010'),
(8, 'ACMS-26023', 1006, 'Pepsi', 2, 98, 15, 30, 1, '15:50', '2017-02-13', '1010'),
(9, 'ACMS-26023', 1001, 'Burger', 1, 19, 30, 30, 1, '10:30', '2017-02-13', '1010');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE IF NOT EXISTS `purchase_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(64) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_cost` double NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `order_no`, `item_id`, `amount`, `total_cost`, `vendor_id`, `date`, `status`) VALUES
(7, 'ORDN-6355533', 2, 5, 250, 1, '2017-02-13', 0),
(11, 'ORDN-3936', 16, 25, 625, 5, '2017-02-09', 0),
(13, 'ORDN-30273', 5, 10, 3000, 1, '2017-02-15', 9),
(14, 'ORDN-30273', 6, 50, 7500, 6, '2017-02-14', 9),
(15, 'ORDN-30273', 4, 5, 300, 1, '2017-02-16', 9);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE IF NOT EXISTS `raw_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`id`, `name`, `amount`, `price`) VALUES
(1, 'Bread', 102, 10),
(2, 'Rice', 15, 50),
(4, 'Onion', 5, 60),
(5, 'Butter', 25, 300),
(6, 'Chicken', 100, 150),
(7, 'Salt', 20, 25),
(8, 'Flour', 20, 28),
(9, 'Oil', 30, 60),
(10, 'Chilli', 2, 100),
(13, 'Garlic', 5, 90),
(14, 'Ginger', 5, 200),
(15, 'Dail', 10, 130),
(16, 'Cauliflower', 20, 25),
(17, 'Tomato', 25, 25);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(32) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_remain` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `invoice_no`, `product_id`, `product_name`, `product_amount`, `product_remain`, `unit_price`, `total_price`) VALUES
(56, 'ACMS-43332239', 1004, 'Cake', 5, 45, 10, 50),
(57, 'ACMS-4303922', 1001, 'Burger', 2, 18, 30, 60),
(58, 'ACMS-4303922', 1004, 'Cake', 2, 48, 10, 20),
(59, 'ACMS-4303922', 1007, 'Coffee', 6, 44, 15, 90),
(60, 'ACMS-2202503', 1004, 'Cake', 5, 45, 10, 50),
(61, 'ACMS-2020205', 1001, 'Burger', 6, 14, 30, 180),
(62, 'ACMS-2732202', 1008, 'Fried Rice', 5, 45, 85, 425),
(63, 'ACMS-2732202', 1003, 'Nodules', 2, 28, 25, 50),
(67, 'ACMS-236073', 1001, 'Burger', 5, 20, 30, 150),
(68, 'ACMS-236073', 1010, 'Butterbun', 10, 90, 15, 150),
(69, 'ACMS-27336203', 1012, 'Sandwich', 2, 13, 25, 50),
(70, 'ACMS-27336203', 1006, 'Pepsi', 1, 99, 15, 15),
(71, 'ACMS-002333', 1011, 'Bakorkhani', 2, 48, 20, 40),
(72, 'ACMS-3092633', 1001, 'Burger', 5, 20, 30, 150),
(73, 'ACMS-38232223', 1001, 'Burger', 5, 15, 30, 150),
(77, 'ACMS-260232', 1001, 'Burger', 10, 10, 30, 300);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone_no` varchar(32) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `address`, `phone_no`, `type`) VALUES
('1', 'Shadman Rashik', 'Naogaon', '01710905655', 0),
('1001', 'Tahmid Arif', 'Gulshan 1', '0179524156', 2),
('1010', 'Abdul Karim Molla', 'AUST', '0148748545', 2),
('14.01.04.030', 'Asib Hasan', 'Mohanogor', '019185492455', 1),
('14.01.04.043', 'Mou', 'Niketon', '01719782364', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone_no` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `address`, `email`, `phone_no`) VALUES
(1, 'Kashem Variety Store', '32 Kawran Bazar, Dhaka', 'kvs2441139@gmail.com', '01712090923'),
(3, 'Hasan Dairy Shop', 'New East Road', 'hasandairy23@gmail.com', '025643456'),
(4, 'Vai Vai Ltd', 'Kawran Bazar', 'vaivai@gmail.com', '01737564987'),
(5, 'Mayer Doa Ltd', 'Mohakhali Kacha bazar', 'mayerdoa@gmail.com', '01676384658'),
(6, 'Azad Poultry Firm', 'Rampura Bazar', 'azad123@gmail.com', '01789462232');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD CONSTRAINT `employee_info_ibfk_1` FOREIGN KEY (`category`) REFERENCES `employee_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_work_detail`
--
ALTER TABLE `employee_work_detail`
  ADD CONSTRAINT `employee_work_detail_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD CONSTRAINT `purchase_item_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `raw_material` (`id`),
  ADD CONSTRAINT `purchase_item_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
