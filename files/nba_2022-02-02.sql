# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.33)
# Database: nba
# Generation Time: 2022-02-02 11:41:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table equipos
# ------------------------------------------------------------


create schema if not exists nba;
use nba;

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `ciudad` varchar(20) DEFAULT NULL,
  `conferencia` varchar(4) DEFAULT NULL,
  `division` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table estadisticas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estadisticas`;

CREATE TABLE `estadisticas` (
  `temporada` varchar(5) NOT NULL,
  `jugador` int(11) NOT NULL,
  `puntos_por_partido` float DEFAULT NULL,
  `asistencias_por_partido` float DEFAULT NULL,
  `tapones_por_partido` float DEFAULT NULL,
  `rebotes_por_partido` float DEFAULT NULL,
  PRIMARY KEY (`temporada`,`jugador`),
  KEY `jugador` (`jugador`),
  CONSTRAINT `estadisticas_ibfk_1` FOREIGN KEY (`jugador`) REFERENCES `jugadores` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table jugadores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jugadores`;

CREATE TABLE `jugadores` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `procedencia` varchar(20) DEFAULT NULL,
  `altura` varchar(4) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `posicion` varchar(5) DEFAULT NULL,
  `nombre_equipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `Nombre_equipo` (`nombre_equipo`),
  CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`nombre_equipo`) REFERENCES `equipos` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table partidos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `partidos`;

CREATE TABLE `partidos` (
  `codigo` int(11) NOT NULL,
  `equipo_local` varchar(20) DEFAULT NULL,
  `equipo_visitante` varchar(20) DEFAULT NULL,
  `puntos_local` int(11) DEFAULT NULL,
  `puntos_visitante` int(11) DEFAULT NULL,
  `temporada` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `equipo_local` (`equipo_local`),
  KEY `equipo_visitante` (`equipo_visitante`),
  CONSTRAINT `partidos_ibfk_1` FOREIGN KEY (`equipo_local`) REFERENCES `equipos` (`nombre`),
  CONSTRAINT `partidos_ibfk_2` FOREIGN KEY (`equipo_visitante`) REFERENCES `equipos` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
