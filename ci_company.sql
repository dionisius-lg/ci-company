/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.38-MariaDB : Database - ci_company
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci_company` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ci_company`;

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `detail` text,
  `slug` varchar(255) DEFAULT NULL,
  `file_path` text,
  `file_url` text,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `dimension` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blogs` */

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values ('20nc1vmln0l0noko5p99cfpa8hi0v31t','127.0.0.1',1614586031,'__ci_last_regenerate|i:1614586030;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('2gjtb5usl83cgfgcafj29m24q884mvlq','127.0.0.1',1614584939,'__ci_last_regenerate|i:1614584845;'),('2u2p2o2lktemsnfqglse94mbbaukeda4','127.0.0.1',1614586703,'__ci_last_regenerate|i:1614586702;'),('4d98mgarjt9vs9j234982ei832i1jtj6','127.0.0.1',1614585975,'__ci_last_regenerate|i:1614585975;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('6kbdcc0jj44833livp8js2hjnkssuc9k','127.0.0.1',1614582757,'__ci_last_regenerate|i:1614582740;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('75kj35ui4ki3e2k75u962efhj73stqbb','127.0.0.1',1614583839,'__ci_last_regenerate|i:1614583642;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('cf29c04jed5ug4l2m1sklnvqiunvgji3','127.0.0.1',1614582042,'__ci_last_regenerate|i:1614582042;'),('ciibokjv3tge3j2dnm4vmedjp146rhqh','127.0.0.1',1614585985,'__ci_last_regenerate|i:1614585985;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('cp97mmg24anc5chl9s87u2iis06hq7oj','127.0.0.1',1614581417,'__ci_last_regenerate|i:1614581417;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('fmv4bjnd2qjit7tumsm02kb5po4iviic','127.0.0.1',1614581607,'__ci_last_regenerate|i:1614581521;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('g5mu6maqca0r9no69n25oskrrceic0dt','127.0.0.1',1614585895,'__ci_last_regenerate|i:1614585895;'),('iqoqk52vlghecppbos3muhbmui43iq6f','127.0.0.1',1614585889,'__ci_last_regenerate|i:1614585690;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('jhtq5ev0c9f726ovcgliivn1k4ug77vu','127.0.0.1',1614586352,'__ci_last_regenerate|i:1614586351;'),('k8fqnodph0dfbc6maub0s80vdin94o87','127.0.0.1',1614581492,'__ci_last_regenerate|i:1614581492;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('kkgl9ptsmd9gjiusf72325n622fd4f3e','127.0.0.1',1614581380,'__ci_last_regenerate|i:1614581372;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('l5e2bcqpb8unio9k7gpceubls4rrglj4','127.0.0.1',1614585898,'__ci_last_regenerate|i:1614585898;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('l5tbps3e8sii4fqm939c8dcafvhmig3p','127.0.0.1',1614586349,'__ci_last_regenerate|i:1614586349;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('lj5r58ff18petjvpdgdd2vnloetc3a8h','127.0.0.1',1614586339,'__ci_last_regenerate|i:1614586339;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('lkal8650q4tmja9nm0vtqmrpu254acdb','127.0.0.1',1614585457,'__ci_last_regenerate|i:1614585240;'),('md5is9f8kdk3qidf6c8rjan9rkn846te','127.0.0.1',1614586026,'__ci_last_regenerate|i:1614586025;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('mo23dpjpk5evhuse3jmdl0csrocmjm6r','127.0.0.1',1614586700,'__ci_last_regenerate|i:1614586700;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('n6ka4jqm9ge7rti1lcvbr59t6hfq7nk2','127.0.0.1',1614581430,'__ci_last_regenerate|i:1614581430;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}'),('neivt7e3v4ijuvkfl6s4ephhrk1s46q2','127.0.0.1',1614581947,'__ci_last_regenerate|i:1614581706;'),('oh68mf4nvjccij0qkok1osg64tnbts5b','127.0.0.1',1614581489,'__ci_last_regenerate|i:1614581480;AuthUser|a:21:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:14:\"dion@jsm.co.id\";s:13:\"user_level_id\";s:1:\"1\";s:10:\"user_level\";s:5:\"Admin\";s:12:\"host_address\";N;s:10:\"ip_address\";N;s:15:\"last_event_date\";N;s:13:\"last_event_id\";N;s:12:\"request_date\";s:19:\"2021-02-20 18:36:14\";s:13:\"register_date\";s:19:\"2021-02-20 18:36:07\";s:16:\"register_user_id\";s:1:\"1\";s:11:\"register_by\";s:14:\"dion@jsm.co.id\";s:11:\"update_date\";s:19:\"2021-02-22 03:38:39\";s:14:\"update_user_id\";s:1:\"1\";s:9:\"update_by\";s:14:\"dion@jsm.co.id\";s:12:\"update_count\";s:1:\"6\";s:17:\"verification_code\";N;s:19:\"is_password_request\";s:1:\"0\";s:12:\"is_employees\";s:1:\"1\";s:11:\"is_register\";s:1:\"1\";s:9:\"is_active\";s:1:\"1\";}site_lang|s:7:\"english\";'),('p1g3501kkvj113h74d0mljl331jm0a9d','127.0.0.1',1614581466,'__ci_last_regenerate|i:1614581466;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('pbthp59kp6spu52v20es1480ubj5tnce','127.0.0.1',1614584503,'__ci_last_regenerate|i:1614584491;'),('qompoq2v8v6b5gm4qgqn2umg62equv38','127.0.0.1',1614585910,'__ci_last_regenerate|i:1614585909;FlashError_auth|s:18:\"Please login first\";__ci_vars|a:1:{s:15:\"FlashError_auth\";s:3:\"old\";}'),('reqv1l54u610j3llchcafpn25jcqh44k','127.0.0.1',1614586023,'__ci_last_regenerate|i:1614586023;'),('timq88crog41p34u9joe02t020hb27bp','127.0.0.1',1614586343,'__ci_last_regenerate|i:1614586343;');

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`province_id`,`is_active`) values (1,'Aceh Barat',21,1),(2,'Aceh Barat Daya',21,1),(3,'Aceh Besar',21,1),(4,'Aceh Jaya',21,1),(5,'Aceh Selatan',21,1),(6,'Aceh Singkil',21,1),(7,'Aceh Tamiang',21,1),(8,'Aceh Tengah',21,1),(9,'Aceh Tenggara',21,1),(10,'Aceh Timur',21,1),(11,'Aceh Utara',21,1),(12,'Agam',32,1),(13,'Alor',23,1),(14,'Ambon',19,1),(15,'Asahan',34,1),(16,'Asmat',24,1),(17,'Badung',1,1),(18,'Balangan',13,1),(19,'Balikpapan',15,1),(20,'Banda Aceh',21,1),(21,'Bandar Lampung',18,1),(22,'Bandung',9,1),(23,'Bandung',9,1),(24,'Bandung Barat',9,1),(25,'Banggai',29,1),(26,'Banggai Kepulauan',29,1),(27,'Bangka',2,1),(28,'Bangka Barat',2,1),(29,'Bangka Selatan',2,1),(30,'Bangka Tengah',2,1),(31,'Bangkalan',11,1),(32,'Bangli',1,1),(33,'Banjar',13,1),(34,'Banjar',9,1),(35,'Banjarbaru',13,1),(36,'Banjarmasin',13,1),(37,'Banjarnegara',10,1),(38,'Bantaeng',28,1),(39,'Bantul',5,1),(40,'Banyuasin',33,1),(41,'Banyumas',10,1),(42,'Banyuwangi',11,1),(43,'Barito Kuala',13,1),(44,'Barito Selatan',14,1),(45,'Barito Timur',14,1),(46,'Barito Utara',14,1),(47,'Barru',28,1),(48,'Batam',17,1),(49,'Batang',10,1),(50,'Batang Hari',8,1),(51,'Batu',11,1),(52,'Batu Bara',34,1),(53,'Bau-Bau',30,1),(54,'Bekasi',9,1),(55,'Bekasi',9,1),(56,'Belitung',2,1),(57,'Belitung Timur',2,1),(58,'Belu',23,1),(59,'Bener Meriah',21,1),(60,'Bengkalis',26,1),(61,'Bengkayang',12,1),(62,'Bengkulu',4,1),(63,'Bengkulu Selatan',4,1),(64,'Bengkulu Tengah',4,1),(65,'Bengkulu Utara',4,1),(66,'Berau',15,1),(67,'Biak Numfor',24,1),(68,'Bima',22,1),(69,'Bima',22,1),(70,'Binjai',34,1),(71,'Bintan',17,1),(72,'Bireuen',21,1),(73,'Bitung',31,1),(74,'Blitar',11,1),(75,'Blitar',11,1),(76,'Blora',10,1),(77,'Boalemo',7,1),(78,'Bogor',9,1),(79,'Bogor',9,1),(80,'Bojonegoro',11,1),(81,'Bolaang Mongondow (Bolmong)',31,1),(82,'Bolaang Mongondow Selatan',31,1),(83,'Bolaang Mongondow Timur',31,1),(84,'Bolaang Mongondow Utara',31,1),(85,'Bombana',30,1),(86,'Bondowoso',11,1),(87,'Bone',28,1),(88,'Bone Bolango',7,1),(89,'Bontang',15,1),(90,'Boven Digoel',24,1),(91,'Boyolali',10,1),(92,'Brebes',10,1),(93,'Bukittinggi',32,1),(94,'Buleleng',1,1),(95,'Bulukumba',28,1),(96,'Bulungan (Bulongan)',16,1),(97,'Bungo',8,1),(98,'Buol',29,1),(99,'Buru',19,1),(100,'Buru Selatan',19,1),(101,'Buton',30,1),(102,'Buton Utara',30,1),(103,'Ciamis',9,1),(104,'Cianjur',9,1),(105,'Cilacap',10,1),(106,'Cilegon',3,1),(107,'Cimahi',9,1),(108,'Cirebon',9,1),(109,'Cirebon',9,1),(110,'Dairi',34,1),(111,'Deiyai (Deliyai)',24,1),(112,'Deli Serdang',34,1),(113,'Demak',10,1),(114,'Denpasar',1,1),(115,'Depok',9,1),(116,'Dharmasraya',32,1),(117,'Dogiyai',24,1),(118,'Dompu',22,1),(119,'Donggala',29,1),(120,'Dumai',26,1),(121,'Empat Lawang',33,1),(122,'Ende',23,1),(123,'Enrekang',28,1),(124,'Fakfak',25,1),(125,'Flores Timur',23,1),(126,'Garut',9,1),(127,'Gayo Lues',21,1),(128,'Gianyar',1,1),(129,'Gorontalo',7,1),(130,'Gorontalo',7,1),(131,'Gorontalo Utara',7,1),(132,'Gowa',28,1),(133,'Gresik',11,1),(134,'Grobogan',10,1),(135,'Gunung Kidul',5,1),(136,'Gunung Mas',14,1),(137,'Gunungsitoli',34,1),(138,'Halmahera Barat',20,1),(139,'Halmahera Selatan',20,1),(140,'Halmahera Tengah',20,1),(141,'Halmahera Timur',20,1),(142,'Halmahera Utara',20,1),(143,'Hulu Sungai Selatan',13,1),(144,'Hulu Sungai Tengah',13,1),(145,'Hulu Sungai Utara',13,1),(146,'Humbang Hasundutan',34,1),(147,'Indragiri Hilir',26,1),(148,'Indragiri Hulu',26,1),(149,'Indramayu',9,1),(150,'Intan Jaya',24,1),(151,'Jakarta Barat',6,1),(152,'Jakarta Pusat',6,1),(153,'Jakarta Selatan',6,1),(154,'Jakarta Timur',6,1),(155,'Jakarta Utara',6,1),(156,'Jambi',8,1),(157,'Jayapura',24,1),(158,'Jayapura',24,1),(159,'Jayawijaya',24,1),(160,'Jember',11,1),(161,'Jembrana',1,1),(162,'Jeneponto',28,1),(163,'Jepara',10,1),(164,'Jombang',11,1),(165,'Kaimana',25,1),(166,'Kampar',26,1),(167,'Kapuas',14,1),(168,'Kapuas Hulu',12,1),(169,'Karanganyar',10,1),(170,'Karangasem',1,1),(171,'Karawang',9,1),(172,'Karimun',17,1),(173,'Karo',34,1),(174,'Katingan',14,1),(175,'Kaur',4,1),(176,'Kayong Utara',12,1),(177,'Kebumen',10,1),(178,'Kediri',11,1),(179,'Kediri',11,1),(180,'Keerom',24,1),(181,'Kendal',10,1),(182,'Kendari',30,1),(183,'Kepahiang',4,1),(184,'Kepulauan Anambas',17,1),(185,'Kepulauan Aru',19,1),(186,'Kepulauan Mentawai',32,1),(187,'Kepulauan Meranti',26,1),(188,'Kepulauan Sangihe',31,1),(189,'Kepulauan Seribu',6,1),(190,'Kepulauan Siau Tagulandang Biaro (Sitaro)',31,1),(191,'Kepulauan Sula',20,1),(192,'Kepulauan Talaud',31,1),(193,'Kepulauan Yapen (Yapen Waropen)',24,1),(194,'Kerinci',8,1),(195,'Ketapang',12,1),(196,'Klaten',10,1),(197,'Klungkung',1,1),(198,'Kolaka',30,1),(199,'Kolaka Utara',30,1),(200,'Konawe',30,1),(201,'Konawe Selatan',30,1),(202,'Konawe Utara',30,1),(203,'Kotabaru',13,1),(204,'Kotamobagu',31,1),(205,'Kotawaringin Barat',14,1),(206,'Kotawaringin Timur',14,1),(207,'Kuantan Singingi',26,1),(208,'Kubu Raya',12,1),(209,'Kudus',10,1),(210,'Kulon Progo',5,1),(211,'Kuningan',9,1),(212,'Kupang',23,1),(213,'Kupang',23,1),(214,'Kutai Barat',15,1),(215,'Kutai Kartanegara',15,1),(216,'Kutai Timur',15,1),(217,'Labuhan Batu',34,1),(218,'Labuhan Batu Selatan',34,1),(219,'Labuhan Batu Utara',34,1),(220,'Lahat',33,1),(221,'Lamandau',14,1),(222,'Lamongan',11,1),(223,'Lampung Barat',18,1),(224,'Lampung Selatan',18,1),(225,'Lampung Tengah',18,1),(226,'Lampung Timur',18,1),(227,'Lampung Utara',18,1),(228,'Landak',12,1),(229,'Langkat',34,1),(230,'Langsa',21,1),(231,'Lanny Jaya',24,1),(232,'Lebak',3,1),(233,'Lebong',4,1),(234,'Lembata',23,1),(235,'Lhokseumawe',21,1),(236,'Lima Puluh Koto/Kota',32,1),(237,'Lingga',17,1),(238,'Lombok Barat',22,1),(239,'Lombok Tengah',22,1),(240,'Lombok Timur',22,1),(241,'Lombok Utara',22,1),(242,'Lubuk Linggau',33,1),(243,'Lumajang',11,1),(244,'Luwu',28,1),(245,'Luwu Timur',28,1),(246,'Luwu Utara',28,1),(247,'Madiun',11,1),(248,'Madiun',11,1),(249,'Magelang',10,1),(250,'Magelang',10,1),(251,'Magetan',11,1),(252,'Majalengka',9,1),(253,'Majene',27,1),(254,'Makassar',28,1),(255,'Malang',11,1),(256,'Malang',11,1),(257,'Malinau',16,1),(258,'Maluku Barat Daya',19,1),(259,'Maluku Tengah',19,1),(260,'Maluku Tenggara',19,1),(261,'Maluku Tenggara Barat',19,1),(262,'Mamasa',27,1),(263,'Mamberamo Raya',24,1),(264,'Mamberamo Tengah',24,1),(265,'Mamuju',27,1),(266,'Mamuju Utara',27,1),(267,'Manado',31,1),(268,'Mandailing Natal',34,1),(269,'Manggarai',23,1),(270,'Manggarai Barat',23,1),(271,'Manggarai Timur',23,1),(272,'Manokwari',25,1),(273,'Manokwari Selatan',25,1),(274,'Mappi',24,1),(275,'Maros',28,1),(276,'Mataram',22,1),(277,'Maybrat',25,1),(278,'Medan',34,1),(279,'Melawi',12,1),(280,'Merangin',8,1),(281,'Merauke',24,1),(282,'Mesuji',18,1),(283,'Metro',18,1),(284,'Mimika',24,1),(285,'Minahasa',31,1),(286,'Minahasa Selatan',31,1),(287,'Minahasa Tenggara',31,1),(288,'Minahasa Utara',31,1),(289,'Mojokerto',11,1),(290,'Mojokerto',11,1),(291,'Morowali',29,1),(292,'Muara Enim',33,1),(293,'Muaro Jambi',8,1),(294,'Muko Muko',4,1),(295,'Muna',30,1),(296,'Murung Raya',14,1),(297,'Musi Banyuasin',33,1),(298,'Musi Rawas',33,1),(299,'Nabire',24,1),(300,'Nagan Raya',21,1),(301,'Nagekeo',23,1),(302,'Natuna',17,1),(303,'Nduga',24,1),(304,'Ngada',23,1),(305,'Nganjuk',11,1),(306,'Ngawi',11,1),(307,'Nias',34,1),(308,'Nias Barat',34,1),(309,'Nias Selatan',34,1),(310,'Nias Utara',34,1),(311,'Nunukan',16,1),(312,'Ogan Ilir',33,1),(313,'Ogan Komering Ilir',33,1),(314,'Ogan Komering Ulu',33,1),(315,'Ogan Komering Ulu Selatan',33,1),(316,'Ogan Komering Ulu Timur',33,1),(317,'Pacitan',11,1),(318,'Padang',32,1),(319,'Padang Lawas',34,1),(320,'Padang Lawas Utara',34,1),(321,'Padang Panjang',32,1),(322,'Padang Pariaman',32,1),(323,'Padang Sidempuan',34,1),(324,'Pagar Alam',33,1),(325,'Pakpak Bharat',34,1),(326,'Palangka Raya',14,1),(327,'Palembang',33,1),(328,'Palopo',28,1),(329,'Palu',29,1),(330,'Pamekasan',11,1),(331,'Pandeglang',3,1),(332,'Pangandaran',9,1),(333,'Pangkajene Kepulauan',28,1),(334,'Pangkal Pinang',2,1),(335,'Paniai',24,1),(336,'Parepare',28,1),(337,'Pariaman',32,1),(338,'Parigi Moutong',29,1),(339,'Pasaman',32,1),(340,'Pasaman Barat',32,1),(341,'Paser',15,1),(342,'Pasuruan',11,1),(343,'Pasuruan',11,1),(344,'Pati',10,1),(345,'Payakumbuh',32,1),(346,'Pegunungan Arfak',25,1),(347,'Pegunungan Bintang',24,1),(348,'Pekalongan',10,1),(349,'Pekalongan',10,1),(350,'Pekanbaru',26,1),(351,'Pelalawan',26,1),(352,'Pemalang',10,1),(353,'Pematang Siantar',34,1),(354,'Penajam Paser Utara',15,1),(355,'Pesawaran',18,1),(356,'Pesisir Barat',18,1),(357,'Pesisir Selatan',32,1),(358,'Pidie',21,1),(359,'Pidie Jaya',21,1),(360,'Pinrang',28,1),(361,'Pohuwato',7,1),(362,'Polewali Mandar',27,1),(363,'Ponorogo',11,1),(364,'Pontianak',12,1),(365,'Pontianak',12,1),(366,'Poso',29,1),(367,'Prabumulih',33,1),(368,'Pringsewu',18,1),(369,'Probolinggo',11,1),(370,'Probolinggo',11,1),(371,'Pulang Pisau',14,1),(372,'Pulau Morotai',20,1),(373,'Puncak',24,1),(374,'Puncak Jaya',24,1),(375,'Purbalingga',10,1),(376,'Purwakarta',9,1),(377,'Purworejo',10,1),(378,'Raja Ampat',25,1),(379,'Rejang Lebong',4,1),(380,'Rembang',10,1),(381,'Rokan Hilir',26,1),(382,'Rokan Hulu',26,1),(383,'Rote Ndao',23,1),(384,'Sabang',21,1),(385,'Sabu Raijua',23,1),(386,'Salatiga',10,1),(387,'Samarinda',15,1),(388,'Sambas',12,1),(389,'Samosir',34,1),(390,'Sampang',11,1),(391,'Sanggau',12,1),(392,'Sarmi',24,1),(393,'Sarolangun',8,1),(394,'Sawah Lunto',32,1),(395,'Sekadau',12,1),(396,'Selayar (Kepulauan Selayar)',28,1),(397,'Seluma',4,1),(398,'Semarang',10,1),(399,'Semarang',10,1),(400,'Seram Bagian Barat',19,1),(401,'Seram Bagian Timur',19,1),(402,'Serang',3,1),(403,'Serang',3,1),(404,'Serdang Bedagai',34,1),(405,'Seruyan',14,1),(406,'Siak',26,1),(407,'Sibolga',34,1),(408,'Sidenreng Rappang/Rapang',28,1),(409,'Sidoarjo',11,1),(410,'Sigi',29,1),(411,'Sijunjung (Sawah Lunto Sijunjung)',32,1),(412,'Sikka',23,1),(413,'Simalungun',34,1),(414,'Simeulue',21,1),(415,'Singkawang',12,1),(416,'Sinjai',28,1),(417,'Sintang',12,1),(418,'Situbondo',11,1),(419,'Sleman',5,1),(420,'Solok',32,1),(421,'Solok',32,1),(422,'Solok Selatan',32,1),(423,'Soppeng',28,1),(424,'Sorong',25,1),(425,'Sorong',25,1),(426,'Sorong Selatan',25,1),(427,'Sragen',10,1),(428,'Subang',9,1),(429,'Subulussalam',21,1),(430,'Sukabumi',9,1),(431,'Sukabumi',9,1),(432,'Sukamara',14,1),(433,'Sukoharjo',10,1),(434,'Sumba Barat',23,1),(435,'Sumba Barat Daya',23,1),(436,'Sumba Tengah',23,1),(437,'Sumba Timur',23,1),(438,'Sumbawa',22,1),(439,'Sumbawa Barat',22,1),(440,'Sumedang',9,1),(441,'Sumenep',11,1),(442,'Sungaipenuh',8,1),(443,'Supiori',24,1),(444,'Surabaya',11,1),(445,'Surakarta (Solo)',10,1),(446,'Tabalong',13,1),(447,'Tabanan',1,1),(448,'Takalar',28,1),(449,'Tambrauw',25,1),(450,'Tana Tidung',16,1),(451,'Tana Toraja',28,1),(452,'Tanah Bumbu',13,1),(453,'Tanah Datar',32,1),(454,'Tanah Laut',13,1),(455,'Tangerang',3,1),(456,'Tangerang',3,1),(457,'Tangerang Selatan',3,1),(458,'Tanggamus',18,1),(459,'Tanjung Balai',34,1),(460,'Tanjung Jabung Barat',8,1),(461,'Tanjung Jabung Timur',8,1),(462,'Tanjung Pinang',17,1),(463,'Tapanuli Selatan',34,1),(464,'Tapanuli Tengah',34,1),(465,'Tapanuli Utara',34,1),(466,'Tapin',13,1),(467,'Tarakan',16,1),(468,'Tasikmalaya',9,1),(469,'Tasikmalaya',9,1),(470,'Tebing Tinggi',34,1),(471,'Tebo',8,1),(472,'Tegal',10,1),(473,'Tegal',10,1),(474,'Teluk Bintuni',25,1),(475,'Teluk Wondama',25,1),(476,'Temanggung',10,1),(477,'Ternate',20,1),(478,'Tidore Kepulauan',20,1),(479,'Timor Tengah Selatan',23,1),(480,'Timor Tengah Utara',23,1),(481,'Toba Samosir',34,1),(482,'Tojo Una-Una',29,1),(483,'Toli-Toli',29,1),(484,'Tolikara',24,1),(485,'Tomohon',31,1),(486,'Toraja Utara',28,1),(487,'Trenggalek',11,1),(488,'Tual',19,1),(489,'Tuban',11,1),(490,'Tulang Bawang',18,1),(491,'Tulang Bawang Barat',18,1),(492,'Tulungagung',11,1),(493,'Wajo',28,1),(494,'Wakatobi',30,1),(495,'Waropen',24,1),(496,'Way Kanan',18,1),(497,'Wonogiri',10,1),(498,'Wonosobo',10,1),(499,'Yahukimo',24,1),(500,'Yalimo',24,1),(501,'Yogyakarta',5,1);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_eng` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `address_ind` text,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `maps` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `phone_1` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_2` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text,
  `about_eng` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `about_ind` text,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `company` */

insert  into `company`(`id`,`name`,`address_eng`,`address_ind`,`city_id`,`province_id`,`maps`,`phone_1`,`phone_2`,`email_1`,`email_2`,`fax`,`logo`,`about_eng`,`about_ind`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'Company Name','Company Address','Alamat Perusahaan',403,3,'&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.1840187100847!2d106.760547!3d-6.239461!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0dd66d189fd%3A0x2fa9d2a5d3f06f2!2sJl.%20Kramat%20No.24%2C%20RT.7%2FRW.4%2C%20Ulujami%2C%20Kec.%20Pesanggrahan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012250!5e0!3m2!1sen!2sid!4v1608979170735!5m2!1sen!2sid&quot; width=&quot;800&quot; height=&quot;600&quot; frameborder=&quot;0&quot; style=&quot;border:0;&quot; allowfullscreen=&quot;&quot; aria-hidden=&quot;false&quot; tabindex=&quot;0&quot;&gt;&lt;/iframe&gt;','085881239998',NULL,'dionisius.lg@gmail.com',NULL,NULL,'d0a63eb2ab6c722f3bbc3caf596a7aa4.png','<div class=\"row\">\r\n<div class=\"col-md-6\"><img class=\"img-fluid\" src=\"http://localhost/ci-company/files/editor/about.jpg\" alt=\"\" width=\"1024\" height=\"768\" /></div>\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Company Name</span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span><span style=\"font-size: 12pt;\"><em>asd</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n<p><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></p>\r\n</div>\r\n</div>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Vision<br /></span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p>\r\n<p><span style=\"font-size: 12pt;\"><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Mission</span></strong></span></span></p>\r\n<p><span style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</span></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Goals</span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n</div>\r\n</div>','<div class=\"row\">\r\n<div class=\"col-md-6\"><img class=\"img-fluid\" src=\"http://localhost/ci-company/files/editor/about.jpg\" alt=\"\" width=\"1024\" height=\"768\" /></div>\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Nama Perusahaan<br /></span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n<p><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></p>\r\n</div>\r\n</div>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Visi<br /></span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p>\r\n<p><span style=\"font-size: 12pt;\"><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Misi</span></strong></span></span></p>\r\n<p><span style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</span></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Tujuan</span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>\r\n</ul>\r\n</div>\r\n</div>','2021-02-28 01:25:50',1,60,1);

/*Table structure for table `company_advantages` */

DROP TABLE IF EXISTS `company_advantages`;

CREATE TABLE `company_advantages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_eng` varchar(100) DEFAULT NULL,
  `title_ind` varchar(100) DEFAULT NULL,
  `detail_eng` text,
  `detail_ind` text,
  `company_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `company_advantages` */

