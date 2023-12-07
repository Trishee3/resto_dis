-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 07, 2023 at 06:42 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `available`) VALUES
(11, 'Basic', 229, 94),
(12, 'MAX', 399, 86);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `product_name` varchar(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  `transaction_Date` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `product_name`, `quantity`, `total_cost`, `transaction_Date`) VALUES
(1, 'test', 2, 123, '2023-12-06 04:28:37.000000'),
(2, 'test2', 1, 2, '2023-12-06 04:29:36.000000'),
(3, 'MAX', 12, 4788, '2023-12-06 08:28:08.000000'),
(4, 'test 4 ni', 1, 100, '2023-12-06 08:29:45.000000'),
(5, 'Basic', 2, 358, '2023-12-06 08:55:09.000000'),
(6, 'MAX', 2, 698, '2023-12-06 08:55:35.000000'),
(7, 'MAX', 2, NULL, '2023-12-06 09:29:44.000000'),
(8, 'Basic', 2, 458, '2023-12-06 09:37:57.000000'),
(9, 'MAX', 1, 399, '2023-12-06 10:02:58.000000'),
(10, 'Basic', 2, 274, '2023-12-06 12:45:02.000000'),
(11, 'Basic', 2, 274, '2023-12-06 13:18:21.000000'),
(12, 'MAX', 2, 798, '2023-12-06 13:32:53.000000'),
(13, 'MAX', 5, 1995, '2023-12-06 13:49:09.000000'),
(14, 'MAX', 4, 957, '2023-12-07 02:52:09.000000'),
(15, 'MAX', 3, 718, '2023-12-07 02:53:32.000000'),
(16, 'Basic', 3, 412.2, '2023-12-07 03:09:34.000000'),
(17, 'Basic', 1, 229, '2023-12-07 04:36:42.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isadmin` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isadmin`) VALUES
(2, 'trisha', '$2y$10$WxNulPYin7NsMv5Tqoa82ui/Vj.6Qn2gns7emJhROIlu1Z/z6uEAa', 1),
(8, 'admin', '$2y$10$PWI.5694QsBuWdGMRZAoAuCUj6c5HSvIfOrL6ikweCD1zUpuKqsjm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
