-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 22:53:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `artcraft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--

CREATE TABLE `cartas` (
  `id` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `valor` int(11) NOT NULL,
  `visibilidad` int(11) NOT NULL,
  `marco` varchar(1000) NOT NULL,
  `fondo` varchar(1000) NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`id`, `id_creador`, `nombre`, `descripcion`, `valor`, `visibilidad`, `marco`, `fondo`, `imagen`) VALUES
(3, 3, 'Carta ensayo 1', 'Esta es una carta de prueba para ver si funciona', 100, 1, 'qwe', '123', 'erq12'),
(4, 3, 'Carta de prueba 2', 'Esta es una carta de ensayo, a diferencia de la otra.', 50, 0, 'public/images/marcos/marcos/02.png', 'public/images/cartas/fondos/02.png', 'public/images/cartas/imagenes/05.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas_grupo`
--

CREATE TABLE `cartas_grupo` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_carta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartas_grupo`
--

INSERT INTO `cartas_grupo` (`id`, `id_grupo`, `id_carta`) VALUES
(4, 2, 3),
(5, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clanes`
--

CREATE TABLE `clanes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `oro` int(11) NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clanes`
--

INSERT INTO `clanes` (`id`, `nombre`, `oro`, `grupo`) VALUES
(2, 'Caos', 0, 1),
(3, 'Perro', 0, 1),
(4, 'vog', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `docente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `docente_id`) VALUES
(1, 'casa', 3),
(2, 'casa', 3),
(3, 'Caos', 3),
(4, 'Ensayo', 3),
(5, 'casa', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `avatar`, `tipo`) VALUES
(1, 'admin', 'Morion', '0|0|0|0|0|0||0|0|0|0|0|0|0|0|0|0|0|0|0|', 2),
(2, 'estudiante', 'Adrián', '0|0|0|0|0|0||0|0|0|0|0|0|0|0|0|0|0|0|0|', 0),
(3, 'morion', 'Morion VO', '0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|', 1),
(4, 'estudiante', 'Andrés', '0|0|0|0|0|0||0|0|0|0|0|0|0|0|0|0|0|0|0|', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_clan`
--

CREATE TABLE `usuario_clan` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_clan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_clan`
--

INSERT INTO `usuario_clan` (`id`, `id_usuario`, `id_clan`) VALUES
(1, 2, 2),
(2, 4, 3),
(3, 2, 3),
(5, 2, 4),
(7, 3, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_creador` (`id_creador`);

--
-- Indices de la tabla `cartas_grupo`
--
ALTER TABLE `cartas_grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_carta` (`id_carta`);

--
-- Indices de la tabla `clanes`
--
ALTER TABLE `clanes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docente_id` (`docente_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_clan`
--
ALTER TABLE `usuario_clan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_clan` (`id_clan`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartas`
--
ALTER TABLE `cartas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cartas_grupo`
--
ALTER TABLE `cartas_grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clanes`
--
ALTER TABLE `clanes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_clan`
--
ALTER TABLE `usuario_clan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD CONSTRAINT `cartas_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartas_grupo`
--
ALTER TABLE `cartas_grupo`
  ADD CONSTRAINT `cartas_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartas_grupo_ibfk_2` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clanes`
--
ALTER TABLE `clanes`
  ADD CONSTRAINT `clanes_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`docente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_clan`
--
ALTER TABLE `usuario_clan`
  ADD CONSTRAINT `usuario_clan_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_clan_ibfk_2` FOREIGN KEY (`id_clan`) REFERENCES `clanes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
