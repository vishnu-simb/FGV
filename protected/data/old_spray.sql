/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `spray` */

CREATE TABLE `spray` (
  `spray_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chemical_id` int(10) unsigned NOT NULL,
  `spray_date` date NOT NULL,
  `spray_quantity` tinyint(4) NOT NULL,
  `block_id` int(11) NOT NULL,
  PRIMARY KEY (`spray_id`),
  KEY `fk_spray_block1` (`block_id`),
  KEY `fk_spray_chemical1` (`chemical_id`),
  CONSTRAINT `spray_ibfk_1` FOREIGN KEY (`chemical_id`) REFERENCES `chemical` (`chemical_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spray_ibfk_2` FOREIGN KEY (`block_id`) REFERENCES `block` (`block_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=370 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=546;

/*Data for the table `spray` */

insert  into `spray`(`spray_id`,`chemical_id`,`spray_date`,`spray_quantity`,`block_id`) values (165,33,'2012-10-02',1,185),(166,13,'2012-10-02',1,186),(167,52,'2012-10-02',1,186),(168,13,'2012-10-02',1,183),(183,1,'2012-09-15',1,183),(248,21,'2012-10-19',1,183),(277,90,'2012-11-08',1,183),(333,75,'2013-08-12',1,183),(334,75,'2013-08-12',1,184),(335,1,'2013-08-14',1,183),(336,1,'2013-08-14',1,183),(337,56,'2013-08-31',1,19),(338,56,'2013-08-31',1,20),(348,2,'2013-10-31',1,341),(349,2,'2013-10-31',1,342),(350,2,'2013-10-31',1,342),(351,2,'2013-10-31',1,342),(352,2,'2013-10-31',1,341),(353,13,'2013-11-15',1,166),(354,13,'2013-11-15',1,167),(355,13,'2013-11-15',1,168),(356,13,'2013-11-15',1,169),(357,13,'2013-11-16',1,172),(359,13,'2013-11-16',1,173),(360,13,'2013-11-15',1,166),(361,13,'2013-11-15',1,167),(365,56,'2013-08-15',60,327),(366,25,'2013-08-15',2,327),(367,54,'2013-09-02',3,328),(369,54,'2013-09-15',3,327);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
