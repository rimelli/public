-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2021 at 12:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `individuals`
--

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coach` varchar(4) NOT NULL,
  `scout` varchar(4) NOT NULL,
  `agent` varchar(4) NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country_based` varchar(100) NOT NULL,
  `city_based` varchar(100) NOT NULL,
  `county_based` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individuals`
--

INSERT INTO `individuals` (`id`, `user_id`, `coach`, `scout`, `agent`, `birth`, `gender`, `country_based`, `city_based`, `county_based`) VALUES
(8, 34, 'yes', 'no', 'no', '0000-00-00', 'M', 'England', 'Wilmslow', 'Cheshire');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `job_category` varchar(50) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `job_sport` varchar(50) NOT NULL,
  `job_country` varchar(50) NOT NULL,
  `job_city` varchar(100) NOT NULL,
  `job_county` varchar(100) NOT NULL,
  `job_salary` varchar(50) NOT NULL,
  `job_salary_min` int(11) NOT NULL,
  `job_salary_max` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `employer_email` varchar(50) NOT NULL,
  `employer_website` varchar(50) NOT NULL,
  `job_post_date` date NOT NULL,
  `job_exp_date` date NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `job_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `job_title`, `job_position`, `job_category`, `job_type`, `job_sport`, `job_country`, `job_city`, `job_county`, `job_salary`, `job_salary_min`, `job_salary_max`, `job_description`, `employer_email`, `employer_website`, `job_post_date`, `job_exp_date`, `job_status`, `job_deleted`) VALUES
