CREATE TABLE `cms_capability_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `label` varchar(255) NOT NULL default '',
  `description` tinytext NOT NULL,
  `idx` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
)
