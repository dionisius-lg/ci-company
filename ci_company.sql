/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.2.3-MariaDB-log : Database - ci_company
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

/*Table structure for table `agency_locations` */

DROP TABLE IF EXISTS `agency_locations`;

CREATE TABLE `agency_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name_chn` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_local` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `agency_locations` */

insert  into `agency_locations`(`id`,`name`,`name_chn`,`slug`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_local`,`is_default`,`is_active`) values (1,'Indonesia','印尼','indonesia','2021-04-10 00:54:07',1,'2021-07-09 22:44:36',1,3,0,0,1),(2,'Hong Kong','香港','hong-kong','2021-04-10 00:54:23',1,'2021-07-09 22:44:57',1,5,1,1,1),(3,'Taiwan','台灣','taiwan','2021-04-10 00:54:38',1,'2021-07-09 22:47:15',1,4,1,1,1),(4,'Singapore','新加坡','singapore','2021-04-10 00:54:50',1,'2021-07-09 22:47:26',1,2,0,0,1),(5,'Middle East','中東','middle-east','2021-04-10 00:55:01',1,'2021-07-09 22:47:53',1,2,0,0,1),(6,'Malaysia','馬來西亞','malaysia','2021-04-10 00:55:15',1,'2021-07-09 22:47:41',1,2,0,0,1),(7,'Others','其他國家','others','2021-04-10 00:55:38',1,'2021-07-09 22:48:57',1,13,0,0,1);

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_url` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `dimension` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blogs` */

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`province_id`,`is_active`) values (1,'Aceh Barat',21,1),(2,'Aceh Barat Daya',21,1),(3,'Aceh Besar',21,1),(4,'Aceh Jaya',21,1),(5,'Aceh Selatan',21,1),(6,'Aceh Singkil',21,1),(7,'Aceh Tamiang',21,1),(8,'Aceh Tengah',21,1),(9,'Aceh Tenggara',21,1),(10,'Aceh Timur',21,1),(11,'Aceh Utara',21,1),(12,'Agam',32,1),(13,'Alor',23,1),(14,'Ambon',19,1),(15,'Asahan',34,1),(16,'Asmat',24,1),(17,'Badung',1,1),(18,'Balangan',13,1),(19,'Balikpapan',15,1),(20,'Banda Aceh',21,1),(21,'Bandar Lampung',18,1),(22,'Bandung',9,1),(23,'Bandung',9,1),(24,'Bandung Barat',9,1),(25,'Banggai',29,1),(26,'Banggai Kepulauan',29,1),(27,'Bangka',2,1),(28,'Bangka Barat',2,1),(29,'Bangka Selatan',2,1),(30,'Bangka Tengah',2,1),(31,'Bangkalan',11,1),(32,'Bangli',1,1),(33,'Banjar',13,1),(34,'Banjar',9,1),(35,'Banjarbaru',13,1),(36,'Banjarmasin',13,1),(37,'Banjarnegara',10,1),(38,'Bantaeng',28,1),(39,'Bantul',5,1),(40,'Banyuasin',33,1),(41,'Banyumas',10,1),(42,'Banyuwangi',11,1),(43,'Barito Kuala',13,1),(44,'Barito Selatan',14,1),(45,'Barito Timur',14,1),(46,'Barito Utara',14,1),(47,'Barru',28,1),(48,'Batam',17,1),(49,'Batang',10,1),(50,'Batang Hari',8,1),(51,'Batu',11,1),(52,'Batu Bara',34,1),(53,'Bau-Bau',30,1),(54,'Bekasi',9,1),(55,'Bekasi',9,1),(56,'Belitung',2,1),(57,'Belitung Timur',2,1),(58,'Belu',23,1),(59,'Bener Meriah',21,1),(60,'Bengkalis',26,1),(61,'Bengkayang',12,1),(62,'Bengkulu',4,1),(63,'Bengkulu Selatan',4,1),(64,'Bengkulu Tengah',4,1),(65,'Bengkulu Utara',4,1),(66,'Berau',15,1),(67,'Biak Numfor',24,1),(68,'Bima',22,1),(69,'Bima',22,1),(70,'Binjai',34,1),(71,'Bintan',17,1),(72,'Bireuen',21,1),(73,'Bitung',31,1),(74,'Blitar',11,1),(75,'Blitar',11,1),(76,'Blora',10,1),(77,'Boalemo',7,1),(78,'Bogor',9,1),(79,'Bogor',9,1),(80,'Bojonegoro',11,1),(81,'Bolaang Mongondow (Bolmong)',31,1),(82,'Bolaang Mongondow Selatan',31,1),(83,'Bolaang Mongondow Timur',31,1),(84,'Bolaang Mongondow Utara',31,1),(85,'Bombana',30,1),(86,'Bondowoso',11,1),(87,'Bone',28,1),(88,'Bone Bolango',7,1),(89,'Bontang',15,1),(90,'Boven Digoel',24,1),(91,'Boyolali',10,1),(92,'Brebes',10,1),(93,'Bukittinggi',32,1),(94,'Buleleng',1,1),(95,'Bulukumba',28,1),(96,'Bulungan (Bulongan)',16,1),(97,'Bungo',8,1),(98,'Buol',29,1),(99,'Buru',19,1),(100,'Buru Selatan',19,1),(101,'Buton',30,1),(102,'Buton Utara',30,1),(103,'Ciamis',9,1),(104,'Cianjur',9,1),(105,'Cilacap',10,1),(106,'Cilegon',3,1),(107,'Cimahi',9,1),(108,'Cirebon',9,1),(109,'Cirebon',9,1),(110,'Dairi',34,1),(111,'Deiyai (Deliyai)',24,1),(112,'Deli Serdang',34,1),(113,'Demak',10,1),(114,'Denpasar',1,1),(115,'Depok',9,1),(116,'Dharmasraya',32,1),(117,'Dogiyai',24,1),(118,'Dompu',22,1),(119,'Donggala',29,1),(120,'Dumai',26,1),(121,'Empat Lawang',33,1),(122,'Ende',23,1),(123,'Enrekang',28,1),(124,'Fakfak',25,1),(125,'Flores Timur',23,1),(126,'Garut',9,1),(127,'Gayo Lues',21,1),(128,'Gianyar',1,1),(129,'Gorontalo',7,1),(130,'Gorontalo',7,1),(131,'Gorontalo Utara',7,1),(132,'Gowa',28,1),(133,'Gresik',11,1),(134,'Grobogan',10,1),(135,'Gunung Kidul',5,1),(136,'Gunung Mas',14,1),(137,'Gunungsitoli',34,1),(138,'Halmahera Barat',20,1),(139,'Halmahera Selatan',20,1),(140,'Halmahera Tengah',20,1),(141,'Halmahera Timur',20,1),(142,'Halmahera Utara',20,1),(143,'Hulu Sungai Selatan',13,1),(144,'Hulu Sungai Tengah',13,1),(145,'Hulu Sungai Utara',13,1),(146,'Humbang Hasundutan',34,1),(147,'Indragiri Hilir',26,1),(148,'Indragiri Hulu',26,1),(149,'Indramayu',9,1),(150,'Intan Jaya',24,1),(151,'Jakarta Barat',6,1),(152,'Jakarta Pusat',6,1),(153,'Jakarta Selatan',6,1),(154,'Jakarta Timur',6,1),(155,'Jakarta Utara',6,1),(156,'Jambi',8,1),(157,'Jayapura',24,1),(158,'Jayapura',24,1),(159,'Jayawijaya',24,1),(160,'Jember',11,1),(161,'Jembrana',1,1),(162,'Jeneponto',28,1),(163,'Jepara',10,1),(164,'Jombang',11,1),(165,'Kaimana',25,1),(166,'Kampar',26,1),(167,'Kapuas',14,1),(168,'Kapuas Hulu',12,1),(169,'Karanganyar',10,1),(170,'Karangasem',1,1),(171,'Karawang',9,1),(172,'Karimun',17,1),(173,'Karo',34,1),(174,'Katingan',14,1),(175,'Kaur',4,1),(176,'Kayong Utara',12,1),(177,'Kebumen',10,1),(178,'Kediri',11,1),(179,'Kediri',11,1),(180,'Keerom',24,1),(181,'Kendal',10,1),(182,'Kendari',30,1),(183,'Kepahiang',4,1),(184,'Kepulauan Anambas',17,1),(185,'Kepulauan Aru',19,1),(186,'Kepulauan Mentawai',32,1),(187,'Kepulauan Meranti',26,1),(188,'Kepulauan Sangihe',31,1),(189,'Kepulauan Seribu',6,1),(190,'Kepulauan Siau Tagulandang Biaro (Sitaro)',31,1),(191,'Kepulauan Sula',20,1),(192,'Kepulauan Talaud',31,1),(193,'Kepulauan Yapen (Yapen Waropen)',24,1),(194,'Kerinci',8,1),(195,'Ketapang',12,1),(196,'Klaten',10,1),(197,'Klungkung',1,1),(198,'Kolaka',30,1),(199,'Kolaka Utara',30,1),(200,'Konawe',30,1),(201,'Konawe Selatan',30,1),(202,'Konawe Utara',30,1),(203,'Kotabaru',13,1),(204,'Kotamobagu',31,1),(205,'Kotawaringin Barat',14,1),(206,'Kotawaringin Timur',14,1),(207,'Kuantan Singingi',26,1),(208,'Kubu Raya',12,1),(209,'Kudus',10,1),(210,'Kulon Progo',5,1),(211,'Kuningan',9,1),(212,'Kupang',23,1),(213,'Kupang',23,1),(214,'Kutai Barat',15,1),(215,'Kutai Kartanegara',15,1),(216,'Kutai Timur',15,1),(217,'Labuhan Batu',34,1),(218,'Labuhan Batu Selatan',34,1),(219,'Labuhan Batu Utara',34,1),(220,'Lahat',33,1),(221,'Lamandau',14,1),(222,'Lamongan',11,1),(223,'Lampung Barat',18,1),(224,'Lampung Selatan',18,1),(225,'Lampung Tengah',18,1),(226,'Lampung Timur',18,1),(227,'Lampung Utara',18,1),(228,'Landak',12,1),(229,'Langkat',34,1),(230,'Langsa',21,1),(231,'Lanny Jaya',24,1),(232,'Lebak',3,1),(233,'Lebong',4,1),(234,'Lembata',23,1),(235,'Lhokseumawe',21,1),(236,'Lima Puluh Koto/Kota',32,1),(237,'Lingga',17,1),(238,'Lombok Barat',22,1),(239,'Lombok Tengah',22,1),(240,'Lombok Timur',22,1),(241,'Lombok Utara',22,1),(242,'Lubuk Linggau',33,1),(243,'Lumajang',11,1),(244,'Luwu',28,1),(245,'Luwu Timur',28,1),(246,'Luwu Utara',28,1),(247,'Madiun',11,1),(248,'Madiun',11,1),(249,'Magelang',10,1),(250,'Magelang',10,1),(251,'Magetan',11,1),(252,'Majalengka',9,1),(253,'Majene',27,1),(254,'Makassar',28,1),(255,'Malang',11,1),(256,'Malang',11,1),(257,'Malinau',16,1),(258,'Maluku Barat Daya',19,1),(259,'Maluku Tengah',19,1),(260,'Maluku Tenggara',19,1),(261,'Maluku Tenggara Barat',19,1),(262,'Mamasa',27,1),(263,'Mamberamo Raya',24,1),(264,'Mamberamo Tengah',24,1),(265,'Mamuju',27,1),(266,'Mamuju Utara',27,1),(267,'Manado',31,1),(268,'Mandailing Natal',34,1),(269,'Manggarai',23,1),(270,'Manggarai Barat',23,1),(271,'Manggarai Timur',23,1),(272,'Manokwari',25,1),(273,'Manokwari Selatan',25,1),(274,'Mappi',24,1),(275,'Maros',28,1),(276,'Mataram',22,1),(277,'Maybrat',25,1),(278,'Medan',34,1),(279,'Melawi',12,1),(280,'Merangin',8,1),(281,'Merauke',24,1),(282,'Mesuji',18,1),(283,'Metro',18,1),(284,'Mimika',24,1),(285,'Minahasa',31,1),(286,'Minahasa Selatan',31,1),(287,'Minahasa Tenggara',31,1),(288,'Minahasa Utara',31,1),(289,'Mojokerto',11,1),(290,'Mojokerto',11,1),(291,'Morowali',29,1),(292,'Muara Enim',33,1),(293,'Muaro Jambi',8,1),(294,'Muko Muko',4,1),(295,'Muna',30,1),(296,'Murung Raya',14,1),(297,'Musi Banyuasin',33,1),(298,'Musi Rawas',33,1),(299,'Nabire',24,1),(300,'Nagan Raya',21,1),(301,'Nagekeo',23,1),(302,'Natuna',17,1),(303,'Nduga',24,1),(304,'Ngada',23,1),(305,'Nganjuk',11,1),(306,'Ngawi',11,1),(307,'Nias',34,1),(308,'Nias Barat',34,1),(309,'Nias Selatan',34,1),(310,'Nias Utara',34,1),(311,'Nunukan',16,1),(312,'Ogan Ilir',33,1),(313,'Ogan Komering Ilir',33,1),(314,'Ogan Komering Ulu',33,1),(315,'Ogan Komering Ulu Selatan',33,1),(316,'Ogan Komering Ulu Timur',33,1),(317,'Pacitan',11,1),(318,'Padang',32,1),(319,'Padang Lawas',34,1),(320,'Padang Lawas Utara',34,1),(321,'Padang Panjang',32,1),(322,'Padang Pariaman',32,1),(323,'Padang Sidempuan',34,1),(324,'Pagar Alam',33,1),(325,'Pakpak Bharat',34,1),(326,'Palangka Raya',14,1),(327,'Palembang',33,1),(328,'Palopo',28,1),(329,'Palu',29,1),(330,'Pamekasan',11,1),(331,'Pandeglang',3,1),(332,'Pangandaran',9,1),(333,'Pangkajene Kepulauan',28,1),(334,'Pangkal Pinang',2,1),(335,'Paniai',24,1),(336,'Parepare',28,1),(337,'Pariaman',32,1),(338,'Parigi Moutong',29,1),(339,'Pasaman',32,1),(340,'Pasaman Barat',32,1),(341,'Paser',15,1),(342,'Pasuruan',11,1),(343,'Pasuruan',11,1),(344,'Pati',10,1),(345,'Payakumbuh',32,1),(346,'Pegunungan Arfak',25,1),(347,'Pegunungan Bintang',24,1),(348,'Pekalongan',10,1),(349,'Pekalongan',10,1),(350,'Pekanbaru',26,1),(351,'Pelalawan',26,1),(352,'Pemalang',10,1),(353,'Pematang Siantar',34,1),(354,'Penajam Paser Utara',15,1),(355,'Pesawaran',18,1),(356,'Pesisir Barat',18,1),(357,'Pesisir Selatan',32,1),(358,'Pidie',21,1),(359,'Pidie Jaya',21,1),(360,'Pinrang',28,1),(361,'Pohuwato',7,1),(362,'Polewali Mandar',27,1),(363,'Ponorogo',11,1),(364,'Pontianak',12,1),(365,'Pontianak',12,1),(366,'Poso',29,1),(367,'Prabumulih',33,1),(368,'Pringsewu',18,1),(369,'Probolinggo',11,1),(370,'Probolinggo',11,1),(371,'Pulang Pisau',14,1),(372,'Pulau Morotai',20,1),(373,'Puncak',24,1),(374,'Puncak Jaya',24,1),(375,'Purbalingga',10,1),(376,'Purwakarta',9,1),(377,'Purworejo',10,1),(378,'Raja Ampat',25,1),(379,'Rejang Lebong',4,1),(380,'Rembang',10,1),(381,'Rokan Hilir',26,1),(382,'Rokan Hulu',26,1),(383,'Rote Ndao',23,1),(384,'Sabang',21,1),(385,'Sabu Raijua',23,1),(386,'Salatiga',10,1),(387,'Samarinda',15,1),(388,'Sambas',12,1),(389,'Samosir',34,1),(390,'Sampang',11,1),(391,'Sanggau',12,1),(392,'Sarmi',24,1),(393,'Sarolangun',8,1),(394,'Sawah Lunto',32,1),(395,'Sekadau',12,1),(396,'Selayar (Kepulauan Selayar)',28,1),(397,'Seluma',4,1),(398,'Semarang',10,1),(399,'Semarang',10,1),(400,'Seram Bagian Barat',19,1),(401,'Seram Bagian Timur',19,1),(402,'Serang',3,1),(403,'Serang',3,1),(404,'Serdang Bedagai',34,1),(405,'Seruyan',14,1),(406,'Siak',26,1),(407,'Sibolga',34,1),(408,'Sidenreng Rappang/Rapang',28,1),(409,'Sidoarjo',11,1),(410,'Sigi',29,1),(411,'Sijunjung (Sawah Lunto Sijunjung)',32,1),(412,'Sikka',23,1),(413,'Simalungun',34,1),(414,'Simeulue',21,1),(415,'Singkawang',12,1),(416,'Sinjai',28,1),(417,'Sintang',12,1),(418,'Situbondo',11,1),(419,'Sleman',5,1),(420,'Solok',32,1),(421,'Solok',32,1),(422,'Solok Selatan',32,1),(423,'Soppeng',28,1),(424,'Sorong',25,1),(425,'Sorong',25,1),(426,'Sorong Selatan',25,1),(427,'Sragen',10,1),(428,'Subang',9,1),(429,'Subulussalam',21,1),(430,'Sukabumi',9,1),(431,'Sukabumi',9,1),(432,'Sukamara',14,1),(433,'Sukoharjo',10,1),(434,'Sumba Barat',23,1),(435,'Sumba Barat Daya',23,1),(436,'Sumba Tengah',23,1),(437,'Sumba Timur',23,1),(438,'Sumbawa',22,1),(439,'Sumbawa Barat',22,1),(440,'Sumedang',9,1),(441,'Sumenep',11,1),(442,'Sungaipenuh',8,1),(443,'Supiori',24,1),(444,'Surabaya',11,1),(445,'Surakarta (Solo)',10,1),(446,'Tabalong',13,1),(447,'Tabanan',1,1),(448,'Takalar',28,1),(449,'Tambrauw',25,1),(450,'Tana Tidung',16,1),(451,'Tana Toraja',28,1),(452,'Tanah Bumbu',13,1),(453,'Tanah Datar',32,1),(454,'Tanah Laut',13,1),(455,'Tangerang',3,1),(456,'Tangerang',3,1),(457,'Tangerang Selatan',3,1),(458,'Tanggamus',18,1),(459,'Tanjung Balai',34,1),(460,'Tanjung Jabung Barat',8,1),(461,'Tanjung Jabung Timur',8,1),(462,'Tanjung Pinang',17,1),(463,'Tapanuli Selatan',34,1),(464,'Tapanuli Tengah',34,1),(465,'Tapanuli Utara',34,1),(466,'Tapin',13,1),(467,'Tarakan',16,1),(468,'Tasikmalaya',9,1),(469,'Tasikmalaya',9,1),(470,'Tebing Tinggi',34,1),(471,'Tebo',8,1),(472,'Tegal',10,1),(473,'Tegal',10,1),(474,'Teluk Bintuni',25,1),(475,'Teluk Wondama',25,1),(476,'Temanggung',10,1),(477,'Ternate',20,1),(478,'Tidore Kepulauan',20,1),(479,'Timor Tengah Selatan',23,1),(480,'Timor Tengah Utara',23,1),(481,'Toba Samosir',34,1),(482,'Tojo Una-Una',29,1),(483,'Toli-Toli',29,1),(484,'Tolikara',24,1),(485,'Tomohon',31,1),(486,'Toraja Utara',28,1),(487,'Trenggalek',11,1),(488,'Tual',19,1),(489,'Tuban',11,1),(490,'Tulang Bawang',18,1),(491,'Tulang Bawang Barat',18,1),(492,'Tulungagung',11,1),(493,'Wajo',28,1),(494,'Wakatobi',30,1),(495,'Waropen',24,1),(496,'Way Kanan',18,1),(497,'Wonogiri',10,1),(498,'Wonosobo',10,1),(499,'Yahukimo',24,1),(500,'Yalimo',24,1),(501,'Yogyakarta',5,1);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_eng` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_ind` text DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `maps` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_1` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_2` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `about_eng` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_ind` text DEFAULT NULL,
  `vision_eng` text DEFAULT NULL,
  `vision_ind` text DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `company` */

insert  into `company`(`name`,`address_eng`,`address_ind`,`city_id`,`province_id`,`zip_code`,`maps`,`phone_1`,`phone_2`,`email_1`,`email_2`,`fax`,`logo`,`about_eng`,`about_ind`,`vision_eng`,`vision_ind`,`update_date`,`update_user_id`,`update_count`) values ('PT. Amalia Rozikin Jaya','A108 Adam Street','Jl. Negara No.05, Pandanwangi, Kec. Blimbing, Kota Malang, Jawa Timur 65126',403,3,'123456','&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6664270097594!2d106.82496411412092!3d-6.1753923955292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sNational%20Monument!5e0!3m2!1sen!2sid!4v1616612557245!5m2!1sen!2sid&quot; width=&quot;100%&quot; height=&quot;300&quot; style=&quot;border:0;&quot; allowfullscreen=&quot;&quot; loading=&quot;lazy&quot;&gt;&lt;/iframe&gt;','12345678',NULL,'example@mail.com',NULL,NULL,'logo_F1Eh6ObBuQM9QJs66KwQbX9PoTxfbiy1gIpKs3d_5cg.png','<div class=\"row\">\r\n<div class=\"col-lg-6 col-12 order-2 order-lg-1\"><img class=\"img-fluid\" src=\"http://localhost/ci-company/files/editor/about.jpg\" alt=\"\" width=\"1024\" height=\"768\" /></div>\r\n<div class=\"col-lg-6 col-12 order-1 order-lg-2\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Company Name</span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit</span></li>\r\n</ul>\r\n<p><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>\r\n<p><span style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></span></p>\r\n</div>\r\n</div>','<div class=\"row\">\r\n<div class=\"col-lg-6 col-12 order-2 order-lg-1\"><img class=\"img-fluid\" src=\"http://localhost/ci-company/files/editor/about.jpg\" alt=\"\" width=\"1024\" height=\"768\" /></div>\r\n<div class=\"col-lg-6 col-12 order-1 order-lg-2\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Nama Perusahaan<br /></span></strong></span></p>\r\n<p><strong><span style=\"font-size: 12pt;\"><em>Nama Perusahaan </em></span></strong><span style=\"font-size: 12pt;\"><span style=\"font-size: 12pt;\">merupakan perusahaan yang bergerak dan memfokuskan diri pada bidang Konsultan IT dan Security</span><em>.</em></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Contoh list 1</span></li>\r\n<li><span style=\"font-size: 12pt;\">Contoh list 2</span></li>\r\n</ul>\r\n<p><span style=\"font-size: 12pt;\">Seiring dengan pesatnya perkembangan teknologi dan keterkaitan nya dengan bidang usaha maka kami hadir di dunia teknologi informasi untuk memberikan solusi, perencanaan, dan strategi yang terintegerasi sebagai nilai tambah yang maksimal bagi kebutuhan dan permasalahan dibidang Teknologi Informasi.</span></p>\r\n<p><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p>\r\n</div>\r\n</div>','<div class=\"row\">\r\n<div class=\"col-lg-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Vision<br /></span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p>\r\n</div>\r\n<div class=\"col-lg-6\">\r\n<p><span style=\"font-size: 12pt;\"><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Mission</span></strong></span></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n</ul>\r\n</div>\r\n</div>','<div class=\"row\">\r\n<div class=\"col-lg-6\">\r\n<p><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Visi<br /></span></strong></span></p>\r\n<p><span style=\"font-size: 12pt;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p>\r\n</div>\r\n<div class=\"col-lg-6\">\r\n<p><span style=\"font-size: 12pt;\"><span style=\"color: #3598db;\"><strong><span style=\"font-size: 20pt;\">Misi</span></strong></span></span></p>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>\r\n<li><span style=\"font-size: 12pt;\">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>\r\n</ul>\r\n</div>\r\n</div>','2023-10-30 23:04:54',1,98);

/*Table structure for table `cooking_abilities` */

DROP TABLE IF EXISTS `cooking_abilities`;

CREATE TABLE `cooking_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_chn` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `cooking_abilities` */

insert  into `cooking_abilities`(`id`,`name`,`name_chn`,`slug`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'Chinese','中式','chinese','2021-06-08 15:01:40',1,'2021-07-09 22:51:36',1,2,1),(2,'Western','西式','western','2021-06-08 15:01:47',1,'2021-07-09 22:51:51',1,2,1),(3,'Indonesian','印尼菜','indonesian','2021-06-08 15:01:56',1,'2021-07-09 22:52:01',1,2,1),(4,'Home Cooking','家常菜','home-cooking','2021-06-08 15:02:04',1,'2021-07-09 22:52:13',1,2,1);

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `iso` char(2) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `iso3` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num_code` int(6) NOT NULL,
  `phone_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`id`,`name`,`iso`,`iso3`,`num_code`,`phone_code`,`is_active`) values (1,'Afghanistan','AF','AFG',4,'+93',1),(2,'Albania','AL','ALB',8,'+355',1),(3,'Algeria','DZ','DZA',12,'+213',1),(4,'American Samoa','AS','ASM',16,'+1684',1),(5,'Andorra','AD','AND',20,'+376',1),(6,'Angola','AO','AGO',24,'+244',1),(7,'Anguilla','AI','AIA',660,'+1264',1),(8,'Antarctica','AQ','',0,'+0',0),(9,'Antigua and Barbuda','AG','ATG',28,'+1268',1),(10,'Argentina','AR','ARG',32,'+54',1),(11,'Armenia','AM','ARM',51,'+374',1),(12,'Aruba','AW','ABW',533,'+297',1),(13,'Australia','AU','AUS',36,'+61',1),(14,'Austria','AT','AUT',40,'+43',1),(15,'Azerbaijan','AZ','AZE',31,'+994',1),(16,'Bahamas','BS','BHS',44,'+1242',1),(17,'Bahrain','BH','BHR',48,'+973',1),(18,'Bangladesh','BD','BGD',50,'+880',1),(19,'Barbados','BB','BRB',52,'+1246',1),(20,'Belarus','BY','BLR',112,'+375',1),(21,'Belgium','BE','BEL',56,'+32',1),(22,'Belize','BZ','BLZ',84,'+501',1),(23,'Benin','BJ','BEN',204,'+229',1),(24,'Bermuda','BM','BMU',60,'+1441',1),(25,'Bhutan','BT','BTN',64,'+975',1),(26,'Bolivia','BO','BOL',68,'+591',1),(27,'Bosnia and Herzegovina','BA','BIH',70,'+387',1),(28,'Botswana','BW','BWA',72,'+267',1),(29,'Bouvet Island','BV','',0,'+0',1),(30,'Brazil','BR','BRA',76,'+55',1),(31,'British Indian Ocean Territory','IO','',0,'+246',0),(32,'Brunei Darussalam','BN','BRN',96,'+673',1),(33,'Bulgaria','BG','BGR',100,'+359',1),(34,'Burkina Faso','BF','BFA',854,'+226',1),(35,'Burundi','BI','BDI',108,'+257',1),(36,'Cambodia','KH','KHM',116,'+855',1),(37,'Cameroon','CM','CMR',120,'+237',1),(38,'Canada','CA','CAN',124,'+1',1),(39,'Cape Verde','CV','CPV',132,'+238',1),(40,'Cayman Islands','KY','CYM',136,'+1345',1),(41,'Central African Republic','CF','CAF',140,'+236',1),(42,'Chad','TD','TCD',148,'+235',1),(43,'Chile','CL','CHL',152,'+56',1),(44,'China','CN','CHN',156,'+86',1),(45,'Christmas Island','CX','',0,'+61',0),(46,'Cocos (Keeling) Islands','CC','',0,'+672',0),(47,'Colombia','CO','COL',170,'+57',1),(48,'Comoros','KM','COM',174,'+269',1),(49,'Congo','CG','COG',178,'+242',1),(50,'Congo, the Democratic Republic of the','CD','COD',180,'+242',1),(51,'Cook Islands','CK','COK',184,'+682',1),(52,'Costa Rica','CR','CRI',188,'+506',1),(53,'Cote D\'Ivoire','CI','CIV',384,'+225',1),(54,'Croatia','HR','HRV',191,'+385',1),(55,'Cuba','CU','CUB',192,'+53',1),(56,'Cyprus','CY','CYP',196,'+357',1),(57,'Czech Republic','CZ','CZE',203,'+420',1),(58,'Denmark','DK','DNK',208,'+45',1),(59,'Djibouti','DJ','DJI',262,'+253',1),(60,'Dominica','DM','DMA',212,'+1767',1),(61,'Dominican Republic','DO','DOM',214,'+1809',1),(62,'Ecuador','EC','ECU',218,'+593',1),(63,'Egypt','EG','EGY',818,'+20',1),(64,'El Salvador','SV','SLV',222,'+503',1),(65,'Equatorial Guinea','GQ','GNQ',226,'+240',1),(66,'Eritrea','ER','ERI',232,'+291',1),(67,'Estonia','EE','EST',233,'+372',1),(68,'Ethiopia','ET','ETH',231,'+251',1),(69,'Falkland Islands (Malvinas)','FK','FLK',238,'+500',1),(70,'Faroe Islands','FO','FRO',234,'+298',1),(71,'Fiji','FJ','FJI',242,'+679',1),(72,'Finland','FI','FIN',246,'+358',1),(73,'France','FR','FRA',250,'+33',1),(74,'French Guiana','GF','GUF',254,'+594',1),(75,'French Polynesia','PF','PYF',258,'+689',1),(76,'French Southern Territories','TF','',0,'+0',0),(77,'Gabon','GA','GAB',266,'+241',1),(78,'Gambia','GM','GMB',270,'+220',1),(79,'Georgia','GE','GEO',268,'+995',1),(80,'Germany','DE','DEU',276,'+49',1),(81,'Ghana','GH','GHA',288,'+233',1),(82,'Gibraltar','GI','GIB',292,'+350',1),(83,'Greece','GR','GRC',300,'+30',1),(84,'Greenland','GL','GRL',304,'+299',1),(85,'Grenada','GD','GRD',308,'+1473',1),(86,'Guadeloupe','GP','GLP',312,'+590',1),(87,'Guam','GU','GUM',316,'+1671',1),(88,'Guatemala','GT','GTM',320,'+502',1),(89,'Guinea','GN','GIN',324,'+224',1),(90,'Guinea-Bissau','GW','GNB',624,'+245',1),(91,'Guyana','GY','GUY',328,'+592',1),(92,'Haiti','HT','HTI',332,'+509',1),(93,'Heard Island and Mcdonald Islands','HM','',0,'+0',0),(94,'Holy See (Vatican City State)','VA','VAT',336,'+39',1),(95,'Honduras','HN','HND',340,'+504',1),(96,'Hong Kong','HK','HKG',344,'+852',1),(97,'Hungary','HU','HUN',348,'+36',1),(98,'Iceland','IS','ISL',352,'+354',1),(99,'India','IN','IND',356,'+91',1),(100,'Indonesia','ID','IDN',360,'+62',1),(101,'Iran, Islamic Republic of','IR','IRN',364,'+98',1),(102,'Iraq','IQ','IRQ',368,'+964',1),(103,'Ireland','IE','IRL',372,'+353',1),(104,'Israel','IL','ISR',376,'+972',1),(105,'Italy','IT','ITA',380,'+39',1),(106,'Jamaica','JM','JAM',388,'+1876',1),(107,'Japan','JP','JPN',392,'+81',1),(108,'Jordan','JO','JOR',400,'+962',1),(109,'Kazakhstan','KZ','KAZ',398,'+7',1),(110,'Kenya','KE','KEN',404,'+254',1),(111,'Kiribati','KI','KIR',296,'+686',1),(112,'Korea, Democratic People\'s Republic of','KP','PRK',408,'+850',1),(113,'Korea, Republic of','KR','KOR',410,'+82',1),(114,'Kuwait','KW','KWT',414,'+965',1),(115,'Kyrgyzstan','KG','KGZ',417,'+996',1),(116,'Lao People\'s Democratic Republic','LA','LAO',418,'+856',1),(117,'Latvia','LV','LVA',428,'+371',1),(118,'Lebanon','LB','LBN',422,'+961',1),(119,'Lesotho','LS','LSO',426,'+266',1),(120,'Liberia','LR','LBR',430,'+231',1),(121,'Libyan Arab Jamahiriya','LY','LBY',434,'+218',1),(122,'Liechtenstein','LI','LIE',438,'+423',1),(123,'Lithuania','LT','LTU',440,'+370',1),(124,'Luxembourg','LU','LUX',442,'+352',1),(125,'Macao','MO','MAC',446,'+853',1),(126,'Macedonia, the Former Yugoslav Republic of','MK','MKD',807,'+389',1),(127,'Madagascar','MG','MDG',450,'+261',1),(128,'Malawi','MW','MWI',454,'+265',1),(129,'Malaysia','MY','MYS',458,'+60',1),(130,'Maldives','MV','MDV',462,'+960',1),(131,'Mali','ML','MLI',466,'+223',1),(132,'Malta','MT','MLT',470,'+356',1),(133,'Marshall Islands','MH','MHL',584,'+692',1),(134,'Martinique','MQ','MTQ',474,'+596',1),(135,'Mauritania','MR','MRT',478,'+222',1),(136,'Mauritius','MU','MUS',480,'+230',1),(137,'Mayotte','YT','',0,'+269',1),(138,'Mexico','MX','MEX',484,'+52',1),(139,'Micronesia, Federated States of','FM','FSM',583,'+691',1),(140,'Moldova, Republic of','MD','MDA',498,'+373',1),(141,'Monaco','MC','MCO',492,'+377',1),(142,'Mongolia','MN','MNG',496,'+976',1),(143,'Montserrat','MS','MSR',500,'+1664',1),(144,'Morocco','MA','MAR',504,'+212',1),(145,'Mozambique','MZ','MOZ',508,'+258',1),(146,'Myanmar','MM','MMR',104,'+95',1),(147,'Namibia','NA','NAM',516,'+264',1),(148,'Nauru','NR','NRU',520,'+674',1),(149,'Nepal','NP','NPL',524,'+977',1),(150,'Netherlands','NL','NLD',528,'+31',1),(151,'Netherlands Antilles','AN','ANT',530,'+599',1),(152,'New Caledonia','NC','NCL',540,'+687',1),(153,'New Zealand','NZ','NZL',554,'+64',1),(154,'Nicaragua','NI','NIC',558,'+505',1),(155,'Niger','NE','NER',562,'+227',1),(156,'Nigeria','NG','NGA',566,'+234',1),(157,'Niue','NU','NIU',570,'+683',1),(158,'Norfolk Island','NF','NFK',574,'+672',1),(159,'Northern Mariana Islands','MP','MNP',580,'+1670',1),(160,'Norway','NO','NOR',578,'+47',1),(161,'Oman','OM','OMN',512,'+968',1),(162,'Pakistan','PK','PAK',586,'+92',1),(163,'Palau','PW','PLW',585,'+680',1),(164,'Palestinian Territory, Occupied','PS','',0,'+970',1),(165,'Panama','PA','PAN',591,'+507',1),(166,'Papua New Guinea','PG','PNG',598,'+675',1),(167,'Paraguay','PY','PRY',600,'+595',1),(168,'Peru','PE','PER',604,'+51',1),(169,'Philippines','PH','PHL',608,'+63',1),(170,'Pitcairn','PN','PCN',612,'+0',1),(171,'Poland','PL','POL',616,'+48',1),(172,'Portugal','PT','PRT',620,'+351',1),(173,'Puerto Rico','PR','PRI',630,'+1787',1),(174,'Qatar','QA','QAT',634,'+974',1),(175,'Reunion','RE','REU',638,'+262',1),(176,'Romania','RO','ROM',642,'+40',1),(177,'Russian Federation','RU','RUS',643,'+70',1),(178,'Rwanda','RW','RWA',646,'+250',1),(179,'Saint Helena','SH','SHN',654,'+290',1),(180,'Saint Kitts and Nevis','KN','KNA',659,'+1869',1),(181,'Saint Lucia','LC','LCA',662,'+1758',1),(182,'Saint Pierre and Miquelon','PM','SPM',666,'+508',1),(183,'Saint Vincent and the Grenadines','VC','VCT',670,'+1784',1),(184,'Samoa','WS','WSM',882,'+684',1),(185,'San Marino','SM','SMR',674,'+378',1),(186,'Sao Tome and Principe','ST','STP',678,'+239',1),(187,'Saudi Arabia','SA','SAU',682,'+966',1),(188,'Senegal','SN','SEN',686,'+221',1),(189,'Serbia and Montenegro','CS','',0,'+381',0),(190,'Seychelles','SC','SYC',690,'+248',1),(191,'Sierra Leone','SL','SLE',694,'+232',1),(192,'Singapore','SG','SGP',702,'+65',1),(193,'Slovakia','SK','SVK',703,'+421',1),(194,'Slovenia','SI','SVN',705,'+386',1),(195,'Solomon Islands','SB','SLB',90,'+677',1),(196,'Somalia','SO','SOM',706,'+252',1),(197,'South Africa','ZA','ZAF',710,'+27',1),(198,'South Georgia and the South Sandwich Islands','GS','',0,'+0',0),(199,'Spain','ES','ESP',724,'+34',1),(200,'Sri Lanka','LK','LKA',144,'+94',1),(201,'Sudan','SD','SDN',736,'+249',1),(202,'Suriname','SR','SUR',740,'+597',1),(203,'Svalbard and Jan Mayen','SJ','SJM',744,'+47',1),(204,'Swaziland','SZ','SWZ',748,'+268',1),(205,'Sweden','SE','SWE',752,'+46',1),(206,'Switzerland','CH','CHE',756,'+41',1),(207,'Syrian Arab Republic','SY','SYR',760,'+963',1),(208,'Taiwan, Province of China','TW','TWN',158,'+886',1),(209,'Tajikistan','TJ','TJK',762,'+992',1),(210,'Tanzania, United Republic of','TZ','TZA',834,'+255',1),(211,'Thailand','TH','THA',764,'+66',1),(212,'Timor-Leste','TL','',0,'+670',0),(213,'Togo','TG','TGO',768,'+228',1),(214,'Tokelau','TK','TKL',772,'+690',1),(215,'Tonga','TO','TON',776,'+676',1),(216,'Trinidad and Tobago','TT','TTO',780,'+1868',1),(217,'Tunisia','TN','TUN',788,'+216',1),(218,'Turkey','TR','TUR',792,'+90',1),(219,'Turkmenistan','TM','TKM',795,'+7370',1),(220,'Turks and Caicos Islands','TC','TCA',796,'+1649',1),(221,'Tuvalu','TV','TUV',798,'+688',1),(222,'Uganda','UG','UGA',800,'+256',1),(223,'Ukraine','UA','UKR',804,'+380',1),(224,'United Arab Emirates','AE','ARE',784,'+971',1),(225,'United Kingdom','GB','GBR',826,'+44',1),(226,'United States','US','USA',840,'+1',1),(227,'United States Minor Outlying Islands','UM','',0,'+1',0),(228,'Uruguay','UY','URY',858,'+598',1),(229,'Uzbekistan','UZ','UZB',860,'+998',1),(230,'Vanuatu','VU','VUT',548,'+678',1),(231,'Venezuela','VE','VEN',862,'+58',1),(232,'Viet Nam','VN','VNM',704,'+84',1),(233,'Virgin Islands, British','VG','VGB',92,'+1284',1),(234,'Virgin Islands, U.s.','VI','VIR',850,'+1340',1),(235,'Wallis and Futuna','WF','WLF',876,'+681',1),(236,'Western Sahara','EH','ESH',732,'+212',1),(237,'Yemen','YE','YEM',887,'+967',1),(238,'Zambia','ZM','ZMB',894,'+260',1),(239,'Zimbabwe','ZW','ZWE',716,'+263',1);

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` text CHARACTER SET latin1 DEFAULT NULL,
  `email_from` text CHARACTER SET latin1 DEFAULT NULL,
  `email_to` text CHARACTER SET latin1 DEFAULT NULL,
  `email_cc` text CHARACTER SET latin1 DEFAULT NULL,
  `email_bcc` text CHARACTER SET latin1 DEFAULT NULL,
  `email_date` datetime DEFAULT NULL,
  `content` text CHARACTER SET utf8 DEFAULT NULL,
  `content_html` longtext CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `email_status_id` int(11) DEFAULT NULL,
  `email_status_detail_id` int(11) DEFAULT NULL,
  `direction_id` int(11) DEFAULT NULL,
  `auto_reply_id` int(3) DEFAULT 0,
  `mail_error_info` text CHARACTER SET latin1 DEFAULT NULL,
  `waiting_respon_status` enum('YES','NO') COLLATE utf8_unicode_ci DEFAULT 'NO',
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `Indexing` (`email_status_id`,`direction_id`,`create_user_id`,`auto_reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `emails` */

/*Table structure for table `galleries` */

DROP TABLE IF EXISTS `galleries`;

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) DEFAULT NULL,
  `pictname` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` int(1) DEFAULT 1,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `galleries` */

insert  into `galleries`(`id`,`picture`,`pictname`,`description`,`is_active`,`create_date`) values (3,'img-galleriescHRhcmouY29tMTYyNzAwMjU4NA.png','ssssss edited','ssssss edited',1,'2021-07-23 08:09:44'),(4,'img-galleriescHRhcmouY29tMTYyNzAwMjczOA.jpg','cucucufcu','ctxtzytztzt',1,'2021-07-23 08:12:18'),(5,'img-galleriescHRhcmouY29tMTYyNzAwNDA4OA.jpg','ssss','ssssss',1,'2021-07-23 08:34:48'),(6,'img-galleriescHRhcmouY29tMTYyNzAwNDA5Nw.jpg','evceveve','veveveve',1,'2021-07-23 08:34:58'),(7,'img-galleriescHRhcmouY29tMTYyNzAwNDExMQ.jpg','scscs','escdscd',1,'2021-07-23 08:35:11'),(8,'img-galleriescHRhcmouY29tMTYyNzAwNDEyOQ.jpg','sxsxscxs','sxsxscs',1,'2021-07-23 08:35:29'),(9,'img-galleriescHRhcmouY29tMTYyNzAwNDE1MA.jpg','scxscs','csxsxscs',1,'2021-07-23 08:35:50');

/*Table structure for table `language_abilities` */

DROP TABLE IF EXISTS `language_abilities`;

CREATE TABLE `language_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_chn` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `language_abilities` */

insert  into `language_abilities`(`id`,`name`,`name_chn`,`slug`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'English','英文','english','2021-06-08 14:57:05',1,'2021-07-09 22:55:17',1,2,1),(2,'Cantonese','廣東話','cantonese','2021-06-08 14:57:20',1,'2021-07-09 22:55:07',1,2,1),(3,'Mandarin','國語','mandarin','2021-06-08 14:58:26',1,'2021-07-09 22:55:42',1,2,1),(4,'Hokkian','福建話','hokkian','2021-06-08 14:58:30',1,'2021-07-09 22:55:27',1,2,1);

/*Table structure for table `mailer_config` */

DROP TABLE IF EXISTS `mailer_config`;

CREATE TABLE `mailer_config` (
  `host` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `encryption` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mailer_config` */

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `provinces` */

insert  into `provinces`(`id`,`name`,`is_active`) values (1,'Bali',1),(2,'Bangka Belitung',1),(3,'Banten',1),(4,'Bengkulu',1),(5,'DI Yogyakarta',1),(6,'DKI Jakarta',1),(7,'Gorontalo',1),(8,'Jambi',1),(9,'Jawa Barat',1),(10,'Jawa Tengah',1),(11,'Jawa Timur',1),(12,'Kalimantan Barat',1),(13,'Kalimantan Selatan',1),(14,'Kalimantan Tengah',1),(15,'Kalimantan Timur',1),(16,'Kalimantan Utara',1),(17,'Kepulauan Riau',1),(18,'Lampung',1),(19,'Maluku',1),(20,'Maluku Utara',1),(21,'Nanggroe Aceh Darussalam (NAD)',1),(22,'Nusa Tenggara Barat (NTB)',1),(23,'Nusa Tenggara Timur (NTT)',1),(24,'Papua',1),(25,'Papua Barat',1),(26,'Riau',1),(27,'Sulawesi Barat',1),(28,'Sulawesi Selatan',1),(29,'Sulawesi Tengah',1),(30,'Sulawesi Tenggara',1),(31,'Sulawesi Utara',1),(32,'Sumatera Barat',1),(33,'Sumatera Selatan',1),(34,'Sumatera Utara',1);

/*Table structure for table `skill_experiences` */

DROP TABLE IF EXISTS `skill_experiences`;

CREATE TABLE `skill_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `name_chn` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `skill_experiences` */

insert  into `skill_experiences`(`id`,`name`,`name_chn`,`slug`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'Cooking','煮菜','cooking','2021-04-10 12:58:25',1,'2021-07-09 22:35:14',1,3,1),(2,'Household','印尼','household','2021-04-10 12:58:35',1,'2021-07-09 22:34:53',1,5,1),(3,'Taking Care of Elderly','照顧老人','taking-care-of-elderly','2021-07-09 22:35:38',1,NULL,NULL,0,1),(4,'Taking Care of Children','照顧嬰兒','taking-care-of-children','2021-07-09 22:35:54',1,NULL,NULL,0,1),(5,'Taking Care of Baby','照顧小孩','taking-care-of-baby','2021-07-09 22:36:11',1,NULL,NULL,0,1),(6,'Others','其他','others','2021-07-09 22:36:26',1,NULL,NULL,0,1);

/*Table structure for table `sliders` */

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `link_to` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sliders` */

insert  into `sliders`(`id`,`picture`,`order_number`,`link_to`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'slider_KdaeAQe6Q8JPbkUKN3k9PAZy6E5QlrtRQI2PgjQFU-k.jpg',1,'https://www.youtube.com/watch?v=VwU3SlQ723Q','2021-07-12 10:15:04',1,'2021-07-14 17:59:26',1,4,1),(2,'slider_QzDZfMdTIO-7upZVQdQ281fy3eoWWlfkG0u4JEIqysg.jpg',2,NULL,'2021-07-12 10:15:24',1,'2021-07-14 18:01:27',1,8,1),(3,'slider_6VoIZW57DbtTbHLly-BbppWiMn-UiaQfewMVsmlfu0Q.jpg',3,NULL,'2021-07-14 17:11:34',1,'2021-07-14 18:02:14',1,2,1);

/*Table structure for table `suplementary_questions` */

DROP TABLE IF EXISTS `suplementary_questions`;

CREATE TABLE `suplementary_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_type_id` tinyint(4) NOT NULL DEFAULT 1,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `suplementary_questions` */

insert  into `suplementary_questions`(`id`,`question`,`answer_type_id`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`update_count`,`is_active`) values (1,'Will You Work Where There Are Pets?',1,'2021-07-06 19:42:53',1,NULL,NULL,0,1),(2,'Do You Have Any Allergies (such As Skin Allergy)?',1,'2021-07-06 19:44:33',1,NULL,NULL,0,1),(3,'Do you have any knowledge in gardening?',2,'2021-07-06 19:45:57',1,'2021-07-08 14:23:10',1,3,1),(4,'Can you handle and cook pork?',1,'2021-07-06 19:49:53',1,NULL,NULL,0,1);

/*Table structure for table `user_levels` */

DROP TABLE IF EXISTS `user_levels`;

CREATE TABLE `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_levels` */

insert  into `user_levels`(`id`,`name`,`is_active`) values (1,'Administrator',1),(2,'Employer',1),(3,'Agency',1),(4,'Worker',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_location_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `company` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `update_count` int(11) NOT NULL DEFAULT 0,
  `verification_code` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_request_password` tinyint(1) NOT NULL DEFAULT 0,
  `is_request_register` tinyint(1) NOT NULL DEFAULT 0,
  `is_register` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_email` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`fullname`,`email`,`phone`,`agency_location_id`,`country_id`,`company`,`user_level_id`,`host_address`,`ip_address`,`last_event_date`,`last_event_id`,`request_date`,`register_date`,`register_user_id`,`update_date`,`update_user_id`,`update_count`,`verification_code`,`is_request_password`,`is_request_register`,`is_register`,`is_active`) values (1,'dion','$2y$10$0fs3zNwpuTsug793bwo6hu6ecK1azoNYXFg4Q8xDj4Uj2GIHvIVRC','Dionisius','dion@jsm.co.id',NULL,1,NULL,NULL,1,NULL,NULL,NULL,NULL,'2021-04-03 23:52:21','2021-04-04 22:01:14',1,'2023-10-29 22:12:56',1,23,'kjfQexoDw7dO0OT+CReoTRGsH4m2qOID2G80G+buCraRzEg4e8yfEaSM4PGXg53WbNXdOfgcgJs/KZs8Qdwg6Q==',1,0,1,1),(2,'ridho','$2y$10$.y.tPzuHYsvbiHPaT/bMCOZdsreiIFMMkTgPXQ0QG1HBQI12g0F5q','Muhammad Ridho','ridho@jsm.co.id',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,'2021-04-03 23:52:22','2021-04-04 02:10:54',2,'2021-04-08 23:45:47',2,18,NULL,0,0,1,1),(3,'employer1','$2y$10$JDgo2Ilr2QnTnRILB4ETy.LSF9gwJTqxV4SIvrq4o4WC/a7WHxpDG','User Employer 1','employer1@email.com',NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,'2021-05-02 00:08:29','2021-05-02 00:08:29',1,'2021-05-02 00:23:02',1,3,NULL,0,0,1,1),(4,'agency1','$2y$10$tgLIP9pgC32N8qSpB3aVo.fsWZC5k5WPWCwYmS64Rn5oE23x9bkte','User Agency 1','agency1@email.com',NULL,2,NULL,NULL,3,NULL,NULL,NULL,NULL,'2021-05-02 00:09:07','2021-05-02 00:09:07',1,'2021-07-04 22:32:45',1,8,NULL,0,0,1,1),(5,'agency2','$2y$10$13Pv9eO//JCnQSx44eSKtOS7G0G9.CPNM35775EdAdWgwS3J1/5fy','User Agency 2','agency2@email.com',NULL,5,NULL,NULL,3,NULL,NULL,NULL,NULL,'2021-05-02 00:09:51','2021-05-02 00:09:51',1,'2021-05-06 00:09:32',1,4,NULL,0,0,1,1),(6,'worker1','$2y$10$S4Hob90h4zy8M2FOCF8qMuhzSHTJcIcAoWPdTc1eYz7kZNsJ6tb3G','User Worker 1','worker1@email.com',NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,'2021-05-02 00:10:47','2021-05-02 00:10:47',1,'2021-05-02 00:22:36',1,1,NULL,0,0,1,1);

/*Table structure for table `worker_attachments` */

DROP TABLE IF EXISTS `worker_attachments`;

CREATE TABLE `worker_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `create_user_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `worker_attachments` */

/*Table structure for table `worker_previous_employments` */

DROP TABLE IF EXISTS `worker_previous_employments`;

CREATE TABLE `worker_previous_employments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `working_area` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quit_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `period` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `worker_previous_employments` */

/*Table structure for table `worker_suplementary_questions` */

DROP TABLE IF EXISTS `worker_suplementary_questions`;

CREATE TABLE `worker_suplementary_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suplementary_question_id` int(11) DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `worker_suplementary_questions` */

/*Table structure for table `workers` */

DROP TABLE IF EXISTS `workers`;

CREATE TABLE `workers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender_id` tinyint(1) DEFAULT NULL,
  `religion_id` tinyint(1) DEFAULT NULL,
  `marital_status_id` tinyint(1) DEFAULT NULL,
  `height` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_video` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_education_id` tinyint(1) DEFAULT NULL,
  `other_information` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `character_evaluation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `children` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `children_age` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_ability_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cooking_ability_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skill_experience_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_experience_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placement_id` int(11) DEFAULT NULL,
  `ready_placement_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_status_id` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `booking_user_id` int(11) DEFAULT NULL,
  `update_count` int(11) NOT NULL DEFAULT 0,
  `is_over_sla` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `workers` */

insert  into `workers`(`id`,`ref_number`,`fullname`,`email`,`phone`,`birth_place`,`birth_date`,`gender_id`,`religion_id`,`marital_status_id`,`height`,`weight`,`address`,`city_id`,`province_id`,`photo`,`link_video`,`last_education_id`,`other_information`,`character_evaluation`,`spouse_name`,`spouse_occupation`,`children`,`children_age`,`father_name`,`father_occupation`,`mother_name`,`mother_occupation`,`description`,`language_ability_ids`,`cooking_ability_ids`,`skill_experience_ids`,`work_experience_ids`,`placement_id`,`ready_placement_ids`,`booking_status_id`,`user_id`,`create_date`,`create_user_id`,`update_date`,`update_user_id`,`booking_date`,`booking_user_id`,`update_count`,`is_over_sla`,`is_active`) values (1,'ARJ HKS - 0001','Worker 1','worker1@email.com','0001','Bojong Kenyot','1945-08-17',1,1,2,'155','150','This is example of address',306,11,'photo_fW1nSE23j7KZRkQUlqG-SHqjIwrPqQGGp0OClIMCTjA.png','https://www.youtube.com/embed/VwU3SlQ723Q',1,NULL,'character evaluation','spouse','occupation','2','1 2 &amp;','father','occupation','mother','occupation','worker description','1,4','2,3','2','1,2,7',2,'1,2,4,6,7',4,6,'2021-04-22 02:11:45',1,'2021-07-15 16:44:24',1,'2021-05-05 23:24:03',4,78,1,1),(2,'ARJ HKS - 0002','Worker 2','worker2@email.com','0002','Bojong Kenyot','1946-08-17',2,1,1,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,5,'3,4,5,8',4,NULL,'2021-04-22 02:11:45',1,'2021-07-06 19:18:45',1,'2021-05-06 00:09:51',5,22,1,1),(3,'ARJ HKS - 0003','Worker 3','worker3@email.com','0003','Bojong Kenyot','1947-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,2,'2',4,NULL,'2021-04-22 02:11:45',1,'2021-07-06 19:18:53',1,'2021-07-04 22:40:31',4,11,1,1),(4,'ARJ HKS - 0004','Worker 4','worker4@email.com','0004','Bojong Kenyot','1948-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-07-15 16:58:31',1,'0000-00-00 00:00:00',0,8,1,1),(5,'ARJ HKS - 0005','Worker 5','worker5@email.com','0005','Bojong Kenyot','1949-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-05-01 01:54:49',1,'0000-00-00 00:00:00',0,4,1,1),(6,'ARJ HKS - 0006','Worker 6','worker6@email.com','0006','Bojong Kenyot','1950-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-05-01 01:54:49',1,'0000-00-00 00:00:00',0,4,1,1),(7,'ARJ HKS - 0007','Worker 7','worker7@email.com','0007','Bojong Kenyot','1951-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-05-01 01:54:49',1,'0000-00-00 00:00:00',0,4,1,1),(8,'ARJ HKS - 0008','Worker 8','worker8@email.com','0008','Bojong Kenyot','1952-08-17',1,1,2,'0835539812','0354843534',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-05-01 01:54:49',1,'0000-00-00 00:00:00',0,4,1,1),(9,'ARJ HKS - 0009','Worker 9','worker9@email.com','0009','Bojong Kenyot','1953-08-17',1,1,2,'0835539812',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'worker description',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-04-22 02:11:45',1,'2021-05-02 20:16:50',1,'0000-00-00 00:00:00',0,5,1,1);

/* Trigger structure for table `agency_locations` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `agency_locations_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `agency_locations_before_insert` BEFORE INSERT ON `agency_locations` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `agency_locations` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `agency_locations_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `agency_locations_before_update` BEFORE UPDATE ON `agency_locations` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `company` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `company_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `company_before_update` BEFORE UPDATE ON `company` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `cooking_abilities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `cooking_abilities_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `cooking_abilities_before_insert` BEFORE INSERT ON `cooking_abilities` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `cooking_abilities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `cooking_abilities_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `cooking_abilities_before_update` BEFORE UPDATE ON `cooking_abilities` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `language_abilities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `language_abilities_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `language_abilities_before_insert` BEFORE INSERT ON `language_abilities` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `language_abilities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `language_abilities_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `language_abilities_before_update` BEFORE UPDATE ON `language_abilities` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `skill_experiences` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `skill_experiences_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `skill_experiences_before_insert` BEFORE INSERT ON `skill_experiences` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `skill_experiences` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `skill_experiences_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `skill_experiences_before_update` BEFORE UPDATE ON `skill_experiences` FOR EACH ROW BEGIN
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

/* Trigger structure for table `suplementary_questions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `suplementary_questions_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `suplementary_questions_before_insert` BEFORE INSERT ON `suplementary_questions` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `suplementary_questions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `suplementary_questions_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `suplementary_questions_before_update` BEFORE UPDATE ON `suplementary_questions` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_before_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
        SET NEW.request_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        
        IF (NEW.is_register = 1) THEN
            SET NEW.register_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `users_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `users_before_update` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
        
        IF (OLD.is_register <> 1 && NEW.is_register = 1) THEN
            SET NEW.register_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `worker_attachments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `worker_attachments_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `worker_attachments_before_insert` BEFORE INSERT ON `worker_attachments` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `worker_previous_employments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `worker_previous_employments_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `worker_previous_employments_before_insert` BEFORE INSERT ON `worker_previous_employments` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `worker_previous_employments` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `worker_previous_employments_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `worker_previous_employments_before_update` BEFORE UPDATE ON `worker_previous_employments` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Trigger structure for table `worker_suplementary_questions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `worker_suplementary_questions_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `worker_suplementary_questions_before_insert` BEFORE INSERT ON `worker_suplementary_questions` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `workers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `workers_before_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `workers_before_insert` BEFORE INSERT ON `workers` FOR EACH ROW BEGIN
        SET NEW.create_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
    END */$$


DELIMITER ;

/* Trigger structure for table `workers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `workers_before_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `workers_before_update` BEFORE UPDATE ON `workers` FOR EACH ROW BEGIN
        SET NEW.update_date = DATE_FORMAT(NOW(),"%Y-%m-%d %H:%i:%s");
        SET NEW.update_count = OLD.update_count + 1;
    END */$$


DELIMITER ;

/* Function  structure for function  `IS_WORKER` */

/*!50003 DROP FUNCTION IF EXISTS `IS_WORKER` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `IS_WORKER`(get_user_id INT) RETURNS tinyint(1)
    READS SQL DATA
    DETERMINISTIC
BEGIN
        DECLARE count_id INT(11);
	DECLARE is_worker TINYINT(1);
	SELECT COUNT(id) INTO count_id FROM workers WHERE user_id = get_user_id;
	IF(count_id = 0) THEN
		SET is_worker = '0';
	ELSE
		SET is_worker = '1';
	END IF;
	RETURN is_worker;
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
    READS SQL DATA
    DETERMINISTIC
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),
       LENGTH(SUBSTRING_INDEX(str, delim, pos -1)) + 1),
       delim, '') */$$
DELIMITER ;

/*Table structure for table `view_agency_locations` */

DROP TABLE IF EXISTS `view_agency_locations`;

/*!50001 DROP VIEW IF EXISTS `view_agency_locations` */;
/*!50001 DROP TABLE IF EXISTS `view_agency_locations` */;

/*!50001 CREATE TABLE  `view_agency_locations`(
 `id` int(11) ,
 `name` varchar(100) ,
 `name_chn` varchar(100) ,
 `slug` varchar(255) ,
 `total_user_agency` bigint(21) ,
 `total_worker_placement` bigint(21) ,
 `total_worker_ready_placement` bigint(21) ,
 `total_worker_work_experience` bigint(21) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `is_local` tinyint(1) ,
 `is_default` tinyint(1) ,
 `is_active` tinyint(1) 
)*/;

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
 `name` varchar(100) ,
 `address_eng` text ,
 `address_ind` text ,
 `city_id` int(11) ,
 `city` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `zip_code` varchar(10) ,
 `phone_1` varchar(30) ,
 `phone_2` varchar(30) ,
 `email_1` varchar(100) ,
 `email_2` varchar(100) ,
 `fax` varchar(30) ,
 `logo` text ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) 
)*/;

/*Table structure for table `view_cooking_abilities` */

DROP TABLE IF EXISTS `view_cooking_abilities`;

/*!50001 DROP VIEW IF EXISTS `view_cooking_abilities` */;
/*!50001 DROP TABLE IF EXISTS `view_cooking_abilities` */;

/*!50001 CREATE TABLE  `view_cooking_abilities`(
 `id` int(11) ,
 `name` varchar(100) ,
 `name_chn` varchar(100) ,
 `slug` varchar(255) ,
 `total_worker` bigint(21) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_language_abilities` */

DROP TABLE IF EXISTS `view_language_abilities`;

/*!50001 DROP VIEW IF EXISTS `view_language_abilities` */;
/*!50001 DROP TABLE IF EXISTS `view_language_abilities` */;

/*!50001 CREATE TABLE  `view_language_abilities`(
 `id` int(11) ,
 `name` varchar(100) ,
 `name_chn` varchar(100) ,
 `slug` varchar(255) ,
 `total_worker` bigint(21) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `update_count` int(11) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_skill_experiences` */

DROP TABLE IF EXISTS `view_skill_experiences`;

/*!50001 DROP VIEW IF EXISTS `view_skill_experiences` */;
/*!50001 DROP TABLE IF EXISTS `view_skill_experiences` */;

/*!50001 CREATE TABLE  `view_skill_experiences`(
 `id` int(11) ,
 `name` varchar(100) ,
 `name_chn` varchar(100) ,
 `slug` varchar(255) ,
 `total_worker` bigint(21) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
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

/*Table structure for table `view_suplementary_questions` */

DROP TABLE IF EXISTS `view_suplementary_questions`;

/*!50001 DROP VIEW IF EXISTS `view_suplementary_questions` */;
/*!50001 DROP TABLE IF EXISTS `view_suplementary_questions` */;

/*!50001 CREATE TABLE  `view_suplementary_questions`(
 `id` int(11) ,
 `question` text ,
 `answer_type_id` tinyint(4) ,
 `answer_type` varchar(6) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_total_data` */

DROP TABLE IF EXISTS `view_total_data`;

/*!50001 DROP VIEW IF EXISTS `view_total_data` */;
/*!50001 DROP TABLE IF EXISTS `view_total_data` */;

/*!50001 CREATE TABLE  `view_total_data`(
 `user` bigint(21) ,
 `user_request` bigint(21) ,
 `worker` bigint(21) ,
 `booking_request` bigint(21) ,
 `booking_approve` bigint(21) 
)*/;

/*Table structure for table `view_users` */

DROP TABLE IF EXISTS `view_users`;

/*!50001 DROP VIEW IF EXISTS `view_users` */;
/*!50001 DROP TABLE IF EXISTS `view_users` */;

/*!50001 CREATE TABLE  `view_users`(
 `id` int(10) unsigned ,
 `username` varchar(30) ,
 `password` varchar(100) ,
 `fullname` varchar(100) ,
 `email` varchar(100) ,
 `phone` varchar(30) ,
 `agency_location_id` int(11) ,
 `agency_location` varchar(100) ,
 `country_id` int(11) ,
 `company` text ,
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
 `verification_code` text ,
 `is_request_password` tinyint(1) ,
 `is_request_register` tinyint(1) ,
 `is_worker` int(1) ,
 `is_register` tinyint(1) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_worker_attachments` */

DROP TABLE IF EXISTS `view_worker_attachments`;

/*!50001 DROP VIEW IF EXISTS `view_worker_attachments` */;
/*!50001 DROP TABLE IF EXISTS `view_worker_attachments` */;

/*!50001 CREATE TABLE  `view_worker_attachments`(
 `id` int(11) ,
 `name` varchar(100) ,
 `file_path` varchar(255) ,
 `file_name` varchar(255) ,
 `file_size` varchar(100) ,
 `file_type` text ,
 `worker_id` int(11) ,
 `worker` varchar(100) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_worker_previous_employments` */

DROP TABLE IF EXISTS `view_worker_previous_employments`;

/*!50001 DROP VIEW IF EXISTS `view_worker_previous_employments` */;
/*!50001 DROP TABLE IF EXISTS `view_worker_previous_employments` */;

/*!50001 CREATE TABLE  `view_worker_previous_employments`(
 `id` int(11) ,
 `employer_name` varchar(255) ,
 `job_content` text ,
 `working_area` varchar(100) ,
 `country` varchar(100) ,
 `quit_reason` varchar(255) ,
 `period` varchar(100) ,
 `worker_id` int(11) ,
 `worker` varchar(100) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_worker_suplementary_questions` */

DROP TABLE IF EXISTS `view_worker_suplementary_questions`;

/*!50001 DROP VIEW IF EXISTS `view_worker_suplementary_questions` */;
/*!50001 DROP TABLE IF EXISTS `view_worker_suplementary_questions` */;

/*!50001 CREATE TABLE  `view_worker_suplementary_questions`(
 `id` int(11) ,
 `suplementary_question_id` int(11) ,
 `question` text ,
 `answer_type_id` tinyint(4) ,
 `answer_type` varchar(6) ,
 `worker_id` int(11) ,
 `worker` varchar(100) ,
 `answer` text ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `is_active` tinyint(1) 
)*/;

/*Table structure for table `view_workers` */

DROP TABLE IF EXISTS `view_workers`;

/*!50001 DROP VIEW IF EXISTS `view_workers` */;
/*!50001 DROP TABLE IF EXISTS `view_workers` */;

/*!50001 CREATE TABLE  `view_workers`(
 `id` int(10) ,
 `ref_number` varchar(100) ,
 `fullname` varchar(100) ,
 `email` varchar(100) ,
 `phone` varchar(100) ,
 `birth_place` varchar(100) ,
 `birth_date` date ,
 `age` varchar(21) ,
 `gender_id` tinyint(1) ,
 `gender` varchar(6) ,
 `religion_id` tinyint(1) ,
 `religion` varchar(9) ,
 `marital_status_id` tinyint(1) ,
 `marital_status` varchar(7) ,
 `height` varchar(10) ,
 `weight` varchar(10) ,
 `address` text ,
 `city_id` int(11) ,
 `city` varchar(100) ,
 `province_id` int(11) ,
 `province` varchar(50) ,
 `full_address` mediumtext ,
 `photo` varchar(255) ,
 `link_video` text ,
 `last_education_id` tinyint(1) ,
 `last_education` varchar(18) ,
 `other_information` text ,
 `character_evaluation` text ,
 `spouse_name` varchar(100) ,
 `spouse_occupation` varchar(100) ,
 `children` varchar(100) ,
 `children_age` varchar(100) ,
 `father_name` varchar(100) ,
 `father_occupation` varchar(100) ,
 `mother_name` varchar(100) ,
 `mother_occupation` varchar(100) ,
 `description` text ,
 `language_ability_ids` varchar(255) ,
 `language_ability_slug` text ,
 `language_ability` text ,
 `cooking_ability_ids` varchar(255) ,
 `cooking_ability_slug` text ,
 `cooking_ability` text ,
 `skill_experience_ids` varchar(255) ,
 `skill_experience_slug` text ,
 `skill_experience` text ,
 `work_experience_ids` varchar(255) ,
 `work_experience_slug` text ,
 `work_experience` text ,
 `placement_id` int(11) ,
 `placement` varchar(100) ,
 `placement_status` varchar(7) ,
 `ready_placement_ids` varchar(255) ,
 `ready_placement_slug` text ,
 `ready_placement` text ,
 `booking_status_id` tinyint(1) ,
 `booking_status` varchar(10) ,
 `user_id` int(11) ,
 `username` varchar(30) ,
 `user_level` varchar(100) ,
 `create_date` datetime ,
 `create_user_id` int(11) ,
 `create_by` varchar(30) ,
 `update_date` datetime ,
 `update_user_id` int(11) ,
 `update_by` varchar(30) ,
 `booking_date` datetime ,
 `booking_user_id` int(11) ,
 `booking_by` varchar(30) ,
 `booking_agency_location_id` bigint(11) ,
 `update_count` int(11) ,
 `is_over_sla` tinyint(1) ,
 `is_active` tinyint(1) 
)*/;

/*View structure for view view_agency_locations */

/*!50001 DROP TABLE IF EXISTS `view_agency_locations` */;
/*!50001 DROP VIEW IF EXISTS `view_agency_locations` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_agency_locations` AS select `agency_locations`.`id` AS `id`,`agency_locations`.`name` AS `name`,`agency_locations`.`name_chn` AS `name_chn`,`agency_locations`.`slug` AS `slug`,(select count(`users`.`id`) from `users` where `users`.`agency_location_id` = `agency_locations`.`id`) AS `total_user_agency`,(select count(`workers`.`id`) from `workers` where `workers`.`placement_id` = `agency_locations`.`id`) AS `total_worker_placement`,(select count(`workers`.`id`) from `workers` where find_in_set(`agency_locations`.`id`,`workers`.`ready_placement_ids`)) AS `total_worker_ready_placement`,(select count(`workers`.`id`) from `workers` where find_in_set(`agency_locations`.`id`,`workers`.`work_experience_ids`)) AS `total_worker_work_experience`,`agency_locations`.`create_date` AS `create_date`,`agency_locations`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `agency_locations`.`create_user_id`) AS `create_by`,`agency_locations`.`update_date` AS `update_date`,`agency_locations`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `agency_locations`.`update_user_id`) AS `update_by`,`agency_locations`.`update_count` AS `update_count`,`agency_locations`.`is_local` AS `is_local`,`agency_locations`.`is_default` AS `is_default`,`agency_locations`.`is_active` AS `is_active` from `agency_locations` group by `agency_locations`.`id` */;

/*View structure for view view_cities */

/*!50001 DROP TABLE IF EXISTS `view_cities` */;
/*!50001 DROP VIEW IF EXISTS `view_cities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cities` AS select `cities`.`id` AS `id`,`cities`.`name` AS `name`,`cities`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,`cities`.`is_active` AS `is_active` from (`cities` left join `provinces` on(`provinces`.`id` = `cities`.`province_id`)) group by `cities`.`id` */;

/*View structure for view view_company */

/*!50001 DROP TABLE IF EXISTS `view_company` */;
/*!50001 DROP VIEW IF EXISTS `view_company` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_company` AS select `company`.`name` AS `name`,`company`.`address_eng` AS `address_eng`,`company`.`address_ind` AS `address_ind`,`company`.`city_id` AS `city_id`,`cities`.`name` AS `city`,`company`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,`company`.`zip_code` AS `zip_code`,`company`.`phone_1` AS `phone_1`,`company`.`phone_2` AS `phone_2`,`company`.`email_1` AS `email_1`,`company`.`email_2` AS `email_2`,`company`.`fax` AS `fax`,`company`.`logo` AS `logo`,`company`.`update_date` AS `update_date`,`company`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `company`.`update_user_id`) AS `update_by`,`company`.`update_count` AS `update_count` from ((`company` left join `cities` on(`cities`.`id` = `company`.`city_id`)) left join `provinces` on(`provinces`.`id` = `company`.`province_id`)) limit 1 */;

/*View structure for view view_cooking_abilities */

/*!50001 DROP TABLE IF EXISTS `view_cooking_abilities` */;
/*!50001 DROP VIEW IF EXISTS `view_cooking_abilities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cooking_abilities` AS select `cooking_abilities`.`id` AS `id`,`cooking_abilities`.`name` AS `name`,`cooking_abilities`.`name_chn` AS `name_chn`,`cooking_abilities`.`slug` AS `slug`,(select count(`workers`.`id`) from `workers` where find_in_set(`cooking_abilities`.`id`,`workers`.`cooking_ability_ids`)) AS `total_worker`,`cooking_abilities`.`create_date` AS `create_date`,`cooking_abilities`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `cooking_abilities`.`create_user_id`) AS `create_by`,`cooking_abilities`.`update_date` AS `update_date`,`cooking_abilities`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `cooking_abilities`.`update_user_id`) AS `update_by`,`cooking_abilities`.`update_count` AS `update_count`,`cooking_abilities`.`is_active` AS `is_active` from `cooking_abilities` group by `cooking_abilities`.`id` */;

/*View structure for view view_language_abilities */

/*!50001 DROP TABLE IF EXISTS `view_language_abilities` */;
/*!50001 DROP VIEW IF EXISTS `view_language_abilities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_language_abilities` AS select `language_abilities`.`id` AS `id`,`language_abilities`.`name` AS `name`,`language_abilities`.`name_chn` AS `name_chn`,`language_abilities`.`slug` AS `slug`,(select count(`workers`.`id`) from `workers` where find_in_set(`language_abilities`.`id`,`workers`.`language_ability_ids`)) AS `total_worker`,`language_abilities`.`create_date` AS `create_date`,`language_abilities`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `language_abilities`.`create_user_id`) AS `create_by`,`language_abilities`.`update_date` AS `update_date`,`language_abilities`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `language_abilities`.`update_user_id`) AS `update_by`,`language_abilities`.`update_count` AS `update_count`,`language_abilities`.`is_active` AS `is_active` from `language_abilities` group by `language_abilities`.`id` */;

/*View structure for view view_skill_experiences */

/*!50001 DROP TABLE IF EXISTS `view_skill_experiences` */;
/*!50001 DROP VIEW IF EXISTS `view_skill_experiences` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_skill_experiences` AS select `skill_experiences`.`id` AS `id`,`skill_experiences`.`name` AS `name`,`skill_experiences`.`name_chn` AS `name_chn`,`skill_experiences`.`slug` AS `slug`,(select count(`workers`.`id`) from `workers` where find_in_set(`skill_experiences`.`id`,`workers`.`skill_experience_ids`)) AS `total_worker`,`skill_experiences`.`create_date` AS `create_date`,`skill_experiences`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `skill_experiences`.`create_user_id`) AS `create_by`,`skill_experiences`.`update_date` AS `update_date`,`skill_experiences`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `skill_experiences`.`update_user_id`) AS `update_by`,`skill_experiences`.`update_count` AS `update_count`,`skill_experiences`.`is_active` AS `is_active` from `skill_experiences` group by `skill_experiences`.`id` */;

/*View structure for view view_sliders */

/*!50001 DROP TABLE IF EXISTS `view_sliders` */;
/*!50001 DROP VIEW IF EXISTS `view_sliders` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sliders` AS select `sliders`.`id` AS `id`,`sliders`.`picture` AS `picture`,`sliders`.`order_number` AS `order_number`,`sliders`.`link_to` AS `link_to`,`sliders`.`create_date` AS `create_date`,`sliders`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `sliders`.`create_user_id`) AS `create_by`,`sliders`.`update_date` AS `update_date`,`sliders`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `sliders`.`update_user_id`) AS `update_by`,`sliders`.`update_count` AS `update_count`,`sliders`.`is_active` AS `is_active` from `sliders` group by `sliders`.`id` */;

/*View structure for view view_suplementary_questions */

/*!50001 DROP TABLE IF EXISTS `view_suplementary_questions` */;
/*!50001 DROP VIEW IF EXISTS `view_suplementary_questions` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_suplementary_questions` AS select `suplementary_questions`.`id` AS `id`,`suplementary_questions`.`question` AS `question`,`suplementary_questions`.`answer_type_id` AS `answer_type_id`,case `suplementary_questions`.`answer_type_id` when 1 then 'Option' when 2 then 'Text' else NULL end AS `answer_type`,`suplementary_questions`.`create_date` AS `create_date`,`suplementary_questions`.`create_user_id` AS `create_user_id`,(select `user_creates`.`username` from `users` `user_creates` where `user_creates`.`id` = `suplementary_questions`.`create_user_id`) AS `create_by`,`suplementary_questions`.`update_date` AS `update_date`,`suplementary_questions`.`update_user_id` AS `update_user_id`,(select `user_updates`.`username` from `users` `user_updates` where `user_updates`.`id` = `suplementary_questions`.`update_user_id`) AS `update_by`,`suplementary_questions`.`is_active` AS `is_active` from `suplementary_questions` group by `suplementary_questions`.`id` */;

/*View structure for view view_total_data */

/*!50001 DROP TABLE IF EXISTS `view_total_data` */;
/*!50001 DROP VIEW IF EXISTS `view_total_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_data` AS select (select count(`users`.`id`) from `users` where `users`.`is_active` = 1 and `users`.`is_register` = 1 and `users`.`id` <> 1) AS `user`,(select count(`user_requests`.`id`) from `users` `user_requests` where `user_requests`.`is_active` = 1 and `user_requests`.`is_register` <> 1 and `user_requests`.`is_request_register` = 1) AS `user_request`,(select count(`workers`.`id`) from `workers` where `workers`.`is_active` = 1) AS `worker`,(select count(`booking_requests`.`id`) from `workers` `booking_requests` where `booking_requests`.`is_active` = 1 and `booking_requests`.`booking_status_id` in (2,3)) AS `booking_request`,(select count(`booking_approves`.`id`) from `workers` `booking_approves` where `booking_approves`.`is_active` = 1 and `booking_approves`.`booking_status_id` = 4) AS `booking_approve` */;

/*View structure for view view_users */

/*!50001 DROP TABLE IF EXISTS `view_users` */;
/*!50001 DROP VIEW IF EXISTS `view_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users` AS select `users`.`id` AS `id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`fullname` AS `fullname`,`users`.`email` AS `email`,`users`.`phone` AS `phone`,`users`.`agency_location_id` AS `agency_location_id`,(select `agency_locations`.`name` from `agency_locations` where `agency_locations`.`id` = `users`.`agency_location_id`) AS `agency_location`,`users`.`country_id` AS `country_id`,`users`.`company` AS `company`,`users`.`user_level_id` AS `user_level_id`,(select `user_levels`.`name` from `user_levels` where `user_levels`.`id` = `users`.`user_level_id`) AS `user_level`,`users`.`host_address` AS `host_address`,`users`.`ip_address` AS `ip_address`,`users`.`last_event_date` AS `last_event_date`,`users`.`last_event_id` AS `last_event_id`,`users`.`request_date` AS `request_date`,`users`.`register_date` AS `register_date`,`users`.`register_user_id` AS `register_user_id`,(select `user_registers`.`username` from `users` `user_registers` where `user_registers`.`id` = `users`.`register_user_id`) AS `register_by`,`users`.`update_date` AS `update_date`,`users`.`update_user_id` AS `update_user_id`,(select `user_updates`.`username` from `users` `user_updates` where `user_updates`.`id` = `users`.`update_user_id`) AS `update_by`,`users`.`update_count` AS `update_count`,`users`.`verification_code` AS `verification_code`,`users`.`is_request_password` AS `is_request_password`,`users`.`is_request_register` AS `is_request_register`,(select `IS_WORKER`(`users`.`id`)) AS `is_worker`,`users`.`is_register` AS `is_register`,`users`.`is_active` AS `is_active` from ((`users` left join `countries` on(`countries`.`id` = `users`.`country_id`)) left join `agency_locations` on(`agency_locations`.`id` = `users`.`agency_location_id`)) group by `users`.`id` */;

/*View structure for view view_worker_attachments */

/*!50001 DROP TABLE IF EXISTS `view_worker_attachments` */;
/*!50001 DROP VIEW IF EXISTS `view_worker_attachments` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_worker_attachments` AS select `attachments`.`id` AS `id`,`attachments`.`name` AS `name`,`attachments`.`file_path` AS `file_path`,`attachments`.`file_name` AS `file_name`,`attachments`.`file_size` AS `file_size`,`attachments`.`file_type` AS `file_type`,`attachments`.`worker_id` AS `worker_id`,`workers`.`fullname` AS `worker`,`attachments`.`create_date` AS `create_date`,`attachments`.`create_user_id` AS `create_user_id`,`users`.`username` AS `create_by`,`attachments`.`is_active` AS `is_active` from ((`worker_attachments` `attachments` left join `workers` on(`workers`.`id` = `attachments`.`worker_id`)) left join `users` on(`users`.`id` = `attachments`.`create_user_id`)) group by `attachments`.`id` */;

/*View structure for view view_worker_previous_employments */

/*!50001 DROP TABLE IF EXISTS `view_worker_previous_employments` */;
/*!50001 DROP VIEW IF EXISTS `view_worker_previous_employments` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_worker_previous_employments` AS select `previous_employments`.`id` AS `id`,`previous_employments`.`employer_name` AS `employer_name`,`previous_employments`.`job_content` AS `job_content`,`previous_employments`.`working_area` AS `working_area`,`previous_employments`.`country` AS `country`,`previous_employments`.`quit_reason` AS `quit_reason`,`previous_employments`.`period` AS `period`,`previous_employments`.`worker_id` AS `worker_id`,(select `workers`.`fullname` from `workers` where `workers`.`id` = `previous_employments`.`worker_id`) AS `worker`,`previous_employments`.`create_date` AS `create_date`,`previous_employments`.`create_user_id` AS `create_user_id`,(select `user_creates`.`username` from `users` `user_creates` where `user_creates`.`id` = `previous_employments`.`create_user_id`) AS `create_by`,`previous_employments`.`update_date` AS `update_date`,`previous_employments`.`update_user_id` AS `update_user_id`,(select `user_updates`.`username` from `users` `user_updates` where `user_updates`.`id` = `previous_employments`.`update_user_id`) AS `update_by`,`previous_employments`.`is_active` AS `is_active` from `worker_previous_employments` `previous_employments` group by `previous_employments`.`id` */;

/*View structure for view view_worker_suplementary_questions */

/*!50001 DROP TABLE IF EXISTS `view_worker_suplementary_questions` */;
/*!50001 DROP VIEW IF EXISTS `view_worker_suplementary_questions` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_worker_suplementary_questions` AS select `worker_suplementary_questions`.`id` AS `id`,`worker_suplementary_questions`.`suplementary_question_id` AS `suplementary_question_id`,`suplementary_questions`.`question` AS `question`,`suplementary_questions`.`answer_type_id` AS `answer_type_id`,case `suplementary_questions`.`answer_type_id` when 1 then 'Option' when 2 then 'Text' else NULL end AS `answer_type`,`worker_suplementary_questions`.`worker_id` AS `worker_id`,`workers`.`fullname` AS `worker`,`worker_suplementary_questions`.`answer` AS `answer`,`worker_suplementary_questions`.`create_date` AS `create_date`,`worker_suplementary_questions`.`create_user_id` AS `create_user_id`,(select `user_creates`.`username` from `users` `user_creates` where `user_creates`.`id` = `worker_suplementary_questions`.`create_user_id`) AS `create_by`,`worker_suplementary_questions`.`is_active` AS `is_active` from ((`worker_suplementary_questions` left join `suplementary_questions` on(`suplementary_questions`.`id` = `worker_suplementary_questions`.`suplementary_question_id`)) left join `workers` on(`workers`.`id` = `worker_suplementary_questions`.`worker_id`)) group by `worker_suplementary_questions`.`id` */;

/*View structure for view view_workers */

/*!50001 DROP TABLE IF EXISTS `view_workers` */;
/*!50001 DROP VIEW IF EXISTS `view_workers` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_workers` AS select `workers`.`id` AS `id`,`workers`.`ref_number` AS `ref_number`,`workers`.`fullname` AS `fullname`,`workers`.`email` AS `email`,`workers`.`phone` AS `phone`,`workers`.`birth_place` AS `birth_place`,`workers`.`birth_date` AS `birth_date`,ifnull(timestampdiff(YEAR,`workers`.`birth_date`,current_timestamp()),'0') AS `age`,`workers`.`gender_id` AS `gender_id`,case `workers`.`gender_id` when 1 then 'Male' when 2 then 'Female' else NULL end AS `gender`,`workers`.`religion_id` AS `religion_id`,case `workers`.`religion_id` when 1 then 'Moslem' when 2 then 'Christian' when 3 then 'Hindu' when 4 then 'Buddha' when 5 then 'Others' else NULL end AS `religion`,`workers`.`marital_status_id` AS `marital_status_id`,case `workers`.`marital_status_id` when 1 then 'Single' when 2 then 'Married' when 3 then 'Divorce' else NULL end AS `marital_status`,`workers`.`height` AS `height`,`workers`.`weight` AS `weight`,`workers`.`address` AS `address`,`workers`.`city_id` AS `city_id`,`cities`.`name` AS `city`,`workers`.`province_id` AS `province_id`,`provinces`.`name` AS `province`,concat_ws(', ',`workers`.`address`,`cities`.`name`,`provinces`.`name`) AS `full_address`,`workers`.`photo` AS `photo`,`workers`.`link_video` AS `link_video`,`workers`.`last_education_id` AS `last_education_id`,case `workers`.`last_education_id` when 1 then 'Kindergarten' when 2 then 'Primary School' when 3 then 'Junior High School' when 4 then 'Senior High School' when 5 then 'Diploma Degree' when 6 then 'Bachelor Degree' when 7 then 'Other' else NULL end AS `last_education`,`workers`.`other_information` AS `other_information`,`workers`.`character_evaluation` AS `character_evaluation`,`workers`.`spouse_name` AS `spouse_name`,`workers`.`spouse_occupation` AS `spouse_occupation`,`workers`.`children` AS `children`,`workers`.`children_age` AS `children_age`,`workers`.`father_name` AS `father_name`,`workers`.`father_occupation` AS `father_occupation`,`workers`.`mother_name` AS `mother_name`,`workers`.`mother_occupation` AS `mother_occupation`,`workers`.`description` AS `description`,`workers`.`language_ability_ids` AS `language_ability_ids`,(select group_concat(`language_abilities`.`slug` separator ',') from `language_abilities` where locate(concat(',',`language_abilities`.`id`,','),concat(' ,',`workers`.`language_ability_ids`,',')) > 1 and `language_abilities`.`is_active` = 1) AS `language_ability_slug`,(select group_concat(`language_abilities`.`name` separator ', ') from `language_abilities` where locate(concat(',',`language_abilities`.`id`,','),concat(' ,',`workers`.`language_ability_ids`,',')) > 1 and `language_abilities`.`is_active` = 1) AS `language_ability`,`workers`.`cooking_ability_ids` AS `cooking_ability_ids`,(select group_concat(`cooking_abilities`.`slug` separator ',') from `cooking_abilities` where locate(concat(',',`cooking_abilities`.`id`,','),concat(' ,',`workers`.`cooking_ability_ids`,',')) > 1 and `cooking_abilities`.`is_active` = 1) AS `cooking_ability_slug`,(select group_concat(`cooking_abilities`.`name` separator ', ') from `cooking_abilities` where locate(concat(',',`cooking_abilities`.`id`,','),concat(' ,',`workers`.`cooking_ability_ids`,',')) > 1 and `cooking_abilities`.`is_active` = 1) AS `cooking_ability`,`workers`.`skill_experience_ids` AS `skill_experience_ids`,(select group_concat(`skill_experiences`.`slug` separator ',') from `skill_experiences` where locate(concat(',',`skill_experiences`.`id`,','),concat(' ,',`workers`.`skill_experience_ids`,',')) > 1 and `skill_experiences`.`is_active` = 1) AS `skill_experience_slug`,(select group_concat(`skill_experiences`.`name` separator ', ') from `skill_experiences` where locate(concat(',',`skill_experiences`.`id`,','),concat(' ,',`workers`.`skill_experience_ids`,',')) > 1 and `skill_experiences`.`is_active` = 1) AS `skill_experience`,`workers`.`work_experience_ids` AS `work_experience_ids`,(select group_concat(`work_experiences`.`slug` separator ',') from `agency_locations` `work_experiences` where locate(concat(',',`work_experiences`.`id`,','),concat(' ,',`workers`.`work_experience_ids`,',')) > 1 and `work_experiences`.`is_active` = 1) AS `work_experience_slug`,(select group_concat(`work_experiences`.`name` separator ', ') from `agency_locations` `work_experiences` where locate(concat(',',`work_experiences`.`id`,','),concat(' ,',`workers`.`work_experience_ids`,',')) > 1 and `work_experiences`.`is_active` = 1) AS `work_experience`,`workers`.`placement_id` AS `placement_id`,`agency_locations`.`name` AS `placement`,case when (`workers`.`placement_id` > 0 and `agency_locations`.`is_local` = 1) then 'Local' when (`workers`.`placement_id` > 0 and `agency_locations`.`is_local` <> 1) then 'Oversea' else NULL end AS `placement_status`,`workers`.`ready_placement_ids` AS `ready_placement_ids`,(select group_concat(`ready_placements`.`slug` separator ',') from `agency_locations` `ready_placements` where locate(concat(',',`ready_placements`.`id`,','),concat(' ,',`workers`.`ready_placement_ids`,',')) > 1 and `ready_placements`.`is_active` = 1) AS `ready_placement_slug`,(select group_concat(`ready_placements`.`name` separator ', ') from `agency_locations` `ready_placements` where locate(concat(',',`ready_placements`.`id`,','),concat(' ,',`workers`.`ready_placement_ids`,',')) > 1 and `ready_placements`.`is_active` = 1) AS `ready_placement`,`workers`.`booking_status_id` AS `booking_status_id`,case `workers`.`booking_status_id` when 1 then 'Free' when 2 then 'On Booking' when 3 then 'Confirmed' when 4 then 'Approved' else NULL end AS `booking_status`,`workers`.`user_id` AS `user_id`,`users`.`username` AS `username`,(select `user_levels`.`name` from `user_levels` where `user_levels`.`id` = `users`.`user_level_id`) AS `user_level`,case when unix_timestamp(`workers`.`create_date`) > 0 then `workers`.`create_date` else NULL end AS `create_date`,`workers`.`create_user_id` AS `create_user_id`,(select `users`.`username` from `users` where `users`.`id` = `workers`.`create_user_id`) AS `create_by`,case when unix_timestamp(`workers`.`update_date`) > 0 then `workers`.`update_date` else NULL end AS `update_date`,`workers`.`update_user_id` AS `update_user_id`,(select `users`.`username` from `users` where `users`.`id` = `workers`.`update_user_id`) AS `update_by`,case when unix_timestamp(`workers`.`booking_date`) > 0 then `workers`.`booking_date` else NULL end AS `booking_date`,`workers`.`booking_user_id` AS `booking_user_id`,(select `users`.`username` from `users` where `users`.`id` = `workers`.`booking_user_id`) AS `booking_by`,(select `users`.`agency_location_id` from `users` where `users`.`id` = `workers`.`booking_user_id`) AS `booking_agency_location_id`,`workers`.`update_count` AS `update_count`,`workers`.`is_over_sla` AS `is_over_sla`,`workers`.`is_active` AS `is_active` from ((((`workers` left join `cities` on(`cities`.`id` = `workers`.`city_id`)) left join `provinces` on(`provinces`.`id` = `workers`.`province_id`)) left join `agency_locations` on(`agency_locations`.`id` = `workers`.`placement_id`)) left join `users` on(`users`.`id` = `workers`.`user_id`)) group by `workers`.`id` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
