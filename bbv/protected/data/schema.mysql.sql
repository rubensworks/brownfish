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
-- Table structure for table `{{auth_assignment}}`
--

DROP TABLE IF EXISTS `{{auth_assignment}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{auth_assignment}}` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `{{auth_assignment_ibfk_1}}` FOREIGN KEY (`itemname`) REFERENCES `{{auth_item}}` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{auth_item}}`
--

DROP TABLE IF EXISTS `{{auth_item}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{auth_item}}` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{auth_item_child}}`
--

DROP TABLE IF EXISTS `{{auth_item_child}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{auth_item_child}}` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `{{auth_item_child_ibfk_1}}` FOREIGN KEY (`parent`) REFERENCES `{{auth_item}}` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `{{auth_item_child_ibfk_2}}` FOREIGN KEY (`child`) REFERENCES `{{auth_item}}` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{category}}`
--

DROP TABLE IF EXISTS `{{category}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{category}}` (
  `category_id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{comment}}`
--

DROP TABLE IF EXISTS `{{comment}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{comment}}` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date_created` int(15) NOT NULL,
  `author_id` int(7) NOT NULL,
  `item_id` int(7) NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{config}}`
--

DROP TABLE IF EXISTS `{{config}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{config}}` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item}}`
--

DROP TABLE IF EXISTS `{{item}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item}}` (
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
  CONSTRAINT `{{item_ibfk_1}}` FOREIGN KEY (`category_id`) REFERENCES `{{category}}` (`category_id`),
  CONSTRAINT `{{item_ibfk_2}}` FOREIGN KEY (`author_id`) REFERENCES `{{user}}` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item_dummy}}`
--

DROP TABLE IF EXISTS `{{item_dummy}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item_dummy}}` (
  `id` int(7) NOT NULL,
  `value` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item_file}}`
--

DROP TABLE IF EXISTS `{{item_file}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item_file}}` (
  `id` int(7) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `mime_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `{{item_file_ibfk_1}}` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item_navigation}}`
--

DROP TABLE IF EXISTS `{{item_navigation}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item_navigation}}` (
  `id` int(7) NOT NULL,
  `navigation_id` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `{{item_navigation_ibfk_1}}` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item_news}}`
--

DROP TABLE IF EXISTS `{{item_news}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item_news}}` (
  `id` int(7) NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `conditional_date` int(1) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `hide` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `{{item_news_ibfk_1}}` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{item_text}}`
--

DROP TABLE IF EXISTS `{{item_text}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{item_text}}` (
  `id` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `{{item_text_ibfk_1}}` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`),
  CONSTRAINT `{{item_text_ibfk_2}}` FOREIGN KEY (`id`) REFERENCES `{{item}}` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{navigation}}`
--

DROP TABLE IF EXISTS `{{navigation}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{navigation}}` (
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
-- Table structure for table `{{page}}`
--

DROP TABLE IF EXISTS `{{page}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{page}}` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author_id` int(7) NOT NULL,
  `columns` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `{{page_ibfk_1}}` FOREIGN KEY (`author_id`) REFERENCES `{{user}}` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{translation}}`
--

DROP TABLE IF EXISTS `{{translation}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{translation}}` (
  `translation_key` int(7) NOT NULL,
  `language` varchar(2) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`translation_key`,`language`),
  CONSTRAINT `{{translation_ibfk_1}}` FOREIGN KEY (`translation_key`) REFERENCES `{{translation_key}}` (`translation_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{translation_key}}`
--

DROP TABLE IF EXISTS `{{translation_key}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{translation_key}}` (
  `translation_key` int(7) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`translation_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `{{user}}`
--

DROP TABLE IF EXISTS `{{user}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{user}}` (
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
-- Table structure for table `{{widget}}`
--

DROP TABLE IF EXISTS `{{widget}}`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `{{widget}}` (
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
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `{{widget_ibfk_1}}` FOREIGN KEY (`page_id`) REFERENCES `{{page}}` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-03 11:10:38
