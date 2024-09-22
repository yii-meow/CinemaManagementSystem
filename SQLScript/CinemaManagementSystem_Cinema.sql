-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com    Database: CinemaManagementSystem
-- ------------------------------------------------------
-- Server version	8.0.35

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `Cinema`
--

DROP TABLE IF EXISTS `Cinema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cinema` (
  `cinemaId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `openingHours` varchar(255) NOT NULL,
  PRIMARY KEY (`cinemaId`),
  UNIQUE KEY `cinemaId_UNIQUE` (`cinemaId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cinema`
--

LOCK TABLES `Cinema` WRITE;
/*!40000 ALTER TABLE `Cinema` DISABLE KEYS */;
INSERT INTO `Cinema` VALUES (1,'Suria KLCC','Klcc Twin Towers, Level 3, Suria, Kuala Lumpur City Centre, 50088 Kuala Lumpur, Wilayah Persekutuan.',' Kuala Lumpur City Centre','Kuala Lumpur','1000-2200'),(2,'Mines','L3-76, Level 3, The Mines, 1, Jalan Dulang, Mines Wellness City, 43300 Seri Kembangan, Selangor','Seri Kembangan','Selangor','1000-2200'),(3,'Wangsa Walk','2-01, Level 2 Wangsa Walk Mall, Wangsa Avenue, 9, Jalan Wangsa Perdana 1, Bandar Wangsa Maju, 53300 Kuala Lumpur, Wilayah Persekutuan','Bandar Wangsa Maju','Kuala Lumpur','1000-2200'),(4,'Seremban 2','S02, 2nd Floor, AEON Seremban 2 Shopping Centre, 112, Persiaran S2 B1, Seremban 2, 70300 Seremban, Negeri Sembilan','Seremban 2','Negeri Sembilan','1000-2200'),(5,'Kulai','801, Persiaran Indahpura Utama, Bandar Indahpura, 81000 Kulai, Johor','Kulai','Johor','1000-2200'),(6,'Bukit Mertajam','Lot No. 30908, AEON, Jalan Rozhan, 14000 Bukit Mertajam, Pulau Pinang','Bukit Mertajam','Pulau Pinang','1000-2200'),(7,'Pavilion Bukit Jalil','Pavilion Bukit Jalil','Kuala Lumpur','Kuala Lumpur','0800-2300'),(12,'Pavilion Bukit Bintang','Pavilion Bukit Bintang','Bukit Bintang','Kuala Lumpur','1000-2300'),(13,'Melawati Mall','Melawati Mall','Setapak','Kuala Lumpur','1100-2300'),(14,'Mid Valley','Mid Valley','Kuala Lumpur','Kuala Lumpur','0830-0000'),(15,'IOI Mall','IOI Mall','Puchong','Selangor','1030-0245'),(16,'IOI City Mall','IOI City Mall','Kuala Lumpur','Kuala Lumpur','2155-1530'),(17,'Pavilion Damansara','Pavilion Damansara','Damansara','Kuala Lumpur','1040-0430'),(18,'Eko Cheras Mall','Eko Cheras','Kuala Lumpur','Kuala Lumpur','0845-0230'),(19,'AEON Bukit Tinggi','AEON Bukit Tinggi','Klang','Selangor','0845-0440'),(20,'Setia Walk','Setia Walk','Puchong','Selangor','0850-0330');
/*!40000 ALTER TABLE `Cinema` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-22 13:37:25
