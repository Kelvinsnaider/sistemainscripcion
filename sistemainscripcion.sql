-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 02:49:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemainscripcion`
--
CREATE DATABASE IF NOT EXISTS `sistemainscripcion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistemainscripcion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--
-- Creación: 26-11-2024 a las 06:37:59
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Desarrollo Web', 'Aprende a crear sitios web completos.', '2024-01-01', '2024-04-30'),
(2, 'Programación en Python', 'Curso para aprender los fundamentos de Python.', '2024-02-05', '2024-05-05'),
(3, 'Inteligencia Artificial', 'Aprende los conceptos básicos de la inteligencia artificial.', '2024-03-10', '2024-09-10'),
(4, 'Desarrollo de Aplicaciones Móviles', 'Aprende a desarrollar aplicaciones móviles.', '2024-04-01', '2024-09-01'),
(5, 'Blockchain y Criptomonedas', 'Conoce los principios fundamentales de blockchains.', '2024-05-15', '2024-08-15'),
(6, 'Big Data y Análisis de Datos', 'Aprende a manejar grandes volúmenes de datos utilizando herramientas como Hadoop, Spark y técnicas de análisis avanzadas.', '2024-06-01', '2024-09-30'),
(7, 'Ciberseguridad', 'La protección de redes hasta la defensa contra ataques avanzados.', '2024-06-01', '2024-12-01'),
(8, 'Diseño de Interfaces de Usuario (UI)', 'Cómo crear experiencias interactivas atractivas y eficientes.', '2024-07-10', '2024-10-10'),
(9, 'Redes y Comunicaciones', 'Aprende sobre la configuración, administración y seguridad de redes informáticas y sistemas de comunicación.', '2024-08-01', '2024-11-30'),
(10, 'Desarrollo de Juegos', 'Aprende a desarrollar videojuegos.', '2024-09-15', '2025-02-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--
-- Creación: 26-11-2024 a las 06:37:59
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `nombre`, `email`, `telefono`, `id_curso`) VALUES
(45, 'Mariel', 'Mariel@gmail.com', '0449800000', 3),
(46, 'Diana', 'Diana@gmail.com', '0987152459', 1),
(47, 'Kelvin', 'Kelvin@gmail.com', '0980880608', 3),
(48, 'Rosa', 'Rosa@gmail.com', '0459874659', 5),
(49, 'Roma', 'Roma@gmail.com', '0968559874', 1),
(50, 'Naomi ', 'Naomi@gmail.com', '0944980014', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
