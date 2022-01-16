-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-01-2022 a las 13:54:54
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidenciasapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`) VALUES
(1, 'comida', '#DE1F59'),
(2, 'hogar', '#DE1FAA'),
(3, 'ropa', '#B01FDE'),
(4, 'Juegos', '#681FDE'),
(5, 'Viajes', '#1FAADE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

DROP TABLE IF EXISTS `incidencias`;
CREATE TABLE IF NOT EXISTS `incidencias` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date DEFAULT NULL,
  `material` varchar(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `aula` int(4) NOT NULL,
  `prioridad` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_incidencias` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `userId`, `fechaInicio`, `fechaFinal`, `material`, `comentario`, `aula`, `prioridad`) VALUES
(1, 8, '2022-01-10', '2022-01-11', 'raton', 'raton inservible ', 221, 'Alta'),
(2, 8, '2022-01-02', '2022-01-03', 'silla', 'Silla rota', 222, 'Alta'),
(3, 8, '2022-01-05', NULL, 'pantalla', 'pantalla no da imagen', 221, 'Baja'),
(4, 8, '2021-12-27', NULL, 'Pizarra', 'pizarra electrica no funciona', 201, 'Media');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `mail`) VALUES
(1, 'kefff', '123', 'user', 'kefff@gmail.com'),
(8, 'kev', '$2y$10$voZ7PQOcEaQWD6SDPd0Xku0QB/RA5B9Admbm7bnQi.2uiU4urfTem', 'user', ''),
(9, 'admin', '$2y$10$YySsGAsnXxKFgCgn/W/j6euTEzrYV9pBuXSJZJYG.rFFt5ZC7uciy', 'admin', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `id_user_incidencias` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
