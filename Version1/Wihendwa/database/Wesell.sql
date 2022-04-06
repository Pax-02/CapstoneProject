-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2020 at 01:52 PM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Wesell`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(12) NOT NULL,
  `image` varchar(70) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(300) NOT NULL,
  `product_price` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `bought` tinyint(1) NOT NULL,
  `buyer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `image`, `product_name`, `product_description`, `product_price`, `username`, `bought`, `buyer`) VALUES
(17, 'Adidas shoes.jpeg', 'Adidas shoe', 'Adidas shoes been renewed now seems brand new', 4500, 'john03', 1, 'Teta'),
(18, 'iphone7+.png', 'Iphone7+', 'Almost brand new iphone 7+', 25000, 'kagisha', 1, 'Teta'),
(19, 'tshirt.jpeg', 'tshirt', 'Renewed in Rwanda t-shirt', 2000, 'kagisha', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `register_buyers`
--

CREATE TABLE `register_buyers` (
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_buyers`
--

INSERT INTO `register_buyers` (`first_name`, `last_name`, `phone_number`, `Location`, `username`, `password`, `confirm_password`) VALUES
('Teta', 'Diana', 730407211, 'Nyarutarama', 'Teta', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `register_sellers`
--

CREATE TABLE `register_sellers` (
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `location` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_sellers`
--

INSERT INTO `register_sellers` (`first_name`, `last_name`, `phone_number`, `location`, `username`, `password`, `confirm_password`) VALUES
('Jack', 'peter', 738162730, 'remera', 'jack02', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b'),
('john', 'Doe', 738162730, 'remera', 'john03', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b'),
('Kagisha', 'kadigi', 784824211, 'Kicukiro', 'kagisha', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b'),
('Pacis', 'Hanyurwimfura Ishimwe', 738162730, 'remera', 'pax02', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `register_buyers`
--
ALTER TABLE `register_buyers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `register_sellers`
--
ALTER TABLE `register_sellers`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`username`) REFERENCES `register_sellers` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
