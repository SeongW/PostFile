CREATE DATABASE crawler;

DROP TABLE IF EXISTS `link_url`;
CREATE TABLE `link_url` (
  `md5` varchar(40) NOT NULL,
  `url` varchar(1024) NOT NULL,
  PRIMARY KEY (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pic_url`;
CREATE TABLE `pic_url` (
  `md5` varchar(40) NOT NULL,
  `url` varchar(1024) NOT NULL,
  PRIMARY KEY (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
