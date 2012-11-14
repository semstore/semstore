CREATE TABLE `cms_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(30) default NULL,
  `surname` varchar(30) default NULL,
  `email` varchar(100) default NULL,
  `username` varchar(20) default NULL,
  `password` varchar(60) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
)
