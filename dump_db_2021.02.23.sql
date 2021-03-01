-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: fassi_cms
-- ------------------------------------------------------
-- Server version	10.3.25-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `catalogs`
--

DROP TABLE IF EXISTS `catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(7,2) NOT NULL,
  `year` smallint(5) unsigned NOT NULL,
  `store_id` bigint(20) unsigned NOT NULL,
  `provider_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catalogs_store_id_foreign` (`store_id`),
  KEY `catalogs_provider_id_foreign` (`provider_id`),
  KEY `catalogs_year_index` (`year`),
  CONSTRAINT `catalogs_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `catalogs_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogs`
--

LOCK TABLES `catalogs` WRITE;
/*!40000 ALTER TABLE `catalogs` DISABLE KEYS */;
INSERT INTO `catalogs` VALUES (1,3314.89,2019,2,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(2,3857.61,2019,2,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(3,1389.05,2019,3,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(4,4.84,2018,3,1,'2020-11-08 15:41:51','2020-11-21 14:34:20'),(5,2510.57,2019,4,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(6,2722.54,2020,4,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(7,3338.52,2019,5,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(8,2062.90,2020,5,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(9,4078.99,2018,6,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(10,4237.76,2019,6,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(11,187.34,2019,7,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(12,90.25,2019,7,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(13,1956.43,2018,8,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(14,3225.56,2018,8,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(15,2790.80,2020,9,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(16,231.17,2018,9,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(17,3657.87,2020,10,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(18,1055.21,2019,10,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(19,1830.19,2019,11,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(20,4361.08,2020,11,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(21,4291.11,2019,12,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(22,1138.70,2018,12,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(23,3169.25,2018,13,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(24,3074.78,2018,13,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(25,814.31,2020,14,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(26,4289.96,2020,14,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(27,106.64,2020,15,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(28,3600.52,2018,15,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(29,955.80,2018,16,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(30,3789.98,2019,16,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(31,2621.87,2020,17,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(32,2266.63,2020,17,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(33,4488.27,2020,18,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(34,1849.15,2019,18,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(35,1571.38,2018,19,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(36,3882.07,2018,19,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(37,598.28,2019,20,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(38,3440.25,2019,20,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(39,3492.25,2018,21,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(40,3554.31,2018,21,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(41,444.83,2019,22,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(42,2799.26,2019,22,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(43,2894.57,2018,23,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(44,1111.68,2019,23,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(45,3423.05,2020,24,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(46,2808.16,2018,24,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(47,436.92,2018,25,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(48,327.80,2018,25,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(49,3006.14,2019,26,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(50,4870.25,2018,26,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(51,4158.55,2019,27,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(52,4420.48,2018,27,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(53,4024.25,2018,28,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(54,1576.09,2019,28,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(55,3377.32,2018,29,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(56,4135.55,2018,29,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(57,1885.37,2020,30,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(58,1374.29,2019,30,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(59,4258.16,2020,31,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(60,666.61,2020,31,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(61,3938.90,2018,32,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(62,3486.89,2018,32,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(63,435.34,2020,33,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(64,4318.74,2018,33,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(65,3379.99,2019,34,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(66,2272.45,2018,34,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(67,3826.27,2020,35,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(68,1267.42,2019,35,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(69,190.65,2018,36,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(70,1622.01,2020,36,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(71,4697.29,2019,37,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(72,4101.37,2019,37,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(73,3464.76,2020,38,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(74,2322.92,2020,38,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(75,312.61,2020,39,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(76,4515.83,2018,39,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(77,4807.76,2020,40,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(78,407.94,2018,40,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(79,2113.30,2018,41,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(80,4235.44,2020,41,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(81,14.47,2020,51,5,'2020-11-18 18:08:05','2020-11-18 18:08:05'),(82,1.87,2020,52,4,'2020-11-18 18:17:28','2020-11-18 18:17:28'),(83,25.87,2020,53,6,'2020-11-18 18:21:15','2020-11-18 18:21:15'),(84,14.78,2020,54,5,'2020-11-18 20:00:45','2020-11-18 20:00:45'),(85,1.89,2020,56,10,'2020-11-21 14:29:33','2020-11-21 14:30:13'),(86,0.87,2020,58,5,'2020-11-21 14:44:21','2020-11-21 14:44:21'),(87,147.45,2020,59,2,'2020-11-22 17:15:35','2020-11-22 17:15:35'),(88,0.58,2020,60,4,'2020-12-11 20:15:38','2020-12-11 20:15:38'),(89,1.20,2020,61,4,'2020-12-11 20:19:21','2020-12-11 20:19:21'),(90,0.58,2020,62,4,'2020-12-12 15:24:48','2020-12-12 15:24:48'),(91,1.50,2020,63,4,'2020-12-15 13:02:33','2020-12-15 13:40:56'),(92,4.00,2020,65,9,'2020-12-15 13:22:13','2020-12-15 13:41:21'),(218,2722.54,2021,4,1,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(219,2062.90,2021,5,1,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(220,2790.80,2021,9,1,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(221,3657.87,2021,10,1,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(222,4361.08,2021,11,1,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(223,814.31,2021,14,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(224,4289.96,2021,14,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(225,106.64,2021,15,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(226,2621.87,2021,17,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(227,2266.63,2021,17,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(228,4488.27,2021,18,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(229,3423.05,2021,24,3,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(230,1885.37,2021,30,3,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(231,4258.16,2021,31,3,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(232,666.61,2021,31,3,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(233,435.34,2021,33,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(234,3826.27,2021,35,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(235,1622.01,2021,36,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(236,3464.76,2021,38,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(237,2322.92,2021,38,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(238,312.61,2021,39,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(239,4807.76,2021,40,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(240,4235.44,2021,41,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(241,14.47,2021,51,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(242,1.87,2021,52,4,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(243,25.87,2021,53,6,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(244,14.78,2021,54,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(245,1.89,2021,56,10,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(246,0.87,2021,58,5,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(247,147.45,2021,59,2,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(248,0.58,2021,60,4,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(249,1.20,2021,61,4,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(250,0.58,2021,62,4,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(251,1.50,2021,63,4,'2021-02-18 18:20:30','2021-02-18 18:20:30'),(252,4.00,2021,65,9,'2021-02-18 18:20:30','2021-02-18 18:20:30');
/*!40000 ALTER TABLE `catalogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clockings`
--

DROP TABLE IF EXISTS `clockings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clockings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `start_date` datetime NOT NULL,
  `stop_date` datetime DEFAULT NULL,
  `technician_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `worksheet_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clockings_technician_id_foreign` (`technician_id`),
  KEY `clockings_user_id_foreign` (`user_id`),
  KEY `clockings_date_index` (`date`),
  KEY `clockings_start_date_index` (`start_date`),
  KEY `clockings_stop_date_index` (`stop_date`),
  KEY `clockings_worksheet_id_foreign_idx` (`worksheet_id`),
  CONSTRAINT `clockings_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`),
  CONSTRAINT `clockings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `clockings_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clockings`
--

LOCK TABLES `clockings` WRITE;
/*!40000 ALTER TABLE `clockings` DISABLE KEYS */;
INSERT INTO `clockings` VALUES (1,'2021-01-26','2021-01-26 10:30:00','2021-01-26 14:35:00',1,1,'2021-01-26 17:33:00','2021-01-30 08:49:14',11),(7,'2021-01-13','2021-01-13 14:28:00','2021-01-13 16:42:00',5,1,'2021-02-06 14:47:30','2021-02-07 18:11:31',17),(8,'2020-12-30','2020-12-30 09:56:00','2020-12-30 16:18:00',12,1,'2021-02-07 15:04:58','2021-02-07 18:11:31',17),(9,'2021-02-24','2021-02-24 08:00:00','2021-02-24 09:48:00',1,1,'2021-02-07 17:00:36','2021-02-07 18:11:31',17),(10,'2021-02-24','2021-02-24 10:26:00','2021-02-24 12:30:00',7,1,'2021-02-07 17:10:52','2021-02-07 18:11:31',17),(11,'2021-01-07','2021-01-07 07:35:00','2021-01-07 12:30:00',15,1,'2021-02-07 18:11:16','2021-02-07 18:11:31',17);
/*!40000 ALTER TABLE `clockings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cranes`
--

DROP TABLE IF EXISTS `cranes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cranes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cranes_serial_unique` (`serial`),
  KEY `cranes_user_id_foreign` (`user_id`),
  CONSTRAINT `cranes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cranes`
--

LOCK TABLES `cranes` WRITE;
/*!40000 ALTER TABLE `cranes` DISABLE KEYS */;
INSERT INTO `cranes` VALUES (1,'Test-001','Blue test de modification II','1-klm-254','2020-11-07 16:43:36','2021-01-02 12:03:19',NULL),(2,'Test-002','Blue and Red','1-lok-587','2020-11-07 16:53:07','2020-11-07 16:53:07',NULL),(3,'26-877PMHTED58','Low Charge','1-SBB-581','2020-12-26 14:00:39','2021-01-02 12:03:57',NULL),(4,'59PMHTED58','Light Soft','1-TTE-78','2020-12-26 14:05:09','2020-12-26 14:05:09',NULL),(5,'26-877PMHTED58-47','Low format','1-TAA-78','2020-12-26 14:16:33','2020-12-26 14:16:33',NULL),(7,'7PMHTED58-47','Low format','1-TFA-78','2020-12-26 14:20:52','2020-12-26 14:20:52',NULL),(8,'REM951REM','Nacy','1-TFA-879','2020-12-26 14:21:59','2020-12-26 14:21:59',NULL),(9,'REM95891REM','Nacy II','1-THE-987','2020-12-26 14:24:04','2020-12-26 14:24:04',NULL),(10,'REM105847FT','Mimi I','1-SBB-588','2020-12-26 14:30:00','2020-12-26 14:30:00',NULL),(11,'REM8988758447P','MIMI II','1-SSS-999','2020-12-26 14:32:20','2020-12-26 14:32:20',NULL),(12,'REM78985874','MIMI IV','1-SSS-879','2020-12-26 16:49:43','2020-12-26 16:49:43',NULL),(13,'89DE1298','Test blue','1-OOP-987','2021-01-02 12:11:05','2021-01-02 12:11:05',NULL),(14,'MNTY78951','Cat II','1-ABC-012','2021-01-10 12:20:21','2021-01-10 12:20:21',NULL),(15,'MOP8974','CAT 14','1-TRE-987','2021-01-10 12:21:44','2021-01-10 12:21:44',NULL),(17,'Y47','FASSI 25','1-RFC-985','2021-01-10 13:47:05','2021-01-10 14:05:42',1),(19,'TRE98754','FASSI T','1-YTR-965','2021-01-10 13:53:34','2021-01-10 13:53:34',NULL);
/*!40000 ALTER TABLE `cranes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_optional` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BELGIQUE',
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (2,'MO Consult','Rue Sainte Barbe 8','bte','Orp-Le-Grand','1350','Belgique','serge.moers@mo-consult.be','0477434312','0477434312','BE7825.255.255','2020-11-30 18:25:04','2020-11-30 18:25:04',NULL),(3,'Robel, Heaney and Bernier','150 Pearl Forges\nLesterville, MO 55878',NULL,'West Mavisland','70093-5682','Belgique','donna91@corwin.com','329.643.7983','+6996819814422','BE177.255.255','2020-12-01 18:20:04','2020-12-01 18:20:04',NULL),(4,'Feest Group','211 Rachelle Drive Suite 219\nKshlerinberg, DC 83104',NULL,'Maudshire','93954-5621','Belgique','sam27@barton.net','1-825-671-1688','+2262712928868','BE177.255.255','2020-12-01 18:20:04','2020-12-01 18:20:04',NULL),(5,'Fadel-Dicki','91997 Herzog Divide\nPort Lewis, NM 02486-5272',NULL,'New Raleigh','13124-4261','Belgique','sipes.alfonzo@friesen.biz','(490) 895-9142','+3014700707477','BE177.255.255','2020-12-01 18:20:04','2020-12-01 18:20:04',NULL),(6,'Quitzon LLC','21903 Arianna Meadows\nSouth Randyshire, KY 92280',NULL,'West Guillermo','58988-2631','Belgique','bkreiger@cruickshank.biz','1-618-488-6029','+4595249797425','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(7,'Johnston Inc','6558 Darby Burgs\nPort Barry, MT 30795-9279',NULL,'East Pierce','68813','Belgique','xpredovic@gutkowski.net','1-590-842-4947','+6659380598553','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(8,'Stiedemann, Orn and Crona','253 Stehr Pass\nWest Nevaton, CA 38788',NULL,'East Wellington','28281-5633','Belgique','sarina88@walsh.org','887.542.4009 x487','+9588819741544','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(9,'VonRueden Group','6233 Susie Roads\nMyrnashire, MD 07069',NULL,'Port Jamarcusmouth','62458-4362','Belgique','akuhic@blick.com','1-807-910-0028 x0501','+5254428033131','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(10,'Heaney Group','15791 Willms Drive Suite 315\nObiestad, NY 96889-4440',NULL,'East Danielafort','57694','Belgique','lysanne.corkery@smitham.info','(928) 987-1517','+2172999590866','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(11,'Waters-Hegmann','7142 Adrienne Shore\nLake Nelson, IL 38258-6287',NULL,'Olliehaven','16087','Belgique','hodkiewicz.presley@lindgren.com','1-891-662-2021','+8774456538205','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(12,'Hackett Inc','12590 Champlin Stravenue\nPaulinemouth, TX 86343-8882',NULL,'Port Herman','73708','Belgique','bernhard.edgar@dickens.info','508.428.3523 x02964','+1127306193765','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(13,'Hill, Turcotte and Herman','6983 Fritsch Lake\nZulaufmouth, IA 63640',NULL,'Balistreriborough','78915','Belgique','alexzander.kemmer@krajcik.com','480-445-9515 x740','+8598111376318','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(14,'Blick, Marvin and Hansen','9520 Maya Ramp Suite 288\nSouth Zacheryborough, WI 50378',NULL,'West Eve','38406','Belgique','michel26@yost.info','576-967-7223 x2531','+8990430851080','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(15,'Nolan LLC','20772 Casimir Freeway Suite 920\nParkerside, WI 66650-9676',NULL,'East Jaylon','23955','Belgique','kbechtelar@kiehn.net','(849) 425-7395 x073','+3277614172470','BE177.255.255','2020-12-01 18:21:53','2020-12-01 18:21:53',NULL),(16,'SPRL TESTO','Rue de la cure 1','Test555','Jauche','1350','Belgique','louis.moers@gmail.com','019634305',NULL,'BE478.855.855','2020-12-26 14:45:59','2021-01-03 09:46:16',NULL),(17,'SPRL Pneu','Rue des tombes 23',NULL,'Orp-Jauche','1350','Belgique',NULL,'019/63.43.05',NULL,NULL,'2021-01-02 16:08:08','2021-01-02 16:19:51',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (23,'2014_10_12_000000_create_users_table',1),(24,'2014_10_12_100000_create_password_resets_table',1),(25,'2019_08_19_000000_create_failed_jobs_table',1),(26,'2020_10_07_104724_create_permission_tables',1),(27,'2020_10_29_183249_create_customers_table',1),(28,'2020_10_31_103712_create_worksheets_table',1),(29,'2020_10_31_110053_create_cranes_table',1),(35,'2020_11_08_113451_create_stores_table',7),(36,'2020_11_08_113628_create_providers_table',8),(37,'2020_11_08_113559_create_catalogs_table',9),(38,'2020_11_08_113739_create_reasons_table',10),(39,'2020_11_08_113711_create_reassortements_table',11),(40,'2020_11_08_113649_create_outs_table',1),(41,'2020_11_24_174920_add_user_to_reassortements',12),(42,'2020_11_24_181931_add_user_to_outs',13),(43,'2020_11_25_182745_add_description_outs_table',14),(44,'2020_11_25_182805_add_description_reason_reassortements_table',15),(45,'2020_11_25_191345_add_option_reasons_table',15),(47,'2020_11_27_163227_create_zipcodes_table',16),(48,'2020_12_04_131254_create_parts_table',17),(49,'2020_12_04_133928_add_part_id_worksheets_table',18),(50,'2020_12_04_134126_add_user_id_worksheets_table',18),(52,'2020_12_07_171838_remove_id_part_worksheets_table',19),(53,'2020_12_07_171431_add_id_worksheet_parts_table',20),(54,'2020_12_15_082017_add_bar_code_stores_table',21),(55,'2020_12_15_132715_add_bar_code_parts_table',21),(56,'2020_12_20_153905_modify_oil_replace_worksheets_table',22),(57,'2021_01_03_165240_create_view_worksheets_customers_cranes',23),(58,'2021_01_10_150101_add__user__cranes__table',24),(59,'2021_01_10_150123_add__user__customer__table',24),(61,'2021_01_10_152526_create__technicians__table',25),(62,'2021_01_10_152549_create__clockings__table',25),(63,'2021_01_10_152152_add__clocking__worksheet_table',26);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outs`
--

DROP TABLE IF EXISTS `outs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qty_pull` smallint(5) unsigned NOT NULL,
  `qty_before` smallint(5) unsigned NOT NULL,
  `reason_id` bigint(20) unsigned NOT NULL,
  `store_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outs_reason_id_foreign` (`reason_id`),
  KEY `outs_store_id_foreign` (`store_id`),
  KEY `outs_user_id_foreign` (`user_id`),
  CONSTRAINT `outs_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `outs_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `outs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outs`
--

LOCK TABLES `outs` WRITE;
/*!40000 ALTER TABLE `outs` DISABLE KEYS */;
INSERT INTO `outs` VALUES (1,10,30,3,59,'2020-11-26 18:14:08','2020-11-26 18:14:08',1,'Attention correction'),(2,1,147,2,58,'2020-12-10 18:05:35','2020-12-10 18:05:35',1,'Attention correction'),(3,10,146,2,58,'2020-12-10 18:08:41','2020-12-10 18:08:41',1,'Attention correction'),(5,2,30,6,59,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,'20201204193500'),(6,1,10,6,52,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,'20201204193500'),(7,2,2,6,51,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,'20201204193500'),(9,1,28,6,59,'2020-12-14 18:45:12','2020-12-14 18:45:12',1,'20201203200228'),(10,1,1,6,54,'2020-12-14 18:45:12','2020-12-14 18:45:12',1,'20201203200228'),(11,2,10,6,63,'2020-12-15 14:52:03','2020-12-15 14:52:03',1,'20201204193500'),(12,3,10,6,65,'2020-12-15 14:52:03','2020-12-15 14:52:03',1,'20201204193500'),(13,4,44,6,63,'2020-12-16 10:59:57','2020-12-16 10:59:57',1,'20201204193500'),(16,4,252,6,5,'2021-02-18 18:33:52','2021-02-18 18:33:52',1,'20210110145253'),(17,4,150,6,51,'2021-02-18 18:33:52','2021-02-18 18:33:52',1,'20210110145253'),(18,8,9,6,52,'2021-02-18 18:33:52','2021-02-18 18:33:52',1,'20210110145253');
/*!40000 ALTER TABLE `outs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` smallint(6) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `year` smallint(5) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `worksheet_id` bigint(20) unsigned DEFAULT NULL,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parts_user_id_foreign` (`user_id`),
  KEY `parts_worksheet_id_foreign` (`worksheet_id`),
  CONSTRAINT `parts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `parts_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'12-3456789','Machine plo',2,147.45,2020,1,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,''),(2,'01201185suuuu','tesg',1,1.87,2020,1,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,''),(3,'01201185s','testdfqdfqdgdqfgdf',2,14.47,2020,1,'2020-12-14 18:38:09','2020-12-14 18:38:09',1,''),(5,'12-3456789','Machine plo',1,147.45,2020,1,'2020-12-14 18:45:12','2020-12-14 18:45:12',9,''),(6,'1-98-98','testdfqdfqdgdqfgdf',1,14.78,2020,1,'2020-12-14 18:45:12','2020-12-14 18:45:12',9,''),(7,'G-35H','EMV Valve',2,1.50,2020,1,'2020-12-15 14:52:03','2020-12-15 14:52:03',1,'10000015871'),(8,'G35-H147','EVM Valve H147',3,4.00,2020,1,'2020-12-15 14:52:03','2020-12-15 14:52:03',1,'10000015872'),(11,'01201185','Corporis minima maiores autem distinctio cum itaque autem. Aut quia eos quos debitis impedit. Et dolorem dolorem sed voluptatem ratione provident facilis.',4,2062.90,2021,1,'2021-02-18 18:33:52','2021-02-18 18:33:52',17,'01201185'),(12,'01201185s','testdfqdfqdgdqfgdf',4,14.47,2021,1,'2021-02-18 18:33:52','2021-02-18 18:33:52',17,'01201185s'),(13,'01201185suuuu','tesg',8,1.87,2021,1,'2021-02-18 18:33:52','2021-02-18 18:33:52',17,'01201185suuuu');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'create worksheet','web','2021-02-22 18:56:21','2021-02-22 18:56:21'),(2,'edit worksheet','web','2021-02-22 18:56:30','2021-02-22 18:56:30'),(3,'delete worksheet','web','2021-02-22 18:56:37','2021-02-22 18:56:37');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `providers_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'Volkman, Thompson and Conroy','2020-11-08 15:39:53','2020-11-08 15:39:53'),(2,'Hills-Gorczany','2020-11-08 15:39:53','2020-11-08 15:39:53'),(3,'Gleason, Conn and Mitchell','2020-11-08 15:39:53','2020-11-08 15:39:53'),(4,'Fadel-Moen','2020-11-08 15:39:53','2020-11-08 15:39:53'),(5,'Franecki-Walter','2020-11-08 15:39:53','2020-11-08 15:39:53'),(6,'Wisozk Inc','2020-11-08 15:39:53','2020-11-08 15:39:53'),(7,'Kozey Inc','2020-11-08 15:39:53','2020-11-08 15:39:53'),(8,'Pfeffer, Bins and Goodwin','2020-11-08 15:39:53','2020-11-08 15:39:53'),(9,'Jenkins-Smith','2020-11-08 15:39:53','2020-11-08 15:39:53'),(10,'Pouros-Murray','2020-11-08 15:39:53','2020-11-08 15:39:53');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reasons`
--

DROP TABLE IF EXISTS `reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reasons`
--

LOCK TABLES `reasons` WRITE;
/*!40000 ALTER TABLE `reasons` DISABLE KEYS */;
INSERT INTO `reasons` VALUES (1,'Warranty',NULL,NULL,'O'),(2,'Stock correction',NULL,NULL,'O'),(3,'Manual',NULL,NULL,'O'),(4,'Reassortment',NULL,NULL,'R'),(5,'Back in stock',NULL,NULL,'R'),(6,'Worksheet',NULL,NULL,'A'),(8,'New part',NULL,NULL,'E');
/*!40000 ALTER TABLE `reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reassortements`
--

DROP TABLE IF EXISTS `reassortements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reassortements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qty_add` smallint(5) unsigned NOT NULL,
  `qty_before` smallint(5) unsigned NOT NULL,
  `store_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reassortements_store_id_foreign` (`store_id`),
  KEY `reassortements_user_id_foreign` (`user_id`),
  KEY `reassortements_reason_id_foreign` (`reason_id`),
  CONSTRAINT `reassortements_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reassortements_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reassortements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reassortements`
--

LOCK TABLES `reassortements` WRITE;
/*!40000 ALTER TABLE `reassortements` DISABLE KEYS */;
INSERT INTO `reassortements` VALUES (3,10,10,59,'2020-11-24 19:15:34','2020-11-24 19:15:34',1,NULL,0),(4,5,20,59,'2020-11-24 19:20:09','2020-11-24 19:20:09',1,NULL,0),(5,5,25,59,'2020-11-24 19:22:05','2020-11-24 19:22:05',1,NULL,0),(6,10,20,59,'2020-11-26 18:33:07','2020-11-26 18:33:07',1,NULL,4),(7,10,136,58,'2020-12-10 18:09:10','2020-12-10 18:09:10',1,NULL,4),(8,10,0,62,'2020-12-12 15:24:48','2020-12-12 15:24:48',1,NULL,8),(9,150,0,54,'2020-12-14 18:46:38','2020-12-14 18:46:38',1,NULL,4),(10,150,0,51,'2020-12-14 18:50:05','2020-12-14 18:50:05',1,NULL,4),(11,10,0,63,'2020-12-15 13:02:33','2020-12-15 13:02:33',1,NULL,8),(12,10,0,65,'2020-12-15 13:22:13','2020-12-15 13:22:13',1,NULL,8),(13,25,8,63,'2020-12-16 08:20:04','2020-12-16 08:20:04',1,'test',4),(14,4,33,63,'2020-12-16 09:28:56','2020-12-16 09:28:56',1,'20201204193500',6),(15,7,37,63,'2020-12-16 09:49:39','2020-12-16 09:49:39',1,'20201203200228',6);
/*!40000 ALTER TABLE `reassortements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,2),(2,2),(3,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2020-11-07 18:28:06','2020-11-07 18:28:06'),(2,'manager','web','2021-02-22 18:42:37','2021-02-22 18:42:37');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` smallint(5) unsigned NOT NULL,
  `location` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_part_number_unique` (`part_number`),
  KEY `stores_part_number_index` (`part_number`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,'91482723','Neque aut sed minima. Consequatur suscipit laborum eius laboriosam. Et optio quis commodi et. Amet in voluptatum voluptatibus cumque dolores provident deserunt mollitia.',721,NULL,1,'2020-11-08 15:35:28','2020-11-08 15:35:28','91482723'),(2,'89473887','Exercitationem animi possimus at id aut doloribus et. Qui illo sed et ipsam. Architecto laborum voluptatem quis error architecto. Et quo voluptate asperiores ex eos cupiditate alias. Nemo eius consequatur quod est. Nihil cupiditate nam aut et rem.',442,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','89473887'),(3,'80171935','Possimus recusandae ullam magnam quo non dolor maiores. Assumenda non tempora id. Aut veritatis qui inventore. Dolores dolores odit nemo necessitatibus. Numquam quae sequi ut.',567,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','80171935'),(4,'37751586','Quidem consequatur dolore eum officiis enim. Qui perferendis et et et quo eligendi earum. Est nostrum nemo explicabo provident ipsum.',1,NULL,1,'2020-11-08 15:41:51','2020-11-21 14:23:59','37751586'),(5,'01201185','Corporis minima maiores autem distinctio cum itaque autem. Aut quia eos quos debitis impedit. Et dolorem dolorem sed voluptatem ratione provident facilis.',248,NULL,1,'2020-11-08 15:41:51','2021-02-18 18:33:52','01201185'),(6,'04036258','Quos aliquid cumque autem beatae. Sequi facilis saepe vitae quia. Ullam rem ullam temporibus sit.',59,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','04036258'),(7,'17961202','Velit beatae perferendis iure quod at accusamus. Nesciunt quae tempora ab facere unde cumque consequatur. Repellendus quaerat qui iure ut et nobis exercitationem.',285,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','17961202'),(8,'88324562','Vitae cupiditate aut sunt non. Aut rerum at et saepe atque.',600,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','88324562'),(9,'79529877','Expedita natus quia sunt modi in esse voluptas in. Iste excepturi eligendi odit saepe vel molestiae. Aliquid neque ullam sit qui adipisci officia.',100,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','79529877'),(10,'72196717','Quos et occaecati repellendus. Amet architecto repellendus consequuntur sed qui ut unde eligendi. Minima sapiente accusantium quaerat.',856,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','72196717'),(11,'19867359','Facere ad vitae suscipit perferendis nam ipsam ut. Doloribus magnam ea et eligendi. Distinctio sit eius et mollitia. Consequatur accusantium animi minima modi illo exercitationem.',845,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51','19867359'),(12,'07271458','Ipsum molestiae occaecati in id. Dicta omnis ab qui necessitatibus et sed ratione beatae. Tempore sed commodi neque. Possimus et consequatur ducimus voluptas unde.',512,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','07271458'),(13,'02078625','Et non eaque sint explicabo. Culpa eligendi nam consequatur eaque totam iure ab dolor. Fugit omnis nemo molestiae sunt adipisci non.',682,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','02078625'),(14,'62476287','Hic cum esse ab molestias aut. Voluptas ducimus et numquam vel voluptates voluptas aut. Aut repellendus optio velit non incidunt. Nobis vel quis sit. Sed impedit repellat nisi voluptate itaque. Eius voluptatibus hic doloremque magnam culpa vero omnis.',185,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','62476287'),(15,'08774118','Et expedita iste adipisci. Dolores rerum repellat cupiditate adipisci natus repellat delectus. Accusantium ab qui eius vitae corporis.',720,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','08774118'),(16,'78923072','Perspiciatis nam perferendis voluptate et et reprehenderit sunt. Qui corporis et architecto perspiciatis quia. Esse minima cumque ab doloremque est labore qui.',758,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','78923072'),(17,'60399748','Aut est temporibus numquam et libero ea repellendus. Sed in quis saepe cumque iste. Excepturi recusandae eius aut officiis illo debitis. Ullam voluptas est exercitationem saepe.',334,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','60399748'),(18,'39350374','Dolore et porro ea mollitia nihil iusto. Voluptas aut sed sapiente non recusandae error. Distinctio praesentium eius rerum voluptatem ab dolores neque. Aliquid consectetur molestias eveniet natus.',783,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31','39350374'),(19,'90506611','Mollitia ut voluptas doloribus molestiae adipisci. Qui commodi cum modi autem delectus. Quia voluptas officiis ut non. Quas ducimus quo asperiores autem.',899,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32','90506611'),(20,'22645265','Ut odio et voluptatibus enim ipsam. Quod deleniti ut placeat velit. Quos ea et a sequi id qui libero tenetur. Ut non tempora sint et. Laudantium voluptates modi non. Repellat saepe libero iste nostrum aut autem. Unde sed beatae in ut.',272,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32','22645265'),(21,'21403576','Odit eos autem repudiandae qui adipisci amet possimus animi. Nihil quidem reiciendis et ea aut. Pariatur vel recusandae omnis alias nihil. Voluptate rerum minima laboriosam omnis at dignissimos sit.',189,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32','21403576'),(22,'18930931','A reiciendis illo culpa blanditiis beatae alias. Blanditiis ut dolor hic amet esse veritatis. Maxime omnis in quam aut beatae.',233,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','18930931'),(23,'15968272','Earum hic placeat qui labore et nesciunt. Vel porro beatae nostrum voluptas. Est vel magnam nemo corrupti. Aspernatur omnis doloremque ratione quo.',642,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','15968272'),(24,'88857381','Architecto omnis excepturi quo. Eius aut velit explicabo dolore et aliquid. Iusto dolore nobis recusandae consequatur voluptates voluptatum. Facere officia excepturi tempora soluta reprehenderit autem ad. Sunt aspernatur distinctio earum suscipit.',881,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','88857381'),(25,'44797911','Quaerat consequatur iste est quaerat non ratione sint voluptates. Magni natus nobis cupiditate. Rerum at corrupti dignissimos nisi.',58,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','44797911'),(26,'36980208','Aut quam vitae atque vero dolorum. Et itaque fugit sapiente fugiat. Ut quis nesciunt aliquid voluptas tenetur consequatur. Rem in perspiciatis iusto eaque voluptatem consequatur. Temporibus velit enim quo itaque voluptas.',116,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','36980208'),(27,'71603827','Eos molestiae quis ex non fugiat voluptatem. Iusto fuga labore enim ipsam nulla. Repellendus minus quos minus molestiae nisi. Sunt fugiat nemo ipsum maiores aut et. Mollitia nam natus in id sed ullam.',537,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','71603827'),(28,'14091308','Et totam et eum dolores et. Quia vel repellat cupiditate accusantium dignissimos. Rem sed quam magnam similique itaque vitae. Dolorem nulla et laboriosam dolorem iusto non. Doloribus velit sit dignissimos.',496,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','14091308'),(29,'68804336','Omnis eum ea quia non labore ipsum sit. Tempore inventore recusandae dignissimos aut culpa nostrum cumque. Nemo atque perspiciatis natus itaque.',882,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','68804336'),(30,'70530742','Et nostrum et dolores iure sint. Adipisci et pariatur atque ullam occaecati qui sed. Libero totam voluptatem voluptas dolorem atque sit et. Libero quod laborum autem amet.',890,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','70530742'),(31,'91127686','Nobis corrupti quas rerum molestiae. Soluta libero assumenda qui omnis amet repudiandae.',980,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43','91127686'),(32,'75941314','Eum fuga ut sunt similique. Voluptatem non voluptas praesentium cumque aut mollitia quae. Quas consequatur quas ut doloremque et assumenda. Tempore non voluptatem enim ut doloribus error tempora.',177,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','75941314'),(33,'68526801','Fugiat exercitationem delectus ut saepe. Facilis labore impedit voluptatem iure consequatur sed. Sed illo aliquam quo excepturi est nihil. Temporibus nesciunt voluptas maxime asperiores esse autem. Ab magni fugiat praesentium.',421,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','68526801'),(34,'34563786','Dolorem maxime accusantium voluptate ea earum. Ut voluptatem porro explicabo ex minima. Est blanditiis ex quod est ea quidem ex.',229,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','34563786'),(35,'96210567','Et animi suscipit aperiam. Quaerat nam praesentium neque. Quis ut aut et earum voluptas dolores odit. Aspernatur aut laborum vel.',656,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','96210567'),(36,'82714529','Velit commodi delectus ex. Quos quae quis tenetur. Inventore et eius iusto quaerat odit asperiores.',351,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','82714529'),(37,'09547285','Distinctio atque alias quos vel et incidunt. Id incidunt a a temporibus. Eum quaerat minima voluptatibus corrupti eos. Numquam maiores magnam aspernatur pariatur. Ullam rem harum optio omnis harum est dolorum aut. Praesentium commodi sequi voluptatibus.',811,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','09547285'),(38,'96523810','Quo corrupti dolor iure modi unde ea libero. Perspiciatis veniam est ea labore ex. Accusamus eum praesentium minima voluptatibus sit ut velit nobis.',892,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','96523810'),(39,'17567312','Ea et aut qui ipsam. Eos esse dolor qui voluptatibus error amet doloribus laboriosam. Officiis corporis ut voluptas architecto itaque. Facere incidunt et sunt hic.',457,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','17567312'),(40,'25858600','Id labore sequi omnis sunt. Cumque nihil omnis tempore architecto minima. Nesciunt nulla ea sunt numquam eaque. Qui et hic facilis facere velit vitae fuga explicabo.',155,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','25858600'),(41,'86453301','Adipisci sint voluptatibus velit reiciendis natus. Quo saepe fuga rerum itaque explicabo quod similique. Nihil quia iure molestiae nostrum magnam earum libero voluptatem.',32,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53','86453301'),(51,'01201185s','testdfqdfqdgdqfgdf',146,NULL,1,'2020-11-18 18:08:05','2021-02-18 18:33:52','01201185s'),(52,'01201185suuuu','tesg',1,'LOC',1,'2020-11-18 18:17:28','2021-02-18 18:33:52','01201185suuuu'),(53,'li4879547','li test',187,'LOC',1,'2020-11-18 18:21:15','2020-11-18 18:21:15','li4879547'),(54,'1-98-98','testdfqdfqdgdqfgdf',150,'LOC',1,'2020-11-18 20:00:45','2020-12-14 18:46:38','1-98-98'),(56,'1-789','nuts',14,NULL,1,'2020-11-21 14:29:33','2020-11-21 14:29:33','1-789'),(58,'1-23','screw',146,NULL,1,'2020-11-21 14:44:21','2020-12-10 18:09:10','1-23'),(59,'12-3456789','Machine plo',27,NULL,1,'2020-11-22 17:15:35','2020-12-14 18:45:12','12-3456789'),(60,'1-47','Vis 14\'',150,NULL,1,'2020-12-11 20:15:38','2020-12-11 20:15:38','1-47'),(61,'1-48','boulon 48/87',140,NULL,1,'2020-12-11 20:19:21','2020-12-11 20:19:21','1-48'),(62,'1-4787877','Joint',10,NULL,1,'2020-12-12 15:24:48','2020-12-12 15:24:48','1-4787877'),(63,'G-35H','EMV Valve',40,NULL,1,'2020-12-15 13:02:33','2020-12-16 10:59:57','10000015871'),(65,'G35-H147','EVM Valve H147',7,NULL,1,'2020-12-15 13:22:13','2020-12-15 14:52:03','10000015872');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technicians`
--

DROP TABLE IF EXISTS `technicians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technicians` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `technicians_number_unique` (`number`),
  KEY `technicians_user_id_foreign` (`user_id`),
  CONSTRAINT `technicians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technicians`
--

LOCK TABLES `technicians` WRITE;
/*!40000 ALTER TABLE `technicians` DISABLE KEYS */;
INSERT INTO `technicians` VALUES (1,20210126183200,'Tonon','Jules',1,1,'2021-01-25 23:00:00','2021-01-25 23:00:00'),(2,21210206110613,'Skiles','Margarita',1,1,'2021-02-06 10:06:13','2021-02-06 10:06:13'),(3,21210206110623,'Eichmann','Florida',1,1,'2021-02-06 10:06:23','2021-02-06 10:06:23'),(4,21210206110633,'Schumm','Cedrick',1,1,'2021-02-06 10:06:33','2021-02-06 10:06:33'),(5,21210206110643,'Smitham','Josianne',1,1,'2021-02-06 10:06:43','2021-02-06 10:06:43'),(6,21210206110653,'Kertzmann','Dandre',1,1,'2021-02-06 10:06:53','2021-02-06 10:06:53'),(7,21210206110703,'Bailey','Adolphus',1,1,'2021-02-06 10:07:03','2021-02-06 10:07:03'),(8,21210206110713,'Gislason','Onie',1,1,'2021-02-06 10:07:13','2021-02-06 10:07:13'),(9,21210206110723,'Leannon','Brianne',1,1,'2021-02-06 10:07:23','2021-02-06 10:07:23'),(10,21210206110733,'Ziemann','Callie',1,1,'2021-02-06 10:07:33','2021-02-06 10:07:33'),(11,21210206110743,'Auer','Joshua',1,1,'2021-02-06 10:07:43','2021-02-06 10:07:43'),(12,21210206110753,'O\'Conner','Candida',1,1,'2021-02-06 10:07:53','2021-02-06 10:07:53'),(13,21210206110803,'Muller','Enid',1,1,'2021-02-06 10:08:03','2021-02-06 10:08:03'),(14,21210206110813,'Weber','Greyson',1,1,'2021-02-06 10:08:13','2021-02-06 10:08:13'),(15,21210206110823,'Beatty','Dayna',1,1,'2021-02-06 10:08:23','2021-02-06 10:08:23'),(16,21210206110833,'Kuphal','Lexi',1,1,'2021-02-06 10:08:33','2021-02-06 10:08:33');
/*!40000 ALTER TABLE `technicians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Moers','Serge',1,'fr','serge.moers@mo-consult.be',NULL,'$2y$10$DLA1UdpGAKmirU0b31ngVeao1fzwJZ.4id3Cm2TplcsJoaKtHSwGm',NULL,'2020-10-31 11:24:09','2020-10-31 11:24:09'),(2,'De Haese','Hans',1,'nl','hans@fassibelgium.com',NULL,'$2y$10$1WfG8QfBDv3cNaGhl8tjT.Eeh4SOKMZBhCi5p9BUcFJtKuWEBPgBq',NULL,'2021-02-22 18:22:57','2021-02-22 18:22:57'),(4,'Dodemont','Eric',1,'fr','eric@fassibelgium.com',NULL,'$2y$10$edmKa5is5tuu6S4wLpgdXexoBaFL7gY79aVSgF6E.qcrel4hj35g.',NULL,'2021-02-22 18:24:06','2021-02-22 18:24:06'),(5,'Godechal','Amandine',1,'fr','administration@fassibelgium.com',NULL,'$2y$10$iZOsMGAxrjlc6xyeR4dRbOn1sXe6SmAM5IBfJaYwQjBEXYeoE.ioK',NULL,'2021-02-22 18:24:17','2021-02-22 18:24:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_clocking_extended`
--

DROP TABLE IF EXISTS `view_clocking_extended`;
/*!50001 DROP VIEW IF EXISTS `view_clocking_extended`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_clocking_extended` (
  `lastname` tinyint NOT NULL,
  `firstname` tinyint NOT NULL,
  `fullname` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `start_date` tinyint NOT NULL,
  `stop_date` tinyint NOT NULL,
  `technician_id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `worksheet_id` tinyint NOT NULL,
  `start_date_d` tinyint NOT NULL,
  `stop_date_d` tinyint NOT NULL,
  `start_time` tinyint NOT NULL,
  `stop_time` tinyint NOT NULL,
  `diff` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_clocking_total`
--

DROP TABLE IF EXISTS `view_clocking_total`;
/*!50001 DROP VIEW IF EXISTS `view_clocking_total`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_clocking_total` (
  `worksheet_id` tinyint NOT NULL,
  `total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_worksheets_customers_cranes`
--

DROP TABLE IF EXISTS `view_worksheets_customers_cranes`;
/*!50001 DROP VIEW IF EXISTS `view_worksheets_customers_cranes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_worksheets_customers_cranes` (
  `id` tinyint NOT NULL,
  `number` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `validated` tinyint NOT NULL,
  `validated_date` tinyint NOT NULL,
  `customer_id` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `crane_id` tinyint NOT NULL,
  `serial` tinyint NOT NULL,
  `plate` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `worksheets`
--

DROP TABLE IF EXISTS `worksheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worksheets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oil_filtered` tinyint(1) NOT NULL DEFAULT 0,
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `validated_date` datetime DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `crane_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `oil_replace` decimal(7,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `worksheets_number_unique` (`number`),
  KEY `worksheets_user_id_foreign` (`user_id`),
  KEY `worksheets_id_crane_foreign` (`crane_id`),
  KEY `worksheets_id_customer_foreign` (`customer_id`),
  CONSTRAINT `worksheets_id_crane_foreign` FOREIGN KEY (`crane_id`) REFERENCES `cranes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `worksheets_id_customer_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `worksheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worksheets`
--

LOCK TABLES `worksheets` WRITE;
/*!40000 ALTER TABLE `worksheets` DISABLE KEYS */;
INSERT INTO `worksheets` VALUES (1,20201204193500,NULL,NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0.00),(2,20201203200214,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:14','2020-12-03 19:02:14',NULL,0.00),(3,20201203200218,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:18','2020-12-03 19:02:18',NULL,0.00),(4,20201203200220,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:20','2020-12-03 19:02:20',NULL,0.00),(5,20201203200223,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:23','2020-12-03 19:02:23',NULL,0.00),(6,20201203200224,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:24','2020-12-03 19:02:24',NULL,0.00),(7,20201203200226,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:26','2020-12-03 19:02:26',NULL,0.00),(8,20201203200227,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:27','2020-12-03 19:02:27',NULL,0.00),(9,20201203200228,NULL,NULL,NULL,0,0,NULL,NULL,NULL,'2020-12-03 19:02:28','2020-12-03 19:02:28',NULL,0.00),(10,20201220145858,'2020-12-20','refaerfaeraergaer','ergegaefraergfaer',0,0,NULL,11,2,'2020-12-20 15:32:53','2020-12-20 15:32:53',NULL,0.00),(11,20201220155207,'2020-12-20','hgd qkqSHJDGK sqhgk qshgKQSJHDGK jhdqg','dk',1,0,NULL,2,1,'2020-12-20 15:53:09','2020-12-20 15:53:09',NULL,1.00),(12,20201226143106,'2020-12-26','gfkhjdegkjhqsgdS Kqjhs dkQJHGD KQJSHD Gkqjhsdgk qJHSDK Jhqdsd kjQH MIUZ','E HFLSCKJHSDCK jhdsck jHDCG KZH KCJUC',1,0,NULL,11,11,'2020-12-26 14:32:59','2020-12-26 14:32:59',NULL,0.00),(13,20201226144203,'2020-12-26','Ceci est un test','Ceci est un test II',0,1,NULL,16,11,'2020-12-26 14:46:18','2020-12-26 14:46:18',NULL,1.47),(14,20210104181346,'2021-01-04','Ceci est un test remarks','Ceci est un test work',0,0,NULL,2,3,'2021-01-04 17:14:52','2021-01-10 12:13:28',1,147.47),(15,20210110131909,'2021-01-10','Nouveau test','Nouveau test work',1,0,NULL,16,17,'2021-01-10 12:20:32','2021-01-10 13:47:32',1,0.00),(17,20210110145253,'2021-01-10','Test','Test',0,0,NULL,4,11,'2021-01-10 13:53:53','2021-01-10 13:54:20',1,147.89);
/*!40000 ALTER TABLE `worksheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zipcodes`
--

DROP TABLE IF EXISTS `zipcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zipcodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zipcode` int(10) unsigned NOT NULL,
  `locality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2758 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zipcodes`
--

LOCK TABLES `zipcodes` WRITE;
/*!40000 ALTER TABLE `zipcodes` DISABLE KEYS */;
INSERT INTO `zipcodes` VALUES (1,1020,'Laeken',NULL,NULL),(2,1030,'Schaerbeek',NULL,NULL),(3,1090,'Jette',NULL,NULL),(4,1140,'Evere',NULL,NULL),(5,1170,'Watermael-Boitsfort',NULL,NULL),(6,1200,'Woluwe-Saint-Lambert',NULL,NULL),(7,1210,'Saint-Josse-Ten-Noode',NULL,NULL),(8,1331,'Rosières',NULL,NULL),(9,1340,'Ottignies-Louvain-La-Neuve',NULL,NULL),(10,1350,'Enines',NULL,NULL),(11,1350,'Jauche',NULL,NULL),(12,1350,'Marilles',NULL,NULL),(13,1350,'Noduwez',NULL,NULL),(14,1357,'Neerheylissem',NULL,NULL),(15,1357,'Opheylissem',NULL,NULL),(16,1360,'Orbais',NULL,NULL),(17,1360,'Thorembais-Les-Béguines',NULL,NULL),(18,1370,'Dongelberg',NULL,NULL),(19,1370,'Jodoigne-Souveraine',NULL,NULL),(20,1370,'Lathuy',NULL,NULL),(21,1370,'Saint-Jean-Geest',NULL,NULL),(22,1370,'Saint-Remy-Geest',NULL,NULL),(23,1380,'Couture-Saint-Germain',NULL,NULL),(24,1380,'Plancenoit',NULL,NULL),(25,1390,'Nethen',NULL,NULL),(26,1401,'Baulers',NULL,NULL),(27,1430,'Bierghes',NULL,NULL),(28,1435,'Mont-Saint-Guibert',NULL,NULL),(29,1440,'Braine-Le-Château',NULL,NULL),(30,1470,'Bousval',NULL,NULL),(31,1472,'Vieux-Genappe',NULL,NULL),(32,1474,'Ways',NULL,NULL),(33,1495,'Sart-Dames-Avelines',NULL,NULL),(34,1495,'Tilly',NULL,NULL),(35,1540,'Herfelingen',NULL,NULL),(36,1540,'Herne',NULL,NULL),(37,1541,'Sint-Pieters-Kapelle',NULL,NULL),(38,1570,'Vollezele',NULL,NULL),(39,1600,'Oudenaken',NULL,NULL),(40,1600,'Sint-Pieters-Leeuw',NULL,NULL),(41,1620,'Drogenbos',NULL,NULL),(42,1651,'Lot',NULL,NULL),(43,1674,'Bellingen',NULL,NULL),(44,1700,'Sint-Martens-Bodegem',NULL,NULL),(45,1700,'Sint-Ulriks-Kapelle',NULL,NULL),(46,1701,'Itterbeek',NULL,NULL),(47,1702,'Groot-Bijgaarden',NULL,NULL),(48,1755,'Leerbeek',NULL,NULL),(49,1785,'Brussegem',NULL,NULL),(50,1790,'Teralfene',NULL,NULL),(51,1820,'Perk',NULL,NULL),(52,1840,'Malderen',NULL,NULL),(53,1840,'Steenhuffel',NULL,NULL),(54,1850,'Grimbergen',NULL,NULL),(55,1880,'Kapelle-Op-Den-Bos',NULL,NULL),(56,1910,'Buken',NULL,NULL),(57,1950,'Kraainem',NULL,NULL),(58,1980,'Eppegem',NULL,NULL),(59,1981,'Hofstade',NULL,NULL),(60,2040,'Antwerpen',NULL,NULL),(61,2140,'Borgerhout',NULL,NULL),(62,2220,'Heist-Op-Den-Berg',NULL,NULL),(63,2221,'Booischot',NULL,NULL),(64,2230,'Ramsel',NULL,NULL),(65,2235,'Houtvenne',NULL,NULL),(66,2260,'Zoerle-Parwijs',NULL,NULL),(67,2280,'Grobbendonk',NULL,NULL),(68,2381,'Weelde',NULL,NULL),(69,2387,'Baarle-Hertog',NULL,NULL),(70,2390,'Malle',NULL,NULL),(71,2390,'Oostmalle',NULL,NULL),(72,2430,'Eindhout',NULL,NULL),(73,2460,'Kasterlee',NULL,NULL),(74,2460,'Lichtaart',NULL,NULL),(75,2520,'Oelegem',NULL,NULL),(76,2540,'Hove',NULL,NULL),(77,2570,'Duffel',NULL,NULL),(78,2580,'Beerzel',NULL,NULL),(79,2630,'Aartselaar',NULL,NULL),(80,2660,'Hoboken',NULL,NULL),(81,2860,'Sint-Katelijne-Waver',NULL,NULL),(82,2950,'Kapellen',NULL,NULL),(83,2960,'Brecht',NULL,NULL),(84,3012,'Wilsele',NULL,NULL),(85,3020,'Veltem-Beisem',NULL,NULL),(86,3040,'Huldenberg',NULL,NULL),(87,3040,'Ottenburg',NULL,NULL),(88,3052,'Blanden',NULL,NULL),(89,3080,'Vossem',NULL,NULL),(90,3150,'Haacht',NULL,NULL),(91,3202,'Rillaar',NULL,NULL),(92,3220,'Holsbeek',NULL,NULL),(93,3271,'Averbode',NULL,NULL),(94,3271,'Zichem',NULL,NULL),(95,3290,'Deurne',NULL,NULL),(96,3290,'Diest',NULL,NULL),(97,3300,'Hakendover',NULL,NULL),(98,3320,'Hoegaarden',NULL,NULL),(99,3321,'Outgaarden',NULL,NULL),(100,3350,'Neerhespen',NULL,NULL),(101,3350,'Wommersom',NULL,NULL),(102,3360,'Opvelp',NULL,NULL),(103,3370,'Boutersem',NULL,NULL),(104,3370,'Kerkom',NULL,NULL),(105,3380,'Glabbeek',NULL,NULL),(106,3400,'Eliksem',NULL,NULL),(107,3400,'Laar',NULL,NULL),(108,3400,'Neerwinden',NULL,NULL),(109,3400,'Overwinden',NULL,NULL),(110,3401,'Waasmont',NULL,NULL),(111,3401,'Walsbets',NULL,NULL),(112,3450,'Grazen',NULL,NULL),(113,3454,'Rummen',NULL,NULL),(114,3560,'Lummen',NULL,NULL),(115,3570,'Alken',NULL,NULL),(116,3582,'Koersel',NULL,NULL),(117,3600,'Genk',NULL,NULL),(118,3630,'Leut',NULL,NULL),(119,3630,'Maasmechelen',NULL,NULL),(120,3650,'Stokkem',NULL,NULL),(121,3660,'Opglabbeek',NULL,NULL),(122,3670,'Meeuwen',NULL,NULL),(123,3670,'Wijshagen',NULL,NULL),(124,3700,'\'s Herenelderen',NULL,NULL),(125,3700,'Berg',NULL,NULL),(126,3700,'Haren',NULL,NULL),(127,3700,'Kolmont',NULL,NULL),(128,3700,'Mal',NULL,NULL),(129,3700,'Nerem',NULL,NULL),(130,3700,'Sluizen',NULL,NULL),(131,3740,'Bilzen',NULL,NULL),(132,3740,'Waltwilder',NULL,NULL),(133,3770,'Genoelselderen',NULL,NULL),(134,3791,'Remersdaal',NULL,NULL),(135,3800,'Ordingen',NULL,NULL),(136,3803,'Duras',NULL,NULL),(137,3806,'Velm',NULL,NULL),(138,3840,'Gors-Opleeuw',NULL,NULL),(139,3870,'Opheers',NULL,NULL),(140,3870,'Rukkelingen-Loon',NULL,NULL),(141,3870,'Veulen',NULL,NULL),(142,3910,'Sint-Huibrechts-Lille',NULL,NULL),(143,3940,'Hechtel',NULL,NULL),(144,3941,'Eksel',NULL,NULL),(145,3980,'Tessenderlo',NULL,NULL),(146,4000,'Glain',NULL,NULL),(147,4000,'Liège',NULL,NULL),(148,4032,'Chênee',NULL,NULL),(149,4041,'Vottem',NULL,NULL),(150,4050,'Chaudfontaine',NULL,NULL),(151,4121,'Neuville-En-Condroz',NULL,NULL),(152,4122,'Plainevaux',NULL,NULL),(153,4140,'Sprimont',NULL,NULL),(154,4141,'Louveigné',NULL,NULL),(155,4171,'Poulseur',NULL,NULL),(156,4180,'Comblain-Fairon',NULL,NULL),(157,4180,'Hamoir',NULL,NULL),(158,4181,'Filot',NULL,NULL),(159,4190,'Werbomont',NULL,NULL),(160,4210,'Lamontzée',NULL,NULL),(161,4210,'Marneffe',NULL,NULL),(162,4254,'Ligney',NULL,NULL),(163,4257,'Corswarem',NULL,NULL),(164,4260,'Avennes',NULL,NULL),(165,4260,'Ville-En-Hesbaye',NULL,NULL),(166,4280,'Bertrée',NULL,NULL),(167,4280,'Crehen',NULL,NULL),(168,4280,'Hannut',NULL,NULL),(169,4280,'Lens-Saint-Remy',NULL,NULL),(170,4280,'Merdorp',NULL,NULL),(171,4280,'Wansin',NULL,NULL),(172,4300,'Bovenistier',NULL,NULL),(173,4317,'Viemme',NULL,NULL),(174,4340,'Othée',NULL,NULL),(175,4367,'Kemexhe',NULL,NULL),(176,4367,'Odeur',NULL,NULL),(177,4367,'Thys',NULL,NULL),(178,4400,'Flémalle-Haute',NULL,NULL),(179,4420,'Saint-Nicolas',NULL,NULL),(180,4420,'Tilleur',NULL,NULL),(181,4431,'Loncin',NULL,NULL),(182,4452,'Wihogne',NULL,NULL),(183,4480,'Clermont-Sous-Huy',NULL,NULL),(184,4520,'Wanze',NULL,NULL),(185,4530,'Warnant-Dreye',NULL,NULL),(186,4537,'Seraing-Le-Château',NULL,NULL),(187,4537,'Verlaine',NULL,NULL),(188,4550,'Villers-Le-Temple',NULL,NULL),(189,4557,'Abée',NULL,NULL),(190,4577,'Outrelouxhe',NULL,NULL),(191,4577,'Strée-Lez-Huy',NULL,NULL),(192,4590,'Warzée',NULL,NULL),(193,4600,'Lanaye',NULL,NULL),(194,4606,'Saint-André',NULL,NULL),(195,4607,'Feneur',NULL,NULL),(196,4607,'Mortroux',NULL,NULL),(197,4610,'Queue-Du-Bois',NULL,NULL),(198,4630,'Soumagne',NULL,NULL),(199,4650,'Herve',NULL,NULL),(200,4672,'Saint-Remy',NULL,NULL),(201,4728,'Hergenrath',NULL,NULL),(202,4750,'Elsenborn',NULL,NULL),(203,4771,'Heppenbach',NULL,NULL),(204,4821,'Andrimont',NULL,NULL),(205,4837,'Baelen',NULL,NULL),(206,4837,'Membach',NULL,NULL),(207,4850,'Montzen',NULL,NULL),(208,4851,'Gemmenich',NULL,NULL),(209,4861,'Soiron',NULL,NULL),(210,4900,'Spa',NULL,NULL),(211,4910,'Polleur',NULL,NULL),(212,4920,'Harzé',NULL,NULL),(213,4950,'Faymonville',NULL,NULL),(214,4983,'Basse-Bodeux',NULL,NULL),(215,5004,'Bouge',NULL,NULL),(216,5020,'Flawinne',NULL,NULL),(217,5020,'Vedrin',NULL,NULL),(218,5024,'Gelbressée',NULL,NULL),(219,5030,'Lonzée',NULL,NULL),(220,5031,'Grand-Leez',NULL,NULL),(221,5032,'Isnes',NULL,NULL),(222,5032,'Mazy',NULL,NULL),(223,5060,'Keumiée',NULL,NULL),(224,5060,'Sambreville',NULL,NULL),(225,5060,'Tamines',NULL,NULL),(226,5070,'Sart-Saint-Laurent',NULL,NULL),(227,5080,'Emines',NULL,NULL),(228,5080,'La Bruyère',NULL,NULL),(229,5080,'Warisoulx',NULL,NULL),(230,5140,'Ligny',NULL,NULL),(231,5190,'Onoz',NULL,NULL),(232,5310,'Dhuy',NULL,NULL),(233,5310,'Hanret',NULL,NULL),(234,5310,'Leuze',NULL,NULL),(235,5310,'Saint-Germain',NULL,NULL),(236,5332,'Crupet',NULL,NULL),(237,5334,'Florée',NULL,NULL),(238,5360,'Hamois',NULL,NULL),(239,5360,'Natoye',NULL,NULL),(240,5361,'Scy',NULL,NULL),(241,5364,'Schaltin',NULL,NULL),(242,5370,'Havelange',NULL,NULL),(243,5377,'Baillonville',NULL,NULL),(244,5377,'Bonsin',NULL,NULL),(245,5377,'Nettinne',NULL,NULL),(246,5380,'Cortil-Wodon',NULL,NULL),(247,5380,'Franc-Waret',NULL,NULL),(248,5500,'Falmagne',NULL,NULL),(249,5500,'Falmignoul',NULL,NULL),(250,5502,'Thynes',NULL,NULL),(251,5523,'Sommière',NULL,NULL),(252,5530,'Spontin',NULL,NULL),(253,5530,'Yvoir',NULL,NULL),(254,5537,'Anhée',NULL,NULL),(255,5537,'Annevoie-Rouillon',NULL,NULL),(256,5537,'Haut-Le-Wastia',NULL,NULL),(257,5537,'Sosoye',NULL,NULL),(258,5540,'Hastière-Lavaux',NULL,NULL),(259,5543,'Heer',NULL,NULL),(260,5550,'Chairière',NULL,NULL),(261,5550,'Membre',NULL,NULL),(262,5550,'Mouzaive',NULL,NULL),(263,5550,'Orchimont',NULL,NULL),(264,5555,'Baillamont',NULL,NULL),(265,5555,'Bellefontaine',NULL,NULL),(266,5555,'Cornimont',NULL,NULL),(267,5555,'Graide',NULL,NULL),(268,5570,'Dion',NULL,NULL),(269,5570,'Felenne',NULL,NULL),(270,5570,'Javingue',NULL,NULL),(271,5570,'Vonêche',NULL,NULL),(272,5572,'Focant',NULL,NULL),(273,5575,'Patignies',NULL,NULL),(274,5575,'Sart-Custinne',NULL,NULL),(275,5575,'Willerzie',NULL,NULL),(276,5580,'Mont-Gauthier',NULL,NULL),(277,5580,'Rochefort',NULL,NULL),(278,5600,'Villers-En-Fagne',NULL,NULL),(279,5630,'Soumoy',NULL,NULL),(280,5640,'Biesme',NULL,NULL),(281,5640,'Mettet',NULL,NULL),(282,5650,'Chastrès',NULL,NULL),(283,5651,'Rognée',NULL,NULL),(284,5660,'Brûly-De-Pesche',NULL,NULL),(285,5660,'Presgaux',NULL,NULL),(286,5670,'Dourbes',NULL,NULL),(287,5670,'Nismes',NULL,NULL),(288,6000,'Charleroi',NULL,NULL),(289,6031,'Monceau-Sur-Sambre',NULL,NULL),(290,6041,'Gosselies',NULL,NULL),(291,6042,'Lodelinsart',NULL,NULL),(292,6120,'Marbaix',NULL,NULL),(293,6181,'Gouy-Lez-Piéton',NULL,NULL),(294,6230,'Pont-À-Celles',NULL,NULL),(295,6238,'Liberchies',NULL,NULL),(296,6238,'Luttre',NULL,NULL),(297,6250,'Pont-De-Loup',NULL,NULL),(298,6250,'Presles',NULL,NULL),(299,6280,'Villers-Poterie',NULL,NULL),(300,6440,'Vergnies',NULL,NULL),(301,6460,'Chimay',NULL,NULL),(302,6460,'Saint-Remy',NULL,NULL),(303,6464,'Rièzes',NULL,NULL),(304,6470,'Sivry',NULL,NULL),(305,6470,'Sivry-Rance',NULL,NULL),(306,6500,'Beaumont',NULL,NULL),(307,6500,'Leval-Chaudeville',NULL,NULL),(308,6500,'Solre-Saint-Géry',NULL,NULL),(309,6530,'Thuin',NULL,NULL),(310,6531,'Biesme-Sous-Thuin',NULL,NULL),(311,6533,'Biercée',NULL,NULL),(312,6542,'Sars-La-Buissière',NULL,NULL),(313,6590,'Momignies',NULL,NULL),(314,6600,'Wardin',NULL,NULL),(315,6630,'Martelange',NULL,NULL),(316,6637,'Hollange',NULL,NULL),(317,6640,'Vaux-Sur-Sûre',NULL,NULL),(318,6681,'Lavacherie',NULL,NULL),(319,6700,'Toernich',NULL,NULL),(320,6717,'Attert',NULL,NULL),(321,6717,'Nothomb',NULL,NULL),(322,6717,'Thiaumont',NULL,NULL),(323,6724,'Houdemont',NULL,NULL),(324,6740,'Villers-Sur-Semois',NULL,NULL),(325,6750,'Musson',NULL,NULL),(326,6760,'Bleid',NULL,NULL),(327,6762,'Saint-Mard',NULL,NULL),(328,6769,'Gérouville',NULL,NULL),(329,6769,'Robelmont',NULL,NULL),(330,6800,'Bras',NULL,NULL),(331,6800,'Libramont-Chevigny',NULL,NULL),(332,6800,'Moircy',NULL,NULL),(333,6800,'Recogne',NULL,NULL),(334,6800,'Sainte-Marie-Chevigny',NULL,NULL),(335,6810,'Izel',NULL,NULL),(336,6820,'Muno',NULL,NULL),(337,6830,'Bouillon',NULL,NULL),(338,6830,'Les Hayons',NULL,NULL),(339,6833,'Vivy',NULL,NULL),(340,6840,'Hamipré',NULL,NULL),(341,6840,'Longlier',NULL,NULL),(342,6850,'Paliseul',NULL,NULL),(343,6852,'Maissin',NULL,NULL),(344,6853,'Framont',NULL,NULL),(345,6860,'Léglise',NULL,NULL),(346,6880,'Auby-Sur-Semois',NULL,NULL),(347,6880,'Orgeo',NULL,NULL),(348,6890,'Redu',NULL,NULL),(349,6890,'Smuid',NULL,NULL),(350,6900,'Humain',NULL,NULL),(351,6900,'On',NULL,NULL),(352,6924,'Lomprez',NULL,NULL),(353,6927,'Resteigne',NULL,NULL),(354,6927,'Tellin',NULL,NULL),(355,6940,'Wéris',NULL,NULL),(356,6941,'Bende',NULL,NULL),(357,6941,'Tohogne',NULL,NULL),(358,6950,'Harsin',NULL,NULL),(359,6950,'Nassogne',NULL,NULL),(360,6952,'Grune',NULL,NULL),(361,6970,'Tenneville',NULL,NULL),(362,6987,'Marcourt',NULL,NULL),(363,6997,'Amonines',NULL,NULL),(364,6997,'Soy',NULL,NULL),(365,7022,'Hyon',NULL,NULL),(366,7034,'Saint-Denis',NULL,NULL),(367,7040,'Asquillies',NULL,NULL),(368,7040,'Bougnies',NULL,NULL),(369,7041,'Havay',NULL,NULL),(370,7050,'Jurbise',NULL,NULL),(371,7063,'Neufvilles',NULL,NULL),(372,7070,'Thieu',NULL,NULL),(373,7070,'Ville-Sur-Haine',NULL,NULL),(374,7090,'Ronquières',NULL,NULL),(375,7100,'Haine-Saint-Pierre',NULL,NULL),(376,7100,'La Louvière',NULL,NULL),(377,7100,'Trivières',NULL,NULL),(378,7110,'Houdeng-Goegnies',NULL,NULL),(379,7120,'Croix-Lez-Rouveroy',NULL,NULL),(380,7120,'Fauroeulx',NULL,NULL),(381,7130,'Binche',NULL,NULL),(382,7134,'Péronnes-Lez-Binche',NULL,NULL),(383,7134,'Ressaix',NULL,NULL),(384,7160,'Piéton',NULL,NULL),(385,7170,'Bois-D\'haine',NULL,NULL),(386,7170,'Fayt-Lez-Manage',NULL,NULL),(387,7170,'Manage',NULL,NULL),(388,7181,'Arquennes',NULL,NULL),(389,7181,'Feluy',NULL,NULL),(390,7181,'Petit-Roeulx-Lez-Nivelles',NULL,NULL),(391,7190,'Ecaussinnes',NULL,NULL),(392,7191,'Ecaussinnes-Lalaing',NULL,NULL),(393,7332,'Sirault',NULL,NULL),(394,7340,'Wasmes',NULL,NULL),(395,7350,'Thulin',NULL,NULL),(396,7370,'Dour',NULL,NULL),(397,7380,'Quiévrain',NULL,NULL),(398,7387,'Erquennes',NULL,NULL),(399,7387,'Honnelles',NULL,NULL),(400,7387,'Onnezies',NULL,NULL),(401,7390,'Wasmuel',NULL,NULL),(402,7502,'Esplechin',NULL,NULL),(403,7506,'Willemeau',NULL,NULL),(404,7520,'Ramegnies-Chin',NULL,NULL),(405,7522,'Lamain',NULL,NULL),(406,7522,'Marquain',NULL,NULL),(407,7534,'Barry',NULL,NULL),(408,7604,'Brasmenil',NULL,NULL),(409,7640,'Péronnes-Lez-Antoing',NULL,NULL),(410,7642,'Calonne',NULL,NULL),(411,7750,'Anseroeul',NULL,NULL),(412,7750,'Mont-De-L\'enclus',NULL,NULL),(413,7750,'Russeignies',NULL,NULL),(414,7760,'Molenbaix',NULL,NULL),(415,7760,'Velaines',NULL,NULL),(416,7781,'Houthem',NULL,NULL),(417,7782,'Ploegsteert',NULL,NULL),(418,7783,'Bizet',NULL,NULL),(419,7800,'Ath',NULL,NULL),(420,7811,'Arbre',NULL,NULL),(421,7823,'Gibecq',NULL,NULL),(422,7830,'Bassilly',NULL,NULL),(423,7830,'Fouleng',NULL,NULL),(424,7830,'Gondregnies',NULL,NULL),(425,7850,'Marcq',NULL,NULL),(426,7861,'Wannebecq',NULL,NULL),(427,7862,'Ogy',NULL,NULL),(428,7890,'Lahamaide',NULL,NULL),(429,7911,'Herquegies',NULL,NULL),(430,7950,'Chièvres',NULL,NULL),(431,7971,'Ramegnies',NULL,NULL),(432,7971,'Thumaide',NULL,NULL),(433,8020,'Hertsberge',NULL,NULL),(434,8340,'Lapscheure',NULL,NULL),(435,8340,'Moerkerke',NULL,NULL),(436,8340,'Oostkerke',NULL,NULL),(437,8340,'Sijsele',NULL,NULL),(438,8377,'Zuienkerke',NULL,NULL),(439,8400,'Oostende',NULL,NULL),(440,8400,'Stene',NULL,NULL),(441,8430,'Middelkerke',NULL,NULL),(442,8433,'Mannekensvere',NULL,NULL),(443,8460,'Ettelgem',NULL,NULL),(444,8480,'Eernegem',NULL,NULL),(445,8510,'Bellegem',NULL,NULL),(446,8510,'Kooigem',NULL,NULL),(447,8550,'Zwevegem',NULL,NULL),(448,8560,'Gullegem',NULL,NULL),(449,8570,'Ingooigem',NULL,NULL),(450,8572,'Kaster',NULL,NULL),(451,8580,'Avelgem',NULL,NULL),(452,8582,'Outrijve',NULL,NULL),(453,8600,'Keiem',NULL,NULL),(454,8600,'Nieuwkapelle',NULL,NULL),(455,8600,'Oostkerke',NULL,NULL),(456,8600,'Vladslo',NULL,NULL),(457,8610,'Werken',NULL,NULL),(458,8630,'Wulveringem',NULL,NULL),(459,8630,'Zoutenaaie',NULL,NULL),(460,8640,'Oostvleteren',NULL,NULL),(461,8640,'Westvleteren',NULL,NULL),(462,8647,'Noordschote',NULL,NULL),(463,8660,'De Panne',NULL,NULL),(464,8670,'Koksijde',NULL,NULL),(465,8680,'Koekelare',NULL,NULL),(466,8680,'Zande',NULL,NULL),(467,8691,'Stavele',NULL,NULL),(468,8700,'Schuiferskapelle',NULL,NULL),(469,8710,'Sint-Baafs-Vijve',NULL,NULL),(470,8720,'Markegem',NULL,NULL),(471,8730,'Sint-Joris',NULL,NULL),(472,8740,'Egem',NULL,NULL),(473,8750,'Wingene',NULL,NULL),(474,8770,'Ingelmunster',NULL,NULL),(475,8780,'Oostrozebeke',NULL,NULL),(476,8793,'Sint-Eloois-Vijve',NULL,NULL),(477,8800,'Rumbeke',NULL,NULL),(478,8830,'Hooglede',NULL,NULL),(479,8902,'Zillebeke',NULL,NULL),(480,8908,'Vlamertinge',NULL,NULL),(481,8930,'Menen',NULL,NULL),(482,8956,'Kemmel',NULL,NULL),(483,8970,'Reningelst',NULL,NULL),(484,8980,'Passendale',NULL,NULL),(485,8980,'Zandvoorde',NULL,NULL),(486,9050,'Gentbrugge',NULL,NULL),(487,9051,'Afsnee',NULL,NULL),(488,9060,'Zelzate',NULL,NULL),(489,9080,'Zeveneken',NULL,NULL),(490,9120,'Kallo',NULL,NULL),(491,9140,'Elversele',NULL,NULL),(492,9150,'Bazel',NULL,NULL),(493,9170,'De Klinge',NULL,NULL),(494,9170,'Meerdonk',NULL,NULL),(495,9200,'Dendermonde',NULL,NULL),(496,9200,'Schoonaarde',NULL,NULL),(497,9200,'Sint-Gillis-Dendermonde',NULL,NULL),(498,9310,'Baardegem',NULL,NULL),(499,9310,'Meldert',NULL,NULL),(500,9340,'Lede',NULL,NULL),(501,9340,'Wanzele',NULL,NULL),(502,9400,'Ninove',NULL,NULL),(503,9402,'Meerbeke',NULL,NULL),(504,9404,'Aspelare',NULL,NULL),(505,9420,'Bambrugge',NULL,NULL),(506,9420,'Erondegem',NULL,NULL),(507,9450,'Haaltert',NULL,NULL),(508,9470,'Denderleeuw',NULL,NULL),(509,9500,'Nederboelare',NULL,NULL),(510,9500,'Onkerzele',NULL,NULL),(511,9500,'Viane',NULL,NULL),(512,9500,'Zarlardinge',NULL,NULL),(513,9520,'Vlierzele',NULL,NULL),(514,9620,'Oombergen',NULL,NULL),(515,9620,'Sint-Goriks-Oudenhove',NULL,NULL),(516,9630,'Roborst',NULL,NULL),(517,9630,'Sint-Denijs-Boekel',NULL,NULL),(518,9636,'Nederzwalm-Hermelgem',NULL,NULL),(519,9660,'Elst',NULL,NULL),(520,9660,'Everbeek',NULL,NULL),(521,9660,'Nederbrakel',NULL,NULL),(522,9661,'Parike',NULL,NULL),(523,9700,'Ename',NULL,NULL),(524,9771,'Nokere',NULL,NULL),(525,9790,'Ooike',NULL,NULL),(526,9790,'Wortegem',NULL,NULL),(527,9790,'Wortegem-Petegem',NULL,NULL),(528,9800,'Vinkt',NULL,NULL),(529,9820,'Lemberge',NULL,NULL),(530,9850,'Vosselare',NULL,NULL),(531,9860,'Oosterzele',NULL,NULL),(532,9860,'Scheldewindeke',NULL,NULL),(533,9870,'Zulte',NULL,NULL),(534,9880,'Lotenhulle',NULL,NULL),(535,9890,'Dikkelvenne',NULL,NULL),(536,9920,'Lovendegem',NULL,NULL),(537,9930,'Zomergem',NULL,NULL),(538,9950,'Waarschoot',NULL,NULL),(539,9960,'Assenede',NULL,NULL),(540,1050,'Ixelles',NULL,NULL),(541,1081,'Koekelberg',NULL,NULL),(542,1130,'Haren',NULL,NULL),(543,1150,'Woluwe-Saint-Pierre',NULL,NULL),(544,1315,'Incourt',NULL,NULL),(545,1315,'Opprebais',NULL,NULL),(546,1315,'Roux-Miroir',NULL,NULL),(547,1325,'Bonlez',NULL,NULL),(548,1325,'Corroy-Le-Grand',NULL,NULL),(549,1341,'Céroux-Mousty',NULL,NULL),(550,1350,'Folx-Les-Caves',NULL,NULL),(551,1360,'Perwez',NULL,NULL),(552,1367,'Bomal',NULL,NULL),(553,1367,'Grand-Rosière-Hottomont',NULL,NULL),(554,1367,'Huppaye',NULL,NULL),(555,1367,'Mont-Saint-André',NULL,NULL),(556,1370,'Jodoigne',NULL,NULL),(557,1380,'Lasne',NULL,NULL),(558,1380,'Maransart',NULL,NULL),(559,1390,'Biez',NULL,NULL),(560,1430,'Rebecq-Rognon',NULL,NULL),(561,1450,'Chastre',NULL,NULL),(562,1450,'Gentinnes',NULL,NULL),(563,1495,'Marbais',NULL,NULL),(564,1495,'Mellery',NULL,NULL),(565,1495,'Villers-La-Ville',NULL,NULL),(566,1500,'Halle',NULL,NULL),(567,1501,'Buizingen',NULL,NULL),(568,1600,'Sint-Laureins-Berchem',NULL,NULL),(569,1602,'Vlezenbeek',NULL,NULL),(570,1670,'Heikruis',NULL,NULL),(571,1671,'Elingen',NULL,NULL),(572,1700,'Dilbeek',NULL,NULL),(573,1740,'Ternat',NULL,NULL),(574,1742,'Sint-Katherina-Lombeek',NULL,NULL),(575,1745,'Mazenzele',NULL,NULL),(576,1750,'Lennik',NULL,NULL),(577,1750,'Sint-Martens-Lennik',NULL,NULL),(578,1780,'Wemmel',NULL,NULL),(579,1785,'Hamme',NULL,NULL),(580,1852,'Beigem',NULL,NULL),(581,1910,'Kampenhout',NULL,NULL),(582,1982,'Weerde',NULL,NULL),(583,2040,'Zandvliet',NULL,NULL),(584,2100,'Deurne',NULL,NULL),(585,2200,'Morkhoven',NULL,NULL),(586,2200,'Noorderwijk',NULL,NULL),(587,2220,'Hallaar',NULL,NULL),(588,2222,'Wiekevorst',NULL,NULL),(589,2235,'Hulshout',NULL,NULL),(590,2240,'Massenhoven',NULL,NULL),(591,2240,'Zandhoven',NULL,NULL),(592,2260,'Tongerlo',NULL,NULL),(593,2320,'Hoogstraten',NULL,NULL),(594,2323,'Wortel',NULL,NULL),(595,2340,'Vlimmeren',NULL,NULL),(596,2400,'Mol',NULL,NULL),(597,2520,'Broechem',NULL,NULL),(598,2550,'Waarloos',NULL,NULL),(599,2627,'Schelle',NULL,NULL),(600,2650,'Edegem',NULL,NULL),(601,2800,'Walem',NULL,NULL),(602,2801,'Heffen',NULL,NULL),(603,2870,'Liezele',NULL,NULL),(604,2870,'Ruisbroek',NULL,NULL),(605,2880,'Bornem',NULL,NULL),(606,2880,'Hingene',NULL,NULL),(607,2880,'Mariekerke',NULL,NULL),(608,2890,'Lippelo',NULL,NULL),(609,2910,'Essen',NULL,NULL),(610,2960,'Sint-Job-In-\'t-Goor',NULL,NULL),(611,2970,'Schilde',NULL,NULL),(612,2980,'Halle',NULL,NULL),(613,2980,'Zoersel',NULL,NULL),(614,2990,'Loenhout',NULL,NULL),(615,2990,'Wuustwezel',NULL,NULL),(616,3001,'Heverlee',NULL,NULL),(617,3020,'Winksele',NULL,NULL),(618,3040,'Loonbeek',NULL,NULL),(619,3050,'Oud-Heverlee',NULL,NULL),(620,3054,'Vaalbeek',NULL,NULL),(621,3060,'Bertem',NULL,NULL),(622,3060,'Korbeek-Dijle',NULL,NULL),(623,3071,'Erps-Kwerps',NULL,NULL),(624,3128,'Baal',NULL,NULL),(625,3130,'Begijnendijk',NULL,NULL),(626,3191,'Hever',NULL,NULL),(627,3201,'Langdorp',NULL,NULL),(628,3212,'Pellenberg',NULL,NULL),(629,3270,'Scherpenheuvel',NULL,NULL),(630,3270,'Scherpenheuvel-Zichem',NULL,NULL),(631,3272,'Testelt',NULL,NULL),(632,3294,'Molenstede',NULL,NULL),(633,3300,'Oplinter',NULL,NULL),(634,3350,'Drieslinter',NULL,NULL),(635,3350,'Neerlinter',NULL,NULL),(636,3350,'Overhespen',NULL,NULL),(637,3370,'Roosbeek',NULL,NULL),(638,3381,'Kapellen',NULL,NULL),(639,3390,'Tielt',NULL,NULL),(640,3390,'Tielt-Winge',NULL,NULL),(641,3404,'Attenhoven',NULL,NULL),(642,3404,'Neerlanden',NULL,NULL),(643,3440,'Halle-Booienhoven',NULL,NULL),(644,3450,'Geetbets',NULL,NULL),(645,3470,'Kortenaken',NULL,NULL),(646,3470,'Sint-Margriete-Houtem',NULL,NULL),(647,3500,'Hasselt',NULL,NULL),(648,3520,'Zonhoven',NULL,NULL),(649,3540,'Berbroek',NULL,NULL),(650,3581,'Beverlo',NULL,NULL),(651,3640,'Kessenich',NULL,NULL),(652,3640,'Molenbeersel',NULL,NULL),(653,3650,'Dilsen',NULL,NULL),(654,3650,'Dilsen-Stokkem',NULL,NULL),(655,3650,'Rotem',NULL,NULL),(656,3670,'Gruitrode',NULL,NULL),(657,3670,'Meeuwen-Gruitrode',NULL,NULL),(658,3700,'Henis',NULL,NULL),(659,3700,'Koninksem',NULL,NULL),(660,3720,'Kortessem',NULL,NULL),(661,3732,'Schalkhoven',NULL,NULL),(662,3740,'Beverst',NULL,NULL),(663,3740,'Eigenbilzen',NULL,NULL),(664,3740,'Hees',NULL,NULL),(665,3740,'Rosmeer',NULL,NULL),(666,3746,'Hoelbeek',NULL,NULL),(667,3770,'Herderen',NULL,NULL),(668,3770,'Millen',NULL,NULL),(669,3798,'Fouron-Le-Comte',NULL,NULL),(670,3800,'Brustem',NULL,NULL),(671,3800,'Engelmanshoven',NULL,NULL),(672,3800,'Gelinden',NULL,NULL),(673,3800,'Kerkom-Bij-Sint-Truiden',NULL,NULL),(674,3800,'Sint-Truiden',NULL,NULL),(675,3830,'Berlingen',NULL,NULL),(676,3832,'Ulbeek',NULL,NULL),(677,3840,'Gotem',NULL,NULL),(678,3840,'Groot-Loon',NULL,NULL),(679,3840,'Kerniel',NULL,NULL),(680,3840,'Rijkel',NULL,NULL),(681,3850,'Wijer',NULL,NULL),(682,3870,'Bovelingen',NULL,NULL),(683,3870,'Heks',NULL,NULL),(684,3870,'Horpmaal',NULL,NULL),(685,3870,'Klein-Gelmen',NULL,NULL),(686,3870,'Mechelen-Bovelingen',NULL,NULL),(687,3930,'Achel',NULL,NULL),(688,3930,'Hamont',NULL,NULL),(689,3960,'Beek',NULL,NULL),(690,3990,'Wijchmaal',NULL,NULL),(691,4020,'Liège',NULL,NULL),(692,4040,'Herstal',NULL,NULL),(693,4042,'Liers',NULL,NULL),(694,4052,'Beaufays',NULL,NULL),(695,4190,'Vieuxville',NULL,NULL),(696,4210,'Hannêche',NULL,NULL),(697,4217,'Lavoir',NULL,NULL),(698,4218,'Couthuin',NULL,NULL),(699,4253,'Darion',NULL,NULL),(700,4257,'Berloz',NULL,NULL),(701,4260,'Braives',NULL,NULL),(702,4260,'Fallais',NULL,NULL),(703,4261,'Latinne',NULL,NULL),(704,4263,'Tourinne',NULL,NULL),(705,4280,'Moxhe',NULL,NULL),(706,4280,'Thisnes',NULL,NULL),(707,4300,'Bleret',NULL,NULL),(708,4317,'Aineffe',NULL,NULL),(709,4347,'Voroux-Goreux',NULL,NULL),(710,4350,'Remicourt',NULL,NULL),(711,4357,'Donceel',NULL,NULL),(712,4357,'Haneffe',NULL,NULL),(713,4360,'Lens-Sur-Geer',NULL,NULL),(714,4360,'Oreye',NULL,NULL),(715,4367,'Crisnée',NULL,NULL),(716,4400,'Flémalle',NULL,NULL),(717,4450,'Lantin',NULL,NULL),(718,4452,'Paifve',NULL,NULL),(719,4458,'Fexhe-Slins',NULL,NULL),(720,4460,'Grâce-Hollogne',NULL,NULL),(721,4480,'Ehein',NULL,NULL),(722,4480,'Hermalle-Sous-Huy',NULL,NULL),(723,4500,'Tihange',NULL,NULL),(724,4520,'Bas-Oha',NULL,NULL),(725,4530,'Fize-Fontaine',NULL,NULL),(726,4530,'Vieux-Waleffe',NULL,NULL),(727,4537,'Bodegnée',NULL,NULL),(728,4540,'Jehay',NULL,NULL),(729,4557,'Seny',NULL,NULL),(730,4577,'Vierset-Barse',NULL,NULL),(731,4600,'Visé',NULL,NULL),(732,4602,'Cheratte',NULL,NULL),(733,4630,'Tignée',NULL,NULL),(734,4631,'Evegnée',NULL,NULL),(735,4650,'Chaineux',NULL,NULL),(736,4650,'Grand-Rechain',NULL,NULL),(737,4652,'Xhendelesse',NULL,NULL),(738,4670,'Trembleur',NULL,NULL),(739,4671,'Barchon',NULL,NULL),(740,4682,'Heure-Le-Romain',NULL,NULL),(741,4701,'Kettenis',NULL,NULL),(742,4720,'La Calamine',NULL,NULL),(743,4721,'Neu-Moresnet',NULL,NULL),(744,4760,'Bullange',NULL,NULL),(745,4761,'Rocherath',NULL,NULL),(746,4784,'Crombach',NULL,NULL),(747,4790,'Burg-Reuland',NULL,NULL),(748,4790,'Reuland',NULL,NULL),(749,4800,'Verviers',NULL,NULL),(750,4820,'Dison',NULL,NULL),(751,4845,'Jalhay',NULL,NULL),(752,4860,'Cornesse',NULL,NULL),(753,4870,'Fraipont',NULL,NULL),(754,4880,'Aubel',NULL,NULL),(755,4910,'La Reid',NULL,NULL),(756,4950,'Sourbrodt',NULL,NULL),(757,4970,'Francorchamps',NULL,NULL),(758,4980,'Fosse',NULL,NULL),(759,4980,'Wanne',NULL,NULL),(760,4987,'Lorcé',NULL,NULL),(761,4987,'Stoumont',NULL,NULL),(762,5000,'Beez',NULL,NULL),(763,5020,'Malonne',NULL,NULL),(764,5021,'Boninne',NULL,NULL),(765,5022,'Cognelée',NULL,NULL),(766,5030,'Gembloux',NULL,NULL),(767,5032,'Corroy-Le-Château',NULL,NULL),(768,5060,'Arsimont',NULL,NULL),(769,5080,'Rhisnes',NULL,NULL),(770,5081,'Meux',NULL,NULL),(771,5100,'Jambes',NULL,NULL),(772,5140,'Boignée',NULL,NULL),(773,5150,'Floreffe',NULL,NULL),(774,5170,'Profondeville',NULL,NULL),(775,5190,'Moustier-Sur-Sambre',NULL,NULL),(776,5190,'Saint-Martin',NULL,NULL),(777,5300,'Andenne',NULL,NULL),(778,5300,'Landenne',NULL,NULL),(779,5310,'Bolinne',NULL,NULL),(780,5330,'Sart-Bernard',NULL,NULL),(781,5336,'Courrière',NULL,NULL),(782,5370,'Verlée',NULL,NULL),(783,5374,'Maffe',NULL,NULL),(784,5377,'Hogne',NULL,NULL),(785,5377,'Noiseux',NULL,NULL),(786,5380,'Bierwart',NULL,NULL),(787,5380,'Forville',NULL,NULL),(788,5380,'Hingeon',NULL,NULL),(789,5520,'Onhaye',NULL,NULL),(790,5523,'Weillen',NULL,NULL),(791,5524,'Gerin',NULL,NULL),(792,5530,'Evrehailles',NULL,NULL),(793,5537,'Bioul',NULL,NULL),(794,5540,'Hermeton-Sur-Meuse',NULL,NULL),(795,5541,'Hastière-Par-Delà',NULL,NULL),(796,5542,'Blaimont',NULL,NULL),(797,5550,'Nafraiture',NULL,NULL),(798,5555,'Petit-Fays',NULL,NULL),(799,5560,'Houyet',NULL,NULL),(800,5560,'Mesnil-Eglise',NULL,NULL),(801,5563,'Hour',NULL,NULL),(802,5564,'Wanlin',NULL,NULL),(803,5570,'Honnay',NULL,NULL),(804,5570,'Winenne',NULL,NULL),(805,5575,'Bourseigne-Neuve',NULL,NULL),(806,5575,'Gedinne',NULL,NULL),(807,5575,'Houdremont',NULL,NULL),(808,5575,'Rienne',NULL,NULL),(809,5580,'Eprave',NULL,NULL),(810,5590,'Chevetogne',NULL,NULL),(811,5600,'Franchimont',NULL,NULL),(812,5600,'Samart',NULL,NULL),(813,5600,'Villers-Le-Gambon',NULL,NULL),(814,5620,'Flavion',NULL,NULL),(815,5620,'Florennes',NULL,NULL),(816,5640,'Biesmerée',NULL,NULL),(817,5650,'Pry',NULL,NULL),(818,5650,'Walcourt',NULL,NULL),(819,5650,'Yves-Gomezée',NULL,NULL),(820,5651,'Laneffe',NULL,NULL),(821,5651,'Tarcienne',NULL,NULL),(822,5660,'Cul-Des-Sarts',NULL,NULL),(823,5660,'Dailly',NULL,NULL),(824,5670,'Oignies-En-Thiérache',NULL,NULL),(825,5670,'Olloy-Sur-Viroin',NULL,NULL),(826,5680,'Gochenée',NULL,NULL),(827,5680,'Romerée',NULL,NULL),(828,5680,'Vaucelles',NULL,NULL),(829,6001,'Marcinelle',NULL,NULL),(830,6044,'Roux',NULL,NULL),(831,6120,'Nalinnes',NULL,NULL),(832,6140,'Fontaine-L\'evêque',NULL,NULL),(833,6220,'Heppignies',NULL,NULL),(834,6240,'Pironchamps',NULL,NULL),(835,6250,'Aiseau-Presles',NULL,NULL),(836,6250,'Roselies',NULL,NULL),(837,6280,'Gerpinnes',NULL,NULL),(838,6464,'Baileux',NULL,NULL),(839,6470,'Grandrieu',NULL,NULL),(840,6470,'Rance',NULL,NULL),(841,6500,'Renlies',NULL,NULL),(842,6532,'Ragnies',NULL,NULL),(843,6540,'Lobbes',NULL,NULL),(844,6560,'Hantes-Wihéries',NULL,NULL),(845,6560,'Solre-Sur-Sambre',NULL,NULL),(846,6567,'Fontaine-Valmont',NULL,NULL),(847,6567,'Labuissière',NULL,NULL),(848,6567,'Merbes-Sainte-Marie',NULL,NULL),(849,6600,'Bastogne',NULL,NULL),(850,6600,'Longvilly',NULL,NULL),(851,6640,'Hompré',NULL,NULL),(852,6640,'Morhet',NULL,NULL),(853,6640,'Nives',NULL,NULL),(854,6642,'Juseret',NULL,NULL),(855,6663,'Mabompré',NULL,NULL),(856,6670,'Gouvy',NULL,NULL),(857,6680,'Tillet',NULL,NULL),(858,6688,'Longchamps',NULL,NULL),(859,6690,'Vielsalm',NULL,NULL),(860,6706,'Autelbas',NULL,NULL),(861,6720,'Habay-La-Neuve',NULL,NULL),(862,6721,'Anlier',NULL,NULL),(863,6730,'Rossignol',NULL,NULL),(864,6730,'Saint-Vincent',NULL,NULL),(865,6740,'Sainte-Marie-Sur-Semois',NULL,NULL),(866,6741,'Vance',NULL,NULL),(867,6747,'Châtillon',NULL,NULL),(868,6747,'Saint-Léger',NULL,NULL),(869,6750,'Signeulx',NULL,NULL),(870,6760,'Virton',NULL,NULL),(871,6767,'Dampicourt',NULL,NULL),(872,6767,'Harnoncourt',NULL,NULL),(873,6780,'Hondelange',NULL,NULL),(874,6790,'Aubange',NULL,NULL),(875,6792,'Rachecourt',NULL,NULL),(876,6810,'Chiny',NULL,NULL),(877,6810,'Jamoigne',NULL,NULL),(878,6820,'Sainte-Cécile',NULL,NULL),(879,6832,'Sensenruth',NULL,NULL),(880,6834,'Bellevaux',NULL,NULL),(881,6850,'Carlsbourg',NULL,NULL),(882,6850,'Offagne',NULL,NULL),(883,6852,'Opont',NULL,NULL),(884,6860,'Assenois',NULL,NULL),(885,6860,'Ebly',NULL,NULL),(886,6870,'Vesqueville',NULL,NULL),(887,6880,'Bertrix',NULL,NULL),(888,6900,'Aye',NULL,NULL),(889,6900,'Marche-En-Famenne',NULL,NULL),(890,6900,'Roy',NULL,NULL),(891,6929,'Daverdisse',NULL,NULL),(892,6929,'Porcheresse',NULL,NULL),(893,6941,'Bomal-Sur-Ourthe',NULL,NULL),(894,6941,'Borlon',NULL,NULL),(895,6941,'Villers-Sainte-Gertrude',NULL,NULL),(896,6960,'Grandmenil',NULL,NULL),(897,6960,'Harre',NULL,NULL),(898,6984,'Hives',NULL,NULL),(899,6997,'Erezée',NULL,NULL),(900,7012,'Jemappes',NULL,NULL),(901,7022,'Mesvin',NULL,NULL),(902,7030,'Saint-Symphorien',NULL,NULL),(903,7032,'Spiennes',NULL,NULL),(904,7034,'Obourg',NULL,NULL),(905,7040,'Genly',NULL,NULL),(906,7040,'Quévy-Le-Petit',NULL,NULL),(907,7050,'Erbaut',NULL,NULL),(908,7050,'Erbisoeul',NULL,NULL),(909,7050,'Masnuy-Saint-Pierre',NULL,NULL),(910,7090,'Henripont',NULL,NULL),(911,7100,'Saint-Vaast',NULL,NULL),(912,7120,'Estinnes',NULL,NULL),(913,7120,'Rouveroy',NULL,NULL),(914,7120,'Vellereille-Le-Sec',NULL,NULL),(915,7130,'Bray',NULL,NULL),(916,7140,'Morlanwelz',NULL,NULL),(917,7140,'Morlanwelz-Mariemont',NULL,NULL),(918,7170,'La Hestre',NULL,NULL),(919,7181,'Familleureux',NULL,NULL),(920,7320,'Bernissart',NULL,NULL),(921,7340,'Colfontaine',NULL,NULL),(922,7350,'Montroeul-Sur-Haine',NULL,NULL),(923,7370,'Blaugies',NULL,NULL),(924,7370,'Elouges',NULL,NULL),(925,7370,'Wihéries',NULL,NULL),(926,7382,'Audregnies',NULL,NULL),(927,7387,'Athis',NULL,NULL),(928,7387,'Autreppe',NULL,NULL),(929,7500,'Tournai',NULL,NULL),(930,7504,'Froidmont',NULL,NULL),(931,7532,'Beclers',NULL,NULL),(932,7534,'Maulde',NULL,NULL),(933,7540,'Quartes',NULL,NULL),(934,7542,'Mont-Saint-Aubert',NULL,NULL),(935,7602,'Bury',NULL,NULL),(936,7603,'Bon-Secours',NULL,NULL),(937,7604,'Baugnies',NULL,NULL),(938,7604,'Braffe',NULL,NULL),(939,7604,'Callenelle',NULL,NULL),(940,7620,'Guignies',NULL,NULL),(941,7620,'Hollain',NULL,NULL),(942,7620,'Wez-Velvain',NULL,NULL),(943,7624,'Howardries',NULL,NULL),(944,7641,'Bruyelle',NULL,NULL),(945,7730,'Estaimbourg',NULL,NULL),(946,7730,'Estaimpuis',NULL,NULL),(947,7730,'Leers-Nord',NULL,NULL),(948,7740,'Pecq',NULL,NULL),(949,7742,'Hérinnes-Lez-Pecq',NULL,NULL),(950,7750,'Orroir',NULL,NULL),(951,7780,'Comines',NULL,NULL),(952,7780,'Comines-Warneton',NULL,NULL),(953,7801,'Irchonwelz',NULL,NULL),(954,7804,'Ostiches',NULL,NULL),(955,7830,'Hoves',NULL,NULL),(956,7830,'Silly',NULL,NULL),(957,7830,'Thoricourt',NULL,NULL),(958,7850,'Petit-Enghien',NULL,NULL),(959,7866,'Bois-De-Lessines',NULL,NULL),(960,7870,'Lombise',NULL,NULL),(961,7870,'Montignies-Lez-Lens',NULL,NULL),(962,7890,'Wodecq',NULL,NULL),(963,7900,'Leuze-En-Hainaut',NULL,NULL),(964,7903,'Chapelle-À-Wattines',NULL,NULL),(965,7904,'Willaupuis',NULL,NULL),(966,7910,'Arc-Wattripont',NULL,NULL),(967,7910,'Ellignies-Lez-Frasnes',NULL,NULL),(968,7910,'Forest',NULL,NULL),(969,7910,'Frasnes-Lez-Anvaing',NULL,NULL),(970,7950,'Huissignies',NULL,NULL),(971,7970,'Beloeil',NULL,NULL),(972,7971,'Basècles',NULL,NULL),(973,8200,'Sint-Andries',NULL,NULL),(974,8210,'Loppem',NULL,NULL),(975,8211,'Aartrijke',NULL,NULL),(976,8300,'Knokke',NULL,NULL),(977,8301,'Ramskapelle',NULL,NULL),(978,8310,'Assebroek',NULL,NULL),(979,8380,'Zeebrugge',NULL,NULL),(980,8400,'Zandvoorde',NULL,NULL),(981,8431,'Wilskerke',NULL,NULL),(982,8433,'Slijpe',NULL,NULL),(983,8470,'Zevekote',NULL,NULL),(984,8480,'Bekegem',NULL,NULL),(985,8490,'Jabbeke',NULL,NULL),(986,8490,'Stalhille',NULL,NULL),(987,8490,'Zerkegem',NULL,NULL),(988,8500,'Kortrijk',NULL,NULL),(989,8501,'Heule',NULL,NULL),(990,8511,'Aalbeke',NULL,NULL),(991,8551,'Heestert',NULL,NULL),(992,8554,'Sint-Denijs',NULL,NULL),(993,8570,'Gijzelbrechtegem',NULL,NULL),(994,8581,'Kerkhove',NULL,NULL),(995,8587,'Helchin',NULL,NULL),(996,8600,'Kaaskerke',NULL,NULL),(997,8600,'Oudekapelle',NULL,NULL),(998,8600,'Woumen',NULL,NULL),(999,8610,'Handzame',NULL,NULL),(1000,8630,'Booitshoeke',NULL,NULL),(1001,8630,'Steenkerke',NULL,NULL),(1002,8630,'Veurne',NULL,NULL),(1003,8630,'Vinkem',NULL,NULL),(1004,8640,'Woesten',NULL,NULL),(1005,8647,'Reninge',NULL,NULL),(1006,8680,'Bovekerke',NULL,NULL),(1007,8690,'Oeren',NULL,NULL),(1008,8691,'Leisele',NULL,NULL),(1009,8720,'Dentergem',NULL,NULL),(1010,8730,'Oedelem',NULL,NULL),(1011,8790,'Waregem',NULL,NULL),(1012,8800,'Oekene',NULL,NULL),(1013,8800,'Roeselare',NULL,NULL),(1014,8820,'Torhout',NULL,NULL),(1015,8851,'Koolskamp',NULL,NULL),(1016,8860,'Lendelede',NULL,NULL),(1017,8900,'Brielen',NULL,NULL),(1018,8900,'Dikkebus',NULL,NULL),(1019,8900,'Ieper',NULL,NULL),(1020,8902,'Hollebeke',NULL,NULL),(1021,8902,'Voormezele',NULL,NULL),(1022,8920,'Bikschote',NULL,NULL),(1023,8951,'Dranouter',NULL,NULL),(1024,8952,'Wulvergem',NULL,NULL),(1025,8953,'Wijtschate',NULL,NULL),(1026,9000,'Gent',NULL,NULL),(1027,9031,'Drongen',NULL,NULL),(1028,9032,'Wondelgem',NULL,NULL),(1029,9050,'Ledeberg',NULL,NULL),(1030,9080,'Beervelde',NULL,NULL),(1031,9130,'Doel',NULL,NULL),(1032,9130,'Kallo',NULL,NULL),(1033,9160,'Eksaarde',NULL,NULL),(1034,9170,'Sint-Gillis-Waas',NULL,NULL),(1035,9170,'Sint-Pauwels',NULL,NULL),(1036,9180,'Moerbeke-Waas',NULL,NULL),(1037,9200,'Grembergen',NULL,NULL),(1038,9200,'Oudegem',NULL,NULL),(1039,9230,'Massemen',NULL,NULL),(1040,9240,'Zele',NULL,NULL),(1041,9270,'Laarne',NULL,NULL),(1042,9280,'Lebbeke',NULL,NULL),(1043,9290,'Berlare',NULL,NULL),(1044,9290,'Overmere',NULL,NULL),(1045,9310,'Moorsel',NULL,NULL),(1046,9320,'Erembodegem',NULL,NULL),(1047,9340,'Impe',NULL,NULL),(1048,9400,'Nederhasselt',NULL,NULL),(1049,9400,'Voorde',NULL,NULL),(1050,9406,'Outer',NULL,NULL),(1051,9420,'Burst',NULL,NULL),(1052,9500,'Ophasselt',NULL,NULL),(1053,9506,'Waarbeke',NULL,NULL),(1054,9506,'Zandbergen',NULL,NULL),(1055,9550,'Woubrechtegem',NULL,NULL),(1056,9570,'Lierde',NULL,NULL),(1057,9600,'Renaix',NULL,NULL),(1058,9620,'Elene',NULL,NULL),(1059,9630,'Munkzwalm',NULL,NULL),(1060,9630,'Rozebeke',NULL,NULL),(1061,9660,'Brakel',NULL,NULL),(1062,9660,'Michelbeke',NULL,NULL),(1063,9660,'Sint-Maria-Oudenhove',NULL,NULL),(1064,9660,'Zegelsem',NULL,NULL),(1065,9680,'Maarke-Kerkem',NULL,NULL),(1066,9681,'Nukerke',NULL,NULL),(1067,9690,'Berchem',NULL,NULL),(1068,9700,'Nederename',NULL,NULL),(1069,9700,'Ooike',NULL,NULL),(1070,9772,'Wannegem-Lede',NULL,NULL),(1071,9800,'Meigem',NULL,NULL),(1072,9800,'Sint-Martens-Leerne',NULL,NULL),(1073,9810,'Nazareth',NULL,NULL),(1074,9820,'Merelbeke',NULL,NULL),(1075,9840,'De Pinte',NULL,NULL),(1076,9840,'Zevergem',NULL,NULL),(1077,9850,'Merendree',NULL,NULL),(1078,9860,'Moortsele',NULL,NULL),(1079,9870,'Machelen',NULL,NULL),(1080,9881,'Bellem',NULL,NULL),(1081,9890,'Vurste',NULL,NULL),(1082,9900,'Eeklo',NULL,NULL),(1083,9910,'Ursel',NULL,NULL),(1084,9940,'Evergem',NULL,NULL),(1085,9968,'Bassevelde',NULL,NULL),(1086,9968,'Oosteeklo',NULL,NULL),(1087,9988,'Watervliet',NULL,NULL),(1088,1060,'Saint-Gilles',NULL,NULL),(1089,1080,'Molenbeek-Saint-Jean',NULL,NULL),(1090,1083,'Ganshoren',NULL,NULL),(1091,1120,'Neder-Over-Heembeek',NULL,NULL),(1092,1300,'Wavre',NULL,NULL),(1093,1301,'Bierges',NULL,NULL),(1094,1320,'L\'ecluse',NULL,NULL),(1095,1340,'Ottignies',NULL,NULL),(1096,1348,'Louvain-La-Neuve',NULL,NULL),(1097,1350,'Orp-Le-Grand',NULL,NULL),(1098,1357,'Hélécine',NULL,NULL),(1099,1357,'Linsmeau',NULL,NULL),(1100,1367,'Autre-Eglise',NULL,NULL),(1101,1390,'Grez-Doiceau',NULL,NULL),(1102,1420,'Braine-L\'alleud',NULL,NULL),(1103,1440,'Wauthier-Braine',NULL,NULL),(1104,1450,'Saint-Géry',NULL,NULL),(1105,1457,'Nil-Saint-Vincent-Saint-Martin',NULL,NULL),(1106,1457,'Walhain',NULL,NULL),(1107,1457,'Walhain-Saint-Paul',NULL,NULL),(1108,1460,'Ittre',NULL,NULL),(1109,1471,'Loupoigne',NULL,NULL),(1110,1480,'Tubize',NULL,NULL),(1111,1570,'Galmaarden',NULL,NULL),(1112,1601,'Ruisbroek',NULL,NULL),(1113,1652,'Alsemberg',NULL,NULL),(1114,1673,'Beert',NULL,NULL),(1115,1730,'Asse',NULL,NULL),(1116,1730,'Kobbegem',NULL,NULL),(1117,1731,'Zellik',NULL,NULL),(1118,1750,'Sint-Kwintens-Lennik',NULL,NULL),(1119,1755,'Kester',NULL,NULL),(1120,1755,'Oetingen',NULL,NULL),(1121,1760,'Pamel',NULL,NULL),(1122,1760,'Strijtem',NULL,NULL),(1123,1770,'Liedekerke',NULL,NULL),(1124,1831,'Diegem',NULL,NULL),(1125,1860,'Meise',NULL,NULL),(1126,1880,'Nieuwenrode',NULL,NULL),(1127,1910,'Nederokkerzeel',NULL,NULL),(1128,1930,'Nossegem',NULL,NULL),(1129,1930,'Zaventem',NULL,NULL),(1130,1933,'Sterrebeek',NULL,NULL),(1131,1982,'Elewijt',NULL,NULL),(1132,2000,'Antwerpen',NULL,NULL),(1133,2050,'Antwerpen',NULL,NULL),(1134,2180,'Ekeren',NULL,NULL),(1135,2200,'Herentals',NULL,NULL),(1136,2242,'Pulderbos',NULL,NULL),(1137,2243,'Pulle',NULL,NULL),(1138,2275,'Gierle',NULL,NULL),(1139,2275,'Lille',NULL,NULL),(1140,2322,'Minderhout',NULL,NULL),(1141,2330,'Merksplas',NULL,NULL),(1142,2370,'Arendonk',NULL,NULL),(1143,2380,'Ravels',NULL,NULL),(1144,2430,'Vorst',NULL,NULL),(1145,2431,'Varendonk',NULL,NULL),(1146,2450,'Meerhout',NULL,NULL),(1147,2470,'Retie',NULL,NULL),(1148,2491,'Olmen',NULL,NULL),(1149,2500,'Lier',NULL,NULL),(1150,2560,'Kessel',NULL,NULL),(1151,2560,'Nijlen',NULL,NULL),(1152,2590,'Berlaar',NULL,NULL),(1153,2620,'Hemiksem',NULL,NULL),(1154,2800,'Mechelen',NULL,NULL),(1155,2811,'Hombeek',NULL,NULL),(1156,2820,'Bonheiden',NULL,NULL),(1157,2820,'Rijmenam',NULL,NULL),(1158,2830,'Blaasveld',NULL,NULL),(1159,2830,'Heindonk',NULL,NULL),(1160,2830,'Tisselt',NULL,NULL),(1161,2830,'Willebroek',NULL,NULL),(1162,2840,'Reet',NULL,NULL),(1163,2850,'Boom',NULL,NULL),(1164,2861,'Onze-Lieve-Vrouw-Waver',NULL,NULL),(1165,2870,'Breendonk',NULL,NULL),(1166,2920,'Kalmthout',NULL,NULL),(1167,2940,'Hoevenen',NULL,NULL),(1168,2970,'\'s Gravenwezel',NULL,NULL),(1169,3010,'Kessel Lo',NULL,NULL),(1170,3020,'Herent',NULL,NULL),(1171,3040,'Neerijse',NULL,NULL),(1172,3070,'Kortenberg',NULL,NULL),(1173,3078,'Meerbeek',NULL,NULL),(1174,3080,'Tervuren',NULL,NULL),(1175,3150,'Tildonk',NULL,NULL),(1176,3200,'Gelrode',NULL,NULL),(1177,3220,'Sint-Pieters-Rode',NULL,NULL),(1178,3300,'Bost',NULL,NULL),(1179,3300,'Oorbeek',NULL,NULL),(1180,3300,'Vissenaken',NULL,NULL),(1181,3350,'Linter',NULL,NULL),(1182,3350,'Melkwezer',NULL,NULL),(1183,3360,'Korbeek-Lo',NULL,NULL),(1184,3380,'Bunsbeek',NULL,NULL),(1185,3384,'Attenrode',NULL,NULL),(1186,3391,'Meensel-Kiezegem',NULL,NULL),(1187,3400,'Ezemaal',NULL,NULL),(1188,3400,'Rumsdorp',NULL,NULL),(1189,3440,'Helen-Bos',NULL,NULL),(1190,3471,'Hoeleden',NULL,NULL),(1191,3510,'Kermt',NULL,NULL),(1192,3530,'Houthalen-Helchteren',NULL,NULL),(1193,3540,'Herk-De-Stad',NULL,NULL),(1194,3540,'Schulen',NULL,NULL),(1195,3580,'Beringen',NULL,NULL),(1196,3620,'Gellik',NULL,NULL),(1197,3620,'Neerharen',NULL,NULL),(1198,3630,'Mechelen-Aan-De-Maas',NULL,NULL),(1199,3631,'Boorsem',NULL,NULL),(1200,3640,'Kinrooi',NULL,NULL),(1201,3670,'Ellikom',NULL,NULL),(1202,3670,'Neerglabbeek',NULL,NULL),(1203,3690,'Zutendaal',NULL,NULL),(1204,3700,'Lauw',NULL,NULL),(1205,3700,'Neerrepen',NULL,NULL),(1206,3700,'Piringen',NULL,NULL),(1207,3700,'Vreren',NULL,NULL),(1208,3700,'Widooie',NULL,NULL),(1209,3717,'Herstappe',NULL,NULL),(1210,3723,'Guigoven',NULL,NULL),(1211,3724,'Vliermaal',NULL,NULL),(1212,3730,'Werm',NULL,NULL),(1213,3740,'Grote-Spouwen',NULL,NULL),(1214,3770,'Membruggen',NULL,NULL),(1215,3770,'Vlijtingen',NULL,NULL),(1216,3790,'Fouron-Saint-Martin',NULL,NULL),(1217,3790,'Fourons',NULL,NULL),(1218,3792,'Fouron-Saint-Pierre',NULL,NULL),(1219,3793,'Teuven',NULL,NULL),(1220,3800,'Zepperen',NULL,NULL),(1221,3831,'Herten',NULL,NULL),(1222,3840,'Broekom',NULL,NULL),(1223,3840,'Kolmont',NULL,NULL),(1224,3840,'Kuttekoven',NULL,NULL),(1225,3850,'Binderveld',NULL,NULL),(1226,3850,'Kozen',NULL,NULL),(1227,3850,'Nieuwerkerken',NULL,NULL),(1228,3870,'Mettekoven',NULL,NULL),(1229,3890,'Gingelom',NULL,NULL),(1230,3890,'Kortijs',NULL,NULL),(1231,3890,'Montenaken',NULL,NULL),(1232,3891,'Borlo',NULL,NULL),(1233,3920,'Lommel',NULL,NULL),(1234,3940,'Hechtel-Eksel',NULL,NULL),(1235,3945,'Ham',NULL,NULL),(1236,3960,'Bree',NULL,NULL),(1237,3971,'Heppen',NULL,NULL),(1238,4031,'Angleur',NULL,NULL),(1239,4041,'Milmort',NULL,NULL),(1240,4102,'Ougrée',NULL,NULL),(1241,4120,'Neupré',NULL,NULL),(1242,4120,'Rotheux-Rimière',NULL,NULL),(1243,4162,'Hody',NULL,NULL),(1244,4170,'Comblain-Au-Pont',NULL,NULL),(1245,4190,'Ferrières',NULL,NULL),(1246,4217,'Héron',NULL,NULL),(1247,4217,'Waret-L\'evêque',NULL,NULL),(1248,4250,'Boëlhe',NULL,NULL),(1249,4250,'Lens-Saint-Servais',NULL,NULL),(1250,4260,'Fumal',NULL,NULL),(1251,4280,'Abolens',NULL,NULL),(1252,4280,'Avin',NULL,NULL),(1253,4280,'Blehen',NULL,NULL),(1254,4280,'Grand-Hallet',NULL,NULL),(1255,4280,'Villers-Le-Peuplier',NULL,NULL),(1256,4300,'Grand-Axhe',NULL,NULL),(1257,4300,'Lantremange',NULL,NULL),(1258,4300,'Oleye',NULL,NULL),(1259,4317,'Faimes',NULL,NULL),(1260,4340,'Fooz',NULL,NULL),(1261,4340,'Villers-L\'evêque',NULL,NULL),(1262,4342,'Hognoul',NULL,NULL),(1263,4347,'Fexhe-Le-Haut-Clocher',NULL,NULL),(1264,4347,'Freloux',NULL,NULL),(1265,4350,'Pousset',NULL,NULL),(1266,4357,'Limont',NULL,NULL),(1267,4360,'Bergilers',NULL,NULL),(1268,4367,'Fize-Le-Marsal',NULL,NULL),(1269,4400,'Awirs',NULL,NULL),(1270,4400,'Flémalle-Grande',NULL,NULL),(1271,4420,'Montegnée',NULL,NULL),(1272,4450,'Juprelle',NULL,NULL),(1273,4450,'Slins',NULL,NULL),(1274,4453,'Villers-Saint-Siméon',NULL,NULL),(1275,4460,'Bierset',NULL,NULL),(1276,4500,'Ben-Ahin',NULL,NULL),(1277,4500,'Huy',NULL,NULL),(1278,4520,'Huccorgne',NULL,NULL),(1279,4520,'Moha',NULL,NULL),(1280,4530,'Vaux-Et-Borset',NULL,NULL),(1281,4530,'Villers-Le-Bouillet',NULL,NULL),(1282,4537,'Chapon-Seraing',NULL,NULL),(1283,4540,'Flône',NULL,NULL),(1284,4540,'Ombret',NULL,NULL),(1285,4550,'Nandrin',NULL,NULL),(1286,4557,'Fraiture',NULL,NULL),(1287,4557,'Ramelot',NULL,NULL),(1288,4557,'Soheit-Tinlot',NULL,NULL),(1289,4560,'Clavier',NULL,NULL),(1290,4560,'Terwagne',NULL,NULL),(1291,4570,'Vyle-Et-Tharoul',NULL,NULL),(1292,4590,'Ellemelle',NULL,NULL),(1293,4600,'Richelle',NULL,NULL),(1294,4607,'Bombaye',NULL,NULL),(1295,4610,'Beyne-Heusay',NULL,NULL),(1296,4630,'Micheroux',NULL,NULL),(1297,4651,'Battice',NULL,NULL),(1298,4653,'Bolland',NULL,NULL),(1299,4670,'Blégny',NULL,NULL),(1300,4670,'Mortier',NULL,NULL),(1301,4671,'Housse',NULL,NULL),(1302,4680,'Hermée',NULL,NULL),(1303,4682,'Houtain-Saint-Siméon',NULL,NULL),(1304,4690,'Boirs',NULL,NULL),(1305,4690,'Eben-Emael',NULL,NULL),(1306,4690,'Glons',NULL,NULL),(1307,4690,'Roclenge-Sur-Geer',NULL,NULL),(1308,4710,'Lontzen',NULL,NULL),(1309,4711,'Walhorn',NULL,NULL),(1310,4730,'Raeren',NULL,NULL),(1311,4750,'Butgenbach',NULL,NULL),(1312,4770,'Meyerode',NULL,NULL),(1313,4791,'Thommen',NULL,NULL),(1314,4800,'Lambermont',NULL,NULL),(1315,4801,'Stembert',NULL,NULL),(1316,4831,'Bilstain',NULL,NULL),(1317,4840,'Welkenraedt',NULL,NULL),(1318,4850,'Plombières',NULL,NULL),(1319,4860,'Pepinster',NULL,NULL),(1320,4870,'Nessonvaux',NULL,NULL),(1321,4870,'Trooz',NULL,NULL),(1322,4877,'Olne',NULL,NULL),(1323,4890,'Thimister',NULL,NULL),(1324,4890,'Thimister-Clermont',NULL,NULL),(1325,4920,'Ernonheid',NULL,NULL),(1326,4950,'Waimes',NULL,NULL),(1327,4960,'Bevercé',NULL,NULL),(1328,4970,'Stavelot',NULL,NULL),(1329,4987,'Chevron',NULL,NULL),(1330,4987,'La Gleize',NULL,NULL),(1331,4987,'Rahier',NULL,NULL),(1332,5000,'Namur',NULL,NULL),(1333,5002,'Saint-Servais',NULL,NULL),(1334,5003,'Saint-Marc',NULL,NULL),(1335,5020,'Daussoulx',NULL,NULL),(1336,5030,'Ernage',NULL,NULL),(1337,5030,'Sauvenière',NULL,NULL),(1338,5032,'Bothey',NULL,NULL),(1339,5060,'Falisolle',NULL,NULL),(1340,5070,'Aisemont',NULL,NULL),(1341,5070,'Fosses-La-Ville',NULL,NULL),(1342,5080,'Villers-Lez-Heest',NULL,NULL),(1343,5081,'Bovesse',NULL,NULL),(1344,5100,'Naninne',NULL,NULL),(1345,5100,'Wépion',NULL,NULL),(1346,5101,'Lives-Sur-Meuse',NULL,NULL),(1347,5101,'Loyers',NULL,NULL),(1348,5140,'Tongrinne',NULL,NULL),(1349,5150,'Franière',NULL,NULL),(1350,5190,'Balâtre',NULL,NULL),(1351,5300,'Bonneville',NULL,NULL),(1352,5300,'Sclayn',NULL,NULL),(1353,5310,'Aische-En-Refail',NULL,NULL),(1354,5310,'Branchon',NULL,NULL),(1355,5310,'Noville-Sur-Méhaigne',NULL,NULL),(1356,5310,'Waret-La-Chaussée',NULL,NULL),(1357,5330,'Maillen',NULL,NULL),(1358,5333,'Sorinne-La-Longue',NULL,NULL),(1359,5340,'Gesves',NULL,NULL),(1360,5340,'Haltinne',NULL,NULL),(1361,5350,'Ohey',NULL,NULL),(1362,5361,'Mohiville',NULL,NULL),(1363,5370,'Barvaux-Condroz',NULL,NULL),(1364,5370,'Flostoy',NULL,NULL),(1365,5377,'Heure',NULL,NULL),(1366,5380,'Fernelmont',NULL,NULL),(1367,5380,'Hemptinne',NULL,NULL),(1368,5380,'Marchovelette',NULL,NULL),(1369,5380,'Noville-Les-Bois',NULL,NULL),(1370,5380,'Pontillas',NULL,NULL),(1371,5503,'Sorinnes',NULL,NULL),(1372,5530,'Dorinne',NULL,NULL),(1373,5530,'Houx',NULL,NULL),(1374,5537,'Denée',NULL,NULL),(1375,5540,'Hastière',NULL,NULL),(1376,5540,'Waulsort',NULL,NULL),(1377,5550,'Bagimont',NULL,NULL),(1378,5550,'Pussemange',NULL,NULL),(1379,5550,'Sugny',NULL,NULL),(1380,5555,'Bièvre',NULL,NULL),(1381,5555,'Monceau-En-Ardenne',NULL,NULL),(1382,5560,'Hulsonniaux',NULL,NULL),(1383,5561,'Celles',NULL,NULL),(1384,5562,'Custinne',NULL,NULL),(1385,5570,'Feschaux',NULL,NULL),(1386,5571,'Wiesme',NULL,NULL),(1387,5573,'Martouzin-Neuville',NULL,NULL),(1388,5574,'Pondrôme',NULL,NULL),(1389,5580,'Han-Sur-Lesse',NULL,NULL),(1390,5580,'Villers-Sur-Lesse',NULL,NULL),(1391,5590,'Leignon',NULL,NULL),(1392,5590,'Pessoux',NULL,NULL),(1393,5600,'Jamagne',NULL,NULL),(1394,5600,'Jamiolle',NULL,NULL),(1395,5600,'Neuville',NULL,NULL),(1396,5620,'Rosée',NULL,NULL),(1397,5630,'Daussois',NULL,NULL),(1398,5630,'Villers-Deux-Eglises',NULL,NULL),(1399,5640,'Graux',NULL,NULL),(1400,5640,'Saint-Gérard',NULL,NULL),(1401,5644,'Ermeton-Sur-Biert',NULL,NULL),(1402,5651,'Berzée',NULL,NULL),(1403,5660,'Couvin',NULL,NULL),(1404,5660,'Mariembourg',NULL,NULL),(1405,5660,'Petite-Chapelle',NULL,NULL),(1406,5670,'Le Mesnil',NULL,NULL),(1407,6010,'Couillet',NULL,NULL),(1408,6043,'Ransart',NULL,NULL),(1409,6060,'Gilly',NULL,NULL),(1410,6061,'Montignies-Sur-Sambre',NULL,NULL),(1411,6141,'Forchies-La-Marche',NULL,NULL),(1412,6182,'Souvret',NULL,NULL),(1413,6183,'Trazegnies',NULL,NULL),(1414,6210,'Les Bons Villers',NULL,NULL),(1415,6210,'Rèves',NULL,NULL),(1416,6210,'Villers-Perwin',NULL,NULL),(1417,6223,'Wagnelée',NULL,NULL),(1418,6230,'Buzet',NULL,NULL),(1419,6230,'Obaix',NULL,NULL),(1420,6230,'Viesville',NULL,NULL),(1421,6240,'Farciennes',NULL,NULL),(1422,6250,'Aiseau',NULL,NULL),(1423,6440,'Fourbechies',NULL,NULL),(1424,6460,'Bailièvre',NULL,NULL),(1425,6460,'Robechies',NULL,NULL),(1426,6460,'Villers-La-Tour',NULL,NULL),(1427,6464,'Bourlers',NULL,NULL),(1428,6464,'L\'escaillère',NULL,NULL),(1429,6500,'Leugnies',NULL,NULL),(1430,6536,'Donstiennes',NULL,NULL),(1431,6540,'Mont-Sainte-Geneviève',NULL,NULL),(1432,6560,'Erquelinnes',NULL,NULL),(1433,6567,'Merbes-Le-Château',NULL,NULL),(1434,6593,'Macquenoise',NULL,NULL),(1435,6594,'Beauwelz',NULL,NULL),(1436,6596,'Forge-Philippe',NULL,NULL),(1437,6596,'Seloignes',NULL,NULL),(1438,6600,'Villers-La-Bonne-Eau',NULL,NULL),(1439,6637,'Tintange',NULL,NULL),(1440,6640,'Sibret',NULL,NULL),(1441,6662,'Tavigny',NULL,NULL),(1442,6673,'Cherain',NULL,NULL),(1443,6690,'Bihain',NULL,NULL),(1444,6700,'Bonnert',NULL,NULL),(1445,6700,'Heinsch',NULL,NULL),(1446,6704,'Guirsch',NULL,NULL),(1447,6730,'Tintigny',NULL,NULL),(1448,6742,'Chantemelle',NULL,NULL),(1449,6747,'Meix-Le-Tige',NULL,NULL),(1450,6760,'Ethe',NULL,NULL),(1451,6761,'Latour',NULL,NULL),(1452,6767,'Torgny',NULL,NULL),(1453,6769,'Villers-La-Loue',NULL,NULL),(1454,6780,'Messancy',NULL,NULL),(1455,6780,'Wolkrange',NULL,NULL),(1456,6812,'Suxy',NULL,NULL),(1457,6820,'Florenville',NULL,NULL),(1458,6820,'Fontenoille',NULL,NULL),(1459,6821,'Lacuisine',NULL,NULL),(1460,6823,'Villers-Devant-Orval',NULL,NULL),(1461,6824,'Chassepierre',NULL,NULL),(1462,6836,'Dohan',NULL,NULL),(1463,6840,'Grandvoir',NULL,NULL),(1464,6840,'Tournay',NULL,NULL),(1465,6856,'Fays-Les-Veneurs',NULL,NULL),(1466,6860,'Mellier',NULL,NULL),(1467,6860,'Witry',NULL,NULL),(1468,6870,'Arville',NULL,NULL),(1469,6870,'Awenne',NULL,NULL),(1470,6870,'Hatrival',NULL,NULL),(1471,6870,'Saint-Hubert',NULL,NULL),(1472,6880,'Cugnon',NULL,NULL),(1473,6887,'Herbeumont',NULL,NULL),(1474,6887,'Straimont',NULL,NULL),(1475,6890,'Anloy',NULL,NULL),(1476,6920,'Wellin',NULL,NULL),(1477,6927,'Bure',NULL,NULL),(1478,6927,'Grupont',NULL,NULL),(1479,6929,'Gembes',NULL,NULL),(1480,6940,'Grandhan',NULL,NULL),(1481,6940,'Septon',NULL,NULL),(1482,6941,'Heyd',NULL,NULL),(1483,6941,'Izier',NULL,NULL),(1484,6951,'Bande',NULL,NULL),(1485,6953,'Ambly',NULL,NULL),(1486,6953,'Lesterny',NULL,NULL),(1487,6960,'Malempré',NULL,NULL),(1488,6960,'Vaux-Chavanne',NULL,NULL),(1489,6972,'Erneuville',NULL,NULL),(1490,6980,'La Roche-En-Ardenne',NULL,NULL),(1491,6990,'Hampteau',NULL,NULL),(1492,6990,'Marenne',NULL,NULL),(1493,7020,'Maisières',NULL,NULL),(1494,7021,'Havre',NULL,NULL),(1495,7024,'Ciply',NULL,NULL),(1496,7033,'Cuesmes',NULL,NULL),(1497,7050,'Herchies',NULL,NULL),(1498,7060,'Horrues',NULL,NULL),(1499,7070,'Gottignies',NULL,NULL),(1500,7070,'Mignault',NULL,NULL),(1501,7080,'Frameries',NULL,NULL),(1502,7080,'La Bouverie',NULL,NULL),(1503,7090,'Braine-Le-Comte',NULL,NULL),(1504,7090,'Steenkerque',NULL,NULL),(1505,7100,'Haine-Saint-Paul',NULL,NULL),(1506,7110,'Houdeng-Aimeries',NULL,NULL),(1507,7133,'Buvrinnes',NULL,NULL),(1508,7134,'Epinois',NULL,NULL),(1509,7134,'Leval-Trahegnies',NULL,NULL),(1510,7180,'Seneffe',NULL,NULL),(1511,7190,'Ecaussinnes-D\'enghien',NULL,NULL),(1512,7190,'Marche-Lez-Ecaussinnes',NULL,NULL),(1513,7301,'Hornu',NULL,NULL),(1514,7321,'Blaton',NULL,NULL),(1515,7321,'Harchies',NULL,NULL),(1516,7330,'Saint-Ghislain',NULL,NULL),(1517,7340,'Warquignies',NULL,NULL),(1518,7350,'Hensies',NULL,NULL),(1519,7387,'Angre',NULL,NULL),(1520,7387,'Angreau',NULL,NULL),(1521,7387,'Montignies-Sur-Roc',NULL,NULL),(1522,7522,'Hertain',NULL,NULL),(1523,7533,'Thimougies',NULL,NULL),(1524,7536,'Vaulx',NULL,NULL),(1525,7538,'Vezon',NULL,NULL),(1526,7540,'Melles',NULL,NULL),(1527,7540,'Rumillies',NULL,NULL),(1528,7543,'Mourcourt',NULL,NULL),(1529,7600,'Péruwelz',NULL,NULL),(1530,7604,'Wasmes-Audemez-Briffoeil',NULL,NULL),(1531,7608,'Wiers',NULL,NULL),(1532,7620,'Bléharies',NULL,NULL),(1533,7621,'Lesdain',NULL,NULL),(1534,7623,'Rongy',NULL,NULL),(1535,7640,'Antoing',NULL,NULL),(1536,7712,'Herseaux',NULL,NULL),(1537,7730,'Néchin',NULL,NULL),(1538,7740,'Warcoing',NULL,NULL),(1539,7743,'Obigies',NULL,NULL),(1540,7784,'Bas-Warneton',NULL,NULL),(1541,7784,'Warneton',NULL,NULL),(1542,7800,'Lanquesaint',NULL,NULL),(1543,7802,'Ormeignies',NULL,NULL),(1544,7804,'Rebaix',NULL,NULL),(1545,7812,'Ligne',NULL,NULL),(1546,7812,'Moulbaix',NULL,NULL),(1547,7812,'Villers-Notre-Dame',NULL,NULL),(1548,7822,'Meslin-L\'evêque',NULL,NULL),(1549,7830,'Graty',NULL,NULL),(1550,7830,'Hellebecq',NULL,NULL),(1551,7850,'Enghien',NULL,NULL),(1552,7860,'Lessines',NULL,NULL),(1553,7861,'Papignies',NULL,NULL),(1554,7864,'Deux-Acren',NULL,NULL),(1555,7870,'Bauffe',NULL,NULL),(1556,7870,'Cambron-Saint-Vincent',NULL,NULL),(1557,7904,'Pipaix',NULL,NULL),(1558,7904,'Tourpes',NULL,NULL),(1559,7910,'Anvaing',NULL,NULL),(1560,7911,'Buissenal',NULL,NULL),(1561,7911,'Moustier',NULL,NULL),(1562,7912,'Saint-Sauveur',NULL,NULL),(1563,7940,'Brugelette',NULL,NULL),(1564,7940,'Cambron-Casteau',NULL,NULL),(1565,7941,'Attre',NULL,NULL),(1566,7943,'Gages',NULL,NULL),(1567,7950,'Tongre-Saint-Martin',NULL,NULL),(1568,7972,'Aubechies',NULL,NULL),(1569,8210,'Veldegem',NULL,NULL),(1570,8370,'Uitkerke',NULL,NULL),(1571,8377,'Meetkerke',NULL,NULL),(1572,8380,'Lissewege',NULL,NULL),(1573,8433,'Schore',NULL,NULL),(1574,8434,'Lombardsijde',NULL,NULL),(1575,8460,'Oudenburg',NULL,NULL),(1576,8460,'Roksem',NULL,NULL),(1577,8470,'Gistel',NULL,NULL),(1578,8470,'Snaaskerke',NULL,NULL),(1579,8510,'Marke',NULL,NULL),(1580,8520,'Kuurne',NULL,NULL),(1581,8530,'Harelbeke',NULL,NULL),(1582,8540,'Deerlijk',NULL,NULL),(1583,8553,'Otegem',NULL,NULL),(1584,8560,'Moorsele',NULL,NULL),(1585,8587,'Espierres',NULL,NULL),(1586,8600,'Beerst',NULL,NULL),(1587,8600,'Driekapellen',NULL,NULL),(1588,8600,'Esen',NULL,NULL),(1589,8600,'Lampernisse',NULL,NULL),(1590,8620,'Nieuwpoort',NULL,NULL),(1591,8620,'Ramskapelle',NULL,NULL),(1592,8630,'Bulskamp',NULL,NULL),(1593,8650,'Houthulst',NULL,NULL),(1594,8670,'Wulpen',NULL,NULL),(1595,8690,'Alveringem',NULL,NULL),(1596,8700,'Kanegem',NULL,NULL),(1597,8720,'Oeselgem',NULL,NULL),(1598,8740,'Pittem',NULL,NULL),(1599,8800,'Beveren',NULL,NULL),(1600,8810,'Lichtervelde',NULL,NULL),(1601,8840,'Staden',NULL,NULL),(1602,8850,'Ardooie',NULL,NULL),(1603,8870,'Izegem',NULL,NULL),(1604,8880,'Sint-Eloois-Winkel',NULL,NULL),(1605,8890,'Dadizele',NULL,NULL),(1606,8890,'Moorslede',NULL,NULL),(1607,8900,'Sint-Jan',NULL,NULL),(1608,8904,'Boezinge',NULL,NULL),(1609,8940,'Geluwe',NULL,NULL),(1610,8940,'Wervik',NULL,NULL),(1611,8950,'Nieuwkerke',NULL,NULL),(1612,8970,'Poperinge',NULL,NULL),(1613,8972,'Roesbrugge-Haringe',NULL,NULL),(1614,8980,'Beselare',NULL,NULL),(1615,8980,'Geluveld',NULL,NULL),(1616,9070,'Destelbergen',NULL,NULL),(1617,9080,'Zaffelare',NULL,NULL),(1618,9090,'Gontrode',NULL,NULL),(1619,9090,'Melle',NULL,NULL),(1620,9100,'Nieuwkerken-Waas',NULL,NULL),(1621,9100,'Sint-Niklaas',NULL,NULL),(1622,9120,'Haasdonk',NULL,NULL),(1623,9120,'Melsele',NULL,NULL),(1624,9140,'Steendorp',NULL,NULL),(1625,9140,'Temse',NULL,NULL),(1626,9150,'Rupelmonde',NULL,NULL),(1627,9200,'Mespelare',NULL,NULL),(1628,9220,'Moerzeke',NULL,NULL),(1629,9230,'Wetteren',NULL,NULL),(1630,9255,'Opdorp',NULL,NULL),(1631,9260,'Wichelen',NULL,NULL),(1632,9308,'Gijzegem',NULL,NULL),(1633,9320,'Nieuwerkerken',NULL,NULL),(1634,9340,'Oordegem',NULL,NULL),(1635,9400,'Appelterre-Eichem',NULL,NULL),(1636,9400,'Denderwindeke',NULL,NULL),(1637,9400,'Lieferinge',NULL,NULL),(1638,9403,'Neigem',NULL,NULL),(1639,9420,'Ottergem',NULL,NULL),(1640,9500,'Geraardsbergen',NULL,NULL),(1641,9500,'Overboelare',NULL,NULL),(1642,9521,'Letterhoutem',NULL,NULL),(1643,9551,'Ressegem',NULL,NULL),(1644,9552,'Borsbeke',NULL,NULL),(1645,9570,'Deftinge',NULL,NULL),(1646,9570,'Sint-Maria-Lierde',NULL,NULL),(1647,9620,'Grotenberge',NULL,NULL),(1648,9620,'Leeuwergem',NULL,NULL),(1649,9620,'Velzeke-Ruddershove',NULL,NULL),(1650,9630,'Meilegem',NULL,NULL),(1651,9630,'Paulatem',NULL,NULL),(1652,9630,'Sint-Maria-Latem',NULL,NULL),(1653,9660,'Opbrakel',NULL,NULL),(1654,9667,'Sint-Maria-Horebeke',NULL,NULL),(1655,9680,'Maarkedal',NULL,NULL),(1656,9700,'Eine',NULL,NULL),(1657,9700,'Melden',NULL,NULL),(1658,9700,'Mullem',NULL,NULL),(1659,9700,'Volkegem',NULL,NULL),(1660,9750,'Zingem',NULL,NULL),(1661,9790,'Elsegem',NULL,NULL),(1662,9790,'Petegem-Aan-De-Schelde',NULL,NULL),(1663,9800,'Bachte-Maria-Leerne',NULL,NULL),(1664,9800,'Deinze',NULL,NULL),(1665,9800,'Gottem',NULL,NULL),(1666,9800,'Wontergem',NULL,NULL),(1667,9800,'Zeveren',NULL,NULL),(1668,9810,'Eke',NULL,NULL),(1669,9820,'Melsen',NULL,NULL),(1670,9831,'Deurle',NULL,NULL),(1671,9850,'Landegem',NULL,NULL),(1672,9850,'Nevele',NULL,NULL),(1673,9880,'Aalter',NULL,NULL),(1674,9880,'Poeke',NULL,NULL),(1675,9910,'Knesselare',NULL,NULL),(1676,9932,'Ronsele',NULL,NULL),(1677,9940,'Sleidinge',NULL,NULL),(1678,9980,'Sint-Laureins',NULL,NULL),(1679,1040,'Etterbeek',NULL,NULL),(1680,1070,'Anderlecht',NULL,NULL),(1681,1160,'Auderghem',NULL,NULL),(1682,1180,'Uccle',NULL,NULL),(1683,1190,'Forest',NULL,NULL),(1684,1300,'Limal',NULL,NULL),(1685,1320,'Tourinnes-La-Grosse',NULL,NULL),(1686,1325,'Dion-Valmont',NULL,NULL),(1687,1325,'Longueville',NULL,NULL),(1688,1367,'Ramillies',NULL,NULL),(1689,1370,'Jauchelette',NULL,NULL),(1690,1380,'Ohain',NULL,NULL),(1691,1390,'Archennes',NULL,NULL),(1692,1400,'Nivelles',NULL,NULL),(1693,1402,'Thines',NULL,NULL),(1694,1430,'Quenast',NULL,NULL),(1695,1430,'Rebecq',NULL,NULL),(1696,1435,'Corbais',NULL,NULL),(1697,1435,'Hévillers',NULL,NULL),(1698,1473,'Glabais',NULL,NULL),(1699,1476,'Houtain-Le-Val',NULL,NULL),(1700,1547,'Biévène',NULL,NULL),(1701,1630,'Linkebeek',NULL,NULL),(1702,1640,'Rhode-Saint-Genèse',NULL,NULL),(1703,1650,'Beersel',NULL,NULL),(1704,1654,'Huizingen',NULL,NULL),(1705,1670,'Pepingen',NULL,NULL),(1706,1741,'Wambeek',NULL,NULL),(1707,1745,'Opwijk',NULL,NULL),(1708,1760,'Roosdaal',NULL,NULL),(1709,1761,'Borchtlombeek',NULL,NULL),(1710,1785,'Merchtem',NULL,NULL),(1711,1790,'Affligem',NULL,NULL),(1712,1790,'Hekelgem',NULL,NULL),(1713,1800,'Peutie',NULL,NULL),(1714,1820,'Melsbroek',NULL,NULL),(1715,1820,'Steenokkerzeel',NULL,NULL),(1716,1851,'Humbeek',NULL,NULL),(1717,1910,'Berg',NULL,NULL),(1718,1932,'Sint-Stevens-Woluwe',NULL,NULL),(1719,1980,'Zemst',NULL,NULL),(1720,2018,'Antwerpen',NULL,NULL),(1721,2030,'Antwerpen',NULL,NULL),(1722,2040,'Berendrecht',NULL,NULL),(1723,2040,'Lillo',NULL,NULL),(1724,2060,'Antwerpen',NULL,NULL),(1725,2150,'Borsbeek',NULL,NULL),(1726,2170,'Merksem',NULL,NULL),(1727,2223,'Schriek',NULL,NULL),(1728,2235,'Westmeerbeek',NULL,NULL),(1729,2260,'Westerlo',NULL,NULL),(1730,2288,'Bouwel',NULL,NULL),(1731,2300,'Turnhout',NULL,NULL),(1732,2310,'Rijkevorsel',NULL,NULL),(1733,2340,'Beerse',NULL,NULL),(1734,2360,'Oud-Turnhout',NULL,NULL),(1735,2382,'Poppel',NULL,NULL),(1736,2390,'Westmalle',NULL,NULL),(1737,2431,'Veerle',NULL,NULL),(1738,2440,'Geel',NULL,NULL),(1739,2480,'Dessel',NULL,NULL),(1740,2490,'Balen',NULL,NULL),(1741,2520,'Emblem',NULL,NULL),(1742,2547,'Lint',NULL,NULL),(1743,2550,'Kontich',NULL,NULL),(1744,2560,'Bevel',NULL,NULL),(1745,2590,'Gestel',NULL,NULL),(1746,2610,'Wilrijk',NULL,NULL),(1747,2811,'Leest',NULL,NULL),(1748,2812,'Muizen',NULL,NULL),(1749,2840,'Rumst',NULL,NULL),(1750,2870,'Puurs',NULL,NULL),(1751,2880,'Weert',NULL,NULL),(1752,2890,'Oppuurs',NULL,NULL),(1753,2930,'Brasschaat',NULL,NULL),(1754,2940,'Stabroek',NULL,NULL),(1755,2960,'Sint-Lenaarts',NULL,NULL),(1756,3000,'Leuven',NULL,NULL),(1757,3040,'Sint-Agatha-Rode',NULL,NULL),(1758,3051,'Sint-Joris-Weert',NULL,NULL),(1759,3053,'Haasrode',NULL,NULL),(1760,3090,'Overijse',NULL,NULL),(1761,3110,'Rotselaar',NULL,NULL),(1762,3111,'Wezemaal',NULL,NULL),(1763,3118,'Werchter',NULL,NULL),(1764,3130,'Betekom',NULL,NULL),(1765,3150,'Wespelaar',NULL,NULL),(1766,3200,'Aarschot',NULL,NULL),(1767,3210,'Lubbeek',NULL,NULL),(1768,3220,'Kortrijk-Dutsel',NULL,NULL),(1769,3272,'Messelbroek',NULL,NULL),(1770,3360,'Lovenjoel',NULL,NULL),(1771,3370,'Neervelp',NULL,NULL),(1772,3370,'Vertrijk',NULL,NULL),(1773,3400,'Landen',NULL,NULL),(1774,3401,'Walshoutem',NULL,NULL),(1775,3401,'Wezeren',NULL,NULL),(1776,3460,'Assent',NULL,NULL),(1777,3461,'Molenbeek-Wersbeek',NULL,NULL),(1778,3470,'Ransberg',NULL,NULL),(1779,3472,'Kersbeek-Miskom',NULL,NULL),(1780,3501,'Wimmertingen',NULL,NULL),(1781,3510,'Spalbeek',NULL,NULL),(1782,3511,'Kuringen',NULL,NULL),(1783,3512,'Stevoort',NULL,NULL),(1784,3530,'Helchteren',NULL,NULL),(1785,3545,'Halen',NULL,NULL),(1786,3545,'Zelem',NULL,NULL),(1787,3550,'Heusden',NULL,NULL),(1788,3560,'Meldert',NULL,NULL),(1789,3583,'Paal',NULL,NULL),(1790,3590,'Diepenbeek',NULL,NULL),(1791,3620,'Lanaken',NULL,NULL),(1792,3620,'Veldwezelt',NULL,NULL),(1793,3621,'Rekem',NULL,NULL),(1794,3630,'Eisden',NULL,NULL),(1795,3630,'Meeswijk',NULL,NULL),(1796,3630,'Opgrimbie',NULL,NULL),(1797,3630,'Vucht',NULL,NULL),(1798,3650,'Elen',NULL,NULL),(1799,3665,'As',NULL,NULL),(1800,3680,'Maaseik',NULL,NULL),(1801,3680,'Opoeteren',NULL,NULL),(1802,3700,'Diets-Heur',NULL,NULL),(1803,3730,'Romershoven',NULL,NULL),(1804,3730,'Sint-Huibrechts-Hern',NULL,NULL),(1805,3740,'Rijkhoven',NULL,NULL),(1806,3770,'Val-Meer',NULL,NULL),(1807,3790,'Mouland',NULL,NULL),(1808,3800,'Aalst',NULL,NULL),(1809,3800,'Groot-Gelmen',NULL,NULL),(1810,3800,'Halmaal',NULL,NULL),(1811,3803,'Gorsem',NULL,NULL),(1812,3830,'Wellen',NULL,NULL),(1813,3840,'Haren',NULL,NULL),(1814,3840,'Hendrieken',NULL,NULL),(1815,3840,'Voort',NULL,NULL),(1816,3870,'Heers',NULL,NULL),(1817,3870,'Vechmaal',NULL,NULL),(1818,3891,'Buvingen',NULL,NULL),(1819,3891,'Mielen-Boven-Aalst',NULL,NULL),(1820,3891,'Muizen',NULL,NULL),(1821,3900,'Overpelt',NULL,NULL),(1822,3945,'Kwaadmechelen',NULL,NULL),(1823,3950,'Bocholt',NULL,NULL),(1824,3950,'Reppel',NULL,NULL),(1825,3960,'Opitter',NULL,NULL),(1826,3990,'Grote-Brogel',NULL,NULL),(1827,4030,'Grivegnee',NULL,NULL),(1828,4053,'Embourg',NULL,NULL),(1829,4120,'Ehein',NULL,NULL),(1830,4140,'Dolembreux',NULL,NULL),(1831,4140,'Rouvreux',NULL,NULL),(1832,4161,'Villers-Aux-Tours',NULL,NULL),(1833,4163,'Tavier',NULL,NULL),(1834,4190,'Xhoris',NULL,NULL),(1835,4210,'Oteppe',NULL,NULL),(1836,4219,'Ambresin',NULL,NULL),(1837,4219,'Meeffe',NULL,NULL),(1838,4219,'Wasseiges',NULL,NULL),(1839,4252,'Omal',NULL,NULL),(1840,4260,'Ciplet',NULL,NULL),(1841,4280,'Avernas-Le-Bauduin',NULL,NULL),(1842,4280,'Petit-Hallet',NULL,NULL),(1843,4280,'Poucet',NULL,NULL),(1844,4280,'Trognée',NULL,NULL),(1845,4287,'Lincent',NULL,NULL),(1846,4300,'Bettincourt',NULL,NULL),(1847,4317,'Borlez',NULL,NULL),(1848,4317,'Celles',NULL,NULL),(1849,4317,'Les Waleffes',NULL,NULL),(1850,4340,'Awans',NULL,NULL),(1851,4350,'Lamine',NULL,NULL),(1852,4350,'Momalle',NULL,NULL),(1853,4351,'Hodeige',NULL,NULL),(1854,4360,'Grandville',NULL,NULL),(1855,4360,'Otrange',NULL,NULL),(1856,4400,'Ivoz-Ramet',NULL,NULL),(1857,4400,'Mons-Lez-Liège',NULL,NULL),(1858,4430,'Ans',NULL,NULL),(1859,4432,'Alleur',NULL,NULL),(1860,4460,'Hollogne-Aux-Pierres',NULL,NULL),(1861,4460,'Velroux',NULL,NULL),(1862,4520,'Antheit',NULL,NULL),(1863,4520,'Vinalmont',NULL,NULL),(1864,4540,'Amay',NULL,NULL),(1865,4550,'Saint-Séverin',NULL,NULL),(1866,4560,'Les Avins',NULL,NULL),(1867,4560,'Pailhe',NULL,NULL),(1868,4570,'Marchin',NULL,NULL),(1869,4607,'Berneau',NULL,NULL),(1870,4608,'Neufchâteau',NULL,NULL),(1871,4608,'Warsage',NULL,NULL),(1872,4610,'Bellaire',NULL,NULL),(1873,4621,'Retinne',NULL,NULL),(1874,4623,'Magnée',NULL,NULL),(1875,4630,'Ayeneux',NULL,NULL),(1876,4632,'Cérexhe-Heuseux',NULL,NULL),(1877,4654,'Charneux',NULL,NULL),(1878,4671,'Saive',NULL,NULL),(1879,4681,'Hermalle-Sous-Argenteau',NULL,NULL),(1880,4684,'Haccourt',NULL,NULL),(1881,4690,'Bassenge',NULL,NULL),(1882,4700,'Eupen',NULL,NULL),(1883,4770,'Amblève',NULL,NULL),(1884,4780,'Saint-Vith',NULL,NULL),(1885,4782,'Schoenberg',NULL,NULL),(1886,4800,'Ensival',NULL,NULL),(1887,4800,'Petit-Rechain',NULL,NULL),(1888,4800,'Polleur',NULL,NULL),(1889,4830,'Limbourg',NULL,NULL),(1890,4851,'Sippenaeken',NULL,NULL),(1891,4852,'Hombourg',NULL,NULL),(1892,4890,'Clermont',NULL,NULL),(1893,4920,'Aywaille',NULL,NULL),(1894,4920,'Louveigné',NULL,NULL),(1895,4950,'Robertville',NULL,NULL),(1896,4960,'Malmedy',NULL,NULL),(1897,4990,'Arbrefontaine',NULL,NULL),(1898,5024,'Marche-Les-Dames',NULL,NULL),(1899,5030,'Beuzet',NULL,NULL),(1900,5060,'Moignelée',NULL,NULL),(1901,5060,'Velaine-Sur-Sambre',NULL,NULL),(1902,5070,'Le Roux',NULL,NULL),(1903,5070,'Sart-Eustache',NULL,NULL),(1904,5170,'Lesve',NULL,NULL),(1905,5170,'Lustin',NULL,NULL),(1906,5190,'Ham-Sur-Sambre',NULL,NULL),(1907,5190,'Mornimont',NULL,NULL),(1908,5190,'Spy',NULL,NULL),(1909,5300,'Coutisse',NULL,NULL),(1910,5300,'Maizeret',NULL,NULL),(1911,5300,'Namêche',NULL,NULL),(1912,5300,'Thon',NULL,NULL),(1913,5310,'Boneffe',NULL,NULL),(1914,5310,'Upigny',NULL,NULL),(1915,5330,'Assesse',NULL,NULL),(1916,5340,'Mozet',NULL,NULL),(1917,5350,'Evelette',NULL,NULL),(1918,5353,'Goesnes',NULL,NULL),(1919,5354,'Jallet',NULL,NULL),(1920,5362,'Achet',NULL,NULL),(1921,5363,'Emptinne',NULL,NULL),(1922,5370,'Jeneffe',NULL,NULL),(1923,5372,'Méan',NULL,NULL),(1924,5377,'Sinsin',NULL,NULL),(1925,5377,'Somme-Leuze',NULL,NULL),(1926,5380,'Tillier',NULL,NULL),(1927,5500,'Bouvignes-Sur-Meuse',NULL,NULL),(1928,5500,'Dinant',NULL,NULL),(1929,5500,'Furfooz',NULL,NULL),(1930,5501,'Lisogne',NULL,NULL),(1931,5520,'Anthée',NULL,NULL),(1932,5521,'Serville',NULL,NULL),(1933,5522,'Falaen',NULL,NULL),(1934,5530,'Godinne',NULL,NULL),(1935,5530,'Purnode',NULL,NULL),(1936,5550,'Alle',NULL,NULL),(1937,5550,'Bohan',NULL,NULL),(1938,5550,'Laforet',NULL,NULL),(1939,5550,'Vresse-Sur-Semois',NULL,NULL),(1940,5555,'Gros-Fays',NULL,NULL),(1941,5555,'Oizy',NULL,NULL),(1942,5560,'Finnevaux',NULL,NULL),(1943,5560,'Mesnil-Saint-Blaise',NULL,NULL),(1944,5570,'Baronville',NULL,NULL),(1945,5575,'Bourseigne-Vieille',NULL,NULL),(1946,5575,'Louette-Saint-Denis',NULL,NULL),(1947,5575,'Louette-Saint-Pierre',NULL,NULL),(1948,5580,'Buissonville',NULL,NULL),(1949,5580,'Lessive',NULL,NULL),(1950,5590,'Achêne',NULL,NULL),(1951,5590,'Conneux',NULL,NULL),(1952,5590,'Haversin',NULL,NULL),(1953,5590,'Serinchamps',NULL,NULL),(1954,5590,'Sovet',NULL,NULL),(1955,5600,'Philippeville',NULL,NULL),(1956,5600,'Romedenne',NULL,NULL),(1957,5600,'Surice',NULL,NULL),(1958,5620,'Hemptinne-Lez-Florennes',NULL,NULL),(1959,5620,'Saint-Aubin',NULL,NULL),(1960,5630,'Silenrieux',NULL,NULL),(1961,5650,'Castillon',NULL,NULL),(1962,5650,'Clermont',NULL,NULL),(1963,5650,'Fontenelle',NULL,NULL),(1964,5650,'Vogenée',NULL,NULL),(1965,5651,'Gourdinne',NULL,NULL),(1966,5651,'Somzée',NULL,NULL),(1967,5651,'Thy-Le-Château',NULL,NULL),(1968,5660,'Aublain',NULL,NULL),(1969,5660,'Brûly',NULL,NULL),(1970,5660,'Frasnes',NULL,NULL),(1971,5660,'Gonrieux',NULL,NULL),(1972,5660,'Pesche',NULL,NULL),(1973,5660,'Petigny',NULL,NULL),(1974,5670,'Mazée',NULL,NULL),(1975,5680,'Soulme',NULL,NULL),(1976,6020,'Dampremy',NULL,NULL),(1977,6032,'Mont-Sur-Marchienne',NULL,NULL),(1978,6111,'Landelies',NULL,NULL),(1979,6120,'Jamioulx',NULL,NULL),(1980,6200,'Bouffioulx',NULL,NULL),(1981,6200,'Châtelet',NULL,NULL),(1982,6200,'Châtelineau',NULL,NULL),(1983,6220,'Fleurus',NULL,NULL),(1984,6220,'Lambusart',NULL,NULL),(1985,6221,'Saint-Amand',NULL,NULL),(1986,6224,'Wanfercée-Baulet',NULL,NULL),(1987,6230,'Thiméon',NULL,NULL),(1988,6280,'Acoz',NULL,NULL),(1989,6280,'Gougnies',NULL,NULL),(1990,6440,'Boussu-Lez-Walcourt',NULL,NULL),(1991,6440,'Froidchapelle',NULL,NULL),(1992,6462,'Vaulx-Lez-Chimay',NULL,NULL),(1993,6463,'Lompret',NULL,NULL),(1994,6470,'Montbliart',NULL,NULL),(1995,6511,'Strée',NULL,NULL),(1996,6530,'Leers-Et-Fosteau',NULL,NULL),(1997,6543,'Bienne-Lez-Happart',NULL,NULL),(1998,6560,'Bersillies-L\'abbaye',NULL,NULL),(1999,6560,'Grand-Reng',NULL,NULL),(2000,6592,'Monceau-Imbrechies',NULL,NULL),(2001,6600,'Noville',NULL,NULL),(2002,6640,'Vaux-Lez-Rosières',NULL,NULL),(2003,6661,'Mont',NULL,NULL),(2004,6661,'Tailles',NULL,NULL),(2005,6666,'Wibrin',NULL,NULL),(2006,6670,'Limerlé',NULL,NULL),(2007,6671,'Bovigny',NULL,NULL),(2008,6672,'Beho',NULL,NULL),(2009,6674,'Montleban',NULL,NULL),(2010,6686,'Flamierge',NULL,NULL),(2011,6687,'Bertogne',NULL,NULL),(2012,6700,'Arlon',NULL,NULL),(2013,6720,'Habay',NULL,NULL),(2014,6723,'Habay-La-Vieille',NULL,NULL),(2015,6724,'Rulles',NULL,NULL),(2016,6740,'Etalle',NULL,NULL),(2017,6767,'Lamorteau',NULL,NULL),(2018,6767,'Rouvroy',NULL,NULL),(2019,6769,'Meix-Devant-Virton',NULL,NULL),(2020,6769,'Sommethonne',NULL,NULL),(2021,6782,'Habergy',NULL,NULL),(2022,6791,'Athus',NULL,NULL),(2023,6792,'Halanzy',NULL,NULL),(2024,6800,'Freux',NULL,NULL),(2025,6811,'Les Bulles',NULL,NULL),(2026,6813,'Termes',NULL,NULL),(2027,6830,'Poupehan',NULL,NULL),(2028,6830,'Rochehaut',NULL,NULL),(2029,6831,'Noirfontaine',NULL,NULL),(2030,6833,'Ucimont',NULL,NULL),(2031,6838,'Corbion',NULL,NULL),(2032,6840,'Grapfontaine',NULL,NULL),(2033,6840,'Neufchâteau',NULL,NULL),(2034,6880,'Jehonville',NULL,NULL),(2035,6887,'Saint-Médard',NULL,NULL),(2036,6890,'Libin',NULL,NULL),(2037,6900,'Hargimont',NULL,NULL),(2038,6920,'Sohier',NULL,NULL),(2039,6921,'Chanly',NULL,NULL),(2040,6922,'Halma',NULL,NULL),(2041,6929,'Haut-Fays',NULL,NULL),(2042,6953,'Forrières',NULL,NULL),(2043,6960,'Manhay',NULL,NULL),(2044,6971,'Champlon',NULL,NULL),(2045,6982,'Samrée',NULL,NULL),(2046,6983,'Ortho',NULL,NULL),(2047,6986,'Halleux',NULL,NULL),(2048,6987,'Hodister',NULL,NULL),(2049,6990,'Fronville',NULL,NULL),(2050,6997,'Mormont',NULL,NULL),(2051,7011,'Ghlin',NULL,NULL),(2052,7012,'Flénu',NULL,NULL),(2053,7020,'Nimy',NULL,NULL),(2054,7022,'Harmignies',NULL,NULL),(2055,7022,'Harveng',NULL,NULL),(2056,7031,'Villers-Saint-Ghislain',NULL,NULL),(2057,7040,'Quévy',NULL,NULL),(2058,7041,'Givry',NULL,NULL),(2059,7050,'Masnuy-Saint-Jean',NULL,NULL),(2060,7060,'Soignies',NULL,NULL),(2061,7061,'Casteau',NULL,NULL),(2062,7061,'Thieusies',NULL,NULL),(2063,7070,'Le Roeulx',NULL,NULL),(2064,7080,'Noirchain',NULL,NULL),(2065,7080,'Sars-La-Bruyère',NULL,NULL),(2066,7090,'Petit-Roeulx-Lez-Braine',NULL,NULL),(2067,7110,'Strépy-Bracquegnies',NULL,NULL),(2068,7120,'Estinnes-Au-Mont',NULL,NULL),(2069,7120,'Estinnes-Au-Val',NULL,NULL),(2070,7130,'Battignies',NULL,NULL),(2071,7141,'Carnières',NULL,NULL),(2072,7141,'Mont-Sainte-Aldegonde',NULL,NULL),(2073,7160,'Chapelle-Lez-Herlaimont',NULL,NULL),(2074,7160,'Godarville',NULL,NULL),(2075,7170,'Bellecourt',NULL,NULL),(2076,7322,'Pommeroeul',NULL,NULL),(2077,7334,'Hautrage',NULL,NULL),(2078,7334,'Villerot',NULL,NULL),(2079,7340,'Paturages',NULL,NULL),(2080,7380,'Baisieux',NULL,NULL),(2081,7387,'Fayt-Le-Franc',NULL,NULL),(2082,7387,'Roisin',NULL,NULL),(2083,7390,'Quaregnon',NULL,NULL),(2084,7500,'Saint-Maur',NULL,NULL),(2085,7503,'Froyennes',NULL,NULL),(2086,7521,'Chercq',NULL,NULL),(2087,7522,'Blandain',NULL,NULL),(2088,7540,'Kain',NULL,NULL),(2089,7548,'Warchin',NULL,NULL),(2090,7601,'Roucourt',NULL,NULL),(2091,7618,'Taintignies',NULL,NULL),(2092,7620,'Brunehaut',NULL,NULL),(2093,7620,'Jollain-Merlin',NULL,NULL),(2094,7640,'Maubray',NULL,NULL),(2095,7711,'Dottignies',NULL,NULL),(2096,7730,'Bailleul',NULL,NULL),(2097,7730,'Evregnies',NULL,NULL),(2098,7730,'Saint-Léger',NULL,NULL),(2099,7743,'Esquelmes',NULL,NULL),(2100,7760,'Celles',NULL,NULL),(2101,7760,'Escanaffles',NULL,NULL),(2102,7760,'Pottes',NULL,NULL),(2103,7803,'Bouvignies',NULL,NULL),(2104,7812,'Houtaing',NULL,NULL),(2105,7822,'Ghislenghien',NULL,NULL),(2106,7822,'Isières',NULL,NULL),(2107,7866,'Ollignies',NULL,NULL),(2108,7870,'Lens',NULL,NULL),(2109,7880,'Flobecq',NULL,NULL),(2110,7890,'Ellezelles',NULL,NULL),(2111,7900,'Grandmetz',NULL,NULL),(2112,7903,'Chapelle-À-Oie',NULL,NULL),(2113,7910,'Wattripont',NULL,NULL),(2114,7911,'Frasnes-Lez-Buissenal',NULL,NULL),(2115,7950,'Grosage',NULL,NULL),(2116,7973,'Grandglise',NULL,NULL),(2117,7973,'Stambruges',NULL,NULL),(2118,8000,'Brugge',NULL,NULL),(2119,8000,'Koolkerke',NULL,NULL),(2120,8020,'Oostkamp',NULL,NULL),(2121,8200,'Sint-Michiels',NULL,NULL),(2122,8300,'Knokke-Heist',NULL,NULL),(2123,8377,'Houtave',NULL,NULL),(2124,8420,'Klemskerke',NULL,NULL),(2125,8420,'Wenduine',NULL,NULL),(2126,8421,'Vlissegem',NULL,NULL),(2127,8432,'Leffinge',NULL,NULL),(2128,8434,'Westende',NULL,NULL),(2129,8480,'Ichtegem',NULL,NULL),(2130,8510,'Rollegem',NULL,NULL),(2131,8560,'Wevelgem',NULL,NULL),(2132,8570,'Anzegem',NULL,NULL),(2133,8570,'Vichte',NULL,NULL),(2134,8573,'Tiegem',NULL,NULL),(2135,8600,'Diksmuide',NULL,NULL),(2136,8600,'Pervijze',NULL,NULL),(2137,8610,'Kortemark',NULL,NULL),(2138,8620,'Sint-Joris',NULL,NULL),(2139,8630,'Avekapelle',NULL,NULL),(2140,8640,'Vleteren',NULL,NULL),(2141,8647,'Lo-Reninge',NULL,NULL),(2142,8647,'Pollinkhove',NULL,NULL),(2143,8650,'Klerken',NULL,NULL),(2144,8650,'Merkem',NULL,NULL),(2145,8691,'Izenberge',NULL,NULL),(2146,8700,'Tielt',NULL,NULL),(2147,8710,'Ooigem',NULL,NULL),(2148,8710,'Wielsbeke',NULL,NULL),(2149,8750,'Zwevezele',NULL,NULL),(2150,8755,'Ruiselede',NULL,NULL),(2151,8760,'Meulebeke',NULL,NULL),(2152,8791,'Beveren',NULL,NULL),(2153,8870,'Emelgem',NULL,NULL),(2154,8870,'Kachtem',NULL,NULL),(2155,8904,'Zuidschote',NULL,NULL),(2156,8920,'Langemark',NULL,NULL),(2157,8920,'Langemark-Poelkapelle',NULL,NULL),(2158,8930,'Rekkem',NULL,NULL),(2159,8950,'Heuvelland',NULL,NULL),(2160,8972,'Proven',NULL,NULL),(2161,8978,'Watou',NULL,NULL),(2162,9030,'Mariakerke',NULL,NULL),(2163,9041,'Oostakker',NULL,NULL),(2164,9042,'Desteldonk',NULL,NULL),(2165,9042,'Mendonk',NULL,NULL),(2166,9051,'Sint-Denijs-Westrem',NULL,NULL),(2167,9070,'Heusden',NULL,NULL),(2168,9112,'Sinaai-Waas',NULL,NULL),(2169,9120,'Vrasene',NULL,NULL),(2170,9150,'Kruibeke',NULL,NULL),(2171,9185,'Wachtebeke',NULL,NULL),(2172,9190,'Stekene',NULL,NULL),(2173,9200,'Baasrode',NULL,NULL),(2174,9220,'Hamme',NULL,NULL),(2175,9250,'Waasmunster',NULL,NULL),(2176,9260,'Schellebelle',NULL,NULL),(2177,9260,'Serskamp',NULL,NULL),(2178,9280,'Denderbelle',NULL,NULL),(2179,9280,'Wieze',NULL,NULL),(2180,9310,'Herdersem',NULL,NULL),(2181,9400,'Okegem',NULL,NULL),(2182,9420,'Erpe',NULL,NULL),(2183,9420,'Erpe-Mere',NULL,NULL),(2184,9420,'Mere',NULL,NULL),(2185,9450,'Heldergem',NULL,NULL),(2186,9472,'Iddergem',NULL,NULL),(2187,9500,'Goeferdinge',NULL,NULL),(2188,9500,'Moerbeke',NULL,NULL),(2189,9506,'Grimminge',NULL,NULL),(2190,9506,'Nieuwenhove',NULL,NULL),(2191,9506,'Schendelbeke',NULL,NULL),(2192,9520,'Bavegem',NULL,NULL),(2193,9520,'Sint-Lievens-Houtem',NULL,NULL),(2194,9550,'Hillegem',NULL,NULL),(2195,9550,'Sint-Antelinks',NULL,NULL),(2196,9550,'Steenhuize-Wijnhuize',NULL,NULL),(2197,9620,'Strijpen',NULL,NULL),(2198,9630,'Sint-Blasius-Boekel',NULL,NULL),(2199,9688,'Schorisse',NULL,NULL),(2200,9690,'Kwaremont',NULL,NULL),(2201,9700,'Edelare',NULL,NULL),(2202,9700,'Heurne',NULL,NULL),(2203,9700,'Leupegem',NULL,NULL),(2204,9700,'Mater',NULL,NULL),(2205,9700,'Oudenaarde',NULL,NULL),(2206,9700,'Welden',NULL,NULL),(2207,9750,'Huise',NULL,NULL),(2208,9750,'Ouwegem',NULL,NULL),(2209,9800,'Astene',NULL,NULL),(2210,9800,'Petegem-Aan-De-Leie',NULL,NULL),(2211,9850,'Hansbeke',NULL,NULL),(2212,9850,'Poesele',NULL,NULL),(2213,9860,'Balegem',NULL,NULL),(2214,9860,'Landskouter',NULL,NULL),(2215,9890,'Baaigem',NULL,NULL),(2216,9921,'Vinderhoute',NULL,NULL),(2217,9940,'Ertvelde',NULL,NULL),(2218,9961,'Boekhoute',NULL,NULL),(2219,9982,'Sint-Jan-In-Eremo',NULL,NULL),(2220,9988,'Waterland-Oudeman',NULL,NULL),(2221,9990,'Maldegem',NULL,NULL),(2222,1000,'Bruxelles',NULL,NULL),(2223,1082,'Berchem-Sainte-Agathe',NULL,NULL),(2224,1310,'La Hulpe',NULL,NULL),(2225,1315,'Glimes',NULL,NULL),(2226,1315,'Piètrebais',NULL,NULL),(2227,1320,'Beauvechain',NULL,NULL),(2228,1320,'Hamme-Mille',NULL,NULL),(2229,1320,'Nodebais',NULL,NULL),(2230,1325,'Chaumont-Gistoux',NULL,NULL),(2231,1330,'Rixensart',NULL,NULL),(2232,1332,'Genval',NULL,NULL),(2233,1342,'Limelette',NULL,NULL),(2234,1350,'Jandrain-Jandrenouille',NULL,NULL),(2235,1350,'Orp-Jauche',NULL,NULL),(2236,1360,'Malèves-Sainte-Marie-Wastines',NULL,NULL),(2237,1360,'Thorembais-Saint-Trond',NULL,NULL),(2238,1367,'Gérompont',NULL,NULL),(2239,1370,'Mélin',NULL,NULL),(2240,1370,'Piétrain',NULL,NULL),(2241,1370,'Zétrud-Lumay',NULL,NULL),(2242,1380,'Lasne-Chapelle-Saint-Lambert',NULL,NULL),(2243,1390,'Bossut-Gottechain',NULL,NULL),(2244,1400,'Monstreux',NULL,NULL),(2245,1404,'Bornival',NULL,NULL),(2246,1410,'Waterloo',NULL,NULL),(2247,1421,'Ophain-Bois-Seigneur-Isaac',NULL,NULL),(2248,1428,'Lillois-Witterzée',NULL,NULL),(2249,1450,'Chastre-Villeroux-Blanmont',NULL,NULL),(2250,1450,'Cortil-Noirmont',NULL,NULL),(2251,1457,'Tourinnes-Saint-Lambert',NULL,NULL),(2252,1460,'Virginal-Samme',NULL,NULL),(2253,1461,'Haut-Ittre',NULL,NULL),(2254,1470,'Baisy-Thy',NULL,NULL),(2255,1470,'Genappe',NULL,NULL),(2256,1480,'Clabecq',NULL,NULL),(2257,1480,'Oisquercq',NULL,NULL),(2258,1480,'Saintes',NULL,NULL),(2259,1490,'Court-Saint-Etienne',NULL,NULL),(2260,1502,'Lembeek',NULL,NULL),(2261,1560,'Hoeilaart',NULL,NULL),(2262,1570,'Tollembeek',NULL,NULL),(2263,1653,'Dworp',NULL,NULL),(2264,1670,'Bogaarden',NULL,NULL),(2265,1703,'Schepdaal',NULL,NULL),(2266,1730,'Bekkerzeel',NULL,NULL),(2267,1730,'Mollem',NULL,NULL),(2268,1731,'Relegem',NULL,NULL),(2269,1750,'Gaasbeek',NULL,NULL),(2270,1755,'Gooik',NULL,NULL),(2271,1760,'Onze-Lieve-Vrouw-Lombeek',NULL,NULL),(2272,1790,'Essene',NULL,NULL),(2273,1800,'Vilvoorde',NULL,NULL),(2274,1830,'Machelen',NULL,NULL),(2275,1840,'Londerzeel',NULL,NULL),(2276,1853,'Strombeek-Bever',NULL,NULL),(2277,1861,'Wolvertem',NULL,NULL),(2278,1880,'Ramsdonk',NULL,NULL),(2279,1970,'Wezembeek-Oppem',NULL,NULL),(2280,2020,'Antwerpen',NULL,NULL),(2281,2070,'Burcht',NULL,NULL),(2282,2070,'Zwijndrecht',NULL,NULL),(2283,2110,'Wijnegem',NULL,NULL),(2284,2160,'Wommelgem',NULL,NULL),(2285,2222,'Itegem',NULL,NULL),(2286,2230,'Herselt',NULL,NULL),(2287,2240,'Viersel',NULL,NULL),(2288,2250,'Olen',NULL,NULL),(2289,2260,'Oevel',NULL,NULL),(2290,2270,'Herenthout',NULL,NULL),(2291,2275,'Poederlee',NULL,NULL),(2292,2275,'Wechelderzande',NULL,NULL),(2293,2290,'Vorselaar',NULL,NULL),(2294,2321,'Meer',NULL,NULL),(2295,2328,'Meerle',NULL,NULL),(2296,2350,'Vosselaar',NULL,NULL),(2297,2430,'Laakdal',NULL,NULL),(2298,2460,'Tielen',NULL,NULL),(2299,2500,'Koningshooikt',NULL,NULL),(2300,2520,'Ranst',NULL,NULL),(2301,2530,'Boechout',NULL,NULL),(2302,2531,'Vremde',NULL,NULL),(2303,2580,'Putte',NULL,NULL),(2304,2600,'Berchem',NULL,NULL),(2305,2640,'Mortsel',NULL,NULL),(2306,2840,'Terhagen',NULL,NULL),(2307,2845,'Niel',NULL,NULL),(2308,2890,'Sint-Amands',NULL,NULL),(2309,2900,'Schoten',NULL,NULL),(2310,3018,'Wijgmaal',NULL,NULL),(2311,3061,'Leefdaal',NULL,NULL),(2312,3078,'Everberg',NULL,NULL),(2313,3080,'Duisburg',NULL,NULL),(2314,3120,'Tremelo',NULL,NULL),(2315,3140,'Keerbergen',NULL,NULL),(2316,3190,'Boortmeerbeek',NULL,NULL),(2317,3210,'Linden',NULL,NULL),(2318,3211,'Binkom',NULL,NULL),(2319,3221,'Nieuwrode',NULL,NULL),(2320,3290,'Schaffen',NULL,NULL),(2321,3290,'Webbekom',NULL,NULL),(2322,3293,'Kaggevinne',NULL,NULL),(2323,3300,'Goetsenhoven',NULL,NULL),(2324,3300,'Kumtich',NULL,NULL),(2325,3300,'Sint-Margriete-Houtem',NULL,NULL),(2326,3300,'Tienen',NULL,NULL),(2327,3320,'Meldert',NULL,NULL),(2328,3350,'Orsmaal-Gussenhoven',NULL,NULL),(2329,3360,'Bierbeek',NULL,NULL),(2330,3370,'Willebringen',NULL,NULL),(2331,3390,'Houwaart',NULL,NULL),(2332,3390,'Sint-Joris-Winge',NULL,NULL),(2333,3400,'Wange',NULL,NULL),(2334,3440,'Budingen',NULL,NULL),(2335,3440,'Dormaal',NULL,NULL),(2336,3440,'Zoutleeuw',NULL,NULL),(2337,3460,'Bekkevoort',NULL,NULL),(2338,3473,'Waanrode',NULL,NULL),(2339,3500,'Sint-Lambrechts-Herk',NULL,NULL),(2340,3511,'Stokrooie',NULL,NULL),(2341,3530,'Houthalen',NULL,NULL),(2342,3540,'Donk',NULL,NULL),(2343,3545,'Loksbergen',NULL,NULL),(2344,3550,'Heusden-Zolder',NULL,NULL),(2345,3550,'Zolder',NULL,NULL),(2346,3560,'Linkhout',NULL,NULL),(2347,3631,'Uikhoven',NULL,NULL),(2348,3640,'Ophoven',NULL,NULL),(2349,3650,'Lanklaar',NULL,NULL),(2350,3668,'Niel-Bij-As',NULL,NULL),(2351,3680,'Neeroeteren',NULL,NULL),(2352,3700,'Overrepen',NULL,NULL),(2353,3700,'Riksingen',NULL,NULL),(2354,3700,'Rutten',NULL,NULL),(2355,3700,'Tongeren',NULL,NULL),(2356,3721,'Vliermaalroot',NULL,NULL),(2357,3722,'Wintershoven',NULL,NULL),(2358,3730,'Hoeselt',NULL,NULL),(2359,3740,'Kleine-Spouwen',NULL,NULL),(2360,3740,'Mopertingen',NULL,NULL),(2361,3740,'Munsterbilzen',NULL,NULL),(2362,3742,'Martenslinde',NULL,NULL),(2363,3770,'Kanne',NULL,NULL),(2364,3770,'Riemst',NULL,NULL),(2365,3770,'Vroenhoven',NULL,NULL),(2366,3770,'Zichen-Zussen-Bolder',NULL,NULL),(2367,3803,'Runkelen',NULL,NULL),(2368,3803,'Wilderen',NULL,NULL),(2369,3840,'Bommershoven',NULL,NULL),(2370,3840,'Borgloon',NULL,NULL),(2371,3840,'Hoepertingen',NULL,NULL),(2372,3840,'Jesseren',NULL,NULL),(2373,3870,'Batsheers',NULL,NULL),(2374,3890,'Boekhout',NULL,NULL),(2375,3890,'Jeuk',NULL,NULL),(2376,3890,'Niel-Bij-Sint-Truiden',NULL,NULL),(2377,3890,'Vorsen',NULL,NULL),(2378,3910,'Neerpelt',NULL,NULL),(2379,3930,'Hamont-Achel',NULL,NULL),(2380,3945,'Oostham',NULL,NULL),(2381,3950,'Kaulille',NULL,NULL),(2382,3960,'Gerdingen',NULL,NULL),(2383,3960,'Tongerlo',NULL,NULL),(2384,3970,'Leopoldsburg',NULL,NULL),(2385,3990,'Kleine-Brogel',NULL,NULL),(2386,3990,'Peer',NULL,NULL),(2387,4000,'Rocourt',NULL,NULL),(2388,4020,'Bressoux',NULL,NULL),(2389,4020,'Jupille-Sur-Meuse',NULL,NULL),(2390,4020,'Wandre',NULL,NULL),(2391,4051,'Vaux-Sous-Chèvremont',NULL,NULL),(2392,4100,'Boncelles',NULL,NULL),(2393,4100,'Seraing',NULL,NULL),(2394,4101,'Jemeppe-Sur-Meuse',NULL,NULL),(2395,4130,'Esneux',NULL,NULL),(2396,4130,'Tilff',NULL,NULL),(2397,4140,'Gomzé-Andoumont',NULL,NULL),(2398,4160,'Anthisnes',NULL,NULL),(2399,4180,'Comblain-La-Tour',NULL,NULL),(2400,4190,'My',NULL,NULL),(2401,4210,'Burdinne',NULL,NULL),(2402,4219,'Acosse',NULL,NULL),(2403,4250,'Geer',NULL,NULL),(2404,4250,'Hollogne-Sur-Geer',NULL,NULL),(2405,4280,'Cras-Avernas',NULL,NULL),(2406,4287,'Pellaines',NULL,NULL),(2407,4287,'Racour',NULL,NULL),(2408,4300,'Waremme',NULL,NULL),(2409,4347,'Noville',NULL,NULL),(2410,4347,'Roloux',NULL,NULL),(2411,4357,'Jeneffe',NULL,NULL),(2412,4400,'Chokier',NULL,NULL),(2413,4432,'Xhendremael',NULL,NULL),(2414,4451,'Voroux-Lez-Liers',NULL,NULL),(2415,4460,'Grâce-Berleur',NULL,NULL),(2416,4460,'Horion-Hozémont',NULL,NULL),(2417,4470,'Saint-Georges-Sur-Meuse',NULL,NULL),(2418,4480,'Engis',NULL,NULL),(2419,4540,'Ampsin',NULL,NULL),(2420,4550,'Yernée-Fraineux',NULL,NULL),(2421,4557,'Tinlot',NULL,NULL),(2422,4560,'Bois-Et-Borsu',NULL,NULL),(2423,4560,'Ocquier',NULL,NULL),(2424,4577,'Modave',NULL,NULL),(2425,4590,'Ouffet',NULL,NULL),(2426,4600,'Lixhe',NULL,NULL),(2427,4601,'Argenteau',NULL,NULL),(2428,4607,'Dalhem',NULL,NULL),(2429,4620,'Fléron',NULL,NULL),(2430,4624,'Romsée',NULL,NULL),(2431,4633,'Melen',NULL,NULL),(2432,4650,'Julémont',NULL,NULL),(2433,4680,'Oupeye',NULL,NULL),(2434,4683,'Vivegnis',NULL,NULL),(2435,4690,'Wonck',NULL,NULL),(2436,4730,'Hauset',NULL,NULL),(2437,4731,'Eynatten',NULL,NULL),(2438,4760,'Manderfeld',NULL,NULL),(2439,4780,'Recht',NULL,NULL),(2440,4783,'Lommersweiler',NULL,NULL),(2441,4802,'Heusy',NULL,NULL),(2442,4834,'Goé',NULL,NULL),(2443,4841,'Henri-Chapelle',NULL,NULL),(2444,4845,'Sart-Lez-Spa',NULL,NULL),(2445,4850,'Moresnet',NULL,NULL),(2446,4860,'Wegnez',NULL,NULL),(2447,4870,'Forêt',NULL,NULL),(2448,4910,'Theux',NULL,NULL),(2449,4980,'Trois-Ponts',NULL,NULL),(2450,4990,'Bra',NULL,NULL),(2451,4990,'Lierneux',NULL,NULL),(2452,5001,'Belgrade',NULL,NULL),(2453,5020,'Champion',NULL,NULL),(2454,5020,'Suarlée',NULL,NULL),(2455,5020,'Temploux',NULL,NULL),(2456,5030,'Grand-Manil',NULL,NULL),(2457,5032,'Bossière',NULL,NULL),(2458,5060,'Auvelais',NULL,NULL),(2459,5070,'Vitrival',NULL,NULL),(2460,5100,'Dave',NULL,NULL),(2461,5100,'Wierde',NULL,NULL),(2462,5101,'Erpent',NULL,NULL),(2463,5140,'Sombreffe',NULL,NULL),(2464,5150,'Floriffoux',NULL,NULL),(2465,5150,'Soye',NULL,NULL),(2466,5170,'Arbre',NULL,NULL),(2467,5170,'Bois-De-Villers',NULL,NULL),(2468,5170,'Rivière',NULL,NULL),(2469,5190,'Jemeppe-Sur-Sambre',NULL,NULL),(2470,5300,'Seilles',NULL,NULL),(2471,5300,'Vezin',NULL,NULL),(2472,5310,'Eghezée',NULL,NULL),(2473,5310,'Liernu',NULL,NULL),(2474,5310,'Longchamps',NULL,NULL),(2475,5310,'Mehaigne',NULL,NULL),(2476,5310,'Taviers',NULL,NULL),(2477,5340,'Faulx-Les-Tombes',NULL,NULL),(2478,5340,'Sorée',NULL,NULL),(2479,5351,'Haillot',NULL,NULL),(2480,5370,'Porcheresse',NULL,NULL),(2481,5376,'Miécret',NULL,NULL),(2482,5377,'Waillet',NULL,NULL),(2483,5500,'Anseremme',NULL,NULL),(2484,5500,'Dréhance',NULL,NULL),(2485,5504,'Foy-Notre-Dame',NULL,NULL),(2486,5530,'Durnal',NULL,NULL),(2487,5530,'Mont',NULL,NULL),(2488,5537,'Warnant',NULL,NULL),(2489,5544,'Agimont',NULL,NULL),(2490,5555,'Naomé',NULL,NULL),(2491,5560,'Ciergnon',NULL,NULL),(2492,5570,'Beauraing',NULL,NULL),(2493,5570,'Wancennes',NULL,NULL),(2494,5575,'Malvoisin',NULL,NULL),(2495,5575,'Vencimont',NULL,NULL),(2496,5576,'Froidfontaine',NULL,NULL),(2497,5580,'Ave-Et-Auffe',NULL,NULL),(2498,5580,'Jemelle',NULL,NULL),(2499,5580,'Wavreille',NULL,NULL),(2500,5590,'Braibant',NULL,NULL),(2501,5590,'Ciney',NULL,NULL),(2502,5600,'Fagnolle',NULL,NULL),(2503,5600,'Merlemont',NULL,NULL),(2504,5600,'Omezée',NULL,NULL),(2505,5600,'Roly',NULL,NULL),(2506,5600,'Sart-En-Fagne',NULL,NULL),(2507,5600,'Sautour',NULL,NULL),(2508,5600,'Vodecée',NULL,NULL),(2509,5620,'Corenne',NULL,NULL),(2510,5620,'Morville',NULL,NULL),(2511,5621,'Hanzinelle',NULL,NULL),(2512,5621,'Hanzinne',NULL,NULL),(2513,5621,'Morialmé',NULL,NULL),(2514,5630,'Cerfontaine',NULL,NULL),(2515,5630,'Senzeille',NULL,NULL),(2516,5640,'Oret',NULL,NULL),(2517,5641,'Furnaux',NULL,NULL),(2518,5646,'Stave',NULL,NULL),(2519,5650,'Fraire',NULL,NULL),(2520,5660,'Boussu-En-Fagne',NULL,NULL),(2521,5670,'Treignes',NULL,NULL),(2522,5670,'Vierves-Sur-Viroin',NULL,NULL),(2523,5670,'Viroinval',NULL,NULL),(2524,5680,'Doische',NULL,NULL),(2525,5680,'Gimnée',NULL,NULL),(2526,5680,'Matagne-La-Grande',NULL,NULL),(2527,5680,'Matagne-La-Petite',NULL,NULL),(2528,5680,'Niverlée',NULL,NULL),(2529,5680,'Vodelée',NULL,NULL),(2530,6030,'Goutroux',NULL,NULL),(2531,6030,'Marchienne-Au-Pont',NULL,NULL),(2532,6040,'Jumet',NULL,NULL),(2533,6110,'Montigny-Le-Tilleul',NULL,NULL),(2534,6120,'Cour-Sur-Heure',NULL,NULL),(2535,6120,'Ham-Sur-Heure',NULL,NULL),(2536,6142,'Leernes',NULL,NULL),(2537,6150,'Anderlues',NULL,NULL),(2538,6180,'Courcelles',NULL,NULL),(2539,6210,'Frasnes-Lez-Gosselies',NULL,NULL),(2540,6210,'Wayaux',NULL,NULL),(2541,6211,'Mellet',NULL,NULL),(2542,6220,'Wangenies',NULL,NULL),(2543,6222,'Brye',NULL,NULL),(2544,6280,'Joncret',NULL,NULL),(2545,6280,'Loverval',NULL,NULL),(2546,6441,'Erpion',NULL,NULL),(2547,6460,'Salles',NULL,NULL),(2548,6461,'Virelles',NULL,NULL),(2549,6464,'Forges',NULL,NULL),(2550,6470,'Sautin',NULL,NULL),(2551,6500,'Barbençon',NULL,NULL),(2552,6500,'Thirimont',NULL,NULL),(2553,6534,'Gozée',NULL,NULL),(2554,6536,'Thuillies',NULL,NULL),(2555,6560,'Montignies-Saint-Christophe',NULL,NULL),(2556,6591,'Macon',NULL,NULL),(2557,6637,'Fauvillers',NULL,NULL),(2558,6660,'Houffalize',NULL,NULL),(2559,6660,'Nadrin',NULL,NULL),(2560,6680,'Amberloup',NULL,NULL),(2561,6680,'Sainte-Ode',NULL,NULL),(2562,6692,'Petit-Thier',NULL,NULL),(2563,6698,'Grand-Halleux',NULL,NULL),(2564,6717,'Nobressart',NULL,NULL),(2565,6717,'Tontelange',NULL,NULL),(2566,6720,'Hachy',NULL,NULL),(2567,6730,'Bellefontaine',NULL,NULL),(2568,6743,'Buzenol',NULL,NULL),(2569,6750,'Mussy-La-Ville',NULL,NULL),(2570,6760,'Ruette',NULL,NULL),(2571,6781,'Sélange',NULL,NULL),(2572,6800,'Remagne',NULL,NULL),(2573,6800,'Saint-Pierre',NULL,NULL),(2574,6851,'Nollevaux',NULL,NULL),(2575,6870,'Mirwart',NULL,NULL),(2576,6890,'Ochamps',NULL,NULL),(2577,6890,'Transinne',NULL,NULL),(2578,6890,'Villance',NULL,NULL),(2579,6900,'Waha',NULL,NULL),(2580,6940,'Durbuy',NULL,NULL),(2581,6953,'Masbourg',NULL,NULL),(2582,6960,'Dochamps',NULL,NULL),(2583,6960,'Odeigne',NULL,NULL),(2584,6980,'Beausaint',NULL,NULL),(2585,6987,'Beffe',NULL,NULL),(2586,6987,'Rendeux',NULL,NULL),(2587,6990,'Hotton',NULL,NULL),(2588,7000,'Mons',NULL,NULL),(2589,7022,'Nouvelles',NULL,NULL),(2590,7040,'Aulnois',NULL,NULL),(2591,7040,'Blaregnies',NULL,NULL),(2592,7040,'Goegnies-Chaussée',NULL,NULL),(2593,7040,'Quévy-Le-Grand',NULL,NULL),(2594,7062,'Naast',NULL,NULL),(2595,7063,'Chaussée-Notre-Dame-Louvignies',NULL,NULL),(2596,7080,'Eugies',NULL,NULL),(2597,7090,'Hennuyères',NULL,NULL),(2598,7110,'Boussoit',NULL,NULL),(2599,7110,'Maurage',NULL,NULL),(2600,7120,'Haulchin',NULL,NULL),(2601,7120,'Peissant',NULL,NULL),(2602,7120,'Vellereille-Les-Brayeux',NULL,NULL),(2603,7131,'Waudrez',NULL,NULL),(2604,7300,'Boussu',NULL,NULL),(2605,7322,'Ville-Pommeroeul',NULL,NULL),(2606,7331,'Baudour',NULL,NULL),(2607,7332,'Neufmaison',NULL,NULL),(2608,7333,'Tertre',NULL,NULL),(2609,7350,'Hainin',NULL,NULL),(2610,7387,'Marchipont',NULL,NULL),(2611,7500,'Ere',NULL,NULL),(2612,7501,'Orcq',NULL,NULL),(2613,7520,'Templeuve',NULL,NULL),(2614,7530,'Gaurain-Ramecroix',NULL,NULL),(2615,7531,'Havinnes',NULL,NULL),(2616,7610,'Rumes',NULL,NULL),(2617,7611,'La Glanerie',NULL,NULL),(2618,7622,'Laplaigne',NULL,NULL),(2619,7643,'Fontenoy',NULL,NULL),(2620,7700,'Luingne',NULL,NULL),(2621,7700,'Mouscron',NULL,NULL),(2622,7750,'Amougies',NULL,NULL),(2623,7760,'Popuelles',NULL,NULL),(2624,7810,'Maffle',NULL,NULL),(2625,7812,'Mainvault',NULL,NULL),(2626,7812,'Villers-Saint-Amand',NULL,NULL),(2627,7863,'Ghoy',NULL,NULL),(2628,7901,'Thieulain',NULL,NULL),(2629,7903,'Blicquy',NULL,NULL),(2630,7906,'Gallaix',NULL,NULL),(2631,7910,'Cordes',NULL,NULL),(2632,7911,'Hacquegnies',NULL,NULL),(2633,7911,'Montroeul-Au-Bois',NULL,NULL),(2634,7911,'Oeudeghien',NULL,NULL),(2635,7912,'Dergneau',NULL,NULL),(2636,7942,'Mévergnies-Lez-Lens',NULL,NULL),(2637,7950,'Ladeuze',NULL,NULL),(2638,7951,'Tongre-Notre-Dame',NULL,NULL),(2639,7971,'Wadelincourt',NULL,NULL),(2640,7972,'Quevaucamps',NULL,NULL),(2641,8020,'Ruddervoorde',NULL,NULL),(2642,8020,'Waardamme',NULL,NULL),(2643,8210,'Zedelgem',NULL,NULL),(2644,8300,'Westkapelle',NULL,NULL),(2645,8310,'Sint-Kruis',NULL,NULL),(2646,8340,'Damme',NULL,NULL),(2647,8340,'Hoeke',NULL,NULL),(2648,8370,'Blankenberge',NULL,NULL),(2649,8377,'Nieuwmunster',NULL,NULL),(2650,8380,'Dudzele',NULL,NULL),(2651,8420,'De Haan',NULL,NULL),(2652,8433,'Sint-Pieters-Kapelle',NULL,NULL),(2653,8450,'Bredene',NULL,NULL),(2654,8460,'Westkerke',NULL,NULL),(2655,8470,'Moere',NULL,NULL),(2656,8490,'Snellegem',NULL,NULL),(2657,8490,'Varsenare',NULL,NULL),(2658,8501,'Bissegem',NULL,NULL),(2659,8531,'Bavikhove',NULL,NULL),(2660,8531,'Hulste',NULL,NULL),(2661,8552,'Moen',NULL,NULL),(2662,8581,'Waarmaarde',NULL,NULL),(2663,8583,'Bossuit',NULL,NULL),(2664,8587,'Espierres-Helchin',NULL,NULL),(2665,8600,'Leke',NULL,NULL),(2666,8600,'Stuivekenskerke',NULL,NULL),(2667,8610,'Zarren',NULL,NULL),(2668,8630,'De Moeren',NULL,NULL),(2669,8630,'Eggewaartskapelle',NULL,NULL),(2670,8630,'Houtem',NULL,NULL),(2671,8647,'Lo',NULL,NULL),(2672,8660,'Adinkerke',NULL,NULL),(2673,8670,'Oostduinkerke',NULL,NULL),(2674,8690,'Hoogstade',NULL,NULL),(2675,8690,'Sint-Rijkers',NULL,NULL),(2676,8691,'Gijverinkhove',NULL,NULL),(2677,8700,'Aarsele',NULL,NULL),(2678,8720,'Wakken',NULL,NULL),(2679,8730,'Beernem',NULL,NULL),(2680,8792,'Desselgem',NULL,NULL),(2681,8830,'Gits',NULL,NULL),(2682,8840,'Oostnieuwkerke',NULL,NULL),(2683,8840,'Westrozebeke',NULL,NULL),(2684,8880,'Ledegem',NULL,NULL),(2685,8880,'Rollegem-Kapelle',NULL,NULL),(2686,8906,'Elverdinge',NULL,NULL),(2687,8920,'Poelkapelle',NULL,NULL),(2688,8930,'Lauwe',NULL,NULL),(2689,8954,'Westouter',NULL,NULL),(2690,8957,'Messines',NULL,NULL),(2691,8958,'Loker',NULL,NULL),(2692,8972,'Krombeke',NULL,NULL),(2693,8980,'Zonnebeke',NULL,NULL),(2694,9040,'Sint-Amandsberg',NULL,NULL),(2695,9042,'Sint-Kruis-Winkel',NULL,NULL),(2696,9052,'Zwijnaarde',NULL,NULL),(2697,9080,'Lochristi',NULL,NULL),(2698,9111,'Belsele',NULL,NULL),(2699,9130,'Kieldrecht',NULL,NULL),(2700,9130,'Verrebroek',NULL,NULL),(2701,9140,'Tielrode',NULL,NULL),(2702,9160,'Daknam',NULL,NULL),(2703,9160,'Lokeren',NULL,NULL),(2704,9190,'Kemzeke',NULL,NULL),(2705,9200,'Appels',NULL,NULL),(2706,9230,'Westrem',NULL,NULL),(2707,9255,'Buggenhout',NULL,NULL),(2708,9270,'Kalken',NULL,NULL),(2709,9290,'Uitbergen',NULL,NULL),(2710,9300,'Aalst',NULL,NULL),(2711,9308,'Hofstade',NULL,NULL),(2712,9340,'Smetlede',NULL,NULL),(2713,9401,'Pollare',NULL,NULL),(2714,9420,'Aaigem',NULL,NULL),(2715,9450,'Denderhoutem',NULL,NULL),(2716,9451,'Kerksken',NULL,NULL),(2717,9473,'Welle',NULL,NULL),(2718,9506,'Idegem',NULL,NULL),(2719,9506,'Smeerebbe-Vloerzegem',NULL,NULL),(2720,9520,'Oombergen',NULL,NULL),(2721,9520,'Zonnegem',NULL,NULL),(2722,9550,'Herzele',NULL,NULL),(2723,9550,'Sint-Lievens-Esse',NULL,NULL),(2724,9571,'Hemelveerdegem',NULL,NULL),(2725,9572,'Sint-Martens-Lierde',NULL,NULL),(2726,9620,'Erwetegem',NULL,NULL),(2727,9620,'Godveerdegem',NULL,NULL),(2728,9620,'Sint-Maria-Oudenhove',NULL,NULL),(2729,9620,'Zottegem',NULL,NULL),(2730,9630,'Beerlegem',NULL,NULL),(2731,9630,'Dikkele',NULL,NULL),(2732,9630,'Hundelgem',NULL,NULL),(2733,9630,'Zwalm',NULL,NULL),(2734,9667,'Horebeke',NULL,NULL),(2735,9667,'Sint-Kornelis-Horebeke',NULL,NULL),(2736,9680,'Etikhove',NULL,NULL),(2737,9690,'Kluisbergen',NULL,NULL),(2738,9690,'Ruien',NULL,NULL),(2739,9690,'Zulzeke',NULL,NULL),(2740,9700,'Bevere',NULL,NULL),(2741,9770,'Kruishoutem',NULL,NULL),(2742,9790,'Moregem',NULL,NULL),(2743,9800,'Grammene',NULL,NULL),(2744,9820,'Bottelare',NULL,NULL),(2745,9820,'Munte',NULL,NULL),(2746,9820,'Schelderode',NULL,NULL),(2747,9830,'Sint-Martens-Latem',NULL,NULL),(2748,9860,'Gijzenzele',NULL,NULL),(2749,9870,'Olsene',NULL,NULL),(2750,9890,'Gavere',NULL,NULL),(2751,9931,'Oostwinkel',NULL,NULL),(2752,9940,'Kluizen',NULL,NULL),(2753,9970,'Kaprijke',NULL,NULL),(2754,9971,'Lembeke',NULL,NULL),(2755,9981,'Sint-Margriete',NULL,NULL),(2756,9991,'Adegem',NULL,NULL),(2757,9992,'Middelburg',NULL,NULL);
/*!40000 ALTER TABLE `zipcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `view_clocking_extended`
--

/*!50001 DROP TABLE IF EXISTS `view_clocking_extended`*/;
/*!50001 DROP VIEW IF EXISTS `view_clocking_extended`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clocking_extended` AS select `technicians`.`lastname` AS `lastname`,`technicians`.`firstname` AS `firstname`,concat(`technicians`.`firstname`,' ',`technicians`.`lastname`) AS `fullname`,`clockings`.`id` AS `id`,`clockings`.`date` AS `date`,`clockings`.`start_date` AS `start_date`,`clockings`.`stop_date` AS `stop_date`,`clockings`.`technician_id` AS `technician_id`,`clockings`.`user_id` AS `user_id`,`clockings`.`created_at` AS `created_at`,`clockings`.`updated_at` AS `updated_at`,`clockings`.`worksheet_id` AS `worksheet_id`,date_format(`clockings`.`start_date`,'%d-%m-%Y') AS `start_date_d`,date_format(`clockings`.`start_date`,'%d-%m-%Y') AS `stop_date_d`,date_format(`clockings`.`start_date`,'%H:%i') AS `start_time`,date_format(`clockings`.`stop_date`,'%H:%i') AS `stop_time`,sec_to_time(timestampdiff(SECOND,`clockings`.`start_date`,`clockings`.`stop_date`)) AS `diff` from (`clockings` left join `technicians` on(`clockings`.`technician_id` = `technicians`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_clocking_total`
--

/*!50001 DROP TABLE IF EXISTS `view_clocking_total`*/;
/*!50001 DROP VIEW IF EXISTS `view_clocking_total`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clocking_total` AS select `view_clocking_extended`.`worksheet_id` AS `worksheet_id`,sec_to_time(sum(time_to_sec(`view_clocking_extended`.`diff`))) AS `total` from `view_clocking_extended` group by `view_clocking_extended`.`worksheet_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_worksheets_customers_cranes`
--

/*!50001 DROP TABLE IF EXISTS `view_worksheets_customers_cranes`*/;
/*!50001 DROP VIEW IF EXISTS `view_worksheets_customers_cranes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`fassi`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_worksheets_customers_cranes` AS select `worksheets`.`id` AS `id`,`worksheets`.`number` AS `number`,`worksheets`.`date` AS `date`,year(`worksheets`.`date`) AS `year`,`worksheets`.`validated` AS `validated`,`worksheets`.`validated_date` AS `validated_date`,`customers`.`id` AS `customer_id`,`customers`.`name` AS `name`,`cranes`.`id` AS `crane_id`,`cranes`.`serial` AS `serial`,`cranes`.`plate` AS `plate` from ((`worksheets` left join `customers` on(`worksheets`.`customer_id` = `customers`.`id`)) left join `cranes` on(`worksheets`.`crane_id` = `cranes`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-23 11:40:08
