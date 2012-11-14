<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-10-25
 * @package Sites.JusteCommerce.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('Sites/SemStore/JusteCommerceUtils.class.php');
require_once('Sites/SemStore/Templates/JusteCommerce3ColumnTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class ProductBrowserWeblet extends Weblet
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
        
        
        var $siteRootWebpath = '';
        var $eComStoreTemplatesPath = '';
        var $defaultProductTemplate = '_ecomstore/products/productinfo.tpl';
        var $defaultProductTemplateCode = '_ecomstore/products/productinfo.php';
        var $customProductTemplatesPath = 'products/custom/';
        var $customProductTemplatesCodePath = 'products/custom/';
        var $customProductTypeTemplatesPath = 'products/types/';
        var $customProductTypeTemplatesCodePath = 'products/types/';
        var $defaultSubproductTemplate = '_ecomstore/products/subproductinfo.tpl';
        var $defaultSubproductTemplateCode = '_ecomstore/products/subproductinfo.php';
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ProductBrowserWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ProductBrowserWeblet'.$numArgs ),
                        $args );
        }
        
        
        function _ProductBrowserWeblet0 ()
        {
                $this->_initialise();
        }
        
        
        function _ProductBrowserWeblet1 ( &$config )
        {
                $this->_initialise();
                $this->autoconfigure($config);
        }
        
        
        function _ProductBrowserWeblet2 ( &$config, $connection )
        {
                $this->_initialise();
                $this->autoconfigure($config);
                $this->setConnection($connection);
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
                $this->configuration =& $config;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
                
        }
        
        
        function setConnection ( $connection )
        {
                $this->connection = $connection;
        }
        
        
        
        
        
        function getSiteRootWebpath ()
        {
                return $this->siteRootWebpath;
        }
        
        
        function setSiteRootWebpath ( $webpath )
        {
                $this->siteRootWebpath = $webpath;
        }
        
        
        function getEComStoreTemplatesPath ()
        {
                return $this->eComStoreTemplatesPath;
        }
        
        
        function setEComStoreTemplatesPath ( $path )
        {
                $this->eComStoreTemplatesPath = $path;
        }
        
        
        function getDefaultProductTemplate ()
        {
                return $this->defaultProductTemplate;
        }
        
        
        function setDefaultProductTemplate ( $template )
        {
                $this->defaultProductTemplate = $template;
        }
        
        
        function getDefaultProductTemplateCode ()
        {
                return $this->defaultProductTemplateCode;
        }
        
        
        function setDefaultProductTemplateCode ( $code )
        {
                $this->defaultProductTemplateCode = $code;
        }
        
        
        function getCustomProductTemplatesPath ()
        {
                return $this->customProductTemplatesPath;
        }
        
        
        function setCustomProductTemplatesPath ( $path )
        {
                $this->customProductTemplatesPath = $path;
        }
        
        
        function getCustomProductTemplatesCodePath ()
        {
                return $this->customProductTemplatesCodePath;
        }
        
        
        function setCustomProductTemplatesCodePath ( $path )
        {
                $this->customProductTemplatesCodePath = $path;
        }
        
        
        function getCustomProductTypeTemplatesPath ()
        {
                return $this->customProductTypeTemplatesPath;
        }
        
        
        function setCustomProductTypeTemplatesPath ( $path )
        {
                $this->customPoductTypeTemplatesPath = $path;
        }
        
        
        function getCustomProductTypeTemplatesCodePath ()
        {
                return $this->customProductTypeTemplatesCodePath;
        }
        
        
        function setCustomProductTypeTemplatesCodePath ( $path )
        {
                $this->customProductTypeTemplatesCodePath = $path;
        }
        
        
        function getDefaultSubproductTemplate ()
        {
                return $this->defaultSubproductTemplate;
        }
        
        
        function setDefaultSubproductTemplate ( $template )
        {
                $this->defaultSubproductTemplate = $template;
        }
        
        
        function getDefaultSubproductTemplateCode ()
        {
                return $this->defaultSubproductTemplateCode;
        }
        
        
        function setDefaultSubproductTemplateCode ( $code )
        {
                $this->defaultSubproductTemplateCode = $code;
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
        
        
        function _initialise ()
        {
                ;
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfiguration($config);
                
                $this->setSiteRootWebpath(
                        $config->getParameter('site_root_webpath'));

                $this->setEComStoreTemplatesPath(
                        $config->getParameter('ecomstore_template_path'));
                
                $this->setCustomProductTemplatesPath(
                        $config->getParameter('custom_product_templates_path'));
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $this->doGet($httpRequest, $httpResponse);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                $categoryId = $httpRequest->getParameter('categoryid');
                $productId = $httpRequest->getParameter('productid');
                $subproductId = $httpRequest->getParameter('subproductid');
                $qterms = $httpRequest->getParameter('qterms');
                
                if ( $action == 'viewsubproduct' || !is_null($subproductId) )
                {
                        return $this->_viewSubproduct($httpRequest, $httpResponse);
                }
                elseif ( $action == 'viewproduct' || !is_null($productId) )
                {
                        return $this->_viewProduct($httpRequest, $httpResponse);
                }
                elseif ( $action == 'browsecategory' || !is_null($categoryId) )
                {
                        return $this->_browseCategory($httpRequest, $httpResponse);
                }
                elseif ( $action == 'search' || !is_null($qterms) )
                {
                        return $this->_search($httpRequest, $httpResponse);
                }
                
                return $this->_browseCategory($httpRequest, $httpResponse);
        }
        
        
        function _viewSubproduct ( &$httpRequest, &$httpResponse )
        {
                $subproductId = $httpRequest->getParameter('subproductid');
                $categoryId = $httpRequest->getParameter('categoryid');
                $connection =& $this->getConnection();
                $subproduct =& Product::findFirst(
                        array('id' => $connection->escapeString($subproductId)),
                        $connection);
                
                if ( is_null($subproduct) )
                {
                        $template =& $this->_prepareProductNotFoundTemplate();
                        $httpResponse->setContent($template->render());
                        
                        return TRUE;
                }
                
                
                $subproductTemplate = $this->getDefaultSubproductTemplate();
                $subproductTemplateCode = $this->getDefaultSubproductTemplateCode();
                
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        $subproductTemplate
                        );
                /*$template->addStylesheet(
                        $this->getSiteRootWebpath() .
                        '/css/product_details.css');*/
                
                $product =& $subproduct->getParentProduct();
                
                if ( is_null($categoryId) )
                {
                        $categories =& $product->getCategories();
                        $category =& $categories[0];
                        $template->assign('selectedCategory', $category);
                        if ( !is_null($category) )
                        {
                                $template->assign('selectedCategoryId', $category->getId());
                        }
                        $template->assign('currentCategory', $category);
                        
                        $ancestors =& $category->getAncestorCategories();
                        $template->assign('ancestorCategories', $ancestors);
                }
                else
                {
                        ;
                }
                
                require($this->getEComStoreTemplatesPath() .
                        '/' . $subproductTemplateCode);
                
                $httpResponse->setContent($template->render());
                Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));
                
                return TRUE;
        }
        
        
        function _viewProduct ( &$httpRequest, &$httpResponse )
        {
                $productId = $httpRequest->getParameter('productid');
                $categoryId = $httpRequest->getParameter('categoryid');
                $connection =& $this->getConnection();
                $product =& Product::findFirst(
                        array('id' => $connection->escapeString($productId)),
                        $connection);
                
                if ( is_null($product) )
                {
                        $template =& $this->_prepareProductNotFoundTemplate();
                        $httpResponse->setContent($template->render());
                        
                        return TRUE;
                }
                
                
                $productTemplate = $this->getDefaultProductTemplate();
                $productTemplateCode = $this->getDefaultProductTemplateCode();
                
                
                if ( $this->_customProductTemplate($product,
                        $this->getEComStoreTemplatesPath(),
                        $this->getCustomProductTemplatesPath()) != NULL )
                {
                        $productTemplate =
                                $this->_customProductTemplate($product,
                                $this->getEComStoreTemplatesPath(),
                                $this->getCustomProductTemplatesPath()
                                );
                }
                elseif ( $this->_customProductTypeTemplate($product,
                        $this->getEComStoreTemplatesPath(),
                        $this->getCustomProductTypeTemplatesPath()) != NULL )
                {
                        $productTemplate =
                                $this->_customProductTypeTemplate($product,
                                $this->getEComStoreTemplatesPath(),
                                $this->getCustomProductTypesTemplatesPath()
                                );
                }
                
                if ( $this->_customProductTemplateCode($product,
                        $this->getEComStoreTemplatesPath(),
                        $this->getCustomProductTemplatesCodePath()) != NULL )
                {
                        $productTemplateCode =
                                $this->_customProductTemplateCode($product,
                                $this->getEComStoreTemplatesPath(),
                                $this->getCustomProductTemplatesCodePath()
                                );
                }
                elseif ( $this->_customProductTypeTemplateCode($product,
                        $this->getEComStoreTemplatesPath(),
                        $this->getCustomProductTypeTemplatesCodePath()) != NULL )
                {
                        $productTemplateCode =
                                $this->_customProductTypeTemplateCode($product,
                                $this->getEComStoreTemplatesPath(),
                                $this->getCustomProductTypeTemplatesCodePath()
                                );
                }
                
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        $productTemplate
                        );
                /*$template->addStylesheet(
                        $this->getSiteRootWebpath() .
                        '/css/product_details.css');*/
                
                if ( is_null($categoryId) )
                {
                        $categories =& $product->getCategories();
                        $category =& $categories[0];
                        $template->assign('selectedCategory', $category);
                        if ( !is_null($category) )
                        {
                                $template->assign('selectedCategoryId', $category->getId());
                        }
                        $template->assign('currentCategory', $category);
                        
                        $ancestors =& $category->getAncestorCategories();
                        $template->assign('ancestorCategories', $ancestors);
                }
                else
                {
                        ;
                }
                
                require($this->getEComStoreTemplatesPath() .
                        '/' . $productTemplateCode);
                
                $httpResponse->setContent($template->render());
                Debug::debugMsg(DebugLevel::DEBUG(), print_r($_SESSION, TRUE));
                
                return TRUE;
        }
        
        
        function _browseCategory ( &$httpRequest, &$httpResponse )
        {
                $template =& new JusteCommerce3ColumnTemplate(
                        Configuration::getInstance(),
                        $this->getConnection(),
                        '_ecomstore/products/products.tpl');
                /*$template->addStylesheet(
                        $this->getSiteRootWebpath() .
                        '/css/product_browser.css');*/
                
                $categoryId = RequestParameters::getParameter('categoryid');
                $connection =& $this->getConnection();
                $category =& ProductCategory::findFirst(
                        array('id' => $connection->escapeString($categoryId)),
                        $connection);
                
                if ( is_object($category) )
                {
                        $template->assign_by_ref('selectedCategory', $category);
                        $template->assign('selectedCategoryId', $category->getId());
                        $template->assign_by_ref('currentCategory', $category);
                        
                        $ancestors =& $category->getAncestorCategories();
                        $template->assign_by_ref('ancestorCategories', $ancestors);
                }
                else
                {
                        $template->assign('selectedCategory', NULL);
                        $template->assign('selectedCategoryId', NULL);
                        $template->assign('currentCategory', NULL);
                        $template->assign('ancestorCategories', NULL);
                }
                
                
                if ( is_object($category) )
                {
                        $template->assign('subtemplate', '_ecomstore/products/browse_category.tpl');
                        $template->setTitle($template->getTitle()
                                . ' :: ' . $category->getName() );
                        
                        /*
                        $products =& eComStoreUtils::searchForProducts(
                                $this->getConnection(),
                                $category,
                                NULL,
                                'price',
                                'asc',
                                0,
                                10,
                                NULL,
                                TRUE,
                                FALSE,
                                TRUE );
                        */
                        $products =& JusteCommerceUtils::searchForProducts(
                                $this->getConnection(),
                                $category,
                                NULL,
                                'price',
                                'asc',
                                NULL,
                                NULL,
                                NULL,
                                TRUE,
                                FALSE,
                                TRUE );
                        $template->assign('products', $products);
                        
                        $productCount = JusteCommerceUtils::countSearchForProducts(
                                $this->getConnection(),
                                $category,
                                NULL,
                                'price',
                                'asc',
                                NULL,
                                NULL,
                                NULL,
                                TRUE,
                                FALSE,
                                TRUE );
                        $template->assign('productCount', $productCount);
                }
                else
                {
                        $template->assign('subtemplate', '_ecomstore/products/product_browser_home.tpl');
                        
                        $products =& JusteCommerceUtils::randomProductSelection(
                                $this->getConnection(),
                                NULL,
                                NULL,
                                NULL, NULL,
                                0, 10,
                                TRUE, FALSE, TRUE);
                        $template->assign('products', $products);
                                
                }
                
                
                $httpResponse->setContent($template->render());
                
                return TRUE;
        }
        
        
        function _search ( &$httpRequest, &$httpResponse )
        {
                $template =& new JusteCommerce3ColumnTemplate(
                        Configuration::getInstance(),
                        $this->getConnection(),
                        '_ecomstore/search.tpl');
                /*$template->addStylesheet(
                        $this->getSiteRootWebpath() .
                        '/css/product_search.css');*/
                
                $searchStr = RequestParameters::getParameter('qterms');
                $terms = split(' ', $searchStr);
                $products =& JusteCommerceUtils::productSearch(
                        $terms, $category, 0, 10, NULL, NULL,
                        $GLOBALS['dbConnection']);
                $productCount = count($products);
                
                $template->assign('search_terms', $searchStr);
                $template->assign('products', $products);
                $template->assign('productCount', $productCount);
                
                $httpResponse->setContent($template->render());
        }
        
        
        
        
        
        
        function &_prepareProductNotFoundTemplate ()
        {
                $template =& new JusteCommerce3ColumnTemplate(
                        $this->getConfiguration(),
                        $this->getConnection(),
                        '_ecomstore/products/product_not_found.tpl');
                /*$template->addStylesheet(
                        $this->getSiteRootWebpath() .
                        '/css/product_details.css');*/
                
                $template->setTitle($template->getTitle() . ' :: ' .
                        'Product Not Found' );
                
                return $template;
        }
        
        
        
        
        
        
        
        function _customProductTemplate ( &$product, $eComStoreTemplatesPath,
                $productTemplatesPath )
        {
                $templateFile = $productTemplatesPath .
                        $product->getId() . '.tpl';
                        
                if ( file_exists($eComStoreTemplatesPath.'/'.$templateFile) )
                {
                        return $templateFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTypeTemplate ( &$product, $eComStoreTemplatesPath,
                $productTypeTemplatesPath )
        {
                $type =& $product->getType();
                
                $templateFile = $productTemplatesPath .
                        $type->getId() . '.tpl';
                        
                if ( file_exists($eComStoreTemplatesPath.'/'.$templateFile) )
                {
                        return $templateFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTemplateCode ( &$product, $eComStoreTemplatesPath,
                $productTemplatesCodePath )
        {
                $codeFile = $productTemplatesCodePath .
                        $product->getId() . '.tpl';
                        
                if ( file_exists($eComStoreTemplatesPath.'/'.$codeFile) )
                {
                        return $codeFile;
                }
                
                return NULL;
        }
        
        
        function _customProductTypeTemplateCode ( &$product, $eComStoreTemplatesPath,
                $productTypeTemplatesCodePath )
        {
                $type =& $product->getType();
                $codeFile = $productTypeTemplatesCodePath .
                        $type->getId() . '.tpl';
                        
                if ( file_exists($eComStoreTemplatesPath.'/'.$codeFile) )
                {
                        return $codeFile;
                }
                
                return NULL;
        }
}

?>
