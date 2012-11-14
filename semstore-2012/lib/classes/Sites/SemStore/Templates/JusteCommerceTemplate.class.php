<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-31
 * @package Sites.JusteCommerce.Templates
 */

require_once('Sites/SemStore/Templates/JusteCommerceAbstractTemplate.class.php');

require_once('HTTP/RequestParameters.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('Sites/SemStore/eComBasket.class.php');

class JusteCommerceTemplate extends JusteCommerceAbstractTemplate
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
        
        
        var $headerTemplate = '';
        var $footerTemplate = '';
        var $toolbarTemplate = '';
        var $subcontainerTemplate = '';
        
        
        var $title = 'Just eCommerce';
        var $siteRootWebpath = '';
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function JusteCommerceTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_JusteCommerceTemplate'.$numArgs),
                        $args );
        }
        
        
        function _JusteCommerceTemplate0 ()
        {
                $this->_initialize();
                $this->_prepare();
        }
        
        
        function _JusteCommerceTemplate1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->_prepare();
        }
        
        
        function _JusteCommerceTemplate2 ( &$config, &$connection )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
                $this->setSubcontainerTemplate($template);
        }
        
        
        function _JusteCommerceTemplate3 ( &$config, &$connection, $template )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
                $this->setSubcontainerTemplate($template);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getLayoutTemplate ()
        {
                return $this->getTemplateFile();
        }
        
        
        function setLayoutTemplate ( $template )
        {
                $this->setTemplateFile($template);
        }
        
        
        function getHeaderTemplate ()
        {
                return $this->headerTemplate;
        }
        
        
        function setHeaderTemplate ( $headerTemplate )
        {
                $this->headerTemplate = $headerTemplate;
        }
        
        
        function getFooterTemplate ()
        {
                return $this->footerTemplate;
        }
        
        
        function setFooterTemplate ( $footerTemplate )
        {
                $this->footerTemplate = $footerTemplate;
        }
        
        
        function getToolbarTemplate ()
        {
                return $this->toolbarTemplate;
        }
        
        
        function setToolbarTemplate ( $toolbarTemplate )
        {
                $this->toolbarTemplate = $toolbarTemplate;
        }
        
        
        function getSubcontainerTemplate ()
        {
                return $this->subcontainerTemplate;
        }
        
        
        function setSubcontainerTemplate ( $subcontainerTemplate )
        {
                $this->subcontainerTemplate = $subcontainerTemplate;
        }
        
        
        
        
        
        function getSiteRootWebpath ()
        {
                return $this->siteRootWebpath;
        }
        
        function setSiteRootWebpath ( $siteRootWebpath )
        {
                $this->siteRootWebpath = $siteRootWebpath;
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
                
                $this->setLayoutTemplate('_default/main.tpl');
                
                $this->setHeaderTemplate('_default/header.tpl');
                $this->setFooterTemplate('_default/footer.tpl');
                $this->setToolbarTemplate('_default/toolbar.tpl');
                $this->setSubcontainerTemplate('_default/subcontainer.tpl');
        }
        
        
        function _prepare ()
        {
                $this->addStylesheet(
                        $this->getSiteRootWebpath() . '/css/layout.css');
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
                
                $this->setTemplateDir($config->getParameter('ecomstore_template_path'));
                $this->setCompileDir($config->getParameter('ecomstore_template_compile_path'));
                $this->setConfigDir($config->getParameter('ecomstore_template_config_path'));
                $this->setCacheDir($config->getParameter('ecomstore_template_cache_path'));
                
                $this->setTitle(
                        $config->getParameter('store_name'));
                
                $this->setSiteRootWebpath(
                        $config->getParameter('site_root_webpath'));
        }
        
        
        function render ()
        {
                $this->assign('configuration', $this->getConfiguration());
                
                $this->assign('siteRootWebpath', $this->getSiteRootWebpath());
                
                $this->assign('title', $this->getTitle());
                $this->assign_by_ref('metatags', $this->_getMetatags());
                $this->assign_by_ref('stylesheets', $this->_getStylesheets());
                $this->assign_by_ref('scripts', $this->_getScripts());
                
                $this->assign('header', $this->getHeaderTemplate());
                $this->assign('footer', $this->getFooterTemplate());
                $this->assign('toolbar', $this->getToolbarTemplate());
                $this->assign('subcontainer', $this->getSubcontainerTemplate());
                
                $this->assign('basket', eComBasket::getInstance());
                
                return $this->fetch($this->getLayoutTemplate());
        }
}

?>
