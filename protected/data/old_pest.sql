/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `pest` */

CREATE TABLE `pest` (
  `pest_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pest_name` varchar(100) NOT NULL,
  `pest_dd` float NOT NULL,
  `pest_calculate` enum('yes','no') NOT NULL,
  PRIMARY KEY (`pest_id`),
  UNIQUE KEY `pest_name_UNIQUE` (`pest_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=2730;

/*Data for the table `pest` */

insert  into `pest`(`pest_id`,`pest_name`,`pest_dd`,`pest_calculate`) values (1,'Codling Moth',10,'yes'),(2,'LBAM',7,'yes'),(3,'OFM',7.5,'yes'),(4,'Heliothis',0,'no'),(5,'Q Fruit Fly',0,'no'),(6,'FRUIT SIZE',0,'no');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
