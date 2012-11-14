INSERT INTO `configuration` VALUES ('debug_level', '1', 'Debug Level', '', 1, '', 0);

INSERT INTO `configuration` VALUES ('site_root_path', '/home/httpd/vhosts/justecommerce.co.uk_development/httpdocs', 'Site Root Path', '', 1, '', 1);
INSERT INTO `configuration` VALUES ('site_root_webpath', '/justecommerce.co.uk_development/httpdocs', 'Site Root Web Path', '', 1, '', 2);
INSERT INTO `configuration` VALUES ('site_root_ftp_path', '${site_root_path}', 'Site Root FTP Path', '', 1, '', 1);

INSERT INTO `configuration` VALUES ('site_tmp_uploads_path', '${site_root_path}/tmpdir', 'Site Temporary Uploads Path', '', 1, '', 19);
INSERT INTO `configuration` VALUES ('site_tmp_uploads_webpath', '${site_root_webpath}/tmpdir', 'Site Temporary Uploads Web Path', '', 1, '', 20);
INSERT INTO `configuration` VALUES ('site_tmp_uploads_ftp_path', '${site_root_ftp_path}/tmpdir', 'Site Temporary Uploads FTP Path', '', 1, '', 21);

INSERT INTO `configuration` VALUES ('css_webpath', '${site_root_webpath}/css', 'CSS Web Path', '', 1, '', 7);
INSERT INTO `configuration` VALUES ('site_images_webpath', '${site_root_webpath}/images', 'Site Images Web Path', '', 1, '', 8);

INSERT INTO `configuration` VALUES ('ftp_server', 'localhost', 'FTP Server', '', 1, '', 9);
INSERT INTO `configuration` VALUES ('ftp_port', '21', 'FTP Port', '', 1, '', 10);
INSERT INTO `configuration` VALUES ('ftp_username', 'wwwftp', 'FTP Username', '', 1, '', 11);
INSERT INTO `configuration` VALUES ('ftp_password', 'wwwftp20060614', 'FTP Password', '', 1, '', 12);

INSERT INTO `configuration` VALUES ('mail_method', 'smtp', 'Mail Method', '', 1, '', 13);
INSERT INTO `configuration` VALUES ('mailserver_host', 'smtp.semstudio.co.uk', 'Mail Server', '', 1, '', 14);
INSERT INTO `configuration` VALUES ('mailserver_port', '25', 'Mail Server Port', '', 1, '', 15);
INSERT INTO `configuration` VALUES ('mailserver_username', 'no-reply', 'Mail Server Username', '', 1, '', 16);
INSERT INTO `configuration` VALUES ('mailserver_password', 'Etv4w4Vn', 'Mail Server Password', '', 1, '', 17);
INSERT INTO `configuration` VALUES ('mailserver_auth', '1', 'Mail Server Authenticate', '', 1, '', 18);

INSERT INTO `configuration` VALUES ('template_path', '${site_root_path}/lib/smarty/templates', 'Template  Path', '', 1, '', 3);
INSERT INTO `configuration` VALUES ('template_compile_path', '${site_root_path}/lib/smarty/templates_c', 'Template Compile Path', '', 1, '', 4);
INSERT INTO `configuration` VALUES ('template_cache_path', '${site_root_path}/lib/smarty/cache', 'Template Cache Path', '', 1, '', 5);
INSERT INTO `configuration` VALUES ('template_config_path', '${site_root_path}/lib/smarty/configs', 'Template Config Path', '', 1, '', 6);

INSERT INTO `configuration` VALUES ('cms_root_path', '${site_root_path}/cms', 'CMS Root Path', '', 2, '', 1);
INSERT INTO `configuration` VALUES ('cms_root_webpath', '${site_root_webpath}/cms', 'CMS Root Web Path', '', 2, '', 2);
INSERT INTO `configuration` VALUES ('cms_root_ftp_path', '${site_root_ftp_path}/cms', 'CMS Root FTP Path', '', 2, '', 3);

INSERT INTO `configuration` VALUES ('cms_css_webpath', '${cms_root_webpath}/css', 'CMS CSS Web Path', '', 2, '', 8);
INSERT INTO `configuration` VALUES ('cms_images_webpath', '${cms_root_webpath}/images', 'CMS Images Web Path', '', 2, '', 9);

INSERT INTO `configuration` VALUES ('cms_template_path', '${cms_root_path}/lib/smarty/templates', 'CMS Template Path', '', 2, '', 4);
INSERT INTO `configuration` VALUES ('cms_template_compile_path', '${cms_root_path}/lib/smarty/templates_c', 'CMS Template Compile Path', '', 2, '', 5);
INSERT INTO `configuration` VALUES ('cms_template_cache_path', '${cms_root_path}/lib/smarty/cache', 'CMS Template Cache Path', '', 2, '', 6);
INSERT INTO `configuration` VALUES ('cms_template_config_path', '${cms_root_path}/lib/smarty/config', 'CMS Template Config Path', '', 2, '', 7);

