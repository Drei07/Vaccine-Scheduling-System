-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 08:25 AM
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
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(145) NOT NULL,
  `LRN` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `program` varchar(145) DEFAULT NULL,
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
  `mother_first_name` varchar(145) DEFAULT NULL,
  `mother_middle_name` varchar(145) DEFAULT NULL,
  `mother_last_name` varchar(145) DEFAULT NULL,
  `mother_phone_number` varchar(145) DEFAULT NULL,
  `father_first_name` varchar(145) DEFAULT NULL,
  `father_middle_name` varchar(145) DEFAULT NULL,
  `father_last_name` varchar(145) DEFAULT NULL,
  `father_phone_number` varchar(145) DEFAULT NULL,
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `account_status` enum('active','disabled') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userId`, `LRN`, `studentId`, `program`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `street`, `mother_first_name`, `mother_middle_name`, `mother_last_name`, `mother_phone_number`, `father_first_name`, `father_middle_name`, `father_last_name`, `father_phone_number`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `account_status`, `created_at`, `updated_at`) VALUES
(1, '106027090003', '2018006160', '41341843', 'ROMMEL', 'PANO', 'ANCIENTE', 'MALE', '2000-01-07', '22', '', 'SINGLE', 'Philippines', 'Roman Catholic', '', '', 'BATAAN', 'HERMOSA', 'SABA', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:44:59', '2022-08-06 11:46:07'),
(2, '106026080004', '2018006161', '41341843', 'CHARLIE', 'BUHALE', 'BELTRAN', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:45:38', NULL),
(3, '106028090001', '2018006162', '41341843', 'TYRON', 'DELA CRUZ', 'BERCASIO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:46:46', NULL),
(4, '106026090010', '2018006163', '41341843', 'JANCEE JOERN', 'MENDOZA', 'CAPATI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:47:50', NULL),
(5, '136484090213', '2018006164', '41341843', 'JOHN PHILIP', 'LAZARO', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:48:27', NULL),
(6, '106032090030', '2018006165', '41341843', 'NATHANIEL', 'EBOJO', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:48:58', NULL),
(7, '159501120015', '201826', '41341843', 'RIXMON', 'CUDUG', 'DABU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:49:33', NULL),
(8, '300894120088', '201827', '41341843', 'RODOLFO JR', 'ANTANG', 'DE GUZMAN', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:50:06', NULL),
(9, '106030090015', '201828', '41341843', 'GARBRIEL NIKOLAI', 'GAMAD', 'DELA PENA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:51:08', NULL),
(10, '106030090018', '201829', '41341843', 'FIAZ ALI', 'TOMNES', 'DIZON', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:51:37', NULL),
(11, '106024070024', '201830', '41341843', 'RAYMOND', '', 'GERONIMO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:52:31', NULL),
(12, '106032090057', '201831', '41341843', 'LEEANN', 'TORNO', 'LASCANO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:53:21', NULL),
(13, '106028090012', '201832', '41341843', 'ALDRIN', 'PUCUT', 'LOZANO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:53:49', NULL),
(14, '106032090071', '201833', '41341843', 'FRANZ', 'LUATON', 'MALLARI', 'MALE', '2004-07-14', '18', 'LUBAO, PAMPANGA', 'SINGLE', 'Philippines', 'ROMAN CATHOLIC', '9776621929', '', 'PAMPANGA', 'LUBAO', 'SAN PABLO', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:54:48', '2022-08-16 02:02:07'),
(15, '106026120173', '201834', '41341843', 'JOHN LENON', 'GABAYAN', 'MALLARI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:55:18', NULL),
(16, '106032090073', '201835', '41341843', 'MAISON SEDRICK', 'GAQUING', 'MALLARI', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:56:13', NULL),
(17, '114421090051', '201836', '41341843', 'ARON', 'DAIT', 'MIRANDO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:56:50', '2022-08-13 05:10:26'),
(18, '106269080034', '201837', '41341843', 'ATHAN TYRON', 'ANCHETA', 'RAZON', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:57:29', NULL),
(19, '103884090175', '201838', '41341843', 'IVAN EZEKIEL', 'MANALO', 'REGALA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:57:56', NULL),
(20, '106038090082', '201839', '41341843', 'JAYMAR', 'RONQUILLO', 'YAMBAO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:58:23', NULL),
(21, '106038090006', '201840', '41341843', 'RISSEL JANE', 'FLORES', 'AQUINO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:59:08', NULL),
(22, '106030090038', '201841', '41341843', 'KATRINA JANE', 'SUNGA', 'LUGTU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 12:59:35', NULL),
(23, '106030090039', '201842', '41341843', 'KEITH ANN', 'SUNGA', 'LUGTU', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 13:00:50', NULL),
(24, '106032090091', '201843', '41341843', 'KAYLEEN', 'DAVID', 'PINEDA', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 13:01:43', NULL),
(25, '106038090061', '201845', '41341843', 'GLAIZA', 'MALIG', 'QUIMBAO', '', '', '', '', '', 'Philippines', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'active', '2022-07-30 13:02:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
