-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: shoes_erp_db
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_category_category1_idx` (`category_id`),
  CONSTRAINT `FK_64C19C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,NULL,'001','Category parent 1','category-parent-1','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(2,1,'002','Category 2','category-2','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(3,1,'003','Category 3','category-3','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(4,NULL,'004','Category 4','category-4','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(5,NULL,'005','Category 5','category-5','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(6,NULL,'006','Category parent 2','category-parent-2','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(7,6,'007','Category 7','category-7','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(8,6,'008','Category 8','category-8','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1),(9,6,'009','Category 9','category-9','PRODUCT','2019-07-29 03:30:46',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pk_file_item` int(11) NOT NULL,
  `class_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mime_content_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `filter` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uniqid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,9,'User','image/png','images','file_thumb_500_417','5d408da2b7cfc5.17878930','5d3e6aa1172b6','2019-07-29 03:40:17',NULL,'2019-07-30 18:34:10',NULL,1),(2,5,'Product','image/png','images','file_thumb_500_417','5d408db1ce6c08.48623171','5d3e6ad1eaa47','2019-07-29 03:41:05',NULL,'2019-07-30 18:34:25',NULL,1),(3,1,'Product','image/png','images','file_thumb_500_417','5d3e8917f1a800.67129092','5d3e7398053d3','2019-07-29 04:18:31',NULL,'2019-07-29 05:50:15',NULL,1),(4,4,'Product','image/jpeg','images','file_thumb_500_417','5d3e89131ffcb0.80509317','5d3e75b6bc8e9','2019-07-29 04:27:34',NULL,'2019-07-29 05:50:11',NULL,1),(5,8,'User','image/jpeg','images','file_thumb_500_417','5d3e897222a3c9.60457537','5d3e89722525e','2019-07-29 05:51:46',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_friends_user1_idx` (`user_id`),
  KEY `fk_friends_user2_idx` (`friend_id`),
  CONSTRAINT `FK_21EE70696A5458E8` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_21EE7069A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file`
--

DROP TABLE IF EXISTS `google_drive_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `unique_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `file_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `file_mime_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_mime_type_short` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_icon_link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8_unicode_ci NOT NULL,
  `file_name_original` text COLLATE utf8_unicode_ci,
  `file_size` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `count_share` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_google_drive_file_user_idx` (`user_id`),
  CONSTRAINT `FK_148FFCAAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file`
--

LOCK TABLES `google_drive_file` WRITE;
/*!40000 ALTER TABLE `google_drive_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file_count`
--

DROP TABLE IF EXISTS `google_drive_file_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `count_share` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file_count`
--

LOCK TABLES `google_drive_file_count` WRITE;
/*!40000 ALTER TABLE `google_drive_file_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file_vote`
--

DROP TABLE IF EXISTS `google_drive_file_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `google_drive_file_id` int(11) DEFAULT NULL,
  `vote` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_google_drive_file_like_google_drive_file1_idx` (`google_drive_file_id`),
  KEY `fk_google_drive_file_like_user1_idx` (`user_id`),
  CONSTRAINT `FK_35D550BF77A02D92` FOREIGN KEY (`google_drive_file_id`) REFERENCES `google_drive_file` (`id`),
  CONSTRAINT `FK_35D550BFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file_vote`
--

LOCK TABLES `google_drive_file_vote` WRITE;
/*!40000 ALTER TABLE `google_drive_file_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_type`
--

LOCK TABLES `payment_type` WRITE;
/*!40000 ALTER TABLE `payment_type` DISABLE KEYS */;
INSERT INTO `payment_type` VALUES (1,'001','Abono por cuenta','abono-por-cuenta','2019-07-29 03:30:46',NULL,1),(2,'002','Adelanto por mercadería','adelanto-por-mercaderia','2019-07-29 03:30:46',NULL,1),(3,'003','Descuento','descuento','2019-07-29 03:30:46',NULL,1),(4,'004','Credito','credito','2019-07-29 03:30:46',NULL,1),(5,'005','Pago por deposito','pago-por-deposito','2019-07-29 03:30:46',NULL,1);
/*!40000 ALTER TABLE `payment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale`
--

DROP TABLE IF EXISTS `point_of_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_of_sale_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` tinytext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_point_of_sale_point_of_sale1_idx` (`point_of_sale_id`),
  CONSTRAINT `FK_F7A7B1FA6B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale`
--

LOCK TABLES `point_of_sale` WRITE;
/*!40000 ALTER TABLE `point_of_sale` DISABLE KEYS */;
INSERT INTO `point_of_sale` VALUES (1,NULL,'111','point-of-sale-1','Punto de venta 1',-12.02407160,-77.11203260,NULL,'Av. Petit Thouars 2161, San Isidro','999888777','2019-07-29 03:30:46',NULL,'2019-07-29 03:30:46',NULL,1),(2,NULL,'222','point-of-sale-2','Punto de venta 2',-12.14761230,-77.02137500,NULL,'Av. Petit Thouars 2161, San Isidro','999888777','2019-07-29 03:30:46',NULL,NULL,NULL,1),(3,NULL,'333','point-of-sale-3','Punto de venta 3',-12.09828210,-76.96201320,NULL,'Av. Petit Thouars 2161, San Isidro','999888777','2019-07-29 03:30:46',NULL,'2019-07-29 03:30:46',NULL,1),(4,NULL,'444','point-of-sale-4','Punto de venta 4',-12.06254110,-77.01679050,NULL,'Av. Petit Thouars 2161, San Isidro','999888777','2019-07-29 03:30:46',NULL,'2019-07-29 03:30:46',NULL,1),(5,3,'1111','point-of-sale-11','Punto de venta Sucursal 1',-12.12887710,-77.00113490,NULL,'Av. jerusalem 777','994826014','2019-07-29 03:30:46',NULL,NULL,NULL,1),(6,3,'2222','point-of-sale-12','Punto de venta Sucursal 2',-12.12087470,-77.02965630,NULL,'Av. breña del mar 4567','2484434','2019-07-29 03:30:46',NULL,NULL,NULL,1),(7,3,'3333','point-of-sale-13','Punto de venta Sucursal 3',-12.05608690,-77.08439210,NULL,'Av. del mar 1234','998461653','2019-07-29 03:30:46',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `point_of_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale_has_category`
--

DROP TABLE IF EXISTS `point_of_sale_has_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale_has_category` (
  `point_of_sale_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`point_of_sale_id`,`category_id`),
  KEY `IDX_A82D93496B7E9A73` (`point_of_sale_id`),
  KEY `IDX_A82D934912469DE2` (`category_id`),
  CONSTRAINT `FK_A82D934912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_A82D93496B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale_has_category`
--

LOCK TABLES `point_of_sale_has_category` WRITE;
/*!40000 ALTER TABLE `point_of_sale_has_category` DISABLE KEYS */;
INSERT INTO `point_of_sale_has_category` VALUES (3,1),(3,2),(3,3),(3,4),(3,5),(3,6),(3,7),(3,8),(3,9);
/*!40000 ALTER TABLE `point_of_sale_has_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale_has_user`
--

DROP TABLE IF EXISTS `point_of_sale_has_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale_has_user` (
  `point_of_sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`point_of_sale_id`,`user_id`),
  KEY `IDX_6D10130A6B7E9A73` (`point_of_sale_id`),
  KEY `IDX_6D10130AA76ED395` (`user_id`),
  CONSTRAINT `FK_6D10130A6B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_6D10130AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale_has_user`
--

LOCK TABLES `point_of_sale_has_user` WRITE;
/*!40000 ALTER TABLE `point_of_sale_has_user` DISABLE KEYS */;
INSERT INTO `point_of_sale_has_user` VALUES (1,2),(3,2),(3,3),(3,4),(3,5),(3,6),(3,7),(3,8),(3,9),(3,10),(3,11),(3,12),(3,13),(3,14),(3,15),(3,17),(3,18),(3,19),(3,20),(3,21),(3,22),(3,23),(3,24),(3,25),(4,2);
/*!40000 ALTER TABLE `point_of_sale_has_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `code` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADF8BD700D` (`unit_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_D34A04ADF8BD700D` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,1,'111','#0000FF',25.33,'Producto 1',10,35,'producto-1','2019-07-29 03:30:46',NULL,NULL,NULL,1),(2,1,1,'222','#FF0000',67.77,'Producto 2',9,67,'producto-2','2019-07-29 03:30:46',NULL,NULL,NULL,1),(3,1,1,'333','#00FF00',15.33,'Producto 3',8,25,'producto-3','2019-07-29 03:30:46',NULL,NULL,NULL,1),(4,1,1,'444','#0000FF',12.33,'Producto 4',10,98,'producto-4','2019-07-29 03:30:46',NULL,NULL,NULL,1),(5,1,1,'555','#FF0000',43.33,'Producto 5',11,15,'producto-5','2019-07-29 03:30:46',NULL,NULL,NULL,1),(6,2,1,'666','#00FF00',23.44,'Producto 6',12,35,'producto-6','2019-07-29 03:30:46',NULL,NULL,NULL,1),(7,2,1,'777','#0000FF',99.22,'Producto 7',10,67,'producto-7','2019-07-29 03:30:46',NULL,NULL,NULL,1),(8,2,1,'888','#FF0000',77.88,'Producto 8',8,25,'producto-8','2019-07-29 03:30:46',NULL,NULL,NULL,1),(9,2,1,'999','#0000FF',41.66,'Producto 9',10,98,'producto-9','2019-07-29 03:30:46',NULL,NULL,NULL,1),(10,3,1,'1010','#FF0000',67.55,'Producto 10',12,78,'producto-10','2019-07-29 03:30:46',NULL,NULL,NULL,1),(11,3,1,'1111','#0000FF',45.22,'Producto 11',11,34,'producto-11','2019-07-29 03:30:46',NULL,NULL,NULL,1),(12,3,1,'1212','#ff006c',14.33,'Producto 12',10,22,'producto-12','2019-07-29 03:30:46',NULL,'2019-07-29 05:52:16',NULL,1),(13,1,2,'4444','#e5a81c',NULL,'rrrrrrrrrrr',9,23,'rrrrrrrrrrr','2019-07-29 05:50:53',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_canonical` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,NULL,'Super Administrator',NULL,'super-administrator','2019-07-29 03:30:46',NULL,NULL,NULL,1),(2,NULL,'PDV Administrator',NULL,'pdv-administrator','2019-07-29 03:30:46',NULL,NULL,NULL,1),(3,NULL,'Empleado',NULL,'employee','2019-07-29 03:30:46',NULL,NULL,NULL,1),(4,NULL,'Cliente',NULL,'client','2019-07-29 03:30:46',NULL,NULL,NULL,1),(5,NULL,'Guest (invitado)',NULL,'guest-invitado','2019-07-29 03:30:46',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_has_role`
--

DROP TABLE IF EXISTS `profile_has_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_has_role` (
  `profile_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`,`role_id`),
  KEY `IDX_F35F3084CCFA12B8` (`profile_id`),
  KEY `IDX_F35F3084D60322AC` (`role_id`),
  CONSTRAINT `FK_F35F3084CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_F35F3084D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_has_role`
--

LOCK TABLES `profile_has_role` WRITE;
/*!40000 ALTER TABLE `profile_has_role` DISABLE KEYS */;
INSERT INTO `profile_has_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(2,8),(2,36),(2,37),(2,38),(2,39),(3,8),(4,8),(5,8);
/*!40000 ALTER TABLE `profile_has_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_rol` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_rol_tag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'Role stadistics','ROLE_STADISTICS','Stadistics','group-stadistics','2019-07-29 03:30:46',NULL,NULL,NULL,1),(2,NULL,'Role settings','ROLE_SETTINGS','Settings','group-settings','2019-07-29 03:30:46',NULL,NULL,NULL,1),(3,NULL,'Role upload image','ROLE_UPLOAD_IMAGE','Upload image','group-upload-image','2019-07-29 03:30:46',NULL,NULL,NULL,1),(4,NULL,'Profile view','ROLE_PROFILE_VIEW','Perfil','group-profile','2019-07-29 03:30:46',NULL,NULL,NULL,1),(5,NULL,'Profile create','ROLE_PROFILE_CREATE','Perfil','group-profile','2019-07-29 03:30:46',NULL,NULL,NULL,1),(6,NULL,'Profile edit','ROLE_PROFILE_EDIT','Perfil','group-profile','2019-07-29 03:30:46',NULL,NULL,NULL,1),(7,NULL,'Profile delete','ROLE_PROFILE_DELETE','Perfil','group-profile','2019-07-29 03:30:46',NULL,NULL,NULL,1),(8,NULL,'User view','ROLE_USER_VIEW','Usuario','group-user','2019-07-29 03:30:46',NULL,NULL,NULL,1),(9,NULL,'User create','ROLE_USER_CREATE','Usuario','group-user','2019-07-29 03:30:46',NULL,NULL,NULL,1),(10,NULL,'User edit','ROLE_USER_EDIT','Usuario','group-user','2019-07-29 03:30:46',NULL,NULL,NULL,1),(11,NULL,'User delete','ROLE_USER_DELETE','Usuario','group-user','2019-07-29 03:30:46',NULL,NULL,NULL,1),(12,NULL,'client view','ROLE_CLIENT_VIEW','Cliente','group-client','2019-07-29 03:30:46',NULL,NULL,NULL,1),(13,NULL,'Client create','ROLE_CLIENT_CREATE','Cliente','group-client','2019-07-29 03:30:46',NULL,NULL,NULL,1),(14,NULL,'client edit','ROLE_CLIENT_EDIT','Cliente','group-client','2019-07-29 03:30:46',NULL,NULL,NULL,1),(15,NULL,'client delete','ROLE_CLIENT_DELETE','Cliente','group-client','2019-07-29 03:30:46',NULL,NULL,NULL,1),(16,NULL,'Employee view','ROLE_EMPLOYEE_VIEW','Empleado','group-employee','2019-07-29 03:30:46',NULL,NULL,NULL,1),(17,NULL,'Employee create','ROLE_EMPLOYEE_CREATE','Empleado','group-employee','2019-07-29 03:30:46',NULL,NULL,NULL,1),(18,NULL,'Employee edit','ROLE_EMPLOYEE_EDIT','Empleado','group-employee','2019-07-29 03:30:46',NULL,NULL,NULL,1),(19,NULL,'Employee delete','ROLE_EMPLOYEE_DELETE','Empleado','group-employee','2019-07-29 03:30:46',NULL,NULL,NULL,1),(20,NULL,'Pdv view','ROLE_PDV_VIEW','Pdv','group-pdv','2019-07-29 03:30:46',NULL,NULL,NULL,1),(21,NULL,'Pdv create','ROLE_PDV_CREATE','Pdv','group-pdv','2019-07-29 03:30:46',NULL,NULL,NULL,1),(22,NULL,'Pdv edit','ROLE_PDV_EDIT','Pdv','group-pdv','2019-07-29 03:30:46',NULL,NULL,NULL,1),(23,NULL,'Pdv delete','ROLE_PDV_DELETE','Pdv','group-pdv','2019-07-29 03:30:46',NULL,NULL,NULL,1),(24,NULL,'Category view','ROLE_CATEGORY_VIEW','Categoría','group-category','2019-07-29 03:30:46',NULL,NULL,NULL,1),(25,NULL,'Category create','ROLE_CATEGORY_CREATE','Categoría','group-category','2019-07-29 03:30:46',NULL,NULL,NULL,1),(26,NULL,'Category edit','ROLE_CATEGORY_EDIT','Categoría','group-category','2019-07-29 03:30:46',NULL,NULL,NULL,1),(27,NULL,'Category delete','ROLE_CATEGORY_DELETE','Categoría','group-category','2019-07-29 03:30:46',NULL,NULL,NULL,1),(28,NULL,'Product view','ROLE_PRODUCT_VIEW','Producto','group-product','2019-07-29 03:30:46',NULL,NULL,NULL,1),(29,NULL,'Product create','ROLE_PRODUCT_CREATE','Producto','group-product','2019-07-29 03:30:46',NULL,NULL,NULL,1),(30,NULL,'Product edit','ROLE_PRODUCT_EDIT','Producto','group-product','2019-07-29 03:30:46',NULL,NULL,NULL,1),(31,NULL,'Product delete','ROLE_PRODUCT_DELETE','Producto','group-product','2019-07-29 03:30:46',NULL,NULL,NULL,1),(32,NULL,'PaymentType view','ROLE_PAYMENT_TYPE_VIEW','Tipo de pago','group-paymenttype','2019-07-29 03:30:46',NULL,NULL,NULL,1),(33,NULL,'PaymentType create','ROLE_PAYMENT_TYPE_CREATE','Tipo de pago','group-paymenttype','2019-07-29 03:30:46',NULL,NULL,NULL,1),(34,NULL,'PaymentType edit','ROLE_PAYMENT_TYPE_EDIT','Tipo de pago','group-paymenttype','2019-07-29 03:30:46',NULL,NULL,NULL,1),(35,NULL,'PaymentType delete','ROLE_PAYMENT_TYPE_DELETE','Tipo de pago','group-paymenttype','2019-07-29 03:30:46',NULL,NULL,NULL,1),(36,NULL,'Ticket view','ROLE_TICKET_VIEW','Ticket','group-ticket','2019-07-29 03:30:46',NULL,NULL,NULL,1),(37,NULL,'Ticket create','ROLE_TICKET_CREATE','Ticket','group-ticket','2019-07-29 03:30:46',NULL,NULL,NULL,1),(38,NULL,'Ticket edit','ROLE_TICKET_EDIT','Ticket','group-ticket','2019-07-29 03:30:46',NULL,NULL,NULL,1),(39,NULL,'Ticket delete','ROLE_TICKET_DELETE','Ticket','group-ticket','2019-07-29 03:30:46',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `FK_7332E16912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4A76ED395` (`user_id`),
  CONSTRAINT `FK_D044D5D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `point_of_sale_id` int(11) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticket_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date_ticket` datetime NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_97A0ADA319EB6921` (`client_id`),
  KEY `IDX_97A0ADA36B7E9A73` (`point_of_sale_id`),
  KEY `IDX_97A0ADA3DC058279` (`payment_type_id`),
  CONSTRAINT `FK_97A0ADA319EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_97A0ADA36B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_97A0ADA3DC058279` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,18,1,4,'5555','EXTERNO','4444444444','2019-07-29 05:53:52','4444444444','2019-07-29 05:53:52',1,NULL,NULL,1);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_has_employee`
--

DROP TABLE IF EXISTS `ticket_has_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_has_employee` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`,`user_id`),
  KEY `IDX_8C2F733E700047D2` (`ticket_id`),
  KEY `IDX_8C2F733EA76ED395` (`user_id`),
  CONSTRAINT `FK_8C2F733E700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_8C2F733EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_has_employee`
--

LOCK TABLES `ticket_has_employee` WRITE;
/*!40000 ALTER TABLE `ticket_has_employee` DISABLE KEYS */;
INSERT INTO `ticket_has_employee` VALUES (1,1);
/*!40000 ALTER TABLE `ticket_has_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_has_products`
--

DROP TABLE IF EXISTS `ticket_has_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_has_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ticket_has_products_ticket1_idx` (`ticket_id`),
  KEY `fk_ticket_has_products_product1_idx` (`product_id`),
  CONSTRAINT `FK_620A5CC54584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_620A5CC5700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_has_products`
--

LOCK TABLES `ticket_has_products` WRITE;
/*!40000 ALTER TABLE `ticket_has_products` DISABLE KEYS */;
INSERT INTO `ticket_has_products` VALUES (1,5,1,1,43.33,43.33),(2,3,1,3,15.33,45.99),(3,2,1,11,67.77,745.47);
/*!40000 ALTER TABLE `ticket_has_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_has_services`
--

DROP TABLE IF EXISTS `ticket_has_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_has_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ticket_has_services_ticket1_idx` (`ticket_id`),
  KEY `fk_ticket_has_services_services1_idx` (`service_id`),
  CONSTRAINT `FK_A282E7F6700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_A282E7F6ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_has_services`
--

LOCK TABLES `ticket_has_services` WRITE;
/*!40000 ALTER TABLE `ticket_has_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_has_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'paquete',NULL,NULL,1),(2,'unidades',NULL,NULL,1);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `point_of_sale_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `headline` varchar(144) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8_unicode_ci,
  `dob` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `reset_password_hash` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  KEY `IDX_8D93D6496B7E9A73` (`point_of_sale_id`),
  KEY `FK_8D93D649CCFA12B8` (`profile_id`),
  CONSTRAINT `FK_8D93D6496B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_8D93D649CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,NULL,'5d3e6866440c6','5d3e6866440c6','carlos@shoes-erp.com','carlos@shoes-erp.com',1,NULL,'$2y$13$SGkzNwgWFr77gsIlZjrH2ObExnIhOmsIaS.87GS4Ekg1ZAoj4yZmm','2019-07-30 19:06:44',NULL,NULL,'N;','5d3e6866440c6-carlos',NULL,'Carlos','Carlos','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,'2019-07-30 19:06:44',NULL,NULL,NULL,NULL,1),(2,2,NULL,'5d3e6866b1264','5d3e6866b1264','aeinstein@shoes-erp.com','aeinstein@shoes-erp.com',1,NULL,'$2y$13$3.7GjOWuH.I1Gy3zI6lr5eUJfQHpnI0mlm90g4fHqU/Ri0gmRKVNK',NULL,NULL,NULL,'N;','5d3e6866b1264-albert',NULL,'Albert','Einstein','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(3,3,NULL,'5d3e68672d180','5d3e68672d180','bgates@shoes-erp.com','bgates@shoes-erp.com',1,NULL,'$2y$13$piiGcNtoq6AMqfgNfouvf.qiaeug3DVgNIlw5JKt8qndNbgf0X27a',NULL,NULL,NULL,'N;','5d3e68672d180-bill',NULL,'Bill','Gates','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(4,3,NULL,'5d3e68679dbe5','5d3e68679dbe5','inewton@shoes-erp.com','inewton@shoes-erp.com',1,NULL,'$2y$13$poKJ4kJJZt62MvXDLGSEk.YDKqA5DyYtbnPKXewpK5Rzpy8HP0PE.',NULL,NULL,NULL,'N;','5d3e68679dbe5-isaac',NULL,'Isaac','Newton','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(5,3,NULL,'5d3e68681786b','5d3e68681786b','mpolo@shoes-erp.com','mpolo@shoes-erp.com',1,NULL,'$2y$13$kzwLNvio61R3aHvf8Ds1R.ebj.PIVzTdqoiUji8ix9DrDYOG/xPwC',NULL,NULL,NULL,'N;','5d3e68681786b-marco',NULL,'Marco','Polo','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(6,3,NULL,'5d3e6868836ce','5d3e6868836ce','troosevelt@shoes-erp.com','troosevelt@shoes-erp.com',1,NULL,'$2y$13$lwthBZqmwOQYc8IX.kJT6OTJO8xUUxCYam3q7CxyQ11yRCAl5evH6',NULL,NULL,NULL,'N;','5d3e6868836ce-theodore',NULL,'Theodore','Roosevelt','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(7,3,NULL,'5d3e6868eeebb','5d3e6868eeebb','kmarx@shoes-erp.com','kmarx@shoes-erp.com',1,NULL,'$2y$13$UiVnmZL4ufuXFaNfgON3d.dWsFvoIdtF/WLr1yLYh8JWxSL8I7bjO',NULL,NULL,NULL,'N;','5d3e6868eeebb-karl',NULL,'Karl','Marx','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(8,3,NULL,'5d3e686966afb','5d3e686966afb','fdouglass@shoes-erp.com','fdouglass@shoes-erp.com',1,NULL,'$2y$13$TbCvLU2i4IfF2NjdV77xWOl6ohhTydYa0DxxwyvYQUXV2A4QqwbjK',NULL,NULL,NULL,'N;','5d3e686966afb-frederick',NULL,'Frederick','Douglass','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(9,3,NULL,'5d3e6869d53ba','5d3e6869d53ba','jlennon@shoes-erp.com','jlennon@shoes-erp.com',1,NULL,'$2y$13$tWIZs9l6uxdjGQGiR6xTc.WLdlIhvVsYJ7Vnl387lrYMYLiOryjKK',NULL,NULL,NULL,'N;','5d3e6869d53ba-john',NULL,'John','Lennon','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(10,4,NULL,'5d3e686a503e3','5d3e686a503e3','sjobs@shoes-erp.com','sjobs@shoes-erp.com',1,NULL,'$2y$13$lMXrQ7yaUSQaSpu3e1oMFOlnsgD9heWS3WPTXc2QtnUUr0il3ANBK',NULL,NULL,NULL,'N;','5d3e686a503e3-steve',NULL,'Steve','Jobs','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(11,4,NULL,'5d3e686abbc5b','5d3e686abbc5b','rfederer@shoes-erp.com','rfederer@shoes-erp.com',1,NULL,'$2y$13$cjrF23TylSF42H4IzHNmGOC3PhB.MMbfxcGXzay5PWQ5ZqzDXPWE.',NULL,NULL,NULL,'N;','5d3e686abbc5b-roger',NULL,'Roger','Federer','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(12,4,NULL,'5d3e686b36f35','5d3e686b36f35','njunior@shoes-erp.com','njunior@shoes-erp.com',1,NULL,'$2y$13$zgGe1o8ehj6wxXc7cgCJn.4VV1a6ObvXTF9VwhhTJvAw6ueeQtWi.',NULL,NULL,NULL,'N;','5d3e686b36f35-neymar',NULL,'Neymar','Junior','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(13,4,NULL,'5d3e686ba4ae9','5d3e686ba4ae9','kgarcia@shoes-erp.com','kgarcia@shoes-erp.com',1,NULL,'$2y$13$j/kdOMy3KTw/vUXBR3.yU.6vzt.KrLXx2TefTTZuDuUP9AhU8IIga',NULL,NULL,NULL,'N;','5d3e686ba4ae9-keiko',NULL,'Keiko','Garcia','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(14,4,NULL,'5d3e686c1ba54','5d3e686c1ba54','jlopez@shoes-erp.com','jlopez@shoes-erp.com',1,NULL,'$2y$13$/Wj4m.3uACy2yexWgp8dEupz4QFaHrlhJrBMZOqTbRvXsXkhwweAe',NULL,NULL,NULL,'N;','5d3e686c1ba54-juan',NULL,'Juan','Lopez','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(15,4,NULL,'5d3e686c85713','5d3e686c85713','rmedina@shoes-erp.com','rmedina@shoes-erp.com',1,NULL,'$2y$13$jzcauaORADEmydD5ZlM94OHJ9zt43yGoAmmXqe30z2yvlJJ0bRIYK',NULL,NULL,NULL,'N;','5d3e686c85713-renee',NULL,'Renee','Medina','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(16,4,NULL,'5d3e686cf01ec','5d3e686cf01ec','kjohnson@shoes-erp.com','kjohnson@shoes-erp.com',1,NULL,'$2y$13$m5bebGV8ilviOTg0hp.je.G6YXZQWg6Jxzwk2MCM./oUKYQI7VJ5y',NULL,NULL,NULL,'N;','5d3e686cf01ec-katherine',NULL,'Katherine','Johnson','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(17,4,NULL,'5d3e686d68432','5d3e686d68432','mhamilton@shoes-erp.com','mhamilton@shoes-erp.com',1,NULL,'$2y$13$ElLIJ3gnkHaygy0sbRIBr.O5cMeqjEzjRJjAvrxZOaOP4qr7yA7Vq',NULL,NULL,NULL,'N;','5d3e686d68432-margaret',NULL,'Margaret','Hamilton','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(18,4,NULL,'5d3e686dd34e6','5d3e686dd34e6','khepburn@shoes-erp.com','khepburn@shoes-erp.com',1,NULL,'$2y$13$r84SHOsOtlZmUwOaHv6OV.gcin/PUoKanvzu2NEOcORcv3v8WwBx2',NULL,NULL,NULL,'N;','5d3e686dd34e6-katharine',NULL,'Katharine','Hepburn','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(19,4,NULL,'5d3e686e49db1','5d3e686e49db1','dparker@shoes-erp.com','dparker@shoes-erp.com',1,NULL,'$2y$13$uBKx4PiZEEZCrTzEQtUIneQqyiUrJtB7OxlpIBQoVVwGgO8VxSvTe',NULL,NULL,NULL,'N;','5d3e686e49db1-dorothy',NULL,'Dorothy','Parker','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(20,4,NULL,'5d3e686eb3e4b','5d3e686eb3e4b','alincoln@shoes-erp.com','alincoln@shoes-erp.com',1,NULL,'$2y$13$RsyuZIHk1RQwQhOHW4KM8OjX/0hEhx1dRsW7fILi2HlDt5yX0dP7G',NULL,NULL,NULL,'N;','5d3e686eb3e4b-abraham',NULL,'Abraham','Lincoln','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(21,4,NULL,'5d3e686f2acd2','5d3e686f2acd2','wdisney@shoes-erp.com','wdisney@shoes-erp.com',1,NULL,'$2y$13$LCyJ0fH2yaff1b1s9Ni8LOzZhKl4gT64deXrj13fiY0HXeLEpiWkK',NULL,NULL,NULL,'N;','5d3e686f2acd2-walt',NULL,'Walt','Disney','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(22,4,NULL,'5d3e686f967ee','5d3e686f967ee','nbonaparte@shoes-erp.com','nbonaparte@shoes-erp.com',1,NULL,'$2y$13$i0CezQyWJY5pbmdN/6HxwerDxc3O3C98UFBgRGsoO53yoGwav.OVq',NULL,NULL,NULL,'N;','5d3e686f967ee-napoleon',NULL,'Napoleon','Bonaparte','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(23,4,NULL,'5d3e68700d823','5d3e68700d823','aelizabeth@shoes-erp.com','aelizabeth@shoes-erp.com',1,NULL,'$2y$13$Ef2o0984avqJAklGGITJOOCV8JDf7cV9Gu/gXCFh0VU2qBtA2v4fK',NULL,NULL,NULL,'N;','5d3e68700d823-abraham',NULL,'Abraham','Elizabeth','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(24,4,NULL,'5d3e687077af3','5d3e687077af3','bfranklin@shoes-erp.com','bfranklin@shoes-erp.com',1,NULL,'$2y$13$K3MMutm8aQfkqRIX5eq2luzZUwze4f/I2rGdOR0heMPXlykzbCJQW',NULL,NULL,NULL,'N;','5d3e687077af3-benjamin',NULL,'Benjamin','Franklin','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1),(25,4,NULL,'5d3e6870e3416','5d3e6870e3416','wbrothers@shoes-erp.com','wbrothers@shoes-erp.com',1,NULL,'$2y$13$fBncA7XwJfpC1NbSK1lM6u9q6X/PtDdgC7LGyAJxeAdpflN0Tme4G',NULL,NULL,NULL,'N;','5d3e6870e3416-wright',NULL,'Wright','Brothers','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2019-07-29 03:30:46',NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-30 20:05:42
