<?php

/**
 *  @author Adam Dowling <adam@semsolutions.co.uk>
 *  @version 1.0
 *  @date 2005-08-31
 */

require_once('Smarty/Smarty.class.php');

class WebsiteTemplate extends Smarty
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        function DEFAULT_TEMPLATE_DIR_NAME ()
        {
                return 'templates';
        }
        
        
        function DEFAULT_TEMPLATE_DIR ()
        {
                return './lib/smarty/templates';
        }
        
        
        function DEFAULT_COMPILE_DIR_NAME ()
        {
                return 'templates_c';
        }
        
        
        function DEFAULT_COMPILE_DIR ()
        {
                return './lib/smarty/templates_c';
        }
        
        
        function DEFAULT_CONFIG_DIR_NAME ()
        {
                return 'config';
        }
        
        
        function DEFAULT_CONFIG_DIR ()
        {
                return './lib/smarty/config';
        }
        
        
        function DEFAULT_CACHE_DIR_NAME ()
        {
                return 'cache';
        }
        
        
        function DEFAULT_CACHE_DIR ()
        {
                return './lib/smarty/cache';
        }
        
        
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
        
        
        var $templateDir = '';
        var $compileDir = '';
        var $configDir = '';
        var $cacheDir = '';
        
        var $title = '';
        var $httpEquivs = array();
        var $metatags = array();
        var $stylesheets = array();
        var $scripts = array();
        var $templateFile = 'main.tpl';
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function WebsiteTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_WebsiteTemplate'.$numArgs),
                        $args );
        }
        
        
        function _WebsiteTemplate0 ()
        {
                $this->_initialize();
        }
        
        
        function _WebsiteTemplate1 ( $template )
        {
                $this->_initialize();
                //$this->assign('centre', $bodyTemplate);
                $this->setTemplateFile($template);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getTemplateDir ()
        {
                return $this->templateDir;
        }
        
        
        function setTemplateDir ( $templateDir )
        {
                $this->templateDir = $templateDir;
                $this->template_dir = $templateDir;
        }
        
        
        function getCompileDir ()
        {
                return $this->compileDir;
        }
        
        
        function setCompileDir ( $compileDir )
        {
                $this->compileDir = $compileDir;
                $this->compile_dir = $compileDir;
        }
        
        
        function getConfigDir ()
        {
                return $this->configDir;
        }
        
        
        function setConfigDir ( $configDir )
        {
                $this->configDir = $configDir;
                $this->config_dir = $configDir;
        }
        
        
        function getCacheDir ()
        {
                return $this->cacheDir;
        }
        
        function setCacheDir ( $cacheDir )
        {
                $this->cacheDir = $cacheDir;
                $this->cache_dir = $cacheDir;
        }
        
        
        
        function getTemplateFile ()
        {
                return $this->templateFile;
        }
        
        
        function setTemplateFile ( $template )
        {
                $this->templateFile = $template;
        }
        
        
        function getTitle ()
        {
                return $this->title;
        }
        
        
        function setTitle ( $title )
        {
                $this->title = $title;
        }
        
        
        function &_getHttpEquivs ()
        {
                return $this->httpEquiv;
        }
        
        
        function setHtppEquivs ( $httpEquivs )
        {
                $this->httpEquivs = $httpEquivs;
        }
        
        
        function &_getMetatags ()
        {
                return $this->metatags;
        }
        
        
        function setMetatags ( $metatags )
        {
                $this->metatags = $metatags;
        }
        
        
        function &_getStylesheets ()
        {
                return $this->stylesheets;
        }
        
        
        function setStylesheets ( $stylesheets )
        {
                $this->stylesheets = $stylesheets;
        }
        
        
        function &_getScripts ()
        {
                return $this->scripts;
        }
        
        
        function setScripts ( $scripts )
        {
                $this->scripts = $scripts;
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
                $this->setTemplateDir($this->DEFAULT_TEMPLATE_DIR());
                $this->setCompileDir($this->DEFAULT_COMPILE_DIR());
                $this->setConfigDir($this->DEFAULT_CONFIG_DIR());
                $this->setCacheDir($this->DEFAULT_CACHE_DIR());
        }
        
        
        function addHttpEquiv ( $name, $content )
        {
                $tags =& $this->_getHttpEquivs();
                $tags[] = array('name' => $name,
                        'content' => $content);
                $this->setHtppEquivs($tags);
        }
        
        
        function addMetatag ( $name, $content )
        {
                $tags =& $this->_getMetatags();
                $tags[] = array('name' => $name,
                        'content' => $content);
                $this->setMetatags($tags);
        }
        
        
        function addStylesheet ( $stylesheet )
        {
                array_push($this->_getStylesheets(), $stylesheet);
        }
        
        
        function addScript ( $script )
        {
                array_push($this->_getScripts(), $script);
        }
        
        
        function render ()
        {
                $this->assign('title', $this->getTitle());
                $this->assign_by_ref('metatags', $this->_getMetatags());
                $this->assign_by_ref('stylesheets', $this->_getStylesheets());
                $this->assign_by_ref('scripts', $this->_getScripts());
                
                return $this->fetch($this->getTemplateFile());
        }
}

?>
