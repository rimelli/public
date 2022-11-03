-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2022 at 01:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks_events`
--

CREATE TABLE `bookmarks_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks_jobs`
--

CREATE TABLE `bookmarks_jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks_profiles`
--

CREATE TABLE `bookmarks_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `event_category` varchar(100) NOT NULL,
  `event_sport` varchar(50) NOT NULL,
  `event_gender` varchar(50) NOT NULL,
  `event_age_month_from` varchar(50) NOT NULL,
  `event_age_year_from` int(11) NOT NULL,
  `event_age_month_to` varchar(50) NOT NULL,
  `event_age_year_to` int(11) NOT NULL,
  `event_online` varchar(10) NOT NULL,
  `event_city` varchar(100) NOT NULL,
  `event_county` varchar(100) NOT NULL,
  `event_country` varchar(100) NOT NULL,
  `event_latitude` decimal(8,5) NOT NULL,
  `event_longitude` decimal(8,5) NOT NULL,
  `event_fee` int(11) NOT NULL,
  `event_description` text NOT NULL,
  `event_email` varchar(50) NOT NULL,
  `event_website` varchar(50) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_post_date` date NOT NULL,
  `event_status` varchar(50) NOT NULL,
  `event_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_name` varchar(100) NOT NULL,
  `application_date` date NOT NULL,
  `application_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `home_away` varchar(5) NOT NULL,
  `your_goal_score` int(11) DEFAULT 0,
  `other_goal_score` int(11) DEFAULT 0,
  `your_team` int(11) NOT NULL,
  `fixture_date` datetime NOT NULL,
  `other_team_name` varchar(150) NOT NULL,
  `other_team_id` int(11) NOT NULL,
  `player_in` int(11) DEFAULT 0 ,
  `player_out` int(11) DEFAULT 0,
  `kick_off` smallint(1),
  `half_time` smallint(1),
  `full_time` smallint(1),
  `fixture_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `user_id`, `home_away`, `your_team`, `fixture_date`, `other_team_name`, `other_team_id`, `fixture_deleted`) VALUES
(1, 96, 'home', 2, '2022-09-15 12:00:00', 'Thunder FC', 96, 'no'),
(2, 96, 'away', 3, '2022-09-16 12:00:00', 'Rubro', 96, 'yes'),
(3, 96, 'away', 4, '2022-09-19 12:00:00', 'Individual User', 95, 'no'),
(4, 96, 'home', 3, '2022-09-21 12:00:00', 'Grassroots Football', 96, 'yes'),
(5, 96, 'home', 3, '2022-09-21 12:00:00', 'City FC', 96, 'no'),
(6, 96, 'home', 3, '2022-09-21 12:00:00', 'Bay United', 96, 'no'),
(7, 96, 'away', 4, '2022-09-15 12:00:00', 'CF Real', 96, 'no'),
(8, 96, 'home', 4, '2022-09-14 12:00:00', 'Individual User', 95, 'no'),
(9, 96, 'away', 2, '2022-09-14 12:00:00', 'North FC', 96, 'no'),
(10, 96, 'home', 4, '2022-09-15 12:00:00', 'South SC', 96, 'no'),
(11, 96, 'home', 6, '2022-09-23 12:00:00', 'AFK', 96, 'no'),
(12, 96, 'home', 2, '2022-09-16 12:00:00', 'Ludo', 96, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `individuals`
--

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_player` varchar(4) NOT NULL,
  `amateur_player` varchar(4) NOT NULL,
  `coach` varchar(4) NOT NULL,
  `scout` varchar(4) NOT NULL,
  `agent` varchar(4) NOT NULL,
  `referee` varchar(4) NOT NULL,
  `parent` varchar(4) NOT NULL,
  `other` varchar(4) NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country_based` varchar(100) NOT NULL,
  `city_based` varchar(100) NOT NULL,
  `county_based` varchar(100) NOT NULL,
  `user_latitude` decimal(8,5) DEFAULT NULL,
  `user_longitude` decimal(8,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `job_latitude` decimal(8,5) NOT NULL,
  `job_longitude` decimal(8,5) NOT NULL,
  `job_salary_min` int(11) NOT NULL,
  `job_salary_max` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `employer_email` varchar(50) NOT NULL,
  `employer_website` varchar(50) NOT NULL,
  `job_post_date` date NOT NULL,
  `job_exp_date` date NOT NULL,
  `job_status` varchar(50) NOT NULL,
  `job_deleted` varchar(4) NOT NULL,
  `job_featured` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `application_date` date NOT NULL,
  `application_deleted` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `body` text NOT NULL,
  `sent_on` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_text` varchar(150) NOT NULL,
  `note_priority` varchar(50) NOT NULL,
  `note_post_date` date NOT NULL,
  `note_deleted` varchar(4) NOT NULL
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
  `academy` varchar(4) NOT NULL,
  `country_based` varchar(100) NOT NULL,
  `city_based` varchar(100) NOT NULL,
  `county_based` varchar(100) NOT NULL,
  `user_latitude` decimal(8,5) DEFAULT NULL,
  `user_longitude` decimal(8,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `user_id`, `pro_club`, `amateur_club`, `academy`, `country_based`, `city_based`, `county_based`, `user_latitude`, `user_longitude`) VALUES
