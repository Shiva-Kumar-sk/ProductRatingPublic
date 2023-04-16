-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 11:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `admin_name`, `admin_password`) VALUES
(2, 'shiva', 'a8668b75a1d197c6d2320d28ccb06c52');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `discription` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `product_name`, `discription`, `image`) VALUES
(9, 'Reach Dad And Poor Dad Book', 'r Dad speaks about the lifelong monetary problems experienced by his poor dad and the life experiences of the rich dad.\r\n\r\nAbout the Author\r\n\r\nRobert Toru Kiyosaki is an American businessman and author. He was born on the 8th of April 1947. He is the founder of Global LLC and the Rich Dad Company. He is also popularly known as the author of the bestseller, Rich Dad Poor Dad. His works have challenged the way people think about money and investments. He discusses personal finance in depth via videos. His first work was published in 1997. Some of his recent works include Why the Rich are Getting Richer and More Important than Money.', '../image/reach_dad .jpg'),
(10, 'realmi i pad', 'what a great ipad\"\"', '../image/realmi_i_pad.jpg'),
(11, 'apple 20 watt c usb', 'apple 20 watt fast charger', '../image/apple_20_watt.JpG'),
(12, 'oppo reno 8', 'what a great mobil', '../image/oppo_reno8.jpg'),
(13, 'redmi', 'jghhgh', 'Screenshot 2023-02-04 214420.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `name`, `email`, `rating`, `comment`) VALUES
(8, 9, 'raja', 'raja@mail.com', 4, 'very good book'),
(9, 12, 'rakesh', 'rakesh@mail.com', 1, 'camera is not good'),
(10, 12, 'vikash', 'vikash@mail.com', 5, 'battery is very good'),
(11, 10, 'rahul', 'rahul@mail.com', 4, 'good ipad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
