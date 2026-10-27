-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2026 at 01:56 PM
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
-- Database: `ccms_wfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$3t4sEw68syyjva6YMnu/KO9pouNsdobYfJw7rKovNbDRr8mdRU.2G');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(11) NOT NULL,
  `career_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `skills` text NOT NULL,
  `scope` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `career_name`, `category`, `description`, `skills`, `scope`) VALUES
(1, 'Software Developer', 'Technology', 'Build websites, applications and software systems.', 'Programming, Problem Solving, Database', 'Web Development, Application Development, Software Companies'),
(2, 'Cybersecurity Analyst', 'Technology', 'Protect computer systems and networks from security threats.', 'Networking, Linux, Security', 'SOC, Security Operations, Cybersecurity'),
(3, 'UI/UX Designer', 'Design', 'Design simple and useful digital experiences.', 'UI Design, UX Research, Creativity', 'Design Agencies, Product Companies, Freelancing'),
(5, 'Data Analyst', 'Technology', 'Analyze data to help organizations make decisions.', 'SQL, Excel, Python, Analytical Thinking', 'IT Companies, Finance, Business Analytics');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `student_name`, `email`, `phone`, `expert_id`, `message`, `status`, `created_at`) VALUES
(2, 'Jiay', 'jiya11@gmail.com', '8888877777', 1, 'ncghjft', 'Accepted', '2026-09-23 09:11:50'),
(3, 'Jiay', 'jiya11@gmail.com', '8780652899', 3, 'mhvuj', 'Rejected', '2026-09-23 09:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE `experts` (
  `id` int(11) NOT NULL,
  `expert_name` varchar(100) NOT NULL,
  `specialization` varchar(150) NOT NULL,
  `experience` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experts`
--

INSERT INTO `experts` (`id`, `expert_name`, `specialization`, `experience`, `email`, `phone`, `bio`) VALUES
(1, 'Rahul Shah', 'Technology Career Counseling', 8, 'rahul@example.com', '9876543210', 'Career counselor specializing in technology and IT careers.'),
(2, 'Priya Mehta', 'Design Career Counseling', 6, 'priya@example.com', '9876543211', 'Helps students understand creative and design career opportunities.'),
(3, 'Amit Patel', 'Business Career Counseling', 10, 'amit@example.com', '9876543212', 'Experienced counselor focusing on business and management careers.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Jiay', 'jiya11@gmail.com', '$2y$10$9dJR5PERfSBM9gmgP.6UEuc6JSyE/HSr9vQPl.Id7XBw3xipo9QzS', '2026-09-14 08:29:30'),
(2, 'Jannatpari Mansuri', 'nurjahamansuri031@gmail.com', '$2y$10$NTp7H3AVvKY.ltQb1E.oWe2HH7LXPHmMUtZG4At90skz6g931M6jS', '2026-09-23 09:38:16'),
(3, 'Krishna dalwala', 'dalwalakrishna@gmail.com', '$2y$10$/YPtY2FOCNpRasxkJeIX6OhuAjDg48VMCeru9DCK.2T31M50k2cky', '2026-09-23 09:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experts`
--
ALTER TABLE `experts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `experts`
--
ALTER TABLE `experts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
