-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 09:07 PM
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
-- Database: `athry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$23VuFKXVhY0JfwHlkyvYT.QDWyRBatkP8uLEORqM8b/J43zy1DR3.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `book_id` int(20) NOT NULL,
  `book_date` date NOT NULL,
  `person_no` int(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tour_id` int(20) NOT NULL,
  `Guide_id` int(20) NOT NULL,
  `Client_id` int(20) NOT NULL,
  `payment_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(20) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(1, 'e');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `mail`, `password`, `phone`, `image`, `active`) VALUES
(5, '23qwesd', 'mohamedgammal55@gmail.com', '$2y$10$Cv/pPdo8aYAO/TA8nB/QMe/D1H.uHLnV2aThnx4OdDLogxlJR.MHq', '123456', '', b'00');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `guide_id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`guide_id`, `name`, `mail`, `password`, `phone`, `image`, `active`) VALUES
(2, 'admin@admin.com', 'mohamedgammal55@gmail.com', '$2y$10$T/9IfiFyyqrJP1UVF4QSwO7ONxKEbiKaJbxuhz62zqjRmOCvKUHq6', '212345', '', b'01');

-- --------------------------------------------------------

--
-- Table structure for table `landmarks`
--

CREATE TABLE `landmarks` (
  `landmark_id` int(20) NOT NULL,
  `landmark_name` varchar(255) NOT NULL,
  `landmark_site` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `city_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landmarks`
--

INSERT INTO `landmarks` (`landmark_id`, `landmark_name`, `landmark_site`, `file`, `type`, `description`, `city_id`) VALUES
(1, 'fd', 'fdfd', '', '', '    fdfd   ', 1),
(2, 'eweqw', 'dsds', 'uploads/landmarks/3427219596.jpg', '', '  eswe ', 1),
(3, 'fd', 'wqewq', 'uploads/landmarks/3427219644.jpg', '', ' eqwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(20) NOT NULL,
  `pay_name` varchar(255) NOT NULL,
  `pay_no` varchar(255) NOT NULL,
  `valid_date` date NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `person_no` int(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `Guide_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`tour_id`, `image`, `name`, `price`, `person_no`, `from_date`, `to_date`, `Guide_id`) VALUES
(1, 'uploads/tours/3427444476.jpg', 'calulogiq@mailinator.com', 665, 42, '1979-11-13', '2006-04-16', 2),
(3, 'uploads/tours/3427445296.jpg', 'pylahu@mailinator.com', 88, 91, '2018-12-19', '2005-05-29', 2),
(4, 'uploads/tours/3427445638.jpg', 'hedodetese@mailinator.com', 69, 9, '1986-01-19', '1988-05-02', 2),
(5, 'uploads/tours/3427445680.jpg', 'hedodetese@mailinator.com', 69, 9, '1986-01-19', '1988-05-02', 2),
(6, 'uploads/tours/3427445728.jpg', 'fupydoqeq@mailinator.com', 3804, 35, '1985-08-24', '1990-10-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tour_details`
--

CREATE TABLE `tour_details` (
  `id` int(20) NOT NULL,
  `landmark_id` int(20) DEFAULT NULL,
  `tour_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_details`
--

INSERT INTO `tour_details` (`id`, `landmark_id`, `tour_id`) VALUES
(8, 2, 6),
(9, 3, 6),
(10, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_guide_fk` (`Guide_id`),
  ADD KEY `book_tour_fk` (`tour_id`),
  ADD KEY `book_pay_fk` (`payment_id`),
  ADD KEY `book_client_id` (`Client_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `landmarks`
--
ALTER TABLE `landmarks`
  ADD PRIMARY KEY (`landmark_id`),
  ADD KEY `landmark_cities` (`city_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_client_fk` (`client_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `pay_client_fk` (`client_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `tour_guide` (`Guide_id`);

--
-- Indexes for table `tour_details`
--
ALTER TABLE `tour_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmark_tours` (`tour_id`),
  ADD KEY `tour_id` (`landmark_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `book_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `guide_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `landmarks`
--
ALTER TABLE `landmarks`
  MODIFY `landmark_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_details`
--
ALTER TABLE `tour_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `book_client_id` FOREIGN KEY (`Client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_guide_fk` FOREIGN KEY (`Guide_id`) REFERENCES `guides` (`guide_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_pay_fk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`pay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_tour_fk` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `landmarks`
--
ALTER TABLE `landmarks`
  ADD CONSTRAINT `landmark_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `pay_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tour_guide` FOREIGN KEY (`Guide_id`) REFERENCES `guides` (`guide_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_details`
--
ALTER TABLE `tour_details`
  ADD CONSTRAINT `landmark_tours` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_id` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`landmark_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
