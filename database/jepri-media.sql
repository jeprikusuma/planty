-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2020 at 07:42 AM
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
(5, 'Wohhh i\'m new here!!', 3, '2020-10-17 19:28:00', 0),
(8, 'Have a nice dream everyone :)', 6, '2020-10-18 02:35:00', 0),
(12, 'Semangat Widyaa', 2, '2020-10-18 12:37:00', 0);

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
  `role` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `profile`, `banner`, `role`) VALUES
(2, 'Jepri Kusuma', 'jepri@gmail.com', '$2y$10$sYL/1Lc5MwdkJiDu.QTHmOFThAyzKrPdSnV6iKNEzFFrqxGb2P33y', 'male', '16029956302.jpeg', '16029854082.jpeg', 'USR'),
(3, 'Rio Ariawan ', 'rio@gmail.com', '$2y$10$BylV65056TfbtNT9RCXe9u39am29aCbAPYelxdV8OtmxdWgdlAQje', 'male', 'default-male.png', 'banner.png', 'USR'),
(5, 'Anitya', 'anitya@gmail.com', '$2y$10$UO1/wvlHFT4GtvY3/3QJou83W6dy.5Yujn2gDuaVbXBX1Ibx7E/3m', 'famale', 'default-famale.png', 'banner.png', 'USR'),
(6, 'Putu Tiara Widiastini', 'tiara@gmail.com', '$2y$10$/et56r3OsACKiHcjQL6IFupgg5mH0mqY1HrdwTTqviHWIkD9frYtm', 'famale', '16029597546.jpeg', 'banner.png', 'USR');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
