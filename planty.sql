-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 02:07 PM
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
-- Database: `planty`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `chats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`chats`)),
  `lastFor` char(120) DEFAULT NULL,
  `lastChat` char(50) DEFAULT NULL,
  `lastTime` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user1`, `user2`, `chats`, `lastFor`, `lastChat`, `lastTime`, `deleted`) VALUES
(13, 2, 13, '[{\"from\": \"jepri@gmail.com\", \"value\": \"ce\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"A\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"c\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"c\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"zasya@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"a\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, tenetur?\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos accusamus porro itaque odio vel. Distinctio dolorum soluta impedit atque ea suscipit numquam corporis, porro rerum quos ab, eveniet cumque quaerat.\"}, {\"from\": \"jepri@gmail.com\", \"value\": \"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos accusamus porro itaque odio vel. Distinctio dolorum soluta impedit atque ea suscipit numquam corporis, porro rerum quos ab, eveniet cumque quaerat.\"}]', 'zasya@gmail.com', 'Lorem ipsum dolor sit, amet consectetur adipisicin', '2021-02-18 20:29:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `file` char(30) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `upload` datetime NOT NULL,
  `suspended` int(11) NOT NULL,
  `likes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`likes`)),
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`comments`)),
  `hidden` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`hidden`)),
  `mark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`mark`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `file`, `user`, `upload`, `suspended`, `likes`, `comments`, `hidden`, `mark`) VALUES
(120, 'Harapan di awal tahun nanti apa hayoo? <a href=\'http://localhost/jepri-media/public/Home/hastag/desember\' class = \'hastag\'>#desember</a> <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', NULL, 2, '2020-12-07 00:38:00', 0, '[0, \"2\", \"6\"]', '[{\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16109760842.jpeg\", \"comment\": \"c\", \"upload\": \"2021/02/10 18:44:08\"}, {\"name\": \"Putu Tiara Widiastini\", \"img\": \"16029597546.jpeg\", \"comment\": \"hihi\", \"upload\": \"2020/12/07 02:08\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Mau juga diatas wkwk\", \"upload\": \"2020/12/07 00:45\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"test\", \"upload\": \"2020/12/07 00:45\"}, 0, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Yuk komen komen wkwk\", \"upload\": \"2020/12/07 00:38\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"wkwk\", \"upload\": \"2020/12/07 00:39\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"huh\", \"upload\": \"2020/12/07 00:40\"}]', '[]', '[0]'),
(124, '\"Knowledge cannot replace friendship, I\'d rather be an idiot than lose you. \" - Patrick Star', NULL, 20, '2020-12-07 02:14:00', 0, '[0, \"20\", \"2\"]', '[0]', '[]', '[0]'),
(125, '\"The best leaders are those most interested in surrounding themselves with assistants and associates smarter than they are. They are frank in admitting this and are willing to pay for such talents.\" -Antos Parrish', NULL, 20, '2020-12-07 02:16:00', 0, '[0, \"20\"]', '[{\"name\": \"Jepri Kusuma\", \"img\": \"16109760842.jpeg\", \"comment\": \"ce\", \"upload\": \"2021/02/15 20:40:29\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16109760842.jpeg\", \"comment\": \"cek\", \"upload\": \"2021/01/22 22:14\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16109760842.jpeg\", \"comment\": \"cek\", \"upload\": \"2021/01/22 22:12\"}, 0]', '[]', '[0]'),
(126, '<a href=\'http://localhost/jepri-media/public/Home/hastag/2021\' class = \'hastag\'>#2021</a> jadi dosen 😂 <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', NULL, 13, '2020-12-07 02:19:00', 0, '[0, \"6\"]', '[{\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Amin zas\", \"upload\": \"2020/12/07 09:27\"}, 0]', '[]', '[0]'),
(131, 'Pagi yang cerah untuk memulai kegiatan baru. Tidur dipagi hari, bangun disiang hari, buat tugas di sore hari, malam hari masih buat tugas hingga tidur di pagi hari. Berulang sampe mampus 🙂  <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', NULL, 2, '2020-12-07 09:25:00', 0, '[0, \"6\"]', '[{\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"test\", \"upload\": \"2020/12/07 10:19\"}, 0]', '[]', '[0, \"2\"]'),
(161, 'Halooo, nama saya komang Jepri Kusuma Jaya. Salam kenal semua', '16108940682.jpeg', 2, '2021-01-17 22:34:00', 0, '[0, \"24\"]', '[{\"name\": \"Jepri Kusuma\", \"img\": \"16134569122.jpeg\", \"comment\": \"ce\", \"upload\": \"2021/02/16 17:57:35\"}, {\"name\": \"Jepri Kusuma\", \"img\": \"16109760842.jpeg\", \"comment\": \"ce\", \"upload\": \"2021/02/15 20:40:24\"}, {\"name\": \"Jepri Kusuma\", \"img\": \"16109760842.jpeg\", \"comment\": \"ce\", \"upload\": \"2021/02/15 20:26:17\"}, {\"name\": \"Jepri Kusuma\", \"img\": \"16109760842.jpeg\", \"comment\": \"Hihi\", \"upload\": \"2021/02/13 12:51:23\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16108942782.jpeg\", \"comment\": \"test\", \"upload\": \"2021/01/17 22:43\"}, 0]', '[\"20\"]', '[0]'),
(193, 'Test', NULL, 2, '2021-02-16 17:57:45', 0, '[0]', '[0]', '[0]', '[0]');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sender` int(11) NOT NULL,
  `sended` datetime NOT NULL,
  `target` char(20) NOT NULL,
  `toUser` int(11) DEFAULT NULL,
  `toPost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` int(11) NOT NULL,
  `hastag` char(25) NOT NULL,
  `popularity` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `posts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `isSuspended` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `hastag`, `popularity`, `lastUpdate`, `posts`, `isSuspended`) VALUES
