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
-- Table structure for table `tipos_software`
--

DROP TABLE IF EXISTS `tipos_software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_software` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tipo_software` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_software_nombre_tipo_software_unique` (`nombre_tipo_software`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_software`
--

LOCK TABLES `tipos_software` WRITE;
/*!40000 ALTER TABLE `tipos_software` DISABLE KEYS */;
INSERT INTO `tipos_software` VALUES (3,'Microsoft Word','activo','2017-05-30 01:49:35','2017-05-30 01:49:35'),(4,'Microsoft Excel','activo','2017-05-30 01:49:48','2017-05-30 01:49:48'),(5,'Eclipse IDE','activo','2017-05-30 01:50:00','2017-05-30 01:50:00'),(6,'GitHub','activo','2017-05-30 01:50:27','2017-05-30 01:50:27'),(7,'Tango Gestión','activo','2017-05-30 01:50:40','2017-05-30 01:50:40'),(8,'Enterprise Architect','activo','2017-05-30 01:51:09','2017-05-30 01:51:09'),(9,'AutoCAD','activo','2017-05-30 01:51:36','2017-05-30 01:51:36'),(10,'Microsoft Proyect','activo','2017-05-30 01:53:24','2017-05-30 01:53:24'),(11,'Photoshop','activo','2017-05-30 01:55:13','2017-05-30 01:55:13'),(12,'Corel Draw','activo','2017-05-30 01:55:28','2017-05-30 01:55:28'),(13,'Adobe Illustrator CC','activo','2017-05-30 01:56:39','2017-05-30 01:56:39');
/*!40000 ALTER TABLE `tipos_software` ENABLE KEYS */;
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
