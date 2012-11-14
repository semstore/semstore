CREATE TABLE `cms_capability_group_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `capability_id` int(10) unsigned default NULL,
  `group_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
)
