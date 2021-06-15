-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 31.170.166.146
-- Tiempo de generación: 13-06-2021 a las 06:34:40
-- Versión del servidor: 10.4.14-MariaDB-cll-lve
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u994122482_web_escolar`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`u994122482_dash`@`%` PROCEDURE `prestarMateriales` (IN `id_estu` INT, IN `idDetaMate` INT)  begin
	-- declare codPecosa varchar(20);
    select @codPecosa := LPAD(CONV(RAND() * POW(36, 6), 10, 36), 6, 0);
    -- declare fecha datetime;
    select @fecha := now();
   UPDATE detallematerial set status = 'OCUPADO' where idDetalleMaterial = idDetaMate;
   INSERT INTO prestamo (idEstudiante, idDetalleMaterial, codePecosa, fechaHora) values (id_estu, idDetaMate, @codPecosa, @fecha);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `DNI` char(8) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phone` char(9) NOT NULL,
  `created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`DNI`, `firstName`, `lastName`, `phone`, `created_At`) VALUES
('01454478', 'Carlos Enrique', 'Sánchez Contreras', '947511478', '2021-06-09 03:31:54'),
('10555153', 'Belinda', 'Cuesta García', '4567987', '2021-06-01 23:49:31'),
('12345678', 'juan', 'jimenez', '999111333', '2021-06-13 02:35:41'),
('14554855', 'Pedro Carlos', 'Portolatino Castillo', '945100175', '2021-06-01 23:49:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallematerial`
--

