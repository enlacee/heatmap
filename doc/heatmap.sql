-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `heatmap`;
CREATE TABLE `heatmap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) DEFAULT NULL,
  `id_browser` bigint(20) DEFAULT NULL,
  `screen` varchar(20) DEFAULT NULL,
  `view_port` varchar(20) DEFAULT NULL,
  `window_browser` varchar(20) DEFAULT NULL,
  `data_serial` text,
  `create_at` datetime DEFAULT NULL,
  `upate_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2014-08-29 06:11:48