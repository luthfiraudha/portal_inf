-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2017 at 04:04 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osd_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_kategori`
--

CREATE TABLE `data_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(225) NOT NULL,
  `hapus` int(11) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kategori`
--

INSERT INTO `data_kategori` (`kategori_id`, `kategori_nama`, `hapus`, `inputdate`, `updatedate`) VALUES
(26, 'Brinets', 0, '2017-03-09 07:14:04', '2017-03-09 07:14:04'),
(27, 'BSM', 0, '2017-03-09 07:14:40', '2017-03-09 07:14:40'),
(28, 'AS 400', 0, '2017-03-10 03:34:03', '2017-03-10 03:34:03'),
(29, 'Cobol', 0, '2017-03-16 03:54:43', '2017-03-16 03:54:43'),
(30, 'asasas', 0, '2017-03-16 03:59:19', '2017-03-16 03:59:19'),
(31, 'React', 0, '2017-03-16 03:59:41', '2017-03-16 03:59:41'),
(32, 'JAJAJA', 0, '2017-03-16 03:59:59', '2017-03-16 03:59:59'),
(33, 'ORACLE', 0, '2017-03-22 09:33:12', '2017-03-22 09:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `data_record`
--

CREATE TABLE `data_record` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isi` text NOT NULL,
  `type` varchar(225) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pinned` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift` varchar(11) NOT NULL,
  `hapus` int(11) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_record`
--

INSERT INTO `data_record` (`id`, `kategori_id`, `tgl_input`, `isi`, `type`, `status`, `pinned`, `user_id`, `shift`, `hapus`, `inputdate`, `updatedate`) VALUES
(39, 26, '2017-03-10 03:53:21', 'jajaja', 'Problem', 'selesai', 0, 1, 'Shift 2', 0, '2017-03-10 03:53:21', '2017-03-28 14:14:51'),
(40, 26, '2017-03-11 03:54:08', 'asasas', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-10 03:54:08', '2017-03-17 09:08:42'),
(41, 26, '2017-03-11 09:10:59', 'hah', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-10 09:10:59', '2017-03-17 09:08:49'),
(42, 26, '2017-03-13 08:14:17', 'asaksas', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-13 08:14:17', '2017-03-15 09:43:25'),
(43, 26, '2017-03-14 02:16:24', 'asasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-14 02:16:24', '2017-03-15 02:28:32'),
(44, 26, '2017-03-14 11:04:51', 'teleek\r\n', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-14 11:04:51', '2017-03-15 03:25:38'),
(45, 26, '2017-03-15 03:15:40', 'hahshasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-15 03:15:40', '2017-03-15 03:25:42'),
(46, 26, '2017-03-15 04:09:23', 'asasasasa', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-15 04:09:23', '2017-03-22 07:40:36'),
(47, 26, '2017-03-13 07:08:20', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-15 07:08:20', '2017-03-20 08:31:23'),
(48, 26, '2017-03-15 07:08:20', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Problem', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-15 07:08:20', '2017-03-28 13:35:26'),
(49, 26, '2017-03-15 07:08:33', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Request', 'belum selesai', 1, 1, 'Shift 1', 0, '2017-03-15 07:08:33', '2017-03-20 03:12:27'),
(50, 26, '2017-03-15 07:08:57', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Request', 'belum selesai', 1, 1, 'Shift 1', 0, '2017-03-15 07:08:57', '2017-03-20 03:12:19'),
(51, 26, '2017-03-15 07:09:24', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Problem', 'belum selesai', 1, 1, 'Shift 1', 0, '2017-03-15 07:09:24', '2017-03-20 03:12:21'),
(52, 26, '2017-03-15 09:27:25', 'zxzxzxzas', 'Request', 'belum selesai', 0, 1, 'Shift 1', 0, '2017-03-15 09:27:25', '2017-03-29 04:50:19'),
(53, 27, '2017-03-15 09:27:38', 'asasazxzzZ', 'Problem', 'belum selesai', 0, 1, 'Shift 1', 0, '2017-03-15 09:27:38', '2017-03-16 04:48:05'),
(54, 28, '2017-03-15 09:28:57', 'asasqwq', 'Request', 'belum selesai', 0, 1, 'Shift 1', 0, '2017-03-15 09:28:57', '2017-03-29 04:50:16'),
(55, 26, '2017-03-16 09:29:10', 'asaeqwqe', 'Request', 'belum selesai', 0, 1, 'Shift 1', 0, '2017-03-15 09:29:10', '2017-03-29 04:50:22'),
(56, 26, '2017-03-16 03:54:26', 'asasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-16 03:54:26', '2017-03-16 03:54:26'),
(57, 29, '2017-03-16 03:54:43', 'asasd', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-16 03:54:43', '2017-03-16 03:58:51'),
(58, 30, '2017-03-16 03:59:20', 'sasasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 1, '2017-03-16 03:59:20', '2017-03-22 09:36:20'),
(59, 31, '2017-03-16 03:59:42', 'HHHHH', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 1, '2017-03-16 03:59:42', '2017-03-16 04:04:25'),
(60, 32, '2017-03-16 04:00:00', 'jaksjas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 1, '2017-03-16 04:00:00', '2017-03-16 04:04:19'),
(61, 26, '2017-03-20 07:34:39', 'JJJJJ', 'Request', 'belum selesai', 1, 6, 'Shift 1', 0, '2017-03-20 07:34:39', '2017-03-20 07:34:39'),
(62, 27, '2017-03-29 02:42:41', 'asasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:42:41', '2017-03-29 02:42:41'),
(63, 26, '2017-03-29 02:42:48', 'sas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:42:48', '2017-03-29 02:42:48'),
(64, 26, '2017-03-29 02:42:51', 'asas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:42:51', '2017-03-29 02:42:51'),
(65, 26, '2017-03-29 02:42:55', 'asasas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:42:55', '2017-03-29 02:42:55'),
(66, 26, '2017-03-29 02:43:01', 'asasasq', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:43:01', '2017-03-29 02:43:01'),
(67, 27, '2017-03-29 02:43:08', 'asqwqw', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-29 02:43:08', '2017-03-29 02:43:08'),
(68, 26, '2017-03-30 02:57:02', '', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 1, '2017-03-30 02:57:02', '2017-03-30 02:57:14'),
(69, 26, '2017-03-30 02:58:45', 'asas', 'Daily Activity', 'selesai', 0, 1, 'Shift 1', 0, '2017-03-30 02:58:45', '2017-03-30 02:58:45'),
(70, 28, '2017-03-30 03:04:31', 'asaweq', 'Request', 'belum selesai', 1, 1, 'Shift 1', 0, '2017-03-30 03:04:31', '2017-03-30 03:04:31'),
(71, 26, '2017-03-30 03:43:04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Problem', 'belum selesai', 1, 1, 'Shift 2', 0, '2017-03-30 03:43:04', '2017-03-30 03:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `data_tindakan`
--

CREATE TABLE `data_tindakan` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift` varchar(11) NOT NULL,
  `tgl_sol` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isi` text NOT NULL,
  `correct` varchar(35) NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_tindakan`
