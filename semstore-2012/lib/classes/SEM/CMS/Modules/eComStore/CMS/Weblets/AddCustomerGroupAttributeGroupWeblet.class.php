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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/AddCustomerGroupAttributeGroupWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddCustomerGroupAttributeGroupForm.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroup.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAttributeGroup.class.php');
//require_once('SEM/CMS/Modules/eComStore/CustomerGroupCustomerAtribute.class.php');

class AddCustomerGroupAttributeGroupWeblet extends Weblet
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
        var $attributeGroupName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddCustomerGroupAttributeGroupWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_AddCustomerGroupAttributeGroupWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _AddCustomerGroupAttributeGroupWeblet0 ()
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
        
        
        function getCustomerGroupId ()
        {
                return $this->customerGroupId;
        }
        
        
        function setCustomerGroupId ( $id )
        {
                $this->customerGroupId = $id;
        }
        
        
        function getAttributeGroupName ()
        {
                return $this->attributeGroupName;
        }
        
        
        function setAttributeGroupName ( $attrGroupName )
        {
                $this->attributeGroupName = $attrGroupName;
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
                $stateContainer =& new AddCustomerGroupAttributeGroupWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                $stateContainer->setCustomerGroupId($this->getCustomerGroupId());
                $stateContainer->setAttributeGroupName(
                        $this->getAttributeGroupName() );
                
                Session::putRef('acgagWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('acgagWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                $this->setAttributeGroupName(
                        $stateContainer->getAttributeGroupName());
                $this->setCustomerGroupId($stateContainer->getCustomerGroupId());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('acgagWebletStateContainer', NULL);
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
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/customer_groups/add_customer_group_attribute_group/add_customer_group_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/customer_groups/add_customer_group_attribute_group/add_customer_group_attribute_group_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                        
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new AddCustomerGroupAttributeGroupForm();
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getAttributeGroupName());
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
                $httpResponse->redirect('add_customer_group_attribute_group.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                /* Prepare the data */
                $form =& new AddCustomerGroupAttributeGroupForm();
                
                $name = $httpRequest->getParameter('name');
                $name = stripslashes(trim($name));
                $this->setAttributeGroupName($name);
                
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getAttributeGroupName());
                
                
                $errors = $form->validate();
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('add_customer_group_attribute_group.php?view=capture_details');
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('add_customer_group_attribute_group.php?view=confirm_details');
                return;
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect(
                        'manage_customer_group.php?groupid=' . 
                        $this->getCustomerGroupId());
                return;
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                
                $this->_restoreWebletState();
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/customer_groups/add_customer_group_attribute_group/add_customer_group_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/customer_groups/add_customer_group_attribute_group/add_customer_group_attribute_group_confirmation.tpl');
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
                $template->assign('name', $this->getAttributeGroupName());
                
                
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
                $httpResponse->redirect('add_customer_group_attribute_group.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $customerGroup =& CustomerGroup::findFirst(
                        array('id' => $this->getCustomerGroupId()),
                        $this->getConnection() );
                
                $group = new CustomerGroupCustomerAttributeGroup();
                $group->setName($this->getAttributeGroupName());
                $customerGroup->addAttributeGroupAtEnd($group);
                $customerGroup->commit();
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_customer_group.php?groupid='.$customerGroup->getId());
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('add_customer_group_attribute_group.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect('manage_customer_group.php?groupid='.$this->getCustomerGroupId());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $group =& CustomerGroup::findFirst(
                        array('id' => $this->getCustomerGroupId()),
                        $this->getConnection() );
                
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
                                'name' => 'Customer Groups',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/customer_groups/'
                                ),
                        array(
                                'name' => 'Customer Group: ' . $group->getName(),
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/customer_groups/manage_customer_group.php?groupid=' . $group->getId()
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
