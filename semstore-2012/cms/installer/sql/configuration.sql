CREATE TABLE `configuration` (
  `parameter_name` varchar(255) NOT NULL default '',
  `parameter_value` varchar(255) NOT NULL default '',
  `parameter_label` varchar(255) NOT NULL default '',
  `description` tinytext NOT NULL,
  `group_id` int(10) unsigned default NULL,
  `type` varchar(255) NOT NULL default '',
  `idx` tinyint(3) unsigned NOT NULL default '0',
  UNIQUE KEY `parameter_name` (`parameter_name`)
)
