/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `session` */

CREATE TABLE session (
  session_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  session_ip VARCHAR(30) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  session_time INT(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (session_id),
  INDEX idx_time (session_time),
  UNIQUE INDEX session_ip (session_ip)
)
ENGINE = INNODB
AUTO_INCREMENT = 36034219
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8
COLLATE utf8_general_ci;

/*Data for the table `session` */

INSERT INTO session VALUES
(36033985, '192.168.2.250', 1316850594),
(36033986, '::1', 1323781201),
(36033992, '192.168.2.141', 1320326169),
(36034214, '192.168.2.114', 1318135978),
(36034218, '10.10.134.134', 1318083709);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
