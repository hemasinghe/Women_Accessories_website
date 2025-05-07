-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 09:57 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accessories_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `session_id`, `product_id`, `quantity`) VALUES
(1, '1', 1, 1),
(2, '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `session_id`, `order_date`, `total_amount`, `status`, `name`, `email`, `address`, `payment_method`) VALUES
(1, '86ueeraamdcs0mqt279jcrmo94', '2025-05-06 13:43:09', '3000.00', 'Pending', 'I.H. Shalini Kaushalya', 'kaushal-ps20218@stu.kln.ac.lk', '86, Nildiyasewana, Hiriwala, kaleliya.', 'credit-card'),
(2, '86ueeraamdcs0mqt279jcrmo94', '2025-05-06 13:45:03', '3000.00', 'Pending', 'I.H. Shalini Kaushalya', 'kaushal-ps20218@stu.kln.ac.lk', '86, Nildiyasewana, Hiriwala, kaleliya.', 'credit-card'),
(3, '86ueeraamdcs0mqt279jcrmo94', '2025-05-06 13:46:48', '2500.00', 'Pending', 'I.H. Shalini Kaushalya', 'kaushal-ps20218@stu.kln.ac.lk', '86 , Nildiyasewana , Hiriwala', 'credit-card'),
(4, '86ueeraamdcs0mqt279jcrmo94', '2025-05-06 13:50:39', '3000.00', 'Pending', 'I.H. Shalini Kaushalya', 'kaushal-ps20218@stu.kln.ac.lk', '86 , Nildiyasewana , Hiriwala', 'credit-card');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 2, 1, 1),
(2, 3, 2, 1),
(3, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `stock_quantity` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `item_type`, `price`, `description`, `image_url`, `stock_quantity`) VALUES
(1, 'Small_Tortoiseshell_Short_Drop_Earrings', 'Jewelry', '3000.00', 'These elegant Small Tortoiseshell Short Drop Earrings feature a stylish tortoiseshell design that adds a chic touch to any outfit. Perfect for both casual and formal wear, their versatile and timeless look makes them an ideal accessory for any occasion.', 'Small_Tortoiseshell_Short_Drop_Earrings.jpg', 20),
(2, 'London_Charm_Bracele', 'Jewelry', '2500.00', 'The London Charm Bracelet is a stylish accessory that captures the essence of the iconic city. Featuring detailed charms inspired by London landmarks, this bracelet adds a unique, personal touch to any outfit. Whether you\'re a London lover or simply looking for a fashionable piece, this bracelet makes the perfect statement.', 'London_Charm_Bracele.jpg', 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
