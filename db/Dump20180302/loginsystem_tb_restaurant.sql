-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: loginsystem
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

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
-- Table structure for table `tb_restaurant`
--

DROP TABLE IF EXISTS `tb_restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(45) DEFAULT NULL,
  `restaurant_address1` varchar(45) DEFAULT NULL,
  `restaurant_address2` varchar(45) DEFAULT NULL,
  `restaurant_city` varchar(45) DEFAULT NULL,
  `restaurant_state` varchar(45) DEFAULT NULL,
  `restaurant_zip` varchar(45) DEFAULT NULL,
  `restaurant_cuisine` varchar(45) DEFAULT NULL,
  `restaurant_category` varchar(45) DEFAULT NULL,
  `restaurant_price_range` varchar(45) DEFAULT NULL,
  `restaurant_open_day` varchar(45) DEFAULT NULL,
  `restaurant_close_day` varchar(45) DEFAULT NULL,
  `restaurant_open_hour` varchar(45) DEFAULT NULL,
  `restaurant_close_hour` varchar(45) DEFAULT NULL,
  `restaurant_status` varchar(45) DEFAULT NULL COMMENT 'up_for_share\nsharer\nsharee\nnone',
  `restaurant_owner_ref` int(11) DEFAULT NULL,
  `restaurant_phone` varchar(12) DEFAULT NULL,
  `restaurant_profile_img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_restaurant`
--

LOCK TABLES `tb_restaurant` WRITE;
/*!40000 ALTER TABLE `tb_restaurant` DISABLE KEYS */;
INSERT INTO `tb_restaurant` VALUES (1,'Eaters8','Precinct',NULL,'North Richland Hills','TX','76180','Japanese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL),(10,'Sushiyaa','Downtown','','Dallas','TX','76180','Japanese',NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,NULL,NULL);
/*!40000 ALTER TABLE `tb_restaurant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-02 14:37:22
