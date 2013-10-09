-- MySQL dump 10.13  Distrib 5.5.25, for osx10.6 (i386)
--
-- Host: localhost    Database: db_bbv
-- ------------------------------------------------------
-- Server version	5.5.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_auth_assignment`
--

DROP TABLE IF EXISTS `tbl_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_auth_assignment`
--

LOCK TABLES `tbl_auth_assignment` WRITE;
/*!40000 ALTER TABLE `tbl_auth_assignment` DISABLE KEYS */;
INSERT INTO `tbl_auth_assignment` VALUES ('Admins','3',NULL,'N;');
/*!40000 ALTER TABLE `tbl_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_auth_item`
--

DROP TABLE IF EXISTS `tbl_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_auth_item`
--

LOCK TABLES `tbl_auth_item` WRITE;
/*!40000 ALTER TABLE `tbl_auth_item` DISABLE KEYS */;
INSERT INTO `tbl_auth_item` VALUES ('Admins',2,'Users who can do everything including altering core settings.',NULL,'N;'),('Auth Assignments Manager',2,'Manages Role Assignments. RBAM required role.',NULL,'N;'),('Auth Items Manager',2,'Manages Auth Items. RBAM required role.',NULL,'N;'),('authenticated',2,'Default role for users that are logged in. RBAC default role.','return !Yii::app()->user->isGuest;','s:0:\"\";'),('dashboardUser',0,'allow access to the user dashboard',NULL,'N;'),('deleteComment',0,'delete comments from other users',NULL,'N;'),('guest',2,'Default role for users that are not logged in. RBAC default role.','return Yii::app()->user->isGuest;','s:0:\"\";'),('manageFiles',0,'Allow managing of file items.',NULL,'N;'),('manageItems',0,'manage the various items',NULL,'N;'),('manageNavigation',0,'manage the navigation items',NULL,'N;'),('manageNews',0,'manage the news',NULL,'N;'),('managePages',0,'manage the various pages',NULL,'N;'),('Managers',2,'Users who are able to manage content.',NULL,'N;'),('manageText',0,'manage the text items',NULL,'N;'),('RBAC Manager',2,'Manages Auth Items and Role Assignments. RBAM required role.',NULL,'N;'),('registerUser',0,'let a guest register himself',NULL,'N;'),('SuperManagers',2,'Users who can manage everything.',NULL,'N;');
/*!40000 ALTER TABLE `tbl_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_auth_item_child`
--

DROP TABLE IF EXISTS `tbl_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_auth_item_child`
--

LOCK TABLES `tbl_auth_item_child` WRITE;
/*!40000 ALTER TABLE `tbl_auth_item_child` DISABLE KEYS */;
INSERT INTO `tbl_auth_item_child` VALUES ('Admins','Auth Assignments Manager'),('RBAC Manager','Auth Assignments Manager'),('Admins','Auth Items Manager'),('RBAC Manager','Auth Items Manager'),('Managers','authenticated'),('authenticated','dashboardUser'),('SuperManagers','deleteComment'),('SuperManagers','manageFiles'),('SuperManagers','manageItems'),('SuperManagers','manageNavigation'),('SuperManagers','manageNews'),('SuperManagers','managePages'),('SuperManagers','Managers'),('SuperManagers','manageText'),('Admins','RBAC Manager'),('guest','registerUser'),('Admins','SuperManagers');
/*!40000 ALTER TABLE `tbl_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `category_id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (1,'Test1'),(2,'Test2'),(5,'qsd'),(7,'Default Category');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comment` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date_created` int(15) NOT NULL,
  `author_id` int(7) NOT NULL,
  `item_id` int(7) NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
INSERT INTO `tbl_comment` VALUES (55,1372167887,3,21,'q'),(56,1372167991,3,21,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a magna justo. Nulla vitae pellentesque turpis. Vestibulum vulputate, massa et dictum mollis, nisi justo sagittis turpis, at tempus ipsum velit et turpis. Phasellus nec justo dui. Proin rhoncus pulvinar nisl, vitae commodo sapien venenatis non. Fusce vitae posuere eros. Quisque volutpat facilisis diam, id ultrices magna accumsan eget.'),(57,1372167998,3,21,'Vivamus pharetra erat purus, in ullamcorper dui cursus tincidunt. Nullam nisl sem, vestibulum vitae condimentum a, lacinia varius massa. Etiam interdum lorem diam, a rhoncus erat interdum viverra. Maecenas bibendum varius leo sollicitudin fermentum. Vivamus ullamcorper, dui commodo accumsan mollis, lacus justo dignissim magna, et cursus arcu felis non enim. Duis iaculis nunc nibh, eu tempus sem ornare vel. Sed at interdum metus, vehicula semper nunc.'),(58,1372168014,3,21,'Praesent imperdiet velit quis quam sagittis, quis semper leo venenatis. Etiam rutrum lectus nibh, in vestibulum tortor sodales id. Sed pharetra convallis rhoncus. Morbi nec nibh mauris. Vestibulum eros neque, mollis quis venenatis at, pharetra ac erat. Proin in imperdiet justo. Phasellus condimentum faucibus nisl a tempus. Proin libero arcu, scelerisque nec elit sed, consectetur laoreet eros. Aliquam aliquet vitae elit sit amet pellentesque.'),(59,1372168021,3,21,'Maecenas porta egestas est pretium tempus. Duis laoreet, ante eget hendrerit auctor, leo elit vehicula dui, at sagittis erat elit eget eros. Suspendisse quis mattis diam. Aliquam sed velit in mauris scelerisque facilisis.'),(60,1372172285,3,19,'sssss'),(61,1372680239,3,16,'drie'),(63,1372680248,3,16,'vier'),(65,1373119564,3,16,'a'),(66,1373121496,3,16,'xyz'),(68,1373372447,3,16,'sdfqsdf');
/*!40000 ALTER TABLE `tbl_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_config`
--

DROP TABLE IF EXISTS `tbl_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_config` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_config`
--

