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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogs`
--

LOCK TABLES `catalogs` WRITE;
/*!40000 ALTER TABLE `catalogs` DISABLE KEYS */;
INSERT INTO `catalogs` VALUES (1,3314.89,2019,2,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(2,3857.61,2019,2,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(3,1389.05,2019,3,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(4,4.84,2018,3,1,'2020-11-08 15:41:51','2020-11-21 14:34:20'),(5,2510.57,2019,4,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(6,2722.54,2020,4,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(7,3338.52,2019,5,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(8,2062.90,2020,5,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(9,4078.99,2018,6,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(10,4237.76,2019,6,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(11,187.34,2019,7,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(12,90.25,2019,7,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(13,1956.43,2018,8,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(14,3225.56,2018,8,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(15,2790.80,2020,9,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(16,231.17,2018,9,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(17,3657.87,2020,10,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(18,1055.21,2019,10,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(19,1830.19,2019,11,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(20,4361.08,2020,11,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(21,4291.11,2019,12,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(22,1138.70,2018,12,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(23,3169.25,2018,13,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(24,3074.78,2018,13,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(25,814.31,2020,14,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(26,4289.96,2020,14,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(27,106.64,2020,15,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(28,3600.52,2018,15,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(29,955.80,2018,16,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(30,3789.98,2019,16,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(31,2621.87,2020,17,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(32,2266.63,2020,17,2,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(33,4488.27,2020,18,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(34,1849.15,2019,18,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(35,1571.38,2018,19,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(36,3882.07,2018,19,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(37,598.28,2019,20,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(38,3440.25,2019,20,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(39,3492.25,2018,21,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(40,3554.31,2018,21,2,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(41,444.83,2019,22,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(42,2799.26,2019,22,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(43,2894.57,2018,23,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(44,1111.68,2019,23,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(45,3423.05,2020,24,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(46,2808.16,2018,24,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(47,436.92,2018,25,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(48,327.80,2018,25,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(49,3006.14,2019,26,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(50,4870.25,2018,26,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(51,4158.55,2019,27,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(52,4420.48,2018,27,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(53,4024.25,2018,28,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(54,1576.09,2019,28,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(55,3377.32,2018,29,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(56,4135.55,2018,29,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(57,1885.37,2020,30,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(58,1374.29,2019,30,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(59,4258.16,2020,31,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(60,666.61,2020,31,3,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(61,3938.90,2018,32,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(62,3486.89,2018,32,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(63,435.34,2020,33,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(64,4318.74,2018,33,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(65,3379.99,2019,34,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(66,2272.45,2018,34,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(67,3826.27,2020,35,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(68,1267.42,2019,35,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(69,190.65,2018,36,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(70,1622.01,2020,36,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(71,4697.29,2019,37,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(72,4101.37,2019,37,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(73,3464.76,2020,38,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(74,2322.92,2020,38,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(75,312.61,2020,39,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(76,4515.83,2018,39,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(77,4807.76,2020,40,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(78,407.94,2018,40,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(79,2113.30,2018,41,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(80,4235.44,2020,41,5,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(81,14.47,2020,51,5,'2020-11-18 18:08:05','2020-11-18 18:08:05'),(82,1.87,2020,52,4,'2020-11-18 18:17:28','2020-11-18 18:17:28'),(83,25.87,2020,53,6,'2020-11-18 18:21:15','2020-11-18 18:21:15'),(84,14.78,2020,54,5,'2020-11-18 20:00:45','2020-11-18 20:00:45'),(85,1.89,2020,56,10,'2020-11-21 14:29:33','2020-11-21 14:30:13'),(86,0.87,2020,58,5,'2020-11-21 14:44:21','2020-11-21 14:44:21'),(87,147.45,2020,59,2,'2020-11-22 17:15:35','2020-11-22 17:15:35');
/*!40000 ALTER TABLE `catalogs` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `cranes_serial_unique` (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cranes`
--

