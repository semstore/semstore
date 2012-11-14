<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/Weblet.class.php');

require_once('HTTP/RequestParameters.class.php');
require_once('Session/Session.class.php');
require_once('Web/Site/SiteUtils.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/Weblets/EditProductTypeWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/Forms/EditProductTypeForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');

class EditProductTypeWeblet extends Weblet
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
        var $typeId = NULL;
        var $typeName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditProductTypeWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditProductTypeWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditProductTypeWeblet0 ()
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
        
        
        function getTypeId ()
        {
                return $this->typeId;
        }
        
        
        function setTypeId ( $id )
        {
                $this->typeId = $id;
        }
        
        
        function getTypeName ()
        {
                return $this->typeName;
        }
        
        
        function setTypeName ( $name )
        {
                $this->typeName = $name;
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
                $stateContainer =& new EditProductTypeWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setTypeId($this->getTypeId());
                $stateContainer->setTypeName($this->getTypeName() );
                
                Session::putRef('eptWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('eptWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setTypeId($stateContainer->getTypeId());
                $this->setTypeName($stateContainer->getTypeName());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('eptWebletStateContainer', NULL);
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
                        return $this->_capture_details(
                                $httpRequest, $httpResponse );
                }
                elseif ( $view == 'confirm_details' )
                {
                        return $this->_confirm_details(
                                $httpRequest, $httpResponse );
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
                        return $this->_capture_details_submit(
                                $httpRequest, $httpResponse );
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        return $this->_confirm_details_submit(
                                $httpRequest, $httpResponse );
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
                        $type =& $this->_typeId2Type(
                                $this->getTypeId(),
                                $this->getConnection()
                                );
                        $this->setTypeName($type->getName());
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('cms/ecomstore/product_catalogue/product_type_management/edit_product_type/edit_product_type.tpl');
                $template->assign('subtemplate', 'cms/ecomstore/product_catalogue/product_type_management/edit_product_type/edit_product_type_form.tpl');
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new EditProductTypeForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getTypeName());
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
                        return $this->_capture_details_next(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_capture_details_cancel(
                                $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_type.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $type =& $this->_typeId2Type(
                                $this->getTypeId(),
                                $this->getConnection()
                                );
                
                /* Prepare the data */
                $form =& new EditProductTypeForm();
                
                $name = $httpRequest->getParameter('name');
                $name = trim($name);
                $this->setTypeName($name);
                
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getTypeName());
                
                
                $errors = $form->validate();
                
                // Check for uniqueness
                if ( $type->getName() != $this->getTypeName() &&
                        eComStoreUtils::productTypeWithNameExists(
                        $this->getTypeName(),
                        $this->getConnection()) === TRUE )
                {
                        array_push($errors,
                                'A product type with ' .
                                'that name already exists.');
                }
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('edit_product_type.php?view=capture_details');
                        return;
                }
                
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_type.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect('index.php');
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Create the template */
                $template =& new CMSTemplate('cms/ecomstore/product_catalogue/product_type_management/edit_product_type/edit_product_type.tpl');
                $template->assign('subtemplate', 'cms/ecomstore/product_catalogue/product_type_management/edit_product_type/edit_product_type_confirmation.tpl');
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                //$template->autoconfigure($this->getConfigurator());
                
                /* Populate the template variables */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncType', 'application/x-www-form-urlencoded');
                $template->assign('action', 'confirm_details_submit');
                $template->assign('name', $this->getTypeName());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = RequestParameters::getParameter('button');
                if ( $button == 'Submit Details' )
                {
                        return $this->_confirm_details_next(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Edit Details' )
                {
                        return $this->_confirm_details_edit(
                                $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        return $this->_confirm_details_cancel(
                                $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_type.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $type =& $this->_typeId2Type(
                                $this->getTypeId(),
                                $this->getConnection()
                                );
                
                $type->setName($this->getTypeName());
                $type->commit();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('index.php');
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('edit_product_type.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect('index.php');
        }
        
        
        
        function &_typeId2Type ( $id, &$connection )
        {
                $type =& ProductType::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $type;
        }
}


?>
