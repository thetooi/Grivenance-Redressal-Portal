-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2015 at 04:53 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grpdb`
--
CREATE DATABASE `grpdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `grpdb`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `category_description` longtext NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Academics', 'Everything related to academics'),
(3, 'Sports', 'All the problems related to sports'),
(5, 'Hostel', 'All the queries related to hostel '),
(6, 'Department', 'All the queries related to the department');

-- --------------------------------------------------------

--
-- Table structure for table `committeemember`
--

CREATE TABLE IF NOT EXISTS `committeemember` (
  `committeeMember_id` int(11) NOT NULL,
  `committeeMember_name` varchar(50) DEFAULT NULL,
  `committeeMember_email` varchar(50) DEFAULT NULL,
  `committeeMember_category_id` int(11) DEFAULT NULL,
  `committeeMember_department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`committeeMember_id`),
  KEY `committeeMember_category_id` (`committeeMember_category_id`),
  KEY `committeeMember_department_id` (`committeeMember_department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committeemember`
--

INSERT INTO `committeemember` (`committeeMember_id`, `committeeMember_name`, `committeeMember_email`, `committeeMember_category_id`, `committeeMember_department_id`) VALUES
(12, 'Akhil', 'akhily02@gmail.com', 1, 8),
(13, 'Amar', 'amarjassal434@gmail.com', 3, 14),
(14, 'ASSTISE', 'asstise@ise.com', 6, 8),
(15, 'HODISE', 'hod@hod.com', 6, 8),
(16, 'HODTC', 'dhod@dhod.com', 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Biotech'),
(2, 'Chemical Engineering'),
(3, 'Civil Engineering'),
(4, 'Computer Science Engineering'),
(5, 'Electrical and Electronics Engineering'),
(6, 'Electronics & Communication Engineering'),
(7, 'Industrial Engineering & Management'),
(8, 'Information Science & Engineering'),
(9, 'Instrumentation Engineering'),
(10, 'Maths'),
(11, 'Master of Computer Applications'),
(12, 'Mechanical Engineering'),
(13, 'Physics'),
(14, 'Physical Education & Sports'),
(15, 'Telecommunication Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `grievance`
--

CREATE TABLE IF NOT EXISTS `grievance` (
  `grievance_id` int(11) NOT NULL AUTO_INCREMENT,
  `grievance_title` varchar(50) DEFAULT NULL,
  `grievance_description` longtext,
  `grievance_image_name` varchar(250) DEFAULT NULL,
  `grievance_category_id` int(11) DEFAULT NULL,
  `grievance_department_id` int(11) DEFAULT NULL,
  `grievance_sender_name` varchar(50) DEFAULT NULL,
  `grievance_sender_USN` varchar(50) DEFAULT NULL,
  `grievance_sender_email` varchar(50) DEFAULT NULL,
  `grievance_sender_sem` int(11) DEFAULT NULL,
  `grievance_sender_department_id` int(11) DEFAULT NULL,
  `grievance_internalFlag` int(11) NOT NULL COMMENT '0-unseen 1-seen 2-replied',
  `grievance_externalFlag` int(11) NOT NULL COMMENT '0-solved 1-pending',
  `grievance_added_timestamp` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grievance_subcategory_id` varchar(250) NOT NULL,
  PRIMARY KEY (`grievance_id`),
  KEY `grievance_category_id` (`grievance_category_id`),
  KEY `grievance_department_id` (`grievance_department_id`),
  KEY `grievance_sender_department_id` (`grievance_sender_department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `grievance`
--

INSERT INTO `grievance` (`grievance_id`, `grievance_title`, `grievance_description`, `grievance_image_name`, `grievance_category_id`, `grievance_department_id`, `grievance_sender_name`, `grievance_sender_USN`, `grievance_sender_email`, `grievance_sender_sem`, `grievance_sender_department_id`, `grievance_internalFlag`, `grievance_externalFlag`, `grievance_added_timestamp`, `timestamp`, `grievance_subcategory_id`) VALUES
(4, 'Hostel snakes problem', 'Hostel snakes problem\r\nHostel snakes problem\r\nHostel snakes problem', 'NULL', 5, NULL, 'Akhil', '1rv12is003', 'akhil.yadav.1426876@facebook.com', 2, 11, 0, 1, '2015-04-10 23:17:49', '2015-04-10 17:47:49', ''),
(5, 'problem is there', 'problem is there\r\nproblem is there\r\nproblem is there', 'rec2.jpg', 3, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 1, 1, '2015-04-10 23:18:19', '2015-04-10 17:59:24', ''),
(6, 'Sports equipments not proper', 'Sports equipments not proper\r\nSports equipments not proper', 'NULL', 3, NULL, 'Ak', '1rvbhoi090', 'aky1002@gmail.com', 6, 8, 2, 0, '2015-04-10 23:19:01', '2015-10-28 16:24:45', ''),
(7, 'Sports complex dirty', 'Sports complex dirty\r\nSports complex dirty\r\nSports complex dirty', 'NULL', 1, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 2, 0, '2015-04-10 23:19:39', '2015-10-29 16:57:26', '2'),
(8, 'Department toilets', 'Department toilets\r\nDepartment toilets\r\nDepartment toilets\r\nDepartment toilets', '4cir.png', 6, 8, 'Anonymous', 'NULL', 'NULL', -1, NULL, 0, 1, '2015-04-10 23:20:10', '2015-04-10 17:50:10', ''),
(9, 'department grievance 1', 'department grievance 1 description\r\ndepartment grievance 1 description\r\ndepartment grievance 1 description', 'cir1.jpg', 6, 15, 'Amar', '1rvjjis092', 'akhil@navikaran.com', 1, 15, 0, 1, '2015-04-10 23:21:02', '2015-04-10 17:51:02', ''),
(10, 'grievance 3', 'grievance 3 description\r\ngrievance 3 description\r\ngrievance 3 description', 'NULL', 6, 8, 'Anonymous', 'NULL', 'NULL', -1, NULL, 0, 1, '2015-04-10 23:21:46', '2015-04-10 17:51:46', ''),
(11, 'Falling sick of maintanence', '[asd \r\nads \r\nad as\r\nda d\r\nasd ', 'diagram-gif.gif', 1, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 2, 1, '2015-06-16 13:55:01', '2015-09-11 06:04:58', ''),
(16, 'HCI faculty problem', 'Prof XYZ taking HCi classes is not teaching us well.', 'NULL', 1, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 0, 1, '2015-11-25 12:26:40', '2015-11-25 06:56:40', '4'),
(17, 'Teaching quality not good', 'The teaching quality of ISE department is not good. Please request the teachers to give more practical knowledge.', 'NULL', 1, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 2, 0, '2015-11-25 12:28:28', '2015-12-02 09:15:56', '4'),
(18, 'faulty Cricket Kit ', 'the cricket kit provided by the sports department is faculty.Please look into the mattter.', 'NULL', 3, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 2, 0, '2015-11-25 12:29:24', '2015-11-25 07:00:29', '3'),
(19, 'Faculty related issues', 'faculty issues', 'Screenshot from 2015-08-21 20:20:33.png', 1, NULL, 'Anonymous', 'NULL', 'NULL', -1, NULL, 2, 0, '2015-12-02 14:58:26', '2015-12-02 09:32:13', '4');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `priv` int(11) NOT NULL COMMENT '1-admin 2-authority',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `priv`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 1),
(12, 'akhily02@gmail.com', 'ec2da3ad44ecbd2e3909224ec40ce3a3', 2),
(13, 'amarjassal434@gmail.com', 'd01b8c6ea1a64ba2510df7cee1e4d604', 2),
(14, 'asstise@ise.com', 'b98736e8efe02e4c612b02a2e8e5ed91', 2);

-- --------------------------------------------------------

--
-- Table structure for table `printletterhead`
--

CREATE TABLE IF NOT EXISTS `printletterhead` (
  `lhid` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(200) NOT NULL,
  `footer` varchar(200) NOT NULL,
  PRIMARY KEY (`lhid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `printletterhead`
--

INSERT INTO `printletterhead` (`lhid`, `header`, `footer`) VALUES
(1, 'R.V. College Of Engineering', 'RVCE 2015-2016'),
(2, 'RVCE ADMIN BLOCK', 'RV 2015-2016'),
(3, 'RVCE REPORT', 'RVCE 2015-2016'),
(4, 'RVCE REPORT FORMAT', 'RV 2015-2016'),
(5, 'RVCE\r\nBangalore-560059', 'RVCE 2015-2016');

-- --------------------------------------------------------

--
-- Table structure for table `redressal`
--

CREATE TABLE IF NOT EXISTS `redressal` (
  `redressal_id` int(11) NOT NULL AUTO_INCREMENT,
  `grievance_id` int(11) DEFAULT NULL,
  `redressal_description` longtext,
  `redressal_type` varchar(50) DEFAULT NULL,
  `redressal_committeeMember_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`redressal_id`),
  KEY `grievance_id` (`grievance_id`),
  KEY `redressal_committeeMember_id` (`redressal_committeeMember_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `redressal`
--

INSERT INTO `redressal` (`redressal_id`, `grievance_id`, `redressal_description`, `redressal_type`, `redressal_committeeMember_id`, `timestamp`) VALUES
(2, 7, 'ok\n', NULL, 13, '2015-04-10 17:59:00'),
(3, 6, 'it will be done', NULL, 13, '2015-04-10 17:59:16'),
(5, 11, 'Ok I will take care of it', NULL, 12, '2015-06-16 08:26:02'),
(6, 11, 'ASasS', NULL, 12, '2015-06-16 08:26:09'),
(7, 11, 'akhil\n', NULL, 12, '2015-06-26 12:40:47'),
(11, 18, 'Sorry for inconvenience.We will surely make all the proper arrangements.', NULL, 13, '2015-11-25 07:00:28'),
(12, 17, 'We are soon conducting a TEACHER-STUDENT meet .You can provide all the necessary suggestions in the meet.', NULL, 12, '2015-11-25 07:01:25'),
(13, 19, 'It has been taken in consideration', NULL, 12, '2015-12-02 09:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(250) NOT NULL,
  `sub_category_description` longtext NOT NULL,
  `category_id` varchar(250) NOT NULL,
  PRIMARY KEY (`sub_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category`, `sub_category_name`, `sub_category_description`, `category_id`) VALUES
(2, 'doubt', 'corrected again,,', '1'),
(3, 'Cricket', 'cricket category', '3'),
(4, 'Faculty problem', 'Problems related to faculty', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `committeemember`
--
ALTER TABLE `committeemember`
  ADD CONSTRAINT `COMMITTEEMEMBER_ibfk_1` FOREIGN KEY (`committeeMember_category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `COMMITTEEMEMBER_ibfk_2` FOREIGN KEY (`committeeMember_department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `grievance`
--
ALTER TABLE `grievance`
  ADD CONSTRAINT `GRIEVANCE_ibfk_1` FOREIGN KEY (`grievance_category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `GRIEVANCE_ibfk_2` FOREIGN KEY (`grievance_department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `GRIEVANCE_ibfk_3` FOREIGN KEY (`grievance_sender_department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `redressal`
--
ALTER TABLE `redressal`
  ADD CONSTRAINT `REDRESSAL_ibfk_1` FOREIGN KEY (`grievance_id`) REFERENCES `grievance` (`grievance_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `REDRESSAL_ibfk_2` FOREIGN KEY (`redressal_committeeMember_id`) REFERENCES `committeemember` (`committeeMember_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
