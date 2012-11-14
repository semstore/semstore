<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-09-18
 * @package SEM.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('Utils/ObjectArrayIterator.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/CMSUSer.class.php');
require_once('SEM/CMS/CMSCapabilityGroup.class.php');
require_once('SEM/CMS/CMSCapability.class.php');
require_once('SEM/CMS/CMSRole.class.php');

class ManageUserPrivilegesWeblet extends Weblet
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
        var $userId = NULL;
        /* Weblet State Variables :: Stop */
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function ManagePrivilegesWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_ManagePrivilegesWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _ManagePrivilegesWeblet0 ()
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
        
        
        function getUserId ()
        {
                return $this->userId;
        }
        
        
        function setUserId ( $userId )
        {
                $this->userId = $userId;
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
                ;
        }
        
        
        function _restoreWebletState ()
        {
                ;
        }
        
        
        function _destroyWebletState ()
        {
                ;
        }
        
        
        function doGet ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                if ( is_null($view) || $view == '' )
                {
                        return $this->_default( $httpRequest, $httpResponse );
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
                else
                {
                        return $httpResponse->redirect($_SERVER['PHP_SELF']);
                }
        }
        
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                $view = $httpRequest->getParameter('view');
                
                $template =& new CMSTemplate('user_management/manage_user_privileges.tpl');
                $template->autoconfigure($this->getConfigurator());
                $template->assign('breadcrumb',
                        $this->_prepareBreadcrumbArray());
                
                $user =& CMSUser::findFirst(
                        array('id' => $this->getUserId()),
                        $this->getConnection() );
                $template->assign('user', $user);
                
                $template->assign('formAction',
                        dirname($_SERVER['PHP_SELF']) .
                        '/update_user_privileges.php');
                $template->assign('formMethod', 'post');
                $template->assign('formEncoding',
                        'application/x-www-form-urlencoded');
                $template->assign('action',
                        'update_privileges');
                
                $capabilityGroupsArray = array();
                
                $capabilityGroups =& CMSCapabilityGroup::find(
                        'ORDER BY idx',
                        $this->getConnection());
                $groupIterator =& new ObjectArrayIterator($capabilityGroups);
                while ( $groupIterator->hasNext() )
                {
                        $capabilityGroup =& $groupIterator->next();
                        $capabilityGroupsArray[$capabilityGroup->getId()] =
                                array('obj' => $capabilityGroup,
                                        'capabilities' => array());
                        
                        $capabilities =& $capabilityGroup->getCapabilities();
                        $capIterator =& new ObjectArrayIterator($capabilities);
                        while ( $capIterator->hasNext() )
                        {
                                $capability =& $capIterator->next();
                                $capabilityGroupsArray[$capabilityGroup->getId()]['capabilities'][$capability->getId()]['obj'] =
                                        $capability;
                                if ( $user->hasCapability($capability) )
                                {
                                        $capabilityGroupsArray[$capabilityGroup->getId()]['capabilities'][$capability->getId()]['checked'] =
                                                TRUE;
                                }
                                else
                                {
                                        $capabilityGroupsArray[$capabilityGroup->getId()]['capabilities'][$capability->getId()]['checked'] =
                                                FALSE;
                                }
                        }
                }
                
                $template->assign_by_ref('capabilityGroups',
                        $capabilityGroupsArray);
                
                $httpResponse->setContent($template->render());
        }
        
        
        function _prepareBreadcrumbArray ()
        {
                $user =& CMSUser::findFirst(
                        array('id' => $this->getUserId()),
                        $this->getConnection());
                        
                $breadcrumb = array(
                        array(
                                'name' => 'Home',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/'
                                ),
                        array(
                                'name' => 'User Management',
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/user_management/'
                                ),
                        array(
                                'name' => 'Manage User: ' . $user->getFirstname() . ' ' .
                                        $user->getSurname(),
                                'url' => Configuration::getParameter('cms_root_webpath') .
                                        '/user_management/manage_user.php?uid=' .
                                        $user->getId()
                                )
                        );
                
                return $breadcrumb;
        }
}


?>