insert  into `company_advantages`(`id`,`title_eng`,`title_ind`,`detail_eng`,`detail_ind`,`company_id`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (3,'Reliable','Handal','Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi','Kami handal',1,'2021-02-20 16:59:52',1,'2021-02-27 22:42:09',1,5,1),(5,'Trusted','Terpercaya','We are trusted','Kami terpercaya',1,'2021-02-24 17:41:09',1,NULL,NULL,0,1),(6,'The Best','Terbaik','We are the best','Kami terbaik',1,'2021-02-24 17:41:56',1,'2021-02-27 22:42:23',1,2,1);

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `phone_1` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `phone_2` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `birth_place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender_id` tinyint(1) DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `religion_id` int(10) unsigned DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik_email` (`nik`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`nik`,`fullname`,`email`,`phone_1`,`phone_2`,`birth_place`,`birth_date`,`gender_id`,`address`,`city_id`,`province_id`,`religion_id`,`photo`,`user_id`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'1234','Dionisius Lumrang Gesangie','dion@jsm.co.id','08588123998',NULL,'Jakarta','1991-10-30',1,'Jalan Kramat Ulujami',NULL,NULL,NULL,NULL,1,'2021-02-20 19:22:42',1,'2021-02-22 13:15:27',1,3,1),(2,'12345','Ridho','ridho@jsm.co.id','1234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-02-28 02:19:35',1,NULL,NULL,0,1);

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `provinces` */

insert  into `provinces`(`id`,`name`,`is_active`) values (1,'Bali',1),(2,'Bangka Belitung',1),(3,'Banten',1),(4,'Bengkulu',1),(5,'DI Yogyakarta',1),(6,'DKI Jakarta',1),(7,'Gorontalo',1),(8,'Jambi',1),(9,'Jawa Barat',1),(10,'Jawa Tengah',1),(11,'Jawa Timur',1),(12,'Kalimantan Barat',1),(13,'Kalimantan Selatan',1),(14,'Kalimantan Tengah',1),(15,'Kalimantan Timur',1),(16,'Kalimantan Utara',1),(17,'Kepulauan Riau',1),(18,'Lampung',1),(19,'Maluku',1),(20,'Maluku Utara',1),(21,'Nanggroe Aceh Darussalam (NAD)',1),(22,'Nusa Tenggara Barat (NTB)',1),(23,'Nusa Tenggara Timur (NTT)',1),(24,'Papua',1),(25,'Papua Barat',1),(26,'Riau',1),(27,'Sulawesi Barat',1),(28,'Sulawesi Selatan',1),(29,'Sulawesi Tengah',1),(30,'Sulawesi Tenggara',1),(31,'Sulawesi Utara',1),(32,'Sumatera Barat',1),(33,'Sumatera Selatan',1),(34,'Sumatera Utara',1);

/*Table structure for table `sliders` */

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `link_to` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `sliders` */

insert  into `sliders`(`id`,`picture`,`order_number`,`link_to`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (5,'31b1a92fc33c6158a6783f06b7537755.jpg',1,NULL,'2021-02-27 02:06:38',NULL,'2021-02-27 21:34:47',NULL,3,1),(6,'da6522f2f6bdde30abc7f55274de60a9.jpg',2,NULL,'2021-02-27 03:38:31',NULL,NULL,NULL,0,1),(7,'d0e6eb660774e718419d25b2eb01066c.jpg',3,'http://localhost/ci-company/admin/sliders','2021-02-27 03:38:51',NULL,'2021-02-27 22:10:15',NULL,12,1);

/*Table structure for table `user_events` */

DROP TABLE IF EXISTS `user_events`;

CREATE TABLE `user_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_events` */

insert  into `user_events`(`id`,`event_name`,`event_date`,`ip_address`,`agent`,`platform`,`user_agent`,`user_id`) values (1,'Logout','2021-03-01 15:31:52',NULL,NULL,NULL,NULL,NULL),(2,'Logout','2021-03-01 15:33:11',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `user_levels` */

DROP TABLE IF EXISTS `user_levels`;

CREATE TABLE `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_levels` */

insert  into `user_levels`(`id`,`name`,`is_active`) values (1,'Admin',1),(2,'User',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_level_id` int(10) unsigned DEFAULT NULL,
  `host_address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_event_date` datetime DEFAULT NULL,
  `last_event_id` int(10) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT '0',
  `verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_password_request` tinyint(1) NOT NULL DEFAULT '0',
  `is_register` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`user_level_id`,`host_address`,`ip_address`,`last_event_date`,`last_event_id`,`request_date`,`register_date`,`register_user_id`,`update_date`,`update_user_id`,`update_count`,`verification_code`,`is_password_request`,`is_register`,`is_active`) values (1,'dion','$2y$10$0fs3zNwpuTsug793bwo6hu6ecK1azoNYXFg4Q8xDj4Uj2GIHvIVRC','dion@jsm.co.id',1,NULL,NULL,NULL,NULL,'2021-02-20 18:36:14','2021-03-01 15:20:54',1,'2021-03-01 15:20:54',1,7,NULL,0,1,1),(2,'ridho','$2y$10$lElCid8kWbAvfziC9yhfiu.XboMJhVaSeC0FLRlqBMG3MK0xhd7fq','ridho@jsm.co.id',1,NULL,NULL,NULL,NULL,'2021-02-20 18:47:12','2021-03-22 21:19:07',2,'2021-03-22 21:19:07',2,8,NULL,0,1,1);