(1, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'Woodtown', 'Devon', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(2, 34, 'Coach', 'Head coach', 'Part time', 'Remote', 'Football', 'Northern ireland', 'Belfast', '', 'Hourly', 200, 400, '', '', '', '2021-08-17', '0000-00-00', '', 'no'),
(3, 34, 'Assistant', 'Assistant Coach', 'Part time', 'Both', 'Football', 'Northern Ireland', 'Belfast', '', 'Fixed', 370, 560, '', '', '', '2021-08-16', '0000-00-00', '', 'no'),
(4, 34, 'Trainer', 'Physical Trainer', 'Part Time', 'Remote', 'Football', 'Northern Ireland', 'Belfast', '', 'Hourly', 2000, 4000, '', '', '', '2021-08-19', '0000-00-00', '', 'no'),
(5, 34, 'Coach', 'Head Coach', 'Full Time', 'Onsite', 'Football', 'England', 'Leeds', '', 'Fixed', 250, 500, '', '', '', '2021-08-12', '0000-00-00', '', 'no'),
(6, 34, 'Coach', 'Head Coach', 'Full Time', 'Onsite', 'Football', 'England', 'Leeds', '', 'Fixed', 250, 500, '', '', '', '2021-08-12', '0000-00-00', '', 'no'),
(7, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(8, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(9, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(10, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(11, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(12, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(13, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(14, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(15, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(16, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(17, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(18, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(19, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(20, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(21, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(22, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(23, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(24, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(25, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(26, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(27, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(28, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(29, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(30, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(31, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(32, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(33, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(34, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(35, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(36, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(37, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(38, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(39, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(40, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(41, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(42, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(43, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(44, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(45, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(46, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(47, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(48, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(49, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(50, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(51, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(52, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(53, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(54, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', '0000-00-00', '', 'no'),
(55, 34, 'Test', 'Player', 'Full Time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 12, 24, 'teste', 'johnwill@gmail.com', '', '2021-10-13', '0000-00-00', 'pending', 'no'),
(56, 34, 'Teste', 'Assistant Coach', 'Part Time', 'Onsite', 'Football', 'England', 'London', '', 'Fixed', 20, 21, 'test', 'teste@gmail.com', '', '2021-10-15', '0000-00-00', 'pending', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_club` varchar(4) NOT NULL,
  `amateur_club` varchar(4) NOT NULL,
  `academy` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(87, 'teste', 34, 34, '2021-10-12 15:22:47', 'no', 'no', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `user_id`) VALUES
(5, 34);

-- --------------------------------------------------------

--
-- Table structure for table `uk_towns`
--

CREATE TABLE `uk_towns` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `county` varchar(32) DEFAULT NULL,
  `country` varchar(16) DEFAULT NULL,
  `grid_reference` varchar(8) DEFAULT NULL,
  `easting` int(11) DEFAULT NULL,
  `northing` int(11) DEFAULT NULL,
  `latitude` decimal(8,5) DEFAULT NULL,
  `longitude` decimal(8,5) DEFAULT NULL,
  `elevation` int(11) DEFAULT NULL,
  `postcode_sector` varchar(6) DEFAULT NULL,
  `local_government_area` varchar(44) DEFAULT NULL,
  `nuts_region` varchar(24) DEFAULT NULL,
  `type` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uk_towns`
--

INSERT INTO `uk_towns` (`id`, `name`, `county`, `country`, `grid_reference`, `easting`, `northing`, `latitude`, `longitude`, `elevation`, `postcode_sector`, `local_government_area`, `nuts_region`, `type`) VALUES
(48501, 'Woodtown', 'Devon', 'England', 'SS490259', 249000, 125947, '51.01303', '-4.15395', 101, 'EX39 4', 'Torridge District', 'South West', 'Hamlet'),
(48502, 'Woodtown', 'Devon', 'England', 'SS413235', 241368, 123558, '50.98950', '-4.26161', 85, 'EX39 5', 'Torridge District', 'South West', 'Hamlet'),
(48503, 'Woodvale', 'Merseyside', 'England', 'SD309111', 330930, 411135, '53.59222', '-3.04499', 10, 'PR8 3', 'Sefton District', 'North West', 'Suburban Area'),
(48504, 'Woodville', 'Cumbria', 'England', 'NY352518', 335295, 551895, '54.85764', '-3.00946', 55, 'CA5 6', 'Carlisle District', 'North West', 'Village'),
(48505, 'Woodville', 'Derbyshire', 'England', 'SK317189', 431729, 318949, '52.76721', '-1.53119', 149, 'DE11 7', 'South Derbyshire District', 'East Midlands', 'Village'),
(48506, 'Woodville', 'Dorset', 'England', 'ST803215', 380303, 121556, '50.99306', '-2.28203', 86, 'SP8 5', 'Dorset', 'South West', 'Hamlet'),
(48507, 'Woodville Feus', 'Angus', 'Scotland', 'NO605435', 360500, 743500, '56.58176', '-2.64463', 72, 'DD11 3', 'Angus', 'Scotland', 'Locality'),
(48508, 'Woodville Terrace', 'City of Edinburgh', 'Scotland', 'NT274754', 327464, 675420, '55.96628', '-3.16360', 25, 'EH6 8', 'City of Edinburgh', 'Scotland', 'Locality'),
(48509, 'Woodwall Green', 'Staffordshire', 'England', 'SJ785315', 378500, 331500, '52.88053', '-2.32092', 161, 'ST21 6', 'Stafford District', 'West Midlands', 'Locality'),
(48510, 'Wood Walton', 'Cambridgeshire', 'England', 'TL214808', 521412, 280885, '52.41250', '-0.21640', 18, 'PE28 5', 'Huntingdonshire District', 'Eastern', 'Village'),
(48511, 'Woodway', 'Oxfordshire', 'England', 'SU531841', 453183, 184181, '51.55402', '-1.23432', 147, 'OX11 9', 'Vale of White Horse District', 'South East', 'Hamlet'),
(48512, 'Woodway Park', 'West Midlands', 'England', 'SP379819', 437971, 281904, '52.43380', '-1.44292', 89, 'CV2 2', 'Coventry District', 'West Midlands', 'Suburban Area'),
(48513, 'Woodwell', 'Northamptonshire', 'England', 'SP955775', 495500, 277500, '52.38721', '-0.59819', 67, 'NN14 4', 'North Northamptonshire', 'East Midlands', 'Locality'),
(48514, 'Woodwick', 'Orkney', 'Scotland', 'HY383240', 338343, 1024011, '59.09850', '-3.07800', 22, 'KW17 2', 'Orkney Islands', 'Scotland', 'Suburban Area'),
(48515, 'Wood Willows', 'South Yorkshire', 'England', 'SK278982', 427867, 398259, '53.48032', '-1.58156', 176, 'S36 2', 'Sheffield District', 'Yorkshire and the Humber', 'Suburban Area'),
(48516, 'Woodworth Green', 'Cheshire', 'England', 'SJ576576', 357639, 357636, '53.11421', '-2.63432', 63, 'CW6 9', 'Cheshire East', 'North West', 'Hamlet'),
(48517, 'Woodyates', 'Dorset', 'England', 'SU028193', 402899, 119345, '50.97351', '-1.96008', 117, 'SP5 5', 'Dorset', 'South West', 'Village'),
(48518, 'Woody Bay', 'Devon', 'England', 'SS675495', 267500, 149500, '51.22926', '-3.89905', 35, 'EX31 4', 'North Devon District', 'South West', 'Locality'),
(48519, 'Woofferton', 'Shropshire', 'England', 'SO520684', 352005, 268488, '52.31239', '-2.70544', 76, 'SY8 4', 'Shropshire', 'West Midlands', 'Hamlet'),
(48520, 'Wookey', 'Somerset', 'England', 'ST518458', 351817, 145837, '51.20969', '-2.69114', 27, 'BA5 1', 'Mendip District', 'South West', 'Village'),
(48521, 'Wookey Hole', 'Somerset', 'England', 'ST532473', 353278, 147389, '51.22377', '-2.67043', 60, 'BA5 1', 'Mendip District', 'South West', 'Village'),
(48522, 'Wool', 'Dorset', 'England', 'SY846866', 384639, 86656, '50.67936', '-2.21877', 19, 'BH20 6', 'Dorset', 'South West', 'Village'),
(48523, 'Woolacombe', 'Devon', 'England', 'SS458437', 245882, 143758, '51.17224', '-4.20597', 24, 'EX34 7', 'North Devon District', 'South West', 'Village'),
(48524, 'Woolage Green', 'Kent', 'England', 'TR237492', 623720, 149254, '51.19868', '1.20085', 96, 'CT4 6', 'Canterbury District', 'South East', 'Village'),
(48525, 'Woolage Village', 'Kent', 'England', 'TR235501', 623572, 150120, '51.20651', '1.19927', 96, 'CT4 6', 'Canterbury District', 'South East', 'Village'),
(48526, 'Woolaston', 'Gloucestershire', 'England', 'SO594003', 359457, 200330, '51.70024', '-2.58804', 45, 'GL15 6', 'Forest of Dean District', 'South West', 'Village'),
(48527, 'Woolaston Common', 'Gloucestershire', 'England', 'SO585015', 358500, 201500, '51.71069', '-2.60203', 56, 'GL15 6', 'Forest of Dean District', 'South West', 'Locality'),
(48528, 'Woolaston Slade', 'Gloucestershire', 'England', 'SO575005', 357500, 200500, '51.70162', '-2.61638', 126, 'GL15 6', 'Forest of Dean District', 'South West', 'Locality'),
(48529, 'Woolaston Woodside', 'Gloucestershire', 'England', 'SO580010', 358040, 201091, '51.70698', '-2.60864', 97, 'GL15 6', 'Forest of Dean District', 'South West', 'Suburban Area'),
(48530, 'Woolavington', 'Somerset', 'England', 'ST347416', 334770, 141624, '51.17012', '-2.93438', 16, 'TA7 8', 'Sedgemoor District', 'South West', 'Village'),
(48531, 'Woolbeding', 'West Sussex', 'England', 'SU872228', 487251, 122836, '50.99831', '-0.75801', 37, 'GU29 9', 'Chichester District', 'South East', 'Hamlet'),
(48532, 'Woolbridge', 'East Sussex', 'England', 'TQ571266', 557151, 126672, '51.01795', '0.23913', 82, 'TN20 6', 'Wealden District', 'South East', 'Hamlet'),
(48533, 'Woolcombe', 'Dorset', 'England', 'ST602053', 360262, 105351, '50.84631', '-2.56580', 98, 'DT2 0', 'Dorset', 'South West', 'Hamlet'),
(48534, 'Woolcotts', 'Somerset', 'England', 'SS966315', 296617, 131522, '51.07368', '-3.47704', 265, 'TA22 9', 'Somerset West and Taunton District', 'South West', 'Hamlet'),
(48535, 'Wooldale', 'West Yorkshire', 'England', 'SE153088', 415322, 408837, '53.57591', '-1.77008', 209, 'HD9 1', 'Kirklees District', 'Yorkshire and the Humber', 'Village'),
(48536, 'Wooler', 'Northumberland', 'England', 'NT990280', 399072, 628094, '55.54655', '-2.01626', 126, 'NE71 6', 'Northumberland', 'North East', 'Town'),
(48537, 'Wooley', 'Northumberland', 'England', 'NY828544', 382800, 554475, '54.88473', '-2.26963', 283, 'NE47 9', 'Northumberland', 'North East', 'Hamlet'),
(48538, 'Wooley', 'Northumberland', 'England', 'NY967595', 396743, 559511, '54.93027', '-2.05236', 152, 'NE46 1', 'Northumberland', 'North East', 'Hamlet'),
(48539, 'Woolfall', 'Cheshire', 'England', 'SJ678450', 367872, 345018, '53.00151', '-2.48019', 74, 'CW3 0', 'Cheshire East', 'North West', 'Hamlet'),
(48540, 'Woolfall Heath', 'Merseyside', 'England', 'SJ432927', 343237, 392722, '53.42822', '-2.85574', 28, 'L36 3', 'Knowsley District', 'North West', 'Suburban Area'),
(48541, 'Woolfardisworthy', 'Devon', 'England', 'SS828086', 282859, 108683, '50.86575', '-3.66597', 143, 'EX17 4', 'Mid Devon District', 'South West', 'Hamlet'),
(48542, 'Woolfardisworthy', 'Devon', 'England', 'SS332210', 233207, 121039, '50.96456', '-4.37663', 177, 'EX39 5', 'Torridge District', 'South West', 'Village'),
(48543, 'Woolfold', 'Greater Manchester', 'England', 'SD788118', 378838, 411818, '53.60249', '-2.32127', 112, 'BL8 1', 'Bury District', 'North West', 'Suburban Area'),
(48544, 'Woolfords Cotts', 'Lanarkshire', 'Scotland', 'NT005575', 300500, 657500, '55.80050', '-3.58881', 272, 'EH55 8', 'South Lanarkshire', 'Scotland', 'Locality'),
(48545, 'Woolford\'s Water', 'Dorset', 'England', 'ST693053', 369335, 105301, '50.84641', '-2.43693', 128, 'DT2 7', 'Dorset', 'South West', 'Village'),
(48546, 'Woolgarston', 'Dorset', 'England', 'SY986813', 398640, 81393, '50.63223', '-2.02059', 106, 'BH20 5', 'Dorset', 'South West', 'Hamlet'),
(48547, 'Woolgreaves', 'West Yorkshire', 'England', 'SE337168', 433751, 416820, '53.64680', '-1.49091', 42, 'WF2 6', 'Wakefield District', 'Yorkshire and the Humber', 'Suburban Area'),
(48548, 'Woolhampton', 'Berkshire', 'England', 'SU572669', 457273, 166905, '51.39830', '-1.17813', 66, 'RG7 5', 'West Berkshire', 'South East', 'Village'),
(48549, 'Woolhope', 'Herefordshire', 'England', 'SO607361', 360733, 236104, '52.02196', '-2.57366', 152, 'HR1 4', 'County of Herefordshire', 'West Midlands', 'Village'),
(48550, 'Woolhope Cockshoot', 'Herefordshire', 'England', 'SO630371', 363080, 237172, '52.03172', '-2.53957', 183, 'HR8 2', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48551, 'Woolland', 'Dorset', 'England', 'ST778072', 377812, 107292, '50.86470', '-2.31665', 105, 'DT11 0', 'Dorset', 'South West', 'Village'),
(48552, 'Woollard', 'Somerset', 'England', 'ST631645', 363196, 164506, '51.37840', '-2.53019', 31, 'BS39 4', 'Bath and North East Somerset', 'South West', 'Village'),
(48553, 'Woollaston', 'Staffordshire', 'England', 'SJ865155', 386500, 315500, '52.73696', '-2.20138', 91, 'ST20 0', 'Stafford District', 'West Midlands', 'Locality'),
(48554, 'Woollaton', 'Devon', 'England', 'SS474129', 247460, 112916, '50.89552', '-4.17042', 140, 'EX38 8', 'Torridge District', 'South West', 'Hamlet'),
(48555, 'Woollensbrook', 'Hertfordshire', 'England', 'TL365105', 536500, 210500, '51.77653', '-0.02287', 70, 'SG13 7', 'East Hertfordshire District', 'Eastern', 'Locality'),
(48556, 'Woolley', 'Cambridgeshire', 'England', 'TL150745', 515028, 274511, '52.35660', '-0.31240', 30, 'PE28 5', 'Huntingdonshire District', 'Eastern', 'Hamlet'),
(48557, 'Woolley', 'Cornwall', 'England', 'SS254166', 225431, 116680, '50.92310', '-4.48517', 201, 'EX23 9', 'Cornwall', 'South West', 'Hamlet'),
(48558, 'Woolley', 'Derbyshire', 'England', 'SK368607', 436864, 360774, '53.14284', '-1.45034', 127, 'DE55 6', 'North East Derbyshire District', 'East Midlands', 'Hamlet'),
(48559, 'Woolley', 'Somerset', 'England', 'ST748685', 374844, 168510, '51.41504', '-2.36312', 95, 'BA1 8', 'Bath and North East Somerset', 'South West', 'Hamlet'),
(48560, 'Woolley', 'West Yorkshire', 'England', 'SE322130', 432224, 413083, '53.61331', '-1.51439', 118, 'WF4 2', 'Wakefield District', 'Yorkshire and the Humber', 'Village'),
(48561, 'Woolley', 'Wiltshire', 'England', 'ST833612', 383314, 161237, '51.34996', '-2.24098', 67, 'BA15 1', 'Wiltshire', 'South West', 'Suburban Area'),
(48562, 'Woolley Bridge', 'Greater Manchester', 'England', 'SK005955', 400500, 395500, '53.45625', '-1.99394', 128, 'SK14 8', 'Tameside District', 'North West', 'Locality'),
(48563, 'Woolley Grange', 'West Yorkshire', 'England', 'SE311111', 431101, 411168, '53.59617', '-1.53156', 96, 'S75 5', 'Wakefield District', 'Yorkshire and the Humber', 'Village'),
(48564, 'Woolley Green', 'Berkshire', 'England', 'SU850797', 485067, 179739, '51.51019', '-0.77561', 46, 'SL6 3', 'Windsor and Maidenhead', 'South East', 'Village'),
(48565, 'Woolley Green', 'Wiltshire', 'England', 'ST837616', 383785, 161631, '51.35352', '-2.23424', 67, 'BA15 1', 'Wiltshire', 'South West', 'Hamlet'),
(48566, 'Woolley Moor', 'Derbyshire', 'England', 'SK371613', 437145, 361358, '53.14807', '-1.44608', 138, 'DE55 6', 'North East Derbyshire District', 'East Midlands', 'Village'),
(48567, 'Woolmere Green', 'Worcestershire', 'England', 'SO965625', 396500, 262500, '52.26065', '-2.05270', 86, 'B60 4', 'Wychavon District', 'West Midlands', 'Locality'),
(48568, 'Woolmer Green', 'Hertfordshire', 'England', 'TL254184', 525422, 218492, '51.85094', '-0.18047', 98, 'SG3 6', 'Welwyn Hatfield District', 'Eastern', 'Village'),
(48569, 'Woolmer Hill', 'Surrey', 'England', 'SU877331', 487701, 133156, '51.09102', '-0.74910', 187, 'GU27 1', 'Waverley District', 'South East', 'Suburban Area'),
(48570, 'Woolmersdon', 'Somerset', 'England', 'ST282339', 328213, 133920, '51.10007', '-3.02662', 19, 'TA5 2', 'Sedgemoor District', 'South West', 'Hamlet'),
(48571, 'Woolminstone', 'Somerset', 'England', 'ST411079', 341112, 107901, '50.86760', '-2.83820', 132, 'TA18 8', 'South Somerset District', 'South West', 'Hamlet'),
(48572, 'Woolpack Corner', 'Kent', 'England', 'TQ851373', 585170, 137345, '51.10549', '0.64364', 65, 'TN27 8', 'Ashford District', 'South East', 'Village'),
(48573, 'Woolpit', 'Suffolk', 'England', 'TL973624', 597367, 262422, '52.22463', '0.88824', 63, 'IP30 9', 'Mid Suffolk District', 'Eastern', 'Village'),
(48574, 'Woolpit Green', 'Suffolk', 'England', 'TL976615', 597675, 261565, '52.21682', '0.89224', 68, 'IP30 9', 'Mid Suffolk District', 'Eastern', 'Village'),
(48575, 'Woolpit Heath', 'Suffolk', 'England', 'TL984615', 598440, 261507, '52.21603', '0.90339', 62, 'IP30 9', 'Mid Suffolk District', 'Eastern', 'Village'),
(48576, 'Woolridge', 'Gloucestershire', 'England', 'SO804236', 380487, 223677, '51.91128', '-2.28508', 82, 'GL19 3', 'Forest of Dean District', 'South West', 'Hamlet'),
(48577, 'Woolroad', 'Greater Manchester', 'England', 'SD994067', 399402, 406762, '53.55748', '-2.01050', 232, 'OL3 5', 'Oldham District', 'North West', 'Suburban Area'),
(48578, 'Woolrooms', 'Leicestershire', 'England', 'SK406177', 440672, 317792, '52.75621', '-1.39880', 102, 'LE67 8', 'North West Leicestershire District', 'East Midlands', 'Suburban Area'),
(48579, 'Woolsbridge', 'Dorset', 'England', 'SU096050', 409635, 105052, '50.84491', '-1.86452', 21, 'BH21 6', 'Dorset', 'South West', 'Suburban Area'),
(48580, 'Woolscott', 'Warwickshire', 'England', 'SP498679', 449829, 267980, '52.30768', '-1.27058', 101, 'CV23 8', 'Rugby District', 'West Midlands', 'Locality'),
(48581, 'Woolsgrove', 'Devon', 'England', 'SS795025', 279500, 102500, '50.80948', '-3.71164', 109, 'EX17 4', 'Mid Devon District', 'South West', 'Locality'),
(48582, 'Woolsington', 'Tyne and Wear', 'England', 'NZ196699', 419612, 569985, '55.02402', '-1.69477', 68, 'NE13 8', 'Newcastle upon Tyne District', 'North East', 'Village'),
(48583, 'Woolstanwood', 'Cheshire', 'England', 'SJ680559', 368074, 355936, '53.09966', '-2.47826', 50, 'CW2 8', 'Cheshire East', 'North West', 'Suburban Area'),
(48584, 'Woolstaston', 'Shropshire', 'England', 'SO452983', 345222, 298368, '52.58035', '-2.80984', 248, 'SY6 6', 'Shropshire', 'West Midlands', 'Hamlet'),
(48585, 'Woolsthorpe by Belvoir', 'Lincolnshire', 'England', 'SK838343', 483856, 334305, '52.89966', '-0.75482', 69, 'NG32 1', 'South Kesteven District', 'East Midlands', 'Village'),
(48586, 'Woolsthorpe-by-Colsterworth', 'Lincolnshire', 'England', 'SK922245', 492275, 324514, '52.81029', '-0.63247', 114, 'NG33 5', 'South Kesteven District', 'East Midlands', 'Village'),
(48587, 'Woolston', 'Cheshire', 'England', 'SJ645895', 364544, 389552, '53.40159', '-2.53474', 16, 'WA1 4', 'Warrington', 'North West', 'Suburban Area'),
(48588, 'Woolston', 'Devon', 'England', 'SX716416', 271674, 41662, '50.26096', '-3.80170', 58, 'TQ7 3', 'South Hams District', 'South West', 'Hamlet'),
(48589, 'Woolston', 'Hampshire', 'England', 'SU438111', 443800, 111189, '50.89852', '-1.37854', 13, 'SO19 7', 'City of Southampton', 'South East', 'Suburban Area'),
(48590, 'Woolston', 'Shropshire', 'England', 'SJ322242', 332264, 324299, '52.81196', '-3.00639', 76, 'SY10 8', 'Shropshire', 'West Midlands', 'Hamlet'),
(48591, 'Woolston', 'Shropshire', 'England', 'SO424872', 342430, 287225, '52.47990', '-2.84910', 224, 'SY6 6', 'Shropshire', 'West Midlands', 'Hamlet'),
(48592, 'Woolston', 'Somerset', 'England', 'ST652278', 365240, 127867, '51.04909', '-2.49726', 99, 'BA22 7', 'South Somerset District', 'South West', 'Hamlet'),
(48593, 'Woolston', 'Somerset', 'England', 'ST096398', 309617, 139872, '51.15094', '-3.29363', 43, 'TA4 4', 'Somerset West and Taunton District', 'South West', 'Hamlet'),
(48594, 'Woolstone', 'Buckinghamshire', 'England', 'SP874388', 487438, 238870, '52.04134', '-0.72658', 66, 'MK15 0', 'Milton Keynes', 'South East', 'Suburban Area'),
(48595, 'Woolstone', 'Gloucestershire', 'England', 'SO957302', 395760, 230263, '51.97082', '-2.06313', 45, 'GL52 9', 'Tewkesbury District', 'South West', 'Hamlet'),
(48596, 'Woolstone', 'Oxfordshire', 'England', 'SU293878', 429371, 187819, '51.58846', '-1.57745', 101, 'SN7 7', 'Vale of White Horse District', 'South East', 'Village'),
(48597, 'Woolston Green', 'Devon', 'England', 'SX777661', 277719, 66163, '50.48249', '-3.72490', 56, 'TQ13 7', 'South Hams District', 'South West', 'Village'),
(48598, 'Woolton', 'Merseyside', 'England', 'SJ422867', 342263, 386730, '53.37426', '-2.86930', 61, 'L25 7', 'Liverpool District', 'North West', 'Suburban Area'),
(48599, 'Woolton Hill', 'Hampshire', 'England', 'SU430617', 443000, 161717, '51.35291', '-1.38391', 131, 'RG20 9', 'Basingstoke and Deane District', 'South East', 'Village'),
(48600, 'Woolvers Hill', 'Somerset', 'England', 'ST385605', 338500, 160500, '51.34024', '-2.88429', 25, 'BS29 6', 'North Somerset', 'South West', 'Locality'),
(48601, 'Woolvershill Batch', 'Somerset', 'England', 'ST382605', 338282, 160531, '51.34050', '-2.88742', 25, 'BS29 6', 'North Somerset', 'South West', 'Hamlet'),
(48602, 'Woolverstone', 'Suffolk', 'England', 'TM187383', 618776, 238301, '52.00002', '1.18570', 34, 'IP9 1', 'Babergh District', 'Eastern', 'Village'),
(48603, 'Woolverton', 'Somerset', 'England', 'ST792540', 379229, 154023, '51.28496', '-2.29922', 61, 'BA2 7', 'Mendip District', 'South West', 'Village'),
(48604, 'Woolwell', 'Devon', 'England', 'SX505615', 250546, 61517, '50.43443', '-4.10580', 159, 'PL6 7', 'South Hams District', 'South West', 'Suburban Area'),
(48605, 'Woolwich', 'Greater London', 'England', 'TQ433788', 543354, 178854, '51.49047', '0.06346', 18, 'SE18 6', 'Greenwich', 'London', 'Locality'),
(48606, 'Woon', 'Cornwall', 'England', 'SX005595', 200500, 59500, '50.40143', '-4.80863', 153, 'PL26 8', 'Cornwall', 'South West', 'Locality'),
(48607, 'Woonton', 'Herefordshire', 'England', 'SO550617', 355033, 261759, '52.25216', '-2.66012', 176, 'HR6 0', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48608, 'Woonton', 'Herefordshire', 'England', 'SO351521', 335125, 252107, '52.16340', '-2.94986', 128, 'HR3 6', 'County of Herefordshire', 'West Midlands', 'Village'),
(48609, 'Woonton Ash', 'Herefordshire', 'England', 'SO348544', 334881, 254424, '52.18420', '-2.95387', 160, 'HR5 3', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48610, 'Wooperton', 'Northumberland', 'England', 'NU043205', 404370, 620526, '55.47853', '-1.93242', 83, 'NE66 4', 'Northumberland', 'North East', 'Hamlet'),
(48611, 'Wooplaw', 'Roxburgh, Ettrick and Lauderdale', 'Scotland', 'NT495425', 349500, 642500, '55.67336', '-2.80450', 307, 'TD1 2', 'Scottish Borders', 'Scotland', 'Locality'),
(48612, 'Woore', 'Shropshire', 'England', 'SJ737423', 373722, 342336, '52.97772', '-2.39280', 137, 'CW3 9', 'Shropshire', 'West Midlands', 'Village'),
(48613, 'Woose Hill', 'Berkshire', 'England', 'SU791686', 479196, 168670, '51.41153', '-0.86267', 55, 'RG41 3', 'Wokingham', 'South East', 'Suburban Area'),
(48614, 'Wooten Hall', 'Somerset', 'England', 'ST581541', 358199, 154113, '51.28461', '-2.60076', 150, 'BA3 4', 'Mendip District', 'South West', 'Locality'),
(48615, 'Wooth', 'Dorset', 'England', 'SY471953', 347165, 95386, '50.75565', '-2.75038', 45, 'DT6 5', 'Dorset', 'South West', 'Hamlet'),
(48616, 'Wooton', 'Shropshire', 'England', 'SO575735', 357500, 273500, '52.35790', '-2.62548', 170, 'SY8 3', 'Shropshire', 'West Midlands', 'Locality'),
(48617, 'Wootten Green', 'Suffolk', 'England', 'TM234728', 623425, 272869, '52.30845', '1.27603', 59, 'IP21 5', 'Mid Suffolk District', 'Eastern', 'Hamlet'),
(48618, 'Wootton', 'Bedfordshire', 'England', 'TL009453', 500963, 245354, '52.09732', '-0.52754', 39, 'MK43 9', 'Bedford', 'Eastern', 'Village'),
(48619, 'Wootton', 'Hampshire', 'England', 'SZ236986', 423659, 98611, '50.78659', '-1.66574', 63, 'BH25 5', 'New Forest District', 'South East', 'Village'),
(48620, 'Wootton', 'Herefordshire', 'England', 'SO487486', 348728, 248633, '52.13361', '-2.75049', 70, 'HR4 8', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48621, 'Wootton', 'Isle of Wight', 'England', 'SZ543919', 454395, 91999, '50.72507', '-1.23073', 7, 'PO33 4', 'Isle of Wight', 'South East', 'Village'),
(48622, 'Wootton', 'Kent', 'England', 'TR223464', 622341, 146422, '51.17379', '1.17939', 134, 'CT4 6', 'Dover District', 'South East', 'Village'),
(48623, 'Wootton', 'Lincolnshire', 'England', 'TA089160', 508922, 416036, '53.62953', '-0.35437', 41, 'DN39 6', 'North Lincolnshire', 'Yorkshire and the Humber', 'Village'),
(48624, 'Wootton', 'Northamptonshire', 'England', 'SP763568', 476397, 256844, '52.20454', '-0.88349', 100, 'NN4 6', 'West Northamptonshire', 'East Midlands', 'Suburban Area'),
(48625, 'Wootton', 'Oxfordshire', 'England', 'SP438200', 443812, 220086, '51.87763', '-1.36497', 113, 'OX20 1', 'West Oxfordshire District', 'South East', 'Village'),
(48626, 'Wootton', 'Oxfordshire', 'England', 'SP474011', 447451, 201103, '51.70667', '-1.31470', 96, 'OX1 5', 'Vale of White Horse District', 'South East', 'Village'),
(48627, 'Wootton', 'Shropshire', 'England', 'SJ337274', 333749, 327428, '52.84027', '-2.98500', 90, 'SY11 4', 'Shropshire', 'West Midlands', 'Hamlet'),
(48628, 'Wootton', 'Shropshire', 'England', 'SO457783', 345761, 278372, '52.40066', '-2.79862', 104, 'SY7 9', 'Shropshire', 'West Midlands', 'Locality'),
(48629, 'Wootton', 'Shropshire', 'England', 'SO770891', 377014, 289192, '52.50014', '-2.34003', 81, 'WV15 6', 'Shropshire', 'West Midlands', 'Locality'),
(48630, 'Wootton', 'Staffordshire', 'England', 'SJ825274', 382564, 327421, '52.84401', '-2.26031', 134, 'ST21 6', 'Stafford District', 'West Midlands', 'Locality'),
(48631, 'Wootton', 'Staffordshire', 'England', 'SK105449', 410554, 344969, '53.00194', '-1.84418', 206, 'DE6 2', 'East Staffordshire District', 'West Midlands', 'Village'),
(48632, 'Wootton Bourne End', 'Bedfordshire', 'England', 'SP985455', 498500, 245500, '52.09908', '-0.56344', 86, 'MK43 9', 'Bedford', 'Eastern', 'Locality'),
(48633, 'Wootton Bridge', 'Isle of Wight', 'England', 'SZ546919', 454643, 91980, '50.72488', '-1.22722', 7, 'PO33 4', 'Isle of Wight', 'South East', 'Suburban Area'),
(48634, 'Wootton Broadmead', 'Bedfordshire', 'England', 'TL025435', 502500, 243500, '52.08038', '-0.50567', 35, 'MK43 9', 'Bedford', 'Eastern', 'Locality'),
(48635, 'Wootton Common', 'Isle of Wight', 'England', 'SZ534911', 453415, 91116, '50.71723', '-1.24474', 53, 'PO33 4', 'Isle of Wight', 'South East', 'Suburban Area'),
(48636, 'Wootton Courtenay', 'Somerset', 'England', 'SS938433', 293825, 143381, '51.17977', '-3.52037', 125, 'TA24 8', 'Somerset West and Taunton District', 'South West', 'Village'),
(48637, 'Wootton Fitzpaine', 'Dorset', 'England', 'SY363954', 336371, 95445, '50.75510', '-2.90340', 37, 'DT6 6', 'Dorset', 'South West', 'Village'),
(48638, 'Wootton Green', 'Bedfordshire', 'England', 'SP997435', 499789, 243594, '52.08172', '-0.54519', 50, 'MK43 9', 'Bedford', 'Eastern', 'Hamlet'),
(48639, 'Wootton Green', 'West Midlands', 'England', 'SP232783', 423262, 278393, '52.40306', '-1.65951', 112, 'CV7 7', 'Solihull District', 'West Midlands', 'Hamlet'),
(48640, 'Wootton Rivers', 'Wiltshire', 'England', 'SU198628', 419886, 162829, '51.36418', '-1.71575', 134, 'SN8 4', 'Wiltshire', 'South West', 'Village'),
(48641, 'Woottons', 'Staffordshire', 'England', 'SK075388', 407592, 338842, '52.94691', '-1.88846', 109, 'ST14 5', 'East Staffordshire District', 'West Midlands', 'Hamlet'),
(48642, 'Wootton St Lawrence', 'Hampshire', 'England', 'SU591533', 459198, 153342, '51.27616', '-1.15271', 122, 'RG23 8', 'Basingstoke and Deane District', 'South East', 'Village'),
(48643, 'Wootton Village', 'Oxfordshire', 'England', 'SP476017', 447693, 201746, '51.71243', '-1.31111', 107, 'OX1 5', 'Vale of White Horse District', 'South East', 'Suburban Area'),
(48644, 'Wootton Wawen', 'Warwickshire', 'England', 'SP151632', 415160, 263241, '52.26712', '-1.77927', 63, 'B95 6', 'Stratford-on-Avon District', 'West Midlands', 'Village'),
(48645, 'Worbarrow', 'Dorset', 'England', 'SY875795', 387500, 79500, '50.61507', '-2.17804', 44, 'BH20 5', 'Dorset', 'South West', 'Locality'),
(48646, 'Worcester', 'Worcestershire', 'England', 'SO849549', 384984, 254989, '52.19293', '-2.22109', 29, 'WR1 3', 'Worcester District', 'West Midlands', 'City'),
(48647, 'Worcester Park', 'Greater London', 'England', 'TQ221660', 522167, 166099, '51.38080', '-0.24595', 23, 'KT4 7', 'Kingston upon Thames', 'London', 'Suburban Area'),
(48648, 'Worcester Park', 'Surrey', 'England', 'TQ219654', 521977, 165452, '51.37503', '-0.24890', 27, 'KT4 7', 'Epsom and Ewell District', 'South East', 'Village'),
(48649, 'Worden', 'Lancashire', 'England', 'SD562207', 356249, 420719, '53.68109', '-2.66386', 64, 'PR7 7', 'Chorley District', 'North West', 'Village'),
(48650, 'Wordsley', 'West Midlands', 'England', 'SO890869', 389000, 286983, '52.48066', '-2.16340', 86, 'DY8 5', 'Dudley District', 'West Midlands', 'Suburban Area'),
(48651, 'Wordsworth Terrace', 'Cumbria', 'England', 'NY124304', 312492, 530452, '54.66153', '-3.35811', 64, 'CA13 9', 'Allerdale District', 'North West', 'Locality'),
(48652, 'Wordwell', 'Suffolk', 'England', 'TL828719', 582845, 271997, '52.31562', '0.68107', 31, 'IP28 6', 'West Suffolk District', 'Eastern', 'Hamlet'),
(48653, 'Worfield', 'Shropshire', 'England', 'SO757958', 375752, 295816, '52.55963', '-2.35911', 67, 'WV15 5', 'Shropshire', 'West Midlands', 'Village'),
(48654, 'Worgret', 'Dorset', 'England', 'SY903870', 390341, 87022, '50.68277', '-2.13808', 32, 'BH20 6', 'Dorset', 'South West', 'Village'),
(48655, 'Workhouse Common', 'Norfolk', 'England', 'TM029947', 602975, 294746, '52.51279', '0.98977', 30, 'NR17 1', 'Breckland District', 'Eastern', 'Hamlet'),
(48656, 'Workhouse Common', 'Norfolk', 'England', 'TG348202', 634897, 320201, '52.72840', '1.47740', 4, 'NR12 8', 'North Norfolk District', 'Eastern', 'Village'),
(48657, 'Workhouse End', 'Bedfordshire', 'England', 'TL101523', 510140, 252365, '52.15858', '-0.39136', 48, 'MK41 0', 'Bedford', 'Eastern', 'Village'),
(48658, 'Workhouse Green', 'Suffolk', 'England', 'TL900373', 590095, 237398, '52.00247', '0.76794', 65, 'CO10 0', 'Babergh District', 'Eastern', 'Village'),
(48659, 'Workhouse Hill', 'Essex', 'England', 'TL994320', 599432, 232007, '51.95079', '0.90065', 43, 'CO4 5', 'Colchester District', 'Eastern', 'Village'),
(48660, 'Workington', 'Cumbria', 'England', 'NY001286', 300111, 528687, '54.64337', '-3.54937', 17, 'CA14 2', 'Allerdale District', 'North West', 'Town'),
(48661, 'Worksop', 'Nottinghamshire', 'England', 'SK585792', 458548, 379270, '53.30715', '-1.12282', 39, 'S80 1', 'Bassetlaw District', 'East Midlands', 'Town'),
(48662, 'Worlaby', 'Lincolnshire', 'England', 'TF339770', 533994, 377000, '53.27306', '0.00792', 71, 'LN11 8', 'East Lindsey District', 'East Midlands', 'Hamlet'),
(48663, 'Worlaby', 'Lincolnshire', 'England', 'TA012137', 501253, 413769, '53.61070', '-0.47103', 19, 'DN20 0', 'North Lincolnshire', 'Yorkshire and the Humber', 'Village'),
(48664, 'Worldsend', 'Shropshire', 'England', 'SO451934', 345176, 293453, '52.53617', '-2.80970', 194, 'SY6 6', 'Shropshire', 'West Midlands', 'Suburban Area'),
(48665, 'World\'s End', 'Berkshire', 'England', 'SU486765', 448662, 176563, '51.48593', '-1.30057', 155, 'RG20 8', 'West Berkshire', 'South East', 'Village'),
(48666, 'World\'s End', 'Buckinghamshire', 'England', 'SP859092', 485927, 209224, '51.77510', '-0.75599', 113, 'HP22 6', 'Buckinghamshire', 'South East', 'Hamlet'),
(48667, 'World\'s End', 'Greater London', 'England', 'TQ308967', 530819, 196737, '51.65421', '-0.11033', 40, 'EN2 7', 'Enfield', 'London', 'Suburban Area'),
(48668, 'World\'s End', 'West Sussex', 'England', 'TQ324201', 532496, 120166, '50.96569', '-0.11452', 38, 'RH15 0', 'Mid Sussex District', 'South East', 'Suburban Area'),
(48669, 'Worlds End', 'Hampshire', 'England', 'SU629117', 462913, 111798, '50.90224', '-1.10668', 32, 'PO7 4', 'Winchester District', 'South East', 'Hamlet'),
(48670, 'Worlds End', 'Worcestershire', 'England', 'SO814597', 381473, 259777, '52.23587', '-2.27271', 47, 'WR2 6', 'Malvern Hills District', 'West Midlands', 'Hamlet'),
(48671, 'Worle', 'Somerset', 'England', 'ST357630', 335763, 163009, '51.36250', '-2.92403', 8, 'BS22 6', 'North Somerset', 'South West', 'Suburban Area'),
(48672, 'Worlebury', 'Somerset', 'England', 'ST337629', 333766, 162969, '51.36191', '-2.95270', 93, 'BS22 9', 'North Somerset', 'South West', 'Suburban Area'),
(48673, 'Worles Common', 'Worcestershire', 'England', 'SO727684', 372731, 268417, '52.31318', '-2.40142', 135, 'WR6 6', 'Malvern Hills District', 'West Midlands', 'Hamlet'),
(48674, 'Worleston', 'Cheshire', 'England', 'SJ658561', 365804, 356111, '53.10109', '-2.51218', 46, 'CW5 6', 'Cheshire East', 'North West', 'Village'),
(48675, 'Worley', 'Gloucestershire', 'England', 'ST842995', 384299, 199534, '51.69433', '-2.22856', 91, 'GL6 0', 'Stroud District', 'South West', 'Suburban Area'),
(48676, 'Worlingham', 'Suffolk', 'England', 'TM443898', 644347, 289852, '52.45193', '1.59468', 18, 'NR34 7', 'East Suffolk District', 'Eastern', 'Village'),
(48677, 'Worlington', 'Suffolk', 'England', 'TL692736', 569210, 273609, '52.33447', '0.48205', 10, 'IP28 8', 'West Suffolk District', 'Eastern', 'Village'),
(48678, 'Worlingworth', 'Suffolk', 'England', 'TM227683', 622718, 268394, '52.26857', '1.26272', 59, 'IP13 7', 'Mid Suffolk District', 'Eastern', 'Village'),
(48679, 'Wormald Green', 'North Yorkshire', 'England', 'SE308649', 430852, 464923, '54.07931', '-1.52994', 85, 'HG3 3', 'Harrogate District', 'Yorkshire and the Humber', 'Village'),
(48680, 'Wormbridge', 'Herefordshire', 'England', 'SO424302', 342487, 230280, '51.96800', '-2.83856', 85, 'HR2 9', 'County of Herefordshire', 'West Midlands', 'Village'),
(48681, 'Wormbridge Common', 'Herefordshire', 'England', 'SO425315', 342500, 231500, '51.97897', '-2.83858', 149, 'HR2 9', 'County of Herefordshire', 'West Midlands', 'Locality'),
(48682, 'Wormegay', 'Norfolk', 'England', 'TF660117', 566004, 311796, '52.67843', '0.45408', 10, 'PE33 0', 'King\'s Lynn and West Norfolk District', 'Eastern', 'Village'),
(48683, 'Wormelow Tump', 'Herefordshire', 'England', 'SO491303', 349129, 230363, '51.96940', '-2.74190', 120, 'HR2 8', 'County of Herefordshire', 'West Midlands', 'Village'),
(48684, 'Wormhill', 'Derbyshire', 'England', 'SK122742', 412296, 374208, '53.26473', '-1.81711', 324, 'SK17 8', 'High Peak District', 'East Midlands', 'Village'),
(48685, 'Wormingford', 'Essex', 'England', 'TL931316', 593158, 231672, '51.94999', '0.80929', 65, 'CO6 3', 'Colchester District', 'Eastern', 'Village'),
(48686, 'Worminghall', 'Buckinghamshire', 'England', 'SP640083', 464033, 208368, '51.77033', '-1.07342', 63, 'HP18 9', 'Buckinghamshire', 'South East', 'Village'),
(48687, 'Wormington', 'Gloucestershire', 'England', 'SP040363', 404086, 236363, '52.02567', '-1.94186', 57, 'WR12 7', 'Tewkesbury District', 'South West', 'Village'),
(48688, 'Worminster', 'Somerset', 'England', 'ST572428', 357277, 142851, '51.18328', '-2.61263', 38, 'BA4 4', 'Mendip District', 'South West', 'Hamlet'),
(48689, 'Wormit', 'Fife', 'Scotland', 'NO395262', 339595, 726201, '56.42414', '-2.98087', 34, 'DD6 8', 'Fife', 'Scotland', 'Suburban Area'),
(48690, 'Wormleighton', 'Warwickshire', 'England', 'SP448536', 444896, 253623, '52.17904', '-1.34483', 161, 'CV47 2', 'Stratford-on-Avon District', 'West Midlands', 'Village'),
(48691, 'Wormley', 'Hertfordshire', 'England', 'TL365056', 536500, 205601, '51.73251', '-0.02480', 33, 'EN10 6', 'Broxbourne District', 'Eastern', 'Suburban Area'),
(48692, 'Wormley', 'Surrey', 'England', 'SU947382', 494736, 138225, '51.13547', '-0.64734', 113, 'GU8 5', 'Waverley District', 'South East', 'Village'),
(48693, 'Wormleybury', 'Hertfordshire', 'England', 'TL365055', 536500, 205500, '51.73160', '-0.02484', 32, 'EN10 6', 'Broxbourne District', 'Eastern', 'Locality'),
(48694, 'Wormley Hill', 'South Yorkshire', 'England', 'SE665163', 466596, 416395, '53.63984', '-0.99420', 5, 'DN14 9', 'Doncaster District', 'Yorkshire and the Humber', 'Hamlet'),
(48695, 'Wormley West End', 'Hertfordshire', 'England', 'TL335060', 533562, 206004, '51.73684', '-0.06716', 58, 'EN10 7', 'East Hertfordshire District', 'Eastern', 'Village'),
(48696, 'Worms Ash', 'Worcestershire', 'England', 'SO946727', 394617, 272788, '52.35313', '-2.08046', 131, 'B61 9', 'Bromsgrove District', 'West Midlands', 'Hamlet'),
(48697, 'Wormshill', 'Kent', 'England', 'TQ880573', 588030, 157341, '51.28417', '0.69491', 156, 'ME9 0', 'Maidstone District', 'South East', 'Village'),
(48698, 'Worms Hill', 'Kent', 'England', 'TQ740400', 574009, 140044, '51.13323', '0.48568', 64, 'TN17 1', 'Tunbridge Wells District', 'South East', 'Hamlet'),
(48699, 'Wormsley', 'Herefordshire', 'England', 'SO430478', 343078, 247852, '52.12603', '-2.83289', 195, 'HR4 8', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48700, 'Wormwood Scrubs', 'Greater London', 'England', 'TQ226811', 522628, 181184, '51.51628', '-0.23410', 14, 'W12 0', 'Hammersmith and Fulham', 'London', 'Suburban Area'),
(48701, 'Wornish Nook', 'Cheshire', 'England', 'SJ838658', 383885, 365874, '53.18971', '-2.24263', 96, 'CW12 2', 'Cheshire East', 'North West', 'Hamlet'),
(48702, 'Worplesdon', 'Surrey', 'England', 'SU971538', 497135, 153873, '51.27573', '-0.60884', 52, 'GU3 3', 'Guildford District', 'South East', 'Village'),
(48703, 'Worrall', 'South Yorkshire', 'England', 'SK307920', 430742, 392092, '53.42473', '-1.53884', 208, 'S35 0', 'Sheffield District', 'Yorkshire and the Humber', 'Village'),
(48704, 'Worrall Hill', 'Gloucestershire', 'England', 'SO605145', 360500, 214500, '51.82771', '-2.57457', 178, 'GL17 9', 'Forest of Dean District', 'South West', 'Locality'),
(48705, 'Worsbrough', 'South Yorkshire', 'England', 'SE353039', 435354, 403994, '53.53142', '-1.46811', 86, 'S70 5', 'Barnsley District', 'Yorkshire and the Humber', 'Town'),
(48706, 'Worsbrough Bridge', 'South Yorkshire', 'England', 'SE351039', 435106, 403929, '53.53085', '-1.47186', 86, 'S70 5', 'Barnsley District', 'Yorkshire and the Humber', 'Suburban Area'),
(48707, 'Worsbrough Common', 'South Yorkshire', 'England', 'SE347051', 434707, 405116, '53.54155', '-1.47774', 169, 'S70 4', 'Barnsley District', 'Yorkshire and the Humber', 'Suburban Area'),
(48708, 'Worsbrough Dale', 'South Yorkshire', 'England', 'SE362041', 436214, 404144, '53.53271', '-1.45512', 104, 'S70 4', 'Barnsley District', 'Yorkshire and the Humber', 'Suburban Area'),
(48709, 'Worsbrough Village', 'South Yorkshire', 'England', 'SE349026', 434952, 402662, '53.51947', '-1.47432', 123, 'S70 5', 'Barnsley District', 'Yorkshire and the Humber', 'Suburban Area'),
(48710, 'Worsham', 'Oxfordshire', 'England', 'SP299106', 429931, 210682, '51.79399', '-1.56741', 95, 'OX29 0', 'West Oxfordshire District', 'South East', 'Hamlet'),
(48711, 'Worsley', 'Greater Manchester', 'England', 'SD744009', 374453, 400975, '53.50484', '-2.38664', 68, 'M28 2', 'Salford District', 'North West', 'Town'),
(48712, 'Worsley Hall', 'Greater Manchester', 'England', 'SD558054', 355808, 405413, '53.54349', '-2.66836', 39, 'WN5 9', 'Wigan District', 'North West', 'Suburban Area'),
(48713, 'Worsley Mesnes', 'Greater Manchester', 'England', 'SD572040', 357275, 404018, '53.53107', '-2.64603', 34, 'WN3 5', 'Wigan District', 'North West', 'Suburban Area'),
(48714, 'Worstead', 'Norfolk', 'England', 'TG304260', 630422, 326061, '52.78291', '1.41537', 17, 'NR28 9', 'North Norfolk District', 'Eastern', 'Village'),
(48715, 'Worsthorne', 'Lancashire', 'England', 'SD875323', 387543, 432392, '53.78770', '-2.19055', 207, 'BB10 3', 'Burnley District', 'North West', 'Village'),
(48716, 'Worston', 'Lancashire', 'England', 'SD768427', 376853, 442788, '53.88076', '-2.35359', 113, 'BB7 1', 'Ribble Valley District', 'North West', 'Hamlet'),
(48717, 'Worten', 'Kent', 'England', 'TQ970433', 597043, 143320, '51.15520', '0.81629', 52, 'TN23 3', 'Ashford District', 'South East', 'Hamlet'),
(48718, 'Worth', 'Kent', 'England', 'TR333560', 633344, 156023, '51.25559', '1.34276', 6, 'CT14 0', 'Dover District', 'South East', 'Village'),
(48719, 'Worth', 'Somerset', 'England', 'ST509452', 350974, 145203, '51.20392', '-2.70312', 21, 'BA5 1', 'Mendip District', 'South West', 'Hamlet'),
(48720, 'Worth', 'West Sussex', 'England', 'TQ302364', 530270, 136447, '51.11252', '-0.14036', 102, 'RH10 7', 'Crawley District', 'South East', 'Suburban Area'),
(48721, 'Worth Abbey', 'West Sussex', 'England', 'TQ324347', 532470, 134742, '51.09669', '-0.10957', 171, 'RH10 4', 'Mid Sussex District', 'South East', 'Village'),
(48722, 'Wortham', 'Suffolk', 'England', 'TM077772', 607795, 277284, '52.35422', '1.04984', 59, 'IP22 1', 'Mid Suffolk District', 'Eastern', 'Village'),
(48723, 'Wortham Ling', 'Suffolk', 'England', 'TM090791', 609081, 279183, '52.37078', '1.06988', 32, 'IP22 1', 'Mid Suffolk District', 'Eastern', 'Village'),
(48724, 'Wortheal', 'Somerset', 'England', 'ST275083', 327536, 108328, '50.86989', '-3.03117', 202, 'TA20 3', 'South Somerset District', 'South West', 'Hamlet'),
(48725, 'Worthen', 'Shropshire', 'England', 'SJ327046', 332753, 304685, '52.63573', '-2.99511', 109, 'SY5 9', 'Shropshire', 'West Midlands', 'Village'),
(48726, 'Worthenbury', 'Clwyd', 'Wales', 'SJ420460', 342062, 346098, '53.00904', '-2.86494', 17, 'LL13 0', 'Wrexham / Wrecsam', 'Wales', 'Village'),
(48727, 'Worthing', 'Norfolk', 'England', 'TF998199', 599851, 319959, '52.74030', '0.95904', 22, 'NR20 5', 'Breckland District', 'Eastern', 'Hamlet'),
(48728, 'Worthing', 'West Sussex', 'England', 'TQ148028', 514843, 102898, '50.81426', '-0.37122', 11, 'BN11 1', 'Worthing District', 'South East', 'Town'),
(48729, 'Worthington', 'Greater Manchester', 'England', 'SD578098', 357868, 409882, '53.58382', '-2.63788', 58, 'WN1 2', 'Wigan District', 'North West', 'Village'),
(48730, 'Worthington', 'Leicestershire', 'England', 'SK408206', 440827, 320638, '52.78179', '-1.39615', 89, 'LE65 1', 'North West Leicestershire District', 'East Midlands', 'Village'),
(48731, 'Worth Matravers', 'Dorset', 'England', 'SY972773', 397294, 77391, '50.59624', '-2.03959', 115, 'BH19 3', 'Dorset', 'South West', 'Village'),
(48732, 'Worth Village', 'West Yorkshire', 'England', 'SE072415', 407209, 441524, '53.86988', '-1.89185', 93, 'BD21 4', 'Bradford District', 'Yorkshire and the Humber', 'Suburban Area'),
(48733, 'Worthy', 'Somerset', 'England', 'SS855485', 285500, 148500, '51.22417', '-3.64106', 3, 'TA24 8', 'Somerset West and Taunton District', 'South West', 'Locality'),
(48734, 'Worthybrook', 'Gwent', 'Wales', 'SO475115', 347500, 211500, '51.79967', '-2.76273', 73, 'NP25 4', 'Monmouthshire / Sir Fynwy', 'Wales', 'Locality'),
(48735, 'Worthy Down', 'Hampshire', 'England', 'SU460349', 446035, 134950, '51.11200', '-1.34376', 100, 'SO21 2', 'Winchester District', 'South East', 'Village'),
(48736, 'Worting', 'Hampshire', 'England', 'SU600517', 460092, 151746, '51.26171', '-1.14017', 107, 'RG23 8', 'Basingstoke and Deane District', 'South East', 'Suburban Area'),
(48737, 'Wortley', 'Gloucestershire', 'England', 'ST765916', 376591, 191623, '51.62293', '-2.33954', 72, 'GL12 7', 'Stroud District', 'South West', 'Hamlet'),
(48738, 'Wortley', 'South Yorkshire', 'England', 'SK308991', 430825, 399142, '53.48809', '-1.53691', 226, 'S35 7', 'Barnsley District', 'Yorkshire and the Humber', 'Village'),
(48739, 'Worton', 'North Yorkshire', 'England', 'SD955900', 395557, 490094, '54.30643', '-2.06978', 211, 'DL8 3', 'Richmondshire District', 'Yorkshire and the Humber', 'Village'),
(48740, 'Worton', 'Oxfordshire', 'England', 'SP462113', 446245, 211367, '51.79904', '-1.33079', 65, 'OX29 4', 'West Oxfordshire District', 'South East', 'Hamlet'),
(48741, 'Worton', 'Wiltshire', 'England', 'ST972574', 397228, 157439, '51.31605', '-2.04116', 58, 'SN10 5', 'Wiltshire', 'South West', 'Village'),
(48742, 'Wortwell', 'Norfolk', 'England', 'TM277851', 627789, 285196, '52.41729', '1.34829', 15, 'IP20 0', 'South Norfolk District', 'Eastern', 'Village'),
(48743, 'Wotherton', 'Shropshire', 'England', 'SJ277005', 327751, 300586, '52.59824', '-3.06811', 110, 'SY15 6', 'Shropshire', 'West Midlands', 'Hamlet'),
(48744, 'Wothorpe', 'Cambridgeshire', 'England', 'TF032061', 503297, 306132, '52.64310', '-0.47478', 61, 'PE9 3', 'City of Peterborough', 'Eastern', 'Village'),
(48745, 'Wotter', 'Devon', 'England', 'SX554618', 255415, 61896, '50.43906', '-4.03743', 208, 'PL7 5', 'South Hams District', 'South West', 'Village'),
(48746, 'Wotton', 'Gloucestershire', 'England', 'SO844189', 384451, 218945, '51.86886', '-2.22723', 27, 'GL1 3', 'Gloucester District', 'South West', 'Suburban Area'),
(48747, 'Wotton', 'Surrey', 'England', 'TQ129474', 512902, 147476, '51.21533', '-0.38490', 141, 'RH5 6', 'Mole Valley District', 'South East', 'Village'),
(48748, 'Wotton Cross', 'Devon', 'England', 'SX805695', 280500, 69500, '50.51306', '-3.68679', 75, 'TQ12 6', 'Teignbridge District', 'South West', 'Town'),
(48749, 'Wotton-under-Edge', 'Gloucestershire', 'England', 'ST757932', 375761, 193268, '51.63769', '-2.35164', 88, 'GL12 7', 'Stroud District', 'South West', 'Town'),
(48750, 'Wotton Underwood', 'Buckinghamshire', 'England', 'SP686160', 468632, 216026, '51.83863', '-1.00527', 79, 'HP18 0', 'Buckinghamshire', 'South East', 'Hamlet'),
(48751, 'Woughton on the Green', 'Buckinghamshire', 'England', 'SP876375', 487652, 237569, '52.02962', '-0.72380', 73, 'MK6 3', 'Milton Keynes', 'South East', 'Suburban Area'),
(48752, 'Woughton Park', 'Buckinghamshire', 'England', 'SP879368', 487907, 236850, '52.02311', '-0.72026', 68, 'MK6 3', 'Milton Keynes', 'South East', 'Suburban Area'),
(48753, 'Wouldham', 'Kent', 'England', 'TQ712640', 571297, 164042, '51.34964', '0.45842', 8, 'ME1 3', 'Tonbridge and Malling District', 'South East', 'Village'),
(48754, 'Woundale', 'Shropshire', 'England', 'SO773931', 377360, 293132, '52.53557', '-2.33521', 96, 'WV15 5', 'Shropshire', 'West Midlands', 'Hamlet'),
(48755, 'Wrabness', 'Essex', 'England', 'TM180314', 618098, 231461, '51.93889', '1.17150', 30, 'CO11 2', 'Tendring District', 'Eastern', 'Village'),
(48756, 'Wrafton', 'Devon', 'England', 'SS493356', 249369, 135647, '51.10028', '-4.15273', 11, 'EX33 2', 'North Devon District', 'South West', 'Village'),
(48757, 'Wragby', 'Lincolnshire', 'England', 'TF133780', 513353, 378065, '53.28744', '-0.30107', 32, 'LN8 5', 'East Lindsey District', 'East Midlands', 'Town'),
(48758, 'Wragby', 'West Yorkshire', 'England', 'SE406169', 440655, 416916, '53.64718', '-1.38646', 62, 'WF4 1', 'Wakefield District', 'Yorkshire and the Humber', 'Village'),
(48759, 'Wragholme', 'Lincolnshire', 'England', 'TF371980', 537160, 398036, '53.46122', '0.06448', 1, 'DN36 5', 'East Lindsey District', 'East Midlands', 'Hamlet'),
(48760, 'Wramplingham', 'Norfolk', 'England', 'TG112061', 611266, 306183, '52.61231', '1.11904', 28, 'NR18 0', 'South Norfolk District', 'Eastern', 'Village'),
(48761, 'Wrangaton', 'Devon', 'England', 'SX678580', 267862, 58049, '50.40741', '-3.86090', 184, 'TQ10 9', 'South Hams District', 'South West', 'Hamlet'),
(48762, 'Wrangbrook', 'West Yorkshire', 'England', 'SE493132', 449375, 413274, '53.61370', '-1.25514', 42, 'WF9 1', 'Wakefield District', 'Yorkshire and the Humber', 'Suburban Area'),
(48763, 'Wrangle', 'Lincolnshire', 'England', 'TF423511', 542355, 351108, '53.03831', '0.12171', 6, 'PE22 9', 'Boston District', 'East Midlands', 'Village'),
(48764, 'Wrangle Bank', 'Lincolnshire', 'England', 'TF425536', 542585, 353620, '53.06081', '0.12625', 4, 'PE22 9', 'Boston District', 'East Midlands', 'Village'),
(48765, 'Wrangle Lowgate', 'Lincolnshire', 'England', 'TF440514', 544057, 351425, '53.04070', '0.14721', 5, 'PE22 9', 'Boston District', 'East Midlands', 'Locality'),
(48766, 'Wrangle Low Ground', 'Lincolnshire', 'England', 'TF425525', 542500, 352500, '53.05077', '0.12448', 4, 'PE22 9', 'Boston District', 'East Midlands', 'Locality'),
(48767, 'Wrangway', 'Somerset', 'England', 'ST122179', 312271, 117909, '50.95391', '-3.25036', 141, 'TA21 9', 'Somerset West and Taunton District', 'South West', 'Hamlet'),
(48768, 'Wrantage', 'Somerset', 'England', 'ST304224', 330401, 122476, '50.99745', '-2.99317', 15, 'TA3 6', 'Somerset West and Taunton District', 'South West', 'Village'),
(48769, 'Wrawby', 'Lincolnshire', 'England', 'TA019087', 501944, 408792, '53.56585', '-0.46221', 35, 'DN20 8', 'North Lincolnshire', 'Yorkshire and the Humber', 'Village'),
(48770, 'Wraxall', 'Dorset', 'England', 'ST571009', 357189, 100991, '50.80688', '-2.60894', 151, 'DT2 0', 'Dorset', 'South West', 'Locality'),
(48771, 'Wraxall', 'Somerset', 'England', 'ST495715', 349513, 171550, '51.44068', '-2.72778', 43, 'BS48 1', 'North Somerset', 'South West', 'Village'),
(48772, 'Wraxall', 'Somerset', 'England', 'ST603363', 360398, 136361, '51.12515', '-2.56726', 58, 'BA4 6', 'Mendip District', 'South West', 'Village'),
(48773, 'Wray', 'Lancashire', 'England', 'SD602674', 360283, 467446, '54.10136', '-2.60886', 62, 'LA2 8', 'Lancaster District', 'North West', 'Village'),
(48774, 'Wray Common', 'Surrey', 'England', 'TQ265505', 526500, 150500, '51.23966', '-0.18924', 102, 'RH2 0', 'Reigate and Banstead District', 'South East', 'Locality'),
(48775, 'Wraysbury', 'Berkshire', 'England', 'TQ004740', 500457, 174004, '51.45611', '-0.55555', 19, 'TW19 5', 'Windsor and Maidenhead', 'South East', 'Village'),
(48776, 'Wrayton', 'Lancashire', 'England', 'SD609724', 360923, 472436, '54.14626', '-2.59972', 34, 'LA6 2', 'Lancaster District', 'North West', 'Hamlet'),
(48777, 'Wrea Green', 'Lancashire', 'England', 'SD397315', 339720, 431536, '53.77665', '-2.91619', 29, 'PR4 2', 'Fylde District', 'North West', 'Village'),
(48778, 'Wreaks End', 'Cumbria', 'England', 'SD225865', 322500, 486500, '54.26826', '-3.19147', 8, 'LA20 6', 'South Lakeland District', 'North West', 'Locality'),
(48779, 'Wreath', 'Somerset', 'England', 'ST345085', 334500, 108500, '50.87227', '-2.93225', 106, 'TA20 4', 'South Somerset District', 'South West', 'Locality'),
(48780, 'Wreaths', 'Angus', 'Scotland', 'NO395445', 339500, 744500, '56.58850', '-2.98667', 155, 'DD8 1', 'Angus', 'Scotland', 'Locality'),
(48781, 'Wreay', 'Cumbria', 'England', 'NY441238', 344191, 523844, '54.60666', '-2.86551', 249, 'CA11 0', 'Eden District', 'North West', 'Hamlet'),
(48782, 'Wreay', 'Cumbria', 'England', 'NY435489', 343525, 548902, '54.83175', '-2.88069', 96, 'CA4 0', 'Carlisle District', 'North West', 'Village'),
(48783, 'Wrecclesham', 'Surrey', 'England', 'SU827451', 482715, 145157, '51.19965', '-0.81752', 92, 'GU10 4', 'Waverley District', 'South East', 'Village'),
(48784, 'Wrekenton', 'Tyne and Wear', 'England', 'NZ276591', 427654, 559147, '54.92625', '-1.57003', 148, 'NE9 7', 'Gateshead District', 'North East', 'Suburban Area'),
(48785, 'Wrelton', 'North Yorkshire', 'England', 'SE766860', 476624, 486070, '54.26456', '-0.82509', 47, 'YO18 8', 'Ryedale District', 'Yorkshire and the Humber', 'Village'),
(48786, 'Wrenbury-cum-Frith', 'Cheshire', 'England', 'SJ598475', 359840, 347501, '53.02328', '-2.60017', 72, 'CW5 8', 'Cheshire East', 'North West', 'Village'),
(48787, 'Wrenbury Heath', 'Cheshire', 'England', 'SJ606484', 360674, 348490, '53.03224', '-2.58786', 74, 'CW5 8', 'Cheshire East', 'North West', 'Village'),
(48788, 'Wreningham', 'Norfolk', 'England', 'TM157985', 615743, 298591, '52.54241', '1.18012', 41, 'NR16 1', 'South Norfolk District', 'Eastern', 'Village'),
(48789, 'Wren\'s Nest', 'West Midlands', 'England', 'SO932917', 393262, 291751, '52.52359', '-2.10074', 194, 'DY1 3', 'Dudley District', 'West Midlands', 'Suburban Area'),
(48790, 'Wrentham', 'Suffolk', 'England', 'TM498826', 649857, 282639, '52.38473', '1.67021', 8, 'NR34 7', 'East Suffolk District', 'Eastern', 'Village'),
(48791, 'Wrentham West End', 'Suffolk', 'England', 'TM470841', 647024, 284193, '52.39995', '1.62981', 23, 'NR34 7', 'East Suffolk District', 'Eastern', 'Hamlet'),
(48792, 'Wrenthorpe', 'West Yorkshire', 'England', 'SE311227', 431158, 422729, '53.70007', '-1.52954', 49, 'WF2 0', 'Wakefield District', 'Yorkshire and the Humber', 'Suburban Area'),
(48793, 'Wrentnall', 'Shropshire', 'England', 'SJ426036', 342608, 303607, '52.62717', '-2.84932', 207, 'SY5 8', 'Shropshire', 'West Midlands', 'Hamlet'),
(48794, 'Wressle', 'East Riding of Yorkshire', 'England', 'SE709314', 470922, 431456, '53.77462', '-0.92534', 6, 'YO8 6', 'East Riding of Yorkshire', 'Yorkshire and the Humber', 'Village'),
(48795, 'Wressle', 'Lincolnshire', 'England', 'SE970095', 497071, 409563, '53.57370', '-0.53553', 16, 'DN20 0', 'North Lincolnshire', 'Yorkshire and the Humber', 'Village'),
(48796, 'Wrestlingworth', 'Bedfordshire', 'England', 'TL257474', 525776, 247438, '52.11097', '-0.16473', 40, 'SG19 2', 'Central Bedfordshire', 'Eastern', 'Village'),
(48797, 'Wretton', 'Norfolk', 'England', 'TL689999', 568937, 299983, '52.57143', '0.49139', 9, 'PE33 9', 'King\'s Lynn and West Norfolk District', 'Eastern', 'Village'),
(48798, 'Wrexham / Wrecsam', 'Clwyd', 'Wales', 'SJ334505', 333410, 350536, '53.04792', '-2.99478', 89, 'LL11 1', 'Wrexham / Wrecsam', 'Wales', 'Town'),
(48799, 'Wreyland', 'Devon', 'England', 'SX785815', 278500, 81500, '50.62051', '-3.71891', 114, 'TQ13 9', 'Teignbridge District', 'South West', 'Locality'),
(48800, 'Wribbenhall', 'Worcestershire', 'England', 'SO792756', 379238, 275652, '52.37851', '-2.30643', 38, 'DY12 1', 'Wyre Forest District', 'West Midlands', 'Suburban Area'),
(48801, 'Wrickton', 'Shropshire', 'England', 'SO646858', 364608, 285811, '52.46908', '-2.52242', 175, 'WV16 6', 'Shropshire', 'West Midlands', 'Hamlet'),
(48802, 'Wrightington', 'Lancashire', 'England', 'SD526123', 352680, 412389, '53.60591', '-2.71662', 112, 'WN6 9', 'West Lancashire District', 'North West', 'Hamlet'),
(48803, 'Wrightington Bar', 'Lancashire', 'England', 'SD534134', 353498, 413486, '53.61584', '-2.70442', 87, 'WN6 9', 'West Lancashire District', 'North West', 'Village'),
(48804, 'Wright\'s green', 'Cheshire', 'England', 'SJ630845', 363086, 384569, '53.35670', '-2.55608', 64, 'WA4 3', 'Warrington', 'North West', 'Hamlet'),
(48805, 'Wrinehill', 'Staffordshire', 'England', 'SJ753469', 375357, 346928, '53.01908', '-2.36880', 83, 'CW3 9', 'Newcastle-under-Lyme District', 'West Midlands', 'Hamlet'),
(48806, 'Wringsdown', 'Cornwall', 'England', 'SX315875', 231500, 87500, '50.66273', '-4.38551', 75, 'PL15 8', 'Cornwall', 'South West', 'Locality'),
(48807, 'Wrington', 'Somerset', 'England', 'ST469627', 346973, 162797, '51.36175', '-2.76301', 24, 'BS40 5', 'North Somerset', 'South West', 'Village'),
(48808, 'Wringworthy', 'Cornwall', 'England', 'SX266579', 226644, 57928, '50.39561', '-4.44040', 114, 'PL13 1', 'Cornwall', 'South West', 'Hamlet'),
(48809, 'Wrinkleberry', 'Devon', 'England', 'SS315245', 231500, 124500, '50.99516', '-4.40252', 159, 'EX39 5', 'Torridge District', 'South West', 'Locality');
INSERT INTO `uk_towns` (`id`, `name`, `county`, `country`, `grid_reference`, `easting`, `northing`, `latitude`, `longitude`, `elevation`, `postcode_sector`, `local_government_area`, `nuts_region`, `type`) VALUES
(48810, 'Writhlington', 'Somerset', 'England', 'ST702546', 370245, 154667, '51.29035', '-2.42809', 133, 'BA3 3', 'Bath and North East Somerset', 'South West', 'Suburban Area'),
(48811, 'Writtle', 'Essex', 'England', 'TL678062', 567859, 206288, '51.73018', '0.42923', 38, 'CM1 3', 'Chelmsford District', 'Eastern', 'Village'),
(48812, 'Wrockwardine', 'Shropshire', 'England', 'SJ625118', 362558, 311855, '52.70306', '-2.55555', 115, 'TF6 5', 'Telford and Wrekin', 'West Midlands', 'Suburban Area'),
(48813, 'Wrockwardine Wood', 'Shropshire', 'England', 'SJ697118', 369763, 311897, '52.70389', '-2.44893', 121, 'TF2 6', 'Telford and Wrekin', 'West Midlands', 'Suburban Area'),
(48814, 'Wroot', 'Lincolnshire', 'England', 'SE714030', 471467, 403039, '53.51917', '-0.92359', 10, 'DN9 2', 'North Lincolnshire', 'Yorkshire and the Humber', 'Village'),
(48815, 'Wrose', 'West Yorkshire', 'England', 'SE161369', 416153, 436960, '53.82866', '-1.75607', 191, 'BD18 1', 'Bradford District', 'Yorkshire and the Humber', 'Suburban Area'),
(48816, 'Wrotham', 'Kent', 'England', 'TQ611591', 561162, 159175, '51.30887', '0.31082', 135, 'TN15 7', 'Tonbridge and Malling District', 'South East', 'Village'),
(48817, 'Wrotham Heath', 'Kent', 'England', 'TQ637580', 563761, 158026, '51.29781', '0.34755', 82, 'TN15 7', 'Tonbridge and Malling District', 'South East', 'Village'),
(48818, 'Wroughton', 'Wiltshire', 'England', 'SU149819', 414999, 181937, '51.53614', '-1.78514', 110, 'SN4 9', 'Swindon', 'South West', 'Village'),
(48819, 'Wroughton Park', 'Buckinghamshire', 'England', 'SP875365', 487500, 236500, '52.02003', '-0.72628', 79, 'MK6 4', 'Milton Keynes', 'South East', 'Locality'),
(48820, 'Wroxall', 'Isle of Wight', 'England', 'SZ550797', 455074, 79739, '50.61477', '-1.22294', 78, 'PO38 3', 'Isle of Wight', 'South East', 'Village'),
(48821, 'Wroxall', 'Warwickshire', 'England', 'SP225712', 422548, 271288, '52.33921', '-1.67048', 130, 'CV35 7', 'Warwick District', 'West Midlands', 'Hamlet'),
(48822, 'Wroxeter', 'Shropshire', 'England', 'SJ563084', 356396, 308416, '52.67169', '-2.64628', 63, 'SY5 6', 'Shropshire', 'West Midlands', 'Village'),
(48823, 'Wroxham', 'Norfolk', 'England', 'TG298175', 629890, 317534, '52.70662', '1.40152', 15, 'NR12 8', 'Broadland District', 'Eastern', 'Village'),
(48824, 'Wroxton', 'Oxfordshire', 'England', 'SP411418', 441120, 241883, '52.07379', '-1.40147', 157, 'OX15 6', 'Cherwell District', 'South East', 'Village'),
(48825, 'Wyaston', 'Derbyshire', 'England', 'SK186420', 418654, 342000, '52.97503', '-1.72366', 169, 'DE6 2', 'Derbyshire Dales District', 'East Midlands', 'Village'),
(48826, 'Wyatt\'s Green', 'Essex', 'England', 'TQ597993', 559759, 199365, '51.67035', '0.30888', 83, 'CM15 0', 'Brentwood District', 'Eastern', 'Village'),
(48827, 'Wybers Wood', 'Lincolnshire', 'England', 'TA235092', 523521, 409208, '53.56495', '-0.13643', 8, 'DN37 9', 'North East Lincolnshire', 'Yorkshire and the Humber', 'Suburban Area'),
(48828, 'Wyberton', 'Lincolnshire', 'England', 'TF318418', 531835, 341852, '52.95785', '-0.03886', 6, 'PE21 7', 'Boston District', 'East Midlands', 'Suburban Area'),
(48829, 'Wyberton Fen', 'Lincolnshire', 'England', 'TF302431', 530208, 343156, '52.96996', '-0.06254', 3, 'PE21 7', 'Boston District', 'East Midlands', 'Suburban Area'),
(48830, 'Wyboston', 'Bedfordshire', 'England', 'TL158568', 515899, 256842, '52.19764', '-0.30568', 23, 'MK44 3', 'Bedford', 'Eastern', 'Village'),
(48831, 'Wybourn', 'South Yorkshire', 'England', 'SK376873', 437609, 387318, '53.38138', '-1.43608', 100, 'S2 1', 'Sheffield District', 'Yorkshire and the Humber', 'Suburban Area'),
(48832, 'Wybunbury', 'Cheshire', 'England', 'SJ698499', 369819, 349901, '53.04552', '-2.45163', 63, 'CW5 7', 'Cheshire East', 'North West', 'Village'),
(48833, 'Wych', 'Dorset', 'England', 'SY468911', 346859, 91165, '50.71767', '-2.75411', 15, 'DT6 4', 'Dorset', 'South West', 'Suburban Area'),
(48834, 'Wychbold', 'Worcestershire', 'England', 'SO920657', 392055, 265785, '52.29014', '-2.11790', 57, 'WR9 7', 'Wychavon District', 'West Midlands', 'Village'),
(48835, 'Wych Cross', 'East Sussex', 'England', 'TQ419320', 541958, 132023, '51.06999', '0.02477', 197, 'RH18 5', 'Wealden District', 'South East', 'Locality'),
(48836, 'Wychnor', 'Staffordshire', 'England', 'SK175164', 417528, 316432, '52.74523', '-1.74179', 66, 'DE13 8', 'East Staffordshire District', 'West Midlands', 'Village'),
(48837, 'Wychnor Bridges', 'Staffordshire', 'England', 'SK185165', 418500, 316500, '52.74581', '-1.72739', 56, 'DE13 8', 'East Staffordshire District', 'West Midlands', 'Locality'),
(48838, 'Wyck', 'Hampshire', 'England', 'SU756395', 475677, 139547, '51.15019', '-0.91941', 133, 'GU34 3', 'East Hampshire District', 'South East', 'Hamlet'),
(48839, 'Wyck Rissington', 'Gloucestershire', 'England', 'SP190215', 419062, 221586, '51.89250', '-1.72441', 149, 'GL54 2', 'Cotswold District', 'South West', 'Village'),
(48840, 'Wycliffe', 'Durham', 'England', 'NZ119142', 411938, 514210, '54.52304', '-1.81708', 120, 'DL12 8', 'County Durham', 'North East', 'Hamlet'),
(48841, 'Wycoller', 'Lancashire', 'England', 'SD931393', 393178, 439382, '53.85063', '-2.10518', 206, 'BB8 8', 'Pendle District', 'North West', 'Hamlet'),
(48842, 'Wycomb', 'Leicestershire', 'England', 'SK774247', 477416, 324783, '52.81504', '-0.85280', 128, 'LE14 4', 'Melton District', 'East Midlands', 'Hamlet'),
(48843, 'Wycombe Marsh', 'Buckinghamshire', 'England', 'SU886917', 488681, 191760, '51.61769', '-0.72052', 59, 'HP11 1', 'Buckinghamshire', 'South East', 'Suburban Area'),
(48844, 'Wyddial', 'Hertfordshire', 'England', 'TL372313', 537216, 231376, '51.96394', '-0.00422', 125, 'SG9 0', 'East Hertfordshire District', 'Eastern', 'Village'),
(48845, 'Wydra', 'North Yorkshire', 'England', 'SE198545', 419885, 454526, '53.98641', '-1.69824', 195, 'HG3 1', 'Harrogate District', 'Yorkshire and the Humber', 'Hamlet'),
(48846, 'Wye', 'Kent', 'England', 'TR054468', 605405, 146845, '51.18392', '0.93771', 46, 'TN25 5', 'Ashford District', 'South East', 'Village'),
(48847, 'Wyebanks', 'Kent', 'England', 'TQ935545', 593500, 154500, '51.25682', '0.77171', 150, 'ME9 0', 'Maidstone District', 'South East', 'Locality'),
(48848, 'Wyegate Green', 'Gloucestershire', 'England', 'SO555065', 355500, 206500, '51.75541', '-2.64609', 190, 'GL15 6', 'Forest of Dean District', 'South West', 'Locality'),
(48849, 'Wyesham', 'Gwent', 'Wales', 'SO516124', 351687, 212413, '51.80825', '-2.70215', 42, 'NP25 3', 'Monmouthshire / Sir Fynwy', 'Wales', 'Suburban Area'),
(48850, 'Wyfordby', 'Leicestershire', 'England', 'SK794189', 479411, 318957, '52.76239', '-0.82461', 83, 'LE14 4', 'Melton District', 'East Midlands', 'Hamlet'),
(48851, 'Wyham', 'Lincolnshire', 'England', 'TF280950', 528000, 395076, '53.43693', '-0.07460', 65, 'DN36 5', 'East Lindsey District', 'East Midlands', 'Hamlet'),
(48852, 'Wyke', 'Dorset', 'England', 'ST791265', 379134, 126550, '51.03792', '-2.29897', 68, 'SP8 5', 'Dorset', 'South West', 'Suburban Area'),
(48853, 'Wyke', 'Shropshire', 'England', 'SJ647021', 364759, 302148, '52.61595', '-2.52193', 171, 'TF13 6', 'Shropshire', 'West Midlands', 'Hamlet'),
(48854, 'Wyke', 'Surrey', 'England', 'SU907510', 490782, 151061, '51.25150', '-0.70060', 80, 'GU12 6', 'Guildford District', 'South East', 'Village'),
(48855, 'Wyke', 'West Yorkshire', 'England', 'SE155266', 415521, 426672, '53.73621', '-1.76619', 173, 'BD12 9', 'Bradford District', 'Yorkshire and the Humber', 'Suburban Area'),
(48856, 'Wyke Champflower', 'Somerset', 'England', 'ST662347', 366292, 134727, '51.11084', '-2.48289', 78, 'BA10 0', 'South Somerset District', 'South West', 'Hamlet'),
(48857, 'Wyke Common', 'West Yorkshire', 'England', 'SE156268', 415690, 426807, '53.73742', '-1.76362', 172, 'BD12 9', 'Bradford District', 'Yorkshire and the Humber', 'Suburban Area'),
(48858, 'Wyke Green', 'Devon', 'England', 'SY298964', 329897, 96479, '50.76365', '-2.99536', 78, 'EX13 8', 'East Devon District', 'South West', 'Hamlet'),
(48859, 'Wykeham', 'Lincolnshire', 'England', 'TF269263', 526951, 326342, '52.81967', '-0.11757', 5, 'PE11 3', 'South Holland District', 'East Midlands', 'Locality'),
(48860, 'Wykeham', 'North Yorkshire', 'England', 'SE816753', 481676, 475314, '54.16714', '-0.75047', 20, 'YO17 6', 'Ryedale District', 'Yorkshire and the Humber', 'Hamlet'),
(48861, 'Wykeham', 'North Yorkshire', 'England', 'SE964830', 496449, 483094, '54.23448', '-0.52177', 33, 'YO13 9', 'Scarborough District', 'Yorkshire and the Humber', 'Village'),
(48862, 'Wyken', 'Shropshire', 'England', 'SO763952', 376362, 295215, '52.55426', '-2.35007', 45, 'WV15 5', 'Shropshire', 'West Midlands', 'Village'),
(48863, 'Wyken', 'West Midlands', 'England', 'SP370802', 437096, 280263, '52.41911', '-1.45597', 89, 'CV2 3', 'Coventry District', 'West Midlands', 'Suburban Area'),
(48864, 'Wyken Green', 'West Midlands', 'England', 'SP362809', 436237, 280907, '52.42496', '-1.46853', 88, 'CV2 3', 'Coventry District', 'West Midlands', 'Suburban Area'),
(48865, 'Wyke Regis', 'Dorset', 'England', 'SY662771', 366285, 77147, '50.59307', '-2.47767', 21, 'DT4 9', 'Dorset', 'South West', 'Suburban Area'),
(48866, 'Wykey', 'Shropshire', 'England', 'SJ391245', 339160, 324593, '52.81543', '-2.90415', 86, 'SY4 1', 'Shropshire', 'West Midlands', 'Locality'),
(48867, 'Wykin', 'Leicestershire', 'England', 'SP406953', 440681, 295374, '52.55469', '-1.40142', 118, 'LE10 3', 'Hinckley and Bosworth District', 'East Midlands', 'Locality'),
(48868, 'Wylam', 'Northumberland', 'England', 'NZ116646', 411663, 564632, '54.97616', '-1.81932', 18, 'NE41 8', 'Northumberland', 'North East', 'Village'),
(48869, 'Wylde', 'Herefordshire', 'England', 'SO455685', 345500, 268500, '52.31189', '-2.80085', 177, 'HR6 9', 'County of Herefordshire', 'West Midlands', 'Locality'),
(48870, 'Wylde Green', 'West Midlands', 'England', 'SP120944', 412051, 294496, '52.54818', '-1.82372', 145, 'B72 1', 'Birmingham District', 'West Midlands', 'Suburban Area'),
(48871, 'Wyllie', 'Gwent', 'Wales', 'ST177940', 317718, 194015, '51.63890', '-3.19040', 143, 'NP12 2', 'Caerphilly / Caerffili', 'Wales', 'Village'),
(48872, 'Wylye', 'Wiltshire', 'England', 'SU009375', 400961, 137528, '51.13702', '-1.98764', 77, 'BA12 0', 'Wiltshire', 'South West', 'Village'),
(48873, 'Wymans Brook', 'Gloucestershire', 'England', 'SO942243', 394262, 224365, '51.91778', '-2.08483', 54, 'GL50 4', 'Cheltenham District', 'South West', 'Suburban Area'),
(48874, 'Wymbush', 'Buckinghamshire', 'England', 'SP825388', 482531, 238850, '52.04192', '-0.79811', 77, 'MK8 8', 'Milton Keynes', 'South East', 'Suburban Area'),
(48875, 'Wymering', 'Hampshire', 'England', 'SU652058', 465297, 105832, '50.84833', '-1.07385', 21, 'PO6 3', 'City of Portsmouth', 'South East', 'Suburban Area'),
(48876, 'Wymeswold', 'Leicestershire', 'England', 'SK602235', 460276, 323506, '52.80575', '-1.10730', 78, 'LE12 6', 'Charnwood District', 'East Midlands', 'Village'),
(48877, 'Wymington', 'Bedfordshire', 'England', 'SP955642', 495579, 264273, '52.26832', '-0.60078', 75, 'NN10 9', 'Bedford', 'Eastern', 'Village'),
(48878, 'Wymondham', 'Leicestershire', 'England', 'SK848188', 484885, 318834, '52.76045', '-0.74354', 108, 'LE14 2', 'Melton District', 'East Midlands', 'Village'),
(48879, 'Wymondham', 'Norfolk', 'England', 'TG110014', 611052, 301483, '52.57020', '1.11289', 43, 'NR18 0', 'South Norfolk District', 'Eastern', 'Town'),
(48880, 'Wymondley Bury', 'Hertfordshire', 'England', 'TL215275', 521500, 227500, '51.93276', '-0.23421', 80, 'SG4 7', 'North Hertfordshire District', 'Eastern', 'Locality'),
(48881, 'Wymott', 'Lancashire', 'England', 'SD508207', 350883, 420740, '53.68080', '-2.74509', 18, 'PR26 8', 'Chorley District', 'North West', 'Village'),
(48882, 'Wyndbrook', 'Gloucestershire', 'England', 'SO780326', 378021, 232662, '51.99197', '-2.32150', 34, 'GL19 3', 'Forest of Dean District', 'South West', 'Hamlet'),
(48883, 'Wyndford', 'City of Glasgow', 'Scotland', 'NS570686', 257008, 668614, '55.88937', '-4.28793', 38, 'G20 9', 'Glasgow City', 'Scotland', 'Suburban Area'),
(48884, 'Wyndham', 'Mid Glamorgan', 'Wales', 'SS932914', 293211, 191494, '51.61211', '-3.54364', 172, 'CF32 7', 'Bridgend / Pen-y-bont ar Ogwr', 'Wales', 'Village'),
(48885, 'Wyndham Park', 'South Glamorgan', 'Wales', 'ST083759', 308367, 175957, '51.47513', '-3.32078', 30, 'CF5 6', 'The Vale of Glamorgan / Bro Morgannwg', 'Wales', 'Village'),
(48886, 'Wyndham Park', 'Wiltshire', 'England', 'SU149304', 414973, 130468, '51.07335', '-1.78766', 64, 'SP1 3', 'Wiltshire', 'South West', 'Suburban Area'),
(48887, 'Wynds Point', 'Herefordshire', 'England', 'SO765405', 376500, 240500, '52.06237', '-2.34419', 264, 'WR13 6', 'County of Herefordshire', 'West Midlands', 'Locality'),
(48888, 'Wynford Eagle', 'Dorset', 'England', 'SY584959', 358402, 95975, '50.76187', '-2.59116', 112, 'DT2 0', 'Dorset', 'South West', 'Hamlet'),
(48889, 'Wyng', 'Orkney', 'Scotland', 'ND317910', 331726, 991026, '58.80134', '-3.18329', 3, 'KW16 3', 'Orkney Islands', 'Scotland', 'Hamlet'),
(48890, 'Wynn\'s Green', 'Herefordshire', 'England', 'SO605475', 360500, 247500, '52.12439', '-2.57838', 96, 'HR1 3', 'County of Herefordshire', 'West Midlands', 'Locality'),
(48891, 'Wynyard Village', 'Durham', 'England', 'NZ419271', 441999, 527118, '54.63744', '-1.35083', 69, 'TS22 5', 'Stockton-on-Tees', 'North East', 'Village'),
(48892, 'Wyre Piddle', 'Worcestershire', 'England', 'SO966474', 396610, 247456, '52.12540', '-2.05093', 23, 'WR10 2', 'Wychavon District', 'West Midlands', 'Village'),
(48893, 'Wysall', 'Nottinghamshire', 'England', 'SK605273', 460510, 327310, '52.83991', '-1.10313', 77, 'NG12 5', 'Rushcliffe District', 'East Midlands', 'Village'),
(48894, 'Wyson', 'Herefordshire', 'England', 'SO519681', 351988, 268103, '52.30893', '-2.70563', 76, 'SY8 4', 'County of Herefordshire', 'West Midlands', 'Village'),
(48895, 'Wythall', 'Worcestershire', 'England', 'SP078751', 407863, 275100, '52.37389', '-1.88593', 168, 'B47 6', 'Bromsgrove District', 'West Midlands', 'Village'),
(48896, 'Wytham', 'Oxfordshire', 'England', 'SP475087', 447557, 208717, '51.77511', '-1.31213', 66, 'OX2 8', 'Vale of White Horse District', 'South East', 'Village'),
(48897, 'Wythburn', 'Cumbria', 'England', 'NY322128', 332232, 512849, '54.50640', '-3.04809', 195, 'CA12 4', 'Allerdale District', 'North West', 'Hamlet'),
(48898, 'Wythenshawe', 'Greater Manchester', 'England', 'SJ820881', 382055, 388112, '53.38954', '-2.27129', 52, 'M22 8', 'Manchester District', 'North West', 'Locality'),
(48899, 'Wythop Mill', 'Cumbria', 'England', 'NY178297', 317832, 529702, '54.65569', '-3.27514', 105, 'CA13 9', 'Allerdale District', 'North West', 'Hamlet'),
(48900, 'Wyton', 'Cambridgeshire', 'England', 'TL274725', 527474, 272506, '52.33584', '-0.13051', 11, 'PE28 2', 'Huntingdonshire District', 'Eastern', 'Village'),
(48901, 'Wyton', 'East Riding of Yorkshire', 'England', 'TA176332', 517658, 433287, '53.78262', '-0.21579', 7, 'HU11 4', 'East Riding of Yorkshire', 'Yorkshire and the Humber', 'Locality'),
(48902, 'Wyverstone', 'Suffolk', 'England', 'TM042678', 604232, 267808, '52.27048', '0.99185', 59, 'IP14 4', 'Mid Suffolk District', 'Eastern', 'Village'),
(48903, 'Wyverstone Green', 'Suffolk', 'England', 'TM045675', 604500, 267500, '52.26762', '0.99559', 53, 'IP14 4', 'Mid Suffolk District', 'Eastern', 'Locality'),
(48904, 'Wyverstone Street', 'Suffolk', 'England', 'TM032677', 603207, 267785, '52.27065', '0.97684', 65, 'IP14 4', 'Mid Suffolk District', 'Eastern', 'Village'),
(48905, 'Wyville', 'Lincolnshire', 'England', 'SK882292', 488230, 329238, '52.85342', '-0.69118', 120, 'NG32 1', 'South Kesteven District', 'East Midlands', 'Hamlet'),
(48906, 'Yaddlethorpe', 'Lincolnshire', 'England', 'SE883069', 488393, 406975, '53.55197', '-0.66727', 16, 'DN17 2', 'North Lincolnshire', 'Yorkshire and the Humber', 'Suburban Area'),
(48907, 'Yafford', 'Isle of Wight', 'England', 'SZ447818', 444791, 81831, '50.63446', '-1.36802', 45, 'PO30 3', 'Isle of Wight', 'South East', 'Hamlet'),
(48908, 'Yafforth', 'North Yorkshire', 'England', 'SE343945', 434302, 494525, '54.34512', '-1.47384', 41, 'DL7 0', 'Hambleton District', 'Yorkshire and the Humber', 'Village'),
(48909, 'Yair', 'Roxburgh, Ettrick and Lauderdale', 'Scotland', 'NT455325', 345500, 632500, '55.58308', '-2.86611', 191, 'TD1 3', 'Scottish Borders', 'Scotland', 'Locality'),
(48910, 'Yalberton', 'Devon', 'England', 'SX865585', 286500, 58500, '50.41537', '-3.59886', 51, 'TQ4 7', 'Torbay', 'South West', 'Locality'),
(48911, 'Yalding', 'Kent', 'England', 'TQ699502', 569910, 150249, '51.22614', '0.43197', 20, 'ME18 6', 'Maidstone District', 'South East', 'Village'),
(48912, 'Yanley', 'Somerset', 'England', 'ST549696', 354997, 169681, '51.42434', '-2.64864', 48, 'BS41 9', 'North Somerset', 'South West', 'Hamlet'),
(48913, 'Yanwath', 'Cumbria', 'England', 'NY511277', 351148, 527719, '54.64221', '-2.75847', 151, 'CA10 2', 'Eden District', 'North West', 'Village'),
(48914, 'Yanworth', 'Gloucestershire', 'England', 'SP077138', 407733, 213845, '51.82318', '-1.88921', 181, 'GL54 3', 'Cotswold District', 'South West', 'Village'),
(48915, 'Yapham', 'East Riding of Yorkshire', 'England', 'SE788520', 478863, 452057, '53.95860', '-0.79958', 37, 'YO42 1', 'East Riding of Yorkshire', 'Yorkshire and the Humber', 'Village'),
(48916, 'Yapton', 'West Sussex', 'England', 'SU980031', 498021, 103128, '50.81941', '-0.60986', 5, 'BN18 0', 'Arun District', 'South East', 'Village'),
(48917, 'Yarberry', 'Somerset', 'England', 'ST388580', 338829, 158039, '51.31815', '-2.87914', 17, 'BS29 6', 'North Somerset', 'South West', 'Locality'),
(48918, 'Yarborough', 'Lincolnshire', 'England', 'TA252089', 525254, 408991, '53.56259', '-0.11037', 7, 'DN34 4', 'North East Lincolnshire', 'Yorkshire and the Humber', 'Suburban Area'),
(48919, 'Yarbridge', 'Isle of Wight', 'England', 'SZ605865', 460502, 86571, '50.67567', '-1.14511', 36, 'PO36 0', 'Isle of Wight', 'South East', 'Suburban Area'),
(48920, 'Yarburgh', 'Lincolnshire', 'England', 'TF349930', 534974, 393098, '53.41742', '0.02946', 12, 'LN11 0', 'East Lindsey District', 'East Midlands', 'Village'),
(48921, 'Yarcombe', 'Devon', 'England', 'ST245082', 324555, 108293, '50.86920', '-3.07352', 144, 'EX14 9', 'East Devon District', 'South West', 'Village'),
(48922, 'Yarde', 'Somerset', 'England', 'ST060390', 306091, 139099, '51.14343', '-3.34382', 67, 'TA4 4', 'Somerset West and Taunton District', 'South West', 'Hamlet'),
(48923, 'Yardhurst', 'Kent', 'England', 'TQ955415', 595500, 141500, '51.13938', '0.79326', 36, 'TN26 1', 'Ashford District', 'South East', 'Locality'),
(48924, 'Yardley', 'West Midlands', 'England', 'SP128860', 412814, 286041, '52.47216', '-1.81279', 127, 'B25 8', 'Birmingham District', 'West Midlands', 'Suburban Area'),
(48925, 'Yardley Fields', 'West Midlands', 'England', 'SP126866', 412642, 286647, '52.47761', '-1.81530', 109, 'B33 8', 'Birmingham District', 'West Midlands', 'Suburban Area'),
(48926, 'Yardley Gobion', 'Northamptonshire', 'England', 'SP765447', 476514, 244792, '52.09619', '-0.88449', 99, 'NN12 7', 'West Northamptonshire', 'East Midlands', 'Village'),
(48927, 'Yardley Hastings', 'Northamptonshire', 'England', 'SP865570', 486577, 257005, '52.20448', '-0.73452', 79, 'NN7 1', 'West Northamptonshire', 'East Midlands', 'Village'),
(48928, 'Yardley Wood', 'West Midlands', 'England', 'SP097801', 409780, 280123, '52.41901', '-1.85762', 127, 'B14 4', 'Birmingham District', 'West Midlands', 'Suburban Area'),
(48929, 'Yardro', 'Powys', 'Wales', 'SO222587', 322289, 258753, '52.22148', '-3.13901', 245, 'LD8 2', 'Powys', 'Wales', 'Locality'),
(48930, 'Yarford', 'Somerset', 'England', 'ST202297', 320231, 129707, '51.06114', '-3.13966', 61, 'TA2 8', 'Somerset West and Taunton District', 'South West', 'Hamlet'),
(48931, 'Yarhampton', 'Worcestershire', 'England', 'SO775675', 377500, 267500, '52.30515', '-2.33141', 76, 'DY13 0', 'Malvern Hills District', 'West Midlands', 'Locality'),
(48932, 'Yarhampton Cross', 'Worcestershire', 'England', 'SO773673', 377318, 267340, '52.30371', '-2.33407', 80, 'DY13 0', 'Malvern Hills District', 'West Midlands', 'Hamlet'),
(48933, 'Yarkhill', 'Herefordshire', 'England', 'SO606426', 360619, 242613, '52.08046', '-2.57607', 59, 'HR1 3', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48934, 'Yarlet', 'Staffordshire', 'England', 'SJ910286', 391096, 328682, '52.85556', '-2.13368', 135, 'ST18 9', 'Stafford District', 'West Midlands', 'Village'),
(48935, 'Yarley', 'Somerset', 'England', 'ST502451', 350227, 145112, '51.20304', '-2.71380', 38, 'BA5 1', 'Mendip District', 'South West', 'Hamlet'),
(48936, 'Yarlington', 'Somerset', 'England', 'ST655292', 365503, 129226, '51.06133', '-2.49364', 81, 'BA9 8', 'South Somerset District', 'South West', 'Village'),
(48937, 'Yarlside', 'Cumbria', 'England', 'SD222700', 322224, 470052, '54.12043', '-3.19145', 18, 'LA13 0', 'Barrow-in-Furness District', 'North West', 'Suburban Area'),
(48938, 'Yarm', 'North Yorkshire', 'England', 'NZ419128', 441907, 512820, '54.50897', '-1.35429', 9, 'TS15 9', 'Stockton-on-Tees', 'North East', 'Town'),
(48939, 'Yarmouth', 'Isle of Wight', 'England', 'SZ355897', 435597, 89744, '50.70625', '-1.49725', 4, 'PO41 0', 'Isle of Wight', 'South East', 'Town'),
(48940, 'Yarnacott', 'Devon', 'England', 'SS622304', 262219, 130492, '51.05719', '-3.96736', 77, 'EX32 0', 'North Devon District', 'South West', 'Hamlet'),
(48941, 'Yarnbrook', 'Wiltshire', 'England', 'ST867549', 386778, 154933, '51.29337', '-2.19101', 45, 'BA14 6', 'Wiltshire', 'South West', 'Village'),
(48942, 'Yarnfield', 'Staffordshire', 'England', 'SJ865326', 386592, 332683, '52.89143', '-2.20073', 101, 'ST15 0', 'Stafford District', 'West Midlands', 'Village'),
(48943, 'Yarnfield', 'Wiltshire', 'England', 'ST778382', 377859, 138271, '51.14327', '-2.31788', 188, 'BA12 7', 'Wiltshire', 'South West', 'Locality'),
(48944, 'Yarningale Common', 'Warwickshire', 'England', 'SP195665', 419500, 266500, '52.29629', '-1.71549', 105, 'CV35 7', 'Warwick District', 'West Midlands', 'Locality'),
(48945, 'Yarnscombe', 'Devon', 'England', 'SS560237', 256038, 123725, '50.99486', '-4.05281', 138, 'EX31 3', 'Torridge District', 'South West', 'Village'),
(48946, 'Yarnton', 'Oxfordshire', 'England', 'SP478125', 447885, 212593, '51.80993', '-1.30684', 62, 'OX5 1', 'Cherwell District', 'South East', 'Village'),
(48947, 'Yarpole', 'Herefordshire', 'England', 'SO467649', 346742, 264940, '52.28001', '-2.78207', 104, 'HR6 0', 'County of Herefordshire', 'West Midlands', 'Village'),
(48948, 'Yarrow', 'Roxburgh, Ettrick and Lauderdale', 'Scotland', 'NT357276', 335758, 627657, '55.53838', '-3.01950', 197, 'TD7 5', 'Scottish Borders', 'Scotland', 'Village'),
(48949, 'Yarrow', 'Somerset', 'England', 'ST380469', 338072, 146947, '51.21835', '-2.88808', 8, 'TA9 4', 'Sedgemoor District', 'South West', 'Hamlet'),
(48950, 'Yarrow Feus', 'Roxburgh, Ettrick and Lauderdale', 'Scotland', 'NT345255', 334500, 625500, '55.51884', '-3.03892', 268, 'TD7 5', 'Scottish Borders', 'Scotland', 'Locality'),
(48951, 'Yarrowford', 'Roxburgh, Ettrick and Lauderdale', 'Scotland', 'NT411301', 341188, 630113, '55.56113', '-2.93399', 163, 'TD7 5', 'Scottish Borders', 'Scotland', 'Village'),
(48952, 'Yarsop', 'Herefordshire', 'England', 'SO409475', 340978, 247562, '52.12320', '-2.86351', 171, 'HR4 7', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48953, 'Yarwell', 'Northamptonshire', 'England', 'TL071976', 507178, 297603, '52.56571', '-0.42021', 29, 'PE8 6', 'North Northamptonshire', 'East Midlands', 'Village'),
(48954, 'Yate', 'Gloucestershire', 'England', 'ST710825', 371020, 182500, '51.54065', '-2.41926', 79, 'BS37 4', 'South Gloucestershire', 'South West', 'Town'),
(48955, 'Yatehouse Green', 'Cheshire', 'England', 'SJ705687', 370545, 368762, '53.21509', '-2.44254', 38, 'CW10 9', 'Cheshire West and Chester', 'North West', 'Hamlet'),
(48956, 'Yateley', 'Hampshire', 'England', 'SU823607', 482390, 160791, '51.34025', '-0.81858', 59, 'GU46 7', 'Hart District', 'South East', 'Town'),
(48957, 'Yate Rocks', 'Gloucestershire', 'England', 'ST721843', 372162, 184343, '51.55728', '-2.40294', 106, 'BS37 7', 'South Gloucestershire', 'South West', 'Hamlet'),
(48958, 'Yatesbury', 'Wiltshire', 'England', 'SU066716', 406611, 171689, '51.44415', '-1.90627', 171, 'SN11 8', 'Wiltshire', 'South West', 'Village'),
(48959, 'Yattendon', 'Berkshire', 'England', 'SU554742', 455433, 174227, '51.46431', '-1.20343', 103, 'RG18 0', 'West Berkshire', 'South East', 'Village'),
(48960, 'Yatton', 'Herefordshire', 'England', 'SO429667', 342985, 266761, '52.29600', '-2.83744', 128, 'HR6 9', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48961, 'Yatton', 'Somerset', 'England', 'ST430655', 343097, 165596, '51.38654', '-2.81912', 12, 'BS49 4', 'North Somerset', 'South West', 'Village'),
(48962, 'Yatton Keynell', 'Wiltshire', 'England', 'ST866763', 386665, 176395, '51.48635', '-2.19344', 129, 'SN14 7', 'Wiltshire', 'South West', 'Village'),
(48963, 'Yatts', 'North Yorkshire', 'England', 'SE808872', 480818, 487283, '54.27482', '-0.76039', 108, 'YO18 8', 'Ryedale District', 'Yorkshire and the Humber', 'Hamlet'),
(48964, 'Yaverland', 'Isle of Wight', 'England', 'SZ612851', 461236, 85174, '50.66303', '-1.13496', 7, 'PO36 8', 'Isle of Wight', 'South East', 'Village'),
(48965, 'Yawl', 'Devon', 'England', 'SY319945', 331913, 94562, '50.74665', '-2.96642', 123, 'DT7 3', 'East Devon District', 'South West', 'Village'),
(48966, 'Yawthorpe', 'Lincolnshire', 'England', 'SK896918', 489642, 391844, '53.41580', '-0.65274', 24, 'DN21 5', 'West Lindsey District', 'East Midlands', 'Hamlet'),
(48967, 'Yaxham', 'Norfolk', 'England', 'TG004105', 600486, 310534, '52.65546', '0.96269', 51, 'NR19 1', 'Breckland District', 'Eastern', 'Village'),
(48968, 'Yaxley', 'Cambridgeshire', 'England', 'TL185926', 518555, 292640, '52.51875', '-0.25421', 21, 'PE7 3', 'Huntingdonshire District', 'Eastern', 'Village'),
(48969, 'Yaxley', 'Suffolk', 'England', 'TM120738', 612007, 273828, '52.32158', '1.10941', 45, 'IP23 8', 'Mid Suffolk District', 'Eastern', 'Village'),
(48970, 'Yazor', 'Herefordshire', 'England', 'SO403465', 340368, 246557, '52.11410', '-2.87224', 127, 'HR4 7', 'County of Herefordshire', 'West Midlands', 'Hamlet'),
(48971, 'Y Bala', 'Gwynedd', 'Wales', 'SH925359', 292592, 335973, '52.91041', '-3.59862', 167, 'LL23 7', 'Gwynedd', 'Wales', 'Town'),
(48972, 'Yeabridge', 'Somerset', 'England', 'ST439158', 343970, 115895, '50.93976', '-2.79882', 37, 'TA13 5', 'South Somerset District', 'South West', 'Hamlet'),
(48973, 'Yeading', 'Greater London', 'England', 'TQ112827', 511297, 182771, '51.53289', '-0.39683', 33, 'UB5 6', 'Ealing', 'London', 'Suburban Area'),
(48974, 'Yeadon', 'West Yorkshire', 'England', 'SE208411', 420814, 441139, '53.86605', '-1.68498', 179, 'LS19 7', 'Leeds District', 'Yorkshire and the Humber', 'Town'),
(48975, 'Yealand Conyers', 'Lancashire', 'England', 'SD507746', 350710, 474656, '54.16533', '-2.75643', 57, 'LA5 9', 'Lancaster District', 'North West', 'Village'),
(48976, 'Yealand Redmayne', 'Lancashire', 'England', 'SD501758', 350132, 475849, '54.17599', '-2.76548', 48, 'LA5 9', 'Lancaster District', 'North West', 'Village'),
(48977, 'Yealand Storrs', 'Lancashire', 'England', 'SD495765', 349500, 476500, '54.18178', '-2.77527', 45, 'LA5 9', 'Lancaster District', 'North West', 'Locality'),
(48978, 'Yealmbridge', 'Devon', 'England', 'SX587522', 258726, 52235, '50.35303', '-3.98720', 52, 'PL8 2', 'South Hams District', 'South West', 'Village'),
(48979, 'Yealmpton', 'Devon', 'England', 'SX578517', 257888, 51761, '50.34857', '-3.99879', 37, 'PL8 2', 'South Hams District', 'South West', 'Village'),
(48980, 'Yearby', 'North Yorkshire', 'England', 'NZ600209', 460067, 520999, '54.58064', '-1.07219', 31, 'TS11 8', 'Redcar and Cleveland', 'North East', 'Village'),
(48981, 'Yearngill', 'Cumbria', 'England', 'NY139439', 313993, 543980, '54.78332', '-3.33885', 44, 'CA7 3', 'Allerdale District', 'North West', 'Hamlet'),
(48982, 'Yearsley', 'North Yorkshire', 'England', 'SE587745', 458772, 474528, '54.16320', '-1.10138', 174, 'YO61 4', 'Hambleton District', 'Yorkshire and the Humber', 'Village'),
(48983, 'Yeaton', 'Shropshire', 'England', 'SJ433193', 343373, 319391, '52.76913', '-2.84074', 73, 'SY4 2', 'Shropshire', 'West Midlands', 'Hamlet'),
(48984, 'Yeaveley', 'Derbyshire', 'England', 'SK184399', 418481, 339902, '52.95618', '-1.72635', 146, 'DE6 2', 'Derbyshire Dales District', 'East Midlands', 'Village'),
(48985, 'Yeavering', 'Northumberland', 'England', 'NT936302', 393653, 630283, '55.56618', '-2.10220', 57, 'NE71 6', 'Northumberland', 'North East', 'Hamlet'),
(48986, 'Yedingham', 'North Yorkshire', 'England', 'SE893794', 489322, 479437, '54.20291', '-0.63217', 22, 'YO17 8', 'Ryedale District', 'Yorkshire and the Humber', 'Village'),
(48987, 'Yelden', 'Bedfordshire', 'England', 'TL011667', 501182, 266706, '52.28918', '-0.51798', 66, 'MK44 1', 'Bedford', 'Eastern', 'Village'),
(48988, 'Yeldersley', 'Derbyshire', 'England', 'SK202445', 420240, 344501, '52.99745', '-1.69988', 170, 'DE6 1', 'Derbyshire Dales District', 'East Midlands', 'Hamlet'),
(48989, 'Yeldersley Hollies', 'Derbyshire', 'England', 'SK225435', 422500, 343500, '52.98837', '-1.66628', 151, 'DE6 1', 'Derbyshire Dales District', 'East Midlands', 'Locality'),
(48990, 'Yelford', 'Oxfordshire', 'England', 'SP359046', 435957, 204661, '51.73951', '-1.48066', 69, 'OX29 7', 'West Oxfordshire District', 'South East', 'Hamlet'),
(48991, 'Yelland', 'Devon', 'England', 'SS493321', 249301, 132144, '51.06879', '-4.15224', 18, 'EX31 3', 'North Devon District', 'South West', 'Village'),
(48992, 'Yelling', 'Cambridgeshire', 'England', 'TL258627', 525850, 262747, '52.24852', '-0.15797', 52, 'PE19 6', 'Huntingdonshire District', 'Eastern', 'Village'),
(48993, 'Yelsted', 'Kent', 'England', 'TQ824622', 582463, 162298, '51.33050', '0.61770', 85, 'ME9 7', 'Maidstone District', 'South East', 'Hamlet'),
(48994, 'Yelvertoft', 'Northamptonshire', 'England', 'SP598754', 459818, 275464, '52.37396', '-1.12276', 113, 'NN6 6', 'West Northamptonshire', 'East Midlands', 'Village'),
(48995, 'Yelverton', 'Devon', 'England', 'SX521678', 252107, 67826, '50.49152', '-4.08633', 189, 'PL20 6', 'West Devon District', 'South West', 'Village'),
(48996, 'Yelverton', 'Norfolk', 'England', 'TG292024', 629224, 302495, '52.57194', '1.38125', 42, 'NR14 7', 'South Norfolk District', 'Eastern', 'Village'),
(48997, 'Yenston', 'Somerset', 'England', 'ST714211', 371490, 121168, '50.98920', '-2.40757', 93, 'BA8 0', 'South Somerset District', 'South West', 'Village'),
(48998, 'Yeoford', 'Devon', 'England', 'SX783987', 278303, 98758, '50.77560', '-3.72738', 69, 'EX17 5', 'Mid Devon District', 'South West', 'Village'),
(48999, 'Yeolmbridge', 'Cornwall', 'England', 'SX315874', 231574, 87475, '50.66253', '-4.38445', 73, 'PL15 8', 'Cornwall', 'South West', 'Village'),
(49000, 'Yeo Mill', 'Devon', 'England', 'SS845265', 284500, 126500, '51.02623', '-3.64831', 167, 'EX36 3', 'North Devon District', 'South West', 'Locality'),
(49001, 'Yeo Vale', 'Devon', 'England', 'SS425235', 242500, 123500, '50.98929', '-4.24547', 50, 'EX39 5', 'Torridge District', 'South West', 'Locality'),
(49002, 'Yeovil', 'Somerset', 'England', 'ST555158', 355585, 115894, '50.94077', '-2.63352', 54, 'BA20 1', 'South Somerset District', 'South West', 'Town'),
(49003, 'Yeovil Marsh', 'Somerset', 'England', 'ST546187', 354604, 118707, '50.96598', '-2.64783', 32, 'BA21 3', 'South Somerset District', 'South West', 'Village'),
(49004, 'Yeovilton', 'Somerset', 'England', 'ST545229', 354559, 122978, '51.00438', '-2.64901', 22, 'BA22 8', 'South Somerset District', 'South West', 'Village'),
(49005, 'Yerbeston', 'Dyfed', 'Wales', 'SN062090', 206214, 209013, '51.74621', '-4.80852', 62, 'SA68 0', 'Pembrokeshire / Sir Benfro', 'Wales', 'Hamlet'),
(49006, 'Yesnaby', 'Orkney', 'Scotland', 'HY226158', 322684, 1015872, '59.02287', '-3.34839', 22, 'KW16 3', 'Orkney Islands', 'Scotland', 'Locality'),
(49007, 'Yetlington', 'Northumberland', 'England', 'NU025095', 402500, 609500, '55.37947', '-1.96210', 186, 'NE66 4', 'Northumberland', 'North East', 'Locality'),
(49008, 'Yetminster', 'Dorset', 'England', 'ST593108', 359342, 110843, '50.89563', '-2.57948', 63, 'DT9 6', 'Dorset', 'South West', 'Village'),
(49009, 'Yett', 'Lanarkshire', 'Scotland', 'NS775595', 277500, 659500, '55.81318', '-3.95639', 120, 'ML1 5', 'North Lanarkshire', 'Scotland', 'Locality'),
(49010, 'Yettington', 'Devon', 'England', 'SY053856', 305361, 85693, '50.66319', '-3.34039', 41, 'EX9 7', 'East Devon District', 'South West', 'Village'),
(49011, 'Yetts o\' Muckhart', 'Clackmannan', 'Scotland', 'NO005013', 300584, 701307, '56.19396', '-3.60368', 176, 'FK14 7', 'Clackmannanshire', 'Scotland', 'Hamlet'),
(49012, 'Yew Green', 'Warwickshire', 'England', 'SP225675', 422500, 267500, '52.30516', '-1.67144', 115, 'CV35 7', 'Warwick District', 'West Midlands', 'Locality'),
(49013, 'Yewhedges', 'Kent', 'England', 'TQ964554', 596458, 155431, '51.26417', '0.81456', 105, 'ME13 0', 'Swale District', 'South East', 'Hamlet'),
(49014, 'Yews Hill', 'West Yorkshire', 'England', 'SE132153', 413215, 415383, '53.63480', '-1.80162', 108, 'HD4 5', 'Kirklees District', 'Yorkshire and the Humber', 'Suburban Area'),
(49015, 'Yewstock', 'Dorset', 'England', 'ST787153', 378746, 115318, '50.93691', '-2.30385', 93, 'DT10 1', 'Dorset', 'South West', 'Locality'),
(49016, 'Yew Tree', 'Greater Manchester', 'England', 'SJ957971', 395761, 397108, '53.47069', '-2.06533', 157, 'SK16 5', 'Tameside District', 'North West', 'Suburban Area'),
(49017, 'Yew Tree', 'West Midlands', 'England', 'SP026955', 402656, 295541, '52.55770', '-1.96226', 125, 'WS5 4', 'Sandwell District', 'West Midlands', 'Suburban Area'),
(49018, 'Yewtree Cross', 'Kent', 'England', 'TR165415', 616500, 141500, '51.13183', '1.09301', 98, 'CT18 8', 'Folkestone and Hythe District', 'South East', 'Locality'),
(49019, 'Yew Tree Green', 'Kent', 'England', 'TQ703420', 570372, 142092, '51.15273', '0.43471', 27, 'TN12 8', 'Tunbridge Wells District', 'South East', 'Hamlet'),
(49020, 'Y Fan', 'Powys', 'Wales', 'SN949876', 294985, 287667, '52.47679', '-3.54762', 179, 'SY18 6', 'Powys', 'Wales', 'Village'),
(49021, 'Y Felinheli', 'Gwynedd', 'Wales', 'SH525677', 252507, 367777, '53.18658', '-4.20884', 8, 'LL56 4', 'Gwynedd', 'Wales', 'Village'),
(49022, 'Y Ferwig', 'Dyfed', 'Wales', 'SN184495', 218441, 249589, '52.11473', '-4.65304', 90, 'SA43 1', 'Ceredigion / Sir Ceredigion', 'Wales', 'Village'),
(49023, 'Y Ffald', 'Dyfed', 'Wales', 'SN619846', 261960, 284690, '52.44269', '-4.03233', 30, 'SY24 5', 'Ceredigion / Sir Ceredigion', 'Wales', 'Locality'),
(49024, 'Y Ffôr', 'Gwynedd', 'Wales', 'SH399390', 239927, 339070, '52.92512', '-4.38266', 59, 'LL53 6', 'Gwynedd', 'Wales', 'Village'),
(49025, 'Y-Ffrith', 'Clwyd', 'Wales', 'SJ044828', 304496, 382840, '53.33382', '-3.43564', 10, 'LL19 7', 'Denbighshire / Sir Ddinbych', 'Wales', 'Suburban Area'),
(49026, 'Y Fron', 'Gwynedd', 'Wales', 'SH508548', 250801, 354844, '53.06994', '-4.22833', 287, 'LL54 7', 'Gwynedd', 'Wales', 'Village'),
(49027, 'Y Gribyn', 'Powys', 'Wales', 'SN925915', 292500, 291500, '52.51076', '-3.58543', 323, 'SY17 5', 'Powys', 'Wales', 'Locality'),
(49028, 'Yieldingtree', 'Worcestershire', 'England', 'SO896774', 389615, 277438, '52.39486', '-2.15404', 92, 'DY9 0', 'Wyre Forest District', 'West Midlands', 'Hamlet'),
(49029, 'Yieldshields', 'Lanarkshire', 'Scotland', 'NS871506', 287171, 650645, '55.73601', '-3.79848', 265, 'ML8 4', 'South Lanarkshire', 'Scotland', 'Hamlet'),
(49030, 'Yiewsley', 'Greater London', 'England', 'TQ060804', 506072, 180478, '51.51328', '-0.47282', 35, 'UB7 7', 'Hillingdon', 'London', 'Locality'),
(49031, 'Yinstay', 'Orkney', 'Scotland', 'HY510103', 351056, 1010331, '58.97732', '-2.85307', 20, 'KW17 2', 'Orkney Islands', 'Scotland', 'Locality'),
(49032, 'Ynus-tawelog', 'West Glamorgan', 'Wales', 'SN625095', 262500, 209500, '51.76724', '-3.99402', 48, 'SA18 2', 'Swansea / Abertawe', 'Wales', 'Locality'),
(49033, 'Ynys', 'Gwynedd', 'Wales', 'SH597352', 259707, 335240, '52.89624', '-4.08699', 9, 'LL47 6', 'Gwynedd', 'Wales', 'Village'),
(49034, 'Ynysboeth', 'Mid Glamorgan', 'Wales', 'ST071961', 307162, 196170, '51.65662', '-3.34347', 115, 'CF45 4', 'Rhondda Cynon Taf', 'Wales', 'Suburban Area'),
(49035, 'Ynysddu', 'Gwent', 'Wales', 'ST180926', 318037, 192650, '51.62667', '-3.18547', 113, 'NP11 7', 'Caerphilly / Caerffili', 'Wales', 'Village'),
(49036, 'Ynys-fach', 'Mid Glamorgan', 'Wales', 'SO044062', 304498, 206289, '51.74713', '-3.38474', 173, 'CF48 1', 'Merthyr Tydfil / Merthyr Tudful', 'Wales', 'Suburban Area'),
(49037, 'Ynysforgan', 'West Glamorgan', 'Wales', 'SS675993', 267599, 199372, '51.67746', '-3.91632', 25, 'SA6 6', 'Swansea / Abertawe', 'Wales', 'Suburban Area'),
(49038, 'Ynyshir', 'Mid Glamorgan', 'Wales', 'ST023926', 302393, 192676, '51.62441', '-3.41141', 118, 'CF39 0', 'Rhondda Cynon Taf', 'Wales', 'Suburban Area'),
(49039, 'Ynys-isaf', 'Powys', 'Wales', 'SN795115', 279524, 211572, '51.78979', '-3.74816', 102, 'SA9 1', 'Powys', 'Wales', 'Suburban Area'),
(49040, 'Ynyslas', 'Dyfed', 'Wales', 'SN608924', 260820, 292473, '52.51232', '-4.05235', 4, 'SY24 5', 'Ceredigion / Sir Ceredigion', 'Wales', 'Village'),
(49041, 'Ynysmaerdy', 'Mid Glamorgan', 'Wales', 'ST032845', 303268, 184526, '51.55130', '-3.39653', 69, 'CF72 8', 'Rhondda Cynon Taf', 'Wales', 'Suburban Area'),
(49042, 'Ynysmaerdy', 'West Glamorgan', 'Wales', 'SS748951', 274821, 195116, '51.64087', '-3.81040', 26, 'SA11 2', 'Neath Port Talbot / Castell-nedd Port Talbot', 'Wales', 'Suburban Area'),
(49043, 'Ynysmeudwy', 'West Glamorgan', 'Wales', 'SN736054', 273618, 205440, '51.73338', '-3.83151', 65, 'SA8 4', 'Neath Port Talbot / Castell-nedd Port Talbot', 'Wales', 'Suburban Area'),
(49044, 'Ynys Tachwedd', 'Dyfed', 'Wales', 'SN605935', 260500, 293500, '52.52147', '-4.05749', 5, 'SY24 5', 'Ceredigion / Sir Ceredigion', 'Wales', 'Locality'),
(49045, 'Ynystawe', 'West Glamorgan', 'Wales', 'SN682003', 268275, 200324, '51.68618', '-3.90690', 23, 'SA6 5', 'Swansea / Abertawe', 'Wales', 'Suburban Area'),
(49046, 'Ynys-uchaf', 'Powys', 'Wales', 'SN798115', 279886, 211514, '51.78935', '-3.74290', 100, 'SA9 1', 'Powys', 'Wales', 'Suburban Area'),
(49047, 'Ynyswen', 'Mid Glamorgan', 'Wales', 'SS948973', 294892, 197340, '51.66498', '-3.52113', 173, 'CF42 6', 'Rhondda Cynon Taf', 'Wales', 'Suburban Area'),
(49048, 'Ynyswen', 'Powys', 'Wales', 'SN836130', 283676, 213091, '51.80432', '-3.68850', 156, 'SA9 1', 'Powys', 'Wales', 'Village'),
(49049, 'Ynysybwl', 'Mid Glamorgan', 'Wales', 'ST060940', 306035, 194089, '51.63773', '-3.35920', 142, 'CF37 3', 'Rhondda Cynon Taf', 'Wales', 'Village'),
(49050, 'Ynysygwas', 'West Glamorgan', 'Wales', 'SS785915', 278500, 191500, '51.60918', '-3.75600', 129, 'SA13 2', 'Neath Port Talbot / Castell-nedd Port Talbot', 'Wales', 'Locality'),
(49051, 'Yockenthwaite', 'North Yorkshire', 'England', 'SD904790', 390448, 479027, '54.20690', '-2.14794', 268, 'BD23 5', 'Craven District', 'Yorkshire and the Humber', 'Locality'),
(49052, 'Yockleton', 'Shropshire', 'England', 'SJ401101', 340117, 310143, '52.68565', '-2.88731', 96, 'SY5 9', 'Shropshire', 'West Midlands', 'Village'),
(49053, 'Yokefleet', 'East Riding of Yorkshire', 'England', 'SE821242', 482126, 424242, '53.70815', '-0.75729', 6, 'DN14 7', 'East Riding of Yorkshire', 'Yorkshire and the Humber', 'Village'),
(49054, 'Yoker', 'City of Glasgow', 'Scotland', 'NS515689', 251594, 668960, '55.89083', '-4.37460', 9, 'G13 4', 'Glasgow City', 'Scotland', 'Suburban Area'),
(49055, 'Yondercott', 'Devon', 'England', 'ST074125', 307489, 112581, '50.90526', '-3.31707', 88, 'EX15 3', 'Mid Devon District', 'South West', 'Village'),
(49056, 'Yondertown', 'Devon', 'England', 'SX592590', 259254, 59094, '50.41481', '-3.98235', 130, 'PL21 9', 'South Hams District', 'South West', 'Village'),
(49057, 'Yondover', 'Dorset', 'England', 'SY498938', 349848, 93854, '50.74212', '-2.71214', 35, 'DT6 4', 'Dorset', 'South West', 'Hamlet'),
(49058, 'Yopps Green', 'Kent', 'England', 'TQ602539', 560236, 153908, '51.26181', '0.29518', 110, 'TN15 0', 'Tonbridge and Malling District', 'South East', 'Hamlet'),
(49059, 'York', 'Lancashire', 'England', 'SD709336', 370930, 433676, '53.79857', '-2.44282', 102, 'BB6 8', 'Ribble Valley District', 'North West', 'Hamlet'),
(49060, 'York', 'North Yorkshire', 'England', 'SE602521', 460218, 452158, '53.96201', '-1.08367', 24, 'YO1 7', 'York', 'Yorkshire and the Humber', 'City'),
(49061, 'Yorkhill', 'City of Glasgow', 'Scotland', 'NS566660', 256615, 666027, '55.86602', '-4.29283', 27, 'G3 8', 'Glasgow City', 'Scotland', 'Suburban Area'),
(49062, 'Yorkletts', 'Kent', 'England', 'TR092633', 609237, 163312, '51.33040', '1.00208', 18, 'CT5 3', 'Canterbury District', 'South East', 'Village'),
(49063, 'Yorkley', 'Gloucestershire', 'England', 'SO630066', 363029, 206634, '51.75716', '-2.53703', 118, 'GL15 4', 'Forest of Dean District', 'South West', 'Village'),
(49064, 'Yorkley Slade', 'Gloucestershire', 'England', 'SO641071', 364178, 207171, '51.76207', '-2.52044', 186, 'GL15 4', 'Forest of Dean District', 'South West', 'Village'),
(49065, 'York Town', 'Surrey', 'England', 'SU858601', 485818, 160138, '51.33387', '-0.76953', 62, 'GU15 3', 'Surrey Heath District', 'South East', 'Suburban Area'),
(49066, 'Yorton', 'Shropshire', 'England', 'SJ504238', 350447, 323820, '52.80964', '-2.73658', 89, 'SY4 3', 'Shropshire', 'West Midlands', 'Hamlet'),
(49067, 'Yorton Heath', 'Shropshire', 'England', 'SJ505223', 350541, 322319, '52.79615', '-2.73495', 83, 'SY4 3', 'Shropshire', 'West Midlands', 'Hamlet'),
(49068, 'Yottenfews', 'Cumbria', 'England', 'NY035055', 303500, 505500, '54.43572', '-3.48927', 46, 'CA20 1', 'Copeland District', 'North West', 'Locality'),
(49069, 'Youlgreave', 'Derbyshire', 'England', 'SK210642', 421057, 364280, '53.17522', '-1.68642', 186, 'DE45 1', 'Derbyshire Dales District', 'East Midlands', 'Village'),
(49070, 'Youlieburn', 'Aberdeenshire', 'Scotland', 'NJ876319', 387676, 831966, '57.37797', '-2.20660', 58, 'AB41 7', 'Aberdeenshire', 'Scotland', 'Locality'),
(49071, 'Youlthorpe', 'East Riding of Yorkshire', 'England', 'SE766556', 476642, 455640, '53.99113', '-0.83253', 41, 'YO41 5', 'East Riding of Yorkshire', 'Yorkshire and the Humber', 'Hamlet'),
(49072, 'Youlton', 'North Yorkshire', 'England', 'SE490635', 449076, 463505, '54.06516', '-1.25165', 22, 'YO61 1', 'Hambleton District', 'Yorkshire and the Humber', 'Hamlet'),
(49073, 'Youngsbury', 'Hertfordshire', 'England', 'TL375185', 537500, 218500, '51.84817', '-0.00522', 92, 'SG12 0', 'East Hertfordshire District', 'Eastern', 'Locality'),
(49074, 'Young\'s End', 'Essex', 'England', 'TL739195', 573915, 219574, '51.84767', '0.52349', 77, 'CM77 8', 'Chelmsford District', 'Eastern', 'Hamlet'),
(49075, 'Young Wood', 'Lincolnshire', 'England', 'TF135715', 513500, 371500, '53.22842', '-0.30121', 18, 'LN3 5', 'West Lindsey District', 'East Midlands', 'Locality'),
(49076, 'Yoxall', 'Staffordshire', 'England', 'SK142188', 414214, 318805, '52.76666', '-1.79078', 65, 'DE13 8', 'East Staffordshire District', 'West Midlands', 'Village'),
(49077, 'Yoxford', 'Suffolk', 'England', 'TM394690', 639435, 269023, '52.26720', '1.50769', 16, 'IP17 3', 'East Suffolk District', 'Eastern', 'Village'),
(49078, 'Y Parc', 'Mid Glamorgan', 'Wales', 'SS849904', 284913, 190486, '51.60142', '-3.66310', 200, 'CF34 9', 'Bridgend / Pen-y-bont ar Ogwr', 'Wales', 'Suburban Area'),
(49079, 'Ysbyty Cynfyn', 'Dyfed', 'Wales', 'SN755792', 275583, 279202, '52.39665', '-3.82998', 260, 'SY23 3', 'Ceredigion / Sir Ceredigion', 'Wales', 'Locality'),
(49080, 'Ysbyty Ifan', 'Clwyd', 'Wales', 'SH841488', 284172, 348837, '53.02425', '-3.72837', 220, 'LL24 0', 'Conwy', 'Wales', 'Village'),
(49081, 'Ysbyty Ystwyth', 'Dyfed', 'Wales', 'SN731714', 273171, 271448, '52.32642', '-3.86248', 224, 'SY25 6', 'Ceredigion / Sir Ceredigion', 'Wales', 'Village'),
(49082, 'Ysceifiog', 'Clwyd', 'Wales', 'SJ152715', 315281, 371539, '53.23410', '-3.27071', 185, 'CH8 8', 'Flintshire / Sir y Fflint', 'Wales', 'Village'),
(49083, 'Ysgeibion', 'Clwyd', 'Wales', 'SJ065585', 306500, 358500, '53.11545', '-3.39841', 265, 'LL15 2', 'Denbighshire / Sir Ddinbych', 'Wales', 'Locality'),
(49084, 'Ysgubor Newydd', 'Mid Glamorgan', 'Wales', 'SO057056', 305787, 205625, '51.74138', '-3.36590', 222, 'CF47 0', 'Merthyr Tydfil / Merthyr Tudful', 'Wales', 'Suburban Area'),
(49085, 'Yspitty', 'Dyfed', 'Wales', 'SS555985', 255500, 198500, '51.66664', '-4.09082', 7, 'SA14 9', 'Carmarthenshire / Sir Gaerfyrddin', 'Wales', 'Locality'),
(49086, 'Ystalyfera', 'West Glamorgan', 'Wales', 'SN769090', 276966, 209006, '51.76617', '-3.78432', 82, 'SA9 2', 'Neath Port Talbot / Castell-nedd Port Talbot', 'Wales', 'Village'),
(49087, 'Ystrad', 'Mid Glamorgan', 'Wales', 'SS991949', 299146, 194910, '51.64391', '-3.45895', 174, 'CF41 7', 'Rhondda Cynon Taf', 'Wales', 'Suburban Area'),
(49088, 'Ystrad Aeron', 'Dyfed', 'Wales', 'SN524558', 252434, 255869, '52.18128', '-4.15973', 87, 'SA48 7', 'Ceredigion / Sir Ceredigion', 'Wales', 'Village'),
(49089, 'Ystrad Fawr', 'Mid Glamorgan', 'Wales', 'SS898798', 289881, 179870, '51.50700', '-3.58807', 45, 'CF31 4', 'Bridgend / Pen-y-bont ar Ogwr', 'Wales', 'Suburban Area'),
(49090, 'Ystradfellte', 'Powys', 'Wales', 'SN930134', 293009, 213461, '51.80951', '-3.55331', 253, 'CF44 9', 'Powys', 'Wales', 'Hamlet'),
(49091, 'Ystradgynlais', 'Powys', 'Wales', 'SN787102', 278784, 210226, '51.77753', '-3.75841', 79, 'SA9 1', 'Powys', 'Wales', 'Town'),
(49092, 'Ystradmeurig', 'Dyfed', 'Wales', 'SN703676', 270345, 267642, '52.29157', '-3.90245', 206, 'SY25 6', 'Ceredigion / Sir Ceredigion', 'Wales', 'Village'),
(49093, 'Ystrad Mynach', 'Gwent', 'Wales', 'ST145943', 314545, 194330, '51.64125', '-3.23632', 110, 'CF82 7', 'Caerphilly / Caerffili', 'Wales', 'Town'),
(49094, 'Ystradowen', 'Dyfed', 'Wales', 'SN749124', 274976, 212473, '51.79689', '-3.81439', 161, 'SA9 2', 'Carmarthenshire / Sir Gaerfyrddin', 'Wales', 'Village'),
(49095, 'Ystradowen', 'South Glamorgan', 'Wales', 'ST018778', 301865, 177860, '51.49114', '-3.41490', 63, 'CF71 7', 'The Vale of Glamorgan / Bro Morgannwg', 'Wales', 'Village'),
(49096, 'Ystrad Uchaf', 'Powys', 'Wales', 'SJ075045', 307500, 304500, '52.63034', '-3.36811', 284, 'SY21 0', 'Powys', 'Wales', 'Locality'),
(49097, 'Ystumtuen', 'Dyfed', 'Wales', 'SN735786', 273546, 278669, '52.39140', '-3.85970', 267, 'SY23 3', 'Ceredigion / Sir Ceredigion', 'Wales', 'Hamlet'),
(49098, 'Ythanbank', 'Aberdeenshire', 'Scotland', 'NJ903343', 390375, 834360, '57.39954', '-2.16181', 23, 'AB41 7', 'Aberdeenshire', 'Scotland', 'Village'),
(49099, 'Ythanwells', 'Aberdeenshire', 'Scotland', 'NJ633384', 363396, 838458, '57.43497', '-2.61132', 231, 'AB54 6', 'Aberdeenshire', 'Scotland', 'Hamlet'),
(49100, 'Ythsie', 'Aberdeenshire', 'Scotland', 'NJ886307', 388694, 830762, '57.36718', '-2.18961', 82, 'AB41 7', 'Aberdeenshire', 'Scotland', 'Hamlet'),
(49101, 'Y Wern', 'Gwynedd', 'Wales', 'SH520667', 252005, 366737, '53.17710', '-4.21586', 66, 'LL56 4', 'Gwynedd', 'Wales', 'Suburban Area'),
(49102, 'Y Wig', 'Powys', 'Wales', 'SJ082122', 308252, 312274, '52.70034', '-3.35917', 160, 'SY21 0', 'Powys', 'Wales', 'Hamlet'),
(49103, 'Zeal Monachorum', 'Devon', 'England', 'SS719040', 271915, 104013, '50.82145', '-3.81977', 146, 'EX17 6', 'Mid Devon District', 'South West', 'Village'),
(49104, 'Zeals', 'Wiltshire', 'England', 'ST781318', 378175, 131800, '51.08510', '-2.31297', 143, 'BA12 6', 'Wiltshire', 'South West', 'Village'),
(49105, 'Zeals Row', 'Wiltshire', 'England', 'ST773320', 377331, 132002, '51.08688', '-2.32503', 157, 'BA12 6', 'Wiltshire', 'South West', 'Hamlet'),
(49106, 'Zelah', 'Cornwall', 'England', 'SW811518', 181113, 51836, '50.32571', '-5.07658', 82, 'TR4 9', 'Cornwall', 'South West', 'Village'),
(49107, 'Zennor', 'Cornwall', 'England', 'SW454384', 145460, 38482, '50.19152', '-5.56754', 103, 'TR26 3', 'Cornwall', 'South West', 'Hamlet'),
(49108, 'Zoar', 'Cornwall', 'England', 'SW765195', 176500, 19500, '50.03360', '-5.12228', 96, 'TR12 6', 'Cornwall', 'South West', 'Locality'),
(49109, 'Zouch', 'Nottinghamshire', 'England', 'SK506234', 450698, 323436, '52.80610', '-1.24938', 37, 'LE12 5', 'Rushcliffe District', 'East Midlands', 'Village');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profile_type` int(4) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `profile_background` varchar(255) NOT NULL,
  `verified` varchar(4) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `tagline` varchar(40) NOT NULL,
  `about` text NOT NULL,
  `user_closed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_type`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `profile_background`, `verified`, `sport`, `website`, `tagline`, `about`, `user_closed`) VALUES
(34, 1, 'Nome', 'Sobrenome', 'usernameteste', 'teste@gmail.com', '$2y$10$Jmri6KovNVgC82kZznVwUOjUB4zyIYxIhSIKDuC/XeFQqFYV02KcK', '2021-03-08', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 'yes', 'Football', '', '', '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

CREATE TABLE `user_follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individuals`
--
ALTER TABLE `individuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uk_towns`
--
ALTER TABLE `uk_towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `individuals`
--
ALTER TABLE `individuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
