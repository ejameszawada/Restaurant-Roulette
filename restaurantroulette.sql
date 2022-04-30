-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: restaurant_roulette
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `cuisines`
--

DROP TABLE IF EXISTS `cuisines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuisines` (
  `cuisine_id` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cuisine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuisines`
--

LOCK TABLES `cuisines` WRITE;
/*!40000 ALTER TABLE `cuisines` DISABLE KEYS */;
INSERT INTO `cuisines` VALUES (1,'Asian'),(2,'Greek'),(4,'Italian'),(5,'Mexican'),(6,'Breakfast'),(7,'Cajun'),(8,'Pizza'),(9,'Indian'),(10,'Hawaiian'),(11,'Burgers and Fries'),(12,'Seafood'),(13,'Fried Chicken'),(14,'Barbecue');
/*!40000 ALTER TABLE `cuisines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eaterytype`
--

DROP TABLE IF EXISTS `eaterytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eaterytype` (
  `eatery_id` int(11) NOT NULL AUTO_INCREMENT,
  `eatery_name` varchar(255) NOT NULL,
  PRIMARY KEY (`eatery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eaterytype`
--

LOCK TABLES `eaterytype` WRITE;
/*!40000 ALTER TABLE `eaterytype` DISABLE KEYS */;
INSERT INTO `eaterytype` VALUES (1,'Restaurant'),(2,'Fast Food'),(3,'CarryOut');
/*!40000 ALTER TABLE `eaterytype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`users_id`),
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price_range` varchar(255) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'Under $10'),(2,'$10-$20'),(3,'$20-$30'),(4,'$30 or more');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recents`
--

DROP TABLE IF EXISTS `recents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recents` (
  `recent_entry` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `date_eaten` date NOT NULL,
  PRIMARY KEY (`recent_entry`),
  KEY `recents_ibfk_1` (`users_id`),
  KEY `recents_ibfk_2` (`restaurant_id`),
  CONSTRAINT `recents_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recents_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recents`
--

LOCK TABLES `recents` WRITE;
/*!40000 ALTER TABLE `recents` DISABLE KEYS */;
/*!40000 ALTER TABLE `recents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `eatery_id` int(11) NOT NULL,
  `website_link` varchar(255) NOT NULL,
  PRIMARY KEY (`restaurant_id`),
  KEY `cuisine_id` (`cuisine_id`),
  KEY `price_id` (`price_id`),
  KEY `eatery_id` (`eatery_id`),
  CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`cuisine_id`),
  CONSTRAINT `restaurants_ibfk_2` FOREIGN KEY (`price_id`) REFERENCES `prices` (`price_id`),
  CONSTRAINT `restaurants_ibfk_3` FOREIGN KEY (`eatery_id`) REFERENCES `eaterytype` (`eatery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,'Jinsei','713 N Lamar Blvd',1,2,1,'https://www.jinseioxford.com/'),(2,'Volta Taverna',' 710 N Lamar Blvd',2,2,1,'https://www.voltataverna.com/'),(3,'Kabuki','1631 Jackson Ave W',1,1,1,'https://www.kabukigourmet.com/'),(6,'Chick-Fil-A','2307 Jackson Ave W',13,1,2,'https://www.chick-fil-a.com/'),(9,'EL Agave','2305 Jackson Ave W #211',5,2,1,'https://www.elagavemexicanrestaurants.com/'),(11,'Tarasque Cucina','1611 Jackson Ave W',4,2,1,'https://www.tarasque.net/'),(12,'Casa Mexicana','1908 Jackson Ave W #4454',5,2,1,'https://www.casamexicanamidsouth.com/'),(21,'Domino\'s','Jackson Avenue',8,2,3,'idk');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'ejzawada','dd9afde0afa7c0362d83d276016058aa7a628693ea1535eecf15cc27196dd5d8836ed939b23b6817deb1e659aa786c1ff224a975c18781b0eec06b09ed14491a',1);
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

-- Dump completed on 2022-04-22 14:11:48
