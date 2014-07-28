/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `pest_spray` */

CREATE TABLE `pest_spray` (
  `pest_id` int(10) unsigned NOT NULL,
  `ps_number` tinyint(3) unsigned NOT NULL,
  `grower_id` int(11) NOT NULL,
  `ps_dd` smallint(5) unsigned NOT NULL,
  `ps_every` smallint(6) NOT NULL,
  `ps_lowpop_dd` smallint(6) DEFAULT NULL,
  `ps_lowpop_every` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`pest_id`,`ps_number`,`grower_id`),
  KEY `fk_pest_spray_grower1` (`grower_id`),
  KEY `fk_pest_spray_pest1` (`pest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=1365 COMMENT='if pest_spray = 0 then this is the default option (when grow';

/*Data for the table `pest_spray` */

insert  into `pest_spray`(`pest_id`,`ps_number`,`grower_id`,`ps_dd`,`ps_every`,`ps_lowpop_dd`,`ps_lowpop_every`) values (1,1,0,110,42,200,21),(1,2,0,700,42,811,21),(1,3,0,1260,42,1371,21),(2,1,0,130,42,NULL,NULL),(2,2,0,772,42,NULL,NULL),(2,3,0,1534,42,NULL,NULL),(3,1,0,110,42,NULL,NULL),(3,2,0,650,42,NULL,NULL),(3,3,0,1190,42,NULL,NULL),(3,4,0,1730,42,NULL,NULL),(3,5,0,2270,42,NULL,NULL),(3,6,0,2810,42,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
