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
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthDate` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `phoneNo` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `coins` int DEFAULT NULL,
  `profileImg` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`),
  UNIQUE KEY `phoneNo_UNIQUE` (`phoneNo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'JaneLim09','jane@email.com','2003-09-09','F','0126538284','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',118,'profile2.jpg','active'),(2,'nicholasCMX','nicholas@email.com','2003-08-07','M','0126539994','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',100,'profile1.jpg','active'),(3,'nicole01','nicole@gmail.com','2003-09-01','F','0129275994','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',120,'profile3.jpg','active'),(4,'kyan','kyan@gmail.com','2024-09-12','F','0144567897','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',0,'pp.webp','active'),(5,'helloo0000','hi@gmail.com','2024-09-10','M','01376783627','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',0,'profile2.jpg','deactive'),(6,'kyanxxxx','xx@gmail.com','2024-09-14','F','0143551931','$2y$10$5Ahb4COHTwvTA11FA28OdO4/JOGoH8XipKSua4aAt5KJ6VkBwgwEm',1023,'cinemaLogin.jpg','active'),(7,'kelly','kl@gmail.com','2024-09-14','F','01155011079','$2y$10$pl7OfAUUf727.w6m0YSjvuON1LC95Y6sb173g6TASR8WCv98VxtBG',0,'profile1.jpg','active'),(8,'Angeline','angeline@gmail.com','2024-09-02','F','0123456789','$2y$10$9Hs3VGgU1UraTcpWz1oG..iUcY.AV0lKMqSCrbZu6b0idy5IKeYsq',0,'profile3.jpg','active'),(9,'Chong Kah Yan','kahyanchong0803@gmail.com','2024-09-21','F','0129736473','$2y$2y$10$igJDZH94QrGJaLmzAoMxT.NewpIpRje/UIFMUK9cjI3Jx4zmJLAEe',0,NULL,'deactive'),(10,'Christine','chris@gmail.com','2024-09-16','F','01091912837','$2y$10$QTncg4UPy8hmVPnSoXjTLuGNKW1wHcyiwDvms1nikDF5BXLt/ICdi',0,'profile6.jpg','active'),(11,'CHh','kahyanchong0803@gmail.com','2024-09-18','M','0143551934','$2y$10$7At4WLIPSGKO9McRIuYgt.WrjgTWYmhsB.TEKHH5eMmska25kuOkK',0,NULL,'active'),(12,'Chong','kahyanchong0803@gmail.com','2024-09-17','M','0143551935','$2y$10$On14ydFr.HK2KhTycZwgpe.dOSho5YXGBFNppZizOdshAqdSp0ppy',0,NULL,'active'),(13,'Kyin','kyin@gmail.com','2024-09-25','F','01136694832','$2y$10$Y1ibnQm.rKdSEIH.HjQqeOT2yusHPoSFkX7mIpgu0kG2PE8EFrzz2',0,NULL,'active'),(14,'cmt','mt@gmail.com','2024-09-10','F','0123456788','$2y$10$II1w3KdPxMV5bSzhdJJpmOtjgDQXqUevCKi9peBPMXsgHUt40NIOy',0,NULL,'active');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
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

-- Dump completed on 2024-09-22 13:37:44
