-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2023 a las 16:58:36
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
-- Base de datos: `juegosscoresdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `juego_id` int(11) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`comentario_id`, `usuario_id`, `juego_id`, `contenido`, `fecha`) VALUES
(83, 24, 5, 'ertytytry', '2023-11-06 22:48:46'),
(84, 46, 1, 'Prueba de comentarios', '2023-11-08 01:24:04'),
(85, 46, 2, 'Prueba de comentarios', '2023-11-08 01:24:18'),
(86, 46, 2, 'Prueba de comentarios', '2023-11-08 01:24:51'),
(87, 46, 3, 'Prueba de comentarios', '2023-11-08 01:25:08'),
(88, 46, 5, 'Prueba de comentarios', '2023-11-08 01:25:21'),
(89, 46, 4, 'Prueba de comentarios', '2023-11-08 01:25:38'),
(90, 46, 1, 'Prueba de comentarios', '2023-11-08 01:25:53'),
(91, 46, 5, 'Prueba de comentarios', '2023-11-08 01:28:37'),
(92, 46, 5, 'Prueba de comentarios', '2023-11-08 01:29:19'),
(93, 24, 5, 'GHHGH', '2023-11-10 22:37:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `juego_id` int(11) NOT NULL,
  `nombre_juego` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`juego_id`, `nombre_juego`) VALUES
(1, 'Tetris'),
(2, 'red vs blue'),
(3, 'creeper'),
(4, 'globy'),
(5, 'GlobyAdventure');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scores`
--

