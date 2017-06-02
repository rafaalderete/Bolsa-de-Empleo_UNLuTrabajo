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
-- Table structure for table `rubros_empresariales`
--

DROP TABLE IF EXISTS `rubros_empresariales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubros_empresariales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rubro_empresarial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rubros_empresariales_nombre_rubro_empresarial_unique` (`nombre_rubro_empresarial`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubros_empresariales`
--

LOCK TABLES `rubros_empresariales` WRITE;
/*!40000 ALTER TABLE `rubros_empresariales` DISABLE KEYS */;
INSERT INTO `rubros_empresariales` VALUES (1,'Agricultura','activo','2017-03-30 09:00:00','2017-03-30 09:00:00'),(2,'Sistemas','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(3,'Educación','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(4,'Alimentos','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(5,'Textil','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(6,'Automotriz','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(7,'Ganadería','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(8,'Hotelería / Turismo','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(9,'Medicina / Salud','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(10,'Administración / Oficina','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(11,'Diseño / Artes Gráficas','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(12,'Legal / Asesoría','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(13,'Recursos Humanos','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(14,'Compras / Comercio Exterior','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(15,'Minería','activo','2017-04-21 02:48:57','2017-04-21 02:48:57'),(16,'Cervecero','activo','2017-05-30 12:25:37','2017-05-30 12:25:37'),(17,'Otros','activo','2017-05-30 12:25:44','2017-05-30 12:25:44');
/*!40000 ALTER TABLE `rubros_empresariales` ENABLE KEYS */;
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
