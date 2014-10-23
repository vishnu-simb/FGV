/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `pest` */

CREATE TABLE pest (
  pest_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  pest_name VARCHAR(100) NOT NULL,
  pest_dd FLOAT NOT NULL,
  pest_calculate ENUM('yes','no') NOT NULL,
  PRIMARY KEY (pest_id),
  UNIQUE INDEX pest_name_UNIQUE (pest_name)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 2730
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

/*Data for the table `pest` */

INSERT INTO pest VALUES
(1, 'Codling Moth', 10, 'yes'),
(2, 'LBAM', 7, 'yes'),
(3, 'OFM', 7.5, 'yes'),
(4, 'Heliothis', 0, 'no'),
(5, 'Q Fruit Fly', 0, 'no'),
(6, 'FRUIT SIZE', 0, 'no');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
