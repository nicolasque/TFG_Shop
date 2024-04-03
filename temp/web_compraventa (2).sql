-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 08:20 PM
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
(2, 1, 3, 24, '', '2024-04-02', 127),
(7, 10, 8, 30, '', '2024-04-03', 127),
(8, 3, 8, 20, '', '2024-04-03', 127),
(9, 3, 8, 19, '', '2024-04-03', 127),
(10, 3, 8, 23, '', '2024-04-03', 127),
(11, 10, 3, 31, '', '2024-04-03', 127),
(12, 8, 3, 33, '', '2024-04-03', 127),
(14, 5, 3, 19, '', '2024-04-03', 127),
(15, 5, 9, 29, '', '2024-04-03', 127),
(16, 5, 10, 30, '', '2024-04-03', 127),
(17, 10, 3, 19, '', '2024-04-03', 127),
(18, 3, 9, 29, '', '2024-04-03', 127),
(19, 3, 8, 33, '', '2024-04-03', 127),
(20, 3, 10, 31, '', '2024-04-03', 127),
(21, 3, 1, 24, '', '2024-04-03', 127),
(22, 1, 10, 31, '', '2024-04-03', 127),
(23, 1, 3, 26, '', '2024-04-03', 127),
(24, 6, 9, 29, '', '2024-04-03', 127),
(25, 6, 3, 19, '', '2024-04-03', 127),
(26, 5, 10, 31, '', '2024-04-03', 127);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `chat_id` int(11) NOT NULL,
  `user_id_buyer` int(11) NOT NULL,
  `message` text NOT NULL,
  `mesage_date` date NOT NULL DEFAULT current_timestamp(),
  `user_id_seller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`chat_id`, `user_id_buyer`, `message`, `mesage_date`, `user_id_seller`) VALUES
(3, 9, 'hola mundo', '2024-04-02', 3),
(3, 9, 'que tal', '2024-04-02', 3),
(3, 9, 'hola como estas ', '2024-04-02', 3),
(3, 9, 'mi amigo', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, 'reinici ael sistema', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, '', '2024-04-02', 3),
(3, 9, 'ey tu loquillo', '2024-04-02', 3),
(3, 9, 'que haces ahi', '2024-04-02', 3),
(3, 9, 'no se , y tu ?', '2024-04-02', 3),
(3, 9, 'pues buscar caracoles no te jode', '2024-04-02', 3),
(3, 9, 'hola que tal', '2024-04-03', 3),
(3, 9, 'y tu ?', '2024-04-03', 3),
(3, 9, 'hola', '2024-04-03', 3),
(2, 3, 'hola\n', '2024-04-03', 1),
(2, 3, 'tu eres de murcia ?', '2024-04-03', 1),
(2, 3, 'si claro ', '2024-04-03', 1),
(2, 3, 'que quieres de comrt', '2024-04-03', 1),
(2, 3, 'algo de pollo', '2024-04-03', 1),
(2, 3, 'dadsda', '2024-04-03', 1),
(2, 3, 'hola\n', '2024-04-03', 1),
(2, 3, 'eyyy\n', '2024-04-03', 1),
(4, 5, 'ey qu etal', '2024-04-03', 3),
(4, 5, 'bueno mira te comento', '2024-04-03', 3),
(5, 3, 'holaaa\n', '2024-04-03', 5),
(5, 3, 'esto es lo mas', '2024-04-03', 5),
(6, 9, 'hola user 54\n', '2024-04-03', 10),
(6, 9, ', me interesa este producto', '2024-04-03', 10),
(7, 8, 'eatro es el cha de user y nico', '2024-04-03', 10),
(7, 8, 'y no se qu evoy a hacer con el', '2024-04-03', 10),
(8, 8, 'ey que onda cuate', '2024-04-03', 3),
(9, 8, 'hola munodo, ?\n', '2024-04-03', 3),
(10, 8, 'qu tigruw increible', '2024-04-03', 3),
(7, 3, 'bonito gato', '2024-04-03', 10),
(11, 3, 'parce que nadie habla por aqui', '2024-04-03', 10),
(13, 3, 'hola pachecoi', '2024-04-03', 9),
(0, 5, 'hola', '2024-04-03', 3),
(0, 5, 'hola', '2024-04-03', 3),
(0, 5, '14:56', '2024-04-03', 3),
(14, 5, 'hola\n', '2024-04-03', 3),
(15, 5, 'hlaaa\n', '2024-04-03', 9),
(16, 5, 'eyyy bonito gato', '2024-04-03', 10),
(11, 10, 'holaa', '2024-04-03', 10),
(7, 10, 'eyy', '2024-04-03', 10),
(17, 10, 'eyy mikaela', '2024-04-03', 3),
(21, 3, 'buenos dias', '2024-04-03', 1),
(22, 1, 'SOY NICOLAsque1', '2024-04-03', 10),
(23, 1, 'holsasa', '2024-04-03', 3),
(19, 3, 'hola prueba con el buler cambiado', '2024-04-03', 8),
(8, 3, 'como estmao amigo', '2024-04-03', 3),
(20, 3, 'holaaa\n', '2024-04-03', 10),
(26, 5, 'holsaa', '2024-04-03', 10);

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
(19, 'hola mundo', 123457, 3, '6602bd8da055c', 'que pasa chabval', 'quequecedo@gmail.com', '2024-03-26'),
(20, 'pruea pdf', 43, 3, '6602bf330dfd7', 'Esto ahora es un png', 'quequecedo@gmail.com', '2024-03-26'),
(21, 'vendo opel corsa', 5432, 3, '66045b9be625d', 'vendo un opelcorsa todo guapo, casi sin uso era de mi abuelo y no lo usaba demasido, pero le encantaba derrapar en las rotodndas los domingos por la tarde cuando llovia ', 'quequecedo@gmail.com', '2024-03-27'),
(22, 'Prueba de textarea', 123, 3, '660467f3bac9f', 'haber que pasa cuando pasao un atextarea por aqui', 'quequecedo@gmail.com', '2024-03-27'),
(23, 'tigre', 12, 3, '660472af4ef1e', 'es un puto trigre', 'quequecedo@gmail.com', '2024-03-27'),
(24, 'tren con peroo', 876, 1, '6604764499629', 'subo un tren un perro y un tigre creo', 'nicolasque1', '2024-03-27'),
(26, 'soy quequece', 12345, 3, '660d8aa1599e4', 'estos es para generar buelt en la pagina', 'quequecedo@gmail.com', '2024-04-03'),
(29, 'prodyucto de pacheco', 4345, 9, '660d8c0682b8e', 'pachecho sube este producto', 'pacheco', '2024-04-03'),
(30, 'producto de user 42', 45, 10, '660d8d484b2da', 'esto es un producto de use r42', 'user42', '2024-04-03'),
(31, 'otro podructo de user 42', 56, 10, '660d8d5b05371', 'segundo producto', 'user42', '2024-04-03'),
(32, 'producto de ncolas', 654, 8, '660d8d93d7d79', 'que pase he ue pasa\r\n', 'ncolas', '2024-04-03'),
(33, 'segundo producto de ncolas', 654, 8, '660d8da6a8665', 'si ses el segudno', 'ncolas', '2024-04-03');

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
(8, 'ncolas', 'nquece', 'Famili', 'queque@es.commm', '42*Urduliz', 0),
(9, 'pacheco', 'juan', 'Pacheco', '1234@gmail.com', 'Familia-12341', 0),
(10, 'user42', 'nico', 'si', 'ertyhjgfde@kapsch.com', 'Familia-12341', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

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
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
