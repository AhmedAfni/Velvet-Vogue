-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 11:48 AM
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
-- Database: `velvet_vogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(5, 'Afni Ahmed', 's92075238@ousl.lk', '$2y$10$AcT1DViRR4UEqzKN6w1NV.FPS0BiRfrOgon4.BoFuT6u4tFyIg94O', '2024-11-30 18:22:44'),
(6, 'Admin', 'admin@mail.com', '$2y$10$TWVZBwAkOTTzrI1OPJKlXuS9fImqu6SQC4HFbwA.tit5zzKISTwcS', '2024-12-01 07:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_number`, `total_amount`, `status`, `payment_status`, `payment_method`, `shipping_address`, `billing_address`, `shipping_method`, `shipping_cost`, `tax_amount`, `notes`, `created_at`, `updated_at`) VALUES
(2, 3, 'ORD20241201094537144', 5800.00, 'shipped', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 08:45:37', '2024-12-01 08:47:39'),
(3, 3, 'ORD20241201095108961', 3340.00, 'pending', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 08:51:08', '2024-12-01 08:51:08'),
(4, 3, 'ORD20241201095530460', 3840.00, 'pending', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 08:55:30', '2024-12-01 08:55:30'),
(5, 3, 'ORD20241201111522445', 1340.00, 'pending', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 10:15:22', '2024-12-01 10:15:22'),
(6, 3, 'ORD20241201114040272', 2330.00, 'processing', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 10:40:40', '2024-12-01 10:40:40'),
(7, 3, 'ORD20241201114649828', 3840.00, 'processing', 'paid', 'Credit Card', '67 Almanar Road Maruthamunai', '67 Almanar Road Maruthamunai', 'Standard Delivery', 350.00, 0.00, NULL, '2024-12-01 10:46:49', '2024-12-01 10:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `size`, `price`, `subtotal`, `created_at`) VALUES
(1, 2, 8, 2, 'XL', 990.00, 1980.00, '2024-12-01 08:45:37'),
(2, 2, 20, 1, 'L', 1490.00, 1490.00, '2024-12-01 08:45:37'),
(3, 2, 8, 1, 'L', 990.00, 990.00, '2024-12-01 08:45:37'),
(4, 2, 14, 1, 'M', 990.00, 990.00, '2024-12-01 08:45:37'),
(5, 3, 5, 1, 'XL', 2990.00, 2990.00, '2024-12-01 08:51:08'),
(6, 4, 3, 1, 'XL', 3490.00, 3490.00, '2024-12-01 08:55:30'),
(7, 5, 8, 1, 'XL', 990.00, 990.00, '2024-12-01 10:15:22'),
(8, 6, 8, 2, 'XL', 990.00, 1980.00, '2024-12-01 10:40:40'),
(9, 7, 3, 1, 'XL', 3490.00, 3490.00, '2024-12-01 10:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `card_last_four` varchar(4) DEFAULT NULL,
  `cardholder_name` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_number`, `amount`, `payment_method`, `card_last_four`, `cardholder_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ORD20241201114040272', 2330.00, 'Credit Card', '5255', 'fgnn', 'completed', '2024-12-01 10:40:40', '2024-12-01 10:40:40'),
(2, 'ORD20241201114649828', 3840.00, 'Credit Card', '4485', 'Himan', 'completed', '2024-12-01 10:46:49', '2024-12-01 10:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image_path`, `description`, `price`, `product_type`) VALUES
(1, 'Xavier - Stylish fur hoodie for men', 'assets/hoodie1.svg', 'Stylish fur hoodie for men Orange.', 3490.00, 'hoodie'),
(2, 'Xavier - Stylish fur hoodie for men', 'assets/hoodie2.svg', 'Stylish fur hoodie for men Blue.', 3490.00, 'hoodie'),
(3, 'Xavier - Stylish fur hoodie for men', 'assets/hoodie3.svg', 'Stylish fur hoodie for men Peach.', 3490.00, 'hoodie'),
(4, 'Stretch Casual Denim Pants', 'assets/pant1.svg', 'Stretch Casual Denim Pants for Men.', 2990.00, 'pants'),
(5, 'Stretch Casual Denim Pants', 'assets/pant2.svg', 'Stretch Casual Denim Pants for Men.', 2990.00, 'pants'),
(6, 'Stretch Casual Denim Pants', 'assets/pant3.svg', 'Stretch Casual Denim Pants for Men.', 2990.00, 'pants'),
(7, 'Men Solid Round Neck T-Shirt', 'assets/tshirt1.svg', 'Men Solid Round Neck T-Shirt Brown.', 990.00, 'tshirt'),
(8, 'Men Solid Round Neck T-Shirt', 'assets/tshirt2.svg', 'Men Solid Round Neck T-Shirt Blue.', 990.00, 'tshirt'),
(9, 'Men Solid Round Neck T-Shirt', 'assets/tshirt3.svg', 'Men Solid Round Neck T-Shirt Green.', 990.00, 'tshirt'),
(10, 'Men Drawstring Waist Shorts', 'assets/shorts1.svg', 'Men Drawstring Waist Shorts Black', 1490.00, 'shorts'),
(11, 'Men Drawstring Waist Shorts', 'assets/shorts2.svg', 'Men Drawstring Waist Shorts Grey', 1490.00, 'shorts'),
(12, 'Men Drawstring Waist Shorts', 'assets/shorts3.svg', 'Men Drawstring Waist Shorts White', 1490.00, 'shorts'),
(13, 'Women Basic Tops Short Sleeve T-Shirts', 'assets/women_tshirt1.svg', 'Women Short Sleeve T-Shirts Maroon', 990.00, 'tshirt'),
(14, 'Women Basic Tops Short Sleeve T-Shirts', 'assets/women_tshirt2.svg', 'Women Short Sleeve T-Shirts Browns', 990.00, 'tshirt'),
(15, 'Women Basic Tops Short Sleeve T-Shirts', 'assets/women_tshirt3.svg', 'Women Short Sleeve T-Shirts Purple', 990.00, 'tshirt'),
(16, 's.Oliver Women Pants', 'assets/women_pant1.svg', 's.Oliver Women Pants', 2990.00, 'pants'),
(17, 's.Oliver Women Pants', 'assets/women_pant2.svg', 's.Oliver Women Pants', 2990.00, 'pants'),
(18, 's.Oliver Women Pants', 'assets/women_pant3.svg', 's.Oliver Women Pants', 2990.00, 'pants'),
(19, 'Women Shorts with Pocket ', 'assets/women_shorts1.svg', 'Women Shorts with Pocket ', 1490.00, 'shorts'),
(20, 'Women Shorts with Pocket ', 'assets/women_shorts2.svg', 'Women Shorts with Pocket ', 1490.00, 'shorts'),
(21, 'Women Shorts with Pocket ', 'assets/women_shorts3.svg', 'Women Shorts with Pocket ', 1490.00, 'shorts'),
(22, 'Women Hoodie ', 'assets/women_hoodie1.svg', 'Women Hoodie Blue', 3490.00, 'hoodie'),
(23, 'Women Hoodie ', 'assets/women_hoodie2.svg', 'Women Hoodie Dark Blue', 3490.00, 'hoodie'),
(24, 'Women Hoodie ', 'assets/women_hoodie3.svg', 'Women Hoodie Brown', 3490.00, 'hoodie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `home_address` text NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `home_address`, `postal_code`, `email`, `password`, `created_at`) VALUES
(3, 'afni ahmed', '67 Almanar Road Maruthamunai', '32314', 'ahmedafni86@gmail.com', '$2y$10$uqOfZ864GcLV3llVhi16P.Z/gNt8u4tkTOlQ5.BLnvi1e2LFef2z.', '2024-11-22 17:16:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_number` (`order_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
