-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2020 at 04:56 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jepri-media`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `user` int(11) NOT NULL,
  `upload` datetime NOT NULL,
  `suspended` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `user`, `upload`, `suspended`) VALUES
(8, 'Have a nice dream everyone :)', 6, '2020-10-18 02:35:00', 0),
(15, 'jepri upload this post', 2, '2020-10-28 23:32:00', 1),
(18, '“Renew, release, let go. Yesterday’s gone. There’s nothing you can do to bring it back. You can’t “should’ve” done something. You can only DO something. Renew yourself. Release that attachment. Today is a new day!”', 6, '2020-10-30 15:49:00', 0),
(19, '“Today is the sort of day where the sun only comes up to humiliate you.”', 10, '2020-10-30 15:51:00', 0),
(20, 'Hy i\'m from Indonesia', 11, '2020-10-30 15:53:00', 0),
(21, 'Huhuhuu dark side', 12, '2020-10-30 15:54:00', 0),
(24, '“The beginning is always today.”', 13, '2020-10-30 16:09:00', 0),
(25, '“The best preparation for tomorrow is doing your best today.”', 13, '2020-10-30 16:09:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` char(10) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `role` char(5) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `profile`, `banner`, `role`, `isActive`) VALUES
(2, 'Komang Jepri Kusuma Jaya', 'jepri@gmail.com', '$2y$10$sYL/1Lc5MwdkJiDu.QTHmOFThAyzKrPdSnV6iKNEzFFrqxGb2P33y', 'male', '16030086632.jpeg', '16030086632.jpeg', 'USR', 1),
(6, 'Putu Tiara Widiastini', 'tiara@gmail.com', '$2y$10$/et56r3OsACKiHcjQL6IFupgg5mH0mqY1HrdwTTqviHWIkD9frYtm', 'famale', '16029597546.jpeg', 'banner.png', 'USR', 1),
(7, 'Admin', 'admin@gmail.com', '$2y$10$FoP4OfdbbXOEH8foRvM5duCZBI3IckZZZTR0POKWRrCndVETF.FX2', 'male', 'default-male.png', 'banner.png', 'ADM', 1),
(10, 'Jepri Kusuma', 'jeprikusuma@gmial.com', '$2y$10$FxPS1zwBso07.mrRpX2r6OHkTnPabd6hyFNj0YTpoQfDtgjrkx5hO', 'male', 'default-male.png', 'banner.png', 'USR', 1),
(11, 'Rio Ariawan', 'rio@gmail.com', '$2y$10$YV9CQjp6xRKEglpu0CncM..QBqMdwo49Ay8MOkSTvKgAfFkg7BIwu', 'male', 'default-male.png', 'banner.png', 'USR', 1),
(12, 'Sri Widya', 'widya@gmail.com', '$2y$10$I4ZkfyB..djEbfNZGv7TCO6he5p/n/zYVV4vNnN/N6xIs1VRWZUfy', 'famale', 'default-famale.png', 'banner.png', 'USR', 1),
(13, 'Putu Zasya Eka Satya Nugraha', 'zasya@gmail.com', '$2y$10$rCje34v4O1O52PV3BnRuT.0Fp4JDIG7hN/in9DyCEl6OZv5fidV3u', 'male', '160404484413.png', '160404501613.jpeg', 'USR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users-roles`
--

CREATE TABLE `users-roles` (
  `id` char(5) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users-roles`
--

INSERT INTO `users-roles` (`id`, `role`) VALUES
('ADM', 'Admin'),
('USR', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_post` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `get_role` (`role`);

--
-- Indexes for table `users-roles`
--
ALTER TABLE `users-roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `get_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_post` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `get_role` FOREIGN KEY (`role`) REFERENCES `users-roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
