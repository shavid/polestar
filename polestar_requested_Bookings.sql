CREATE DATABASE  IF NOT EXISTS `polestar` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `polestar`;
-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: polestar
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `requested_Bookings`
--

DROP TABLE IF EXISTS `requested_Bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requested_Bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `booking_Date` date DEFAULT NULL,
  `start_Time` time DEFAULT NULL,
  `end_Time` time DEFAULT NULL,
  `room` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'Reciept',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requested_Bookings`
--

LOCK TABLES `requested_Bookings` WRITE;
/*!40000 ALTER TABLE `requested_Bookings` DISABLE KEYS */;
INSERT INTO `requested_Bookings` VALUES (2,'dave ','shpherd','045454','davidjohnshepherd@msn.com','2015-08-31','09:30:00','10:00:00','Green','Accepted'),(3,'dada','sada','4343','davidjohnshepherd@msn.com','2015-08-30','09:00:00','16:30:00','Blue','Accepted'),(4,'ada','adada','455764w43','davidjohnshepherd@msn.com','2015-08-29','08:00:00','11:30:00','Yellow','Rejected'),(5,NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,'Requested'),(6,'david','shepherd','123456789','Testing@testing.com','2015-08-29','09:30:00','11:30:00','Yellow','Accepted'),(7,'test','test','123','dad','2015-08-28','09:00:00','09:30:00','Red','Accepted'),(8,'testing','testing','2342','sadasda','2015-08-29','12:30:00','15:30:00','Green','Accepted'),(9,'','','','','1970-01-01','09:00:00','09:30:00','Red','Requested'),(11,'sdad','34343','34','','1970-01-01','09:00:00','09:30:00','Red','Requested'),(12,'dsad','ada','34343','dadada','2015-08-21','09:00:00','09:30:00','Red','Requested'),(13,'sfs','sfsf','sfs','sfs','2015-08-11','09:00:00','09:30:00','Red','Requested'),(14,'','','','','1970-01-01','09:00:00','09:30:00','Red','Requested'),(15,'david','shepherd','07891877816','thebest@thebest.com','2015-08-29','09:00:00','09:30:00','Red','Reciept'),(16,'dave','she','34343','davidjohnshepherd@msn.com','2015-08-11','09:00:00','09:30:00','Red','Requested'),(17,'david','shepherd','0120669291','davidjohnshepherd@msn.com','2015-08-19','09:30:00','00:00:00','Red','Requested'),(18,'david','shepherd','0123456901','davidjohnshepherd@msn.com','2015-08-26','10:30:00','13:00:00','Red','Requested'),(19,'david','shepherd','01912245042','davidjohnshepherd@msn.com','2015-08-21','09:30:00','12:30:00','Red','Cancelled'),(92,'da','','','','2015-08-25','09:00:00','10:30:00','Red','Accepted');
/*!40000 ALTER TABLE `requested_Bookings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-04 12:55:47
