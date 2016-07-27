-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.17 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.1.0.4903
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla colegio.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Carrera_id` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL DEFAULT '0',
  `Apellido` varchar(50) NOT NULL DEFAULT '0',
  `Sexo` tinyint(4) NOT NULL DEFAULT '0',
  `FechaNacimiento` varchar(20) DEFAULT NULL,
  `FechaRegistro` varchar(20) DEFAULT NULL,
  `Foto` varchar(200) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_alumnos_carreras` (`Carrera_id`),
  CONSTRAINT `FK_alumnos_carreras` FOREIGN KEY (`Carrera_id`) REFERENCES `carrera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla colegio.alumno: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`id`, `Carrera_id`, `Nombre`, `Apellido`, `Sexo`, `FechaNacimiento`, `FechaRegistro`, `Foto`, `Correo`) VALUES
	(3, 3, 'Sara', 'Malakul Lane', 2, '1994-01-07', NULL, '160123021338-sara-malakul-lane-14.jpg', 'sara@malakul.com'),
	(4, 4, 'Fiorella', 'Robert Lopez', 2, '1972-01-12', NULL, '160123021453-fiorella-chirichigno-clases-yoga.jpg', 'frobert@gmail.com'),
	(5, 1, 'Naomi', 'Tmasuda Hehachi', 2, '1992-01-08', NULL, '160123021544-ishihara_kaori.png', 'tmasuda_h@yahoo.es'),
	(6, 4, 'Alberto', 'Perez Díaz', 1, '2016-01-08', NULL, '160123032244-developer.jpg', 'aperez@hotmail.com');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


-- Volcando estructura para tabla colegio.carrera
CREATE TABLE IF NOT EXISTS `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla colegio.carrera: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` (`id`, `Nombre`) VALUES
	(1, 'Ciencias de la comunicación'),
	(2, 'Derecho'),
	(3, 'Medicina Humana'),
	(4, 'Ingeniería de Software');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
