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
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/AddProductToCategoryWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class AddProductToCategoryWeblet extends Weblet
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
        
        /* Configuration Variables :: Start */
        
        /* Configuration Variables :: Stop */
        
        
        /* Weblet State Variables :: Start */
        var $view = '';
        var $formErrors = NULL;
        var $categoryId = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddProductToCategoryWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_AddProductToCategoryWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _AddProductToCategoryWeblet0 ()
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
        
        
        function getView ()
        {
                return $this->view;
        }
        
        
        function setView ( $view )
        {
                $this->view = $view;
        }
        
        
        function getFormValidationErrors ()
        {
                return $this->formErrors;
        }
        
        
        function setFormValidationErrors ( $errorsArray )
        {
                $this->formErrors = $errorsArray;
        }
        
        
        function getCategoryId ()
        {
                return $this->categoryId;
        }
        
        
        function setCategoryId ( $id )
        {
                $this->categoryId = $id;
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
        }
        
        
        function _saveWebletState ()
        {
                $stateContainer =& new AddProductToCategoryWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                        
                $stateContainer->setCategoryId($this->getCategoryId() );
                
                Session::putRef('aptcWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('aptcWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setCategoryId($stateContainer->getCategoryId());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('aptcWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( $action == 'add_product_to_category' )
                {
                        return $this->_add_product_to_category( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        return $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                
                $view = $httpRequest->getParameter('view');
                if ( $view == 'capture_details' )
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        return $this->_confirm_details( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
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
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/catalogue_management/add_product_to_category/add_product_to_category.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/catalogue_management/add_product_to_category/add_product_to_category_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                        
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                $template->assign('action', 'capture_details_submit');
                
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                        
                $template->assign('category', $category);
                
                $sql = 'WHERE ISNULL(parent_id) ORDER BY name';
                $products =& Product::find($sql, $this->getConnection());
                
                $template->assign('products', $products);
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Cancel' )
                {
                        return $this->_capture_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('add_product_to_category.php?view=capture_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product_category.php?categoryid='
                        .$category->getId() );
        }
        
        
        
        
        function _add_product_to_category ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                
                $categoryId = $httpRequest->getParameter('categoryid');
                $categoryId = trim($categoryId);
                
                
                $productId = $httpRequest->getParameter('productid');
                $productId = trim($productId);
                
                
                //print $categoryId;
                //print $productId;
                
                
                $category =& ProductCategory::findFirst(
                        array('id' => $categoryId),
                        $this->getConnection() );
                
                $product =& Product::findFirst(
                        array('id' => $productId),
                        $this->getConnection() );
                $category->addProduct($product);
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_category.php?categoryid='
                        .$category->getId() );
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
