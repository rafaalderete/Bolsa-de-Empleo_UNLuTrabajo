CREATE DATABASE  IF NOT EXISTS `practica` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `practica`;
-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: practica
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `unlu_estudiantes`
--

DROP TABLE IF EXISTS `unlu_estudiantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unlu_estudiantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `legajo` int(10) unsigned NOT NULL,
  `unlu_carrera_id` int(10) unsigned NOT NULL,
  `fecha_inicio_carrera` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_materias_aprobadas` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `cuil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_documento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nro_documento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_fijo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unlu_estudiantes_cuil_unique` (`cuil`),
  UNIQUE KEY `unlu_estudiantes_nro_documento_unique` (`nro_documento`),
  UNIQUE KEY `unlu_estudiantes_email_unique` (`email`),
  KEY `unlu_estudiantes_unlu_carrera_id_foreign` (`unlu_carrera_id`),
  CONSTRAINT `unlu_estudiantes_unlu_carrera_id_foreign` FOREIGN KEY (`unlu_carrera_id`) REFERENCES `unlu_carreras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unlu_estudiantes`
--

LOCK TABLES `unlu_estudiantes` WRITE;
/*!40000 ALTER TABLE `unlu_estudiantes` DISABLE KEYS */;
INSERT INTO `unlu_estudiantes` VALUES (1,113635,1,'01-02-2010',27,'Alexis','Alderete','1991-02-21','20360766811','DNI','36076681','alra.alderete@gmail.com','44812549','1544132412','Bagnat 2524','Ituzaingo','Buenos Aires','Argentina','2017-04-01 09:00:00','2017-04-01 09:00:00'),(2,117591,1,'01-02-2010',27,'Maria Eliana','Pighin','1991-08-10','27357233939','DNI','35723393','me.pighin@gmail.com','2374841978','111565617113','Pasaje Bonino 968','General Rodriguez','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(3,117024,1,'01-02-2010',27,'Maria Victoria','Medina','1991-08-13','23357946204','DNI','35794620','medina.vicc@gmail.com','','2323613760','Champagnat 385','LujÃ¡n','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(4,117869,1,'01-02-2010',27,'Pedro','Guerrero','1990-09-01','2035325498','DNI','35325498','peg10@live.com.ar','4687018','1167980534','Solon 1490','Moreno','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(5,117025,2,'01-02-2010',27,'Lucas','Perez','1990-10-01','2035325499','DNI','35325499','unlulucas@gmail.com','4687019','1167980535','San Matin 2100','Lujan','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(6,117026,4,'01-02-2010',27,'Marta','Morales','1990-12-01','2035325410','DNI','35325410','unlumaerta@outlook.es','4687010','1167980536','Av de Mayo 552','San Miguel','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(7,117027,10,'01-02-2010',27,'Javier','Mendez','1990-05-01','2035325411','DNI','35325411','unlujavier@yahoo.com.ar','4687011','1167980537','Saavedra 1544','Chivilcoy','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(8,117028,8,'01-02-2010',27,'Analia','Hunt','1990-03-01','2035325412','DNI','35325412','unluanalia@gmail.com','4687012','1167980538','Palmar 7126','Capital','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00'),(9,117029,14,'01-02-2010',15,'Ricardo','Castro','1990-07-01','2035325413','DNI','35325413','unluricardo@gmail.com','4687012','1167980539','Belgrano 789','Lobos','Buenos Aires','Argentina','2017-05-01 06:00:00','2017-05-01 06:00:00');
/*!40000 ALTER TABLE `unlu_estudiantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-30 10:12:05
