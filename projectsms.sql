-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2023 at 04:13 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsms`
--
CREATE DATABASE IF NOT EXISTS `projectsms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projectsms`;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `tol` varchar(255) DEFAULT NULL,
  `pts` varchar(255) DEFAULT NULL,
  `contractor` varchar(255) DEFAULT NULL,
  `contractno` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `archived` varchar(255) DEFAULT NULL,
  `archivedate` datetime DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `primaryassigneng` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects_users`
--

DROP TABLE IF EXISTS `projects_users`;
CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtaskscategories`
--

DROP TABLE IF EXISTS `subtaskscategories`;
CREATE TABLE IF NOT EXISTS `subtaskscategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `subcat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `subcat` varchar(255) DEFAULT NULL,
  `revno` varchar(255) DEFAULT NULL,
  `letterno` varchar(255) DEFAULT NULL,
  `letterdate` date DEFAULT NULL,
  `recedate` date DEFAULT NULL,
  `replyno` varchar(255) DEFAULT NULL,
  `replydate` date DEFAULT NULL,
  `conshrs` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `dayscount` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `assignuser` varchar(255) DEFAULT NULL,
  `cdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taskscategories`
--

DROP TABLE IF EXISTS `taskscategories`;
CREATE TABLE IF NOT EXISTS `taskscategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(250) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `division` varchar(255) DEFAULT NULL,
  `emptype` varchar(255) DEFAULT NULL,
  `approved` varchar(255) DEFAULT '1',
  `nationality` varchar(255) DEFAULT NULL,
  `joiningdate` date DEFAULT NULL,
  `gradyear` date DEFAULT NULL,
  `vacbalance` varchar(255) DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
