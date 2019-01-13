-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2018 a las 16:48:59
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

grant all privileges on unipadelbd.* to root@localhost identified by "";

--
-- Base de datos: `unipadelbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UsuarioRegistrado`
--

CREATE TABLE `UsuarioRegistrado` (
  `usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `tipoUsuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Campeonato`
--

CREATE TABLE `Campeonato` (
  `idCampeonato` int(4) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `fechaInicioInscripciones` date NOT NULL,
  `fechaFinInscripciones` date NOT NULL,
  `reglas` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `idCategoria` int(4) NOT NULL,
  `nivel` int(1) NOT NULL,
  `tipo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `maxParticipantes` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Campeonato_Categoria`
--

CREATE TABLE `Campeonato_Categoria` (
  `CampeonatoidCampeonato` int(4) NOT NULL,
  `CategoriaidCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE `Grupo` (
  `idGrupo` int(4) NOT NULL,
  `tipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Campeonato_CategoriaCampeonatoidCampeonato` int(4) NOT NULL,
  `Campeonato_CategoriaCategoriaidCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clasificacion`
--

CREATE TABLE `Clasificacion` (
  `idClasificacion` int(4) NOT NULL,
  `ParejaidPareja` int(4) NOT NULL,
  `resultado` int(4) DEFAULT NULL,
  `GrupoidGrupo` int(4) NOT NULL,
  `GrupotipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `CampeonatoidCampeonato` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pareja`
--

CREATE TABLE `Pareja` (
  `idPareja` int(4) NOT NULL,
  `capitan` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `deportista` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `GrupoidGrupo` int(4) NOT NULL,
  `GrupotipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Enfrentamiento`
--

CREATE TABLE `Enfrentamiento` (
  `idEnfrentamiento` int(4) NOT NULL,
  `ParejaidPareja1` int(4) NOT NULL,
  `ParejaidPareja2` int(4) NOT NULL,
  `resultado` int(3) DEFAULT NULL,
  `set1` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL,
  `set2` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL,
  `set3` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL,
  `GrupoidGrupo` int(4) NOT NULL,
  `GrupotipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Estructura de tabla para la tabla `Partido`
--

CREATE TABLE `Partido` (
  `idPartido` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `inicioInscripcion` date NOT NULL,
  `finInscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Partido_Reserva`
--

CREATE TABLE `Partido_Reserva` (
  `PartidoidPartido` int(4) NOT NULL,
  `ReservaidReserva` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pista`
--

CREATE TABLE `Pista` (
  `idPista` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horario`
--

CREATE TABLE `Horario` (
  `fecha` date NOT NULL,
  `idPista` int(4) NOT NULL,
  `horario` time NOT NULL,
  `disponibilidad` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva`
--

CREATE TABLE `Reserva` (
  `UsuarioRegistradousuario` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idReserva` int(4) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `PistaidPista` int(4) DEFAULT NULL,
  `disponibilidad` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PosiblesReservasEnfrentamiento`
--

CREATE TABLE `PosiblesReservasEnfrentamiento` (
  `idEnfrentamiento` int(4) NOT NULL,
  `UsuarioRegistradousuario` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idReserva` int(4) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `PistaidPista` int(4) DEFAULT NULL,
  `disponibilidad` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Indices de la tabla `PosiblesReservasEnfrentamiento`
--
ALTER TABLE `PosiblesReservasEnfrentamiento`
  ADD PRIMARY KEY (`idReserva`,`idEnfrentamiento`);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reserva_Enfrentamiento`
--

CREATE TABLE `Reserva_Enfrentamiento` (
  `idReserva` int(4) NOT NULL,
  `idEnfrentamiento` int(4) NOT NULL,
  `PistaidPista` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Indices de la tabla `Reserva_Enfrentamiento`
--
ALTER TABLE `Reserva_Enfrentamiento`
  ADD PRIMARY KEY (`idReserva`,`idEnfrentamiento`);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Campeonato`
--
ALTER TABLE `Campeonato`
  ADD PRIMARY KEY (`idCampeonato`);

--
-- Indices de la tabla `Campeonato_Categoria`
--
ALTER TABLE `Campeonato_Categoria`
  ADD PRIMARY KEY (`CampeonatoidCampeonato`,`CategoriaidCategoria`),
  ADD KEY `FKCampeonato419290` (`CategoriaidCategoria`);

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `Clasificacion`
--
ALTER TABLE `Clasificacion`
  ADD PRIMARY KEY (`idClasificacion`),
  ADD KEY `FKClasificac524722` (`ParejaidPareja`),
  ADD KEY `FKClasificac616946` (`GrupoidGrupo`,`GrupotipoLiga`),
  ADD KEY `FKClasificac710388` (`CampeonatoidCampeonato`);

--
-- Indices de la tabla `Enfrentamiento`
--
ALTER TABLE `Enfrentamiento`
  ADD PRIMARY KEY (`idEnfrentamiento`),
  ADD KEY `FKEnfren1` (`ParejaidPareja1`),
  ADD KEY `FKEnfren2` (`ParejaidPareja2`),
  ADD KEY `FKEnfrentami527261` (`GrupoidGrupo`,`GrupotipoLiga`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`idGrupo`,`tipoLiga`),
  ADD KEY `FKGrupo875320` (`Campeonato_CategoriaCampeonatoidCampeonato`,`Campeonato_CategoriaCategoriaidCategoria`);

--
-- Indices de la tabla `Horario`
--
ALTER TABLE `Horario`
  ADD PRIMARY KEY (`fecha`,`idPista`,`horario`,`disponibilidad`);

--
-- Indices de la tabla `Pareja`
--
ALTER TABLE `Pareja`
  ADD PRIMARY KEY (`idPareja`),
  ADD KEY `FKPareja602943` (`GrupoidGrupo`,`GrupotipoLiga`);

--
-- Indices de la tabla `Partido`
--
ALTER TABLE `Partido`
  ADD PRIMARY KEY (`idPartido`);

--
-- Indices de la tabla `Partido_Reserva`
--
ALTER TABLE `Partido_Reserva`
  ADD PRIMARY KEY (`PartidoidPartido`,`ReservaidReserva`),
  ADD KEY `FKPartido_Re279823` (`ReservaidReserva`);

--
-- Indices de la tabla `Pista`
--
ALTER TABLE `Pista`
  ADD PRIMARY KEY (`idPista`);

--
-- Indices de la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD PRIMARY KEY (`idReserva`);

--
-- Indices de la tabla `UsuarioRegistrado`
--
ALTER TABLE `UsuarioRegistrado`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Campeonato`
--
ALTER TABLE `Campeonato`
  MODIFY `idCampeonato` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `idCategoria` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Clasificacion`
--
ALTER TABLE `Clasificacion`
  MODIFY `idClasificacion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `Enfrentamiento`
--
ALTER TABLE `Enfrentamiento`
  MODIFY `idEnfrentamiento` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  MODIFY `idGrupo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Pareja`
--
ALTER TABLE `Pareja`
  MODIFY `idPareja` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `Partido`
--
ALTER TABLE `Partido`
  MODIFY `idPartido` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Pista`
--
ALTER TABLE `Pista`
  MODIFY `idPista` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Reserva`
--
ALTER TABLE `Reserva`
  MODIFY `idReserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Campeonato_Categoria`
--
ALTER TABLE `Campeonato_Categoria`
  ADD CONSTRAINT `FKCampeonato419290` FOREIGN KEY (`CategoriaidCategoria`) REFERENCES `Categoria` (`idCategoria`),
  ADD CONSTRAINT `FKCampeonato73800` FOREIGN KEY (`CampeonatoidCampeonato`) REFERENCES `Campeonato` (`idCampeonato`);

--
-- Filtros para la tabla `Clasificacion`
--
ALTER TABLE `Clasificacion`
  ADD CONSTRAINT `FKClasificac524722` FOREIGN KEY (`ParejaidPareja`) REFERENCES `Pareja` (`idPareja`),
  ADD CONSTRAINT `FKClasificac616946` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `Grupo` (`idGrupo`, `tipoLiga`),
  ADD CONSTRAINT `FKClasificac710388` FOREIGN KEY (`CampeonatoidCampeonato`) REFERENCES `Campeonato` (`idCampeonato`);

--
-- Filtros para la tabla `Enfrentamiento`
--
ALTER TABLE `Enfrentamiento`
  ADD CONSTRAINT `FKEnfren1` FOREIGN KEY (`ParejaidPareja1`) REFERENCES `Pareja` (`idPareja`),
  ADD CONSTRAINT `FKEnfren2` FOREIGN KEY (`ParejaidPareja2`) REFERENCES `Pareja` (`idPareja`),
  ADD CONSTRAINT `FKEnfrentami527261` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `Grupo` (`idGrupo`, `tipoLiga`);

--
-- Filtros para la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD CONSTRAINT `FKGrupo875320` FOREIGN KEY (`Campeonato_CategoriaCampeonatoidCampeonato`,`Campeonato_CategoriaCategoriaidCategoria`) REFERENCES `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`);

--
-- Filtros para la tabla `Horario`
--
ALTER TABLE `Horario`
  ADD CONSTRAINT `FKHorario323934` FOREIGN KEY (`idPista`) REFERENCES `Pista` (`idPista`);

--
-- Filtros para la tabla `Pareja`
--
ALTER TABLE `Pareja`
  ADD CONSTRAINT `FKPareja602943` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `Grupo` (`idGrupo`, `tipoLiga`);

--
-- Filtros para la tabla `Partido_Reserva`
--
ALTER TABLE `Partido_Reserva`
  ADD CONSTRAINT `FKPartido_Re279823` FOREIGN KEY (`ReservaidReserva`) REFERENCES `Reserva` (`idReserva`),
  ADD CONSTRAINT `FKPartido_Re355375` FOREIGN KEY (`PartidoidPartido`) REFERENCES `Partido` (`idPartido`);

--
-- Filtros para la tabla `Reserva`
--
ALTER TABLE `Reserva`
  ADD CONSTRAINT `FKReserva401525` FOREIGN KEY (`fecha`,`PistaidPista`,`horaInicio`,`disponibilidad`) REFERENCES `Horario` (`fecha`, `idPista`, `horario`, `disponibilidad`),
  ADD CONSTRAINT `FKReserva450869` FOREIGN KEY (`UsuarioRegistradousuario`) REFERENCES `UsuarioRegistrado` (`usuario`);


--
-- Volcado de datos para la tabla `UsuarioRegistrado`
--

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES
('ana', 'purple', 'Ana', 'Martinez', 'deportista'),
('betty', 'betty', 'Bea', 'Martinez', 'deportista'),
('elena', 'purple', 'Elena', 'Fernandez', 'deportista'),
('irpereira', 'purple', 'Ignacio', 'Rodriguez', 'deportista'),
('juan', 'juan', 'Jose', 'Juan', 'deportista'),
('laura', 'laura', 'Laura', 'La', 'deportista'),
('leo', 'leo', 'Leonidas', 'Torres', 'deportista'),
('mario', 'purple', 'Mario', 'Sanchez', 'deportista'),
('miguel', 'purple', 'Miguel', 'Sanchez', 'deportista'),
('pepe', 'purple', 'Pepito', 'Grillo', 'deportista'),
('pmperez', 'purple', 'Patricia', 'Martin', 'deportista'),
('vfvarela', 'purple', 'Victor', 'Fernandez', 'deportista'),
('pep', 'pep', 'Pepi', 'Grill', 'deportista'),
('ipereira', 'ipereira', 'Ismael', 'Pereira', 'deportista'),
('maria', 'maria', 'Maria', 'Sanchez', 'deportista'),
('sara', 'sara', 'Sara', 'Fernandez', 'deportista'),
('pperez', 'pperez', 'Pablo', 'Perez', 'deportista'),
('irerra', 'irerra', 'Iris', 'Herrera', 'deportista'),
('vvarela', 'vvarela', 'Vlas', 'Varela', 'deportista'),
('marie', 'marie', 'Maria', 'Lopez', 'deportista'),
('elna', 'elna', 'Elena', 'Vila', 'deportista'),
('ala', 'ala', 'Ana', 'Alvarez', 'deportista'),
('mguel', 'mguel', 'Miguel', 'Martin', 'deportista'),
('lau', 'lau', 'Laura', 'Lopez', 'deportista'),
('pp', 'pp', 'Paula', 'Perez', 'deportista'),
('bet', 'bet', 'Bella', 'Torres', 'deportista'),
('pereira', 'pereira', 'Maria', 'Pereira', 'deportista'),
('jan', 'jan', 'Juan', 'Santiago', 'deportista'),
('mria', 'mria', 'Maria', 'Santiago', 'deportista'),
('lea', 'lea', 'Lara', 'Santalla', 'deportista'),
('ara', 'ara', 'Ana', 'Rodriguez', 'deportista');
--
-- Volcado de datos para la tabla `Campeonato`
--

INSERT INTO `Campeonato` (`idCampeonato`, `nombre`, `fechaInicio`, `fechaFin`, `fechaInicioInscripciones`, `fechaFinInscripciones`, `reglas`) VALUES
(1, 'Torneo Mundial', '2018-10-24', '2018-10-25', '2018-10-20', '2018-10-23', 'Respetar'),
(2, 'Campeonato A', '2018-11-08', '2018-11-30', '2018-11-09', '2018-11-14', ''),
(3, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', ''),
(4, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', ''),
(5, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', '');

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`idCategoria`, `nivel`, `tipo`, `maxParticipantes`) VALUES
(1, 1, 'mixto', 8),
(2, 2, 'Masculina', 10),
(3, 2, 'Masculina', 13);


--
-- Volcado de datos para la tabla `Campeonato_Categoria`
--

INSERT INTO `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES
(1, 1),
(1, 2),
(3, 1),
(3, 3);

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`idGrupo`, `tipoLiga`, `Campeonato_CategoriaCampeonatoidCampeonato`, `Campeonato_CategoriaCategoriaidCategoria`) VALUES
(1, 'regular', 1, 1),
(2, 'regular', 1, 1),
(4, 'regular', 3, 3);


--
-- Volcado de datos para la tabla `Pareja`
--

INSERT INTO `Pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES
(1, 'pmperez', 'pepe', 1, 'regular'),
(2, 'vfvarela', 'irpereira', 1, 'regular'),
(3, 'elena', 'mario', 1, 'regular'),
(4, 'miguel', 'ana', 1, 'regular'),
(5, 'pepe', 'pmperez', 2, 'regular'),
(6, 'irpereira', 'vfvarela', 2, 'regular'),
(7, 'mario', 'elena', 2, 'regular'),
(8, 'ana', 'miguel', 2, 'regular'),
(9, 'laura', 'pep', 1, 'regular'),
(10, 'betty', 'ipereira', 1, 'regular'),
(11, 'juan', 'maria', 1, 'regular'),
(12, 'leo', 'sara', 1, 'regular'),
(13, 'pep', 'pperez', 4, 'regular'),
(14, 'irerra', 'vvarela', 4, 'regular'),
(15, 'marie', 'elna', 4, 'regular'),
(16, 'ala', 'mguel', 4, 'regular'),
(17, 'lau', 'pp', 4, 'regular'),
(18, 'bet', 'pereira', 4, 'regular'),
(19, 'jan', 'mria', 4, 'regular'),
(20, 'lea', 'ara', 4, 'regular');

--
-- Volcado de datos para la tabla `Enfrentamiento`
--

INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES
(1, 1, 1, 0, '-', '-', '-', 1, 'regular'),
(2, 1, 2, 0, '2-3', '1-2', '4-5', 1, 'regular'),
(3, 1, 3, 2, '2-3', '3-1', '5-2', 1, 'regular'),
(4, 1, 4, 0, '-', '-', '-', 1, 'regular'),
(5, 1, 9, 0, '-', '-', '-', 1, 'regular'),
(6, 1, 10, 1, '1-3', '5-3', '2-6', 1, 'regular'),
(7, 1, 11, 0, '-', '-', '-', 1, 'regular'),
(8, 1, 12, 0, '-', '-', '-', 1, 'regular'),
(9, 2, 2, 0, '-', '-', '-', 1, 'regular'),
(10, 2, 1, 3, '3-2', '2-1', '5-4', 1, 'regular'),
(11, 2, 3, 2, '2-3', '5-4', '5-5', 1, 'regular'),
(12, 2, 4, 0, '-', '-', '-', 1, 'regular'),
(13, 2, 9, 0, '-', '-', '-', 1, 'regular'),
(14, 2, 10, 0, '-', '-', '-', 1, 'regular'),
(15, 2, 11, 1, '4-3', '2-5', '5-8', 1, 'regular'),
(16, 2, 12, 0, '-', '-', '-', 1, 'regular'),
(17, 3, 3, 0, '-', '-', '-', 1, 'regular'),
(18, 3, 1, 1, '3-2', '1-3', '2-5', 1, 'regular'),
(19, 3, 2, 2, '3-2', '4-5', '5-5', 1, 'regular'),
(20, 3, 4, 3, '4-2', '1-0', '3-2', 1, 'regular'),
(21, 3, 9, 1, '1-3', '5-9', '2-1', 1, 'regular'),
(22, 3, 10, 1, '1-4', '4-5', '3-3', 1, 'regular'),
(23, 3, 11, 0, '-', '-', '-', 1, 'regular'),
(24, 3, 12, 0, '-', '-', '-', 1, 'regular'),
(25, 4, 4, 0, '-', '-', '-', 1, 'regular'),
(26, 4, 1, 0, '-', '-', '-', 1, 'regular'),
(27, 4, 2, 0, '-', '-', '-', 1, 'regular'),
(28, 4, 3, 0, '2-4', '0-1', '2-3', 1, 'regular'),
(29, 4, 9, 0, '-', '-', '-', 1, 'regular'),
(30, 4, 10, 0, '-', '-', '-', 1, 'regular'),
(31, 4, 11, 0, '-', '-', '-', 1, 'regular'),
(32, 4, 12, 0, '-', '-', '-', 1, 'regular'),
(33, 9, 9, 0, '-', '-', '-', 1, 'regular'),
(34, 9, 1, 0, '-', '-', '-', 1, 'regular'),
(35, 9, 2, 0, '-', '-', '-', 1, 'regular'),
(36, 9, 3, 2, '3-1', '9-5', '1-2', 1, 'regular'),
(37, 9, 4, 0, '-', '-', '-', 1, 'regular'),
(38, 9, 10, 0, '-', '-', '-', 1, 'regular'),
(39, 9, 11, 0, '-', '-', '-', 1, 'regular'),
(40, 9, 12, 0, '-', '-', '-', 1, 'regular'),
(41, 10, 10, 0, '-', '-', '-', 1, 'regular'),
(42, 10, 1, 2, '3-1', '3-5', '6-2', 1, 'regular'),
(43, 10, 2, 0, '-', '-', '-', 1, 'regular'),
(44, 10, 3, 3, '4-1', '5-4', '3-3', 1, 'regular'),
(45, 10, 4, 0, '-', '-', '-', 1, 'regular'),
(46, 10, 9, 0, '-', '-', '-', 1, 'regular'),
(47, 10, 11, 0, '-', '-', '-', 1, 'regular'),
(48, 10, 12, 0, '-', '-', '-', 1, 'regular'),
(49, 11, 11, 0, '-', '-', '-', 1, 'regular'),
(50, 11, 1, 0, '-', '-', '-', 1, 'regular'),
(51, 11, 2, 2, '3-4', '5-2', '8-5', 1, 'regular'),
(52, 11, 3, 0, '-', '-', '-', 1, 'regular'),
(53, 11, 4, 0, '-', '-', '-', 1, 'regular'),
(54, 11, 9, 0, '-', '-', '-', 1, 'regular'),
(55, 11, 10, 0, '-', '-', '-', 1, 'regular'),
(56, 11, 12, 0, '-', '-', '-', 1, 'regular'),
(57, 12, 12, 0, '-', '-', '-', 1, 'regular'),
(58, 12, 1, 0, '-', '-', '-', 1, 'regular'),
(59, 12, 2, 0, '-', '-', '-', 1, 'regular'),
(60, 12, 3, 0, '-', '-', '-', 1, 'regular'),
(61, 12, 4, 0, '-', '-', '-', 1, 'regular'),
(62, 12, 9, 0, '-', '-', '-', 1, 'regular'),
(63, 12, 10, 0, '-', '-', '-', 1, 'regular'),
(64, 12, 11, 0, '-', '-', '-', 1, 'regular');


--
-- Volcado de datos para la tabla `Clasificacion`
--

INSERT INTO `Clasificacion` (`idClasificacion`, `ParejaidPareja`, `resultado`, `GrupoidGrupo`, `GrupotipoLiga`, `CampeonatoidCampeonato`) VALUES
(45, 1, 3, 1, 'regular', 1),
(46, 2, 6, 1, 'regular', 1),
(47, 3, 8, 1, 'regular', 1),
(48, 4, 0, 1, 'regular', 1),
(49, 9, 2, 1, 'regular', 1),
(50, 10, 5, 1, 'regular', 1),
(51, 11, 2, 1, 'regular', 1),
(52, 12, 0, 1, 'regular', 1),
(53, 5, NULL, 2, 'regular', 1),
(54, 6, NULL, 2, 'regular', 1),
(55, 7, NULL, 2, 'regular', 1),
(56, 8, NULL, 2, 'regular', 1);


--
-- Volcado de datos para la tabla `Pista`
--


INSERT INTO `Pista` (`idPista`) VALUES ('1');
INSERT INTO `Pista` (`idPista`) VALUES ('2');
INSERT INTO `Pista` (`idPista`) VALUES ('3');
INSERT INTO `Pista` (`idPista`) VALUES ('4');

--
-- Volcado de datos para la tabla `Horario`
--

INSERT INTO `Horario` (`fecha`, `idPista`, `horario`, `disponibilidad`) VALUES
('2018-11-06', 1, '00:00:00', 'ocupado'),
('2018-11-06', 1, '01:30:00', 'disponible'),
('2018-11-06', 1, '03:00:00', 'disponible'),
('2018-11-06', 1, '04:30:00', 'disponible'),
('2018-11-06', 2, '00:00:00', 'ocupado'),
('2018-11-06', 2, '04:30:00', 'disponible'),
('2018-11-06', 2, '15:00:00', 'disponible'),
('2018-11-06', 3, '00:00:00', 'ocupado'),
('2018-11-06', 3, '01:30:00', 'disponible'),
('2018-11-06', 3, '10:30:00', 'disponible'),
('2018-11-06', 4, '00:00:00', 'ocupado'),
('2018-11-06', 4, '01:30:00', 'disponible'),
('2018-11-06', 4, '09:00:00', 'disponible'),
('2018-11-06', 4, '10:30:00', 'disponible');



-- --------------------------------------------------------


--
-- Volcado de datos para la tabla `Partido`
--

INSERT INTO `Partido` (`idPartido`, `fecha`, `horaInicio`, `horaFin`, `inicioInscripcion`, `finInscripcion`) VALUES
(1, '2018-11-15', '20:23:00', '06:02:00', '2018-11-15', '2018-11-24');



--
-- Volcado de datos para la tabla `Reserva`
--

INSERT INTO `Reserva` (`UsuarioRegistradousuario`, `idReserva`, `fecha`, `horaInicio`, `horaFin`, `PistaidPista`, `disponibilidad`) VALUES
(NULL, 13, '2018-11-06', '00:00:00', '01:30:00', 2, 'ocupado'),
(NULL, 14, '2018-11-06', '00:00:00', '01:30:00', 3, 'ocupado'),
(NULL, 15, '2018-11-06', '00:00:00', '01:30:00', 4, 'ocupado'),
(NULL, 16, '2018-11-06', '00:00:00', '01:30:00', 1, 'ocupado');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
