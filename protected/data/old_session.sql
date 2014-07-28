/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `session` */

CREATE TABLE `session` (
  `session_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_ip` varchar(30) CHARACTER SET ascii NOT NULL,
  `session_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_ip` (`session_ip`),
  KEY `idx_time` (`session_time`)
) ENGINE=InnoDB AUTO_INCREMENT=36034219 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=3276;

/*Data for the table `session` */

insert  into `session`(`session_id`,`session_ip`,`session_time`) values (36033985,'192.168.2.250',1316850594),(36033986,'::1',1323781201),(36033992,'192.168.2.141',1320326169),(36034214,'192.168.2.114',1318135978),(36034218,'10.10.134.134',1318083709);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
