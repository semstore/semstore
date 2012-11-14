<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-31
 * @package SEM.CMS.Templates
 */

require_once('HTML/WebsiteTemplate.class.php');

require_once('Session/Session.class.php');

class CMSLoginTemplate extends WebsiteTemplate
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*                                                                                                                  
         *
	 * Instance Variables
         *
	 */
        
        
        var $configurator = NULL;
        
        var $title = 'SEM Solutions Content Management System';
        var $headerTemplate = '';
        var $toolbarTemplate = '';
        var $leftTemplate = '';
        var $centerTemplate = '';
        var $rightTemplate = '';
        var $footerTemplate = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CMSLoginTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSLoginTemplate'.$numArgs),
                        $args );
        }
        
        
        function _CMSLoginTemplate0 ()
        {
                $this->_initialize();
        }
        
        
        function _CMSLoginTemplate1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
        }
        
        
        function _CMSLoginTemplate2 ( &$config, $bodyTemplate )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setCentreTemplate($bodyTemplate);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getConfigurator ()
        {
                return $this->configurator;
        }
        
        
        function setConfigurator ( &$config )
        {
                $this->configurator = $config;
        }
        
        
        function getCentreTemplate ()
        {
                return $this->centreTemplate;
        }
        
        
        function setCentreTemplate ( $centreTemplate )
        {
                $this->centreTemplate = $centreTemplate;
        }
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfigurator($config);
                
                $this->setTemplateDir(
                        $config->getParameter('cms_template_path') );
                $this->setCompileDir(
                        $config->getParameter('cms_template_compile_path') );
                $this->setConfigDir(
                        $config->getParameter('cms_template_config_path') );
                $this->setCacheDir(
                        $config->getParameter('cms_template_cache_path') );
                
                
                $this->setTemplateFile('_login/main.tpl');
                $this->setCentreTemplate('_login/login.tpl');
                
                $this->addStylesheet(
                        $config->getParameter('cms_css_webpath') . 
                        '/layout.css');
                
                $this->addStylesheet(
                        $config->getParameter('cms_css_webpath') . 
                        '/login.css');
                
                
                /*
                $this->setSiteRootWebpath(
                        $config->getParameter('site_root_webpath') );
                */
        }
        
        
        function render ()
        {
                $this->assign('configuration', $this->getConfigurator());
                
                $this->assign('title', $this->getTitle());
                $this->assign_by_ref('metatags', $this->_getMetatags());
                $this->assign_by_ref('stylesheets', $this->_getStylesheets());
                $this->assign_by_ref('scripts', $this->_getScripts());
                
                $this->assign('centre', $this->getCentreTemplate());
                
                //$this->assign('siteRootWebpath', $this->getSiteRootWebpath());
                
                return $this->fetch($this->getTemplateFile());
        }
}

?>
