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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/EditProductTypeAttributeGroupWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/EditProductTypeAttributeGroupForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeProductAttributeGroup.class.php');

class EditProductTypeAttributeGroupWeblet extends Weblet
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
        var $groupName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function EditProductTypeAttributeGroupWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_EditProductTypeAttributeGroupWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _EditProductTypeAttributeGroupWeblet0 ()
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
        
        
        function getGroupName ()
        {
                return $this->groupName;
        }
        
        
        function setGroupName ( $name )
        {
                $this->groupName = $name;
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
                $stateContainer =& new EditProductTypeAttributeGroupWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setGroupId($this->getGroupId());
                $stateContainer->setGroupName($this->getGroupName() );
                
                Session::putRef('eptagWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('eptagWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setGroupId($stateContainer->getGroupId());
                $this->setGroupName($stateContainer->getGroupName());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('eptagWebletStateContainer', NULL);
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
                        $group =& $this->_groupId2Group(
                                $this->getGroupId(),
                                $this->getConnection()
                                );
                        $this->setGroupName($group->getName());
                        $this->_saveWebletState();
                }
                
                
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute_group/edit_product_type_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute_group/edit_product_type_attribute_group_form.tpl');
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                $template->addStylesheet(
                        $configuration->getParameter('cms_css_webpath') . 
                        '/semecomstore.css');
                        
                $template->assign('formErrors', $this->getFormValidationErrors());
                
                $form =& new EditProductTypeAttributeGroupForm();
                
                $actionWidget =& $form->getWidget('action');
                $actionWidget->setValue('capture_details_submit');
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getGroupName());
                
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
                $httpResponse->redirect('edit_product_type_attribute_group.php?view=capture_details');
        }
        
        
        function _capture_details_next ( &$httpRequest, &$httpResponse )
        {
                $group =& $this->_groupId2Group(
                        $this->getGroupId(),
                        $this->getConnection()
                        );
                
                /* Prepare the data */
                $form =& new EditProductTypeAttributeGroupForm();
                
                $name = RequestParameters::getParameter('name');
                $name = trim($name);
                $this->setGroupName($name);
                
                
                $nameWidget =& $form->getWidget('name');
                $nameWidget->setValue($this->getGroupName());
                
                
                $errors = $form->validate();
                
                // Check for uniqueness
                if ( $group->getName() != $this->getGroupName() &&
                        eComStoreUtils::productTypeAttributeGroupWithNameExists(
                        $this->getGroupName(),
                        $this->getConnection()) === TRUE )
                {
                        array_push($errors,
                                'A product type feature group with ' .
                                'that name already exists.');
                }
                
                $this->setFormValidationErrors($errors);
                if ( count($errors) > 0 )
                {
                        $this->setView('capture_details');
                        $this->_saveWebletState();
                        $httpResponse->redirect('edit_product_type_attribute_group.php?view=capture_details');
                        return;
                }
                
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('edit_product_type_attribute_group.php?view=confirm_details');
        }
        
        
        function _capture_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                
                $group =& $this->_groupId2Group(
                        $this->getGroupId(),
                        $this->getConnection()
                        );
                $type =& $group->getType();
                
                
                $httpResponse->redirect('manage_product_type.php?typeid=' .
                        $type->getId() );
        }
        
        
        
        
        
        function _confirm_details ( &$httpRequest, &$httpResponse )
        {
                $configuration =& $this->getConfigurator();
                $this->_restoreWebletState();
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute_group/edit_product_type_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute_group/edit_product_type_attribute_group_confirmation.tpl');
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
                $template->assign('name', $this->getGroupName());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
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
                $httpResponse->redirect('edit_product_type_attribute_group.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $group =& $this->_groupId2Group(
                                $this->getGroupId(),
                                $this->getConnection()
                                );
                
                $group->setName($this->getGroupName());
                $group->commit();
                
                $type =& $group->getType();
                
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('manage_product_type.php?typeid=' .
                        $type->getId() );
        }
        
        
        
        function _confirm_details_edit ( &$httpRequest, &$httpResponse )
        {
                $this->setView('capture_details');
                $httpResponse->redirect('edit_product_type_attribute_group.php?view=capture_details');
        }
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                
                $group =& $this->_groupId2Group(
                        $this->getGroupId(),
                        $this->getConnection()
                        );
                $type =& $group->getType();
                
                
                $httpResponse->redirect('manage_product_type.php?typeid=' .
                        $type->getId() );
        }
        
        
        
        function &_groupId2Group ( $id, &$connection )
        {
                $group =& ProductTypeProductAttributeGroup::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $group;
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $group =& $this->_groupId2Group(
                        $this->getGroupId(),
                        $this->getConnection()
                        );
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
                                'name' => 'Products &amp Categories',
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
                                        '/ecomstore/product_catalogue/product_type_management/manage_product_type.php?typeid=' . $type->getId()
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
