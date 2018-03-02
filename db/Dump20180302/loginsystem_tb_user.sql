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
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(45) DEFAULT NULL,
  `user_last_name` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_auth` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (13,'Joseph','Park','joe@gmail.com','$2y$10$mrQQZ4qc8umSTjprrWxl/.g/tX8OS.RhwjiWI24r17WmxnsgXJ8FG',NULL),(14,'sfa','dfas','dddd@gmail.com','$2y$10$FJ3gmwo.pCOV3jVZz4I3OeBwlUFQzn2oeyJEERnJvG7QG.7Nb60Ru',NULL),(15,'dsaf','afs','fsdfsf@sadf','$2y$10$V16ABpO5vyK5VOCiz4cBUuiM4KoNGwadcpl9FzrGAdhXja4bieebO',NULL),(16,'dfsaf','afdfs','fafafs@adfsffs','$2y$10$FlfmUyBj47Uuu1JZTBHeuesjkiyySeImoR86eHFMSPnpvh.GSXJDm',NULL),(17,'fasdfs','adsdfs','asfds@fsafadsfas','$2y$10$SUwrqH5TULUp6UOjN8nFZeZl1rUxU9rXDKLNxbo/z1EWG03csTmka',NULL),(18,'asdfdf','sadfssdf','adsf@adsdfssdf','$2y$10$hdeamF0P2gaGcIU9JPpPwOiQmGaeF9MG98mR9jOM1sKnfu3XjsM1O',NULL),(19,'fadssf','dadsfsdf','jafsfasd@adfsfsaf','$2y$10$BBrntR4JlBbj/LZ7hhTzBeEBvq/lqnHPlChkG6b76Pf6rJusPXGZK',NULL);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
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
