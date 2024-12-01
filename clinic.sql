-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 02:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine_name`, `stock`, `description`, `expiration_date`, `created_at`) VALUES
(1, 'biogesic', 1, 'asdsad', '2024-12-07', '2024-11-30 09:04:46'),
(2, 'mefenamic', 4, 'sdfsdf', '2024-12-04', '2024-11-30 09:52:04'),
(3, 'qe', 2, 'asdasd', '0000-00-00', '2024-11-30 10:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_requests`
--

CREATE TABLE `medicine_requests` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_requests`
--

INSERT INTO `medicine_requests` (`id`, `medicine_id`, `student_id`, `reason`, `request_date`, `status`) VALUES
(4, 1, '20210364', 'hfhtr\r\n', '2024-11-30 14:58:09', 'approved'),
(5, NULL, '20244444', '        asdsad', '2024-12-01 14:12:57', 'pending'),
(6, NULL, '20244444', '        labad akong o', '2024-12-01 14:13:53', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year_sec` varchar(20) DEFAULT NULL,
  `vaccine_type` varchar(50) DEFAULT NULL,
  `guardian_number` varchar(20) DEFAULT NULL,
  `student_number` varchar(20) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `disability` text DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `health_conditions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_number`, `name`, `phone`, `address`, `email`, `date`, `age`, `gender`, `civil_status`, `course`, `year_sec`, `vaccine_type`, `guardian_number`, `student_number`, `parent`, `disability`, `blood_pressure`, `temperature`, `height`, `weight`, `health_conditions`, `created_at`) VALUES
(3, '11', 'pax', '45345345345', 'cams', 'pax@email.com', '2024-12-01', 21, 'Male', 'Single', 'BSIT', '4B', 'astra', '13241234', '12432412', 'moms', 'N/A', '90/110', 60.0, 5.00, 50.00, 'N/A', '2024-11-30 09:32:05'),
(4, '09', 'jan', '7439598', 'kams', 'jan@email.com', '2024-12-07', 44, 'Male', 'Married', 'BEED', '1b', 'asta', '097645748', '097463736', 'jane doe', 'N/A', '80/60', 55.0, 4.00, 65.00, 'walay health conditions baskog pakay og lawas', '2024-11-30 09:39:47'),
(5, '20210364', 'jax', '5324234243', 'fams', 'jax@gmail.com', '2024-12-01', 31, 'Male', 'Married', 'BSIT', '4b', 'astra', '2431234123', '234123213', 'ajax', 'piang', '10/10', 50.0, 7.00, 40.00, 'okay raman', '2024-11-30 10:10:20'),
(6, '20210263', 'joren sumagang', '0987654321', 'buagonsg', 'adasjod@adsa.com', '2024-12-06', 11, 'Male', 'Single', 'BSIT', '4B', 'astra', 'pekepk', '12432412', 'jane doe', 'nonchalant', '90/110', 60.0, 4.00, 50.00, 'goat', '2024-12-01 12:55:03'),
(7, '20244444', 'JOHN DOE', '3243243243', 'buagsong', 'asdaasdas@sadsa.com', '2024-12-01', 20, 'Male', 'Single', 'BSIT', '4b', 'kokoawdok', 'jorendoe', '31232132131', 'jorenjoren', 'nochaalanat', 'asdasdasda', 0.0, 24.00, 0.00, 'asdsadsad', '2024-12-01 12:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','nurse','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `password`, `role`) VALUES
(1, '20210365', 'adan', 'student'),
(2, '1010', 'admin', 'nurse'),
(6, '20210364', '123', 'student'),
(7, '20210263', '$2y$10$PeQXe/N1V2YqCQ2lKvnh1OKTe2Z1TNj.TLwO1FPtzsJ5NpGCqSBB6', 'student'),
(8, '20244444', '$2y$10$x4zxdASJcs65tVcYV9ECgenoKOyZR3IURkiCf8WxpAHarijO30g5S', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_requests`
--
ALTER TABLE `medicine_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_requests`
--
ALTER TABLE `medicine_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine_requests`
--
ALTER TABLE `medicine_requests`
  ADD CONSTRAINT `medicine_requests_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`),
  ADD CONSTRAINT `medicine_requests_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
