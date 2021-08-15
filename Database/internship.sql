-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2021 at 01:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_details`
--

CREATE TABLE `group_details` (
  `gid` int(11) NOT NULL,
  `group_id` varchar(15) DEFAULT NULL,
  `group_member_count` int(11) NOT NULL,
  `group_member_ids` varchar(20) NOT NULL,
  `group_member_names` varchar(50) NOT NULL,
  `guide_id` varchar(4) NOT NULL,
  `project_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_details`
--

INSERT INTO `group_details` (`gid`, `group_id`, `group_member_count`, `group_member_ids`, `group_member_names`, `guide_id`, `project_id`) VALUES
(2, 'Gr2', 2, 's14,s12', 'Shardul Birje,John Doe', 'g11', 'EtA1');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guide_id` varchar(4) NOT NULL,
  `project_ids` varchar(50) DEFAULT NULL,
  `guide_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guide_id`, `project_ids`, `guide_code`) VALUES
('g11', NULL, 'RS');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pid` int(11) NOT NULL,
  `project_id` varchar(5) DEFAULT NULL,
  `project_name` text NOT NULL,
  `project_desc` varchar(100) DEFAULT NULL,
  `blackbook_link` varchar(100) DEFAULT NULL,
  `paper_link` varchar(100) DEFAULT NULL,
  `videa_link` varchar(50) DEFAULT NULL,
  `guideid` varchar(5) NOT NULL,
  `other_details` varchar(100) DEFAULT NULL,
  `group_id` varchar(5) NOT NULL,
  `project_link` varchar(50) DEFAULT NULL,
  `technologies` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `project_id`, `project_name`, `project_desc`, `blackbook_link`, `paper_link`, `videa_link`, `guideid`, `other_details`, `group_id`, `project_link`, `technologies`) VALUES
(1, 'EtA1', 'BookBarn', 'Amazing project', NULL, NULL, NULL, 'g11', NULL, 'Gr2', NULL, 'HTML,CSS');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `group_id` varchar(15) DEFAULT NULL,
  `guide_id` varchar(4) DEFAULT NULL,
  `batch` int(11) NOT NULL DEFAULT 0,
  `division` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `group_id`, `guide_id`, `batch`, `division`) VALUES
('s12', 'Gr2', 'g11', 2022, 1),
('s14', 'Gr2', 'g11', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department` varchar(30) NOT NULL DEFAULT 'Enter your Department',
  `type` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT './Assets/default_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `username`, `email`, `department`, `type`, `password`, `image`) VALUES
(11, 'g11', 'Rohana Survase', 'rohana@gmail.com', 'Enter your Department', 'guide', 'rohana', './Assets/default_profile.png'),
(12, 's12', 'Shardul Birje', 'shardulbirje@gmail.com', 'Enter your Department', 'student', 'shardul', './Assets/default_profile.png'),
(14, 's14', 'John Doe', 'johndoe@gmail.com', 'Enter your Department', 'student', 'john', './Assets/default_profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_details`
--
ALTER TABLE `group_details`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_details`
--
ALTER TABLE `group_details`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
