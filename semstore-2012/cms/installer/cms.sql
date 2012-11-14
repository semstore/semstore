# Dump of table configuration_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS 'configuration_group';

CREATE TABLE 'configuration_group' (
  'id' int(10) unsigned NOT NULL auto_increment,
  'name' varchar(100) NOT NULL default '',
  PRIMARY KEY  ('id')
);

INSERT INTO 'configuration_group' ('id','name') VALUES ('2','SEM Content Management System');
INSERT INTO 'configuration_group' ('id','name') VALUES ('3','SEM eComStore');
INSERT INTO 'configuration_group' ('id','name') VALUES ('4','SEM ePublisher');
INSERT INTO 'configuration_group' ('id','name') VALUES ('1','Just eCommerce');



# Dump of table configuration
# ------------------------------------------------------------

DROP TABLE IF EXISTS 'configuration';

CREATE TABLE 'configuration' (
  'parameter_name' varchar(255) NOT NULL default '',
  'parameter_value' varchar(255) NOT NULL default '',
  'parameter_label' varchar(255) NOT NULL default '',
  'description' tinytext NOT NULL,
  'group_id' int(10) unsigned default NULL,
  UNIQUE KEY 'parameter_name' ('parameter_name')
);

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('debug_level','1','','','1');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('site_root_path','/home/httpd/vhosts/justecommerce.co.uk/httpdocs','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('site_root_webpath','/justecommerce.co.uk/httpdocs','','','1');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('template_path','${site_root_path}/lib/smarty/templates','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('template_compile_path','${site_root_path}/lib/smarty/templates_c','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('template_cache_path','${site_root_path}/lib/smarty/cache','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('template_config_path','${site_root_path}/lib/smarty/configs','','','1');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('css_webpath','${site_root_webpath}/css','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('site_images_webpath','${site_root_webpath}/images','','','1');



INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_root_path','${site_root_path}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_root_webpath','${site_root_webpath}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_template_path','${template_path}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_template_compile_path','${template_compile_path}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_template_cache_path','${template_cache_path}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_template_config_path','${template_config_path}/cms','','','2');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_css_webpath','${css_webpath}/cms','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_images_webpath','${site_images_webpath}/cms','','','2');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_breadcrumb_template','${cms_template_path}/breadcrumb.tpl','','','2');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('cms_show_breadcrumb','1','','','2');



INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_server','localhost','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_port','21','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_username','admin','','','1');
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_password','password','','','1');

INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_webapp_upload_tmp_dir','${site_root_path}/tmp_uploads','','',NULL);
INSERT INTO 'configuration' ('parameter_name','parameter_value','parameter_label','description','group_id') VALUES ('ftp_webapp_product_images_dir','${site_root_path}/images/products','','',NULL);


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS 'user';

CREATE TABLE 'user' (
  'id' int(11) default NULL
);

