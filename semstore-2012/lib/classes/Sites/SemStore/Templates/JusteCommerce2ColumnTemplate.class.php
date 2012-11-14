<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-08-31
 * @package Sites.JusteCommerce.Templates
 */

require_once('Sites/SemStore/Templates/JusteCommerceTemplate.class.php');

require_once('HTTP/RequestParameters.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');
require_once('Sites/SemStore/eComBasket.class.php');

class JusteCommerce2ColumnTemplate extends JusteCommerceTemplate
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
        
        
        var $leftTemplate = '';
        var $centreTemplate = '';
        var $rightTemplate = '';
        
        
        var $title = 'SEM Store&trade;';
        var $siteRootWebpath = '';
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function JusteCommerce2ColumnTemplate ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_JusteCommerce2ColumnTemplate'.$numArgs),
                        $args );
        }
        
        
        function _JusteCommerce2ColumnTemplate0 ()
        {
                $this->_initialize();
                $this->_prepare();
        }
        
        
        function _JusteCommerce2ColumnTemplate1 ( &$config )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->_prepare();
        }
        
        
        function _JusteCommerce2ColumnTemplate2 ( &$config, &$connection )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
                $this->setCentreTemplate($template);
        }
        
        
        function _JusteCommerce2ColumnTemplate3 ( &$config, &$connection, $template )
        {
                $this->_initialize();
                $this->autoconfigure($config);
                $this->setConnection($connection);
                $this->_prepare();
                $this->setCentreTemplate($template);
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
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
                $this->setSubcontainerTemplate('_default/col3_subcontainer.tpl');
                
                $this->setLeftTemplate('_default/company.tpl');
                $this->setCentreTemplate('_default/centre.tpl');
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
                
                $this->assign('left', $this->getLeftTemplate());
                $this->assign('centre', $this->getCentreTemplate());
                $this->assign('right', $this->getRightTemplate());
                
                
                $this->populateLeftNav();
                $this->assign('basket', eComBasket::getInstance());
                
                return $this->fetch($this->getLayoutTemplate());
        }
        
        
        function populateLeftNav ()
        {
                $productId = NULL;
                $categoryId = NULL;
                
                $productId = RequestParameters::getParameter('productid');
                $categoryId = RequestParameters::getParameter('categoryid');
                
                if ( !is_null($productId) && $productId != '' )
                {
                        $product =& Product::findFirst(
                                array('id' => $productId),
                                $GLOBALS['dbConnection'] );
                        //$this->assign('selectedProduct', $product);
                        
                        $productCategories =& $product->getCategories();
                        $category =& $productCategories[0];
                        //$category = NULL;
                        //$this->assign('selectedCategory', $category);
                        
                        $rootCategories =& ProductCategory::getRootCategories(
                                $GLOBALS['dbConnection'] );
                        $html =& $this->buildNavFromCategories(
                                $rootCategories,
                                $category );
                        $this->assign('leftNav', $html);
                }
                elseif (!is_null($categoryId) && $categoryId != '' )
                {
                        $product = NULL;
                        //$this->assign('selectedProduct', $product);
                        
                        $category =& ProductCategory::findFirst(
                                array('id' => $categoryId),
                                $GLOBALS['dbConnection'] );
                        //$this->assign('selectedCategory', $category);
                        
                        $rootCategories =& ProductCategory::getRootCategories(
                                $GLOBALS['dbConnection'] );
                        $html =& $this->buildNavFromCategories(
                                $rootCategories,
                                $category );
                        $this->assign('leftNav', $html);
                }
                else
                {
                        $product = NULL;
                        //$this->assign('selectedProduct', $product);
                        
                        $category = NULL;
                        //$this->assign('selectedCategory', $category);
                        
                        $rootCategories =& ProductCategory::getRootCategories(
                                $GLOBALS['dbConnection'] );
                        $html =& $this->buildNavFromCategories(
                                $rootCategories,
                                $category );
                        $this->assign('leftNav', $html);
                }
        }
        
        
        function buildNavFromCategories ( &$categories, &$selectedCategory )
        {
                $html = '<ul class="navigation_list">';
                
                foreach ( $categories as $category )
                {
                        if ( $category->hasDescendant($selectedCategory) )
                        {
                                //print "1";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        '<b>'.$category->getName() . '</b></a></li>';
                                $subcategories =& $category->getChildCategories();
                                
                                if ( count($subcategories) > 0 )
                                {
                                        $html .= $this->buildSubnavFromCategories($subcategories, $selectedCategory);
                                }
                        }
                        elseif ( is_object($selectedCategory) && $category->getId() == $selectedCategory->getId() )
                        {
                                //print "2";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        '<b>'.$category->getName() . '</b></a></li>';
                                $subcategories =& $category->getChildCategories();
                                
                                if ( count($subcategories) > 0 )
                                {
                                        $html .= $this->buildSubnavFromCategories($subcategories, $selectedCategory);
                                }
                        }
                        else
                        {
                                //print "3";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        $category->getName() . '</a></li>';
                        }
                }
                
                $html .= '</ul>';
                
                return $html;
        }
        
        
        function buildSubnavFromCategories ( &$categories, &$selectedCategory )
        {
                $html = '<ul class="subnavigation_list">';
                
                foreach ( $categories as $category )
                {
                        if ( $category->hasDescendant($selectedCategory) )
                        {
                                //print "1a";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        '<b>'.$category->getName() . '</b></a></li>';
                                $subcategories =& $category->getChildCategories();
                                if ( count($subcategories) > 0 )
                                {
                                        $html .= $this->buildSubnavFromCategories($subcategories, $selectedCategory);
                                }
                        }
                        elseif ( is_object($selectedCategory) && ($category->getId() == $selectedCategory->getId()) )
                        {
                                //print "2a";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        '<b>'.$category->getName() . '</b></a></li>';
                                $subcategories =& $category->getChildCategories();
                                
                                if ( count($subcategories) > 0 )
                                {
                                        $html .= $this->buildSubnavFromCategories($subcategories, $selectedCategory);
                                }
                        }
                        else
                        {
                                //print "3a";
                                $html .= '<li class="navigation_list_item">' .
                                        '<a href="products.php?categoryid='. $category->getId() .'">' .
                                        $category->getName() . '</a></li>';
                        }
                }
                
                $html .= '</ul>';
                
                return $html;
        }
}

?>
