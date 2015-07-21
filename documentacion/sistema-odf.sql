CREATE DATABASE  IF NOT EXISTS `sistema-odf` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistema-odf`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: sistema-odf
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'controllers',1,124),(2,1,NULL,NULL,'Departamentos',2,19),(3,2,NULL,NULL,'index',3,4),(4,2,NULL,NULL,'add',5,6),(5,2,NULL,NULL,'view',7,8),(6,2,NULL,NULL,'edit',9,10),(7,2,NULL,NULL,'index_map',11,12),(8,2,NULL,NULL,'view_map',13,14),(9,2,NULL,NULL,'delete',15,16),(10,2,NULL,NULL,'menu_departamentos',17,18),(11,1,NULL,NULL,'Groups',20,27),(12,11,NULL,NULL,'index',21,22),(13,11,NULL,NULL,'view',23,24),(14,11,NULL,NULL,'add',25,26),(15,1,NULL,NULL,'Notas',28,31),(16,15,NULL,NULL,'ultimas_notas',29,30),(17,1,NULL,NULL,'Odfs',32,43),(18,17,NULL,NULL,'index',33,34),(19,17,NULL,NULL,'add',35,36),(20,17,NULL,NULL,'view',37,38),(21,17,NULL,NULL,'administrar',39,40),(22,17,NULL,NULL,'delete',41,42),(23,1,NULL,NULL,'Pages',44,47),(24,23,NULL,NULL,'display',45,46),(25,1,NULL,NULL,'Provincias',48,65),(26,25,NULL,NULL,'index',49,50),(27,25,NULL,NULL,'add',51,52),(28,25,NULL,NULL,'view',53,54),(29,25,NULL,NULL,'edit',55,56),(30,25,NULL,NULL,'view_map',57,58),(31,25,NULL,NULL,'getByDepartamento',59,60),(32,25,NULL,NULL,'delete',61,62),(33,25,NULL,NULL,'menu_provincias',63,64),(34,1,NULL,NULL,'Reportes',66,85),(35,34,NULL,NULL,'departamentos',67,68),(36,34,NULL,NULL,'departamentos_post',69,70),(37,34,NULL,NULL,'provincias',71,72),(38,34,NULL,NULL,'provincias_post',73,74),(39,34,NULL,NULL,'urds',75,76),(40,34,NULL,NULL,'urds_post',77,78),(41,34,NULL,NULL,'odfs',79,80),(42,34,NULL,NULL,'odfs_post',81,82),(43,34,NULL,NULL,'reporte_odf',83,84),(44,1,NULL,NULL,'Urds',86,99),(45,44,NULL,NULL,'index',87,88),(46,44,NULL,NULL,'add',89,90),(47,44,NULL,NULL,'view',91,92),(48,44,NULL,NULL,'edit',93,94),(49,44,NULL,NULL,'getByProvincia',95,96),(50,44,NULL,NULL,'delete',97,98),(51,1,NULL,NULL,'Users',100,121),(52,51,NULL,NULL,'initDB',101,102),(53,51,NULL,NULL,'index',103,104),(54,51,NULL,NULL,'view',105,106),(55,51,NULL,NULL,'add',107,108),(56,51,NULL,NULL,'edit',109,110),(57,51,NULL,NULL,'delete',111,112),(58,51,NULL,NULL,'login',113,114),(59,51,NULL,NULL,'logout',115,116),(60,51,NULL,NULL,'manage_usuario',117,118),(61,51,NULL,NULL,'change_password',119,120),(62,1,NULL,NULL,'AclExtras',122,123);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT INTO `aros` VALUES (1,NULL,'Group',1,NULL,1,2),(2,NULL,'Group',2,NULL,3,4);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT INTO `aros_acos` VALUES (1,1,1,'1','1','1','1'),(2,1,14,'-1','-1','-1','-1'),(3,2,1,'1','1','1','1'),(4,2,4,'-1','-1','-1','-1'),(5,2,6,'-1','-1','-1','-1'),(6,2,9,'-1','-1','-1','-1'),(7,2,14,'-1','-1','-1','-1'),(8,2,19,'-1','-1','-1','-1'),(9,2,21,'-1','-1','-1','-1'),(10,2,22,'-1','-1','-1','-1'),(11,2,27,'-1','-1','-1','-1'),(12,2,29,'-1','-1','-1','-1'),(13,2,32,'-1','-1','-1','-1'),(14,2,46,'-1','-1','-1','-1'),(15,2,48,'-1','-1','-1','-1'),(16,2,50,'-1','-1','-1','-1'),(17,2,53,'-1','-1','-1','-1'),(18,2,55,'-1','-1','-1','-1'),(19,2,56,'-1','-1','-1','-1'),(20,2,57,'-1','-1','-1','-1'),(21,2,34,'1','1','1','1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bcs`
--

