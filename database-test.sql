-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2021 at 10:37 AM
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
-- Database: `database-test`
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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(5, 'Comment 1', '1', '1', '2021-12-06 11:01:36', 'no', 90),
(6, 'comment 2', '1', '1', '2021-12-10 18:03:02', 'no', 90),
(7, 'comment 3', '1', '1', '2021-12-10 18:03:10', 'no', 90),
(8, 'Comment post 2', '1', '1', '2021-12-10 18:04:15', 'no', 91),
(9, 'comment 3', '1', '1', '2021-12-22 16:40:31', 'no', 91),
(10, 'com 4', '1', '1', '2021-12-22 16:40:39', 'no', 91),
(11, '567', '1', '1', '2021-12-22 16:41:24', 'no', 91),
(12, '8', '1', '1', '2021-12-22 17:23:06', 'no', 91),
(13, '9', '1', '1', '2021-12-22 17:32:11', 'no', 91);

-- --------------------------------------------------------

--
-- Table structure for table `comments_replies`
--

CREATE TABLE `comments_replies` (
  `id` int(11) NOT NULL,
  `reply_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `individuals`
--

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individuals`
--

INSERT INTO `individuals` (`id`, `user_id`) VALUES
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(28, 23);

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

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `user_id`, `nationality`, `country_name`) VALUES
(6, 1, '', ''),
(7, 2, '', ''),
(8, 3, '', ''),
(9, 4, '', ''),
(10, 5, '', ''),
(11, 6, '', ''),
(12, 7, '', ''),
(13, 8, '', ''),
(14, 9, '', ''),
(15, 10, '', ''),
(16, 11, '', ''),
(17, 12, '', ''),
(18, 13, '', ''),
(19, 14, '', ''),
(20, 15, '', ''),
(21, 16, '', ''),
(22, 17, '', ''),
(23, 18, '', ''),
(24, 19, '', ''),
(25, 20, '', ''),
(26, 21, '', ''),
(27, 22, '', ''),
(28, 23, '', '');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(15, 1, 1, 'User Upwork posted on your profile', 'post.php?id=89', '2021-12-06 10:14:54', 'no', 'yes'),
(16, 1, 1, 'User Upwork posted on your profile', 'post.php?id=90', '2021-12-06 10:19:44', 'no', 'yes'),
(17, 1, 1, 'User Upwork posted on your profile', 'post.php?id=91', '2021-12-10 18:04:05', 'no', 'yes'),
(18, 1, 7, 'Ricardo Lima liked your post', 'post.php?id=91', '2021-12-21 07:49:54', 'no', 'yes'),
(19, 1, 7, 'Ricardo Lima liked your post', 'post.php?id=91', '2021-12-21 07:51:04', 'no', 'yes'),
(20, 1, 7, 'Ricardo Lima liked your post', 'post.php?id=91', '2021-12-21 07:51:06', 'no', 'yes'),
(21, 1, 7, 'Ricardo Lima liked your post', 'post.php?id=91', '2021-12-21 07:51:07', 'no', 'yes'),
(22, 1, 7, 'Ricardo Lima liked your post', 'post.php?id=91', '2021-12-21 07:51:09', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
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
(90, 'Post 1', 1, 1, '2021-12-06 10:19:44', 'no', 'no', 0, ''),
(91, 'Post 2', 1, 1, '2021-12-10 18:04:05', 'no', 'no', 0, '');

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
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_type`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `profile_background`, `num_posts`, `num_likes`, `user_closed`) VALUES
(1, 1, 'User', 'Upwork', 'userupwork', 'user@gmail.com', '$2y$10$pAxtL1XQ5PmflwdU8vuHZuHaIsKl9VBr0F4bBvCrZphOVcctHeGOa', '2021-12-06', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 2, 0, 'no'),
(2, 1, 'User2', 'Upwork2', 'user2upwork2', 'user2@gmail.com', '$2y$10$xnx2cN1Ip4G1Q1I/CxSsLOoiTJhYywc/RgE967HmjAwgfsaFhPyHO', '2021-12-06', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no'),
(3, 1, 'User3', 'Test', 'user3test', 'user3@gmail.com', '$2y$10$ZY958Jsccr2t7EMyLLZkreLbeV8kLjejRuC24UPyJTmZotmPMuGQa', '2021-12-10', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no'),
(4, 1, 'User4', 'Teste', 'user4teste', 'user4@gmail.com', '$2y$10$AQOM4.nconv/tYIVyxPmTeNnngyJlktcq6eczX5/TWjgsMcqmI4Xq', '2021-12-10', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no'),
(5, 1, 'User6', 'Test', 'user6test', 'user6@gmail.com', '$2y$10$FqozolMPxavBz6InLpq02ugd1HIqAq/p1UJrns4ypTYAlNIj2PSjC', '2021-12-10', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no'),
(6, 1, 'User7', 'Test', 'user7test', 'user7@gmail.com', '$2y$10$WZcgX6LlM1Oo3HQVt4u8MeGYPAC/C.KGN1mSnxRskVW87gXYLiDGq', '2021-12-10', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no'),
(23, 1, 'User10', 'Test', 'user10test', 'user10@gmail.com', '$2y$10$//3eC/S7UfVPY6daaTbhv.NyfU3rTmPudLVFrs3zdvUDrafOq35gG', '2021-12-23', 'assets/images/profile_pics/defaults/profileimg.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', 0, 0, 'no');

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
-- Indexes for table `comments_replies`
--
ALTER TABLE `comments_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individuals`
--
ALTER TABLE `individuals`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments_replies`
--
ALTER TABLE `comments_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `individuals`
--
ALTER TABLE `individuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
