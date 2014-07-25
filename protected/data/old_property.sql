/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.6.17 : Database - simb_fgv
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`simb_fgv` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simb_fgv`;

/*Table structure for table `property` */

DROP TABLE IF EXISTS `property`;

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `grower_id` int(11) NOT NULL,
  `location_id` varchar(100) NOT NULL,
  `property_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`property_id`),
  KEY `fk_block_grower` (`grower_id`),
  KEY `fk_block_location1` (`location_id`),
  CONSTRAINT `property_ibfk_1` FOREIGN KEY (`grower_id`) REFERENCES `grower` (`grower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `property_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=215;

/*Data for the table `property` */

insert  into `property`(`property_id`,`grower_id`,`location_id`,`property_name`) values (3,3,'armourstation','Bona Vista'),(4,3,'armourstation','Lardner'),(5,6,'cerberus','Atlanta'),(6,6,'cerberus','Next Door'),(7,6,'cerberus','Shepherds Bush'),(9,7,'scoresby','Wandin'),(10,7,'coldstream','Hoddles Creek'),(11,7,'scoresby','Seville'),(12,8,'tatura','Ardmona'),(13,9,'shepparton','Home'),(14,10,'tatura','Mooroopna'),(15,11,'tatura','Ardmona'),(16,11,'shepparton','Grahamvale'),(17,15,'tatura','Murton Road'),(18,16,'shepparton','Central Avenue'),(19,16,'shepparton','Swainston Road'),(20,16,'shepparton','Old Dookie'),(21,5,'fankhauser','Drouin'),(22,17,'cerberus','Greg Bradshaw - Home'),(23,4,'tatura','Minchin Road'),(24,11,'tatura','Toolamba'),(25,19,'tatura','River'),(26,19,'tatura','Home'),(29,22,'tatura','MJ Hall'),(30,23,'tatura','Ferguson Road'),(31,24,'tatura','Scaled Up Investments'),(33,11,'tatura','Tatura'),(34,27,'kyabram','Summerlands'),(35,30,'yarrawonga','Cobram'),(36,28,'kyabram','Kyabram'),(37,32,'shepparton','Orchard Road'),(39,34,'yarrawonga','Cobram'),(40,10,'tatura','ARDMONA'),(44,37,'yarrawonga','River Road - Dads Farm'),(45,37,'yarrawonga','Denson'),(46,37,'yarrawonga','SUB STATION'),(47,37,'yarrawonga','OKANES'),(48,37,'yarrawonga','SHED'),(49,39,'kyabram','KYABRAM'),(53,40,'shepparton','HOME ORCHARD'),(54,40,'shepparton','PENISI'),(55,40,'shepparton','NOVAC'),(56,40,'shepparton','SCHOOL ROAD'),(57,40,'shepparton','PARAS'),(58,40,'shepparton','RENDEVSKI'),(59,40,'shepparton','TZ ORCHARD'),(60,40,'shepparton','DORCHARDS'),(61,40,'shepparton','KYRIAKOU STEVE'),(62,40,'shepparton','KYRIAKOU VICTOR'),(63,40,'shepparton','CHRISTOU'),(64,40,'shepparton','DAIRY FARM'),(66,40,'shepparton','DELLINGSMITH'),(67,41,'kyabram','SHED PROPERTY'),(68,41,'kyabram','HOME PROPERTY'),(69,40,'shepparton','FORD ROAD'),(70,42,'shepparton','SHEPP EAST'),(71,42,'shepparton','LEMNOS'),(72,43,'shepparton','HOME ORCHARD'),(73,43,'shepparton','JK ORCHARD'),(74,38,'yarrawonga','CAMPBELL RD'),(75,44,'kyabram','KY.D PAK'),(76,45,'tatura','HOME'),(77,46,'scoresby','BELLEVUE'),(78,47,'yarrawonga','HOME PROPERTY'),(79,44,'tatura','TATURA PROPERTY'),(80,48,'shepparton','SHEPP EAST'),(81,49,'shepparton','CHANNEL RD'),(82,49,'shepparton','CENTRAL AVENUE'),(83,50,'tatura','CORBOY - WHEELHOUSE'),(84,50,'shepparton','LEMNOS ORCHARD'),(85,25,'tatura','DEPI PEAR LAB'),(86,51,'kyabram','CADAN'),(87,51,'kyabram','PALMER'),(88,52,'melbourne airport','Treefruit'),(89,53,'tatura','DHURRINGHILE'),(90,53,'tatura','RYANS');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
