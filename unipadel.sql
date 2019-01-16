-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2019 a las 16:13:19
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unipadel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

CREATE TABLE `campeonato` (
  `idCampeonato` int(4) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `fechaInicioInscripciones` date NOT NULL,
  `fechaFinInscripciones` date NOT NULL,
  `reglas` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`idCampeonato`, `nombre`, `fechaInicio`, `fechaFin`, `fechaInicioInscripciones`, `fechaFinInscripciones`, `reglas`) VALUES
(1, 'Torneo Mundial', '2018-10-24', '2018-10-25', '2018-10-20', '2018-10-23', 'Respetar'),
(2, 'Campeonato A', '2018-11-08', '2018-11-30', '2018-11-09', '2018-11-14', ''),
(3, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', ''),
(4, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', ''),
(5, 'Campeonato', '2018-11-07', '2018-11-30', '2018-11-09', '2018-11-20', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato_categoria`
--

CREATE TABLE `campeonato_categoria` (
  `CampeonatoidCampeonato` int(4) NOT NULL,
  `CategoriaidCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `campeonato_categoria`
--

INSERT INTO `campeonato_categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES
(1, 1),
(1, 2),
(3, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(4) NOT NULL,
  `nivel` int(1) NOT NULL,
  `tipo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `maxParticipantes` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nivel`, `tipo`, `maxParticipantes`) VALUES
(1, 1, 'Mixta', 8),
(2, 2, 'Masculina', 10),
(3, 2, 'Masculina', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `idClasificacion` int(4) NOT NULL,
  `ParejaidPareja` int(4) NOT NULL,
  `resultado` int(4) DEFAULT NULL,
  `GrupoidGrupo` int(4) NOT NULL,
  `GrupotipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `CampeonatoidCampeonato` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`idClasificacion`, `ParejaidPareja`, `resultado`, `GrupoidGrupo`, `GrupotipoLiga`, `CampeonatoidCampeonato`) VALUES
(45, 1, 3, 1, 'regular', 1),
(46, 2, 6, 1, 'regular', 1),
(47, 3, 8, 1, 'regular', 1),
(48, 4, 0, 1, 'regular', 1),
(49, 9, 2, 1, 'regular', 1),
(50, 10, 5, 1, 'regular', 1),
(51, 11, 2, 1, 'regular', 1),
(52, 12, 0, 1, 'regular', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfrentamiento`
--

CREATE TABLE `enfrentamiento` (
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
-- Volcado de datos para la tabla `enfrentamiento`
--

INSERT INTO `enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES
(1, 1, 1, 0, '-', '-', '-', 1, 'regular'),
(2, 1, 2, 0, '2-3', '1-2', '4-5', 1, 'regular'),
(3, 1, 3, 2, '2-3', '3-1', '5-2', 1, 'regular'),
(4, 1, 4, 2, '2-1', '3-5', '4-1', 1, 'regular'),
(5, 1, 9, 1, '2-6', '1-4', '2-1', 1, 'regular'),
(6, 1, 10, 1, '1-3', '5-3', '2-6', 1, 'regular'),
(7, 1, 11, 3, '2-1', '2-2', '4-1', 1, 'regular'),
(8, 1, 12, 2, '1-2', '3-1', '4-1', 1, 'regular'),
(9, 2, 2, 0, '-', '-', '-', 1, 'regular'),
(10, 2, 1, 3, '3-2', '2-1', '5-4', 1, 'regular'),
(11, 2, 3, 2, '2-3', '5-4', '5-5', 1, 'regular'),
(12, 2, 4, 3, '1-1', '2-1', '5-2', 1, 'regular'),
(13, 2, 9, 3, '1-0', '2-1', '7-1', 1, 'regular'),
(14, 2, 10, 1, '2-3', '1-2', '5-1', 1, 'regular'),
(15, 2, 11, 1, '4-3', '2-5', '5-8', 1, 'regular'),
(16, 2, 12, 3, '2-1', '3-3', '4-1', 1, 'regular'),
(17, 3, 3, 0, '-', '-', '-', 1, 'regular'),
(18, 3, 1, 1, '3-2', '1-3', '2-5', 1, 'regular'),
(19, 3, 2, 2, '3-2', '4-5', '5-5', 1, 'regular'),
(20, 3, 4, 3, '4-2', '1-0', '3-2', 1, 'regular'),
(21, 3, 9, 1, '1-3', '5-9', '2-1', 1, 'regular'),
(22, 3, 10, 1, '1-4', '4-5', '3-3', 1, 'regular'),
(23, 3, 11, 1, '2-4', '1-5', '3-3', 1, 'regular'),
(24, 3, 12, 2, '2-2', '1-0', '2-4', 1, 'regular'),
(25, 4, 4, 0, '-', '-', '-', 1, 'regular'),
(26, 4, 1, 1, '1-2', '5-3', '1-4', 1, 'regular'),
(27, 4, 2, 1, '1-1', '1-2', '2-5', 1, 'regular'),
(28, 4, 3, 0, '2-4', '0-1', '2-3', 1, 'regular'),
(29, 4, 9, 0, '-', '-', '-', 1, 'regular'),
(30, 4, 10, 0, '-', '-', '-', 1, 'regular'),
(31, 4, 11, 3, '2-1', '4-1', '5-1', 1, 'regular'),
(32, 4, 12, 3, '2-1', '1-1', '5-1', 1, 'regular'),
(33, 9, 9, 0, '-', '-', '-', 1, 'regular'),
(34, 9, 1, 2, '6-2', '4-1', '1-2', 1, 'regular'),
(35, 9, 2, 0, '0-1', '1-2', '1-7', 1, 'regular'),
(36, 9, 3, 2, '3-1', '9-5', '1-2', 1, 'regular'),
(37, 9, 4, 0, '-', '-', '-', 1, 'regular'),
(38, 9, 10, 0, '-', '-', '-', 1, 'regular'),
(39, 9, 11, 0, '-', '-', '-', 1, 'regular'),
(40, 9, 12, 3, '2-2', '3-1', '4-1', 1, 'regular'),
(41, 10, 10, 0, '-', '-', '-', 1, 'regular'),
(42, 10, 1, 2, '3-1', '3-5', '6-2', 1, 'regular'),
(43, 10, 2, 2, '3-2', '2-1', '1-5', 1, 'regular'),
(44, 10, 3, 3, '4-1', '5-4', '3-3', 1, 'regular'),
(45, 10, 4, 0, '-', '-', '-', 1, 'regular'),
(46, 10, 9, 0, '-', '-', '-', 1, 'regular'),
(47, 10, 11, 0, '-', '-', '-', 1, 'regular'),
(48, 10, 12, 2, '2-3', '5-1', '4-1', 1, 'regular'),
(49, 11, 11, 0, '-', '-', '-', 1, 'regular'),
(50, 11, 1, 1, '1-2', '2-2', '1-4', 1, 'regular'),
(51, 11, 2, 2, '3-4', '5-2', '8-5', 1, 'regular'),
(52, 11, 3, 3, '4-2', '5-1', '3-3', 1, 'regular'),
(53, 11, 4, 0, '1-2', '1-4', '1-5', 1, 'regular'),
(54, 11, 9, 0, '-', '-', '-', 1, 'regular'),
(55, 11, 10, 0, '-', '-', '-', 1, 'regular'),
(56, 11, 12, 1, '2-4', '2-1', '3-4', 1, 'regular'),
(57, 12, 12, 0, '-', '-', '-', 1, 'regular'),
(58, 12, 1, 1, '2-1', '1-3', '1-4', 1, 'regular'),
(59, 12, 2, 1, '1-2', '3-3', '1-4', 1, 'regular'),
(60, 12, 3, 2, '2-2', '0-1', '4-2', 1, 'regular'),
(61, 12, 4, 1, '1-2', '1-1', '1-5', 1, 'regular'),
(62, 12, 9, 1, '2-2', '1-3', '1-4', 1, 'regular'),
(63, 12, 10, 1, '3-2', '1-5', '1-4', 1, 'regular'),
(64, 12, 11, 2, '4-2', '1-2', '4-3', 1, 'regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(4) NOT NULL AUTO_INCREMENT,
  `tipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `Campeonato_CategoriaCampeonatoidCampeonato` int(4) NOT NULL,
  `Campeonato_CategoriaCategoriaidCategoria` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `tipoLiga`, `Campeonato_CategoriaCampeonatoidCampeonato`, `Campeonato_CategoriaCategoriaidCategoria`) VALUES
(1, 'regular', 1, 1),
(2, 'regular', 1, 2),
(4, 'regular', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `fecha` date NOT NULL,
  `idPista` int(4) NOT NULL,
  `horario` time NOT NULL,
  `disponibilidad` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `numInscritos` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`fecha`, `idPista`, `horario`, `disponibilidad`, `numInscritos`) VALUES
('2019-01-06', 1, '00:00:00', 'disponible', NULL),
('2019-01-06', 1, '01:30:00', 'ocupado', 2),
('2019-01-06', 1, '03:00:00', 'disponible', 1),
('2019-01-06', 1, '04:30:00', 'disponible', NULL),
('2019-01-06', 1, '06:00:00', 'disponible', NULL),
('2019-01-06', 1, '07:30:00', 'disponible', NULL),
('2019-01-06', 2, '00:00:00', 'disponible', NULL),
('2019-01-06', 2, '01:30:00', 'ocupado', 2),
('2019-01-06', 2, '03:00:00', 'disponible', NULL),
('2019-01-06', 2, '04:30:00', 'disponible', NULL),
('2019-01-06', 2, '06:00:00', 'disponible', NULL),
('2019-01-06', 2, '07:30:00', 'disponible', NULL),
('2019-01-06', 3, '00:00:00', 'disponible', NULL),
('2019-01-06', 3, '01:30:00', 'ocupado', 2),
('2019-01-06', 3, '03:00:00', 'disponible', NULL),
('2019-01-06', 4, '00:00:00', 'disponible', NULL),
('2019-01-06', 4, '01:30:00', 'ocupado', 2),
('2019-01-06', 4, '03:00:00', 'disponible', NULL),
('2019-01-06', 4, '04:30:00', 'disponible', NULL),
('2019-01-06', 4, '06:00:00', 'disponible', NULL),
('2019-01-17', 1, '00:00:00', 'disponible', NULL),
('2019-01-17', 1, '01:30:00', 'disponible', NULL),
('2019-01-17', 1, '03:00:00', 'disponible', NULL),
('2019-01-17', 1, '04:30:00', 'disponible', NULL),
('2019-01-20', 1, '00:00:00', 'disponible', NULL),
('2019-01-20', 1, '01:30:00', 'disponible', NULL),
('2019-01-20', 1, '03:00:00', 'disponible', NULL),
('2019-01-20', 1, '04:30:00', 'disponible', NULL),
('2019-01-20', 2, '00:00:00', 'disponible', NULL),
('2019-01-20', 2, '01:30:00', 'disponible', NULL),
('2019-01-20', 2, '03:00:00', 'disponible', NULL),
('2019-01-20', 2, '04:30:00', 'disponible', NULL),
('2019-01-25', 1, '00:00:00', 'ocupado', 0),
('2019-01-25', 1, '01:30:00', 'disponible', 1),
('2019-01-25', 1, '03:00:00', 'disponible', NULL),
('2019-01-25', 1, '04:30:00', 'disponible', NULL),
('2019-01-25', 2, '00:00:00', 'ocupado', 0),
('2019-01-25', 2, '01:30:00', 'disponible', 2),
('2019-01-25', 2, '03:00:00', 'disponible', NULL),
('2019-01-25', 2, '04:30:00', 'disponible', NULL),
('2019-01-25', 3, '00:00:00', 'ocupado', 0),
('2019-01-25', 3, '01:30:00', 'disponible', 3),
('2019-01-25', 3, '03:00:00', 'disponible', NULL),
('2019-01-25', 3, '04:30:00', 'disponible', NULL),
('2019-01-25', 4, '00:00:00', 'ocupado', 0),
('2019-01-25', 4, '01:30:00', 'disponible', 1),
('2019-01-25', 4, '03:00:00', 'disponible', NULL),
('2019-01-25', 4, '04:30:00', 'disponible', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pareja`
--

CREATE TABLE `pareja` (
  `idPareja` int(4) NOT NULL,
  `capitan` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `deportista` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `GrupoidGrupo` int(4) NOT NULL,
  `GrupotipoLiga` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pareja`
--

INSERT INTO `pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `idPartido` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `inicioInscripcion` date DEFAULT NULL,
  `finInscripcion` date DEFAULT NULL,
  `pista` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`idPartido`, `fecha`, `horaInicio`, `horaFin`, `inicioInscripcion`, `finInscripcion`, `pista`) VALUES
(127, '2019-01-25', '00:00:00', '01:30:00', NULL, '2019-01-18', 1),
(128, '2019-01-25', '01:30:00', '03:00:00', NULL, '2019-01-18', 1),
(129, '2019-01-25', '01:30:00', '03:00:00', NULL, '2019-01-18', 2),
(130, '2019-01-25', '01:30:00', '03:00:00', NULL, '2019-01-18', 3),
(131, '2019-01-25', '01:30:00', '03:00:00', NULL, '2019-01-18', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_reserva`
--

CREATE TABLE `partido_reserva` (
  `PartidoidPartido` int(4) NOT NULL,
  `ReservaidReserva` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pista`
--

CREATE TABLE `pista` (
  `idPista` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pista`
--

INSERT INTO `pista` (`idPista`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `UsuarioRegistradousuario` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idReserva` int(4) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `PistaidPista` int(4) DEFAULT NULL,
  `disponibilidad` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`UsuarioRegistradousuario`, `idReserva`, `fecha`, `horaInicio`, `horaFin`, `PistaidPista`, `disponibilidad`) VALUES
('admin', 11, '2019-01-25', '00:00:00', '01:30:00', 2, 'ocupado'),
('admin', 12, '2019-01-25', '00:00:00', '01:30:00', 3, 'ocupado'),
('admin', 13, '2019-01-25', '00:00:00', '01:30:00', 4, 'ocupado'),
('admin', 14, '2019-01-25', '00:00:00', '01:30:00', 1, 'ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioregistrado`
--

CREATE TABLE `usuarioregistrado` (
  `usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `tipoUsuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarioregistrado`
--

INSERT INTO `usuarioregistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES
('admin', 'admin', 'admin', 'admin', 'admin'),
('ala', 'ala', 'Ana', 'Alvarez', 'deportista'),
('ana', 'purple', 'Ana', 'Martinez', 'admin'),
('ara', 'ara', 'Ana', 'Rodriguez', 'deportista'),
('bet', 'bet', 'Bella', 'Torres', 'deportista'),
('betty', 'betty', 'Bea', 'Martinez', 'deportista'),
('elena', 'purple', 'Elena', 'Fernandez', 'deportista'),
('elna', 'elna', 'Elena', 'Vila', 'deportista'),
('ipereira', 'ipereira', 'Ismael', 'Pereira', 'deportista'),
('irerra', 'irerra', 'Iris', 'Herrera', 'deportista'),
('irpereira', 'purple', 'Ignacio', 'Rodriguez', 'deportista'),
('jan', 'jan', 'Juan', 'Santiago', 'deportista'),
('juan', 'juan', 'Jose', 'Juan', 'deportista'),
('lau', 'lau', 'Laura', 'Lopez', 'deportista'),
('laura', 'laura', 'Laura', 'La', 'deportista'),
('lea', 'lea', 'Lara', 'Santalla', 'deportista'),
('leo', 'leo', 'Leonidas', 'Torres', 'deportista'),
('maria', 'maria', 'Maria', 'Sanchez', 'deportista'),
('marie', 'marie', 'Maria', 'Lopez', 'deportista'),
('mario', 'purple', 'Mario', 'Sanchez', 'deportista'),
('mguel', 'mguel', 'Miguel', 'Martin', 'deportista'),
('miguel', 'purple', 'Miguel', 'Sanchez', 'deportista'),
('mria', 'mria', 'Maria', 'Santiago', 'deportista'),
('pep', 'pep', 'Pepi', 'Grill', 'deportista'),
('pepe', 'purple', 'Pepito', 'Grillo', 'deportista'),
('pereira', 'pereira', 'Maria', 'Pereira', 'deportista'),
('pmperez', 'purple', 'Patricia', 'Martin', 'deportista'),
('pp', 'pp', 'Paula', 'Perez', 'deportista'),
('pperez', 'pperez', 'Pablo', 'Perez', 'deportista'),
('sara', 'sara', 'Sara', 'Fernandez', 'deportista'),
('vfvarela', 'purple', 'Victor', 'Fernandez', 'deportista'),
('vvarela', 'vvarela', 'Vlas', 'Varela', 'deportista');

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

ALTER TABLE `PosiblesReservasEnfrentamiento` CHANGE `idReserva` `idReserva` INT(4) NOT NULL AUTO_INCREMENT;


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
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`idCampeonato`);

--
-- Indices de la tabla `campeonato_categoria`
--
ALTER TABLE `campeonato_categoria`
  ADD PRIMARY KEY (`CampeonatoidCampeonato`,`CategoriaidCategoria`),
  ADD KEY `FKCampeonato419290` (`CategoriaidCategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`idClasificacion`),
  ADD KEY `FKClasificac524722` (`ParejaidPareja`),
  ADD KEY `FKClasificac616946` (`GrupoidGrupo`,`GrupotipoLiga`),
  ADD KEY `FKClasificac710388` (`CampeonatoidCampeonato`);

--
-- Indices de la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD PRIMARY KEY (`idEnfrentamiento`),
  ADD KEY `FKEnfren1` (`ParejaidPareja1`),
  ADD KEY `FKEnfren2` (`ParejaidPareja2`),
  ADD KEY `FKEnfrentami527261` (`GrupoidGrupo`,`GrupotipoLiga`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`,`tipoLiga`),
  ADD KEY `FKGrupo875320` (`Campeonato_CategoriaCampeonatoidCampeonato`,`Campeonato_CategoriaCategoriaidCategoria`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`fecha`,`idPista`,`horario`),
  ADD KEY `idPista` (`idPista`);

--
-- Indices de la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD PRIMARY KEY (`idPareja`),
  ADD KEY `FKPareja602943` (`GrupoidGrupo`,`GrupotipoLiga`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`idPartido`),
  ADD KEY `pista` (`pista`);

--
-- Indices de la tabla `partido_reserva`
--
ALTER TABLE `partido_reserva`
  ADD PRIMARY KEY (`PartidoidPartido`,`ReservaidReserva`),
  ADD KEY `FKPartido_Re279823` (`ReservaidReserva`);

--
-- Indices de la tabla `pista`
--
ALTER TABLE `pista`
  ADD PRIMARY KEY (`idPista`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FKReserva401525` (`fecha`,`PistaidPista`,`horaInicio`),
  ADD KEY `FKReserva450869` (`UsuarioRegistradousuario`);

--
-- Indices de la tabla `usuarioregistrado`
--
ALTER TABLE `usuarioregistrado`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `idCampeonato` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `idClasificacion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  MODIFY `idEnfrentamiento` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pareja`
--
ALTER TABLE `pareja`
  MODIFY `idPareja` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `idPartido` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `pista`
--
ALTER TABLE `pista`
  MODIFY `idPista` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campeonato_categoria`
--
ALTER TABLE `campeonato_categoria`
  ADD CONSTRAINT `FKCampeonato419290` FOREIGN KEY (`CategoriaidCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKCampeonato73800` FOREIGN KEY (`CampeonatoidCampeonato`) REFERENCES `campeonato` (`idCampeonato`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD CONSTRAINT `FKClasificac524722` FOREIGN KEY (`ParejaidPareja`) REFERENCES `pareja` (`idPareja`),
  ADD CONSTRAINT `FKClasificac616946` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `grupo` (`idGrupo`, `tipoLiga`),
  ADD CONSTRAINT `FKClasificac710388` FOREIGN KEY (`CampeonatoidCampeonato`) REFERENCES `campeonato` (`idCampeonato`);

--
-- Filtros para la tabla `enfrentamiento`
--
ALTER TABLE `enfrentamiento`
  ADD CONSTRAINT `FKEnfren1` FOREIGN KEY (`ParejaidPareja1`) REFERENCES `pareja` (`idPareja`),
  ADD CONSTRAINT `FKEnfren2` FOREIGN KEY (`ParejaidPareja2`) REFERENCES `pareja` (`idPareja`),
  ADD CONSTRAINT `FKEnfrentami527261` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `grupo` (`idGrupo`, `tipoLiga`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `FKGrupo875320` FOREIGN KEY (`Campeonato_CategoriaCampeonatoidCampeonato`,`Campeonato_CategoriaCategoriaidCategoria`) REFERENCES `campeonato_categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `FKHorario323934` FOREIGN KEY (`idPista`) REFERENCES `pista` (`idPista`);

--
-- Filtros para la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD CONSTRAINT `FKPareja602943` FOREIGN KEY (`GrupoidGrupo`,`GrupotipoLiga`) REFERENCES `grupo` (`idGrupo`, `tipoLiga`);

--
-- Filtros para la tabla `partido_reserva`
--
ALTER TABLE `partido_reserva`
  ADD CONSTRAINT `FKPartido_Re279823` FOREIGN KEY (`ReservaidReserva`) REFERENCES `reserva` (`idReserva`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKPartido_Re355375` FOREIGN KEY (`PartidoidPartido`) REFERENCES `partido` (`idPartido`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FKReserva401525` FOREIGN KEY (`fecha`,`PistaidPista`,`horaInicio`) REFERENCES `horario` (`fecha`, `idPista`, `horario`),
  ADD CONSTRAINT `FKReserva450869` FOREIGN KEY (`UsuarioRegistradousuario`) REFERENCES `usuarioregistrado` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