LOCK TABLES `cranes` WRITE;
/*!40000 ALTER TABLE `cranes` DISABLE KEYS */;
INSERT INTO `cranes` VALUES (1,'Test-001','Blue','1-klm-254','2020-11-07 16:43:36','2020-11-07 16:43:36'),(2,'Test-002','Blue and Red','1-lok-587','2020-11-07 16:53:07','2020-11-07 16:53:07');
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
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (23,'2014_10_12_000000_create_users_table',1),(24,'2014_10_12_100000_create_password_resets_table',1),(25,'2019_08_19_000000_create_failed_jobs_table',1),(26,'2020_10_07_104724_create_permission_tables',1),(27,'2020_10_29_183249_create_customers_table',1),(28,'2020_10_31_103712_create_worksheets_table',1),(29,'2020_10_31_110053_create_cranes_table',1),(35,'2020_11_08_113451_create_stores_table',7),(36,'2020_11_08_113628_create_providers_table',8),(37,'2020_11_08_113559_create_catalogs_table',9),(38,'2020_11_08_113739_create_reasons_table',10),(39,'2020_11_08_113711_create_reassortements_table',11),(40,'2020_11_08_113649_create_outs_table',1),(41,'2020_11_24_174920_add_user_to_reassortements',12),(42,'2020_11_24_181931_add_user_to_outs',13),(43,'2020_11_25_182745_add_description_outs_table',14),(44,'2020_11_25_182805_add_description_reason_reassortements_table',15),(45,'2020_11_25_191345_add_option_reasons_table',15);
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outs`
--

LOCK TABLES `outs` WRITE;
/*!40000 ALTER TABLE `outs` DISABLE KEYS */;
/*!40000 ALTER TABLE `outs` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reasons`
--

