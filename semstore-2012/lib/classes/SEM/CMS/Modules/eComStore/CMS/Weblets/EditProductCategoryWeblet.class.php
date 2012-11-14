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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/EditProductCategoryWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/EditProductCategoryForm.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductCategory.class.php');

class EditProductCategoryWeblet extends Weblet
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
        var $categoryDescription = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditProductCategoryWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditProductCategoryWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditProductCategoryWeblet0 ()
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
        
        
        function getCategoryDescription ()
        {
                return $this->categoryDescription;
        }
        
        
        function setCategoryDescription ( $description )
        {
                $this->categoryDescription = $description;
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
                $stateContainer =& new EditProductCategoryWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setCategoryId($this->getCategoryId());
                $stateContainer->setCategoryName($this->getCategoryName());
                $stateContainer->setCategoryDescription($this->getCategoryDescription());
                
                Session::putRef('epcWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('epcWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setCategoryId($stateContainer->getCategoryId());
                $this->setCategoryName($stateContainer->getCategoryName());
                $this->setCategoryDescription($stateContainer->getCategoryDescription());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('epcWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'capture_details' )
                {
                        return $this->_capture_details( $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        return $this->_confirm_details( $httpRequest, $httpResponse );
                }
                else
                {
                        return $this->_default( $httpRequest, $httpResponse );
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        return $this->_capture_details_submit( $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        return $this->_confirm_details_submit( $httpRequest, $httpResponse );
                }
                else
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                return $this->_capture_details( $httpRequest, $httpResponse );
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
                        $category =& ProductCategory::findFirst(
                                array('id' => $this->getCategoryId()),
                                $this->getConnection()
                                );
                        $this->setCategoryName($category->getName());
                        $this->setCategoryDescription(
                                $category->getDescription());
                        
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/catalogue_management/edit_product_category/edit_product_category.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/catalogue_management/edit_product_category/edit_product_category_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new EditProductCategoryForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getCategoryName());
                
                $descriptionWidget =& $form->getWidget('description');
                $descriptionWidget->setValue($this->getCategoryDescription());
                
                $template->assign('form', $form);
                
                foreach ( array_keys($form->getWidgets()) as $widgetId )
                {
                        $widget =& $form->getWidget($widgetId);
                        $template->assign($widgetId.'Widget', $widget);
                }
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _capture_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_capture_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_capture_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_category.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                $form =& new EditProductCategoryForm();
                
                $name = $httpRequest->getParameter('name');
                $name = stripslashes(trim($name));
                $this->setCategoryName($name);
                
                
                $description = $httpRequest->getParameter('description');
                $description = stripslashes(trim($description));
                $this->setCategoryDescription($description);
                
                
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getCategoryName());
                
                $descriptionWidget =& $form->getWidget('description');
                $descriptionWidget->setValue($this->getCategoryDescription());
                
                
                $errors = $form->validate();
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('edit_product_category.php?view=capture_details');
                        return;
                }
                
                // Check for uniqueness
                
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_category.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $category->getId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/catalogue_management/edit_product_category/edit_product_category.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/catalogue_management/edit_product_category/edit_product_category_confirmation.tpl');
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
                $template->assign('description', $this->getCategoryDescription());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_confirm_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Edit Details' )
                {
                        return $this->_confirm_details_edit( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_confirm_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_category.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                $category->setName($this->getCategoryName());
                $category->setDescription($this->getCategoryDescription());
                $category->commit();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $category->getId());
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('edit_product_category.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $category =& ProductCategory::findFirst(
                        array('id' => $this->getCategoryId()),
                        $this->getConnection() );
                
                $this->_destroyWebletState();
                
                $httpResponse->redirect('manage_product_category.php?categoryid=' .
                        $category->getId());
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