(50, 'desember', 1, '2020-12-07 00:38:00', '[120]', 0),
(51, 'resolusibaru', 2, '2020-12-07 09:25:00', '[120, 122, 126, 131]', 0),
(53, '2021', 2, '2020-12-07 02:19:00', '[122, 126]', 0),
(54, 'covid19', 1, '2020-12-07 02:10:00', '[122]', 0);

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
  `isActive` int(11) NOT NULL,
  `verify` char(32) DEFAULT NULL,
  `online` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `profile`, `banner`, `role`, `isActive`, `verify`, `online`) VALUES
(2, 'Jepri Kusuma', 'jepri@gmail.com', '$2y$10$4OPpNYBM1y6Ss.d4I1bITe0X2bB2DPt/jNKTpmws16k/oWmrj6E5W', 'famale', '16136453192.jpeg', '16073048972.jpeg', 'USR', 1, NULL, '2021-02-18 20:49:26'),
(7, 'Admin', 'admin@jeprimedia.com', '$2y$10$FoP4OfdbbXOEH8foRvM5duCZBI3IckZZZTR0POKWRrCndVETF.FX2', 'male', 'default-male.png', 'banner.png', 'ADM', 1, NULL, '2021-02-16 17:32:40'),
(13, 'Putu Zasya Eka Satya Nugraha', 'zasya@gmail.com', '$2y$10$rCje34v4O1O52PV3BnRuT.0Fp4JDIG7hN/in9DyCEl6OZv5fidV3u', 'male', 'default-male.png', '160404501613.jpeg', 'USR', 1, NULL, '2021-02-18 19:53:20'),
(15, 'Sri Widya', 'widya@gmail.com', '$2y$10$aA03hMHHku2S8GZjmAU/g.wbWRMpXeQfxMqqBbXuniLZ/wCBef49a', 'famale', 'default-famale.png', 'banner.png', 'USR', 1, NULL, NULL),
(20, 'Rio Ariawan', 'rio@gmail.com', '$2y$10$2g8tssjVzyKawTQMl33dLOA3KYMoQtBYAG2gmK6gzCId/tB/fomPu', 'male', 'default-male.png', 'banner.png', 'USR', 1, NULL, '2021-02-16 18:03:34'),
(24, 'Jepri Kusuma', 'jeprikusuma11@gmail.com', '$2y$10$jvwHU9EhxUC4gIXR2NN14uFORJ9vFkmUTXawy1OC.CNx6EinYeF2.', 'male', 'default-male.png', 'banner.png', 'USR', 1, NULL, NULL),
(25, 'test', 'test@gmail.com', '$2y$10$T9GxKNl1G9kqJojzjxkvoezDUUb91T3gidsTh5j.Uiw9MPu4E2WMC', 'male', 'default-male.png', 'banner.png', 'USR', 1, NULL, NULL),
(28, 'Nine Blog', 'nineblog11@gmail.com', '$2y$10$OHr5E.ILr47gvD.O6mCKRO8RGWr1DVRrjHUEQBPAMLVWtSZEJtQWq', 'famale', 'default-famale.png', 'banner.png', 'USR', 1, '4fbca2027a8c25ec92ee9782c5b98d36', '2021-02-18 19:46:35');

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
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1`),
  ADD KEY `user2_id` (`user2`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_post` (`user`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`sender`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `user1_id` FOREIGN KEY (`user1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user2_id` FOREIGN KEY (`user2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_post` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `senderId` FOREIGN KEY (`sender`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `get_role` FOREIGN KEY (`role`) REFERENCES `users-roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
