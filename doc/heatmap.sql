SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `heatmap`;
CREATE TABLE `heatmap` (
  id int NOT NULL AUTO_INCREMENT,
  page_id int DEFAULT NULL,
  browser_id bigint DEFAULT NULL,
  screen varchar(20) DEFAULT NULL,
  view_port varchar(20) DEFAULT NULL,
  window_browser varchar(20) DEFAULT NULL,
  data_serial text,
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
