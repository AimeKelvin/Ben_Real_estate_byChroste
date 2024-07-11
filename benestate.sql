-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 06:50 PM
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
  `images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `apartment_title`, `apartment_price`, `apartment_des`, `number_rooms`, `number_bedrooms`, `status`, `images`) VALUES
(1, 'Tech Infinity', '$ 300', 'Quasi maiores vulputate, ducimus lectus esse tenetur et, qui gravida nihil explicabo recusandae eros! Unde, molestiae, vestibulum ', '2', '2', 'rent', '[\"668ff31ab50ef.png\",\"668ff31ab97ff.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_name` varchar(200) DEFAULT NULL,
  `car_price` varchar(200) DEFAULT NULL,
  `kilometres` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `car_price`, `kilometres`, `description`, `status`, `images`) VALUES
(1, 'Suzuki', '$ 200', '12 Km', 'Id commodi! Eros consequatur cumque, corrupti mollitia eiusmod interdum accusamus tincidunt, ullamcorper, class, vitae potenti officia eaque ullam do curae aliquam? Senectus!', 'rent', '[\"668fcfe46a6c9.jpg\",\"668fcfe47367b.jpg\",\"668fcfe47713f.jpg\"]'),
(2, 'Toyota 45T 2023', '$ 300', '0 Km', 'Repellat, at imperdiet mollitia? Ipsam dui, exercitationem litora, ullamco, magni metus nihil tristique facilis class, rerum', 'sale', '[\"668fd385e7569.jpg\",\"668fd385e9b1a.jpg\",\"668fd385ebb7b.jpg\",\"668fd385edced.jpg\"]');

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
(4, 'New Listing Added', '2024-07-11 12:46:04'),
(13, 'New Listing Added', '2024-07-11 16:34:06'),
(14, 'New Listing Added', '2024-07-11 16:58:34');

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
  `images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house_title`, `house_price`, `house_des`, `number_rooms`, `number_bedrooms`, `status`, `images`) VALUES
(1, 'Inzu Kimironko', '$ 200', 'Fringilla nostra dicta convallis ridiculus ipsa? Iaculis adipisic', '2', '2', 'rent', '[\"668fed5ea9771.png\",\"668fed5eaa6f9.png\"]');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