/*Table structure for table `users_old` */

DROP TABLE IF EXISTS `users_old`;

CREATE TABLE `users_old` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'username',
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '$2y$10$nnOAcQOtEFbImyU6JZfZouA7sTcY68zCoj/gB.5Er3HneeXKS5dta',
  `fullname` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `phone_1` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `phone_2` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `birthplace` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender_id` tinyint(1) DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion_id` int(10) unsigned DEFAULT NULL,
  `user_level_id` int(10) unsigned DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `last_event_date` datetime DEFAULT NULL,
  `last_event_id` int(10) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_logout_date` datetime DEFAULT NULL,
  `host_address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_password_request` tinyint(1) NOT NULL DEFAULT '0',
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_email` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_old` */

insert  into `users_old`(`id`,`username`,`password`,`fullname`,`email`,`phone_1`,`phone_2`,`birthplace`,`birthdate`,`gender_id`,`address`,`city_id`,`province_id`,`photo`,`religion_id`,`user_level_id`,`join_date`,`last_event_date`,`last_event_id`,`last_login_date`,`last_logout_date`,`host_address`,`ip_address`,`verification_code`,`is_password_request`,`is_online`,`is_active`) values (1,'dion','$2y$10$0fs3zNwpuTsug793bwo6hu6ecK1azoNYXFg4Q8xDj4Uj2GIHvIVRC','Dionisius Lumrang Gesangie','dionisius.lg@gmail.com','085881239998',NULL,'Jakarta','1991-10-30',1,'Jl. Ulujami',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,1);

/* Trigger structure for table `company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `company_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `company_before_update` BEFORE UPDATE ON `company` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `company_advantages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `company_advantages_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `company_advantages_before_insert` BEFORE INSERT ON `company_advantages` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `company_advantages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `company_advantages_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `company_advantages_before_update` BEFORE UPDATE ON `company_advantages` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `employees` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `employees_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `employees_before_insert` BEFORE INSERT ON `employees` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `employees` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `employees_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `employees_before_update` BEFORE UPDATE ON `employees` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `sliders` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sliders_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sliders_before_insert` BEFORE INSERT ON `sliders` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `sliders` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sliders_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sliders_before_update` BEFORE UPDATE ON `sliders` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_before_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
        SET NEW.request_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_before_update` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
        
        IF (NEW.is_register = 1) THEN
            SET NEW.register_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        END IF;
    END */$$


