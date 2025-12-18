-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2025 at 09:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

CREATE DATABASE IF NOT EXISTS candyland_database CHARACTER SET utf8 COLLATE utf8_general_ci;
USE candyland_database;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candyland_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `street_number` int NOT NULL,
  `adress_line1` varchar(255) NOT NULL,
  `adress_line2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int NOT NULL,
  `country_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `ordered_product_id` int NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `id` int NOT NULL,
  `product_item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(99) NOT NULL,
  `description` text NOT NULL,
  `product_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `product_image`) VALUES
(1, 11, 'Assortiment Bonbons Colorés', 'Diverses collections de bonbons colorés et délicieux', 'assets/images/bonbons.jpg'),
(2, 11, 'Oursons Gélifiés', 'Oursons en gélatine au goût de fraise et de citron', 'assets/images/oursons.jpg'),
(3, 11, 'Bonbons Acidulés', 'Des bonbons épicés et acides au goût explosif', 'assets/images/acidules.jpg'),
(4, 12, 'Tablette Chocolat Noir', 'Chocolat noir à 70% de cacao fort et épicé', 'assets/images/chocolat.jpg'),
(5, 12, 'Chocolat au Lait', 'Du lait et un délicieux chocolat au lait pour toute la famille', 'assets/images/lait.jpg'),
(6, 12, 'Chocolat Blanc Premium', 'Chocolat blanc de première qualité au goût pur de vanille', 'assets/images/blanc.jpg'),
(7, 13, 'Sucettes Artisanales Fraise', 'Sucettes artistiques au goût de fraise', 'assets/images/sucettes.jpg'),
(8, 13, 'Sucettes Couleurs Arc-en-ciel', 'Collection arc-en-ciel de diverses sucettes', 'assets/images/Sucettes-c.jpg'),
(9, 13, 'Bonbons à la menthe poivrée', 'Sucette rafraîchissante et sucrée au goût de menthe', 'assets/images/menthe.jpg'),
(10, 14, 'Guimauves Vanille', 'poisson vanille doux et aéré', 'assets/images/guimauves.jpg'),
(11, 14, 'Guimauves Chocolat', 'Poisson enrobé de chocolat noir', 'assets/images/Guimauves-c.jpg'),
(12, 14, 'guimauves à l\'orange', 'Une collection de plats de poisson variés aux goûts différents', 'assets/images/guimauves-o.jpg'),
(13, 12, 'jelly belli', 'Les Jelly Belly :\r\n\r\nPetits bonbons iconiques aux couleurs vives, les Jelly Belly offrent une explosion de saveurs précises et surprenantes, allant du fruité classique aux goûts les plus inattendus. Leur texture tendre et leur variété infinie en font une gourmandise ludique, addictive et parfaite pour tous les moments.', 'assets/images/ChatGPT Image 4 déc. 2025, 17_44_49.png'),
(14, 12, 'Ciao Kombucha', 'Une boisson pétillante et naturellement fermentée qui allie fraîcheur, légèreté et bien-être. Avec ses arômes fruités et son équilibre parfait entre douceur et acidité, Ciao Kombucha apporte un boost vivifiant tout en offrant une alternative saine et tendance pour se faire plaisir à chaque gorgée.', 'assets/images/ChatGPT Image 4 déc. 2025, 17_36_42.png'),
(15, 12, 'Chocolat de Dubaï Original', 'L\'authentique chocolat de Dubaï.', 'assets/images/ChatGPT Image 4 déc. 2025, 10_35_15.png'),
(16, 11, 'Mélange Signature-Noël', 'Le mélange sucré-salé ultime ! Des chips croustillantes accompagnées de bouchées chocolatées, approuvé par le Père Noël', 'assets/images/30c6ae0b-22c7-4747-9dae-5d26b14663f2.jpg'),
(17, 12, 'Sucres d\'Orge Cola Rétro', 'Une touche nostalgique avec une saveur moderne ! Ces sucres d\'orge au goût pétillant de cola sont fabriqués avec des arômes 100% naturels', 'assets/images/ChatGPT Image 9 déc. 2025, 11_57_58.png'),
(18, 12, 'Truffes au Caramel', 'Un mélange fondant de chocolat et de caramel au beurre salé.', 'assets/images/truffes_caramel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int NOT NULL,
  `parent_category_id` int DEFAULT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `parent_category_id`, `category_name`) VALUES
(11, NULL, 'Bonbons & Gélifiés'),
(12, NULL, 'Chocolat'),
(13, NULL, 'Sucettes'),
(14, NULL, 'Guimauves');

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_item`
--

INSERT INTO `product_item` (`id`, `product_id`, `stock`, `price`) VALUES
(1, 1, 15, 13),
(2, 2, 20, 10),
(3, 3, 18, 11),
(4, 4, 12, 15),
(5, 5, 16, 13),
(6, 6, 10, 16),
(7, 7, 25, 9),
(8, 8, 22, 10),
(9, 9, 19, 9),
(10, 10, 14, 12),
(11, 11, 13, 13),
(12, 12, 17, 13),
(13, 13, 50, 5),
(14, 14, 40, 3),
(15, 15, 30, 15),
(16, 16, 20, 12),
(17, 17, 15, 4),
(18, 18, 100, 22);

-- --------------------------------------------------------
CREATE TABLE `settings` (
  `id` int NOT NULL,
  `key_name` varchar(100) NOT NULL,
  `value` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'PHP MVC Starter', 'Nom du site web', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(2, 'maintenance_mode', '0', 'Mode maintenance (0 = désactivé, 1 = activé)', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(3, 'max_login_attempts', '5', 'Nombre maximum de tentatives de connexion', '2025-09-09 16:37:49', '2025-09-09 16:37:49'),
(4, 'session_timeout', '3600', 'Timeout de session en secondes', '2025-09-09 16:37:49', '2025-09-09 16:37:49');
--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int NOT NULL,
  `name` varchar(99) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_item_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` date NOT NULL,
  `payment_id` int NOT NULL,
  `shipping_adress` int NOT NULL,
  `shipping_method` int NOT NULL,
  `order_total` int NOT NULL,
  `order_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(99) DEFAULT NULL,
  `firstname` varchar(99) NOT NULL,
  `lastname` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `role` enum('user','admin','superadmin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` int NOT NULL,
  `adress_id` int NOT NULL,
  `is_default` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_method`
--

CREATE TABLE `user_payment_method` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `payment_type_id` int NOT NULL,
  `provider` varchar(99) NOT NULL,
  `account_number` int NOT NULL,
  `expiry_date` date NOT NULL,
  `is_default` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_name` (`key_name`);


--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payment_method`
--
ALTER TABLE `user_payment_method`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_payment_method`
--
ALTER TABLE `user_payment_method`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
