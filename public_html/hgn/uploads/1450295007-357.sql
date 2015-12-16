-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2015 a las 18:10:33
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
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `edad` int(11) NOT NULL,
  `residencia` text NOT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `carrera` varchar(60) NOT NULL,
  `inst_carrera` varchar(100) NOT NULL,
  `maestria` varchar(60) NOT NULL,
  `inst_maestria` varchar(100) NOT NULL,
  `ingles` enum('alto','medio','bajo') NOT NULL,
  `otros_idiomas` text NOT NULL,
  `ultimo_puesto` text NOT NULL,
  `empresa` varchar(60) NOT NULL,
  `rango_sueldo` text NOT NULL,
  `area1` text NOT NULL,
  `tiempo1` varchar(20) NOT NULL,
  `area2` text NOT NULL,
  `tiempo2` varchar(20) NOT NULL,
  `area3` text NOT NULL,
  `tiempo3` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Persona`
--
ALTER TABLE `Persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
