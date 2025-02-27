-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql309.infinityfree.com
-- Generation Time: Feb 27, 2025 at 11:01 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38160015_test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_usn` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `acc_pic` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `acc_pass` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `acc_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_usn`, `acc_pic`, `acc_pass`, `acc_desc`) VALUES
('123', NULL, '$2y$10$kqW/Ro5FzqhR9OuNkZUWmeK6yhJpBZ0E26VBu1efdyA2zq59aGjOK', ''),
('admin', '../uploads/profile_pics/admin_1740641425.jpg', '$2y$10$wztG/xsI5g7LVMXubL6omuEgjMpfbutdYKNCQgO51Vhz3uBZsmFvy', 'aku adlah seorang captain'),
('admin1', NULL, '$2y$10$9ItoPQhdF1I9kOUeAwUW.uPWonUfyd4cbFBiJGJzrj3X3qi74yPRy', ''),
('Al123.', NULL, '$2y$10$OqyBX2ivcvHMiwSiwAW5aOKxC.ilgIBH.cVW3ivYB4CCTOhE.QDJm', ''),
('apakek', NULL, '$2y$10$rzd6EBr09G3HR.6UTeQ/3exQ0D6SYgtLq79zEbaVnsQK8LvucMR7.', ''),
('arka', NULL, '$2y$10$njOF7PfoLvT1YeYg/JqJhOnBfmjCTFon11JyUSIs07iP8cwUJKzTa', 'rttrs'),
('bajingan', NULL, '$2y$10$qw/NLcs1klxhohezEmWKQe8MyqxP4fvRV5nDw67H.KLC/aP2OVDyu', ''),
('eaa', NULL, '$2y$10$O2Y4uuaP4UwKuyP7O6U3b.UIAt.KxWtVns9j1Fw7W8LUrlfFu2Xbe', ''),
('Hai', NULL, '$2y$10$jljcwrKkKFEF9RriYm9LIuShq0.VfY7LIOAvVDcW7xrqu91QuEOlG', ''),
('hjkl', NULL, '$2y$10$t5WIoCDzqU8wVhNexmeG7ebcB/gNEEfx01Mxyd0jc6u675zkvO6bO', ''),
('jait', NULL, '$2y$10$3Ck4asD2iIqaMGNBNGoQWeqK5VV9.CRFDwb2HgIIkBcLdbvJqxkcm', ''),
('kuhaku', NULL, '$2y$10$zMMIX2sgjIwgFLkMFvMoBOIyCangRaaaBjT.c1FYPA959zjzmM/dy', ''),
('mikael', NULL, '$2y$10$dRXJfYz0twvBu1Ghuk00Ged3Yssi0ORBfzioZBuiAZDryzkikPVdO', ''),
('mingyu', NULL, '$2y$10$s9ghXpHb0EwMHCPmCYmJRO/t4AYhnAgWjDJggY1yiWclRktvqWlp6', ''),
('mink', NULL, '$2y$10$bnVj.9u9NNBsGYj8.fRD.esiJCX0RuzDyviJo9.73z66Zk7XiXXDG', ''),
('nofi', '../uploads/profile_pics/nofi_1740640928.png', '$2y$10$4DaznRr3XTztwhQYqrXNHOz5q2YjLQWz6xDZN3.3wdnHPEC8ncAMK', 'Belum ada deskripsi.'),
('pki', NULL, '$2y$10$PrWYhORHK8Bnbg6Vn5RbeO6WewU9YNYFEnZEv6U5F4RUyYyhWsG0.', ''),
('ppp', NULL, '$2y$10$rz6KVfc0ek3/5UtoaTqNkOh3jb/oPMvHiVQsSUucwhKvW8IAgKeH2', ''),
('randi', NULL, '$2y$10$Tzgyvv3steMJuo9uEnToVOkdD80OIVPYeO.irWIBRhvVFzD8hwlUq', ''),
('Random', NULL, '$2y$10$DmvSnDavhiepsBuw6SyI6Otg9i/tDkPPZHTAhk.9KgDC4B6S49ZJa', ''),
('rey', NULL, '$2y$10$mpTvIBd5GAFMso0gJQd9gOwF65sFMdQBvGKtxKkVOJz9obpZkeesW', ''),
('reyy', '../uploads/profile_pics/reyy_1740573882.jpg', '$2y$10$D4Hh8aX1vk9ZegVcTYSfeevNt42JQy6LYxJr11AYNNxY9a38NPhtK', 'Michieeee !!! <3'),
('salsa', NULL, '$2y$10$e7FGmQfBa2b8E/7zKzt3guLVeaCz21RL.dP2hEdJNm3jZ6heyWMMm', ''),
('samin', NULL, '$2y$10$w1f3p0tWknAm9x2Xhgmjee9b1PX0lVZQP7UgWAZnfvNYTDkxjbRGm', ''),
('steven gigit dia', NULL, '$2y$10$MN50oEx2aSesGCXdv8KToOdvp8hNo/HdsRN5avKhPsWfSYddB7ymK', ''),
('stevengigitdia', '../uploads/profile_pics/stevengigitdia_1740635129.jpeg', '$2y$10$y6EBqkKC6VS9dPnkZ47GOeVf9bNbR6Y.16eWYlMBzhLO8YnLjIqP6', 'Aku Yang Dulu Bukanlah yang sekarang'),
('student', NULL, '$2y$10$BGzrrHqzgzeqDTA4OVueZOrcFwpReAoyxJ9JAX404jKsqrm1i/4o2', ''),
('student2', NULL, '$2y$10$SSuLxB6/EAHulZFqUacev.ZraF9xmeLQJZXcAkfsZksTYlyA8/clm', ''),
('Tesr', NULL, '$2y$10$tfaPkIufseXE9tZQVjEekOcYRMFb/wCi4VN9sIPUFFXVU.8hotUFe', ''),
('Test', NULL, '$2y$10$D6Tmf40Jxp2R7czXxs.iceCo/yd5jOWJviPGnMaIOsYim18zurhBy', ''),
('test_profile_pic', NULL, '$2y$10$pNKFUvqfF/4YZdGcnBFTTOv/lIGDmHCOCHRQhJBnZjlENOzaQfUH.', ''),
('ujang', NULL, '$2y$10$Zp4JFpm.pGdfE9oisHEGuO60fL9WurEJbhpzW/b/DbY2cApr2WydK', ''),
('usman', NULL, '$2y$10$S/vFyK1eM0I.csXLZ87AAuifjbY209WRPagPhOFoP7ocqpsdP8mcq', ''),
('wawww', NULL, '$2y$10$rG9blmeXXSlarKD5S6vs6eU7IkiVmcEjjNWJUjiiCaOCjO0wGVElW', ''),
('whywhy', NULL, '$2y$10$e9tp8UFyke.oFTuX3.kqfevR9egaeZPUKEMruf9X2p2WOmi5Zp4FW', ''),
('widja', NULL, '$2y$10$dg/5rr/zxNqMUaSUV0fEeeKhYHjJZoRfKTtjsLpzJYY.wYu57wMQm', ''),
('Yes', NULL, '$2y$10$RrJ0Vm3c3OGdSWSJRJtuQejBP7i36IGqMiaI9cH.qRJqjxe9b3Wpi', ''),
('yuuu', NULL, '$2y$10$xEfBqlZBAkWhUT9yWApUjuhlq75JMbtFwE7C0elpCLpjq2nK4wbIu', ''),
('Zahid', '../uploads/profile_pics/Zahid_1740579832.jpg', '$2y$10$VPC68sNBCTX673MMmoC4IO2WD3c/JxQDtxOOBvt1whkrB/0f1//IG', 'Hallo semua, Nama saya adalah Muhammad Zahid Setiansyah, umur saya 20 tahun, saya suka duduk di depan laptop, saya wibu nolep ekkekkekekekke\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `username`, `post_id`) VALUES
(1, '0', 7),
(2, '0', 7),
(3, '0', 8),
(4, '0', 9),
(5, '0', 10),
(6, '0', 7),
(7, '0', 8),
(8, '0', 8),
(9, 'admin', 8),
(10, 'admin', 8),
(12, 'student', 47);

-- --------------------------------------------------------

--
-- Table structure for table `comnote`
--

CREATE TABLE `comnote` (
  `nt_num` int(4) NOT NULL,
  `nt_name` varchar(10) NOT NULL,
  `nt_text` varchar(255) NOT NULL,
  `nt_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nt_timepost` varchar(40) NOT NULL,
  `nt_rating_up` int(12) NOT NULL,
  `nt_rating_down` int(12) NOT NULL,
  `nt_filename` varchar(255) DEFAULT NULL,
  `nt_filepath` varchar(255) DEFAULT NULL,
  `is_bookmarked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comnote`
--

INSERT INTO `comnote` (`nt_num`, `nt_name`, `nt_text`, `nt_time`, `nt_timepost`, `nt_rating_up`, `nt_rating_down`, `nt_filename`, `nt_filepath`, `is_bookmarked`) VALUES
(6, 'student', 'sese', '2025-02-24 05:02:00', '04-02-2025 14:09:57', 23, 2, NULL, NULL, 0),
(7, 'mkel', 'asa\r\n', '2025-02-18 07:32:01', '04-02-2025 15:16:43', 5, 4, NULL, NULL, 0),
(8, 'keqing', 'halo reyner', '2025-02-17 06:14:01', '05-02-2025 22:16:45', 10, 1, NULL, NULL, 0),
(9, 'yuuu', 'hi:>', '2025-02-26 06:06:16', '05-02-2025 22:16:54', 1, 3, NULL, NULL, 0),
(10, 'zhongli', 'osmanthus wine taste as i remembered', '2025-02-05 15:18:00', '05-02-2025 22:18:00', 0, 0, NULL, NULL, 0),
(11, 'Zhongli', 'Osmanthus wine tastes the same as I remember... But where are those who share the memory?', '2025-02-05 15:19:53', '05-02-2025 22:19:53', 0, 0, NULL, NULL, 0),
(12, 'Lynx', 'ã‚¯ãƒ©ãƒƒã‚¯ãƒ˜ãƒƒãƒ‰', '2025-02-24 13:10:25', '05-02-2025 22:20:48', 6, 0, NULL, NULL, 0),
(13, 'randi', 'halo', '2025-02-06 06:55:58', '06-02-2025 10:18:03', 1, 0, NULL, NULL, 0),
(14, 'student', 'aaa', '2025-02-25 12:06:49', '06-02-2025 10:55:12', 0, 1, NULL, NULL, 0),
(15, 'arka', 'Hello!!!!!!!!!!!?!?!?!?!', '2025-02-06 03:59:53', '06-02-2025 10:59:53', 0, 0, NULL, NULL, 0),
(16, 'admin', 'alo\r\n', '2025-02-08 11:35:47', '06-02-2025 12:18:28', 1, 0, NULL, NULL, 0),
(17, 'admin', 'alo', '2025-02-12 13:45:20', '06-02-2025 12:18:36', 1, 5, NULL, NULL, 0),
(18, 'randi', 'halooo', '2025-02-06 09:52:45', '06-02-2025 12:36:10', 2, 0, NULL, NULL, 0),
(19, 'Zahid', 'Zahid', '2025-02-25 07:43:27', '06-02-2025 13:03:45', 16, 2, NULL, NULL, 0),
(20, 'admin', 'Please don\'t be any ERROR anymore, enough red code for this week!!', '2025-02-24 12:51:22', '06-02-2025 13:50:52', 24, 0, NULL, NULL, 0),
(21, 'admin', 'hii!!', '2025-02-06 06:58:40', '06-02-2025 13:58:22', 2, 0, NULL, NULL, 0),
(22, 'bajingan', 'hello', '2025-02-06 07:23:09', '06-02-2025 14:23:09', 0, 0, NULL, NULL, 0),
(23, 'Random', 'Halo guys', '2025-02-06 10:54:38', '06-02-2025 16:52:18', 15, 0, NULL, NULL, 0),
(24, 'Random', 'Hai', '2025-02-24 05:02:01', '07-02-2025 21:15:39', 2, 0, NULL, NULL, 0),
(25, 'Random', 'Hai', '2025-02-08 11:35:41', '08-02-2025 18:35:29', 1, 0, NULL, NULL, 0),
(26, 'Al123.', 'hello ', '2025-02-10 16:56:55', '10-02-2025 23:56:55', 0, 0, NULL, NULL, 0),
(27, 'admin', 'plis udah dulu le', '2025-02-26 12:46:34', '11-02-2025 22:01:08', 32, 0, NULL, NULL, 0),
(28, 'nofi', 'ea', '2025-02-12 15:32:02', '12-02-2025 22:32:02', 0, 0, NULL, NULL, 0),
(29, 'rey', 'ea', '2025-02-13 03:49:53', '13-02-2025 10:49:53', 0, 0, NULL, NULL, 0),
(30, 'rey', 'ea', '2025-02-13 03:50:02', '13-02-2025 10:50:02', 0, 0, NULL, NULL, 0),
(31, 'rey', 'eaea', '2025-02-13 04:04:22', '13-02-2025 11:04:22', 0, 0, NULL, NULL, 0),
(32, 'rey', 'eaea', '2025-02-13 04:10:45', '13-02-2025 11:10:45', 0, 0, 'Fe_Colored.png', 'uploads/Fe_Colored.png', 0),
(33, 'rey', 'ini postingan csgo loh', '2025-02-13 04:15:26', '13-02-2025 11:15:26', 0, 0, 'Feb 2nd (2).png', 'uploads/Feb 2nd (2).png', 0),
(34, 'rey', 'Indonesia F16', '2025-02-13 04:26:10', '13-02-2025 11:26:10', 0, 0, 'RobloxScreenShot20241005_184807655.png', 'uploads/RobloxScreenShot20241005_184807655.png', 0),
(35, 'rey', 'eaea', '2025-02-24 09:02:21', '13-02-2025 11:49:11', 3, 4, 'RobloxScreenShot20240902_161012818.png', 'uploads/RobloxScreenShot20240902_161012818.png', 0),
(36, 'rey', 'eaea', '2025-02-13 04:49:13', '13-02-2025 11:49:12', 0, 0, 'RobloxScreenShot20240902_161012818.png', 'uploads/RobloxScreenShot20240902_161012818.png', 0),
(37, 'rey', 'tes', '2025-02-13 04:57:31', '13-02-2025 11:57:31', 0, 0, NULL, NULL, 0),
(38, 'rey', 'SBD Dauntless-es', '2025-02-13 05:13:31', '13-02-2025 12:13:31', 0, 0, 'RobloxScreenShot20240730_134000604.png', 'uploads/RobloxScreenShot20240730_134000604.png', 0),
(39, 'rey', 'Fleet', '2025-02-24 16:05:57', '13-02-2025 12:37:41', 0, 1, 'RobloxScreenShot20250210_090131087.png', 'uploads/RobloxScreenShot20250210_090131087.png', 0),
(40, 'samin', 'keren kak', '2025-02-13 05:41:57', '13-02-2025 12:41:00', 48, 0, NULL, NULL, 0),
(41, 'samin', 'hi\r\n', '2025-02-13 06:04:18', '13-02-2025 12:45:10', 126, 0, 'WhatsApp Image 2024-10-20 at 21.59.20.jpeg', 'uploads/WhatsApp Image 2024-10-20 at 21.59.20.jpeg', 0),
(42, 'Zahid', 'Zahid Ganteng Banget omaigod astaganaga', '2025-02-27 07:24:43', '16-02-2025 17:01:59', 130, 13, NULL, NULL, 0),
(43, 'Zahid', '', '2025-02-16 17:32:55', '17-02-2025 00:32:55', 0, 0, 'wp9894763-hd-the-wind-rises-wallpapers.png', 'uploads/wp9894763-hd-the-wind-rises-wallpapers.png', 0),
(44, 'Zahid', 'aaa', '2025-02-16 17:48:53', '17-02-2025 00:48:53', 0, 0, NULL, NULL, 0),
(45, 'Zahid', 'aaaa', '2025-02-24 08:42:11', '17-02-2025 00:48:58', 22, 3, NULL, NULL, 0),
(46, 'Zahid', 'aaaa', '2025-02-16 17:49:03', '17-02-2025 00:49:03', 0, 0, NULL, NULL, 0),
(47, 'arka', 'Halo gessss, help me woiiiii', '2025-02-17 04:33:46', '17-02-2025 11:33:21', 0, 5, 'Screenshot 2024-10-07 141244.png', 'uploads/Screenshot 2024-10-07 141244.png', 0),
(48, 'Zahid', 'ini adalah bakso', '2025-02-17 09:16:38', '17-02-2025 16:16:38', 0, 0, 'bakso basi.jpg', 'uploads/bakso basi.jpg', 0),
(49, 'Zahid', 'Zahidddddddd', '2025-02-18 06:23:57', '18-02-2025 13:23:57', 0, 0, NULL, NULL, 0),
(50, 'Zahid', 'hallo gess gua ngantuk banget', '2025-02-18 07:30:38', '18-02-2025 14:30:38', 0, 0, NULL, NULL, 0),
(51, 'Zahid', '', '2025-02-18 11:09:19', '18-02-2025 18:09:20', 0, 0, NULL, NULL, 0),
(52, 'admin', 'WOI !!!!!!!!', '2025-02-19 04:29:50', '19-02-2025 11:29:50', 0, 0, NULL, NULL, 0),
(53, 'admin', 'Hiii', '2025-02-19 06:09:30', '19-02-2025 13:09:30', 0, 0, NULL, NULL, 0),
(54, 'admin', 'Hi', '2025-02-19 06:11:40', '19-02-2025 13:11:40', 0, 0, NULL, NULL, 0),
(55, 'admin', 'Hi', '2025-02-24 04:56:07', '19-02-2025 13:15:23', 0, 1, NULL, NULL, 0),
(56, 'admin', 'Hii', '2025-02-24 04:56:04', '19-02-2025 13:15:48', 1, 0, NULL, NULL, 0),
(57, 'admin', 'halo woi!', '2025-02-26 12:46:59', '19-02-2025 13:17:43', 2, 1, NULL, NULL, 0),
(58, 'admin', 'wkaowakoakw keren', '2025-02-24 08:53:08', '19-02-2025 13:20:47', 19, 1, NULL, NULL, 0),
(59, 'admin', 'wokawoakow 2 le?', '2025-02-25 02:55:34', '19-02-2025 13:21:06', 32, 1, NULL, NULL, 0),
(60, 'admin', 'woi!', '2025-02-26 12:14:43', '20-02-2025 00:36:19', 14, 0, 'Screenshot 2024-09-30 085042.png', 'uploads/Screenshot 2024-09-30 085042.png', 0),
(61, 'admin', '', '2025-02-20 03:01:45', '20-02-2025 10:01:45', 0, 0, NULL, NULL, 0),
(62, 'admin', 'hi', '2025-02-24 13:02:13', '20-02-2025 10:44:26', 9, 1, NULL, NULL, 0),
(63, 'admin', 'arka', '2025-02-24 14:13:10', '20-02-2025 12:41:00', 11, 3, NULL, NULL, 0),
(64, 'admin', '3 limit', '2025-02-27 07:02:52', '20-02-2025 12:54:52', 9, 3, NULL, NULL, 0),
(65, 'jait', 'Lukisan tertua di dunia ada di Sulawesi', '2025-02-24 16:06:01', '20-02-2025 13:06:47', 4, 2, NULL, NULL, 0),
(66, 'admin', 'Whats on my mind', '2025-02-20 06:07:53', '20-02-2025 13:07:53', 0, 0, NULL, NULL, 0),
(67, 'admin', 'what is this', '2025-02-20 06:08:54', '20-02-2025 13:08:54', 0, 0, NULL, NULL, 0),
(68, 'admin', 'okei 3', '2025-02-20 06:09:04', '20-02-2025 13:09:04', 0, 0, NULL, NULL, 0),
(69, 'admin', '3 limit', '2025-02-27 10:53:22', '20-02-2025 13:10:27', 22, 2, NULL, NULL, 0),
(70, 'admin', '3 tag', '2025-02-24 13:35:52', '20-02-2025 13:27:56', 2, 1, NULL, NULL, 0),
(71, 'jait', 'FYI: Bulan puasa sebentar lagi\r\n', '2025-02-20 06:31:07', '20-02-2025 13:31:07', 0, 0, NULL, NULL, 0),
(72, 'admin', 'three', '2025-02-24 14:08:53', '20-02-2025 13:32:18', 3, 0, NULL, NULL, 0),
(73, 'admin', 'hi 234', '2025-02-24 12:29:22', '20-02-2025 13:36:12', 3, 2, NULL, NULL, 0),
(74, 'nofi', 'tesss', '2025-02-25 12:38:19', '21-02-2025 16:06:39', 16, 0, 'Screenshot 2025-01-27 125655.png', 'uploads/Screenshot 2025-01-27 125655.png', 0),
(75, 'admin', 'a', '2025-02-24 16:15:02', '24-02-2025 19:11:15', 12, 2, NULL, NULL, 0),
(76, 'admin', 'We are committed to provide an enriching educational experience beyond the classroom. Find out the benefits of studying at our campus.\r\n\r\nPresident University is devoted to excellence in teaching, learning, research and developing leaders in many discipli', '2025-02-24 14:11:47', '24-02-2025 19:59:16', 2, 0, NULL, NULL, 0),
(77, 'admin', 'Hello!', '2025-02-26 06:19:31', '24-02-2025 21:51:56', 1, 0, NULL, NULL, 0),
(78, 'admin', '#EfisieinsiAnggaran!', '2025-02-26 12:10:43', '25-02-2025 15:05:00', 1, 0, NULL, NULL, 0),
(79, 'nofi', 'tesssss', '2025-02-25 12:40:37', '25-02-2025 19:40:08', 0, 1, NULL, NULL, 0),
(80, 'Zahid', 'aaaaa', '2025-02-25 13:59:38', '25-02-2025 20:59:38', 0, 0, NULL, NULL, 0),
(81, 'admin', 'tes', '2025-02-26 05:57:34', '26-02-2025 12:57:34', 0, 0, 'Happy Birthday PUFA (2).mp4', 'uploads/Happy Birthday PUFA (2).mp4', 0),
(82, 'reyy', 'haiii!!! <3', '2025-02-26 14:04:33', '26-02-2025 21:04:33', 0, 0, NULL, NULL, 0),
(83, 'reyy', 'aloooo!!!!', '2025-02-26 14:09:32', '26-02-2025 21:09:32', 0, 0, NULL, NULL, 0),
(84, 'admin', 'ini namanya Luce', '2025-02-26 16:25:08', '26-02-2025 23:25:08', 0, 0, 'Luce_Colored.png', 'uploads/Luce_Colored.png', 0),
(85, 'Zahid', '', '2025-02-27 04:41:33', '27-02-2025 11:41:33', 0, 0, NULL, NULL, 0),
(86, 'stevengigi', 'PERTAMAX = PERTALITE', '2025-02-27 05:42:59', '27-02-2025 12:42:30', 95, 0, NULL, NULL, 0),
(87, 'stevengigi', 'zaaaaaaaaaaaaaa\r\n', '2025-02-27 05:47:24', '27-02-2025 12:47:24', 0, 0, NULL, NULL, 0),
(88, 'stevengigi', '', '2025-02-27 05:47:32', '27-02-2025 12:47:32', 0, 0, NULL, NULL, 0),
(89, 'Zahid', 'zaaaa\r\n', '2025-02-27 06:41:20', '27-02-2025 13:41:20', 0, 0, NULL, NULL, 0),
(90, 'stevengigi', 'Kalian Lapar gak?\r\nBeli ayam bakar harganya cuma 60rb kok!!!', '2025-02-27 06:56:50', '27-02-2025 13:55:42', 112, 0, '1 ekor ayam kampung.jpg', 'uploads/1 ekor ayam kampung.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_type`
--

