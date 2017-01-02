-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2016 at 08:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_name`
--

CREATE TABLE IF NOT EXISTS `college_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=239 ;

--
-- Dumping data for table `college_name`
--

INSERT INTO `college_name` (`id`, `user`, `name`) VALUES
(211, 19, 'atmiya'),
(216, 19, 'a'),
(217, 19, 'b'),
(219, 19, 'd'),
(220, 19, 'e'),
(222, 19, 'navyug'),
(225, 19, 'nanlada'),
(226, 19, 'gg'),
(227, 19, 'kk'),
(228, 13, 'l'),
(229, 20, 'm'),
(230, 21, 'n'),
(231, 1, 'o'),
(232, 6, 'p'),
(235, 19, 'kaushik'),
(237, 19, 'rk'),
(238, 19, 'navyug');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `college_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=336 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `college_id`) VALUES
(284, 'mca', 211),
(286, 'mba', 211),
(287, 'mca', 255),
(291, 'asp.net', 214),
(292, 'b.com', 213),
(294, 'bba', 226),
(295, 'bba', 226),
(296, 'bca', 226),
(297, 'b.com', 226),
(298, 'ba', 226),
(299, 'bsc', 226),
(300, 'ma', 226),
(307, 'bba', 222),
(309, 'bba', 222),
(310, 'b.com', 216),
(311, 'bba', 220),
(313, 'm.com', 220),
(318, 'b.com', 226),
(319, 'bba', 226),
(322, 'm.com', 226),
(324, 'mca', 226),
(325, 'bba', 226),
(326, 'bca', 226),
(327, 'ma', 226),
(328, 'msc', 226),
(329, 'mca', 226),
(330, 'b.com', 226),
(331, 'ba', 226),
(332, 'm.com', 226),
(333, 'mba', 226),
(335, 'bba', 238);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'kaushik', 'kaushik');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fristname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` int(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `onoroff` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fristname`, `lastname`, `email`, `password`, `address`, `phone_no`, `city`, `onoroff`) VALUES
(1, 'kalariya', 'kaushik', 'kalariyakaushik71@gmail.com', 'k', 'k', 7, 'm', 1),
(6, 'kalariya', 'kaushik', 'kalariyakaushik71@gmail.com', 'k', 'k', 7, 'm', 0),
(13, 'kalariya', 'k', 'k', 'k', 'l', 7, 'k', 1),
(19, 'kaushik', 'kaushik', 'kaushik', 'kaushik', 'jivapar', 123456789, 'morbi', 0),
(20, 'kalariya', 'kalariya', 'kalariya', 'kalariya', 'kalariya', 165464, 'kalariya', 0),
(21, 'k', 'k', 'kkkkk', 'k', 'kk', 74, 'morbi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `phone_no` int(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `age`, `village`, `phone_no`, `course_id`) VALUES
(35, 'vishal', 0, '', 0, '284'),
(37, 'uttam', 0, '', 0, '287'),
(38, 'vivek', 0, '', 0, ' 305'),
(39, 'kaushik', 0, '', 0, ' 305'),
(40, 'bhavesh', 0, '', 0, ' 305'),
(41, 'nikul', 0, '', 0, ' 305'),
(42, 'kailash', 0, '', 0, ' 305'),
(43, 'hiren', 0, '', 0, '309'),
(44, 'tarang', 0, '', 0, '307'),
(45, 'mayank', 0, '', 0, ' 305'),
(46, 'kalpesh', 0, '', 0, '311'),
(47, 'mahesh', 0, '', 0, '295'),
(53, 'mailik', 0, '', 0, '302'),
(54, 'jaydeep', 0, '', 0, ' 329'),
(55, 'bhavin', 0, '', 0, ' 329'),
(56, 'a', 0, '', 0, ' 329'),
(57, 'b', 0, '', 0, ' 329'),
(58, 'c', 0, '', 0, ' 329'),
(59, 'd', 0, '', 0, ' 329'),
(60, 'e', 0, '', 0, ' 329'),
(61, 'f', 0, '', 0, ' 329'),
(62, 'g', 0, '', 0, ' 329'),
(64, 'i', 0, '', 0, ' 329'),
(65, 'ka', 0, '', 0, ' 329');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `course_id`) VALUES
(26, 'Vector Calculus and Linear Algebra', '2'),
(27, 'Basic Electronics', '5'),
(28, 'android', '4'),
(29, 'computer opareting system', ''),
(30, 'java', '292'),
(32, 'asp.net', '294'),
(34, 'asp', '305'),
(35, 'vb', ' 292'),
(36, 'c#', '337'),
(37, 'c#', ' 292'),
(38, 'java', ' 292'),
(42, 'asp.net', ' 284'),
(46, 'android', ' 284'),
(49, 'c', '329'),
(52, 'java', '305'),
(53, 'java', '295'),
(54, 'java', ' 295'),
(55, 'asp.net', ' 295'),
(56, 'php', ' 295'),
(57, 'c#', ' 295'),
(58, 'networking', ' 295'),
(59, 'android', '309'),
(60, 'iphone', ' 295'),
(61, 'c++', ' 295'),
(71, 'java', ' 311'),
(73, 'c++', ' 294'),
(74, 'java', ' 294'),
(75, 'java', ' <br />\r\n<b>Notice</b>:  Undefined index: id in <b>C:\\xampp\\htdocs\\mvc\\view\\subject\\subjectCreate.php</b> on line <b>189</b><br />\r\n'),
(76, 'java', ' <br />\r\n<b>Notice</b>:  Undefined index: id in <b>C:\\xampp\\htdocs\\mvc\\view\\subject\\subjectCreate.php</b> on line <b>189</b><br />\r\n'),
(77, 'java', ' <br />\r\n<b>Notice</b>:  Undefined index: id in <b>C:\\xampp\\htdocs\\mvc\\view\\subject\\subjectCreate.php</b> on line <b>189</b><br />\r\n'),
(78, 'java', ' <br />\r\n<b>Notice</b>:  Undefined index: id in <b>C:\\xampp\\htdocs\\mvc\\view\\subject\\subjectCreate.php</b> on line <b>189</b><br />\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `subject_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `course_id`, `subject_id`) VALUES
(71, 'mayank', '309', 51),
(72, 'manish', '292', 35),
(73, 'kaushik', '287', 35),
(74, 'nayan', '287', 38),
(75, 'uttam', '286', 31),
(76, 'kishan', '284', 33),
(77, 'vishal', '286', 31),
(78, 'kuldeep', '284', 33),
(79, 'divyesh', '291', 34),
(80, 'bhavin', '292', 35),
(81, 'nikul', '287', 35),
(82, 'hiren', '294', 51),
(83, 'raj', '291', 34),
(86, 'bhavin', '292', 35),
(87, 'kalpesh', '329', 49),
(89, 'vivek', '291', 38),
(90, 'harshad', '291', 37),
(96, 'mit', '305', 34),
(97, 'mayur', '329', 49),
(98, 'kaushik', '329', 49);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
