-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: learniversedb
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `file` text NOT NULL,
  `user_id` bigint NOT NULL,
  `createdAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_book_idx` (`user_id`),
  CONSTRAINT `user_id_book` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (23,'Ginerbread Man','\"The Gingerbread Boy\" redirects here. For the Oswald the Lucky Rabbit short, see The Ginger Bread Boy. For other uses, see Gingerbread Man (disambiguation).\r\n\r\n1918 illustration for the tale\r\nThe Gingerbread Man (also known as The Gingerbread Boy) is a fairy tale about a gingerbread man\'s misadventures while fleeing from various people that culminates in the titular character being eaten by a fox. \"The Gingerbread Boy\" first appeared in print in the May 1875, issue of St. Nicholas Magazine in a cumulative tale which, like \"The Little Red Hen\", depends on repetitious scenes featuring an ever-growing cast of characters for its effect.[1] According to the reteller of the tale, \"A girl from Maine told it to my children. It interested them so much that I thought it worth preserving. I asked where she found it and she said an old lady told it to her in her childhood.\"[2]','1729924512_1729277744_GingerbreadMan_book.jpg','1729924512_1729278460_The Gingerbread Man – Classic Tales with Activities.pdf',21,'2024-10-26 13:05:12',NULL),(24,'Test','Test','1729934516_1729276564_GingerbreadMan_book.jpg','1729934516_1728895246_001-HIDE-AND-SEEK-Free-Childrens-Book-By-Monkey-Pen.pdf',21,'2024-10-26 15:51:56','2024-11-11 05:05:27'),(25,'Tom and Jerry ','The series features comic fights between an iconic set of adversaries, a house cat (Tom) and a house mouse (Jerry). The plots of many shorts are often set in the backdrop of a house, centering on Tom (who is often enlisted by a human) trying to capture Jerry, and the mayhem and destruction that follows. Tom rarely succeeds in catching Jerry, mainly because of Jerry\'s cleverness, cunning abilities, and luck. However, on several occasions, they have displayed genuine friendship and concern for each other\'s well-being. At other times, the pair set aside their rivalry in order to pursue a common goal, such as when a baby escapes the watch of a negligent babysitter, causing Tom and Jerry to pursue the baby and keep it away from danger, in the shorts Busy Buddies and Tot Watchers respectively. Despite their endless attacks on one another, they have saved each other\'s lives every time they were truly in danger, except in The Two Mouseketeers, which features an uncharacteristically morbid ending, and Blue Cat Blues, where both sit on a railroad track at the end after being jilted by girlfriends. The cartoon irises out with the whistle of an oncoming steam train.','1731278075_download.jpg','1731278075_1729934516_1728895246_001-HIDE-AND-SEEK-Free-Childrens-Book-By-Monkey-Pen.pdf',21,'2024-11-11 05:04:35',NULL),(26,'Snow White','At the beginning of the story, a queen sits sewing at an open window during a winter snowfall when she pricks her finger with her needle, causing three drops of blood to drip onto the freshly fallen snow on the black window sill. Then she says to herself, \"How I wish that I had a daughter who had skin as white as snow, lips as red as blood and hair as black as ebony.\" Some time later, the queen dies giving birth to a baby daughter whom she names Snow White. (However, in the 1812 version of the tale, the queen does not die but later behaves the same way the stepmother does in later versions of the tale, including the 1854 iteration.) A year later, Snow White\'s father, the king, marries again. His new wife is very beautiful, but a vain and wicked woman who practices witchcraft. The new queen possesses a magic mirror, which she asks every morning, \"Mirror mirror on the wall, who is the fairest one of all?\" The mirror always tells the queen that she is the fairest. The Queen is always pleased with that response because the magic mirror never lies. When Snow White is seven years old, her fairness surpasses that of her stepmother. When the Queen again asks her mirror the same question, it tells her that Snow White is the fairest.[1][5]','1731278278_download (1).jpg','1731278278_1729934516_1728895246_001-HIDE-AND-SEEK-Free-Childrens-Book-By-Monkey-Pen.pdf',21,'2024-11-11 05:07:58',NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11 10:27:00
