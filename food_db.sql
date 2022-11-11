-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 08:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_contact`) VALUES
(1, 'Katty', 'admin@gmail.com', '123', '012-9696969'),
(2, 'Sally2', 'sally@admin.com', '123', '011-741254791');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(85, 2, 'Sandwish', 15, 2, 'food-galler-img-3-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `number` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` varchar(500) NOT NULL,
  `reser_status` varchar(30) NOT NULL DEFAULT 'On going'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `phone_number`, `number`, `date`, `time`, `message`, `reser_status`) VALUES
(2, 1, 'Katherine', 'abc@g.com', '0123333333', '4', '2022-11-01', '13:00:00', '', 'Completed'),
(3, 3, 'jun', 'jun@example.com', '0175106026', '125', '2022-11-04', '13:00:00', '', 'On going');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `order_status`, `payment_status`) VALUES
(1, 'ORDER20221103150319D3', 3, 'jun', '0175106026', 'jun@example.com', 'paypal', '1274, 10, test, test, George Town, Penang, Malaysia - 14000', 'Sandwish (1) ', 15, '03-Nov-2022', 'pending', 'pending'),
(2, 'ORDER20221103150930D3', 3, 'jun', '0175106026', 'jun@example.com', 'paypal', '1274, 10, test, test, George Town, Penang, Malaysia - 14000', 'Sandwish (3) ', 45, '03-Nov-2022', 'pending', 'paid'),
(3, 'ORDER20221103151119D3', 3, 'jun', '0175106026', 'jun@example.com', 'cash on delivery', '1274, 10, test, test, George Town, Penang, Malaysia - 14000', 'Sandwish (2) ', 30, '03-Nov-2022', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_code`, `txn_id`, `order_id`, `total_payment`, `payment_status`, `shipping_address`, `created_at`) VALUES
(1, 'ORDER20221103150930D3', 'PZYI8FR2xRbLNjV14xw9', 9, '45.00', 'paid', '1274, 10, test, test, George Town, Penang, Malaysia - 14000', '2022-11-06 05:46:55'),
(2, 'ORDER20221103150621D3', 'DeNKg8AYYvPuSi0NMVh0', 8, '45.00', 'paid', '1274, 10, test, test, George Town, Penang, Malaysia - 14000', '2022-11-03 07:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Sandwish', 15, 'food-galler-img-3-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `password`, `address`) VALUES
(1, 'Katherine', 'abc@g.com', '0121234567', '202cb962ac59075b964b07152d234b70', '3-20, block b, jalan dedap 4, taman dedap, butterworth, penang, malayia - 13400'),
(2, 'abby', 'abby@gmail.com', '01215555555', '202cb962ac59075b964b07152d234b70', '3-20, block b, jalan dedap 4, taman dedap, butterworth, penang, malayia - 12000'),
(3, 'jun', 'jun@example.com', '0175106026', '4297f44b13955235245b2497399d7a93', '1274, 10, test, test, George Town, Penang, Malaysia - 14000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
