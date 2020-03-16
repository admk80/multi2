-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2020 at 05:24 PM
-- Server version: 5.7.29
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jodimoll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(555) NOT NULL,
  `email` varchar(555) NOT NULL,
  `password` varchar(555) NOT NULL,
  `address` varchar(555) NOT NULL,
  `logo` varchar(555) NOT NULL,
  `verified` enum('no','yes') NOT NULL DEFAULT 'no',
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `email`, `password`, `address`, `logo`, `verified`, `updated_at`, `created_at`) VALUES
(1, 'admk', 'admin@aaa.com', '$2y$10$Me8b2q/17F8pmGOB6lwRgOaXp4rbwTslxthNwuLTqRWYWxEvyOBA.', 'Islamabad', '1583005438.png', 'no', '2020-03-06', '2020-02-29'),
(2, 'rsa', 'po@a.com', '$2y$10$34s84lBpmvh136/MVqKy2eMFDV/0n6BbRoI.6cvowg1fnLly5htai', 'Islamabad', '1583260827.png', 'no', '2020-03-03', '2020-03-03'),
(3, 'Arshad', 'www@aaa.com', '$2y$10$7ESX3WwQ8ognFLKXrlOtKO14.tbtDus16C82ixnHU9HFlHeNvmt1.', 'Tobacco1', '1583502132.jpg', 'yes', '2020-03-06', '2020-03-03'),
(4, 'pol', 'pol@yahoo.com', '$2y$10$AsGIJ6xE7sV1sw6QAq0oIOfvW7l1OxICXPelV3fYoJyCrbWKeAQqi', 'later', '1583326742.JPG', 'yes', '2020-03-06', '2020-03-04'),
(5, 'Shivam1', 'shivam.gupta@newrise.in', '$2y$10$7huutJgf.Qx6301AzGpAaObkLYf4sBgoizbn3MdxTXsBnmKrezDBa', 'qwerty1', '1583487437.png', 'yes', '2020-03-06', '2020-03-06'),
(6, 'Naveed Khan', 'share4all.com@gmail.com', '$2y$10$jEYRxl72PyAkmefnAb.57enAXghtNB7GwRE6czgpPanjXriYR4892', 'later, 6666', '1583507593.jpg', 'yes', '2020-03-06', '2020-03-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
