-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 02:41 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_detail`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `course_details` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `course_details`, `created_date`) VALUES
(1, 'IT', 'Information technology - (IT) is the use of any computers, storage, networking and other physical devices, infrastructure and processes to create, process, store.', '2020-06-24 17:44:03'),
(2, 'ECE', 'Electronic communications engineers conceptualize, design, test and oversee the manufacturing of communications and broadcast systems.', '2020-06-24 17:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(64) CHARACTER SET utf8mb4 DEFAULT NULL,
  `last_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_no` bigint(10) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `dob`, `contact_no`, `created_date`) VALUES
(1, 'Kumar', 'Durairaj', '1995-02-11', 9095643211, '2020-06-24 17:27:00'),
(2, 'Sanjay', 'Kumar', '1997-07-16', 9988774455, '2020-06-24 17:27:54'),
(3, 'Raja', 'Palani', '2000-10-10', 7700553366, '2020-06-24 17:28:26'),
(6, 'Vinoth', 'Kumar', '2005-02-09', 9988774455, '2020-06-24 17:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_reg`
--

CREATE TABLE `student_course_reg` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course_reg`
--

INSERT INTO `student_course_reg` (`id`, `student_id`, `course_id`, `created_date`) VALUES
(1, 1, 1, '2020-06-24 17:51:27'),
(2, 2, 1, '2020-06-24 17:51:27'),
(3, 1, 2, '2020-06-24 17:51:27'),
(4, 3, 2, '2020-06-24 17:54:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_course_reg`
--
ALTER TABLE `student_course_reg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_course_reg`
--
ALTER TABLE `student_course_reg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