CREATE TABLE `detallematerial` (
  `idDetalleMaterial` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `status` enum('DISPONIBLE','OCUPADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallematerial`
--

INSERT INTO `detallematerial` (`idDetalleMaterial`, `idMaterial`, `status`) VALUES
(1, 10, 'DISPONIBLE'),
(2, 10, 'DISPONIBLE'),
(4, 10, 'OCUPADO'),
(10, 8, 'OCUPADO'),
(11, 10, 'DISPONIBLE'),
(12, 10, 'DISPONIBLE');

--
-- Disparadores `detallematerial`
--
DELIMITER $$
CREATE TRIGGER `eliminarCantidadMaterial` AFTER DELETE ON `detallematerial` FOR EACH ROW BEGIN
DECLARE total INT;
SET total = (SELECT count(iddetallematerial) from detallematerial where idmaterial = old.idmaterial);
UPDATE material set material.amount = total where idMaterial = old.idmaterial;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modificarCantidadMaterial` AFTER INSERT ON `detallematerial` FOR EACH ROW BEGIN
DECLARE total INT;
SET total = (SELECT count(iddetallematerial) from detallematerial where idmaterial = new.idmaterial);
UPDATE material set material.amount = total where idMaterial = new.idmaterial;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallematerialdevuelto`
--

CREATE TABLE `detallematerialdevuelto` (
  `idDevolucion` int(11) NOT NULL,
  `idDetalle` int(11) NOT NULL,
  `Datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallematerialdevuelto`
--

INSERT INTO `detallematerialdevuelto` (`idDevolucion`, `idDetalle`, `Datetime`, `motivo`) VALUES
(6, 4, '2021-06-13 03:21:52', ' hola mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idEstudiante` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `grado` varchar(20) NOT NULL,
  `section` enum('A','B') NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idApoderado` char(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `dni`, `firstName`, `LastName`, `grado`, `section`, `idUsuario`, `idApoderado`, `created_at`) VALUES
(3, '74821145', 'Cindy Mia', 'Portolatino Espiribidigliosi', 'Tercer Grado', 'B', 1, '14554855', '2021-06-01 23:50:57'),
(4, '76548888', 'Cecilia Arsenia', 'Paredes Cuesta', 'Primer Grado', 'B', 1, '10555153', '2021-06-07 18:42:31'),
(5, '75266897', 'Sofia Carla', 'Sanchez Pariño', 'Quinto Grado', 'A', 2, '01454478', '2021-06-09 13:05:27'),
(9, '70247730', 'bruno', 'jimenez', 'Segundo', 'B', 2, '12345678', '2021-06-13 02:35:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `idMaterial` int(11) NOT NULL,
  `curse` varchar(40) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `ReceptionDate` date NOT NULL,
  `tipoMaterial` varchar(30) NOT NULL,
  `nameMaterial` varchar(30) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`idMaterial`, `curse`, `grade`, `ReceptionDate`, `tipoMaterial`, `nameMaterial`, `amount`, `created_At`) VALUES
(2, 'Logico Matematico', 'Segundo', '2021-06-23', 'Libros', '', 5, '2021-06-01 23:26:49'),
(8, 'Comunicacion Integral', 'Segundo', '2021-06-07', 'Libros', '', 20, '2021-06-04 20:27:23'),
(9, 'Comunicacion Integral', 'Segundo', '2021-06-07', 'Otros', 'QWEQW', 20, '2021-06-04 20:27:36'),
(10, 'Logico Matematico', 'Tercero', '2021-06-08', 'Libros', '', 5, '2021-06-13 01:27:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagoapafa`
--

CREATE TABLE `pagoapafa` (
  `codeApafa` int(11) NOT NULL,
  `state` enum('PAGO','NO PAGO') NOT NULL,
  `fechaPago` date DEFAULT NULL,
  `idApoderado` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagoapafa`
--

INSERT INTO `pagoapafa` (`codeApafa`, `state`, `fechaPago`, `idApoderado`) VALUES
(1, 'PAGO', '2021-05-10', '10555153'),
(2, 'NO PAGO', NULL, '14554855'),
(3, 'PAGO', '2021-06-09', '01454478');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idPrestamo` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL,
  `idDetalleMaterial` int(11) NOT NULL,
  `codePecosa` varchar(10) NOT NULL,
  `fechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idPrestamo`, `idEstudiante`, `idDetalleMaterial`, `codePecosa`, `fechaHora`) VALUES
(1, 4, 4, 'Z1EL82', '2021-06-13 01:27:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(150) NOT NULL,
  `rol` enum('director','secretaria') NOT NULL,
  `status` enum('on','off') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUser`, `firstName`, `lastName`, `email`, `password`, `rol`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Azucena Rosa', 'Torres Sosa', 'Smiguelgrau24015@gmail.com', '$2y$10$.LAUTN/382cfACsjfX8UlObYqNTfMKW/GgpIQurllSo587S5WOvXm', 'secretaria', 'off', '2021-06-13 03:40:41', '2021-06-13 05:40:40'),
(2, 'Jesus Manuel', 'Jimenez Huaraca', 'Dmiguelgrau24015@gmail.com', '$2y$10$.LAUTN/382cfACsjfX8UlObYqNTfMKW/GgpIQurllSo587S5WOvXm', 'director', 'on', '2021-06-13 03:40:50', '2021-06-13 05:40:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `detallematerial`
--
ALTER TABLE `detallematerial`
  ADD PRIMARY KEY (`idDetalleMaterial`),
  ADD KEY `idMaterial` (`idMaterial`),
  ADD KEY `detalleMaterialIndex` (`idDetalleMaterial`);

--
-- Indices de la tabla `detallematerialdevuelto`
--
ALTER TABLE `detallematerialdevuelto`
  ADD PRIMARY KEY (`idDevolucion`),
  ADD KEY `idDetalle` (`idDetalle`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idEstudiante`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idApoderado` (`idApoderado`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idMaterial`);

--
-- Indices de la tabla `pagoapafa`
--
ALTER TABLE `pagoapafa`
  ADD PRIMARY KEY (`codeApafa`),
  ADD KEY `DNI` (`idApoderado`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idPrestamo`),
  ADD KEY `idEstudiante` (`idEstudiante`),
  ADD KEY `idDetalleMaterial` (`idDetalleMaterial`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallematerial`
--
ALTER TABLE `detallematerial`
  MODIFY `idDetalleMaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detallematerialdevuelto`
--
ALTER TABLE `detallematerialdevuelto`
  MODIFY `idDevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `idMaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pagoapafa`
--
ALTER TABLE `pagoapafa`
  MODIFY `codeApafa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `idPrestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallematerial`
--
ALTER TABLE `detallematerial`
  ADD CONSTRAINT `idMaterial` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detallematerialdevuelto`
--
ALTER TABLE `detallematerialdevuelto`
  ADD CONSTRAINT `idDetalle` FOREIGN KEY (`idDetalle`) REFERENCES `detallematerial` (`idDetalleMaterial`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `idApoderado` FOREIGN KEY (`idApoderado`) REFERENCES `apoderado` (`DNI`) ON DELETE CASCADE,
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagoapafa`
--
ALTER TABLE `pagoapafa`
  ADD CONSTRAINT `DNI` FOREIGN KEY (`idApoderado`) REFERENCES `apoderado` (`DNI`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `idDetalleMaterial` FOREIGN KEY (`idDetalleMaterial`) REFERENCES `detallematerial` (`idDetalleMaterial`) ON DELETE CASCADE,
  ADD CONSTRAINT `idEstudiante` FOREIGN KEY (`idEstudiante`) REFERENCES `estudiante` (`idEstudiante`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
