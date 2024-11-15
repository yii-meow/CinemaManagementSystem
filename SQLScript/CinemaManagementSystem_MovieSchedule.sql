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
-- Table structure for table `MovieSchedule`
--

DROP TABLE IF EXISTS `MovieSchedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MovieSchedule` (
  `movieScheduleId` int NOT NULL AUTO_INCREMENT,
  `startingTime` datetime DEFAULT NULL,
  `movieId` int NOT NULL,
  `cinemaHallId` int NOT NULL,
  PRIMARY KEY (`movieScheduleId`),
  UNIQUE KEY `movieScheduleId_UNIQUE` (`movieScheduleId`),
  KEY `movieId_idx` (`movieId`),
  KEY `cinemaHallId_idx` (`cinemaHallId`),
  CONSTRAINT `cinemaHallId` FOREIGN KEY (`cinemaHallId`) REFERENCES `CinemaHall` (`hallId`),
  CONSTRAINT `movieId` FOREIGN KEY (`movieId`) REFERENCES `Movie` (`movieId`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MovieSchedule`
--

LOCK TABLES `MovieSchedule` WRITE;
/*!40000 ALTER TABLE `MovieSchedule` DISABLE KEYS */;
INSERT INTO `MovieSchedule` VALUES (1,'2024-09-13 11:00:00',1,1),(2,'2024-09-13 10:00:00',2,2),(3,'2024-09-13 10:00:00',3,3),(4,'2024-09-13 10:00:00',4,4),(5,'2024-09-13 10:00:00',5,5),(6,'2024-09-13 10:00:00',6,6),(7,'2024-09-14 01:30:00',1,7),(8,'2024-09-14 12:30:00',7,8),(9,'2024-09-14 12:30:00',8,9),(10,'2024-09-14 12:30:00',9,10),(11,'2024-09-14 12:30:00',10,11),(12,'2024-09-14 11:30:00',1,12),(13,'2024-09-15 15:00:00',11,13),(14,'2024-09-15 15:00:00',12,14),(15,'2024-09-15 15:00:00',13,15),(16,'2024-09-15 15:00:00',14,16),(17,'2024-09-15 15:00:00',15,17),(18,'2024-09-15 15:00:00',1,18),(19,'2024-09-16 18:30:00',19,19),(20,'2024-09-16 18:30:00',20,20),(21,'2024-09-16 18:30:00',21,21),(22,'2024-09-16 18:30:00',22,22),(23,'2024-09-16 18:30:00',23,23),(24,'2024-09-16 18:30:00',1,24),(25,'2024-09-17 20:45:00',24,25),(26,'2024-09-17 20:45:00',25,26),(27,'2024-09-17 20:45:00',24,27),(28,'2024-09-17 20:45:00',21,28),(29,'2024-09-17 20:45:00',22,29),(30,'2024-09-17 20:45:00',1,30),(31,'2024-09-13 10:00:00',20,1),(32,'2024-09-13 10:00:00',21,2),(33,'2024-09-13 10:00:00',2,3),(34,'2024-09-13 10:00:00',3,4),(35,'2024-09-13 10:00:00',4,5),(36,'2024-09-13 12:00:00',1,2),(37,'2024-09-13 13:00:00',1,3),(38,'2024-09-13 14:00:00',1,20),(39,'2024-09-13 15:00:00',1,7),(40,'2024-09-13 16:00:00',1,16),(41,'2024-09-15 03:45:00',1,5),(42,'2024-09-15 20:00:00',1,18),(43,'2024-09-15 20:00:00',1,1),(44,'2024-09-15 22:00:00',2,3),(45,'2024-09-15 23:00:00',1,13),(46,'2024-09-16 12:30:00',1,2),(59,'2024-09-16 12:45:00',1,6),(60,'2024-09-16 15:45:00',2,6),(61,'2024-09-16 11:45:00',5,30),(62,'2024-09-16 11:15:00',7,18),(63,'2024-09-16 18:45:00',10,30),(64,'2024-09-16 10:45:00',11,6),(65,'2024-09-16 19:45:00',11,6),(66,'2024-09-17 10:45:00',15,6),(67,'2024-09-17 11:30:00',4,6),(68,'2024-09-17 14:45:00',4,6),(69,'2024-09-17 16:45:00',7,6),(70,'2024-09-17 19:45:00',1,6),(71,'2024-09-17 23:45:00',5,6),(72,'2024-09-17 19:45:00',11,6),(73,'2024-09-18 10:45:00',1,2),(74,'2024-09-22 19:45:00',1,5),(75,'2024-09-21 19:45:00',1,12),(76,'2024-09-16 23:40:00',11,6),(77,'2024-09-16 16:30:00',11,6),(78,'2024-09-16 22:21:00',2,6),(79,'2024-09-16 12:20:00',3,6),(80,'2024-09-16 21:40:00',9,12),(81,'2024-09-17 22:40:00',13,12),(82,'2024-09-17 22:56:00',17,8),(83,'2024-09-17 02:00:00',4,8),(84,'2024-09-17 10:55:00',4,8),(85,'2024-09-16 23:45:00',8,8),(86,'2024-09-18 14:36:00',17,6),(87,'2024-09-17 17:36:00',1,24),(88,'2024-09-18 15:14:00',6,19),(89,'2024-09-25 15:45:00',15,6),(90,'2024-09-20 16:12:00',3,30),(91,'2024-09-26 17:00:00',2,33),(92,'2024-09-19 23:30:00',5,32),(93,'2024-09-20 14:09:00',11,33),(94,'2024-09-21 18:45:00',2,33),(95,'2024-09-20 20:00:00',22,33),(96,'2024-09-20 22:00:00',22,33),(97,'2024-09-20 23:00:00',24,23),(98,'2024-09-21 12:00:00',16,33),(99,'2024-09-21 17:40:00',21,36),(100,'2024-09-27 11:50:00',3,33),(101,'2024-09-21 19:20:00',1,40),(102,'2024-09-21 16:30:00',3,40),(103,'2024-09-21 19:50:00',15,6),(105,'2024-09-21 23:30:00',15,6),(106,'2024-09-30 02:21:00',41,38);
/*!40000 ALTER TABLE `MovieSchedule` ENABLE KEYS */;
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

-- Dump completed on 2024-09-22 13:37:01
