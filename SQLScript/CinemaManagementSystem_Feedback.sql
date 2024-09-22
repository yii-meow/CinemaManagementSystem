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
-- Table structure for table `Feedback`
--

DROP TABLE IF EXISTS `Feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Feedback` (
  `feedbackID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `reply` varchar(200) DEFAULT NULL,
  `coinCompensation` int DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `inProgress_at` datetime DEFAULT NULL,
  `resolved_at` datetime DEFAULT NULL,
  `compensationOffered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Feedback`
--

LOCK TABLES `Feedback` WRITE;
/*!40000 ALTER TABLE `Feedback` DISABLE KEYS */;
INSERT INTO `Feedback` VALUES (1,1,'sasasd',3,NULL,NULL,'Compensation Offered','2024-09-17 11:35:03',NULL,NULL,NULL),(2,1,'sasasdwefwef',2,NULL,NULL,'Compensation Offered','2024-09-17 11:35:03',NULL,NULL,NULL),(3,1,'sasasdwefwef',2,NULL,NULL,'Compensation Offered','2024-09-17 11:35:03',NULL,NULL,NULL),(4,1,'123',1,'wow, i see that ahahahahrgerg 123',0,NULL,'2024-09-17 11:35:03',NULL,NULL,NULL),(5,1,'new record testing',5,'good',NULL,'Compensation Offered','2024-09-19 10:08:04',NULL,NULL,NULL),(6,1,'etstting feedback 2',4,'nice one',325,'Compensation Offered','2024-09-20 07:42:09',NULL,NULL,NULL),(7,1,'tetsing feedback status bar',2,NULL,0,'Compensation Offered','2024-09-20 08:54:56','2024-09-20 08:55:41','2024-09-20 08:56:06','2024-09-20 08:56:32'),(8,6,'it is so nice. i love this',4,NULL,33,'Compensation Offered','2024-09-21 10:27:46',NULL,NULL,NULL),(9,6,'0p\'0\'',4,NULL,123,'Compensation Offered','2024-09-21 10:39:20','2024-09-21 11:37:44','2024-09-21 11:38:10','2024-09-21 11:38:10'),(10,6,'thgxdf',5,NULL,0,'Compensation Offered','2024-09-21 10:39:33','2024-09-21 10:50:43','2024-09-21 10:50:53','2024-09-21 10:51:03'),(11,6,'123',2,NULL,123,'Compensation Offered','2024-09-21 10:40:56',NULL,NULL,NULL),(12,6,'testing wefwefqerwq',4,'wow, thank you for ur support',242,'Compensation Offered','2024-09-21 10:45:09','2024-09-21 10:49:00',NULL,NULL),(13,6,'12352',4,NULL,244,'Compensation Offered','2024-09-21 11:45:11','2024-09-21 11:45:33','2024-09-21 11:45:49','2024-09-21 11:45:49'),(14,6,'dqwdqwd',2,NULL,244,'Compensation Offered','2024-09-21 11:47:37','2024-09-21 11:48:39','2024-09-21 11:49:06','2024-09-21 11:49:06'),(15,6,'ewerwer',3,NULL,100,'Compensation Offered','2024-09-21 11:50:26','2024-09-21 11:50:49','2024-09-21 11:51:05','2024-09-21 11:51:05'),(16,6,'eewqeqwe',3,NULL,23,'Compensation Offered','2024-09-21 11:52:40','2024-09-21 11:53:16','2024-09-21 11:53:30','2024-09-21 11:53:30'),(17,6,'testing new feedback',2,NULL,300,'Compensation Offered','2024-09-22 07:29:03','2024-09-22 07:31:14','2024-09-22 07:33:22','2024-09-22 07:33:22'),(18,6,'1231eq',3,NULL,200,'Compensation Offered','2024-09-22 07:34:51','2024-09-22 07:35:10','2024-09-22 07:35:28','2024-09-22 07:35:28');
/*!40000 ALTER TABLE `Feedback` ENABLE KEYS */;
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

-- Dump completed on 2024-09-22 13:37:38
