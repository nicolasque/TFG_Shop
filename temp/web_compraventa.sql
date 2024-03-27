-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 11:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_compraventa`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(9) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `photo` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `user_id`, `photo`, `description`, `user_name`, `upload_date`) VALUES
(15, 'casa CAMBIADA', 4242, 3, '6602bae866db5', 'Hola mundo ira que bonita casa\r\nY este texto cambiado.', 'quequecedo@gmail.com', '2024-03-26'),
(18, 'habe ruqe pasa', 1423, 3, '6602bd5ede4cd', 'hvot ap probar', 'quequecedo@gmail.com', '2024-03-26'),
(19, 'hola mundo', 1234570, 3, '6602bd8da055c', 'que pasa chabval', 'quequecedo@gmail.com', '2024-03-26'),
(20, 'pruea pdf', 43, 3, '6602bf330dfd7', 'Esto ahora es un png', 'quequecedo@gmail.com', '2024-03-26'),
(21, 'vendo opel corsa', 5432, 3, '66045b9be625d', 'vendo un opelcorsa todo guapo, casi sin uso era de mi abuelo y no lo usaba demasido, pero le encantaba derrapar en las rotodndas los domingos por la tarde cuando llovia ', 'quequecedo@gmail.com', '2024-03-27'),
(22, 'Prueba de textarea', 123, 3, '660467f3bac9f', 'haber que pasa cuando pasao un atextarea por aqui', 'quequecedo@gmail.com', '2024-03-27'),
(23, 'tigre', 12, 3, '660472af4ef1e', 'es un puto trigre', 'quequecedo@gmail.com', '2024-03-27'),
(24, 'tren con peroo', 876, 1, '6604764499629', 'subo un tren un perro y un tigre creo', 'nicolasque1', '2024-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `surname`, `email`, `password`, `admin`) VALUES
(1, 'nicolasque1', 'nico', 'quece', 'nicoquece@gmail.com', '12341', 0),
(3, 'quequecedo@gmail.com', 'nicolas', 'quecedo', 'quequecedo@gmail.com', '12341', 1),
(5, '954404', 'nicolas', 'quecedo gaminde', 'quequedo@gmail.com', 'Familia-12341', 0),
(6, '9544040', 'nicolas', 'quecedo', 'quequecedo@ail.com', '42_Urduliz', 1),
(7, 'quequeedo@gmail.com', 'nicolas', 'quecedo', 'queqcedo@gmail.com', 'Urduliz-42', 0),
(8, 'ncolas', 'nquece', 'Famili', 'queque@es.commm', '42*Urduliz', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_name` (`product_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
