-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 23 jun 2013 om 14:15
-- Serverversie: 5.5.25
-- PHP-versie: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `db_bbv`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `AuthAssignment`
--

CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '3', NULL, 'N;');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `AuthItem`
--

CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('createUser', 0, 'create a new user', NULL, 'N;'),
('readUser', 0, 'read user profile information', NULL, 'N;'),
('updateUser', 0, 'update a users information', NULL, 'N;'),
('deleteUser', 0, 'delete user', NULL, 'N;'),
('registerUser', 0, 'let a guest register himself', NULL, 'N;'),
('dashboardUser', 0, 'allow access to the user dashboard', NULL, 'N;'),
('manageItems', 0, 'manage the various items', NULL, 'N;'),
('manageNews', 0, 'manage the news', NULL, 'N;'),
('managePages', 0, 'manage the various pages', NULL, 'N;'),
('guest', 2, 'guest user', 'return Yii::app()->user->isGuest;', 'N;'),
('registered', 2, 'authenticated user', 'return !Yii::app()->user->isGuest;', 'N;'),
('admin', 2, 'administrator', NULL, 'N;');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `AuthItemChild`
--

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('admin', 'createUser'),
('admin', 'deleteUser'),
('admin', 'manageItems'),
('admin', 'manageNews'),
('admin', 'managePages'),
('admin', 'registered'),
('admin', 'updateUser'),
('guest', 'readUser'),
('guest', 'registerUser'),
('registered', 'dashboardUser'),
('registered', 'readUser');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `name`) VALUES
(1, 'Test1'),
(2, 'Test2'),
(5, 'qsd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author_id` int(7) NOT NULL,
  `date_created` int(15) NOT NULL,
  `date_changed` int(15) NOT NULL,
  `category_id` int(7) NOT NULL,
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `name`, `author_id`, `date_created`, `date_changed`, `category_id`, `tags`) VALUES
(1, 'XYZ', 3, 10, 1371896426, 1, 'test,test2a,aaa,eentagje'),
(2, 'ulu', 3, 10, 10, 2, 'aaa'),
(3, 'nnn', 4, 1371653202, 1371654167, 2, 'ttt'),
(4, 'nnn', 3, 1371653221, 1371653221, 2, 'ttt'),
(5, 'aaa', 3, 1371653980, 1371653980, 1, 'sss'),
(6, 'aaa', 4, 1371654176, 1371657424, 1, 'bbb,uuuuu'),
(7, 'a', 3, 1371658410, 1371658410, 1, ''),
(8, 'a', 3, 1371658413, 1371658413, 1, ''),
(9, 'a', 3, 1371658416, 1371658777, 1, ''),
(10, 'a', 3, 1371658421, 1371658421, 1, ''),
(11, 'a', 3, 1371658426, 1371658426, 1, ''),
(12, 'a', 3, 1371658435, 1371658435, 1, ''),
(13, 'a', 3, 1371658439, 1371669748, 1, 'bla,blabla,blablabla'),
(14, 'a', 3, 1371658463, 1371658486, 1, ''),
(15, 'bbb', 3, 1371658473, 1371658473, 1, ''),
(16, 'testnews', 3, 1371896430, 1371896445, 2, 'hallo,test'),
(17, 'gggg', 3, 1371896456, 1371896456, 1, ''),
(18, 'RUBEN', 3, 1371896544, 1371896544, 1, ''),
(19, 'Rppppqsdqsd', 5, 1371896637, 1371902441, 1, ''),
(20, 'another1@', 3, 1371896707, 1371896707, 1, ''),
(21, 'xyz', 3, 1371896828, 1371902434, 1, ''),
(22, 'a', 3, 1371901535, 1371901535, 1, ''),
(23, 'test', 3, 1371901667, 1371901667, 1, ''),
(24, 'a', 3, 1371901959, 1371901959, 1, ''),
(25, 'dfghj', 3, 1371975047, 1371975047, 5, 'dfghj');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_dummy`
--

CREATE TABLE `tbl_item_dummy` (
  `id` int(7) NOT NULL,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_dummy`
--

INSERT INTO `tbl_item_dummy` (`id`, `value`) VALUES
(1, 'vallllueaaaxx'),
(3, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, 'qsd'),
(10, ''),
(13, ''),
(14, ''),
(15, ''),
(18, ''),
(20, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_news`
--

CREATE TABLE `tbl_item_news` (
  `id` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_news`
--

INSERT INTO `tbl_item_news` (`id`) VALUES
(16),
(19),
(21);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_user`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `mail`, `datereg`, `pwd`, `secra`, `secrq`, `gender`, `fbid`) VALUES
(3, 'admin', 'admin@admin.be', 6, '6ad4664ba23eac71b5ef5e826ea0c6cd', '', '', 'M', ''),
(4, 'test', 'a', 6, 'bc18a007185593423a61f573be365f6d', '', '', 'M', ''),
(5, 'test2', 'rubensworks@gmail.com', 6, 'cbb18f48f09f44c4e4dbd6fcde934023', 'aha!', 'huh?', 'M', '');

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  ADD CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`);

--
-- Beperkingen voor tabel `tbl_item_dummy`
--
ALTER TABLE `tbl_item_dummy`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Beperkingen voor tabel `tbl_item_news`
--
ALTER TABLE `tbl_item_news`
  ADD CONSTRAINT `tbl_item_news_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

