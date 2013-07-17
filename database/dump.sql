-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 17 jul 2013 om 15:01
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admins', '3', NULL, 'N;');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admins', 2, 'Users who can do everything including altering core settings.', NULL, 'N;'),
('Auth Assignments Manager', 2, 'Manages Role Assignments. RBAM required role.', NULL, 'N;'),
('Auth Items Manager', 2, 'Manages Auth Items. RBAM required role.', NULL, 'N;'),
('authenticated', 2, 'Default role for users that are logged in. RBAC default role.', 'return !Yii::app()->user->isGuest;', 's:0:"";'),
('dashboardUser', 0, 'allow access to the user dashboard', NULL, 'N;'),
('deleteComment', 0, 'delete comments from other users', NULL, 'N;'),
('guest', 2, 'Default role for users that are not logged in. RBAC default role.', 'return Yii::app()->user->isGuest;', 's:0:"";'),
('manageItems', 0, 'manage the various items', NULL, 'N;'),
('manageNavigation', 0, 'manage the navigation items', NULL, 'N;'),
('manageNews', 0, 'manage the news', NULL, 'N;'),
('managePages', 0, 'manage the various pages', NULL, 'N;'),
('Managers', 2, 'Users who are able to manage content.', NULL, 'N;'),
('manageText', 0, 'manage the text items', NULL, 'N;'),
('RBAC Manager', 2, 'Manages Auth Items and Role Assignments. RBAM required role.', NULL, 'N;'),
('registerUser', 0, 'let a guest register himself', NULL, 'N;'),
('SuperManagers', 2, 'Users who can manage everything.', NULL, 'N;');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `AuthItemChild`
--

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Admins', 'Auth Assignments Manager'),
('RBAC Manager', 'Auth Assignments Manager'),
('Admins', 'Auth Items Manager'),
('RBAC Manager', 'Auth Items Manager'),
('Managers', 'authenticated'),
('authenticated', 'dashboardUser'),
('SuperManagers', 'deleteComment'),
('SuperManagers', 'manageItems'),
('SuperManagers', 'manageNavigation'),
('SuperManagers', 'manageNews'),
('SuperManagers', 'managePages'),
('SuperManagers', 'Managers'),
('SuperManagers', 'manageText'),
('Admins', 'RBAC Manager'),
('guest', 'registerUser'),
('Admins', 'SuperManagers');

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
-- Tabelstructuur voor tabel `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date_created` int(15) NOT NULL,
  `author_id` int(7) NOT NULL,
  `item_id` int(7) NOT NULL,
  `content` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `date_created`, `author_id`, `item_id`, `content`) VALUES
