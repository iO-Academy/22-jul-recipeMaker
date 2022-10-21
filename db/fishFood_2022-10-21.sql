# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.38)
# Database: fishFood
# Generation Time: 2022-10-21 09:42:25 +0000
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

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;

INSERT INTO `ingredients` (`id`, `name`)
VALUES
	(1,'butter'),
	(2,'sugar'),
	(3,'eggs'),
	(4,'7up'),
	(5,'lemon juice'),
	(6,'vanilla'),
	(7,'flour'),
	(8,'lime juice'),
	(9,'lime zest'),
	(10,'avocado'),
	(11,'red onion'),
	(12,'tomato'),
	(13,'cumin'),
	(14,'lime'),
	(15,'salt'),
	(16,'pepper'),
	(17,'bbq sauce'),
	(18,'guinness'),
	(19,'sweetcorn'),
	(20,'chicken'),
	(21,'garlic'),
	(22,'thyme'),
	(23,'lemons'),
	(24,'bread'),
	(25,'cheese'),
	(26,'pasta');

/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'7up Pound Cake',90,70,20,'Preheat oven to 350&deg;. Grease and flour a 10-in. fluted or plain tube pan.\nIn a large bowl, cream butter and sugar until light and fluffy, 5-7 minutes. Add eggs, 1 at a time, beating well after each addition. Beat in lemon juice and vanilla. Add flour alternately with 7UP, beating well after each addition.\nTransfer batter to prepared pan. Bake until a toothpick inserted in center comes out clean, 65-75 minutes. Cool in pan 20 minutes before removing to a wire rack to cool completely.\nFor glaze, in a small bowl, mix confectioners&#039; sugar, lemon juice and enough 7UP to reach desired consistency. If desired, stir in zest. Drizzle over cake.'),
	(2,'7up Guacamole',10,0,10,'Remove the stones and scrape out the flesh of the avocados into a bowl with the rest of the ingredients.\nMash until smooth. Enjoy!'),
	(3,'Mikey&#039;s Special 7up Sauce',720,NULL,NULL,'Add all of the ingredients into a pan and simmer on a medium-low heat for 60 minutes.\nLeave to cool overnight. \nEnjoy with your lunch!'),
	(4,'7up Can Chicken',90,80,10,'Rinse and pat the chicken dry.\nRub the outside of the chicken with butter to coat.\nSeason the entire chicken with salt and pepper.\nOpen the can of 7UP&reg;, and pour 1/3 cup into a container and set aside.\nAdd the crushed garlic and thyme to the can.\nPlace the chicken onto the can so that the chicken sits up straight, and place into a shallow baking pan.\nPlace the lemon slices at the base of the chicken, and pour the 1/3 cup and additional can of 7UP&reg; into the baking pan.\nBake at 350&deg; F for 1 hour, then turn the oven up to 425&deg; F and bake for an additional 20 minutes, or until a thermometer inserted into the meat in the leg close to the bone registers at 160&deg; F.\nRemove the chicken from the oven, and wrap in foil to rest for 5-10 minutes before serving.'),
	(5,'Cheese On Toast',20,15,5,'Pre-heat the grill to as hot as it goes.\nLightly toast the bread while you slice the cheese. \nPut the cheese on the bread before placing under the grill.\nRemove from the grill and enjoy with some of Mikey&#039;s Special 7up Sauce!'),
	(6,'Pasta',11,11,0,'Add the pasta to a pan of boiling water.\nEnjoy!');

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

LOCK TABLES `recipes_ingredients` WRITE;
/*!40000 ALTER TABLE `recipes_ingredients` DISABLE KEYS */;

INSERT INTO `recipes_ingredients` (`id`, `recipeId`, `ingredientId`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,1,3),
	(4,1,4),
	(5,1,5),
	(6,1,6),
	(7,1,7),
	(8,1,8),
	(9,1,9),
	(10,2,10),
	(11,2,11),
	(12,2,12),
	(13,2,13),
	(14,2,14),
	(15,2,15),
	(16,2,16),
	(17,2,4),
	(18,3,17),
	(19,3,18),
	(20,3,19),
	(21,3,4),
	(22,3,15),
	(23,4,20),
	(24,4,21),
	(25,4,22),
	(26,4,23),
	(27,4,1),
	(28,4,4),
	(29,4,15),
	(30,4,16),
	(31,5,24),
	(32,5,25),
	(33,6,26);

/*!40000 ALTER TABLE `recipes_ingredients` ENABLE KEYS */;
UNLOCK TABLES;


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
	(2,'mikey@mikey.com'),
	(3,'aidan@aidan.com'),
	(4,'ai@dan.com');

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
	(1,4,1),
	(2,4,2),
	(3,4,3),
	(4,4,4),
	(5,4,5),
	(6,4,6);

/*!40000 ALTER TABLE `users_recipes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
