-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-04-2015 a las 02:05:39
-- Versión del servidor: 5.5.41-log
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mvc_fwk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(100) NOT NULL,
  `firstName` text COLLATE utf8_spanish_ci NOT NULL,
  `lastName` text COLLATE utf8_spanish_ci NOT NULL,
  `username` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para los datos los usuarios' AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `username`, `password`) VALUES
(2, 'Genny', 'Centeno', 'gennycm13', '456987'),
(3, 'Andrea', 'Centeno', 'andreacm', '123456'),
(18, 'Andres', 'Centeno', 'andycenteno', '456789'),
(19, 'Leslie', 'Metri', 'lesliemetri', '123654'),
(21, 'Harvey', 'Dent', 'hdent', '123456'),
(22, 'Rachel', 'Green', 'rgreen', '123456'),
(40, 'Spencer', 'Reid', 'spenceReid2', '3333'),
(43, 'Bruce', 'Wayne', 'batman', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `userId` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