DELIMITER ;

/* Function  structure for function  `IS_EMPLOYEES` */

/*!50003 DROP FUNCTION IF EXISTS `IS_EMPLOYEES` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `IS_EMPLOYEES`(get_user_id INT) RETURNS tinyint(1)
BEGIN
        DECLARE count_id INT(11);
        DECLARE is_employees TINYINT(1);
        SELECT COUNT(id) INTO count_id FROM employees WHERE user_id = get_user_id;
        IF(count_id = 0) THEN
            SET is_employees = '0';
        ELSE
            SET is_employees = '1';
        END IF;
        RETURN is_employees;
    END */$$
DELIMITER ;

/* Function  structure for function  `SPLIT_STR` */

/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STR` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR`(
  str VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),
       LENGTH(SUBSTRING_INDEX(str, delim, pos -1)) + 1),
       delim, '') */$$
DELIMITER ;

/*Table structure for table `view_cities` */

DROP TABLE IF EXISTS `view_cities`;

/*!50001 DROP VIEW IF EXISTS `view_cities` */;
/*!50001 DROP TABLE IF EXISTS `view_cities` */;

/*!50001 CREATE TABLE  `view_cities`(
 `id` int(11) ,
 `name` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_company` */

DROP TABLE IF EXISTS `view_company`;

