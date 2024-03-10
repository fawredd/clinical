-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2022 a las 02:30:05
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mibase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_adjuntosficha`
--

CREATE TABLE `mm_adjuntosficha` (
  `id` int(11) NOT NULL,
  `ficha` int(11) NOT NULL,
  `archivo` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_adjuntosnutri`
--

CREATE TABLE `mm_adjuntosnutri` (
  `id` int(11) NOT NULL,
  `ficha` int(11) NOT NULL,
  `archivo` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_empresas`
--

CREATE TABLE `mm_empresas` (
  `id` int(11) NOT NULL,
  `denominacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_empresas`
--

INSERT INTO `mm_empresas` (`id`, `denominacion`) VALUES
(1, 'empresa'),
(2, 'empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_fichahistoria`
--

CREATE TABLE `mm_fichahistoria` (
  `id` int(11) NOT NULL,
  `historiaclinica` int(11) NOT NULL,
  `fechaficha` date DEFAULT NULL,
  `horacarga` time DEFAULT NULL,
  `usuariocarga` int(11) NOT NULL,
  `datos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentario` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_fichahistoria`
--

INSERT INTO `mm_fichahistoria` (`id`, `historiaclinica`, `fechaficha`, `horacarga`, `usuariocarga`, `datos`, `comentario`) VALUES
(1, 2, '2022-11-01', '22:21:00', 1, 'Esta es una nueva evolucion de la historia clinica', 'Comentario de la nueva evolucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_fichanutri`
--

CREATE TABLE `mm_fichanutri` (
  `id` int(11) NOT NULL,
  `historiaclinica` int(11) NOT NULL,
  `fechaficha` date DEFAULT NULL,
  `horacarga` time DEFAULT NULL,
  `usuariocarga` int(11) NOT NULL,
  `diagnostico` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `antecedentes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `pa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `t` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tEstimada` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bmi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pcp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diagnosticoNutricional` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `laboratorio` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `masticacion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deglucion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `asistencia` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `indicacion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `suplementacion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `colaciones` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentario` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_historiasclinicas`
--

CREATE TABLE `mm_historiasclinicas` (
  `id` int(11) NOT NULL,
  `usuariocarga` int(11) NOT NULL,
  `fechacarga` date DEFAULT NULL,
  `paciente` int(11) NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_historiasclinicas`
--

INSERT INTO `mm_historiasclinicas` (`id`, `usuariocarga`, `fechacarga`, `paciente`, `comentarios`) VALUES
(2, 1, '2022-11-02', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_indicaciones`
--

CREATE TABLE `mm_indicaciones` (
  `id` int(11) NOT NULL,
  `historiaclinica` int(11) NOT NULL,
  `fechaficha` date DEFAULT NULL,
  `horacarga` time DEFAULT NULL,
  `usuariocarga` int(11) NOT NULL,
  `comentario` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_indicaciones`
--

INSERT INTO `mm_indicaciones` (`id`, `historiaclinica`, `fechaficha`, `horacarga`, `usuariocarga`, `comentario`) VALUES
(1, 2, '2022-11-01', '22:22:54', 1, 'Comentario de indicacion uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_indicaciones_mov`
--

CREATE TABLE `mm_indicaciones_mov` (
  `id` int(11) NOT NULL,
  `indicacion` int(11) NOT NULL,
  `medicacion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `desayuno` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `almuerzo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `merienda` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cena` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `22hs` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_indicaciones_mov`
--

INSERT INTO `mm_indicaciones_mov` (`id`, `indicacion`, `medicacion`, `desayuno`, `almuerzo`, `merienda`, `cena`, `22hs`) VALUES
(1, 1, 'Cenar carne', '12', '12', '12', '12', '12'),
(2, 1, 'Almorzar Pure', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_mensajes`
--

CREATE TABLE `mm_mensajes` (
  `id` int(11) NOT NULL,
  `fecha_carga` date DEFAULT NULL,
  `mensaje` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_empresa` tinyint(255) NOT NULL,
  `usuario_carga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_pacientes`
--

CREATE TABLE `mm_pacientes` (
  `id` int(11) NOT NULL,
  `tipodocumento` tinyint(10) NOT NULL,
  `documento` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` tinyint(4) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigopostal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gruposanguineo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obrasocial` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroafiliado` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentarios` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuariocreacion` int(11) NOT NULL,
  `fechaalta` date DEFAULT NULL,
  `id_empresa` tinyint(255) NOT NULL,
  `responsable_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_doc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modificacion` date NOT NULL DEFAULT current_timestamp(),
  `fechafallecimiento` date DEFAULT NULL,
  `fechabaja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_pacientes`
--

INSERT INTO `mm_pacientes` (`id`, `tipodocumento`, `documento`, `nombre`, `apellido`, `sexo`, `fechanacimiento`, `direccion`, `provincia`, `localidad`, `codigopostal`, `telefono`, `celular`, `email`, `gruposanguineo`, `obrasocial`, `numeroafiliado`, `comentarios`, `usuariocreacion`, `fechaalta`, `id_empresa`, `responsable_nombre`, `responsable_doc`, `responsable_tel`, `responsable_email`, `responsable_dir`, `modificacion`, `fechafallecimiento`, `fechabaja`) VALUES
(2, 1, '55555555', 'Pepe', 'Pepon', 0, '1950-01-01', 'Calle 1234', '1', 'Caba', '1054', '011 555555555', '011 66666666', 'x@x.com', '1', 'OSDE', '123134145134514', '', 1, '2022-11-02', 2, 'El Responsable', 'DNI 000000', '88888888', '', 'Esta es la direccion del responsable', '2022-11-02', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_provincias`
--

CREATE TABLE `mm_provincias` (
  `provincia_id` int(11) NOT NULL,
  `provincia_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_provincias`
--

INSERT INTO `mm_provincias` (`provincia_id`, `provincia_nombre`) VALUES
(1, 'Buenos Aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mm_usuarios`
--

CREATE TABLE `mm_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipousuario` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `alta` date NOT NULL,
  `modificacion` date DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipodocumento` tinyint(10) DEFAULT NULL,
  `numerodocumento` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matricula` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `especialidad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_empresa` tinyint(255) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuariocarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mm_usuarios`
--

INSERT INTO `mm_usuarios` (`id`, `nombre`, `apellido`, `email`, `clave`, `tipousuario`, `activo`, `alta`, `modificacion`, `direccion`, `provincia`, `localidad`, `cp`, `telefono`, `celular`, `tipodocumento`, `numerodocumento`, `matricula`, `especialidad`, `id_empresa`, `token`, `comentarios`, `usuariocarga`) VALUES
(1, 'Admin', 'Admin', 'x@x.com', '$2y$10$43kLmV30sPHQw.tqf7LaTeFZqyv6INbIxBSQXyYbYKX1q2WGxz5Gu', 1, 1, '2022-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '$2y$10$yHvEL/laqgCtpad2q24r1./uK4CFfBzleknYh5KqxvEwq2llk13iy', NULL, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mm_adjuntosficha`
--
ALTER TABLE `mm_adjuntosficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ficha` (`ficha`);

--
-- Indices de la tabla `mm_adjuntosnutri`
--
ALTER TABLE `mm_adjuntosnutri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ficha` (`ficha`);

--
-- Indices de la tabla `mm_empresas`
--
ALTER TABLE `mm_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mm_fichahistoria`
--
ALTER TABLE `mm_fichahistoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiaclinica` (`historiaclinica`),
  ADD KEY `usuariocarga` (`usuariocarga`);

--
-- Indices de la tabla `mm_fichanutri`
--
ALTER TABLE `mm_fichanutri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiaclinica` (`historiaclinica`);

--
-- Indices de la tabla `mm_historiasclinicas`
--
ALTER TABLE `mm_historiasclinicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuariocarga` (`usuariocarga`),
  ADD KEY `paciente` (`paciente`);

--
-- Indices de la tabla `mm_indicaciones`
--
ALTER TABLE `mm_indicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiaclinica` (`historiaclinica`),
  ADD KEY `usuariocarga` (`usuariocarga`);

--
-- Indices de la tabla `mm_indicaciones_mov`
--
ALTER TABLE `mm_indicaciones_mov`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicacion` (`indicacion`);

--
-- Indices de la tabla `mm_mensajes`
--
ALTER TABLE `mm_mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_carga` (`usuario_carga`);

--
-- Indices de la tabla `mm_pacientes`
--
ALTER TABLE `mm_pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuariocreacion` (`usuariocreacion`);

--
-- Indices de la tabla `mm_provincias`
--
ALTER TABLE `mm_provincias`
  ADD PRIMARY KEY (`provincia_id`);

--
-- Indices de la tabla `mm_usuarios`
--
ALTER TABLE `mm_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mm_adjuntosficha`
--
ALTER TABLE `mm_adjuntosficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mm_adjuntosnutri`
--
ALTER TABLE `mm_adjuntosnutri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mm_empresas`
--
ALTER TABLE `mm_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mm_fichahistoria`
--
ALTER TABLE `mm_fichahistoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mm_fichanutri`
--
ALTER TABLE `mm_fichanutri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mm_historiasclinicas`
--
ALTER TABLE `mm_historiasclinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mm_indicaciones`
--
ALTER TABLE `mm_indicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mm_indicaciones_mov`
--
ALTER TABLE `mm_indicaciones_mov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mm_mensajes`
--
ALTER TABLE `mm_mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mm_pacientes`
--
ALTER TABLE `mm_pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mm_provincias`
--
ALTER TABLE `mm_provincias`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mm_usuarios`
--
ALTER TABLE `mm_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mm_adjuntosficha`
--
ALTER TABLE `mm_adjuntosficha`
  ADD CONSTRAINT `mm_adjuntosficha_ibfk_1` FOREIGN KEY (`ficha`) REFERENCES `mm_fichahistoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_adjuntosnutri`
--
ALTER TABLE `mm_adjuntosnutri`
  ADD CONSTRAINT `mm_adjuntosnutri_ibfk_1` FOREIGN KEY (`ficha`) REFERENCES `mm_fichanutri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_fichahistoria`
--
ALTER TABLE `mm_fichahistoria`
  ADD CONSTRAINT `mm_fichahistoria_ibfk_1` FOREIGN KEY (`historiaclinica`) REFERENCES `mm_historiasclinicas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_fichahistoria_ibfk_2` FOREIGN KEY (`usuariocarga`) REFERENCES `mm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_fichanutri`
--
ALTER TABLE `mm_fichanutri`
  ADD CONSTRAINT `mm_fichanutri_ibfk_1` FOREIGN KEY (`historiaclinica`) REFERENCES `mm_historiasclinicas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_historiasclinicas`
--
ALTER TABLE `mm_historiasclinicas`
  ADD CONSTRAINT `mm_historiasclinicas_ibfk_1` FOREIGN KEY (`usuariocarga`) REFERENCES `mm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_historiasclinicas_ibfk_2` FOREIGN KEY (`paciente`) REFERENCES `mm_pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_indicaciones`
--
ALTER TABLE `mm_indicaciones`
  ADD CONSTRAINT `mm_indicaciones_ibfk_1` FOREIGN KEY (`historiaclinica`) REFERENCES `mm_historiasclinicas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_indicaciones_ibfk_2` FOREIGN KEY (`usuariocarga`) REFERENCES `mm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_indicaciones_mov`
--
ALTER TABLE `mm_indicaciones_mov`
  ADD CONSTRAINT `mm_indicaciones_mov_ibfk_1` FOREIGN KEY (`indicacion`) REFERENCES `mm_indicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_mensajes`
--
ALTER TABLE `mm_mensajes`
  ADD CONSTRAINT `mm_mensajes_ibfk_1` FOREIGN KEY (`usuario_carga`) REFERENCES `mm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mm_pacientes`
--
ALTER TABLE `mm_pacientes`
  ADD CONSTRAINT `mm_pacientes_ibfk_1` FOREIGN KEY (`usuariocreacion`) REFERENCES `mm_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
