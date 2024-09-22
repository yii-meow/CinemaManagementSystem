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
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Post` (
  `postID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `contentImg` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`postID`),
  KEY `userID` (`userID`),
  CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `User` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (54,1,'Please watch this movie','2024-09-14 15:51:11','/storage/uploads/222568c9606ac3685244e466a568ae5d_postImg1.jpg','Approved'),(65,4,'dscvfbgh','2024-09-16 23:17:15',NULL,'Approved'),(69,1,'hhhhh','2024-09-17 05:03:29',NULL,'Approved'),(71,1,'recommended','2024-09-17 05:06:09','/storage/uploads/86a37d1119540b0278d833c2e6b06a08_mainMovie_1.jpg','Approved'),(74,1,'非常推荐','2024-09-18 02:03:51','/storage/uploads/86a37d1119540b0278d833c2e6b06a08_mainMovie_1.jpg','Approved'),(75,1,'terima kasih','2024-09-18 02:04:32',NULL,'Approved'),(76,1,'Esta pelicula es recomendable','2024-09-18 02:05:05',NULL,'Approved'),(78,1,'hahahaa','2024-09-18 04:33:49','/storage/uploads/222568c9606ac3685244e466a568ae5d_postImg1.jpg','Reported'),(80,1,'oiuhruiwefw','2024-09-18 04:53:24','/storage/uploads/3f9075e9231733b27c3e8f00e81ae5d3_profile5.jpg','Reported'),(81,1,'coffee','2024-09-18 05:11:54','/storage/uploads/3f9075e9231733b27c3e8f00e81ae5d3_profile5.jpg','Approved'),(82,1,'recommended','2024-09-18 05:33:59','/storage/uploads/3f9075e9231733b27c3e8f00e81ae5d3_profile5.jpg','Approved'),(83,1,'Go watch this!!','2024-09-18 10:35:37','/storage/uploads/aea76520d2ffb14214912ee224d38933_Cafe-Owners.png','Approved'),(84,8,'Deadpool is recommended to watch!!','2024-09-18 11:09:25','/storage/uploads/222568c9606ac3685244e466a568ae5d_postImg1.jpg','Approved'),(85,8,'Can\'t wait to the movie day','2024-09-18 13:00:25',NULL,'Approved'),(86,8,'hahahaa','2024-09-18 13:04:13',NULL,'Reported'),(87,8,'I\'m so excited','2024-09-18 13:04:29',NULL,'Approved'),(88,8,'I like this movie a lot!!','2024-09-18 15:31:37','/storage/uploads/86a37d1119540b0278d833c2e6b06a08_mainMovie_1.jpg','Approved'),(90,8,'omg','2024-09-18 15:48:21',NULL,'Approved'),(91,8,'Esta pelicula es recomendable','2024-09-18 15:50:02',NULL,'Approved'),(92,8,'content','2024-09-18 15:50:25','/storage/uploads/3f9075e9231733b27c3e8f00e81ae5d3_profile5.jpg','Approved'),(94,8,'sssss','2024-09-18 15:59:38',NULL,'Approved'),(95,10,'This movie so amazing!','2024-09-19 08:53:54','/storage/uploads/58bb070a12cdcc0f868ee74a8ae44456_cinemaLogin.jpg','Approved'),(96,10,'The entire experience in the cinema was great','2024-09-19 08:54:22',NULL,'Approved'),(97,8,'Interesting','2024-09-21 03:00:26','/storage/uploads/07f0ca55ef88c7e27000946ba2ef22cd_th.jpg','Approved'),(100,8,'baik','2024-09-21 19:06:45',NULL,'Approved');
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
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

-- Dump completed on 2024-09-22 13:38:46
