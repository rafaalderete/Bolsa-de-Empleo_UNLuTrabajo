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
-- Table structure for table `unlu_carreras`
--

DROP TABLE IF EXISTS `unlu_carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unlu_carreras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_unlu_carrera` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_materias` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unlu_carreras`
--

LOCK TABLES `unlu_carreras` WRITE;
/*!40000 ALTER TABLE `unlu_carreras` DISABLE KEYS */;
INSERT INTO `unlu_carreras` VALUES (1,'Lic. en Sistemas de Información',38,'2017-04-01 09:00:00','2017-04-01 09:00:00'),(2,'Lic. en Administración',40,'2017-04-01 09:00:00','2017-04-01 09:00:00'),(3,'Ing. Agronómica',40,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(4,'Ing. en Alimentos',38,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(5,'Ing. Industrial',48,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(6,'Contador Público',43,'2017-05-03 06:00:00','2017-05-04 06:00:00'),(7,'Lic. en Ciencias Biológicas',37,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(8,'Lic. en Ciencias de la Educación',45,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(9,'Lic. en Comercio Internacional',54,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(10,'Lic. en Educación Física',56,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(11,'Lic. en Enfermería',57,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(12,'Lic. en Geografía',48,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(13,'Lic. en Gestión Universitaria',37,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(14,'Lic. en Historia',34,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(15,'Lic. en Información Ambiental',43,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(16,'Lic. en Trabajo Social',36,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(17,'Prof. en Ciencias Biológicas',37,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(18,'Prof. en Ciencias de la Educación',45,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(19,'Prof. en Educación Física',40,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(20,'Prof. en Enseñanza Media de Adultos',43,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(21,'Prof. en Física',39,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(22,'Prof. en Geofrafía',38,'2017-05-04 06:00:00','2017-05-04 06:00:00'),(23,'Prof. en Historia',48,'2017-05-04 06:00:00','2017-05-04 06:00:00');
/*!40000 ALTER TABLE `unlu_carreras` ENABLE KEYS */;
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