/*!50001 DROP VIEW IF EXISTS `view_company` */;
/*!50001 DROP TABLE IF EXISTS `view_company` */;

/*!50001 CREATE TABLE  `view_company`(
 `id` int(11) ,
 `name` varchar(100) ,
 `address_eng` text ,
 `address_ind` text ,
 `city_id` int(11) ,
 `city` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `maps` text ,
 `phone_1` varchar(30) ,
 `phone_2` varchar(30) ,
 `email_1` varchar(100) ,
 `email_2` varchar(100) ,
 `fax` varchar(30) ,
 `logo` text ,
 `about_eng` text ,
 `about_ind` text ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) 
)*/;

/*Table structure for table `view_company_advantages` */

DROP TABLE IF EXISTS `view_company_advantages`;

/*!50001 DROP VIEW IF EXISTS `view_company_advantages` */;
/*!50001 DROP TABLE IF EXISTS `view_company_advantages` */;

/*!50001 CREATE TABLE  `view_company_advantages`(
 `id` int(11) ,
 `title_eng` varchar(100) ,
 `title_ind` varchar(100) ,
 `detail_eng` text ,
 `detail_ind` text ,
 `company_id` int(11) ,
 `company` varchar(100) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_employees` */

DROP TABLE IF EXISTS `view_employees`;

