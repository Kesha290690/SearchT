/*
SQLyog Ultimate v10.42 
MySQL - 5.6.17 : Database - searcht
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`searcht` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `searcht`;

/*Table structure for table `assoc` */

DROP TABLE IF EXISTS `assoc`;

CREATE TABLE `assoc` (
  `wordId` int(11) DEFAULT NULL,
  `assocId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assoc` */

insert  into `assoc`(`wordId`,`assocId`) values (1,1),(1,2),(1,3),(1,4),(1,5),(6,6),(6,7);

/*Table structure for table `tattoo` */

DROP TABLE IF EXISTS `tattoo`;

CREATE TABLE `tattoo` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tattoo` */

insert  into `tattoo`(`id`,`name`,`path`,`desc`) values (1,'test1','img/01.jpg',NULL),(2,'test2','img/02.jpg',NULL),(3,'test3','img/03.jpg',NULL),(4,'test4','img/04.jpg',NULL);

/*Table structure for table `tattoo_assoc` */

DROP TABLE IF EXISTS `tattoo_assoc`;

CREATE TABLE `tattoo_assoc` (
  `tattooId` int(11) DEFAULT NULL,
  `assocId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tattoo_assoc` */

insert  into `tattoo_assoc`(`tattooId`,`assocId`) values (1,1),(1,2),(1,3),(1,4),(1,5),(2,6),(2,7),(3,2),(3,3),(3,4),(4,1),(4,2),(4,4);

/*Table structure for table `word` */

DROP TABLE IF EXISTS `word`;

CREATE TABLE `word` (
  `id` int(11) NOT NULL,
  `word` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `word` */

insert  into `word`(`id`,`word`) values (0,NULL),(1,'skull'),(2,'dead'),(3,'brain'),(4,'death'),(5,'bone'),(6,'wolf'),(7,'moon');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
