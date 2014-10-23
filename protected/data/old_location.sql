
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `location` */

DROP TABLE IF EXISTS location;
CREATE TABLE location (
  location_id VARCHAR(100) NOT NULL,
  location_name VARCHAR(100) DEFAULT NULL,
  location_observation VARCHAR(45) DEFAULT NULL,
  location_forcast VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (location_id)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 963
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

/*Data for the table `location` */

INSERT INTO location VALUES
('armourstation', 'Ian Armour', NULL, NULL),
('castlemaine', 'Castlemaine', 'IDCJDW3013', 'castlemaine'),
('cerberus', 'Cerberus', 'IDCJDW3014', 'cerberus'),
('coldstream', 'Coldstream', 'IDCJDW3016', NULL),
('cranbourne', 'Cranbourne', 'IDCJDW3019', 'cranbourne'),
('fankhauser', 'Drouin (Fankhauser)', '*_special_fankhauser', ''),
('knoxfield', 'Knoxfield', 'IDV60901', 'knoxfield'),
('kyabram', 'Kyabram', 'IDCJDW3039', 'kyabram'),
('latrobevalley', 'Latrobe Valley', 'IDCJDW3042', 'latrobevalley'),
('melbourne airport', 'Melbourne Airport', 'IDCJDW3049', 'melbourne'),
('noojee', 'Noojee', 'IDCJDW3060', 'noojee'),
('scoresby', 'Scoresby', 'IDCJDW3072', 'scoresby'),
('shepparton', 'Shepparton', 'IDCJDW3074', 'shepparton'),
('swanhill', 'Swan Hill', 'IDCJDW3077', 'swanhill'),
('tatura', 'Tatura', 'IDCJDW3078', 'tatura'),
('westsouthgippsland', 'South West Gippsland', 'IDCJDW3019', 'westsouthgippsland'),
('yarrawonga', 'Yarrawonga', 'IDCJDW3087', 'yarrawonga');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
