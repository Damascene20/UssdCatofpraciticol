-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 08:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rp_student_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `pin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reg_number`, `amount`, `pin`) VALUES
(1, '', 0.00, ''),
(2, 'RP202439', 2000.00, '$2y$10$EXI6wVOLFWT3bOszoLMi6.MAW6wn6Q.Y7XPpfIMXrddwBTeQkcKOm'),
(3, 'RP202439', 2000.00, '$2y$10$QeXZNNeVbOay5X5ZfUtbeOctwMQoLk.Df9UOGw/tKH/UDb9Tg/qK.'),
(4, 'RP202439', 2000.00, '$2y$10$Aeo.ZS3PkFKnzDzojcLHnO5nh/0iPrc/r7tJkPclj6SEahA3CFPTy'),
(5, 'RP202439', 2000.00, '$2y$10$pgs.OFod0Cz88uEWG5Cn7uVz60D387uoDaFMuyWG30tev.dZJshM6'),
(6, 'RP202439', 2000.00, '$2y$10$VYGjnvViOIf3PiMwTLL1huW3qh.u/bPsyFZhajUulQx8ylrIDaVvO'),
(7, 'RP202439', 2000.00, '$2y$10$HQVfyBFIVhhHk9xrV0uWlecHN049DiwPtl2uUf5RB7UAe37wZxeKy'),
(8, 'RP202439', 2000.00, '$2y$10$Zd9L84ymYfi5IA7m22r3geqbp81Wmo3jqGngO.B2KXu14DKmBcVtS'),
(9, 'RP202439', 2000.00, '$2y$10$wJz.vcpq26MtLh62UFl6wOaTyeY5S1fA8w20jLjBBSJiNMNWdcIGS'),
(15, 'RP202439', 12300.00, '$2y$10$cdyIJA1Dpue1nerGOAnwe.yEami1wbDDwl58XoIuAzIjtWJn77v7S');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `college`, `department`, `full_name`, `id_card`, `phone`, `email`, `password`, `reg_number`) VALUES
(1, '3', '5', 'habana', '1199875634', '0780215223', 'nshimi@gmail.com', '$2y$10$f/6R5cgMDiJHAOAorJ2gVu5Q4acaeiK4c40BzadUQ4HhXqlAQ9QoG', ''),
(2, '4', '1', 'eric', '11996773535', '078923443', 'ha@gmail.com', '$2y$10$rpJQV.nSsvwr.n.9YYmebOo63jdK6OI0aisW0Oiy/VOCwcrjP/4bO', 'RP202439');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