(20, 96, 'yes', 'no', 'no', '', '', '', '0.00000', '0.00000');

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

-- --------------------------------------------------------

--
-- Table structure for table `profile_attachments`
--

CREATE TABLE `profile_attachments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetype` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `attach_deleted` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_galleries`
--

CREATE TABLE `profile_galleries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetype` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `gallery_deleted` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `profile_count` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `views_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `user_id`, `team_name`, `team_deleted`) VALUES
(1, 96, 'First Team', 'yes'),
(2, 96, 'Reserves', 'no'),
(3, 96, '3rd', 'no'),
(4, 96, '4th', 'no'),
(5, 96, '5th', 'no'),
(6, 96, '6th', 'no'),
(7, 96, '7', 'no'),
(8, 96, '8', 'no'),
(9, 96, '9', 'yes'),
(10, 96, '10', 'no'),
(11, 96, '11', 'yes'),
(12, 96, '12', 'yes'),
(13, 96, '13', 'yes'),
(14, 96, '14', 'yes'),
(15, 96, '15', 'yes'),
(16, 96, '16', 'yes'),
(17, 96, 'Team Test', 'no'),
(18, 96, '7', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `team_players`
--

CREATE TABLE `team_players` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(150) NOT NULL,
  `player_position` varchar(100) NOT NULL,
  `player_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_players`
--

INSERT INTO `team_players` (`id`, `team_id`, `player_id`, `player_name`, `player_position`, `player_deleted`) VALUES
(1, 1, 95, 'Individual User', 'Defender', 'no'),
(2, 1, 96, 'Ronaldo', 'Forward', 'no'),
(3, 1, 95, 'Individual User', 'Goalkeeper', 'no'),
(4, 1, 96, 'Rick', 'Defender', 'no'),
(5, 1, 96, 'Jack', 'Goalkeeper', 'no'),
(6, 1, 96, 'Toby', 'Midfielder', 'no'),
(7, 1, 96, 'Arthur', 'Goalkeeper', 'no'),
(8, 1, 96, 'Luke', 'Defender', 'no'),
(9, 1, 96, 'Mark', 'Defender', 'no'),
(10, 1, 96, 'Player 3', 'Defender', 'no'),
(11, 1, 96, 'Player 4', 'Midfielder', 'no'),
(12, 2, 96, 'Player 1', 'Goalkeeper', 'no'),
(13, 2, 96, 'Ben', 'Midfielder', 'no'),
(14, 2, 96, 'Player 2', 'Goalkeeper', 'no'),
(15, 2, 96, 'Chris', 'Forward', 'yes'),
(16, 2, 96, 'Adam', 'Goalkeeper', 'no'),
(17, 3, 96, 'Terry', 'Midfielder', 'no'),
(18, 2, 96, 'John', 'Defender', 'no'),
(19, 2, 95, 'Individual User', 'Defender', 'yes'),
(20, 2, 96, 'Messi', 'Goalkeeper', 'no'),
(21, 2, 95, 'Individual User', 'Goalkeeper', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_name` varchar(100) NOT NULL,
  `ticket_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `tr_name` varchar(100) NOT NULL,
  `tr_level` int(11) NOT NULL,
  `tr_category` varchar(50) NOT NULL,
  `tr_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `tr_name`, `tr_level`, `tr_category`, `tr_description`) VALUES
(1, '2 Miles Run', 1, 'conditioning', 'Must work up a little sweat, average heart rate. Focus on 70% effort.'),
(2, '100 Repeat', 5, 'conditioning', 'Two sets of 8 x 100m with 30 seconds rest between runs. 3 minutes rest between sets.'),
(3, '90 Seconds Runs', 3, 'conditioning', '6 x 90 seconds run with 3 minutes recovery between runs.'),
(4, '30/30\'s', 3, 'conditioning', '10 x 30 seconds run, 30 seconds jog recovery. '),
(5, '30/30\'s', 5, 'conditioning', '12 x 30 seconds run, 30 seconds jog recovery. '),
(6, '90 Seconds Runs', 5, 'conditioning', '8 x 90 seconds run with 3 minutes recovery between runs.'),
(7, '2 Minutes Runs', 3, 'conditioning', '5 x 2 minutes run with 2 minutes recovery between runs.'),
(8, '10 Seconds Bursts', 5, 'conditioning', 'Burst hard with maximum effort for 10 seconds then slow \ndown and coast for 30 seconds. 2 sets of 5 minutes. 3 minutes walk recovery between sets.'),
(9, '3-2-1 Intervals', 5, 'conditioning', 'Run at 80% effort for 3 minutes, then rest for 1 minute. Then run again for 2 minutes, then rest for 2 minutes. Then, run for 1 minute and rest for 3 minutes. This exercise will take 12 minutes. Repeat it 3 times (36 minutes total).'),
(10, '1 Minute Interval Sprints', 3, 'conditioning', 'Sprint for 1 minute, followed by a jog at a calm pace for 1 minute. Needs 10 repetitions.'),
(11, '30 Seconds Interval Sprints', 1, 'conditioning', 'Sprint for 30 seconds, followed by a jog at a calm pace for 2 minutes. Needs 8 repetitions.'),
(12, 'Up & Back', 1, 'conditioning', 'Place two cones 10 yards apart. Sprint to the other cone then backpedal sprint (run backwards) to start. Each set consists of sprinting 4 times. Complete 4 sets with a 2 minutes rest between sets.'),
(13, 'Up & Back', 3, 'conditioning', 'Place a cone at the starting point and one at 10 yards and at 20 yards. Sprint 10 yards and backpedal (run backwards) to start. Sprint 20 yards and backpedal (run backwards) to start.\r\nEach set consists of doing this 4 times. Complete 5 sets with a 2 minutes rest between sets.'),
(14, 'Ladder L1', 1, 'conditioning', 'Run 100m, rest 1 minute. Run 200m, rest 2 minutes. Run 300m, rest 3 minutes. Run 400m, rest 4 minutes. Run 300m, rest 3 minutes. Run 200m, rest 2 minutes. Run 100m to finish.'),
(15, 'Ladder L3', 3, 'conditioning', 'Run 100m between 13 – 17 seconds, rest 1 minute. Run 200m between 27 – 33 seconds, rest 2 minutes. Run 300m between 44 – 50 seconds, rest 3 minutes. Run 400m between 59 – 71 seconds, rest 4 minutes. Run 300m between 44 – 50 seconds, rest 3 minutes. Run 200m between 27 – 33 seconds, rest 2 minutes. Run 100m between 13 – 17 seconds to finish.'),
(16, 'Ladder L5', 5, 'conditioning', 'Run 100m between 12 – 15 seconds, rest 1 minute. Run 200m between 25 – 31 seconds, rest 1:45 minutes. Run 300m between 40 – 45 seconds, rest 2 minutes. Run 400m between 55 – 67 seconds, rest 2:30 minutes. Run 300m between 40 – 45 seconds, rest 2 minutes. Run 200m between 25 – 31 seconds, rest 1:45 minutes. Run 100m between 12 – 15 seconds to finish.'),
(17, 'Back Tracker 1', 1, 'conditioning', 'Run easy out in one direction for 25 minutes. On the way back increase pace arriving in 19-21 minutes.'),
(18, 'Back Tracker 3', 3, 'conditioning', 'Run easy out in one direction for 25 minutes. On the way back increase pace arriving in 17-19 minutes.'),
(19, 'Back Tracker 5', 5, 'conditioning', 'Run easy out in one direction for 25 minutes. On the way back increase pace arriving in less than 17 minutes.');

-- --------------------------------------------------------

--
-- Table structure for table `training_sessions`
--

CREATE TABLE `training_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_category` varchar(100) NOT NULL,
  `session_drill_1` int(11) NOT NULL,
  `session_drill_2` int(11) NOT NULL,
  `session_drill_3` int(11) NOT NULL,
  `session_drill_4` int(11) NOT NULL,
  `session_drill_5` int(11) NOT NULL,
  `session_completed` varchar(4) NOT NULL,
  `session_deleted` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_sessions`
--

INSERT INTO `training_sessions` (`id`, `user_id`, `session_category`, `session_drill_1`, `session_drill_2`, `session_drill_3`, `session_drill_4`, `session_drill_5`, `session_completed`, `session_deleted`) VALUES
(1, 95, 'conditioning', 1, 11, 12, 14, 17, 'no', 'yes');

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

-- --------------------------------------------------------
--
-- Table structure for table `pageview`
--
CREATE TABLE `page_view` (
`id` int(11) NOT NULL,
`page` text NOT NULL,
`userip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `totalview`
--
CREATE TABLE `total_view` (
`id` int(11) NOT NULL,
`page` text NOT NULL,
`totalvisit` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profile_type` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `profile_background` varchar(255) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `verified` varchar(4) NOT NULL,
  `tagline` varchar(40) NOT NULL,
  `about` text NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `plan` varchar(45) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `user_active` varchar(4) NOT NULL,
  `customer_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_type`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `profile_background`, `sport`, `website`, `verified`, `tagline`, `about`, `num_posts`, `num_likes`, `plan`, `user_closed`, `user_active`, `customer_id`) VALUES
(95, 1, 'Individual', 'User', 'individualuser', 'user@gmail.com', '$2y$10$HmRqFHN12IrfEAlrh8INBud7mepDInmGgXvsyCPLhzYe.TCQmUUYa', '2022-09-06', 'assets/images/players.jpg', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', '', '', 'no', '', '', 0, 0, 'Free', 'no', 'yes', ''),
(96, 2, 'Organisation', 'User', 'organisationuser', 'user2@gmail.com', '$2y$10$/x.UIPWqkM9LnipXJQ3R4OMiHOXTXv9t/le/bQKlK2g6Q1eFoz8WK', '2022-09-06', 'assets/images/logob.png', 'assets/images/profile_backgrounds/defaults/default_profile_background.jpg', '', '', 'no', '', '', 0, 0, 'Free', 'no', 'yes', '');

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
-- Indexes for table `bookmarks_events`
--
ALTER TABLE `bookmarks_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks_jobs`
--
ALTER TABLE `bookmarks_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks_profiles`
--
ALTER TABLE `bookmarks_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
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
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
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
-- Indexes for table `notes`
--
ALTER TABLE `notes`
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
-- Indexes for table `profile_attachments`
--
ALTER TABLE `profile_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_galleries`
--
ALTER TABLE `profile_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_players`
--
ALTER TABLE `team_players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_sessions`
--
ALTER TABLE `training_sessions`
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
-- Indexes for table `page_view`
--
ALTER TABLE `page_view`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_view`
--
ALTER TABLE `total_view`
    ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks_events`
--
ALTER TABLE `bookmarks_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bookmarks_jobs`
--
ALTER TABLE `bookmarks_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `bookmarks_profiles`
--
ALTER TABLE `bookmarks_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `individuals`
--
ALTER TABLE `individuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `profile_attachments`
--
ALTER TABLE `profile_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profile_galleries`
--
ALTER TABLE `profile_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `profile_views`
--
ALTER TABLE `profile_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `team_players`
--
ALTER TABLE `team_players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `training_sessions`
--
ALTER TABLE `training_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
