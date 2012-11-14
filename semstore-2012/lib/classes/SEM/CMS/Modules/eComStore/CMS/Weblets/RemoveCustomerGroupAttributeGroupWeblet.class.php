<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.eComStore.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('HTML/Forms/Form.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveCustomerGroupAttributeGroupWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/CMS/Forms/AddProductForm.class.php');
require_once('SEM/CMS/Modules/eComStore/eComStoreUtils.class.php');
require_once('SEM/CMS/Modules/eComStore/Product.class.php');
require_once('SEM/CMS/Modules/eComStore/CustomerGroup.class.php');

class RemoveCustomerGroupAttributeGroupWeblet extends Weblet
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
        var $attributegroupid = NULL;
        var $groupName = '';
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function RemoveCustomerGroupAttributeGroupWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveCustomerGroupAttributeGroupWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveCustomerGroupAttributeGroupWeblet0 ()
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
        
        
        function getAttributeGroupId ()
        {
                return $this->attributegroupid;
        }
        
        
        function setAttributeGroupId ( $id )
        {
                $this->attributegroupid = $id;
        }
        
        
        function getGroupName ()
        {
                return $this->productName;
        }
        
        
        function setGroupName ( $name )
        {
                $this->productName = $name;
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
                $stateContainer =& new RemoveCustomerGroupAttributeGroupWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setAttributeGroupId($this->getAttributeGroupId());
                $stateContainer->setGroupName($this->getGroupName() );
                
                Session::putRef('rpWebletStateContainer',
                        $stateContainer);
                /*
                Debug::debugMsg(DebugLevel::DEBUG(), 
                        'RegistrationWeblet' . print_r($this,TRUE));
                Debug::debugMsg(DebugLevel::DEBUG(), 
                        'StateContainer'.print_r($stateContainer,TRUE));
                Debug::flush();
                exit();
                */
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('rpWebletStateContainer');
                if ( is_null($stateContainer) )
                {
                        return;
                }
                
                $this->setView($stateContainer->getView());
                $this->setFormValidationErrors(
                        $stateContainer->getFormValidationErrors() );
                
                $this->setAttributeGroupId($stateContainer->getAttributeGroupId());
                $this->setGroupName($stateContainer->getGroupName());
        }
        
        
        function _destroyWebletState ()
        {
                Session::put('rpWebletStateContainer', NULL);
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
                elseif ( $view == 'confirm_details' )
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
                else
                {
                        $this->_confirm_details($httpRequest, $httpResponse);
                        return;
                }
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                $action = $httpRequest->getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
                }
                elseif ( $action == 'capture_details_submit' )
                {
                        $this->_capture_details_submit($httpRequest, $httpResponse);
                        return;
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        $this->_confirm_details_submit($httpRequest, $httpResponse);
                        return;
                }
                else
                {
                        $httpResponse->redirect($_SERVER['PHP_SELF']);
                        return;
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
                        $group =& CustomerGroupCustomerAttributeGroup::findFirst(array('id' => $this->getAttributeGroupId()),
                                $this->getConnection() );
                        $this->setGroupName($group->getName());
                        
                        $this->_saveWebletState();
                }
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/customer_groups/remove_customer_group_attribute_group/remove_customer_group_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/customer_groups/remove_customer_group_attribute_group/remove_customer_group_attribute_group_confirmation.tpl');
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
                
                $template->assign('name', $this->getGroupName());
                
                
                /* Render template */
                $httpResponse->setContent($template->render());
        }
        
        
        function _confirm_details_submit ( &$httpRequest, &$httpResponse )
        {
                $this->_restoreWebletState();
                
                $button = $httpRequest->getParameter('button');
                if ( $button == 'Remove' )
                {
                        $this->_confirm_details_next($httpRequest, $httpResponse);
                        return;
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_confirm_details_cancel($httpRequest, $httpResponse);
                        return;
                }
                
                $this->setView('confirm_details');
                $this->_saveWebletState();
                $httpResponse->redirect('remove_group.php?view=capture_details');
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(array('id' => $this->getAttributeGroupId()), $this->getConnection());
                $group->remove(TRUE);
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect("manage_customer_group.php?groupid=".$group->getGroupId());
        }
        
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $group =& CustomerGroupCustomerAttributeGroup::findFirst(array('id' => $this->getAttributeGroupId()), $this->getConnection());
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect("manage_customer_group.php?groupid=".$group->getGroupId());
        }
        
        
        
        function &_productId2Product ( $id, &$connection )
        {
                $product =& Product::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $product;
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
                                'name' => 'Products & Catalogue',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/'
                                ),
                        array(
                                'name' => 'Products',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_management/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
