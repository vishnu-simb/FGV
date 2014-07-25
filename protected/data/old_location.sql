
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `location` */

CREATE TABLE `location` (
  `location_id` varchar(100) NOT NULL,
  `location_name` varchar(100) DEFAULT NULL,
  `location_observation` varchar(45) DEFAULT NULL,
  `location_forcast` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=963;

/*Data for the table `location` */

insert  into `location`(`location_id`,`location_name`,`location_observation`,`location_forcast`) values ('armourstation','Ian Armour',NULL,NULL),('castlemaine','Castlemaine','IDCJDW3013','castlemaine'),('cerberus','Cerberus','IDCJDW3014','cerberus'),('coldstream','Coldstream','IDCJDW3016',NULL),('cranbourne','Cranbourne','IDCJDW3019','cranbourne'),('fankhauser','Drouin (Fankhauser)','*_special_fankhauser',''),('knoxfield','Knoxfield','IDV60901','knoxfield'),('kyabram','Kyabram','IDCJDW3039','kyabram'),('latrobevalley','Latrobe Valley','IDCJDW3042','latrobevalley'),('melbourne airport','Melbourne Airport','IDCJDW3049','melbourne'),('noojee','Noojee','IDCJDW3060','noojee'),('scoresby','Scoresby','IDCJDW3072','scoresby'),('shepparton','Shepparton','IDCJDW3074','shepparton'),('swanhill','Swan Hill','IDCJDW3077','swanhill'),('tatura','Tatura','IDCJDW3078','tatura'),('westsouthgippsland','South West Gippsland','IDCJDW3019','westsouthgippsland'),('yarrawonga','Yarrawonga','IDCJDW3087','yarrawonga');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
