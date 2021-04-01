-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: fw2
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
  `session_id` varchar(45) NOT NULL,
  `date_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cart_goods_id_fk` (`product_id`),
  CONSTRAINT `cart_goods_id_fk` FOREIGN KEY (`product_id`) REFERENCES `goods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,1,3,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:44:18'),(2,8,1,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:44:43'),(3,7,1,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:46:37'),(4,6,1,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:47:16'),(5,5,1,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:47:26'),(6,1,1,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:51:32'),(7,7,2,'4s9u8u0sm0glgeunrcbj4e3jcbadq5i8','2021-04-01 13:53:06');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Good 1',100,1,'Описание товара 1',1,'product_1001.jpg'),(2,'Good 2',120,2,'Описание товара 2',1,'product_1002.jpg'),(3,'Good 3',48,2,'Описание товара 3',1,'product_1003.jpg'),(4,'Good 4',100500,2,'Описание товара 4',1,'product_1004.jpg'),(5,'Good 5',2001,3,'Описание товара 5',4,'product_1005.jpg'),(6,'Good 6',1020,4,'Описание товара 6',1,'product_1006.jpg'),(7,'Good 7',1,4,'Описание товара 7',1,'product_1007.jpg'),(8,'Good 8',800,5,'Описание товара 8',1,'product_1008.jpg');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (27,'aaNmae','aa@aa.a','13124235346','aa','$2y$10$IkhPG6S41xVyiAEP4ObZCemj81jVhgkF4hhVcQ1.mdMGvsE3.WLZ2',0,'2021-03-24 13:58:01'),(28,'aaNmae','aa@aa.aa','131242353461','aaa','$2y$10$k51v2oW4BBfJ64Jf47DgO.TyQ7CSZJuqopakda/cIYe2tcXSxEqRy',0,'2021-03-24 13:59:10'),(29,'ssname','ss@ss.s','79869675745','ss','$2y$10$GK6P5HtzcN1FqbF4ny.QVuOB0TwmXoXBf.CRCyFxOeBkM7dafj3m6',0,'2021-03-24 14:02:15'),(30,'vvname','vv@v.v','34567890','vv','$2y$10$FpngshoqEJdBtnHAqkNkw.HzQ8F3./FvfR9lasrkbWCO91GUc6fIC',0,'2021-03-24 14:06:39'),(31,'vvname','vv@v.vv','345678905','vvv','$2y$10$RqTwzfNGP9oTdrUVQ4lRc.e84Ddwbcw6wwJTK41Iub89NzJRJtS.6',0,'2021-03-24 14:12:04'),(32,'xxn','xx@x.x','123143124','xx','$2y$10$Oar.QDmhtQfd2hHTgHQCeO8o5NVtW4qHuoVkwXTN9U4/CBjZbbbOS',0,'2021-03-24 14:20:18'),(33,'xxn','xx@x.xx','123143124435','xxx','$2y$10$vgbBSuHc9eSZXEXHKIvk..RD0y3IPjhEXWYIdrICr7RHCpqc9IiSK',0,'2021-03-24 14:36:46'),(34,'ppName','pp@pp.p','254678098','ppp','$2y$10$oNRfNbaaNXeXbZG4n37RWuHIGrRCZAWOy1JtRWm2CpdGMBfDlTGaS',0,'2021-03-24 14:38:59'),(35,'qq','qq@qq.q','32526534','qq','$2y$10$vYHQt.vTGhEzi9AWmsm/Qe03rKcBPudJCGS6wiKAmj5lXtsmVCwnu',0,'2021-03-25 14:53:36');
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

-- Dump completed on 2021-04-01 17:21:58
