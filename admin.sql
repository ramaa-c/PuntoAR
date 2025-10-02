-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2025 a las 11:13:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` enum('general','evento','combo') DEFAULT 'general'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `tipo`) VALUES
(1, 'Tazas', 'Artículos de cerámica personalizables.', 'general'),
(2, 'Indumentaria', 'Ropa de algodón y otros textiles para estampar.', 'evento'),
(3, 'Accesorios', 'Llaveros, pines y otros pequeños artículos.', 'general'),
(4, 'Termos', NULL, 'general'),
(5, 'Gorras', NULL, 'general'),
(6, 'Tazas Mágicas', NULL, 'general');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `id_combo` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidodetalle`
--

CREATE TABLE `pedidodetalle` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `especificaciones` text DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `detalleImagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','en_proceso','finalizado','cancelado') DEFAULT 'pendiente',
  `requiere_contacto` tinyint(1) DEFAULT 0,
  `nombre_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefono_cliente` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `id_categoria` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tipo` enum('estandar','personalizable') DEFAULT 'estandar',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `id_categoria`, `imagen`, `tipo`, `activo`) VALUES
(1, 'Taza Simple', 'Taza de cerámica blanca lista para personalizar.', 1500.00, 20, 1, 'http://localhost/puntoar/public/images/tazab.jpg', 'personalizable', 1),
(2, 'Remera Lisa', 'Remera de algodón lista para estampar.', 3500.00, 15, 2, 'http://localhost/puntoar/public/images/remerab.jpg', 'personalizable', 1),
(3, 'Llavero', 'Llavero metálico personalizable.', 800.00, 30, 3, 'http://localhost/puntoar/public/images/llaverob.png', 'personalizable', 1),
(4, 'Buzo Hoodie', 'Buzo con capucha personalizable.', 5000.00, 10, 2, 'http://localhost/puntoar/public/images/buzob.jpg', 'personalizable', 1),
(5, 'Vaso Térmico', 'Vaso térmico de acero inoxidable, ideal para mantener la temperatura.', 2200.00, 12, 4, 'http://localhost/puntoar/public/images/vasob.jpg', 'personalizable', 1),
(6, 'Gorra Malla', 'Gorra estilo trucker con malla, personalizable.', 1800.00, 20, 5, 'http://localhost/puntoar/public/images/gorrab.jpg', 'personalizable', 1),
(7, 'Taza Appa', 'Taza mágica con diseño de Appa.', 2500.00, 10, 6, 'http://localhost/puntoar/public/images/taza1.jpg', 'estandar', 1),
(8, 'Taza Stitch', 'Taza mágica con diseño de Stitch.', 2500.00, 10, 6, 'http://localhost/puntoar/public/images/taza2.jpg', 'estandar', 1),
(9, 'Taza Vegeta', 'Taza mágica con diseño de Vegeta.', 2500.00, 10, 6, 'http://localhost/puntoar/public/images/taza3.jpg', 'estandar', 1),
(10, 'Taza Ghibli', 'Taza mágica con diseño Studio Ghibli.', 2500.00, 10, 6, 'http://localhost/puntoar/public/images/taza4.jpg', 'estandar', 1),
(11, 'Taza Manga', 'Taza mágica con diseño de manga.', 2500.00, 10, 6, 'http://localhost/puntoar/public/images/taza5.jpg', 'estandar', 1),
(12, 'Taza Mágica', 'Taza mágica negra que revela el diseño con calor.', 2700.00, 10, 6, 'http://localhost/puntoar/public/images/taza6.jpeg', 'estandar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `rol` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `clave`, `telefono`, `rol`) VALUES
(1, 'Ramiro Gabriel', 'cavagol10@gmail.com', '$2y$10$k4OuwVJRGoY5ryivnG7aOOm07woWZC7eDe4mpmBU/7KMc.P9UTgVe', NULL, 'cliente'),
(2, 'sandro', 'panchito777@gmail.com', '$2y$10$/hfprl.zSKeCtAxff6PhE.r9MHamFUTLIVOA8s0o2RWvftJrnrWuW', 2147483647, 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id_combo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `pedidodetalle`
--
ALTER TABLE `pedidodetalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `id_combo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidodetalle`
--
ALTER TABLE `pedidodetalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `combos`
--
ALTER TABLE `combos`
  ADD CONSTRAINT `combos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidodetalle`
--
ALTER TABLE `pedidodetalle`
  ADD CONSTRAINT `pedidodetalle_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidodetalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
