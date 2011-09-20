# ************************************************************
# Rome CMS SQL
# Version 0.01
# TJ Eastmond <tj.eastmond@gmail.com>
# ************************************************************

# Caches

DROP TABLE IF EXISTS `Caches`;

CREATE TABLE `Caches` (
  `cache_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `content` blob,
  `clear` int(1) unsigned NOT NULL DEFAULT '0',
  `minutes` int(3) unsigned NOT NULL DEFAULT '5',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`cache_id`),
  UNIQUE KEY `uname` (`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

# Options

DROP TABLE IF EXISTS `Options`;

CREATE TABLE `Options` (
  `option_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `system` int(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  `themeName` varchar(500) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`option_id`),
  KEY `name` (`name`),
  KEY `u_name` (`name`),
  KEY `system` (`system`),
  KEY `themeName` (`themeName`(255))
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

LOCK TABLES `Options` WRITE;
/*!40000 ALTER TABLE `Options` DISABLE KEYS */;

INSERT INTO `Options` (`option_id`, `system`, `name`, `value`, `themeName`, `created`, `modified`)
VALUES
	(3,1,'site_title','Rome CMS','','2011-08-29 16:31:28','2011-08-29 17:34:43'),
	(4,1,'meta_description','New site setup with Rome CMS','','2011-08-29 16:31:43','2011-08-29 17:34:43'),
	(5,1,'meta_keywords','rome, cms, romecms, rome cms','','2011-08-29 16:32:03','2011-08-29 17:34:43'),
	(6,1,'copyright','Copyright 2011','','2011-08-29 16:34:52','2011-08-29 17:34:43'),
	(7,1,'google_analytics','','','2011-08-29 16:37:31','2011-08-29 17:34:43'),
	(8,1,'theme','default','','2011-08-29 16:37:56',NULL),
	(9,1,'name','ROME CMS','','2011-08-29 16:41:15',NULL),
	(10,1,'email','test@test.com','','2011-08-29 16:41:38',NULL),
	(11,1,'twitter_username','','','2011-08-29 16:41:55',NULL),
	(12,1,'linkedin_url','','','2011-08-29 16:42:21',NULL),
	(13,1,'facebook_url','','','2011-08-29 16:42:45',NULL),
	(14,1,'tumblr_url','','','2011-08-29 16:42:57',NULL),
	(15,1,'instagram_username','tjeastmond','','2011-08-29 16:43:12',NULL),
	(16,1,'tagline','Rome CMS Solution','','2011-08-30 12:24:13',NULL),
	(17,1,'bio','Update your profile **now!**','','2011-08-30 12:24:25',NULL),
	(32,0,'number_of_tweets','5','default','2011-09-19 22:40:22',NULL),
	(33,0,'customcontent','### Custom Content\\r\\n\\r\\nYou can create custom blocks of content that you can call from within your templates. To display this content block, simple add this line to your theme:\\r\\n\\r\\n> Rome::getContent(\\\'customcontent\\\', 1)\\r\\n\\r\\nThe second param (\\\'1\\\'), tells the helper method to apply [Markdown](http://daringfireball.net/projects/markdown/syntax). Pass nothing or the number zero to no apply Markdown.','','2011-09-20 10:49:27','2011-09-20 10:53:51');

/*!40000 ALTER TABLE `Options` ENABLE KEYS */;
UNLOCK TABLES;

# Users

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `admin` int(1) unsigned NOT NULL DEFAULT '0',
  `status` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`user_id`, `username`, `password`, `admin`, `status`)
VALUES
	(9,'admin','21232f297a57a5a743894a0e4a801fc3',1,1);

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
