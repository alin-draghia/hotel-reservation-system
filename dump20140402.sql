CREATE DATABASE  IF NOT EXISTS `hotel_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hotel_db`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: hotel_db
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHotel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES (1,'Brasov','http://www.hotelbrasov.ro/'),(2,'Coroana Brasovului','http://coroana-brasovului.ro/'),(3,'Ambient','http://www.hotelambient.ro/'),(4,'Ramada','http://www.ramadabrasov.ro/'),(5,'Gott','http://www.hotelgott.ro/'),(6,'Cubix','http://www.hotelcubix.ro/home/index.php?lang='),(7,'Golden time','http://www.goldentimehotel.ro/'),(8,'Kronwell','http://kronwell.com/en'),(9,'Aro Palace','http://www.aro-palace.ro/hotel-brasov-aro-pal');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoteldetails`
--

DROP TABLE IF EXISTS `hoteldetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hoteldetails` (
  `RoomType_idRoomType` int(11) NOT NULL,
  `Hotel_idHotel` int(11) NOT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`RoomType_idRoomType`,`Hotel_idHotel`),
  KEY `fk_RoomType_has_Hotel_Hotel1_idx` (`Hotel_idHotel`),
  KEY `fk_RoomType_has_Hotel_RoomType_idx` (`RoomType_idRoomType`),
  CONSTRAINT `fk_RoomType_has_Hotel_RoomType` FOREIGN KEY (`RoomType_idRoomType`) REFERENCES `roomtype` (`idRoomType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_RoomType_has_Hotel_Hotel1` FOREIGN KEY (`Hotel_idHotel`) REFERENCES `hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoteldetails`
--

LOCK TABLES `hoteldetails` WRITE;
/*!40000 ALTER TABLE `hoteldetails` DISABLE KEYS */;
INSERT INTO `hoteldetails` VALUES (1,1,55),(1,2,70),(1,3,40),(1,4,65),(1,6,35),(1,7,80),(1,8,40),(1,9,50),(2,1,90),(2,2,120),(2,3,80),(2,4,100),(2,5,80),(2,7,200),(2,8,60),(2,9,70),(3,1,200),(3,2,200),(3,3,110),(3,5,300),(3,7,250),(3,9,150);
/*!40000 ALTER TABLE `hoteldetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `StartDate` datetime DEFAULT NULL,
  `EndData` datetime DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `user_iduser` int(11) NOT NULL,
  PRIMARY KEY (`idReservation`,`user_iduser`),
  KEY `fk_Reservation_user1_idx` (`user_iduser`),
  CONSTRAINT `fk_Reservation_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservationdetails`
--

DROP TABLE IF EXISTS `reservationdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservationdetails` (
  `Reservation_idReservation` int(11) NOT NULL,
  `Reservation_user_iduser` int(11) NOT NULL,
  `Hotel_idHotel` int(11) NOT NULL,
  `RoomType_idRoomType` int(11) NOT NULL,
  `NumberOfRooms` int(11) DEFAULT NULL,
  PRIMARY KEY (`Reservation_idReservation`,`Reservation_user_iduser`,`Hotel_idHotel`,`RoomType_idRoomType`),
  KEY `fk_Reservation_has_Hotel_Hotel1_idx` (`Hotel_idHotel`),
  KEY `fk_Reservation_has_Hotel_Reservation1_idx` (`Reservation_idReservation`,`Reservation_user_iduser`),
  KEY `fk_Reservation_has_Hotel_RoomType1_idx` (`RoomType_idRoomType`),
  CONSTRAINT `fk_Reservation_has_Hotel_Hotel1` FOREIGN KEY (`Hotel_idHotel`) REFERENCES `hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reservation_has_Hotel_Reservation1` FOREIGN KEY (`Reservation_idReservation`, `Reservation_user_iduser`) REFERENCES `reservation` (`idReservation`, `user_iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reservation_has_Hotel_RoomType1` FOREIGN KEY (`RoomType_idRoomType`) REFERENCES `roomtype` (`idRoomType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservationdetails`
--

LOCK TABLES `reservationdetails` WRITE;
/*!40000 ALTER TABLE `reservationdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservationdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomtype`
--

DROP TABLE IF EXISTS `roomtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roomtype` (
  `idRoomType` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRoomType`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomtype`
--

LOCK TABLES `roomtype` WRITE;
/*!40000 ALTER TABLE `roomtype` DISABLE KEYS */;
INSERT INTO `roomtype` VALUES (1,'Single'),(2,'Double'),(3,'Suit');
/*!40000 ALTER TABLE `roomtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'alin','login');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'hotel_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `getHotelRooms` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getHotelRooms`(hotel_id int)
BEGIN

SELECT `hotel`.`idHotel`, `hotel`.`Name`, `roomtype`.`type`, `hoteldetails`.`Price` 
FROM `hotel_db`.`hoteldetails` AS `hoteldetails`, `hotel_db`.`hotel` AS `hotel`, `hotel_db`.`roomtype` AS `roomtype` 
WHERE `hoteldetails`.`Hotel_idHotel` = `hotel`.`idHotel` AND `hoteldetails`.`RoomType_idRoomType` = `roomtype`.`idRoomType`
	AND `hotel`.`idHotel` = hotel_id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-02 16:50:11
