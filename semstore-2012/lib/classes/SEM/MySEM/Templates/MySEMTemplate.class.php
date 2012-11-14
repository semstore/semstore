<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2007-02-24
 * @package SEM.MySEM.Templates
 */

require_once('HTML/WebsiteTemplate.class.php');

require_once('Session/Session.class.php');

class MySEMTemplate extends WebsiteTemplate
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
        
        
        var $configuration = NULL;
        var $connection = NULL;
        
        var $title = 'MySEM Portal by SEM Solutions Ltd';
        var $headerTemplate = '';
        var $subcontainerTemplate = '';
        var $leftTemplate = '';
        var $centerTemplate = '';
        var $rightTemplate = '';
        var $footerTemplate = '';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function MySEMTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_MySEMTemplate'.$numArgs),
                        $args );
        }
        
        
        function _MySEMTemplate0 ()
        {
                $this->_initialize();
        }
        
        
        function _MySEMTemplate1 ( $content )
        {
                $this->_initialize();
                $this->setCentreTemplate($content);
                $this->prepare();
        }
        
        
        function _MySEMTemplate3 ( &$configuration, &$dbConnection, $content )
        {
                $this->_initialize();
                $this->autoconfigure($configuration);
                $this->setConnection($dbConnection);
                $this->setCentreTemplate($content);
                $this->prepare();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function &getConfiguration ()
        {
                return $this->configuration;
        }
        
        
        function setConfiguration ( &$config )
        {
                $this->configuration = $config;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$config )
        {
                $this->connection = $config;
        }
        
        
        function getHeaderTemplate ()
        {
                return $this->headerTemplate;
        }
        
        
        function setHeaderTemplate ( $headerTemplate )
        {
                $this->headerTemplate = $headerTemplate;
        }
        
        
        function getSubcontainerTemplate ()
        {
                return $this->subcontainerTemplate;
        }
        
        
        function setSubcontainerTemplate ( $subcontainerTemplate )
        {
                $this->subcontainerTemplate = $subcontainerTemplate;
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
                $this->setConfiguration($config);
                
                $this->setTemplateDir(
                        $config->getParameter('template_path') );
                $this->setCompileDir(
                        $config->getParameter('template_compile_path') );
                $this->setConfigDir(
                        $config->getParameter('template_config_path') );
                $this->setCacheDir(
                        $config->getParameter('template_cache_path') );
                
                
                $this->setTemplateFile('_default/main.tpl');
                $this->setHeaderTemplate('_default/header.tpl');
                $this->setFooterTemplate('_default/footer.tpl');
                $this->setSubcontainerTemplate('_default/2col_subcontainer.tpl');
                $this->setLeftTemplate('_default/left.tpl');
                $this->setCentreTemplate('_default/centre.tpl');
                $this->setRightTemplate('_default/right.tpl');
                
                $this->addStylesheet(
                        $config->getParameter('css_webpath') . 
                        '/mysem.css');
                /*
                $this->addScript(
                        $config->getParameter('scripts_webpath') . 
                        '/scripts/context_help.js');
                */
        }
        
        
        function prepare ()
        {
                ;
        }
        
        
        function render ()
        {
                //print 'CMS Template Path: ' . $this->getTemplateDir();
                
                $this->assign('configuration', $this->getConfiguration());
                
                $this->assign('title', $this->getTitle());
                $this->assign_by_ref('metatags', $this->_getMetatags());
                $this->assign_by_ref('stylesheets', $this->_getStylesheets());
                $this->assign_by_ref('scripts', $this->_getScripts());
                
                $this->assign('header', $this->getHeaderTemplate());
                $this->assign('footer', $this->getFooterTemplate());
                $this->assign('subcontainer', $this->getSubcontainerTemplate());
                $this->assign('left', $this->getLeftTemplate());
                $this->assign('centre', $this->getCentreTemplate());
                $this->assign('right', $this->getRightTemplate());
                
                return $this->fetch($this->getTemplateFile());
        }
}

?>
