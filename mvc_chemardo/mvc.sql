-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2021 a las 19:00:47
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mvc`
--
CREATE DATABASE IF NOT EXISTS `mvc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mvc`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`) VALUES
(2, 'aggggggg', 'ajmiras@gmail.com'),
(3, 'javier', 'ajmiras@igformacion.com'),
(4, 'asdfasdf', 'ajmiras@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `cliente_id`, `numero`, `fecha`) VALUES
(1, 3, 10, '2021-11-10 00:00:00'),
(2, 2, 3, '2021-11-09 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaslineas`
--

DROP TABLE IF EXISTS `facturaslineas`;
CREATE TABLE `facturaslineas` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `referencia` int(11) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `cantidad` decimal(10,3) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `importe` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturaslineas`
--

INSERT INTO `facturaslineas` (`id`, `factura_id`, `referencia`, `descripcion`, `cantidad`, `precio`, `iva`, `importe`) VALUES
(1, 1, 25, 'Jamón 5J', '35.000', '451.00', '21.00', '19099.85'),
(3, 1, 2, '2', '40.000', '2.00', '21.00', '96.80');

--
-- Disparadores `facturaslineas`
--
DROP TRIGGER IF EXISTS `facturaslineas_BEFORE_INSERT`;
DELIMITER $$
CREATE TRIGGER `facturaslineas_BEFORE_INSERT` BEFORE INSERT ON `facturaslineas` FOR EACH ROW BEGIN
	SET NEW.importe = NEW.cantidad * NEW.precio * (1 + (NEW.iva / 100.0));
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `facturaslineas_BEFORE_UPDATE`;
DELIMITER $$
CREATE TRIGGER `facturaslineas_BEFORE_UPDATE` BEFORE UPDATE ON `facturaslineas` FOR EACH ROW BEGIN
	SET NEW.importe = NEW.cantidad * NEW.precio * (1 + (NEW.iva / 100.0));
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facturas_clientes_idx` (`cliente_id`);

--
-- Indices de la tabla `facturaslineas`
--
ALTER TABLE `facturaslineas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facturaslineas_facturas_idx` (`factura_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturaslineas`
--
ALTER TABLE `facturaslineas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_facturas_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturaslineas`
--
ALTER TABLE `facturaslineas`
  ADD CONSTRAINT `fk_facturaslineas_facturas` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
