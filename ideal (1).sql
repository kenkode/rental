-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2018 at 03:58 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ideal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', 'admin', '0000-00-00'),
(2, 'kennjuguna@gmail.com', 'bbit74491', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `owner_utility_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `rent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `water_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `electric_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `gas_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `security_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `utility_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `other_bill` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_rent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `issue_date` date NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`owner_utility_id`, `tenant_id`, `month`, `rent`, `water_bill`, `electric_bill`, `gas_bill`, `security_bill`, `utility_bill`, `other_bill`, `total_rent`, `issue_date`, `added_date`) VALUES
(3, 15, 'October-2018', '7000.00', '500.00', '300.00', '650.00', '200.00', '700.00', '550.00', '9900.00', '2018-10-05', '2018-10-19 07:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `bill_type`
--

CREATE TABLE `bill_type` (
  `bt_id` int(11) NOT NULL,
  `bill_type` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_type`
--

INSERT INTO `bill_type` (`bt_id`, `bill_type`, `added_date`) VALUES
(1, 'Gas', '2016-05-04 23:49:35'),
(2, 'Water', '2016-05-04 23:50:39'),
(3, 'Electric', '2016-05-04 23:50:51'),
(4, 'Internet', '2018-05-06 13:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `building_info`
--

CREATE TABLE `building_info` (
  `bldid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `security_guard_mobile` varchar(200) NOT NULL,
  `building_make_year` varchar(200) NOT NULL,
  `status` varchar(255) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building_info`
--

INSERT INTO `building_info` (`bldid`, `name`, `address`, `security_guard_mobile`, `building_make_year`, `status`, `added_date`) VALUES
(1, 'Marina Height ', 'Mombasa', '254700123456', '1', 'ACTIVE', '2018-05-05 21:00:00'),
(3, 'J&D Height', '123, Nairobi', '0712345678', '2018', 'ACTIVE', '2018-10-18 11:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complain_id` int(11) NOT NULL,
  `c_title` varchar(200) NOT NULL,
  `c_description` varchar(200) NOT NULL,
  `c_date` varchar(200) NOT NULL,
  `c_month` varchar(50) NOT NULL,
  `c_year` varchar(50) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complain_id`, `c_title`, `c_description`, `c_date`, `c_month`, `c_year`, `tenant_id`, `added_date`) VALUES
(8, 'Water Problem', 'Every day getting water problem', '07/05/2016', '5', '2016', 7, '2016-05-06 23:41:42'),
(9, 'Water Problem', 'Water has gone for 3 days...', '25/06/2016', '6', '2016', 8, '2016-06-25 00:27:18'),
(10, 'Toilet Sink Clogged', 'My toilet sink is clogged please send someone pronto!', '2018-10-19', 'October', '2018', 15, '2018-10-19 13:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `e_name` varchar(200) NOT NULL,
  `e_email` varchar(200) NOT NULL,
  `e_contact` varchar(200) NOT NULL,
  `e_address` varchar(200) NOT NULL,
  `e_nid` varchar(200) NOT NULL,
  `e_designation` varchar(255) NOT NULL,
  `e_date` varchar(200) NOT NULL,
  `e_password` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `e_name`, `e_email`, `e_contact`, `e_address`, `e_nid`, `e_designation`, `e_date`, `e_password`, `building_id`, `status`) VALUES
(5, 'Jhonson', 'jhonson@yahoo.com', '98654722', 'Mildura, Australia', '98654723', 'Agent', '01/05/2016', '123456', 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `employee_login`
--

CREATE TABLE `employee_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_login`
--

INSERT INTO `employee_login` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', 'admin', '0000-00-00'),
(2, 'kennjuguna@gmail.com', 'bbit74491', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

CREATE TABLE `employee_salary_setup` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `month_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `issue_date` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_salary_setup`
--

INSERT INTO `employee_salary_setup` (`emp_id`, `emp_name`, `designation`, `month_id`, `xyear`, `amount`, `issue_date`, `building_id`, `added_date`) VALUES
(8, '5', 'Security Gard', 5, '2016', '10000.00', '05/05/2016', 7, '2016-05-06 23:57:11'),
(9, '5', 'Security Gard', 4, '2016', '10000.00', '05/04/2016', 7, '2016-05-07 00:01:59'),
(10, '5', 'Security Gard', 1, '2016', '50.25', '22/06/2016', 8, '2016-06-25 22:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `fid` int(11) NOT NULL,
  `floor_no` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`fid`, `floor_no`, `building_id`, `added_date`) VALUES
(1, 'First Floor', 1, '2016-03-22 02:07:46'),
(3, 'Second Floor', 1, '2018-05-05 21:00:00'),
(4, 'Third Floor', 1, '2018-05-05 21:00:00'),
(5, 'Seventh Floor', 1, '2016-06-22 00:33:41'),
(6, 'Fourth Floor', 1, '2018-10-18 07:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `fund_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `f_date` varchar(200) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `purpose` varchar(400) NOT NULL,
  `building_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`fund_id`, `unit_id`, `month_id`, `xyear`, `f_date`, `total_amount`, `purpose`, `building_id`, `added_date`) VALUES
(2, 6, 5, '8', '01/05/2016', '5000.00', 'Monthly Collection', 7, '2016-05-06 23:30:25'),
(3, 7, 5, '8', '01/05/2016', '5000.00', 'Monthly Collection', 7, '2016-05-06 23:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `unit_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `floor_id`, `unit_no`, `status`, `building_id`) VALUES
(1, 3, 'C4', 'ACTIVE', 3),
(2, 1, 'A1', 'ACTIVE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `ownid` int(11) NOT NULL,
  `o_name` varchar(200) NOT NULL,
  `o_email` varchar(200) NOT NULL,
  `o_contact` varchar(200) NOT NULL,
  `o_address` varchar(500) NOT NULL,
  `o_nid` varchar(200) NOT NULL,
  `o_password` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`ownid`, `o_name`, `o_email`, `o_contact`, `o_address`, `o_nid`, `o_password`, `building_id`, `status`) VALUES
(1, 'Mark Muhoho', 'mark@yahoo.com', '254706301950', 'Karen, Nairobi', '32955055', '123456', 1, 'ACTIVE'),
(2, 'Muigai Kenyatta', 'kenyatta@gmail.com', '257790158519', 'Muthaiga, Nairobi', '28224110', '123456', 1, 'ACTIVE'),
(3, 'Maina Kageni', 'kageni@gmail.com', '254715750755', 'Nyali, Mombasa', '25583669', '123456', 3, 'ACTIVE'),
(4, 'Michael Joseph', 'mj@gmail.com', '254711911511', 'Nyeri', '23558662', '232423', 3, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `landlord_login`
--

CREATE TABLE `landlord_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landlord_login`
--

INSERT INTO `landlord_login` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', 'admin', '0000-00-00'),
(2, 'kennjuguna@gmail.com', 'bbit74491', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `mcid` int(11) NOT NULL,
  `m_title` varchar(200) NOT NULL,
  `m_date` varchar(200) NOT NULL,
  `m_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `m_details` varchar(200) NOT NULL,
  `xmonth` int(11) NOT NULL DEFAULT '0',
  `xyear` int(11) NOT NULL DEFAULT '0',
  `building_id` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`mcid`, `m_title`, `m_date`, `m_amount`, `m_details`, `xmonth`, `xyear`, `building_id`, `added_date`) VALUES
(1, 'Painting', '05/05/2016', '15000.00', 'painting', 1, 2018, 1, '2018-05-05 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `month_setup`
--

CREATE TABLE `month_setup` (
  `m_id` int(11) NOT NULL,
  `month_name` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `month_setup`
--

INSERT INTO `month_setup` (`m_id`, `month_name`, `added_date`) VALUES
(1, 'January', '2016-04-11 02:16:15'),
(2, 'February', '2016-04-11 02:16:25'),
(3, 'March', '2016-04-11 02:16:30'),
(4, 'April', '2016-04-11 02:16:36'),
(5, 'May', '2016-04-11 02:16:41'),
(6, 'June', '2016-04-11 02:16:48'),
(7, 'July', '2016-04-11 02:16:53'),
(8, 'August', '2016-04-11 02:16:59'),
(9, 'September', '2016-04-11 02:17:06'),
(10, 'Octobor', '2016-04-11 02:17:14'),
(11, 'November', '2016-04-11 02:17:24'),
(12, 'December', '2016-04-11 02:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `owner_unit_relation`
--

CREATE TABLE `owner_unit_relation` (
  `owner_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner_unit_relation`
--

INSERT INTO `owner_unit_relation` (`owner_id`, `building_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `r_name` varchar(200) NOT NULL,
  `r_email` varchar(200) NOT NULL,
  `r_contact` varchar(200) NOT NULL,
  `r_address` varchar(200) NOT NULL,
  `r_nid` varchar(200) NOT NULL,
  `house_id` int(11) NOT NULL,
  `r_advance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `r_rent_pm` decimal(15,2) NOT NULL DEFAULT '0.00',
  `r_date` varchar(200) NOT NULL,
  `r_password` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `r_name`, `r_email`, `r_contact`, `r_address`, `r_nid`, `house_id`, `r_advance`, `r_rent_pm`, `r_date`, `r_password`, `building_id`, `status`) VALUES
(1, 'Ken Kithinji', 'kkithinji@gmail.com', '254700800900', 'Mombasa', '32966033', 2, '12000.00', '6500.00', '2018-05-06', '123456', 1, 'ACTIVE'),
(2, 'Tim Westwood', 'twestwood@gmail.com', '254703601950', 'Mombasa', '32692987', 3, '20000.00', '10000.00', '2018-05-13', '23456', 1, 'ACTIVE'),
(10, 'Ricky', 'ricky@yahoo.com', '97605412', 'Melbourne, Australia', '9865321', 18, '20000.00', '10000.00', '07/05/2016', '123456', 3, 'ACTIVE'),
(11, 'Mishel Johnson', 'michel@gmail.com', '01717456321', 'Mirpur-1,Dhaka-1216', '1521807785324', 14, '12000.00', '12000.00', '09/05/2016', '123456', 3, 'ACTIVE'),
(12, 'Test 12', 'test@gmail.com', '0712345678', '123', '1234578', 0, '20000.00', '10000.00', '2018-10-01', '123456', 1, 'ACTIVE'),
(15, 'Ken', 'wangoken2@gmail.com', '0725145304', '123, Nairobi', '27781190', 1, '13000.00', '7000.00', '2018-10-05', '123456', 3, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_login`
--

CREATE TABLE `tenant_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant_login`
--

INSERT INTO `tenant_login` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', 'admin', '0000-00-00'),
(2, 'kennjuguna@gmail.com', 'bbit74491', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `uid` int(11) NOT NULL,
  `floor_no` varchar(200) NOT NULL,
  `unit_no` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`uid`, `floor_no`, `unit_no`, `building_id`, `status`, `added_date`) VALUES
(14, '1', '1B', 7, 1, '2016-05-06 22:30:42'),
(15, '1', '1A', 7, 0, '2016-05-06 22:30:53'),
(16, '3', '2B', 7, 0, '2016-05-06 22:31:02'),
(17, '3', '2A', 7, 0, '2016-05-06 22:31:11'),
(18, '4', '3A', 7, 1, '2016-05-06 22:31:22'),
(19, '4', '3B', 7, 0, '2016-05-06 22:31:33'),
(20, '5', '4B', 7, 0, '2016-05-06 22:31:48'),
(21, '5', '4A', 7, 0, '2016-05-06 22:31:57'),
(22, '6', '5B', 7, 0, '2016-05-06 22:32:07'),
(23, '6', '5A', 7, 0, '2016-05-06 22:32:16'),
(24, '8', '6A', 7, 0, '2016-05-06 22:32:24'),
(25, '8', '6B', 7, 0, '2016-05-06 22:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `year_setup`
--

CREATE TABLE `year_setup` (
  `y_id` int(11) NOT NULL,
  `xyear` varchar(200) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `year_setup`
--

INSERT INTO `year_setup` (`y_id`, `xyear`, `added_date`) VALUES
(1, '2017', '2018-05-05 21:00:00'),
(2, '2018', '2018-05-05 21:00:00'),
(3, '2019', '2018-05-05 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`owner_utility_id`);

--
-- Indexes for table `bill_type`
--
ALTER TABLE `bill_type`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `building_info`
--
ALTER TABLE `building_info`
  ADD PRIMARY KEY (`bldid`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complain_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`fund_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landlord`
--
ALTER TABLE `landlord`
  ADD PRIMARY KEY (`ownid`);

--
-- Indexes for table `landlord_login`
--
ALTER TABLE `landlord_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`mcid`);

--
-- Indexes for table `month_setup`
--
ALTER TABLE `month_setup`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_login`
--
ALTER TABLE `tenant_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `year_setup`
--
ALTER TABLE `year_setup`
  ADD PRIMARY KEY (`y_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `owner_utility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bill_type`
--
ALTER TABLE `bill_type`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `building_info`
--
ALTER TABLE `building_info`
  MODIFY `bldid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee_login`
--
ALTER TABLE `employee_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `fund_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `ownid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `landlord_login`
--
ALTER TABLE `landlord_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `month_setup`
--
ALTER TABLE `month_setup`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tenant_login`
--
ALTER TABLE `tenant_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `year_setup`
--
ALTER TABLE `year_setup`
  MODIFY `y_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