DROP TABLE IF EXISTS `bcs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bcs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bes_id` int(11) NOT NULL,
  `numero_cables` int(11) DEFAULT '8',
  `numeracion` int(11) DEFAULT '72',
  `estado` char(1) DEFAULT '1',
  PRIMARY KEY (`id`,`bes_id`),
  KEY `fk_bcs_bes1_idx` (`bes_id`),
  CONSTRAINT `fk_bcs_bes1` FOREIGN KEY (`bes_id`) REFERENCES `bes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bcs`
--

LOCK TABLES `bcs` WRITE;
/*!40000 ALTER TABLE `bcs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bcs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bes`
--

DROP TABLE IF EXISTS `bes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tubofibras_id` int(11) NOT NULL,
  `numero_cables` int(11) DEFAULT NULL,
  `numeracion` int(11) DEFAULT '1',
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`tubofibras_id`),
  KEY `fk_bes_tubofibras1_idx` (`tubofibras_id`),
  CONSTRAINT `fk_bes_tubofibras1` FOREIGN KEY (`tubofibras_id`) REFERENCES `tubofibras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bes`
--

LOCK TABLES `bes` WRITE;
/*!40000 ALTER TABLE `bes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conectorfibras`
--

DROP TABLE IF EXISTS `conectorfibras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conectorfibras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bcs_id` int(11) NOT NULL,
  `tipos_id` int(11) NOT NULL,
  `gestores_id` int(11) NOT NULL,
  `numeracion` int(11) NOT NULL DEFAULT '1',
  `descripcion` varchar(150) DEFAULT NULL,
  `intermedio` varchar(150) DEFAULT NULL,
  `gestor_ubicacion` varchar(45) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`bcs_id`,`tipos_id`,`gestores_id`),
  KEY `fk_fibraconectores_bcs1_idx` (`bcs_id`),
  KEY `fk_fibraconectores_tipos1_idx` (`tipos_id`),
  KEY `fk_conectorfibras_gestores1_idx` (`gestores_id`),
  CONSTRAINT `fk_fibraconectores_bcs1` FOREIGN KEY (`bcs_id`) REFERENCES `bcs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fibraconectores_tipos1` FOREIGN KEY (`tipos_id`) REFERENCES `tipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conectorfibras_gestores1` FOREIGN KEY (`gestores_id`) REFERENCES `gestores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conectorfibras`
--

LOCK TABLES `conectorfibras` WRITE;
/*!40000 ALTER TABLE `conectorfibras` DISABLE KEYS */;
/*!40000 ALTER TABLE `conectorfibras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  `posicion_x` int(11) DEFAULT NULL,
  `posicion_y` int(11) DEFAULT NULL,
  `mapa` varchar(45) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'ANCASH',200,330,'mapa_ancash.png','1'),(2,'LA LIBERTAD',150,280,'mapa_lalibertad.png','1'),(3,'LORETO',265,145,'mapa_loreto.png','1'),(4,'SAN MARTIN',175,250,'mapa_sanmartin.png','1'),(5,'LIMA',150,405,'mapa_lima.png','1');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestores`
--

DROP TABLE IF EXISTS `gestores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gestores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestores`
--

LOCK TABLES `gestores` WRITE;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` VALUES (1,'SIN GESTOR','1'),(2,'GESTOR NO IDENTIFICADO','1'),(3,'OPTIX-OSN-6800 HUAWEI','1'),(4,'OPTIX-OSN-3500 HUAWEI','1'),(5,'OPTIX-OSN-1500 HUAWEI','1'),(6,'OPTIX-OSN-7500 HUAWEI','1'),(7,'OPTIX-OSN-8800 HUAWEI','1'),(8,'OPTIX-OSN-8800 T32 HUAWEI','1'),(9,'OPTIX-OSN-500 HUAWEI','1'),(10,'OPTIX-OSN-3800 HUAWEI','1'),(11,'OPTINEX OSN 1800 V  HUAWEI','1'),(12,'OPTIX-METRO 6100 HUAWEI','1'),(13,'OPTIX-METRO 3100 HUAWEI','1'),(14,'OPTIX-METRO-155/622H 1000 HUAWEI','1'),(15,'OPTINEX-1678 ALCATEL','1'),(16,'OPTINEX-1660 ALCATEL','1'),(17,'OPTINEX-1662 ALCATEL','1'),(18,'OPTINEX-1642 ALCATEL','1'),(19,'OPTINEX-1660-SM ALCATEL','1'),(20,'OPTINEX-1650-SM-C ALCATEL','1'),(21,'OPTINEX-1662-SM-C ALCATEL','1'),(22,'OPTINEX-ADM-1641SM/1651 SM-C ALCATEL','1'),(23,'NE40E-x1','1'),(24,'NE40E-x3','1'),(25,'NE40E-x4 HUAWEI','1'),(26,'NE40E-x8','1'),(27,'NE40E-x16','1'),(28,'NE80E','1'),(29,'AURORA','1'),(30,'BPX-8600','1'),(31,'TRURCASR9K','1'),(32,'TRURCASR9K CISCO ASR 9000 ','1'),(33,'NGN UMG 8900','1'),(34,'TELLABS-8630','1'),(35,'TELLABS-8660','1'),(36,'TRUPEWX','1'),(37,'TRUPE','1'),(38,'TRUPENG','1'),(39,'TRUPE CISCO 7200 ','1'),(40,'TRUPENG WX1','1'),(41,'STANDALONE-TELECOM','1'),(42,'STANDALONE-TMARC','1'),(43,'TRURI CISCO 7200','1'),(44,'MX-960','1'),(45,'TRUPCRS CISCO','1'),(46,'TELCO T5C','1'),(47,'RBS-6601','1'),(48,'CISCO CATV','1'),(49,'ERX','1'),(50,'METROBILITY','1'),(51,'SWITCH 2960G','1'),(52,'EFM MA5600T','1'),(53,'SERIE VXR','1'),(54,'E-320 JE320 JUNIPER','1'),(55,'T320 JUNIPER','1'),(56,'JT4000 JUNIPER','1'),(57,'ERX1','1'),(58,'HME60X8','1'),(59,'RACK-01A','1'),(60,'RACK-02A','1'),(61,'BSCRN HRT','1'),(62,'BSCRNC HRT','1'),(63,'ADSL','1'),(64,'ADSL CONCENTRADOR 7300 ASAM','1'),(65,'ADSL CONCENTRADOR MA5600','1'),(66,'ADSL CONCENTRADOR  MA5300','1'),(67,'ISAM 7302 ','1'),(68,'ADSL CCONCENTRADOR MA5600T ','1');
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrador','1'),(2,'Técnico','1');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odfs_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `cuerpo` longtext,
  `created` date NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`odfs_id`,`users_id`),
  KEY `fk_notas_users1_idx` (`users_id`),
  KEY `fk_notas_odfs1_idx` (`odfs_id`),
  CONSTRAINT `fk_notas_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notas_odfs1` FOREIGN KEY (`odfs_id`) REFERENCES `odfs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odfs`
--

DROP TABLE IF EXISTS `odfs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urds_id` int(11) NOT NULL,
  `numeracion` int(11) NOT NULL DEFAULT '1',
  `numero_cables` int(11) NOT NULL DEFAULT '1',
  `tam_bc` int(11) NOT NULL DEFAULT '8',
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`urds_id`),
  KEY `fk_odfs_urds1_idx` (`urds_id`),
  CONSTRAINT `fk_odfs_urds1` FOREIGN KEY (`urds_id`) REFERENCES `urds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odfs`
--

LOCK TABLES `odfs` WRITE;
/*!40000 ALTER TABLE `odfs` DISABLE KEYS */;
/*!40000 ALTER TABLE `odfs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamentos_id` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `posicion_x` int(11) DEFAULT NULL,
  `posicion_y` int(11) DEFAULT NULL,
  `latitud` decimal(10,6) DEFAULT NULL,
  `longitud` decimal(10,6) DEFAULT NULL,
  `zoom` int(11) DEFAULT '13',
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`departamentos_id`),
  KEY `fk_provincias_departamentos1_idx` (`departamentos_id`),
  CONSTRAINT `fk_provincias_departamentos1` FOREIGN KEY (`departamentos_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,1,'CARHUAZ',320,215,-9.281994,-77.645252,16,'1'),(2,1,'CASMA',160,280,-9.473677,-78.300934,16,'1'),(3,1,'HUARAZ',220,275,-9.529653,-77.529895,16,'1'),(4,1,'HUARMEY',155,410,-10.065797,-78.153627,16,'1'),(5,1,'HUAYLAS',150,140,-9.048024,-77.810841,16,'1'),(6,1,'RECUAY',200,365,-9.723249,-77.457025,16,'1'),(7,1,'SANTA',15,160,-9.022114,-78.606419,13,'1'),(8,1,'YUNGAY',25,225,-9.140785,-77.744193,16,'1'),(9,2,'CHEPEN',25,50,-7.229069,-79.429759,16,'1'),(10,2,'PACASMAYO',25,110,-7.402217,-79.564913,16,'1'),(11,2,'ASCOPE',45,195,-7.770713,-79.174261,11,'1'),(12,2,'TRUJILLO',60,240,-8.108510,-79.024508,13,'1'),(13,2,'VIRU',90,340,-8.416838,-78.753197,16,'1'),(14,3,'ALTO AMAZONAS',145,280,-5.895814,-76.117144,15,'1'),(15,3,'LORETO',200,220,-4.508680,-73.583562,15,'1'),(16,3,'MAYNAS',220,115,-3.742770,-73.259367,15,'1'),(17,4,'BELLAVISTA',330,360,-7.056859,-76.590465,15,'1'),(18,4,'MARISCAL CACERES',160,280,-7.177958,-76.731133,16,'1'),(19,4,'MOYOBAMBA',140,60,-6.037561,-76.971502,15,'1'),(20,4,'RIOJA',45,25,-6.058687,-77.170157,15,'1'),(21,4,'SAN MARTIN',270,150,-6.490365,-76.375065,14,'1'),(22,5,'BARRANCA',100,30,-10.752007,-77.760630,15,'1'),(23,5,'HUARAL',180,140,-11.493022,-77.214001,15,'1'),(24,5,'HUAURA',100,100,-11.134543,-77.192586,15,'1'),(25,5,'LIMA',120,230,-11.806266,-77.164482,15,'1');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'LIBRE','1'),(2,'SERVICIOS MULTIPLES','1'),(3,'MOVILES','1'),(4,'D\'LAM','1'),(5,'CATV','1'),(6,'MONITOREO','1'),(7,'FUSION','1'),(8,'ASIGNADO','1');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tubofibras`
--

DROP TABLE IF EXISTS `tubofibras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tubofibras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `odfs_id` int(11) NOT NULL,
  `id2` varchar(3) DEFAULT NULL,
  `descripcion` varchar(100) NOT NULL,
  `numero_cables` int(11) DEFAULT NULL,
  `numeracion` int(11) NOT NULL DEFAULT '1',
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`odfs_id`),
  KEY `fk_tubofibras_odfs1_idx` (`odfs_id`),
  CONSTRAINT `fk_tubofibras_odfs1` FOREIGN KEY (`odfs_id`) REFERENCES `odfs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tubofibras`
--

LOCK TABLES `tubofibras` WRITE;
/*!40000 ALTER TABLE `tubofibras` DISABLE KEYS */;
/*!40000 ALTER TABLE `tubofibras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urds`
--

DROP TABLE IF EXISTS `urds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincias_id` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `latitud` decimal(10,6) DEFAULT NULL,
  `longitud` decimal(10,6) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`provincias_id`),
  KEY `fk_urds_provincias1_idx` (`provincias_id`),
  CONSTRAINT `fk_urds_provincias1` FOREIGN KEY (`provincias_id`) REFERENCES `provincias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urds`
--

LOCK TABLES `urds` WRITE;
/*!40000 ALTER TABLE `urds` DISABLE KEYS */;
INSERT INTO `urds` VALUES (1,1,'CARHUAZ',-9.281611,-77.649444,'Jr. Real 581 - 585 / Calle Aurora',NULL,'1'),(2,2,'CASMA',-9.478092,-78.304008,'AV. BOLIVAR',NULL,'1'),(3,3,'HUARAZ',-9.529292,-77.529543,'AV. JUAN ANTONIO DE SUCRE (frente a bomberos)',NULL,'1'),(4,4,'HUARMEY',-10.069689,-78.154664,'CALLE QULIPE',NULL,'1'),(5,5,'CARAZ',-9.049219,-77.809364,'CALLE LEONCIO PRADO',NULL,'1'),(6,6,'RECUAY',-9.722483,-77.458525,'',NULL,'1'),(7,6,'TICAPAMPA',-9.759278,-77.444047,'',NULL,'1'),(8,6,'CATAC',-9.801675,-77.430644,'',NULL,'1'),(9,7,'C.O CHIMBOTE',-9.077266,-78.588993,'JR. TUMBES',NULL,'1'),(10,7,'SANTA',-8.988431,-78.613176,'JR. RIO SANTA',NULL,'1'),(11,7,'BUENOS AIRES',-9.127513,-78.522851,'AV. EL PACIFICO',NULL,'1'),(12,7,'COISHCO',-9.023863,-78.615622,'PANAMERICANA NORTE',NULL,'1'),(13,7,'MEIGGS',0.000000,0.000000,'',NULL,'1'),(14,8,'YUNGAY',-9.138689,-77.744831,'Av. Santo Domingo vivienda 8 (ex Ca. 2)',NULL,'1'),(15,11,'CARTAVIO',-7.893061,-79.223978,'AV. SAN FRANCISCO (ESQUINA)',NULL,'1'),(16,11,'CHICAMA',-7.846717,-79.146243,'PROLONG. PROGRESO / PARALELA PAN. NORTE',NULL,'1'),(17,11,'SANTIAGO DE CAO',-7.960952,-79.239525,'ASEQUIA PONGO CHONGO / CHIQUITOY',NULL,'1'),(18,11,'CHOCOPE',-7.792131,-79.224313,'0',NULL,'1'),(19,11,'CASA GRANDE',-7.738663,-79.182520,'0',NULL,'1'),(20,11,'ASCOPE',-7.713242,-79.109829,'0',NULL,'1'),(21,11,'ROMA',0.000000,0.000000,'0',NULL,'1'),(22,11,'PAIJAN',-7.733147,-79.294408,'0',NULL,'1'),(23,9,'CHEPEN',-7.226807,-79.429940,'CALLE RAMON CASTILLA',NULL,'1'),(24,9,'CHEPEN2',-7.219349,-79.434189,'CALLE LAS FLORES / PARELELA PANAMERICA NORTE',NULL,'1'),(25,10,'PACASMAYO',-7.401557,-79.565173,'0',NULL,'1'),(26,10,'SAN PEDRO DE LLOC',-7.424938,-79.502807,'0',NULL,'1'),(27,10,'SAN JOSE',-7.350106,-79.454505,'0',NULL,'1'),(28,10,'CIUDAD DE DIOS',-7.304731,-79.480877,'0',NULL,'1'),(29,10,'GUADALUPE',-7.243936,-79.470892,'Av. Perez de Lescano Nro. 148 ',NULL,'1'),(30,12,'O.C TRUJILLO',-8.110699,-79.024640,'JR. JUNIN 650',NULL,'1'),(31,12,'LARCO MOVILES',-8.117254,-79.032766,'AV. LARCO CUADRA #2',NULL,'1'),(32,12,'GRANADOS',-8.096098,-79.011683,'AV. FEDERICO VILLARREAL #238',NULL,'1'),(33,12,'ESPERANZA',-8.071784,-79.049033,'AV. TAHUANTINSUYO / M. BELGRANO',NULL,'1'),(34,12,'LAS FLORES',-8.130460,-79.045488,'CALLE VICTOR HAYA DE LA TORRE / PARQ. DE LAS AGUAS',NULL,'1'),(35,12,'LAREDO',-8.087005,-78.958642,'CALLE LOS JAZMINES',NULL,'1'),(36,12,'REAL PLAZA',-8.132060,-79.031491,'DENTRO DE REAL PLAZA/COSTADO ADIDAS',NULL,'1'),(37,12,'SALAVERRY',-8.222610,-78.976577,'CALLE TRUJILLO',NULL,'1'),(38,12,'PORVENIR',-8.085060,-79.000522,'AV. SANCHEZ CARRION #939',NULL,'1'),(39,12,'HUANCHACO',-8.081552,-79.121290,'CALLE LOS ROBLES',NULL,'1'),(40,12,'MOCHE',-8.168605,-79.009841,'CALLE LIBERTAD',NULL,'1'),(41,12,'AEROPUERTO',-8.085273,-79.107176,'DENTRO DE AEROPUERTO',NULL,'1'),(42,13,'VIRU',-8.416174,-78.750817,'0',NULL,'1');
/*!40000 ALTER TABLE `urds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`groups_id`),
  KEY `fk_users_groups1_idx` (`groups_id`),
  CONSTRAINT `fk_users_groups1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin','$2a$10$2peFsk71vR1I5vCbdSmpc.0TDI/BmTNN2Mxt5Y6knQCWZSFgPBDrm','1'),(2,2,'tecnico1','$2a$10$eGPQO9K2uueVYCHn0NPax.ivN5MGtsdWSnhObvZgIp961/nkn./bC','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-20 12:30:11
