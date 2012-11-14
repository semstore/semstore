<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-31
 * @package SEM.CMS.Templates
 */

require_once('HTML/WebsiteTemplate.class.php');

require_once('Session/Session.class.php');

class CMSTemplate extends WebsiteTemplate
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
        //var $siteRootWebpath = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function CMSTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_CMSTemplate'.$numArgs),
                        $args );
        }
        
        
        function _CMSTemplate0 ()
        {
                $this->_initialize();
        }
        
        
        function _CMSTemplate1 ( $bodyTemplate )
        {
                $this->_initialize();
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
        
        
        function getHeaderTemplate ()
        {
                return $this->headerTemplate;
        }
        
        
        function setHeaderTemplate ( $headerTemplate )
        {
                $this->headerTemplate = $headerTemplate;
        }
        
        
        function getToolbarTemplate ()
        {
                return $this->toolbarTemplate;
        }
        
        
        function setToolbarTemplate ( $toolbarTemplate )
        {
                $this->toolbarTemplate = $toolbarTemplate;
        }
        
        
        function getLeftTemplate ()
        {
                return $this->leftTemplate;
        }
        
        
        function setLeftTemplate ( $leftTemplate )
        {
                $this->leftTemplate = $leftTemplate;
        }
        
        
        function getCentreTemplate ()
        {
                return $this->centreTemplate;
        }
        
        
        function setCentreTemplate ( $centreTemplate )
        {
                $this->centreTemplate = $centreTemplate;
        }
        
        
        function getRightTemplate ()
        {
                return $this->rightTemplate;
        }
        
        
        function setRightTemplate ( $rightTemplate )
        {
                $this->rightTemplate = $rightTemplate;
        }
        
        
        function getFooterTemplate ()
        {
                return $this->footerTemplate;
        }
        
        
        function setFooterTemplate ( $footerTemplate )
        {
                $this->footerTemplate = $footerTemplate;
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
                
                
                $this->setTemplateFile('_default/main.tpl');
                $this->setHeaderTemplate('_default/header.tpl');
                $this->setFooterTemplate('_default/footer.tpl');
                $this->setToolbarTemplate('_default/toolbar.tpl');
                $this->setLeftTemplate('_default/left.tpl');
                $this->setRightTemplate('_default/right.tpl');
                
                /*
                $this->addStylesheet(
                        $config->getParameter('cms_css_webpath') . 
                        '/layout.css');
                */
                $this->addStylesheet(
                        $config->getParameter('cms_css_webpath') . 
                        '/semcms.css');
                /*
                $this->addScript(
                        $config->getParameter('cms_root_webpath') . 
                        '/scripts/context_help.js');
                */
        }
        
        
        function render ()
        {
                //print 'CMS Template Path: ' . $this->getTemplateDir();
                
                $this->assign('configuration', $this->getConfigurator());
                
                $this->assign('title', $this->getTitle());
                $this->assign_by_ref('metatags', $this->_getMetatags());
                $this->assign_by_ref('stylesheets', $this->_getStylesheets());
                $this->assign_by_ref('scripts', $this->_getScripts());
                
                $this->assign('header', $this->getHeaderTemplate());
                $this->assign('toolbar', $this->getToolbarTemplate());
                $this->assign('left', $this->getLeftTemplate());
                $this->assign('centre', $this->getCentreTemplate());
                $this->assign('right', $this->getRightTemplate());
                $this->assign('footer', $this->getFooterTemplate());
                
                return $this->fetch($this->getTemplateFile());
        }
}

?>
