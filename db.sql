-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-11-07 14:00:41
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for cv
CREATE DATABASE IF NOT EXISTS `cv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cv`;


-- Dumping structure for table cv.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.meta
CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.meta_category
CREATE TABLE IF NOT EXISTS `meta_category` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.occupation
CREATE TABLE IF NOT EXISTS `occupation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `type` enum('Education','Job') NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.occupation_meta
CREATE TABLE IF NOT EXISTS `occupation_meta` (
  `occupation` int(10) unsigned NOT NULL,
  `meta` int(10) unsigned NOT NULL,
  PRIMARY KEY (`meta`,`occupation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.project_meta
CREATE TABLE IF NOT EXISTS `project_meta` (
  `project` int(10) unsigned NOT NULL,
  `meta` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table cv.project_occupation
CREATE TABLE IF NOT EXISTS `project_occupation` (
  `project` int(10) unsigned NOT NULL,
  `occupation` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
