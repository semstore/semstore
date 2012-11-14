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
require_once('SEM/CMS/Modules/eComStore/CMS/Weblets/RemoveGlobalProductAttributeGroupWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductGlobalProductAttributeGroup.class.php');

class RemoveGlobalProductAttributeGroupWeblet extends Weblet
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
        
        
        function RemoveGlobalProductAttributeGroupWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveGlobalProductAttributeGroupWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveGlobalProductAttributeGroupWeblet0 ()
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
                $stateContainer =& new RemoveGlobalProductAttributeGroupWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setGroupId($this->getGroupId());
                $stateContainer->setGroupName($this->getGroupName() );
                
                Session::putRef('rgpagWebletStateContainer',
                        $stateContainer);
        }
        
        
        function _restoreWebletState ()
        {
                $stateContainer =& Session::getRef('rgpagWebletStateContainer');
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
                Session::put('rgpagWebletStateContainer', NULL);
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
                
                
                /* Create the template */
                $template =& new CMSTemplate('modules/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute_group/remove_global_product_attribute_group.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('subtemplate', 'modules/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute_group/remove_global_product_attribute_group_confirmation.tpl');
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
                if ( $button == 'Remove' )
                {
                        $this->_confirm_details_next( $httpRequest, $httpResponse );
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_confirm_details_cancel( $httpRequest, $httpResponse );
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                $httpResponse->redirect('remove_global_product_attribute_group.php?view=capture_details');
                exit();
        }
        
        
        function _confirm_details_next ( &$httpRequest, &$httpResponse )
        {
                $group =& $this->_groupId2Group(
                                $this->getGroupId(),
                                $this->getConnection()
                                );
                $group->remove(TRUE);
                
                $this->_destroyWebletState();
                $this->setView('');
                $httpResponse->redirect('index.php');
                exit();
        }
        
        
        
        function _confirm_details_cancel ( &$httpRequest, &$httpResponse )
        {
                $this->_destroyWebletState();
                $httpResponse->redirect('index.php');
                exit();
        }
        
        
        
        function &_groupId2Group ( $id, &$connection )
        {
                $group =& ProductGlobalProductAttributeGroup::findFirst(
                        array('id' => $id),
                        $connection );
                
                return $group;
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
                                'name' => 'General Product Features',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_global_attribute_management/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
