-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 11:35 AM
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
-- Database: `pets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
CREATE DATABASE IF NOT EXISTS pets;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `number`, `address`, `email`, `password`) VALUES
(1, 'admin', '12345', '  Sialkot', 'admin12@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `alllpets`
--

CREATE TABLE `alllpets` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `picture_url` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alllpets`
--

INSERT INTO `alllpets` (`id`, `name`, `price`, `quantity`, `description`, `picture_url`, `seller_id`) VALUES
(2, 'Parrots', '99', '4', 'parots', '', 1),
(4, 'Dog', '99', '4', 'Dog', '', 1),
(8, 'cat', '1223', '55', 'sdfsdf', '', 1),
(10, 'Mongral Dog ', '3420', '5', 'Dog', '', 1),
(12, 'Sparrow', '2999', '33', 'Sparrows\r\n', '', 1),
(14, 'Cat', '2999', '33', 'cat', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Cat'),
(2, 'Dogs'),
(3, 'Birds');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `number`, `address`, `email`, `password`) VALUES
(3, 'kabir Ali', '12344', 'Sialkot', 'kabir12@gmail.com', '1234'),
(24, 'zain', '2', 'sialkot', 'admin12@gmail.com', '123'),
(25, '1', '1', '', 'admin12@gmail.com', '123'),
(26, '1', '1', '', 'admin12@gmail.com', '123'),
(27, '', '', '', '', ''),
(28, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `pet_id`, `price`, `quantity`, `grand_total`, `status`) VALUES
(1, 3, 4, '99', '1', '99', 'delivered'),
(2, 3, 0, '', '288', '0', 'pending'),
(3, 3, 4, '99', '288', '28512', 'delivered'),
(5, 3, 4, '99', '2', '198', 'delivered'),
(14, 3, 2, '99', '1', '99', 'delivered'),
(15, 3, 2, '99', '1', '99', 'pending'),
(16, 3, 2, '99', '1', '99', 'pending'),
(17, 3, 4, '99', '1', '99', 'pending'),
(18, 3, 2, '99', '1', '99', 'pending'),
(19, 24, 4, '99', '1', '99', 'pending'),
(20, 25, 4, '99', '1', '99', 'pending'),
(21, 26, 4, '99', '1', '99', 'pending'),
(22, 27, 4, '99', '0', '0', 'pending'),
(23, 28, 4, '99', '0', '0', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `pet_id` varchar(50) NOT NULL,
  `img_name` varchar(50) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `pet_id`, `img_name`, `path`) VALUES
(8, '2', 'colorful-parrot-branch-sunlit-ro.jpg', '../Assets/pictures/pets/colorful_parrot_branch_sunlit_ro.jpg'),
(9, '4', 'dog-cat-pet-animal-logo-260nw-24.jpg', '../Assets/pictures/pets/dog_cat_pet_animal_logo_260nw_24.jpg'),
(10, '6', 'cat.png', '../pictures/pets/cat.png'),
(11, '6', 'cat.png', '../Assets/pictures/pets/cat.png'),
(12, '6', 'cat.png', '../Assets/pictures/pets/cat.png'),
(13, '8', 'cat.png', '../Assets/pictures/pets/cat.png'),
(14, '10', 'mongrel-dog-red-color-lies-its-s.jpg', '../Assets/pictures/pets/mongrel_dog_red_color_lies_its_s.jpg'),
(15, '12', 'close-up-sparrow-wooden-table_10.jpg', '../Assets/pictures/pets/close_up_sparrow_wooden_table_10.jpg'),
(16, '14', 'cute-spitz_144627-7076.jpg', '../Assets/pictures/pets/cute_spitz_144627_7076.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `number`, `address`, `email`, `password`) VALUES
(1, 'attiq alii', '123465', 'Sialkot', 'ali123@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alllpets`
--
ALTER TABLE `alllpets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seller_id` (`seller_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alllpets`
--
ALTER TABLE `alllpets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alllpets`
--
ALTER TABLE `alllpets`
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
