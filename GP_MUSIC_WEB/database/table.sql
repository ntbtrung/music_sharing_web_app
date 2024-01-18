-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 07:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `text` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `Artis` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `avatar_music_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `name`, `Artis`, `url`, `avatar_music_url`) VALUES
(1, 'Anh Nhớ Ra', 'Vũ', 'assets/library/musics-library/Anh Nhớ Ra.mp3', 'assets/library/avt-music-library/anh_nho_ra.jpg'),
(2, 'Bao Tiền', '14Cosper ft Bon', 'assets/library/musics-library/Bao Tiền.mp3', 'assets/library/avt-music-library/bao_tien_mot_mo_binh_yen.jpg'),
(3, 'Có em', 'Madihu ft LowG', 'assets/library/musics-library/Có Em.mp3', 'assets/library/avt-music-library/co_em.jpg'),
(4, 'Thằng điên', 'Justatee ft Andree', 'assets/library/musics-library/Thang Dien.mp3', 'assets/library/avt-music-library/thang_dien.jpg'),
(5, 'Thích em hơi nhiều', 'Wren Evan', 'assets/library/musics-library/Thích Em Hơi Nhiều.mp3', 'assets/library/avt-music-library/thich_em_hoi_nhieu.jpg'),
(6, 'See you again', 'Chalie Puth', 'assets/library/musics-library/See You Again.mp3', 'assets/library/avt-music-library/see_you_again.jpg'),
(7, 'Something Just Like This', 'Coldplay', 'assets/library/musics-library/Something Just Like This.mp3', 'assets/library/avt-music-library/something_just_like_this.jpg'),
(8, 'Sugar', 'Marron 5', 'assets/library/musics-library/Sugar.mp3', 'assets/library/avt-music-library/sugar.jpg'),
(9, 'What You Came For', 'Rihanna', 'assets/library/musics-library/This Is What You Came For.mp3', 'assets/library/avt-music-library/this_is_what_you_came_for.jpg'),
(10, 'What Do You Mean', 'Justin Bieber', 'assets/library/musics-library/What Do You Mean.mp3', 'assets/library/avt-music-library/what_do_you_mean.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `song_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `text` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `Artis` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `avatar_music_url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `cover_photo` varchar(200) NOT NULL,
  `biography` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `email`, `avatar`, `cover_photo`, `biography`) VALUES
(1, 'vinh123', 'f797402a7e526d8ca10713d1ebb72a24', '', 'vinh123@gmail.com', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD KEY `comment_author_id` (`author_id`),
  ADD KEY `comment_post_id` (`post_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `post_song_id` (`song_id`),
  ADD KEY `post_author_id` (`author_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
