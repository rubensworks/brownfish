-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Generation Time: Jul 28, 2013 at 10:41 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date_created` int(15) NOT NULL,
  `author_id` int(7) NOT NULL,
  `item_id` int(7) NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
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
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_dummy`
--

CREATE TABLE IF NOT EXISTS `tbl_item_dummy` (
  `id` int(7) NOT NULL,
  `value` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_file`
--

CREATE TABLE IF NOT EXISTS `tbl_item_file` (
  `id` int(7) NOT NULL,
  `extension` varchar(20) NOT NULL,
  `mime_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_navigation`
--

CREATE TABLE IF NOT EXISTS `tbl_item_navigation` (
  `id` int(7) NOT NULL,
  `navigation_id` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_news`
--

CREATE TABLE IF NOT EXISTS `tbl_item_news` (
  `id` int(7) NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_text`
--

CREATE TABLE IF NOT EXISTS `tbl_item_text` (
  `id` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_navigation`
--

CREATE TABLE IF NOT EXISTS `tbl_navigation` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `type` enum('ROOT','NODE','LEAF') NOT NULL,
  `route` varchar(100) NOT NULL,
  `parent_id` int(7) NOT NULL,
  `row_order` int(5) NOT NULL,
  `bizrule` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author_id` int(7) NOT NULL,
  `columns` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_translation`
--

CREATE TABLE IF NOT EXISTS `tbl_translation` (
  `translation_key` int(7) NOT NULL,
  `language` varchar(2) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`translation_key`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_translation_key`
--

CREATE TABLE IF NOT EXISTS `tbl_translation_key` (
  `translation_key` int(7) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`translation_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widget`
--

CREATE TABLE IF NOT EXISTS `tbl_widget` (
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
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  ADD CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_item_dummy`
--
ALTER TABLE `tbl_item_dummy`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Constraints for table `tbl_item_file`
--
ALTER TABLE `tbl_item_file`
  ADD CONSTRAINT `tbl_item_file_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Constraints for table `tbl_item_navigation`
--
ALTER TABLE `tbl_item_navigation`
  ADD CONSTRAINT `tbl_item_navigation_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Constraints for table `tbl_item_news`
--
ALTER TABLE `tbl_item_news`
  ADD CONSTRAINT `tbl_item_news_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Constraints for table `tbl_item_text`
--
ALTER TABLE `tbl_item_text`
  ADD CONSTRAINT `tbl_item_text_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`),
  ADD CONSTRAINT `tbl_item_text_ibfk_2` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Constraints for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD CONSTRAINT `tbl_page_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_translation`
--
ALTER TABLE `tbl_translation`
  ADD CONSTRAINT `tbl_translation_ibfk_1` FOREIGN KEY (`translation_key`) REFERENCES `tbl_translation_key` (`translation_key`);

--
-- Constraints for table `tbl_widget`
--
ALTER TABLE `tbl_widget`
  ADD CONSTRAINT `tbl_widget_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `tbl_page` (`id`);