/*!50001 DROP VIEW IF EXISTS `view_employees` */;
/*!50001 DROP TABLE IF EXISTS `view_employees` */;

/*!50001 CREATE TABLE  `view_employees`(
 `id` int(10) unsigned ,
 `nik` varchar(20) ,
 `fullname` varchar(100) ,
 `email` varchar(100) ,
 `phone_1` varchar(30) ,
 `phone_2` varchar(30) ,
 `birth_place` varchar(100) ,
 `birth_date` date ,
 `gender_id` tinyint(1) ,
 `gender` varchar(6) ,
 `address` text ,
 `city_id` int(11) ,
 `city` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `religion_id` int(10) unsigned ,
 `photo` varchar(255) ,
 `user_id` int(11) ,
 `username` varchar(30) ,
 `user_level` varchar(100) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(100) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(100) ,
 `update_count` int(11) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_sliders` */

DROP TABLE IF EXISTS `view_sliders`;

/*!50001 DROP VIEW IF EXISTS `view_sliders` */;
/*!50001 DROP TABLE IF EXISTS `view_sliders` */;

/*!50001 CREATE TABLE  `view_sliders`(
 `id` int(11) unsigned ,
 `picture` varchar(255) ,
 `order_number` int(11) ,
 `link_to` text ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_users` */