LOCK TABLES `reasons` WRITE;
/*!40000 ALTER TABLE `reasons` DISABLE KEYS */;
INSERT INTO `reasons` VALUES (1,'Warranty',NULL,NULL,'O'),(2,'Stock correction',NULL,NULL,'O'),(3,'Manual',NULL,NULL,'O'),(4,'Reassortment',NULL,NULL,'R'),(5,'Back in stock',NULL,NULL,'R');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reassortements`
--

LOCK TABLES `reassortements` WRITE;
/*!40000 ALTER TABLE `reassortements` DISABLE KEYS */;
INSERT INTO `reassortements` VALUES (3,10,10,59,'2020-11-24 19:15:34','2020-11-24 19:15:34',1,NULL,0),(4,5,20,59,'2020-11-24 19:20:09','2020-11-24 19:20:09',1,NULL,0),(5,5,25,59,'2020-11-24 19:22:05','2020-11-24 19:22:05',1,NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2020-11-07 18:28:06','2020-11-07 18:28:06');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `stores_part_number_unique` (`part_number`),
  KEY `stores_part_number_index` (`part_number`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,'91482723','Neque aut sed minima. Consequatur suscipit laborum eius laboriosam. Et optio quis commodi et. Amet in voluptatum voluptatibus cumque dolores provident deserunt mollitia.',721,NULL,1,'2020-11-08 15:35:28','2020-11-08 15:35:28'),(2,'89473887','Exercitationem animi possimus at id aut doloribus et. Qui illo sed et ipsam. Architecto laborum voluptatem quis error architecto. Et quo voluptate asperiores ex eos cupiditate alias. Nemo eius consequatur quod est. Nihil cupiditate nam aut et rem.',442,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(3,'80171935','Possimus recusandae ullam magnam quo non dolor maiores. Assumenda non tempora id. Aut veritatis qui inventore. Dolores dolores odit nemo necessitatibus. Numquam quae sequi ut.',567,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(4,'37751586','Quidem consequatur dolore eum officiis enim. Qui perferendis et et et quo eligendi earum. Est nostrum nemo explicabo provident ipsum.',1,NULL,1,'2020-11-08 15:41:51','2020-11-21 14:23:59'),(5,'01201185','Corporis minima maiores autem distinctio cum itaque autem. Aut quia eos quos debitis impedit. Et dolorem dolorem sed voluptatem ratione provident facilis.',252,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(6,'04036258','Quos aliquid cumque autem beatae. Sequi facilis saepe vitae quia. Ullam rem ullam temporibus sit.',59,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(7,'17961202','Velit beatae perferendis iure quod at accusamus. Nesciunt quae tempora ab facere unde cumque consequatur. Repellendus quaerat qui iure ut et nobis exercitationem.',285,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(8,'88324562','Vitae cupiditate aut sunt non. Aut rerum at et saepe atque.',600,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(9,'79529877','Expedita natus quia sunt modi in esse voluptas in. Iste excepturi eligendi odit saepe vel molestiae. Aliquid neque ullam sit qui adipisci officia.',100,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(10,'72196717','Quos et occaecati repellendus. Amet architecto repellendus consequuntur sed qui ut unde eligendi. Minima sapiente accusantium quaerat.',856,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(11,'19867359','Facere ad vitae suscipit perferendis nam ipsam ut. Doloribus magnam ea et eligendi. Distinctio sit eius et mollitia. Consequatur accusantium animi minima modi illo exercitationem.',845,NULL,1,'2020-11-08 15:41:51','2020-11-08 15:41:51'),(12,'07271458','Ipsum molestiae occaecati in id. Dicta omnis ab qui necessitatibus et sed ratione beatae. Tempore sed commodi neque. Possimus et consequatur ducimus voluptas unde.',512,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(13,'02078625','Et non eaque sint explicabo. Culpa eligendi nam consequatur eaque totam iure ab dolor. Fugit omnis nemo molestiae sunt adipisci non.',682,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(14,'62476287','Hic cum esse ab molestias aut. Voluptas ducimus et numquam vel voluptates voluptas aut. Aut repellendus optio velit non incidunt. Nobis vel quis sit. Sed impedit repellat nisi voluptate itaque. Eius voluptatibus hic doloremque magnam culpa vero omnis.',185,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(15,'08774118','Et expedita iste adipisci. Dolores rerum repellat cupiditate adipisci natus repellat delectus. Accusantium ab qui eius vitae corporis.',720,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(16,'78923072','Perspiciatis nam perferendis voluptate et et reprehenderit sunt. Qui corporis et architecto perspiciatis quia. Esse minima cumque ab doloremque est labore qui.',758,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(17,'60399748','Aut est temporibus numquam et libero ea repellendus. Sed in quis saepe cumque iste. Excepturi recusandae eius aut officiis illo debitis. Ullam voluptas est exercitationem saepe.',334,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(18,'39350374','Dolore et porro ea mollitia nihil iusto. Voluptas aut sed sapiente non recusandae error. Distinctio praesentium eius rerum voluptatem ab dolores neque. Aliquid consectetur molestias eveniet natus.',783,NULL,1,'2020-11-08 15:43:31','2020-11-08 15:43:31'),(19,'90506611','Mollitia ut voluptas doloribus molestiae adipisci. Qui commodi cum modi autem delectus. Quia voluptas officiis ut non. Quas ducimus quo asperiores autem.',899,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(20,'22645265','Ut odio et voluptatibus enim ipsam. Quod deleniti ut placeat velit. Quos ea et a sequi id qui libero tenetur. Ut non tempora sint et. Laudantium voluptates modi non. Repellat saepe libero iste nostrum aut autem. Unde sed beatae in ut.',272,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(21,'21403576','Odit eos autem repudiandae qui adipisci amet possimus animi. Nihil quidem reiciendis et ea aut. Pariatur vel recusandae omnis alias nihil. Voluptate rerum minima laboriosam omnis at dignissimos sit.',189,NULL,1,'2020-11-08 15:43:32','2020-11-08 15:43:32'),(22,'18930931','A reiciendis illo culpa blanditiis beatae alias. Blanditiis ut dolor hic amet esse veritatis. Maxime omnis in quam aut beatae.',233,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(23,'15968272','Earum hic placeat qui labore et nesciunt. Vel porro beatae nostrum voluptas. Est vel magnam nemo corrupti. Aspernatur omnis doloremque ratione quo.',642,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(24,'88857381','Architecto omnis excepturi quo. Eius aut velit explicabo dolore et aliquid. Iusto dolore nobis recusandae consequatur voluptates voluptatum. Facere officia excepturi tempora soluta reprehenderit autem ad. Sunt aspernatur distinctio earum suscipit.',881,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(25,'44797911','Quaerat consequatur iste est quaerat non ratione sint voluptates. Magni natus nobis cupiditate. Rerum at corrupti dignissimos nisi.',58,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(26,'36980208','Aut quam vitae atque vero dolorum. Et itaque fugit sapiente fugiat. Ut quis nesciunt aliquid voluptas tenetur consequatur. Rem in perspiciatis iusto eaque voluptatem consequatur. Temporibus velit enim quo itaque voluptas.',116,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(27,'71603827','Eos molestiae quis ex non fugiat voluptatem. Iusto fuga labore enim ipsam nulla. Repellendus minus quos minus molestiae nisi. Sunt fugiat nemo ipsum maiores aut et. Mollitia nam natus in id sed ullam.',537,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(28,'14091308','Et totam et eum dolores et. Quia vel repellat cupiditate accusantium dignissimos. Rem sed quam magnam similique itaque vitae. Dolorem nulla et laboriosam dolorem iusto non. Doloribus velit sit dignissimos.',496,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(29,'68804336','Omnis eum ea quia non labore ipsum sit. Tempore inventore recusandae dignissimos aut culpa nostrum cumque. Nemo atque perspiciatis natus itaque.',882,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(30,'70530742','Et nostrum et dolores iure sint. Adipisci et pariatur atque ullam occaecati qui sed. Libero totam voluptatem voluptas dolorem atque sit et. Libero quod laborum autem amet.',890,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(31,'91127686','Nobis corrupti quas rerum molestiae. Soluta libero assumenda qui omnis amet repudiandae.',980,NULL,1,'2020-11-08 15:43:43','2020-11-08 15:43:43'),(32,'75941314','Eum fuga ut sunt similique. Voluptatem non voluptas praesentium cumque aut mollitia quae. Quas consequatur quas ut doloremque et assumenda. Tempore non voluptatem enim ut doloribus error tempora.',177,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(33,'68526801','Fugiat exercitationem delectus ut saepe. Facilis labore impedit voluptatem iure consequatur sed. Sed illo aliquam quo excepturi est nihil. Temporibus nesciunt voluptas maxime asperiores esse autem. Ab magni fugiat praesentium.',421,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(34,'34563786','Dolorem maxime accusantium voluptate ea earum. Ut voluptatem porro explicabo ex minima. Est blanditiis ex quod est ea quidem ex.',229,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(35,'96210567','Et animi suscipit aperiam. Quaerat nam praesentium neque. Quis ut aut et earum voluptas dolores odit. Aspernatur aut laborum vel.',656,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(36,'82714529','Velit commodi delectus ex. Quos quae quis tenetur. Inventore et eius iusto quaerat odit asperiores.',351,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(37,'09547285','Distinctio atque alias quos vel et incidunt. Id incidunt a a temporibus. Eum quaerat minima voluptatibus corrupti eos. Numquam maiores magnam aspernatur pariatur. Ullam rem harum optio omnis harum est dolorum aut. Praesentium commodi sequi voluptatibus.',811,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(38,'96523810','Quo corrupti dolor iure modi unde ea libero. Perspiciatis veniam est ea labore ex. Accusamus eum praesentium minima voluptatibus sit ut velit nobis.',892,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(39,'17567312','Ea et aut qui ipsam. Eos esse dolor qui voluptatibus error amet doloribus laboriosam. Officiis corporis ut voluptas architecto itaque. Facere incidunt et sunt hic.',457,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(40,'25858600','Id labore sequi omnis sunt. Cumque nihil omnis tempore architecto minima. Nesciunt nulla ea sunt numquam eaque. Qui et hic facilis facere velit vitae fuga explicabo.',155,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(41,'86453301','Adipisci sint voluptatibus velit reiciendis natus. Quo saepe fuga rerum itaque explicabo quod similique. Nihil quia iure molestiae nostrum magnam earum libero voluptatem.',32,NULL,1,'2020-11-08 15:43:53','2020-11-08 15:43:53'),(51,'01201185s','testdfqdfqdgdqfgdf',2,NULL,1,'2020-11-18 18:08:05','2020-11-18 18:08:05'),(52,'01201185suuuu','tesg',10,'LOC',1,'2020-11-18 18:17:28','2020-11-18 18:17:28'),(53,'li4879547','li test',187,'LOC',1,'2020-11-18 18:21:15','2020-11-18 18:21:15'),(54,'1-98-98','testdfqdfqdgdqfgdf',1,'LOC',1,'2020-11-18 20:00:45','2020-11-18 20:00:45'),(56,'1-789','nuts',14,NULL,1,'2020-11-21 14:29:33','2020-11-21 14:29:33'),(58,'1-23','screw',147,NULL,1,'2020-11-21 14:44:21','2020-11-21 14:44:21'),(59,'12-3456789','Machine plo',30,NULL,1,'2020-11-22 17:15:35','2020-11-24 19:22:05');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Moers','Serge',1,'en','serge.moers@mo-consult.be',NULL,'$2y$10$DLA1UdpGAKmirU0b31ngVeao1fzwJZ.4id3Cm2TplcsJoaKtHSwGm',NULL,'2020-10-31 11:24:09','2020-10-31 11:24:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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
  `oil_replace` int(10) unsigned NOT NULL DEFAULT 0,
  `oil_filtered` tinyint(1) NOT NULL DEFAULT 0,
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `validated_date` datetime DEFAULT NULL,
  `id_customer` bigint(20) unsigned NOT NULL,
  `id_crane` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `worksheets_number_unique` (`number`),
  KEY `worksheets_id_customer_foreign` (`id_customer`),
  KEY `worksheets_id_crane_foreign` (`id_crane`),
  CONSTRAINT `worksheets_id_crane_foreign` FOREIGN KEY (`id_crane`) REFERENCES `cranes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `worksheets_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worksheets`
--

LOCK TABLES `worksheets` WRITE;
/*!40000 ALTER TABLE `worksheets` DISABLE KEYS */;
/*!40000 ALTER TABLE `worksheets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-26 16:52:42
