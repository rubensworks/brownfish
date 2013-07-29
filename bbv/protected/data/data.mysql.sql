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
-- Dumping data for table `{{auth_item}}`
--

LOCK TABLES `{{auth_item}}` WRITE;
/*!40000 ALTER TABLE `{{auth_item}}` DISABLE KEYS */;
INSERT INTO `{{auth_item}}` VALUES ('Admins',2,'Users who can do everything including altering core settings.',NULL,'N;'),('Auth Assignments Manager',2,'Manages Role Assignments. RBAM required role.',NULL,'N;'),('Auth Items Manager',2,'Manages Auth Items. RBAM required role.',NULL,'N;'),('authenticated',2,'Default role for users that are logged in. RBAC default role.','return !Yii::app()->user->isGuest;','s:0:\"\";'),('dashboardUser',0,'allow access to the user dashboard',NULL,'N;'),('deleteComment',0,'delete comments from other users',NULL,'N;'),('guest',2,'Default role for users that are not logged in. RBAC default role.','return Yii::app()->user->isGuest;','s:0:\"\";'),('manageFiles',0,'Allow managing of file items.',NULL,'N;'),('manageItems',0,'manage the various items',NULL,'N;'),('manageNavigation',0,'manage the navigation items',NULL,'N;'),('manageNews',0,'manage the news',NULL,'N;'),('managePages',0,'manage the various pages',NULL,'N;'),('Managers',2,'Users who are able to manage content.',NULL,'N;'),('manageText',0,'manage the text items',NULL,'N;'),('RBAC Manager',2,'Manages Auth Items and Role Assignments. RBAM required role.',NULL,'N;'),('registerUser',0,'let a guest register himself',NULL,'N;'),('SuperManagers',2,'Users who can manage everything.',NULL,'N;');
/*!40000 ALTER TABLE `{{auth_item}}` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `{{auth_item_child}}`
--

LOCK TABLES `{{auth_item_child}}` WRITE;
/*!40000 ALTER TABLE `{{auth_item_child}}` DISABLE KEYS */;
INSERT INTO `{{auth_item_child}}` VALUES ('Admins','Auth Assignments Manager'),('RBAC Manager','Auth Assignments Manager'),('Admins','Auth Items Manager'),('RBAC Manager','Auth Items Manager'),('Managers','authenticated'),('authenticated','dashboardUser'),('SuperManagers','deleteComment'),('SuperManagers','manageFiles'),('SuperManagers','manageItems'),('SuperManagers','manageNavigation'),('SuperManagers','manageNews'),('SuperManagers','managePages'),('SuperManagers','Managers'),('SuperManagers','manageText'),('Admins','RBAC Manager'),('guest','registerUser'),('Admins','SuperManagers');
/*!40000 ALTER TABLE `{{auth_item_child}}` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-29 19:50:59