DROP TABLE IF EXISTS `view_users`;

/*!50001 DROP VIEW IF EXISTS `view_users` */;
/*!50001 DROP TABLE IF EXISTS `view_users` */;

/*!50001 CREATE TABLE  `view_users`(
 `id` int(10) unsigned ,
 `username` varchar(30) ,
 `password` varchar(100) ,
 `user_level_id` int(10) unsigned ,
 `user_level` varchar(100) ,
 `host_address` varchar(100) ,
 `ip_address` varchar(100) ,
 `last_event_date` datetime ,
 `last_event_id` int(10) ,
 `request_date` datetime ,
 `register_date` datetime ,
 `register_user_id` int(11) ,
 `register_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `verification_code` varchar(255) ,
 `is_password_request` tinyint(1) ,
 `is_employees` int(1) ,
 `is_register` tinyint(1) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_users_old` */

DROP TABLE IF EXISTS `view_users_old`;

/*!50001 DROP VIEW IF EXISTS `view_users_old` */;
/*!50001 DROP TABLE IF EXISTS `view_users_old` */;

/*!50001 CREATE TABLE  `view_users_old`(
 `id` int(10) unsigned ,
 `username` varchar(20) ,
 `fullname` varchar(100) ,
 `email` varchar(100) ,
 `phone_1` varchar(30) ,
 `phone_2` varchar(30) ,
 `birthplace` varchar(100) ,
 `birthdate` date ,
 `gender_id` tinyint(1) ,
 `gender` varchar(6) ,
 `address` text ,
 `city_id` int(11) ,
 `city` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `photo` varchar(255) ,
 `religion_id` int(10) unsigned ,
 `user_level_id` int(10) unsigned ,
 `user_level` varchar(100) ,
 `join_date` datetime ,
 `last_event_date` datetime ,
 `last_event_id` int(10) ,
 `last_login_date` datetime ,
 `last_logout_date` datetime ,
 `host_address` varchar(100) ,
 `ip_address` varchar(100) ,
 `verification_code` varchar(255) ,
 `is_password_request` tinyint(1) ,
 `is_online` tinyint(1) ,
 `is_active` tinyint(1) 
)*/;

/*View structure for view view_cities */

/*!50001 DROP TABLE IF EXISTS `view_cities` */;
/*!50001 DROP VIEW IF EXISTS `view_cities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cities` AS select `cities`.`id` AS `id`,`cities`.`name` AS `name`,`cities`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,`cities`.`is_active` AS `is_active` from (`cities` left join `provinces` on((`provinces`.`id` = `cities`.`province_id`))) group by `cities`.`id` */;

/*View structure for view view_company */

/*!50001 DROP TABLE IF EXISTS `view_company` */;
/*!50001 DROP VIEW IF EXISTS `view_company` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_company` AS select `company`.`id` AS `id`,`company`.`name` AS `name`,`company`.`address_eng` AS `address_eng`,`company`.`address_ind` AS `address_ind`,`company`.`city_id` AS `city_id`,`city`.`name` AS `city`,`company`.`province_id` AS `province_id`,`province`.`name` AS `province`,`company`.`maps` AS `maps`,`company`.`phone_1` AS `phone_1`,`company`.`phone_2` AS `phone_2`,`company`.`email_1` AS `email_1`,`company`.`email_2` AS `email_2`,`company`.`fax` AS `fax`,`company`.`logo` AS `logo`,`company`.`about_eng` AS `about_eng`,`company`.`about_ind` AS `about_ind`,`company`.`update_date` AS `update_date`,`company`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where (`users`.`id` = `company`.`update_user_id`)) AS `update_by`,`company`.`update_count` AS `update_count` from ((`company` left join `cities` `city` on((`city`.`id` = `company`.`city_id`))) left join `provinces` `province` on((`province`.`id` = `company`.`province_id`))) group by `company`.`id` limit 1 */;

/*View structure for view view_company_advantages */

/*!50001 DROP TABLE IF EXISTS `view_company_advantages` */;
/*!50001 DROP VIEW IF EXISTS `view_company_advantages` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_company_advantages` AS select `company_advantages`.`id` AS `id`,`company_advantages`.`title_eng` AS `title_eng`,`company_advantages`.`title_ind` AS `title_ind`,`company_advantages`.`detail_eng` AS `detail_eng`,`company_advantages`.`detail_ind` AS `detail_ind`,`company_advantages`.`company_id` AS `company_id`,`company`.`name` AS `company`,`company_advantages`.`create_date` AS `create_date`,`company_advantages`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where (`users`.`id` = `company_advantages`.`create_user_id`)) AS `create_by`,`company_advantages`.`update_date` AS `update_date`,`company_advantages`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where (`users`.`id` = `company_advantages`.`update_user_id`)) AS `update_by`,`company_advantages`.`update_count` AS `update_count`,`company_advantages`.`is_active` AS `is_active` from (`company_advantages` left join `company` on((`company`.`id` = `company_advantages`.`company_id`))) group by `company_advantages`.`id` */;

