-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2018 at 02:27 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(200) NOT NULL,
  `employee_password` varchar(200) NOT NULL,
  `Employee_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_password`, `Employee_name`) VALUES
('adevalacheru@speech-soft.com', 'Akshita123', 'D Akshita'),
('asingh@speech-soft.com', 'Akhilesh123', 'Akhilesh Pratap Singh'),
('bsandana@speech-soft.com', 'Sandhana123', 'Sandhana Bharghavi'),
('gputta@speech-soft.com', 'Ganesh123', 'Ganesh'),
('kdesouza@speech-soft.com', 'Keith123', 'Keith'),
('mbarru@speech-soft.com ', 'Madhavi123', 'Madhavi'),
('nrao@speech-soft.com', 'Nageshwar123', 'Nageshwar Rao'),
('rmanchala@speech-soft.com', 'Ram123', 'Ram Manchala'),
('sindhureddy@speech-soft.com', 'Sindhuja123', 'Sindhuja'),
('skumar@speech-soft.com ', 'Sandeep123', 'Sandeep'),
('slakkakula@speech-soft.com', 'Sunil123', 'Sunil Lakkakula'),
('spreddy@speech-soft.com', 'Santhosh123', 'Santhosh Reddy'),
('vpatil@speech-soft.com', 'Vinod123', 'Vinod Patil');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `report_id` int(11) NOT NULL,
  `Employee_name` text NOT NULL,
  `date` text NOT NULL,
  `type` text NOT NULL,
  `comment` text NOT NULL,
  `vacation` int(11) NOT NULL,
  `optional` int(11) NOT NULL,
  `sick` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  `work_from_home` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`report_id`, `Employee_name`, `date`, `type`, `comment`, `vacation`, `optional`, `sick`, `present`, `work_from_home`, `others`) VALUES
(17, 'Ganesh', '01-06-2018', 'Present', '', 0, 0, 0, 1, 0, 0),
(18, 'Ganesh', '02-06-2018', 'Sick Leave', 'Sick', 0, 0, 1, 0, 0, 0),
(19, 'Ganesh', '03-06-2018', 'Work From Home', 'Work From Home', 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `experience`) VALUES
(3, 'Ganesh', 1),
(4, 'Keith', 1),
(5, 'Madhavi', 3),
(6, 'Nageshwar Rao', 1),
(7, 'Sandeep', 3),
(8, 'Sandhana Bharghavi', 1),
(9, 'Santhosh Reddy', 3),
(10, 'Sindhuja', 3),
(11, 'Sunil Lakkakula', 1),
(13, 'Vinod Patil', 3),
(17, 'Akhilesh Pratap Singh', 1),
(18, 'D Akshita', 1),
(19, 'Ram Manchala', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
