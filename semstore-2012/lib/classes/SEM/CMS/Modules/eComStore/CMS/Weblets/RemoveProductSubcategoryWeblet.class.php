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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveProductSubcategoryWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class RemoveProductSubcategoryWeblet extends Weblet
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
        var $categoryName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveProductSubcategoryWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveProductSubcategoryWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveProductSubcategoryWeblet0 ()
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
        
        
        function getCategoryName ()
        {
                return $this->categoryName;
        }
        
        
        function setCategoryName ( $name )
        {
                $this->categoryName = $name;
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
                $stateContainer =& new RemoveProductSubcategoryWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setCategoryId($this->getCategoryId());
                $stateContainer->setCategoryName($this->getCategoryName() );
                
                Session::putRef('rpsWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('rpsWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setCategoryId($stateContainer->getCategoryId());
                $this->setCategoryName($stateContainer->getCategoryName());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('rpsWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_confirm_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        $this->_confirm_details( $httpRequest, $httpResponse );
                }
                else
                {
                        $this->_confirm_details( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        exit();
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        $this->_confirm_details_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        exit();
                }
        }
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $view = $httpRequest->getParameter('view');
                if ( $view == 'confirm_details' )
                {
                        $this->_restoreWebletState();
                }
                else
                {
                        $category =& $this->_categoryId2Category(
                                $this->getCategoryId(),
                                $this->getConnection() );
                        $this->setCategoryName($category->getName());
                        
                        $this->_saveWebletState();
                }
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/catalogue_management/remove_product_subcategory/remove_product_subcategory.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/catalogue_management/remove_product_subcategory/remove_product_subcategory_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                /* Populate the template variables */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding', 'application/x-www-form-urlencoded');
                $template->assign('action', 'confirm_details_submit');
                
                $template->assign('name', $this->getCategoryName());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Remove' )
                {
                        $this->_confirm_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_confirm_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('remove_product_subcategory.php?view=capture_details');
                exit();
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $category =& $this->_categoryId2Category(
                                $this->getCategoryId(),
                                $this->getConnection()
                                );
                $parent =& $category->getParentCategory();
                $category->remove(TRUE);
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $parent->getId());
                exit();
        }
        
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('index.php');
                exit();
        }
        
        
        
        function &_categoryId2Category ( $id, &$connection )
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $category;
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
