CREATE TABLE `cms_user_role_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned default NULL,
  `role_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
)
