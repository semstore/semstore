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
require_once('SEM/CMS/Modules/eComStore/Weblets/RemoveProductTypeAttributeGroupWebletStateContainer.class.php');
require_once('SEM/CMS/Modules/eComStore/ProductTypeProductAttributeGroup.class.php');

class RemoveProductTypeAttributeGroupWeblet extends Weblet
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
        
        
        function RemoveProductTypeAttributeGroupWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_RemoveProductTypeAttributeGroupWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _RemoveProductTypeAttributeGroupWeblet0 ()
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
                $stateContainer =& new RemoveProductTypeAttributeGroupWebletStateContainer();
                $stateContainer->setView($this->getView());
                $stateContainer->setFormValidationErrors(
                        $this->getFormValidationErrors() );
                
                $stateContainer->setGroupId($this->getGroupId());
                $stateContainer->setGroupName($this->getGroupName() );
                
                Session::putRef('rtpagWebletStateContainer',
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
                $stateContainer =& Session::getRef('rtpagWebletStateContainer');
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
        
        
        function doGet ()
        {
                $view = RequestParameters::getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        $this->_confirm_details();
                }
                elseif ( $view == 'confirm_details' )
                {
                        $this->_confirm_details();
                }
                else
                {
                        $this->_confirm_details();
                }
        }
        
        
        function doPost ()
        {
                $action = RequestParameters::getParameter('action');
                if ( is_null($action) || $action == '' )
                {
                        SiteUtils::redirect($_SERVER['PHP_SELF']);
                        exit();
                }
                elseif ( $action == 'confirm_details_submit' )
                {
                        $this->_confirm_details_submit();
                }
                else
                {
                        SiteUtils::redirect($_SERVER['PHP_SELF']);
                        exit();
                }
        }
        
        
        
        
        function _confirm_details ()
        {
                $configuration =& $this->getConfigurator();
                $view = RequestParameters::getParameter('view');
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
                Out::writeOut($template->render());
        }
        
        
        function _confirm_details_submit ()
        {
                $this->_restoreWebletState();
                
                $button = RequestParameters::getParameter('button');
                if ( $button == 'Remove' )
                {
                        $this->_confirm_details_next();
                }
                elseif ( $button == 'Cancel' )
                {
                        $this->_confirm_details_cancel();
                }
                
                $this->setView('capture_details');
                $this->_saveWebletState();
                SiteUtils::redirect('remove_global_product_attribute_group.php?view=capture_details');
                exit();
        }
        
        
        function _confirm_details_next ()
        {
                $group =& $this->_groupId2Group(
                                $this->getGroupId(),
                                $this->getConnection()
                                );
                
                
                $this->_destroyWebletState();
                $this->setView('');
                SiteUtils::redirect('index.php');
                exit();
        }
        
        
        
        function _confirm_details_cancel ()
        {
                $this->_destroyWebletState();
                SiteUtils::redirect('index.php');
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
                                'name' => 'Global Product Attributes',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/ecomstore/product_catalogue/product_global_attribute_management/'
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
