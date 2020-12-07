-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 02:40 AM
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
  `suspended` int(11) NOT NULL,
  `likes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`likes`)),
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`comments`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `user`, `upload`, `suspended`, `likes`, `comments`) VALUES
(120, 'Harapan di awal tahun nanti apa hayoo? <a href=\'http://localhost/jepri-media/public/Home/hastag/desember\' class = \'hastag\'>#desember</a> <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', 2, '2020-12-07 00:38:00', 0, '[0, \"2\", \"6\"]', '[{\"name\": \"Putu Tiara Widiastini\", \"img\": \"16029597546.jpeg\", \"comment\": \"hihi\", \"upload\": \"2020/12/07 02:08\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Mau juga diatas wkwk\", \"upload\": \"2020/12/07 00:45\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"test\", \"upload\": \"2020/12/07 00:45\"}, 0, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Yuk komen komen wkwk\", \"upload\": \"2020/12/07 00:38\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"wkwk\", \"upload\": \"2020/12/07 00:39\"}, {\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"huh\", \"upload\": \"2020/12/07 00:40\"}]'),
(122, '2021 : Covid-19 hilang <a href=\'http://localhost/jepri-media/public/Home/hastag/2021\' class = \'hastag\'>#2021</a> <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a> <a href=\'http://localhost/jepri-media/public/Home/hastag/covid19\' class = \'hastag\'>#covid19</a>', 6, '2020-12-07 02:10:00', 0, '[0, \"6\", \"20\"]', '[{\"name\": \"Rio Ariawan\", \"img\": \"default-male.png\", \"comment\": \"Astunkara😊\", \"upload\": \"2020/12/07 02:12\"}, 0]'),
(124, '\"Knowledge cannot replace friendship, I\'d rather be an idiot than lose you. \" - Patrick Star', 20, '2020-12-07 02:14:00', 0, '[0, \"20\"]', '[0]'),
(125, '\"The best leaders are those most interested in surrounding themselves with assistants and associates smarter than they are. They are frank in admitting this and are willing to pay for such talents.\" -Antos Parrish', 20, '2020-12-07 02:16:00', 0, '[0, \"20\"]', '[0]'),
(126, '<a href=\'http://localhost/jepri-media/public/Home/hastag/2021\' class = \'hastag\'>#2021</a> jadi dosen 😂 <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', 13, '2020-12-07 02:19:00', 0, '[0, \"2\"]', '[{\"name\": \"Komang Jepri Kusuma Jaya\", \"img\": \"16030086632.jpeg\", \"comment\": \"Amin zas\", \"upload\": \"2020/12/07 09:27\"}, 0]'),
(131, 'Pagi yang cerah untuk memulai kegiatan baru. Tidur dipagi hari, bangun disiang hari, buat tugas di sore hari, malam hari masih buat tugas hingga tidur di pagi hari. Berulang sampe mampus 🙂  <a href=\'http://localhost/jepri-media/public/Home/hastag/resolusibaru\' class = \'hastag\'>#resolusibaru</a>', 2, '2020-12-07 09:25:00', 0, '[0, \"2\"]', '[0]');

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
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `profile`, `banner`, `role`, `isActive`) VALUES
(2, 'Komang Jepri Kusuma Jaya', 'jepri@gmail.com', '$2y$10$sYL/1Lc5MwdkJiDu.QTHmOFThAyzKrPdSnV6iKNEzFFrqxGb2P33y', 'male', '16030086632.jpeg', '16073048972.jpeg', 'USR', 1),
(6, 'Putu Tiara Widiastini', 'tiara@gmail.com', '$2y$10$/et56r3OsACKiHcjQL6IFupgg5mH0mqY1HrdwTTqviHWIkD9frYtm', 'famale', '16029597546.jpeg', 'banner.png', 'USR', 1),
(7, 'Admin', 'admin@jeprimedia.com', '$2y$10$FoP4OfdbbXOEH8foRvM5duCZBI3IckZZZTR0POKWRrCndVETF.FX2', 'male', 'default-male.png', 'banner.png', 'ADM', 1),
(13, 'Putu Zasya Eka Satya Nugraha', 'zasya@gmail.com', '$2y$10$rCje34v4O1O52PV3BnRuT.0Fp4JDIG7hN/in9DyCEl6OZv5fidV3u', 'male', '160404484413.png', '160404501613.jpeg', 'USR', 1),
(15, 'Sri Widya', 'widya@gmail.com', '$2y$10$aA03hMHHku2S8GZjmAU/g.wbWRMpXeQfxMqqBbXuniLZ/wCBef49a', 'famale', 'default-famale.png', 'banner.png', 'USR', 1),
(20, 'Rio Ariawan', 'rio@gmail.com', '$2y$10$2g8tssjVzyKawTQMl33dLOA3KYMoQtBYAG2gmK6gzCId/tB/fomPu', 'male', 'default-male.png', 'banner.png', 'USR', 1);

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
