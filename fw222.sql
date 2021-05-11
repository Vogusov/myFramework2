-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: fw2
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `user_id` int DEFAULT NULL,
  `session_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cart_goods_id_fk` (`product_id`),
  KEY `cart_users_id_fk` (`user_id`),
  CONSTRAINT `cart_goods_id_fk` FOREIGN KEY (`product_id`) REFERENCES `goods` (`id`),
  CONSTRAINT `cart_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (42,2,2,NULL,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-06 17:34:28'),(47,1,4,36,NULL,'2021-04-16 18:16:16'),(48,2,2,36,NULL,'2021-04-17 11:26:27');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL,
  `name` varchar(222) NOT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'Category 1',0),(2,1,'Category 2',1),(3,1,'Category 3',1),(4,1,'Category 4',0),(5,1,'Category 5',2),(6,1,'Category 6',5);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(111) NOT NULL,
  `price` int NOT NULL,
  `category` int NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` int NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_img_uindex` (`img`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Good 1',100,1,'Описание товара 1',1,'product_1001.jpg','0'),(2,'Good 2',120,2,'Описание товара 2',1,'product_1002.jpg','0'),(3,'Good 3',48,2,'Описание товара 3',1,'product_1003.jpg','0'),(4,'Good 4',100500,2,'Описание товара 4',1,'product_1004.jpg','0'),(5,'Good 5',2001,3,'Описание товара 5',4,'product_1005.jpg','0'),(6,'Good 6',1020,4,'Описание товара 6',1,'product_1006.jpg','0'),(7,'Good 7',1,4,'Описание товара 7',1,'product_1007.jpg','0'),(8,'Good 8',800,5,'Описание товара 8',1,'product_1008.jpg','1');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `additional_info` varchar(2400) DEFAULT NULL COMMENT 'Дополнительная информация, которую может добавить покупатель при оформлении заказа по своему желанию',
  `date_time_formed` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_users_fk` (`user_id`),
  CONSTRAINT `orders_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,37,'abeabaebn','2021-04-17 16:50:53'),(5,37,'swvgr','2021-04-17 17:17:05'),(7,37,'jagit','2021-04-20 12:37:14'),(9,37,'','2021-04-22 14:11:57'),(22,38,'test my order','2021-04-23 10:32:48'),(23,2,'Best regards','2021-05-10 10:34:37');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_products` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `orders_products_products_id_fk` (`product_id`),
  CONSTRAINT `orders_products_orders_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `orders_products_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` VALUES (2,1,2,'2021-04-17 16:50:54'),(2,6,2,'2021-04-17 16:50:54'),(5,1,3,'2021-04-17 17:17:05'),(5,6,3,'2021-04-17 17:17:05'),(7,2,6,'2021-04-20 12:37:14'),(22,1,4,'2021-04-23 10:32:48'),(22,2,7,'2021-04-23 10:32:48'),(23,2,19,'2021-05-10 10:34:37');
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Главная'),(2,'О Магазине'),(3,'Каталог');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'admin','admin@admin.ru','4964040','admin','$2y$10$RU5llEv8w/ELpQcwEqvDI.H2CPcIRgDBaJCwZIykwI0y5sADHkf9.',1,'2021-04-23 13:36:26'),(27,'aaNmae','aa@aa.a','13124235346','aa','$2y$10$IkhPG6S41xVyiAEP4ObZCemj81jVhgkF4hhVcQ1.mdMGvsE3.WLZ2',0,'2021-03-24 13:58:01'),(28,'aaNmae','aa@aa.aa','131242353461','aaa','$2y$10$k51v2oW4BBfJ64Jf47DgO.TyQ7CSZJuqopakda/cIYe2tcXSxEqRy',0,'2021-03-24 13:59:10'),(29,'ssname','ss@ss.s','79869675745','ss','$2y$10$GK6P5HtzcN1FqbF4ny.QVuOB0TwmXoXBf.CRCyFxOeBkM7dafj3m6',0,'2021-03-24 14:02:15'),(30,'vvname','vv@v.v','34567890','vv','$2y$10$FpngshoqEJdBtnHAqkNkw.HzQ8F3./FvfR9lasrkbWCO91GUc6fIC',0,'2021-03-24 14:06:39'),(31,'vvname','vv@v.vv','345678905','vvv','$2y$10$RqTwzfNGP9oTdrUVQ4lRc.e84Ddwbcw6wwJTK41Iub89NzJRJtS.6',0,'2021-03-24 14:12:04'),(32,'xxn','xx@x.x','123143124','xx','$2y$10$Oar.QDmhtQfd2hHTgHQCeO8o5NVtW4qHuoVkwXTN9U4/CBjZbbbOS',0,'2021-03-24 14:20:18'),(33,'xxn','xx@x.xx','123143124435','xxx','$2y$10$vgbBSuHc9eSZXEXHKIvk..RD0y3IPjhEXWYIdrICr7RHCpqc9IiSK',0,'2021-03-24 14:36:46'),(34,'ppName','pp@pp.p','254678098','ppp','$2y$10$oNRfNbaaNXeXbZG4n37RWuHIGrRCZAWOy1JtRWm2CpdGMBfDlTGaS',0,'2021-03-24 14:38:59'),(35,'qq','qq@qq.q','32526534','qq','$2y$10$vYHQt.vTGhEzi9AWmsm/Qe03rKcBPudJCGS6wiKAmj5lXtsmVCwnu',0,'2021-03-25 14:53:36'),(36,'op','op@op.op','4277587','op','$2y$10$1Y9AAAi6SBNuiTh4KADEZO3ORIapTnGNdVu.jgTE/3PVok6KWQEt6',0,'2021-04-16 21:15:18'),(37,'cv','cv@cv.cv','124254536476','cv','$2y$10$PZpzgPvbH1FInXARhLydyOYf7zbncM/i0YvootYYj6jy4bvsbZbOW',0,'2021-04-17 18:11:42'),(38,'testName','test@test.test','990088778898','test','$2y$10$hDqkmU3t5MlAN7321SHRSuzzSwxMJBAjt05aFKvyx5jE4htqzNfby',0,'2021-04-23 13:31:34');
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

-- Dump completed on 2021-05-10 15:41:51