CREATE TABLE `scores` (
  `scores_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `juego_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scores`
--

INSERT INTO `scores` (`scores_id`, `usuarios_id`, `juego_id`, `score`) VALUES
(66, 21, 4, 10),
(67, 21, 4, 10),
(68, 21, 4, 10),
(69, 21, 4, 10),
(70, 21, 4, 20),
(71, 21, 4, 20),
(72, 21, 4, 10),
(73, 21, 4, 10),
(74, 24, 4, 90),
(75, 24, 4, 10),
(76, 25, 4, 30),
(77, 25, 4, 20),
(78, 26, 4, 10),
(79, 26, 4, 20),
(80, 27, 4, 40),
(81, 27, 4, 10),
(82, 27, 4, 80),
(83, 27, 4, 40),
(84, 27, 4, 140),
(85, 21, 4, 170),
(86, 21, 4, 10),
(87, 24, 5, 62),
(88, 26, 5, 32),
(89, 24, 1, 0),
(90, 37, 5, 51),
(91, 37, 1, 10),
(92, 24, 2, 342);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `clave` varchar(90) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `nombre_usuario`, `clave`, `email`, `reset_token`, `token_expira`) VALUES
(21, 'Josue', '$2y$10$gmiW6VXRSDwxjFMGh19DoOjbzpy6ijL.pep9LMKjEdupa1PKimC5q', 'elpepopnsio@gmail.com', NULL, NULL),
(23, 'todo', '$2y$10$6V2WjwHGjGwLptHpQqOugeK7pBaKPbtiaxTgEQE6j56AeuBr2hPvK', 'holacomoestas123@gmail.com', NULL, NULL),
(24, '666', '$2y$10$yilrXffREWV1wvzoaasRC.9EwJPuHrw5mKqRLLr04ZX8kO61.kxzO', '666@gmail.com', NULL, NULL),
(25, '777', '$2y$10$.KTCcPWNXqD33GqOy08.6Oqm/G2MvVBbUHKN4Tvs1CIibLn5fjsHG', '777@gmail.com', '511925', '2023-11-08 19:55:41'),
(26, '888', '$2y$10$e5A75WJSQ0ouIGsqeZqneO1Ac9z2ldDZNdE/nULM3/kNZh5glJ6H.', '888@gmail.com', NULL, NULL),
(27, 'josi', '$2y$10$o4e91eCQwbuj9.krnrEzH.gOKRmjc2SZ2de8LWa6nJDGC5YV4narK', 'josiascr14@gmail.com', NULL, NULL),
(28, 'pepito', '$2y$10$6S76jD2v8QKo3pIcQeyNq.jNdt4V9xeA6AiXasrR0hJf25MwfeAv.', 'pepito@globaly.com', NULL, NULL),
(29, 'Globy', '$2y$10$yilrXffREWV1wvzoaasRC.9EwJPuHrw5mKqRLLr04ZX8kO61.kxzO', '666@gmail.com', NULL, NULL),
(30, '', '$2y$10$G1skxrmwQVmIrreDjqem0.UCjgRnAtF2.L44Wd9.is71sVanYM59i', '', NULL, NULL),
(31, 'chus', '$2y$10$4q7TSxq8rwz/osnvpQ1Mgu75gAh82CHXpYIIMMPWr2NHdn9gBYzzG', 'solano@gmail.com', NULL, NULL),
(32, '', '$2y$10$zMt.e4R.LXT.UfXg9OoVyOlY6kRs3CG0vGJIp9TdXooPDiIZB3ahm', '', NULL, NULL),
(33, '', '$2y$10$52Ei9blOpX.7YjhHCd6o2.17548Zcwolv.m3vOnWbp4M5MO/xHRD2', '', NULL, NULL),
(34, 'pedrito', '$2y$10$jbrAj.8Eo8wuQevohwY0cOay/hL2tb/lzjJsvD/3CUHODZtngRWra', 'pedroffernandez@gmail.com', NULL, NULL),
(35, '', '$2y$10$HIBymouTldhBUXiGoaQgnuHYC0L0tkaiyFqrUX7y7zKB0xkio3HNa', '', NULL, NULL),
(36, '', '$2y$10$N1BzCV8LnpYihnN4U9hd.OmzTu6OaipcfEuMvQlHjYPCmRIFpnQbK', '', NULL, NULL),
(37, 'Vicente', '$2y$10$M2bqAQjEAJGN6GicgGWlI.xJMCbq2KQOe96FDEOzWGG5u.DIcP3FG', 'vicente@gmail.com', NULL, NULL),
(38, '', '$2y$10$Gtx4RcjJs3VNMgcB75vb3eyXJEEQTt2pZ0Tze91HINVUV289Gy25O', '', NULL, NULL),
(39, 'randy', '$2y$10$iqq3tvahWweOXDMBFZUul.OK6sWt1FCC/ukDAsBpyMsYG8Z48zma2', 'randy@gmail.com', '77062bec4bc64d0ea489a2e3ae06dbbf3624de38df0ea963c24795e6558d5538', '2023-11-09 22:24:12'),
(40, 'jona', '$2y$10$0kAAkV06IlMERWNx0G0uD.Bk5v.wOQYvs9ONWmNGGqkv6GQzxz7u.', 'jonathan@gmail.com', NULL, NULL),
(41, 'jesus', '$2y$10$LPaijQA/ABlTUC95UzVuo.wpbDKsvCSeRkjrcm.Ws5dNSeqWavjtS', 'alberto169@gmail.com', '6364cd27803d61865cba229b1d55cf02', '2023-11-07 23:39:05'),
(42, 'jesus', '$2y$10$g31MxAs8R/icf7J8l1hYOe2bS6K3L2ORX3bvk3206x6yeDLeWCJk6', 'albertosolano169@gmail.com', '345481', '2023-11-08 21:21:41'),
(43, '', '$2y$10$8aKNwJ2KGTTwLupGpsKaregPQnTb7y9nwzYCkFXFw04MrDnf1Q6mG', '', NULL, NULL),
(44, 'ignacio', '$2y$10$7DATCfIwmsdGJXViI51Hxew0yTo3jOobmIa3yXCmb61.tZPfk81BS', 'ignacio@gmail.com', NULL, NULL),
(45, '666', '$2y$10$yilrXffREWV1wvzoaasRC.9EwJPuHrw5mKqRLLr04ZX8kO61.kxzO', '666@gmail.com', NULL, NULL),
(46, 'Globaly', '$2y$10$iTYPPj1RibNxNU3l0WqCGegJwN1T/25AVpSLu8/gDWKbcdY4oXQUe', 'testgames@globaly.com', NULL, NULL),
(47, 'Globy', '$2y$10$yilrXffREWV1wvzoaasRC.9EwJPuHrw5mKqRLLr04ZX8kO61.kxzO', '666@gmail.com', NULL, NULL),
(48, 'SOLANOOBADNO', '$2y$10$7778oCLGIKOdWzw3m7E6puB.NE25SokIqnb13ypANMl6Ri3DSCGLO', 'globy@gmail.com', NULL, NULL),
(49, 'Globy', '$2y$10$7778oCLGIKOdWzw3m7E6puB.NE25SokIqnb13ypANMl6Ri3DSCGLO', 'globy@gmail.com', NULL, NULL),
(50, 'Ubuntu', '$2y$10$SBsN7zeDJBE9yrM25YyNpuHWI3aVbqNr1.KQLWO/lJN1H1P1TvNn.', 'pcubuntugl@gmail.com', '02bf5ccdee792e9bfafb119d8f04c5dfbaca680ef7e61fd1dedd99a3d1e790d5', '2023-11-09 20:47:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `juego_id` (`juego_id`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`juego_id`);

--
-- Indices de la tabla `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`scores_id`),
  ADD KEY `usuarios_id` (`usuarios_id`),
  ADD KEY `juego_id` (`juego_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `juego_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `scores`
--
ALTER TABLE `scores`
  MODIFY `scores_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuarios_id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`juego_id`);

--
-- Filtros para la tabla `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`juego_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
