DROP DATABASE IF EXISTS `smallApplication`;
CREATE DATABASE `smallApplication`;
USE `smallApplication`;

CREATE TABLE IF NOT EXISTS `promocode` (
  `id` MEDIUMINT unsigned NOT NULL AUTO_INCREMENT,
  `promocode` CHAR(10) CHARACTER SET ascii NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promocode` (`promocode`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COMMENT='Stores promotional codes.';

CREATE TABLE IF NOT EXISTS `user_promocode` (
  `id` MEDIUMINT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` CHAR(10) CHARACTER SET ascii NOT NULL,
  `promocode_id` MEDIUMINT unsigned NOT NULL,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE `promocode_id` (`promocode_id`),
  CONSTRAINT `user_promocode_constraint` FOREIGN KEY (`promocode_id`) REFERENCES `promocode` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COMMENT='It keeps user relationship towards promotional codes.';