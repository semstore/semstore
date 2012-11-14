<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-09-19
 * @package SEM.CMS.Weblets
 */

require_once('HTTP/Weblet.class.php');
require_once('HTTP/HttpRequest.class.php');
require_once('HTTP/HttpResponse.class.php');

require_once('Configuration/Configuration.class.php');
require_once('Session/Session.class.php');
require_once('SEM/CMS/Templates/CMSTemplate.class.php');
require_once('SEM/CMS/CMSUSer.class.php');
require_once('SEM/CMS/CMSCapabilityGroup.class.php');
require_once('SEM/CMS/CMSCapability.class.php');
require_once('SEM/CMS/CMSRole.class.php');

class UpdateUserPrivilegesWeblet extends Weblet
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
        
        
        function UpdatePrivilegesWeblet ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array( &$this, '_UpdatePrivilegesWeblet'.$numArgs),
                        $args
                        );
        }
        
        
        function _UpdatePrivilegesWeblet0 ()
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
                return $this->_default( $httpRequest, $httpResponse );
        }
        
        
        function doPost ( &$httpRequest, &$httpResponse )
        {
                return $this->_default( $httpRequest, $httpResponse );
        }
        
        
        
        
        
        function _default ( &$httpRequest, &$httpResponse )
        {
                if ( is_null($this->getUserId()) ||
                        $this->getUserId() == '' )
                {
                        $httpResponse->redirect(
                                dirname($_SERVER['PHP_SELF']) . '/index.php');
                }
                
                $user =& CMSUser::findFirst(
                        array('id' => $this->getUserId()),
                        $this->getConnection() );
                
                if ( is_null($user) )
                {
                        $httpResponse->redirect(
                                dirname($_SERVER['PHP_SELF']) . '/index.php');
                }
                
                
                //
                $currentPrivileges =& $user->getCapabilities();
                
                
                // Extract a list of granted privilege ids from $_REQUEST
                $grantedPrivilegeIds = CMSUtils::grepArrayKeys(
                        $_REQUEST, '{^PRIV_}');
                foreach ( $grantedPrivilegeIds as $key => $grantedPrivilegeId )
                {
                        $grantedPrivilegeIds[$key] =
                                str_replace(
                                'PRIV_',
                                '',
                                $grantedPrivilegeId);
                }
                
                
                // Turn them into a set of privilege objects
                $grantedPrivileges = array();
                foreach ( $grantedPrivilegeIds as $grantedPrivilegeId )
                {
                        //print $grantedPrivilegeId;
                        $grantedCapability =& CMSCapability::findFirst(
                                array('name' => $grantedPrivilegeId),
                                $this->getConnection());
                        if ( !is_null($grantedCapability) )
                        {
                                //print "1";
                                $grantedPrivileges[$grantedCapability->getName()] =&
                                        $grantedCapability;
                        }
                }
                
                //print_r($grantedPrivileges);
                //die();
                
                
                // Compare the users current privileges with new set of
                // privileges to determine which privileges (if any) have been
                // revoked.
                $revokedPrivileges = array();
                
                foreach ( array_keys($currentPrivileges) as $currPrivKey )
                {
                        $currentPrivilege =& $currentPrivileges[$currPrivKey];
                        $privfound = FALSE;
                        foreach ( array_keys($grantedPrivileges) as $grantPrivKey )
                        {
                                $grantedPrivilege =& $grantedPrivileges[$grantPrivKey];
                                if ( $currentPrivilege->getName() ==
                                        $grantedPrivilege->getName() )
                                {
                                        $privfound = TRUE;
                                        break;
                                }
                        }
                        
                        if ( !$privfound )
                        {
                                $revokedPrivileges[$currentPrivilege->getName()] =&
                                        $currentPrivilege;
                        }
                }
                
                
                // Grant privileges from new set of privileges
                foreach ( array_keys($grantedPrivileges) as $grantPrivKey )
                {
                        //print "Grant: " . $grantPrivKey;
                        $grantedPrivilege =& $grantedPrivileges[$grantPrivKey];
                        $user->grantCapability($grantedPrivilege);
                }
                
                
                // Revoke privileges
                foreach ( array_keys($revokedPrivileges) as $revokedPrivKey )
                {
                        //print "Revoke: " . $revokedPrivKey;
                        $revokedPrivilege =& $revokedPrivileges[$revokedPrivKey];
                        $user->revokeCapability($revokedPrivilege);
                }
                
                
                $httpResponse->redirect(
                        dirname($_SERVER['PHP_SELF']) .
                        '/manage_user_privileges.php?uid=' . $user->getId());
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
