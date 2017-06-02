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
-- Table structure for table `requisitos_idioma`
--

DROP TABLE IF EXISTS `requisitos_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisitos_idioma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `propuesta_laboral_id` int(10) unsigned NOT NULL,
  `idioma_id` int(10) unsigned NOT NULL,
  `tipo_conocimiento_idioma_id` int(10) unsigned NOT NULL,
  `nivel_conocimiento_id` int(10) unsigned NOT NULL,
  `excluyente` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `requisitos_idioma_propuesta_laboral_id_foreign` (`propuesta_laboral_id`),
  KEY `requisitos_idioma_idioma_id_foreign` (`idioma_id`),
  KEY `requisitos_idioma_tipo_conocimiento_idioma_id_foreign` (`tipo_conocimiento_idioma_id`),
  KEY `requisitos_idioma_nivel_conocimiento_id_foreign` (`nivel_conocimiento_id`),
  CONSTRAINT `requisitos_idioma_idioma_id_foreign` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisitos_idioma_nivel_conocimiento_id_foreign` FOREIGN KEY (`nivel_conocimiento_id`) REFERENCES `niveles_conocimiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisitos_idioma_propuesta_laboral_id_foreign` FOREIGN KEY (`propuesta_laboral_id`) REFERENCES `propuestas_laborales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisitos_idioma_tipo_conocimiento_idioma_id_foreign` FOREIGN KEY (`tipo_conocimiento_idioma_id`) REFERENCES `tipos_conocimiento_idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitos_idioma`
--

LOCK TABLES `requisitos_idioma` WRITE;
/*!40000 ALTER TABLE `requisitos_idioma` DISABLE KEYS */;
INSERT INTO `requisitos_idioma` VALUES (1,1,1,1,2,0,'2017-05-30 02:29:52','2017-05-30 02:29:52'),(2,10,1,1,3,1,'2017-05-30 13:02:38','2017-05-30 13:02:38'),(3,10,1,2,3,1,'2017-05-30 13:02:38','2017-05-30 13:02:38');
/*!40000 ALTER TABLE `requisitos_idioma` ENABLE KEYS */;
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
