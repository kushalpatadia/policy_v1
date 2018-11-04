-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2018 at 12:24 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `policy_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sha_key` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `sha_key`, `createdDate`, `modifiedDate`, `status`) VALUES
(1, 'Administrator', 'jay@gmail.com', 'MTIzNDU2', '', '2015-01-27 07:57:45', '2018-10-13 10:36:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_date`, `status`) VALUES
(1, 'Category 1', '57adfa0-393418a-koala.jpg', '2015-05-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `call_time` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `telephone_number`, `email_id`, `call_time`, `created_date`) VALUES
(1, 'Jay', '7878787878', 'jayparmar271@gmail.com', 'Today 15:00 - 18:00', '2018-10-13 12:33:48'),
(2, 'sasas', '3234567890', 'k@k.com', 'Today 09:00 - 12:00', '2018-11-03 07:22:53'),
(3, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:25:34'),
(4, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:25:57'),
(5, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:26:09'),
(6, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:26:20'),
(7, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:26:52'),
(8, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:27:39'),
(9, 'Kushal', '1234567890', 'Kushalpatadia@gmail.com', 'Tomorrow 09:00 - 12:00', '2018-11-03 12:27:53'),
(10, 'K', '8888888888', '888@11.com', 'Tomorrow 15:00 - 18:00', '2018-11-03 12:28:35'),
(11, 'kushal', '1234567890', 'k.p@openxcell.com', 'Tomorrow 09:00 - 12:00', '2018-11-04 06:22:40'),
(12, 's', '1111111111', '1@1.cc', 'Tomorrow 12:00 - 15:00', '2018-11-04 06:30:38'),
(13, 's', '1111111111', '1@1.cc', 'Tomorrow 12:00 - 15:00', '2018-11-04 06:32:04'),
(14, 's', '1111111111', '1@1.cc', 'Tomorrow 12:00 - 15:00', '2018-11-04 06:43:56'),
(15, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Today 15:00 - 18:00', '2018-11-04 11:55:45'),
(16, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:03:33'),
(17, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:04:18'),
(18, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:05:20'),
(19, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:06:23'),
(20, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:12:25'),
(21, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:14:48'),
(22, 'Kushal', '7600779534', 'kushalpatadia@gmail.com', 'Anytime', '2018-11-04 12:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_favourite`
--

CREATE TABLE IF NOT EXISTS `product_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `store_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `rate` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `category_name`, `name`, `image`, `created_date`, `status`) VALUES
(1, 1, 'Category 1', 'Sub 2', '5b774ad-chrysanthemum.jpg', '2015-05-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE IF NOT EXISTS `tbl_enquiry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) unsigned NOT NULL,
  `enquiry_type` varchar(50) DEFAULT NULL,
  `contract_rate` decimal(10,2) DEFAULT NULL,
  `contract_type` varchar(25) DEFAULT NULL,
  `contract_length` varchar(25) DEFAULT NULL,
  `gapsinOneYear` enum('Yes','No') DEFAULT NULL,
  `gapsDetails` varchar(255) DEFAULT NULL,
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
  `visited_broker` enum('Yes','No') DEFAULT NULL,
  `visited_broker_reason` varchar(250) DEFAULT NULL,
  `hopingFromUs` varchar(250) DEFAULT NULL,
  `mortage_type` varchar(25) DEFAULT NULL,
  `length_initial_rate_fixed` varchar(25) DEFAULT NULL,
  `important_feature` varchar(250) DEFAULT NULL,
  `covertype` varchar(25) DEFAULT NULL,
  `critical_illness` enum('Yes','No') DEFAULT NULL,
  `premium` varchar(25) DEFAULT NULL,
  `coveramount` decimal(10,2) DEFAULT NULL,
  `noofyears` varchar(25) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_enquiry`
--

INSERT INTO `tbl_enquiry` (`id`, `contact_id`, `enquiry_type`, `contract_rate`, `contract_type`, `contract_length`, `gapsinOneYear`, `gapsDetails`, `time_left`, `industryworked`, `contracting_through`, `purchase_price`, `loan_amount`, `current_lender`, `outstanding_balance`, `rent_acheivable`, `term_of_mortage`, `credit_rating`, `poor_reason`, `visited_broker`, `visited_broker_reason`, `hopingFromUs`, `mortage_type`, `length_initial_rate_fixed`, `important_feature`, `covertype`, `critical_illness`, `premium`, `coveramount`, `noofyears`, `budget`, `comment`) VALUES
(1, 14, 'Home-mover', '50.00', 'Per Hour', '2 Months', '', NULL, '3 Months', 'Testing industry', 'Limited Company', '500.00', '1200.00', '', '0.00', '0.00', '3', 'Good', '', '', 'testting nedd proceed', 'hoping so much', 'Tracker', '2', NULL, '', '', '', '0.00', '', '0.00', 'testinggg'),
(2, 19, 'Help to Buy', '500.00', 'Per Day', '2 Months', '', NULL, '2 Months', '', '', '5000.00', '10000.00', '', '0.00', '0.00', '3', 'Good', '', '', 'testtt', 'wedsfds', 'Fixed', '3', NULL, '', '', '', '0.00', '', '0.00', 'sfdsdfds'),
(3, 20, 'Next Time Buyer', '50.00', 'Per Day', '1 Month', '', NULL, '2 Months', '', 'Umbrella', '50.00', '100.00', '', '0.00', '0.00', '1', 'Excellent', '', '', '', 'test', 'Fixed', '5', 'No ERC overhang after the initial period,No Early Repayment Charge,Take repayment holidays', '', '', '', '0.00', '', '0.00', ''),
(4, 12, 'First Time Buyer', '0.00', '', '', '', NULL, '', '', '', '0.00', '0.00', '', '0.00', '0.00', '', '', '', '', '', '', '', '', NULL, '', '', '', '0.00', '', '0.00', ''),
(5, 13, 'First Time Buyer', '0.00', '', '', '', NULL, '', '', '', '0.00', '0.00', '', '0.00', '0.00', '', '', '', '', '', '', '', '', NULL, '', '', '', '0.00', '', '0.00', ''),
(6, 14, 'First Time Buyer', '0.00', '', '', '', NULL, '', '', '', '0.00', '0.00', '', '0.00', '0.00', '', '', '', '', '', '', '', '', NULL, '', '', '', '0.00', '', '0.00', ''),
(7, 18, '1', '100.00', 'Per Day', '10 Months', '', NULL, '4 Months', 'asasasa', 'Umbrella', '100.00', '200.00', NULL, NULL, NULL, '2', 'Poor', 'sasas sacsacsac s\r\nc\r\nas cs cas\r\ns \r\nc\r\nsc\r\nsc \r\ncsa\r\n \r\nsa as', '', 'asd asd sad as', 'sasdasasadm  jjsj s  s s  s s ', 'Tracker', '10', '1,2,3,4,5,6,7,8', '', NULL, NULL, NULL, NULL, NULL, 'asd dsa das dsa \r\nsa \r\nsa '),
(8, 19, '1', '100.00', 'Per Day', '10 Months', '', NULL, '4 Months', 'asasasa', 'Umbrella', '100.00', '200.00', NULL, NULL, NULL, '2', 'Poor', 'sasas sacsacsac s\r\nc\r\nas cs cas\r\ns \r\nc\r\nsc\r\nsc \r\ncsa\r\n \r\nsa as', '', 'asd asd sad as', 'sasdasasadm  jjsj s  s s  s s ', 'Tracker', '10', '1,2,3,4,5,6,7,8', '', NULL, NULL, NULL, NULL, NULL, 'asd dsa das dsa \r\nsa \r\nsa '),
(9, 20, '1', '100.00', 'Per Day', '10 Months', 'Yes', NULL, '4 Months', 'asasasa', 'Umbrella', '100.00', '200.00', NULL, NULL, NULL, '2', 'Poor', 'sasas sacsacsac s\r\nc\r\nas cs cas\r\ns \r\nc\r\nsc\r\nsc \r\ncsa\r\n \r\nsa as', 'Yes', 'asd asd sad as', 'sasdasasadm  jjsj s  s s  s s ', 'Tracker', '10', '1,2,3,4,5,6,7,8', NULL, NULL, NULL, NULL, NULL, NULL, 'asd dsa das dsa \r\nsa \r\nsa '),
(10, 21, '1', '100.00', 'Per Day', '10 Months', 'Yes', NULL, '4 Months', 'asasasa', 'Umbrella', '100.00', '200.00', NULL, NULL, NULL, '2', 'Poor', 'sasas sacsacsac s\r\nc\r\nas cs cas\r\ns \r\nc\r\nsc\r\nsc \r\ncsa\r\n \r\nsa as', 'Yes', 'asd asd sad as', 'sasdasasadm  jjsj s  s s  s s ', 'Tracker', '10', '1,2,3,4,5,6,7,8', NULL, NULL, NULL, NULL, NULL, NULL, 'asd dsa das dsa \r\nsa \r\nsa '),
(11, 22, '1', '100.00', 'Per Day', '10 Months', 'Yes', NULL, '4 Months', 'asasasa', 'Umbrella', '100.00', '200.00', NULL, NULL, NULL, '2', 'Poor', 'sasas sacsacsac s\r\nc\r\nas cs cas\r\ns \r\nc\r\nsc\r\nsc \r\ncsa\r\n \r\nsa as', 'Yes', 'asd asd sad as', 'sasdasasadm  jjsj s  s s  s s ', 'Tracker', '10', '1,2,3,4,5,6,7,8', NULL, NULL, NULL, NULL, NULL, NULL, 'asd dsa das dsa \r\nsa \r\nsa ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_site_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) NOT NULL,
  `site_logo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_site_settings`
--

INSERT INTO `tbl_site_settings` (`id`, `site_name`, `site_logo`) VALUES
(1, 'tessttttsdas', '8e2cfdc-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `image`, `created_date`, `status`) VALUES
(4, 'Test slider', '0c7119e-8560777271522843952.jpg', '2018-10-21', 1),
(5, 'Lorem ipsummm', 'e2b26aa-5596436091522843952.jpg', '2018-10-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `subject`, `template`, `created_at`, `updated_at`) VALUES
(1, 'Admin Contact', '<table width="100%" cellspacing="0" cellpadding="0" border="0">\n    <tbody>\n        <tr style="background:#000000;">\n            <td valign="top" align="left" style="font-family:verdana;font-size:16px;line-height:1.3em;text-align:left;padding:15px">\n                <table  width="100%">\n                    <tr style="background:#FFF;border-radius:5px;">\n                        <td style="font-family:verdana;font-size:13px;line-height:1.3em;text-align:left;padding:15px;">\n                            <p><span style="font-family:arial,sans-serif; font-size:10pt">{LOGO}</span></p>\n                            <p><strong><span style="font-family:arial,sans-serif; font-size:10pt">Customer Name: {CUSTOMER_NAME}</span></strong></p>\n                            <p><strong><span style="font-family:arial,sans-serif; font-size:10pt">Customer Email: {CUSTOMER_EMAIL}</span></strong></p>\n                            <p><strong><span style="font-family:arial,sans-serif; font-size:10pt">Customer Phone: {CUSTOMER_PHONE}</span></strong></p>\n                            <p><strong><span style="font-family:arial,sans-serif; font-size:10pt">Customer Contact Time: {CUSTOMER_CONTACT_TIME}</span></strong></p>\n                            <p><strong><span style="font-family:arial,sans-serif; font-size:10pt">Customer Request Time: {CUSTOMER_REQUEST_TIME}</span></strong></p>\n                            {ENQUIRY_TABLE}\n                        </td>\n                    </tr>\n                    <tr style="background:#FFF;border-radius:5px;">\n                        <td style="font-family:verdana;font-size:13px;line-height:1.3em;text-align:left;padding:15px;">\n                            <p><span style="font-family:arial,sans-serif; font-size:10pt">Thanks,</span></p>\n                            <p><span style="font-family:arial,sans-serif; font-size:10pt">The Contractor Mortgages&nbsp;Team</span></p>\n                        </td>\n                    </tr>\n                </table>\n            </td>\n        </tr>\n    </tbody>\n</table>', '2018-11-03 00:00:00', '2018-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE IF NOT EXISTS `user_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_management`
--

INSERT INTO `user_management` (`id`, `name`, `phone`, `email`, `age`, `city`, `gender`, `password`, `is_admin`, `created_date`, `modified_date`, `status`) VALUES
(1, 'parth', 1221212121, 'parth@gmail.com', '23', 'ahmedabad', 'male', '4297f44b13955235245b2497399d7a93', 1, '2015-05-11 20:57:40', '0000-00-00 00:00:00', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
