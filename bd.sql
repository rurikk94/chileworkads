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
DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id_ciudad` bigint NOT NULL AUTO_INCREMENT,
  `comuna_id` bigint NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL,
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.ciudad: ~4 rows (aproximadamente)
DELETE FROM `ciudad`;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` (`id_ciudad`, `comuna_id`, `nombre_ciudad`, `borrado`) VALUES
	(1, 81, 'Viña del Mar', NULL),
	(2, 79, 'Valparaíso', NULL),
	(3, 77, 'Quilpué', NULL),
	(4, 80, 'Villa Alemana', NULL);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.comuna
DROP TABLE IF EXISTS `comuna`;
CREATE TABLE IF NOT EXISTS `comuna` (
  `id_comuna` int NOT NULL AUTO_INCREMENT,
  `region_id` int NOT NULL,
  `nombre_comuna` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `provincia_id` int DEFAULT NULL,
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_comuna`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla chileworkads.comuna: 345 rows
DELETE FROM `comuna`;
/*!40000 ALTER TABLE `comuna` DISABLE KEYS */;
INSERT INTO `comuna` (`id_comuna`, `region_id`, `nombre_comuna`, `provincia_id`, `borrado`) VALUES
	(1, 1, 'Arica', 1, NULL),
	(2, 1, 'Camarones', 1, NULL),
	(3, 1, 'General Lagos', 2, NULL),
	(4, 1, 'Putre', 2, NULL),
	(5, 2, 'Alto Hospicio', 3, NULL),
	(6, 2, 'Iquique', 3, NULL),
	(7, 2, 'Camiña', 4, NULL),
	(8, 2, 'Colchane', 4, NULL),
	(9, 2, 'Huara', 4, NULL),
	(10, 2, 'Pica', 4, NULL),
	(11, 2, 'Pozo Almonte', 4, NULL),
	(12, 3, 'Antofagasta', 5, NULL),
	(13, 3, 'Mejillones', 5, NULL),
	(14, 2, 'Sierra Gorda', 5, NULL),
	(15, 3, 'Taltal', 5, NULL),
	(16, 3, 'Calama', 6, NULL),
	(17, 3, 'Ollague', 6, NULL),
	(18, 3, 'San Pedro de Atacama', 6, NULL),
	(19, 3, 'María Elena', 7, NULL),
	(20, 3, 'Tocopilla', 7, NULL),
	(21, 4, 'Chañaral', 8, NULL),
	(22, 4, 'Diego de Almagro', 8, NULL),
	(23, 4, 'Caldera', 9, NULL),
	(24, 4, 'Copiapó', 9, NULL),
	(25, 4, 'Tierra Amarilla', 9, NULL),
	(26, 4, 'Alto del Carmen', 10, NULL),
	(27, 4, 'Freirina', 10, NULL),
	(28, 4, 'Huasco', 10, NULL),
	(29, 4, 'Vallenar', 10, NULL),
	(30, 5, 'Canela', 11, NULL),
	(31, 5, 'Illapel', 11, NULL),
	(32, 5, 'Los Vilos', 11, NULL),
	(33, 5, 'Salamanca', 11, NULL),
	(34, 5, 'Andacollo', 12, NULL),
	(35, 5, 'Coquimbo', 12, NULL),
	(36, 5, 'La Higuera', 12, NULL),
	(37, 5, 'La Serena', 12, NULL),
	(38, 5, 'Paihuaco', 12, NULL),
	(39, 5, 'Vicuña', 12, NULL),
	(40, 5, 'Combarbalá', 13, NULL),
	(41, 5, 'Monte Patria', 13, NULL),
	(42, 5, 'Ovalle', 13, NULL),
	(43, 5, 'Punitaqui', 13, NULL),
	(44, 5, 'Río Hurtado', 13, NULL),
	(45, 6, 'Isla de Pascua', 14, NULL),
	(46, 6, 'Calle Larga', 15, NULL),
	(47, 6, 'Los Andes', 15, NULL),
	(48, 6, 'Rinconada', 15, NULL),
	(49, 6, 'San Esteban', 15, NULL),
	(50, 6, 'La Ligua', 16, NULL),
	(51, 6, 'Papudo', 16, NULL),
	(52, 6, 'Petorca', 16, NULL),
	(53, 6, 'Zapallar', 16, NULL),
	(54, 6, 'Hijuelas', 17, NULL),
	(55, 6, 'La Calera', 17, NULL),
	(56, 6, 'La Cruz', 17, NULL),
	(57, 6, 'Limache', 17, NULL),
	(58, 6, 'Nogales', 17, NULL),
	(59, 6, 'Olmué', 17, NULL),
	(60, 6, 'Quillota', 17, NULL),
	(61, 6, 'Algarrobo', 18, NULL),
	(62, 6, 'Cartagena', 18, NULL),
	(63, 6, 'El Quisco', 18, NULL),
	(64, 6, 'El Tabo', 18, NULL),
	(65, 6, 'San Antonio', 18, NULL),
	(66, 6, 'Santo Domingo', 18, NULL),
	(67, 6, 'Catemu', 19, NULL),
	(68, 6, 'Llaillay', 19, NULL),
	(69, 6, 'Panquehue', 19, NULL),
	(70, 6, 'Putaendo', 19, NULL),
	(71, 6, 'San Felipe', 19, NULL),
	(72, 6, 'Santa María', 19, NULL),
	(73, 6, 'Casablanca', 20, NULL),
	(74, 6, 'Concón', 20, NULL),
	(75, 6, 'Juan Fernández', 20, NULL),
	(76, 6, 'Puchuncaví', 20, NULL),
	(77, 6, 'Quilpué', 20, NULL),
	(78, 6, 'Quintero', 20, NULL),
	(79, 6, 'Valparaíso', 20, NULL),
	(80, 6, 'Villa Alemana', 20, NULL),
	(81, 6, 'Viña del Mar', 20, NULL),
	(82, 7, 'Colina', 21, NULL),
	(83, 7, 'Lampa', 21, NULL),
	(84, 7, 'Tiltil', 21, NULL),
	(85, 7, 'Pirque', 22, NULL),
	(86, 7, 'Puente Alto', 22, NULL),
	(87, 7, 'San José de Maipo', 22, NULL),
	(88, 7, 'Buin', 23, NULL),
	(89, 7, 'Calera de Tango', 23, NULL),
	(90, 7, 'Paine', 23, NULL),
	(91, 7, 'San Bernardo', 23, NULL),
	(92, 7, 'Alhué', 24, NULL),
	(93, 7, 'Curacaví', 24, NULL),
	(94, 7, 'María Pinto', 24, NULL),
	(95, 7, 'Melipilla', 24, NULL),
	(96, 7, 'San Pedro', 24, NULL),
	(97, 7, 'Cerrillos', 25, NULL),
	(98, 7, 'Cerro Navia', 25, NULL),
	(99, 7, 'Conchalí', 25, NULL),
	(100, 7, 'El Bosque', 25, NULL),
	(101, 7, 'Estación Central', 25, NULL),
	(102, 7, 'Huechuraba', 25, NULL),
	(103, 7, 'Independencia', 25, NULL),
	(104, 7, 'La Cisterna', 25, NULL),
	(105, 7, 'La Granja', 25, NULL),
	(106, 7, 'La Florida', 25, NULL),
	(107, 7, 'La Pintana', 25, NULL),
	(108, 7, 'La Reina', 25, NULL),
	(109, 7, 'Las Condes', 25, NULL),
	(110, 7, 'Lo Barnechea', 25, NULL),
	(111, 7, 'Lo Espejo', 25, NULL),
	(112, 7, 'Lo Prado', 25, NULL),
	(113, 7, 'Macul', 25, NULL),
	(114, 7, 'Maipú', 25, NULL),
	(115, 7, 'Ñuñoa', 25, NULL),
	(116, 7, 'Pedro Aguirre Cerda', 25, NULL),
	(117, 7, 'Peñalolén', 25, NULL),
	(118, 7, 'Providencia', 25, NULL),
	(119, 7, 'Pudahuel', 25, NULL),
	(120, 7, 'Quilicura', 25, NULL),
	(121, 7, 'Quinta Normal', 25, NULL),
	(122, 7, 'Recoleta', 25, NULL),
	(123, 7, 'Renca', 25, NULL),
	(124, 7, 'San Miguel', 25, NULL),
	(125, 7, 'San Joaquín', 25, NULL),
	(126, 7, 'San Ramón', 25, NULL),
	(127, 7, 'Santiago', 25, NULL),
	(128, 7, 'Vitacura', 25, NULL),
	(129, 7, 'El Monte', 26, NULL),
	(130, 7, 'Isla de Maipo', 26, NULL),
	(131, 7, 'Padre Hurtado', 26, NULL),
	(132, 7, 'Peñaflor', 26, NULL),
	(133, 7, 'Talagante', 26, NULL),
	(134, 8, 'Codegua', 27, NULL),
	(135, 8, 'Coínco', 27, NULL),
	(136, 8, 'Coltauco', 27, NULL),
	(137, 8, 'Doñihue', 27, NULL),
	(138, 8, 'Graneros', 27, NULL),
	(139, 8, 'Las Cabras', 27, NULL),
	(140, 8, 'Machalí', 27, NULL),
	(141, 8, 'Malloa', 27, NULL),
	(142, 8, 'Mostazal', 27, NULL),
	(143, 8, 'Olivar', 27, NULL),
	(144, 8, 'Peumo', 27, NULL),
	(145, 8, 'Pichidegua', 27, NULL),
	(146, 8, 'Quinta de Tilcoco', 27, NULL),
	(147, 8, 'Rancagua', 27, NULL),
	(148, 8, 'Rengo', 27, NULL),
	(149, 8, 'Requínoa', 27, NULL),
	(150, 8, 'San Vicente de Tagua Tagua', 27, NULL),
	(151, 8, 'La Estrella', 28, NULL),
	(152, 8, 'Litueche', 28, NULL),
	(153, 8, 'Marchihue', 28, NULL),
	(154, 8, 'Navidad', 28, NULL),
	(155, 8, 'Peredones', 28, NULL),
	(156, 8, 'Pichilemu', 28, NULL),
	(157, 8, 'Chépica', 29, NULL),
	(158, 8, 'Chimbarongo', 29, NULL),
	(159, 8, 'Lolol', 29, NULL),
	(160, 8, 'Nancagua', 29, NULL),
	(161, 8, 'Palmilla', 29, NULL),
	(162, 8, 'Peralillo', 29, NULL),
	(163, 8, 'Placilla', 29, NULL),
	(164, 8, 'Pumanque', 29, NULL),
	(165, 8, 'San Fernando', 29, NULL),
	(166, 8, 'Santa Cruz', 29, NULL),
	(167, 9, 'Cauquenes', 30, NULL),
	(168, 9, 'Chanco', 30, NULL),
	(169, 9, 'Pelluhue', 30, NULL),
	(170, 9, 'Curicó', 31, NULL),
	(171, 9, 'Hualañé', 31, NULL),
	(172, 9, 'Licantén', 31, NULL),
	(173, 9, 'Molina', 31, NULL),
	(174, 9, 'Rauco', 31, NULL),
	(175, 9, 'Romeral', 31, NULL),
	(176, 9, 'Sagrada Familia', 31, NULL),
	(177, 9, 'Teno', 31, NULL),
	(178, 9, 'Vichuquén', 31, NULL),
	(179, 9, 'Colbún', 32, NULL),
	(180, 9, 'Linares', 32, NULL),
	(181, 9, 'Longaví', 32, NULL),
	(182, 9, 'Parral', 32, NULL),
	(183, 9, 'Retiro', 32, NULL),
	(184, 9, 'San Javier', 32, NULL),
	(185, 9, 'Villa Alegre', 32, NULL),
	(186, 9, 'Yerbas Buenas', 32, NULL),
	(187, 9, 'Constitución', 33, NULL),
	(188, 9, 'Curepto', 33, NULL),
	(189, 9, 'Empedrado', 33, NULL),
	(190, 9, 'Maule', 33, NULL),
	(191, 9, 'Pelarco', 33, NULL),
	(192, 9, 'Pencahue', 33, NULL),
	(193, 9, 'Río Claro', 33, NULL),
	(194, 9, 'San Clemente', 33, NULL),
	(195, 9, 'San Rafael', 33, NULL),
	(196, 9, 'Talca', 33, NULL),
	(197, 10, 'Arauco', 34, NULL),
	(198, 10, 'Cañete', 34, NULL),
	(199, 10, 'Contulmo', 34, NULL),
	(200, 10, 'Curanilahue', 34, NULL),
	(201, 10, 'Lebu', 34, NULL),
	(202, 10, 'Los Álamos', 34, NULL),
	(203, 10, 'Tirúa', 34, NULL),
	(204, 10, 'Alto Biobío', 35, NULL),
	(205, 10, 'Antuco', 35, NULL),
	(206, 10, 'Cabrero', 35, NULL),
	(207, 10, 'Laja', 35, NULL),
	(208, 10, 'Los Ángeles', 35, NULL),
	(209, 10, 'Mulchén', 35, NULL),
	(210, 10, 'Nacimiento', 35, NULL),
	(211, 10, 'Negrete', 35, NULL),
	(212, 10, 'Quilaco', 35, NULL),
	(213, 10, 'Quilleco', 35, NULL),
	(214, 10, 'San Rosendo', 35, NULL),
	(215, 10, 'Santa Bárbara', 35, NULL),
	(216, 10, 'Tucapel', 35, NULL),
	(217, 10, 'Yumbel', 35, NULL),
	(218, 10, 'Chiguayante', 36, NULL),
	(219, 10, 'Concepción', 36, NULL),
	(220, 10, 'Coronel', 36, NULL),
	(221, 10, 'Florida', 36, NULL),
	(222, 10, 'Hualpén', 36, NULL),
	(223, 10, 'Hualqui', 36, NULL),
	(224, 10, 'Lota', 36, NULL),
	(225, 10, 'Penco', 36, NULL),
	(226, 10, 'San Pedro de La Paz', 36, NULL),
	(227, 10, 'Santa Juana', 36, NULL),
	(228, 10, 'Talcahuano', 36, NULL),
	(229, 10, 'Tomé', 36, NULL),
	(230, 10, 'Bulnes', 37, NULL),
	(231, 10, 'Chillán', 37, NULL),
	(232, 10, 'Chillán Viejo', 37, NULL),
	(233, 10, 'Cobquecura', 37, NULL),
	(234, 10, 'Coelemu', 37, NULL),
	(235, 10, 'Coihueco', 37, NULL),
	(236, 10, 'El Carmen', 37, NULL),
	(237, 10, 'Ninhue', 37, NULL),
	(238, 10, 'Ñiquen', 37, NULL),
	(239, 10, 'Pemuco', 37, NULL),
	(240, 10, 'Pinto', 37, NULL),
	(241, 10, 'Portezuelo', 37, NULL),
	(242, 10, 'Quillón', 37, NULL),
	(243, 10, 'Quirihue', 37, NULL),
	(244, 10, 'Ránquil', 37, NULL),
	(245, 10, 'San Carlos', 37, NULL),
	(246, 10, 'San Fabián', 37, NULL),
	(247, 10, 'San Ignacio', 37, NULL),
	(248, 10, 'San Nicolás', 37, NULL),
	(249, 10, 'Treguaco', 37, NULL),
	(250, 10, 'Yungay', 37, NULL),
	(251, 11, 'Carahue', 38, NULL),
	(252, 11, 'Cholchol', 38, NULL),
	(253, 11, 'Cunco', 38, NULL),
	(254, 11, 'Curarrehue', 38, NULL),
	(255, 11, 'Freire', 38, NULL),
	(256, 11, 'Galvarino', 38, NULL),
	(257, 11, 'Gorbea', 38, NULL),
	(258, 11, 'Lautaro', 38, NULL),
	(259, 11, 'Loncoche', 38, NULL),
	(260, 11, 'Melipeuco', 38, NULL),
	(261, 11, 'Nueva Imperial', 38, NULL),
	(262, 11, 'Padre Las Casas', 38, NULL),
	(263, 11, 'Perquenco', 38, NULL),
	(264, 11, 'Pitrufquén', 38, NULL),
	(265, 11, 'Pucón', 38, NULL),
	(266, 11, 'Saavedra', 38, NULL),
	(267, 11, 'Temuco', 38, NULL),
	(268, 11, 'Teodoro Schmidt', 38, NULL),
	(269, 11, 'Toltén', 38, NULL),
	(270, 11, 'Vilcún', 38, NULL),
	(271, 11, 'Villarrica', 38, NULL),
	(272, 11, 'Angol', 39, NULL),
	(273, 11, 'Collipulli', 39, NULL),
	(274, 11, 'Curacautín', 39, NULL),
	(275, 11, 'Ercilla', 39, NULL),
	(276, 11, 'Lonquimay', 39, NULL),
	(277, 11, 'Los Sauces', 39, NULL),
	(278, 11, 'Lumaco', 39, NULL),
	(279, 11, 'Purén', 39, NULL),
	(280, 11, 'Renaico', 39, NULL),
	(281, 11, 'Traiguén', 39, NULL),
	(282, 11, 'Victoria', 39, NULL),
	(283, 12, 'Corral', 40, NULL),
	(284, 12, 'Lanco', 40, NULL),
	(285, 12, 'Los Lagos', 40, NULL),
	(286, 12, 'Máfil', 40, NULL),
	(287, 12, 'Mariquina', 40, NULL),
	(288, 12, 'Paillaco', 40, NULL),
	(289, 12, 'Panguipulli', 40, NULL),
	(290, 12, 'Valdivia', 40, NULL),
	(291, 12, 'Futrono', 41, NULL),
	(292, 12, 'La Unión', 41, NULL),
	(293, 12, 'Lago Ranco', 41, NULL),
	(294, 12, 'Río Bueno', 41, NULL),
	(295, 13, 'Ancud', 42, NULL),
	(296, 13, 'Castro', 42, NULL),
	(297, 13, 'Chonchi', 42, NULL),
	(298, 13, 'Curaco de Vélez', 42, NULL),
	(299, 13, 'Dalcahue', 42, NULL),
	(300, 13, 'Puqueldón', 42, NULL),
	(301, 13, 'Queilén', 42, NULL),
	(302, 13, 'Quemchi', 42, NULL),
	(303, 13, 'Quellón', 42, NULL),
	(304, 13, 'Quinchao', 42, NULL),
	(305, 13, 'Calbuco', 43, NULL),
	(306, 13, 'Cochamó', 43, NULL),
	(307, 13, 'Fresia', 43, NULL),
	(308, 13, 'Frutillar', 43, NULL),
	(309, 13, 'Llanquihue', 43, NULL),
	(310, 13, 'Los Muermos', 43, NULL),
	(311, 13, 'Maullín', 43, NULL),
	(312, 13, 'Puerto Montt', 43, NULL),
	(313, 13, 'Puerto Varas', 43, NULL),
	(314, 13, 'Osorno', 44, NULL),
	(315, 13, 'Puero Octay', 44, NULL),
	(316, 13, 'Purranque', 44, NULL),
	(317, 13, 'Puyehue', 44, NULL),
	(318, 13, 'Río Negro', 44, NULL),
	(319, 13, 'San Juan de la Costa', 44, NULL),
	(320, 13, 'San Pablo', 44, NULL),
	(321, 13, 'Chaitén', 45, NULL),
	(322, 13, 'Futaleufú', 45, NULL),
	(323, 13, 'Hualaihué', 45, NULL),
	(324, 13, 'Palena', 45, NULL),
	(325, 14, 'Aisén', 46, NULL),
	(326, 14, 'Cisnes', 46, NULL),
	(327, 14, 'Guaitecas', 46, NULL),
	(328, 14, 'Cochrane', 47, NULL),
	(329, 14, 'O\'higgins', 47, NULL),
	(330, 14, 'Tortel', 47, NULL),
	(331, 14, 'Coihaique', 48, NULL),
	(332, 14, 'Lago Verde', 48, NULL),
	(333, 14, 'Chile Chico', 49, NULL),
	(334, 14, 'Río Ibáñez', 49, NULL),
	(335, 15, 'Antártica', 50, NULL),
	(336, 15, 'Cabo de Hornos', 50, NULL),
	(337, 15, 'Laguna Blanca', 51, NULL),
	(338, 15, 'Punta Arenas', 51, NULL),
	(339, 15, 'Río Verde', 51, NULL),
	(340, 15, 'San Gregorio', 51, NULL),
	(341, 15, 'Porvenir', 52, NULL),
	(342, 15, 'Primavera', 52, NULL),
	(343, 15, 'Timaukel', 52, NULL),
	(344, 15, 'Natales', 53, NULL),
	(345, 15, 'Torres del Paine', 53, NULL),
	(346, 7, 'comunita', NULL, '2020-06-20 19:48:41');
/*!40000 ALTER TABLE `comuna` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.oficio
DROP TABLE IF EXISTS `oficio`;
CREATE TABLE IF NOT EXISTS `oficio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oficio_nombre` varchar(50) NOT NULL,
  `oficio_icon` text,
  `categoria` varchar(50) DEFAULT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.oficio: ~5 rows (aproximadamente)
DELETE FROM `oficio`;
/*!40000 ALTER TABLE `oficio` DISABLE KEYS */;
INSERT INTO `oficio` (`id`, `oficio_nombre`, `oficio_icon`, `categoria`, `enable`) VALUES
	(1, 'Informático', '18537717dfcf0724bd0592e6f7f20b5b1592696599.png', 'IT', 0),
	(2, 'Soporte Ténico', 'soportetecnico.png', 'Reparaciones', 1),
	(3, 'Reparación Bicicletas', 'bicicletas.png', 'Reparaciones', 1),
	(4, 'Mecánico Autos', 'mecanico.png', 'Reparaciones', 1),
	(5, 'MataPaco', '37ab4c4f59b5fb17ae61737730cdaf101592695595.webp', 'paco', 0);
/*!40000 ALTER TABLE `oficio` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona
DROP TABLE IF EXISTS `persona`;
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
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipo_user` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1, usuario que puede agregar favoritos y comentar, 2 usuario que ofrece trabajo, 3 admin',
  `enable` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1' COMMENT '0, usuario no habilitado, 1 usario creado esperando confirmacion email, 2 usuaro habilitado',
  `borrado` datetime DEFAULT NULL,
  `id_poblacion` bigint DEFAULT NULL,
  `cookie` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='datos de los usuarios, independiente del tipo';

-- Volcando datos para la tabla chileworkads.persona: ~2 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`id`, `rut`, `nombres`, `genero`, `file_cv`, `foto_file`, `apellidos`, `fecha_nacimiento`, `correo`, `contrasena`, `tipo_user`, `enable`, `borrado`, `id_poblacion`, `cookie`) VALUES
	(3, NULL, 'Chillán', NULL, NULL, 'user.png', NULL, '1955-06-21', 'sergio94mora@gmail.com', '$2y$10$5s9d6KZoB4E1qwiArT/Xi.Jhn9GETM2iZMHI9bXiaY17Ti1n0VqT6', '3', '2', NULL, 3, NULL),
	(4, NULL, 'J', NULL, NULL, 'user.png', NULL, NULL, 'rurikk94@gmail.com', '$2y$10$SyJGZSQWK6D6l/pcdqxOkuRrsr603xI7KSgf8aAjoqLf47GEPnaxK', '1', '1', NULL, NULL, NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona_contacto
DROP TABLE IF EXISTS `persona_contacto`;
CREATE TABLE IF NOT EXISTS `persona_contacto` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `persona_id` bigint NOT NULL,
  `red_id` bigint NOT NULL,
  `valor` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.persona_contacto: ~0 rows (aproximadamente)
DELETE FROM `persona_contacto`;
/*!40000 ALTER TABLE `persona_contacto` DISABLE KEYS */;
INSERT INTO `persona_contacto` (`id`, `persona_id`, `red_id`, `valor`) VALUES
	(1, 3, 1, '979856221'),
	(2, 3, 2, 'rurikk94'),
	(3, 3, 3, '979856221'),
	(4, 3, 4, 'sergio94mora@gmail.com'),
	(5, 3, 5, 'rurikk94');
/*!40000 ALTER TABLE `persona_contacto` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.persona_oficio
DROP TABLE IF EXISTS `persona_oficio`;
CREATE TABLE IF NOT EXISTS `persona_oficio` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `persona_id` bigint NOT NULL,
  `oficio_id` bigint NOT NULL,
  `experiencia` float NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.persona_oficio: ~7 rows (aproximadamente)
DELETE FROM `persona_oficio`;
/*!40000 ALTER TABLE `persona_oficio` DISABLE KEYS */;
INSERT INTO `persona_oficio` (`id`, `persona_id`, `oficio_id`, `experiencia`, `detalle`) VALUES
	(1, 1, 1, 5, NULL),
	(2, 1, 1, 2, NULL),
	(3, 2, 2, 5, NULL),
	(4, 3, 3, 3, NULL),
	(5, 3, 2, 1, NULL),
	(6, 4, 3, 1, NULL),
	(7, 4, 2, 1, NULL);
/*!40000 ALTER TABLE `persona_oficio` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.poblacion
DROP TABLE IF EXISTS `poblacion`;
CREATE TABLE IF NOT EXISTS `poblacion` (
  `id_poblacion` bigint NOT NULL AUTO_INCREMENT,
  `ciudad_id` bigint NOT NULL,
  `borrado` datetime DEFAULT NULL,
  `nombre_poblacion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_poblacion`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.poblacion: ~55 rows (aproximadamente)
DELETE FROM `poblacion`;
/*!40000 ALTER TABLE `poblacion` DISABLE KEYS */;
INSERT INTO `poblacion` (`id_poblacion`, `ciudad_id`, `borrado`, `nombre_poblacion`) VALUES
	(1, 1, NULL, 'Gómez Carreño'),
	(2, 1, NULL, 'Mirador de Reñaca'),
	(3, 1, NULL, 'Santa Julia'),
	(4, 1, NULL, 'Villa Dulce'),
	(5, 1, NULL, 'Glorias Navales'),
	(6, 1, NULL, 'Recreo'),
	(7, 1, NULL, 'Jardín del Mar'),
	(8, 1, NULL, 'Santa Inés	'),
	(9, 1, NULL, 'Achupallas'),
	(10, 1, NULL, 'Miraflores '),
	(11, 1, NULL, 'El Salto'),
	(12, 1, NULL, 'Chorrillos'),
	(13, 1, NULL, 'Forestal'),
	(14, 2, NULL, 'Ramaditas'),
	(15, 2, NULL, 'Alegre'),
	(16, 2, NULL, 'Barón'),
	(17, 2, NULL, 'Blanco'),
	(18, 2, NULL, 'Bellavista'),
	(19, 2, NULL, 'Concepción'),
	(20, 2, NULL, 'Cordillera'),
	(21, 2, NULL, 'Delicias'),
	(22, 2, NULL, 'El Litre'),
	(23, 2, NULL, 'El Molino'),
	(24, 2, NULL, 'Esperanza'),
	(25, 2, NULL, 'Jiménez'),
	(26, 2, NULL, 'Larraín'),
	(27, 2, NULL, 'La Cruz'),
	(28, 2, NULL, 'La Cárcel'),
	(29, 2, NULL, 'La Florida'),
	(30, 2, NULL, 'La Merced'),
	(31, 2, NULL, 'La Virgen'),
	(32, 2, NULL, 'Las Cañas'),
	(33, 2, NULL, 'Las Jarcias'),
	(34, 2, NULL, 'Las Monjas'),
	(35, 2, NULL, 'Los Placeres'),
	(36, 2, NULL, 'Loceras'),
	(37, 2, NULL, 'Lecheros'),
	(38, 2, NULL, 'Mariposas'),
	(39, 2, NULL, 'Mesilla'),
	(40, 2, NULL, 'Miraflores'),
	(41, 2, NULL, 'O\'Higgins'),
	(42, 2, NULL, 'Pajonal'),
	(43, 2, NULL, 'Panteón'),
	(44, 2, NULL, 'Playa Ancha'),
	(45, 2, NULL, 'Perdices'),
	(46, 2, NULL, 'Polanco'),
	(47, 2, NULL, 'Ramaditas'),
	(48, 2, NULL, 'Reina Victoria'),
	(49, 2, NULL, 'Rodelillo'),
	(50, 2, NULL, 'Rocuant'),
	(51, 2, NULL, 'San Juan de Dios'),
	(52, 2, NULL, 'Santo Domingo'),
	(53, 2, NULL, 'San Francisco'),
	(54, 2, NULL, 'Toro'),
	(55, 2, NULL, 'Yungay');
/*!40000 ALTER TABLE `poblacion` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.provincia
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id_provincia` int NOT NULL AUTO_INCREMENT,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int NOT NULL,
  PRIMARY KEY (`id_provincia`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla chileworkads.provincia: 53 rows
DELETE FROM `provincia`;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`id_provincia`, `provincia_nombre`, `region_id`) VALUES
	(1, 'Arica', 1),
	(2, 'Parinacota', 1),
	(3, 'Iquique', 2),
	(4, 'El Tamarugal', 2),
	(5, 'Antofagasta', 3),
	(6, 'El Loa', 3),
	(7, 'Tocopilla', 3),
	(8, 'Chañaral', 4),
	(9, 'Copiapó', 4),
	(10, 'Huasco', 4),
	(11, 'Choapa', 5),
	(12, 'Elqui', 5),
	(13, 'Limarí', 5),
	(14, 'Isla de Pascua', 6),
	(15, 'Los Andes', 6),
	(16, 'Petorca', 6),
	(17, 'Quillota', 6),
	(18, 'San Antonio', 6),
	(19, 'San Felipe de Aconcagua', 6),
	(20, 'Valparaiso', 6),
	(21, 'Chacabuco', 7),
	(22, 'Cordillera', 7),
	(23, 'Maipo', 7),
	(24, 'Melipilla', 7),
	(25, 'Santiago', 7),
	(26, 'Talagante', 7),
	(27, 'Cachapoal', 8),
	(28, 'Cardenal Caro', 8),
	(29, 'Colchagua', 8),
	(30, 'Cauquenes', 9),
	(31, 'Curicó', 9),
	(32, 'Linares', 9),
	(33, 'Talca', 9),
	(34, 'Arauco', 10),
	(35, 'Bio Bío', 10),
	(36, 'Concepción', 10),
	(37, 'Ñuble', 10),
	(38, 'Cautín', 11),
	(39, 'Malleco', 11),
	(40, 'Valdivia', 12),
	(41, 'Ranco', 12),
	(42, 'Chiloé', 13),
	(43, 'Llanquihue', 13),
	(44, 'Osorno', 13),
	(45, 'Palena', 13),
	(46, 'Aisén', 14),
	(47, 'Capitán Prat', 14),
	(48, 'Coihaique', 14),
	(49, 'General Carrera', 14),
	(50, 'Antártica Chilena', 15),
	(51, 'Magallanes', 15),
	(52, 'Tierra del Fuego', 15),
	(53, 'Última Esperanza', 15);
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.region
DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id_region` int NOT NULL AUTO_INCREMENT,
  `nombre_region` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_region`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla chileworkads.region: 15 rows
DELETE FROM `region`;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` (`id_region`, `nombre_region`, `borrado`) VALUES
	(1, 'Arica y Parinacota', NULL),
	(2, 'Tarapacá', NULL),
	(3, 'Antofagasta', NULL),
	(4, 'Atacama', NULL),
	(5, 'Coquimbo', NULL),
	(6, 'Valparaiso', NULL),
	(7, 'Metropolitana de Santiago', NULL),
	(8, 'Libertador General Bernardo O\'Higgins', NULL),
	(9, 'Maule', NULL),
	(10, 'Biobío', NULL),
	(11, 'La Araucanía', NULL),
	(12, 'Los Ríos', NULL),
	(13, 'Los Lagos', NULL),
	(14, 'Aisén del General Carlos Ibáñez del Campo', NULL),
	(15, 'Magallanes y de la Antártica Chilena', NULL);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.resena
DROP TABLE IF EXISTS `resena`;
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
DROP TABLE IF EXISTS `tipo_contacto`;
CREATE TABLE IF NOT EXISTS `tipo_contacto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_red` varchar(50) NOT NULL,
  `url_red` varchar(50) NOT NULL,
  `icono_red` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `enable` tinyint NOT NULL DEFAULT '1',
  `borrado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla chileworkads.tipo_contacto: ~5 rows (aproximadamente)
DELETE FROM `tipo_contacto`;
/*!40000 ALTER TABLE `tipo_contacto` DISABLE KEYS */;
INSERT INTO `tipo_contacto` (`id`, `nombre_red`, `url_red`, `icono_red`, `enable`, `borrado`) VALUES
	(1, 'Teléfono', 'tel:', '930817b53d559220e1077b2cf095bec21592704189.png', 1, NULL),
	(2, 'Facebook', 'https://www.facebook.com/', 'facebook.png', 1, NULL),
	(3, 'Whatsapp', 'https://wa.me/', 'whatsapp.png', 1, NULL),
	(4, 'Email', 'mailto:', 'email.png', 1, NULL),
	(5, 'Twitter', 'https://twitter.com/', 'b02dad3047a010e5b3ecc90560e5fb891592703570.png', 1, NULL);
/*!40000 ALTER TABLE `tipo_contacto` ENABLE KEYS */;

-- Volcando estructura para tabla chileworkads.trabajo_imagen
DROP TABLE IF EXISTS `trabajo_imagen`;
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
DROP TABLE IF EXISTS `trabajo_realizado`;
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
