-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Generation Time: Jul 28, 2013 at 10:45 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admins', '3', NULL, 'N;'); -- Enter the id of the admin account

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admins', 2, 'Users who can do everything including altering core settings.', NULL, 'N;'),
('Auth Assignments Manager', 2, 'Manages Role Assignments. RBAM required role.', NULL, 'N;'),
('Auth Items Manager', 2, 'Manages Auth Items. RBAM required role.', NULL, 'N;'),
('authenticated', 2, 'Default role for users that are logged in. RBAC default role.', 'return !Yii::app()->user->isGuest;', 's:0:"";'),
('dashboardUser', 0, 'allow access to the user dashboard', NULL, 'N;'),
('deleteComment', 0, 'delete comments from other users', NULL, 'N;'),
('guest', 2, 'Default role for users that are not logged in. RBAC default role.', 'return Yii::app()->user->isGuest;', 's:0:"";'),
('manageFiles', 0, 'Allow managing of file items.', NULL, 'N;'),
('manageItems', 0, 'manage the various items', NULL, 'N;'),
('manageNavigation', 0, 'manage the navigation items', NULL, 'N;'),
('manageNews', 0, 'manage the news', NULL, 'N;'),
('managePages', 0, 'manage the various pages', NULL, 'N;'),
('Managers', 2, 'Users who are able to manage content.', NULL, 'N;'),
('manageText', 0, 'manage the text items', NULL, 'N;'),
('RBAC Manager', 2, 'Manages Auth Items and Role Assignments. RBAM required role.', NULL, 'N;'),
('registerUser', 0, 'let a guest register himself', NULL, 'N;'),
('SuperManagers', 2, 'Users who can manage everything.', NULL, 'N;');

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Admins', 'Auth Assignments Manager'),
('RBAC Manager', 'Auth Assignments Manager'),
('Admins', 'Auth Items Manager'),
('RBAC Manager', 'Auth Items Manager'),
('Managers', 'authenticated'),
('authenticated', 'dashboardUser'),
('SuperManagers', 'deleteComment'),
('SuperManagers', 'manageFiles'),
('SuperManagers', 'manageItems'),
('SuperManagers', 'manageNavigation'),
('SuperManagers', 'manageNews'),
('SuperManagers', 'managePages'),
('SuperManagers', 'Managers'),
('SuperManagers', 'manageText'),
('Admins', 'RBAC Manager'),
('guest', 'registerUser'),
('Admins', 'SuperManagers');
