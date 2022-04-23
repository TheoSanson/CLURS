-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 06:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_session`
--

CREATE TABLE `class_session` (
  `id` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `duration` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_set` datetime NOT NULL,
  `description` varchar(100) NOT NULL,
  `lab` int(11) NOT NULL,
  `repeat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_session`
--

INSERT INTO `class_session` (`id`, `time_start`, `time_end`, `duration`, `date`, `date_set`, `description`, `lab`, `repeat_id`) VALUES
(13, '07:00:00', '08:30:00', 90, '2022-04-20', '2022-04-16 21:15:42', 'Programming 3', 3, NULL),
(14, '09:30:00', '11:00:00', 90, '2022-04-21', '2022-04-16 21:16:25', 'Programming 4', 3, NULL),
(1130, '12:00:00', '13:00:00', 60, '2022-04-20', '2022-04-20 20:52:02', 'Lunch Break', 3, NULL),
(1131, '12:00:00', '13:00:00', 60, '2022-04-21', '2022-04-20 20:52:02', 'Lunch Break REPEATING', 3, 1130),
(1132, '12:00:00', '13:00:00', 60, '2022-04-22', '2022-04-20 20:52:02', 'Lunch Break REPEATING', 3, 1130),
(1133, '12:00:00', '13:00:00', 60, '2022-04-25', '2022-04-20 20:52:02', 'Lunch Break REPEATING', 3, 1130),
(1134, '12:00:00', '13:00:00', 60, '2022-04-26', '2022-04-20 20:52:03', 'Lunch Break REPEATING', 3, 1130),
(1135, '12:00:00', '13:00:00', 60, '2022-04-27', '2022-04-20 20:52:03', 'Lunch Break REPEATING', 3, 1130),
(1141, '14:00:00', '16:00:00', 120, '2022-04-22', '2022-04-22 21:14:31', 'Web Dev Lab', 3, NULL),
(1142, '14:00:00', '16:00:00', 120, '2022-04-29', '2022-04-22 21:14:31', 'Web Dev Lab (r)', 3, 1141),
(1143, '14:00:00', '16:00:00', 120, '2022-05-06', '2022-04-22 21:14:31', 'Web Dev Lab (r)', 3, 1141),
(1144, '12:00:00', '13:00:00', 60, '2022-04-22', '2022-04-22 21:17:31', 'Lunch Break', 2, NULL),
(1145, '12:00:00', '13:00:00', 60, '2022-04-25', '2022-04-22 21:17:31', 'Lunch Break (r)', 2, 1144),
(1146, '12:00:00', '13:00:00', 60, '2022-04-26', '2022-04-22 21:17:31', 'Lunch Break (r)', 2, 1144),
(1147, '12:00:00', '13:00:00', 60, '2022-04-27', '2022-04-22 21:17:31', 'Lunch Break (r)', 2, 1144),
(1148, '12:00:00', '13:00:00', 60, '2022-04-28', '2022-04-22 21:17:32', 'Lunch Break (r)', 2, 1144),
(1149, '12:00:00', '13:00:00', 60, '2022-04-29', '2022-04-22 21:17:32', 'Lunch Break (r)', 2, 1144);

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `id` int(11) NOT NULL,
  `vacancy` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `lab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`id`, `vacancy`, `status`, `remarks`, `lab`) VALUES
(1, 'Vacant', 'Available', '', 2),
(2, 'Vacant', 'Available', '', 2),
(3, 'Vacant', 'Available', '', 2),
(4, 'Vacant', 'Available', '', 2),
(5, 'Vacant', 'Available', '', 2),
(6, 'Vacant', 'Available', '', 3),
(7, 'Vacant', 'Available', '', 3),
(8, 'Vacant', 'Available', '', 3),
(9, 'Vacant', 'Available', '', 3),
(10, 'Vacant', 'Available', '', 3),
(11, 'Vacant', 'Available', '', 3),
(12, 'Vacant', 'Available', '', 3),
(13, 'Vacant', 'Available', '', 3),
(14, 'Vacant', 'Available', '', 3),
(15, 'Vacant', 'Available', '', 3),
(26, 'Vacant', 'Available', '', 2),
(27, 'Vacant', 'Available', '', 2),
(28, 'Vacant', 'Available', '', 2),
(29, 'Vacant', 'Available', '', 5),
(30, 'Vacant', 'Available', '', 5),
(31, 'Vacant', 'Available', '', 5),
(32, 'Vacant', 'Available', '', 5),
(33, 'Vacant', 'Available', '', 5),
(34, 'Vacant', 'Available', '', 5),
(35, 'Vacant', 'Available', '', 5),
(36, 'Vacant', 'Available', '', 5),
(37, 'Vacant', 'Available', '', 5),
(38, 'Vacant', 'Available', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `time_open` time NOT NULL,
  `time_close` time NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `name`, `total_seats`, `remarks`, `time_open`, `time_close`, `status`) VALUES
(2, 'ICS 01', 5, '', '07:00:00', '17:00:00', 'Available'),
(3, 'ICS 02', 10, '', '07:00:00', '17:00:00', 'Available'),
(5, 'ICS 03', 10, '', '07:00:00', '17:00:00', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `duration` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `user` int(11) NOT NULL,
  `computer` int(11) NOT NULL,
  `date_set` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `time_start`, `time_end`, `duration`, `date`, `remarks`, `user`, `computer`, `date_set`) VALUES
(24, '19:30:00', '24:00:00', 30, '2022-04-20', '', 11, 6, '2022-04-19 23:02:52'),
(39, '08:00:00', '11:00:00', 180, '2022-04-25', '', 11, 8, '2022-04-23 23:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `access_level` varchar(20) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `school_id`, `access_level`, `contactno`, `email`) VALUES
(1, 'admin@wmsu.edu.ph', 'admin@wmsu.edu.ph', 'Admin', 'User', '12345', '2', '12345', 'admin@wmsu.edu.ph'),
(11, 'student@wmsu.edu.ph', 'student@wmsu.edu.ph', 'John', 'Doe', '123456', '0', '12345678901', 'student@wmsu.edu.ph');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_session`
--
ALTER TABLE `class_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_class_to_lab` (`lab`),
  ADD KEY `FK_class_to_class` (`repeat_id`);

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_com_to_lab` (`lab`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_session_to_user` (`user`),
  ADD KEY `FK_session_to_computer` (`computer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_session`
--
ALTER TABLE `class_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1160;

--
-- AUTO_INCREMENT for table `computer`
--
ALTER TABLE `computer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_session`
--
ALTER TABLE `class_session`
  ADD CONSTRAINT `FK_class_to_class` FOREIGN KEY (`repeat_id`) REFERENCES `class_session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_class_to_lab` FOREIGN KEY (`lab`) REFERENCES `laboratory` (`id`);

--
-- Constraints for table `computer`
--
ALTER TABLE `computer`
  ADD CONSTRAINT `fk_com_to_lab` FOREIGN KEY (`lab`) REFERENCES `laboratory` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_session_to_computer` FOREIGN KEY (`computer`) REFERENCES `computer` (`id`),
  ADD CONSTRAINT `FK_session_to_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
