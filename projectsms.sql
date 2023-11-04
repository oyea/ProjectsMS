-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2023 at 01:20 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

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
CREATE DATABASE IF NOT EXISTS `projectsms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projectsms`;

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `WEEKDAY_DIFF`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `WEEKDAY_DIFF` (`date1` DATE, `date2` DATE) RETURNS INT  BEGIN

    DECLARE diff INT;

    SET diff = ABS(DATEDIFF(date2, date1)) + 1;

    

    WHILE date1 <= date2 DO

        IF DAYOFWEEK(date1) = 6 OR DAYOFWEEK(date1) = 7 THEN

            SET diff = diff - 1;

        END IF;

        SET date1 = ADDDATE(date1, INTERVAL 1 DAY);

    END WHILE;

    

    RETURN diff;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_read` int DEFAULT '0',
  `cdate` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uid`, `msg`, `link`, `is_read`, `cdate`) VALUES
(1, 8, 'New task assigned to you:after format', 'task?id=41', 1, '0000-00-00 00:00:00'),
(2, 8, 'New task assigned to you:after format 2', 'task?id=42', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `cdate`, `tol`, `pts`, `contractor`, `contractno`, `category`, `archived`, `archivedate`, `author`, `primaryassigneng`) VALUES
(1, 'Sahel Towers Building 43', '2023-06-20 14:37:49', '987754000012', '1100014754', 'Alajel Trading. Company', '44011542-5', 'EHV', '0', NULL, NULL, '1'),
(105, 'Copy of_ main ten proj', '2023-07-31 16:29:35', '1212', '2121', '', '', 'Maintenance', '0', NULL, '9', ''),
(106, 'main ten proj66', '2023-07-31 16:30:32', '1212', '2121', '', '', 'Maintenance', '0', NULL, '9', '1'),
(107, 'hv proj j', '2021-07-31 16:31:15', '5454', '4864', '', '', 'HV', '0', NULL, '9', ''),
(108, 'ehv some', '2023-07-31 16:31:47', '1112', '2211', '', '', 'EHV', '1', '2023-07-31 16:32:19', '9', ''),
(109, 'Copy of_ ehv some', '2022-07-31 16:31:56', '1112', '2211', '', '', 'EHV', '1', '2023-07-31 16:32:10', '9', '1'),
(97, 'substation 47', '2023-07-19 16:58:13', '147', '852', 'alothman', '44144400001', 'Maintenance', '0', NULL, NULL, '1'),
(98, 'new project sat', '2023-07-22 14:50:42', '112233', '332211', 'alfanar', '44112233', 'EHV', '1', '2023-07-31 15:50:35', '9', '3'),
(100, 'sh sat', '2023-07-22 16:36:49', '987', '789', '', '', 'Maintenance', '1', '2023-07-31 14:46:11', '9', '8'),
(103, 'rashid 888', '2023-07-26 23:06:34', '1212', '1233', '', '', 'HV', '0', NULL, '8', ''),
(104, 'main ten proj', '2023-07-31 16:29:14', '1212', '2121', '', '', 'Maintenance', '0', NULL, '9', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects_users`
--

DROP TABLE IF EXISTS `projects_users`;
CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_id` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `userid`) VALUES
(107, '66', '3'),
(106, '66', '1'),
(185, '97', '2'),
(35, 'Array', '2'),
(177, '1', '1'),
(178, '1', '5'),
(186, '103', '2'),
(181, '98', '3'),
(182, '100', '2'),
(183, '100', '4'),
(184, '97', '1'),
(187, '103', '3'),
(188, '104', '1'),
(189, '104', '2'),
(190, '104', '3'),
(191, '106', '1'),
(192, '106', '3'),
(193, '107', '3'),
(194, '107', '4'),
(195, '108', '2'),
(196, '108', '4'),
(197, '109', '1'),
(198, '109', '2');

-- --------------------------------------------------------

--
-- Table structure for table `subtaskscategories`
--

DROP TABLE IF EXISTS `subtaskscategories`;
CREATE TABLE IF NOT EXISTS `subtaskscategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `subcat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `subtaskscategories`
--

