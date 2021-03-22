-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 02:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rail_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `timestamp`, `type`) VALUES
(1, 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-02-22 18:18:28', 1),
(2, '', '', '2021-02-26 20:00:08', 100);

-- --------------------------------------------------------

--
-- Table structure for table `lib_categories`
--

CREATE TABLE `lib_categories` (
  `id` bigint(50) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lib_categories`
--

INSERT INTO `lib_categories` (`id`, `category`) VALUES
(2, 'Rasfo'),
(3, 'Cat2');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `ques` text DEFAULT NULL,
  `opt1` text DEFAULT NULL,
  `opt2` text DEFAULT NULL,
  `opt3` text DEFAULT NULL,
  `opt4` text DEFAULT NULL,
  `correct_opt` text DEFAULT NULL,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `ques`, `opt1`, `opt2`, `opt3`, `opt4`, `correct_opt`, `category`) VALUES
(6, 'Which is the fastest animal on Earth?', 'Lioness', 'Cheetah', 'Tiger', 'Fox', 'B', 'Theoritical'),
(15, 'Who is the President of India?', 'Narendra Modi', 'Pranab Mukherjee', 'Pratibha Patel', 'Ram Nath Kovind', 'D', 'Theoritical'),
(16, 'What is 8*2+5-6?', '15', '11', '0', '8', 'A', 'Algebric'),
(17, 'Who is known as the Flying Sikh?', 'Milkha Singh', 'P.T Usha', 'Jagmeet Singh', 'Harjjit Sajan', 'A', 'Conceptual'),
(18, 'Where is Taj Mahal Located?', 'Kanpur', 'Patna', 'Lucknow', 'Agra', 'D', 'Conceptual'),
(19, 'Where is Burj Khalifa Located?', 'Dubai', 'Abu Dhabi', 'Kuwait', 'Ajman', 'A', 'Theoritical'),
(20, 'What is 2 to the power 10?', '1024', '2048', '512', '256', 'A', 'Algebric'),
(21, 'Who is the Road & Transport Minister of India?', 'Narendra Modi', 'Nitin Gadhkari', 'Ram Nath Kovind', 'Rahul Gandhi', 'B', 'Theoritical'),
(22, 'What is 2*10*10/10?', '100', '150', '200', '20', 'D', 'Algebric'),
(23, 'The Surgical Strike by India took place on?', '29th September', '28th September', '27th September', '2nd Sepetember', 'A', 'Theoritical');

-- --------------------------------------------------------

--
-- Table structure for table `ques_cat`
--

CREATE TABLE `ques_cat` (
  `id` int(11) NOT NULL,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ques_cat`
--

INSERT INTO `ques_cat` (`id`, `category`) VALUES
(1, 'Conceptual'),
(2, 'Algebric'),
(3, 'Theoritical'),
(4, 'Aptitude');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`id`, `username`, `category`) VALUES
(28, 'Vansh Patpatia', 'Conceptual'),
(29, 'Vansh Patpatia', 'Theoritical');

-- --------------------------------------------------------

--
-- Table structure for table `tech_lib`
--

CREATE TABLE `tech_lib` (
  `id` bigint(50) NOT NULL,
  `cat_id` bigint(50) NOT NULL,
  `book_name` text NOT NULL,
  `book_addr` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_lib`
--

INSERT INTO `tech_lib` (`id`, `cat_id`, `book_name`, `book_addr`, `time_stamp`, `status`) VALUES
(2, 3, 'test_name', '1614327912_Project description and details (1).pdf', '2021-02-26 08:25:12', 1),
(3, 2, 'test_name22', '1614329040_Letter to Students  23022021.pdf', '2021-02-26 08:44:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `id` bigint(50) NOT NULL,
  `quiz_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`id`, `quiz_time`) VALUES
(1, '120');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lib_categories`
--
ALTER TABLE `lib_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ques_cat`
--
ALTER TABLE `ques_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_lib`
--
ALTER TABLE `tech_lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lib_categories`
--
ALTER TABLE `lib_categories`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ques_cat`
--
ALTER TABLE `ques_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tech_lib`
--
ALTER TABLE `tech_lib`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
