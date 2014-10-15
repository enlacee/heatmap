SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS heatmap;
CREATE TABLE heatmap (
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

DROP TABLE IF EXISTS page;
CREATE TABLE page (
  id int NOT NULL AUTO_INCREMENT,
  url tinytext NOT NULL,
  enabled int DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO page (id, url) VALUES
(1, 'http://localhost/heatmap/client.html'),
(2, 'http://vlearning.icpna.edu.pe/in/web/login'),
(3, 'http://vlearning.icpna.edu.pe/in/web/modules'),
(4, 'http://vlearningkids.icpna.edu.pe/courses/COURSE002/index.php'),
(5, 'http://vlearningkids.icpna.edu.pe/main/newscorm/lp_controller.php'),
(6, 'http://vlearningkids.icpna.edu.pe/main/social/home.php'),
(7, 'http://vlearningkids.icpna.edu.pe/main/messages/inbox.php'),
(8, 'http://vlearningkids.icpna.edu.pe/main/social/whereiam.php'),
(9, 'http://vlearningkids.icpna.edu.pe/main/social/myperformance.php');
