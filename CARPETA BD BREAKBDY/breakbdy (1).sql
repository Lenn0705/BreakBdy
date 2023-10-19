-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2023 a las 22:52:36
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `breakbdy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad compromisos`
--

CREATE TABLE `cantidad compromisos` (
  `idCompromiso_has_Tarea` int(11) NOT NULL,
  `Compromiso_idCompromisos` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `horaCompromiso` datetime NOT NULL,
  `horaFinalizacionCompromiso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad descansos`
--

CREATE TABLE `cantidad descansos` (
  `idDescanso_has_Tarea` int(11) NOT NULL,
  `Descanso_idEscanso` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `tiempoDescanso` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad eventos`
--

CREATE TABLE `cantidad eventos` (
  `idCantidadEventos` int(11) NOT NULL,
  `Eventos_idEventos` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `horaEvento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad tareas`
--

CREATE TABLE `cantidad tareas` (
  `idCantidadTareas` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Tarea_idTarea` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinalizacion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compromisos`
--

CREATE TABLE `compromisos` (
  `idCompromisos` int(11) NOT NULL,
  `nombreCompromiso` varchar(11) NOT NULL,
  `descripcionCompromiso` varchar(11) NOT NULL,
  `Prioridad` enum('Alta','Baja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descanso2`
--

CREATE TABLE `descanso2` (
  `idEscanso` int(11) NOT NULL,
  `nombreDescanso` varchar(45) NOT NULL,
  `descripcionDescanso` varchar(45) NOT NULL,
  `prioridadDescanso` enum('Alta','Baja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `idEventos` int(11) NOT NULL,
  `nombreEvento` varchar(11) NOT NULL,
  `descripcionEvento` tinytext NOT NULL,
  `Prioridad` enum('Alta','Baja') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `idUsuario` int(11) NOT NULL,
  `correoUsuario` varchar(45) NOT NULL,
  `nombreReal` varchar(45) NOT NULL,
  `apellidoReal` varchar(45) NOT NULL,
  `fechaNacimiento` datetime NOT NULL,
  `usuarioBreak` varchar(45) NOT NULL,
  `contraseñaBreak` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`idUsuario`, `correoUsuario`, `nombreReal`, `apellidoReal`, `fechaNacimiento`, `usuarioBreak`, `contraseñaBreak`) VALUES
(5, 'a', 'b', 'c', '2023-10-19 14:49:19', 'ab', 'ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idTarea` int(11) NOT NULL,
  `nombreTarea` varchar(45) NOT NULL,
  `prioridadTarea` enum('Baja','Alta') NOT NULL,
  `descripcionTarea` varchar(500) NOT NULL,
  `estadoTarea` enum('completado','Faltante') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cantidad compromisos`
--
ALTER TABLE `cantidad compromisos`
  ADD PRIMARY KEY (`idCompromiso_has_Tarea`),
  ADD KEY `Compromiso_idCompromisos` (`Compromiso_idCompromisos`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`);

--
-- Indices de la tabla `cantidad descansos`
--
ALTER TABLE `cantidad descansos`
  ADD PRIMARY KEY (`idDescanso_has_Tarea`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`),
  ADD KEY `Descanso_idEscanso` (`Descanso_idEscanso`);

--
-- Indices de la tabla `cantidad eventos`
--
ALTER TABLE `cantidad eventos`
  ADD PRIMARY KEY (`idCantidadEventos`),
  ADD KEY `Eventos_idEventos` (`Eventos_idEventos`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`);

--
-- Indices de la tabla `cantidad tareas`
--
ALTER TABLE `cantidad tareas`
  ADD PRIMARY KEY (`idCantidadTareas`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`),
  ADD KEY `Tarea_idTarea` (`Tarea_idTarea`);

--
-- Indices de la tabla `compromisos`
--
ALTER TABLE `compromisos`
  ADD PRIMARY KEY (`idCompromisos`);

--
-- Indices de la tabla `descanso2`
--
ALTER TABLE `descanso2`
  ADD PRIMARY KEY (`idEscanso`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEventos`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idTarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cantidad compromisos`
--
ALTER TABLE `cantidad compromisos`
  MODIFY `idCompromiso_has_Tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cantidad descansos`
--
ALTER TABLE `cantidad descansos`
  MODIFY `idDescanso_has_Tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cantidad eventos`
--
ALTER TABLE `cantidad eventos`
  MODIFY `idCantidadEventos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cantidad tareas`
--
ALTER TABLE `cantidad tareas`
  MODIFY `idCantidadTareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compromisos`
--
ALTER TABLE `compromisos`
  MODIFY `idCompromisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descanso2`
--
ALTER TABLE `descanso2`
  MODIFY `idEscanso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEventos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cantidad compromisos`
--
ALTER TABLE `cantidad compromisos`
  ADD CONSTRAINT `cantidad compromisos_ibfk_2` FOREIGN KEY (`Compromiso_idCompromisos`) REFERENCES `compromisos` (`idCompromisos`),
  ADD CONSTRAINT `cantidad compromisos_ibfk_3` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `registro` (`idUsuario`);

--
-- Filtros para la tabla `cantidad descansos`
--
ALTER TABLE `cantidad descansos`
  ADD CONSTRAINT `cantidad descansos_ibfk_1` FOREIGN KEY (`Descanso_idEscanso`) REFERENCES `descanso2` (`idEscanso`),
  ADD CONSTRAINT `cantidad descansos_ibfk_2` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `registro` (`idUsuario`);

--
-- Filtros para la tabla `cantidad eventos`
--
ALTER TABLE `cantidad eventos`
  ADD CONSTRAINT `cantidad eventos_ibfk_2` FOREIGN KEY (`Eventos_idEventos`) REFERENCES `eventos` (`idEventos`),
  ADD CONSTRAINT `cantidad eventos_ibfk_3` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `registro` (`idUsuario`);

--
-- Filtros para la tabla `cantidad tareas`
--
ALTER TABLE `cantidad tareas`
  ADD CONSTRAINT `cantidad tareas_ibfk_2` FOREIGN KEY (`Tarea_idTarea`) REFERENCES `tarea` (`idTarea`),
  ADD CONSTRAINT `cantidad tareas_ibfk_3` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `registro` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