--

INSERT INTO `data_tindakan` (`id`, `record_id`, `user_id`, `shift`, `tgl_sol`, `isi`, `correct`, `hapus`, `inputdate`, `updatedate`) VALUES
(4, 39, 1, 'Shift 1', '2017-03-10 09:30:45', 'asasaakakaka', 'tepat', 0, '2017-03-10 09:30:45', '2017-03-13 09:44:03'),
(5, 39, 1, 'Shift 1', '2017-03-10 09:30:49', 'asas', 'tidak tepat', 0, '2017-03-10 09:30:49', '2017-03-13 09:41:28'),
(6, 40, 1, 'Shift 1', '2017-03-10 09:42:17', 'asas', 'tidak tepat', 0, '2017-03-10 09:42:17', '2017-03-13 02:59:45'),
(7, 40, 1, 'Shift 1', '2017-03-10 09:42:21', 'asasas', 'tepat', 0, '2017-03-10 09:42:21', '2017-03-13 02:59:45'),
(8, 40, 1, 'Shift 1', '2017-03-10 09:42:25', 'asasas', 'tidak tepat', 0, '2017-03-10 09:42:25', '2017-03-13 02:59:45'),
(9, 41, 1, 'Shift 1', '2017-03-13 04:18:08', 'sasas', 'tepat', 0, '2017-03-13 04:18:08', '2017-03-14 01:37:15'),
(10, 42, 1, 'Shift 1', '2017-03-13 09:59:40', 'asasas', 'tidak tepat', 0, '2017-03-13 09:59:40', '2017-03-15 09:43:25'),
(11, 42, 1, 'Shift 1', '2017-03-14 01:30:52', 'hshs', 'tepat', 0, '2017-03-14 01:30:52', '2017-03-15 09:43:24'),
(12, 42, 1, 'Shift 1', '2017-03-14 08:05:36', 'sasas', 'tidak tepat', 0, '2017-03-14 08:05:36', '2017-03-15 09:43:25'),
(43, 42, 1, 'Shift 1', '2017-03-14 08:08:01', 'sasaskllas', 'tidak tepat', 0, '2017-03-14 08:08:01', '2017-03-15 09:43:25'),
(44, 42, 1, 'Shift 1', '2017-03-14 08:10:39', 'asas', 'tepat', 0, '2017-03-14 08:10:39', '2017-03-15 09:43:24'),
(45, 42, 1, 'Shift 1', '2017-03-14 08:10:43', 'efwef', 'tidak tepat', 0, '2017-03-14 08:10:43', '2017-03-15 09:43:25'),
(46, 42, 1, 'Shift 1', '2017-03-14 08:10:48', 'qwqewqr', 'tidak tepat', 0, '2017-03-14 08:10:48', '2017-03-15 09:43:25'),
(47, 42, 1, 'Shift 1', '2017-03-15 03:11:38', 'asas', 'tepat', 0, '2017-03-15 03:11:38', '2017-03-15 09:43:24'),
(48, 46, 1, 'Shift 1', '2017-03-15 04:09:35', 'asas', 'tepat', 0, '2017-03-15 04:09:35', '2017-03-22 07:40:36'),
(49, 46, 1, 'Shift 1', '2017-03-15 04:09:40', 'asa', 'tepat', 0, '2017-03-15 04:09:40', '2017-03-22 07:40:36'),
(50, 47, 6, 'Shift 1', '2017-03-20 08:22:47', 'assas', 'tepat', 0, '2017-03-20 08:22:47', '2017-03-20 08:31:23'),
(51, 48, 1, 'Shift 1', '2017-03-20 09:29:59', 'lll', 'tepat', 0, '2017-03-20 09:29:59', '2017-03-28 13:35:26'),
(52, 191, 1, 'Shift 2', '2017-03-21 06:40:09', 'Ks njgdnsnd ns dnjhdw ndjbskjwe dsksad', 'belum dikoreksi', 0, '2017-03-21 06:40:09', '2017-03-21 06:40:09'),
(53, 46, 1, 'Shift 1', '2017-03-22 04:49:13', 'sa', 'tidak tepat', 0, '2017-03-22 04:49:13', '2017-03-22 07:40:36'),
(54, 46, 1, 'Shift 1', '2017-03-22 04:49:17', 'asas', 'tepat', 0, '2017-03-22 04:49:17', '2017-03-22 07:40:36'),
(55, 46, 1, 'Shift 1', '2017-03-22 04:49:22', 'asassa', 'tidak tepat', 0, '2017-03-22 04:49:22', '2017-03-22 07:40:36'),
(56, 61, 1, 'Shift 1', '2017-03-29 03:07:02', 'sd', 'belum dikoreksi', 0, '2017-03-29 03:07:02', '2017-03-29 03:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `free_text`
--

CREATE TABLE `free_text` (
  `text_id` int(11) NOT NULL,
  `user_nama` varchar(225) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `free_text`
--

INSERT INTO `free_text` (`text_id`, `user_nama`, `inputdate`, `updatedate`, `text`) VALUES
(68, 'admin', '2017-03-09 02:00:51', '2017-03-14 11:04:28', '\n                  \n                  \n                  \n                  \n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                                           '),
(69, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(70, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(71, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(72, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(73, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(74, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(75, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(76, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(77, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(78, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(79, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(80, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(81, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(82, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            '),
(83, 'admin', '2017-03-09 02:00:51', '2017-03-13 02:46:43', '                  \r\n                  \r\n                  \r\n                  <p>shitf 1: hahahaha</p><p>shift 1 : apa</p><p>shift 3 :kakak</p>                                                            ');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `akses_id` int(11) NOT NULL,
  `akses_nama` varchar(35) NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`akses_id`, `akses_nama`, `hapus`, `inputdate`, `updatedate`) VALUES
(1, 'superadmin', 0, '2017-02-08 09:26:16', '2017-02-08 09:26:16'),
(2, 'maker', 0, '2017-02-08 09:26:16', '2017-02-08 09:26:16'),
(3, 'checker', 0, '2017-02-10 03:29:00', '2017-02-16 06:08:59'),
(4, 'signer', 0, '2017-02-16 06:09:16', '2017-02-16 06:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `log_id` int(11) NOT NULL,
  `log_user_pn` varchar(50) NOT NULL,
  `log_ip` varchar(200) NOT NULL,
  `log_os` varchar(255) NOT NULL,
  `log_browser` varchar(255) NOT NULL,
  `log_tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`log_id`, `log_user_pn`, `log_ip`, `log_os`, `log_browser`, `log_tanggal`) VALUES
(1, '12345', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-02-09 14:03:44'),
(2, '12345', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-02-09 14:06:00'),
(3, '12345', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-02-09 14:55:45'),
(4, '12345', '::1', 'Mac OS X', 'Chrome 55.0.2883.95', '2017-02-09 21:57:42'),
(5, '12345', '::1', 'Mac OS X', 'Safari 602.4.8', '2017-02-10 13:24:24'),
(6, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-10 14:22:08'),
(7, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-10 17:25:42'),
(8, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-13 08:22:38'),
(9, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-13 15:53:52'),
(10, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-14 16:19:26'),
(11, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-16 07:36:45'),
(12, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-17 10:48:09'),
(13, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-17 14:16:26'),
(14, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-20 08:34:39'),
(15, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-20 14:07:02'),
(16, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:36:03'),
(17, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:36:18'),
(18, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:39:02'),
(19, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:40:01'),
(20, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:40:51'),
(21, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:41:34'),
(22, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 14:47:52'),
(23, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 15:14:54'),
(24, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 16:21:02'),
(25, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 17:11:18'),
(26, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-21 17:11:42'),
(27, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:16:51'),
(28, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:18:21'),
(29, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:24:30'),
(30, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:25:19'),
(31, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:25:53'),
(32, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:26:41'),
(33, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:28:24'),
(34, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:30:20'),
(35, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:35:42'),
(36, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 08:44:31'),
(37, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 18:45:23'),
(38, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-22 18:45:40'),
(39, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 08:22:06'),
(40, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 13:15:59'),
(41, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 13:26:22'),
(42, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 13:40:30'),
(43, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 13:40:51'),
(44, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-23 13:58:55'),
(45, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-24 09:55:47'),
(46, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-24 10:11:54'),
(47, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-24 11:13:47'),
(48, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-27 07:32:03'),
(49, '11', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-02-28 15:46:34'),
(50, '12345', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-01 08:37:17'),
(51, '111111', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-01 13:27:47'),
(52, '111111', '::1', 'Mac OS X', 'Safari 602.4.8', '2017-03-02 14:08:52'),
(53, '111111', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-03 16:16:45'),
(54, '333333', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-03 16:17:28'),
(55, '111111', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-03 16:28:08'),
(56, '111111', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-06 08:28:31'),
(57, '333333', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-07 14:17:50'),
(58, '111111', '::1', 'Mac OS X', 'Chrome 56.0.2924.87', '2017-03-07 14:26:38'),
(59, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-08 10:51:27'),
(60, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-08 11:59:42'),
(61, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-08 14:03:24'),
(62, '333333', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-09 10:18:39'),
(63, '222222', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-09 10:34:14'),
(64, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-09 15:07:19'),
(65, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-13 08:04:41'),
(66, '333333', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-17 14:26:38'),
(67, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-17 14:50:16'),
(68, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-20 08:15:28'),
(69, '333333', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-20 14:34:08'),
(70, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-20 15:30:53'),
(71, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-21 10:08:45'),
(72, '333333', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-23 08:19:49'),
(73, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-23 10:18:28'),
(74, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-23 11:24:13'),
(75, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-23 15:41:07'),
(76, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-24 14:00:05'),
(77, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-27 08:39:55'),
(78, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-27 09:50:44'),
(79, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-29 09:58:02'),
(80, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-30 09:48:10'),
(81, '333333', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-30 11:28:25'),
(82, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-03-31 10:21:32'),
(83, '111111', '::1', 'Windows 10', 'Chrome 56.0.2924.87', '2017-04-03 07:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `is_order` int(5) NOT NULL,
  `hapus` int(1) NOT NULL,
  `hak_akses` text NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `is_active`, `is_parent`, `is_order`, `hapus`, `hak_akses`, `inputdate`, `updatedate`) VALUES
(1, 'dashboard', 'dashboard', 1, 0, 1, 0, 'superadmin|maker|checker|signer', '2017-03-15 06:40:28', '2017-04-04 04:36:04'),
(15, 'Management Menu', 'master_menu', 1, 59, 0, 0, 'superadmin', '2017-02-09 04:54:13', '2017-03-21 02:00:35'),
(41, 'Hak Akses', 'master_hak_akses', 1, 59, 0, 0, 'superadmin', '2017-02-09 04:54:13', '2017-03-21 02:00:40'),
(43, 'Vendor', '#', 1, 0, 2, 0, 'superadmin|signer', '2017-02-13 01:28:54', '2017-04-04 04:36:04'),
(44, 'reminder vendor', 'reminder_vendor', 0, 43, 0, 0, 'superadmin', '2017-02-13 01:29:22', '2017-03-02 08:09:40'),
(45, 'Data vendor', 'data_vendor', 1, 43, 0, 0, 'superadmin|signer', '2017-02-13 01:29:42', '2017-03-06 01:33:40'),
(48, 'Data User', 'data_user', 1, 59, 0, 0, 'superadmin|signer', '2017-02-16 04:51:44', '2017-03-07 08:07:21'),
(49, 'Pengajuan User', 'pengajuan_user', 0, 42, 0, 0, 'superadmin', '2017-02-16 04:52:18', '2017-03-02 08:10:27'),
(50, 'Ticketing', '#', 1, 0, 3, 0, 'superadmin|maker|checker|signer', '2017-02-16 07:57:55', '2017-04-04 04:36:04'),
(51, 'Data Ticket', 'data_issue', 1, 50, 0, 0, 'superadmin|maker|checker|signer', '2017-02-16 07:58:18', '2017-03-13 06:24:43'),
(52, 'reminder issue', 'reminder_issue', 0, 50, 0, 0, 'superadmin', '2017-02-16 07:59:01', '2017-03-02 08:09:59'),
(53, 'Category', 'kategori_issue', 1, 50, 0, 0, 'superadmin|maker|checker|signer', '2017-02-16 08:02:57', '2017-03-13 07:20:06'),
(54, 'Data Problem / Request', 'bank_issue', 1, 50, 0, 0, 'superadmin|maker|checker|signer', '2017-02-21 02:37:49', '2017-03-13 07:21:42'),
(55, 'How To ', 'data_sop', 1, 0, 4, 0, 'superadmin|maker|checker|signer', '2017-02-27 04:09:17', '2017-04-04 04:36:04'),
(56, 'Monitoring', '#', 1, 0, 5, 0, 'superadmin|maker|checker|signer', '2017-03-06 02:28:18', '2017-04-04 04:36:04'),
(57, 'Portal Monitor', 'portal_monitor', 1, 56, 0, 0, 'superadmin|maker|checker|signer', '2017-03-06 02:28:45', '2017-03-06 02:28:45'),
(58, 'management monitor', 'data_monitor', 1, 56, 0, 0, 'superadmin', '2017-03-06 02:29:12', '2017-03-21 02:01:02'),
(59, 'Config', '#', 1, 0, 7, 0, 'superadmin', '2017-03-07 08:04:12', '2017-04-04 04:37:47'),
(60, 'Data Daily Activity', 'daily_issue', 1, 50, 0, 0, 'superadmin|maker|checker|signer', '2017-03-13 07:31:01', '2017-03-13 07:31:01'),
(99, 'report', '#', 1, 0, 6, 0, 'superadmin|maker|checker|signer', '2017-03-15 06:41:54', '2017-04-04 04:37:47'),
(100, 'Report User Activity', 'report/report_user', 1, 99, 0, 0, 'superadmin|maker|checker|signer', '2017-04-03 08:38:11', '2017-04-03 08:39:52'),
(101, 'Report Ticket', 'report/report_ticket', 1, 99, 0, 0, 'superadmin|maker|checker|signer', '2017-04-03 08:38:42', '2017-04-03 08:40:10'),
(102, 'vendor summary', 'report/vendor_summary', 1, 99, 0, 0, 'superadmin|maker|checker|signer', '2017-04-03 09:08:40', '2017-04-03 09:08:40'),
(103, 'Troubleshoot Perform', 'report/ts_perform', 1, 99, 0, 0, 'superadmin|maker|checker|signer', '2017-04-04 02:44:35', '2017-04-04 02:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `monitor_id` int(11) NOT NULL,
  `monitor_nama` varchar(225) NOT NULL,
  `monitor_link` varchar(225) NOT NULL,
  `hapus` int(11) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`monitor_id`, `monitor_nama`, `monitor_link`, `hapus`, `inputdate`, `updatedate`) VALUES
(1, 'zabbix', 'www.facebook.com', 0, '2017-03-06 03:46:10', '2017-03-07 07:35:49'),
(2, 'DWH', 'fendypradana.com', 0, '2017-03-06 06:56:06', '2017-03-07 07:35:58'),
(3, 'TES 2', 'ub.ac.id', 0, '2017-03-06 06:56:22', '2017-03-07 07:36:22'),
(4, 'TES 3 ', '#', 0, '2017-03-06 06:56:32', '2017-03-06 06:56:32'),
(5, 'kompas', 'kompas.com', 0, '2017-03-07 07:45:25', '2017-03-07 07:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `sop_app`
--

CREATE TABLE `sop_app` (
  `sop_id` int(11) NOT NULL,
  `sop_pic` varchar(225) NOT NULL,
  `sop_name` varchar(225) NOT NULL,
  `sop_tgl` date NOT NULL,
  `sop_pdf` text NOT NULL,
  `sop_ket` text NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sop_app`
--

INSERT INTO `sop_app` (`sop_id`, `sop_pic`, `sop_name`, `sop_tgl`, `sop_pdf`, `sop_ket`, `hapus`, `inputdate`, `updatedate`, `user_id`) VALUES
(1, 'as', 'las', '2017-02-23', 'http://localhost/portalosd/uploads/sop/2017-02-23-las-58b5216078ee5.pdf', 'as', 1, '2017-02-28 04:32:18', '2017-02-28 07:11:05', 0),
(2, 'LALA', 'Brinets', '2017-02-28', 'http://localhost/portalosd/uploads/sop/2017-02-28-Brinets-58b522ac12aeb.pdf', '-', 1, '2017-02-28 07:11:40', '2017-03-29 03:44:11', 0),
(3, 'asas', 'asasa', '2017-03-01', 'http://localhost/portalosd/uploads/sop/2017-03-01-asasa-58b63e11caaf5.pdf', 'asas', 0, '2017-03-01 03:20:49', '2017-03-01 03:20:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_pn` varchar(35) NOT NULL,
  `user_email` text NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_nohp` varchar(35) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_akses` varchar(35) NOT NULL,
  `user_aktif` varchar(35) NOT NULL,
  `inputdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_pn`, `user_email`, `user_nama`, `user_nohp`, `user_type`, `password`, `user_akses`, `user_aktif`, `inputdate`, `updatedate`) VALUES
(1, '111111', 'adminosd@bri.co.id', 'admin', '12345', 'Kabag', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'superadmin', '1', '2017-02-03 04:09:04', '2017-03-10 07:38:26'),
(5, '222222', 'signerosd@bri.co.id', 'signer', '90212093013', 'Kabag', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'signer', '1', '2017-02-21 07:35:44', '2017-03-10 07:38:41'),
(6, '333333', 'makerosd@bri.co.id', 'maker', '12', 'Enggineer', 'yc-75KPpqAnN9cD7Meg1h3kk02VJfmepymoDkmmFSgc', 'maker', '1', '2017-02-23 06:16:41', '2017-03-30 06:57:01'),
(8, '121212', 'gaga@gmail.com', 'gaga gaga', '097688199212', 'jaja', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'maker', '1', '2017-03-07 06:56:30', '2017-03-23 04:11:10'),
(9, '444444', '444@gmail.com', 'Lucario', '0896929912917', 'aaa', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'maker', '1', '2017-03-09 08:07:09', '2017-03-23 03:54:44'),
(10, '111', '1111@hotmail.com', 'gaga', '8291892121', 'hahaha', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'maker', '1', '2017-03-10 08:39:55', '2017-03-10 08:39:55'),
(11, '909090', '9090@gmail.com', '909090', '909', 'Enggineer', 'GDjE3HM7GGgMFgTeCBJ0hotWOQDfaOXx3dqHhk2i8Yg', 'maker', '1', '2017-03-23 04:23:25', '2017-03-23 04:35:44'),
(12, '89898989', '89182@ganmksas.com', '979719271', '92719872', 'jaja', 'sMdTIIj_V5o4_JZY3lP71_IfcBHCZ-ftiDUpxiio8Pk', 'maker', '1', '2017-03-23 04:24:06', '2017-03-23 04:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(35) NOT NULL,
  `spk_nmr` varchar(35) NOT NULL,
  `vendor_nama` varchar(60) NOT NULL,
  `nama_projek` varchar(225) NOT NULL,
  `vendor_begindate` date NOT NULL,
  `vendor_enddate` date NOT NULL,
  `status` varchar(225) NOT NULL,
  `nilai_kontrak` double NOT NULL,
  `vendor_dokumen` text NOT NULL,
  `hapus` int(1) NOT NULL,
  `inputdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `spk_nmr`, `vendor_nama`, `nama_projek`, `vendor_begindate`, `vendor_enddate`, `status`, `nilai_kontrak`, `vendor_dokumen`, `hapus`, `inputdate`, `updatedate`) VALUES
(1, '121212', 'IMB', '121212', '2017-03-10', '2017-06-01', 'baru', 2000000, 'http://localhost/portalosd/uploads/spk/2017-03-20-121212-58cf43febe381.pdf', 0, '2017-03-20 02:52:46', '2017-03-20 04:36:26'),
(2, '178312', 'HONDA', 'HAHAHHA', '2017-03-01', '2019-02-02', 'baru', 809921000, 'http://localhost/portalosd/uploads/spk/2017-03-01-178312-58cf5ef0a61b4.pdf', 0, '2017-03-20 04:47:44', '2017-03-20 04:47:44'),
(3, '9348234', 'kkkkkkk', 'kkkkkk', '2016-03-01', '2017-03-24', 'baru', 7809201212, 'http://localhost/portalosd/uploads/spk/2016-03-01-9348234-58cf5f9666900.pdf', 0, '2017-03-20 04:50:30', '2017-03-20 04:50:30'),
(4, '0909', 'kkkkkkk', 'Juang', '2017-03-01', '2017-11-25', 'baru', 19999999, 'http://localhost/portalosd/uploads/spk/2017-03-01-0909-58d37227ed65e.pdf', 0, '2017-03-23 06:58:48', '2017-03-23 06:58:48'),
(5, '85304343023', '32131', '2323', '2017-03-24', '2018-07-07', 'baru', 23232323, 'http://localhost/portalosd/uploads/spk/2017-03-24-85304343023-58d497258c866.pdf', 0, '2017-03-24 03:48:53', '2017-03-24 03:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_setting`
--

CREATE TABLE `vendor_setting` (
  `sv_id` int(11) NOT NULL,
  `sv_value` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_setting`
--

INSERT INTO `vendor_setting` (`sv_id`, `sv_value`) VALUES
(1, '6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_kategori`
--
ALTER TABLE `data_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `data_record`
--
ALTER TABLE `data_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_tindakan`
--
ALTER TABLE `data_tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_text`
--
ALTER TABLE `free_text`
  ADD PRIMARY KEY (`text_id`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`akses_id`),
  ADD UNIQUE KEY `akses_nama` (`akses_nama`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`monitor_id`);

--
-- Indexes for table `sop_app`
--
ALTER TABLE `sop_app`
  ADD PRIMARY KEY (`sop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_pn` (`user_pn`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `vendor_nmr` (`spk_nmr`);

--
-- Indexes for table `vendor_setting`
--
ALTER TABLE `vendor_setting`
  ADD PRIMARY KEY (`sv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_kategori`
--
ALTER TABLE `data_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `data_record`
--
ALTER TABLE `data_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `data_tindakan`
--
ALTER TABLE `data_tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `free_text`
--
ALTER TABLE `free_text`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `monitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sop_app`
--
ALTER TABLE `sop_app`
  MODIFY `sop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendor_setting`
--
ALTER TABLE `vendor_setting`
  MODIFY `sv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update status vendor` ON SCHEDULE EVERY 1 DAY STARTS '2017-03-01 00:00:00' ENDS '2037-12-30 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `vendor` SET `status`="kadaluarsa" WHERE (DATEDIFF(vendor_enddate,CURDATE()) <0)$$

CREATE DEFINER=`root`@`localhost` EVENT `delete free_text` ON SCHEDULE EVERY 7 DAY STARTS '2017-03-06 00:00:00' ENDS '2027-12-31 00:00:00' ON COMPLETION NOT PRESERVE DISABLE DO DELETE FROM free_text WHERE `date` < DATE_SUB(NOW(), INTERVAL 7 DAY)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
