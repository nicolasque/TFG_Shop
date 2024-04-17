-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 06:03 PM
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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id_buyer` int(11) NOT NULL,
  `user_id_seller` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id_buyer`, `user_id_seller`, `product_id`, `message`, `date`, `seen`) VALUES
(31, 3, 8, 33, '', '2024-04-08', 127),
(32, 3, 8, 32, '', '2024-04-08', 127),
(33, 3, 10, 31, '', '2024-04-08', 127),
(34, 3, 1, 24, '', '2024-04-08', 127),
(36, 8, 9, 29, '', '2024-04-08', 127),
(37, 3, 9, 29, '', '2024-04-08', 127),
(38, 3, 10, 30, '', '2024-04-12', 127);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mesage_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `mesage_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mesage_id`, `chat_id`, `user_id`, `message`, `mesage_date`) VALUES
(64, 31, 3, 'holaaa que tal ncolas', '2024-04-08'),
(65, 32, 3, 'hola que tal , ncolas', '2024-04-08'),
(66, 33, 3, 'que tal user 42', '2024-04-08'),
(67, 34, 3, 'Bonito tren con perro', '2024-04-08'),
(68, 31, 8, 'eyy tdo bien mamon', '2024-04-08'),
(69, 35, 8, 'vaya cacharo que llevas', '2024-04-08'),
(70, 36, 8, 'eyy pache buna figura', '2024-04-08'),
(71, 37, 3, 'bua que bueno e pche ya me alegro que ya no se muestren los otros mensajes qui', '2024-04-08'),
(72, 31, 3, 'nuev pruebita del estilo del texto', '2024-04-10'),
(73, 31, 3, 'holaa\n', '2024-04-10'),
(74, 31, 3, 'si claro mujo que bueno\n', '2024-04-10'),
(75, 37, 3, 'no sai que los menajes se veia asi, supongo que tendre que cambiar sosas dl codigo para que encaje mejor\n', '2024-04-10'),
(76, 31, 3, 'que se cuenta este mamahuevo', '2024-04-10'),
(77, 31, 3, 'ayyy caramba ', '2024-04-10'),
(78, 31, 3, 'y como ver lo del patido de mañana', '2024-04-10'),
(79, 31, 3, 'y que te cuentas primo', '2024-04-10'),
(80, 31, 3, 'a que bueno', '2024-04-10'),
(81, 31, 3, 'que bien ya funciona', '2024-04-10'),
(82, 35, 3, 'eyy\n', '2024-04-12'),
(83, 35, 3, 'me alegro de hablar contiigo', '2024-04-12'),
(84, 35, 8, 'que bueno parece que todo funciona ne el chat ', '2024-04-12'),
(85, 38, 3, 'hola user 42', '2024-04-12'),
(86, 31, 8, 'que bueno mamon', '2024-04-12');

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
  `city` varchar(30) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `user_id`, `photo`, `description`, `city`, `user_name`, `upload_date`) VALUES
(20, 'pruea pdf', 43, 3, '6602bf330dfd7', 'Esto ahora es un png cambio desde admin', NULL, 'quequecedo@gmail.com', '2024-03-26'),
(21, 'vendo opel corsa', 5432, 3, '66045b9be625d', 'vendo un opelcorsa todo guapo, casi sin uso era de mi abuelo y no lo usaba demasido, pero le encantaba derrapar en las rotodndas los domingos por la tarde cuando llovia ', NULL, 'quequecedo@gmail.com', '2024-03-27'),
(22, 'Prueba de textarea', 123, 3, '660467f3bac9f', 'haber que pasa cuando pasao un atextarea por aqui', NULL, 'quequecedo@gmail.com', '2024-03-27'),
(23, 'tigre', 12, 3, '660472af4ef1e', 'es un puto trigre ahora estoy intentando cambiarlo desde la pagina de vcambiar', NULL, 'quequecedo@gmail.com', '2024-03-27'),
(24, 'tren con peroo', 876, 1, '6604764499629', 'subo un tren un perro y un tigre creo', NULL, 'nicolasque1', '2024-03-27'),
(26, 'soy quequece', 12345, 3, '660d8aa1599e4', 'estos es para generar buelt en la pagina', NULL, 'quequecedo@gmail.com', '2024-04-03'),
(29, 'prodyucto de pacheco', 4345, 9, '660d8c0682b8e', 'pachecho sube este producto', NULL, 'pacheco', '2024-04-03'),
(30, 'producto de user 42', 45, 10, '660d8d484b2da', 'esto es un producto de use r42', NULL, 'user42', '2024-04-03'),
(31, 'otro podructo de user 42', 56, 10, '660d8d5b05371', 'segundo producto', NULL, 'user42', '2024-04-03'),
(32, 'producto de ncolas', 654, 8, '660d8d93d7d79', 'que pase he ue pasa\r\n', NULL, 'ncolas', '2024-04-03'),
(33, 'segundo producto de ncolas', 654, 8, '660d8da6a8665', 'si ses el segudno', NULL, 'ncolas', '2024-04-03'),
(34, 'Try city', 543, 3, '6616ba23ab5c5', 'Es para ver si funcona esto de la ciudad', 'Bilbao', 'quequecedo@gmail.com', '2024-04-10'),
(35, 'Pueba, comentarios quitados', 7654, 3, '661945ba079f5', 'Es para ver si se ha roto la pagina', 'Bilbao', 'quequecedo@gmail.com', '2024-04-12');

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
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `Register_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `surname`, `email`, `password`, `admin`, `Register_date`) VALUES
(1, 'nicolasque1', 'nico', 'quece', 'nicoquece@gmail.com', '12341', 1, '2024-04-08'),
(3, 'quequecedo@gmail.com', 'nicolas', 'quecedo', 'quequecedo@gmail.com', '12341', 1, '2024-04-08'),
(5, '954404', 'nicolas', 'quecedo gaminde', 'quequedo@gmail.com', 'Familia-12341', 0, '2024-04-08'),
(6, '9544040', 'nicolas', 'quecedo', 'quequecedo@ail.com', '42_Urduliz', 1, '2024-04-08'),
(7, 'quequeedo@gmail.com', 'nicolas', 'quecedo', 'queqcedo@gmail.com', 'Urduliz-42', 0, '2024-04-08'),
(8, 'ncolas', 'nquece', 'Famili', 'queque@es.commm', '42*Urduliz', 0, '2024-04-08'),
(9, 'pacheco', 'juan', 'Pacheco', '1234@gmail.com', 'Familia-12341', 0, '2024-04-08'),
(10, 'user42', 'nico', 'si', 'ertyhjgfde@kapsch.com', 'Familia-12341', 0, '2024-04-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mesage_id`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mesage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