CREATE TABLE `post_type` (
  `type_main_id` int(11) NOT NULL,
  `assign_type_id` int(4) DEFAULT NULL,
  `post_id` int(4) DEFAULT NULL,
  `assign_type_id2` int(4) DEFAULT 0,
  `assign_type_id3` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_type`
--

INSERT INTO `post_type` (`type_main_id`, `assign_type_id`, `post_id`, `assign_type_id2`, `assign_type_id3`) VALUES
(1, 1, 12, NULL, NULL),
(2, 3, 27, NULL, NULL),
(3, 3, 35, NULL, NULL),
(4, 3, 45, NULL, NULL),
(6, 2, 57, NULL, NULL),
(7, 3, 58, NULL, NULL),
(8, 1, 59, NULL, NULL),
(9, 2, 59, NULL, NULL),
(10, 3, 60, NULL, NULL),
(11, 4, 60, NULL, NULL),
(12, 1, 62, NULL, NULL),
(13, 2, 62, NULL, NULL),
(18, 1, 64, NULL, NULL),
(19, 2, 64, NULL, NULL),
(20, 3, 64, NULL, NULL),
(21, 4, 65, NULL, NULL),
(22, NULL, 66, NULL, NULL),
(23, 1, 69, 2, 3),
(24, 1, 70, 2, 3),
(25, 4, 71, NULL, NULL),
(26, 1, 72, 2, 3),
(27, 1, 73, 2, 3),
(28, 1, 74, 3, 4),
(29, 1, 75, NULL, NULL),
(30, 1, 76, 2, 3),
(31, 3, 77, 4, NULL),
(32, 3, 78, NULL, NULL),
(33, 1, 81, 4, NULL),
(34, 4, 84, NULL, NULL),
(35, 3, 86, NULL, NULL),
(36, 4, 90, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_name` varchar(50) NOT NULL,
  `tag_rank` float DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_scores`
--

CREATE TABLE `tag_scores` (
  `tag_id` int(11) NOT NULL,
  `total_score` int(11) DEFAULT 0,
  `interaction_count` int(11) DEFAULT 0,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testdata`
--

CREATE TABLE `testdata` (
  `std_id` int(5) NOT NULL,
  `std_name` varchar(60) NOT NULL,
  `std_major` varchar(6) NOT NULL,
  `std_batch` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `testdata`
--

INSERT INTO `testdata` (`std_id`, `std_name`, `std_major`, `std_batch`) VALUES
(1, 'Reyner Orlando Winata', 'IT', 2024),
(2, 'Stewie Griffin', 'IRE', 2024),
(3, 'Wirandy', 'IT', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(4) NOT NULL,
  `type_post` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_post`) VALUES
(4, 'Entertainment'),
(3, 'Politics'),
(2, 'Science'),
(1, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `user_interactions`
--

CREATE TABLE `user_interactions` (
  `interact_id` int(12) NOT NULL,
  `interact_usn` varchar(30) DEFAULT NULL,
  `interactions` int(11) DEFAULT 0,
  `interact_type` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_interactions`
--

INSERT INTO `user_interactions` (`interact_id`, `interact_usn`, `interactions`, `interact_type`) VALUES
(1, 'admin', 37, 1),
(2, 'admin', 26, 3),
(3, 'arka', 3, 1),
(4, 'admin', 10, 2),
(5, 'admin', 1, 4),
(6, 'nofi', 1, 1),
(7, 'nofi', 19, 3),
(8, 'nofi', 2, 4),
(9, 'arka', 2, 3),
(10, 'arka', 1, 2),
(11, 'reyy', 1, 3),
(12, 'reyy', 2, 2),
(13, 'stevengigitdia', 95, 3),
(14, 'stevengigitdia', 112, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE `user_preferences` (
  `pref_id` int(10) NOT NULL,
  `pref_name` varchar(50) NOT NULL,
  `pref_text_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`pref_id`, `pref_name`, `pref_text_id`) VALUES
(2, 'arka', 23),
(45, 'admin', 24),
(46, 'admin', 23),
(47, 'admin', 22),
(48, 'admin', 25),
(51, 'admin', 26),
(52, 'admin', 6),
(53, 'admin', 6),
(54, 'arka', 6),
(55, 'admin', 7),
(56, 'nofi', 7),
(57, 'arka', 7),
(58, 'rey', 38),
(59, 'rey', 6),
(60, 'Zahid', 6),
(61, 'samin', 41),
(62, 'arka', 46),
(63, 'admin', 18),
(64, 'admin', 64),
(65, 'admin', 64),
(66, 'admin', 64),
(67, 'admin', 62);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_usn`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comnote`
--
ALTER TABLE `comnote`
  ADD PRIMARY KEY (`nt_num`),
  ADD UNIQUE KEY `nt_num` (`nt_num`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `post_type`
--
ALTER TABLE `post_type`
  ADD PRIMARY KEY (`type_main_id`),
  ADD KEY `fk_type_id` (`assign_type_id`),
  ADD KEY `fk_postid` (`post_id`),
  ADD KEY `fk_type_id2` (`assign_type_id2`),
  ADD KEY `fk_type_id3` (`assign_type_id3`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_name`);

--
-- Indexes for table `tag_scores`
--
ALTER TABLE `tag_scores`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `testdata`
--
ALTER TABLE `testdata`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_post` (`type_post`);

--
-- Indexes for table `user_interactions`
--
ALTER TABLE `user_interactions`
  ADD PRIMARY KEY (`interact_id`),
  ADD KEY `fk_usn` (`interact_usn`),
  ADD KEY `fk_type` (`interact_type`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`pref_id`),
  ADD KEY `fk_text_id` (`pref_text_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comnote`
--
ALTER TABLE `comnote`
  MODIFY `nt_num` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `post_type`
--
ALTER TABLE `post_type`
  MODIFY `type_main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_interactions`
--
ALTER TABLE `user_interactions`
  MODIFY `interact_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `pref_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_type`
--
ALTER TABLE `post_type`
  ADD CONSTRAINT `fk_postid` FOREIGN KEY (`post_id`) REFERENCES `comnote` (`nt_num`),
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`assign_type_id`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `fk_type_id2` FOREIGN KEY (`assign_type_id2`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `fk_type_id3` FOREIGN KEY (`assign_type_id3`) REFERENCES `types` (`type_id`);

--
-- Constraints for table `user_interactions`
--
ALTER TABLE `user_interactions`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`interact_type`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `fk_usn` FOREIGN KEY (`interact_usn`) REFERENCES `accounts` (`acc_usn`);

--
-- Constraints for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD CONSTRAINT `user_preferences_ibfk_1` FOREIGN KEY (`pref_name`) REFERENCES `accounts` (`acc_usn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
