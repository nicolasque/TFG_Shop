-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 07:36 PM
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
-- Table structure for table `admin_report`
--

CREATE TABLE `admin_report` (
  `report_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `report_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_report`
--

INSERT INTO `admin_report` (`report_id`, `name`, `email`, `message`, `report_date`) VALUES
(1, 'nicolas quecedo', '0', 'Prueba de mensje a admin', '2024-04-17'),
(2, 'nicolas quecedo', '0', 'Prueba de mensje a admin', '2024-04-17'),
(3, 'nicolas quecedo', '0', 'Peuba 2 de mensaje', '2024-04-17'),
(4, 'hola qye tal ', 'purba@gmail.com', 'Hora lestoy prbando esto de mandar mensaje al dministrador', '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id_buyer` int(11) NOT NULL,
  `user_id_seller` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id_buyer`, `user_id_seller`, `product_id`, `date`, `seen`) VALUES
(31, 3, 8, 33, '2024-04-08', 127),
(32, 3, 8, 32, '2024-04-08', 127),
(33, 3, 10, 31, '2024-04-08', 127),
(34, 3, 1, 24, '2024-04-08', 127),
(36, 8, 9, 29, '2024-04-08', 127),
(37, 3, 9, 29, '2024-04-08', 127),
(38, 3, 10, 30, '2024-04-12', 127),
(39, 14, 3, 21, '2024-04-15', 127),
(40, 10, 8, 33, '2024-04-16', 127),
(41, 5, 3, 21, '2024-04-17', 127),
(42, 15, 3, 23, '2024-04-17', 127),
(43, 15, 3, 26, '2024-04-17', 127);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(9) NOT NULL,
  `forum_name` varchar(60) NOT NULL,
  `topic` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `active_users` int(11) NOT NULL DEFAULT 0,
  `date_of_creation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_name`, `topic`, `description`, `active_users`, `date_of_creation`) VALUES
(1, 'pruba1', 'Pruebas', 'Este es un foro de prueba', 4, '2024-04-17'),
(2, 'prueba1', 'prubas', 'Este es un foro para ver si funcionan las restriccones', 3, '2024-04-17'),
(3, 'prueba2', 'Pruebas', 'Esta e suna segunda pruba de que todo funcione', 1, '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE `forum_post` (
  `forum_mesage_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_post`
--

INSERT INTO `forum_post` (`forum_mesage_id`, `forum_id`, `user_id`, `message`, `message_date`) VALUES
(1, 1, 3, 'hola mundo', 0),
(2, 1, 3, 'que tal', 0),
(3, 1, 5, 'muy bien y tu ?', 0),
(4, 2, 5, 'Este es un mensaje de prueba', 0),
(5, 3, 5, 'hola que tal foro', 0),
(6, 2, 5, 'hola mundo', 0),
(7, 1, 3, 'eeey\r\n', 0),
(8, 1, 8, 'holaa\r\n', 0),
(9, 2, 8, 'holaaa\r\n', 0),
(10, 1, 15, 'Funciona esto ?', 0),
(11, 2, 15, 'Parece que si', 0);

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
(85, 38, 3, 'hola user 42', '2024-04-12'),
(86, 31, 8, 'que bueno mamon', '2024-04-12'),
(87, 31, 3, 'HOLA QUE TAL', '2024-04-15'),
(88, 39, 14, 'Hola que quecedo, estoy interesado\n', '2024-04-15'),
(89, 31, 3, 'ey a que precio le dejas el loro a irune ?\n', '2024-04-16'),
(90, 31, 3, '654 es muy caro\n', '2024-04-16'),
(91, 34, 3, 'a que si', '2024-04-16'),
(92, 33, 10, 'eyy que hona cuate', '2024-04-16'),
(93, 40, 10, 'hola ncolas estoy unteresado en tu segundo prducto', '2024-04-16'),
(94, 41, 5, 'Me interesa el opol corsa', '2024-04-17'),
(95, 42, 15, 'hola esto es una pruba despues de cambiar las fk', '2024-04-17'),
(96, 43, 15, 'Nueva prueba', '2024-04-17');

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
  `times_seen` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(50) NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `user_id`, `photo`, `description`, `city`, `times_seen`, `user_name`, `upload_date`) VALUES
(21, 'vendo opel corsa', 5432, 3, '66045b9be625d', 'vendo un opelcorsa todo guapo, casi sin uso era de mi abuelo y no lo usaba demasido, pero le encantaba derrapar en las rotodndas los domingos por la tarde cuando llovia ', NULL, 2, 'quequecedo@gmail.com', '2024-03-27'),
(22, 'Prueba de textarea', 123, 3, '660467f3bac9f', 'haber que pasa cuando pasao un atextarea por aqui', NULL, 0, 'quequecedo@gmail.com', '2024-03-27'),
(23, 'tigre', 12, 3, '660472af4ef1e', 'es un puto trigre ahora estoy intentando cambiarlo desde la pagina de vcambiar', NULL, 0, 'quequecedo@gmail.com', '2024-03-27'),
(24, 'tren con peroo', 876, 1, '6604764499629', 'subo un tren un perro y un tigre creo', NULL, 5, 'nicolasque1', '2024-03-27'),
(26, 'soy quequece', 12345, 3, '660d8aa1599e4', 'estos es para generar buelt en la pagina', NULL, 0, 'quequecedo@gmail.com', '2024-04-03'),
(29, 'prodyucto de pacheco', 4345, 9, '660d8c0682b8e', 'pachecho sube este producto', NULL, 0, 'pacheco', '2024-04-03'),
(30, 'producto de user 42', 45, 10, '660d8d484b2da', 'esto es un producto de use r42', NULL, 0, 'user42', '2024-04-03'),
(31, 'otro podructo de user 42', 56, 10, '660d8d5b05371', 'segundo producto', NULL, 0, 'user42', '2024-04-03'),
(32, 'producto de ncolas', 654, 8, '660d8d93d7d79', 'que pase he ue pasa\r\n', NULL, 0, 'ncolas', '2024-04-03'),
(33, 'segundo producto de ncolas', 654, 8, '660d8da6a8665', 'si ses el segudno', NULL, 0, 'ncolas', '2024-04-03'),
(34, 'Try city', 543, 3, '6616ba23ab5c5', 'Es para ver si funcona esto de la ciudad', 'Bilbao', 0, 'quequecedo@gmail.com', '2024-04-10'),
(35, 'Pueba, comentarios quitados', 7654, 3, '661945ba079f5', 'Es para ver si se ha roto la pagina', 'Bilbao', 0, 'quequecedo@gmail.com', '2024-04-12'),
(36, 'Copa del rei', 13, 3, '661e494885b22', 'Esta es la copa del rei , esta un poco usada ero todavia se puede usar', 'Bilbao', 0, 'quequecedo@gmail.com', '2024-04-16'),
(42, 'quint apruba', 6543, 3, '661e5bb54f1cc', 'Ahora creo que si he puesto bien la ruta relativa, parece que con la ruta absoluta no me funciona bien', 'Salamanca', 0, 'quequecedo@gmail.com', '2024-04-16');

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
  `password` varchar(150) NOT NULL,
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
(10, 'user42', 'nico', 'si', 'ertyhjgfde@kapsch.com', 'Familia-12341', 0, '2024-04-08'),
(13, 'prueba_has2', 'Nico2', 'Sur_nico2', 'has_try2@gmail.com', '$2y$10$0aGAuZEuesnhZSuFXzXYvezOvQ8esfGaFTpVwCskFXJen6OpPSTKK', 0, '2024-04-15'),
(14, 'has_3', 'has_', 'hasinto', 'has.quepasa@gmail.com', '$2y$10$F0.lTroJcUuAvNFg/dOje.RHH59yqX0mIGlVpI/pjR6Xm6Acyj7bG', 0, '2024-04-15'),
(15, 'pruebaFK', 'FOREING', 'KEY', 'fk@gmal.com', '$2y$10$lyBltXbkC4XCB2pAguQDwevQfKTbp4bIzJXMmnmPakfCBCnQHwuKC', 0, '2024-04-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_report`
--
ALTER TABLE `admin_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `FK_chat_user_buyer` (`user_id_buyer`),
  ADD KEY `FK_chat_user_seller` (`user_id_seller`),
  ADD KEY `FK_chat_product` (`product_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`forum_mesage_id`),
  ADD KEY `FK_forum_post_forum` (`forum_id`),
  ADD KEY `FK_forum_post_user` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mesage_id`),
  ADD KEY `FK_message_chat` (`chat_id`),
  ADD KEY `FK_message_user` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `FK_product_user` (`user_id`);

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
-- AUTO_INCREMENT for table `admin_report`
--
ALTER TABLE `admin_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `forum_mesage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mesage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_chat_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `FK_chat_user_buyer` FOREIGN KEY (`user_id_buyer`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_chat_user_seller` FOREIGN KEY (`user_id_seller`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `FK_forum_post_forum` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`forum_id`),
  ADD CONSTRAINT `FK_forum_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_forum_posts_forum` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`forum_id`),
  ADD CONSTRAINT `FK_forum_posts_usuarios` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_message_chat` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`),
  ADD CONSTRAINT `FK_message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
