-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para flexografia
CREATE DATABASE IF NOT EXISTS `flexografia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `flexografia`;

-- Volcando estructura para tabla flexografia.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token_password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password_request` tinyint NOT NULL DEFAULT '0',
  `activo` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL,
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.admin: ~0 rows (aproximadamente)
INSERT INTO `admin` (`id`, `usuario`, `password`, `nombre`, `correo`, `token_password`, `password_request`, `activo`, `fecha_alta`) VALUES
	(1, 'admin', '$2y$10$utL0QYa/qG469FuEUMmmK./ZwNAoFJlCuuMs/Cm6YAA7NfXygmiBq', 'Administrador', 'contacto@23publicidad.mx', NULL, 0, 1, '2024-03-20 18:07:09');

-- Volcando estructura para tabla flexografia.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `activo` int DEFAULT NULL,
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.categorias: ~0 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
	(1, 'Flexible', 1);

-- Volcando estructura para tabla flexografia.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  KEY `Primary key` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.clientes: ~3 rows (aproximadamente)
INSERT INTO `clientes` (`Id`, `nombre`, `email`) VALUES
	(22, 'Jesus', 'alberto.lopez.isw@unipolidgo.edu.mx'),
	(23, 'Jesus', 'angel.solis.isw@unipolidgo.edu.mx'),
	(25, 'Angel', 'angel.solis.isw@unipolidgo.edu.mx');

-- Volcando estructura para tabla flexografia.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `valor` tinytext NOT NULL,
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.configuracion: ~5 rows (aproximadamente)
INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
	(1, 'tienda_nombre', '23 Publicidad'),
	(2, 'correo_email', 'nopalnode@gmail.com     '),
	(3, 'correo_SMTP', 'smtp.gmail.com'),
	(4, 'correo_password', 'uSF1RwAJS+OpSxzydkkDEg==:tbepiwy1MRpK5AyOfeka9L0ix9TSFgRuIing9LA5p/ajH7lhedx1YF2+/Xuj7NAB1yI8G7NZuPyCoKeBaIYayg=='),
	(5, 'correo_puerto', '435');

-- Volcando estructura para tabla flexografia.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_cliente` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.pedido: ~0 rows (aproximadamente)
INSERT INTO `pedido` (`id_pedido`, `id_producto`, `id_cliente`, `cantidad`, `precio`, `fecha_pedido`) VALUES
	(1, 3, 22, 1, 333.00, '2024-03-22 21:39:41');

-- Volcando estructura para tabla flexografia.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `img_url` varchar(100) DEFAULT NULL,
  `precio` int DEFAULT NULL,
  `activo` int DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.products: ~7 rows (aproximadamente)
INSERT INTO `products` (`id_product`, `nombre`, `descripcion`, `img_url`, `precio`, `activo`) VALUES
	(1, 'Etiqueta Flexible Circular', 'Etiqueta versátil y duradera, perfecta para cualquier envase curvo. Fácil de aplicar y con un diseño elegante para resaltar tus productos.', NULL, 10, 1),
	(2, 'Etiqueta Flexible Cuadrada', 'Etiqueta flexible y resistente, diseñada para adaptarse a envases cuadrados con facilidad. Su aplicación es sencilla y su diseño elegante realza la presentación de tus productos de manera destacada.', NULL, 1, 1),
	(3, 'Etiqueta Flexible Ovalada', '<p>kasjhasdhaksjd &nbsp;kasjkalsd lkasmdlkasjdlak alksdlaksjdlaksd alskdña</p>', NULL, 14, 1),
	(4, 'Etiqueta Flexible Redondeada', 'Etiqueta versátil y resistente con bordes redondeados para adaptarse a envases curvos o con esquinas suaves. Fácil de aplicar y con un diseño elegante que realza la presentación de tus productos de manera llamativa.', NULL, 22, 1),
	(5, 'Andres', 'dsadasdhjvhjbdasjvbds', NULL, 10, 1),
	(6, 'Etiqueta Circular Flexible', 'Etiqueta personalizada de forma circular ', NULL, 5, 1),
	(17, 'Octavio', 'Photograph of my main profile', NULL, 10, 1),
	(18, 'Ama', '<p>claro k si</p>', NULL, 80, 1);

-- Volcando estructura para tabla flexografia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `nombre`, `correo`, `contrasena`, `type`) VALUES
	(1, 'Jesus', 'alberto.lopez.isw@unipolidgo.edu.mx', 'jesus123', 'normal'),
	(2, 'Alberto', 'hola@gmail.com', 'alberto123', 'admin');

-- Volcando estructura para tabla flexografia.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `activacion` int NOT NULL DEFAULT '0',
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password_request` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL DEFAULT '0',
  KEY `Primary key` (`id`),
  KEY `Foreign Key` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `correo`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
	(19, 'alberto.lopez.isw@unipolidgo.edu.mx', '$2y$10$WJ84VMq0hDWO3rBqRx1dqOfJjdYDb8jd3l2xeLTfyhR9XU3nasZ7e', 1, '', NULL, 0, 22),
	(21, 'solis_angelzr1@outlook.com', '$2y$10$9D7r0Qko738jlisSq1f3Ou5vrDfIukGW9pKrqKPjv2FBgLF3hFB7K', 1, '79aecdcd1d603859d834f5d90f3fbf52', NULL, 0, 24),
	(22, 'angel.solis.isw@unipolidgo.edu.mx', '$2y$10$Ir2Tq7WSswjhCYaOQKWoCevMTTx0NefzV0neyVhX2ui/6ewLZT6p.', 1, '792b899a07fa5d595a5ead8c75174f72', NULL, 0, 25);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
