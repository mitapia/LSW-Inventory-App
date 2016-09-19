-- MySQL dump 10.13  Distrib 5.7.11, for Linux (x86_64)
--
-- Host: localhost    Database: liberty001
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Sandals','2016-03-13 23:27:26','2016-03-13 23:27:26'),(2,'Pumps','2016-03-13 23:27:26','2016-03-13 23:27:26'),(3,'Flats','2016-03-13 23:27:26','2016-03-13 23:27:26'),(4,'Wedges and Platforms','2016-03-13 23:27:26','2016-03-13 23:27:26'),(5,'Boots','2016-03-13 23:27:26','2016-03-13 23:27:26'),(6,'Sneakers','2016-03-13 23:27:26','2016-03-13 23:27:26'),(7,'Heels','2016-03-13 23:27:26','2016-03-13 23:27:26'),(8,'Clogs & Mules','2016-03-13 23:27:26','2016-03-13 23:27:26'),(9,'Booties','2016-03-13 23:27:26','2016-03-13 23:27:26'),(10,'Dress Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(11,'Slippers','2016-03-13 23:27:26','2016-03-13 23:27:26'),(12,'Accessories','2016-03-13 23:27:26','2016-03-13 23:27:26'),(13,'Mix','2016-03-13 23:27:26','2016-03-13 23:27:26');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_price_rule`
--

DROP TABLE IF EXISTS `category_price_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_price_rule` (
  `category_id` int(11) NOT NULL,
  `price_rule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_price_rule`
--

LOCK TABLES `category_price_rule` WRITE;
/*!40000 ALTER TABLE `category_price_rule` DISABLE KEYS */;
INSERT INTO `category_price_rule` VALUES (1,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(2,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(3,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(4,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(5,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(6,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(7,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(8,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(9,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(10,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(11,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(12,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(13,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(1,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(2,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(3,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(4,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(5,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(6,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(7,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(8,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(9,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(10,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(11,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(12,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(13,3,'2016-04-11 08:54:31','2016-04-11 08:54:31');
/*!40000 ALTER TABLE `category_price_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Men','2016-03-13 23:27:26','2016-03-13 23:27:26'),(2,'Women','2016-03-13 23:27:26','2016-03-13 23:27:26'),(3,'Girls','2016-03-13 23:27:26','2016-03-13 23:27:26'),(4,'Boys','2016-03-13 23:27:26','2016-03-13 23:27:26'),(5,'Accessories','2016-03-13 23:27:26','2016-03-13 23:27:26');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_price_rule`
--

