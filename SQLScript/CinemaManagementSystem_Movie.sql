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
-- Table structure for table `Movie`
--

DROP TABLE IF EXISTS `Movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Movie` (
  `movieId` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `trailerLink` varchar(255) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `catagory` varchar(255) DEFAULT NULL,
  `releaseDate` datetime DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `subtitles` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `casts` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `classification` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`movieId`),
  UNIQUE KEY `movieId_UNIQUE` (`movieId`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='A table that stores all movie details ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Movie`
--

LOCK TABLES `Movie` WRITE;
/*!40000 ALTER TABLE `Movie` DISABLE KEYS */;
INSERT INTO `Movie` VALUES (1,'Twilight of the Warriors: Walled In','/assets/images/movies/PywbVPeIhBFc33QXktnhMaysmL.jpg','https://www.youtube.com/embed/4kBU6Rff26A?si=ujtSvEYsIpxVdgqk',125,'Action, Adventure, Crime, Thriller','2024-04-23 00:00:00','cn','English','Soi Cheang','Aaron Kwok, Louis Koo, Richie Jen, Kenny Wong Tak-Ban, Sammo Hung','Set in the 1980s, troubled youth Chan Lok-kwun accidentally enter the Walled City, discovers the order amidst its chaos, and learns important life lessons along the way. In the Walled City, he becomes close friends with Shin, Twelfth Master and AV. Under','PG','Now Showing'),(2,'Inside Out 2','/assets/images/movies/vpnVM9B6NMmQpWeZvzLvDESb2QY.jpg','https://www.youtube.com/embed/u69y5Ie519M',97,'Animation, Family, Adventure, Comedy','2024-06-11 00:00:00','en','English','Kelsey Mann','Amy Poehler, Maya Hawke, Kensington Tallman, Liza Lapira, Tony Hale','Teenager Riley\'s mind headquarters is undergoing a sudden demolitions to make room for something entirely unexpected: new Emotions! Joy, Sadness, Anger, Fear and Disgust, who’ve long been running a successful operation by all accounts, aren’t sure how to ','PG','Released'),(3,'Borderlands','/assets/images/movies/865DntZzOdX6rLMd405R0nFkLmL.jpg','https://www.youtube.com/embed/Icnysn53neU',101,'Action, Science Fiction, Comedy, Adventure, Thriller, Fantasy','2024-08-07 00:00:00','en','English','Eli Roth','Cate Blanchett, Kevin Hart, Edgar Ramírez, Jamie Lee Curtis, Ariana Greenblatt','Returning to her home planet, an infamous bounty hunter forms an unexpected alliance with a team of unlikely heroes. Together, they battle monsters and dangerous bandits to protect a young girl who holds the key to unimaginable power.','PG','Coming Soon'),(4,'Despicable Me 4','/assets/images/movies/wWba3TaojhK7NdycRhoQpsG0FaH.jpg','https://www.youtube.com/embed/LtNYaH61dXY',94,'Animation, Family, Comedy, Action','2024-06-20 00:00:00','en','English','Chris Renaud','Steve Carell, Kristen Wiig, Will Ferrell, Sofía Vergara, Miranda Cosgrove','Gru and Lucy and their girls—Margo, Edith and Agnes—welcome a new member to the Gru family, Gru Jr., who is intent on tormenting his dad. Gru also faces a new nemesis in Maxime Le Mal and his femme fatale girlfriend Valentina, forcing the family to go on ','PG','Coming Soon'),(5,'Beetlejuice Beetlejuice','/assets/images/movies/kKgQzkUCnQmeTPkyIwHly2t6ZFI.jpg','https://www.youtube.com/embed/As-vKW4ZboU',105,'Comedy, Horror, Fantasy, Mystery','2024-09-04 00:00:00','en','English','Tim Burton','Michael Keaton, Winona Ryder, Catherine O\'Hara, Jenna Ortega, Justin Theroux','After a family tragedy, three generations of the Deetz family return home to Winter River. Still haunted by Beetlejuice, Lydia\'s life is turned upside down when her teenage daughter, Astrid, accidentally opens the portal to the Afterlife.','PG','Released'),(6,'Trap','/assets/images/movies/jwoaKYVqPgYemFpaANL941EF94R.jpg','https://www.youtube.com/embed/mps1HbpECIA',105,'Crime, Thriller','2024-07-31 00:00:00','en','English','M. Night Shyamalan','Josh Hartnett, Ariel Donoghue, Saleka, Alison Pill, Hayley Mills','A father and teen daughter attend a pop concert, where they realize they\'re at the center of a dark and sinister event.','PG','Released'),(7,'Twisters','/assets/images/movies/pjnD08FlMAIXsfOLKQbvmO0f0MD.jpg','https://www.youtube.com/embed/AZbEi95SuMg',123,'Action, Adventure, Thriller','2024-07-10 00:00:00','en','English','Lee Isaac Chung','Daisy Edgar-Jones, Glen Powell, Anthony Ramos, Brandon Perea, Maura Tierney','As storm season intensifies, the paths of former storm chaser Kate Carter and reckless social-media superstar Tyler Owens collide when terrifying phenomena never seen before are unleashed. The pair and their competing teams find themselves squarely in the','PG','Released'),(8,'Beetlejuice','/assets/images/movies/nnl6OWkyPpuMm595hmAxNW3rZFn.jpg','https://www.youtube.com/embed/po1HJbmow0g',92,'Fantasy, Comedy','1988-03-30 00:00:00','en','English','Tim Burton','Alec Baldwin, Geena Davis, Winona Ryder, Catherine O\'Hara, Jeffrey Jones','A newly dead New England couple seeks help from a deranged demon exorcist to scare an affluent New York family out of their home.','PG','Released'),(9,'The Union','/assets/images/movies/d9CTnTHip1RbVi2OQbA2LJJQAGI.jpg','https://www.youtube.com/embed/vea9SdnRMyg',109,'Action, Comedy','2024-08-15 00:00:00','en','English','Julian Farino','Mark Wahlberg, Halle Berry, J.K. Simmons, Mike Colter, Adewale Akinnuoye-Agbaje','A New Jersey construction worker goes from regular guy to aspiring spy when his long-lost high school sweetheart recruits him for an espionage mission.','PG','Coming Soon'),(10,'The Killer','/assets/images/movies/6PCnxKZZIVRanWb710pNpYVkCSw.jpg','https://www.youtube.com/embed/gNOS5ofQhw',126,'Action, Thriller, Crime','2024-08-22 00:00:00','en','English','John Woo','Nathalie Emmanuel, Omar Sy, Sam Worthington, Diana Silvers, Saïd Taghmaoui','Zee is a feared contract killer known as \"the Queen of the Dead,\" but when she refuses to murder a young blind woman, she finds herself hunted both by criminal colleagues and a determined police detective.','PG','Released'),(11,'Kill','/assets/images/movies/m2zXTuNPkywdYLyWlVyJZW2QOJH.jpg','https://www.youtube.com/embed/da7lKeeS67c',105,'Action, Crime','2024-07-03 00:00:00','hi','English','Nikhil Nagesh Bhat','Lakshya Lalwani, Raghav Juyal, Tanya Maniktala, Abhishek Chauhan, Ashish Vidhyarthi','When an army commando finds out his true love is engaged against her will, he boards a New Dehli-bound train in a daring quest to derail the arranged marriage. But when a gang of knife-wielding thieves begin to terrorize innocent passengers on his train, ','PG','Released'),(12,'Gunner','/assets/images/movies/eEkAY5veAnwxUOOlpF62KawkFO9.jpg','https://www.youtube.com/embed/0PEOojf2ghQ',90,'Action, Thriller, Crime','2024-08-16 00:00:00','en','English','Dimitri Logothetis','Luke Hemsworth, Morgan Freeman, Joseph Baena, Maurice P. Kerry, Mykel Shannon Jenkins','While on a camping trip in order to reconnect, war veteran Colonel Lee Gunner must save his two sons from a gang of violent bikers when they\'re kidnapped after accidentally stumbling upon to a massive drug operation.','PG','Now Showing'),(13,'Alien: Romulus','/assets/images/movies/b33nnKl1GSFbao4l3fZDDqsMx0F.jpg','https://www.youtube.com/embed/x0XDEhP4MQs',119,'Horror, Science Fiction','2024-08-13 00:00:00','en','English','Fede Álvarez','Cailee Spaeny, David Jonsson, Archie Renaux, Isabela Merced, Spike Fearn','While scavenging the deep ends of a derelict space station, a group of young space colonizers come face to face with the most terrifying life form in the universe.','PG','Released'),(14,'It Ends with Us','/assets/images/movies/4TzwDWpLmb9bWJjlN3iBUdvgarw.jpg','https://www.youtube.com/embed/r-GQvSc5ZGw',131,'Romance, Drama','2024-08-07 00:00:00','en','English','Justin Baldoni','Blake Lively, Justin Baldoni, Brandon Sklenar, Jenny Slate, Hasan Minhaj','When a woman\'s first love suddenly reenters her life, her relationship with a charming, but abusive neurosurgeon is upended, and she realizes she must learn to rely on her own strength to make an impossible choice for her future.','PG','Released'),(15,'Longlegs','/assets/images/movies/5aj8vVGFwGVbQQs26ywhg4Zxk2L.jpg','https://www.youtube.com/embed/6hlDgMrYUmc',101,'Crime, Horror, Thriller','2024-07-10 00:00:00','en','English','Osgood Perkins','Maika Monroe, Nicolas Cage, Blair Underwood, Alicia Witt, Michelle Choi-Lee','FBI Agent Lee Harker is assigned to an unsolved serial killer case that takes an unexpected turn, revealing evidence of the occult. Harker discovers a personal connection to the killer and must stop him before he strikes again.','PG','Released'),(16,'Harold and the Purple Crayon','/assets/images/movies/dEsuQOZwdaFAVL26RjgjwGl9j7m.jpg','https://www.youtube.com/embed/-itXhXgatsI',90,'Adventure, Family, Fantasy, Comedy','2024-07-31 00:00:00','en','English','Carlos Saldanha','Zachary Levi, Lil Rel Howery, Zooey Deschanel, Benjamin Bottani, Tanya Reynolds','Inside of his book, adventurous Harold can make anything come to life simply by drawing it. After he grows up and draws himself off the book\'s pages and into the physical world, Harold finds he has a lot to learn about real life.','PG','Now Showing'),(17,'Jackpot!','/assets/images/movies/fOsamTFIyGxjw1jLSKdZYxQBJOT.jpg','https://www.youtube.com/embed/W7pIYtpp50',107,'Comedy, Science Fiction','2024-08-13 00:00:00','en','English','Paul Feig','Awkwafina, John Cena, Simu Liu, Ayden Mayeri, Donald Watkins','In the near future, a \'Grand Lottery\' has been established - the catch: kill the winner before sundown to legally claim their multi-billion dollar jackpot. When Katie Kim mistakenly finds herself with the winning ticket, she reluctantly joins forces with ','PG','Released'),(18,'Saving Bikini Bottom: The Sandy Cheeks Movie','/assets/images/movies/30YnfZdMNIV7noWLdvmcJS0cbnQ.jpg','https://www.youtube.com/embed/Ud6-SGnzH3k',87,'Animation, Comedy, Adventure, Family','2024-08-01 00:00:00','en','English','Liza Johnson','Carolyn Lawrence, Tom Kenny, Clancy Brown, Bill Fagerbakke, Mr. Lawrence','When Bikini Bottom is scooped from the ocean, scientific squirrel Sandy Cheeks and her pal SpongeBob SquarePants saddle up for Texas to save their town.','PG','Coming Soon'),(19,'Untamed Royals','/assets/images/movies/iEe9RODlNgobupiksZ2vE4TZwUg.jpg','https://www.youtube.com/embed/9WBRP3BdRLY',99,'Thriller, Crime, Drama','2024-08-27 00:00:00','es','English','Humberto Hinojosa','Alfonso Herrera, Ximena Lamadrid, Fernando Cattori, Juan Pablo Fuentes, Renata Manterola','A group of wealthy teenagers commit crimes that escalate from petty mischief to dangerous plots, causing chaotic consequences — but not for themselves.','PG','Coming Soon'),(20,'The Garfield Movie','/assets/images/movies/p6AbOJvMQhBmffd0PIv0u8ghWeY.jpg','https://www.youtube.com/embed/yk2Ej59DnrE',101,'Animation, Comedy, Family, Adventure, Action','2024-04-30 00:00:00','en','English','Mark Dindal','Chris Pratt, Samuel L. Jackson, Hannah Waddingham, Ving Rhames, Nicholas Hoult','Garfield, the world-famous, Monday-hating, lasagna-loving indoor cat, is about to have a wild outdoor adventure! After an unexpected reunion with his long-lost father – scruffy street cat Vic – Garfield and his canine friend Odie are forced from their per','PG','Released'),(21,'TRAPEZIUM','/assets/images/movies/Website-Poster-4.jpg','https://www.youtube.com/embed/-7ZfLFqeOs4?si=otrTNOy-M6YUCKEd',95,'Animation','2024-04-19 00:00:00','jp','English, Chinese','Masahiro Shinohara','Yu Azuma, Kurumi Taiga, Ranko Katori, Mika Kamei','In order to achieve her dream of becoming an idol by any means necessary, Yu Azuma, a first-year student at Joshu East High School decides to seek out three beautiful young girls from each of the four corners of her prefecture (north, south, east, and wes','P12','Coming Soon'),(22,'BLUE LOCK THE MOVIE -EPISODE NAGI-','/assets/images/movies/Website-Poster.jpg','https://www.youtube.com/embed/oKuCj8r5cnw?si=1E9MW3cwqfe8dW80',90,'Animation','2024-08-01 00:00:00','jp','English, Chinese','Shunsuke Ishikawa','Nobunaga Shimazaki, Yuma Uchida, Junichi Suwabe, Koki Uchiyama','“That’s a hassle.” That was second-year high schooler Nagi Seishiro’s favorite phrase as he lived his dull life. Until Mikage Reo, a classmate who dreamed of winning the World Cup, discovered Nagi’s hidden skill, inspiring him to play soccer and share his','P13','Release'),(23,'BOCCHI THE ROCK! RECAP PART 1','/assets/images/movies/Website-Poster-7.jpg','https://www.youtube.com/embed/MCNmJwk3OaA?si=FGyZ89oJinR4c3Li',90,'Animation','2024-08-08 00:00:00','jp','English, Chinese','Keiichiro Saito','Yoshino Aoyama, Sayumi Suzushiro, Saku Mizuno, Ikumi Hasegawa','Hitori Gotoh, “Bocchi-chan,” is a girl who’s so introverted and shy around people that she’d always start her conversations with “Ah…”','P12','Release'),(24,'Maidens of the Ripples','/assets/images/movies/Screen-Shot-2024-08-08-at-12.44.57-AM.jpg','https://www.youtube.com/embed/kRudc0c-8y4?si=6d2h449rksPpmrvL',72,'Animation','2024-09-10 00:00:00','jp','English, Chinese','Michiko Soma','Arima Haruka, Toratani Rin','The story is set in a small, nostalgic port town where houses light up in the evening, and fishing boats fill the harbor instead of trendy beaches. Most young people born and raised here leave for higher education or work. There are no big shopping malls ','P12','Coming Soon'),(25,'Suzume','/assets/images/movies/MV5BNGVkNDc3NjUtNTY5ZS00ZmE0LWE3YzctMDk2OTRlNTdiZWQwXkEyXkFqcGdeQXVyMTU3NDg0OTgx._V1_.jpg','https://www.youtube.com/embed/5pTcio2hTSw?si=rFdFiY3ehRFpkdPX',122,'Animation','2022-11-11 00:00:00','jp','English, Chinese','Makoto Shinkai','Nanoka Hara, Hokuto Matsumura, Eri Fukatsu, Shota Sometani, Sairi Ito, Kotone Hanase, Kana Hanazawa, Matsumoto Hakuō','Suzume no Tojimari, lit. \'Suzume\'s Locking Up\') is a 2022 Japanese animated coming-of-age fantasy adventure film written and directed by Makoto Shinkai. The film follows 17-year-old high school girl Suzume Iwato and young stranger Souta Munakata, who team','P12','Now Showing'),(31,'Avenger','/assets/images/movies/66ec3b11991d1.jpg','https://www.youtube.com/embed/eOrNdBpGMv8',120,'Fantasy','2024-09-18 00:00:00','en','en,cn','ABC','ABC','Fantasy Movie','PG-13','Now Showing'),(34,'Takluk: Lahad Datu','/assets/images/movies/66ecea698f04c.jpg','https://www.youtube.com/embed/vhX1snDIqOY',120,'War','2024-08-22 00:00:00','bm','en,bm,cn','Zulkarnain Azhar','Zulkarnain Azhar','War movieeeeeee ;))','PG-13','Now Showing'),(39,'A Minecraft Movie','/assets/images/movies/66ee6319cf2a3.jpg','https://www.youtube.com/embed/PE2YZhcC4NY',120,'game,imagination,fantasy','2025-04-04 00:00:00','en','en,bm,cn','Jared Hess','‎Jared Hess\r\nDanielle Brooks','Minecraft movie','G','Coming Soon'),(40,'tetesst','/assets/images/movies/66ee7daf2c2e9.jpg','https://www.youtube.com/embed/h8XqkfuaQfE',123,'test','2024-09-20 00:00:00','test','test','test','test','tes','G','Now Showing'),(41,'The Wild Robot','/assets/images/movies/66ef0dc9f414c.jpg','https://www.youtube.com/embed/67vbA5ZJdKQ',100,'Science fiction','2024-09-29 00:00:00','en','en,cn,bm','Chris Sanders','Kit Connor','Shipwrecked on a deserted island, a robot named Roz must learn to adapt to its new surroundings. Building relationships with the native animals, Roz soon develops a parental bond with an orphaned gosling.','G','Now Showing');
/*!40000 ALTER TABLE `Movie` ENABLE KEYS */;
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

-- Dump completed on 2024-09-22 13:38:09
