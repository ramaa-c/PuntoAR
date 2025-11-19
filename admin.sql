-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 20:16:55
-- Versión del servidor: 10.4.32-MariaDB-log
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
-- Estructura de tabla para la tabla `banners_carrusel`
--

CREATE TABLE `banners_carrusel` (
  `id` int(11) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banners_carrusel`
--

INSERT INTO `banners_carrusel` (`id`, `ruta_imagen`, `titulo`, `enlace`, `orden`) VALUES
(1, 'uploads/banners/1762943553_e0e0764d2f9bf275bfb0.png', NULL, NULL, 1),
(3, 'uploads/banners/1762947047_9213d8ae44bad19a298c.png', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel_productos`
--

CREATE TABLE `carrusel_productos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `tipo` enum('estandar','personalizable') DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  `limite` int(11) NOT NULL DEFAULT 8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrusel_productos`
--

INSERT INTO `carrusel_productos` (`id`, `titulo`, `id_categoria`, `tipo`, `orden`, `limite`) VALUES
(10, 'todito', 0, '', 6, 50),
(14, 'Nuestras Tazas', 1, '', 7, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Tazas', 'Artículos de cerámica personalizables.'),
(2, 'Indumentaria', 'Ropa de algodón y otros textiles para estampar.'),
(3, 'Accesorios', 'Llaveros, pines y otros pequeños artículos.'),
(4, 'Termos', 'termos sublimables'),
(5, 'Gorras', 'gorras de red ddd'),
(6, 'Tazas Mágicas', 'tazas que cambian '),
(8, 'Combos', 'Combo de productos');

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
  `detalleImagen` varchar(500) DEFAULT NULL,
  `imagen_personalizada` tinyint(1) NOT NULL DEFAULT 0,
  `nombre_producto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidodetalle`
--

INSERT INTO `pedidodetalle` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `especificaciones`, `precio_unitario`, `detalleImagen`, `imagen_personalizada`, `nombre_producto`) VALUES
(29, 8, 18, 1, '', 50.00, NULL, 0, NULL),
(30, 8, 21, 2, '', 434.00, NULL, 0, NULL),
(31, 8, 22, 1, '', 434.00, NULL, 0, NULL),
(32, 8, 27, 1, '', 343.00, NULL, 0, NULL),
(33, 8, 30, 2, '', 212.00, NULL, 0, NULL),
(34, 8, 23, 1, '', 343.00, NULL, 0, NULL),
(35, 8, 29, 1, 'quiero q sea toda negra', 232.00, 'uploads/pedidos/1763106429_b2083429c8b35465e913.png', 0, NULL),
(36, 8, 28, 1, '', 3423.00, NULL, 0, NULL),
(37, 9, 18, 1, '', 50.00, NULL, 0, NULL),
(38, 9, 21, 2, 'dasdasdasd', 434.00, NULL, 0, NULL),
(39, 9, 22, 1, '', 434.00, NULL, 0, NULL),
(40, 9, 27, 1, '', 343.00, NULL, 0, NULL),
(41, 9, 30, 2, '', 212.00, NULL, 0, NULL),
(42, 9, 23, 1, 'sadas', 343.00, NULL, 0, NULL),
(43, 9, 29, 1, 'quiero coso', 232.00, 'uploads/pedidos/1763106629_5f5b6a7d3f586ef47ef2.png', 0, NULL),
(44, 9, 28, 1, '', 3423.00, NULL, 0, NULL),
(45, 10, 18, 1, '', 50.00, NULL, 0, NULL),
(46, 10, 21, 2, '', 434.00, NULL, 0, NULL),
(47, 10, 22, 1, '', 434.00, NULL, 0, NULL),
(48, 10, 27, 1, '', 343.00, NULL, 0, NULL),
(49, 10, 30, 2, '', 212.00, NULL, 0, NULL),
(50, 10, 23, 1, '', 343.00, NULL, 0, NULL),
(51, 10, 29, 1, '', 232.00, 'uploads/pedidos/1763130365_d33f576058c41529e210.png', 0, NULL),
(52, 10, 28, 1, '', 3423.00, NULL, 0, NULL),
(53, 11, 18, 1, '', 50.00, NULL, 0, NULL),
(54, 11, 21, 2, '', 434.00, NULL, 0, NULL),
(55, 11, 22, 1, '', 434.00, NULL, 0, NULL),
(56, 11, 27, 1, '', 343.00, NULL, 0, NULL),
(57, 11, 30, 2, '', 212.00, NULL, 0, NULL),
(58, 11, 23, 1, '', 343.00, NULL, 0, NULL),
(59, 11, 29, 1, '', 232.00, 'uploads/pedidos/1763133671_397e6e853ef206e2abc1.png', 0, NULL),
(60, 11, 28, 1, '', 3423.00, NULL, 0, NULL),
(61, 12, 18, 1, '', 50.00, NULL, 0, NULL),
(62, 12, 21, 2, '', 434.00, NULL, 0, NULL),
(63, 12, 22, 1, '', 434.00, NULL, 0, NULL),
(64, 12, 27, 1, '', 343.00, NULL, 0, NULL),
(65, 12, 30, 2, '', 212.00, NULL, 0, NULL),
(66, 12, 23, 1, '', 343.00, NULL, 0, NULL),
(67, 12, 29, 1, '', 232.00, NULL, 0, NULL),
(68, 12, 28, 1, '', 3423.00, NULL, 0, NULL),
(69, 13, 18, 1, '', 50.00, NULL, 0, NULL),
(70, 13, 21, 2, '', 434.00, NULL, 0, NULL),
(71, 13, 22, 1, '', 434.00, NULL, 0, NULL),
(72, 13, 27, 1, '', 343.00, NULL, 0, NULL),
(73, 13, 30, 2, '', 212.00, NULL, 0, NULL),
(74, 13, 23, 1, '', 343.00, NULL, 0, NULL),
(75, 13, 29, 1, '', 232.00, NULL, 0, NULL),
(76, 13, 28, 1, '', 3423.00, NULL, 0, NULL),
(77, 14, 18, 1, 'sadasd', 50.00, NULL, 0, NULL),
(78, 14, 21, 2, 'sadsa', 434.00, NULL, 0, NULL),
(79, 14, 22, 1, 'aaaaaaa', 434.00, NULL, 0, NULL),
(80, 14, 27, 1, '', 343.00, NULL, 0, NULL),
(81, 14, 30, 2, '', 212.00, NULL, 0, NULL),
(82, 14, 23, 1, '', 343.00, NULL, 0, NULL),
(83, 14, 29, 1, 'aaa', 232.00, NULL, 0, NULL),
(84, 14, 28, 1, '', 3423.00, NULL, 0, NULL),
(85, 15, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, NULL),
(86, 15, 21, 2, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, NULL),
(87, 15, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, NULL),
(88, 15, 27, 1, '', 343.00, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 0, NULL),
(89, 15, 30, 2, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, NULL),
(90, 15, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, NULL),
(91, 15, 29, 1, '', 232.00, 'uploads/pedidos/1763134867_1a62e0e521ac5dfa242d.png', 0, NULL),
(92, 15, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, NULL),
(93, 16, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(94, 16, 21, 2, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(95, 16, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, 'taza 5'),
(96, 16, 27, 1, '', 343.00, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 0, 'gorra 4'),
(97, 16, 30, 2, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(98, 16, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(99, 16, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(100, 16, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(101, 17, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(102, 17, 21, 2, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(103, 17, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, 'taza 5'),
(104, 17, 27, 1, '', 343.00, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 0, 'gorra 4'),
(105, 17, 30, 2, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(106, 17, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(107, 17, 29, 1, '', 232.00, 'uploads/pedidos/1763136495_143af2902c0f12ac505b.png', 0, 'gorra 6'),
(108, 17, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(109, 18, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(110, 18, 21, 2, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(111, 18, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, 'taza 5'),
(112, 18, 27, 1, '', 343.00, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 0, 'gorra 4'),
(113, 18, 30, 2, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(114, 18, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(115, 18, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(116, 18, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(117, 19, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(118, 19, 29, 1, '', 232.00, 'uploads/pedidos/1763138294_59f917b216d20de421b5.png', 1, 'gorra 6'),
(119, 19, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(120, 19, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(121, 19, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(122, 19, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(123, 20, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(124, 20, 29, 1, '', 232.00, 'uploads/pedidos/1763139026_a9f6d93c36f5bd41c215.png', 1, 'gorra 6'),
(125, 20, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(126, 20, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(127, 20, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(128, 20, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(129, 21, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(130, 21, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(131, 21, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(132, 21, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(133, 21, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(134, 21, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(135, 21, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(136, 22, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(137, 22, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(138, 22, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(139, 22, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(140, 22, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(141, 22, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(142, 22, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(143, 23, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(144, 23, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(145, 23, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(146, 23, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(147, 23, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(148, 23, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(149, 23, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(150, 24, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(151, 24, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(152, 24, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(153, 24, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(154, 24, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(155, 24, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(156, 24, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(157, 25, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(158, 25, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(159, 25, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(160, 25, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(161, 25, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(162, 25, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(163, 25, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(164, 26, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(165, 26, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(166, 26, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(167, 26, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(168, 26, 20, 2, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(169, 26, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(170, 26, 31, 4, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(171, 27, 20, 1, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(172, 27, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(173, 27, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(174, 27, 31, 1, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(175, 27, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(176, 27, 29, 1, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6'),
(177, 28, 31, 1, '', 0.00, 'uploads/pedidos/1763389514_9ccc9177828fac8dc692.png', 1, 'prueba '),
(178, 28, 30, 2, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(179, 28, 29, 1, '', 232.00, 'uploads/pedidos/1763389514_083fced1b38ef28201cb.jpeg', 1, 'gorra 6'),
(180, 28, 28, 1, '', 3423.00, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 0, 'gorra 5'),
(181, 28, 27, 1, '', 343.00, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 0, 'gorra 4'),
(182, 28, 26, 1, '', 3432.00, 'uploads/productos/1762843315_5d8826721f7cbf3f77df.jpg', 0, 'gorra 3'),
(183, 29, 31, 1, '', 0.00, 'uploads/pedidos/1763389743_09dae9c5efb002f1d871.png', 1, 'prueba '),
(184, 29, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(185, 29, 29, 1, '', 232.00, 'uploads/pedidos/1763389743_f32683a95bef1781d72a.jpg', 1, 'gorra 6'),
(186, 29, 23, 1, '', 343.00, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 0, 'taza 6'),
(187, 29, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(188, 29, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(189, 30, 30, 3, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(190, 30, 20, 1, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(191, 30, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, 'taza 5'),
(192, 30, 21, 1, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(193, 31, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(194, 31, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(195, 31, 20, 1, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(196, 32, 18, 1, '', 50.00, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 0, 'taza 1'),
(197, 32, 19, 1, '', 323.00, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 0, 'taza 2'),
(198, 32, 20, 1, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(199, 32, 21, 1, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(200, 33, 22, 1, '', 434.00, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 0, 'taza 5'),
(201, 33, 21, 1, '', 434.00, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 0, 'taza 4'),
(202, 33, 20, 1, '', 434.00, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 0, 'taza 3'),
(203, 33, 31, 1, '', 0.00, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 0, 'prueba '),
(204, 33, 30, 1, '', 212.00, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 0, 'taza appa'),
(205, 33, 29, 2, '', 232.00, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 0, 'gorra 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','en_proceso','finalizado','cancelado') DEFAULT 'pendiente',
  `nombre_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefono_cliente` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha`, `estado`, `nombre_cliente`, `email_cliente`, `telefono_cliente`, `total`) VALUES
(1, 2, '2025-10-02 07:32:21', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(2, 2, '2025-10-02 07:35:27', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(3, 2, '2025-10-02 07:41:16', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(4, 2, '2025-10-02 07:45:01', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(5, 2, '2025-10-02 07:45:31', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(6, 2, '2025-10-02 07:51:45', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(7, 2, '2025-10-02 07:52:21', 'pendiente', NULL, 'panchito777@gmail.com', NULL, 0.00),
(8, NULL, '2025-11-14 04:47:09', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(9, NULL, '2025-11-14 04:50:29', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(10, NULL, '2025-11-14 11:26:05', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(11, NULL, '2025-11-14 12:21:11', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(12, NULL, '2025-11-14 12:26:58', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(13, NULL, '2025-11-14 12:29:15', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(14, NULL, '2025-11-14 12:30:12', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(15, NULL, '2025-11-14 12:41:07', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(16, NULL, '2025-11-14 12:47:54', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(17, NULL, '2025-11-14 13:08:15', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(18, NULL, '2025-11-14 13:09:00', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 6117.00),
(19, NULL, '2025-11-14 13:38:14', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(20, NULL, '2025-11-14 13:50:26', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(21, NULL, '2025-11-17 11:01:46', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(22, NULL, '2025-11-17 11:11:55', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(23, NULL, '2025-11-17 11:13:19', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', '2665114075', 5401.00),
(24, NULL, '2025-11-17 11:14:41', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(25, NULL, '2025-11-17 11:17:53', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(26, NULL, '2025-11-17 11:21:32', 'pendiente', 'ramadel', 'ramirocaceres.240@gmail.com', NULL, 5401.00),
(27, NULL, '2025-11-17 11:23:39', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 1251.00),
(28, NULL, '2025-11-17 11:25:14', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 7854.00),
(29, NULL, '2025-11-17 11:29:03', 'pendiente', 'ramadel', 'ramirocaceres.240@gmail.com', NULL, 1160.00),
(30, NULL, '2025-11-17 11:40:09', 'pendiente', 'ramadel', 'ramirocaceres.240@gmail.com', NULL, 1938.00),
(31, NULL, '2025-11-17 11:41:33', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 807.00),
(32, NULL, '2025-11-17 11:43:43', 'pendiente', 'ramadel', 'ramirocaceres.240@gmail.com', NULL, 1241.00),
(33, NULL, '2025-11-17 11:50:57', 'pendiente', 'ramiro', 'ramirocaceres.240@gmail.com', NULL, 1978.00);

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
(18, 'taza 1', 'taza de prueba 1', 50.00, 12, 1, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 'estandar', 1),
(19, 'taza 2', 'taza de prueba 2', 323.00, 2, 1, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 'estandar', 1),
(20, 'taza 3', 'taza de prueba 3', 434.00, 3, 1, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 'estandar', 1),
(21, 'taza 4', 'taza de prueba 4', 434.00, 22, 1, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 'estandar', 1),
(22, 'taza 5', 'taza de prueba 5', 434.00, 22, 1, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 'estandar', 1),
(23, 'taza 6', 'taza de prueba 6', 343.00, 3, 1, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 'estandar', 1),
(24, 'gorra 1', 'gorra de prueba 1', 34.00, 233, 5, 'uploads/productos/1762843266_3f1f1fee1fe3e25b861a.jpg', 'estandar', 1),
(25, 'gorra 2', 'gorra de prueba 2', 32.00, 543, 5, 'uploads/productos/1762843289_cb1353759adf94a7b8e6.jpg', 'estandar', 1),
(26, 'gorra 3', 'gorra de prueba 3', 3432.00, 44, 5, 'uploads/productos/1762843315_5d8826721f7cbf3f77df.jpg', 'estandar', 1),
(27, 'gorra 4', 'gorra de prueba 4', 343.00, 23, 5, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 'estandar', 1),
(28, 'gorra 5', 'gorra de prueba 5', 3423.00, 32, 5, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 'estandar', 1),
(29, 'gorra 6', 'gorra de prueba 6', 232.00, 2, 5, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 'personalizable', 1),
(30, 'taza appa', 'taza sublimada', 212.00, 1212, 1, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 'estandar', 1),
(31, 'prueba ', 'ppppp', NULL, NULL, 2, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 'personalizable', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id`, `id_producto`, `ruta_imagen`, `orden`) VALUES
(43, 18, 'uploads/productos/1762839923_061f7b297dbfb53282ef.jpg', 1),
(44, 19, 'uploads/productos/1762839955_0a3427bd9d899bed018c.jpg', 1),
(45, 20, 'uploads/productos/1762839990_9c6289df52a7375283e0.jpg', 1),
(46, 21, 'uploads/productos/1762840010_b68980d0cd0fbdfbbea3.jpg', 1),
(47, 22, 'uploads/productos/1762840030_ce351ab6021717f03adf.jpg', 1),
(48, 23, 'uploads/productos/1762840047_a593580374af0720aca5.jpg', 1),
(49, 24, 'uploads/productos/1762843266_3f1f1fee1fe3e25b861a.jpg', 1),
(50, 25, 'uploads/productos/1762843289_cb1353759adf94a7b8e6.jpg', 1),
(51, 26, 'uploads/productos/1762843315_5d8826721f7cbf3f77df.jpg', 1),
(52, 27, 'uploads/productos/1762843337_3d557dc5ef9bcde50b83.jpg', 1),
(53, 28, 'uploads/productos/1762843362_66e700f770fce7086721.jpg', 1),
(54, 29, 'uploads/productos/1762843405_0c5ca87e1f57c51ee1cf.jpg', 1),
(55, 18, 'uploads/productos/1762943265_bd79a01cf16538790872.jpg', 2),
(56, 18, 'uploads/productos/1762946559_e2f7407a124da1178eb5.jpg', 3),
(57, 30, 'uploads/productos/1763013231_403a178999ed4f33bb9f.jpg', 1),
(58, 30, 'uploads/productos/1763013231_0056f350573e127f4de7.jpeg', 2),
(59, 30, 'uploads/productos/1763013231_6a76fb00efbd0f471430.jpg', 3),
(60, 31, 'uploads/productos/1763377625_21261e1a2059ed594acb.png', 1);

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
(2, 'Francisco Sangayo', 'panchito777@gmail.com', '$2y$10$/hfprl.zSKeCtAxff6PhE.r9MHamFUTLIVOA8s0o2RWvftJrnrWuW', 2147483647, 'cliente'),
(5, 'Administrador', 'puntoar.contact@gmail.com', '$2y$10$/aMFigWDMivA5Y947vzMK.Y7XH1Rdua1owUAevI6u/lRaFdF.heF2', 0, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners_carrusel`
--
ALTER TABLE `banners_carrusel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrusel_productos`
--
ALTER TABLE `carrusel_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

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
ALTER TABLE `productos` ADD FULLTEXT KEY `imagen` (`imagen`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

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
-- AUTO_INCREMENT de la tabla `banners_carrusel`
--
ALTER TABLE `banners_carrusel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carrusel_productos`
--
ALTER TABLE `carrusel_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidodetalle`
--
ALTER TABLE `pedidodetalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

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

--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `producto_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
