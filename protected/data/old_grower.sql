/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `grower` */

CREATE TABLE grower (
  grower_id INT(11) NOT NULL AUTO_INCREMENT,
  grower_name VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  grower_username VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  grower_password VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  grower_email TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  grower_enabled ENUM('yes','no') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'yes',
  grower_reporting ENUM('daily','weekly','monthly','none') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'weekly',
  PRIMARY KEY (grower_id),
  UNIQUE INDEX grower_username (grower_username)
)
ENGINE = INNODB
AUTO_INCREMENT = 57
AVG_ROW_LENGTH = 399
CHARACTER SET latin1
COLLATE latin1_general_ci;

/*Data for the table `grower` */

INSERT INTO grower VALUES
(3, 'Ian Armour', 'Ian', 'ian', 'armouri@sympac.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au, kwhittam72@gmail.com ', 'yes', 'weekly'),
(4, 'Matthew Lenne', 'Matthew', 'Lenne', 'mlenne@mcmedia.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au, donny.giankos@lindsayrural.com.au', 'yes', 'weekly'),
(5, 'Brad Fankhauser', 'Brad', 'Fankhauser', 'brad@fankhauserapples.com.au, ido@fgv.com.au, glynn@fankhauserapples.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(6, 'Mark Paganoni', 'Mark', 'Paganoni', 'atlanta@surf.net.au, mark@atlanta.com.au, jabbarhs@yahoo.com.au, adriancclay@bigpond.com, ido@fgv.com.au', 'yes', 'weekly'),
(7, 'Garry Byrne', 'Garry', 'Byrne', 'garrybyrne@aanet.com.au, janine@hillndale.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(8, 'Phil Damianopoulos', 'Masalki', 'Ardmona', 'masalki@bigpond.com, ido@fgv.com.au, Donny.Giankos@lindsayrural.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(9, 'Gary Godwill', 'Gary', 'Godwill', 'gj.godwill@bigpond.com, ido@fgv.com.au', 'yes', 'none'),
(10, 'Angelo Emmi', 'Angelo', 'Emmi', 'angeloemmi@hotmail.com, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(11, 'Hardev Bhatti', 'Hardev', 'Bhatti', 'bhattifruitorchards@mcmedia.com.au, ido@fgv.com.au', 'yes', 'none'),
(15, 'Gary Attwood', 'Gary2', 'Attwood', 'glattwood@mcmedia.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(16, 'Peter Radevski', 'Peter', 'Radevski', 'radcool360@bigpond.com, ido@fgv.com.au', 'yes', 'none'),
(17, 'Greg Bradshaw', 'Greg', 'Bradshaw', 'gregbradshaw@bigpond.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(19, 'Ian Bolitho', 'IanB', 'Bolitho', 'ibolitho@bigpond.com, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(22, 'Castlegar', 'MJ', 'Hall', 'greg291@bigpond.com, mjhall@mcmedia.com.au,ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'none'),
(23, 'Chatswood', 'Sam', 'Boyce', 'boycey@live.com, mjhall@mcmedia.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'none'),
(24, 'Woodlands', 'Darren', 'Butler', 'darren.fiona11@bigpond.com', 'yes', 'none'),
(25, 'DEPI', 'Tatura', 'Pear', 'ido@fgv.com.au, fruitscope@mcmedia.com.au, ian.goodwin@depi.vic.gov.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(27, 'Ian Puckey', 'IPuckey', 'Cropwatch', 'irpuckey@gmail.com, ido@fgv.com.au', 'yes', 'none'),
(28, 'Joe Corso', 'Joe1', 'Corso', 'lrgcorsoptyltd@bigpond.com, ido@fgv.com.au', 'no', 'none'),
(30, 'Mantovani', 'Lindsay', 'Rural1', 'Donny.Giankos@lindsayrural.com.au, ido@fgv.com.au', 'yes', 'none'),
(32, 'DEMO GROWER', 'demo', 'demo', 'ido@fgv.com.au', 'yes', 'none'),
(34, 'Mete', 'Mario', 'Mete', 'Donny.Giankos@lindsayrural.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(37, 'Nick Demaio', 'Nick1', 'Demaio', 'nick@sunlandfreshfruit.com, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(38, 'ADRIAN CONTI', 'Adrian1', 'Conti', 'contiac@bigpond.net.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(39, 'JOE CORSO2', 'Joe2', 'Corso', 'Donny.Giankos@lindsayrural.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(40, 'GEORGOPOULOS ORCHARDS', 'Goppy', 'orchard', 'gvorchard@bigpond.com, chrisg1@telstra.ap.blackberry.net, jgeorgopoulos@iinet.net.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(41, 'SCIACCA ORCHARDS', 'Ang1', 'Modi', 'sciaccaorchards@hotmail.com, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(42, 'MINHAS ORCHARDS', 'RANVIR', 'MINHAS', 'rsm@brownbaldwin.com.au, ido@fgv.com.au', 'yes', 'none'),
(43, 'MARLEY PERONA', 'MARLEY1', 'PERONA', 'ido@fgv.com.au, malleybull1@bigpond.com, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(44, 'NUNZY DEPASQUALE', 'Nunzy1', 'KYD', 'nunzdepasquale@gmail.com', 'yes', 'none'),
(45, 'PAT SIBIO', 'Pat1', 'Sibio', 'cbo5@bigpond.com, ido@fgv.com.au', 'yes', 'none'),
(46, 'ROBERT RUSSO', 'Robert', 'Russo', 'rob@summersnowjuice.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au, nick@summersnowjuice.com.au', 'yes', 'weekly'),
(47, 'BOOSEY FRUIT', 'Boosey', 'Fruit', 'boosey@cobram.net.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(48, 'LINDSAY RURAL SHEPP EAST', 'Donny1', 'Giankos', 'donny.giankos@lindsayrural.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(49, 'SRT LOVERSO', 'Faci', 'Piato', 'ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(50, 'KALAFATIS ORCHARDS', 'jkala', 'united', 'jkala@bigpond.net.au, ido@fgv.com.au', 'yes', 'none'),
(51, 'DARIO PULSONI', 'Dario1', 'Pulsoni', 'pulsoniorchards@bigpond.com, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(52, 'Nick', 'Nick', 'Morenos', 'info@treefruit.com.au', 'yes', 'weekly'),
(53, 'PICKWORTH NEW', 'Ben', 'Trazzera', 'trazz@pickworthorchards.com.au, Donny.Giankos@lindsayrural.com.au, ido@fgv.com.au, jabbarhs@yahoo.com.au', 'yes', 'weekly'),
(55, 'Test Inc', 'testymctest', 'abc123', 'tester1@simb.com.au', 'yes', 'daily'),
(56, 'Virginie', 'Virginie', 'Gregoire', 'ido@fgv.com.au', 'yes', 'weekly');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
