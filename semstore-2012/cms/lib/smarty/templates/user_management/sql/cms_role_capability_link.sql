CREATE TABLE `cms_role_capability_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `role_id` int(10) unsigned default NULL,
  `capability_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
)