DROP TABLE IF EXISTS `department_price_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department_price_rule` (
  `department_id` int(11) NOT NULL,
  `price_rule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_price_rule`
--

LOCK TABLES `department_price_rule` WRITE;
/*!40000 ALTER TABLE `department_price_rule` DISABLE KEYS */;
INSERT INTO `department_price_rule` VALUES (2,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(1,3,'2016-04-11 08:54:31','2016-04-11 08:54:31');
/*!40000 ALTER TABLE `department_price_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail`
--

DROP TABLE IF EXISTS `detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `online_color_id` int(11) NOT NULL,
  `inventory_prep_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail`
--

LOCK TABLES `detail` WRITE;
/*!40000 ALTER TABLE `detail` DISABLE KEYS */;
INSERT INTO `detail` VALUES (1,'aa',3,2,10,'2016-04-10 17:16:32','2016-04-10 17:16:32'),(2,'aa',3,14,11,'2016-04-10 17:16:32','2016-04-10 17:16:32'),(3,'nikk',6,2,12,'2016-04-10 17:16:32','2016-04-10 17:16:32'),(4,'aa',3,2,17,'2016-04-10 18:41:07','2016-04-10 18:41:07'),(5,'fd',5,2,18,'2016-04-10 18:41:07','2016-04-10 18:41:07'),(6,'hwatss',2,2,13,'2016-04-12 06:07:43','2016-04-12 06:07:43'),(7,'afd',3,5,14,'2016-04-12 06:07:43','2016-04-12 06:07:43'),(8,'asdf',6,5,15,'2016-04-12 06:07:43','2016-04-12 06:07:43'),(9,'sd',2,6,16,'2016-04-12 06:07:43','2016-04-12 06:07:43'),(10,'aa',3,2,19,'2016-04-18 08:24:48','2016-04-18 08:24:48'),(11,'aa',3,2,20,'2016-04-18 08:24:48','2016-04-18 08:24:48');
/*!40000 ALTER TABLE `detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_prep`
--

DROP TABLE IF EXISTS `inventory_prep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_prep` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `style` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(13,2) NOT NULL,
  `color` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `size_matrix_id` int(11) NOT NULL,
  `detail_set` tinyint(1) NOT NULL DEFAULT '0',
  `quantity_set` tinyint(1) NOT NULL DEFAULT '0',
  `delivered` tinyint(1) NOT NULL DEFAULT '0',
  `reorder` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_vendor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `inventory_prep_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `inventory_prep_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_prep`
--

LOCK TABLES `inventory_prep` WRITE;
/*!40000 ALTER TABLE `inventory_prep` DISABLE KEYS */;
INSERT INTO `inventory_prep` VALUES (10,'anna-0',3.00,'black',2,0,8,13,1,1,1,0,0,'2016-04-09 20:49:16','2016-04-10 17:17:39'),(11,'anna-0',3.50,'white',2,0,8,13,1,1,1,0,0,'2016-04-09 20:49:16','2016-04-10 17:17:39'),(12,'0093763',7.00,'black',1,0,8,14,1,1,1,0,0,'2016-04-09 20:49:16','2016-04-10 17:17:39'),(13,'style-00',11.00,'black',4,0,9,13,1,0,1,0,0,'2016-04-09 20:49:16','2016-04-12 06:07:43'),(14,'color-8',2.00,'silver',4,0,9,13,1,0,1,0,0,'2016-04-09 20:49:16','2016-04-12 06:07:43'),(15,'color-8',2.00,'green',4,0,9,14,1,0,1,0,0,'2016-04-09 20:49:16','2016-04-12 06:07:43'),(16,'6738899',1.00,'orange',3,0,9,14,1,0,1,0,0,'2016-04-09 20:49:16','2016-04-12 06:07:43'),(17,'anna-0',3.00,'black',2,0,10,14,1,1,1,0,0,'2016-04-09 20:49:16','2016-04-10 18:45:48'),(18,'anna-1',3.00,'black',2,0,10,13,1,1,1,0,0,'2016-04-09 20:49:16','2016-04-10 18:45:48'),(19,'anna-0',3.00,'black',2,0,11,15,1,1,1,0,0,'2016-04-18 08:22:11','2016-04-18 08:24:48'),(20,'anna-1',3.00,'black',2,0,11,15,1,1,1,0,0,'2016-04-18 08:22:11','2016-04-18 08:24:48');
/*!40000 ALTER TABLE `inventory_prep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `page_number` tinyint(4) NOT NULL DEFAULT '1',
  `total_pages` tinyint(4) NOT NULL DEFAULT '1',
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `open` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (8,'1000010298',1,1,'first test invoice','testing',9,1,'2016-04-09 20:49:16','2016-04-09 20:49:16'),(9,'1000010JBD',1,2,'anoher invoice','testing',9,1,'2016-04-09 20:49:16','2016-04-09 20:49:16'),(10,'1000010JBD-2',2,2,'second page invoice','testing',9,1,'2016-04-09 20:49:16','2016-04-09 20:49:16'),(11,'00¥¥¥',1,1,'','staff',9,1,'2016-04-18 08:22:11','2016-04-18 08:22:11');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_07_22_081053_create_departments_table',1),('2015_07_22_081204_create_categories_table',1),('2015_07_22_081216_create_vendors_table',1),('2015_07_22_202638_create_invoices_table',1),('2015_07_22_202639_create_inventory__preps_table',1),('2015_07_22_202639_create_price__rules_table',1),('2015_07_25_114414_DCV_m2m_relationship',1),('2015_07_30_103649_create_size__matrices_table',1),('2015_08_05_150301_create_quantities_table',1),('2015_08_10_044931_create_online__colors_table',1),('2015_08_16_063520_create_details_table',1),('2015_08_27_114619_create_q_b__inventories_table',1),('2015_11_11_115315_create_permissions_table',1),('2016_04_19_193822_create_temporary__stagings_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_color`
--

DROP TABLE IF EXISTS `online_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online_color` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_color`
--

LOCK TABLES `online_color` WRITE;
/*!40000 ALTER TABLE `online_color` DISABLE KEYS */;
INSERT INTO `online_color` VALUES (1,'Beige','2016-03-13 23:27:26','2016-03-13 23:27:26'),(2,'Black','2016-03-13 23:27:26','2016-03-13 23:27:26'),(3,'Blue','2016-03-13 23:27:26','2016-03-13 23:27:26'),(4,'Brown','2016-03-13 23:27:26','2016-03-13 23:27:26'),(5,'Gold','2016-03-13 23:27:26','2016-03-13 23:27:26'),(6,'Green','2016-03-13 23:27:26','2016-03-13 23:27:26'),(7,'Gray','2016-03-13 23:27:26','2016-03-13 23:27:26'),(8,'Multicolor','2016-03-13 23:27:26','2016-03-13 23:27:26'),(9,'Orange','2016-03-13 23:27:26','2016-03-13 23:27:26'),(10,'Pink','2016-03-13 23:27:26','2016-03-13 23:27:26'),(11,'Purple','2016-03-13 23:27:26','2016-03-13 23:27:26'),(12,'Red','2016-03-13 23:27:26','2016-03-13 23:27:26'),(13,'Silver','2016-03-13 23:27:26','2016-03-13 23:27:26'),(14,'White','2016-03-13 23:27:26','2016-03-13 23:27:26'),(15,'Yellow','2016-03-13 23:27:26','2016-03-13 23:27:26');
/*!40000 ALTER TABLE `online_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permissions_user_id_foreign` (`user_id`),
  CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,'admin','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_rule`
--

DROP TABLE IF EXISTS `price_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `minimum_cost` decimal(13,2) NOT NULL,
  `maximum_cost` decimal(13,2) NOT NULL,
  `item_description` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `regular_price` decimal(13,2) NOT NULL,
  `custom_price_1` decimal(13,2) NOT NULL,
  `custom_price_2` decimal(13,2) NOT NULL,
  `custom_price_3` decimal(13,2) NOT NULL,
  `custom_price_4` decimal(13,2) NOT NULL,
  `rewards` tinyint(1) NOT NULL DEFAULT '1',
  `priority` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_rule`
--

LOCK TABLES `price_rule` WRITE;
/*!40000 ALTER TABLE `price_rule` DISABLE KEYS */;
INSERT INTO `price_rule` VALUES (2,0.01,6.00,'Woman til 10',15.00,15.00,13.00,13.00,15.00,0,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(3,0.01,6.00,'Men price',16.00,16.00,14.00,14.00,16.00,0,1,'2016-04-11 08:54:31','2016-04-11 08:54:31');
/*!40000 ALTER TABLE `price_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_rule_vendor`
--

DROP TABLE IF EXISTS `price_rule_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_rule_vendor` (
  `vendor_id` int(11) NOT NULL,
  `price_rule_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_rule_vendor`
--

LOCK TABLES `price_rule_vendor` WRITE;
/*!40000 ALTER TABLE `price_rule_vendor` DISABLE KEYS */;
INSERT INTO `price_rule_vendor` VALUES (5,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(6,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(8,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(9,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(10,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(11,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(12,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(13,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(19,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(20,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(21,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(22,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(23,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(25,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(26,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(28,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(29,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(30,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(31,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(32,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(33,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(34,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(35,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(37,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(38,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(40,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(41,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(44,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(45,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(81,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(82,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(83,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(85,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(86,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(87,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(88,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(89,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(92,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(93,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(95,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(96,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(98,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(99,2,'2016-04-11 08:54:02','2016-04-11 08:54:02'),(5,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(6,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(8,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(9,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(10,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(11,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(12,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(13,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(19,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(20,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(21,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(22,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(23,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(25,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(26,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(28,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(29,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(30,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(31,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(32,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(33,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(34,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(35,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(37,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(38,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(40,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(41,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(44,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(45,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(81,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(82,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(83,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(85,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(86,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(87,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(88,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(89,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(92,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(93,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(95,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(96,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(98,3,'2016-04-11 08:54:31','2016-04-11 08:54:31'),(99,3,'2016-04-11 08:54:31','2016-04-11 08:54:31');
/*!40000 ALTER TABLE `price_rule_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qb_inventory`
--

DROP TABLE IF EXISTS `qb_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qb_inventory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `style` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qb_inventory`
--

LOCK TABLES `qb_inventory` WRITE;
/*!40000 ALTER TABLE `qb_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `qb_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantity`
--

DROP TABLE IF EXISTS `quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quantity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_prep_id` int(11) NOT NULL,
  `store_1` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_2` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_3` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_4` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantity`
--

LOCK TABLES `quantity` WRITE;
/*!40000 ALTER TABLE `quantity` DISABLE KEYS */;
INSERT INTO `quantity` VALUES (1,10,2,2,2,2,'2016-04-10 17:17:39','2016-04-10 17:17:39'),(2,11,1,1,1,1,'2016-04-10 17:17:39','2016-04-10 17:17:39'),(3,12,1,2,3,4,'2016-04-10 17:17:39','2016-04-10 17:17:39'),(4,17,1,1,1,1,'2016-04-10 18:45:48','2016-04-10 18:45:48'),(5,18,1,1,1,1,'2016-04-10 18:45:48','2016-04-10 18:45:48'),(6,19,1,1,1,1,'2016-04-18 08:23:16','2016-04-18 08:23:16'),(7,20,1,1,1,1,'2016-04-18 08:23:16','2016-04-18 08:23:16');
/*!40000 ALTER TABLE `quantity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `size_matrix`
--

DROP TABLE IF EXISTS `size_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `size_matrix` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_id` tinyint(3) unsigned NOT NULL,
  `0_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `1_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `2_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `3_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `4_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `5_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `6_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `7_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `8_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `9_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `10_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `11_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `12_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `13_K` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `0_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `0_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `1_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `1_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `2_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `2_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `3_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `3_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `4_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `4_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `5_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `6_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `6_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `7_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `7_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `8_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `8_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `9_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `9_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `10_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `10_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `11_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `11_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `12_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `12_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `13_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `13_5_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `14_A` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size_matrix`
--

LOCK TABLES `size_matrix` WRITE;
/*!40000 ALTER TABLE `size_matrix` DISABLE KEYS */;
INSERT INTO `size_matrix` VALUES (13,'A1',9,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-09 20:49:16','2016-04-09 20:49:16'),(14,'A2',9,0,0,2,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-09 20:49:16','2016-04-09 20:49:16'),(15,'A3',9,0,0,0,3,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-18 08:16:38','2016-04-18 08:16:38');
/*!40000 ALTER TABLE `size_matrix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temporary_stagings`
--

DROP TABLE IF EXISTS `temporary_stagings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temporary_stagings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_prep_id` int(11) NOT NULL,
  `style` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `store_1` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_2` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_3` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `store_4` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporary_stagings`
--

LOCK TABLES `temporary_stagings` WRITE;
/*!40000 ALTER TABLE `temporary_stagings` DISABLE KEYS */;
INSERT INTO `temporary_stagings` VALUES (1,10,'anna-0','black','1_K',2,2,2,2,'2016-04-23 14:53:06','2016-04-23 14:53:06'),(2,10,'anna-0','black','2_K',2,2,2,2,'2016-04-23 14:53:06','2016-04-23 14:53:06'),(3,11,'anna-0','white','1_K',1,1,1,1,'2016-04-23 14:53:06','2016-04-23 14:53:06'),(4,11,'anna-0','white','2_K',1,1,1,1,'2016-04-23 14:53:06','2016-04-23 14:53:06');
/*!40000 ALTER TABLE `temporary_stagings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'SysAdmin','sysadmin','$2y$10$KYx0UIJU6OWxJYL456RtCuwSFHOtwoaptOQ82VKyHSiCjJu9gzqKu',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor`
--

LOCK TABLES `vendor` WRITE;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` VALUES (5,'CPC Ardor','2016-03-13 23:27:26','2016-03-13 23:27:26'),(6,'Donis Dynasty','2016-03-13 23:27:26','2016-03-13 23:27:26'),(8,'Eagle Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(9,'Elim Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(10,'Forever Link','2016-03-13 23:27:26','2016-03-13 23:27:26'),(11,'Golden Asia Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(12,'Hot Air Inc','2016-03-13 23:27:26','2016-03-13 23:27:26'),(13,'Happy New Star','2016-03-13 23:27:26','2016-03-13 23:27:26'),(19,'Melrose','2016-03-13 23:27:26','2016-03-13 23:27:26'),(20,'I Heart Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(21,'Marilyn Moda','2016-03-13 23:27:26','2016-03-13 23:27:26'),(22,'X-Power / Nuera Group','2016-03-13 23:27:26','2016-03-13 23:27:26'),(23,'Oceanlink','2016-03-13 23:27:26','2016-03-13 23:27:26'),(25,'Ositos Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(26,'People\'s Shoe','2016-03-13 23:27:26','2016-03-13 23:27:26'),(28,'Red Circle','2016-03-13 23:27:26','2016-03-13 23:27:26'),(29,'Rockland Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(30,'DND Fashion','2016-03-13 23:27:26','2016-03-13 23:27:26'),(31,'High Output / Shenzhen','2016-03-13 23:27:26','2016-03-13 23:27:26'),(32,'Saul Caudillo','2016-03-13 23:27:26','2016-03-13 23:27:26'),(33,'Shoe Dynasty','2016-03-13 23:27:26','2016-03-13 23:27:26'),(34,'Springland Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(35,'Sunny AIT','2016-03-13 23:27:26','2016-03-13 23:27:26'),(37,'Syke Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(38,'Sup Trading / Smart Easy','2016-03-13 23:27:26','2016-03-13 23:27:26'),(40,'Top Link / Universal Link','2016-03-13 23:27:26','2016-03-13 23:27:26'),(41,'Twin Tiger','2016-03-13 23:27:26','2016-03-13 23:27:26'),(44,'Bella Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(45,'Lasonia Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(81,'Reyme','2016-03-13 23:27:26','2016-03-13 23:27:26'),(82,'Machi Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(83,'Mythology Trading','2016-03-13 23:27:26','2016-03-13 23:27:26'),(85,'Makers Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(86,'ChinAmerica','2016-03-13 23:27:26','2016-03-13 23:27:26'),(87,'JP Original','2016-03-13 23:27:26','2016-03-13 23:27:26'),(88,'Shine Max','2016-03-13 23:27:26','2016-03-13 23:27:26'),(89,'Milan Import','2016-03-13 23:27:26','2016-03-13 23:27:26'),(92,'K-Swiss','2016-03-13 23:27:26','2016-03-13 23:27:26'),(93,'Elegant Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26'),(95,'Neway Shoes','2016-03-13 23:27:26','2016-03-13 23:27:26'),(96,'Formosa Fashion','2016-03-13 23:27:26','2016-03-13 23:27:26'),(98,'Amiga Shoes Factory','2016-03-13 23:27:26','2016-03-13 23:27:26'),(99,'Golden West Footwear','2016-03-13 23:27:26','2016-03-13 23:27:26');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-23 20:04:55
