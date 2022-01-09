/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(9,3) NOT NULL,
  `year` smallint(5) unsigned NOT NULL,
  `provider_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `partmetadata_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catalogs_provider_id_foreign` (`provider_id`),
  KEY `catalogs_year_index` (`year`),
  KEY `catalogs_part_meta_id_foreign_idx` (`partmetadata_id`),
  KEY `catalogs_user_id_foreign` (`user_id`),
  CONSTRAINT `catalogs_part_meta_id_foreign` FOREIGN KEY (`partmetadata_id`) REFERENCES `partmetadatas` (`id`),
  CONSTRAINT `catalogs_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `catalogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clockings_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `date_time` datetime NOT NULL,
  `action` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `worksheet_id` bigint(20) unsigned NOT NULL,
  `technician_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clockings_details_worksheet_id_foreign` (`worksheet_id`),
  KEY `clockings_details_technician_id_foreign` (`technician_id`),
  KEY `clockings_details_user_id_foreign` (`user_id`),
  KEY `clockings_details_date_index` (`date`),
  KEY `clockings_details_date_time_index` (`date_time`),
  KEY `clockings_details_action_index` (`action`),
  KEY `clockings_details_status_index` (`status`),
  CONSTRAINT `clockings_details_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`id`),
  CONSTRAINT `clockings_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `clockings_details_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cranes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `current` tinyint(1) NOT NULL DEFAULT 0,
  `date_current` date NOT NULL,
  `truck_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cranes_user_id_foreign` (`user_id`),
  KEY `cranes_truck_id_foreign` (`truck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  KEY `customers_contacts_FK_1` (`id`),
  KEY `customers_contacts_user_id_IDX` (`user_id`) USING BTREE,
  KEY `customers_contacts_customer_id_IDX` (`customer_id`) USING BTREE,
  CONSTRAINT `customers_contacts` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `users_contacts` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
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
  `user_id` bigint(20) unsigned NOT NULL,
  `black_listed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location_UNIQUE` (`location`),
  KEY `locations_user_id_foreign_idx` (`user_id`),
  CONSTRAINT `locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partmetadatas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `electrical_part` tinyint(1) NOT NULL DEFAULT 0,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reassort_level` smallint(5) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part_number` (`part_number`),
  KEY `stores_part_number_index` (`part_number`),
  KEY `parts_metas_location_id_foreign` (`user_id`),
  CONSTRAINT `parts_metas_location_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
  `location_id` bigint(20) unsigned NOT NULL,
  `bar_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'O',
  PRIMARY KEY (`id`),
  KEY `parts_user_id_foreign` (`user_id`),
  KEY `parts_worksheet_id_foreign` (`worksheet_id`),
  KEY `parts_location_id_foreign_idx` (`location_id`),
  CONSTRAINT `parts_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `parts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `parts_worksheet_id_foreign` FOREIGN KEY (`worksheet_id`) REFERENCES `worksheets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `providers_name_index` (`name`),
  KEY `providers_user_id_foreign_idx` (`user_id`),
  CONSTRAINT `providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qty` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` bigint(20) unsigned NOT NULL,
  `partmetadata_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stores_location_id_foreign_idx` (`location_id`),
  KEY `stores_user_id_foreign_idx` (`user_id`),
  KEY `stores_part_meta_id_foreign` (`partmetadata_id`),
  CONSTRAINT `stores_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `stores_part_meta_id_foreign` FOREIGN KEY (`partmetadata_id`) REFERENCES `partmetadatas` (`id`),
  CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technicians` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `truckscranes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plate` varchar(20) NOT NULL,
  `brand` varchar(250) DEFAULT NULL,
  `truck_model` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `current` tinyint(1) NOT NULL DEFAULT 0,
  `date_current` date DEFAULT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `serial` varchar(255) NOT NULL,
  `crane_model` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trucks_plate_IDX` (`plate`) USING BTREE,
  KEY `trucks_cranes_customer_id_foreign` (`customer_id`),
  KEY `trucks_cranes_user_id_foreign` (`user_id`),
  CONSTRAINT `trucks_cranes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `trucks_cranes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_clocking_total` (
  `worksheet_id` tinyint NOT NULL,
  `total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_clockings_by_day` (
  `worksheet_id` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `time` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_clockings_details_correct` (
  `id` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `time` tinyint NOT NULL,
  `action` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `worksheet_id` tinyint NOT NULL,
  `technician_id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `w_number` tinyint NOT NULL,
  `t_number` tinyint NOT NULL,
  `technician` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_partmetadatas_reassort` (
  `id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `enabled` tinyint NOT NULL,
  `electrical_part` tinyint NOT NULL,
  `bar_code` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `reassort_level` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `qty` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_parts_signed_values` (
  `id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `qty` tinyint NOT NULL,
  `price` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `worksheet_id` tinyint NOT NULL,
  `bar_code` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `qty_signed` tinyint NOT NULL,
  `unit_price_signed` tinyint NOT NULL,
  `total_price_signed` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_parts_sum_outs` (
  `worksheet_id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `bar_code` tinyint NOT NULL,
  `o_qty` tinyint NOT NULL,
  `r_qty` tinyint NOT NULL,
  `o_price` tinyint NOT NULL,
  `r_price` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_parts_sum_reassortements` (
  `worksheet_id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `bar_code` tinyint NOT NULL,
  `o_qty` tinyint NOT NULL,
  `r_qty` tinyint NOT NULL,
  `o_price` tinyint NOT NULL,
  `r_price` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_parts_total` (
  `worksheet_id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `bar_code` tinyint NOT NULL,
  `qty_total` tinyint NOT NULL,
  `price_total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_worksheets_customers_cranes` (
  `id` tinyint NOT NULL,
  `number` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `validated` tinyint NOT NULL,
  `validated_date` tinyint NOT NULL,
  `warranty` tinyint NOT NULL,
  `serial` tinyint NOT NULL,
  `plate` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `truckscrane_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `oil_replace` decimal(7,2) NOT NULL DEFAULT 0.00,
  `warranty` tinyint(1) NOT NULL DEFAULT 0,
  `truckscrane_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `worksheets_number_unique` (`number`),
  KEY `worksheets_user_id_foreign` (`user_id`),
  KEY `worksheets_truckscrane_id_foreign` (`truckscrane_id`),
  CONSTRAINT `worksheets_truckscrane_id_foreign` FOREIGN KEY (`truckscrane_id`) REFERENCES `truckscranes` (`id`),
  CONSTRAINT `worksheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zipcodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zipcode` int(10) unsigned NOT NULL,
  `locality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50001 DROP TABLE IF EXISTS `view_clocking_extended`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clocking_extended` AS select `technicians`.`lastname` AS `lastname`,`technicians`.`firstname` AS `firstname`,concat(`technicians`.`firstname`,' ',`technicians`.`lastname`) AS `fullname`,`clockings`.`id` AS `id`,`clockings`.`date` AS `date`,`clockings`.`start_date` AS `start_date`,`clockings`.`stop_date` AS `stop_date`,`clockings`.`technician_id` AS `technician_id`,`clockings`.`user_id` AS `user_id`,`clockings`.`created_at` AS `created_at`,`clockings`.`updated_at` AS `updated_at`,`clockings`.`worksheet_id` AS `worksheet_id`,date_format(`clockings`.`start_date`,'%d-%m-%Y') AS `start_date_d`,date_format(`clockings`.`start_date`,'%d-%m-%Y') AS `stop_date_d`,date_format(`clockings`.`start_date`,'%H:%i') AS `start_time`,date_format(`clockings`.`stop_date`,'%H:%i') AS `stop_time`,sec_to_time(timestampdiff(SECOND,`clockings`.`start_date`,`clockings`.`stop_date`)) AS `diff` from (`clockings` left join `technicians` on(`clockings`.`technician_id` = `technicians`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_clocking_total`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clocking_total` AS select `view_clocking_extended`.`worksheet_id` AS `worksheet_id`,sec_to_time(sum(time_to_sec(`view_clocking_extended`.`diff`))) AS `total` from `view_clocking_extended` group by `view_clocking_extended`.`worksheet_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_clockings_by_day`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clockings_by_day` AS select `vce`.`worksheet_id` AS `worksheet_id`,`vce`.`date` AS `date`,sec_to_time(sum(time_to_sec(`vce`.`diff`))) AS `time` from `view_clocking_extended` `vce` group by `vce`.`worksheet_id`,`vce`.`date` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_clockings_details_correct`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_clockings_details_correct` AS select `cd`.`id` AS `id`,cast(`cd`.`date_time` as date) AS `date`,cast(`cd`.`date_time` as time) AS `time`,`cd`.`action` AS `action`,`cd`.`status` AS `status`,`cd`.`worksheet_id` AS `worksheet_id`,`cd`.`technician_id` AS `technician_id`,`cd`.`user_id` AS `user_id`,`cd`.`created_at` AS `created_at`,`cd`.`updated_at` AS `updated_at`,`w`.`number` AS `w_number`,`t`.`number` AS `t_number`,concat_ws(' ',`t`.`firstname`,`t`.`lastname`) AS `technician` from ((`clockings_details` `cd` left join `worksheets` `w` on(`cd`.`worksheet_id` = `w`.`id`)) left join `technicians` `t` on(`cd`.`technician_id` = `t`.`id`)) where `cd`.`date_time` < curdate() */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_partmetadatas_reassort`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_partmetadatas_reassort` AS select `PM`.`id` AS `id`,`PM`.`part_number` AS `part_number`,`PM`.`description` AS `description`,`PM`.`enabled` AS `enabled`,`PM`.`electrical_part` AS `electrical_part`,`PM`.`bar_code` AS `bar_code`,`PM`.`created_at` AS `created_at`,`PM`.`updated_at` AS `updated_at`,`PM`.`reassort_level` AS `reassort_level`,`PM`.`user_id` AS `user_id`,`ST`.`qty` AS `qty` from (`fassi_cms_01`.`partmetadatas` `PM` left join (select `fassi_cms_01`.`stores`.`partmetadata_id` AS `partmetadata_id`,sum(`fassi_cms_01`.`stores`.`qty`) AS `qty` from `fassi_cms_01`.`stores` group by `fassi_cms_01`.`stores`.`partmetadata_id`) `ST` on(`PM`.`id` = `ST`.`partmetadata_id`)) where `PM`.`reassort_level` >= `ST`.`qty` and `PM`.`enabled` = 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_parts_signed_values`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_parts_signed_values` AS select `parts`.`id` AS `id`,`parts`.`part_number` AS `part_number`,`parts`.`description` AS `description`,`parts`.`qty` AS `qty`,`parts`.`price` AS `price`,`parts`.`year` AS `year`,`parts`.`user_id` AS `user_id`,`parts`.`created_at` AS `created_at`,`parts`.`updated_at` AS `updated_at`,`parts`.`worksheet_id` AS `worksheet_id`,`parts`.`bar_code` AS `bar_code`,`parts`.`type` AS `type`,if(`parts`.`type` = 'O',`parts`.`qty`,`parts`.`qty` * -1) AS `qty_signed`,if(`parts`.`type` = 'O',`parts`.`price`,`parts`.`price` * -1) AS `unit_price_signed`,if(`parts`.`type` = 'O',`parts`.`qty` * `parts`.`price`,`parts`.`qty` * `parts`.`price` * -1) AS `total_price_signed` from `parts` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_parts_sum_outs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_parts_sum_outs` AS select `parts`.`worksheet_id` AS `worksheet_id`,`parts`.`part_number` AS `part_number`,`parts`.`bar_code` AS `bar_code`,sum(`parts`.`qty`) AS `o_qty`,sum(`parts`.`qty`) * -1 AS `r_qty`,sum(`parts`.`price`) AS `o_price`,sum(`parts`.`price`) * -1 AS `r_price` from `parts` where `parts`.`type` = 'O' group by `parts`.`worksheet_id`,`parts`.`part_number`,`parts`.`bar_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_parts_sum_reassortements`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_parts_sum_reassortements` AS select `parts`.`worksheet_id` AS `worksheet_id`,`parts`.`part_number` AS `part_number`,`parts`.`bar_code` AS `bar_code`,sum(`parts`.`qty`) * -1 AS `o_qty`,sum(`parts`.`qty`) AS `r_qty`,sum(`parts`.`price`) * -1 AS `o_price`,sum(`parts`.`price`) AS `r_price` from `parts` where `parts`.`type` = 'R' group by `parts`.`worksheet_id`,`parts`.`part_number`,`parts`.`bar_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_parts_total`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_parts_total` AS select `view_parts_signed_values`.`worksheet_id` AS `worksheet_id`,`view_parts_signed_values`.`part_number` AS `part_number`,`view_parts_signed_values`.`bar_code` AS `bar_code`,sum(`view_parts_signed_values`.`qty_signed`) AS `qty_total`,sum(`view_parts_signed_values`.`total_price_signed`) AS `price_total` from `view_parts_signed_values` group by `view_parts_signed_values`.`worksheet_id`,`view_parts_signed_values`.`part_number`,`view_parts_signed_values`.`bar_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `view_worksheets_customers_cranes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`smoers`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_worksheets_customers_cranes` AS select `w`.`id` AS `id`,`w`.`number` AS `number`,`w`.`date` AS `date`,year(`w`.`date`) AS `year`,`w`.`validated` AS `validated`,`w`.`validated_date` AS `validated_date`,`w`.`warranty` AS `warranty`,`tc`.`serial` AS `serial`,`tc`.`plate` AS `plate`,`c`.`name` AS `name`,`w`.`truckscrane_id` AS `truckscrane_id` from ((`worksheets` `w` left join `truckscranes` `tc` on(`w`.`truckscrane_id` = `tc`.`id`)) left join `customers` `c` on(`tc`.`customer_id` = `c`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

