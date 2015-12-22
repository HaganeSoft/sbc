-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2015 a las 22:16:41
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solisbar_hagane`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `edad` int(11) NOT NULL,
  `residencia` int(11) NOT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `carrera` varchar(60) NOT NULL,
  `inst_carrera` int(11) NOT NULL,
  `maestria` varchar(60) DEFAULT NULL,
  `inst_maestria` int(11) DEFAULT NULL,
  `ingles` int(11) NOT NULL,
  `otros_idiomas` text,
  `ultimo_puesto` text,
  `empresa` varchar(60) DEFAULT NULL,
  `rango_sueldo` int(11) NOT NULL,
  `area1` int(11) NOT NULL,
  `tiempo1` int(11) NOT NULL,
  `area2` int(11) DEFAULT NULL,
  `tiempo2` int(11) DEFAULT NULL,
  `area3` int(11) DEFAULT NULL,
  `tiempo3` int(11) DEFAULT NULL,
  `file_path` text NOT NULL,
  `inst_carrera_otro` text,
  `inst_maestria_otro` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
