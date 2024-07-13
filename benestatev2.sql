-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 09:54 AM
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
-- Database: `benestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `full_name`) VALUES
(1, 'ben@gmail.com', '$2y$10$EWybxBT3pz/qtny55vm.eOY7EJQNXnP9yDfRA40HA2GMkXqhrGYJK', 'Ben estate');

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL,
  `apartment_title` varchar(200) DEFAULT NULL,
  `apartment_price` varchar(200) DEFAULT NULL,
  `apartment_des` text DEFAULT NULL,
  `number_rooms` varchar(100) DEFAULT NULL,
  `number_bedrooms` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `location` varchar(200) DEFAULT 'Not Given'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `apartment_title`, `apartment_price`, `apartment_des`, `number_rooms`, `number_bedrooms`, `status`, `images`, `location`) VALUES
(2, 'Apartment  Kacyiru', '$ 200', 'Iaculis hymenaeos? Viverra euismod? Expedita facere, dictumst facilis labore venenatis in amet aliquip rutrum, ornare', '3', '4', 'rent', '[\"6691524800363.jpg\",\"6691524802b01.jpg\",\"6691524804d44.jpg\"]', 'Not Given'),
(3, 'New apartment', '$ 40', 'Et repellat architecto quo facilisi urna, consectetur rutrum? Facere! Dictum dolorum eros impedit velit veniam consequat', '2', '2', 'rent', '[\"6691b8d40ce3b.png\",\"6691b8d40f16c.png\"]', 'Not Given');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_name` varchar(200) DEFAULT NULL,
  `car_price` varchar(200) DEFAULT NULL,
  `kilometres` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `location` varchar(200) DEFAULT 'Not Given'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `car_price`, `kilometres`, `description`, `status`, `images`, `location`) VALUES
(2, 'Toyota 45T 2023', '$ 300', '0 Km', 'Repellat, at imperdiet mollitia? Ipsam dui, exercitationem litora, ullamco, magni metus nihil tristique facilis class, rerum', 'sale', '[\"668fd385e7569.jpg\",\"668fd385e9b1a.jpg\",\"668fd385ebb7b.jpg\",\"668fd385edced.jpg\"]', 'Not Given'),
(3, 'Bugatti', '$ 300', '5 Km', 'Nec illo faucibus repudiandae fuga scelerisque placeat officia, euismod eleifend. Voluptatem? Perferendis! Aspernatur', 'sale', '[\"6691007939f64.png\",\"669100794017c.png\",\"6691007942df5.png\"]', 'Not Given'),
(4, 'Suzuki', '$ 100', '2 Km', 'Nec illo faucibus repudiandae fuga scelerisque placeat officia, euismod eleifend. Voluptatem? Perferendis! Aspernatur', 'rent', '[\"6691009cb32f1.png\",\"6691009cb64dd.png\"]', 'Not Given'),
(5, 'Toyota 45T 2023', '$ 50', '1 Km', 'Nec illo faucibus repudiandae fuga scelerisque placeat officia, euismod eleifend. Voluptatem? Perferendis! Aspernatur', 'sale', '[\"669100c4ae9e4.png\",\"669100c4b0bf4.png\",\"669100c4b31a7.png\"]', 'Not Given');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `listing` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `phone`, `listing`, `name`) VALUES
(2, '0788675731', 'Toyota 45T 2023', 'Zera');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'caleb Kwizera', 'calebkwizera91@gmail.com', 'Greeting', 'Hello Ben estate'),
(2, 'ngenzi cian', 'ngenzi@gmail.com', 'Gukodesha', 'Nshaka inzu ikodeshwa');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `action` varchar(200) DEFAULT NULL,
  `done__at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `action`, `done__at`) VALUES
(32, 'New Listing Added', '2024-07-13 01:14:28'),
(33, 'New Login Session', '2024-07-13 09:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `house_title` varchar(200) DEFAULT NULL,
  `house_price` varchar(200) DEFAULT NULL,
  `house_des` text DEFAULT NULL,
  `number_rooms` varchar(100) DEFAULT NULL,
  `number_bedrooms` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `location` varchar(200) DEFAULT 'Not Given'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house_title`, `house_price`, `house_des`, `number_rooms`, `number_bedrooms`, `status`, `images`, `location`) VALUES
(1, 'Inzu Kimironko', '$ 200', 'Fringilla nostra dicta convallis ridiculus ipsa? Iaculis adipisic', '2', '2', 'sale', '[\"66911ca8cdccd.png\",\"66911ca8d0755.png\",\"66911ca8d2d82.png\"]', 'Not Given'),
(2, 'Inzu Ya make', '$ 200', 'Nibh eros pharetra penatibus taciti do nemo, soluta dignissimos facilis dicta pariatur quo! Platea egestas! Justo', '3', '4', 'sale', '[\"6691b822f27ef.png\",\"6691b82300abc.png\",\"6691b823029e6.png\"]', 'Not Given'),
(3, 'Kibagabaga House', '$ 100', 'Nibh eros pharetra penatibus taciti do nemo, soluta dignissimos facilis dicta pariatur quo! Platea egestas! Justo,', '2', '3', 'sale', '[\"66919955cc849.jpg\",\"66919955cf042.jpg\",\"66919955d11fb.jpg\"]', 'Not Given'),
(4, 'Kicukiro Building', '$ 300', 'Nibh eros pharetra penatibus taciti do nemo, soluta dignissimos facilis dicta pariatur quo! Platea egestas! Justo,', '4', '4', 'rent', '[\"6691096098629.png\",\"669109609abbd.png\"]', 'Not Given');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `price` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `price`) VALUES
(1, NULL),
(2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
