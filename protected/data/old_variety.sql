/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `variety` */

CREATE TABLE `variety` (
  `variety_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `variety_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`variety_id`),
  UNIQUE KEY `variety_name_UNIQUE` (`variety_name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=744;

/*Data for the table `variety` */

insert  into `variety`(`variety_id`,`variety_name`) values (6,'Alvina Gala'),(5,'Buckeye Gala'),(16,'Buerre Bosc'),(18,'Corella'),(22,'Fierro Fuji'),(4,'Fuji'),(8,'Galaxy Gala'),(7,'Glenco Gala'),(10,'Golden Delicious'),(3,'Granny Smith'),(21,'Jonagold'),(20,'Jonathan'),(17,'Josephines'),(19,'Nashi'),(14,'Packhams'),(2,'Pink Lady'),(9,'Red Delicious'),(11,'Rosy Glow'),(1,'Royal Gala'),(12,'Ruby Pink'),(13,'Sundowner'),(15,'WBC');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
