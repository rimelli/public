-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2021 at 03:32 PM
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
  `job_salary` varchar(50) NOT NULL,
  `job_salary_min` int(11) NOT NULL,
  `job_salary_max` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `employer_email` varchar(50) NOT NULL,
  `employer_website` varchar(50) NOT NULL,
  `job_post_date` date NOT NULL,
  `job_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `job_title`, `job_position`, `job_category`, `job_type`, `job_sport`, `job_country`, `job_city`, `job_salary`, `job_salary_min`, `job_salary_max`, `job_description`, `employer_email`, `employer_website`, `job_post_date`, `job_deleted`) VALUES
(1, 34, 'Player', 'Player', 'Full time', 'Onsite', 'Football', 'England', 'London', 'Fixed', 1000, 2000, '', '', '', '2021-08-18', 'no'),
(2, 34, 'Coach', 'Head coach', 'Part time', 'Remote', 'Football', 'Northern ireland', 'Belfast', 'Hourly', 200, 400, '', '', '', '2021-08-17', 'no'),
(3, 34, 'Assistant', 'Assistant Coach', 'Part time', 'Both', 'Football', 'Northern Ireland', 'Belfast', 'Fixed', 370, 560, '', '', '', '2021-08-16', 'no'),
(4, 34, 'Trainer', 'Physical Trainer', 'Part Time', 'Remote', 'Football', 'Northern Ireland', 'Belfast', 'Hourly', 2000, 4000, '', '', '', '2021-08-19', 'no'),
(5, 34, 'Coach', 'Head Coach', 'Full Time', 'Onsite', 'Football', 'England', 'Leeds', 'Fixed', 250, 500, '', '', '', '2021-08-12', 'no');

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
  `verified` varchar(4) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `user_closed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_type`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `verified`, `sport`, `user_closed`) VALUES
(19, 1, 'John', 'Williams', 'johnwilliams', 'johnwill@gmail.com', '$2y$10$Jmri6KovNVgC82kZznVwUOjUB4zyIYxIhSIKDuC/XeFQqFYV02KcK', '2021-03-08', '', 'yes', 'Football', 'no'),
(33, 1, 'Justin', 'Schneider', 'justinschneider', 'justinsch@gmail.com', '$2y$10$ZloEUGEINyNvdQP8.1QLh.BPlQMEGHEuxKl./3w3bFGiUCa/Zeix6', '2021-06-15', '', 'yes', 'Football', 'no'),
(34, 1, 'Daniel', 'Elkins', 'danielelkins', 'danielelk@live.fr', '$2y$10$hvdjdpNjmimhngCZ/3YzveDslX1Cts21rkU6Q9cbYa/1012E0Hgui', '2021-06-16', '', 'yes', 'Football', 'no'),
(35, 1, 'Victor', 'Duenas', 'victorduenas', 'victorduenas@gmail.com', '$2y$10$MkELX9AJ3HqOqQYpxUozIuzfdfWaERffi.WhrXHgNqnGKxnM723cy', '2021-06-16', '', 'yes', 'Football', 'no'),
(36, 1, 'James', 'Crawford', 'jamescrawford', 'jamescraw@gmail.com', '$2y$10$0h4aeA6Sl.S7KsZ/NfOBq.keZ54KtX40tGH9e0uMpgwAnif1cwLAi', '2021-07-23', '', 'yes', 'Football', 'no'),
(37, 1, 'Chris', 'Tate', 'christate', 'christate@gmail.com', '$2y$10$h8tkWyCwpNUK2Pq7lY/CN.2tJzNwJ0m76vG4X1SFJSMMvXPLbikLm', '2021-07-23', '', 'yes', 'Football', 'no'),
(38, 1, 'Jack', 'Webb', 'jackwebb', 'jackwebb@gmail.com', '$2y$10$nZ/kSU8pqq2EbEIm/TIPHe8ewaKaYjjbmhf9rTn/ZmQ6uLwlxvNq2', '2021-07-23', '', 'yes', 'Football', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
