-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2015 a las 01:13:35
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
  `residencia` text NOT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `carrera` varchar(60) NOT NULL,
  `inst_carrera` varchar(100) NOT NULL,
  `maestria` varchar(60) DEFAULT NULL,
  `inst_maestria` varchar(100) DEFAULT NULL,
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
  `file_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellidos`, `edad`, `residencia`, `sexo`, `telefono`, `email`, `carrera`, `inst_carrera`, `maestria`, `inst_maestria`, `ingles`, `otros_idiomas`, `ultimo_puesto`, `empresa`, `rango_sueldo`, `area1`, `tiempo1`, `area2`, `tiempo2`, `area3`, `tiempo3`, `file_path`) VALUES
(2, 'fesda', 'fsda', 0, 'fdsa', 'Femenino', 'fsda', 'sda', 'fsda', 'fdsa', '', '', 2, 'fsda', '', '', 2, 2, 3, 3, 1, 0, 0, 'uploads/1450202084-91.sql'),
(3, 'jkl;', 'jkl;', 0, 'sdfafdsa', 'Femenino', '333', '33', 'fsda', 'dsa', '', '', 2, NULL, '', '', 4, 4, 2, NULL, NULL, 0, 0, 'uploads/1450207939-90.sql');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `sessionid` varchar(60) DEFAULT NULL,
  `user_type` enum('Administrador','Cliente','Doctor') NOT NULL,
  `imgPath` text,
  `activo` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `sessionid`, `user_type`, `imgPath`, `activo`) VALUES
(1, 'erick', 'hola', '729QJgajV2zPvyX4nelkFtighNCEs120MbRaeE02w5oW5L0pkqxD2qaLvtcy', 'Administrador', NULL, 'y');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `sessionid` (`sessionid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
