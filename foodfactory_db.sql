-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 01:54 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodfactory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodcategorytbl`
--

CREATE TABLE `foodcategorytbl` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(1000) NOT NULL,
  `c_image` varchar(1000) NOT NULL,
  `c_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodcategorytbl`
--

INSERT INTO `foodcategorytbl` (`c_id`, `c_name`, `c_image`, `c_status`) VALUES
(1, 'Indian', 'https://i.ndtvimg.com/i/2015-11/indian-food-625_625x350_51448018868.jpg', 1),
(2, 'Chinese', 'https://i.ndtvimg.com/i/2016-06/chinese-625_625x350_81466064119.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foodprovidertbl`
--

CREATE TABLE `foodprovidertbl` (
  `fp_id` int(11) NOT NULL,
  `fp_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodprovidertbl`
--

INSERT INTO `foodprovidertbl` (`fp_id`, `fp_name`) VALUES
(1, 'Zomato'),
(2, 'Swiggy'),
(3, 'Uber Eats');

-- --------------------------------------------------------

--
-- Table structure for table `locationstbl`
--

CREATE TABLE `locationstbl` (
  `l_id` int(11) NOT NULL,
  `l_name` varchar(1000) NOT NULL,
  `l_lat` decimal(12,9) NOT NULL,
  `l_long` decimal(12,9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locationstbl`
--

INSERT INTO `locationstbl` (`l_id`, `l_name`, `l_lat`, `l_long`) VALUES
(1, 'Dahisar West', '19.257486100', '72.829732900'),
(2, 'Dahisar East', '19.251948700', '72.860032700');

-- --------------------------------------------------------

--
-- Table structure for table `menurestauranttbl`
--

CREATE TABLE `menurestauranttbl` (
  `mr_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `mr_cost` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menurestauranttbl`
--

INSERT INTO `menurestauranttbl` (`mr_id`, `m_id`, `r_id`, `mr_cost`) VALUES
(1, 1, 1, '190'),
(2, 1, 1, '200'),
(3, 2, 2, '160'),
(4, 2, 2, '140');

-- --------------------------------------------------------

--
-- Table structure for table `menutbl`
--

CREATE TABLE `menutbl` (
  `m_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `m_name` varchar(1000) NOT NULL,
  `m_image` varchar(1000) NOT NULL,
  `m_type` int(11) NOT NULL COMMENT '0 - veg, 1 - non-veg',
  `m_marketcost` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menutbl`
--

INSERT INTO `menutbl` (`m_id`, `c_id`, `m_name`, `m_image`, `m_type`, `m_marketcost`) VALUES
(1, 1, 'Tawa Murgh Kebab', 'http://www.cukzy.com/wp-content/uploads/chicken-bihari.jpg', 1, '210'),
(2, 2, 'Chicken Fried Rice', 'https://natashaskitchen.com/wp-content/uploads/2019/09/Chicken-Fried-Rice-2-500x500.jpg', 1, '180');

-- --------------------------------------------------------

--
-- Table structure for table `orderstbl`
--

CREATE TABLE `orderstbl` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `rp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurantprovidertbl`
--

CREATE TABLE `restaurantprovidertbl` (
  `rp_id` int(11) NOT NULL,
  `mr_id` int(11) NOT NULL,
  `fp_id` int(11) NOT NULL,
  `fp_url` varchar(1000) NOT NULL,
  `rp_discountedcost` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurantprovidertbl`
--

INSERT INTO `restaurantprovidertbl` (`rp_id`, `mr_id`, `fp_id`, `fp_url`, `rp_discountedcost`) VALUES
(1, 1, 1, 'http://zomato.com', '150'),
(2, 1, 2, 'http://swiggy.com', '160'),
(3, 1, 3, 'http://ubereats.com', '150');

-- --------------------------------------------------------

--
-- Table structure for table `restaurantstbl`
--

CREATE TABLE `restaurantstbl` (
  `r_id` int(11) NOT NULL,
  `r_lat` decimal(12,9) NOT NULL,
  `r_long` decimal(12,9) NOT NULL,
  `r_name` varchar(1000) NOT NULL,
  `r_address` varchar(1000) NOT NULL,
  `r_image` varchar(1000) NOT NULL,
  `r_mobile` varchar(1000) NOT NULL,
  `r_isopen` int(11) NOT NULL COMMENT '0 - close, 1 - open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurantstbl`
--

INSERT INTO `restaurantstbl` (`r_id`, `r_lat`, `r_long`, `r_name`, `r_address`, `r_image`, `r_mobile`, `r_isopen`) VALUES
(1, '19.257521500', '72.853750300', 'Banjara Dhaba', 'Holy Cross Rd, I C Colony, Borivali West, Mumbai, Maharashtra 400103', 'https://www.google.com/maps/place/Banjara+Dhaba/@19.2529303,72.8490266,3a,75y,90t/data=!3m8!1e2!3m6!1sAF1QipOYAJ7Rzyo_lSJle8o99FDE-Ii7h28N4Q-IwMXi!2e10!3e12!6shttps:%2F%2Flh5.googleusercontent.com%2Fp%2FAF1QipOYAJ7Rzyo_lSJle8o99FDE-Ii7h28N4Q-IwMXi%3Dw86-h114-k-no!7i3024!8i4032!4m13!1m7!3m6!1s0x3be7b0ee9275be8f:0xdd7b9fff4a566a20!2sDahisar+West,+Mumbai,+Maharashtra!3b1!8m2!3d19.2546655!4d72.8538822!3m4!1s0x3be7b11d11bcf1b7:0x67e69543b6f3190f!8m2!3d19.2529536!4d72.8492019#', '9867656567', 1),
(2, '19.252930300', '72.849026600', 'Tawa Tandoor Center', 'Mukunda Nagar, I.C.Colony, New Link Road, Borivali West, Mumbai, Maharashtra 400103', 'https://lh5.googleusercontent.com/p/AF1QipMkbS6jLdjevsRQGbkxZdRZMDp3ogrEm9lKrt_-=w408-h544-k-no', '084548 50911', 1);

-- --------------------------------------------------------

--
-- Table structure for table `searchtbl`
--

CREATE TABLE `searchtbl` (
  `s_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_term` varchar(1000) NOT NULL,
  `s_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `searchtbl`
--

INSERT INTO `searchtbl` (`s_id`, `u_id`, `s_term`, `s_date`) VALUES
(1, 1, 'Chicken', '2020-01-15'),
(6, 1, 'Banjara', '2020-01-15'),
(7, 1, 'Banjara', '2020-01-15'),
(8, 1, 'Banjara', '2020-01-15'),
(9, 1, 'Banjara', '2020-01-15'),
(10, 1, 'tawa', '2020-01-15'),
(11, 1, 'tawa', '2020-01-16'),
(12, 4, 'tawa', '2020-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `surveytbl`
--

CREATE TABLE `surveytbl` (
  `s_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_ids` varchar(100) NOT NULL COMMENT 'separated ids',
  `price_from` varchar(1000) NOT NULL,
  `price_to` varchar(1000) NOT NULL,
  `pref_delivery_from` varchar(1000) NOT NULL,
  `pref_delivery_to` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveytbl`
--

INSERT INTO `surveytbl` (`s_id`, `u_id`, `c_ids`, `price_from`, `price_to`, `pref_delivery_from`, `pref_delivery_to`) VALUES
(1, 1, '1, 2', '200', '500', '25', '45'),
(2, 1, '1, 2', '1000', '1500', '60', '100'),
(3, 1, '[1]', '200', '500', '25', '45'),
(4, 1, '1', '200', '500', '45', '60'),
(5, 1, '1, 2', '500', '1000', '45', '60'),
(6, 1, '1, 2', '500', '1000', '25', '45'),
(7, 1, '1, 2', '200', '500', '45', '60'),
(8, 1, '1, 2', '200', '500', '45', '60'),
(9, 1, '1, 2', '500', '1000', '45', '60'),
(10, 1, '1, 2', '200', '500', '25', '45'),
(11, 4, '1, 2', '500', '1000', '25', '45'),
(12, 5, '1', '500', '1000', '25', '45'),
(13, 4, '1, 2', '500', '1000', '45', '60');

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(1000) NOT NULL,
  `u_email` varchar(1000) NOT NULL,
  `u_phone` varchar(10) NOT NULL,
  `u_password` varchar(1000) NOT NULL,
  `u_creationdate` date NOT NULL,
  `u_lat` decimal(12,9) NOT NULL,
  `u_long` decimal(12,9) NOT NULL,
  `login_check` tinyint(4) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`u_id`, `u_name`, `u_email`, `u_phone`, `u_password`, `u_creationdate`, `u_lat`, `u_long`, `login_check`, `last_login`) VALUES
(1, 'charul', 'charul@gmail.com', '9383838382', '3a367c5e268668282a5781d2d7be69d9', '2019-12-16', '0.000000000', '0.000000000', 1, '2019-12-28 20:05:19'),
(2, 'charul18', 'charuldalvi18@gmail.com', '9464646444', '777a2c8b665c99844f13f78bd8d4e7bc', '2019-12-16', '19.000000000', '73.000000000', 0, '0000-00-00 00:00:00'),
(3, 'sachin', 'sachin@gmail.com', '9467946764', '9c182baae5f199a97e907712e0a60141', '2019-12-19', '19.153153000', '72.823967000', 0, '0000-00-00 00:00:00'),
(4, 'charul_18', 'charul18@gmail.com', '9467646467', '777a2c8b665c99844f13f78bd8d4e7bc', '2019-12-19', '19.178426200', '72.842281000', 1, '2020-01-17 15:35:39'),
(5, 'manavlundia', 'manavlundia.nmims@gmail.com', '9799949794', '7de705319c1bc84d227d94ef8ca5cd94', '2020-01-17', '19.178501900', '72.842422100', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodcategorytbl`
--
ALTER TABLE `foodcategorytbl`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `foodprovidertbl`
--
ALTER TABLE `foodprovidertbl`
  ADD PRIMARY KEY (`fp_id`);

--
-- Indexes for table `locationstbl`
--
ALTER TABLE `locationstbl`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `menurestauranttbl`
--
ALTER TABLE `menurestauranttbl`
  ADD PRIMARY KEY (`mr_id`);

--
-- Indexes for table `menutbl`
--
ALTER TABLE `menutbl`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orderstbl`
--
ALTER TABLE `orderstbl`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `restaurantprovidertbl`
--
ALTER TABLE `restaurantprovidertbl`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `restaurantstbl`
--
ALTER TABLE `restaurantstbl`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `searchtbl`
--
ALTER TABLE `searchtbl`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `surveytbl`
--
ALTER TABLE `surveytbl`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foodcategorytbl`
--
ALTER TABLE `foodcategorytbl`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `foodprovidertbl`
--
ALTER TABLE `foodprovidertbl`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locationstbl`
--
ALTER TABLE `locationstbl`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menurestauranttbl`
--
ALTER TABLE `menurestauranttbl`
  MODIFY `mr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menutbl`
--
ALTER TABLE `menutbl`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderstbl`
--
ALTER TABLE `orderstbl`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurantprovidertbl`
--
ALTER TABLE `restaurantprovidertbl`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurantstbl`
--
ALTER TABLE `restaurantstbl`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `searchtbl`
--
ALTER TABLE `searchtbl`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `surveytbl`
--
ALTER TABLE `surveytbl`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
