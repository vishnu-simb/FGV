/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `sizing` */

CREATE TABLE sizing (
  sizing_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  block_id INT(11) NOT NULL,
  variety_id INT(10) UNSIGNED NOT NULL,
  sizing_date DATE NOT NULL,
  sizing_value FLOAT UNSIGNED NOT NULL,
  sizing_type ENUM('size','weight') NOT NULL,
  PRIMARY KEY (sizing_id),
  INDEX fk_sizing_block1 (block_id),
  CONSTRAINT fk_sizing_variety1 FOREIGN KEY (variety_id)
    REFERENCES variety(variety_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT sizing_ibfk_1 FOREIGN KEY (block_id)
    REFERENCES block(block_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

/*Data for the table `sizing` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
