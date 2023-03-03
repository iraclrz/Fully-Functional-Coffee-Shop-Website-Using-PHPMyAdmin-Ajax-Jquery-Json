-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 04:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

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
  `image` varchar(100) NOT NULL,
  `options` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `options` varchar(255) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `options`, `description`, `note`, `price`, `image`) VALUES
(22, 'Signature Tablea Drink', 'iced', 'Is a traditional Filipino chocolate drink made with tablea de cacao and milk that is slight sweetened with sugar.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 130, 'signature-tablea-drink.JPG'),
(23, 'Matcha Latte', 'iced', 'Is a tea latte made with green tea powder and steamed milk. A perfect non-espresso based if you want to have a caffeine boost without coffee.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 130, 'matcha-latte.JPG'),
(24, 'Peppermint Mocha Latte ', 'iced', 'Get the taste of the holidays daily! With this holiday-themed espresso-based drink with steamed milk mixed with mocha and peppermint sauce.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 140, 'peppermint-mocha-latte.JPG'),
(25, 'Muscovado Cinnamon Latte ', 'iced', 'Is an espresso-based drink mixed with milk and a muscovado sauce for an additional toffee-like taste, and a hint of cinnamon.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 135, 'muscovado-cinnamon-latte.JPG'),
(26, 'Spanish Latte ', 'iced', 'Is an espresso-based drink mixed with milk and condensed milk. It is slightly sweeter than a normal latte.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 130, 'spanish-latte.JPG'),
(27, 'Salted Caramel Latte ', 'iced', 'Is a creamy espresso drink topped with steamed, frothed milk, caramel drizzle and a touch of sea salt', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 140, 'salted-caramel-latte.JPG'),
(28, 'Caramel Macchiato ', 'iced', 'Is an espresso-based drink with freshly steamed milk with vanilla-flavored soup topped with a caramel drizzle for a sweet finish.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 140, 'caramel-macchiato.JPG'),
(29, 'Caffe Latte ', 'iced', 'Is a concoction of hard brewed espresso with milk and foam resulting in a pattern or design on the surface of the latte.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 120, 'caffe-latte.JPG'),
(30, 'Cappuccino', 'iced', 'Is an espresso-based drink with steamed whole milk and thick rich foam to offer a velvety texture', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 125, 'cappuccino.JPG'),
(31, 'Dirty Matcha', 'iced', 'Is a refreshing blend of sweet, iced coffee and creamy green tea to create a layered matcha-espresso fusion drink.', '', 150, 'dirty-matcha.JPG'),
(32, 'Caffe Tablea ', 'iced', 'Is an espresso-based drink mixed with a sweetened tablea, a ball of ground-up cacao beans to make a traditional Filipino chocolate, with chocolate drizzle line in the cup.', '', 140, 'caffe-tablea.JPG'),
(33, 'Americano', 'iced', 'Is a coffee-based drink made just with hot water and espresso, 1-oz, shot or doppio (double shot), that has been diluted to resemble drip coffee in flavor.', '', 90, 'americano.JPG'),
(34, 'Strawberry Latte ', 'iced', 'Is a steamed milk drink mixed with strawberry bits, and strawberry syrup drizzle line in the cup.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 120, 'strawberry-latte.jpg'),
(35, 'Mixed Berries Latte', 'iced', 'Mixed berries are a combination of both blueberry and strawberry bits for additional hint of sweet and sour, mixed with steamed milk, and blueberry and strawberry drizzle line in the cup.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 120, 'mixed-berries-latte.jpg'),
(36, 'Blueberry Latte ', 'iced', 'Is a steamed milk drink mixed with blueberry bits, and blueberry syrup drizzle line in the cup.', 'If you don’t drink dairy milk, you can easily swap it for a plant-based alternative. We offer almond, oat and soy sub. Just add a note on a message tab upon checkout.', 120, 'blueberry-latte.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'user1', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', 'user'),
(2, 'admin1', 'admin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
