-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 09:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccine_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `Id` int(145) NOT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`Id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'andrei.m.viscayno@gmail.com', 'zgyivspimzmjortq', '2022-07-08 04:41:51', '2022-07-08 09:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptcha_api`
--

CREATE TABLE `google_recaptcha_api` (
  `Id` int(11) NOT NULL,
  `site_key` varchar(145) DEFAULT NULL,
  `site_secret_key` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `google_recaptcha_api`
--

INSERT INTO `google_recaptcha_api` (`Id`, `site_key`, `site_secret_key`, `created_at`, `updated_at`) VALUES
(1, '6LfeHlkdAAAAABiHm93II8UuYYtIs8WFhSIiWQ-B', '6LfeHlkdAAAAAA3NYvNccc_FqzGi2Y6wiGGCOG1s', '2022-07-08 04:29:37', '2022-07-12 07:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(145) NOT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL,
  `birth_date` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `place_of_birth` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `nationality` varchar(145) DEFAULT NULL,
  `religion` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `province` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `barangay` varchar(147) DEFAULT NULL,
  `street` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `street`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ROMMEL', 'PANO', 'ANCIENTE', 'MALE', '2000-01-07', '22', '', 'SINGLE', 'Philippines', 'Roman Catholic', '', '', 'BATAAN', 'HERMOSA', 'SABA', '', NULL, '2022-07-30 12:44:59', '2022-08-06 11:46:07'),
(2, 'CHARLIE', 'BUHALE', 'BELTRAN', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:45:38', NULL),
(3, 'TYRON', 'DELA CRUZ', 'BERCASIO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:46:46', NULL),
(4, 'JANCEE JOERN', 'MENDOZA', 'CAPATI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:47:50', NULL),
(5, 'JOHN PHILIP', 'LAZARO', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:48:27', NULL),
(6, 'NATHANIEL', 'EBOJO', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:48:58', NULL),
(7, 'RIXMON', 'CUDUG', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:49:33', NULL),
(8, 'RODOLFO JR', 'ANTANG', 'DE GUZMAN', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:50:06', NULL),
(9, 'GARBRIEL NIKOLAI', 'GAMAD', 'DELA PENA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:51:08', NULL),
(10, 'FIAZ ALI', 'TOMNES', 'DIZON', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:51:37', NULL),
(11, 'RAYMOND', '', 'GERONIMO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:52:31', NULL),
(12, 'LEEANN', 'TORNO', 'LASCANO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:53:21', NULL),
(13, 'ALDRIN', 'PUCUT', 'LOZANO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:53:49', NULL),
(14, 'FRANZ', 'LUATON', 'MALLARI', 'MALE', '2004-07-14', '18', 'LUBAO, PAMPANGA', 'SINGLE', 'Philippines', 'ROMAN CATHOLIC', '9776621929', '', 'PAMPANGA', 'LUBAO', 'SAN PABLO', '', NULL, '2022-07-30 12:54:48', '2022-08-16 02:02:07'),
(15, 'JOHN LENON', 'GABAYAN', 'MALLARI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:55:18', NULL),
(16, 'MAISON SEDRICK', 'GAQUING', 'MALLARI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:56:13', NULL),
(17, 'ARON', 'DAIT', 'MIRANDO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:56:50', '2022-08-13 05:10:26'),
(18, 'ATHAN TYRON', 'ANCHETA', 'RAZON', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:57:29', NULL),
(19, 'IVAN EZEKIEL', 'MANALO', 'REGALA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:57:56', NULL),
(20, 'JAYMAR', 'RONQUILLO', 'YAMBAO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:58:23', NULL),
(21, 'RISSEL JANE', 'FLORES', 'AQUINO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:59:08', NULL),
(22, 'KATRINA JANE', 'SUNGA', 'LUGTU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 12:59:35', NULL),
(23, 'KEITH ANN', 'SUNGA', 'LUGTU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 13:00:50', NULL),
(24, 'KAYLEEN', 'DAVID', 'PINEDA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 13:01:43', NULL),
(25, 'GLAIZA', 'MALIG', 'QUIMBAO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', NULL, '2022-07-30 13:02:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `superadminId` int(145) NOT NULL,
  `name` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `tokencode` varchar(145) DEFAULT NULL,
  `profile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`superadminId`, `name`, `email`, `password`, `tokencode`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'DATU, JUAN', 'andrei.m.viscayno@gmail.com', '24b35e91f6650c460b66bceaa1590664', 'cf3d41ef87dbd96fe6b963af1eb9c0f6', 'profile.png', '2022-07-03 00:09:13', '2022-08-31 01:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `Id` int(14) NOT NULL,
  `system_name` varchar(145) DEFAULT NULL,
  `system_number` varchar(145) DEFAULT NULL,
  `system_email` varchar(145) DEFAULT NULL,
  `copy_right` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`Id`, `system_name`, `system_number`, `system_email`, `copy_right`, `created_at`, `updated_at`) VALUES
(1, 'Vaccine Scheduling System', '9776621929', 'andrei.m.viscayno@gmail.com', 'Copyright 2022 AMV. All right reserved', '2022-07-08 12:38:28', '2022-08-31 00:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `system_logo`
--

CREATE TABLE `system_logo` (
  `Id` int(145) NOT NULL,
  `logo` varchar(1145) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_logo`
--

INSERT INTO `system_logo` (`Id`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'child+female+girl+kid+user+young+icon-1320196265224558260.png', '2022-07-08 08:11:27', '2022-08-31 00:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `activityId` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(145) NOT NULL,
  `activity` varchar(145) NOT NULL,
  `date` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_logs`
--

INSERT INTO `tb_logs` (`activityId`, `user`, `email`, `activity`, `date`) VALUES
(1, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-07 09:50:50 AM'),
(2, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-07 09:51:14 AM'),
(3, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-08 11:27:55 AM'),
(4, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-08 11:28:13 AM'),
(5, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-09 09:18:46 AM'),
(6, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-09 09:19:06 AM'),
(7, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-10 09:15:22 AM'),
(8, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-10 09:16:11 AM'),
(9, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-10 10:30:17 PM'),
(10, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-10 10:39:00 PM'),
(11, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-11 08:01:18 AM'),
(12, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-11 08:01:50 AM'),
(13, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-12 08:48:43 AM'),
(14, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-12 08:48:59 AM'),
(15, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-13 09:00:06 AM'),
(16, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-13 09:00:19 AM'),
(17, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-13 08:41:54 PM'),
(18, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-13 08:42:08 PM'),
(19, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-16 09:48:42 AM'),
(20, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-16 09:49:03 AM'),
(21, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-30 09:55:55 PM'),
(22, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-30 10:11:39 PM'),
(23, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-30 10:15:32 PM'),
(24, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-30 10:38:59 PM'),
(25, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-30 10:58:12 PM'),
(26, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-30 10:59:20 PM'),
(27, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 06:28:47 AM'),
(28, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-31 06:29:04 AM'),
(29, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 07:11:58 AM'),
(30, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 07:13:45 AM'),
(31, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 07:14:27 AM'),
(32, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-08-31 09:51:29 AM'),
(33, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 12:35:21 PM'),
(34, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 02:57:41 PM'),
(35, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-31 03:07:50 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(255) NOT NULL,
  `userFirst_Name` varchar(145) DEFAULT NULL,
  `userMiddle_Name` varchar(145) DEFAULT NULL,
  `userLast_Name` varchar(145) DEFAULT NULL,
  `userSex` varchar(145) DEFAULT NULL,
  `userBirthDate` varchar(145) DEFAULT NULL,
  `userAge` varchar(145) DEFAULT NULL,
  `userCivilStatus` varchar(145) DEFAULT NULL,
  `userReligion` varchar(145) DEFAULT NULL,
  `userProvince` varchar(145) DEFAULT NULL,
  `userCity` varchar(145) DEFAULT NULL,
  `userBarangay` varchar(145) DEFAULT NULL,
  `userStreet` varchar(145) DEFAULT NULL,
  `userPhone_Number` varchar(145) DEFAULT NULL,
  `userEmail` varchar(145) DEFAULT NULL,
  `userPassword` varchar(145) DEFAULT NULL,
  `userStatus` enum('Y','N') DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `userProfile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `uniqueID` varchar(145) DEFAULT NULL,
  `account_status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userFirst_Name`, `userMiddle_Name`, `userLast_Name`, `userSex`, `userBirthDate`, `userAge`, `userCivilStatus`, `userReligion`, `userProvince`, `userCity`, `userBarangay`, `userStreet`, `userPhone_Number`, `userEmail`, `userPassword`, `userStatus`, `tokencode`, `userProfile`, `uniqueID`, `account_status`, `created_at`, `updated_at`) VALUES
(197, 'ANDREI', 'MANALANSAN', 'VISCAYNO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9776621929', 'andreishania07012000@gmail.com', '8280cf6cf941dbabb5ebabf6a8016c0f', 'Y', 'b3c2dc375edf8a69d45bcbeac8f805a5', 'profile.png', '68414511', 'active', '2022-07-05 11:39:33', '2022-08-31 01:57:56'),
(200, 'ANDREI', 'MANALANSAN', 'viscayno', 'MALE', '2000-01-07', '22', 'SINGLE', 'ROMAN CATHOLIC', 'BATAAN', 'HERMOSA', 'SABA', 'CENTRO', '9776621929', 'andrei.m.viscayno@gmail.com', '8280cf6cf941dbabb5ebabf6a8016c0f', 'Y', '179052851549a7a2aba597bdf663f826', 'profile.png', '61325258', 'active', '2022-08-31 06:57:06', '2022-08-31 07:07:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadminId`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `system_logo`
--
ALTER TABLE `system_logo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `superadminId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `Id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logo`
--
ALTER TABLE `system_logo`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `activityId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
