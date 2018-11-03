-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 10:37 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `policy_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sha_key` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `sha_key`, `createdDate`, `modifiedDate`, `status`) VALUES
(1, 'Administrator', 'jay@gmail.com', 'MTIzNDU2', '', '2015-01-27 07:57:45', '2018-10-13 10:36:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_date`, `status`) VALUES
(1, 'Category 1', '57adfa0-393418a-koala.jpg', '2015-05-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `call_time` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `telephone_number`, `email_id`, `call_time`, `created_date`) VALUES
(1, 'Jay', '7878787878', 'jayparmar271@gmail.com', 'Today 15:00 - 18:00', '2018-10-13 12:33:48'),
(3, 'Kishan', '9845787878', 'k@gmail.com', 'Today 12:00 - 15:00', '2018-10-13 04:12:20'),
(4, 'Jay', '7405873827', 'jayparmar271@gmail.com', 'Today 12:00 - 15:00', '2018-10-14 12:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_favourite`
--

CREATE TABLE `product_favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `pro1_name` varchar(255) NOT NULL,
  `pro1_price` varchar(255) NOT NULL,
  `pro1_image` varchar(255) NOT NULL,
  `pro2_name` varchar(255) NOT NULL,
  `pro2_price` varchar(255) NOT NULL,
  `pro2_image` varchar(255) NOT NULL,
  `pro3_name` varchar(255) NOT NULL,
  `pro3_price` varchar(255) NOT NULL,
  `pro3_image` varchar(255) NOT NULL,
  `pro4_name` varchar(255) NOT NULL,
  `pro4_price` varchar(255) NOT NULL,
  `pro4_image` varchar(255) NOT NULL,
  `pro5_name` varchar(255) NOT NULL,
  `pro5_price` varchar(255) NOT NULL,
  `pro5_image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `fax` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `about_us` varchar(255) NOT NULL,
  `days_hours` varchar(200) NOT NULL,
  `location` varchar(255) NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `photo4` varchar(255) NOT NULL,
  `photo5` varchar(255) NOT NULL,
  `pro1_name` varchar(255) NOT NULL,
  `pro1_price` varchar(255) NOT NULL,
  `pro1_image` varchar(255) NOT NULL,
  `pro2_name` varchar(255) NOT NULL,
  `pro2_price` varchar(255) NOT NULL,
  `pro2_image` varchar(255) NOT NULL,
  `pro3_name` varchar(255) NOT NULL,
  `pro3_price` varchar(255) NOT NULL,
  `pro3_image` varchar(255) NOT NULL,
  `pro4_name` varchar(255) NOT NULL,
  `pro4_price` varchar(255) NOT NULL,
  `pro4_image` varchar(255) NOT NULL,
  `pro5_name` varchar(255) NOT NULL,
  `pro5_price` varchar(255) NOT NULL,
  `pro5_image` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `shop_name`, `category_id`, `subcategory_id`, `category_name`, `phone`, `fax`, `email`, `site`, `about_us`, `days_hours`, `location`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`, `pro1_name`, `pro1_price`, `pro1_image`, `pro2_name`, `pro2_price`, `pro2_image`, `pro3_name`, `pro3_price`, `pro3_image`, `pro4_name`, `pro4_price`, `pro4_image`, `pro5_name`, `pro5_price`, `pro5_image`, `latitude`, `longitude`, `created_date`, `status`) VALUES
(1, 'Shop 1', 1, 1, 'Category 1', 2147483647, 2147483647, 'parthkhatri.it@gmail.com', 'www.gooel.com', 'About us', '23', 'Ahmedabad', '6aaf618-hydrangeas.jpg', '', '', '', '', 'name 1', '88', '029c962-tulips.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-24', 1),
(2, 'parth', 1, 1, 'category1', 2147483647, 2147483647, 'parth@gmail.com', 'www.google.com', 'About', '12', 'dholka', '', '', '', '', '', 'pa', '12', '', 'p2', '23', '', 'p3', '33', '', 'p4', '55', '', 'pp', '99', '', '23.23232323', '24.22323232323', '2015-05-24', 1),
(3, 'parth', 1, 1, 'category1', 2147483647, 2147483647, 'parth@gmail.com', 'www.google.com', 'About', '12', 'dholka', '', '', '', '', '', 'pa', '12', '', 'p2', '23', '', 'p3', '33', '', 'p4', '55', '', 'pp', '99', '', '23.23232323', '24.22323232323', '2015-05-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_rate`
--

CREATE TABLE `store_rate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `rate` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `category_name`, `name`, `image`, `created_date`, `status`) VALUES
(1, 1, 'Category 1', 'Sub 2', '5b774ad-chrysanthemum.jpg', '2015-05-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE `tbl_enquiry` (
  `id` int(11) UNSIGNED NOT NULL,
  `contact_id` int(11) UNSIGNED NOT NULL,
  `enquiry_type` varchar(50) DEFAULT NULL,
  `contract_rate` decimal(10,2) DEFAULT NULL,
  `contract_type` varchar(25) DEFAULT NULL,
  `contract_length` varchar(25) DEFAULT NULL,
  `gapsinOneYear` enum('y','n') DEFAULT NULL,
  `time_left` varchar(25) DEFAULT NULL,
  `industryworked` varchar(100) DEFAULT NULL,
  `contracting_through` varchar(50) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `loan_amount` decimal(10,2) DEFAULT NULL,
  `current_lender` varchar(25) DEFAULT NULL,
  `outstanding_balance` decimal(10,2) DEFAULT NULL,
  `rent_acheivable` decimal(10,2) DEFAULT NULL,
  `term_of_mortage` varchar(25) DEFAULT NULL,
  `credit_rating` varchar(25) DEFAULT NULL,
  `poor_reason` varchar(150) DEFAULT NULL,
  `visited_broker` enum('y','n') DEFAULT NULL,
  `visited_broker_reason` varchar(250) DEFAULT NULL,
  `hopingFromUs` varchar(250) DEFAULT NULL,
  `mortage_type` varchar(25) DEFAULT NULL,
  `length_initial_rate_fixed` varchar(25) DEFAULT NULL,
  `important_feature` varchar(250) DEFAULT NULL,
  `covertype` varchar(25) DEFAULT NULL,
  `critical_illness` enum('y','n') DEFAULT NULL,
  `premium` varchar(25) DEFAULT NULL,
  `coveramount` decimal(10,2) DEFAULT NULL,
  `noofyears` varchar(25) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enquiry`
--

INSERT INTO `tbl_enquiry` (`id`, `contact_id`, `enquiry_type`, `contract_rate`, `contract_type`, `contract_length`, `gapsinOneYear`, `time_left`, `industryworked`, `contracting_through`, `purchase_price`, `loan_amount`, `current_lender`, `outstanding_balance`, `rent_acheivable`, `term_of_mortage`, `credit_rating`, `poor_reason`, `visited_broker`, `visited_broker_reason`, `hopingFromUs`, `mortage_type`, `length_initial_rate_fixed`, `important_feature`, `covertype`, `critical_illness`, `premium`, `coveramount`, `noofyears`, `budget`, `comment`) VALUES
(1, 18, 'Home-mover', '50.00', 'Per Hour', '2 Months', '', '3 Months', 'Testing industry', 'Limited Company', '500.00', '1200.00', '', '0.00', '0.00', '3', 'Good', '', '', 'testting nedd proceed', 'hoping so much', 'Tracker', '2', NULL, '', '', '', '0.00', '', '0.00', 'testinggg'),
(2, 19, 'Help to Buy', '500.00', 'Per Day', '2 Months', 'y', '2 Months', '', '', '5000.00', '10000.00', '', '0.00', '0.00', '3', 'Good', '', 'y', 'testtt', 'wedsfds', 'Fixed', '3', NULL, '', '', '', '0.00', '', '0.00', 'sfdsdfds'),
(3, 20, 'Next Time Buyer', '50.00', 'Per Day', '1 Month', 'y', '2 Months', '', 'Umbrella', '50.00', '100.00', '', '0.00', '0.00', '1', 'Excellent', '', '', '', 'test', 'Fixed', '5', 'No ERC overhang after the initial period,No Early Repayment Charge,Take repayment holidays', '', '', '', '0.00', '', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE `user_management` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `age` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_management`
--

INSERT INTO `user_management` (`id`, `name`, `phone`, `email`, `age`, `city`, `gender`, `password`, `is_admin`, `created_date`, `modified_date`, `status`) VALUES
(1, 'parth', 1221212121, 'parth@gmail.com', '23', 'ahmedabad', 'male', '4297f44b13955235245b2497399d7a93', 1, '2015-05-11 20:57:40', '0000-00-00 00:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_favourite`
--
ALTER TABLE `product_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_rate`
--
ALTER TABLE `store_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_favourite`
--
ALTER TABLE `product_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_rate`
--
ALTER TABLE `store_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_management`
--
ALTER TABLE `user_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
