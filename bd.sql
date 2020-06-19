-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.19 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para chileworkads
CREATE DATABASE IF NOT EXISTS `chileworkads` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `chileworkads`;

-- Volcando estructura para tabla chileworkads.ciudad
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id_ciudad` bigint NOT NULL AUTO_INCREMENT,
  `comuna_id` bigint NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.ciudad: ~0 rows (aproximadamente)
DELETE FROM `ciudad`;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.comuna
CREATE TABLE IF NOT EXISTS `comuna` (
  `id_comuna` bigint NOT NULL AUTO_INCREMENT,
  `region_id` bigint NOT NULL,
  `nombre_comuna` varchar(50) NOT NULL,
  PRIMARY KEY (`id_comuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.comuna: ~0 rows (aproximadamente)
DELETE FROM `comuna`;
/*!40000 ALTER TABLE `comuna` DISABLE KEYS */;
/*!40000 ALTER TABLE `comuna` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.oficio
CREATE TABLE IF NOT EXISTS `oficio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oficio_nombre` varchar(50) NOT NULL,
  `oficio_icon` text,
  `categoria` varchar(50) DEFAULT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.oficio: ~0 rows (aproximadamente)
DELETE FROM `oficio`;
/*!40000 ALTER TABLE `oficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `oficio` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `rut` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nombres` varchar(50) NOT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `file_cv` text,
  `foto_file` text,
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `tipo_user` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1, usuario que puede agregar favoritos y comentar, 2 usuario que ofrece trabajo, 3 admin',
  `enable` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0, usuario no habilitado, 1 usario creado esperando confirmacion email, 2 usuaro habilitado',
  `borrado` datetime DEFAULT NULL,
  `id_poblacion` bigint DEFAULT NULL,
  `cookie` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='datos de los usuarios, independiente del tipo';

-- Volcando datos para la tabla chileworkads.persona: ~0 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona_contacto
CREATE TABLE IF NOT EXISTS `persona_contacto` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `persona_id` bigint NOT NULL,
  `red_id` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.persona_contacto: ~0 rows (aproximadamente)
DELETE FROM `persona_contacto`;
/*!40000 ALTER TABLE `persona_contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `persona_contacto` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona_oficio
CREATE TABLE IF NOT EXISTS `persona_oficio` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `persona_id` bigint NOT NULL,
  `oficio_id` bigint NOT NULL,
  `experiencia` float NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.persona_oficio: ~0 rows (aproximadamente)
DELETE FROM `persona_oficio`;
/*!40000 ALTER TABLE `persona_oficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `persona_oficio` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.poblacion
CREATE TABLE IF NOT EXISTS `poblacion` (
  `id_poblacion` bigint NOT NULL AUTO_INCREMENT,
  `ciudad_id` bigint NOT NULL,
  `nombre_poblacion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_poblacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.poblacion: ~0 rows (aproximadamente)
DELETE FROM `poblacion`;
/*!40000 ALTER TABLE `poblacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `poblacion` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.region
CREATE TABLE IF NOT EXISTS `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_region` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.region: ~0 rows (aproximadamente)
DELETE FROM `region`;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.resena
CREATE TABLE IF NOT EXISTS `resena` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `trabajador_id` bigint NOT NULL DEFAULT '0',
  `quien_resena_id` bigint NOT NULL DEFAULT '0',
  `texto` text,
  `fecha` datetime NOT NULL,
  `evaluacion` float NOT NULL DEFAULT '0',
  `enable` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.resena: ~0 rows (aproximadamente)
DELETE FROM `resena`;
/*!40000 ALTER TABLE `resena` DISABLE KEYS */;
/*!40000 ALTER TABLE `resena` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.tipo_contacto
CREATE TABLE IF NOT EXISTS `tipo_contacto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_red` varchar(50) NOT NULL,
  `url_red` varchar(50) NOT NULL,
  `icono_red` varchar(50) NOT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.tipo_contacto: ~2 rows (aproximadamente)
DELETE FROM `tipo_contacto`;
/*!40000 ALTER TABLE `tipo_contacto` DISABLE KEYS */;
INSERT INTO `tipo_contacto` (`id`, `nombre_red`, `url_red`, `icono_red`, `enable`, `borrado`) VALUES
	(1, 'Teléfono', 'tel:', 'phone.ico', 1, NULL),
	(2, 'Facebook', 'https://www.facebook.com/', 'facebook.ico', 1, NULL),
	(3, 'Whatsapp', 'https://wa.me/', 'whatsapp.ico', 1, NULL),
	(4, 'Email', 'mailto:', 'email.ico', 1, NULL);
/*!40000 ALTER TABLE `tipo_contacto` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.trabajo_imagen
CREATE TABLE IF NOT EXISTS `trabajo_imagen` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `trabajo_id` bigint NOT NULL,
  `foto_archivo` text NOT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.trabajo_imagen: ~0 rows (aproximadamente)
DELETE FROM `trabajo_imagen`;
/*!40000 ALTER TABLE `trabajo_imagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabajo_imagen` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.trabajo_realizado
CREATE TABLE IF NOT EXISTS `trabajo_realizado` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_trabajador` bigint NOT NULL,
  `id_persona` bigint NOT NULL,
  `descripcion` text,
  `fecha` datetime NOT NULL,
  `evaluacion` float NOT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.trabajo_realizado: ~0 rows (aproximadamente)
DELETE FROM `trabajo_realizado`;
/*!40000 ALTER TABLE `trabajo_realizado` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabajo_realizado` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
