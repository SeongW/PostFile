
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES ('123','123');
UNLOCK TABLES;
