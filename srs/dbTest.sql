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

-- Volcando estructura para tabla flexografia.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `Password` varchar(50) DEFAULT '',
  KEY `Primary key` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.clientes: ~0 rows (aproximadamente)

-- Volcando estructura para tabla flexografia.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `img_url` varchar(100) DEFAULT NULL,
  `precio` int DEFAULT NULL,
  `activo` int DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.products: ~2 rows (aproximadamente)
INSERT INTO `products` (`id_product`, `nombre`, `descripcion`, `img_url`, `precio`, `activo`) VALUES
	(1, 'Angel', 'sadasdasdas', NULL, 10, 1),
	(2, 'Josue', 'Sobrino del rector de la universidad', NULL, 1, 1),
	(12, 'Jesus ', 'Project Manager and Backend Dev', NULL, 333, 1),
	(13, 'Andres', 'ddsadassadsadd sadsad sad sadsadsadasd', NULL, 22, 1);

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
  `id` int NOT NULL,
  `correo` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `activacion` int NOT NULL DEFAULT '0',
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password_request` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL DEFAULT '0',
  KEY `Primary key` (`id`),
  KEY `Foreign Key` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla flexografia.usuarios: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
