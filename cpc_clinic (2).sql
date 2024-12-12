-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpc_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `visit_at` datetime NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `nurse_id`, `student_id`, `visit_at`, `notes`, `created_at`) VALUES
(1, 1, 6, '2024-12-13 10:04:00', 'erm please come', '2024-12-11 02:05:21'),
(2, 1, 6, '2024-12-11 17:45:00', 'ARI DIRE BOANG PISTE YAWA', '2024-12-11 09:46:25'),
(3, 1, 6, '2024-12-12 17:47:00', 'hoy animal ari ragud dire', '2024-12-11 09:47:21'),
(4, 1, 4, '2024-12-12 17:51:00', 'HOY GIATAY', '2024-12-11 09:51:13'),
(5, 1, 4, '2024-12-13 19:17:00', 'sadasdas', '2024-12-11 11:17:25'),
(6, 1, 6, '2024-12-21 22:10:00', 'asdsad', '2024-12-12 02:07:51'),
(7, 1, 4, '2024-12-21 10:13:00', '', '2024-12-12 11:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `expired_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `stock`, `desc`, `expired_at`) VALUES
(1, 'biogesic', 15, 'tambbal hilanat', '2024-12-20'),
(2, 'Neozep', 4, 'tambal sipon', '2024-12-12'),
(3, 'alaxan', 19, 'basta tambal', '2024-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `monitorings`
--

CREATE TABLE `monitorings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitorings`
--

INSERT INTO `monitorings` (`id`, `user_id`, `created_at`) VALUES
(1, 4, '2024-12-10 06:22:11'),
(2, 6, '2024-12-10 13:14:53'),
(3, 8, '2024-12-12 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `request_id`, `notes`, `created_at`) VALUES
(1, 1, 'asdas', '2024-12-11 02:56:33'),
(2, 3, 'you need to chill fr, skibidi sigma is not build in one day', '2024-12-11 03:02:51'),
(3, 3, 'you need to chill fr, skibidi sigma is not build in one day', '2024-12-11 03:04:26'),
(4, 4, 'tumara ning tambal kada 4 ka oras', '2024-12-11 11:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicines`
--

CREATE TABLE `prescription_medicines` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_medicines`
--

INSERT INTO `prescription_medicines` (`id`, `prescription_id`, `medicine_id`, `quantity`) VALUES
(2, 1, 1, 3),
(3, 2, 2, 2),
(4, 3, 2, 2),
(5, 4, 2, 2),
(6, 4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `visit_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `reason`, `message`, `status`, `visit_at`, `created_at`) VALUES
(1, 4, 'heee', 'frr', 'approved', '2024-12-11', '2024-12-12 02:49:56'),
(2, 4, 'sakit akong tiyan', 'please malooy mo', 'approved', '2024-12-11', '2024-12-10 13:27:39'),
(3, 4, 'labad akong o', 'frr lets link up', 'approved', '2024-12-12', '2024-12-11 02:28:29'),
(4, 4, 'sakit akong ngipon', 'adto sa clinic', 'approved', '2024-12-12', '2024-12-11 11:14:12'),
(5, 7, '\\hey im locked in', 'fosho', 'approved', '2024-12-13', '2024-12-12 02:11:34'),
(6, 8, 'give me medicine tyshii', 'errm ok', 'approved', '2024-12-12', '2024-12-12 10:05:19'),
(7, 4, 'i need help', '', 'pending', '0000-00-00', '2024-12-12 04:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `year_sec` varchar(255) DEFAULT NULL,
  `vaccine_type` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `disability` varchar(255) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `temperature` varchar(255) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `health_conditions` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `role`, `password`, `name`, `phone`, `address`, `email`, `birthdate`, `gender`, `civil_status`, `course`, `year_sec`, `vaccine_type`, `guardian_number`, `parent`, `disability`, `blood_pressure`, `temperature`, `height`, `weight`, `health_conditions`, `updated_at`, `created_at`) VALUES
(1, 1000, 'nurse', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-10 06:51:00', '2024-12-10 05:51:28'),
(4, 1010, 'student', '$2y$10$KdAi7iUGBCE0SbOFvGRgbu/r5sGg2lGNNsZOj8c1IyWxdg5d7P0.a', 'Joren Sumagang', '234234', 'asdsad', 'asd@asd.com', '2002-12-09', 'Male', 'Single', 'BSIT', 'asd', 'asda', 'qasd', 'asdm', 'asdma', 'asdm', 'asda', 22, 22, 'Asthma', '2024-12-10 18:04:28', '2024-12-12 10:04:30'),
(5, 1011, 'student', '$2y$10$3.tou6azqXmoSR0KHgJTdeukjkgvhE2HPjowJRJnZ5ue0yT40BZ8K', 'John Doe', '0912345678', 'Buagsong', 'john@doe.com', '2002-12-09', 'Male', 'Single', 'BSIT', '4-B', 'astra', '0923423235', 'jane doe', 'N/A', '90/100', '', 170, 60, 'facts', '2024-12-12 18:00:58', '2024-12-12 10:00:58'),
(6, 1012, 'student', '$2y$10$B5KhFS2c.wfJRZuvRDNuU.V2KS9cnoFbYmAy0BGeo6POHy.wZqaDu', 'Daniel Caesar', '09654987321', 'California', 'daniel@caesar.com', '2002-12-09', 'Male', 'Single', 'BSIT', '4-B', 'Astrazenica', '09123456798', '', '', '', '', 0, 0, 'Nothing much...\r\nHe got lung cancer', '2024-12-12 19:23:06', '2024-12-12 11:23:06'),
(7, 1013, 'student', '$2y$10$//nRLcIFMH2HdpoTkV.YJuGdJEarjnN10H1mpqPtB3paafOXc6BX6', 'Kendrick Lamar', '0912324234', 'buagsong', 'kendrick@lemail.com', '2002-02-01', 'Male', 'Single', 'BEED', '4-B', 'astra', '0923423235', 'mama doe', 'goat', '90/100', '45%', 22, 34, 'i got asthma', '2024-12-10 18:04:31', '2024-12-12 10:04:33'),
(8, 1014, 'student', '$2y$10$1cA90l1XXeUTSHZt0V.jiOZf200KaYfxzQaV.G.Hjbv/TT8pgw3FK', 'DUMMY', '0922342342', 'Buagsong', 'dummy@email.com', '2002-12-09', 'Male', 'Single', 'BSIT', '4-B', 'astra', '0923423235', 'mama doe', 'pwd', '22/22', '23', 167, 2321, '', '2024-12-12 18:04:16', '2024-12-12 10:04:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monitorings`
--
ALTER TABLE `monitorings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescription_medicines`
--
ALTER TABLE `prescription_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
