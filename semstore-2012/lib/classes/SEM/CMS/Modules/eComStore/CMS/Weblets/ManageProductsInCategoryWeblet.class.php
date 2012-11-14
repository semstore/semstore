<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.CMS.Modules.eComStore.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/CMSUtils.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/ManageProductsInCategoryWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class ManageProductsInCategoryWeblet extends Weblet
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
        var $connection = NULL;
        
        
        var $stateContainer = NULL;
        var $categoryId = NULL;
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ManageProductsInCategoryWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ManageProductsInCategoryWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _ManageProductsInCategoryWeblet0 ()
        {
                $this->_initialize();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        function getConfigurator ()
        {
                return $this->configurator;
        }
        
        
        function setConfigurator ( $configurator )
        {
                $this->configurator = $configurator;
        }
        
        
        function &getConnection ()
        {
                return $this->connection;
        }
        
        
        function setConnection ( &$connection )
        {
                $this->connection =& $connection;
        }
        
        
        
        
        
        function getCategoryId ()
        {
                return $this->stateContainer->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->stateContainer->categoryId = $id;
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
                $this->stateContainer =& new ManageProductsInCategoryWebletStateContainer();
        }
        
        
        function autoconfigure ( &$config )
        {
                $this->setConfigurator($config);
        }
        
        
        function _saveWebletState ()
        {
                Session::putRef('mpicWebletStateContainer',
                        $this->stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $this->stateContainer =& Session::getRef('mpicWebletStateContainer');
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('mpicWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                
                if ( $view == 'capture_details' )
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( $action == 'capture_details_submit' )
                {
                        return $this->_capture_details_submit(
                                $httpRequest, $httpResponse );
                }
                
                $this->doGet( $httpRequest, $httpResponse );
        }
        
        
        
        
        function _capture_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $view = $httpRequest->getParameter('view');
                if ( $view == 'capture_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/catalogue_management/manage_products_in_category/manage_products_in_category.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/catalogue_management/manage_products_in_category/manage_products_in_category_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                
                
                /*
                 * Prepare Products In Category Pane
                 */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                $template->assign('action', 'capture_details_submit');
                
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                $template->assign('category', $category);
                
                $template->assign('productsInCategory',
                        $category->getProducts());
                
                
                
                /*
                 * Prepare Product Search Pane
                 */
                $searchTerms = '';
                $numResults = 20;
                
                $searchCriteria = array(
                        'st' => (!is_null($_REQUEST['st']) && $_REQUEST['st'] != '' ? $_REQUEST['st'] : 0),
                        'mh' => (!is_null($_REQUEST['mh']) && $_REQUEST['mh'] != '' ? $_REQUEST['mh'] : 10),
                        );
                        
                if ( !is_null($httpRequest->getParameter('productName')) )
                {
                     $searchCriteria['productName'] = $httpRequest->getParameter('productName');
                      
                     $template->assign('searchValue', $httpRequest->getParameter('productName'));
                }
                        
                $searchResults = array();
                $pagerArray = array();
                $options = array();
                $this->paginatedSearch($searchCriteria, $searchResults, $pagerArray, $options);
                $template->assign('products', $searchResults);
                $template->assign('searchPager', $pagerArray);
                
                
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                
                // Sort product ids array
                $productIds = $_POST['productsInCategory'];
                if ( count($productId) > 0 )
                {
                        sort($productIds);
                }
                /*
                print 'productsInCategory = ' .
                        print_r($productIds, TRUE);
                */
                
                
                // Sort product objects array;
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection());
                $products =& $category->getProducts();
                if ( count($products) > 0 )
                {
                        usort($products,
                                create_function('$a, $b',
                                'return $a->getId() < $b->getId() ? -1 : ' .
                                '( $a->getId() > $b->getId() ? 1 : 0 );')
                                );
                }
                
                $i1 = 0;
                $i2 = 0;
                while ( $i1 < count($products) &&
                        $i2 < count($productIds) )
                {
                        if ( $products[$i1]->getId() < $productIds[$i2] )
                        {
                                // Remove product from category
                                $category->removeProduct($products[$i1]);
                                /*
                                print 'Removing product ' .
                                        $products[$i1]->getId();
                                */
                                $i1++;
                        }
                        elseif ( $products[$i1]->getId() > $productIds[$i2] )
                        {
                                // Insert product into category
                                $newProduct =& Product::findFirst(
                                        array('id' => $productIds[$i2]),
                                        $this->getConnection() );
                                $category->addProduct($newProduct);
                                /*
                                print 'Inserting product ' .
                                        $productIds[$i2];
                                */
                                $i2++;
                        }
                        else
                        {
                                // Product is already in category so no change
                                $i1++;
                                $i2++;
                        }
                        
                }
                
                if ( $i1 < count($products) )
                {
                        // Remove remaining products from category
                        for ( ; $i1 < count($products); $i1++ )
                        {
                                $category->removeProduct($products[$i1]);
                                /*
                                print 'Removing product ' .
                                        $products[$i1]->getId();
                                */
                        }
                }
                elseif ( $i2 < count($productIds) )
                {
                        // Insert remaining products into category
                        for ( ; $i2 < count($productIds); $i2++ )
                        {
                                $newProduct =& Product::findFirst(
                                        array('id' => $productIds[$i2]),
                                        $this->getConnection() );
                                $category->addProduct($newProduct);
                                /*
                                print 'Inserting product ' .
                                        $productIds[$i2];
                                */
                        }
                }
                
                
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $category->getId());
                
                return TRUE;
        }
        
        
        function paginatedSearch (
                $searchCriteria, &$results, &$pagerArray, $options )
        {
                $rcount = $this->search($searchCriteria, $results);
                return CMSUtils::pager($pagerArray,
                        array(
                                'st' => $searchCriteria['st'],
                                'mh' => $searchCriteria['mh'],
                                'rcount' => $rcount,
                                'productName' => $searchCriteria['productName']
                                ),
                        $options);
        }
        
        
        function search ( &$searchCriteria, &$results )
        {
                // Execute search
                
                $dbConnection =& $this->getConnection();
                
                $sql = '';
                $sql = 'SELECT COUNT(id) FROM product' .
                        ' WHERE parent_id IS NULL';
                
                if ( $searchCriteria['productName'] != '' && !is_null($searchCriteria['productName']) )
                {
                       $sql.= ' AND name LIKE "'.$searchCriteria['productName'].'%"';
                }
                
                $sql.=' ORDER By name';
                
                $res = NULL;
                $res =& $dbConnection->select($sql);
                $res->first();
                $row =& $res->getRowArray();
                $rcount = $row[0];
                
                
                //
                
                $sql = '';
                $sql = 'WHERE parent_id IS NULL';
                

                if ( $searchCriteria['productName'] != '' && !is_null($searchCriteria['productName']) )
                {
                       $sql.= ' AND name LIKE "'.$searchCriteria['productName'].'%"';
                }
                
                $sql .=' ORDER BY name';
                if ( $searchCriteria['st'] > 0 && $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['st'] . ', '.
                                $searchCriteria['mh'];
                }
                elseif ( $searchCriteria['mh'] > 0 )
                {
                        $sql .= ' LIMIT ' . $searchCriteria['mh'];
                }
                
                $results = Product::find($sql, $this->getConnection());
                
                //
                
                return $rcount;
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'eComStore',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/'
                                ),
                        array(
                                'name' => 'Products &amp Categories',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                ),
                        array(
                                'name' => 'Categories',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/catalogue_management/'
                                )
                        );
                
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                $ancestorCategories =& $category->getAncestorCategories();
                foreach ( array_keys($ancestorCategories) as
                        $ancestorCategoriesKey )
                {
                        $ancestorCategory =&
                                $ancestorCategories[$ancestorCategoriesKey];
                        $breadcrumb[] =
                                array(
                                        'name' => $ancestorCategory->getName(),
                                        'url' => Configuration::getParameter('cms_root_webpath') .
                                                '/ecomstore/product_catalogue/catalogue_management/' .
                                                'manage_product_category.php?categoryid=' .
                                                $ancestorCategory->getId()
                                );
                }
                
                $breadcrumb[] =
                        array(
                                'name' => $category->getName(),
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/catalogue_management/' .
                                        'manage_product_category.php?categoryid=' .
                                        $category->getId()
                        );
                
                
                return $breadcrumb;
        }
}


?>