INSERT INTO `subtaskscategories` (`id`, `category_id`, `subcat`) VALUES
(1, '1', 'sub pr cat'),
(2, '1', 'sub pr 2'),
(3, '3', ' design r 1'),
(4, '3', 'design r 2');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `category`, `subcat`, `revno`, `letterno`, `letterdate`, `recedate`, `replyno`, `replydate`, `conshrs`, `author`, `project`, `progress`, `dayscount`, `weight`, `score`, `assignuser`, `cdate`) VALUES
(30, 'fill forms', '3', '4', '0', '01', '2023-07-25', '2023-07-26', '', NULL, '', '9', '100', '0', NULL, NULL, NULL, '8', '2023-07-26 15:24:41'),
(28, 'new task SAT', '4', '', '0', '12233', '2023-07-20', '2023-07-29', '', NULL, '', '9', '98', '0', NULL, NULL, NULL, '9', '2023-07-22 11:53:08'),
(29, 'omer SAT 05:06', '5', '', '212', '222', '2023-07-01', '2023-07-27', '221', '2023-07-27', '3', '9', '1', '100', '1', NULL, NULL, '5', '2023-07-22 14:06:55'),
(26, 'Sat 2', '1', '2', '2', '72', '2023-07-22', '2023-07-23', '33321', '2023-07-22', '2', NULL, '97', '100', '2', NULL, NULL, '7', '2023-07-22 10:31:59'),
(25, 'sat', '2', '', '0', '11', '2023-08-02', '2023-08-01', '', NULL, '', NULL, '97', '0', NULL, NULL, NULL, '4', '2023-07-22 10:30:48'),
(7, 'comp task 2 proj 1', '7', '2', '', '', '2023-07-10', '2023-07-11', '', NULL, '', NULL, '1', '0', NULL, NULL, NULL, '1', '2023-07-10 14:53:22'),
(8, 'comp task 1 proj 1', '1', '2', '11', '222', '2023-07-11', '2023-07-26', 'rno', '2023-07-13', '11.5', NULL, '1', '100', '14', NULL, NULL, '4', '2023-07-11 11:11:49'),
(33, 'test task', '1', '1', '1', '', '2023-08-01', '2023-08-01', '', NULL, '', '9', '108', '0', NULL, NULL, NULL, '5', '2023-08-01 12:07:35'),
(32, 'Copy of_ fill forms', '3', '4', '0', '01', '2023-06-29', '2023-07-24', '', NULL, '', '8', '100', '0', NULL, NULL, NULL, '', '2023-07-26 16:41:02'),
(36, 'pending task today', '13', '', '1', '', '2023-08-01', '2023-08-03', '', NULL, '', '9', '106', '0', NULL, NULL, NULL, '7', '2023-08-03 12:59:04'),
(35, 'anoth comp', '3', '', '', '', '2023-08-01', '2023-08-01', '7887', '2023-08-01', '', '9', '108', '100', '1', NULL, NULL, '8', '2023-08-01 12:10:19'),
(13, 'yousi test projec 1', '1', '2', '', '', '2023-07-11', '2023-07-31', '', NULL, '', NULL, '1', '0', NULL, NULL, NULL, '9', '2023-07-17 14:06:41'),
(14, 'shaz sal 3 proj 1', '2', '', '1119', '8889', '2023-07-25', '2023-07-26', '', NULL, '', NULL, '1', '0', NULL, NULL, NULL, '4', '2023-07-17 14:07:35'),
(37, 'comp task today', '24', '', '0', '', '2023-08-03', '2023-08-03', '1254', '2023-08-03', '2', '9', '106', '100', '1', NULL, NULL, '1', '2023-08-03 13:00:47'),
(38, 'days coinut task', '', '', '', '', '2023-08-01', '2023-08-03', '', '2023-08-06', '', '9', '1', '0', '2', NULL, NULL, '19', '2023-08-06 17:26:28'),
(39, 'empty reply date', '', '', '', '', '2023-08-01', '2023-08-03', '', NULL, '', '9', '1', '0', NULL, NULL, NULL, '7', '2023-08-06 17:39:32'),
(40, 'not empty reply date', '', '', '', '', '2023-08-06', '2023-08-07', '', '2023-08-11', '', '9', '1', '100', '4', NULL, NULL, '9', '2023-08-06 17:40:14'),
(41, 'after format', '1', '1', 'dsf', 'dsfdsf', '2023-11-04', '2023-11-04', '', NULL, '', '9', '109', '0', NULL, '1', NULL, '8', '2023-11-04 13:13:01'),
(42, 'after format 2', '3', '4', '', '', '2023-11-03', '2023-11-03', '', NULL, '', '9', '109', '0', NULL, '0.7', NULL, '8', '2023-11-04 13:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `taskscategories`
--

DROP TABLE IF EXISTS `taskscategories`;
CREATE TABLE IF NOT EXISTS `taskscategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `hours` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `taskscategories`
--

INSERT INTO `taskscategories` (`id`, `category`, `weight`, `duration`, `hours`) VALUES
(1, '01- Issuing a PR/TS (SOW)', '1', '10', '28'),
(2, '02- Revise/Review a PR Ver. X', '0.5', '2', '6'),
(3, '03- Review a bidder clarification (per bidder)', '0.7', '3', '10'),
(4, '04- Review the relay list', '0.5', '3', '12'),
(5, '05- Review the project base design', '1', '10', '28'),
(6, '05.2- Review the project base design per equipment or voltage level', '0.5', '4.16', '5'),
(7, '06- Review the project details design', '1', '10', '30'),
(8, '06.2- Review the project details design per equipment or voltage level', '0.5', '3', '6'),
(9, '07- Review of protection cross-related project submittals (TFR, SOE, LCC,...)', '0.3', '5', '8'),
(10, '08- Issuing the protection relay setting per equipment ( TR, line, BB, Other )', '1', '3', '30'),
(11, '09- Issuing the protection relay setting per substation', '1', '10', '40'),
(12, '10- Relay setting coordination study or setting at interface point with \"Generation, DBU, Bulk customer\" (per study)', '1', '10', '20'),
(13, '11- Nth version of the any project submittals', '0.5', '5', '6'),
(14, '12- Miscellaneous documents review', '0.4', '3', '6'),
(15, '13- Review of irrelevant protection submittals (out of PED scope)', '0.2', '5', '1'),
(16, '14- Prepare a base design for special protection scheme (SPS), per request', '1', '3', '20'),
(17, '15- Quick response to normalize the fault and give quick response before morning call (per incident)', '1', '1', '2'),
(18, '16- Fault analysis (per incident)', '1', '3', '6'),
(19, '17- Review Standards, policies, procedures,...', '0.4', '10', '2'),
(20, '18- Preparing WI, procedure,...', '1', '10', '16'),
(21, '19- Protection relay pre-qualification', '0.3', '10', '8'),
(22, '20- Review OPDS scheme as a team member', '0.7', '10', '8'),
(23, '21- Conduct a wide-area coordination study', '1', '20', '30'),
(24, '22- Peer Review of a project submittal', '0.5', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `taskscategoriesold`
--

DROP TABLE IF EXISTS `taskscategoriesold`;
CREATE TABLE IF NOT EXISTS `taskscategoriesold` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `pduration` varchar(255) DEFAULT NULL,
  `hours` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_users`
--

DROP TABLE IF EXISTS `tasks_users`;
CREATE TABLE IF NOT EXISTS `tasks_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `taskid` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `online` int NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `role`, `name`, `image`, `email`, `division`, `emptype`, `approved`, `nationality`, `joiningdate`, `gradyear`, `vacbalance`, `online`, `cdate`) VALUES
(1, '2255', '', NULL, 'Mohamed Ahmed Alban', NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(2, '3366', '', NULL, 'Ahmed Hussain Gaber', NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(3, '2244', '', NULL, 'Ali Abubakar Omer', NULL, '', NULL, NULL, '1', NULL, NULL, NULL, NULL, 0, NULL),
(4, '8877', '', NULL, 'Hamid A Alfaroq', NULL, '', NULL, NULL, '1', NULL, NULL, NULL, NULL, 0, NULL),
(5, '9955', '', NULL, 'Khalid Sihab Matin', NULL, '', NULL, NULL, '1', NULL, NULL, NULL, NULL, 0, NULL),
(6, '4758', '', NULL, 'Ayman Ahmed Jalal Alfyomi', NULL, 'sad@sd.com', 'RND', '', '1', '', '2023-07-23', NULL, '', 0, '2023-07-24 16:41:08'),
(7, '3245', '', NULL, 'Ahmed Alkhatem Ahmed', NULL, 'asa@dss.com', 'sdf', 'Contractor', '1', 'US', '2023-07-09', '2000-07-01', '34', 0, '2023-07-24 15:28:58'),
(8, '888', '$2y$10$f2.QFVKWyxBUe.f/d8WrBeinQBQ/fA.LzOxVL7PpETi1Rn1z9KirS', 'user', 'Rashid Yaqoob Motalem', 'views/imgs/emps_imgs/8726_WhatsApp Image 2021-11-06 at 11.48.04 PM.jpeg', 'kelo@man.com', 'WOA', 'Saudi Engineer', '1', '', '2023-07-02', NULL, '41', 1, '2023-07-26 22:48:12'),
(9, 'admin', '$2y$10$fAKIrzXpizTWQ4j3uO1yr.y/hK5hg/PCtonBcBdGMKzecqBbVYwlW', 'admin', 'Omer Y. Elsharief', NULL, 'any@so.com', 'RND', 'Contract', '1', 'Sudanese', '2009-01-01', '2007-01-01', '90', 0, '2023-07-22 15:18:31'),
(19, '111', '$2y$10$o0fqAYLL3Ik9oT2GupGLHuvYDViwIvkVbgvxnOLAh9UNo6MR9kEjO', 'user', 'Abu Baker Othman Ali', 'views/imgs/emps_imgs/111_calendar.png', 'sad@sd.com', 'Department', 'Saudi Engineer', '1', 'Sudanese', '2023-07-01', '2007-02-01', '0', 0, '2023-08-03 17:05:26'),
(20, '222', '$2y$10$UDwAoqj7rwwuf9JwRra4L.vEcdNQVVAa5xuyFBUcPiAvCoARE5B2m', 'user', 'Mazin man can use this system', 'views/imgs/emps_imgs/222_car.jpg', 'sad@sd.com', 'COA', 'non-Saudi Engineer', '1', 'Sudanese', '2022-07-01', '2011-02-01', '53', 0, '2023-07-26 15:59:36');

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `score cal intg`$$
CREATE DEFINER=`root`@`localhost` EVENT `score cal intg` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-12-05 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE tel_pf_tasks, qiyasscore SET








tel_pf_tasks.score = qiyasscore.duration / tel_pf_tasks.daysD * qiyasscore.weight * 10








WHERE tel_pf_tasks.TaskC = qiyasscore.id$$

DROP EVENT IF EXISTS `set ReceivedD  null`$$
CREATE DEFINER=`root`@`localhost` EVENT `set ReceivedD  null` ON SCHEDULE EVERY 7 SECOND STARTS '2023-04-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update `tel_pf_tasks` set ReceD = NULL WHERE ReceD = '0000-00-00'$$

DROP EVENT IF EXISTS `set replydate null`$$
CREATE DEFINER=`root`@`localhost` EVENT `set replydate null` ON SCHEDULE EVERY 11 SECOND STARTS '2021-09-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update `tel_pf_tasks` set ReplyD = NULL WHERE ReplyD = '0000-00-00'$$

DROP EVENT IF EXISTS `tasks users intg`$$
CREATE DEFINER=`root`@`localhost` EVENT `tasks users intg` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-12-04 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update tel_pf_task_users, tel_pf_tasks set tel_pf_tasks.User_ID = tel_pf_task_users.user_id where tel_pf_tasks.id = tel_pf_task_users.task_id$$

DROP EVENT IF EXISTS `trainingDaysDiff`$$
CREATE DEFINER=`root`@`localhost` EVENT `trainingDaysDiff` ON SCHEDULE EVERY 1 DAY STARTS '2022-08-20 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update tel_training set total = (DATEDIFF(dto, dfrom)) + 1$$

DROP EVENT IF EXISTS `trainingNameDivision`$$
CREATE DEFINER=`root`@`localhost` EVENT `trainingNameDivision` ON SCHEDULE EVERY 1 DAY STARTS '2022-08-15 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE tel_training, tel_comprofiler SET tel_training.name = tel_comprofiler.cb_name, tel_training.division = tel_comprofiler.cb_division WHERE tel_training.BadgeNo = tel_comprofiler.cb_badgeno$$

DROP EVENT IF EXISTS `weight integration`$$
CREATE DEFINER=`root`@`localhost` EVENT `weight integration` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-12-02 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO update tel_pf_tasks, qiyasscore set tel_pf_tasks.weight = qiyasscore.weight where tel_pf_tasks.TaskC = qiyasscore.id$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
