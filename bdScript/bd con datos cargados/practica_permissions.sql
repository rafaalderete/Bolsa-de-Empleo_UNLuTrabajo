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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion_permiso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado_permiso` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Crear usuarios','activo','crear_usuario','2017-03-12 15:01:46','2017-03-12 15:01:46'),(4,'Modificar usuario','activo','modificar_usuario','2017-03-13 05:27:06','2017-03-13 05:27:06'),(5,'Eliminar usuario','activo','eliminar_usuario','2017-03-13 05:27:36','2017-03-13 19:51:13'),(6,'Listar usuarios','activo','listar_usuarios','2017-03-13 05:32:14','2017-03-13 05:32:14'),(7,'Crear persona','activo','crear_persona','2017-03-13 05:38:32','2017-03-13 05:38:32'),(8,'Modificar persona','activo','modificar_persona','2017-03-13 05:39:06','2017-03-13 05:39:06'),(9,'Eliminar persona','activo','eliminar_persona','2017-03-13 05:39:39','2017-03-13 05:39:39'),(10,'Listar personas','activo','listar_personas','2017-03-13 05:40:10','2017-03-13 05:40:10'),(11,'Crear rol','activo','crear_rol','2017-03-13 05:40:53','2017-03-13 05:40:53'),(12,'Modificar rol','activo','modificar_rol','2017-03-13 05:41:34','2017-03-13 05:41:34'),(13,'Eliminar rol','activo','eliminar_rol','2017-03-13 05:41:58','2017-03-13 05:41:58'),(14,'Listar roles','activo','listar_roles','2017-03-13 05:42:23','2017-03-13 05:42:23'),(15,'Crear permiso','activo','crear_permiso','2017-03-13 05:44:42','2017-03-13 05:44:42'),(16,'Modificar permiso','activo','modificar_permiso','2017-03-13 05:45:05','2017-03-13 05:45:05'),(17,'Eliminar permiso','activo','eliminar_permiso','2017-03-13 05:45:41','2017-03-13 05:45:41'),(18,'Listar permisos','activo','listar_permisos','2017-03-13 05:46:14','2017-03-13 05:46:14'),(20,'Crear empresa','activo','crear_empresa','2017-03-30 18:08:20','2017-03-30 18:08:20'),(21,'Eliminar empresa','activo','eliminar_empresa','2017-03-30 18:08:47','2017-03-30 18:08:47'),(22,'Modificar empresa','activo','modificar_empresa','2017-03-30 18:09:09','2017-03-30 18:09:09'),(23,'Listar empresas','activo','listar_empresas','2017-03-30 18:09:25','2017-03-30 18:09:25'),(24,'Listar Rubros Empresariales','activo','listar_rubros_empresariales','2017-04-12 08:18:03','2017-04-12 08:18:03'),(25,'Crear rubro empresarial','activo','crear_rubro_empresarial','2017-04-12 08:20:55','2017-04-12 08:20:55'),(26,'Modificar rubro empresarial','activo','modificar_rubro_empresarial','2017-04-12 08:21:25','2017-04-12 08:21:25'),(27,'Eliminar rubro empresarial','activo','eliminar_rubro_empresarial','2017-04-12 08:21:54','2017-04-12 08:21:54'),(28,'Crear propuesta laboral','activo','crear_propuesta_laboral','2017-04-21 18:02:55','2017-04-21 18:02:55'),(29,'Listar propuestas laborales','activo','listar_propuestas_laborales','2017-04-21 18:03:36','2017-04-21 18:03:36'),(30,'Modificar propuesta laboral','activo','modificar_propuesta_laboral','2017-04-21 18:04:02','2017-04-21 18:04:02'),(31,'Eliminar propuesta laboral','activo','eliminar_propuesta_laboral','2017-04-21 18:04:29','2017-04-21 18:04:29'),(32,'Listar detalle propuesta laboral','activo','listar_detalle_propuesta_laboral','2017-04-28 14:25:44','2017-04-28 14:25:44'),(33,'Listar Tipos de Trabajo','activo','listar_tipos_trabajo','2017-04-30 11:45:14','2017-04-30 11:45:14'),(34,'Crear Tipo de Trabajo','activo','crear_tipo_trabajo','2017-04-30 11:45:51','2017-04-30 11:45:51'),(35,'Modificar Tipo de Trabajo','activo','modificar_tipo_trabajo','2017-04-30 11:46:16','2017-04-30 11:46:16'),(36,'Eliminar Tipo de Trabajo','activo','eliminar_tipo_trabajo','2017-04-30 11:46:43','2017-04-30 11:46:43'),(37,'Listar Tipos de Jornada','activo','listar_tipos_jornada','2017-04-30 11:48:28','2017-04-30 11:48:28'),(38,'Crear Tipo de Jornada','activo','crear_tipo_jornada','2017-04-30 11:48:59','2017-04-30 11:48:59'),(39,'Modificar Tipo de Jornada','activo','modificar_tipo_jornada','2017-04-30 11:49:27','2017-04-30 11:49:27'),(40,'Eliminar Tipo de Jornada','activo','eliminar_tipo_jornada','2017-04-30 11:50:00','2017-04-30 11:50:00'),(41,'Listar Estados de Carrera','activo','listar_estados_carrera','2017-04-30 11:54:48','2017-04-30 11:54:48'),(42,'Crear Estado de Carrera','activo','crear_estado_carrera','2017-04-30 11:55:11','2017-04-30 11:55:11'),(43,'Modificar Estado de Carrera','activo','modificar_estado_carrera','2017-04-30 11:55:40','2017-04-30 11:55:40'),(44,'Eliminar Estado de Carrera','activo','eliminar_estado_carrera','2017-04-30 11:55:59','2017-04-30 11:55:59'),(45,'Listar Niveles Educativos','activo','listar_niveles_educativos','2017-04-30 11:57:33','2017-04-30 11:57:33'),(46,'Crear NIvel Educativo','activo','crear_nivel_educativo','2017-04-30 11:57:58','2017-04-30 11:57:58'),(47,'Modificar NIvel Educativo','activo','modificar_nivel_educativo','2017-04-30 11:58:20','2017-04-30 11:58:20'),(48,'Eliminar NIvel Educativo','activo','eliminar_nivel_educativo','2017-04-30 11:58:42','2017-04-30 11:58:42'),(49,'Listar Tipos de Software','activo','listar_tipos_software','2017-04-30 12:00:10','2017-04-30 12:00:10'),(50,'Crear Tipo de Software','activo','crear_tipo_software','2017-04-30 12:00:31','2017-04-30 12:00:31'),(51,'Modificar Tipo de Software','activo','modificar_tipo_software','2017-04-30 12:00:59','2017-04-30 12:00:59'),(52,'Eliminar Tipo de Software','activo','eliminar_tipo_software','2017-04-30 12:01:20','2017-04-30 12:01:20'),(53,'Listar Niveles de Conocimiento','activo','listar_niveles_conocimiento','2017-04-30 12:07:39','2017-04-30 12:07:39'),(54,'Crear Nivel de Conocimiento','activo','crear_nivel_conocimiento','2017-04-30 12:07:59','2017-04-30 12:07:59'),(55,'Modificar Nivel de Conocimiento','activo','modificar_nivel_conocimiento','2017-04-30 12:08:37','2017-04-30 12:08:37'),(56,'Eliminar Nivel de Conocimiento','activo','eliminar_nivel_conocimiento','2017-04-30 12:09:01','2017-04-30 12:09:01'),(57,'Listar Idiomas','activo','listar_idiomas','2017-04-30 12:10:51','2017-04-30 12:10:51'),(58,'Crear Idioma','activo','crear_idioma','2017-04-30 12:11:05','2017-04-30 12:11:05'),(59,'Modificar Idioma','activo','modificar_idioma','2017-04-30 12:11:40','2017-04-30 12:11:40'),(60,'Eliminar Idioma','activo','eliminar_idioma','2017-04-30 12:11:56','2017-04-30 12:11:56'),(61,'Listar Tipos de Conocimiento de Idiomas','activo','listar_tipos_conocimiento_idioma','2017-04-30 12:13:14','2017-04-30 12:13:14'),(62,'Crear Tipo de Conocimiento de Idioma','activo','crear_tipo_conocimiento_idioma','2017-04-30 12:13:39','2017-04-30 12:13:39'),(63,'Modificar Tipo de Conocimiento de Idioma','activo','modificar_tipo_conocimiento_idioma','2017-04-30 12:14:07','2017-04-30 12:14:07'),(64,'Eliminar Tipo de Conocimiento Idioma','activo','eliminar_tipo_conocimiento_idioma','2017-04-30 12:14:42','2017-04-30 12:14:42'),(65,'Listar Tipos de Documentos','activo','listar_tipos_documento','2017-04-30 12:16:10','2017-04-30 12:16:10'),(66,'Crear Tipo de Documento','activo','crear_tipo_documento','2017-04-30 12:16:30','2017-04-30 12:16:30'),(67,'Modificar Tipo de Documento','activo','modificar_tipo_documento','2017-04-30 12:17:03','2017-04-30 12:17:03'),(68,'Eliminar Tipo de Documento','activo','eliminar_tipo_documento','2017-04-30 12:17:26','2017-04-30 12:17:26'),(69,'Buscar Ofertas','activo','buscar_ofertas','2017-05-04 08:17:31','2017-05-04 08:17:31'),(70,'Postularse','activo','postularse','2017-05-04 08:17:45','2017-05-04 08:17:45'),(71,'Listar Postulaciones','activo','listar_postulaciones','2017-05-04 08:18:06','2017-05-04 08:18:06'),(72,'Visualizar CV','activo','visualizar_cv','2017-05-07 12:47:58','2017-05-07 12:47:58'),(73,'Visualizar datos personales cv','activo','visualizar_datos_personales_cv','2017-05-07 12:48:57','2017-05-07 13:15:46'),(74,'Visualizar objetivo laboral cv','activo','visualizar_objetivo_laboral_cv','2017-05-07 12:50:54','2017-05-07 13:15:15'),(75,'Modificar objetivo laboral cv','activo','modificar_objetivo_laboral_cv','2017-05-07 12:51:43','2017-05-07 13:14:55'),(76,'Listar estudios academicos cv','activo','listar_estudios_academicos_cv','2017-05-07 13:11:05','2017-05-07 13:14:39'),(77,'Crear estudio academico cv','activo','crear_estudio_academico_cv','2017-05-07 13:12:24','2017-05-07 13:14:23'),(78,'Modificar estudio academico cv','activo','modificar_estudio_academico_cv','2017-05-07 13:13:56','2017-05-07 13:13:56'),(79,'Eliminar estudio academico cv','activo','eliminar_estudio_academico_cv','2017-05-07 13:18:03','2017-05-07 13:18:03'),(80,'Listar experiencias laborales cv','activo','listar_experiencias_laborales_cv','2017-05-07 13:27:51','2017-05-07 13:27:51'),(81,'Crear experiencia laboral cv','activo','crear_experiencia_laboral_cv','2017-05-07 13:28:40','2017-05-07 13:28:40'),(82,'Modificar experiencia laboral cv','activo','modificar_experiencia_laboral_cv','2017-05-07 13:29:37','2017-05-07 13:29:37'),(83,'Eliminar experiencia laboral cv','activo','eliminar_experiencia_laboral_cv','2017-05-07 13:30:23','2017-05-07 13:30:23'),(84,'Listar conocimientos idiomas cv','activo','listar_conocimientos_idiomas_cv','2017-05-07 13:43:13','2017-05-07 13:43:13'),(85,'Crear conocimiento idioma cv','activo','crear_conocimiento_idioma_cv','2017-05-07 13:43:46','2017-05-07 13:43:46'),(86,'Modificar conocimiento idioma cv','activo','modificar_conocimiento_idioma_cv','2017-05-07 13:44:22','2017-05-07 13:44:22'),(87,'Eliminar conocimiento idioma cv','activo','eliminar_conocimiento_idioma_cv','2017-05-07 13:45:01','2017-05-07 13:45:01'),(88,'Listar conocimientos informaticos cv','activo','listar_conocimientos_informaticos_cv','2017-05-07 13:54:19','2017-05-07 13:54:19'),(89,'Crear conocimiento informatico cv','activo','crear_conocimiento_informatico_cv','2017-05-07 13:54:57','2017-05-07 13:54:57'),(90,'Modificar conocimiento informatico cv','activo','modificar_conocimiento_informatico_cv','2017-05-07 13:55:32','2017-05-07 13:55:32'),(91,'Eliminar conocimiento informatico cv','activo','eliminar_conocimiento_informatico_cv','2017-05-07 13:56:16','2017-05-07 13:56:16'),(92,'Listar conocimientos adicionales cv','activo','listar_conocimientos_adicionales_cv','2017-05-07 14:04:31','2017-05-07 14:04:31'),(93,'Crear conocimiento adicional cv','activo','crear_conocimiento_adicional_cv','2017-05-07 14:05:01','2017-05-07 14:05:01'),(94,'Modificar conocimiento adicional cv','activo','modificar_conocimiento_adicional_cv','2017-05-07 14:05:31','2017-05-07 14:05:31'),(95,'Eliminar conocimiento adicional cv','activo','eliminar_conocimiento_adicional_cv','2017-05-07 14:05:58','2017-05-07 14:05:58');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
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