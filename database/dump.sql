-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 15 jun 2013 om 14:46
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
('guest', 2, 'guest user', 'return Yii::app()->user->isGuest;', 'N;'),
('registered', 2, 'authenticated user', 'return !Yii::app()->user->isGuest;', 'N;');

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
('guest', 'readUser'),
('guest', 'registerUser'),
('registered', 'dashboardUser'),
('registered', 'readUser');

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
  `gender` enum('M','F') NOT NULL,
  `fbid` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `mail`, `datereg`, `pwd`, `gender`, `fbid`) VALUES
(3, 'admin', 'admin@admin.be', 6, 'e00cf25ad42683b3df678c61f42c6bda', 'M', '');
