/*
SQLyog Enterprise Trial - MySQL GUI v7.11 
MySQL - 5.7.14 : Database - new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`new` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `new`;

/*Table structure for table `assign_trainer` */

DROP TABLE IF EXISTS `assign_trainer`;

CREATE TABLE `assign_trainer` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tran_id` bigint(20) DEFAULT NULL,
  `emp_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `assign_trainer` */

insert  into `assign_trainer`(`_id`,`tran_id`,`emp_id`) values (1,1,1),(2,2,2),(3,3,1);

/*Table structure for table `attachment` */

DROP TABLE IF EXISTS `attachment`;

CREATE TABLE `attachment` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `atch_url` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `attachment` */

insert  into `attachment`(`_id`,`atch_url`,`msg_id`) values (1,'Untitled.png',1);

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cur_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cur_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `course` */

insert  into `course`(`_id`,`cur_name`,`cur_descr`) values (1,'Computer Science','2015 CS'),(2,'Management Information','2015 MI');

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_surname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_connum` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_gender` tinyint(1) DEFAULT NULL,
  `emp_birth` date DEFAULT NULL,
  `emp_img` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `employee` */

insert  into `employee`(`_id`,`emp_surname`,`emp_name`,`emp_connum`,`emp_gender`,`emp_birth`,`emp_img`,`emp_status`) values (1,'Ecole','Ecole','12345678',1,'1970-01-01','avatar.png',1),(2,'Lam','Ben','11111',0,'1970-04-20','24300.png',0);

/*Table structure for table `enroll_training` */

DROP TABLE IF EXISTS `enroll_training`;

CREATE TABLE `enroll_training` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stu_id` bigint(20) DEFAULT NULL,
  `tran_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `enroll_training` */

insert  into `enroll_training`(`_id`,`stu_id`,`tran_id`) values (1,1,1),(2,2,3),(4,3,3);

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `msg_from` bigint(20) DEFAULT NULL,
  `msg_to` bigint(20) DEFAULT NULL,
  `msg_title` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `msg_from_type` int(11) DEFAULT NULL,
  `msg_to_type` int(11) DEFAULT NULL,
  `msg_date` datetime DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `message` */

insert  into `message`(`_id`,`msg_from`,`msg_to`,`msg_title`,`msg_note`,`msg_from_type`,`msg_to_type`,`msg_date`) values (1,1,2,'Hello, Stephan','<p>I need your help for my thesis. Could you come here?</p>',0,0,'2017-04-20 10:15:48');

/*Table structure for table `organization` */

DROP TABLE IF EXISTS `organization`;

CREATE TABLE `organization` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_connum` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_address` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_about` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_img` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `organization` */

insert  into `organization`(`_id`,`org_name`,`org_connum`,`org_email`,`org_address`,`org_about`,`org_img`) values (1,'Ecole Management System','1234567890','ecoleuniversity@outlook.com','Filand','Ecole supérieure de la statistique et de l\'analyse de l\'information','66912.png');

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stu_id` bigint(20) DEFAULT NULL,
  `rp_title` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rp_url` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rp_date` date DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `report` */

insert  into `report`(`_id`,`stu_id`,`rp_title`,`rp_url`,`rp_date`) values (1,1,'My theise','Rar.txt','2017-04-20');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stu_surname` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `stu_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `stu_connum` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `stu_gender` tinyint(1) DEFAULT NULL,
  `stu_birth` date DEFAULT NULL,
  `stu_img` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cur_id` bigint(20) DEFAULT NULL,
  `stu_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`_id`,`stu_surname`,`stu_name`,`stu_connum`,`stu_gender`,`stu_birth`,`stu_img`,`cur_id`,`stu_status`) values (1,'Muller','Stephan','123456',0,'1990-01-01','60.png',1,1),(2,'Pak','Dai','123456789',1,'1991-01-10','16200.png',2,1),(3,'Will','Scott','123',0,'2017-03-09','132888.png',2,0);

/*Table structure for table `training` */

DROP TABLE IF EXISTS `training`;

CREATE TABLE `training` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cur_id` bigint(20) DEFAULT NULL,
  `tran_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tran_startdate` date DEFAULT NULL,
  `tran_enddate` date DEFAULT NULL,
  `tran_descr` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `training` */

insert  into `training`(`_id`,`cur_id`,`tran_name`,`tran_startdate`,`tran_enddate`,`tran_descr`) values (1,1,'Web Programming','2017-04-01','2017-06-24','graduate thesis period'),(2,1,'Mobile Programming','2017-03-09','2017-07-14','2015 CS graduate thesis period'),(3,2,'Financial Management','2017-03-09','2017-08-18','2015 MI graduate period');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ps_id` bigint(20) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`_id`,`ps_id`,`user_type`,`user_name`,`user_email`,`user_password`) values (1,1,0,'admin','admin@gamil.com','123456'),(2,2,0,'Ben','admin@gmail.com','111'),(3,1,1,'Stephan','admin@a.com','1'),(4,2,1,'Dai','admin@a.com','1'),(5,3,1,'Scott','admin@gmail.com','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
