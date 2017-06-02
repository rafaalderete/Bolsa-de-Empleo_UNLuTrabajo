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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado_usuario` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `persona_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verificacion_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  UNIQUE KEY `usuarios_nombre_usuario_unique` (`nombre_usuario`),
  KEY `usuarios_persona_id_foreign` (`persona_id`),
  CONSTRAINT `usuarios_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'$2y$10$ol3sUwr.ezbzrZAQYXVYJOYyPQ0x2/GcQL/LGA3e4KCHu0X2DKCwu','admin@admin.com','','activo','peguerrero','',1,'9qeruziSnmsRKSNoh3KOz1xnopwvep7wB0J3cNbyc9D8r4XU1s8TqXkf3iQH','','2017-03-29 06:00:00','2017-05-30 12:30:30'),(3,'$2y$10$CvDnazBqmKNp80aaRYkDNeEdbJg3MW5JHNKR6MzMSQRgb8HkPRm/y','alra.alderete@gmail.com','','activo','admin','',1,'8Fjt5zGuVowIwPeCJOWeHFk2O6BUiRLE1hWUtQdLTDPv0pWb7N5ImihcIIKC','','2017-03-30 16:05:29','2017-03-30 16:06:33'),(5,'$2y$10$2aed9HZhk2yjWqFs9KXw3evylII0Y3jlEB6CLuzcGSPozaVWXycGm','unluarcor@gmail.com','','activo','arcor','',24,'mQPuP1SeDogJ9it3hg9vJ8a242L8DJvgvJiJrYR9KzmrU8ndeOnpKAkAAcOQ','','2017-05-30 02:23:58','2017-05-30 02:43:44'),(6,'$2y$10$44JJh.jUpGJRpRPpP3c.mut9MNW8J5SSwmn/vgj7gS9sZwEPrU75S','unluseminario@gmail.com','','activo','unlu','',25,'ElmvishJfpRlyDhftLAxB7vwpgqskPwbO3ktiqA7Hnw8Gfye85ird64fYGJo','','2017-05-30 02:49:29','2017-05-30 03:00:55'),(7,'$2y$10$y4wzHMwB2VheOQXaKxP7kuOdZQ0COtTXdt5Ds68MBqe7GeeK3Kv2W','unlubrama@yahoo.com','','activo','brahma','',26,'9Sg7k8W9tNs4O29XDjd1FiwP4oDv8aFj5SEEKcEMaAjHnEWD197XQx4mwUf4','','2017-05-30 12:29:29','2017-05-30 13:02:44');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
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
