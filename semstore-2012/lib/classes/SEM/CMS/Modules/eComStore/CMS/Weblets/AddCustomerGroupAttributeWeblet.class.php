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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/AddCustomerGroupAttributeWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddCustomerGroupCustomerAttributeForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductType.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttributeGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttribute.class.php');

class AddCustomerGroupAttributeWeblet extends Weblet
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
        var $groupId = NULL;
        var $attributeName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddCustomerGroupAttributeWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_AddCustomerGroupAttributeWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _AddCustomerGroupAttributeWeblet0 ()
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
        
        
        function getGroupId ()
        {
                return $this->groupId;
        }
        
        
        function setGroupId ( $id )
        {
                $this->groupId = $id;
        }
        
        
        function getAttributeName ()
        {
                return $this->attributeName;
        }
        
        
        function setAttributeName ( $name )
        {
                $this->attributeName = $name;
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
                $stateContainer =& new AddCustomerGroupAttributeWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                $stateContainer->setGroupId($this->getGroupId() );
                $stateContainer->setAttributeName($this->getAttributeName() );
                
                Session::putRef('aptpaWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('aptpaWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                $this->setGroupId($stateContainer->getGroupId());
                $this->setAttributeName($stateContainer->getAttributeName());
                
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('aptpaWebletStateContainer', NULL);
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
                        return $this->_confirm_details( $httpRequest, $httpResponse);
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
                return $this->_capture_details($httpRequest, $httpResponse);
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
                
                
                $template =& new CMSTemplate('modules/ecomstore/customer_groups/add_customer_group_attribute/add_customer_group_attribute.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/customer_groups/add_customer_group_attribute/add_customer_group_attribute_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                        
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new AddCustomerGroupCustomerAttributeForm();
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getAttributeName());
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
                $httpResponse->redirect('add_customer_group_attribute.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                $form =& new AddCustomerGroupCustomerAttributeForm();
                
                $name = $httpRequest->getParameter('name');
                $name = stripslashes(trim($name));
                $this->setAttributeName($name);
                
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getAttributeName());
                
                
                $errors = $form->validate();
                
                // Check for uniqueness
                /*
                if ( eComStoreUtils::productTypeAttributeWithNameExists(
                        $this->getAttributeName(),
                        $this->getConnection()) === TRUE )
                {
                        array_push($errors,
                                'A feature with ' .
                                'that name already exists.');
                }
                */
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('add_customer_group_attribute.php?view=capture_details');
                        return;
                }
                
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('add_customer_group_attribute.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
                $httpResponse->redirect('manage_customer_group.php?typeid='.$group->getTypeId());
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Create the template */
                $template =& new
                 CMSTemplate('modules/ecomstore/customer_groups/add_customer_group_attribute/add_customer_group_attribute.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/customer_groups/add_customer_group_attribute/add_customer_group_attribute_confirmation.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                
                /* Populate the template variables */
                $template->assign('formAction', $_SERVER['PHP_SELF']);
                $template->assign('formMethod', 'post');
                $template->assign('formEncType', 'application/x-www-form-urlencoded');
                $template->assign('action', 'confirm_details_submit');
                $template->assign('name', $this->getAttributeName());
                
                
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
                $httpResponse->redirect('add_customer_group_attribute.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
        
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
                
                
                $attribute = new CustomerGroupCustomerAttribute();
                $attribute->setName($this->getAttributeName());
                $group->addAttributeAtEnd($attribute);
                
                //$this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_customer_group.php?typeid='.$group->getId());
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('add_customer_group_attribute.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
                $httpResponse->redirect('manage_customer_group.php?typeid='.$group->getTypeId());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
        /*
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(
                        array('id' => $this->getGroupId()),
                        $this->getConnection() );
                $type =& $group->getType();
                
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
                                'name' => 'Products & Catalogue',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                ),
                        array(
                                'name' => 'Product Types',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_type_management/'
                                ),
                        array(
                                'name' => 'Product Type: ' . $type->getName(),
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_type_management/manage_customer_group.php?typeid=' . $type->getId()
                                )
                        );
                
                return $breadcrumb;
                */
        }
}


?>
