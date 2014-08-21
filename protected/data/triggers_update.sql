/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/* Trigger structure for table `fgv_block` */

DELIMITER $$

/*!50003 CREATE */ /*!50003 TRIGGER `trigger_after_insert_block` AFTER INSERT ON `fgv_block` FOR EACH ROW BEGIN
INSERT INTO  fgv_mite_monitor (mite_id, block_id)
SELECT id,NEW.id FROM fgv_mite;
END */$$


DELIMITER ;

/* Trigger structure for table `fgv_mite` */

DELIMITER $$

/*!50003 CREATE */ /*!50003 TRIGGER `trigger_after_insert_mite` AFTER INSERT ON `fgv_mite` FOR EACH ROW BEGIN
INSERT INTO  fgv_mite_monitor (mite_id, block_id)
SELECT NEW.id,id FROM fgv_block;
END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