(55, 1372167887, 3, 21, 'q'),
(56, 1372167991, 3, 21, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a magna justo. Nulla vitae pellentesque turpis. Vestibulum vulputate, massa et dictum mollis, nisi justo sagittis turpis, at tempus ipsum velit et turpis. Phasellus nec justo dui. Proin rhoncus pulvinar nisl, vitae commodo sapien venenatis non. Fusce vitae posuere eros. Quisque volutpat facilisis diam, id ultrices magna accumsan eget.'),
(57, 1372167998, 3, 21, 'Vivamus pharetra erat purus, in ullamcorper dui cursus tincidunt. Nullam nisl sem, vestibulum vitae condimentum a, lacinia varius massa. Etiam interdum lorem diam, a rhoncus erat interdum viverra. Maecenas bibendum varius leo sollicitudin fermentum. Vivamus ullamcorper, dui commodo accumsan mollis, lacus justo dignissim magna, et cursus arcu felis non enim. Duis iaculis nunc nibh, eu tempus sem ornare vel. Sed at interdum metus, vehicula semper nunc.'),
(58, 1372168014, 3, 21, 'Praesent imperdiet velit quis quam sagittis, quis semper leo venenatis. Etiam rutrum lectus nibh, in vestibulum tortor sodales id. Sed pharetra convallis rhoncus. Morbi nec nibh mauris. Vestibulum eros neque, mollis quis venenatis at, pharetra ac erat. Proin in imperdiet justo. Phasellus condimentum faucibus nisl a tempus. Proin libero arcu, scelerisque nec elit sed, consectetur laoreet eros. Aliquam aliquet vitae elit sit amet pellentesque.'),
(59, 1372168021, 3, 21, 'Maecenas porta egestas est pretium tempus. Duis laoreet, ante eget hendrerit auctor, leo elit vehicula dui, at sagittis erat elit eget eros. Suspendisse quis mattis diam. Aliquam sed velit in mauris scelerisque facilisis.'),
(60, 1372172285, 3, 19, 'sssss'),
(61, 1372680239, 3, 16, 'drie'),
(63, 1372680248, 3, 16, 'vier'),
(65, 1373119564, 3, 16, 'a'),
(66, 1373121496, 3, 16, 'xyz'),
(68, 1373372447, 3, 16, 'sdfqsdf');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_config`
--

CREATE TABLE `tbl_config` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_config`
--

INSERT INTO `tbl_config` (`key`, `value`) VALUES
('core_index_page_id', 'i:8;'),
('core_main_nav_id', 'i:89;');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item`
--

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
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `name`, `content`, `author_id`, `date_created`, `date_changed`, `category_id`, `tags`) VALUES
(1, 'XYZ', 'qsdsssaaaaaXXXxxxaaa', 3, 10, 1374056783, 1, 'test,test2a,aaa,eentagje'),
(2, 'ulu', '', 3, 10, 10, 2, 'aaa'),
(3, 'nnn', '', 4, 1371653202, 1371654167, 2, 'ttt'),
(4, 'nnn', '', 3, 1371653221, 1371653221, 2, 'ttt'),
(6, 'aaa', '', 4, 1371654176, 1371657424, 1, 'bbb,uuuuu'),
(7, 'a', '', 3, 1371658410, 1371658410, 1, ''),
(8, 'a', '', 3, 1371658413, 1371658413, 1, ''),
(9, 'a', '', 3, 1371658416, 1371658777, 1, ''),
(10, 'a', '', 3, 1371658421, 1371658421, 1, ''),
(11, 'a', '', 3, 1371658426, 1371658426, 1, ''),
(12, 'a', '', 3, 1371658435, 1371658435, 1, ''),
(13, 'a', '', 3, 1371658439, 1371669748, 1, 'bla,blabla,blablabla'),
(14, 'a', '', 3, 1371658463, 1371658486, 1, ''),
(15, 'bbb', '', 3, 1371658473, 1371658473, 1, ''),
(16, 'testnews', '<h3><b>This is a test</b></h3>', 3, 1371896430, 1373890903, 2, 'hallo,test'),
(17, 'gggg', '', 3, 1371896456, 1371896456, 1, ''),
(18, 'RUBEN', '', 3, 1371896544, 1371896544, 1, ''),
(19, 'Rppppqsdqsd', '', 5, 1371896637, 1373030244, 1, 'test'),
(20, 'another1@', '', 3, 1371896707, 1373209221, 1, ''),
(21, 'xyz', '', 3, 1371896828, 1373030261, 1, ''),
(22, 'a', '', 3, 1371901535, 1371901535, 1, ''),
(23, 'test', '', 3, 1371901667, 1371901667, 1, ''),
(24, 'a', '', 3, 1371901959, 1371901959, 1, ''),
(25, 'dfghj', '', 3, 1371975047, 1371975047, 5, 'dfghj'),
(32, 'HALLO', '', 3, 1372603270, 1372603270, 1, ''),
(33, 'HALLO', '', 3, 1372603324, 1372603324, 1, ''),
(34, 'HALLo', '', 3, 1372603346, 1372603346, 1, ''),
(35, 'HALLO', '', 3, 1372603478, 1372603478, 1, ''),
(37, 'test', '', 3, 1373804738, 1373804738, 1, 'a'),
(38, 'aaa', '', 3, 1373805085, 1373805085, 1, 'a'),
(39, 'aaa', '', 3, 1373806283, 1373806283, 1, 'a'),
(40, 'aaa', '', 3, 1373808150, 1373808150, 1, 'a'),
(41, 'aaa', '', 3, 1373808449, 1373808449, 1, 'a'),
(42, 'aaa', '', 3, 1373808499, 1373808499, 1, 'a'),
(43, 'aaa', '', 3, 1373808516, 1373808516, 1, 'a'),
(44, 'aa', '', 3, 1373808524, 1373808524, 1, 'aaaa'),
(45, 'aaa', '', 3, 1373808612, 1373808612, 1, 'aa'),
(46, 'a', '', 3, 1373808629, 1373808629, 1, 'a'),
(47, 'a', '', 3, 1373808662, 1373808662, 1, 'a'),
(49, 'a', '', 3, 1373822349, 1373822349, 1, ''),
(50, 'aa', '', 3, 1373822640, 1373822640, 1, ''),
(52, 'x', '', 3, 1373824820, 1373824820, 1, ''),
(53, 'Test', '', 3, 1373886789, 1373886941, 1, 'hallo'),
(54, 'Inleiding', 'Hallo, dit is de index die aangepast kan worden in de Dashboard, admin rechten zijn vereist.', 3, 1373890008, 1373891193, 1, ''),
(55, 'a', '', 3, 1373967036, 1373967036, 1, ''),
(56, 'aaaa', '', 3, 1373967112, 1373967112, 1, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_dummy`
--

CREATE TABLE `tbl_item_dummy` (
  `id` int(7) NOT NULL,
  `value` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_dummy`
--

INSERT INTO `tbl_item_dummy` (`id`, `value`) VALUES
(1, 1),
(3, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(13, 0),
(14, 0),
(15, 0),
(18, 0),
(20, 0),
(55, 0),
(56, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_navigation`
--

CREATE TABLE `tbl_item_navigation` (
  `id` int(7) NOT NULL,
  `navigation_id` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_navigation`
--

INSERT INTO `tbl_item_navigation` (`id`, `navigation_id`) VALUES
(53, 126);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_news`
--

CREATE TABLE `tbl_item_news` (
  `id` int(7) NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_news`
--

INSERT INTO `tbl_item_news` (`id`, `excerpt`) VALUES
(16, 'blublusss'),
(19, 'Dit is een korte inleiding!'),
(21, 'korte inhoud');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_item_text`
--

CREATE TABLE `tbl_item_text` (
  `id` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_item_text`
--

INSERT INTO `tbl_item_text` (`id`) VALUES
(54);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_navigation`
--

CREATE TABLE `tbl_navigation` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `type` enum('ROOT','NODE','LEAF') NOT NULL,
  `route` varchar(100) NOT NULL,
  `parent_id` int(7) NOT NULL,
  `row_order` int(5) NOT NULL,
  `bizrule` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_navigation`
--

INSERT INTO `tbl_navigation` (`id`, `label`, `type`, `route`, `parent_id`, `row_order`, `bizrule`) VALUES
(89, 'Root', 'ROOT', '', 0, 0, ''),
(100, 'Ding 1', 'NODE', '', 89, 0, ''),
(111, 'En hier ook niets', 'NODE', '', 113, 0, ''),
(112, 'Nog een ding', 'NODE', '', 100, 0, 'return $this->label=="Nog een ding";'),
(113, 'Niets hier', 'NODE', '', 115, 1, ''),
(114, 'Navigation admin', 'LEAF', '/navigation/admin', 112, 0, ''),
(115, 'Nieuw element', 'NODE', '', 89, 1, ''),
(116, 'Nieuwe link', 'LEAF', '/', 115, 0, ''),
(117, 'Nieuwe link', 'LEAF', '/', 111, 0, ''),
(118, 'Index', 'LEAF', '/site/index', 112, 1, ''),
(119, 'Dashboard', 'LEAF', '/user/dashboard', 112, 3, ''),
(120, 'CUSTOM_ROOT', 'ROOT', '', 0, 0, ''),
(121, 'Nieuw element', 'NODE', '', 120, 0, ''),
(122, 'Nieuwe link', 'LEAF', '/', 121, 0, ''),
(123, 'CUSTOM_ROOT', 'ROOT', '', 0, 0, ''),
(124, 'Nieuw element', 'NODE', '', 123, 0, ''),
(125, 'Nieuwe link', 'LEAF', '', 124, 0, ''),
(126, 'CUSTOM_ROOT', 'ROOT', '', 0, 0, ''),
(127, 'Nieuw element', 'NODE', '', 126, 0, ''),
(128, 'Nieuwe link', 'LEAF', '/', 127, 0, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `author_id` int(7) NOT NULL,
  `columns` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `name`, `author_id`, `columns`) VALUES
(4, 'pagina 123', 4, 2),
(7, 'xyz', 3, 1),
(8, 'Home', 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_translation`
--

CREATE TABLE `tbl_translation` (
  `translation_key` int(7) NOT NULL,
  `language` varchar(2) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`translation_key`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_translation`
--

INSERT INTO `tbl_translation` (`translation_key`, `language`, `value`) VALUES
(1, 'nl', 'Testing...');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_translation_key`
--

CREATE TABLE `tbl_translation_key` (
  `translation_key` int(7) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`translation_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_translation_key`
--

INSERT INTO `tbl_translation_key` (`translation_key`) VALUES
(1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `mail`, `datereg`, `pwd`, `secra`, `secrq`, `gender`, `fbid`) VALUES
(3, 'admin', 'admin@admin.be', 7, '21232f297a57a5a743894a0e4a801fc3', '', '', 'M', ''),
(4, 'test', 'a', 6, 'bc18a007185593423a61f573be365f6d', '', '', 'M', ''),
(5, 'test2', 'rubensworks@gmail.com', 7, '9589f46d46ad079911a79b7b1ec6f084', 'aha!', 'huh?', 'M', ''),
(6, 'aap', 'aap@aap.be', 7, 'be8c5618210c6079f0997f77a9d6479f', 'aap', 'aap', 'M', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_widget`
--

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
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_widget`
--

INSERT INTO `tbl_widget` (`id`, `name`, `page_id`, `col_id`, `row_order`, `item_type`, `widget_type`, `filter_category`, `category_id`, `filter_tags`, `tags`, `amount`, `item_id`) VALUES
(85, 'Een dummy dingessss', 4, 0, 0, 'DummyItem', 'SINGLE', 1, 5, 0, 'tag1,tag2,tag3,tag4', 4, 18),
(126, 'Een nieuws dinges', 4, 1, 0, 'NewsItem', 'SINGLE', 0, 1, 0, '', 1, 16),
(127, 'Allemaal Nieuws Dingen', 4, 1, 1, 'NewsItem', 'LIST', 0, 1, 0, 'test,hallo', 5, 0),
(128, 'Allemaal dummy dingen', 4, 0, 1, 'DummyItem', 'LIST', 0, 1, 1, '', 5, 0),
(130, 'Nieuwe Widget', 4, 0, 3, 'NewsItem', 'LIST', 0, 1, 0, '', 1, 0),
(131, 'Nieuwe Widget', 4, 1, 2, 'NavigationItem', 'SINGLE', 0, 0, 0, '', 1, 53),
(132, 'Inleiding', 8, 0, 0, 'TextItem', 'SINGLE', 0, 0, 0, '', 1, 54),
(133, 'Laatste Nieuws', 8, 0, 1, 'NewsItem', 'LIST', 0, 0, 0, '', 5, 0);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Beperkingen voor tabel `tbl_item_navigation`
--
ALTER TABLE `tbl_item_navigation`
  ADD CONSTRAINT `tbl_item_navigation_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Beperkingen voor tabel `tbl_item_news`
--
ALTER TABLE `tbl_item_news`
  ADD CONSTRAINT `tbl_item_news_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Beperkingen voor tabel `tbl_item_text`
--
ALTER TABLE `tbl_item_text`
  ADD CONSTRAINT `tbl_item_text_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`),
  ADD CONSTRAINT `tbl_item_text_ibfk_2` FOREIGN KEY (`id`) REFERENCES `tbl_item` (`id`);

--
-- Beperkingen voor tabel `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD CONSTRAINT `tbl_page_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`);

--
-- Beperkingen voor tabel `tbl_translation`
--
ALTER TABLE `tbl_translation`
  ADD CONSTRAINT `tbl_translation_ibfk_1` FOREIGN KEY (`translation_key`) REFERENCES `tbl_translation_key` (`translation_key`);

--
-- Beperkingen voor tabel `tbl_widget`
--
ALTER TABLE `tbl_widget`
  ADD CONSTRAINT `tbl_widget_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `tbl_page` (`id`);