LOCK TABLES `tbl_config` WRITE;
/*!40000 ALTER TABLE `tbl_config` DISABLE KEYS */;
INSERT INTO `tbl_config` VALUES ('core_default_category_id','s:1:\"7\";'),('core_index_page_id','i:8;'),('core_main_nav_id','i:89;'),('preferences_file_max_size','i:10000;'),('preferences_file_types','a:5:{i:0;s:9:\"image/gif\";i:1;s:10:\"image/jpeg\";i:2;s:9:\"image/png\";i:3;s:15:\"application/pdf\";i:4;s:17:\"application/x-pdf\";}');
/*!40000 ALTER TABLE `tbl_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item`
--

DROP TABLE IF EXISTS `tbl_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(7) NOT NULL,
  `date_created` int(15) NOT NULL,
  `date_changed` int(15) NOT NULL,
  `category_id` int(7) NOT NULL,
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item`
--

LOCK TABLES `tbl_item` WRITE;
/*!40000 ALTER TABLE `tbl_item` DISABLE KEYS */;
INSERT INTO `tbl_item` VALUES (1,'XYZ','qsdsssaaaaaXXXxxxaaa',3,10,1374056783,1,'test,test2a,aaa,eentagje'),(2,'ulu','',3,10,10,2,'aaa'),(3,'nnn','',4,1371653202,1371654167,2,'ttt'),(4,'nnn','',3,1371653221,1371653221,2,'ttt'),(6,'aaa','',4,1371654176,1371657424,1,'bbb,uuuuu'),(7,'a','',3,1371658410,1371658410,1,''),(8,'a','',3,1371658413,1371658413,1,''),(9,'a','',3,1371658416,1371658777,1,''),(10,'a','',3,1371658421,1371658421,1,''),(11,'a','',3,1371658426,1371658426,1,''),(12,'a','',3,1371658435,1371658435,1,''),(13,'a','',3,1371658439,1371669748,1,'bla,blabla,blablabla'),(14,'a','',3,1371658463,1371658486,1,''),(15,'bbb','',3,1371658473,1371658473,1,''),(16,'testnews','<h3><b>This is a test</b></h3>',3,1371896430,1375517879,2,'hallo,test'),(17,'gggg','',3,1371896456,1371896456,1,''),(18,'RUBEN','',3,1371896544,1371896544,1,''),(19,'Rppppqsdqsd','',5,1371896637,1373030244,1,'test'),(20,'another1@','',3,1371896707,1373209221,1,''),(21,'xyz','',3,1371896828,1373030261,1,''),(22,'a','',3,1371901535,1371901535,1,''),(23,'test','',3,1371901667,1371901667,1,''),(24,'a','',3,1371901959,1371901959,1,''),(25,'dfghj','',3,1371975047,1371975047,5,'dfghj'),(32,'HALLO','',3,1372603270,1372603270,1,''),(33,'HALLO','',3,1372603324,1372603324,1,''),(34,'HALLo','',3,1372603346,1372603346,1,''),(35,'HALLO','',3,1372603478,1372603478,1,''),(37,'test','',3,1373804738,1373804738,1,'a'),(38,'aaa','',3,1373805085,1373805085,1,'a'),(39,'aaa','',3,1373806283,1373806283,1,'a'),(40,'aaa','',3,1373808150,1373808150,1,'a'),(41,'aaa','',3,1373808449,1373808449,1,'a'),(42,'aaa','',3,1373808499,1373808499,1,'a'),(43,'aaa','',3,1373808516,1373808516,1,'a'),(44,'aa','',3,1373808524,1373808524,1,'aaaa'),(45,'aaa','',3,1373808612,1373808612,1,'aa'),(46,'a','',3,1373808629,1373808629,1,'a'),(47,'a','',3,1373808662,1373808662,1,'a'),(49,'a','',3,1373822349,1373822349,1,''),(50,'aa','',3,1373822640,1373822640,1,''),(52,'x','',3,1373824820,1373824820,1,''),(53,'Test','',3,1373886789,1373886941,1,'hallo'),(54,'Inleiding','Haallo, dit is de index die aangepast kan worden in de Dashboard, admin rechten zijn vereist.<br><ul><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/FileItem/download/90\">Download undefined</a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/FileItem/download/89\">Download 89</a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/FileItem/download/88\">github</a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/FileItem/download/67\">pinterest_logo</a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/FileItem/download/94\">bruinvis2013-03</a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/ImageFileItem/93\"><img alt=\"smiley\" src=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/assets/easyimage/f/f2d3d25762be3c47f0cab3455c788ce2.png\"></a><br></li><li><a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/ImageFileItem/95\"><img alt=\"github\" src=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/assets/easyimage/c/c8bdfc48876c6fc4830405f0f2a4b7cf.png\"></a><br></li></ul>',3,1373890008,1375513569,1,''),(55,'a','',3,1373967036,1373967036,1,''),(56,'aaaa','',3,1373967112,1373967112,1,''),(57,'Testfile','',3,1374153513,1374153513,1,'sss'),(58,'Github','',3,1374153527,1374153527,1,'git'),(59,'a','',3,1374153580,1374153580,1,''),(62,'github','Dit is het logo va <b>GITHUB</b>',3,1374153747,1374493575,1,'git'),(63,'pinterest','',3,1374325055,1374325055,1,''),(64,'github.png','',3,1374488681,1374488681,1,''),(65,'pinterest_logo','',3,1374488906,1374488906,1,''),(90,'github','',3,1374604052,1374604052,7,''),(91,'github','',3,1374743896,1374743896,7,''),(92,'allectro_channel_art','',3,1374744015,1374744015,7,''),(93,'smiley','',3,1374744029,1374744029,7,''),(94,'bruinvis2013-03','',3,1374832844,1374832844,7,''),(95,'github','',3,1375513542,1375513542,7,''),(96,'Bestuur','<a rel=\"nofollow\" target=\"_blank\" href=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/ImageFileItem/93\"><img alt=\"smiley\" src=\"http://localhost:8888/Users/kroeser/Documents/BBV/bbv/bbv/assets/easyimage/f/f2d3d25762be3c47f0cab3455c788ce2.png\"></a>&nbsp;aaaaaaaaaaaa',3,1375514972,1375514972,1,'bestuur'),(97,'test222','qsd',3,1375517889,1375517889,1,'');
/*!40000 ALTER TABLE `tbl_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_dummy`
--

DROP TABLE IF EXISTS `tbl_item_dummy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_dummy` (
  `id` int(7) NOT NULL,
  `value` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_dummy`
--

LOCK TABLES `tbl_item_dummy` WRITE;
/*!40000 ALTER TABLE `tbl_item_dummy` DISABLE KEYS */;
INSERT INTO `tbl_item_dummy` VALUES (1,1),(3,0),(6,0),(7,0),(8,0),(9,0),(10,0),(13,0),(14,0),(15,0),(18,0),(20,0),(55,0),(56,0);
/*!40000 ALTER TABLE `tbl_item_dummy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_file`
--

DROP TABLE IF EXISTS `tbl_item_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_file` (
  `id` int(7) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `mime_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tbl_item_file_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_file`
--

LOCK TABLES `tbl_item_file` WRITE;
/*!40000 ALTER TABLE `tbl_item_file` DISABLE KEYS */;
INSERT INTO `tbl_item_file` VALUES (62,'png','image/png'),(63,'gif','image/gif'),(64,'png','image/png'),(65,'gif','image/gif'),(90,'png','doc/x'),(91,'png','image/png'),(92,'jpg','image/jpeg'),(93,'jpg','image/jpeg'),(94,'pdf','application/pdf'),(95,'png','image/png');
/*!40000 ALTER TABLE `tbl_item_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_navigation`
--

DROP TABLE IF EXISTS `tbl_item_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_navigation` (
  `id` int(7) NOT NULL,
  `navigation_id` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tbl_item_navigation_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_navigation`
--

LOCK TABLES `tbl_item_navigation` WRITE;
/*!40000 ALTER TABLE `tbl_item_navigation` DISABLE KEYS */;
INSERT INTO `tbl_item_navigation` VALUES (53,126);
/*!40000 ALTER TABLE `tbl_item_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_news`
--

DROP TABLE IF EXISTS `tbl_item_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_news` (
  `id` int(7) NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `conditional_date` int(1) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `hide` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `tbl_item_news_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_news`
--

LOCK TABLES `tbl_item_news` WRITE;
/*!40000 ALTER TABLE `tbl_item_news` DISABLE KEYS */;
INSERT INTO `tbl_item_news` VALUES (16,'blublusss',1,'2013-08-08','2013-02-08',0),(19,'Dit is een korte inleiding!',0,'0000-00-00','0000-00-00',0),(21,'korte inhoud',0,'0000-00-00','0000-00-00',0),(59,'',0,'0000-00-00','0000-00-00',0),(97,'zz',0,'2013-03-08','2013-03-08',0);
/*!40000 ALTER TABLE `tbl_item_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_text`
--

DROP TABLE IF EXISTS `tbl_item_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_text` (
  `id` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tbl_item_text_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`),
  CONSTRAINT `tbl_item_text_ibfk_2` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_text`
--

LOCK TABLES `tbl_item_text` WRITE;
/*!40000 ALTER TABLE `tbl_item_text` DISABLE KEYS */;
INSERT INTO `tbl_item_text` VALUES (54),(96);
/*!40000 ALTER TABLE `tbl_item_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_navigation`
--

DROP TABLE IF EXISTS `tbl_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_navigation` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `type` enum('ROOT','NODE','LEAF') NOT NULL,
  `route` varchar(100) NOT NULL,
  `parent_id` int(7) NOT NULL,
  `row_order` int(5) NOT NULL,
  `bizrule` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_navigation`
--

LOCK TABLES `tbl_navigation` WRITE;
/*!40000 ALTER TABLE `tbl_navigation` DISABLE KEYS */;
INSERT INTO `tbl_navigation` VALUES (89,'Root','ROOT','',0,0,''),(100,'Ding 1','NODE','',89,0,''),(111,'En hier ook niets','NODE','',113,0,''),(112,'Nog een ding','NODE','',100,0,'return $this->label==\"Nog een ding\";'),(113,'Niets hier','NODE','',115,1,''),(114,'Navigation admin','LEAF','/navigation/admin',112,1,''),(115,'Nieuw element','NODE','',89,1,''),(116,'Nieuwe link','LEAF','/',115,0,''),(117,'Nieuwe link','LEAF','/',111,0,''),(118,'Index','LEAF','/site/index',112,0,''),(119,'Dashboard','LEAF','/user/dashboard',112,2,''),(120,'CUSTOM_ROOT','ROOT','',0,0,''),(121,'Nieuw element','NODE','',120,0,''),(122,'Nieuwe link','LEAF','/',121,0,''),(123,'CUSTOM_ROOT','ROOT','',0,0,''),(124,'Nieuw element','NODE','',123,0,''),(125,'Nieuwe link','LEAF','',124,0,''),(126,'CUSTOM_ROOT','ROOT','',0,0,''),(127,'Nieuw element','NODE','',126,0,''),(128,'Nieuwe link','LEAF','/',127,0,''),(129,'MAIN_NAV_ROOT','ROOT','',0,0,''),(130,'MAIN_NAV_ROOT','ROOT','',0,0,'');
/*!40000 ALTER TABLE `tbl_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_page` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author_id` int(7) NOT NULL,
  `columns` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `tbl_page_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page`
--

LOCK TABLES `tbl_page` WRITE;
/*!40000 ALTER TABLE `tbl_page` DISABLE KEYS */;
INSERT INTO `tbl_page` VALUES (4,'pagina 123',4,2),(7,'xyz',3,1),(8,'Home',3,1),(13,'aaa',3,1);
/*!40000 ALTER TABLE `tbl_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_translation`
--

DROP TABLE IF EXISTS `tbl_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_translation` (
  `translation_key` int(7) NOT NULL,
  `language` varchar(2) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`translation_key`,`language`),
  CONSTRAINT `tbl_translation_ibfk_1` FOREIGN KEY (`translation_key`) REFERENCES `tbl_translation_key` (`translation_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_translation`
--

LOCK TABLES `tbl_translation` WRITE;
/*!40000 ALTER TABLE `tbl_translation` DISABLE KEYS */;
INSERT INTO `tbl_translation` VALUES (1,'nl','Testing...');
/*!40000 ALTER TABLE `tbl_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_translation_key`
--

DROP TABLE IF EXISTS `tbl_translation_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_translation_key` (
  `translation_key` int(7) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`translation_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_translation_key`
--

LOCK TABLES `tbl_translation_key` WRITE;
/*!40000 ALTER TABLE `tbl_translation_key` DISABLE KEYS */;
INSERT INTO `tbl_translation_key` VALUES (1);
/*!40000 ALTER TABLE `tbl_translation_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `datereg` int(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `secra` varchar(50) NOT NULL,
  `secrq` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `fbid` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (3,'admin','admin@admin.be',8,'21232f297a57a5a743894a0e4a801fc3','','','M',''),(4,'test','a',6,'bc18a007185593423a61f573be365f6d','','','M',''),(5,'test2','rubensworks@gmail.com',7,'9589f46d46ad079911a79b7b1ec6f084','aha!','huh?','M',''),(6,'aap','aap@aap.be',7,'be8c5618210c6079f0997f77a9d6479f','aap','aap','M','');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_widget`
--

DROP TABLE IF EXISTS `tbl_widget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_widget` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `page_id` int(7) NOT NULL,
  `col_id` int(2) NOT NULL,
  `row_order` int(5) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `widget_type` enum('LIST','SINGLE') NOT NULL,
  `filter_category` int(1) NOT NULL,
  `category_id` int(7) NOT NULL DEFAULT '0',
  `filter_tags` int(1) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `amount` int(5) NOT NULL DEFAULT '1',
  `item_id` int(7) NOT NULL,
  `clear` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `tbl_widget_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `tbl_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_widget`
--

LOCK TABLES `tbl_widget` WRITE;
/*!40000 ALTER TABLE `tbl_widget` DISABLE KEYS */;
INSERT INTO `tbl_widget` VALUES (85,'a',4,1,0,'DummyItem','SINGLE',1,5,0,'tag1,tag2,tag3,tag4',4,18,0),(126,'Een nieuws dinges',4,1,1,'NewsItem','SINGLE',0,1,0,'',1,16,0),(127,'Allemaal Nieuws Dingen',4,1,2,'NewsItem','LIST',0,1,0,'test,hallo',5,0,0),(128,'Allemaal dummy dingen',4,0,1,'DummyItem','LIST',0,1,1,'',5,0,0),(130,'Nieuwe Widget',4,0,3,'NewsItem','LIST',0,1,0,'',1,0,0),(131,'Nieuwe Widget',4,1,3,'NavigationItem','SINGLE',0,1,0,'',1,53,0),(132,'Inleiding',8,0,1,'TextItem','SINGLE',0,1,0,'',1,54,0),(133,'Laatste Nieuws',8,0,3,'NewsItem','LIST',0,1,0,'',5,0,0),(134,'Nieuwe Widget',4,0,2,'NewsItem','SINGLE',1,0,0,'',5,16,0),(135,'Afbeeldingen',8,0,2,'ImageFileItem','LIST',0,1,0,'',5,0,0),(136,'Een naam',8,0,0,'TextItem','SINGLE',0,1,0,'',1,96,0);
/*!40000 ALTER TABLE `tbl_widget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-09 18:57:37
