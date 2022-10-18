# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.8.3-MariaDB-1:10.8.3+maria~jammy)
# Database: fishFood
# Generation Time: 2022-10-17 14:28:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ingredients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ingredients`;

CREATE TABLE `ingredients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table recipes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recipes`;

CREATE TABLE `recipes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `duration` int(10) NOT NULL,
  `cookTime` int(10) DEFAULT NULL,
  `prepTime` int(10) DEFAULT NULL,
  `instructions` varchar(10000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;

INSERT INTO `recipes` (`id`, `name`, `duration`, `cookTime`, `prepTime`, `instructions`)
VALUES
	(1,'Cheese on Toast',15,10,5,'Put cheese on some bread and toast it'),
	(2,'Beans on Toast',20,15,5,'Microwave beans, toast some toast, put toast on the beans'),
	(3,'Cheese on Beans on Toast',25,20,5,'Place the cheese in the toast, toast the beans and bread the toast');

/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table recipes_ingredients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recipes_ingredients`;

CREATE TABLE `recipes_ingredients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipeId` int(10) NOT NULL,
  `ingredientId` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`)
VALUES
	(1,'chris@chris.com'),
	(2,'mike@key.com'),
	(3,'aid@dan.com');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_recipes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_recipes`;

CREATE TABLE `users_recipes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `recipeId` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users_recipes` WRITE;
/*!40000 ALTER TABLE `users_recipes` DISABLE KEYS */;

INSERT INTO `users_recipes` (`id`, `userId`, `recipeId`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,1,3),
	(4,2,3),
	(5,2,1),
	(6,3,2),
	(7,3,1);

/*!40000 ALTER TABLE `users_recipes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
