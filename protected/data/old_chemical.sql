
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `chemical` */

CREATE TABLE chemical (
  chemical_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  chemical_name VARCHAR(100) NOT NULL,
  chemical_pack_qty FLOAT NOT NULL,
  chemical_pack_price FLOAT NOT NULL,
  chemical_dilution_rate FLOAT NOT NULL,
  chemical_application_rate FLOAT NOT NULL,
  PRIMARY KEY (chemical_id),
  UNIQUE INDEX chemical_name_UNIQUE (chemical_name)
)
ENGINE = INNODB
AUTO_INCREMENT = 92
AVG_ROW_LENGTH = 192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

/*Data for the table `chemical` */

INSERT INTO chemical VALUES
(1, 'Altacor', 0.72, 484, 9, 2000),
(2, 'Delegate', 0.8, 408, 20, 2000),
(3, 'Parathion', 20, 220, 65, 2000),
(4, 'Parathion100', 20, 220, 100, 2000),
(5, 'Parashoot 500', 20, 220, 65, 2000),
(7, 'Mavrik', 1, 220, 20, 2000),
(11, 'Tokuthion', 5, 291, 100, 2000),
(12, 'Gusathion', 10, 137, 245, 1600),
(13, 'Calypso', 5, 800, 50, 1600),
(14, 'ParashootCS', 10, 300, 70, 1600),
(15, 'Penncap', 10, 180, 125, 1600),
(16, 'Duwett', 10, 560, 10, 2500),
(17, 'Aphidex', 5, 270, 50, 2500),
(19, 'Insegar40', 0.6, 105, 40, 2500),
(20, 'Insegar30', 0.6, 105, 30, 2500),
(21, 'Insegar20', 0.6, 226, 20, 2000),
(22, 'Lorsban WP', 3, 220, 33, 1600),
(23, 'Lorsban WG', 3, 220, 33, 1600),
(24, 'Lorsban EC', 20, 220, 50, 1600),
(25, 'Lorsban EC150', 20, 220, 150, 1600),
(26, 'Bugmaster100', 20, 280, 100, 1600),
(27, 'Bugmaster200', 20, 280, 200, 1600),
(28, 'Maxx', 2.5, 120, 50, 1600),
(29, 'Dipel', 5, 260, 25, 1600),
(30, 'Betamite100', 10, 470, 100, 1600),
(31, 'Betamite200', 10, 470, 200, 1600),
(33, 'Dithane', 20, 155, 150, 2000),
(34, 'Sulfur DF', 15, 31, 200, 2000),
(35, 'Dormex', 10, 78, 3000, 1400),
(36, 'Naturalure', 4, 75, 100, 2000),
(37, 'Stroby', 0.2, 73.5, 10, 2000),
(38, 'Hydrocop (copper hydroxide)', 10, 185, 110, 2000),
(39, 'Suprathion', 10, 325, 150, 2000),
(40, 'Isomate OFM Rosso 500', 1, 285, 500, 200),
(41, 'Tri Base Blue', 20, 205, 150, 2000),
(42, 'Ziram', 20, 190, 150, 2000),
(43, 'Rubigan', 5, 470, 30, 2000),
(44, 'Syllit Protective', 10, 240, 80, 2000),
(45, 'Syllit Curative', 10, 240, 120, 2000),
(46, 'Applaud', 10, 880, 60, 2000),
(47, 'Talstar - Carpophilus', 20, 215, 50, 2000),
(48, 'Talstar - Mealybug (pears)', 20, 215, 25, 2000),
(49, 'Klartan', 1, 250, 20, 2000),
(50, 'Success ', 1, 398, 40, 2000),
(51, 'Confidor Guard', 10, 400, 3.5, 2000),
(52, 'Tilt', 5, 110, 25, 2000),
(53, 'Rovral', 5, 87.5, 100, 2000),
(54, 'Kocide Blue', 10, 165, 150, 2000),
(55, 'Summer oil', 20, 60, 500, 2000),
(56, 'Winter oil', 205, 400, 3, 2000),
(57, 'Calcium Nitrate', 25, 20, 600, 2000),
(58, 'Captan', 10, 145, 150, 2000),
(59, 'Surround', 12.5, 53.5, 100, 2000),
(60, 'Delan', 2, 188, 18, 2000),
(61, 'Vision', 5, 300, 75, 2000),
(62, 'Systhane', 0.6, 100, 12, 2000),
(63, 'Prodigy', 1, 320, 25, 2000),
(64, 'Topas', 5, 300, 25, 2000),
(65, 'Avatar Codling', 3, 847, 25, 2000),
(66, 'Avatar LBAM', 3, 847, 12.5, 2000),
(67, 'Thiragranz', 20, 190, 150, 2000),
(68, 'Polyram DF', 15, 190, 200, 2000),
(69, 'Viva', 5, 0, 60, 2000),
(70, 'Perlan 65', 0.5, 0, 65, 2000),
(71, 'Perlan 125', 0.5, 0, 125, 2000),
(72, 'Exilis', 5, 0, 450, 2000),
(73, 'Ethrel 5', 10, 0, 5, 2000),
(74, 'Copper Sulphate', 25, 0, 0, 0),
(75, 'Samurai', 2.5, 517, 40, 2000),
(76, 'Pristine', 2.5, 374, 40, 2000),
(77, 'Samurai (soil applied)', 2.5, 600, 4, 1),
(78, 'Madex', 0.1, 200, 7, 2000),
(79, 'Cytolin 65', 1.5, 176, 65, 2000),
(80, 'Cytolin 120', 1.5, 176, 120, 2000),
(81, 'Regalis 75', 1, 357, 75, 2000),
(82, 'Thin It', 20, 180, 1.6, 2000),
(83, 'Bogard 25', 1, 109, 25, 2000),
(84, 'Bogard 35', 1, 109, 35, 2000),
(85, 'Regalis 50', 1, 357, 50, 2000),
(86, 'Confidor 200SC', 1, 75, 500, 2000),
(87, 'Coppox', 15, 175, 200, 2000),
(88, 'ShinetsuCTT flex', 1, 284, 500, 200),
(89, 'MAP 25kg Soluble Granule', 25, 93, 100, 2000),
(90, 'Flint', 1, 298, 10, 2000),
(91, 'Fruit Cal', 200, 300, 500, 2000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
