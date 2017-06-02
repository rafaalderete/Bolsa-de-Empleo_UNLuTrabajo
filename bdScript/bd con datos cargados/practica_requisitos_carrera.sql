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
-- Table structure for table `requisitos_carrera`
--

DROP TABLE IF EXISTS `requisitos_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisitos_carrera` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `propuesta_laboral_id` int(10) unsigned NOT NULL,
  `carrera_id` int(10) unsigned NOT NULL,
  `estado_carrera_id` int(10) unsigned NOT NULL,
  `excluyente` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `requisitos_carrera_propuesta_laboral_id_foreign` (`propuesta_laboral_id`),
  KEY `requisitos_carrera_carrera_id_foreign` (`carrera_id`),
  KEY `requisitos_carrera_estado_carrera_id_foreign` (`estado_carrera_id`),
  CONSTRAINT `requisitos_carrera_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisitos_carrera_estado_carrera_id_foreign` FOREIGN KEY (`estado_carrera_id`) REFERENCES `estados_carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requisitos_carrera_propuesta_laboral_id_foreign` FOREIGN KEY (`propuesta_laboral_id`) REFERENCES `propuestas_laborales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitos_carrera`
--

LOCK TABLES `requisitos_carrera` WRITE;
/*!40000 ALTER TABLE `requisitos_carrera` DISABLE KEYS */;
INSERT INTO `requisitos_carrera` VALUES (1,2,5,2,0,'2017-05-30 02:37:53','2017-05-30 02:37:53'),(2,4,2,1,0,'2017-05-30 02:55:04','2017-05-30 02:55:04'),(3,4,9,1,0,'2017-05-30 02:55:04','2017-05-30 02:55:04'),(4,4,6,1,0,'2017-05-30 02:55:04','2017-05-30 02:55:04'),(5,5,19,1,0,'2017-05-30 02:58:44','2017-05-30 02:58:44'),(6,6,20,2,0,'2017-05-30 03:00:48','2017-05-30 03:00:48'),(7,7,4,2,1,'2017-05-30 12:33:40','2017-05-30 12:33:40'),(8,7,5,2,1,'2017-05-30 12:33:40','2017-05-30 12:33:40'),(9,8,5,2,1,'2017-05-30 12:37:43','2017-05-30 12:37:43'),(10,9,2,2,1,'2017-05-30 12:42:29','2017-05-30 12:42:29'),(11,9,9,2,1,'2017-05-30 12:42:29','2017-05-30 12:42:29'),(12,9,6,2,1,'2017-05-30 12:42:29','2017-05-30 12:42:29'),(13,10,1,2,1,'2017-05-30 13:02:38','2017-05-30 13:02:38');
/*!40000 ALTER TABLE `requisitos_carrera` ENABLE KEYS */;
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
