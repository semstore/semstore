<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-05-18
 * @package Sites.JusteCommerce.Templates
 */

require_once('Sites/SemStore/Templates/JusteCommerceTemplate.class.php');

require_once('HTTP/RequestParameters.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class JusteCommerceCheckoutTemplate extends JusteCommerceTemplate
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
        
        var $title = 'Just eCommerce';
        var $siteRootWebpath = '';
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function JusteCommerceCheckoutTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_JusteCommerceCheckoutTemplate'.$numArgs),
                        $args );
        }
        
        
        function _JusteCommerceCheckoutTemplate0 ()
        {
                $this->_initialize();
                $this->_prepare();
        }
        
        
        function _JusteCommerceCheckoutTemplate1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->_prepare();
        }
        
        
        function _JusteCommerceCheckoutTemplate2 ( &$config, &$connection )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
        }
        
        
        function _JusteCommerceCheckoutTemplate3 ( &$config, &$connection, $template )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
                $this->setTemplate($template);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
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
                $this->setLayoutTemplate('_default/main.tpl');
                
                $this->setHeaderTemplate('_default/header.tpl');
                $this->setFooterTemplate('_default/footer.tpl');
                $this->setToolbarTemplate('_default/toolbar.tpl');
                $this->setSubcontainerTemplate('_ecomstore/checkout/checkout.tpl');
        }
        
        
        function _prepare ()
        {
                $this->addStylesheet(
                        $this->getSiteRootWebpath() . '/css/layout.css');
                /*$this->addStylesheet(
                        $this->getSiteRootWebpath() . '/css/basket.css');
                $this->addStylesheet(
                        $this->getSiteRootWebpath() . '/css/checkout.css');*/
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
                
                return $this->fetch($this->getTemplate());
        }
}

?>
