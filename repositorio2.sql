-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2021 a las 16:42:24
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(50) NOT NULL,
  `namealum` varchar(100) NOT NULL,
  `name_ase_aca` varchar(100) DEFAULT NULL,
  `name_ase_emp` varchar(100) DEFAULT NULL,
  `nameproy` varchar(100) NOT NULL,
  `name_empresa` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `palabra_clave` varchar(100) DEFAULT NULL,
  `generacion` varchar(20) DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `captura_pantalla` varchar(200) DEFAULT NULL,
  `file_type_captura` varchar(50) DEFAULT NULL,
  `file_path_captura` text DEFAULT NULL,
  `archivo_aplicativo` varchar(200) NOT NULL,
  `file_type_archivo` varchar(50) NOT NULL,
  `file_path_archivo` text NOT NULL,
  `manual_tec` varchar(200) DEFAULT NULL,
  `file_type_tec` varchar(50) DEFAULT NULL,
  `file_path_tec` text DEFAULT NULL,
  `manual_user` varchar(200) DEFAULT NULL,
  `file_type_user` varchar(50) DEFAULT NULL,
  `file_path_user` text DEFAULT NULL,
  `tipo_proy` varchar(100) DEFAULT NULL,
  `nivel_proy` varchar(50) DEFAULT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `is_public` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `namealum`, `name_ase_aca`, `name_ase_emp`, `nameproy`, `name_empresa`, `description`, `palabra_clave`, `generacion`, `date_updated`, `captura_pantalla`, `file_type_captura`, `file_path_captura`, `archivo_aplicativo`, `file_type_archivo`, `file_path_archivo`, `manual_tec`, `file_type_tec`, `file_path_tec`, `manual_user`, `file_type_user`, `file_path_user`, `tipo_proy`, `nivel_proy`, `user_id`, `folder_id`, `is_public`) VALUES
(27, 'sael alexander', NULL, NULL, 'MOGOS', NULL, 'Es un desarrollo de software', NULL, NULL, '2021-07-21 09:41:20', NULL, NULL, NULL, 'Trabajo', 'rar', '1626878460_Trabajo.rar', NULL, NULL, NULL, NULL, NULL, NULL, 'Integradora', 'TSU', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` int(100) NOT NULL,
  `carrera` varchar(100) DEFAULT NULL,
  `cuatrimestre` varchar(50) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Administrador,                2=Docente,            3=Alumno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `carrera`, `cuatrimestre`, `type`) VALUES
(1, 'Sael Alexander Madora Sanchez', '18307058', 123456, 'Ing. en Desarrollo y Gestión de Software', ' ', 2),
(2, 'Obed Gomez Piedra', 'obed', 12345, 'Ing. en Desarrollo y Gestión de Software', '9no', 3),
(3, 'David Rogelio Obscura Garcia', 'David', 12345, 'Ing. en Desarrollo y Gestión de Software', '9no', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
