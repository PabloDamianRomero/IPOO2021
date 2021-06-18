-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2021 a las 20:56:11
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdteatro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cine`
--

CREATE TABLE `cine` (
  `id_funcion` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `paisOrigen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cine`
--

INSERT INTO `cine` (`id_funcion`, `genero`, `paisOrigen`) VALUES
(141, 'Western', 'Italia'),
(144, 'Comedia', 'USA'),
(145, 'Accion/Policiaco', 'Australia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcion`
--

CREATE TABLE `funcion` (
  `id_funcion` int(11) NOT NULL,
  `nombreFuncion` varchar(50) NOT NULL,
  `horaInicio` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precioFuncion` double(10,2) NOT NULL,
  `mes` int(11) NOT NULL,
  `id_teatro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `funcion`
--

INSERT INTO `funcion` (`id_funcion`, `nombreFuncion`, `horaInicio`, `duracion`, `precioFuncion`, `mes`, `id_teatro`) VALUES
(141, 'Django', 13, 1, 715.00, 2, 74),
(142, 'Peter Pan', 15, 1, 250.00, 7, 74),
(143, 'Romeo y Julieta', 17, 2, 400.00, 10, 74),
(144, 'Tom & Jerry', 20, 2, 720.00, 7, 74),
(145, 'Mad Max', 23, 1, 750.00, 4, 74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musical`
--

CREATE TABLE `musical` (
  `id_funcion` int(11) NOT NULL,
  `director` varchar(50) NOT NULL,
  `cantPersonasEscena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `musical`
--

INSERT INTO `musical` (`id_funcion`, `director`, `cantPersonasEscena`) VALUES
(142, 'Barrie W', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrateatral`
--

CREATE TABLE `obrateatral` (
  `id_funcion` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obrateatral`
--

INSERT INTO `obrateatral` (`id_funcion`, `autor`) VALUES
(143, 'William Shakespeare');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teatro`
--

CREATE TABLE `teatro` (
  `id_teatro` int(11) NOT NULL,
  `nombreTeatro` varchar(50) NOT NULL,
  `direccionTeatro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `teatro`
--

INSERT INTO `teatro` (`id_teatro`, `nombreTeatro`, `direccionTeatro`) VALUES
(74, 'Galaxia', 'Alf. H. Bouchard');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cine`
--
ALTER TABLE `cine`
  ADD PRIMARY KEY (`id_funcion`);

--
-- Indices de la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD PRIMARY KEY (`id_funcion`),
  ADD KEY `id_teatro` (`id_teatro`);

--
-- Indices de la tabla `musical`
--
ALTER TABLE `musical`
  ADD PRIMARY KEY (`id_funcion`);

--
-- Indices de la tabla `obrateatral`
--
ALTER TABLE `obrateatral`
  ADD PRIMARY KEY (`id_funcion`);

--
-- Indices de la tabla `teatro`
--
ALTER TABLE `teatro`
  ADD PRIMARY KEY (`id_teatro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `funcion`
--
ALTER TABLE `funcion`
  MODIFY `id_funcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `teatro`
--
ALTER TABLE `teatro`
  MODIFY `id_teatro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cine`
--
ALTER TABLE `cine`
  ADD CONSTRAINT `cine_ibfk_1` FOREIGN KEY (`id_funcion`) REFERENCES `funcion` (`id_funcion`);

--
-- Filtros para la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD CONSTRAINT `funcion_ibfk_1` FOREIGN KEY (`id_teatro`) REFERENCES `teatro` (`id_teatro`);

--
-- Filtros para la tabla `musical`
--
ALTER TABLE `musical`
  ADD CONSTRAINT `musical_ibfk_1` FOREIGN KEY (`id_funcion`) REFERENCES `funcion` (`id_funcion`);

--
-- Filtros para la tabla `obrateatral`
--
ALTER TABLE `obrateatral`
  ADD CONSTRAINT `obrateatral_ibfk_1` FOREIGN KEY (`id_funcion`) REFERENCES `funcion` (`id_funcion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
