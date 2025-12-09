-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2025 at 01:26 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

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
(5, 12, 'Chocolat au Lait', 'Du lait et un délicieux chocolat au lait pour toute la famille', 'assets/images/bonbons.jpg'),
(6, 12, 'Chocolat Blanc Premium', 'Chocolat blanc de première qualité au goût pur de vanille', 'assets/images/oursons.jpg'),
(7, 13, 'Sucettes Artisanales Fraise', 'Sucettes artistiques au goût de fraise', 'assets/images/sucettes.jpg'),
(8, 13, 'Sucettes Couleurs Arc-en-ciel', 'Collection arc-en-ciel de diverses sucettes', 'assets/images/acidules.jpg'),
(9, 13, 'Sucettes Menthe Glacée', 'Sucette rafraîchissante et sucrée au goût de menthe', 'assets/images/bonbons.jpg'),
(10, 14, 'Guimauves Vanille', 'poisson vanille doux et aéré', 'assets/images/guimauves.jpg'),
(11, 14, 'Guimauves Chocolat', 'Poisson enrobé de chocolat noir', 'assets/images/chocolat.jpg'),
(12, 14, 'Guimauves Assortiment', 'Une collection de plats de poisson variés aux goûts différents', 'assets/images/oursons.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