/*View structure for view view_employees */

/*!50001 DROP TABLE IF EXISTS `view_employees` */;
/*!50001 DROP VIEW IF EXISTS `view_employees` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_employees` AS select `employees`.`id` AS `id`,`employees`.`nik` AS `nik`,`employees`.`fullname` AS `fullname`,`employees`.`email` AS `email`,`employees`.`phone_1` AS `phone_1`,`employees`.`phone_2` AS `phone_2`,`employees`.`birth_place` AS `birth_place`,`employees`.`birth_date` AS `birth_date`,`employees`.`gender_id` AS `gender_id`,(case `employees`.`gender_id` when 1 then 'Male' when 2 then 'Female' else NULL end) AS `gender`,`employees`.`address` AS `address`,`employees`.`city_id` AS `city_id`,`cities`.`name` AS `city`,`employees`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,`employees`.`religion_id` AS `religion_id`,`employees`.`photo` AS `photo`,`employees`.`user_id` AS `user_id`,`users`.`username` AS `username`,(select `user_levels`.`name` from `user_levels` where (`user_levels`.`id` = `users`.`user_level_id`)) AS `user_level`,`employees`.`create_date` AS `create_date`,`employees`.`create_user_id` AS `create_user_id`,(select `users`.`email` from `users` where (`users`.`id` = `employees`.`create_user_id`)) AS `create_by`,`employees`.`update_date` AS `update_date`,`employees`.`update_user_id` AS `update_user_id`,(select `users`.`email` from `users` where (`users`.`id` = `employees`.`update_user_id`)) AS `update_by`,`employees`.`update_count` AS `update_count`,`employees`.`is_active` AS `is_active` from (((`employees` left join `cities` on((`cities`.`id` = `employees`.`city_id`))) left join `provinces` on((`provinces`.`id` = `employees`.`province_id`))) left join `users` on((`users`.`id` = `employees`.`user_id`))) group by `employees`.`id` */;

/*View structure for view view_sliders */

/*!50001 DROP TABLE IF EXISTS `view_sliders` */;
/*!50001 DROP VIEW IF EXISTS `view_sliders` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sliders` AS select `sliders`.`id` AS `id`,`sliders`.`picture` AS `picture`,`sliders`.`order_number` AS `order_number`,`sliders`.`link_to` AS `link_to`,`sliders`.`create_date` AS `create_date`,`sliders`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where (`users`.`id` = `sliders`.`create_user_id`)) AS `create_by`,`sliders`.`update_date` AS `update_date`,`sliders`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where (`users`.`id` = `sliders`.`update_user_id`)) AS `update_by`,`sliders`.`update_count` AS `update_count`,`sliders`.`is_active` AS `is_active` from `sliders` group by `sliders`.`id` */;

/*View structure for view view_users */

/*!50001 DROP TABLE IF EXISTS `view_users` */;
/*!50001 DROP VIEW IF EXISTS `view_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users` AS select `users`.`id` AS `id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`user_level_id` AS `user_level_id`,`user_levels`.`name` AS `user_level`,`users`.`host_address` AS `host_address`,`users`.`ip_address` AS `ip_address`,`users`.`last_event_date` AS `last_event_date`,`users`.`last_event_id` AS `last_event_id`,`users`.`request_date` AS `request_date`,`users`.`register_date` AS `register_date`,`users`.`register_user_id` AS `register_user_id`,(select `u`.`username` from `users` `u` where (`u`.`id` = `users`.`register_user_id`)) AS `register_by`,`users`.`update_date` AS `update_date`,`users`.`update_user_id` AS `update_user_id`,(select `u`.`username` from `users` `u` where (`u`.`id` = `users`.`update_user_id`)) AS `update_by`,`users`.`update_count` AS `update_count`,`users`.`verification_code` AS `verification_code`,`users`.`is_password_request` AS `is_password_request`,(select `IS_EMPLOYEES`(`users`.`id`)) AS `is_employees`,`users`.`is_register` AS `is_register`,`users`.`is_active` AS `is_active` from (`users` left join `user_levels` on((`user_levels`.`id` = `users`.`user_level_id`))) group by `users`.`id` */;

/*View structure for view view_users_old */

/*!50001 DROP TABLE IF EXISTS `view_users_old` */;
/*!50001 DROP VIEW IF EXISTS `view_users_old` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users_old` AS select `users_old`.`id` AS `id`,`users_old`.`username` AS `username`,`users_old`.`fullname` AS `fullname`,`users_old`.`email` AS `email`,`users_old`.`phone_1` AS `phone_1`,`users_old`.`phone_2` AS `phone_2`,`users_old`.`birthplace` AS `birthplace`,`users_old`.`birthdate` AS `birthdate`,`users_old`.`gender_id` AS `gender_id`,(case `users_old`.`gender_id` when 1 then 'Male' when 2 then 'Female' else NULL end) AS `gender`,`users_old`.`address` AS `address`,`users_old`.`city_id` AS `city_id`,`cities`.`name` AS `city`,`users_old`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,`users_old`.`photo` AS `photo`,`users_old`.`religion_id` AS `religion_id`,`users_old`.`user_level_id` AS `user_level_id`,`user_levels`.`name` AS `user_level`,`users_old`.`join_date` AS `join_date`,`users_old`.`last_event_date` AS `last_event_date`,`users_old`.`last_event_id` AS `last_event_id`,`users_old`.`last_login_date` AS `last_login_date`,`users_old`.`last_logout_date` AS `last_logout_date`,`users_old`.`host_address` AS `host_address`,`users_old`.`ip_address` AS `ip_address`,`users_old`.`verification_code` AS `verification_code`,`users_old`.`is_password_request` AS `is_password_request`,`users_old`.`is_online` AS `is_online`,`users_old`.`is_active` AS `is_active` from (((`users_old` left join `cities` on((`cities`.`id` = `users_old`.`city_id`))) left join `provinces` on((`provinces`.`id` = `users_old`.`province_id`))) left join `user_levels` on((`user_levels`.`id` = `users_old`.`user_level_id`))) group by `users_old`.`id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
